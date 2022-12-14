// Cria o canvas
const canvas = document.createElement('canvas');
const ctx = canvas.getContext('2d');
canvas.width = 1280;
canvas.height = 720;
document.body.appendChild(canvas);
var ObjetosLixo = []
var ObjetosLixoAzul = []
var ObjetosLixoVerde = []
var ObjetosLixoMarrom = []
var ObjetosLixoVermelho = []
var ObjetosLixoAmarelo = []
var pontuacao = 0 
var erros = 0 
var objetos = []

function setFavicons(favImg){
  let headTitle = document.querySelector('head');
  let setFavicon = document.createElement('link');
  setFavicon.setAttribute('rel','shortcut icon');
  setFavicon.setAttribute('href',favImg);
  headTitle.appendChild(setFavicon);
}
setFavicons('images/home-logo.ico');

// Imagem de fundo
let bgReady = false;
const bgImage = new Image();
bgImage.onload = function () {
  bgReady = true;
};
bgImage.src = 'images/campo.png';

// Imagem do herói
const heroImage = new Image();
heroImage.src = 'images/hero.png';

// Imagem do monstro
const monsterImage = new Image();
monsterImage.src = 'images/ie.png';

// Imagem do lixoVerde
const lixoVerdeImage = new Image();
lixoVerdeImage.src = 'images/lixoVerde.png';

// Imagem do lixoMarrom
const lixoMarromImage = new Image();
lixoMarromImage.src = 'images/lixoMarrom.png';

// Imagem do lixoAmarelo
const lixoAmareloImage = new Image();
lixoAmareloImage.src = 'images/lixoAmarelo.png';

// Imagem do lixoAzul
const lixoAzulImage = new Image();
lixoAzulImage.src = 'images/lixoAzul.png';

// Imagem do lixoVermelho
const lixoVermelhoImage = new Image();
lixoVermelhoImage.src = 'images/lixoVermelho.png';

// Imagem da banana
const bananaImage = new Image();
bananaImage.src = 'images/banana.png';

// Imagem da papel
const papelImage = new Image();
papelImage.src = 'images/papel.png';

// Imagem da papel
const latinhaImage = new Image();
latinhaImage.src = 'images/lataRefrigerante.png';

// Imagem da papel
const copoImage = new Image();
copoImage.src = 'images/copoVidro.png';

// Imagem da garrafa
const garrafaImage = new Image();
garrafaImage.src = 'images/garrafa.png';

