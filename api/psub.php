<?php
	function includep($php, $subfolder)
	{
		if(!$subfolder && isset($_SERVER['PATH_INFO']))
		{
			include 'unfound.php';
		}
		else
		{
			include $php;
		}
	}
?>
