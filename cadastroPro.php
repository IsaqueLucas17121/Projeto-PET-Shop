<?php

include "conn.php";

session_start();

if(isset($_SESSION['vendedores'])){
    $chave = $_SESSION['vendedores']->idFuncionario;

    $sql = "SELECT img FROM funcionarios WHERE idFuncionario = $chave";

    $res = $conn->query($sql);
    $row = $res->fetch_object();


}
else{
    header("Location: index.html");
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loja - Nome da loja</title>
    <link rel="stylesheet" href="frontend/src/css/adicionar.css">
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
        #voltar{
            position: absolute;
            top: 2%;
            right: 5%;
            padding: 13px;
            font-size: 17px;
            border: none;
            background-color: #6a1b9a;
            color: white;
            cursor: pointer;
            border-radius: 15px;
        }

        .radio_tipo{
            display: inline;
          }
    </style>
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
            <li><a href="loja.php">Loja</a></li>
            <li><a href="cadastroPro.php">Produto</a></li>
            <li><a href="#">Contato</a></li>
        </ul>
    </nav>

    <a href="config.php">
        <div class="icone">
        <img src="<?php echo 'backend/php/vendedor' . $row->img?>" alt="Imagem do usuario">
        <h1>  Configurações</h4>
        </div>
    </a>
    
</header>

    <section class="margin_container" style="position: relative;">
        <div class="container">
            <form enctype="multipart/form-data" id="formularioPro" action="cadastrarPro.php" method="POST">
                <label for="produto" class="form-label">Nome do Produto</label>
                <input type="text" name="produto" class="form-control" id="produto" required>

                <label for="descricao" class="form-label">Descrição</label>
                <input type="text" name="descricao" class="form-control" id="descricao" required>


                <label for="preco" class="form-label">Preço</label>
                <input type="number" name="preco" class="form-control" id="preco" step="0.01" required>

                <div class="radio_tipo">
                    <label for="Cachorro">Cachorro</label>
                    <input type="radio" name="tipoPet" value="Cachorro" id="Cachorro" required>

                    <label for="Gato">Gato</label>
                    <input type="radio" name="tipoPet" value="Gato" id="Gato">

                    <label for="Passarinho">Passarinho</label>
                    <input type="radio" name="tipoPet" value="Passarinho" id="Passarinho">

                    <label for="Peixe">Peixe</label>
                    <input type="radio" name="tipoPet" value="Peixe" id="Peixe">

                    <label for="Outros">Outros</label>
                    <input type="radio" name="tipoPet" value="Outros" id="Outros">

                </div>


                <label for="imagem" class="form-label">Imagem do Produto</label>
                <img name="profilePic" id="profilePic" src="https://icones.pro/wp-content/uploads/2021/06/icone-d-image-bleue.png" alt="imagem padão do site">
                <input type="file" name="imagem" class="form-control" id="imagem" accept="image/*">

                <input type="submit" value="Cadastrar Produto">
            </form>
        </div>

        <button id="voltar" onclick="location='loja.php'">Voltar</button>

    </section>

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
    document.getElementById('imagem').addEventListener('change', function(event) {
            const file = event.target.files[0];
            
            // Verifica se um arquivo foi selecionado e se é uma imagem
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                
                // Define o que fazer quando a leitura for concluída
                reader.onload = function(e) {
                    // Define o src da img com o conteúdo da imagem lida
                    const profilePic = document.getElementsByName('profilePic')[0];
                    profilePic.src = e.target.result;
                    profilePic.style.display = 'block'; // Exibe a imagem
                };

                // Lê o arquivo como uma URL de dados
                reader.readAsDataURL(file);
            } else {
                // Se não for uma imagem, oculta a pré-visualização e exibe uma mensagem
                const profilePic = document.getElementsByName('profilePic')[0];
                profilePic.src = "https://icones.pro/wp-content/uploads/2021/06/icone-d-image-bleue.png";
                alert('Por favor, selecione um arquivo de imagem válido.');
            }
        });

    function changeProfilePicture(){
            let img = document.getElementById("profilePic");
        }
  </script>
</body>
</html>