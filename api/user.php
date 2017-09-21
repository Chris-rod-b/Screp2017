<?php
	session_start();
	include_once 'connect_s.php';
	$login = $_SESSION['login'];
	if(isset($login))
	{
		$user_login_row = pg_fetch_all(pg_query_params($connection_s, 'SELECT usuario.id_usuario, usuario.login, usuario.email, cliente.id_usuario AS id_cliente, cliente.nome, cliente.sobrenome, cliente.cpf FROM usuario RIGHT JOIN cliente ON usuario.id_usuario = cliente.id_usuario WHERE usuario.login = $1 AND usuario.senha = $2', [$login['login'], $login['senha']]))[0];
		$user_login_admin = $user_login_row['id_usuario'] !== $user_login_row['id_cliente'];
	}
?>
