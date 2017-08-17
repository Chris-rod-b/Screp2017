<?php
	include_once 'connect.php';
	include_once 'botton_body.php';
	
	?>
		<template id="edit-botton">
			<form method="post" class="newproduct-form">
				<p>
					<label data-for="color">
						Cor:
					</label>
				</p>
				<p>
					<select name="color" data-id="color" required>
						<?php
							foreach(pg_fetch_all(pg_query($connection, 'SELECT codigo, nome FROM cor ORDER BY nome')) as $row)
							{
								echo '<option value="'.$row['codigo'].'">'.$row['nome'].'</option>';
							}
						?>
					</select>
				</p>
				<p>
					<label data-for="stamp">
						Estampa:
					</label>
				</p>
				<p>
					<select name="stamp" data-id="stamp" required>
						<?php
							foreach(pg_fetch_all(pg_query($connection, 'SELECT codigo, nome FROM estampa ORDER BY nome')) as $row)
							{
								echo '<option value="'.$row['codigo'].'">'.$row['nome'].'</option>';
							}
						?>
					</select>
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
					<label data-for="description">
						Descrição:
					</label>
				</p>
				<p>
					<textarea name="description" data-id="description"></textarea>
				</p>
				<p>
					<button class="edit-botton-save">salvar</button>
					<button type="button" class="edit-botton-cancel">cancelar</button>
				</p>
			</form>
		</template>
	<?php
	
	if(empty($_SERVER['PATH_INFO']))
	{
		$query = $_GET['query'];
		?>
			<h1>Nossos Produtos</h1>
			<form>
				<p>
					<label>
						Termos de pesquisa: <input type="search" class="input-block" name="query"<?php if(isset($query)) echo ' value="'.htmlspecialchars($query).'"'; ?> />
					</label>
					<button>pesquisar</button>
				</p>
				<?php
					/*
				?>
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
					<fieldset>
						<legend>Estampa</legend>
						<div>
							<?php
								foreach(pg_fetch_all(pg_query($connection, 'SELECT codigo, nome FROM estampa ORDER BY nome')) as $row)
								{
									echo '<p><label><input type="checkbox" value="'.$row['codigo'].'" name="stamp[]"> '.ucfirst($row['nome']).'</label></p>';
								}
							?>
						</div>
					</fieldset>
				</p>
				<?php
					*/
				?>
			</form>
		<?php
		
		include 'results.php';
		
		if(empty($query))
		{
			?>
				<p id="newproduct-p">
					<button type="button" class="icon-button" id="newproduct-button">
						<img src="images/new.svg" alt="adicionar produto" />
					</button>
				</p>
			<?php
		}
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
