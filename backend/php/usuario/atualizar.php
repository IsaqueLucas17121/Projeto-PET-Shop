<?php

include '../conn.php';
session_start();

$chave = $_SESSION['usuario']->cpf;

$busca = "SELECT * FROM usuario WHERE cpf = '$chave'";
$res = $conn->query($busca);
$row = $res->fetch_object();

$chave2 = $row->cep;

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

$sql = "UPDATE usuario SET nome='{$nome}',sobrenome='{$sobrenome}',email='{$email}',
senha='{$senha}',celular='{$celular}' 

WHERE cpf='$chave'";

$sql2 = "UPDATE endereco SET rua='{$rua}',bairro='{$bairro}',
cidade='{$cidade}',estado='{$estado}',numero='{$numero}',complemento='{$complemento}'

WHERE cep = '$chave2'";

if($conn->query($sql2) == TRUE){
        if($conn->query($sql) == TRUE){
        echo "<script>alert('Usuario Editado');</script>";
        print "<script>location.href='../index.php';</script>";
    }
}
else{
    echo "<script>alert('falaha ao editar usuario: {$conn->error}');</script>";
    print "<script>location.href='configUsu.php'</script>";
};

?>