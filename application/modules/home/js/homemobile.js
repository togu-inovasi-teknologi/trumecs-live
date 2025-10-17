$(document).ready(function(){
  $('.slide-mobile').fadeIn();
  $(".slick-banner-home").slick({
    arrows: false, 
    variableWidth: false,
    autoplay: true,
    dots: true,
    centerMode: false,
    focusOnSelect: true,
    swipeToSlide: true,
    slidesToShow:1,
    speed: 1000,
    
  });
  $(".slick-top-product").slick({
    arrows: true, 
    variableWidth: false,
    autoplay: true,
    dots: true,
    centerMode: false,
    focusOnSelect: true,
    swipeToSlide: true,
    slidesToShow:1,
    speed: 1000,
  });
  $(".slick-banner-home-2").slick({
    arrows: true, 
    variableWidth: false,
    autoplay: true,
    dots: false,
    centerMode: false,
    focusOnSelect: true,
    swipeToSlide: true,
    slidesToShow:1,
    speed: 2000,
    prevArrow: '.prev-banner-home',
    nextArrow: '.next-banner-home',
  });
  $(".slick-article-home").slick({
    arrows: true, 
    variableWidth: false,
    autoplay: true,
    dots: false,
    centerMode: false,
    focusOnSelect: true,
    swipeToSlide: true,
    slidesToShow: 3,
    speed: 1000,
    prevArrow: '.prev-article-home',
    nextArrow: '.next-article-home',
  });
  
  $(".slick-promo-home").slick({
    arrows: true, 
    variableWidth: false,
    autoplay: true,
    dots: false,
    centerMode: false,
    focusOnSelect: true,
    swipeToSlide: true,
    slidesToShow: 2,
    speed: 1000,
    prevArrow: '.prev-promo-home',
    nextArrow: '.next-promo-home',
  });
  $(".slick-brands-even").slick({
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
  $(".slick-brands-odd").slick({
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
  $(".slick-brands-even-mobile").slick({
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
  $(".slick-brands-odd-mobile").slick({
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
  $(".slick-promo-home-mobile").slick({
    arrows: false, 
    variableWidth: false,
    autoplay: true,
    dots: true,
    centerMode: false,
    focusOnSelect: true,
    swipeToSlide: true,
    slidesToShow: 1,
    speed: 1000
  });
  $(".slick-article-home-mobile").slick({
    arrows: false, 
    variableWidth: false,
    autoplay: true,
    dots: false,
    centerMode: false,
    focusOnSelect: true,
    swipeToSlide: true,
    slidesToShow: 2,
    speed:1000
  });
  $(".slick-product-home").slick({
    arrows:true,
    variableWidth: false,
    autoplay:true,
    dots: true,
    centerMode: false,
    focusOnSelect: true,
    slidesToShow: 5,
    swipeToSlide: true,
    speed: 1000,
    prevArrow: '.prev-product-home',
    nextArrow: '.next-product-home',
  });
  $(".slick-product-home-mobile").slick({
    arrows:false,
    // variableWidth: false,
    autoplay:true,
    dots: true,
    centerMode: false,
    focusOnSelect: true,
    slidesToShow: 2,
    swipeToSlide: true,
    speed: 1000,
  });
  $(".slick-product-home-mobile-new-product").slick({
    arrows:false,
    // variableWidth: false,
    autoplay:true,
    dots: true,
    centerMode: false,
    focusOnSelect: true,
    slidesToShow: 2,
    swipeToSlide: true,
    speed: 1000,
  });

  $(".slick-best-seller-home").slick({
    arrows:true,
    variableWidth: false,
    autoplay:true,
    dots: true,
    centerMode: false,
    focusOnSelect: true,
    slidesToShow: 5,
    swipeToSlide: true,
    speed: 1000,
    prevArrow: '.prev-best-seller-home',
    nextArrow: '.next-best-seller-home',
  });
  
  $(".slick-product-category-home").slick({
    arrows:false,
    variableWidth: false,
    autoplay:false,
    dots: true,
    centerMode: false,
    focusOnSelect: true,
    slidesToShow: 4,
  });
  $(".slickbigslide").find("img").css("width",screen.width);
  $(".test-list").slick({
    arrows:true,
    variableWidth: false,
    autoplay:false,
    dots: true,
    centerMode: false,
    focusOnSelect: true,
    slidesToShow: 6,
    slidesToScroll: 6
  });
  $(".mobile-home-list").slick({
    arrows:false,
    variableWidth: false,
    autoplay:false,
    dots: true,
    centerMode: false,
    focusOnSelect: true,
    slidesToShow: 2,
    swipeToSlide:true,
  });
  $(".slick-banner-landpage").slick({
    arrows:false,
    variableWidth: false,
    autoplay:true,
    dots: true,
    centerMode: false,
    focusOnSelect: true,
    slidesToShow: 1,
    swipeToSlide: true,
    speed: 1000,
  });
});

