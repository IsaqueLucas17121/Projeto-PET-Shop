<?php

include "../conn.php";

session_start();
$chave = $_SESSION['idPro'];

$sql = "DELETE FROM produtos WHERE idPro = $chave";
$sql2 = "SELECT * FROM produtos WHERE idPro = $chave";
$res = $conn->query($sql2);
$row = $res->fetch_object();

$img = $row->img;

$protegidos = './img/imagemProdutoOFF.png';

if ($img !== $protegidos && file_exists($img)) {
    unlink($img); // Só apaga se não for protegido
}


if($conn->query($sql)){
    echo "<script>alert('Produto Deletado');</script>";
    echo "<script>location.href='../loja.php';</script>";
    unset($_SESSION['idPro']);
}
else{
    echo "<script>alert('Falha ao deletar produto');</script>";
    echo "<script>location.href='../loja.php';</script>";
}