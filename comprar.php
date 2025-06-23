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

    <header>
    <div class="logo">
        <img src="../../frontend/src/assets/Foto site.png" alt="Logo PetShop"> <!-- Substitua pelo caminho da sua logo -->
        <h1>PetShop Amor & Cuidado</h1>
    </div>

    <nav>
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="backend/php/lojaUsu.php">Loja</a></li>
            <li><a onclick="MostrarSer()" style="cursor: pointer;">Serviços</a></li>
            <div class="desligado" id="MostrarSer">
              <li><a href="frontend/pages/AgendarPet.php">Banho/Tosa</a></li>
              <li><a href="#">Creche</a></li>
            </div>
            <li><a href="#">Contato</a></li>
        </ul>
    </nav>

    <a style="<?php if($ligado == TRUE){ echo "display: none;";} else{ echo "display: block;";} ?>" href="../../frontend/pages/cadastro.html" class="btn-login">Login / Cadastro</a>
    <a href="config.php" style="<?php if($ligado == TRUE){ echo "display: block;";} else{ echo "display: none;";} ?>">
        <div class="icone">
        <img  src="<?php echo 'usuario' . $row->img?>" alt="Imagem do usuario">
        <h4 >  Configurações</h4>
        </div>
    </a>

</header>


    <footer>
  <div class="footer-section">
    <div class="column">
      <h3>Políticas</h3>
      <button onclick="openModal('Política de Privacidade', 'privacidade')">Política de Privacidade</button>
      <button onclick="openModal('Política de Cookies', 'cookies')">Política de Cookies</button>
      <button onclick="openModal('Política de Compras', 'compras')">Política de Compras</button>
      <button onclick="openModal('Política de Entregas', 'entregas')">Política de Entregas</button>
    </div>

    <div class="column">
      <h3>Suporte</h3>
      <button onclick="openModal('Central de Atendimento', 'atendimento')">Central de Atendimento</button>
      <button onclick="openModal('WhatsApp', 'whatsapp')">WhatsApp</button>
    </div>

    <div class="column">
      <h3>Categorias</h3>
      <button onclick="openModal('Ração', 'racao')">Ração</button>
      <button onclick="openModal('Marcas', 'marcas')">Marcas</button>
      <button onclick="openModal('Utensílios', 'utensilios')">Utensílios</button>
      <button onclick="openModal('Planos de Saúde Pet', 'planos')">Planos de Saúde Pet</button>
    </div>

    <div class="column">
      <h3>Ofertas em Destaque</h3>
      <button onclick="openModal('Antipulgas e Carrapatos', 'antipulgas')">Antipulgas e Carrapatos</button>
      <button onclick="openModal('Medicamentos', 'medicamentos')">Medicamentos</button>
      <button onclick="openModal('Antibióticos', 'antibioticos')">Antibióticos</button>
    </div>
  </div>
</footer>

<div id="modal" class="modal" role="dialog" aria-labelledby="modal-title" aria-modal="true" tabindex="-1">
  <div class="modal-content">
    <button class="close-btn" onclick="closeModal()" aria-label="Fechar modal">×</button>
    <h2 id="modal-title"></h2>
    <p id="modal-text"></p>
  </div>
</div>

      <!-- VLibras Widget -->
  <div vw class="enabled">
      <div vw-access-button class="active"></div>
      <div vw-plugin-wrapper>
          <div class="vw-plugin-top-wrapper"></div>
      </div>
  </div>
  <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
  <script>
      new window.VLibras.Widget('https://vlibras.gov.br/app');
  </script>
  <!-- Fim VLibras Widget -->

<div class="botao_acessibilidade" onclick="abrir_acessibilidade(1)">
    <i class="bi bi-universal-access"></i>
</div>

<div class="botao_visualizacao desligado" id="botao_acesso" onclick="abrir_acessibilidade(2)">
    <i class="bi bi-eye"></i>
</div>

<div class="botao_visualizacao desligado" id="botao_tema" onclick="toggleTheme()">
    <i class="bi bi-moon"></i>
</div>

<div class="botoes_acessibilidade desligado" id="acessibilidade2" onclick="mudar_fonte(1)">
    <i class="bi bi-plus-lg"></i>
    <span>Aumentar Fonte</span>
</div>

<div class="botoes_acessibilidade desligado" id="acessibilidade3" onclick="mudar_fonte(2)">
    <i class="bi bi-dash-lg"></i>
    <span>Diminuir Fonte</span>
</div>
</body>
</html>