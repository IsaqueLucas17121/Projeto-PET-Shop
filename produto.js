// JavaScript para interatividade da página de produto

document.addEventListener('DOMContentLoaded', function() {
    
    // ===== GALERIA DE IMAGENS =====
    const thumbnails = document.querySelectorAll('.thumbnail');
    const mainImage = document.getElementById('mainProductImage');
    
    thumbnails.forEach(thumbnail => {
        thumbnail.addEventListener('click', function() {
            // Remove active class de todas as thumbnails
            thumbnails.forEach(t => t.classList.remove('active'));
            
            // Adiciona active class na thumbnail clicada
            this.classList.add('active');
            
            // Troca a imagem principal
            const newImageSrc = this.querySelector('img').src.replace('100x100', '500x500');
            mainImage.src = newImageSrc;
        });
    });
    
    // ===== TABS =====
    const tabButtons = document.querySelectorAll('.tab-btn');
    const tabPanels = document.querySelectorAll('.tab-panel');
    
    tabButtons.forEach(button => {
        button.addEventListener('click', function() {
            const targetTab = this.getAttribute('data-tab');
            
            // Remove active class de todos os botões e painéis
            tabButtons.forEach(btn => btn.classList.remove('active'));
            tabPanels.forEach(panel => panel.classList.remove('active'));
            
            // Adiciona active class no botão clicado e painel correspondente
            this.classList.add('active');
            document.getElementById(targetTab).classList.add('active');
        });
    });
    
    // ===== SELEÇÃO DE CORES =====
    const colorOptions = document.querySelectorAll('.color-option');
    
    colorOptions.forEach(option => {
        option.addEventListener('click', function() {
            colorOptions.forEach(opt => opt.classList.remove('active'));
            this.classList.add('active');
            
            // Aqui você pode adicionar lógica para trocar a imagem baseada na cor
            const color = this.getAttribute('data-color');
            console.log('Cor selecionada:', color);
        });
    });
    
    // ===== SELEÇÃO DE ARMAZENAMENTO =====
    const storageOptions = document.querySelectorAll('.storage-option');
    
    storageOptions.forEach(option => {
        option.addEventListener('click', function() {
            storageOptions.forEach(opt => opt.classList.remove('active'));
            this.classList.add('active');
            
            // Aqui você pode adicionar lógica para atualizar o preço baseado no armazenamento
            const storage = this.textContent;
            console.log('Armazenamento selecionado:', storage);
        });
    });
    
    // ===== CONTROLES DE QUANTIDADE =====
    const quantityInput = document.querySelector('.quantity-input');
    const minusBtn = document.querySelector('.quantity-btn.minus');
    const plusBtn = document.querySelector('.quantity-btn.plus');
    
    minusBtn.addEventListener('click', function() {
        let currentValue = parseInt(quantityInput.value);
        if (currentValue > 1) {
            quantityInput.value = currentValue - 1;
        }
    });
    
    plusBtn.addEventListener('click', function() {
        let currentValue = parseInt(quantityInput.value);
        const maxValue = parseInt(quantityInput.getAttribute('max'));
        if (currentValue < maxValue) {
            quantityInput.value = currentValue + 1;
        }
    });
    
    // ===== BOTÃO ADICIONAR AO CARRINHO =====
    const addToCartBtn = document.querySelector('.add-to-cart');
    
    addToCartBtn.addEventListener('click', function() {
        // Adiciona animação de loading
        this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Adicionando...';
        this.disabled = true;
        
        // Simula adição ao carrinho
        setTimeout(() => {
            this.innerHTML = '<i class="fas fa-check"></i> Adicionado!';
            this.style.background = '#28a745';
            
            // Volta ao estado normal após 2 segundos
            setTimeout(() => {
                this.innerHTML = '<i class="fas fa-shopping-cart"></i> Adicionar ao Carrinho';
                this.style.background = '';
                this.disabled = false;
            }, 2000);
        }, 1500);
    });
    
    // ===== BOTÃO COMPRAR AGORA =====
    const buyNowBtn = document.querySelector('.buy-now');
    
    buyNowBtn.addEventListener('click', function() {
        alert('Redirecionando para o checkout...');
    });
    
    // ===== BOTÃO WISHLIST =====
    const wishlistBtn = document.querySelector('.wishlist');
    
    wishlistBtn.addEventListener('click', function() {
        const icon = this.querySelector('i');
        
        if (icon.classList.contains('far')) {
            icon.classList.remove('far');
            icon.classList.add('fas');
            this.style.color = '#dc3545';
            this.title = 'Remover da lista de desejos';
        } else {
            icon.classList.remove('fas');
            icon.classList.add('far');
            this.style.color = '';
            this.title = 'Adicionar à lista de desejos';
        }
    });
    
    // ===== CALCULADORA DE CEP =====
    const cepInput = document.querySelector('.cep-input');
    const calculateBtn = document.querySelector('.calculate-btn');
    
    calculateBtn.addEventListener('click', function() {
        const cep = cepInput.value.replace(/\D/g, '');
        
        if (cep.length !== 8) {
            alert('Por favor, digite um CEP válido com 8 dígitos.');
            return;
        }
        
        // Simula consulta de CEP
        this.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
        this.disabled = true;
        
        setTimeout(() => {
            alert(`Frete calculado para o CEP ${cep}:\n\nEntrega Padrão: Grátis (5-7 dias)\nEntrega Expressa: R$ 19,90 (1-2 dias)`);
            this.innerHTML = 'Calcular';
            this.disabled = false;
        }, 2000);
    });
    
    // ===== FORMATAÇÃO DO CEP =====
    cepInput.addEventListener('input', function() {
        let value = this.value.replace(/\D/g, '');
        value = value.replace(/(\d{5})(\d)/, '$1-$2');
        this.value = value;
    });
    
    // ===== BOTÕES ÚTIL NAS AVALIAÇÕES =====
    const helpfulBtns = document.querySelectorAll('.helpful-btn');
    
    helpfulBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const currentText = this.textContent;
            const currentCount = parseInt(currentText.match(/\d+/)[0]);
            const newCount = currentCount + 1;
            
            this.innerHTML = `<i class="fas fa-thumbs-up"></i> Útil (${newCount})`;
            this.style.color = '#667eea';
            this.disabled = true;
        });
    });
    
    // ===== SMOOTH SCROLL PARA SEÇÕES =====
    const breadcrumbLinks = document.querySelectorAll('.breadcrumb-link');
    
    breadcrumbLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            // Aqui você pode adicionar navegação suave se necessário
        });
    });
    
    // ===== ANIMAÇÃO DE ENTRADA =====
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);
    
    // Observa elementos para animação
    const animatedElements = document.querySelectorAll('.product-section, .product-details, .related-products');
    animatedElements.forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(el);
    });
    
    // ===== NEWSLETTER =====
    const newsletterForm = document.querySelector('.newsletter');
    
    if (newsletterForm) {
        const newsletterBtn = newsletterForm.querySelector('.btn');
        const newsletterInput = newsletterForm.querySelector('input');
        
        newsletterBtn.addEventListener('click', function(e) {
            e.preventDefault();
            const email = newsletterInput.value;
            
            if (!email || !email.includes('@')) {
                alert('Por favor, digite um e-mail válido.');
                return;
            }
            
            this.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
            this.disabled = true;
            
            setTimeout(() => {
                alert('E-mail cadastrado com sucesso! Você receberá nossas ofertas exclusivas.');
                newsletterInput.value = '';
                this.innerHTML = 'Inscrever';
                this.disabled = false;
            }, 1500);
        });
    }
    
    // ===== ZOOM DA IMAGEM =====
    const zoomBtn = document.querySelector('.zoom-btn');
    
    if (zoomBtn) {
        zoomBtn.addEventListener('click', function() {
            const mainImageSrc = mainImage.src;
            
            // Cria modal para zoom
            const modal = document.createElement('div');
            modal.style.cssText = `
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.9);
                display: flex;
                align-items: center;
                justify-content: center;
                z-index: 9999;
                cursor: zoom-out;
            `;
            
            const zoomedImage = document.createElement('img');
            zoomedImage.src = mainImageSrc;
            zoomedImage.style.cssText = `
                max-width: 90%;
                max-height: 90%;
                object-fit: contain;
            `;
            
            modal.appendChild(zoomedImage);
            document.body.appendChild(modal);
            
            // Fecha o modal ao clicar
            modal.addEventListener('click', function() {
                document.body.removeChild(modal);
            });
        });
    }
    
    // ===== CONTADOR DO CARRINHO =====
    function updateCartCount() {
        const cartCount = document.querySelector('.cart-count');
        if (cartCount) {
            let currentCount = parseInt(cartCount.textContent);
            cartCount.textContent = currentCount + 1;
            
            // Animação do contador
            cartCount.style.transform = 'scale(1.3)';
            setTimeout(() => {
                cartCount.style.transform = 'scale(1)';
            }, 200);
        }
    }
    
    // ===== VALIDAÇÃO DE FORMULÁRIOS =====
    const questionForm = document.querySelector('.question-form');
    
    if (questionForm) {
        const textarea = questionForm.querySelector('textarea');
        const submitBtn = questionForm.querySelector('.btn');
        
        submitBtn.addEventListener('click', function(e) {
            e.preventDefault();
            
            if (!textarea.value.trim()) {
                alert('Por favor, digite sua pergunta.');
                textarea.focus();
                return;
            }
            
            this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Enviando...';
            this.disabled = true;
            
            setTimeout(() => {
                alert('Pergunta enviada com sucesso! Responderemos em breve.');
                textarea.value = '';
                this.innerHTML = 'Enviar Pergunta';
                this.disabled = false;
            }, 2000);
        });
    }
});

// ===== FUNÇÕES UTILITÁRIAS =====

// Função para formatar preço
function formatPrice(price) {
    return new Intl.NumberFormat('pt-BR', {
        style: 'currency',
        currency: 'BRL'
    }).format(price);
}

// Função para debounce (útil para pesquisas)
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Função para detectar dispositivo móvel
function isMobile() {
    return window.innerWidth <= 768;
}

// Função para scroll suave
function smoothScrollTo(element) {
    element.scrollIntoView({
        behavior: 'smooth',
        block: 'start'
    });
}

