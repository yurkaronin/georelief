menuButton.onclick = function () {
  if (document.body.classList.contains('js-menu-active')) {
    document.body.classList.remove('js-menu-active');
  } else {
    document.body.classList.add('js-menu-active');
  }
}

const headerLink = document.querySelectorAll('.new-header__link');

for (let headerLinkElem of headerLink) {

  headerLinkElem.onclick = function (event) {
    // if(headerLinkElem.href === 'tel:88612907722' || headerLinkElem.href === '#modal-callback' ) {
    // } else {
      document.body.classList.remove('js-menu-active');
    // }
  };
}
