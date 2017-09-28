<?php
	if(isset($_GET['acao']))
	{
		if($_GET['acao'] === 'add')
		{
			$codigo_botton = $_GET['botton'];
			$_SESSION['carrinho'][$codigo_botton]++;
		}
		
		if($_GET['acao'] === 'del')
		{
			$codigo_botton = $_GET['botton'];
			unset($_SESSION['carrinho'][$codigo_botton]);
		}
		
		if($_GET['acao'] === 'up')
		{
			if(is_array($_POST['botton']))
			{
				foreach($_POST['botton'] as $codigo_botton=>$qtd)
				{
					$qtd = intval($qtd);
					if(empty($qtd) && $qtd === 0)
					{
						unset($_SESSION['carrinho'][$codigo_botton]);
					}
					else
					{
						$_SESSION['carrinho'][$codigo_botton] = $qtd;
					}
				}
			}
		}
	}
?>
<h1>Carrinho de Compras</h1>
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
				foreach($_SESSION['carrinho'] as $codigo_botton=>$qtd)
				{
					$sql = 'SELECT (estampa.nome || '."' '".' || cor.nome) AS nome, botton.preco FROM botton, estampa, cor WHERE botton.codigo=$1 AND NOT botton.excluido AND cor.codigo = botton.codigo_cor AND estampa.codigo = botton.codigo_estampa ORDER BY (estampa.nome || '."' '".' || cor.nome)';
					$res = pg_query_params($connection, $sql, [$codigo_botton]);
					$linha = pg_fetch_all($res)[0];
					$nome = $linha['nome'];
					$preco = $linha['preco'];
					$sub = $preco*$qtd; 
					$total += $sub;
					
					?>
						<tr>
							<td>Botton <?php echo $nome; ?></td>
							<td><input type="number" size="3" min="0" max="999" name="qtde-<?php echo $botton['.$codigo_botton.']; ?>" value="<?php echo $qtd; ?>" /></td>
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
