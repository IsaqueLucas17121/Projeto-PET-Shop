<?php

include "../../backend/php/conn.php";

session_start();
$local = "../../index.html";
$ligado = FALSE;

if(isset($_SESSION['usuarios'])){
    $local = "../../backend/php/index.php";
    $chave = $_SESSION['usuarios']->cpf;
    $sql = "SELECT * FROM usuarios WHERE cpf = '$chave'";
    $res = $conn->query($sql);
    $row = $res->fetch_object();
    $ligado = TRUE;

}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendar Pet - Nome do site</title>
    <link rel="stylesheet" href="../src/css/agendarPet.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- BOOTSTRAP ICONS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- FIM BOOTSTRAP ICONS -->

    <link rel="shortcut icon" href="../src/assets/Foto site.png" type="image/x-icon">

    <script src="../src/js/script.js" defer></script>
</head>
<body>

    <header>
    <div class="logo">
        <img src="../../frontend/src/assets/Foto site.png" alt="Logo PetShop"> <!-- Substitua pelo caminho da sua logo -->
        <h1>PetShop Amor & Cuidado</h1>
    </div>

    <nav>
        <ul>
            <li><a href="<?php echo $local?>">Home</a></li>
            <li><a href="../../backend/php/lojaUsu.php">Loja</a></li>
            <li><a onclick="MostrarSer()" style="cursor: pointer;">Serviços</a></li>
            <div class="desligado" id="MostrarSer">
              <li><a href="AgendarPet.php">Banho/Tosa</a></li>
              <li><a href="#">Creche</a></li>
            </div>
            <li><a href="#">Contato</a></li>
        </ul>
    </nav>

    <a style="<?php if($ligado == TRUE){ echo "display: none;";} else{ echo "display: block;";} ?>" href="cadastro.html" class="btn-login">Login / Cadastro</a>
    <a href="../../backend/php/config.php" style="<?php if($ligado == TRUE){ echo "display: block;";} else{ echo "display: none;";} ?>">
        <div class="icone">
        <img style="width: 60px; height: 60px; border-radius: 50%;" src="<?php echo '../../backend/php/usuario' . $row->img?>" alt="Imagem do usuario">
        <h4 style="font-size: 20px;">  Configurações</h4>
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


<div class="background_calendario">
    
    <div class="cabecario_calendario">
        <h1 id="dataAgora"></h1>
        <span>Segunda</span>
        <span>Terça</span>
        <span>Quarta</span>
        <span>Quinta</span>
        <span>Sexta</span>
        <span>Sabado</span>
        <span>Domingo</span>
    </div>
    <form action="AgendarPet.php" method="post" id="dia_cre">
        <div class="numero_calendario">

        </div>
        <input type="submit" class="botao_marcar" value="Marcar dia"></h2>
    </form>
          
</div>

    <div class="numero_calendario"></div>
<div id="dataAgora"></div>

<script>
  let numeros = document.querySelector(".numero_calendario");
  let dia = document.getElementById("dataAgora");

  for (let i = 1; i <= 31; i++) {
    numeros.innerHTML += `
      <input type="checkbox" name="dias[]" value="${i}" id="dia${i}" class="dia-checkbox">
      <label style="cursor:pointer;" for="dia${i}">${i}</label>
    `;
  }

  // Seleciona todos os inputs tipo checkbox criados
  let checkboxes = document.querySelectorAll(".dia-checkbox");

  checkboxes.forEach(input => {
    input.addEventListener('change', () => {
      // Atualiza os labels com classe "selecionado"
      checkboxes.forEach(cb => {
        let label = document.querySelector(`label[for="${cb.id}"]`);
        if (cb.checked) {
          label.classList.add("selecionado");
        } else {
          label.classList.remove("selecionado");
        }
      });

      // Pega os dias selecionados com base nos labels
      let selecionados = Array.from(document.querySelectorAll("label.selecionado"))
        .map(label => label.textContent);

      // Atualiza o conteúdo do elemento com id "dataAgora"
      dia.innerHTML = selecionados.length
        ? "Marcar Dia: " + selecionados.join(', ')
        : "";
    });
  });
</script>

    <div class="background_pet desligado">
        <h1>Cadastre seu Pet</h1>

        <section class="form_pet">

            <form id="tipoPet" action="#">
                
                <div class="margin_nomePet">
                <!-- Se a identidade estiver cadastrada o o nome do pet aparece -->
                    <label for="identidade" class="titulo_form">Indentidade do Pet:</label>
                    <input type="text" id="identidade" required>
                </div>

                <div class="margin_nomePet">
                    <label for="nomePet" class="titulo_form">Nome do Pet</label>
                    <input type="text" id="nomePet" readonly required>
                </div>
                
                <label for="tipoPet" class="titulo_form">Tipo do Pet:</label>
                <div class="magin_radio">         
                    <div class="radio_btn">
                        <label for="cachorro">Cachorro</label>
                        <input type="radio" name="tipoPet" id="cachorro">
                        <label for="cachorro" class="radio_manual" id="radio1"></label>  
                        <select id="racaCachorro" name="racaCachorro">
                            <option value="Beagle">Beagle</option>
                            <option value="PastorAlemao">Pastor Alemão</option>   
                            <option value="Poodle">Poodle</option>
                            <option value="ShihTzu">Shih Tzu</option>
                            <option value="YorkshireTerrier">Yorkshire Terrier</option>
                            <option value="Outro">Não Sei</option>     
                        </select>
                        
                    </div>
                    <div class="radio_btn">
                        <label for="gato">Gato</label>
                        <input type="radio" name="tipoPet" id="gato">
                        <label for="gato" class="radio_manual" id="radio2"></label>
                        <select id="racaGato" name="racaGato">
                            <option value="Siames">Siames</option>
                            <option value="Persa">Persa</option>   
                            <option value="ScottishFold">Scottish Fold</option>
                            <option value="Sphynx">Sphynx</option>
                            <option value="MaineCoon">Maine Coon</option>
                            <option value="Outro">Não Sei</option>
                        </select>  

                    </div>
                    <div class="radio_btn">
                        <label for="ave">Passaro</label>
                        <input type="radio" name="tipoPet" id="ave">
                        <label for="ave" class="radio_manual" id="radio3"></label>
                        <select id="racaAve" name="racaAve">
                            <option value="canario">Canário</option>
                            <option value="calopsita">Calopsita</option>   
                            <option value="Cacatua">Cacatua</option>
                            <option value="Arara">Arara</option>
                            <option value="PapagaioCinzento">Papagaio Cinzento</option>
                            <option value="Outro">Não Sei</option>
                        </select>          

                    </div>
                    <div class="radio_btn">
                        <label for="reptil">Reptil</label>
                        <input type="radio" name="tipoPet" id="reptil">
                        <label for="reptil" class="radio_manual" id="radio4"></label>
                        <select id="racaReptil" name="racaReptil">
                            <option value="Iguana">Iguana Verde</option>
                            <option value="Jabuti">Jabuti</option>   
                            <option value="Teiú">Teiú</option>
                            <option value="Sphynx">Sphynx</option>
                            <option value="Jiboia">Jiboia Arco-íris</option>
                            <option value="Outro">Não Sei</option>
                        </select> 

                    </div>
                </div>
                

                <input type="submit" value="salvar">
            </form>

            
        </section>
        
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