<?php
	include 'connect.php';
	
	function botton_name($row)
	{
		return('Botton '.ucwords($row['nome_estampa']).' '.ucwords($row['nome_cor']));
	}
	
	if(empty($_SERVER['PATH_INFO']))
	{
		?>
			<h1>Nossos Produtos</h1>
			<?php
				foreach(pg_fetch_all(pg_query($connection, 'SELECT botton.estoque, botton.descricao, botton.codigo_estampa, botton.codigo_cor, estampa.nome as nome_estampa, cor.nome as nome_cor FROM botton, estampa, cor WHERE botton.codigo_cor = cor.codigo AND botton.codigo_estampa = estampa.codigo ORDER BY estampa.nome, cor.nome')) as $row)
				{
					$estoque = $row['estoque'];
					$descricao = $row['descricao'];
					$codigo_estampa = $row['codigo_estampa'];
					$codigo_cor = $row['codigo_cor'];
					$nome_estampa = $row['nome_estampa'];
					$nome_cor = $row['nome_cor'];
					$esgotado = $estoque <= 0;
					$url = $codigo_estampa.'-'.$codigo_cor;
					?>
						<article>
							<a href="all.php/<?php echo $url; ?>"><h2><?php echo botton_name($row); ?></h2></a>
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
						</article>
					<?php
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
		echo '<h1>'.botton_name($row).'</h1>';
	}
?>
