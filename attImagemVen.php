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

$accessKey = 'ASIA4OOK5GVJWPAGKRWY';
$secretKey = 'CahtXIGSJvFNuI81YYVRRXr1M/A6JSwQdnC/xKi4';
$sessionToken = 'IQoJb3JpZ2luX2VjED4aCXVzLXdlc3QtMiJIMEYCIQCQokRcboqf2WRYGTdIbmRNiQ5d8nfcfP62G4i9HrBxWwIhAKRTStxoR2LDcRFCCVMQb+jwR6jbEAi8IVNNWWxb+cHMKqACCDcQABoMODU1NjYwOTAxNzE1Igxo9gwC30h/2r9r5BIq/QHVFoRORzGQ7lfXlQ792p6DnbxJYMR4ftGRIiZoJJSOSZWZypf0G3McZWIP8+7CebYF3M7kjSlP2cIyLFU4PUBtlaSsixNizwHRnblzfuo9Fxitlht7+3pe1VAIjTnWn5bsqh+it0KxeeIZ+RY984F0Sq/rRlqsI6x3kjF8WupnaIW2hYnQQI855FgSgNU/eU6wZxXbqjt4lIhYnz0Yy98RtM0wNsijCICOpOP1Pb9FmP5zbHGj68+HZGPB4kqQM7alqj44D3mvnzcDho0Y3Uev4Mh9fcQGgwIY6BRBEbWdbNmhNFRGfeHKEjb7H3YJjXjy7cSNvrnnBMR4pjz4MN217MIGOpwB6vE7HxnGeag97x27YjHGdyNsnL1HRvKEjpqgsROE8qLChOC4qYpzyk5e0adUQSfIvf9y69TL0LviDYnaIjk9K6qcyg6OaQZNbmAA8wSbfHL9GoqkKI67nr1CT58HhFHnqp99cejhZGSu+vWBLikY+r8XwgvuaTcoIXhf/1oiiXgx0SBJPwMRVOVtNkG+kZsWXHTYZ4Nw12M4BMRG';
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