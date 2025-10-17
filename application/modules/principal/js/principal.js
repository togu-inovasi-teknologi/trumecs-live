$(".slick-brands").slick({
    arrows: true, 
    variableWidth: false,
    autoplay: true,
    dots: false,
    centerMode: false,
    focusOnSelect: true,
    swipeToSlide: true,
    slidesToShow: 6,
    speed: 1000,
    prevArrow: '.prev-brands',
    nextArrow: '.next-brands',
});
  $(".slick-brands-mobile").slick({
    arrows: false, 
    variableWidth: false,
    autoplay: true,
    dots: false,
    centerMode: false,
    focusOnSelect: true,
    swipeToSlide: true,
    slidesToShow: 3,
    speed: 1000,
  });