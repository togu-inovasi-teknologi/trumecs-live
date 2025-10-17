$(".content-artikel table").addClass("table table-bordered").wrap("<div class='table-responsive'></div>");
$(".content-artikel-text a").addClass("forange");
$('.content-artikel img').map(function () {
	$(this).addClass("img-fluid");
});
$(".slickareatagartikel").slick({
    arrows: false, 
    variableWidth: false,
    autoplay: true,
    dots: false,
    slidesToShow:3,
    centerMode: false,
    focusOnSelect: true,
    swipeToSlide: true
});
$(".slick-product-article").slick({
      arrows:false,
      variableWidth: false,
      autoplay:true,
      dots: false,
      centerMode: false,
      focusOnSelect: true,
      slidesToShow: 2,
    swipeToSlide: true,
    speed: 1000,
      
});
  
$(".slick-product-article-mobile").slick({
      arrows:false,
      variableWidth: false,
      autoplay:true,
      dots: true,
      centerMode: false,
      focusOnSelect: true,
      slidesToShow: 2,
    swipeToSlide: true,
    speed: 1000,
      
  });
/*var arraysOfIds = $('.content-artikel img').map(function(){
	var width= this.clientWidth;
	if (width>600) {
		$(this).addClass("img-responsive");
	};*/