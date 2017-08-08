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
	codigo CHARACTER VARYING NOT NULL PRIMARY KEY,
	nome CHARACTER VARYING NOT NULL
);

CREATE TABLE cor
(
	r INTEGER NOT NULL,
	g INTEGER NOT NULL,
	b INTEGER NOT NULL,
	nome CHARACTER VARYING NOT NULL,
	codigo CHARACTER VARYING NOT NULL PRIMARY KEY,
	UNIQUE (r, g, b)
);

CREATE TABLE botton
(
	estoque INTEGER NOT NULL DEFAULT 1,
	descricao CHARACTER VARYING NOT NULL DEFAULT '',
	codigo_estampa CHARACTER VARYING NOT NULL REFERENCES estampa,
	codigo_cor CHARACTER VARYING NOT NULL REFERENCES cor,
	excluido BOOLEAN NOT NULL DEFAULT FALSE,
	PRIMARY KEY (codigo_estampa, codigo_cor)
);

CREATE TABLE venda
(
	login_usuario CHARACTER VARYING(50) NOT NULL REFERENCES usuario,
	concretizacao TIMESTAMP,
	PRIMARY KEY (login_usuario, concretizacao)
);

CREATE TABLE item
(
	codigo_estampa_botton CHARACTER VARYING NOT NULL,
	quantidade INTEGER NOT NULL,
	login_usuario_venda CHARACTER VARYING NOT NULL,
	concretizacao_venda TIMESTAMP,
	codigo_cor_botton CHARACTER VARYING NOT NULL,
	FOREIGN KEY (login_usuario_venda, concretizacao_venda) REFERENCES venda (login_usuario, concretizacao),
	FOREIGN KEY (codigo_estampa_botton, codigo_cor_botton) REFERENCES botton (codigo_estampa, codigo_cor),
	PRIMARY KEY (codigo_estampa_botton, codigo_cor_botton, login_usuario_venda)
);

CREATE TABLE cliente
(
	login CHARACTER VARYING(50) NOT NULL PRIMARY KEY REFERENCES usuario,
	nome CHARACTER VARYING(100) NOT NULL,
	cpf CHARACTER(14),
	rg CHARACTER(12),
	endereco CHARACTER VARYING(120),
	imagem CHARACTER VARYING(30) NOT NULL
);

CREATE TABLE admin
(
	login CHARACTER VARYING(50) NOT NULL PRIMARY KEY REFERENCES usuario
);

INSERT INTO cor
	(codigo, r, g, b, nome)
	VALUES
	('preto', 0, 0, 0, 'preto'),
	('azul', 0, 0, 255, 'azul'),
	('lima', 0, 255, 0, 'lima'),
	('aqua', 0, 255, 255, 'aqua'),
	('vermelho', 255, 0, 0, 'vermelho'),
	('magenta', 255, 0, 255, 'magenta'),
	('amarelo', 255, 255, 0, 'amarelo'),
	('branco', 255, 255, 255, 'branco');

INSERT INTO estampa
	(codigo, nome)
	VALUES
	('bob_esponja', 'Bob Esponja'),
	('minion', 'minion'),
	('superman', 'Superman'),
	('batman', 'Batman');

INSERT INTO botton
	(codigo_estampa, codigo_cor)
	VALUES
	('bob_esponja', 'amarelo'),
	('minion', 'amarelo'),
	('batman', 'preto'),
	('superman', 'vermelho'),
	('superman', 'azul'),
	('superman', 'branco'),
	('superman', 'preto');
