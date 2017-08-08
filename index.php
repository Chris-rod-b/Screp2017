<?php
	header('location: '.dirname($_SERVER['SCRIPT_NAME']).'home.php');
	http_response_code(308);
	include 'api/redirect.php';
?>
<!doctype html>
<html lang="pt">
	<head>
		<meta charset="utf-8" />
		<title>Redirecionamento</title>
	</head>
	<body>
		<p>
			Caso você não tenha sido redirecionado automaticamente, por favor vá para <a href="<?php echo dirname($_SERVER['SCRIPT_NAME']);?>/home.php">a nossa página inicial</a>.
		</p>
	</body>
</html>
