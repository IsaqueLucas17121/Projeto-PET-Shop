<?php

include "../conn.php";

session_start();

$produto = $_POST['produto'];
$descricao = $_POST['descricao'];
$preco = $_POST['preco'];
$idLoja = $_SESSION['idLoja'];
$chave = $_SESSION['idPro'];

$buscar = "SELECT img FROM produtos WHERE idPro = $chave";
$res = $conn->query($buscar);
$row = $res->fetch_object();
$qtd = $res->num_rows;

if(isset($_FILES['imagem']) && !empty($_FILES['imagem']['name'])){
    $img = "./img/" . $_FILES['imagem']['name'];
    move_uploaded_file($_FILES['imagem']['tmp_name'] ,$img);
}
else if($qtd>0){
    $img = "$row->img";
}
else{
    $img ="./img/imagemProdutoOFF.png";
}

$sql= "UPDATE produtos SET nome='{$produto}',descricao='{$descricao}',preco='{$preco}',img='{$img}'
WHERE idPro = $chave";


if($conn->query($sql) ){
    echo "<script>alert('Produto Atualizado');</script>";
    echo "<script>location.href='../loja.php';</script>";
}
else{
    echo "<script>alert('Falha ao atualizar Produto');</script>";
    echo "<script>location.href='../loja.php';</script>";
}
