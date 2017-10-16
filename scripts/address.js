{
	let address_template = document.querySelector("#address-template");
	
	let addressindex = 0;
	let initAddress = cloned=>
	{
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
		let namein = cloned.querySelector("[data-id=\"address\"]");
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
	};
	
	let existing = document.querySelectorAll(".address-entry");
	for(let ex of existing)
	{
		initAddress(ex);
	}
	
	let createAddress = () =>
	{
		let cloned = address_template.content.cloneNode(true);
		
		initAddress(cloned);
		
		return(cloned);
	};
	
	let moreaddresses = document.querySelector(".add-address");
	
	if(!existing.length)
	{
		let address = createAddress();
		address.querySelector(".address-entry").open = true;
		address.querySelector(".delete-address").disabled = true;
		moreaddresses.before(address);
	}
	
	moreaddresses.addEventListener("click", ()=>
	{
		moreaddresses.before(createAddress());
		document.querySelector(".address-entry .delete-address").disabled = false;
	});
}
