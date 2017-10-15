<h1>Compras realizadas</h1>
<table>
	<thead>
		<tr>
			<th>Data</th>
			<th>Código</th>
			<th>Sobre</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<?php
				include_once 'connect.php';
				include_once 'user.php';
				foreach(pg_fetch_all(pg_query_params($connection, 'SELECT concretizacao, codigo FROM venda WHERE codigo_cliente = $1', [$user_login_row['id_usuario']])) as $linha)
				{
					$data = $linha['concretizacao'];
					$cod= $linha['codigo'];
					$preco = $linha['preco'];
					
					?>
						<tr>
							<td><?php echo $data; ?></td>
							<td><?php echo $cod; ?></td>
							<td><a href="detalhes.php?codigo=<?php echo $cod; ?>">Detalhes</a>
						</tr>
					<?php
				}
			?>
		</tr>
	</tbody>
</table>