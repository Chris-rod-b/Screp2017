<?php
	include 'connect.php';
	
	function botton_body($row, $link = true, $h = 1)
	{
		$estoque = $row['estoque'];
		$descricao = $row['descricao'];
		$codigo_estampa = $row['codigo_estampa'];
		$codigo_cor = $row['codigo_cor'];
		$nome_estampa = $row['nome_estampa'];
		$nome_cor = $row['nome_cor'];
		if($link)
		{
			$href = ' href="all.php/'.$codigo_estampa.'-'.$codigo_cor.'"';
		}
		// $esgotado = $estoque <= 0;
		?>
			<a<?php echo $href; ?>>
				<h<?php echo $h; ?>>
					Botton <?php echo ucwords($nome_estampa).' '.ucwords($nome_cor); ?>
				</h<?php echo $h; ?>>
			</a>
			<p class="botton-image">
				<a<?php echo $href; ?>>
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
	
	?>
		<template id="edit-botton">
			<form method="post" class="newproduct-form">
				<p>
					<label data-for="color">
						Cor:
					</label>
				</p>
				<p>
					<select name="color" data-id="color" required></select>
				</p>
				<p>
					<label data-for="stamp">
						Estampa:
					</label>
				</p>
				<p>
					<select name="stamp" data-id="stamp" required></select>
				</p>
				<p>
					<label data-for="stock">
						Estoque:
					</label>
				</p>
				<p>
					<input type="number" name="stock" data-id="stock" class="input-block" min="0" step="1" value="1" required />
				</p>
				<p>
					<button>salvar</button>
					<button type="button" class="cancel">cancelar</button>
				</p>
			</form>
		</template>
	<?php
	
	if(empty($_SERVER['PATH_INFO']))
	{
		?>
			<h1>Nossos Produtos</h1>
			<details>
				<summary>Filtros</summary>
				<form>
					<p>
						<label for="search-query">
							Pesquisar:
						</label>
					</p>
					<p>
						<input type="search" class="input-block" name="query" id="search-query" required />
					</p>
					<fieldset id="search-colors">
						<legend>Cor</legend>
						<div>
							<?php
								foreach(pg_fetch_all(pg_query($connection, 'SELECT codigo, nome, r, g, b FROM cor ORDER BY nome')) as $row)
								{
									$r = $row['r'];
									$g = $row['g'];
									$b = $row['b'];
									
									$cs = ['r'=>$r, 'g'=>$g, 'b'=>$b];
									
									foreach($cs as &$c)
									{
										$c = $c / 255;
										if($c <= 0.04045)
										{
											$c = $c/12.92;
										}
										else
										{
											$c = (($c+0.055)/1.055) ^ 2.4;
										}
									}
									$l = 0.2126 * $cs['r'] + 0.7152 * $cs['g'] + 0.0722 * $cs['b'];
									if(0.179 < $l)
									{
										$f = 'rgba(0, 0, 0, 0.85)';
									}
									else
									{
										$f = 'rgba(255, 255, 255, 0.85)';
									}
									echo '<p style="background: rgb('.$r.', '.$g.', '.$b.'); color: '.$f.';"><label><input type="checkbox" name="color[]" value="'.$row['codigo'].'" /> '.ucfirst($row['nome']).'</label></p>';
								}
							?>
						</div>
					</fieldset>
					<p>
						<label for="search-stamp">
							Estampa:
						</label>
					</p>
					<p>
						<select multiple name="stamp" id="search-stamp">
							<?php
								foreach(pg_fetch_all(pg_query($connection, 'SELECT codigo, nome FROM estampa ORDER BY nome')) as $row)
								{
									echo '<option value="'.$row['name'].'">'.$row['nome'].'</option>';
								}
							?>
						</select>
					</p>
				</form>
			</details>
			<?php
				foreach(pg_fetch_all(pg_query($connection, 'SELECT botton.estoque, botton.descricao, botton.codigo_estampa, botton.codigo_cor, estampa.nome as nome_estampa, cor.nome as nome_cor FROM botton, estampa, cor WHERE botton.codigo_cor = cor.codigo AND botton.codigo_estampa = estampa.codigo ORDER BY estampa.nome, cor.nome')) as $row)
				{
					echo '<article class="botton">';
					botton_body($row, true, 2);
					echo '</article>';
				}
			?>
			<p id="newproduct-p">
				<button type="button" class="icon-button" id="newproduct-button">
					<img src="images/new.svg" alt="adicionar produto" />
				</button>
			</p>
		<?php
	}
	else
	{
		$info = explode('-', basename($_SERVER['PATH_INFO']), 2);
		$row = pg_fetch_all(pg_query_params($connection, 'SELECT botton.estoque, botton.descricao, botton.codigo_estampa, botton.codigo_cor, estampa.nome as nome_estampa, cor.nome as nome_cor FROM botton, estampa, cor WHERE botton.codigo_cor = cor.codigo AND botton.codigo_estampa = estampa.codigo AND cor.codigo = $2 AND estampa.codigo = $1', array($info[0], $info[1])))[0];
		echo '<div class="botton">';
		botton_body($row, false, 1);
		echo '</div>';
	}
?>
