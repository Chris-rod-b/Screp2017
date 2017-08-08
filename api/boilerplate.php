<?php
	$pages = array('home'=>array('name'=>'home'), 'all'=>array('name'=>'produtos', 'subfolder'=>true), 'design'=>array('name'=>'design'), 'sitemap'=>array('name'=>'mapa'));
	$page = basename($_SERVER['SCRIPT_NAME'], '.php');
	
	$people = array(array('13', 'Sabrina'), array('02', 'Christian'), array('08', 'José Rogério'), array('14', 'Elias'), array('12', 'Pedro'));
	
	function links()
	{
		global $pages;
		global $page;
		foreach($pages as $pcode=>$pinfo)
		{
			echo '<a';
			if(isset($_SERVER['PATH_INFO']) || $page !== $pcode)
			{
				echo ' href="'.$pcode.'.php"';
			}
			echo ' data-href="'.$pcode.'.php">'.$pinfo['name'].'</a> ';
		}
	}
	
	$cpinfo = $pages[$page];
	
	?>
		<!doctype html>
		<html lang="pt" id="page">
			<head>
				<meta charset="utf-8" />
				<base href="<?php echo dirname($_SERVER['SCRIPT_NAME']); ?>" />
				<title>screp &mdash; <?php if($cpinfo['subfolder'] || !isset($_SERVER['PATH_INFO'])) echo $cpinfo['name']; else echo 'não encontrado'; ?></title>
				<link rel="stylesheet" href="layout.css" />
				<script src="main.js"></script>
				<script type="text/plain" id="pagenames"><?php foreach($pages as $pcode=>$pinfo) echo $pcode.'.php::'.$pcode.'.js::'.$pinfo['name'].'::'.$pinfo['subfolder'].';;'; ?></script>
				<script id="pagescript"<?php if(!isset($_SERVER['PATH_INFO'])) echo ' src="scripts/'.$page.'.js"'; ?>></script>
			</head>
			<body>
				<script src="compat.js"></script>
				<div id="main">
					<header>
						<a<?php if($page !== 'home') echo ' href="home.php"'; ?>>
							<img src="images/screp.svg" width="100%" alt="Logo Screp" />
						</a>
					</header>
					<div id="top">
						<nav>
							<a<?php if($page !== 'home') echo ' href="home.php"'; ?> id="minilogo" hidden>
								<img src="images/screp.svg" alt="Mini Logo Screp" />
							</a>
							<div id="links">
								<?php
									links();
								?>
								<button type="button" id="p-button" class="icon-button"><img src="images/profile.svg" alt="Seu Perfil" /></button>
								<a<?php if($page !== 'cart') echo ' href="cart.php"'; ?> data-href="cart.php" class="icon-button"><img src="images/cart.svg" alt="Carrinho de Compras" /></a>
							</div>
						</nav>
						<div id="profile-wrap-wrap" hidden>
							<div id="profile-wrap">
								<div id="profile" method="post">
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
											<label><input type="checkbox" name="keep" value="true" /> Salvar Login</label>
										</p>
										<p>
											<button>login</button>
										</p>
									</form>
									<p>
										<a href="cadastro.html">não tenho conta</a>
									</p>
								</div>
							</div>
						</div>
					</div>
					<main>
	<?php
	
	include 'psub.php';
	includep(dirname(__FILE__).'/'.$page.'.php', $cpinfo['subfolder']);
	
	global $people;
	
	echo '</main><footer><p>';
	links();
	echo'</p><p>';
	
	$sep = '';
	foreach($people as list($number, $person))
	{
		echo $sep.'<span>'.$number.' &hyphen; '.$person.'</span>';
		$sep = ' | ';
	}
	
	echo '</p></footer><p id="back" hidden><a href="#page">voltar ao topo</a></p></div></body></html>';
?>
