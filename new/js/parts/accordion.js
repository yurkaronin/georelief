for (let custTabsItem of custTabsItems) {

  custTabsItem.querySelector('.cust-accordion__button').onclick = function () {
    custTabsItem.classList.toggle('show');
    custTabsItem.querySelector('.cust-accordion__content').classList.toggle('collapse');
  };
}