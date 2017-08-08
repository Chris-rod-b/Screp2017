<h1>Nossos Produtos</h1>
<?php
	include 'connect.php';
	
	foreach(pg_fetch_all(pg_query($connection, 'SELECT botton.estoque, botton.descricao, botton.codigo_estampa, botton.codigo_cor, estampa.nome as nome_estampa, cor.nome as nome_cor FROM botton, estampa, cor WHERE botton.codigo_cor = cor.codigo AND botton.codigo_estampa = estampa.codigo ORDER BY estampa.nome, cor.nome')) as $row)
	{
		$estoque = $row['estoque'];
		$descricao = $row['descricao'];
		$codigo_estampa = $row['codigo_estampa'];
		$codigo_cor = $row['codigo_cor'];
		$nome_estampa = $row['nome_estampa'];
		$nome_cor = $row['nome_cor'];
		$esgotado = $estoque <= 0;
		?>
			<article>
				<a href="all.php/<?php echo $codigo_estampa.'-'.$codigo_cor; ?>"><h2>Botton <?php echo ucwords($nome_estampa).' '.ucwords($nome_cor); ?></h2></a>
				
			</article>
		<?php
	}
?>
