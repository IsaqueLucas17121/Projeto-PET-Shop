<?php

include "conn.php";

session_start();

$ligado = FALSE;
$local = "index.html";

if(isset($_SESSION['usuarios'])){
    $chave = $_SESSION['usuarios']->cpf;
    $sql = "SELECT * FROM usuarios WHERE cpf = '$chave'";

    $res = $conn->query($sql);
    $row = $res->fetch_object();

    $ligado = TRUE;
    $local = "index.php";
}

$marcas = ['Pedigree', 'Golden', 'Whiskas', 'Aleon', 'Outra'];
$racas = ['Cachorro', 'Gato', 'Passarinho', 'Peixe', 'Outro'];

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
        <img  src="<?php echo $row->img?>" alt="Imagem do usuario">
        <h1 >  Configurações</h4>
        </div>
    </a>

</header>


    <section class="slider">

        <div class="slider-content">

            <input type="radio" name="btn-radio" id="radio1">
            <input type="radio" name="btn-radio" id="radio2">
            <input type="radio" name="btn-radio" id="radio3">

            <div class="slide-box primeiro" id="primeiro">
                <img class="img-Pc" src="frontend/src/assets/promocao1.jpg" alt="Imagem da propaganda 1">
                <img class="img-Mobile" src="frontend/src/assets/promocao1.jpg" alt="Imagem da propaganda 1">
            </div>
            <div class="slide-box">
                <img class="img-Pc" src="frontend/src/assets/promocao2.jpg" alt="Imagem da propaganda 2">
                <img class="img-Mobile" src="frontend/src/assets/promocao2.jpg" alt="Imagem da propaganda 2">
            </div>
            <div class="slide-box">
                <img class="img-Pc" src="frontend/src/assets/promocao3.jpg" alt="Imagem da propaganda 3">
                <img class="img-Mobile" src="frontend/src/assets/promocao3.jpg" alt="Imagem da propaganda 3">
            </div>
            
            <button onclick="slide_arrow(1)" class="botaoS" id="botaoS" ><span>‹</span></button>
            <button onclick="slide_arrow(2)" class="botaoS2" id="botaoS2" ><span>›</span></button>

            <div class="nav-auto"> 
                <div class="auto-btn1"></div>
                <div class="auto-btn2"></div>
                <div class="auto-btn3"></div>
            </div>

            <div class="nav-manual"> 
                <label for="radio1" class="manual-btn"></label>
                <label for="radio2" class="manual-btn"></label>
                <label for="radio3" class="manual-btn"></label>
            </div>

        </div>

    </section>

    <div class="magin_loja">

        <div class="background_loja">

            <div class="background_filtro">

                <div class="box_filtro">
                    <h3>Tipos de Animais</h3>
                    <i class="bi bi-filter" onclick="DesligarFiltro()"></i>
                    <?php
                        foreach ($racas as $tipo) {
                            $sql = "SELECT COUNT(*) as total FROM produtos WHERE tipo = ?";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("s", $tipo);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $row = $result->fetch_object();

                            echo "<div onclick=\"selecionado('$tipo')\" class='filtro_iten'>";
                            echo "<span class='filtro-nome'>{$tipo}</span>";
                            echo "<span class='quantidade_filtro'>{$row->total}</span>";
                            echo "</div>";
                    }
                    ?>
                    <h3>Marcas Populares</h3> 
                    <?php
                        foreach ($marcas as $marca) {
                            $sql = "SELECT COUNT(*) as total FROM produtos WHERE marca = ?";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("s", $marca);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $row = $result->fetch_object();

                            echo "<div onclick=\"selecionado('$marca')\" class='filtro_iten'>";
                            echo "<span class='filtro-nome'>{$marca}</span>";
                            echo "<span class='quantidade_filtro'>{$row->total}</span>";
                            echo "</div>";
                    }
                    ?>

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
                    $sql2 = "SELECT * FROM produtos";
                    $res2 = $conn->query($sql2);
                    
                    $qtd = $res2->num_rows;

                    while($row2 = $res2->fetch_object()){

                        if($qtd > 1){
                            echo"<div class='box_cards deligado' onclick=\"location.href='comprar.php?idPro=".$row2->idPro."';\">
                                <div class='magin_imagemcard'>
                                    <img src= 'produto$row2->img' alt='Foto do produto'>
                                </div>
                                <ul>
                                    <li><span>$row2->nome</span></li>
                                    <li><span>R$: $row2->preco,00</span></li>
                                </ul>
                            
                            </div>";

                        }
                        else{
                            echo"<div class='box_cards' onclick=\"location.href='comprar.php?idPro=".$row2->idPro."';\">
                                <div class='magin_imagemcard'>
                                    <img src= '$row2->img' alt='Foto do produto'>
                                </div>
                                <ul>
                                    <li><span>$row2->nome</span></li>
                                    <li><span>R$: $row2->preco,00</span></li>
                                </ul>
                            
                            </div>";


                        }
                    }
           
                ?>
    
                
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

<script>
    /* Slide */


var radio = document.querySelector('.manual-btn')
var contador = 1

document.getElementById('radio1').checked = true

setInterval(() => {
    proximaimg()
}, 5000)


// rolamento do slide 

function proximaimg(){

    contador++

    if(contador > 3)(
        contador = 1
    )

    document.getElementById('radio'+contador).checked = true

    
}

// mudar imagem slide

function mudarImg(index){
    for( i=1; i<=4 ; i++ ){
        document.getElementById("img_principal" + i).classList.add("desligado")
    }
    document.getElementById("img_principal" + index).classList.remove("desligado")
}

// setas do slide

let count = 1;

function slide_arrow(direction) {
    let slide = document.getElementById("primeiro");

    if (direction === 1) {
        count = count - 1; 
    }
    else {
        count = count + 1; 
    }

    if (count < 1) {
        count = 3;
    } else if (count > 3) {
        count = 1;
    }

    document.getElementById("radio" + count).checked = true;
}

function selecionado(valor){
    console.log(valor)
}
</script>

</body>
</html>
