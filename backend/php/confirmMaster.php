<?php 

include 'conn.php';

$email = $_POST['masterUsername'];
$senha = $_POST['masterPassword'];


$stmt = $conn->prepare("SELECT * FROM funcionarios WHERE funcao = 'Master' AND email = ? AND senha = ?");
$stmt->bind_param("ss", $email, $senha);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
        echo "<script>alert('Login bem-sucedido')</script>";
        $sql = "SELECT * FROM usuarios";
        $result = $conn->query($sql);
        $sql2 = "SELECT * FROM enderecos";
        $result2 = $conn->query($sql2);

} else {
    echo "<script>alert('Email ou Senha errados')</script>";
    echo "<script>location.href='config.php';</script>";
}


?>

<!DOCTYPE html>
<html lang="br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabela do Banco - Nome do Site</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- Favicon -->
    <link rel="shortcut icon" href="../../frontend/src/assets/Foto site.png" type="image/x-icon">

    <style>
        body{
            background-image: url('https://institutomix.com.br/wp-content/uploads/2019/04/petshop-1.png');
            background-size: cover;
            background-position: center;
            background-color: whitesmoke;
            font-family: "Poppins", sans-serif;  
            font-size: 1rem;
            font-weight: 400;
            justify-items: center;
        }
        .desligado{
            display: none;
        }
        #cep{
            cursor: pointer;
            color: blue;
            text-decoration: underline;
        }
        table{
            padding: 30px 100px;
            max-width: auto;
            background: #ffffffd9;
            border-radius: 15px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.7);
            display: grid;
            justify-content: center;
            align-items: center;
            position: relative;
        }
        caption{
            text-align: center;
            color: black;
        }
        th, td {
            border:1px solid black;
            border-collapse: collapse;
            text-align: center;
        }

    </style>
</head>
<body>
    <table id="tabelaUsuario">
        

        <tr>
            <caption><h1>Listar Usuarios</h1></caption>
            <th>Nome</th>
            <th>Sobrenome</th>
            <th>Email</th>
            <th>Senha</th>
            <th>Celular</th>
            <th id='cep' onclick = 'trocarCep()'>Cep</th>
            <th>Numero</th>
            <th>Complemento</th>
            <th>Imagem</th>
            <th>Logado/Deslogado</th>
            <th>Editar/Apagar</th>
        </tr>
        <?php
            while ($row = $result->fetch_object()){

                    $imgSuja = $row->img;

                    $img = str_replace("./img/UsuarioOFF.png/", "/img/UsuarioOFF.png", $imgSuja);

                    echo "<tr>";
                    echo "<td>{$row->nome}</td>";
                    echo "<td>{$row->sobrenome}</td>";
                    echo "<td>{$row->email}</td>";
                    echo "<td>{$row->senha}</td>";
                    echo "<td>{$row->celular}</td>";
                    echo "<td>{$row->cep}</td>";
                    echo "<td>{$row->numero}</td>";
                    echo "<td>{$row->complemento}</td>";
                    echo "<td><img src=/usuario{$img} alt='icone do usuario'></td>";
                    echo "<td>" . ($row->logado ? 'Logado' : 'Deslogado') . "</td>";
                    echo "<td><button>Editar</button> <button>Apagar</button></td>";
                    echo "</tr>";
                }
        ?>
    </table>

    <table id="tabelaCep" class="desligado">
        <tr>
            <th  id='cep' onclick="trocarCep()" >Cep</th>
            <th>Rua</th>
            <th>Bairro</th>
            <th>Cidade</th>
            <th>Estado</th>
        </tr>
            <?php
                
                while ($row2 = $result2->fetch_object()) {
                        echo "<tr>";
                        echo "<td>{$row2->cep}</td>";
                        echo "<td>{$row2->rua}</td>";
                        echo "<td>{$row2->bairro}</td>";
                        echo "<td>{$row2->cidade}</td>";
                        echo "<td>{$row2->estado}</td>";
                        echo"</tr>";
                        }
                
            ?>
    </table>

    <script>
        function trocarCep(){
            usuario = document.getElementById('tabelaUsuario');
            cep = document.getElementById('tabelaCep');

            usuario.classList.toggle('desligado');
            cep.classList.toggle('desligado');
        }
    </script>
</body>
</html>