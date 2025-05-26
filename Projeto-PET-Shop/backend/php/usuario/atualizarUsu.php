<?php

include '../conn.php';

session_start();

$chave = $_SESSION['usuarios']->cpf;

$sql1 = "SELECT * FROM usuarios WHERE cpf = '$chave'";
$res = $conn->query($sql1);
$row = $res->fetch_object();

$sql2 = "SELECT * FROM enderecos WHERE cep = '$row->cep'";
$res2 = $conn->query($sql2);
$row2 = $res2->fetch_object();

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - PetShop</title>
    
    <!-- CSS -->
    <link rel="stylesheet" href="../../../frontend/src/css/login.css">
    <link rel="stylesheet" href="../../../frontend/src/css/loja.css">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- Favicon -->
    <link rel="shortcut icon" href="../../../frontend/src/assets/Foto site.png" type="image/x-icon">

    <!-- JavaScript -->
    <script src="../../../frontend/src/js/script.js" defer></script>
    <script src="../../../frontend/src/js/cadastro.js" defer></script>
</head>
<body>
    <header class="cabecario" id="cabecario">
        <a href="index.html"><img src="../../../frontend/src/assets/Foto site.png" alt="Logo PetShop"></a>
        <span><a href="loja.html"><i class="bi bi-cart"></i> Loja</a></span>
        <span><a href="AgendarPet.html"><i class="bi bi-droplet"></i> Banho/Tosa</a></span>
        <span><a href="cadastroCre.html"><i class="bi bi-house-heart"></i>  Creche</a></span>
        <span><a href="./cadastro.html"><i class="bi bi-person-circle"></i> Entrar</a></span>
    </header>


    <!-- Seção de Cadastro de Cliente -->
    <section class="content" id="cliente">
        <a href="configUsu.php"><h5 id="voltar"> Voltar</h5></a>
        <h2>Aualizar Cliente</h2>

        <form id="form-cliente" action="atualizar.php" method="POST">
            <label for="cliente-nome">Nome:</label>
            <input value=<?php echo $row->nome?> type="text" name="cliente-nome" id="cliente-nome" required />

            <label for="cliente-sobrenome">Sobrenome:</label>
            <input value=<?php echo $row->sobrenome?> type="text" name="cliente-sobrenome" id="cliente-sobrenome" required />

            <label for="cliente-email">Email:</label>
            <input value=<?php echo $row->email?> type="email" name="cliente-email" id="cliente-email" required />

            <label for="cliente-senha">Senha:</label>
            <input value=<?php echo $row->senha?> type="password" name="cliente-senha" id='cliente-senha' required />
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
            <input value=<?php echo $row->celular?> oninput="formatarCelular(this)" type="text" name="cliente-celular" id="cliente-celular" placeholder="(11) 91234-5678" maxlength="15" minlength="15" required />

            <label for="cliente-cep">CEP:</label>
            <input value=<?php echo $row->cep?> oninput="formatarCEP(this)" type="text" name="cliente-cep" id="cliente-cep" required maxlength="9" />

            <label for="cliente-rua">Rua:</label>
            <input value=<?php echo $row2->rua?> type="text" name="cliente-rua" id="cliente-rua" required readonly maxlength="100" />

            <label for="cliente-bairro">Bairro:</label>
            <input value=<?php echo $row2->bairro?> type="text" name="cliente-bairro" id="cliente-bairro" required readonly maxlength="50" />
            
            <label for="cliente-cidade">Cidade:</label>
            <input value=<?php echo $row2->cidade?> type="text" name="cliente-cidade" id="cliente-cidade" required readonly maxlength="50" />

            <label for="cliente-estado">Estado:</label>
            <input value=<?php echo $row2->estado?> type="text" name="cliente-estado" id="cliente-estado" required readonly maxlength="2" />

            <label for="cliente-numero">Número:</label>
            <input value=<?php echo $row->numero?> type="text" name="cliente-numero" id="cliente-numero" required maxlength="100" />
            
            <label for="cliente-complemento">Complemento:</label>
            <input value=<?php echo $row->complemento?> type="text" name="cliente-complemento" id="cliente-complemento" required maxlength="100" />

            <input type="submit" value="Atualizar Cliente" class="btn-submit" />
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
        <div class="box_rodape">
            <div class="card_rodape">
                <h4>Políticas</h4>
                <span>Política de Privacidade</span>
                <span>Política de Cookies</span>
                <span>Política de Compras</span>
                <span>Política de Entregas</span>
            </div>
            
            <div class="card_rodape">
                <h4>Suporte</h4>
                <span>Central de Atendimento</span>
                <span><i class="bi bi-whatsapp"></i> WhatsApp</span>
            </div>
            
            <div class="card_rodape">
                <h4>Categorias</h4>
                <span>Ração</span>
                <span>Marcas</span>
                <span>Utensílios</span>
                <span>Planos de Saúde Pet</span>
            </div>

            <div class="card_rodape">
                <h4>Ofertas em Destaque</h4>
                <span>Antipulgas e Carrapatos</span>
                <span>Medicamentos</span>
                <span>Antibióticos</span>
            </div>

            <span class="voltar_footer"><a href="#cabecario"><i class="bi bi-arrow-bar-up"></i> Voltar ao Início</a></span>
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

    <!-- Botões de Acessibilidade -->
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