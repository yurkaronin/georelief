menuButton.onclick = function () {
  if (document.body.classList.contains('js-menu-active')) {
    document.body.classList.remove('js-menu-active');
  } else {
    document.body.classList.add('js-menu-active');
  }
}

