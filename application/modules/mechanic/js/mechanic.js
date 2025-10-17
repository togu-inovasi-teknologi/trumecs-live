$(".slick-usp-mechanic").slick({
  arrows: false,
  autoplay: true,
  dots: true,
  slidesToShow: 1,
  centerMode: false,
  focusOnSelect: true,
  swipeToSlide: true,
  variableWidth: false,
});

$(".slick-portofolio-mobile").slick({
  arrows: true,
  autoplay: true,
  dots: false,
  slidesToShow: 1,
  centerMode: false,
  focusOnSelect: true,
  swipeToSlide: true,
  variableWidth: false,
});
$(".slick-portofolio-desktop").slick({
  arrows: true,
  autoplay: true,
  dots: false,
  slidesToShow: 3,
  centerMode: true,
  focusOnSelect: true,
  swipeToSlide: true,
  variableWidth: true,
});

$(document).ready(function () {
  var $modal = $("#modalGallery");
  var $modalImg = $("#img01");
  var $captionText = $("#caption");

  $("#imgGallery").on("click", function () {
    $modal.show();
    $modalImg.attr("src", $(this).attr("src"));
    $captionText.text($(this).attr("alt"));
  });

  $(".close").on("click", function () {
    $modal.hide();
  });
});