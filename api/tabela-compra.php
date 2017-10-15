<?php
function tabela($rows)
{
	?>
		<table>
			<thead>
				<tr>
					<th>Nome</th>
					<th>Quantidade</th>
					<th>Preço Unitário</th>
					<th>Subtotal</th>
				</tr>
			</thead>
			<tbody>
				<?php
					foreach($rows as $row)
					{
						?>
							<tr>
								<td><?php echo $row['nome']; ?></td>
								<td><?php echo $row['quantidade']; ?></td>
								<td>R$ <?php echo number_format($row['preco_botton'], 2, ',', '.'); ?></td>
								<td>R$ <?php echo number_format($row['subtotal'], 2, ',', '.'); ?></td>
							</tr>
						<?php
					}
				?>
			</tbody>
		</table>
	<?php
}
