<?php

$DbHost = "localhost";
$DbUsername = "root";
$DbPassword = "";
$DbName = "PetShop";

$conn = new mysqli($DbHost,$DbUsername,$DbPassword,$DbName);

if($conn->connect_error){
    echo "Erro ao conectar: " . $conn->connect_error;
    exit;
}

?>