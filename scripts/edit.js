{
	let handler = ()=>
	{
		let form = document.querySelector("#newproduct-form");
		
		form.addEventListener("submit", event=>
		{
			if(form.action === "about:blank")
			{
				event.preventDefault();
				let p = form.querySelector("#replace-continue");
				form.action = "api/complete.php";
				form.method = "post";
				
				fetch("api/continue.php?"+new URLSearchParams(new FormData(form)),  {credentials: "same-origin"}).then(response=>
				{
					if(response.ok)
					{
						response.text().then(text=>
						{
							p.outerHTML = text;
						});
					}
				});
				
				for(let element of form.elements)
				{
					element.disabled = true;
				}
			}
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
