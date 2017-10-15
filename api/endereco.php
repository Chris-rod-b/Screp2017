<?php
	function endereco($enderecos)
	{
		foreach($enderecos as $endereco)
		{
			?>
				<details>
					<summary><span class="address-name">Endereço</span> <button type="button" class="delete-address">excluir</button></summary>
					<p>
						<label data-for="country">País*:</label>
					</p>
					<p>
						<input data-id="country" class="input-block" data-name="pais" required value="<?php echo $endereco['pais']; ?>" />
					</p>
					
					<p>
						<label data-for="state">Estado*:</label>
					</p>
					<p>
						<input data-id="state" class="input-block" data-name="estado" required size="2" min-length="2" max-length="2" value="<?php echo $endereco['estado']; ?>" />
					</p>
					
					<p>
						<label data-for="city">Cidade*:</label>
					</p>
					<p>
						<input data-id="city" class="input-block" data-name="cidade" required value="<?php echo $endereco['cidade']; ?>" />
					</p>
					
					<p>
						<label data-for="bairro">Bairro*:</label>
					</p>
					<p>
						<input data-id="bairro" class="input-block" data-name="bairro" required value="<?php echo $endereco['bairro']; ?>" />
					</p>
					
					<p>
						<label data-for="zip">CEP*:</label>
					</p>
					<p>
						<input data-id="zip" class="input-block" data-name="cep" required pattern="[0-9]{5}-[0-9]{3}" value="<?php echo $endereco['cep']; ?>" />
					</p>
					
					<p>
						<label data-for="address">Endereço*:</label>
					</p>
					<p>
						<input data-id="address" class="input-block" data-name="endereco" required value="<?php echo $endereco['endereco']; ?>" />
						<input type="hidden" name="addresses[]" data-value="address"/>
					</p>
					
					<p>
						<label data-for="number">Número*:</label>
					</p>
					<p>
						<input data-id="number" class="input-block" data-name="numero" required value="<?php echo $endereco['numero']; ?>" />
					</p>
					
					<p>
						<label data-for="complement">Complemento (opcional):</label>
					</p>
					<p>
						<input data-id="complement" class="input-block" data-name="complemento" value="<?php echo $endereco['complemento']; ?>" />
					</p>
				</details>
			<?php
		}
	}
?>
