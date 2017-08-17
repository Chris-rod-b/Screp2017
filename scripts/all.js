{
	let handler = ()=>
	{
		let newp = document.querySelector("#newproduct-p");
		
		if(newp)
		{
			let newbutton = newp.querySelector("#newproduct-button");
			
			let template = document.querySelector("#edit-botton");
			
			let cur = 0;
			newbutton.addEventListener("click", ()=>
			{
				let fragment = document.importNode(template.content, true);
				
				let form = fragment.querySelector(".newproduct-form");
				
				fragment.querySelector(".edit-botton-cancel").addEventListener("click", ()=>
				{
					form.animate(
					[
						{
							height: form.getBoundingClientRect().height + "px"
						},
						{
							height: "0px"
						}
					],
					{
						easing: "ease-in",
						duration: 300
					}).addEventListener("finish", ()=>{form.remove();});
				});
				
				for(let input of fragment.querySelectorAll("[data-id]"))
				{
					input.id = input.dataset.id + "-" + cur;
				}
				
				for(let label of fragment.querySelectorAll("[data-for]"))
				{
					label.htmlFor = label.dataset.for + "-" + cur;
				}
				
				newp.before(fragment);
				
				form.animate(
				[
					{
						height: "0px"
					},
					{
						height: form.getBoundingClientRect().height + "px"
					}
				],
				{
					easing: "ease-out",
					duration: 300
				});
				
				cur++;
			});
		}
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
