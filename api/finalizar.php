<?php
	include_once 'tabela-compra.php';
	include_once 'connect.php';
	
	$sql = 'SELECT '."'".'Botton'."'".'||'."' '".'||estampa.nome||'."' '".'||cor.nome AS nome, item_cart.quantidade, botton.preco AS preco_botton, item_cart.quantidade*botton.preco AS subtotal FROM item_cart, botton, cor, estampa WHERE botton.codigo = item_cart.codigo_botton AND cor.codigo = botton.codigo_cor AND estampa.codigo = botton.codigo_estampa ORDER BY estampa.nome, cor.nome';
	tabela(pg_fetch_all(pg_query($connection, $sql)));
	
	include_once 'user.php';
	include_once 'connect_s.php';
	
	$sql = 'SELECT endereco, numero, complemento, bairro, cep, cidade, estado, pais FROM endereco WHERE id_usuario = $1';
	
	include_once 'endereco.php';
	
	endereco(pg_fetch_all(pg_query_params($connection_s, $sql, [$user_login_row['id_usuario']])));
?>
<p>
	<a href="api/shop.php">finalizar pedido</a>
</p>
