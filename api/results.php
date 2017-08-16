<?php
	include_once 'connect.php';
	include_once 'botton_body.php';
	
	$offset = $_GET['offset'];
	$limit = 10;
	
	$rows = pg_fetch_all(pg_query_params($connection, 'SELECT botton.estoque, botton.descricao, estampa.codigo AS codigo_estampa, cor.codigo AS codigo_cor, (estampa.nome || '."' '".' || cor.nome) AS nome FROM botton, cor, estampa WHERE botton.codigo_cor = cor.codigo AND botton.codigo_estampa = estampa.codigo AND ($1::TEXT IS NULL OR $1 = '."''".' OR EXISTS(SELECT * FROM (SELECT UNNEST(ARRAY_REMOVE(STRING_TO_ARRAY($1, '."' '".'), '."''".')) AS c) AS q, (SELECT UNNEST((STRING_TO_ARRAY(estampa.nome, '."' '".') || STRING_TO_ARRAY(cor.nome, '."' '".'))) AS c) AS d WHERE LOWER(q.c) = LOWER(d.c))) ORDER BY estampa.nome, cor.nome LIMIT $2 OFFSET $3', [$query, $limit, $offset]));
	
	if(empty($rows))
	{
		?>
			<p>Nenhum produto encontrado.</p>
		<?php
	}
	else
	{
		foreach($rows as $row)
		{
			echo '<article class="botton">';
			botton_body($row, true, 2);
			echo '</article>';
		}
	}
	
?>
