<?php

include '../conn.php';
session_start();

$chave = $_SESSION['vendedores']->idFuncionario;

$busca = "SELECT * FROM funcionarios WHERE idFuncionario = '$chave'";
$res = $conn->query($busca);
$row = $res->fetch_object();

$chave2 = $row->cep;

$nome = $_POST['vendedor-nome'];
$sobrenome = $_POST['vendedor-sobrenome'];
$email = $_POST['vendedor-email'];
$senha = $_POST['vendedor-senha'];
$telefoneSujo = $_POST['vendedor-telefone'];
$cep = $_POST['vendedor-cep'];
$rua = $_POST['vendedor-rua'];
$bairro = $_POST['vendedor-bairro'];
$cidade = $_POST['vendedor-cidade'];
$estado = $_POST['vendedor-estado'];
$numero = $_POST['vendedor-numero'];
$complemento = $_POST['vendedor-complemento'];

$telefone = str_replace(['(',')',' ','-'],'',$telefoneSujo);

$sql = "UPDATE funcionarios SET nome='{$nome}',sobrenome='{$sobrenome}',email='{$email}',
senha='{$senha}',telefone='{$telefone}',numero='{$numero}',complemento='{$complemento}',cep='{$cep}'

WHERE idFuncionario='$chave'";

$sql2 = "INSERT INTO enderecos (cep,rua,bairro,cidade,estado) 
VALUES ('$cep','$rua','$bairro','$cidade','$estado')";

$sql_check2 = $conn->prepare("SELECT * FROM enderecos WHERE  cep= ?");
$sql_check2->bind_param('s', $cep);
$sql_check2->execute();
$result2 = $sql_check2->get_result();


if($conn->query($sql2) === TRUE &&  $conn->query($sql) === TRUE ){
    echo "<script>alert('Vendedor Editado');</script>";
    print "<script>location.href='../index.php';</script>";
}
else if($result2->num_rows > 0 && $conn->query($sql) === TRUE){       
    echo "<script>alert('Vendedor Editado');</script>";
    print "<script>location.href='../index.php';</script>";
}
else{
    echo "<script>alert('Falaha ao Editar Vendedor: {$conn->error}');</script>";
    print "<script>location.href='../atualizar.php'</script>";
};

