{
	let handler = ()=>
	{
		for(let qtde of document.querySelectorAll(".qtde"))
		{
			let subtotal = qtde.closest("tr").querySelector(".out-sub");
			qtde.addEventListener("input", ()=>
			{
				let price = ((qtde.valueAsNumber||0) * qtde.dataset.price).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1-").replace(".", ",").replace(/-/g, '.');
				if(/^[0-9]{1,3}(\.[0-9]{3})*,[0-9]{2}$/.test(price))
				{
					subtotal.textContent = "R$ " + price;
				}
				else
				{
					subtotal.textContent = "inválido";
				}
			});
		}
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
