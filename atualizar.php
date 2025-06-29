<?php

include 'conn.php';

session_start();

if( !isset($_SESSION['usuarios']) && !isset($_SESSION['vendedores'])){
    print "<script>location.href='frontend/pages/cadastro.html';</script>";
}
if(isset($_SESSION['usuarios'])){

    $chave = $_SESSION['usuarios']->cpf;

    $local = 'backend/php/usuario/';

    $sql1 = "SELECT * FROM usuarios WHERE cpf = '$chave'";
    $res = $conn->query($sql1);
    $row = $res->fetch_object();

    $sql2 = "SELECT * FROM enderecos WHERE cep = '$row->cep'";
    $res2 = $conn->query($sql2);
    $row2 = $res2->fetch_object();
    $loja = "lojaUsu.php";
}

if(isset($_SESSION['vendedores'])){

    $chave = $_SESSION['vendedores']->idFuncionario;

    $local = 'backend/php/vendedor/';

    $sql3 = "SELECT * FROM funcionarios WHERE idFuncionario = '$chave'";
    $res3 = $conn->query($sql3);
    $row3 = $res3->fetch_object();

    $sql4 = "SELECT * FROM enderecos WHERE cep='$row3->cep'";
    $res4 = $conn->query($sql4);
    $row4 = $res4->fetch_object();

    $salvarVen = "atualizarVen.php";
    $loja = "loja.php";
}

if(isset($_REQUEST['idFuncionario'])){

    $chave = $_REQUEST['idFuncionario'];

    $sql1 = "SELECT * FROM funcionarios WHERE idFuncionario = '$chave'";
    $res = $conn->query($sql1);
    $row = $res->fetch_object();

    $sql2 = "SELECT * FROM enderecos WHERE cep = '$row->cep'";
    $res2 = $conn->query($sql2);
    $row2 = $res2->fetch_object();

    $salvarVen = "atualizarVen.php?idFuncionario=$chave";

}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Cadastro - PetShop</title>
    
    <!-- CSS -->
    <link rel="stylesheet" href="frontend/src/css/login.css">
    <link rel="stylesheet" href="frontend/src/css/loja.css">
    <link rel="stylesheet" href="frontend/src/css/style.css">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- Favicon -->
    <link rel="shortcut icon" href="frontend/src/assets/Foto site.png" type="image/x-icon">

    <!-- JavaScript -->
    <script src="frontend/src/js/script.js" defer></script>
    <script src="frontend/src/js/cadastro.js" defer></script>

    <style>
        #cliente{
            <?php 
                if(isset($_SESSION['usuarios'])){
                    echo "display: block;";
                }  
                else{
                    echo "display: none;";
                }
            ?>
        }
        #vendedor{
            <?php 
                if(isset($_SESSION['vendedores'])){
                    echo "display: block;";
                }  
                else{
                    echo "display: none;";
                }
            ?>
        }
        
    </style>
</head>
<body style="margin-top: 100px;">
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
        <img  src="<?php echo $local . $row->img?>" alt="Imagem do usuario">
        <h1 >  Configurações</h4>
        </div>
    </a>
    
