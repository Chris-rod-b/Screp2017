<?php
	session_start();
	include_once 'connect_s.php';
	if(pg_fetch_all(pg_query_params($connection_s, 'WITH novo_usuario AS (INSERT INTO usuario (login, email, senha, excluido) VALUES ($1, $2, MD5($3), '."'".'n'."'".') RETURNING id_usuario) INSERT INTO cliente (id_usuario, nome, sobrenome, cpf, sexo, data_nasc, telefone, celular, excluido) SELECT novo_usuario.id_usuario, $4, $5, $6, $7, $8, $9, $10, '."'".'n'."'".' FROM novo_usuario RETURNING (1)', [$login=$_POST['login'], $_POST['email'], $senha=$_POST['password'], $nome=$_POST['nome'], $_POST['sobrenome'], $_POST['cpf'], $_POST['sexo'], $_POST['data_nasc'], $_POST['telefone'], $_POST['celular']])))
	{
		$_SESSION['login'] = ['login'=>$login, 'senha'=>$senha];
	}
	echo $nome;
?>
