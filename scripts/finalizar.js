{
	let handler = async ()=>
	{
		eval(await (await fetch("scripts/address.js", {credentials: "same-origin"})).text());
		
	};
	
	if(document.readyState === "complete")
	{
		handler();
	}
	else
	{
		document.addEventListener("DOMContentLoaded", handler);
	}
}
