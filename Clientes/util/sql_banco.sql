/* Aula OO . Persintência */

CREATE TABLE clientes (

    id int AUTO_INCREMENT NOT NULL,
    tipo varchar(1) NOT NULL, /* Tipo de cliente: F(físico) ou J(juridico)*/
    nome_social varchar(70) NOT NULL,
    email varchar(70) NOT NULL,
    nome varchar(70),
    cpf varchar(30),
    razao_social varchar(70),
    cnpj varchar(30),
    PRIMARY KEY (id)
    
)