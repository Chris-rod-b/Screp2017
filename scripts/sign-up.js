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
						zx_login(text, ()=>zx_goto("home.php"));
					});
				}
			});
		});
		
		let address_template = form.querySelector("#address-template");
		
		let addressindex = 0;
		
		let createAddress = () =>
		{
			let cloned = address_template.content.cloneNode(true);
			for(let withfor of cloned.querySelectorAll("[data-for]"))
			{
				withfor.htmlFor = withfor.dataset.for+"-"+addressindex;
			}
			for(let withname of cloned.querySelectorAll("[data-name]"))
			{
				withname.name = withname.dataset.name+"-"+addressindex;
			}
			for(let withid of cloned.querySelectorAll("[data-id]"))
			{
				withid.id = withid.dataset.id+"-"+addressindex;
			}
			for(let withvalue of cloned.querySelectorAll("[data-value]"))
			{
				withvalue.value = withvalue.dataset.value+"-"+addressindex;
			}
			
			let delbut = cloned.querySelector(".delete-address");
			delbut.addEventListener("click", ()=>
			{
				delbut.closest("details").remove();
			});
			
			let nameout = cloned.querySelector(".address-name");
			let namein = cloned.querySelector("[data-id=\"address\"");
			namein.addEventListener("input", ()=>
			{
				let value = namein.value;
				if(value)
				{
					nameout.textContent = value;
				}
				else
				{
					nameout.textContent = "Endereço";
				}
			});
			
			addressindex++;
			return(cloned);
		};
		
		let moreaddresses = form.querySelector(".add-address");
		
		let address = createAddress();
		address.querySelector("details").open = true;
		address.querySelector(".delete-address").disabled = true;
		moreaddresses.before(address);
		
		moreaddresses.addEventListener("click", ()=>
		{
			let address = createAddress();
			moreaddresses.before(address);
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
