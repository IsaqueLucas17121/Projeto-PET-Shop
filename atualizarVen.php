<?php
include 'conn.php';

session_start();

$chave = null;

if (isset($_REQUEST['idFuncionario'])) {
    $chave = intval($_REQUEST['idFuncionario']);
    session_write_close();
} elseif (isset($_SESSION['vendedores'])) {
    $chave = $_SESSION['vendedores']->idFuncionario;
}




// Dados do formulário
$nome = $_POST['vendedor-nome'];
$sobrenome = $_POST['vendedor-sobrenome'];
$email = $_POST['vendedor-email'];
$senha = $_POST['vendedor-senha'];
$telefoneSujo = $_POST['vendedor-telefone'];
$cep = $_POST['vendedor-cep'];
$rua = $_POST['vendedor-rua'];
$bairro = $_POST['vendedor-bairro'];
$cidade = $_POST['vendedor-cidade'];
$estado = $_POST['vendedor-estado'];
$numero = $_POST['vendedor-numero'];
$complemento = $_POST['vendedor-complemento'];

$telefone = str_replace(['(',')',' ','-'],'',$telefoneSujo);

// Verificar se o CEP já existe na tabela de endereços
$sql_check2 = $conn->prepare("SELECT * FROM enderecos WHERE cep = ?");
$sql_check2->bind_param('s', $cep);
$sql_check2->execute();
$result2 = $sql_check2->get_result();

// Se o endereço não existir, insere
if ($result2->num_rows == 0) {
    $sql2 = $conn->prepare("INSERT INTO enderecos (cep, rua, bairro, cidade, estado) VALUES (?, ?, ?, ?, ?)");
    $sql2->bind_param('sssss', $cep, $rua, $bairro, $cidade, $estado);
    if (!$sql2->execute()) {
        echo "<script>alert('Falha ao inserir endereço: {$conn->error}');</script>";
        echo "<script>location.href='atualizar.php';</script>";
        exit;
    }
}

// Atualizar dados do funcionário
$sql = $conn->prepare("UPDATE funcionarios SET nome=?, sobrenome=?, email=?, senha=?, telefone=?, numero=?, complemento=?, cep=? WHERE idFuncionario=?");
$sql->bind_param('ssssssssi', $nome, $sobrenome, $email, $senha, $telefone, $numero, $complemento, $cep, $chave);

if ($sql->execute()) {
    echo "<script>alert('Vendedor Editado com sucesso');</script>";
    echo "<script>location.href='index.php';</script>";
} else {
    echo "<script>alert('Falha ao editar vendedor: {$conn->error}');</script>";
    echo "<script>location.href='atualizar.php';</script>";
}
?>
