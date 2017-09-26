<?php
	include_once 'connect.php';
	include_once 'botton_body.php';
	
	$rows = pg_fetch_all(pg_query_params($connection, 'SELECT botton.estoque, botton.descricao, estampa.codigo AS codigo_estampa, cor.codigo AS codigo_cor, (estampa.nome || '."' '".' || cor.nome) AS nome, botton.codigo FROM botton, cor, estampa WHERE botton.codigo_cor = cor.codigo AND botton.codigo_estampa = estampa.codigo AND ($1::TEXT IS NULL OR $1 = '."''".' OR EXISTS(SELECT * FROM (SELECT UNNEST(ARRAY_REMOVE(STRING_TO_ARRAY($1, '."' '".'), '."''".')) AS c) AS q, (SELECT UNNEST((STRING_TO_ARRAY(estampa.nome, '."' '".') || STRING_TO_ARRAY(cor.nome, '."' '".'))) AS c) AS d WHERE LOWER(q.c) = LOWER(d.c))) ORDER BY estampa.nome, cor.nome LIMIT $2 OFFSET $3', [$_GET['query'], 10, $_GET['offset']]));
	
	if(empty($rows))
	{
		?>
			<p>Fim dos resultados de pesquisa.</p>
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
		
		?>
			<p class="replace-more">
				<button class="load-more">carregar mais</button>
			</p>
		<?php
	}
?>
