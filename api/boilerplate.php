<?php
	$pages = array('home'=>array('name'=>'home', 'nav'=>true), 'all'=>array('name'=>'produtos', 'subfolder'=>true, 'nav'=>true), 'design'=>array('name'=>'design', 'nav'=>true), 'sitemap'=>array('name'=>'mapa', 'nav'=>true), 'edit'=>array('name'=>'alteração/inclusão'), 'sign-up'=>array('name'=>'cadastro'));
	$page = basename($_SERVER['SCRIPT_NAME'], '.php');
	
	$people = array(array('13', 'Sabrina'), array('02', 'Christian'), array('08', 'José Rogério'), array('14', 'Elias'), array('12', 'Pedro'));
	
	function links()
	{
		global $pages;
		global $page;
		foreach($pages as $pcode=>$pinfo)
		{
			if($pinfo['nav'])
			{
				echo '<a';
				if(isset($_SERVER['PATH_INFO']) || $page !== $pcode)
				{
					echo ' href="'.$pcode.'.php"';
				}
				echo ' data-href="'.$pcode.'.php">'.$pinfo['name'].'</a> ';
			}
		}
	}
	
	$cpinfo = $pages[$page];
	
	$base = dirname($_SERVER['SCRIPT_NAME']);
	if(substr($base, -1) !== '/')
	{
		$base .= '/';
	}
	
	?>
		<!doctype html>
		<html lang="pt" id="page">
			<head>
				<meta charset="utf-8" />
				<base href="<?php echo $base; ?>" />
				<title>screp &mdash; <?php if($cpinfo['subfolder'] || empty($_SERVER['PATH_INFO'])) echo $cpinfo['name']; else echo 'não encontrado'; ?></title>
				<link rel="stylesheet" href="layout.css" />
				<script src="main.js"></script>
				<script type="text/plain" id="pagenames"><?php foreach($pages as $pcode=>$pinfo) echo $pcode.'.php::'.$pcode.'.js::'.$pinfo['name'].'::'.$pinfo['subfolder'].';;'; ?></script>
				<script id="pagescript"<?php if($cpinfo['subfolder'] || empty($_SERVER['PATH_INFO'])) echo ' src="scripts/'.$page.'.js"'; ?>></script>
			</head>
			<body>
				<script src="compat.js"></script>
				<div id="main">
					<header id="mainlogo">
						<a<?php if($page !== 'home') echo ' href="home.php"'; ?>>
							<img src="images/screp.png" width="100%" alt="Logo Screp" />
						</a>
					</header>
					<div id="top">
						<nav>
							<a<?php if($page !== 'home') echo ' href="home.php"'; ?> id="minilogo" hidden>
								<img src="images/sc_screp.png" alt="Mini Logo Screp" />
							</a>
							<div id="links">
								<?php
									links();
									include_once 'user.php';
								?>
								<button type="button" id="p-button"><?php if($nome=$user_login_row['nome']) echo htmlspecialchars($nome); else echo 'login'; ?></button>
								<a<?php if($page !== 'cart') echo ' href="cart.php"'; ?> data-href="cart.php" class="icon-button"><img src="images/cart.svg" alt="Carrinho de Compras" /></a>
							</div>
						</nav>
						<div id="profile-wrap-wrap" hidden>
							<div id="profile-wrap">
								<div id="profile">
									<?php
										include 'profile.php';
									?>
								</div>
							</div>
						</div>
					</div>
					<main>
	<?php
	
	if(!($cpinfo['subfolder'] || empty($_SERVER['PATH_INFO'])))
	{
		include 'unfound.php';
	}
	else
	{
		include dirname(__FILE__).'/'.$page.'.php';
	}
	
	global $people;
	
	echo '</main><footer><p>';
	links();
	echo '</p><p>';
	
	$sep = '';
	foreach($people as list($number, $person))
	{
		echo $sep.'<span>'.$number.' &hyphen; '.$person.'</span>';
		$sep = ' | ';
	}
	
	echo '</p></footer></div></body></html>';
?>
