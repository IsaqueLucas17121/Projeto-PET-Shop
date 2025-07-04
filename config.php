<?php
    
        include 'conn.php';

        session_start();

        if(!isset($_SESSION['usuarios']) && !isset($_SESSION['vendedores'])){
            echo "<script>location.href='index.html';</script>";
        }
        
        if(isset($_SESSION['usuarios'])){
            $trocarImg = "attImagemUsu.php";
            $nomePagi = "Usuario";
        }
        else if(isset($_SESSION['vendedores'])){
            $trocarImg = "attImagemVen.php";
            $nomePagi = "Vendedores";
        }

    ?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar dados - Nome da loja</title>
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
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f0f0;
            color: #333;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            padding: 30px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .dark-mode .container{
            background-color: #333;
            color: #f0f0f0;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #d36600;
        }

        .tabs {
            display: flex;
            justify-content: space-around;
            background-color: #d36600;
            padding: 10px;
            border-radius: 10px 10px 0 0;
            color: white;
        }

        .tabs div {
            cursor: pointer;
            padding: 10px;
            transition: background-color 0.3s ease;
        }

        .tabs div:hover {
            background-color: #e88327;
        }

        .tabs div.active {
            background-color: #e88327;
            font-weight: bold;
        }

        .content {
            padding: 20px;
            display: none;
        }

        .content.active {
            display: block;
        }

        .form-group {
            margin-bottom: 20px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="file"] {
            width: 100%;
            padding: 10px;
            font-size: 1rem;
            border: 1px solid #ccc;
            border-radius: 5px;
            outline: none;
            margin: 5px 0;
        }

        input[type="file"] {
            padding: 5px;
        }

        button {
            padding: 10px 20px;
            background-color: #d36600;
            border: none;
            color: white;
            cursor: pointer;
            border-radius: 5px;
        }

        button:hover {
            background-color: #e88327;
        }

        .profile-pic {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 10px;
        }

        /* Estilos para o modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: #fff;
            margin: 15% auto;
            padding: 20px;
            border-radius: 10px;
            width: 80%;
            max-width: 400px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            font-family: Arial, sans-serif;
            margin-top: 20px;
        }

        .dark-mode table *{
            background-color: #333;
            color: #f0f0f0;
        }

        th, td {
            padding: 12px 15px;
            border: 1px solid #ccc;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }
        .dark-mode th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .dark-mode td:nth-child(even) {
            background-color: #626262;
        }

        .btn-editar,
        .btn-apagar {
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 13px;
            margin-right: 5px;
            transition: 0.3s ease;
        }

        .btn-editar {
            background-color: #2196F3;
            color: white;
        }
        .dark-mode .btn-editar {
            background-color: #2196F3;
            color: white;
        }

        .btn-editar:hover {
            background-color: #1976D2;
        }
        .dark-mode .btn-editar:hover {
            background-color: #1976D2;
        }

        .btn-apagar {
            background-color: #f44336;
            color: white;
        }
        .dark-mode .btn-apagar {
            background-color: #f44336;
            color: white;
        }

        .btn-apagar:hover {
            background-color: #d32f2f;
        }
        .dark-mode .btn-apagar:hover {
            background-color: #d32f2f;
        }
        
</style>

</head>

<body>

    <div class="container">
        <h1>Configurações do <?php echo $nomePagi ?></h1>

        <div class="tabs">
            <div id="tabName" class="active">Atualizar Dados</div>
            <div id="tabProfilePicture">Mudar Foto de Perfil</div>
            <div id="tabMasterProfile" style="<?php if(isset($_SESSION['usuarios'])) echo 'display: none;'; ?>">Perfil Master</div>
            <div id="tabCadastroPet" style="<?php if(isset($_SESSION['vendedores'])) echo 'display: none;'; ?>" >Cadastrar Pet</div>
            <div id="logout">Sair da Conta</div>
            <div onclick="voltar()" id="tabVoltar">Voltar</div>
        </div>

        <div id="contentName" class="content active">
            <h3>Atualizar Dados</h3>
            <form action="atualizar.php" method="post">
                <button>Atualizar</button>
            </form>
        </div>

        <form action="<?php echo $trocarImg ?>" method="post" enctype="multipart/form-data">
            <div id="contentProfilePicture" class="content">
                <h3>Mudar Foto de Perfil</h3>
                <div class="form-group">
                    <img src="backend/php/usuario/img/UsuarioOFF.png" id="profilePic" name="profilePic" class="profile-pic" alt="Foto de perfil">
                    <input type="file" name="icone" id="icone" accept="image/*">
                </div>
                <button onclick="changeProfilePicture()">Salvar</button>
            </div>
        </form>

        <div id="contentCadastrarPet" class="content">
            <h3>Cadastre seu Pet</h3>
            <button onclick="location.href='cadastroPet.php'">Entrar</button>

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
                        echo "<th>Editar/Apagar</th>";
                        echo "</tr>";

                        while($row = $res->fetch_object()){
                            echo "<tr>";
                            echo "<td>{$row->nome}</td>";
                            echo "<td>{$row->idade}</td>";
                            echo "<td>{$row->tipo}</td>";
                            echo "<td>{$row->raca}</td>";
                            echo "<td><button class='btn-editar'>Editar</button> <button onclick=\"location.href='deletarPet.php?idPet=".$row->idPet."';\"  class='btn-apagar'>Apagar</button></td>";
                            echo "</tr>";
                        } 

                        echo "</table>";
                    }else{
                        exit;
                    }
                }
                    
                ?>
        </div>

        <div id="contentMasterProfile" class="content">
            <h3>Entrar com Perfil Master</h3>
            <button onclick="openLoginModal()">Entrar</button>
        </div>

        <div id="contentLogout" class="content">
            <h3>Sair da Conta</h3>
            <form action="logout.php" method="post">
                <button type="submit">Deslogar</button>
            </form>
        </div>
    </div>

    <!-- Modal para o login -->
    <div id="loginModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeLoginModal()">&times;</span>
            <h2>Login do Perfil Master</h2>
            <form action="confirmMaster.php" method="post">
                <div class="form-group">
                    <label for="masterUsername">Email</label>
                    <input required name="masterUsername" type="text" id="masterUsername" placeholder="Digite o email">
                </div>
                <div class="form-group">
                    <label for="masterPassword">Senha</label>
                    <input required name="masterPassword" type="password" id="masterPassword" placeholder="Digite a senha">
                </div>
                <button>Entrar</button>
            </form>
            
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

        function voltar(){
            window.location.href = 'index.php';
        }

        // Função para exibir o conteúdo da aba ativa
        const tabToContentMap = {
            tabName: 'contentName',
            tabProfilePicture: 'contentProfilePicture',
            tabMasterProfile: 'contentMasterProfile',
            tabCadastroPet: 'contentCadastrarPet',
            logout: 'contentLogout'
        };

        function switchTab(tabId) {
            document.querySelectorAll('.tabs div').forEach(tab => tab.classList.remove('active'));
            document.querySelectorAll('.content').forEach(content => content.classList.remove('active'));

            document.getElementById(tabId).classList.add('active');
            const contentId = tabToContentMap[tabId];
            if (contentId) {
                document.getElementById(contentId).classList.add('active');
            }
        }


        document.getElementById('icone').addEventListener('change', function(event) {
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
                profilePic.style.display = 'none';
                alert('Por favor, selecione um arquivo de imagem válido.');
            }
        });

        function changeProfilePicture(){
            let img = document.getElementById("profilePic");
        }

        // Função para abrir o modal de login
        function openLoginModal() {
            document.getElementById('loginModal').style.display = 'block';
        }

        // Função para fechar o modal de login
        function closeLoginModal() {
            document.getElementById('loginModal').style.display = 'none';
        }

        // Adicionar evento de clique às abas
        document.getElementById('tabName').addEventListener('click', function () { switchTab('tabName'); });
        document.getElementById('tabProfilePicture').addEventListener('click', function () { switchTab('tabProfilePicture'); });
        document.getElementById('tabMasterProfile').addEventListener('click', function () { switchTab('tabMasterProfile'); });
        document.getElementById('tabCadastroPet').addEventListener('click', function () { switchTab('tabCadastroPet'); });
        document.getElementById('logout').addEventListener('click', function () { switchTab('logout'); });
    </script>
</body>

</html>
