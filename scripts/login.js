{
	let form = document.currentScript.closest("form");
	form.addEventListener("submit", event=>
	{
		event.preventDefault();
		let formdata = new FormData(form);
		fetch("api/login.php?" + new URLSearchParams(formdata), {credentials: "same-origin"}).then(response=>
		{
			if(response.ok)
			{
				response.text().then(text=>
				{
					zx_login(document.querySelector("#p-button").textContent = formdata.get("username"));
				});
			}
		});
	});
}
