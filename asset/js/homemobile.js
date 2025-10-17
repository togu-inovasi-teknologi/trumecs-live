$(document).ready(function(){
  $('.slide-mobile').fadeIn();
  $(".slickbigslide").slick({
    arrows: false, 
    variableWidth: true,autoplay:true,
    dots: true,
    centerMode: true,
    focusOnSelect: true
});
  $(".slickareaslide").slick({
    arrows: false, 
    variableWidth: false,autoplay:true,
    dots: false,
    slidesToShow:2,
    centerMode: false,
    focusOnSelect: true
});
  $(".slickbigslide").find("img").css("width",screen.width);
 
    $(".slick-line1").slick({
        arrows:true,
        variableWidth: false,
        autoplay:false,
        dots: true,
        centerMode: false,
        focusOnSelect: true,
        slidesToShow: 5,
        slidesToScroll: 5
    });

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
    arrows:true,
    variableWidth: false,
    autoplay:false,
    dots: true,
    centerMode: false,
    focusOnSelect: true,
    slidesToShow: 2,
    slidesToScroll: 2
});

});

