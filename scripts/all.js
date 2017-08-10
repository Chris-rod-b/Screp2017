{
	let handler = ()=>
	{
		let newp = document.querySelector("#newproduct-p");
		
		let newbutton = newp.querySelector("#newproduct-button");
		
		let template = document.querySelector("#edit-botton");
		
		let cur = 0;
		newbutton.addEventListener("click", ()=>
		{
			let fragment = document.importNode(template.content, true);
			let form = fragment.querySelector("form");
			fragment.querySelector(".cancel").addEventListener("click", ()=>
			{
				form.remove();
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
			cur++;
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
