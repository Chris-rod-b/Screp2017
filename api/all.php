<?php
	include 'connect.php';
	
	function botton_name($row)
	{
		echo 'Botton '.ucwords($row['nome_estampa']).' '.ucwords($row['nome_cor']);
	}
	
	function botton_body($row, $h = 1)
	{
		$estoque = $row['estoque'];
		$descricao = $row['descricao'];
		// $esgotado = $estoque <= 0;
		?>
			<p class="botton-image">
				<a href="all.php/<?php echo $url; ?>">
					<img src="images/botton.svg" alt="imagem do botton" />
				</a>
			</p>
			<p>
				Estoque: <?php echo $estoque; ?>
			</p>
			<?php
				if(!empty($descricao))
				{
					echo '<p>'.$descricao.'</p>';
				}
			?>
			
			<p>
				<button type="button" class="icon-button">
					<img src="images/add.svg" alt="adicionar ao carrinho" />
				</button>
			</p>
			<p>
				<button class="icon-button">
					<img src="images/edit.svg" alt="editar item" />
				</button>
			</p>
		<?php
	}
	
	if(empty($_SERVER['PATH_INFO']))
	{
		?>
			<h1>Nossos Produtos</h1>
			<?php
				foreach(pg_fetch_all(pg_query($connection, 'SELECT botton.estoque, botton.descricao, botton.codigo_estampa, botton.codigo_cor, estampa.nome as nome_estampa, cor.nome as nome_cor FROM botton, estampa, cor WHERE botton.codigo_cor = cor.codigo AND botton.codigo_estampa = estampa.codigo ORDER BY estampa.nome, cor.nome')) as $row)
				{
					$codigo_estampa = $row['codigo_estampa'];
					$codigo_cor = $row['codigo_cor'];
					$url = $codigo_estampa.'-'.$codigo_cor;
					echo '<article class="botton">';
					echo '<a href="all.php/'.$url.'"><h2>';
					botton_name($row);
					echo '</h2></a>';
					botton_body($row);
					echo '</article>';
				}
			?>
			<p>
				<button type="button" class="icon-button newproduct-button">
					<img src="images/new.svg" alt="adicionar produto" />
				</button>
			</p>
		<?php
	}
	else
	{
		$info = explode('-', basename($_SERVER['PATH_INFO']), 2);
		$row = pg_fetch_all(pg_query_params($connection, 'SELECT botton.estoque, botton.descricao, botton.codigo_estampa, botton.codigo_cor, estampa.nome as nome_estampa, cor.nome as nome_cor FROM botton, estampa, cor WHERE botton.codigo_cor = cor.codigo AND botton.codigo_estampa = estampa.codigo AND cor.codigo = $2 AND estampa.codigo = $1', array($info[0], $info[1])))[0];
		echo '<div class="botton"><h1>';
		botton_name($row);
		echo '</h1>';
		botton_body($row);
		echo '</div>';
	}
?>
