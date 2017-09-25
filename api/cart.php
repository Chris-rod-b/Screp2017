<?php
	if(isset($_GET['acao']))
	{
		if($_GET['acao'] == 'add')
		{
			$codigo_botton = $_GET['botton'];
			$_SESSION['carrinho'][$codigo_botton]++;
		}
		
		if($_GET['acao'] == 'del')
		{
			$codigo_botton = $_GET['botton'];
			unset($_SESSION['carrinho'][$codigo_botton]);
		}
		
		if($_GET['acao'] == 'up')
		{
			if(is_array($_POST['botton']))
			{
				foreach($_POST['botton'] as $codigo_botton => $qtd)
				{
					$codigo_botton  = intval($codigo_botton);
					$qtd = intval($qtd);
					if(!empty($qtd) || $qtd <> 0)
					{
						$_SESSION['carrinho'][$codigo_botton] = $qtd;
					}
					else
					{
						unset($_SESSION['carrinho'][$codigo_botton]);
					}
				}
			}
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
				foreach($_SESSION['carrinho'] as $codigo_botton => $qtd)
				{
					$sql = 'SELECT (estampa.nome || '."' '".' || cor.nome) AS nome, botton.preco FROM botton, estampa, cor WHERE botton.codigo=$1 AND NOT botton.excluido AND cor.codigo = botton.codigo_cor AND estampa.codigo = botton.codigo_estampa ORDER BY (estampa.nome || '."' '".' || cor.nome)';
					$res = pg_query_params($connection, $sql, [$codigo_botton]);
					$linha = pg_fetch_array($res);
					$nome = $linha['nome'];
					$preco = $linha['preco'];
					$sub = $preco*$qtd; 
					$total += $sub;

					?>
						<tr>
							<td>Botton <?php echo $nome; ?></td>
							<td><input type="text" size="3" name="<?php echo $botton['.$codigo_botton.']; ?>" value="<?php echo $qtd; ?>" /></td>
							<td>R$ <?php echo number_format($qtd, 2, ',', '.'); ?></td>
							<td>R$ <?php echo number_format($sub, 2, ',', '.'); ?></td>
							<td><a href="cart.php?acao=del&botton='.$codigo_botton.'">remover item</a></td>
						</tr>';
					<?php
				}
				
				$total = number_format($total, 2, ',', '.');
				echo 'Total R$ '.$total;
				
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
<form method="post">
	<input type="hidden" name="" value="" />
	<button>finalizar pedido</button>
</form>
<a href="all.php">continuar comprando</a>
