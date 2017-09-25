<?php
	session_start();
	include_once 'connect_s.php';
	if($row = pg_fetch_all(pg_query_params($connection_s, 'SELECT login, senha FROM usuario WHERE login = $1 AND senha = $2', [$_GET['username'], $_GET['senha']]))[0])
	{
		$_SESSION['login'] = ['login'=>$row['login'], 'senha'=>$row[senha]];
	}
	include 'user.php';
	$nome = $user_login_row['nome'];
	echo $nome? $nome : 'login';
?>
