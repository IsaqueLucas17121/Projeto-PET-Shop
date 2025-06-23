<?php

$DbHost = "54.197.80.137";
$DbUsername = "root";
$DbPassword = "rootPassword";
$DbName = "PetShop";

$conn = new mysqli($DbHost,$DbUsername,$DbPassword,$DbName);

if($conn->connect_error){
    echo "Erro ao conectar: " . $conn->connect_error;
    exit;
}

?>