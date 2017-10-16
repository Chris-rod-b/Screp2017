{
	let handler = async ()=>
	{
		let form = document.querySelector("#signup-form");
		form.addEventListener("submit", event=>
		{
			event.preventDefault();
			let data = new FormData(form);
			fetch("api/register-user.php", {credentials: "same-origin", method: "POST", body: data}).then(response=>
			{
				if(response.ok)
				{
					response.text().then(text=>
					{
						zx_login(text, ()=>zx_goto("home.php"));
					});
				}
			});
		});
		
		let address_template = form.querySelector("#address-template");
		
		let addressindex = 0;
		
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
