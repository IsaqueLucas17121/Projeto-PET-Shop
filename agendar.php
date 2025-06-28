<?php

    include "conn.php";
    session_start();

    if (!isset($_SESSION['usuarios'])) {
        die("Acesso negado.");   
        echo "<script>location.href='index.html';</script>";
    }

    $nomePet = $_POST['petCadastro'];
    $data = $_POST['dataSelecionada'];
    $chave = $_SESSION['usuarios']->cpf;
    

    $sql = "UPDATE pets SET consulta = '$data' WHERE idUsuario = $chave AND nome = '$nomePet'";
    
    if($conn->query($sql)){
        echo "<script>alert('Agendamento Realizado Com Sucesso');</script>";
        print "<script>location.href='index.php';</script>";
    }
    else{
        echo "<script>alert('Erro ao Agendar');</script>";
        print "<script>location.href='AgendarPet.php';</script>";
    }


?>