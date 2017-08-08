{
	let handler = ()=>
	{
		let roulette = document.querySelector("#roulette");
		let images = roulette.querySelector("#roulette-images");
		
		for(let element of images.children)
		{
			element.hidden = true;
		}
		
		let animating;
		
		let hovered = false;
		
		let timeout = null;
		
		let animate = ()=>
		{
			animating = false;
			let current = images.firstElementChild;
			current.classList.remove("transitioning");
			current.hidden = false;
			if(!hovered)
			{
				animating = true;
				timeout = window.setTimeout(()=>
				{
					current.nextElementSibling.classList.add("transitioning");
					timeout = null;
					current.animate(
					[
						{
							marginLeft: "0%"
						},
						{
							marginLeft: "-100%"
						}
					],
					{
						easing: "ease",
						duration: 1500
					}).addEventListener("finish", ()=>
					{
						current.hidden = true;
						images.append(current);
						animate();
					});
				}, 3000);
			}
		};
		
		animate();
		
		let pointers = 0;
		
		let enter = ()=>
		{
			pointers++;
			hovered = true;
			if(timeout !== null)
			{
				animating = false;
				window.clearTimeout(timeout);
			}
		};
		
		let leave = ()=>
		{
			if(--pointers <= 0)
			{
				pointers = 0;
				hovered = false;
				if(!animating)
				{
					animate();
				}
			}
		};
		
		roulette.addEventListener("pointerenter", enter);
		roulette.addEventListener("pointerleave", leave);
		
		
		roulette.addEventListener("focusin", enter);
		roulette.addEventListener("focusout", leave);
		
		let back = roulette.querySelector("#roulette-control-back");
		let next = roulette.querySelector("#roulette-control-next");
		
		back.addEventListener("click", ()=>
		{
			if(!animating)
			{
				let current = images.lastElementChild;
				animating = true;
				images.prepend(current);
				current.classList.add("transitioning");
				current.animate(
				[
					{
						marginLeft: "-100%"
					},
					{
						marginLeft: "0%"
					}
				],
				{
					easing: "ease-out",
					duration: 250
				}).addEventListener("finish", ()=>
				{
					current.classList.remove("transitioning");
					current.hidden = false;
					current.nextElementSibling.hidden = true;
					animating = false;
					animate();
				});
			}
		});
		
		next.addEventListener("click", ()=>
		{
			if(!animating)
			{
				let current = images.firstElementChild;
				animating = true;
				let next = current.nextElementSibling;
				next.classList.add("transitioning");
				current.animate(
				[
					{
						marginLeft: "0%"
					},
					{
						marginLeft: "-100%"
					}
				],
				{
					easing: "ease-out",
					duration: 250
				}).addEventListener("finish", ()=>
				{
					current.hidden = true;
					next.hidden = false;
					next.classList.remove("transitioning");
					images.append(current);
					animating = false;
					animate();
				});
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
