<?php

include "conn.php";

session_start();

$chave = $_SESSION['vendedores']->idFuncionario;

if(isset($_SESSION['vendedores'])){
    $sql = "SELECT * FROM lojas WHERE idFuncionario = $chave";

    $res = $conn->query($sql);
    $row = $res->fetch_object();
    $idloja = $row->idLoja;

    $sql2 = "SELECT img FROM funcionarios WHERE idFuncionario = $chave";

    $res2 = $conn->query($sql2);
    $row2 = $res2->fetch_object();

}
else{
    header("Location: ../../frontend/pages/index.html");
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configurações da Loja - Nome da loja</title>
    <link rel="stylesheet" href="../../frontend/src/css/loja.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
   

    <!-- BOOTSTRAP ICONS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- FIM BOOTSTRAP ICONS -->

    <link rel="shortcut icon" href="../../frontend/src/assets/Foto site.png" type="image/x-icon">

    <script src="../../frontend/src/js/script.js" defer></script>
    <script src="../../frontend/src/js/cookiePro.js" defer></script>

    <style>
        .box_cards{
            width: auto;
        }
    </style>
</head>
<body>
    <header class="cabecario" id="cabecario">
        <a href="index.php"><img src="../../frontend/src/assets/Foto site.png" alt="Imagem do site"></a>
        <span><a href="loja.php"><i class="bi bi-cart"></i>  Loja</a></span>
        <span><a href="AgendarPet.html"><i class="bi bi-droplet"></i>  Banho/Tosa</a></span>
        <span><a href="cadastroCre.html"><i class="bi bi-house-heart"></i>  Creche</a></span>
        <a href="config.php">
          <div class="icone" style="cursor: pointer; display:grid; justify-content:center; justify-items:center;">
            <img style="width: 60px; height: 60px; border-radius: 50%;" src="<?php echo 'vendedor' . $row2->img?>" alt="Imagem do usuario">
            <h4 style="font-size: 20px;">  Configurações</h4>
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
                        <span>Cachorro</span><span class="quantidade_filtro" id="filtro1">0</span>
                    </div>
                    <div class="filtro_iten">
                        <span>Gato</span><span class="quantidade_filtro" id="filtro2">0</span>
                    </div>
                    <div class="filtro_iten">
                        <span>Passarinho</span><span class="quantidade_filtro" id="filtro3">0</span>
                    </div>  
                    <div class="filtro_iten">
                        <span>Peixe</span><span class="quantidade_filtro" id="filtro4">0</span>
                    </div>        
                    <div class="filtro_iten">
                        <span>Outros</span><span class="quantidade_filtro" id="filtro5">0</span>
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

                    while($row3 = $res3->fetch_object()){

                        echo"<div class='box_cards' onclick=\"location.href='produto/atualizarPro.php?idPro=".$row3->idPro."';\">
                                <div class='magin_imagemcard'>
                                    <img src= 'produto$row3->img' alt='Foto do produto'>
                                </div>
                                <ul>
                                    <li><span>$row3->nome</span></li>
                                    <li><span>R$: $row3->preco,00</span></li>
                                </ul>
                            
                            </div>";


                    }
                    
                ?>
    
                
                <div class="box_cards" id="adicionarPro">
                    <a href="produto/cadastroPro.html">
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
        <div class="box_rodape">

            <div class="card_rodape">
                <h4>Políticas</h4>
                <span>Política de Privacidade</span>
                <span>Política de Cookies</span>
                <span>Política de Compras</span>
                <span>política de Entregas</span>
            </div>
            
            <div class="card_rodape">
                <h4>Suporte</h4>
                <span>Central de Atendimento</span>
                <span><i class="bi bi-whatsapp"></i>  WhatsApp</span>
            </div>
            
            <div class="card_rodape">
                <h4>Categorias</h4>
                <span>Ração</span>
                <span>Marcas</span>
                <span>Utensílios</span>
                <span>Planos de Sáude Pet</span>
            </div>

            <div class="card_rodape">
                <h4>Ofertas em Destaque</h4>
                <span>Antipulgas e Carrapatos</span>
                <span>Medicamentos</span>
                <span>Antibióticos</span>
            </div>

            <span class="voltar_footer"><a href="#cabecario"><i class="bi bi-arrow-bar-up"></i>  Voltar ao Início</a></span>
            
        </div>
        
    </footer>

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
