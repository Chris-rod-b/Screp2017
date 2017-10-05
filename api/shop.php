<?php
	include_once 'connect.php';
	include_once 'user.php';
	$sql = 'WITH v AS (INSERT INTO venda (codigo_cliente, concretizacao) VALUES ($1, LOCALTIMESTAMP) RETURNING codigo), i AS (SELECT botton.codigo, item_cart.quantidade, botton.preco FROM item_cart, botton WHERE item_cart.codigo_cliente = $1 AND item_cart.codigo_botton = botton.codigo AND item_cart.quantidade <= botton.estoque), s AS (INSERT INTO item (codigo_venda, codigo_botton, preco_botton, quantidade) SELECT v.codigo, i.codigo, i.preco, i.quantidade FROM v, i), g AS (DELETE FROM item_cart WHERE item_cart.codigo_cliente = $1) UPDATE botton SET estoque = botton.estoque - i.quantidade FROM i WHERE botton.codigo = i.codigo';
	pg_query_params($connection, $sql, [$user_login_row['id_usuario']]);
	http_response_code(303);
	$location = dirname(dirname($_SERVER['SCRIPT_NAME']));
	if(substr($location, -1) !== '/')
	{
		$location .= '/';
	}
	$location .= 'home.php';
	header('location: '.$location);
?>
