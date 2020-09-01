CREATE DATABASE AULA25082020;

USE AULA25082020;

CREATE TABLE CLIENTES (
    codigo INT PRIMARY KEY NOT NULL AUTO_INCREMENT, 
    nome VARCHAR(50) NOT NULL, 
    dtnasc DATETIME , 
    cpf VARCHAR(18) , 
    cidade VARCHAR(50) , 
    estado VARCHAR(2) )


//$Codigo, $Descricao, $UnidadeDeMedida, $ValorDeCusto, $MargemDeLucro;

CREATE TABLE PRODUTOS (
    codigo INT PRIMARY KEY NOT NULL AUTO_INCREMENT, 
    descricao VARCHAR(50) NOT NULL,
    unidadedemedida VARCHAR(2),
    valordecusto decimal(10,2),
    margemdelucro decimal (10,2)
)

ALTER TABLE PRODUTOS 
    ADD estoque decimal(10,3);

ALTER TABLE PRODUTOS 
    DROP COLUMN estoque;

ALTER TABLE PRODUTOS 
    ADD estoque decimal(10,2);

ALTER TABLE `produtos` CHANGE `teste` `teste123` DECIMAL(10,2) NULL DEFAULT NULL;



create table CLIENTE (
    codigo int not null,
    nome varchar(50)

)