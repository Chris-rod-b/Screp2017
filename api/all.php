<?php
	include_once 'connect.php';
	include_once 'botton_body.php';
	
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
			</form>
		<?php
		
		if(empty($query))
		{
			?>
				<p id="newproduct-p">
					<a href="edit.php" class="icon-button" id="newproduct-button">
						<img src="images/new.svg" alt="adicionar ou editar produto" />
					</a>
				</p>
			<?php
		}
		
		include 'results.php';
	}
	else
	{
		$info = explode('-', basename($_SERVER['PATH_INFO']), 2);
		echo '<div class="botton">';
		botton_body(pg_fetch_all(pg_query_params($connection, 'SELECT botton.estoque, botton.descricao, botton.codigo_estampa, botton.codigo_cor, (estampa.nome || '."' '".' || cor.nome) AS nome, botton.codigo FROM botton, estampa, cor WHERE botton.codigo_cor = cor.codigo AND botton.codigo_estampa = estampa.codigo AND cor.codigo = $2 AND estampa.codigo = $1', array($info[0], $info[1])))[0], false, 1);
		echo '</div>';
	}
?>
