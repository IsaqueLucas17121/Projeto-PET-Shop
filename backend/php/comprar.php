<?php

include "conn.php";

session_start();


$sql = "SELECT * FROM produtos WHERE idPro=".$_REQUEST['idPro'];
$res = $conn->query($sql);
$row = $res->fetch_object();


$chave = $_SESSION['usuarios']->cpf;

$sql2 = "SELECT img FROM usuarios WHERE cpf = '$chave'";

  $res2 = $conn->query($sql2);
  $row2 = $res2->fetch_object();

?>


<!DOCTYPE html>
<html lang="br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $row->nome?> - Nome da Loja</title>

    <link rel="stylesheet" href="../../frontend/src/css/style.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- BOOTSTRAP ICONS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- FIM BOOTSTRAP ICONS -->

    <link rel="shortcut icon" href="../../frontend/src/assets/Foto site.png" type="image/x-icon">

    <script src="../../frontend/src/js/script.js" defer></script>

</head>
<body>

    <header class="cabecario" id="cabecario">
        <a href="index.php"><img src="../../frontend/src/assets/Foto site.png" alt="Imagem do site"></a>
        <span><a href="<?php echo $loja?>"><i class="bi bi-cart"></i>  Loja</a></span>
        <span><a href="../../frontend/pages/AgendarPet.php"><i class="bi bi-droplet"></i>  Banho/Tosa</a></span>
        <span><a href="cadastroCre.php"><i class="bi bi-house-heart"></i>  Creche</a></span>
        <a href="config.php">
        <div class="icone" style="cursor: pointer; display:grid; justify-content:center; justify-items:center;">
            <img style="width: 60px; height: 60px; border-radius: 50%;" src="<?php echo "usuario" . $row2->img?>" alt="Imagem do usuario">
            <h4 style="font-size: 20px;">  Configurações</h4>
        </div>
        </a>
    
    </header>


    
</body>
</html>