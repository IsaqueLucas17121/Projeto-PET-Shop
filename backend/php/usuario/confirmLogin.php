<?php

include '../conn.php';

$email = $conn->real_escape_string($_POST['confirm_email']);
$senha = $conn->real_escape_string($_POST['confirm_senha']);

$sql1 = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
$sql2 = "SELECT cpf FROM usuarios WHERE email = '$email' AND senha = '$senha'";

if( isset($sql1) == TRUE && isset($sql2)){
    $res1 = $conn->query($sql1);
    $res2 = $conn->query($sql2);

    $qtd = $res1->num_rows;
    $cpf = $res2->fetch_object();
}


if( $qtd > 0 ){
    session_start();

    $_SESSION['usuarios'] = $cpf;

    $sql1 = "UPDATE usuarios SET logado = '1' WHERE email= '$email' AND senha = '$senha'";
    $conn->query($sql1);

    echo "<script>alert('Logado');</script>";
    print "<script>location.href='../index.php';</script>";

}
else{
    echo "<script>alert('Erro ao logar');</script>";
    print "<script>location.href='../../../frontend/pages/index.html';</script>";
}

?>