{
	let handler = ()=>
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
						zx_login(text);
					});
				}
			});
		});
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
