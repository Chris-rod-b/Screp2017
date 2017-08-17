<?php
	include_once 'connect.php';
	
	if(!$done)
	{
		$color = $_GET['color'];
		$stamp = $_GET['stamp'];
		$color_name = pg_fetch_all(pg_query_params($connection, 'SELECT nome FROM cor WHERE codigo = $1', [$color]))[0]['nome'];
		$stamp_name = pg_fetch_all(pg_query_params($connection, 'SELECT nome FROM estampa WHERE codigo = $1', [$stamp]))[0]['nome'];
	}
	$row = pg_fetch_all(pg_query_params($connection, 'SELECT estoque, descricao FROM botton WHERE codigo_cor = $1 AND codigo_estampa = $2', [$color, $stamp]))[0];
?>
<p>
	<input type="hidden" name="color" value="<?php echo $color; ?>" />
	<input type="hidden" name="stamp" value="<?php echo $stamp; ?>" />
	<?php
		if(isset($row))
		{
			echo '<strong>Alterando';
		}
		else
		{
			echo '<input type="hidden" name="new" value="true" /><strong>Inserindo';
		}
		echo '</strong> botton '.$stamp_name.' '.$color_name.'.';
	?>
</p>
<p>
	<label for="stock">
		Estoque:
	</label>
</p>
<p>
	<input type="number" name="stock" id="stock" class="input-block" min="0" step="1" required<?php if(isset($row)) echo ' value="'.$row['estoque'].'"'; ?> />
</p>
<p>
	<label for="description">
		Descrição:
	</label>
</p>
<p>
	<textarea name="description" id="description"<?php if(isset($row)) echo ' value="'.$row['descricao'].'"'?>></textarea>
</p>
<p>
	<button class="edit-botton-save">salvar</button>
</p>
