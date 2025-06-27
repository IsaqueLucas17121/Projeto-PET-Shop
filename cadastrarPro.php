<?php

include "conn.php";

session_start();

$produto = $_POST['produto'];
$descricao = $_POST['descricao'];
$preco = $_POST['preco'];
$tipoPet = $_POST['tipoPet'];
$idLoja = $_SESSION['idLoja'];
$marca = $_POST['marca'];
$idFuncionario = $_SESSION['vendedores']->idFuncionario;

if(isset($_FILES['imagem']) && !empty($_FILES['imagem']['name'])){
    $img = "backend/php/produto/img/" . $_FILES['imagem']['name'];
    move_uploaded_file($_FILES['imagem']['tmp_name'] ,$img);
}
else{
    $img ="backend/php/produto/img/imagemProdutoOFF.png";
}

$sql = "INSERT INTO produtos (nome,descricao,preco,img,idLoja,idFuncionario,tipo,marca) VALUES 
('$produto','$descricao','$preco','$img','$idLoja','$idFuncionario','$tipoPet','$marca')";

if($conn->query($sql)){
    echo "<script>alert('Produto Cadatrado');</script>";
    header("Location: cadastroPro.php");
}
else{
    echo "<script>alert('Falha ao cadastrar o produto');</script>";
    header("Location: cadastroPro.php");
}