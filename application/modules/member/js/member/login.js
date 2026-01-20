$(document).ready(function () {
  $(".signup-button").on("click", function () {
    $(".login-page").hide("slide", { direction: "left" }, 200);
    $(".signup-page").delay(200).show("slide", { direction: "right" }, 300);
  });
  $(".login-button").on("click", function () {
    $(".signup-page").hide("slide", { direction: "right" }, 200);
    $(".login-page").delay(200).show("slide", { direction: "left" }, 300);
  });
  $(".show-password-icon").click(function () {
    var prop = $(this).val();
    var icon = $(this);
    if (prop == 1) {
      $(".password").attr("type", "text");
      icon.html('<i class="fa fa-eye-slash"></i>');
      icon.val(2);
    } else {
      $(".password").attr("type", "password");
      icon.html('<i class="fa fa-eye"></i>');
      icon.val(1);
    }
  });
});
