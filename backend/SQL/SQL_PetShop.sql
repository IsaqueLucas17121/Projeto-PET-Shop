CREATE DATABASE PetShop;

select * from enderecos;

USE PetShop;

CREATE TABLE enderecos(
    cep VARCHAR(255) NOT NULL PRIMARY KEY,
    rua VARCHAR(255),
    bairro VARCHAR(255),
    cidade VARCHAR(255),
    estado VARCHAR(255)
);

CREATE TABLE usuarios(
    cpf VARCHAR(255) NOT NULL PRIMARY KEY,
    logado VARCHAR(255),
    nome VARCHAR(255),
    sobrenome VARCHAR(255),
    email VARCHAR(255),
    senha VARCHAR(255),
    img VARCHAR(255),
    celular VARCHAR(255),
    cep VARCHAR(255),
    numero VARCHAR(255),
    complemento VARCHAR(255),
    CONSTRAINT fk_cep_usu FOREIGN KEY (cep) REFERENCES enderecos(cep)
);

CREATE TABLE pets(
    identidade VARCHAR(255) NOT NULL PRIMARY KEY,
    nome VARCHAR(255),
    tipo VARCHAR(255),
    raca VARCHAR(255),
    idUsuario VARCHAR(255) NOT NULL,
    CONSTRAINT fk_pet_usu FOREIGN KEY (idUsuario) REFERENCES usuarios(cpf)
);

CREATE TABLE funcionarios(
    idFuncionario VARCHAR(255) NOT NULL PRIMARY KEY,
    nome VARCHAR(255),
    sobrenome VARCHAR(255),
    funcao ENUM("Caixa", "Veterinário", "Gerente", "Master"),
    email VARCHAR(255),
    senha VARCHAR(255),
    cep VARCHAR(255),
    numero VARCHAR(255),
    complemento VARCHAR(255),
    CONSTRAINT fk_cep_funcionario FOREIGN KEY (cep) REFERENCES enderecos(cep)
);

CREATE TABLE lojas(
    idLoja INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255),
    img VARCHAR(255),
    cep VARCHAR(255),
    numero VARCHAR(255),
    complemento VARCHAR(255),
    CONSTRAINT fk_cep_loja FOREIGN KEY (cep) REFERENCES enderecos(cep)
);

CREATE TABLE produtos(
    idPro INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255),
    descricao VARCHAR(255),
    preco VARCHAR(255),
    img VARCHAR(255),
    idLoja INT,
    idFuncionario VARCHAR(255),
    CONSTRAINT fk_id_loja FOREIGN KEY (idLoja) REFERENCES lojas(idLoja),
    CONSTRAINT fk_pro_funcionario FOREIGN KEY (idFuncionario) REFERENCES funcionarios(idFuncionario)
);