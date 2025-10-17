$(document).ready(function(){
  $("#cari-produk-promo").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $(".produk-promo").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
  
  $("#sph-nc").click(function(){
      $("#form-nc").trigger("reset");
      $("#modal-nc").modal("show");
  });
  $("#sph-cirebon").click(function(){
      $("#form-cirebon").trigger("reset");
      $("#modal-cirebon").modal("show");
  });
  $("#form-nc").submit(function(){
      $("#modal-nc").modal("hide");
      return true;
  });
  $("#form-cirebon").submit(function(){
      $("#modal-cirebon").modal("hide");
      return true;
  });
  
  $(".tab-produk").click(function(){
      var produk = $(this).data('produk');
      $(".tab-produk").find(".arrow-produk").removeClass("pointer-produk");
      $(this).find(".arrow-produk").addClass("pointer-produk");
      
      $(".detail-produk").hide();
      $(".detail-produk[data-produk='"+produk+"']").show();
  });
  
});