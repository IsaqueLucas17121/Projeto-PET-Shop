<?php

include "conn.php";

session_start();

$sql = "DELETE FROM pets WHERE idUsuario =" .$_REQUEST['cpf'];
$sql2 = "DELETE FROM usuarios WHERE cpf =" .$_REQUEST['cpf'];

if($conn->query($sql) && $conn->query($sql2) ){
    echo "<script>alert('Usuario Deletado');</script>";
    echo "<script>location.href='config.php';</script>";
}
else{
    echo "<script>alert('Falha ao Deletar Usuario');</script>";
    echo "<script>location.href='config.php';</script>";
}