Create database Projeto;

CREATE TABLE MODELO
(
	id INT AUTO_INCREMENT PRIMARY KEY,
	codigo varchar(10) NOT NULL,
	descricao VARCHAR(50) NOT NULL,
	marca varchar(3) NOT NULL
);

CREATE TABLE VEICULO
(
    id INT AUTO_INCREMENT PRIMARY KEY,
    chassi VARCHAR(17) NOT NULL,
	situacao varchar(1) NOT NULL,
    preco FLOAT NOT NULL,
	id_modelo int NOT NULL,
	FOREIGN KEY (id_modelo) REFERENCES MODELO(id)
);

CREATE TABLE NOTA_FISCAL
(
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_veiculo INT NOT NULL,
	data date NOT NULL,
    nota_fiscal int NOT NULL,
	FOREIGN KEY (id_veiculo) REFERENCES VEICULO(id)
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