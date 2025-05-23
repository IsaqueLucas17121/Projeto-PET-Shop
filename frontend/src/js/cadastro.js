// cadastro.js

// ========== CADASTRO DE CLIENTE ==========
function cadastrarCliente(event) {
    event.preventDefault();

    const cliente = {
        nome: document.getElementById('cliente-nome').value,
        sobrenome: document.getElementById('cliente-sobrenome').value,
        email: document.getElementById('cliente-email').value,
        celular: document.getElementById('cliente-celular').value,
        cpf: document.getElementById('cliente-cpf').value,
        tipo_user: document.getElementById('cliente-tipo_user').value,
        endereco: {
            cep: document.getElementById('cliente-cep').value,
            rua: document.getElementById('cliente-rua').value,
            bairro: document.getElementById('cliente-bairro').value,
            cidade: document.getElementById('cliente-cidade').value,
            estado: document.getElementById('cliente-estado').value,
            numero: document.getElementById('cliente-numero').value,
            complemento: document.getElementById('cliente-complemento').value
        }
    };

    fetch('http://localhost:3333/user/register', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(cliente)
    })
    .then(response => {
        if (!response.ok) throw new Error('Erro ao cadastrar cliente');
        return response.json();
    })
    .then(() => {
        alternarCadastro('confirmacao');
    })
    .catch(error => {
        alert("Erro no cadastro de cliente: " + error.message);
    });
}

// ========== CADASTRO DE VENDEDOR ==========
function cadastrarVendedor(event) {
    event.preventDefault();

    const vendedor = {
        nome: document.getElementById('vendedor-nome').value,
        email: document.getElementById('vendedor-email').value,
        telefone: document.getElementById('vendedor-telefone').value,
        endereco: document.getElementById('vendedor-endereco').value,
        cnpj: document.getElementById('vendedor-cnpj').value,
        tipo_user: document.getElementById('vendedor-tipo_user').value
    };

    fetch('http://localhost:3333/', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(vendedor)
    })
    .then(response => {
        if (!response.ok) throw new Error('Erro ao cadastrar vendedor');
        return response.json();
    })
    .then(() => {
        alternarCadastro('confirmacao');
    })
    .catch(error => {
        alert("Erro no cadastro de vendedor: " + error.message);
    });
}

// ========== CADASTRO DE PET ==========
function cadastrarPet(event) {
    event.preventDefault();

    const pet = {
        identidade: document.getElementById('pet-identidade').value,
        nome: document.getElementById('pet-nome').value,
        tipo: document.getElementById('pet-tipo').value,
        raca: document.getElementById('pet-raca').value
    };

    fetch('http://localhost:3333/user/register', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(pet)
    })
    .then(response => {
        if (!response.ok) throw new Error('Erro ao cadastrar pet');
        return response.json();
    })
    .then(() => {
        alternarCadastro('confirmacao');
    })
    .catch(error => {
        alert("Erro no cadastro de pet: " + error.message);
    });
}

// ========== CEP AUTOMÁTICO ==========
document.getElementById('cliente-cep').addEventListener('blur', () => {
    const cep = document.getElementById('cliente-cep').value.replace(/\D/g, '');
    if (cep.length === 8) {
        fetch(`https://viacep.com.br/ws/${cep}/json/`)
            .then(response => {
                if (!response.ok) throw new Error("CEP inválido");
                return response.json();
            })
            .then(data => {
                document.getElementById('cliente-rua').value = data.logradouro || '';
                document.getElementById('cliente-bairro').value = data.bairro || '';
                document.getElementById('cliente-cidade').value = data.localidade || '';
                document.getElementById('cliente-estado').value = data.uf || '';
            })
            .catch(() => {
                alert('Não foi possível buscar o endereço para o CEP informado.');
            });
    }
});


