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
	
	<p>
		<label for="address">Endereço*:</label>
	</p>
	<p>
		<input id="address" class="input-block" name="endereco" required />
	</p>
	
	<p>
		<label for="complement">Complemento:</label>
	</p>
	<p>
		<input id="complement" class="input-block" name="complemento" />
	</p>

	<p>
		<label for="city">Cidade*:</label>
	</p>
	<p>
		<input id="city" class="input-block" name="cidade" required />
	</p>

	<p>
		<label for="state">Estado*:</label>
	</p>
	<p>
		<input id="state" class="input-block" name="estado" required size="2" min-length="2" max-length="2" />
	</p>

	<p>
		<label for="country">País*:</label>
	</p>
	<p>
		<input id="country" class="input-block" name="pais" required />
	</p>
					
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
		<label for="phone-home">Telefone residencial:</label>
	</p>
	<p>
		<input id="phone-home" class="input-block" name="telefone" pattern="\(([0-9]{2})\) *[0-9]{4,5}-[0-9]{4}" />
	</p>
	
	<p>
		<label for="phone-cell">Celular:</label>
	</p>
	<p>
		<input id="phone-cell" class="input-block" name="celular" pattern="\(([0-9]{2})\) *[0-9]{4,5}-[0-9]{4}" />
	</p>
	
	<button class="signup-button-disable">cadastrar</button>	
</form>
