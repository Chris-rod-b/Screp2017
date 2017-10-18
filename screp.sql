DROP TABLE IF EXISTS item_cart;
DROP TABLE IF EXISTS item;
DROP TABLE IF EXISTS venda;
DROP TABLE IF EXISTS botton;
DROP TABLE IF EXISTS cor;
DROP TABLE IF EXISTS estampa;

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
	codigo_cliente INTEGER NOT NULL,
	concretizacao TIMESTAMP NOT NULL UNIQUE,
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

CREATE TABLE item_cart
(
	codigo SERIAL PRIMARY KEY,
	codigo_cliente INTEGER NOT NULL,
	codigo_botton INTEGER NOT NULL REFERENCES botton (codigo),
	quantidade INTEGER NOT NULL
);

INSERT INTO cor
	(r, g, b, nome, codigo)
	VALUES
	(0, 0, 0, 'branco', 0),
	(0, 0, 1, 'preto', 1),
	(0, 0, 2, 'azul claro', 2),
	(0, 0, 3, 'laranja', 3);

INSERT INTO estampa
	(codigo, nome)
	VALUES
	( 1, 'Darth Vader'),
	( 2, 'Game of Thrones'),
	( 3, 'Grey''s Anatomy'),
	( 4, 'Guns ''n'' Roses'),
	( 5, 'Harry Potter'),
	( 6, 'Jake'),
	( 7, 'minions'),
	( 8, 'Nirvana'),
	( 9, 'Rolling Stones'),
	(10, 'Rosquinha');

INSERT INTO botton
	(codigo, estoque, preco, codigo_estampa, codigo_cor)
	VALUES
	(     1,      10,     3,              1,          0),
	(     2,      10,     3,              2,          1),
	(     3,      10,     3,              3,          2),
	(     4,      10,     3,              4,          1),
	(     5,      10,     3,              5,          0),
	(     6,      10,     3,              6,          3),
	(     7,      10,     3,              7,          0),
	(     8,      10,     3,              8,          1),
	(     9,      10,     3,              9,          1),
	(    10,      10,     3,             10,          3);
