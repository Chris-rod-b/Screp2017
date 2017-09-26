<?php
	function botton_body($row, $link = true, $h = 1)
	{
		$estoque = $row['estoque'];
		$descricao = $row['descricao'];
		$codigo_estampa = $row['codigo_estampa'];
		$codigo_cor = $row['codigo_cor'];
		$nome = $row['nome'];
		if($link)
		{
			$href = ' href="all.php/'.$codigo_estampa.'-'.$codigo_cor.'"';
		}
		
		$esgotado = $estoque <= 0;
		
		?>
			<a<?php echo $href; ?>>
				<h<?php echo $h; ?>>
					Botton <?php echo ucwords($nome); ?>
				</h<?php echo $h; ?>>
			</a>
			<p class="botton-image">
				<a<?php echo $href; ?>>
					<img src="images/botton.svg" alt="imagem do botton" />
				</a>
			</p>
			<p>
				Estoque: <?php echo $estoque; ?>
			</p>
			<?php
				if(!empty($descricao))
				{
					echo '<p>'.$descricao.'</p>';
				}
			?>
			
			<p>
				<a href="cart.php?acao=add&botton=<?php echo $row['codigo']; ?>" class="icon-button">
					<img src="images/add.svg" alt="adicionar ao carrinho" />
				</a>
			</p>
			<p>
				<a href="edit.php?<?php echo 'stamp='.$codigo_estampa.'&color='.$codigo_cor; ?>" class="icon-button">
					<img src="images/edit.svg" alt="editar item" />
				</a>
			</p>
		<?php
	}
?>
