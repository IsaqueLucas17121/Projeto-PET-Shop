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
        $sql3 = "SELECT * FROM funcionarios";
        $result3 = $conn->query($sql3); 
        $sql4 = "SELECT * FROM pets";
        $result4 = $conn->query($sql4);
        $sql5 = "SELECT * FROM produtos";
        $result5 = $conn->query($sql5);

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
            background-image: url('');
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
            display: flex;
            justify-content: center;
            align-items: center;
        }
        caption button,#voltar{
            margin-left: 20px;
            border: none;
            padding: 15px;
            border-radius: 15px;
            color: #efeac5;
            background-color: #360745;
            cursor: pointer;
            transition: 0.5s ease-out;
            font-size: 17px;
        }
        th, td {
            border:1px solid black;
            border-collapse: collapse;
            text-align: center;
        }
        .box_card{
            padding: 40px 100px;
            max-width: auto;
            background: #ffffffd9;
            border-radius: 15px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.7);
            display: grid;
            position: relative;
            justify-items: center;
            margin: auto 0;
        }
        .box_card h2{
            cursor: pointer;
            transition: 0.5s ease-out;
            color: #360745;
        }
        .box_card h2:hover, caption button:hover,#voltar:hover{
            text-decoration: underline;
            scale: 1.1;
        }
        #voltar{
            position: absolute;
            right: 5%;
            top: 0;
        }

        .btn-editar {
            background-color: #4CAF50; /* Verde */
            color: white;
            border: none;
            padding: 8px 16px;
            margin-right: 5px;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-apagar {
            background-color: #f44336; /* Vermelho */
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-editar:hover {
            background-color: #45a049;
        }

        .btn-apagar:hover {
            background-color: #d32f2f;
        }

    </style>
</head>
<body>
    <div id="box_card" class="box_card">
        <h2 onclick="trocarLista(1)">Lista de Usuarios</h2>
        <h2 onclick="trocarLista(2)">Lista de Funcionarios</h2>
        <h2 onclick="trocarLista(3)">Lista de Pets</h2>
        <h2 onclick="trocarLista(4)">Lista de Produtos</h2>   
        <a href="config.php"><button id="voltar">Voltar</button></a>   
    </div>

    
    <table id="tabela1" class="desligado">  
   
        <tr>
            <caption><h1>Listar Usuarios</h1><button onclick="voltar()">Voltar</button></caption>
            <th>Nome</th>
            <th>Sobrenome</th>
            <th>Email</th>
            <th>Senha</th>
            <th>Celular</th>
            <th id='cep' onclick = 'trocarCep(1)'>Cep</th>
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
                    echo "<td><img style='height: 50px;width: 50px;' src='backend/php/usuario{$img}' alt='icone do usuario'></td>";
                    echo "<td>" . ($row->logado ? 'Logado ✅' : 'Deslogado') . "</td>";
                    echo "<td><button onclick=\"location.href='atualizar.php?cpf=".$row->cpf."';\" class='btn-editar'>Editar</button> <button onclick=\"location.href='deletarUsu.php?cpf=".$row->cpf."';\" class='btn-apagar'>Apagar</button></td>";
                    echo "</tr>";
                }
        ?>
    </table>

    <table id="tabela2" class="desligado">  
   
        <tr>
            <caption><h1>Listar Funcionarios</h1><button onclick="voltar()">Voltar</button></caption>
            <th>Nome</th>
            <th>Sobrenome</th>
            <th>CNPJ</th>
            <th>Email</th>
            <th>Senha</th>
            <th>Celular</th>
            <th id='cep' onclick='trocarCep(2)'>Cep</th>
            <th>Numero</th>
            <th>Complemento</th>
            <th>Imagem</th>
            <th>Logado/Deslogado</th>
            <th>Editar/Apagar</th>
        </tr>
        <?php
            while ($row3 = $result3->fetch_object()){

                    $imgSuja = $row3->img;

                    $img = str_replace("./img/UsuarioOFF.png/", "/img/UsuarioOFF.png", $imgSuja);

                    echo "<tr>";
                    echo "<td>{$row3->nome}</td>";
                    echo "<td>{$row3->sobrenome}</td>";
                    echo "<td>{$row3->idFuncionario}</td>";
                    echo "<td>{$row3->email}</td>";
                    echo "<td>{$row3->senha}</td>";
                    echo "<td>{$row3->telefone}</td>";
                    echo "<td>{$row3->cep}</td>";
                    echo "<td>{$row3->numero}</td>";
                    echo "<td>{$row3->complemento}</td>";
                    echo "<td><img style='height: 50px;width: 50px;' src='backend/php/vendedor{$img}' alt='icone do funcionario {$row3->nome}'></td>";
                    echo "<td>" . ($row3->logado ? 'Logado ✅' : 'Deslogado') . "</td>";
                    echo "<td><button onclick=\"location.href='atualizar.php?idFuncionario=".$row3->idFuncionario."';\" class='btn-editar'>Editar</button>
                              <button onclick=\"location.href='deletarVen.php?idFuncionario=".$row3->idFuncionario."';\" class='btn-apagar'>Apagar</button></td>";
                    echo "</tr>";
                }
        ?>
    </table>

    <table id="tabela3" class="desligado">  
   
        <tr>
            <caption><h1>Listar Pets</h1><button onclick="voltar()">Voltar</button></caption>
            <th>Id Pet</th>
            <th>Idade</th>
            <th>Nome</th>
            <th>Tipo</th>
            <th>Raça</th>
            <th>Hotel</th>
            <th>Consulta</th>
            <th>Dono</th>
            <th>Editar/Apagar</th>
        </tr>
        <?php
            while ($row4 = $result4->fetch_object()){

                $donoId = $row4->idUsuario;
                $donoQuery = "SELECT nome FROM usuarios WHERE cpf=$donoId";
                $donoResult = $conn->query($donoQuery);
                $donoNome = ($donoResult && $donoResult->num_rows > 0) ? $donoResult->fetch_object()->nome : "Desconhecido";


                    echo "<tr>";
                    echo "<td>{$row4->idPet}</td>";
                    echo "<td>{$row4->idade}</td>";
                    echo "<td>{$row4->nome}</td>";
                    echo "<td>{$row4->tipo}</td>";
                    echo "<td>{$row4->raca}</td>";
                    echo "<td>{$row4->hotel}</td>";
                    echo "<td>{$row4->consulta}</td>";
                    echo "<td>{$donoNome}</td>";
                    echo "<td><button class='btn-editar'>Editar</button> <button onclick=\"location.href='deletarPet.php?idPet=".$row4->idPet."';\" class='btn-apagar'>Apagar</button></td>";
                    echo "</tr>";
                }
        ?>
    </table>

    <table id="tabela4" class="desligado">  
   
        <tr>
            <caption><h1>Listar Produtos</h1><button onclick="voltar()">Voltar</button></caption>
            <th>Id Produto</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Preço</th>
            <th>Tipo</th>
            <th>Vendedor</th>
            <th>Imagem</th>
            <th>Editar/Apagar</th>
        </tr>
        <?php
            while ($row5 = $result5->fetch_object()){

                $vendedorId = $row5->idFuncionario;
                $vendedorQuery = "SELECT nome FROM funcionarios WHERE idFuncionario=$vendedorId";
                $vendedorResult = $conn->query($vendedorQuery);
                $vendedorNome = ($vendedorResult && $vendedorResult->num_rows > 0) ? $vendedorResult->fetch_object()->nome : "Desconhecido";

                    echo "<tr>";
                    echo "<td>{$row5->idPro}</td>";
                    echo "<td>{$row5->nome}</td>";
                    echo "<td>{$row5->descricao}</td>";
                    echo "<td>R$ {$row5->preco},00</td>";
                    echo "<td>{$row5->tipo}</td>";
                    echo "<td>$vendedorNome</td>";
                    echo "<td><img style='height: 50px;width: 50px;' src='backend/php/produto{$row5->img}' alt='Imagem do Produto'></td>";
                    echo "<td><button class='btn-editar'>Editar</button> <button class='btn-apagar'>Apagar</button></td>";
                    echo "</tr>";
                }
        ?>
    </table>

    <table id="tabelaCep" class="desligado">
        <tr>
            <th id='cep' onclick="trocarCep()" >Cep</th>
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
 function trocarLista(num) {
    for (let i = 1; i <= 4; i++) {
        document.getElementById('tabela' + i).classList.add('desligado');
    }
    document.getElementById('box_card').style.display= "none";
    document.getElementById('tabela' + num).classList.remove('desligado');
}

function voltar() {
    for (let i = 1; i <= 4; i++) {
        document.getElementById('tabela' + i).classList.add('desligado');
    }
    document.getElementById('box_card').style.display= "grid";
}

function trocarCep(num){
    if(num === 1){
        document.getElementById('tabela1').classList.add('desligado');
        document.getElementById('tabelaCep').classList.remove('desligado');
    }
    else if(num === 2){
        document.getElementById('tabela2').classList.add('desligado');
        document.getElementById('tabelaCep').classList.remove('desligado');
    }
    else{
        document.getElementById('tabela1').classList.add('desligado');
        document.getElementById('tabela1').classList.add('desligado');
        document.getElementById('tabelaCep').classList.add('desligado');
        document.getElementById('box_card').style.display= "block";
    }
}

</script>
</body>
</html>