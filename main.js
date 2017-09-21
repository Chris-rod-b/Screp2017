document.addEventListener("DOMContentLoaded", ()=>
{
	let main = document.querySelector("main");
	
	let pagenames = {};
	
	for(let pagename of document.querySelector("#pagenames").textContent.split(";;"))
	{
		let [code, js, name, subfolder] = pagename.split('::');
		pagenames[code] = {js, name, subfolder};
	}
	
	let pagescript = document.querySelector("#pagescript");
	
	let nav = document.querySelector("nav");
	let mini = nav.querySelector("#minilogo");
	let profile = document.querySelector("#profile-wrap-wrap");
	let boxShadow = (top = nav.getBoundingClientRect().top) => "0em 0em " + Math.min(1, Math.max(0, (128-top)/128)) + "em rgba(0, 0, 0, 0.25)";
	let update = ()=>
	{
		let ttop = nav.getBoundingClientRect().top;
		let top;
		if(profile.hidden)
		{
			nav.style.removeProperty("transition");
			top = ttop;
		}
		else
		{
			nav.style.setProperty("transition", "0.3s box-shadow");
			top = 0;
		}
		nav.style.setProperty("box-shadow", boxShadow(top));
		mini.hidden = 0 < ttop;
	};
	window.addEventListener("scroll", update);
	window.addEventListener("resize", update);
	update();
	
	let pbutton = document.querySelector("#p-button");
	pbutton.addEventListener("click", ()=>
	{
		if(!profile.hidden)
		{
			let login = profile.querySelector("#login");
			if(login)
			{
				login.reset();
			}
		}
		update();
	}, {capture: true});
	
	let big = document.querySelector("header a");
	
	let navlinks = document.querySelectorAll("a[data-href]");
	
	window.addEventListener("blur", ()=>{profile.hidden = true; update();});
	window.addEventListener("click", event=>
	{
		let target = event.target;
		
		let out = false;
		for(let current = target; current; current = current.parentNode)
		{
			let href;
			if(current.localName === "a" && (href = current.getAttribute("href")) && /^[^\/]*?\.php(\/.*)?$/.test(href))
			{
				let pagename = pagenames[href.split("/")[0]];
				let url;
				let unfound = !pagename.subfolder && href.includes('/');
				if(unfound)
				{
					url = "unfound.php";
				}
				else
				{
					url = href;
				}
				fetch("api/"+url, {credentials: "same-origin"}).then(response=>
				{
					if(response.ok)
					{
						response.text().then(text=>
						{
							scrollTo(0, 0);
							
							main.innerHTML = text;
							
							if(href === "home.php")
							{
								big.removeAttribute("href");
								mini.removeAttribute("href");
							}
							else
							{
								big.href = mini.href = "home.php";
							}
							
							for(let a of navlinks)
							{
								let dhref = a.dataset.href;
								if(href === dhref)
								{
									a.removeAttribute("href");
								}
								else
								{
									a.href = dhref;
								}
							}
							
							if(unfound)
							{
								document.title = "screp \u2014 não encotrado";
							}
							else
							{
								document.title = "screp \u2014 " + pagename.name;
								let script = document.createElement("script");
								script.src = "scripts/"+pagename.js;
								pagescript.replaceWith(script);
								pagescript = script;
							}
							history.pushState(null, null, href);
						});
					}
					else
					{
						scrollTo(0, 0);
						main.textContent = "";
						let h1 = document.createElement("h1");
						h1.textContent = "Erro Desconhecido";
						let p = document.createElement("p");
						p.textContent = "Ocorreu um erro ao carregar essa página.";
						main.append(h1, p);
						document.title = "screp \u2014 erro";
						big.href = mini.href = "home.php";
						for(let a of navlinks)
						{
							a.href = a.dataset.href;
						}
						history.pushState(null, null, "/error");
					}
				});
				event.preventDefault();
				out = true;
				break;
			}
		}
		
		let oldshown = !profile.hidden;
		profile.hidden = (oldshown || !pbutton.contains(target)) && (out || !profile.contains(target));
		if(oldshown && profile.hidden)
		{
			nav.animate(
			[
				{
					boxShadow: boxShadow(0)
				},
				{
					boxShadow: boxShadow()
				}
			],
			{
				easing: "ease",
				duration: 300
			});
			update();
		}
	}, {capture: true});
	
	window.zx_login = name =>
	{
		let profile = document.querySelector("#profile");
		profile.textContent = "";
		let button = document.querySelector("#p-button");
		button.textContent = name;
		fetch("api/profile.php", {credentials: "same-origin"}).then(response=>
		{
			if(response.ok)
			{
				response.text().then(text=>
				{
					profile.innerHTML = text;
				});
			}
		});
		
		window.zx_logout = ()=>login("login");
	};
});
