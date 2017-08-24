DROP TABLE IF EXISTS admin;
DROP TABLE IF EXISTS cliente;
DROP TABLE IF EXISTS item;
DROP TABLE IF EXISTS venda;
DROP TABLE IF EXISTS botton;
DROP TABLE IF EXISTS cor;
DROP TABLE IF EXISTS estampa;
DROP TABLE IF EXISTS usuario;

CREATE TABLE usuario
(
	login CHARACTER VARYING(50) NOT NULL PRIMARY KEY,
	senha CHARACTER VARYING(20) NOT NULL,
	email CHARACTER VARYING(50) NOT NULL,
	excluido BOOLEAN NOT NULL DEFAULT FALSE
);

CREATE TABLE estampa
(
	codigo SERIAL NOT NULL PRIMARY KEY,
	nome CHARACTER VARYING NOT NULL
);

CREATE TABLE cor
(
	r INTEGER NOT NULL,
	g INTEGER NOT NULL,
	b INTEGER NOT NULL,
	nome CHARACTER VARYING NOT NULL,
	codigo SERIAL NOT NULL PRIMARY KEY,
	UNIQUE (r, g, b)
);

CREATE TABLE botton
(
	estoque INTEGER NOT NULL DEFAULT 1,
	descricao CHARACTER VARYING NOT NULL DEFAULT '',
	codigo_estampa INTEGER NOT NULL REFERENCES estampa (codigo),
	codigo_cor INTEGER NOT NULL REFERENCES cor (codigo),
	excluido BOOLEAN NOT NULL DEFAULT FALSE,
	preco NUMERIC NOT NULL,
	codigo SERIAL NOT NULL PRIMARY KEY,
	UNIQUE (codigo_estampa, codigo_cor)
);

CREATE TABLE venda
(
	login_usuario CHARACTER VARYING(50) NOT NULL REFERENCES usuario (login),
	concretizacao TIMESTAMP,
	codigo SERIAL NOT NULL PRIMARY KEY
);

CREATE TABLE item
(
	codigo_venda INTEGER NOT NULL REFERENCES venda (codigo),
	codigo_botton INTEGER NOT NULL REFERENCES botton (codigo),
	preco_botton INTEGER NOT NULL,
	quantidade INTEGER NOT NULL,
	PRIMARY KEY (codigo_venda, codigo_botton)
);

CREATE TABLE cliente
(
	login CHARACTER VARYING(50) NOT NULL PRIMARY KEY REFERENCES usuario (login),
	nome CHARACTER VARYING(60) NOT NULL,
	sobrenome CHARACTER VARYING(60) NOT NULL,
	cpf CHARACTER(14) NOT NULL,
	rg CHARACTER(12),
	endereco CHARACTER VARYING(120) NOT NULL,
	cidade CHARACTER VARYING(50) NOT NULL,
	estado CHARACTER(2) NOT NULL,
	cep CHARACTER(9) NOT NULL
);

CREATE TABLE admin
(
	login CHARACTER VARYING(50) NOT NULL PRIMARY KEY REFERENCES usuario (login)
);

INSERT INTO cor
	(r, g, b, nome)
	VALUES
	(0, 0, 0, 'preto'),
	(0, 0, 255, 'azul'),
	(0, 255, 0, 'lima'),
	(0, 255, 255, 'aqua'),
	(255, 0, 0, 'vermelho'),
	(255, 0, 255, 'magenta'),
	(255, 255, 0, 'amarelo'),
	(255, 255, 255, 'branco');

INSERT INTO estampa (nome) VALUES ('Bob Esponja'), ('minion'), ('Superman'), ('Batman');
