console.log(document.querySelector('.js-slider-portfolio'));

const sliderPortfolio = new Swiper('.js-slider-portfolio', {
  loop: true,
    // autoplay: true,
  grabCursor: true,
  autoHeight: true,
  slidesPerView: "auto",
  // spaceBetween: 32,a
  // centeredSlides: true,
  pagination: {
    el: ".new-portfolio .swiper-pagination",
    clickable: true,
  },
});


