<?php

include "../../backend/php/conn.php";

session_start();

if(isset($_SESSION['usuarios'])){
    $chave = $_SESSION['usuarios']->cpf;
    $sql = "SELECT * FROM usuarios WHERE cpf = '$chave'";
    $res = $conn->query($sql);
    $row = $res->fetch_object();

}
else{
 exit();
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

    <header class="cabecario" id="cabecario">
        <a href="../../backend/php/index.php"><img src="../../frontend/src/assets/Foto site.png" alt="Imagem do site"></a>
        <span><a href="#"><i class="bi bi-cart"></i>  Loja</a></span>
        <span><a href="AgendarPet.php"><i class="bi bi-droplet"></i>  Banho/Tosa</a></span>
        <span><a href="cadastroCre.php"><i class="bi bi-house-heart"></i>  Creche</a></span>
        <a href="../../backend/php/config.php">
          <div class="icone" style="cursor: pointer; display:grid; justify-content:center; justify-items:center;">
            <img style="width: 60px; height: 60px; border-radius: 50%;" src="<?php echo '../../backend/php/usuario' . $row->img?>" alt="Imagem do usuario">
            <h4 style="font-size: 20px;">  Configurações</h4>
          </div>
        </a>
        
    </header>

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

            <form id="tipoPet">
                
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

<?php

    if (isset($_POST['dias'])) {
        $diasSelecionados = $_POST['dias']; // array de dias: [3, 15, 22]

        $ano = date('Y');
        $mes = date('m');

        foreach ($diasSelecionados as $dia) {
            $dataCompleta = "$ano-$mes-" . str_pad($dia, 2, '0', STR_PAD_LEFT); // ex: 2025-06-03

            // Agora insira essa $dataCompleta no banco
            // Exemplo com PDO:
            $stmt = $pdo->prepare("INSERT INTO pets (consulta) VALUES (:data)");
            $stmt->execute(['data' => $dataCompleta]);
        }
    }
  

?>