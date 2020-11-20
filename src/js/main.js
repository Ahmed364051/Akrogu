window.onload = function () {

	// Над функцией popup и sort надо еще поработать


	// Рандомное число
	const getRandomNumber = (min, max) => Math.floor(Math.random() * (max - min)) + min;

	// Плеер
	function player () {
		const btnMusic = document.querySelector(".player__btn-play");
		const btnRandomMusic = document.querySelector(".player__btn");
		const musicName = document.querySelector(".player__name");

		let lastRandomNum;
		let currentRandomNum;

		const audio = new Audio(); 

		btnMusic.addEventListener("click", function(){
			this.classList.toggle("player__btn-play_active");

			if (this.classList.contains("player__btn-play_active")) {
				this.src = "img/pause.svg";
				audio.play();
			}
			else {
				this.src = "img/play.svg";
				audio.pause();	
			}
		});

		btnRandomMusic.addEventListener("click", function(e){
			e.preventDefault();

			btnMusic.classList.add("player__btn-play_active");

			startStatePlayer();

			btnMusic.src = "img/pause.svg";
			audio.play();
		});

		audio.addEventListener("ended", function(){
			btnMusic.src = "img/play.svg";
			btnMusic.classList.remove("player__btn-play_active");
		});

		function startStatePlayer() {
			currentRandomNum = getRandomNumber(0, openings.length);

			if (currentRandomNum === lastRandomNum) {
				startStatePlayer();
			}

			lastRandomNum = currentRandomNum;

			musicName.innerHTML = openings[currentRandomNum]["name"];
			audio.src = "openings/" + openings[currentRandomNum]["link"];
		}

		startStatePlayer();
	}

	// Текст-ротейтор
	function rotateText () {
		
	  	function animateWords (words, path) {
	  
			const word = document.querySelector(path);
			let currentWord;
			let duration = 4000;
			let i = 0;
		
			function clear() { // один раз
			setTimeout(function(){
				word.className = "verb";
			}, duration / 4);
			};
	  
			function toggleWord(duration){ // много раз
			setInterval(function(){
				
				i++;

				// currentWord = words[i];
		
				if (i === words.length) {
					i = 0;
				}
		
				currentWord = words[i];
		
				word.innerHTML = currentWord;
		
				clear();
		
				word.classList.add("js-fade-in-verb");

			}, duration);
		};
	  
		toggleWord(duration);
	  };
	  
	  animateWords(adjectives, ".about__word_adjective");
	  animateWords(names,  ".about__word_name");
	}

	// Название аниме
	function disappearNameAnime() {
		const title = document.querySelector(".about__name");

		title.addEventListener("focus", function (){
			if (this.value === "Название аниме") {
				this.value = "";
			}
		});

		title.addEventListener("blur", function (){
			if (!this.value) {
				this.value = "Название аниме";
			}
		});
	}

	// Оценка
	function passGrade () {
		const ratingItems = document.querySelectorAll(".rating__item");
		const ratingValue = document.querySelector(".rating-input");
		
		ratingItems.forEach(item => item.addEventListener("click", function() {
			item.parentNode.dataset.totalValue = item.dataset.itemValue;
			ratingValue.value = item.parentNode.dataset.totalValue;
		}));
	}

	// Поиск в списке
	function searchMatches () {
		const input = document.querySelector("#search");
		const listNames = document.querySelectorAll(".list__name");

		const regexp = /\s+/g;

		input.addEventListener("input", function (){
			let inputVal = this.value;

			let item;
			let match;

			if (inputVal) {
				listNames.forEach(listName => {
					item = listName.innerText.replace(regexp, "").toLowerCase();
					match = inputVal.replace(regexp, "").toLowerCase();

					if (item.search(match) === -1) {
						listName.parentNode.classList.add("js-hide");	
					}
					else {
						listName.parentNode.classList.remove("js-hide");
					}
				});
			}
			else {
				listNames.forEach(itemList => {
					itemList.parentNode.classList.remove("js-hide");
				});
			}
		})
	}

	function sortList () {
		document.querySelector(".list__btn_asc").addEventListener("click", sortListAsc);
		document.querySelector(".list__btn_desk ").addEventListener("click", sortListDesk);
	
		function sortListAsc () {
			const list = document.querySelector(".list__holder");
			let firstItem;
			let secondItem;
	
			for (let i = 0; i < list.children.length; i++) {
				for (let j = i; j < list.children.length; j++) {
					firstItem = list.children[i].dataset.listName.toLowerCase();
					secondItem = list.children[j].dataset.listName.toLowerCase();
					if (firstItem > secondItem) {
						let replacedNode = list.replaceChild(list.children[j], list.children[i]);
						insertAfter(replacedNode, list.children[i]);
					}
				}
			}
		}

		function sortListDesk () {
			const list = document.querySelector(".list__holder");
			let firstItem;
			let secondItem;
	
			for (let i = 0; i < list.children.length; i++) {
				for (let j = i; j < list.children.length; j++) {
					firstItem = list.children[i].dataset.listName.toLowerCase();
					secondItem = list.children[j].dataset.listName.toLowerCase();
					if (firstItem < secondItem) {
						let replacedNode = list.replaceChild(list.children[j], list.children[i]);
						insertAfter(replacedNode, list.children[i]);
					}
				}
			}
		}

		function insertAfter (elem, refElem) {
			return refElem.parentNode.insertBefore(elem, refElem.nextSibling);
		}
	}

	function popup () {
		const popupBtns =  document.querySelectorAll(".btn-popup");

		let popupId;

		popupBtns.forEach(btn => {
			btn.addEventListener("click", function(e){
				if (e.target.dataset.callPopup === "popup") {
					popupId = this.dataset.popup;
					document.querySelector(`${popupId}`).classList.remove("js-popup-hide");
				}
			});
		})
		
		const popups = document.querySelectorAll(".popup__wrap");

		popups.forEach(popup => {
			popup.addEventListener("click", function(){
				this.parentNode.parentNode.classList.add("js-popup-hide");
			})
		})
	}

	function setUserpic () {
		const form = document.querySelector(".popup__userpic");

		const userpic = document.querySelector(".popup__file").addEventListener("change", function(){
			form.submit();
		});

	}



	// Создание элемента списка
	// const btn = document.querySelector('.opinion__btn');
	// const list = document.querySelector('.opinion__details');
	// 	console.log(btn);
	// 	btn.addEventListener("click", function(e){
			
	// 		list.innerHTML += '<li class="opinion__item"><span class="opinion__name">Клинок рассекающий демонов</span><span class="opinion__grade">5</span><button>X</button></li>';
	// 	});
	// console.log(11111)
	player();
	disappearNameAnime();
	passGrade();
	rotateText();
	searchMatches();
	sortList();
	popup();


	setUserpic();
}