document.getElementById("form-cadastro").addEventListener("submit", function (e) {
    e.preventDefault();
  
    const nome = document.getElementById("nome").value.trim();
    const email = document.getElementById("email").value.trim();
    const telefone = document.getElementById("telefone").value.trim();
    const cpf = document.getElementById("cpf").value.trim();
    const endereco = document.getElementById("endereco").value.trim();
    const verificado = document.getElementById("cadastro");
    const cliente = document.getElementById("cliente");
  
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
    
    cliente.style.display = "none";
    verificado.style.display = "grid";
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

  // Máscara para CNPJ: 00.000.000/0000-00
  function mascararCNPJ(campo) {
    let cnpj = campo.value.replace(/\D/g, ""); // Remove tudo que não é número

    if (cnpj.length > 14) cnpj = cnpj.slice(0, 14); // Limita a 14 dígitos

    // Aplica a máscara
    cnpj = cnpj.replace(/^(\d{2})(\d)/, "$1.$2");
    cnpj = cnpj.replace(/^(\d{2})\.(\d{3})(\d)/, "$1.$2.$3");
    cnpj = cnpj.replace(/\.(\d{3})(\d)/, ".$1/$2");
    cnpj = cnpj.replace(/(\d{4})(\d)/, "$1-$2");

    campo.value = cnpj;
  }
  document.getElementById("form-cadastro2").addEventListener("submit", function (e) {
    e.preventDefault();
  
    const nome = document.getElementById("nome2").value.trim();
    const email = document.getElementById("email2").value.trim();
    const telefone = document.getElementById("telefone2").value.trim();
    const endereco = document.getElementById("endereco2").value.trim();
    const verificado = document.getElementById("cadastro");
    const vendedor = document.getElementById("vendedor");
  
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
  
    vendedor.style.display = "none";
    verificado.style.display = "grid";

    this.reset();
  });
  
  // Máscara para telefone: (11) 91234-5678
  document.getElementById("telefone2").addEventListener("input", function (e) {
    let v = e.target.value.replace(/\D/g, ""); // remove tudo que não é número
    v = v.replace(/^(\d{2})(\d)/g, "($1) $2");
    v = v.replace(/(\d{5})(\d{4})$/, "$1-$2");
    e.target.value = v;
  });
  

  // Máscara para CNPJ: 00.000.000/0000-00
  function mascararCNPJ(campo) {
    let cnpj = campo.value.replace(/\D/g, ""); // Remove tudo que não é número

    if (cnpj.length > 14) cnpj = cnpj.slice(0, 14); // Limita a 14 dígitos

    // Aplica a máscara
    cnpj = cnpj.replace(/^(\d{2})(\d)/, "$1.$2");
    cnpj = cnpj.replace(/^(\d{2})\.(\d{3})(\d)/, "$1.$2.$3");
    cnpj = cnpj.replace(/\.(\d{3})(\d)/, ".$1/$2");
    cnpj = cnpj.replace(/(\d{4})(\d)/, "$1-$2");

    campo.value = cnpj;
  }
  
  function TocarCadastro(index){
    let cliente = document.getElementById("cliente")
    let vendedor = document.getElementById("vendedor")
    if(index == 1){
        cliente.style.display = "none"
        vendedor.style.display = "block"
    }else{
        cliente.style.display = "block"
        vendedor.style.display = "none"
    }
  }
