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

$sql = "INSERT INTO usuarios (logado,cpf,nome,sobrenome,email,
senha,celular,cep,img,numero,complemento) 
VALUES ('$logado','$cpf','$nome','$sobrenome','$email','$senha','$celular','$cep','$img','$numero','$complemento')";

$sql2 = "INSERT INTO enderecos (cep,rua,bairro,cidade,estado) 
VALUES ('$cep','$rua','$bairro','$cidade','$estado')";

$sql_check = $conn->prepare("SELECT * FROM usuarios WHERE cpf = ?");
$sql_check->bind_param('s', $cpf);
$sql_check->execute();
$result = $sql_check->get_result();

$sql_check2 = $conn->prepare("SELECT * FROM enderecos WHERE  cep= ?");
$sql_check2->bind_param('s', $cep);
$sql_check2->execute();
$result2 = $sql_check2->get_result();

if ($result->num_rows > 0) {
        echo "<script>alert('Usuário já existe com o CPF fornecido.');</script>";
        print "<script>location.href='../../../frontend/pages/cadastro.html';</script>";
    }
else if($result2->num_rows > 0 && $conn->query($sql) === TRUE){
        echo "<script>alert('Usuario Cadatrado');</script>";
        print "<script>location.href='../../../frontend/pages/cadastro.html';</script>";       
    }
else if($conn->query($sql2) === TRUE &&  $conn->query($sql) === TRUE ){
        echo "<script>alert('Usuario Cadatrado');</script>";
        print "<script>location.href='../../../frontend/pages/cadastro.html';</script>";
    }
else{
        echo "<script>alert('Falha ao cadastrar usuário: {$conn->error}');</script>";
        print "<script>location.href='../../../frontend/pages/cadastro.html'</script>";
    }

?>