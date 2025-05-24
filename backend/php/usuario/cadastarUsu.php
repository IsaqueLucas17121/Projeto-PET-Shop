<?php

include '../conn.php';

class UsuarioCadastro {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function cadastrar($data) {
        $logado = '0';
        $cpfSujo = $data['cliente-cpf'];
        $nome = $data['cliente-nome'];
        $sobrenome = $data['cliente-sobrenome'];
        $email = $data['cliente-email'];
        $senha = $data['cliente-senha'];
        $celular = $data['cliente-celular'];
        $cep = $data['cliente-cep'];
        $rua = $data['cliente-rua'];
        $bairro = $data['cliente-bairro'];
        $cidade = $data['cliente-cidade'];
        $estado = $data['cliente-estado'];
        $numero = $data['cliente-numero'];
        $complemento = $data['cliente-complemento'];
        $img = './img/UsuarioOFF.png';

        $cpf = str_replace(['.','-'],'',$cpfSujo);

        // Verifica se usuário já existe
        $sql_check = $this->conn->prepare("SELECT * FROM usuario WHERE cpf = ?");
        $sql_check->bind_param('s', $cpf);
        $sql_check->execute();
        $result = $sql_check->get_result();

        // Verifica se endereço já existe
        $sql_check2 = $this->conn->prepare("SELECT * FROM endereco WHERE cep = ?");
        $sql_check2->bind_param('s', $cep);
        $sql_check2->execute();
        $result2 = $sql_check2->get_result();

        if ($result->num_rows > 0) {
            $this->alertAndRedirect('Usuário já existe com o CPF fornecido.', '../index.php');
        } else if ($result2->num_rows > 0) {
            $sql = "INSERT INTO usuario (logado,cpf,nome,sobrenome,email,senha,celular,cep,img) 
                    VALUES ('$logado','$cpf','$nome','$sobrenome','$email','$senha','$celular','$cep','$img')";
            if ($this->conn->query($sql)) {
                $this->alertAndRedirect('Usuario Cadastrado', '../index.php');
            } else {
                $this->alertAndRedirect('Falha ao cadastrar usuário: ' . $this->conn->error, '../../frontend/pages/cadastro.html');
            }
        } else {
            $sql2 = "INSERT INTO endereco (cep,numero,rua,bairro,cidade,estado,complemento) 
                     VALUES ('$cep','$numero','$rua','$bairro','$cidade','$estado','$complemento')";
            $sql = "INSERT INTO usuario (logado,cpf,nome,sobrenome,email,senha,celular,cep,img) 
                    VALUES ('$logado','$cpf','$nome','$sobrenome','$email','$senha','$celular','$cep','$img')";
            if ($this->conn->query($sql2) === TRUE && $this->conn->query($sql) === TRUE) {
                $this->alertAndRedirect('Usuario Cadastrado', '../index.php');
            } else {
                $this->alertAndRedirect('Falha ao cadastrar usuário: ' . $this->conn->error, '../../frontend/pages/cadastro.html');
            }
        }
    }

    private function alertAndRedirect($msg, $url) {
        echo "<script>alert('$msg');</script>";
        echo "<script>location.href='$url';</script>";
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cadastro = new UsuarioCadastro($conn);
    $cadastro->cadastrar($_POST);
} else {
    echo "Método de requisição inválido.";
}
?>