</header>


    <!-- Seção de Cadastro de Cliente -->
    <section class="content" id="cliente">
        <a href="config.php"><h5 id="voltar"> Voltar</h5></a>
        <h2>Atualizar Cliente</h2>

        <form id="form-cliente" action="atualizarUsu.php" method="POST">
            <label for="cliente-nome">Nome:</label>
            <input value="<?php echo $row->nome?>" type="text" name="cliente-nome" id="cliente-nome" required />

            <label for="cliente-sobrenome">Sobrenome:</label>
            <input value="<?php echo $row->sobrenome?>" type="text" name="cliente-sobrenome" id="cliente-sobrenome" required />

            <label for="cliente-email">Email:</label>
            <input value="<?php echo $row->email?>" type="email" name="cliente-email" id="cliente-email" required />

            <label for="cliente-senha">Senha:</label>
            <input value="<?php echo $row->senha?>" type="password" name="cliente-senha" id='cliente-senha' required />
            <i class="bi bi-eye" id="olho1" onclick="trocarSenha(1)" style="transform: translateY(-50%);top: 25%;display: flex;"></i>
            <i class="bi bi-eye-slash" id="olho2" onclick="trocarSenha(2)" style="transform: translateY(-50%);top: 25%;display: flex;"></i>

            <script>
                function trocarSenha(index){
                    let olho1 = document.getElementById('olho1')
                    let olho2 = document.getElementById('olho2')
                    let input = document.getElementById('cliente-senha')
                    if(index === 1 ){
                        olho1.style.display = "none"
                        olho2.style.display = "flex"
                    }
                    else if(index === 2){
                        olho1.style.display = "flex"
                        olho2.style.display = "none"
                    }
                    input.type = input.type === 'text' ? 'password' : 'text';
                }
            </script>


            <label for="cliente-celular">Celular (com DDD):</label>
            <input value="<?php echo $row->celular?>" oninput="formatarCelular(this)" type="text" name="cliente-celular" id="cliente-celular" placeholder="(11) 91234-5678" maxlength="15" minlength="15" required />

            <label for="cliente-cep">CEP:</label>
            <input value="<?php echo $row->cep?>" oninput="formatarCEP(this)" type="text" name="cliente-cep" id="cliente-cep" required maxlength="9" />

            <label for="cliente-rua">Rua:</label>
            <input value="<?php echo $row2->rua; ?>" type="text" name="cliente-rua" id="cliente-rua" required readonly maxlength="100" />

            <label for="cliente-bairro">Bairro:</label>
            <input value="<?php echo $row2->bairro; ?>" type="text" name="cliente-bairro" id="cliente-bairro" required readonly maxlength="50" />

            <label for="cliente-cidade">Cidade:</label>
            <input value="<?php echo $row2->cidade;?>" type="text" name="cliente-cidade" id="cliente-cidade" required readonly maxlength="50" />

            <label for="cliente-estado">Estado:</label>
            <input value="<?php echo $row2->estado;?>" type="text" name="cliente-estado" id="cliente-estado" required readonly maxlength="2" />

            <label for="cliente-numero">Número:</label>
            <input value="<?php echo $row->numero?>" type="text" name="cliente-numero" id="cliente-numero" required maxlength="100" />
            
            <label for="cliente-complemento">Complemento:</label>
            <input value="<?php echo $row->complemento;?>" type="text" name="cliente-complemento" id="cliente-complemento" required maxlength="100" />

            <input type="submit" value="Atualizar Cliente" class="btn-submit" />
        </form>
        
    </section>

    <section class="content" id="vendedor">
        <a href="config.php"><h5 id="voltar"> Voltar</h5></a>
        <h2>Atualizar Vendedor</h2>
  
        <form id="form-vendedor" action="<?php echo $salvarVen?>" method="POST">
            <label for="vendedor-nome">Nome:</label>
            <input value="<?php echo $row3->nome?>" type="text" name="vendedor-nome" id="vendedor-nome" required />

            <label for="vendedor-sobrenome">Sobrenome:</label>
            <input value="<?php echo $row3->sobrenome?>" type="text" name="vendedor-sobrenome" id="vendedor-sobrenome" required />

            <label for="vendedor-email">Email:</label>
            <input value="<?php echo $row3->email?>" type="email" name="vendedor-email" id="vendedor-email" required />

            
            <label for="vendedor-senha">Senha:</label>
            <input value="<?php echo $row3->senha?>" type="password" name="vendedor-senha" id='vendedor-senha' required />
            <i class="bi bi-eye" id="olho3" onclick="trocarSenha(3)"></i>
            <i class="bi bi-eye-slash" id="olho4" onclick="trocarSenha(4)"></i>

            <label for="vendedor-telefone">Telefone (com DDD):</label>
            <input value="<?php echo $row3->telefone?>" oninput="formatarCelular(this)" type="text" name="vendedor-telefone" id="vendedor-telefone" placeholder="(11) 91234-5678" maxlength="15" minlength="15" required />

            <label for="vendedor-cep">CEP:</label>
            <input value="<?php echo $row3->cep?>" oninput="formatarCEP(this)" type="text" name="vendedor-cep" id="vendedor-cep" required maxlength="9" />

            <label for="vendedor-rua">Rua:</label>
            <input value="<?php echo $row4->rua?>" type="text" name="vendedor-rua" id="vendedor-rua" required readonly maxlength="100" />

            <label for="vendedor-bairro">Bairro:</label>
            <input value="<?php echo $row4->bairro?>" type="text" name="vendedor-bairro" id="vendedor-bairro" required readonly maxlength="50" />
            
            <label for="vendedor-cidade">Cidade:</label>
            <input value="<?php echo $row4->cidade?>" type="text" name="vendedor-cidade" id="vendedor-cidade" required readonly maxlength="50" />

            <label for="vendedor-estado">Estado:</label>
            <input value="<?php echo $row4->estado?>" type="text" name="vendedor-estado" id="vendedor-estado" required readonly maxlength="2" />

            <label for="vendedor-numero">Número:</label>
            <input value="<?php echo $row3->numero?>" type="text" name="vendedor-numero" id="vendedor-numero" required maxlength="100" />
            
            <label for="vendedor-complemento">Complemento:</label>
            <input value="<?php echo $row3->complemento?>" type="text" name="vendedor-complemento" id="vendedor-complemento" required maxlength="100" />

            
            <input type="submit" value="Atualizar Vendedor" class="btn-submit" />
        </form>
        
    </section>

    <!-- Seção de Confirmação -->
    <section class="content desligado" id="confirmacao">
        <h2>CADASTRO REALIZADO COM SUCESSO!</h2>
        <i class="bi bi-cloud-check"></i>
        <button onclick="voltarParaInicio()" class="btn-submit">
            <i class="bi bi-house"></i> Voltar ao Início
        </button>
    </section>

    <script>
        function mascaraCelular(valor) {
            valor = valor.replace(/\D/g, '');
            valor = valor.replace(/^(\d{2})(\d)/g, '($1) $2');
            valor = valor.replace(/(\d{5})(\d)/, '$1-$2');
            return valor;
        }

        function formatarCelular(input) {
            input.value = mascaraCelular(input.value);
        }
    </script>

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