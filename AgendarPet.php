<?php

include "conn.php";

session_start();
$local = "index.html";
$ligado = FALSE;
$agendar = "frontend/pages/cadastro.html";

if(isset($_SESSION['usuarios'])){
    $local = "index.php";
    $chave = $_SESSION['usuarios']->cpf;
    $sql = "SELECT * FROM usuarios WHERE cpf = '$chave'";
    $res = $conn->query($sql);
    $row = $res->fetch_object();
    $ligado = TRUE;
    $agendar = "agendar.php";

}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendar Pet - Nome do site</title>
    <link rel="stylesheet" href="frontend/src/css/agendarPet.css">
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

    <style>

      .radioSelecionar{
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
      }

      /* Centralizar o calendário na tela */
      .calendario-container {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 30px;
      }

      /* Aumentar o tamanho geral do calendário */
      .flatpickr-calendar {
        font-size: 18px !important;
        width: 450px !important;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
      }

      /* Estilo dos quadrados dos dias */
      .flatpickr-day {
        width: 50px !important;
        height: 50px !important;
        line-height: 50px !important;
        font-size: 18px !important;
        border-radius: 6px;
      }

      /* Cabeçalho (mês/ano) */
      .flatpickr-months {
        font-size: 15px;
      }

      /* Botões de navegação */
      .flatpickr-prev-month,
      .flatpickr-next-month {
        font-size: 22px;
      }

      .flatpickr-days{
        justify-content: center;
        width: 100%;
      }
      .flatpickr-innerContainer{
        justify-content: center;
      }
      .dayContainer{
        justify-content: space-between
      }

      /* Responsivo para mobile */
      @media (max-width: 600px) {
        .flatpickr-calendar {
          width: 100% !important;
          font-size: 22px !important;
        }

        .flatpickr-day {
          width: 48px !important;
          height: 48px !important;
          font-size: 18px !important;
        }
      }

    </style>
</head>
<body>

<header>
    <div class="logo">
        <img src="frontend/src/assets/Foto site.png" alt="Logo PetShop"> <!-- Substitua pelo caminho da sua logo -->
        <h1>PetShop Amor & Cuidado</h1>
    </div>

    <button class="menu-toggle" id="menu-toggle" aria-label="Abrir menu">
        <span class="hamburger-line"></span>
        <span class="hamburger-line"></span>
        <span class="hamburger-line"></span>
    </button>

    <nav class="nav-menu" id="nav-menu">
        <ul>
            <li><a href="<?php echo $local?>">Home</a></li>
            <li><a href="lojaUsu.php">Loja</a></li>
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

    <a style="<?php if($ligado == TRUE){ echo "display: none;";} else{ echo "display: block;";} ?>" href="frontend/pages/cadastro.html" class="btn-login">Login / Cadastro</a>
    <a href="config.php" style="<?php if($ligado == TRUE){ echo "display: block;";} else{ echo "display: none;";} ?>">
        <div class="icone">
        <img src="<?php echo 'backend/php/usuario' . $row->img?>" alt="Imagem do usuario">
        <h1 >  Configurações</h4>
        </div>
    </a>

</header>
<div class="background_des">
  <h1>Como funciona o banho e tosa?</h1>

  <article>
    O banho e tosa para pets é um serviço especializado que garante a higiene, saúde e bem-estar dos animais.
    O processo começa com um banho usando shampoos adequados ao tipo de pele e pelo do pet, seguido de secagem com equipamentos próprios.
    Depois, é feita a tosa, que pode ser higiênica, estética ou conforme a raça. O serviço geralmente inclui ainda limpeza das orelhas, corte das unhas e, em alguns casos, escovação dos dentes.
    Tudo é feito por profissionais treinados para garantir conforto e segurança ao animal.
  </article>
</div>

<div class="img_des">
  <img src="https://foxvet.com.br/wp-content/uploads/2022/07/banner-banho-tosa-perguntas-frequentes-1200x675.jpg" alt="">
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const elementos = document.querySelectorAll('.img_des');

  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('animated');
        observer.unobserve(entry.target); // Só anima uma vez
      }
    });
  });

  elementos.forEach(el => observer.observe(el));
});
</script>

<form class="background_calendario" action="agendar.php" method="post">

  <div class="calendario-container">
    <div id="calendario"></div>
  </div>

  <input type="hidden" name="dataSelecionada" id="dataSelecionada">

  <!-- Flatpickr: CSS + JS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

  <script>
      flatpickr("#calendario", {
      inline: true,
      dateFormat: "Y-m-d",
      defaultDate: "today",
      onChange: function(selectedDates, dateStr, instance) {
        // Atualiza o input hidden com a data
        document.getElementById("dataSelecionada").value = dateStr;
      }
    });

    // Define valor inicial (caso o usuário não clique no calendário)
    window.onload = () => {
      const hoje = new Date().toISOString().split("T")[0];
      document.getElementById("dataSelecionada").value = hoje;
    };

  </script>

  <?php
    if(isset($_SESSION['usuarios'])){
        $sql = "SELECT * FROM pets WHERE idUsuario=" . $_SESSION['usuarios']->cpf;
        $res = $conn->query($sql);

        if($conn->query($sql)){
            echo "<table>";
            echo "<tr>";
            echo "<th>Nome</th>";
            echo "<th>idade</th>";
            echo "<th>Tipo</th>";
            echo "<th>Raça</th>";
            echo "<th>Selecionar</th>";
            echo "</tr>";

            while($row = $res->fetch_object()){
                echo "<tr>";
                echo "<td>{$row->nome}</td>";
                echo "<td>{$row->idade}</td>";
                echo "<td>{$row->tipo}</td>";
                echo "<td>{$row->raca}</td>";
                echo "
              <td>
                <input class='radioSelecionar' type='radio' name='petCadastro' id='{$row->nome}' value='{$row->nome}' required>              
              </td>";

                echo "</tr>";
            } 

            echo "</table>";
            echo "<input type='submit' class='botao_marcar' value='Marcar dia'></h2>";
        }
        else{
            echo "<input type='submit' onclick=location.href='cadastroPet.php' class='botao_marcar' value='Cadastrar Pet'></h2>";
        }
    }
        
    ?>
    
</form>


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