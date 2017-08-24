<?php
	$color = $_POST['color'];
	$stamp = $_POST['stamp'];
	$descr = $_POST['description'];
	$stock = $_POST['stock'];
	
	http_response_code(303);
	$location = dirname(dirname($_SERVER['SCRIPT_NAME']));
	if(substr($location, -1) !== '/')
	{
		$location .= '/';
	}
	$location .= 'all.php/'.$stamp.'-'.$color;
	header('location: '.$location);
	
	include_once 'connect.php';
	
	if(isset($_POST['new']))
	{
		$sql = 'INSERT INTO botton (codigo_estampa, codigo_cor, descricao, estoque, preco) VALUES ($1, $2, $3, $4, 5)';
	}
	else
	{
		$sql = 'UPDATE botton SET descricao = $3, estoque = $4 WHERE codigo_estampa = $1 AND codigo_cor = $2';
	}
	pg_query_params($connection, $sql, [$stamp, $color, $descr, $stock]);
?>
<!doctype html>
<html lang="pt">
	<head>
		<meta charset="utf-8" />
		<title>Produto Salvo</title>
	</head>
	<body>
		<p>
			O produto foi salvado corretamente. Você pode ir para <a href="<?php echo $location; ?>">a página do produto</a>.
		</p>
	</body>
</html>
