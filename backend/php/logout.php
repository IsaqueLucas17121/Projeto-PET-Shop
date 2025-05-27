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
else{
    header("Location: ../../frontend/pages/index.html");
}