<?php

include "conn.php";

session_start();

if(isset($_SESSION['vendedores'])){
    $chave = $_SESSION['vendedores']->idFuncionario;

    $sql = "SELECT * FROM lojas WHERE idFuncionario = $chave";

    $res = $conn->query($sql);
    $row = $res->fetch_object();
    $idloja = $row->idLoja;

    $sql2 = "SELECT img FROM funcionarios WHERE idFuncionario = $chave";

    $res2 = $conn->query($sql2);
    $row2 = $res2->fetch_object();


}
else{
    header("Location: index.html");
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configurações da Loja - Nome da loja</title>
    <link rel="stylesheet" href="frontend/src/css/loja.css">
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
    <script src="frontend/src/js/cookiePro.js" defer></script>

    <style>
        .box_cards{
            width: auto;
        }
    </style>
</head>
<body style="margin-top: 60px;">
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

    <div class="magin_loja" style="width: 100%;
    display: flex;
    justify-content: center;
    align-items: flex-start;">

        <div class="background_loja">

            <div class="background_filtro">

                <div class="box_filtro">
                    <h3>Tipos de Animais</h3>
                    <i class="bi bi-filter" onclick="DesligarFiltro()"></i>
                    <div class="filtro_iten">
                        <span id="filtro1">Cachorro</span><span class="quantidade_filtro">0</span>
                    </div>
                    <div class="filtro_iten">
                        <span id="filtro2">Gato</span><span class="quantidade_filtro">0</span>
                    </div>
                    <div class="filtro_iten">
                        <span id="filtro3">Passarinho</span><span class="quantidade_filtro">0</span>
                    </div>  
                    <div class="filtro_iten">
                        <span id="filtro4">Peixe</span><span class="quantidade_filtro">0</span>
                    </div>        
                    <div class="filtro_iten">
                        <span id="filtro5">Outros</span><span class="quantidade_filtro">0</span>
                    </div>     

                    <h3>Marca</h3>
                    <div class="filtro_iten">
                        <span>Golden</span><span class="quantidade_filtro" id="filtro6">0</span>
                    </div>
                    <div class="filtro_iten">
                        <span>Pedigree</span><span class="quantidade_filtro" id="filtro7">0</span>
                    </div>
                    <div class="filtro_iten">
                        <span>PremieR</span><span class="quantidade_filtro" id="filtro8">0</span>
                    </div>

                    <h3>Idade</h3>
                    <div class="filtro_iten">
                        <span>Adulto</span><span class="quantidade_filtro" id="filtro9">0</span>
                    </div>
                    <div class="filtro_iten">
                        <span>Filhote</span><span class="quantidade_filtro" id="filtro10">0</span>
                    </div>
                    <div class="filtro_iten">
                        <span>Idoso</span><span class="quantidade_filtro" id="filtro11">0</span>
                    </div>

                    <h3>Sabor da Ração</h3>
                    <div class="filtro_iten">
                        <span>Carne</span><span class="quantidade_filtro" id="filtro12">0</span>
                    </div>
                    <div class="filtro_iten">
                        <span>Frango</span><span class="quantidade_filtro" id="filtro13">0</span>
                    </div>
                    <div class="filtro_iten">
                        <span>Peixo</span><span class="quantidade_filtro" id="filtro14">0</span>
                    </div>
                    <div class="filtro_iten">
                        <span>Legumes e Verduras</span><span class="quantidade_filtro" id="filtro15">0</span>
                    </div>

                </div>
    
            </div>

            <div class="background_cards">
                <?php
                    $sql3 = "SELECT * FROM produtos WHERE idFuncionario = $chave";
                    $res3 = $conn->query($sql3);
                    
                    $qtd = $res3->num_rows;

                    while($row3 = $res3->fetch_object()){

                        if($qtd > 1){
                            echo"<div class='box_cards deligado' onclick=\"location.href='atualizarPro.php?idPro=".$row3->idPro."';\">
                                <div class='magin_imagemcard'>
                                    <img src= 'backend/php/produto/$row3->img' alt='Foto do produto'>
                                </div>
                                <ul>
                                    <li><span>$row3->nome</span></li>
                                    <li><span>R$: $row3->preco,00</span></li>
                                </ul>
                            
                            </div>";

                        }
                        else{
                            echo"<div class='box_cards' onclick=\"location.href='atualizarPro.php?idPro=".$row3->idPro."';\">
                                <div class='magin_imagemcard'>
                                    <img src= '$row3->img' alt='Foto do produto'>
                                </div>
                                <ul>
                                    <li><span>$row3->nome</span></li>
                                    <li><span>R$: $row3->preco,00</span></li>
                                </ul>
                            
                            </div>";


                        }
                    }
           
                ?>
    
                
                <div class="box_cards" id="adicionarPro">
                    <a href="cadastroPro.php">
                        <div class="magin_imagemcard">
                            <img src="https://icones.pro/wp-content/uploads/2021/06/icone-d-image-bleue.png" alt="Foto do produto">
                        </div>
                        <ul>
                            <li><span>Adiciona Nome do produto</span></li>
                            <li><span>Adicionar Preço do produto</span></li>
                        </ul>
                    </a>
                </div>
                
                <div class="proxima_pag" style="display: flex;width: 100%; justify-content: center;position: initial;">
                    <i class="bi bi-arrow-left"></i>
                    <span id="pagi1" onclick="MudarPagina(1)">1</span>
                    <span id="pagi2" onclick="MudarPagina(2)">2</span>
                    <span id="pagi3" onclick="MudarPagina(3)">3</span>
                    <i class="bi bi-arrow-right"></i>
                </div>
                
            </div>

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


</body>
</html>
