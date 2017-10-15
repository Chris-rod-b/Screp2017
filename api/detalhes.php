<?php
	include_once 'connect.php';
	include_once 'tabela-compra.php';
	
	$sql = 'SELECT '."'".'Botton'."'".'||'."' '".'||estampa.nome||'."' '".'||cor.nome AS nome, item.quantidade, item.preco_botton, item.quantidade*item.preco_botton AS subtotal FROM item, botton, cor, estampa WHERE botton.codigo = item.codigo_botton AND cor.codigo = botton.codigo_cor AND estampa.codigo = botton.codigo_estampa AND item.codigo_venda = $1 ORDER BY estampa.nome, cor.nome';
	
	tabela(pg_fetch_all(pg_query_params($connection, $sql, [$_GET['codigo']])));
?>
