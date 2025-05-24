// Objeto com as raças organizadas por tipo
const racasPorTipo = {
    cachorro: ["Beagle", "Pastor Alemão", "Poodle", "Shih Tzu", "Yorkshire Terrier", "Outro"],
    gato: ["Siames", "Persa", "Scottish Fold", "Sphynx", "Maine Coon", "Outro"],
    ave: ["Canário", "Calopsita", "Cacatua", "Arara", "Papagaio Cinzento", "Outro"],
    reptil: ["Iguana Verde", "Jabuti", "Teiú", "Jiboia Arco-íris", "Outro"]
};

function mudarCadastro(i) {
    let login = document.getElementById('login');
    let cliente = document.getElementById('cliente');
    let pet = document.getElementById('pet');
    let vendedor = document.getElementById('vendedor');

    if (i === 1) {
        login.classList.add('desligado');
        cliente.classList.remove('desligado');
    } else {
        login.classList.remove('desligado');
        cliente.classList.add('desligado');
        pet.classList.add('desligado');
        vendedor.classList.add('desligado'); 
    }
}

function verificarIdentidade() {
    const identidade = document.getElementById('pet-identidade').value;
    const nomePet = document.getElementById('pet-nome');
    
    if(identidade.length > 0) {
        nomePet.disabled = false;
        
        
        if(identidade === "123") { 
            nomePet.value = "Rex";
        } else {
            nomePet.value = "";
        }
    } else {
        nomePet.disabled = true;
        nomePet.value = "";
    }
}

function atualizarRacas() {
    const tipoSelect = document.getElementById('pet-tipo');
    const racaSelect = document.getElementById('pet-raca');
    const tipoSelecionado = tipoSelect.value;

    racaSelect.innerHTML = '';
    
    if (tipoSelecionado) {
        racaSelect.disabled = false;
        racaSelect.appendChild(new Option("Selecione uma raça", ""));
        
        racasPorTipo[tipoSelecionado].forEach(raca => {
            racaSelect.appendChild(new Option(raca, raca.replace(/\s+/g, '')));
        });
    } else {
        racaSelect.disabled = true;
        racaSelect.appendChild(new Option("Selecione primeiro o tipo", ""));
    }
}

function alternarCadastro(tipo) {
    document.getElementById('cliente').classList.add('desligado');
    document.getElementById('vendedor').classList.add('desligado');
    document.getElementById('pet').classList.add('desligado');
    document.getElementById('confirmacao').classList.add('desligado');
    
    document.getElementById(tipo).classList.remove('desligado');
}

function cadastrarCliente(event) {
    event.preventDefault();
    console.log("Cadastrando cliente...");
    mostrarConfirmacao();
}

function cadastrarVendedor(event) {
    event.preventDefault();
    console.log("Cadastrando vendedor...");
    mostrarConfirmacao();
}

function cadastrarPet(event) {
    event.preventDefault();
    console.log("Cadastrando pet...");
    mostrarConfirmacao();
}

function mostrarConfirmacao() {
    alternarCadastro('confirmacao');
}

function voltarParaInicio() {
    window.location.href = "index.html";
}

function mascaraCPF(valor) {
    valor = valor.replace(/\D/g, ''); // Remove não dígitos
    valor = valor.replace(/(\d{3})(\d)/, '$1.$2');
    valor = valor.replace(/(\d{3})(\d)/, '$1.$2');
    valor = valor.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
    return valor;
}

function formatarCPF(input) {
    input.value = mascaraCPF(input.value);
}

function mascaraCNPJ(valor) {
    valor = valor.replace(/\D/g, '');
    valor = valor.replace(/^(\d{2})(\d)/, '$1.$2');
    valor = valor.replace(/^(\d{2})\.(\d{3})(\d)/, '$1.$2.$3');
    valor = valor.replace(/\.(\d{3})(\d)/, '.$1/$2');
    valor = valor.replace(/(\d{4})(\d)/, '$1-$2');
    return valor;
}

function formatarCNPJ(input) {
    input.value = mascaraCNPJ(input.value);
}

function mascaraCEP(valor) {
    valor = valor.replace(/\D/g, '');
    valor = valor.replace(/^(\d{5})(\d)/, '$1-$2');
    return valor;
}

function formatarCEP(input) {
    input.value = mascaraCEP(input.value);
}

function mascaraCelular(valor) {
    valor = valor.replace(/\D/g, '');
    valor = valor.replace(/^(\d{2})(\d)/g, '($1) $2');
    valor = valor.replace(/(\d{5})(\d)/, '$1-$2');
    return valor;
}

function formatarCelular(input) {
    input.value = mascaraCelular(input.value);
}

// Função para alternar visibilidade da senha
function trocarSenha(index) {
    let olho1 = document.getElementById('olho1');
    let olho2 = document.getElementById('olho2');
    let input = document.getElementById('cliente-senha');
    
    if(index === 1) {
        olho1.style.display = "none";
        olho2.style.display = "flex";
        input.type = 'text';
    } else if(index === 2) {
        olho1.style.display = "flex";
        olho2.style.display = "none";
        input.type = 'password';
    }

    let olho3 = document.getElementById('olho3');
    let olho4 = document.getElementById('olho4');
    let input2 = document.getElementById('vendedor-senha');
    
    if(index === 3) {
        olho3.style.display = "none";
        olho4.style.display = "flex";
        input2.type = 'text';
    } else if(index === 4) {
        olho3.style.display = "flex";
        olho4.style.display = "none";
        input2.type = 'password';
    }
}

async function buscarEnderecoPorCEP(cep, tipo) {
    try {
        cep = cep.replace(/\D/g, '');

        if (cep.length !== 8) {
            throw new Error('CEP inválido');
        }

        const response = await fetch(`https://viacep.com.br/ws/${cep}/json/`);
        const data = await response.json();

        if (data.erro) {
            throw new Error('CEP não encontrado');
        }

        document.getElementById(`${tipo}-rua`).value = data.logradouro || '';
        document.getElementById(`${tipo}-bairro`).value = data.bairro || '';
        document.getElementById(`${tipo}-cidade`).value = data.localidade || '';
        document.getElementById(`${tipo}-estado`).value = data.uf || '';

    } catch (error) {
        console.error('Erro ao buscar CEP:', error);
        alert('Erro ao buscar CEP: ' + error.message);
    }
}

document.addEventListener('DOMContentLoaded', function() {
    // Configura o evento para o CEP do cliente
    const clienteCEP = document.getElementById('cliente-cep');
    clienteCEP.addEventListener('blur', function() {
        if (this.value.length === 9) { // 12345-678
            buscarEnderecoPorCEP(this.value, 'cliente');
        }
    });

    const vendedorCEP = document.getElementById('vendedor-cep');
    vendedorCEP.addEventListener('blur', function() {
        if (this.value.length === 9) { // 12345-678
            buscarEnderecoPorCEP(this.value, 'vendedor');
        }
    });
});