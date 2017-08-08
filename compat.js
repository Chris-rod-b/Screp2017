{
	var chrome = navigator.userAgent.match(/Chrome\/([0-9]+)\./);
	
	if(!chrome || chrome[1] < 60)
	{
		var div = document.createElement("div");
		div.setAttribute("class", "unsupported");
		var strong = document.createElement("strong");
		strong.appendChild(document.createTextNode("Você está usando um navegador não suportado, favor usar a versão mais nova do Google Chrome ou um navegador compatível. Alguns recursos podem não funcionar corretamente."));
		div.appendChild(strong);
		document.body.appendChild(div);
	}
}
