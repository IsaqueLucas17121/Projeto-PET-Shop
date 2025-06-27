<?php

    include "conn.php";
    session_start();

    if (!isset($_SESSION['usuarios'])) {
        die("Acesso negado.");
    }

    if (isset($_POST['dias'])) {
        $diasSelecionados = $_POST['dias']; // array de dias: [3, 15, 22]

        $ano = date('Y');
        $mes = date('m');

        foreach ($diasSelecionados as $dia) {
            $dataCompleta = "$ano-$mes-" . str_pad($dia, 2, '0', STR_PAD_LEFT); // ex: 2025-06-03

            // Agora insira essa $dataCompleta no banco
            // Exemplo com PDO:
            $stmt = $pdo->prepare("INSERT INTO pets (consulta) VALUES (:data)");
            $stmt->execute(['data' => $dataCompleta]);
        }
    }



?>