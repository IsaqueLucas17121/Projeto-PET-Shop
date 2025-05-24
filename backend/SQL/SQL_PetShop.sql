create database PetShop;

use PetShop;

select * from usuario;

create table endereco(
cep varchar(255) not null primary key,
numero varchar(255),
rua varchar(255),
bairro varchar(255),
cidade varchar(255),
estado varchar(255),
complemento varchar(255)

);

create table usuario(
cpf varchar(255) not null primary key,
logado varchar(255),
nome varchar(255),
sobrenome varchar(255),
email varchar(255),
senha varchar(255),
img varchar(255),
celular varchar(255),
cep varchar(255),

constraint fk_cep_usu foreign key (cep) references endereco(cep)
);

create table pet(
id_pet int primary key not null auto_increment,
nome varchar(255),
tipo varchar(255),
raca varchar(255),
id_usu varchar(255) not null,
constraint fk_pet_usu foreign key (id_usu) references usuario(cpf)
);

create table vendedor(
id_ven varchar(255) not null primary key,
nome varchar(255),
sobrenome varchar(255),
funcao varchar(255),
email varchar(255),
senha varchar(255)
);

create table loja(
id_loja int not null auto_increment primary key,
nome varchar(255),
img varchar(255)
);

create table produto(
id_pro int not null auto_increment primary key,
nome varchar(255),
descricao varchar(255),
valor varchar(255),
img varchar(255),
id_loja int,
id_usu varchar(255),
constraint fk_id_loja foreign key (id_loja) references loja(id_loja),
constraint fk_pro_usu foreign key (id_usu) references usuario(cpf)

);










