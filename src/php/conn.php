<?php

$dbHost = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "PetShop";

$conn = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);

if($conn->connect_erro){
    echo "Erro ao conectar" . $conn->connerct_erro;
}

?>