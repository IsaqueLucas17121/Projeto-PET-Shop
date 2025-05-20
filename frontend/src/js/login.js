document.getElementById("form-cadastro").addEventListener("submit", async function (e) {
  e.preventDefault();

  const nome = document.getElementById("nome").value.trim();
  const email = document.getElementById("email").value.trim();
  const celular = document.getElementById("celular").value.trim();
  const cpf = document.getElementById("cpf").value.trim();
  const cep = document.getElementById("cep").value.trim();

  if (!validarEmail(email)) {
      alert("Email inválido!");
      return;
  }

  if (!validarTelefone(celular)) {
      alert("Celular deve estar no formato (11) 91234-5678");
      return;
  }

  if (!validarCPF(cpf)) {
      alert("CPF deve estar no formato 000.000.000-00");
      return;
  }


  const endereco = await AcharCep(cep);

  if (endereco) {
      document.getElementById("rua").value = endereco.logradouro || "Endereço não encontrado";
      document.getElementById("bairro").value = endereco.bairro || "Bairro não encontrado";
      document.getElementById("cidade").value = endereco.localidade || "Cidade não encontrada";
      document.getElementById("estado").value = endereco.uf || "UF não encontrado";
  }

  document.getElementById("cliente").style.display = "none";
  document.getElementById("cadastro").style.display = "grid";
  this.reset();
});

async function AcharCep(cep) {
  try {
      const response = await fetch(`https://viacep.com.br/ws/${cep}/json/`);
      const data = await response.json();
      return data;
  } catch (error) {
      console.error("Error fetching data:", error);
      return null;
  }
}


document.getElementById("cep").addEventListener("input", async function () {
  const cep = this.value.trim();
  if (cep.length === 8) { 
      const endereco = await AcharCep(cep);
      if (endereco) {
          document.getElementById("rua").value = endereco.logradouro || "Endereço não encontrado";
          document.getElementById("bairro").value = endereco.bairro || "Bairro não encontrado";
          document.getElementById("cidade").value = endereco.localidade || "Cidade não encontrada";
          document.getElementById("estado").value = endereco.uf || "UF não encontrado";
      }
  }
});

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

document.getElementById("celular").addEventListener("input", function (e) {
  let v = e.target.value.replace(/\D/g, ""); 
  v = v.replace(/^(\d{2})(\d)/g, "($1) $2");
  v = v.replace(/(\d{5})(\d{4})$/, "$1-$2");
  e.target.value = v;
});

document.getElementById("cpf").addEventListener("input", function (e) {
  let v = e.target.value.replace(/\D/g, ""); 
  v = v.replace(/(\d{3})(\d)/, "$1.$2");
  v = v.replace(/(\d{3})(\d)/, "$1.$2");
  v = v.replace(/(\d{3})(\d{1,2})$/, "$1-$2");
  e.target.value = v;
});

document.getElementById("telefone2").addEventListener("input", function (e) {
  let v = e.target.value.replace(/\D/g, ""); 
  v = v.replace(/^(\d{2})(\d)/g, "($1) $2");
  v = v.replace(/(\d{5})(\d{4})$/, "$1-$2");
  e.target.value = v;
});

function mascararCNPJ(campo) {
  let cnpj = campo.value.replace(/\D/g, "");

  if (cnpj.length > 14) cnpj = cnpj.slice(0, 14); 


  cnpj = cnpj.replace(/^(\d{2})(\d)/, "$1.$2");
  cnpj = cnpj.replace(/^(\d{2})\.(\d{3})(\d)/, "$1.$2.$3");
  cnpj = cnpj.replace(/\.(\d{3})(\d)/, ".$1/$2");
  cnpj = cnpj.replace(/(\d{4})(\d)/, "$1-$2");

  campo.value = cnpj;
}

function TocarCadastro(index) {
  let cliente = document.getElementById("cliente");
  let vendedor = document.getElementById("vendedor");
  if (index === 1) {
      cliente.style.display = "none";
      vendedor.style.display = "block";
  } else {
      cliente.style.display = "block";
      vendedor.style.display = "none";
  }
}
