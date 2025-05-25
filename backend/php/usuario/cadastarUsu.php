<?php
// Configurações de segurança
header('X-Frame-Options: DENY');
header('X-Content-Type-Options: nosniff');
header('X-XSS-Protection: 1; mode=block');
header('Strict-Transport-Security: max-age=63072000; includeSubDomains; preload');

// Inicia a sessão com cookies seguros
session_set_cookie_params([
    'lifetime' => 3600,
    'path' => '/',
    'domain' => $_SERVER['HTTP_HOST'],
    'secure' => true,
    'httponly' => true,
    'samesite' => 'Strict'
]);
session_start();

include '../conn.php';

class UsuarioCadastro {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    private function sanitizeInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
        return $data;
    }

    private function validateCPF($cpf) {
        $cpf = preg_replace('/[^0-9]/', '', $cpf);
        
        if (strlen($cpf) != 11 || preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }
        return true;
    }

    private function validateEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    private function validatePassword($password) {
        return strlen($password) >= 8;
    }

    private function logError($error) {
        $logMessage = date('[Y-m-d H:i:s]') . " ERRO: " . $error . PHP_EOL;
        file_put_contents('security.log', $logMessage, FILE_APPEND);
    }

    public function cadastrar($data) {
        try {
            // Sanitização de todos os inputs
            $cpfSujo = $this->sanitizeInput($data['cliente-cpf']);
            $nome = $this->sanitizeInput($data['cliente-nome']);
            $sobrenome = $this->sanitizeInput($data['cliente-sobrenome']);
            $email = $this->sanitizeInput($data['cliente-email']);
            $senha = $data['cliente-senha'];
            $celular = $this->sanitizeInput($data['cliente-celular']);
            $cep = $this->sanitizeInput($data['cliente-cep']);
            $rua = $this->sanitizeInput($data['cliente-rua']);
            $bairro = $this->sanitizeInput($data['cliente-bairro']);
            $cidade = $this->sanitizeInput($data['cliente-cidade']);
            $estado = $this->sanitizeInput($data['cliente-estado']);
            $numero = $this->sanitizeInput($data['cliente-numero']);
            $complemento = $this->sanitizeInput($data['cliente-complemento']);
            $img = './img/UsuarioOFF.png';

            // Validações
            $cpf = str_replace(['.','-'],'',$cpfSujo);
            
            if (!$this->validateCPF($cpf)) {
                throw new Exception("CPF inválido");
            }
            
            if (!$this->validateEmail($email)) {
                throw new Exception("E-mail inválido");
            }
            
            if (!$this->validatePassword($senha)) {
                throw new Exception("A senha deve ter pelo menos 8 caracteres");
            }

            // Hash seguro da senha
            $senhaHash = password_hash($senha, PASSWORD_BCRYPT, ['cost' => 12]);
            if ($senhaHash === false) {
                throw new Exception("Falha ao criar hash da senha");
            }

            // Verifica se usuário já existe
            $sql_check = $this->conn->prepare("SELECT cpf, email FROM usuarios WHERE cpf = ? OR email = ?");
            $sql_check->bind_param('ss', $cpf, $email);
            $sql_check->execute();
            $result = $sql_check->get_result();

            if ($result->num_rows > 0) {
                $this->logError("Tentativa de cadastro com CPF/e-mail existente: $cpf / $email");
                throw new Exception("Usuário já existe com o CPF ou e-mail fornecido");
            }

            // Inicia transação
            $this->conn->begin_transaction();

            try {
                // Verifica/insere endereço
                $sql_check2 = $this->conn->prepare("SELECT cep FROM enderecos WHERE cep = ? FOR UPDATE");
                $sql_check2->bind_param('s', $cep);
                $sql_check2->execute();
                $result2 = $sql_check2->get_result();

                if ($result2->num_rows === 0) {
                    $sql2 = $this->conn->prepare("INSERT INTO enderecos (cep, rua, bairro, cidade, estado) 
                            VALUES (?, ?, ?, ?, ?)");
                    $sql2->bind_param('sssss', $cep, $rua, $bairro, $cidade, $estado);
                    if (!$sql2->execute()) {
                        throw new Exception("Falha ao cadastrar endereço");
                    }
                }

                // Insere usuário
                $sql = $this->conn->prepare("INSERT INTO usuarios 
                        (logado, cpf, nome, sobrenome, email, senha, celular, cep, numero, complemento, img) 
                        VALUES (0, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $sql->bind_param('ssssssssss', $cpf, $nome, $sobrenome, $email, $senhaHash, $celular, $cep, $numero, $complemento, $img);
                
                if (!$sql->execute()) {
                    throw new Exception("Falha ao cadastrar usuário");
                }

                $this->conn->commit();
                
                // Limpa dados sensíveis da memória
                unset($senha, $senhaHash);
                
                $this->alertAndRedirect('✅ Cadastro realizado com sucesso!', '../index.php', false);
                
            } catch (Exception $e) {
                $this->conn->rollback();
                $this->logError($e->getMessage());
                throw $e;
            }

        } catch (Exception $e) {
            $this->alertAndRedirect('❌ ' . $e->getMessage(), '../../frontend/pages/cadastro.html', true);
        }
    }

    public function alertAndRedirect($msg, $url, $isError) {
        $_SESSION['flash_message'] = $msg;
        $_SESSION['flash_is_error'] = $isError;
        header("Location: $url");
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cadastro = new UsuarioCadastro($conn);
    $cadastro->cadastrar($_POST);
} else {
    header("HTTP/1.1 405 Method Not Allowed");
    exit;
}
?>