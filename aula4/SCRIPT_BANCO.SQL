CREATE DATABASE AULAPHP3OWEB;

CREATE TABLE CLIENTES (
   codigo int  PRIMARY KEY AUTO_INCREMENT NOT NULL,
   nome varchar(50),
   nascimento datetime,
   cpf varchar(18),
   cidade varchar(50),
   estado varchar(2)
)
