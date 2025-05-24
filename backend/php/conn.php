<?php

$DbHost = "localhost";
$DbUsername = "root";
$DbPassword = "";
$DbName = "ppp";

$conn = new mysqli($DbHost,$DbUsername,$DbPassword,$DbName);

if($conn -> connect_error){
    echo "Erro ao conectar" . $connect->conn_error;
};

?>