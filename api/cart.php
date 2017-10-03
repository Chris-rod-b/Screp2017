<?php
	include_once 'connect.php';
	include_once 'user.php';
	
	if(isset($user_login_row))
	{
		if(isset($_GET['acao']))
		{
			if($_GET['acao'] === 'add')
			{
				$codigo_botton = $_GET['botton'];
				$sql = 'WITH t AS (UPDATE item_cart SET quantidade = quantidade + 1 WHERE codigo_botton = $1 RETURNING codigo)
				        INSERT INTO item_cart
				            (codigo_cliente, codigo_botton, quantidade)
				            SELECT $2, $1, 1 WHERE NOT EXISTS (SELECT codigo FROM t)';
				pg_query_params($connection, $sql, [$codigo_botton, $user_login_row['id_usuario']]);
			}
			
			if($_GET['acao'] === 'del')
			{
				$codigo_botton = $_GET['botton'];
				pg_query_params($connection, 'DELETE FROM item_cart WHERE codigo_botton = $1', [$codigo_botton]);
			}
		}
		?>
			<h4>Carrinho de Compras</h4>
			<table>
				<thead>
					<tr>
						<th>Produto</th>
						<th>Quantidade</th>
						<th>Preço</th>
						<th>Subtotal</th>
						<th>Remover</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<?php
							include_once 'connect.php';
							$total = 0;
							foreach(pg_fetch_all(pg_query_params($connection, 'SELECT item_cart.codigo_botton, item_cart.quantidade, (estampa.nome || '."' '".' || cor.nome) AS nome, botton.preco FROM item_cart, botton, estampa, cor WHERE botton.codigo = item_cart.codigo_botton AND NOT botton.excluido AND cor.codigo = botton.codigo_cor AND estampa.codigo = botton.codigo_estampa ORDER BY estampa.nome, cor.nome', []))?:[] as $linha)
							{
								$codigo_botton = $linha['codigo_botton'];
								$qtd = $linha['quantidade'];
								$nome = $linha['nome'];
								$preco = $linha['preco'];
								$sub = $preco*$qtd; 
								$total += $sub;
								
								?>
									<tr>
										<td>Botton <?php echo $nome; ?></td>
										<td><input type="number" size="3" min="1" max="999" name="qtde-<?php echo $botton[$codigo_botton]; ?>" value="<?php echo $qtd; ?>" /></td>
										<td>R$ <?php echo number_format($preco, 2, ',', '.'); ?></td>
										<td>R$ <?php echo number_format($sub, 2, ',', '.'); ?></td>
										<td><a href="cart.php?acao=del&botton=<?php echo $codigo_botton; ?>">remover item</a></td>
									</tr>
								<?php
							}
							
							if(isset($_POST['enviar']))
							{
								foreach($_SESSION['carrinho'] as $inseri_botton => $quantidade)
								{
									$Sql = pg_query("INSERT INTO item (codigo_botton, preco, quantidade) VALUES ('$inseri_botton', '$preco', '$quantidade')");
								}
							}
						?>
					</tr>
				</tbody>
			</table>
			<p>
				Total: R$
				<?php
					echo number_format($total, 2, ',', '.');
				?>
			</p>
			<form method="post">
				<p>
					<input type="hidden" name="final" value="true" />
					<button>finalizar pedido</button>
				</p>
			</form>
			<p>
				<a href="all.php">continuar comprando</a>
			</p>
		<?php
	}
	else
	{
		?>
			<p>Você tem que estar logado para ver o seu carrinho.</p>
		<?php
	}
?>
