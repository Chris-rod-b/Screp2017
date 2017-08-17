<?php
	include_once 'connect.php';
	
	$color = $_GET['color'];
	$stamp = $_GET['stamp'];
	
	$done = isset($color) && isset($_GET['stamp']);
	if($done)
	{
		$color_name = pg_fetch_all(pg_query_params($connection, 'SELECT nome FROM cor WHERE codigo = $1', [$color]))[0]['nome'];
		$stamp_name = pg_fetch_all(pg_query_params($connection, 'SELECT nome FROM estampa WHERE codigo = $1', [$stamp]))[0]['nome'];
	}
?>
<form id="newproduct-form" action="<?php if($done) echo 'api/complete.php" method="post'; else echo 'about:blank'; ?>">
	<p>
		<label for="stamp">
			Estampa:
		</label>
	</p>
	<p>
		<select name="stamp" id="stamp" required<?php if($done) echo ' disabled'; ?>>
			<?php
				if($done)
				{
					echo '<option>'.$stamp_name.'</option>';
				}
				else
				{
					echo '<option></option>';
					foreach(pg_fetch_all(pg_query($connection, 'SELECT codigo, nome FROM estampa ORDER BY nome')) as $row)
					{
						echo '<option value="'.$row['codigo'].'">'.$row['nome'].'</option>';
					}
				}
			?>
		</select>
	</p>
	<p>
		<label for="color">
			Cor:
		</label>
	</p>
	<p>
		<select name="color" id="color" required<?php if($done) echo ' disabled'; ?>>
			<?php
				if($done)
				{
					echo '<option>'.$color_name.'</option>';
				}
				else
				{
					echo '<option></option>';
					foreach(pg_fetch_all(pg_query($connection, 'SELECT codigo, nome FROM cor ORDER BY nome')) as $row)
					{
						echo '<option value="'.$row['codigo'].'">'.$row['nome'].'</option>';
					}
				}
			?>
		</select>
	</p>
	<?php
		if($done)
		{
			include 'continue.php';
		}
		else
		{
			?>
				<p id="replace-continue">
					<button id="disable-continue">continuar</button>
				</p>
			<?php
		}
	?>
</form>
