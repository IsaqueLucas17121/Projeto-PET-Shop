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

let contador = 16; // Tamanho base em px

function mudar_fonte(index) {
    let body = document.body;

    if(index === 1 && contador < 30) {
        contador += 1;
    }
    if(index === 2 && contador > 10) {
        contador -= 1;
    }

    body.style.fontSize = contador + "px";
}

function abrir_acessibilidade(index) {
    const botao2 = document.getElementById("acessibilidade2");
    const botao3 = document.getElementById("acessibilidade3");

    if (index === 1) {
        botao2.classList.toggle("desligado");
        botao3.classList.toggle("desligado");
    }
}
