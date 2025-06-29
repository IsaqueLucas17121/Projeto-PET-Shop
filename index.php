<?php

include 'conn.php';

session_start();

if( !isset($_SESSION['usuarios']) && !isset($_SESSION['vendedores'])){
  print "<script>location.href='index.html';</script>";
}

if(isset($_SESSION['usuarios'])){
  $chave = $_SESSION['usuarios']->cpf;

  $sql = "SELECT * FROM usuarios WHERE cpf = '$chave'";

  $loja = "lojaUsu.php";

  $res = $conn->query($sql);
  $row = $res->fetch_object();
}
else if(isset($_SESSION['vendedores'])){

  $chave = $_SESSION['vendedores']->idFuncionario;

  $sql = "SELECT * FROM funcionarios WHERE idFuncionario = '$chave'";

  $loja = "loja.php";

  $res = $conn->query($sql);
  $row = $res->fetch_object();

  $vendedor = TRUE;
}


?>

<!DOCTYPE html>
<html lang="pr-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página inicial - Nome da loja</title>
    <link rel="stylesheet" href="frontend/src/css/style.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- BOOTSTRAP ICONS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- FIM BOOTSTRAP ICONS -->

    <link rel="shortcut icon" href="frontend/src/assets/Foto site.png" type="image/x-icon">

    <script src="frontend/src/js/script.js" defer></script>

</head>
<body>

<header>
    <div class="logo">
        <img src="frontend/src/assets/Foto site.png" alt="Logo PetShop">
        <h1>PetShop Amor & Cuidado</h1>
    </div>

    <!-- Botão do menu mobile -->
    <button class="menu-toggle" id="menu-toggle" aria-label="Abrir menu">
        <span class="hamburger-line"></span>
        <span class="hamburger-line"></span>
        <span class="hamburger-line"></span>
    </button>

    <nav class="nav-menu" id="nav-menu">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="<?php echo $loja?>">Loja</a></li>
            <li style="display: none; <?php if($vendedor == TRUE){echo 'display: block;';}?>"><a href="cadastroPro.php">Produto</a></li>
            <li class="dropdown">
                <a href="#" onclick="toggleDropdown()" style="<?php if($vendedor == TRUE){echo 'display: none;';}?> cursor: pointer;">Serviços</a>
                <div class="dropdown-content" id="dropdown-servicos">
                    <a href="AgendarPet.php">Banho/Tosa</a>
                    <a href="#">Creche</a>
                </div>
            </li>
            <li><a href="#">Contato</a></li>
        </ul>
    </nav>

    <a href="config.php">
        <div class="icone">
        <img src="<?php echo $row->img?>" alt="Imagem do usuario">
        <h1>  Configurações</h1>
        </div>
    </a>
    
</header>


<div class="primeira_box">
    <div class="slide-container">
        <div class="slide active" id="slide1">
            <div class="slide-content">
                <h2>VAI VIAJAR</h2>
                <span>E PRECISA DE UM LUGAR PARA</span>
                <h1>DEIXAR O SEU PET?</h1>
                <button class="slide-btn">Clique Aqui</button>
            </div>
        </div>
        <div class="slide" id="slide2">
            <div class="slide-content">
                <h2>BANHO E TOSA</h2>
                <span>PARA SEU PET FICAR <span class="destaque_roll">CHEIROSO</span> E <span id="destaque_roll" class="destaque_roll">LIMPINHO</span></span>
                <h1 id="descri">AGENDE AGORA</h1>
                <a href="AgendarPet.php"><button id="botao2" class="slide-btn">Clique Aqui</button></a>
            </div>
        </div>
    </div>
