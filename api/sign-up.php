<form id="signup-form" method="post" action="home.php">
	<p>
		<label for="login">Login*:</label>
	</p>
	<p>
		<input id="login" class="input-block" name="login" required />
	</p>
	
	<p>
		<label for="email">Email*:</label>
	</p>
	<p>
		<input id="email" class="input-block" name="email" type="email" required />
	</p>
	
	<p>
		<label for="senha">Senha*:</label>
	</p>
	<p>
		<input id="senha" class="input-block" name="password" type="password" required />
	</p>
	
	<p>
		<label for="name">Nome*:</label>
	</p>
	<p>
		<input id="name" class="input-block" name="nome" required />
	</p>
	
	<p>
		<label for="surname">Sobrenome*:</label>
	</p>
	<p>
		<input id="surname" class="input-block" name="sobrenome" required />
	</p>
	
	<fieldset>
		<legend>Endereço</legend>
		<template id="address-template">
			<details>
				<summary><span class="address-name">Endereço</span> <button type="button" class="delete-address">excluir</button></summary>
				<p>
					<label data-for="country">País*:</label>
				</p>
				<p>
					<input data-id="country" class="input-block" data-name="pais" required value="Brasil" />
				</p>
				
				<p>
					<label data-for="state">Estado*:</label>
				</p>
				<p>
					<input data-id="state" class="input-block" data-name="estado" required size="2" min-length="2" max-length="2" />
				</p>
				
				<p>
					<label data-for="city">Cidade*:</label>
				</p>
				<p>
					<input data-id="city" class="input-block" data-name="cidade" required value="Bauru" />
				</p>
				
				<p>
					<label data-for="bairro">Bairro*:</label>
				</p>
				<p>
					<input data-id="bairro" class="input-block" data-name="bairro" required />
				</p>
				
				<p>
					<label data-for="zip">CEP*:</label>
				</p>
				<p>
					<input data-id="zip" class="input-block" data-name="cep" required pattern="[0-9]{5}-[0-9]{3}" />
				</p>
				
				<p>
					<label data-for="address">Endereço*:</label>
				</p>
				<p>
					<input data-id="address" class="input-block" data-name="endereco" required />
					<input type="hidden" name="addresses[]" data-value="address"/>
				</p>
				
				<p>
					<label data-for="number">Número*:</label>
				</p>
				<p>
					<input data-id="number" class="input-block" data-name="numero" required />
				</p>
				
				<p>
					<label data-for="complement">Complemento (opcional):</label>
				</p>
				<p>
					<input data-id="complement" class="input-block" data-name="complemento" />
				</p>
			</details>
		</template>
		<button type="button" class="add-address">adicionar endereço</button>
	</fieldset>
	
	<p>
		<label for="cpf">CPF*:</label>
	</p>
	<p>
		<input id="cpf" class="input-block" pattern="[0-9]{11,14}" minlength="11" maxlength="14" name="cpf" required />
	</p>
	
	<p>
		<fieldset>
			<legend>Gênero*:</legend>
			<p>
				<label><input type="radio" name="sexo" value="M" /> Masculino</label>
			</p>
			<p>
				<label><input type="radio" name="sexo" value="F" /> Feminino</label>
			</p>
		</fieldset>
	</p>
	
	<p>
		<label for="birth">Data de Nascimento*:</label>
	</p>
	<p>
		<input id="birth" class="input-block" type="date" name="data_nasc" required />
	</p>
	
	<p>
		<label for="phone-home">Telefone residencial (opcional):</label>
	</p>
	<p>
		<input id="phone-home" class="input-block" name="telefone" pattern="\(([0-9]{2})\)[0-9]{4,5}-[0-9]{4}" />
	</p>
	
	<p>
		<label for="phone-cell">Celular (opcional):</label>
	</p>
	<p>
		<input id="phone-cell" class="input-block" name="celular" pattern="\(([0-9]{2})\)[0-9]{4,5}-[0-9]{4}" />
	</p>
	
	<button class="signup-button-disable">cadastrar</button>
</form>
