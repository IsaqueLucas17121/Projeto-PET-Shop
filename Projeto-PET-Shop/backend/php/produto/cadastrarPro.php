<?php

include "../conn.php";

session_start();

$produto = $_POST['produto'];
$descricao = $_POST['descricao'];
$preco = $_POST['preco'];
$idLoja = $_SESSION['idLoja'];
$idFuncionario = $_SESSION['vendedores']->idFuncionario;

if(isset($_FILES['imagem']) && !empty($_FILES['imagem']['name'])){
    $img = "./img/" . $_FILES['imagem']['name'];
    move_uploaded_file($_FILES['imagem']['tmp_name'] ,$img);
}
else{
    $img ="./img/imagemProdutoOFF.png";
}

$sql = "INSERT INTO produtos (nome,descricao,preco,img,idLoja,idFuncionario) VALUES 
('$produto','$descricao','$preco','$img','$idLoja','$idFuncionario')";

if($conn->query($sql)){
    echo "<script>alert('Produto Cadatrado');</script>";
    echo "<script>location.href='cadastroPro.html';</script>";
}
else{
    echo "<script>alert('Falha ao cadastrar o produto');</script>";
    header("Location: cadastroPro.html");
}