// Funções de validação
function validarEmail(email) {
  const regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return regexEmail.test(email);
}

function validarTelefone(telefone) {
  const regexTelefone = /^\(\d{2}\)\s9\d{4}-\d{4}$/;
  return regexTelefone.test(telefone);
}

function validarCPF(cpf) {
  const regexCPF = /^\d{3}\.\d{3}\.\d{3}-\d{2}$/;
  return regexCPF.test(cpf);
}

// Máscaras para campos
function aplicarMascaraTelefone(input) {
  let v = input.value.replace(/\D/g, "");
  v = v.replace(/^(\d{2})(\d)/g, "($1) $2");
  v = v.replace(/(\d{5})(\d{4})$/, "$1-$2");
  input.value = v;
}

function aplicarMascaraCPF(input) {
  let v = input.value.replace(/\D/g, "");
  v = v.replace(/(\d{3})(\d)/, "$1.$2");
  v = v.replace(/(\d{3})(\d)/, "$1.$2");
  v = v.replace(/(\d{3})(\d{1,2})$/, "$1-$2");
  input.value = v;
}

function mascararCNPJ(campo) {
  let cnpj = campo.value.replace(/\D/g, "");
  if (cnpj.length > 14) cnpj = cnpj.slice(0, 14);
  
  cnpj = cnpj.replace(/^(\d{2})(\d)/, "$1.$2");
  cnpj = cnpj.replace(/^(\d{2})\.(\d{3})(\d)/, "$1.$2.$3");
  cnpj = cnpj.replace(/\.(\d{3})(\d)/, ".$1/$2");
  cnpj = cnpj.replace(/(\d{4})(\d)/, "$1-$2");
  
  campo.value = cnpj;
}

// Consulta CEP
async function consultarCEP(cep) {
  try {
    const response = await fetch(`https://viacep.com.br/ws/${cep}/json/`);
    return await response.json();
  } catch (error) {
    console.error("Erro ao consultar CEP:", error);
    return null;
  }
}

// Objeto com as raças organizadas por tipo
const racasPorTipo = {
  cachorro: ["Beagle", "Pastor Alemão", "Poodle", "Shih Tzu", "Yorkshire Terrier", "Outro"],
  gato: ["Siames", "Persa", "Scottish Fold", "Sphynx", "Maine Coon", "Outro"],
  ave: ["Canário", "Calopsita", "Cacatua", "Arara", "Papagaio Cinzento", "Outro"],
  reptil: ["Iguana Verde", "Jabuti", "Teiú", "Jiboia Arco-íris", "Outro"]
};

// Funções para manipulação de formulários
function alternarCadastro(tipo) {
  const secoes = ['cliente', 'vendedor', 'pet', 'confirmacao'];
  secoes.forEach(sec => {
    document.getElementById(sec).style.display = sec === tipo ? 'block' : 'none';
  });
}

function verificarIdentidade() {
  const identidade = document.getElementById('pet-identidade').value;
  const nomePet = document.getElementById('pet-nome');
  
  nomePet.disabled = identidade.length === 0;
  
  // Simulação: buscar nome do pet se identidade já existir
  if (identidade === "123") { // Exemplo apenas
    nomePet.value = "Rex";
  } else {
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

// Funções de cadastro
async function cadastrarCliente(event) {
  event.preventDefault();
  
  const form = event.target;
  const formData = new FormData(form);
  const userData = Object.fromEntries(formData.entries());

  // Validações
  if (!validarEmail(userData.email)) {
    alert("Email inválido!");
    return;
  }

  if (!validarTelefone(userData.celular)) {
    alert("Celular deve estar no formato (11) 91234-5678");
    return;
  }

  if (!validarCPF(userData.cpf)) {
    alert("CPF deve estar no formato 000.000.000-00");
    return;
  }

  try {
    const response = await fetch('http://localhost:3333/user/register', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        ...userData,
        password: "senhaPadrao123",
        confirmPassword: "senhaPadrao123"
      })
    });

    const data = await response.json();
    
    if (response.ok) {
      alternarCadastro('confirmacao');
    } else {
      alert(`Erro no cadastro: ${data.message}`);
    }
  } catch (error) {
    console.error('Erro:', error);
    alert('Erro ao conectar com o servidor');
  }
}

async function cadastrarVendedor(event) {
  event.preventDefault();
  
  const form = event.target;
  const formData = new FormData(form);
  const vendedorData = Object.fromEntries(formData.entries());

  try {
    const response = await fetch('http://localhost:3333/user/register', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        ...vendedorData,
        password: "senhaPadrao123",
        confirmPassword: "senhaPadrao123"
      })
    });

    const data = await response.json();
    
    if (response.ok) {
      alternarCadastro('confirmacao');
    } else {
      alert(`Erro no cadastro: ${data.message}`);
    }
  } catch (error) {
    console.error('Erro:', error);
    alert('Erro ao conectar com o servidor');
  }
}

async function cadastrarPet(event) {
  event.preventDefault();
  
  const form = event.target;
  const formData = new FormData(form);
  const petData = Object.fromEntries(formData.entries());

  try {
    const response = await fetch('http://localhost:3333/pet/register', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(petData)
    });

    const data = await response.json();
    
    if (response.ok) {
      alert("Pet cadastrado com sucesso!");
      alternarCadastro('confirmacao');
    } else {
      alert(`Erro no cadastro do pet: ${data.message}`);
    }
  } catch (error) {
    console.error('Erro:', error);
    alert('Erro ao conectar com o servidor');
  }
}

function voltarParaInicio() {
  window.location.href = "index.html";
}

// Event Listeners
document.addEventListener('DOMContentLoaded', function() {
  // Máscaras de entrada
  document.getElementById("cliente-celular")?.addEventListener("input", function(e) {
    aplicarMascaraTelefone(e.target);
  });
  
  document.getElementById("cliente-cpf")?.addEventListener("input", function(e) {
    aplicarMascaraCPF(e.target);
  });
  
  document.getElementById("vendedor-telefone")?.addEventListener("input", function(e) {
    aplicarMascaraTelefone(e.target);
  });
  
  document.getElementById("vendedor-cnpj")?.addEventListener("input", function(e) {
    mascararCNPJ(e.target);
  });

  // Consulta CEP
  document.getElementById("cliente-cep")?.addEventListener("input", async function() {
    const cep = this.value.trim();
    if (cep.length === 8) {
      const endereco = await consultarCEP(cep);
      if (endereco) {
        document.getElementById("cliente-rua").value = endereco.logradouro || "";
        document.getElementById("cliente-bairro").value = endereco.bairro || "";
        document.getElementById("cliente-cidade").value = endereco.localidade || "";
        document.getElementById("cliente-estado").value = endereco.uf || "";
      }
    }
  });

  // Formulários
  document.getElementById("form-cliente")?.addEventListener("submit", cadastrarCliente);
  document.getElementById("form-vendedor")?.addEventListener("submit", cadastrarVendedor);
  document.getElementById("form-pet")?.addEventListener("submit", cadastrarPet);
  
  // Botões de alternância
  document.querySelectorAll(".btn-alternar").forEach(btn => {
    btn.addEventListener("click", function() {
      const tipo = this.getAttribute("onclick").match(/'([^']+)'/)[1];
      alternarCadastro(tipo);
    });
  });
  
  // Botão voltar
  document.querySelector("button[onclick='voltarParaInicio()']")?.addEventListener("click", voltarParaInicio);
});