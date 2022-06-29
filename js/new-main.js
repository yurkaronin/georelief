// Глобальные переменные
const menuButton = document.querySelector('.js-btn-menu');
const searchButton = document.querySelectorAll('.js-btn-search');
const searchCloseButton = document.querySelector('.js-search-close');
const bigTable = document.querySelectorAll('.page-content table');
let upButton = document.querySelector('.move-up__link');

// функция подключения скриптов
function include(url) {
  var script = document.createElement('script');
  script.src = url;
  document.getElementsByTagName('head')[0].appendChild(script);
}

include("./js/parts/menu.js");
