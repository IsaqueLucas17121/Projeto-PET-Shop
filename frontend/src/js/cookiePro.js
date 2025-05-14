document.getElementById("formularioPro").addEventListener("submit", function(e){
    e.preventDefault()

    const nomePro = document.getElementById("produto")
    const descricaoPro = document.getElementById("descricao")
    const precoPro = document.getElementById("preco")
    const imagemPro = document.getElementById("imagem")

    localStorage.setItem("nomePro", nomePro)
    localStorage.setItem("descricaoPro", descricaoPro)
    localStorage.setItem("precoPro", precoPro)
    localStorage.setItem("imagemPro", imagemPro)
})