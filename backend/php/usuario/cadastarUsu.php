<?php

include '../conn.php';

$logado = '0';
$cpfSujo = $_POST['cliente-cpf'];
$nome = $_POST['cliente-nome'];
$sobrenome = $_POST['cliente-sobrenome'];
$email = $_POST['cliente-email'];
$senha = $_POST['cliente-senha'];
$celular = $_POST['cliente-celular'];
$cep = $_POST['cliente-cep'];
$rua = $_POST['cliente-rua'];
$bairro = $_POST['cliente-bairro'];
$cidade = $_POST['cliente-cidade'];
$estado = $_POST['cliente-estado'];
$numero = $_POST['cliente-numero'];
$complemento = $_POST['cliente-complemento'];
$img = './img/UsuarioOFF.png';

$cpf = str_replace(['.','-'],'',$cpfSujo);

$sql = "INSERT INTO usuario (logado,cpf,nome,sobrenome,email,
senha,celular,cep,img) 
VALUES ('$logado','$cpf','$nome','$sobrenome','$email','$senha','$celular','$cep','$img')";

$sql2 = "INSERT INTO endereco (cep,numero,rua,bairro,cidade,estado,complemento) 
VALUES ('$cep','$numero','$rua','$bairro','$cidade','$estado','$complemento')";

$sql_check = $conn->prepare("SELECT * FROM usuario WHERE cpf = ?");
$sql_check->bind_param('s', $cpf);
$sql_check->execute();
$result = $sql_check->get_result();

$sql_check2 = $conn->prepare("SELECT * FROM endereco WHERE  cep= ?");
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
