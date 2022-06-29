window.onscroll = function() {
  if(window.pageYOffset > 200) {
    document.body.classList.add('js-menu-fixed');
  } else {
    document.body.classList.remove('js-menu-fixed');
  }

  if (window.pageYOffset > 400 && window.screen.width >= 650) {
    document.body.classList.add('js-up-button-show');
  } else {
    document.body.classList.remove('js-up-button-show');
  }

}
