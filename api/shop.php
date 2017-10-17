<?php
	include_once 'connect.php';
	include_once 'user.php';
	$sql = 'WITH v AS (INSERT INTO venda (codigo_cliente, concretizacao) VALUES ($1, LOCALTIMESTAMP) RETURNING codigo), i AS (SELECT botton.codigo, item_cart.quantidade, botton.preco FROM item_cart, botton WHERE item_cart.codigo_cliente = $1 AND item_cart.codigo_botton = botton.codigo AND item_cart.quantidade <= botton.estoque), s AS (INSERT INTO item (codigo_venda, codigo_botton, preco_botton, quantidade) SELECT v.codigo, i.codigo, i.preco, i.quantidade FROM v, i), g AS (DELETE FROM item_cart WHERE item_cart.codigo_cliente = $1) UPDATE botton SET estoque = botton.estoque - i.quantidade FROM i, v WHERE botton.codigo = i.codigo RETURNING v.codigo';
	$codigo_venda = pg_fetch_all(pg_query_params($connection, $sql, [$user_login_row['id_usuario']]))[0]['codigo'];
	http_response_code(303);
	$location = dirname(dirname($_SERVER['SCRIPT_NAME']));
	if(substr($location, -1) !== '/')
	{
		$location .= '/';
	}
	$location .= 'compras.php';
	header('location: '.$location);
	
	include("PHPMailer/class.phpmailer.php");
	include("PHPMailer/class.smtp.php");
	
	include "user.php";
	include "connect_s.php";
	include "connect.php";
	
	$email = $user_login_row['email'];
	$nome = $user_login_row['nome'];
	
	$mail = new PHPMailer(TRUE);
	$mail->IsSMTP();
	$mail->Host = "smtp.gmail.com";
	$mail->SMTPAuth = TRUE;
	$mail->SMTPSecure = 'ssl';
	$mail->Port = 465;
	$mail->Username = 'screpbottons10@gmail.com';
	$mail->Password = 'screp1234';
	$mail->SetFrom("screpbottons10@gmail.com", "Screp Bottons");
	$mail->AddAddress($email, $nome);
	$mail->AddAddress($email);
	
	$sql = 'SELECT '."'".'Botton'."'".'||'."' '".'||estampa.nome||'."' '".'||cor.nome AS nome, item.quantidade, botton.preco AS preco_botton, item.quantidade*botton.preco AS subtotal FROM item, botton, cor, estampa, venda WHERE item.codigo_venda = venda.codigo AND venda.codigo_cliente = $1 AND venda.codigo = $2 AND botton.codigo = item.codigo_botton AND cor.codigo = botton.codigo_cor AND estampa.codigo = botton.codigo_estampa ORDER BY estampa.nome, cor.nome';
	
	$rows = pg_fetch_all(pg_query_params($connection, $sql, [$user_login_row['id_usuario'], $codigo_venda]));
	
	$email_body = '
		<table>
			<thead>
				<tr>
					<th>Nome</th>
					<th>Quantidade</th>
					<th>Preço Unitário</th>
					<th>Subtotal</th>
				</tr>
			</thead>
			<tbody>';
	foreach($rows as $row)
	{
		$email_body .='
			<tr>
				<td>'.$row['nome'].'</td>
				<td>'.$row['quantidade'].'</td>
				<td>R$ '.number_format($row['preco_botton'], 2, ',', '.').'</td>
				<td>R$ '.number_format($row['subtotal'], 2, ',', '.').'</td>
			</tr>';
	}
	$email_body .= '</tbody></table>';
	
	//$mail->IsMail();// Define que o e-mail será enviado como HTML
	$mail->CharSet = 'utf-8'; 
	$mail->IsHTML(TRUE);
	
	$mail->Subject = "Confirmação de dados";
	$mail->Body = $email_body;
	$mail->AltBody = "Email para informar o relátorio de compras, caso tenha alguma duvida entre em contato conosco.";
	
	// Envia o e-mail
	$enviado = $mail->Send();
	$mail->ClearAllRecipients();
	$mail->ClearAttachments();
?>
<!doctype html>
<html lang="pt">
	<head>
		<meta charset="utf-8" />
		<title>Compra Efetuada</title>
	</head>
	<body>
		<p>
			A compra foi efetuada com sucesso. Você pode ir para <a href="<?php echo $location; ?>">o seu histórico</a>.
		</p>
	</body>
</html>
