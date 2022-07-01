// слушаем событие клика по всем элементам коллекции
for (let custTabsItem of custTabsItems) {
  // уточняем что слушать клик нужно только по шпаке внутри каждого элемента (кнопка)
  custTabsItem.querySelector('.cust-accordion__button').onclick = function () {
    // если у элемента есть активный класс
    if (custTabsItem.classList.contains('show')) {
      // удаляем нахер все активные классы у всех элементов этой коллекции
      custTabsItem.classList.remove('show');
      // и у контента в каждом элементе коллекции тоже чистим активный класс, ибо нефиг висеть открытым без надобности!
      custTabsItem.querySelector('.cust-accordion__content').classList.remove('collapse');
    } else {
      // ну а в остальных случаях делаем то же самое, тока дополнительно в конце добавляем активные классы для элемента, по которому соершён клик и для его содержимого
      for (let elem of custTabsItems) {
        elem.classList.remove('show');
        elem.querySelector('.cust-accordion__content').classList.remove('collapse');

      }
      custTabsItem.classList.add('show');
      custTabsItem.querySelector('.cust-accordion__content').classList.toggle('collapse');
    }
  };
}
