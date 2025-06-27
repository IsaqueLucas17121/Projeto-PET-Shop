<?php

include 'conn.php';

$sql = "DELETE FROM produtos WHERE idFuncionario=" .$_REQUEST["idFuncionario"];
$sql2 = "DELETE FROM lojas WHERE idFuncionario=" .$_REQUEST["idFuncionario"];
$sql3 = "DELETE FROM funcionarios WHERE idFuncionario=" .$_REQUEST["idFuncionario"];

if($conn->query($sql) && $conn->query($sql2) && $conn->query($sql3)){
    echo "<script>alert('Vendedor Deletado');</script>";
    print "<script>location.href='config.php';</script>";
}
else{
    echo "<script>alert('Falaha ao Deletar Vendedor{$conn->error}');</script>";
    print "<script>location.href='config.php'</script>";
}