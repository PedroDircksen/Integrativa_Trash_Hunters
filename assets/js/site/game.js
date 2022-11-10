/**
 *
 * Script do login de admin
 *
 * @author Emprezaz
 *
 **/
(function ($, PATH, Helpers) {
	var game = function () {
		if ($('.menu-pause').hasClass('show')) {
			sleep();
		}
		// Cria o canvas
		const canvas = document.createElement('canvas');
		const ctx = canvas.getContext('2d');
		canvas.width = 1300;
		canvas.height = 720;
		document.body.appendChild(canvas);
		var ObjetosLixo = []
		var ObjetosLixoAzul = []
		var ObjetosLixoVerde = []
		var ObjetosLixoMarrom = []
		var ObjetosLixoVermelho = []
		var ObjetosLixoAmarelo = []
		var pontuacao = 0
		var objetos = []

		// Imagem de fundo
		let bgReady = false;
		const bgImage = new Image();
		bgImage.onload = function () {
			bgReady = true;
		};
		
		bgImage.src = PATH + '/assets/img/BackgroundProvisorio.png';

		// Imagem do herói
		const heroImage = new Image();
		heroImage.src =  PATH + '/assets/img/hero.png';

		// Imagem do monstro
		const monsterImage = new Image();
		monsterImage.src =  PATH + '/assets/img/ie.png';

		// Imagem do lixoVerde
		const lixoVerdeImage = new Image();
		lixoVerdeImage.src =  PATH + '/assets/img/lixoVerde.png';

		// Imagem do lixoMarrom
		const lixoMarromImage = new Image();
		lixoMarromImage.src =  PATH + '/assets/img/lixoMarrom.png';

		// Imagem do lixoAmarelo
		const lixoAmareloImage = new Image();
		lixoAmareloImage.src =  PATH + '/assets/img/lixoAmarelo.png';

		// Imagem do lixoAzul
		const lixoAzulImage = new Image();
		lixoAzulImage.src =  PATH + '/assets/img/lixoAzul.png';

		// Imagem do lixoVermelho
		const lixoVermelhoImage = new Image();
		lixoVermelhoImage.src =  PATH + '/assets/img/lixoVermelho.png';

		// Imagem da banana
		const bananaImage = new Image();
		bananaImage.src =  PATH + '/assets/img/banana.png';

		// Imagem da papel
		const papelImage = new Image();
		papelImage.src =  PATH + '/assets/img/papel.png';

		// Imagem da papel
		const latinhaImage = new Image();
		latinhaImage.src =  PATH + '/assets/img/lataRefrigerante.png';

		// Imagem da papel
		const copoImage = new Image();
		copoImage.src =  PATH + '/assets/img/copoVidro.png';

		// Imagem da garrafa
		const garrafaImage = new Image();
		garrafaImage.src =  PATH + '/assets/img/garrafa.png';

		// Objetos do jogo
		const hero = {
			image: heroImage,
			speed: 600, // movimento em pixels por segundo
			x: canvas.width / 2,
			y: canvas.height / 2,
		};
		const lixoAzul = {
			image: lixoAzulImage,
			x: canvas.width - 200,
			y: 100,
		};
		const lixoMarrom = {
			image: lixoMarromImage,
			x: canvas.width - 200,
			y: 200,
		};
		const lixoVerde = {
			image: lixoVerdeImage,
			x: canvas.width - 200,
			y: 300,
		};
		const lixoVermelho = {
			image: lixoVermelhoImage,
			x: canvas.width - 200,
			y: 400,
		};
		const lixoAmarelo = {
			image: lixoAmareloImage,
			x: canvas.width - 200,
			y: 500,
		};
		const banana = {
			image: bananaImage,
			speed: 600, // movimento em pixels por segundo
			x: 100,
			y: 100,
		};
		const papel = {
			image: papelImage,
			speed: 600, // movimento em pixels por segundo
			x: 100,
			y: 200,
		};
		const latinha = {
			image: latinhaImage,
			speed: 600, // movimento em pixels por segundo
			x: 100,
			y: 300,
		};
		const copo = {
			image: copoImage,
			speed: 600, // movimento em pixels por segundo
			x: 100,
			y: 400,
		};
		const garrafa = {
			image: garrafaImage,
			speed: 600, // movimento em pixels por segundo
			x: 100,
			y: 500,
		};

		objetos.push(hero)

		ObjetosLixo.push(banana)
		ObjetosLixoMarrom.push(banana)
		ObjetosLixo.push(papel)
		ObjetosLixoAzul.push(papel)
		ObjetosLixo.push(latinha)
		ObjetosLixoAmarelo.push(latinha)
		ObjetosLixo.push(copo)
		ObjetosLixoVerde.push(copo)
		ObjetosLixo.push(garrafa)
		ObjetosLixoVermelho.push(garrafa)

		// Controle do teclado
		const keysDown = {};

		window.addEventListener('keydown', function (e) {
			keysDown[e.keyCode] = true;
		}, false);

		window.addEventListener('keyup', function (e) {
			delete keysDown[e.keyCode];
		}, false);

		const updateTest = function (objetoMovido, modifier) {
			if (38 in keysDown) { // Pressionando a seta pra cima
				objetoMovido.y -= objetoMovido.speed * modifier;
			}
			if (40 in keysDown) { // Pressionando a seta pra baixo
				objetoMovido.y += objetoMovido.speed * modifier;
			}
			if (37 in keysDown) { // Pressionando a seta pra esquerda
				objetoMovido.x -= objetoMovido.speed * modifier;
			}
			if (39 in keysDown) { // Pressionando a seta pra direita
				objetoMovido.x += objetoMovido.speed * modifier;
			}
		}

		// Atualiza os objetos do jogo
		const update = function (modifier) {
			if (38 in keysDown) { // Pressionando a seta pra cima
				hero.y -= hero.speed * modifier;
			}
			if (40 in keysDown) { // Pressionando a seta pra baixo
				hero.y += hero.speed * modifier;
			}
			if (37 in keysDown) { // Pressionando a seta pra esquerda
				hero.x -= hero.speed * modifier;
			}
			if (39 in keysDown) { // Pressionando a seta pra direita
				hero.x += hero.speed * modifier;
			}

			// Os personagens se encostaram?
			ObjetosLixo.forEach(element => {
				if (
					hero.x <= (element.x + 50)
					&& element.x <= (hero.x + 50)
					&& hero.y <= (element.y + 50)
					&& element.y <= (hero.y + 50)
					&& 32 in keysDown
				) {
					console.log('ta perto e apertou o botao')
					updateTest(element, 14 / 1000)
				}
			});

			ObjetosLixoMarrom.forEach(element => {
				if (
					lixoMarrom.x <= (element.x + 50)
					&& element.x <= (lixoMarrom.x + 50)
					&& lixoMarrom.y <= (element.y + 50)
					&& element.y <= (lixoMarrom.y + 50)
					&& !(32 in keysDown)
				) {
					console.log('ACERTOUUUUU')
					pontuacao += 5
					score(pontuacao);
					ObjetosLixoMarrom.pop(element)
					element.x = 100000000
					element.y = 100000000
				}
			});

			ObjetosLixoAzul.forEach(element => {
				if (
					lixoAzul.x <= (element.x + 50)
					&& element.x <= (lixoAzul.x + 50)
					&& lixoAzul.y <= (element.y + 50)
					&& element.y <= (lixoAzul.y + 50)
					&& !(32 in keysDown)
				) {
					console.log('ACERTOUUUUU')
					pontuacao += 5
					score(pontuacao);
					ObjetosLixoAzul.pop(element)
					element.x = 100000000
					element.y = 100000000
				}
			});

			ObjetosLixoAmarelo.forEach(element => {
				if (
					lixoAmarelo.x <= (element.x + 50)
					&& element.x <= (lixoAmarelo.x + 50)
					&& lixoAmarelo.y <= (element.y + 50)
					&& element.y <= (lixoAmarelo.y + 50)
					&& !(32 in keysDown)
				) {
					console.log('ACERTOUUUUU')
					pontuacao += 5
					score(pontuacao);
					ObjetosLixoAmarelo.pop(element)
					element.x = 100000000
					element.y = 100000000
				}
			});

			ObjetosLixoVerde.forEach(element => {
				if (
					lixoVerde.x <= (element.x + 50)
					&& element.x <= (lixoVerde.x + 50)
					&& lixoVerde.y <= (element.y + 50)
					&& element.y <= (lixoVerde.y + 50)
					&& !(32 in keysDown)
				) {
					console.log('ACERTOUUUUU')
					pontuacao += 5
					score(pontuacao);
					ObjetosLixoVerde.pop(element)
					element.x = 100000000
					element.y = 100000000
				}
			});


			ObjetosLixoVermelho.forEach(element => {
				if (
					lixoVermelho.x <= (element.x + 50)
					&& element.x <= (lixoVermelho.x + 50)
					&& lixoVermelho.y <= (element.y + 50)
					&& element.y <= (lixoVermelho.y + 50)
					&& !(32 in keysDown)
				) {
					console.log('ACERTOUUUUU')
					pontuacao += 5
					score(pontuacao);
					ObjetosLixoVermelho.pop(element)
					element.x = 100000000
					element.y = 100000000
				}
			});

		};

		// Renderiza tudo
		const render = function () {

			ctx.drawImage(bgImage, 0, 0, 1920, 1080);
			ctx.drawImage(heroImage, hero.x, hero.y, 50, 50);
			ctx.drawImage(lixoAzulImage, lixoAzul.x, lixoAzul.y, 100, 100);
			ctx.drawImage(lixoMarromImage, lixoMarrom.x, lixoMarrom.y, 100, 100);
			ctx.drawImage(lixoAmareloImage, lixoAmarelo.x, lixoAmarelo.y, 100, 100);
			ctx.drawImage(lixoVerdeImage, lixoVerde.x, lixoVerde.y, 100, 100);
			ctx.drawImage(lixoVermelhoImage, lixoVermelho.x, lixoVermelho.y, 100, 100);
			ctx.drawImage(bananaImage, banana.x, banana.y, 100, 100);
			ctx.drawImage(papelImage, papel.x, papel.y, 70, 70);
			ctx.drawImage(latinhaImage, latinha.x, latinha.y, 60, 60);
			ctx.drawImage(copoImage, copo.x, copo.y, 40, 40);
			ctx.drawImage(garrafaImage, garrafa.x, garrafa.y, 60, 60);

			ctx.fillStyle = 'rgb(0, 0, 0)';
			ctx.font = '30px Helvetica';
			ctx.textAlign = 'left';
			ctx.textBaseline = 'top';
			// ctx.fillText('Pontuação: ' + pontuacao, 32, 32);
		};

		// Controla o loop do jogo
		const main = function () {
			update(14 / 1000);
			render();

			// Executa isso o mais breve possível
			requestAnimationFrame(main);
		};

		// Suporte cross-browser para requestAnimationFrame
		const w = window;
		const requestAnimationFrame = w.requestAnimationFrame || w.webkitRequestAnimationFrame || w.msRequestAnimationFrame || w.mozRequestAnimationFrame;

		// Que comece o jogo!
		main();
	}

	var pause = function () {
		$(document).on('click', '#btn-pause', function () {
			$(this).parents('.content').find('.menu-pause').toggleClass('show');
		})
		$(document).on('click', '#btn-continue', function () {
			$(this).parent().toggleClass('show');
		})
	}

	var score = function (pontuation) {
		$('#score').html(pontuation);
	}


	var timer = function (duration, display) {
		var timer = duration, minutes, seconds;
		setInterval(function () {
			if ($('.menu-pause').hasClass('show')) {
				sleep();
			}
			minutes = parseInt(timer / 60, 10);
			seconds = parseInt(timer % 60, 10);

			minutes = minutes < 10 ? "0" + minutes : minutes;
			seconds = seconds < 10 ? "0" + seconds : seconds;

			display.html(minutes + ":" + seconds);

			if (--timer < 0) {
				timer = duration;
			}
		}, 1000);

	}


	var countdownStart = function () {
		setTimeout(function () {
			$('#start-game').fadeOut();
		}, 2000);
		setTimeout(function () {
			let minutes = 60 * 2,
				display = $('#time');
			timer(minutes, display);
		}, 1000)
	}
	$(document).ready(function () {
		game();
		pause();
		countdownStart();
	});

})($, PATH, Helpers);