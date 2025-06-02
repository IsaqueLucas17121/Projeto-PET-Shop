<?php

include '../conn.php';

$logado = '0';
$cnpjSujo = $_POST['vendedor-cnpj'];
$nome = $_POST['vendedor-nome'];
$sobrenome = $_POST['vendedor-sobrenome'];
$email = $_POST['vendedor-email'];
$senha = $_POST['vendedor-senha'];
$telefone = $_POST['vendedor-telefone'];
$cep = $_POST['vendedor-cep'];
$rua = $_POST['vendedor-rua'];
$bairro = $_POST['vendedor-bairro'];
$cidade = $_POST['vendedor-cidade'];
$estado = $_POST['vendedor-estado'];
$numero = $_POST['vendedor-numero'];
$complemento = $_POST['vendedor-complemento'];
$img = './img/UsuarioOFF.png';

$cnpj = str_replace(['.','-','/'],'',$cnpjSujo);

$sql = "INSERT INTO funcionarios (idFuncionario,logado,nome,sobrenome,email,senha,telefone,cep,numero,complemento,img) 
VALUES ('$cnpj','$logado','$nome','$sobrenome','$email','$senha','$telefone','$cep','$numero','$complemento','$img')";

$sql2 = "INSERT INTO enderecos (cep,rua,bairro,cidade,estado) 
VALUES ('$cep','$rua','$bairro','$cidade','$estado')";

$sql_check = $conn->prepare("SELECT * FROM funcionarios WHERE idFuncionario = ?");
$sql_check->bind_param('s', $cnpj);
$sql_check->execute();
$result = $sql_check->get_result();

$sql_check2 = $conn->prepare("SELECT * FROM enderecos WHERE  cep= ?");
$sql_check2->bind_param('s', $cep);
$sql_check2->execute();
$result2 = $sql_check2->get_result();

if ($result->num_rows > 0) {
        echo "<script>alert('Vendedor já existe com o CNPJ fornecido.');</script>";
        print "<script>location.href='../../../frontend/pages/cadastro.html';</script>";
    }
else if($result2->num_rows > 0 && $conn->query($sql) === TRUE){
        echo "<script>alert('Vendedor Cadatrado');</script>";
        print "<script>location.href='../../../frontend/pages/cadastro.html';</script>";
    }
else if($conn->query($sql2) === TRUE &&  $conn->query($sql) === TRUE ){
        echo "<script>alert('Vendedor Cadatrado');</script>";
        print "<script>location.href='../../../frontend/pages/cadastro.html';</script>";
    }
else{
        echo "<script>alert('Falha ao cadastrar vendedor: {$conn->error}');</script>";
        print "<script>location.href='../../../frontend/pages/cadastro.html'</script>";
    }
