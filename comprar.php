<?php

include "conn.php";

session_start();

if(isset($_SESSION["usuarios"])){
    $chave = $_SESSION["usuarios"]->cpf;
    $sql = "SELECT * FROM usuarios WHERE cpf = ".$chave;

    $res = $conn->query($sql);
    $row = $res->fetch_object();

    $sql2 = "SELECT * FROM produtos WHERE idPro=" .$_REQUEST["idPro"];

    $res2 = $conn->query($sql2);
    $row2 = $res2->fetch_object();
}
else{
    echo "<script>location.href=\'index.html\';</script>";
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $row2->nome?> - Loja Online</title>
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
    <script src="frontend/src/js/comprar.js" defer></script>

</head>
<body style="margin-top: 60px;">
    <header>
    <div class="logo">
        <img src="frontend/src/assets/Foto site.png" alt="Logo PetShop">
        <h1>PetShop Amor & Cuidado</h1>
    </div>

    <button class="menu-toggle" id="menu-toggle" aria-label="Abrir menu">
        <span class="hamburger-line"></span>
        <span class="hamburger-line"></span>
        <span class="hamburger-line"></span>
    </button>

    <nav class="nav-menu" id="nav-menu">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="lojaUsu.php">Loja</a></li>
            <li class="dropdown">
                <a href="#" onclick="toggleDropdown()" style="cursor: pointer;">Serviços</a>
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
        <img src="<?php echo $row->img?>" alt="Imagem do usuario">
        <h1>Configurações</h1>
        </div>
    </a>

</header>
    <!-- Main Product Section -->
    <main class="main-content">
        <div class="container">
            <div class="product-section">
                <!-- Product Gallery -->
                <div class="product-gallery">
                    <div class="main-image">
                        <img src="https://via.placeholder.com/500x500/4a90e2/ffffff?text=Galaxy+Pro+Max" alt="Galaxy Pro Max" id="mainProductImage">
                        <div class="image-badges">
                            <span class="badge new">Novo</span>
                            <span class="badge discount">-20%</span>
                        </div>
                        <button class="zoom-btn">
                            <i class="fas fa-search-plus"></i>
                        </button>
                    </div>
                    <div class="thumbnail-gallery">
                        <div class="thumbnail active">
                            <img src="https://via.placeholder.com/100x100/4a90e2/ffffff?text=Frente" alt="Frente">
                        </div>
                        <div class="thumbnail">
                            <img src="https://via.placeholder.com/100x100/2c3e50/ffffff?text=Tras" alt="Traseira">
                        </div>
                        <div class="thumbnail">
                            <img src="https://via.placeholder.com/100x100/e74c3c/ffffff?text=Lateral" alt="Lateral">
                        </div>
                        <div class="thumbnail">
                            <img src="https://via.placeholder.com/100x100/27ae60/ffffff?text=Tela" alt="Tela">
                        </div>
                        <div class="thumbnail">
                            <img src="https://via.placeholder.com/100x100/f39c12/ffffff?text=Camera" alt="Câmera">
                        </div>
                    </div>
                </div>

                <!-- Product Info -->
                <div class="product-info">
                    <div class="product-header">
                        <h1 class="product-title"><?php echo $row2->nome?></h1>
                        <div class="product-rating">
                            <div class="stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <span class="rating-text">4.5 (2.847 avaliações)</span>
                        </div>
                        <p class="product-brand">Marca: <strong><?php echo $row2->nome?></strong></p>
                    </div>

                    <div class="product-pricing">
                        <div class="price-section">
                            <span class="old-price">R$ 2.499,00</span>
                            <span class="current-price">R$ <?php echo $row2->preco?>,00</span>
                            <span class="discount-percent">20% OFF</span>
                        </div>
                        <div class="payment-options">
                            <p class="installment">ou 12x de <strong>R$ 166,58</strong> sem juros</p>
                            <p class="pix-discount">R$ 1.899,00 à vista no PIX (5% desconto)</p>
                        </div>
                    </div>

                    <div class="product-variants">
                        <div class="variant-group">
                            <label class="variant-label">Cor:</label>
                            <div class="color-options">
                                <button class="color-option active" data-color="azul" style="background-color: #4a90e2;"></button>
                                <button class="color-option" data-color="preto" style="background-color: #2c3e50;"></button>
                                <button class="color-option" data-color="branco" style="background-color: #ecf0f1;"></button>
                                <button class="color-option" data-color="rosa" style="background-color: #e91e63;"></button>
                            </div>
                        </div>
                        <div class="variant-group">
                            <label class="variant-label">Armazenamento:</label>
                            <div class="storage-options">
                                <button class="storage-option">128GB</button>
                                <button class="storage-option active">256GB</button>
                                <button class="storage-option">512GB</button>
                            </div>
                        </div>
                    </div>

                    <div class="quantity-section">
                        <label class="quantity-label">Quantidade:</label>
                        <div class="quantity-controls">
                            <button class="quantity-btn minus">-</button>
                            <input type="number" class="quantity-input" value="1" min="1" max="10">
                            <button class="quantity-btn plus">+</button>
                        </div>
                        <span class="stock-info">
                            <i class="fas fa-check-circle"></i>
                            Em estoque (47 unidades)
                        </span>
                    </div>

                    <div class="action-buttons">
                        <button class="btn btn-primary add-to-cart">
                            <i class="fas fa-shopping-cart"></i>
                            Adicionar ao Carrinho
                        </button>
                        <button class="btn btn-secondary buy-now">
                            <i class="fas fa-bolt"></i>
                            Comprar Agora
                        </button>
                        <button class="btn btn-outline wishlist">
                            <i class="far fa-heart"></i>
                        </button>
                    </div>

                    <div class="shipping-info">
                        <h3>Informações de Entrega</h3>
                        <div class="shipping-calculator">
                            <input type="text" placeholder="Digite seu CEP" class="cep-input">
                            <button class="calculate-btn">Calcular</button>
                        </div>
                        <div class="shipping-options">
                            <div class="shipping-option">
                                <i class="fas fa-truck"></i>
                                <div>
                                    <strong>Entrega Padrão</strong>
                                    <p>5-7 dias úteis - Grátis</p>
                                </div>
                            </div>
                            <div class="shipping-option">
                                <i class="fas fa-shipping-fast"></i>
                                <div>
                                    <strong>Entrega Expressa</strong>
                                    <p>1-2 dias úteis - R$ 19,90</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="product-guarantees">
                        <div class="guarantee-item">
                            <i class="fas fa-shield-alt"></i>
                            <span>Garantia de 1 ano</span>
                        </div>
                        <div class="guarantee-item">
                            <i class="fas fa-undo"></i>
                            <span>7 dias para troca</span>
                        </div>
                        <div class="guarantee-item">
                            <i class="fas fa-lock"></i>
                            <span>Compra segura</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Details Tabs -->
            <div class="product-details">
                <div class="tabs">
                    <button class="tab-btn active" data-tab="description">Descrição</button>
                    <button class="tab-btn" data-tab="specifications">Especificações</button>
                    <button class="tab-btn" data-tab="reviews">Avaliações (2.847)</button>
                    <button class="tab-btn" data-tab="questions">Perguntas</button>
                </div>

                <div class="tab-content">
                    <div class="tab-panel active" id="description">
                        <h3>Descrição do Produto</h3>
                        <p>O Galaxy Pro Max representa o que há de mais avançado em tecnologia mobile. Com design premium e recursos inovadores, este smartphone oferece uma experiência única para usuários exigentes.</p>
                        
                        <h4>Principais Características:</h4>
                        <ul>
                            <li><strong>Tela Super AMOLED 6.7"</strong> - Resolução 4K com cores vibrantes e brilho excepcional</li>
                            <li><strong>Câmera Tripla 108MP</strong> - Sistema avançado com IA para fotos profissionais</li>
                            <li><strong>Processador Octa-Core</strong> - Performance superior para jogos e multitarefas</li>
                            <li><strong>Bateria 5000mAh</strong> - Carregamento rápido 65W e wireless 15W</li>
                            <li><strong>Resistência IP68</strong> - Proteção contra água e poeira</li>
                            <li><strong>5G Ready</strong> - Conectividade de última geração</li>
                        </ul>

                        <p>Ideal para profissionais, criadores de conteúdo e entusiastas da tecnologia que buscam o melhor em performance e qualidade.</p>
                    </div>

                    <div class="tab-panel" id="specifications">
                        <h3>Especificações Técnicas</h3>
                        <div class="specs-grid">
                            <div class="spec-group">
                                <h4>Display</h4>
                                <ul>
                                    <li>Tamanho: 6.7 polegadas</li>
                                    <li>Tipo: Super AMOLED</li>
                                    <li>Resolução: 3200 x 1440 pixels</li>
                                    <li>Taxa de atualização: 120Hz</li>
                                    <li>Proteção: Gorilla Glass Victus</li>
                                </ul>
                            </div>
                            <div class="spec-group">
                                <h4>Performance</h4>
                                <ul>
                                    <li>Processador: Snapdragon 8 Gen 2</li>
                                    <li>RAM: 12GB LPDDR5</li>
                                    <li>Armazenamento: 256GB UFS 3.1</li>
                                    <li>GPU: Adreno 740</li>
                                </ul>
                            </div>
                            <div class="spec-group">
                                <h4>Câmeras</h4>
                                <ul>
                                    <li>Principal: 108MP f/1.8</li>
                                    <li>Ultra-wide: 12MP f/2.2</li>
                                    <li>Telefoto: 10MP f/2.4</li>
                                    <li>Frontal: 40MP f/2.2</li>
                                    <li>Vídeo: 8K@30fps, 4K@60fps</li>
                                </ul>
                            </div>
                            <div class="spec-group">
                                <h4>Conectividade</h4>
                                <ul>
                                    <li>5G: Sub-6GHz e mmWave</li>
                                    <li>Wi-Fi: 6E (802.11ax)</li>
                                    <li>Bluetooth: 5.3</li>
                                    <li>NFC: Sim</li>
                                    <li>USB: Type-C 3.2</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="tab-panel" id="reviews">
                        <h3>Avaliações dos Clientes</h3>
                        <div class="reviews-summary">
                            <div class="rating-overview">
                                <div class="overall-rating">
                                    <span class="rating-number">4.5</span>
                                    <div class="stars">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                    <p>2.847 avaliações</p>
                                </div>
                                <div class="rating-breakdown">
                                    <div class="rating-bar">
                                        <span>5 estrelas</span>
                                        <div class="bar"><div class="fill" style="width: 80%;"></div></div>
                                        <span>80%</span>
                                    </div>
                                    <div class="rating-bar">
                                        <span>4 estrelas</span>
                                        <div class="bar"><div class="fill" style="width: 10%;"></div></div>
                                        <span>10%</span>
                                    </div>
                                    <div class="rating-bar">
                                        <span>3 estrelas</span>
                                        <div class="bar"><div class="fill" style="width: 5%;"></div></div>
                                        <span>5%</span>
                                    </div>
                                    <div class="rating-bar">
                                        <span>2 estrelas</span>
                                        <div class="bar"><div class="fill" style="width: 3%;"></div></div>
                                        <span>3%</span>
                                    </div>
                                    <div class="rating-bar">
                                        <span>1 estrela</span>
                                        <div class="bar"><div class="fill" style="width: 2%;"></div></div>
                                        <span>2%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="reviews-list">
                            <div class="review-item">
                                <div class="review-header">
                                    <div class="reviewer-info">
                                        <img src="https://via.placeholder.com/40x40" alt="Avatar" class="reviewer-avatar">
                                        <div>
                                            <strong>João Silva</strong>
                                            <div class="stars">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="review-date">15 de Junho, 2025</span>
                                </div>
                                <p class="review-text">"Produto excelente! A qualidade da tela é incrível e a câmera tira fotos espetaculares. Superou minhas expectativas."</p>
                                <button class="helpful-btn"><i class="far fa-thumbs-up"></i> Útil (12)</button>
                            </div>
                            <div class="review-item">
                                <div class="review-header">
                                    <div class="reviewer-info">
                                        <img src="https://via.placeholder.com/40x40" alt="Avatar" class="reviewer-avatar">
                                        <div>
                                            <strong>Maria Oliveira</strong>
                                            <div class="stars">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="far fa-star"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="review-date">10 de Junho, 2025</span>
                                </div>
                                <p class="review-text">"Muito bom, mas a bateria poderia durar um pouco mais. No geral, estou satisfeita com a compra."</p>
                                <button class="helpful-btn"><i class="far fa-thumbs-up"></i> Útil (5)</button>
                            </div>
                        </div>
                    </div>

                    <div class="tab-panel" id="questions">
                        <h3>Perguntas e Respostas</h3>
                        <div class="question-form">
                            <h4>Faça sua pergunta:</h4>
                            <textarea placeholder="Digite sua pergunta aqui..."></textarea>
                            <button class="btn btn-primary">Enviar Pergunta</button>
                        </div>
                        <div class="questions-list">
                            <div class="question-item">
                                <p class="question"><strong>P:</strong> Ele vem com fone de ouvido na caixa?</p>
                                <p class="answer"><strong>R:</strong> Não, este modelo não inclui fones de ouvido na caixa.</p>
                                <div class="question-meta">
                                    <span>Por: Usuário Anônimo</span>
                                    <span>Data: 18 de Junho, 2025</span>
                                </div>
                            </div>
                            <div class="question-item">
                                <p class="question"><strong>P:</strong> A tela é curva?</p>
                                <p class="answer"><strong>R:</strong> Sim, a tela do Galaxy Pro Max possui bordas levemente curvas.</p>
                                <div class="question-meta">
                                    <span>Por: Suporte da Loja</span>
                                    <span>Data: 16 de Junho, 2025</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Related Products Section -->
            <div class="related-products">
                <h2>Produtos Relacionados</h2>
                <div class="products-grid">
                    <div class="product-card">
                        <img src="https://via.placeholder.com/200x200/4a90e2/ffffff?text=Produto+1" alt="Produto Relacionado 1">
                        <h3>Smartwatch X1</h3>
                        <p class="price">R$ 799,00</p>
                        <button class="btn btn-primary">Ver Detalhes</button>
                    </div>
                    <div class="product-card">
                        <img src="https://via.placeholder.com/200x200/2c3e50/ffffff?text=Produto+2" alt="Produto Relacionado 2">
                        <h3>Fone Bluetooth Pro</h3>
                        <p class="price">R$ 299,00</p>
                        <button class="btn btn-primary">Ver Detalhes</button>
                    </div>
                    <div class="product-card">
                        <img src="https://via.placeholder.com/200x200/e74c3c/ffffff?text=Produto+3" alt="Produto Relacionado 3">
                        <h3>Tablet Ultra</h3>
                        <p class="price">R$ 1.599,00</p>
                        <button class="btn btn-primary">Ver Detalhes</button>
                    </div>
                    <div class="product-card">
                        <img src="https://via.placeholder.com/200x200/27ae60/ffffff?text=Produto+4" alt="Produto Relacionado 4">
                        <h3>Câmera Esportiva 4K</h3>
                        <p class="price">R$ 999,00</p>
                        <button class="btn btn-primary">Ver Detalhes</button>
                    </div>
                </div>
            </div>
        </div>
    </main>

<footer>
  <div class="footer-section">
    <div class="column">
      <h3>Políticas</h3>
      <button onclick="openModal(\'Política de Privacidade\', \'privacidade\')">Política de Privacidade</button>
      <button onclick="openModal(\'Política de Cookies\', \'cookies\')">Política de Cookies</button>
      <button onclick="openModal(\'Política de Compras\', \'compras\')">Política de Compras</button>
      <button onclick="openModal(\'Política de Entregas\', \'entregas\')">Política de Entregas</button>
    </div>

    <div class="column">
      <h3>Suporte</h3>
      <button onclick="openModal(\'Central de Atendimento\', \'atendimento\')">Central de Atendimento</button>
      <button onclick="openModal(\'WhatsApp\', \'whatsapp\')">WhatsApp</button>
    </div>

    <div class="column">
      <h3>Categorias</h3>
      <button onclick="openModal(\'Ração\', \'racao\')">Ração</button>
      <button onclick="openModal(\'Marcas\', \'marcas\')">Marcas</button>
      <button onclick="openModal(\'Utensílios\', \'utensilios\')">Utensílios</button>
      <button onclick="openModal(\'Planos de Saúde Pet\', \'planos\')">Planos de Saúde Pet</button>
    </div>

    <div class="column">
      <h3>Ofertas em Destaque</h3>
      <button onclick="openModal(\'Antipulgas e Carrapatos\', \'antipulgas\')">Antipulgas e Carrapatos</button>
      <button onclick="openModal(\'Medicamentos\', \'medicamentos\')">Medicamentos</button>
      <button onclick="openModal(\'Antibióticos\', \'antibioticos\')">Antibióticos</button>
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
      new window.VLibras.Widget(\'https://vlibras.gov.br/app\');
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

