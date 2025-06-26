<?php

include 'conn.php';

session_start();

$chave = $_SESSION['vendedores']->idFuncionario;

require 'vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\Exception\AwsException;

// Configurações da AWS (credenciais temporárias)
$bucket = 'awspetshop';
$region = 'us-east-1';

$accessKey = '';
$secretKey = '';
$sessionToken = '';
// Criação do cliente S3
$s3 = new S3Client([
    'version'     => 'latest',
    'region'      => $region,
    'credentials' => [
        'key'    => $accessKey,
        'secret' => $secretKey,
        'token'  => $sessionToken,
    ],
]);

// Verifica se foi enviado um arquivo
if (isset($_FILES['icone']) && !empty($_FILES['icone']['tmp_name'])) {
    $nomeArquivo = basename($_FILES['icone']['name']);
    $caminhoTemp = $_FILES['icone']['tmp_name'];
    $caminhoS3 = 'vendedor/' . uniqid() . '-' . $nomeArquivo;

    try {
        // Envio para o S3
        $resultado = $s3->putObject([
            'Bucket'     => $bucket,
            'Key'        => $caminhoS3,
            'SourceFile' => $caminhoTemp,

        ]);

        // URL pública da imagem
        $img = $resultado['ObjectURL'];
    } catch (AwsException $e) {
        echo "Erro ao enviar para o S3: " . $e->getMessage();
        $img = "/img/UsuarioOFF.png";
    }
} else {
    $img = "/img/UsuarioOFF.png";
}

// Exemplo: atualizar no banco de dados

$sql = "UPDATE funcionarios SET img='{$img}' WHERE cpf ='$chave'";

if($conn->query($sql) == TRUE){
 echo "Imagem Trocada";
 echo "<script>location.href='index.php';</script>";
}