Create database Projeto;

CREATE TABLE MODELO
(
	codigo varchar(10) PRIMARY KEY,
	descricao VARCHAR(50) NOT NULL,
	marca varchar(3) NOT NULL
);

CREATE TABLE VEICULO
(
    id INT AUTO_INCREMENT PRIMARY KEY,
    chassi VARCHAR(17) NOT NULL,
	situacao varchar(1) NOT NULL,
    preco FLOAT NOT NULL,
	id_modelo varchar(10) NOT NULL/*,
	FOREIGN KEY (id_modelo) REFERENCES MODELO(codigo)*/
);

CREATE TABLE NOTA_FISCAL
(
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_veiculo INT NOT NULL,
	data date NOT NULL,
    nota_fiscal int NOT NULL/*,
	FOREIGN KEY (id_veiculo) REFERENCES VEICULO(id)*/
);

CREATE TABLE USUARIO
(
	id INT AUTO_INCREMENT PRIMARY KEY,
    nome varchar(50) NOT NULL,
	login varchar(14) NOT NULL,
    senha varchar(14) NOT NULL
);


Insert into usuario VALUES(1, 'FELIPE FRIEDRICH SANTOS', 'FELIPE', 'FRIEDRICH');
Insert into usuario VALUES(2, 'PROFESSOR PROGRAMACAO INTERNET II', 'PROFESSOR', 'progINT2');


insert into MODELO values('5Z95E4', 'SpaceFox', 'VW'),('5D43Z3', 'Virtus', 'VW'), ('B3LLY3', 'Palio', 'FIT');

insert into VEICULO values('1', '12345678901234567', 'A', '100000', '5D43Z3'),('2', '12345678901234568', 'N', '60500', '5Z95E4');

insert into NOTA_FISCAL values(1, 1, STR_TO_DATE('18/10/2019','%d/%m/%Y'), '123456'),(2, 2, STR_TO_DATE('05/09/2019','%d/%m/%Y'), '175401');
