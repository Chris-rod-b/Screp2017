<?php
	include_once 'user.php';
	if($user_login_row)
	{
		?>
			<p>Você está logado como <?php echo $user_login_row['nome'].' '.$user_login_row['sobrenome'].' ('.$user_login_row['login'].')'; ?>.</p>
			<p><button id="logout-button">logout</button></p>
		<?php
	}
	else
	{
		?>
			<form method="post" id="login">
				<p>
					<label for="login-username">User:</label>
				</p>
				<p>
					<input class="input-inline" autocomplete="username" name="username" id="login-username" />
				</p>
				<p>
					<label for="login-password">Senha:</label>
				</p>
				<p>
					<input class="input-inline" type="password" autocomplete="current-password" name="senha" id="login-password" />
				</p>
				<p>
					<button>login</button>
				</p>
			</form>
			<p>
				<a href="sign-up.php">não tenho conta</a>
			</p>
		<?php
	}
?>
