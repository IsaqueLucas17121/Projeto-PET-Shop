<?php

include 'conn.php';

session_start();

$email = $conn->real_escape_string($_POST['confirm_email']);
$senha = $conn->real_escape_string($_POST['confirm_senha']);

// Verifica usuário comum
$sqlUsuario = "SELECT cpf FROM usuarios WHERE email = '$email' AND senha = '$senha'";
$resUsuario = $conn->query($sqlUsuario);

// Verifica funcionário
$sqlFuncionario = "SELECT idFuncionario FROM funcionarios WHERE email = '$email' AND senha = '$senha'";
$resFuncionario = $conn->query($sqlFuncionario);

session_start();

if ($resUsuario && $resUsuario->num_rows > 0) {

    $cpf = $resUsuario->fetch_object();
    $_SESSION['usuarios'] = $cpf;

    $conn->query("UPDATE usuarios SET logado = '1' WHERE email = '$email' AND senha = '$senha'");


    echo "<script>alert('Logado como Usuário');</script>";
    echo "<script>location.href='index.php';</script>";
}
else if ($resFuncionario && $resFuncionario->num_rows > 0) {

    $idFuncionario = $resFuncionario->fetch_object();
    $_SESSION['vendedores'] = $idFuncionario;

    $conn->query("UPDATE funcionarios SET logado = '1' WHERE email = '$email' AND senha = '$senha'");

    echo "<script>alert('Logado como Funcionário');</script>";
    echo "<script>location.href='index.php';</script>";
}
else {
    echo "<script>alert('Erro ao logar');</script>";
    echo "<script>location.href='../../../frontend/pages/index.html';</script>";
}

?>
