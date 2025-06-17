

  const textos = {
    privacidade: "Saiba como seus dados são coletados, utilizados e protegidos. Garantimos sua privacidade com total transparência em nosso site.",
    cookies: "Entenda como utilizamos cookies para melhorar sua experiência de navegação e oferecer conteúdos personalizados.",
    compras: "Veja todos os detalhes sobre o processo de compra, formas de pagamento, cancelamentos e condições especiais.",
    entregas: "Confira como funciona nossa logística de entregas, prazos, regiões atendidas e condições para frete grátis.",
    atendimento: "Precisa de ajuda? Acesse nossa central de atendimento para tirar dúvidas, solucionar problemas ou fazer sugestões.",
    whatsapp: "Fale conosco diretamente pelo WhatsApp! Atendimento rápido, prático e personalizado para você.",
    racao: "Encontre a ração ideal para seu pet com opções para todas as idades, portes e necessidades nutricionais.",
    marcas: "Conheça as principais marcas do mercado pet e escolha com confiança os produtos preferidos para seu animal.",
    utensilios: "Tudo que você precisa para cuidar do seu pet: comedouros, brinquedos, coleiras e muito mais.",
    planos: "Garanta o bem-estar do seu companheiro com planos acessíveis e completos para cuidar da saúde dele.",
    antipulgas: "Proteja seu pet com produtos eficazes contra pulgas e carrapatos. Descontos especiais por tempo limitado!",
    medicamentos: "Medicamentos veterinários com qualidade e segurança. Cuidar da saúde do seu pet ficou ainda mais fácil.",
    antibioticos: "Veja nossa linha de antibióticos com prescrição, ideal para o tratamento de infecções e cuidados veterinários."
  };

  function openModal(titulo, tipo) {
    document.getElementById("modal-title").innerText = titulo;
    document.getElementById("modal-text").innerText = textos[tipo];
    const modal = document.getElementById("modal");
    modal.classList.remove("fade-out");
    modal.style.display = "block";
    history.pushState({ modal: { title: titulo, key: tipo } }, titulo, `#${tipo}`);
  }

  function closeModal() {
    const modal = document.getElementById("modal");
    modal.classList.add("fade-out");
    setTimeout(() => {
      modal.style.display = "none";
      modal.classList.remove("fade-out");
      history.pushState({}, '', window.location.pathname);
    }, 300);
  }

  window.onclick = function(event) {
    const modal = document.getElementById("modal");
    if (event.target === modal) {
      closeModal();
    }
  };

  window.onpopstate = function(event) {
    if (event.state && event.state.modal) {
      openModal(event.state.modal.title, event.state.modal.key);
    } else {
      closeModal();
    }
  };

  function toggleTheme() {
    document.body.classList.toggle('dark-mode');
  }

let tamanhotxt = 16 

/* Loja */

function MudarPagina(index) {
    const botoes = [
        document.getElementById("pagi1"),
        document.getElementById("pagi2"),
        document.getElementById("pagi3")
    ];

    botoes.forEach(botao => {
        botao.style.backgroundColor = "transparent";
        botao.style.color = "#360745";
    });

    if (botoes[index - 1]) {
        botoes[index - 1].style.backgroundColor = "#360745";
        botoes[index - 1].style.color = "#fff7bd";
    }
}

/* Slide */


var radio = document.querySelector('.manual-btn')
var contador = 1

document.getElementById('radio1').checked = true

setInterval(() => {
    proximaimg()
}, 5000)


// rolamento do slide 

function proximaimg(){

    contador++

    if(contador > 3)(
        contador = 1
    )

    document.getElementById('radio'+contador).checked = true

    
}

// mudar imagem slide

function mudarImg(index){
    for( i=1; i<=4 ; i++ ){
        document.getElementById("img_principal" + i).classList.add("desligado")
    }
    document.getElementById("img_principal" + index).classList.remove("desligado")
}

// setas do slide

let count = 1;

function slide_arrow(direction) {
    let slide = document.getElementById("primeiro");

    if (direction === 1) {
        count = count - 1; 
    }
    else {
        count = count + 1; 
    }

    if (count < 1) {
        count = 3;
    } else if (count > 3) {
        count = 1;
    }

    document.getElementById("radio" + count).checked = true;
}

//Acecibilidade

function mudar_fonte(index) {

    let body = document.body;

    if(index === 1 && tamanhotxt < 30 ) {
        tamanhotxt += 1;
    }
    if(index === 2 && tamanhotxt > 10) {
        tamanhotxt -= 1;
    }

    body.style.fontSize = tamanhotxt + "px";
}

function abrir_acessibilidade(index) {
    const botaoAcesso = document.getElementById("botao_acesso");
    const botaoTema = document.getElementById("botao_tema");
    const botao2 = document.getElementById("acessibilidade2");
    const botao3 = document.getElementById("acessibilidade3");

    if (index === 1) {
        // Clique no bonequinho -> mostra/esconde os botões "visualização" e "tema"
        botaoAcesso.classList.toggle("desligado");
        botaoTema.classList.toggle("desligado");

        // Garante que os botões de fonte fiquem escondidos ao fechar
        if (botaoAcesso.classList.contains("desligado")) {
            botao2.classList.add("desligado");
            botao3.classList.add("desligado");
        }
    } 
    else if (index === 2) {
        // Clique no olho -> mostra/esconde os botões de fonte
        botao2.classList.toggle("desligado");
        botao3.classList.toggle("desligado");
    }
}

function MostrarSer(){
    document.getElementById('MostrarSer').classList.toggle("desligado");
}
