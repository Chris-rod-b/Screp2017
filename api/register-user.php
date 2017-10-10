<?php
	session_start();
	include_once 'connect_s.php';
	
	$row = pg_fetch_all(pg_query_params($connection_s, 'WITH novo_usuario AS (INSERT INTO usuario (login, email, senha, excluido) VALUES ($1, $2, MD5($3), '."'".'n'."'".') RETURNING id_usuario) INSERT INTO cliente (id_usuario, nome, sobrenome, cpf, sexo, data_nasc, telefone, celular, excluido) SELECT novo_usuario.id_usuario, $4, $5, $6, $7, $8, $9, $10, '."'".'n'."'".' FROM novo_usuario RETURNING (id_usuario)', [$login=$_POST['login'], $_POST['email'], $senha=$_POST['password'], $nome=$_POST['nome'], $_POST['sobrenome'], $_POST['cpf'], $_POST['sexo'], $_POST['data_nasc'], $_POST['telefone'], $_POST['celular']]))[0];
	if($row)
	{
		$_SESSION['login'] = ['login'=>$login, 'senha'=>$senha];
		
		foreach($_POST['addresses'] as $address)
		{
			$suffix = preg_replace('/^address/', '', $address);
			pg_query_params($connection_s, 'INSERT INTO endereco (endereco, numero, complemento, bairro, cep, cidade, estado, pais, id_usuario) VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9)', [$_POST['endereco'.$suffix], $_POST['numero'.$suffix], $_POST['complemento'.$suffix], $_POST['bairro'.$suffix], $_POST['cep'.$suffix], $_POST['cidade'.$suffix], $_POST['estado'.$suffix], $_POST['pais'.$suffix], $row['id_usuario']]);
		}
	}
	
	echo $nome;
?>
