<?php

include 'conn.php';

session_start();

if( !isset($_SESSION['usuarios']) && !isset($_SESSION['vendedores'])){
  print "<script>location.href='../../frontend/pages/index.html';</script>";
}

if(isset($_SESSION['usuarios'])){
  $chave = $_SESSION['usuarios']->cpf;

  $sql = "SELECT * FROM usuarios WHERE cpf = '$chave'";

  $local = 'usuario';

  $loja = "lojaUsu.php";

  $res = $conn->query($sql);
  $row = $res->fetch_object();
}
else if(isset($_SESSION['vendedores'])){

  $chave = $_SESSION['vendedores']->idFuncionario;

  $sql = "SELECT * FROM funcionarios WHERE idFuncionario = '$chave'";

  $local = 'vendedor';

  $loja = "loja.php";

  $res = $conn->query($sql);
  $row = $res->fetch_object();
}


?>

<!DOCTYPE html>
<html lang="pr-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página inicial - Nome da loja</title>
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
            <img style="width: 60px; height: 60px; border-radius: 50%;" src="<?php echo $local, $row->img?>" alt="Imagem do usuario">
            <h4 style="font-size: 20px;">  Configurações</h4>
          </div>
        </a>
        
    </header>

    <div class="primeira_box">
        <div class="magin_roll" id="roll1">
            <h2>VAI VIAJAR</h2>
            <span>E PRECISA DE UM LUGAR PARA</span>
            <h1>DEIXAR O SEU PET?</h1>
            <h3>Clique Aqui</h3>
        </div>
        <div class="magin_roll" id="roll2">
            <h2>BANHO E TOSA</h2>
            <span>PARA SEU PET FICAR <span class="destaque_roll">CHEIROSO</span> E <span class="destaque_roll">LIMPINHO</span></span>
            <h1>AGENDE AGORA</h1>
            <h3>Clique Aqui</h3>
        </div>

    </div>

    <div class="segunda_box">
      <div class="card_segunda_box" id="segunda_box1">
        <img src="https://premierpet.com.br/wp-content/uploads/2022/07/Golded-Gourmet-logo-cor-01-e1657028143101-1024x411.png" alt="Logo da marca Gloden">
      </div>
      <div class="card_segunda_box" id="segunda_box2">
        <img src="../../frontend/src/assets/raçao de peixe.jpg" alt="Logo da marca Pedigree">
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
          <img src="../../frontend/src/assets/comida gato.png" alt="Comida Para Gatos">
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
          <img src="../../frontend/src/assets/comida cachorro.png" alt="Comida Para Gatos">
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