<?php
	function includep($php, $subfolder)
	{
		if(!($subfolder || empty($_SERVER['PATH_INFO'])))
		{
			include 'unfound.php';
		}
		else
		{
			include $php;
		}
	}
?>
