<?php 

include 'conn.php';

$email = $_POST['masterUsername'];
$senha = $_POST['masterPassword'];

$sql = "SELECT * FROM funcionarios WHERE funcao = 'Master' AND email = '$email' AND senha = '$senha'";

if ($conn->query($sql) == TRUE){
    $mostrar = "SELECT * FROM usuarios";

    $res = $conn->query($mostrar);
    $qtd = $res->num_rows;

    if($qtd > 0){
        $row = $res->fetch_object();
    }
}
else{
    echo "<script>alert('Email ou Senha Errados');</script>";
    print "<script>location.href='config.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabela do Banco - Nome do Site</title>

    <style>

    </style>
</head>
<body>
    <h1>Listar Usuarios</h1>

    <table>
        <tr>
            <th>Nome</th>
            <th>Sobrenome</th>
            <th>Email</th>
            <th>Senha</th>
            <th>Celular</th>
            <th>Cep</th>
            <th>Rua</th>
            <th>Bairro</th>
            <th>Cidade</th>
            <th>Estado</th>
            <th>Municipio</th>
            <th>Numero</th>
            <th>Complemento</th>
            <th><img src="" alt="icone do usuario tal"></th>
            <th>Logado/Deslogado</th>
            <th>Editar/Apagar</th>
        </tr>

        <tr>

        </tr>
    </table>
</body>
</html>