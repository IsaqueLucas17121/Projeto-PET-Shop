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