// Objetos do jogo
const hero = {
  image: heroImage,
  speed: 500, // movimento em pixels por segundo
  x: canvas.width / 2,
  y: canvas.height / 2,
};
const lixoAzul = {
  image: lixoAzulImage,
  x: canvas.width - 100,
  y: 70,
};
const lixoMarrom = {
  image: lixoMarromImage,
  x: canvas.width - 100,
  y: 170,
};
const lixoVerde = {
  image: lixoVerdeImage,
  x: canvas.width - 100,
  y: 270,
};
const lixoVermelho = {
  image: lixoVermelhoImage,
  x: canvas.width - 100,
  y: 370,
};
const lixoAmarelo = {
  image: lixoAmareloImage,
  x: canvas.width - 100,
  y: 470,
};
const banana = {
  isMoving: false,
  image: bananaImage,
  speed: 500, // movimento em pixels por segundo
  x: 200 + (Math.random() * (canvas.width - 500)),
  y: 200 + (Math.random() * (canvas.height - 450)),
  acertou: false
  
};console.log(banana.x, banana.y)
const papel = {
  isMoving: false,
  image: papelImage,
  speed: 500, // movimento em pixels por segundo
  x: 200 + (Math.random() * (canvas.width - 500)),
  y: 200 + (Math.random() * (canvas.height - 450)),
  acertou: false
};
const latinha = {
  isMoving: false,
  image: latinhaImage,
  speed: 500, // movimento em pixels por segundo
  x: 200 + (Math.random() * (canvas.width - 500)),
  y: 200 + (Math.random() * (canvas.height - 450)),
  acertou: false
};
const copo = {
  isMoving: false,
  image: copoImage,
  speed: 500, // movimento em pixels por segundo
  x: 200 + (Math.random() * (canvas.width - 500)),
  y: 200 + (Math.random() * (canvas.height - 450)),
  acertou: false
};
const garrafa = {
  isMoving: false,
  image: garrafaImage,
  speed: 500, // movimento em pixels por segundo
  x: 200 + (Math.random() * (canvas.width - 500)),
  y: 200 + (Math.random() * (canvas.height - 450)),
  acertou: false
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
  checarSeSoltouNoLugarCerto()
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
    element.isMoving = true
    updateTest(element,14/1000)
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
    ObjetosLixoMarrom.pop(element)
    element.x = 100000000
    element.y = 100000000
    element.acertou = true
    element.isMoving = false
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
    ObjetosLixoAzul.pop(element)
    element.x = 100000000
    element.y = 100000000
    element.acertou = true
    element.isMoving = false
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
    ObjetosLixoAmarelo.pop(element)
    element.x = 100000000
    element.y = 100000000
    element.acertou = true
    element.isMoving = false
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
    ObjetosLixoVerde.pop(element)
    element.x = 100000000
    element.y = 100000000
    element.acertou = true
    element.isMoving = false
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
    ObjetosLixoVermelho.pop(element)
    element.x = 100000000
    element.y = 100000000
    element.acertou = true
    element.isMoving = false
  }  
  });

  var countAcertos = 0

  ObjetosLixo.forEach(element => {
    if(!(32 in keysDown)
       && element.isMoving == true
       && element.acertou == false){
      console.log("errouuuu")
      element.isMoving = false
      pontuacao -= 5
      erros++
      element.x = 200 + (Math.random() * (canvas.width - 500)),
      element.y = 200 + (Math.random() * (canvas.height - 450))
    }
    
    if(element.acertou == true){
      countAcertos++      
    }
  });

  if(countAcertos == ObjetosLixo.length){
    wait(1000);
    window.alert('GANHOU')
    console.log('GANHOUUU')
  }
  
};

function wait(ms)
{
    var d = new Date();
    var d2 = null;
    do { d2 = new Date(); }
    while(d2-d < ms);
}

// Renderiza tudo
const render = function () {

  ctx.drawImage(bgImage, 0, 0, canvas.width, canvas.height);
  ctx.drawImage(heroImage, hero.x, hero.y, 50, 50);
  ctx.drawImage(lixoAzulImage, lixoAzul.x, lixoAzul.y, 100, 100);
  ctx.drawImage(lixoMarromImage, lixoMarrom.x, lixoMarrom.y, 100, 100);
  ctx.drawImage(lixoAmareloImage, lixoAmarelo.x, lixoAmarelo.y, 100, 100);
  ctx.drawImage(lixoVerdeImage, lixoVerde.x, lixoVerde.y, 100, 100);
  ctx.drawImage(lixoVermelhoImage, lixoVermelho.x, lixoVermelho.y, 100, 100);
  ctx.drawImage(bananaImage, banana.x, banana.y, 100, 100);
  ctx.drawImage(papelImage, papel.x, papel.y, 50, 50);
  ctx.drawImage(latinhaImage, latinha.x, latinha.y, 60, 60);
  ctx.drawImage(copoImage, copo.x, copo.y, 40, 40);
  ctx.drawImage(garrafaImage, garrafa.x, garrafa.y, 60, 60);

  ctx.fillStyle = 'rgb(250, 250, 250)';
  ctx.font = '30px Helvetica';
  ctx.textAlign = 'left';
  ctx.textBaseline = 'top';
  ctx.shadowColor = 'rgb(0, 0, 0)'
  ctx.fillText('Pontuação: ' + pontuacao, 32, 32);
  ctx.fillText('Erros: ' + erros, 32, 70);
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