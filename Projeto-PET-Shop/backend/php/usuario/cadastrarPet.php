<?php
include "../conn.php";
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['usuarios'])) {
    die("Acesso negado.");
}

$idUsuario = $_SESSION['usuarios']->cpf;

// Verifica se os dados foram enviados
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Nome e idade
    $nomePet = $_POST['nomePet'] ?? '';
    $idadePet = $_POST['idadePet'] ?? '';
    $tipoPet = '';
    $racaPet = '';

    // Identifica o tipo do pet com base nos selects
    if (isset($_POST['racaCachorro'])) {
        $tipoPet = 'Cachorro';
        $racaPet = $_POST['racaCachorro'];
    } elseif (isset($_POST['racaGato'])) {
        $tipoPet = 'Gato';
        $racaPet = $_POST['racaGato'];
    } elseif (isset($_POST['racaAve'])) {
        $tipoPet = 'Pássaro';
        $racaPet = $_POST['racaAve'];
    } elseif (isset($_POST['racaReptil'])) {
        $tipoPet = 'Réptil';
        $racaPet = $_POST['racaReptil'];
    }

    // Validação básica
    if (strlen($nomePet) < 3 || !is_numeric($idadePet)) {
        die("Dados inválidos.");
    }

    try {
        // Insere no banco
        $stmt = $conn->prepare("INSERT INTO pets (idUsuario, nome, idade, tipo, raca) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$idUsuario, $nomePet, $idadePet, $tipoPet, $racaPet]);

        // Redireciona ou exibe sucesso
        echo "<script>alert('Pet cadastrado com sucesso');</script>";
        echo "<script>location.href='../index.php';</script>";
        // header("Location: sucesso.php");
        // exit();

    } catch (PDOException $e) {
        die("Erro ao cadastrar pet: " . $e->getMessage());
        echo "<script>location.href='../../../frontend/pages/cadastrarPet.php';</script>";
    }
} else {
    die("Método não permitido.");
}
?>
