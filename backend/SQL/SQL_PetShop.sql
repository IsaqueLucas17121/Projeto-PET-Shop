create database PetShop;
use PetShop;

create table enderecos(
cep varchar(255) not null primary key,
rua varchar(255),
bairro varchar(255),
cidade varchar(255),
estado varchar(255)
);

create table usuarios(
cpf varchar(255) not null primary key,
logado varchar(255),
nome varchar(255),
sobrenome varchar(255),
email varchar(255),
senha varchar(255),
img varchar(255),
celular varchar(255),
cep varchar(255),
numero varchar(255),
complemento varchar(255),

constraint fk_cep_usu foreign key (cep) references enderecos(cep)
);

create table pets(
identidade varchar(255) not null primary key,
nome varchar(255),
tipo varchar(255),
raca varchar(255),
idUsuario varchar(255) not null,
constraint fk_pet_usu foreign key (idUsuario) references usuarios(cpf)
);

create table funcionarios(
idFuncionario varchar(255) not null primary key,
nome varchar(255),
sobrenome varchar(255),
funcao enum("Caixa", "Veterinário", "Gerente", "Master"),
email varchar(255),
senha varchar(255),
cep varchar(255),
numero varchar(255),
complemento varchar(255),

constraint fk_cep_funcionario foreign key (cep) references endereco(cep)
);

create table lojas(
idLoja int not null auto_increment primary key,
nome varchar(255),
img varchar(255),
cep varchar(255),
numero varchar(255),
complemento varchar(255),

constraint fk_cep_loja foreign key (cep) references endereco(cep)
);

create table produtos(
idPro int not null auto_increment primary key,
nome varchar(255),
descricao varchar(255),
preco varchar(255),
img varchar(255),
idLoja int,
idFuncionario varchar(255),
constraint fk_id_loja foreign key (idLoja) references loja(idLoja),
constraint fk_pro_funcionario foreign key (idFuncionario) references funcionario(idFuncionario)
);













