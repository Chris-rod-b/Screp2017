DROP TABLE IF EXISTS item;
DROP TABLE IF EXISTS venda;
DROP TABLE IF EXISTS botton;
DROP TABLE IF EXISTS cor;
DROP TABLE IF EXISTS estampa;
DROP TABLE IF EXISTS item_cart;

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