</div>

    <div class="segunda_box">
      <div class="card_segunda_box" id="segunda_box1">
        <img src="https://premierpet.com.br/wp-content/uploads/2022/07/Golded-Gourmet-logo-cor-01-e1657028143101-1024x411.png" alt="Logo da marca Gloden">
      </div>
      <div class="card_segunda_box" id="segunda_box2">
        <img src="frontend/src/assets/raçao de peixe.jpg" alt="Logo da marca Pedigree">
      </div>
      <div class="card_segunda_box" id="segunda_box3">
        <img src="https://logodownload.org/wp-content/uploads/2017/04/whiskas-logo.png" alt="Logo da marca Whiskas">
      </div>

    </div>

    <div class="quarta_box">
      <div class="card_quarta_box">
        <h1>Destaques Para Gatos</h1>
        <div class="margem_quarta_box">
          <h2>Caixa de Areia e Limpeza</h2>
          <img src="https://images.vexels.com/media/users/3/316989/isolated/preview/c9e082462f5eafbca1459251d7efa471-material-de-limpeza-icone-plano.png" alt="Areia Para Gatos">
        </div>
        <div class="margem_quarta_box">
          <h2>Ração para Gato</h2>
          <img src="frontend/src/assets/comida gato.png" alt="Comida Para Gatos">
        </div>
        <div class="margem_quarta_box">
          <h2>Medicina e Saúde</h2>
          <img src="https://cdn-icons-png.flaticon.com/512/1546/1546155.png" alt="Medicamentos Para Gatos">
        </div>
        <div class="margem_quarta_box">
          <h2>Acessórios de Alimentação</h2>
          <img src="https://www.pngplay.com/wp-content/uploads/6/Dog-Food-Logo-Transparent-PNG.png" alt="Acessorios de alimentação Para Gatos">
        </div>
      </div>
      <div class="card_quarta_box">
        <h1>Destaques Para Cachorros</h1>
        <div class="margem_quarta_box">
          <h2>Higiene e Limpeza</h2>
          <img src="https://images.vexels.com/media/users/3/316989/isolated/preview/c9e082462f5eafbca1459251d7efa471-material-de-limpeza-icone-plano.png" alt="Areia Para Gatos">
        </div>
        <div class="margem_quarta_box">
          <h2>Ração para Cachorro</h2>
          <img src="frontend/src/assets/comida cachorro.png" alt="Comida Para Gatos">
        </div>
        <div class="margem_quarta_box">
          <h2>Medicina e Saúde</h2>
          <img src="https://cdn-icons-png.flaticon.com/512/1546/1546155.png" alt="Medicamentos Para Gatos">
        </div>
        <div class="margem_quarta_box">
          <h2>Acessórios de Alimentação</h2>
          <img src="https://www.pngplay.com/wp-content/uploads/6/Dog-Food-Logo-Transparent-PNG.png" alt="Acessorios de alimentação Para Gatos">
        </div>
      </div>
    </div>

    <div class="terceira_box">
        <div class="card_terceira_box">
          <i class="bi bi-cart2"></i>
          <span>Loja</span>
        </div>
        <div class="card_terceira_box">
          <i class="bi bi-truck"></i>
          <span>Entrega</span>
        </div>
        <div class="card_terceira_box">
          <i class="bi bi-ticket"></i>
          <span>Cupons</span>
        </div>
        <div class="card_terceira_box">
          <i class="bi bi-droplet"></i>
          <span>Banho/Tosa</span>
        </div>
        <div class="card_terceira_box">
          <i class="bi bi-house-heart"></i>
          <span>Creche</span>
        </div>
    </div>

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

    <script>
  document.addEventListener("DOMContentLoaded", () => {
    let contadorimg = 1;

    function slidePGI() {
      const imagem1 = document.getElementById("roll1");
      const imagem2 = document.getElementById("roll2");

      contadorimg++;

      if (contadorimg > 2) {
        contadorimg = 1;
      }

      if (contadorimg === 1) {
        imagem1.style.display = "flex";
        imagem2.style.display = "none";
      } else {
        imagem1.style.display = "none";
        imagem2.style.display = "flex";
      }
    }

    // Inicia com a primeira visível
    document.getElementById("roll1").style.display = "flex";
    document.getElementById("roll2").style.display = "none";

    // Roda a cada 7 segundos
    setInterval(slidePGI, 7000);
  });
</script>

</body>
</html>