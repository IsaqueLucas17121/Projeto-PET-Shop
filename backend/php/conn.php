<?php

include_once '../config.php';

$DbHost = $DbHost;
$DbUsername = $DbUsername;
$DbPassword = $DbPassword;
$DbName = $DbName;

$conn = new mysqli($DbHost,$DbUsername,$DbPassword,$DbName);

if($conn -> connect_error){
    echo "Erro ao conectar" . $connect->conn_error;
};

?>