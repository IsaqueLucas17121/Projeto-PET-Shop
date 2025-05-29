<?php

include "conn.php";

session_start();

if(isset($_SESSION['usuarios'])){
    $chave = $_SESSION['usuarios']->cpf;

    $sql = "UPDATE usuarios SET logado = '0' WHERE cpf = '$chave'";

    $res = $conn->query($sql);

    unset($_SESSION['usuarios']);

    header("Location: ../../frontend/pages/index.html");
}
else if(isset($_SESSION['vendedores'])){
    $chave = $_SESSION['vendedores']->idFuncionario;

    $sql = "UPDATE funcionarios SET logado = '0' WHERE idFuncionario = '$chave'";

    $res = $conn->query($sql);

    unset($_SESSION['vendedores']);

    header("Location: ../../frontend/pages/index.html");
}
else{
    echo "<script>alert('falaha ao deslogar: {$conn->error}');</script>";
    header("Location: index.php");
}