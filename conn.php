<?php

$DbHost = "44.201.115.177";
$DbUsername = "root";
$DbPassword = "rootPassword";
$DbName = "PetShop";

$conn = new mysqli($DbHost,$DbUsername,$DbPassword,$DbName);

if($conn->connect_error){
    echo "Erro ao conectar: " . $conn->connect_error;
    exit;
}

?>
