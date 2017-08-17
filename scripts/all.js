{
	let handler = ()=>
	{
		let offset = 0;
		
		let more = ()=>
		{
			let replaced = document.querySelector(".replace-more");
			if(replaced)
			{
				let next = replaced.querySelector(".load-more");
				next.addEventListener("click", ()=>
				{
					offset = document.querySelectorAll(".botton").length;
					let data = new URLSearchParams(window.location.search);
					data.set("offset", offset);
					next.disabled = true;
					fetch("api/results.php?" + data, {credentials: "same-origin"}).then(response=>
					{
						if(response.ok)
						{
							response.text().then(text=>
							{
								replaced.outerHTML = text;
								more();
							});
						}
					});
				});
			}
		};
		more();
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
