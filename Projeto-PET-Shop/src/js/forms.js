document.getElementById("form-cadastro").addEventListener("submit", function (e) {
    e.preventDefault();
  
    const nome = document.getElementById("nome").value.trim();
    const email = document.getElementById("email").value.trim();
    const telefone = document.getElementById("telefone").value.trim();
    const cpf = document.getElementById("cpf").value.trim();
    const endereco = document.getElementById("endereco").value.trim();
  
    const regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const regexTelefone = /^\(\d{2}\)\s9\d{4}-\d{4}$/;
    const regexCPF = /^\d{3}\.\d{3}\.\d{3}-\d{2}$/;
  
    if (!regexEmail.test(email)) {
      alert("Email inválido!");
      return;
    }
  
    if (!regexTelefone.test(telefone)) {
      alert("Telefone deve estar no formato (11) 91234-5678");
      return;
    }
  
    if (!regexCPF.test(cpf)) {
      alert("CPF deve estar no formato 000.000.000-00");
      return;
    }
  
    alert("Cadastro realizado com sucesso!");
    this.reset();
  });
  
  // Máscara para telefone: (11) 91234-5678
  document.getElementById("telefone").addEventListener("input", function (e) {
    let v = e.target.value.replace(/\D/g, ""); // remove tudo que não é número
    v = v.replace(/^(\d{2})(\d)/g, "($1) $2");
    v = v.replace(/(\d{5})(\d{4})$/, "$1-$2");
    e.target.value = v;
  });
  
  // Máscara para CPF: 000.000.000-00
  document.getElementById("cpf").addEventListener("input", function (e) {
    let v = e.target.value.replace(/\D/g, ""); // remove tudo que não é número
    v = v.replace(/(\d{3})(\d)/, "$1.$2");
    v = v.replace(/(\d{3})(\d)/, "$1.$2");
    v = v.replace(/(\d{3})(\d{1,2})$/, "$1-$2");
    e.target.value = v;
  });
  