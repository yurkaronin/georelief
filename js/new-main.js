// Глобальные переменные
// const menuButton = document.querySelector('.js-btn-menu');
const custTabsItems = document.querySelectorAll('.cust-accordion');

// функция подключения скриптов
function include(url) {
  var script = document.createElement('script');
  script.src = url;
  document.getElementsByTagName('head')[0].appendChild(script);
}

include("./js/parts/fixed-header.js");
include("./js/parts/sliders.js");
include("./js/parts/accordion.js");
