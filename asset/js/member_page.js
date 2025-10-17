var base_url = $("body").attr("baseurl");

/*$('#login_member').validator().on('submit', function (e) {
	if (e.isDefaultPrevented()) {
    // handle the invalid form...
} else {
    // everything looks good!

}
})*/

$(document).on("submit", "#login_member", function (e) {
  e.isDefaultPrevented();
  $("button[type=submit]").replaceWith(
    '<span class="btn form-control btnnew disabled">' +
      $("button[type=submit]").text() +
      "</span>"
  );
});

$(document).on("submit", "#signup_member", function (e) {
  e.isDefaultPrevented();
  $("button[type=submit]").replaceWith(
    '<span class="btn form-control btnnew disabled">' +
      $("button[type=submit]").text() +
      "</span>"
  );
});

// $(document).on("submit",".settingmember",function(e) {
// 	e.isDefaultPrevented();
// 	$("#one_click").replaceWith('<span class="btn btnnew form-control disabled">'+$("#one_click").text() + "</span>");
// })

//$('.settingmember').validator();
$(document).ready(function () {
  var base_url = $("body").attr("baseurl");
  var id_province = $("select[name=province]").attr("id");
  var id_city = $("select[name=city]").attr("id");
  var id_districts = $("select[name=districts]").attr("id");
  var id_village = $("select[name=village]").attr("id");
  $("select[name=province]").val(id_province);
  /*	$.ajax({
	url: base_url+ "general/getwilayahprovince_json",
	dataType: "JSON",
	success: function(json){
	$("select[name=province]").html("");
	for (i in json)
				{	
	var str_select="";
					if (id_province==json[i].id) {str_select="selected"};
					$("select[name=province]").append('<option value="'+json[i].id+'" '+str_select+'>'+json[i].name+'</option>');
				}*/
  $.ajax({
    url: base_url + "general/getwilayahrigences_json?id=" + id_province,
    dataType: "JSON",
    success: function (json) {
      $("select[name=city]").html(
        '<option value="">--Pilih Kabupaten--</option>'
      );
      for (i in json) {
        var str_select = "";
        if (id_city == json[i].id) {
          str_select = "selected";
        }
        $("select[name=city]").append(
          '<option gfdgd value="' +
            json[i].id +
            '" ' +
            str_select +
            ">" +
            json[i].name +
            "</option>"
        );
      }
      $.ajax({
        url: base_url + "general/getwilayahdistricts_json?id=" + id_city,
        dataType: "JSON",
        success: function (json) {
          $("select[name=districts]").html(
            '<option value="">--Pilih Kecamatan--</option>'
          );
          for (i in json) {
            var str_select = "";
            if (id_districts == json[i].id) {
              str_select = "selected";
            }
            $("select[name=districts]").append(
              '<option value="' +
                json[i].id +
                '" ' +
                str_select +
                ">" +
                json[i].name +
                "</option>"
            );
          }
          $.ajax({
            url:
              base_url + "general/getwilayahvillages_json?id=" + id_districts,
            dataType: "JSON",
            success: function (json) {
              $("select[name=village]").html(
                '<option value="">--Pilih Kelurahan--</option>'
              );
              for (i in json) {
                var str_select = "";
                if (id_village == json[i].id) {
                  str_select = "selected";
                }
                $("select[name=village]").append(
                  '<option value="' +
                    json[i].id +
                    '" ' +
                    str_select +
                    ">" +
                    json[i].name +
                    "</option>"
                );
              }
            },
          });
        },
      });
    },
  });
  /*	    }
	});*/
  $(document).on("change", "select[name=province]", function () {
    var id = $(this).val();
    $.ajax({
      url: base_url + "general/getwilayahrigences_json?id=" + id,
      dataType: "JSON",
      success: function (json) {
        $("select[name=city]").html("<option>Pilih Kabupaten</option>");
        $("select[name=districts]").html(
          "<option>-sedang mengambil data...-</option>"
        );
        $("select[name=village]").html(
          "<option>-sedang mengambil data...-</option>"
        );

        for (i in json) {
          var str_select = "";
          $("select[name=city]").append(
            '<option value="' +
              json[i].id +
              '" ' +
              str_select +
              ">" +
              json[i].name +
              "</option>"
          );
        }
      },
    });
  });

  $(document).on("change", "select[name=city]", function () {
    var id = $(this).val();
    $.ajax({
      url: base_url + "general/getwilayahdistricts_json?id=" + id,
      dataType: "JSON",
      success: function (json) {
        $("select[name=districts]").html("<option>Pilih Kecamatan</option>");
        $("select[name=village]").html(
          "<option>-sedang mengambil data...-</option>"
        );
        for (i in json) {
          var str_select = "";
          $("select[name=districts]").append(
            '<option value="' +
              json[i].id +
              '" ' +
              str_select +
              ">" +
              json[i].name +
              "</option>"
          );
        }
      },
    });
  });

  $(document).on("change", "select[name=districts]", function () {
    var id = $(this).val();
    $.ajax({
      url: base_url + "general/getwilayahvillages_json?id=" + id,
      dataType: "JSON",
      success: function (json) {
        $("select[name=village]").html("<option>Pilih Desa</option>");
        for (i in json) {
          var str_select = "";
          $("select[name=village]").append(
            '<option value="' +
              json[i].id +
              '" ' +
              str_select +
              ">" +
              json[i].name +
              "</option>"
          );
        }
      },
    });
  });
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //Shipping
  var id_shipping_province = $("select[name=shipping_province]").attr("id");
  var id_shipping_city = $("select[name=shipping_city]").attr("id");
  var id_shipping_districts = $("select[name=shipping_districts]").attr("id");
  var id_shipping_village = $("select[name=shipping_village]").attr("id");
  $("select[name=shipping_province]").val(id_shipping_province);
  /*	
	$.ajax({
	    url: base_url+ "general/getwilayahprovince_json",
	    dataType: "JSON",
	    success: function(json){
	    	$("select[name=shipping_province]").html("");
	        for (i in json)
				{	
	    			var str_select="";
					if (id_shipping_province==json[i].id) {str_select="selected"};
					$("select[name=shipping_province]").append('<option value="'+json[i].id+'" '+str_select+'>'+json[i].name+'</option>');
				}*/
  $.ajax({
    url:
      base_url + "general/getwilayahrigences_json?id=" + id_shipping_province,
    dataType: "JSON",
    success: function (json) {
      $("select[name=shipping_city]").html("");
      for (i in json) {
        var str_select = "";
        if (id_shipping_city == json[i].id) {
          str_select = "selected";
        }
        $("select[name=shipping_city]").append(
          '<option value="' +
            json[i].id +
            '" ' +
            str_select +
            ">" +
            json[i].name +
            "</option>"
        );
      }
      $.ajax({
        url:
          base_url + "general/getwilayahdistricts_json?id=" + id_shipping_city,
        dataType: "JSON",
        success: function (json) {
          $("select[name=shipping_districts]").html("");
          for (i in json) {
            var str_select = "";
            if (id_shipping_districts == json[i].id) {
              str_select = "selected";
            }
            $("select[name=shipping_districts]").append(
              '<option value="' +
                json[i].id +
                '" ' +
                str_select +
                ">" +
                json[i].name +
                "</option>"
            );
          }
          $.ajax({
            url:
              base_url +
              "general/getwilayahvillages_json?id=" +
              id_shipping_districts,
            dataType: "JSON",
            success: function (json) {
              $("select[name=shipping_village]").html("");
              for (i in json) {
                var str_select = "";
                if (id_shipping_village == json[i].id) {
                  str_select = "selected";
                }
                $("select[name=shipping_village]").append(
                  '<option value="' +
                    json[i].id +
                    '" ' +
                    str_select +
                    ">" +
                    json[i].name +
                    "</option>"
                );
              }
            },
          });
        },
      });
    },
  });
  /*	    }
	});*/
  $(document).on("change", "select[name=shipping_province]", function () {
    var id = $(this).val();
    $.ajax({
      url: base_url + "general/getwilayahrigences_json?id=" + id,
      dataType: "JSON",
      success: function (json) {
        $("select[name=shipping_city]").html(
          "<option>Pilih Kabupaten</option>"
        );
        $("select[name=shipping_districts]").html(
          "<option>-sedang mengambil data...-</option>"
        );
        $("select[name=shipping_village]").html(
          "<option>-sedang mengambil data...-</option>"
        );

        for (i in json) {
          var str_select = "";
          $("select[name=shipping_city]").append(
            '<option value="' +
              json[i].id +
              '" ' +
              str_select +
              ">" +
              json[i].name +
              "</option>"
          );
        }
      },
    });
  });

  $(document).on("change", "select[name=shipping_city]", function () {
    var id = $(this).val();
    $.ajax({
      url: base_url + "general/getwilayahdistricts_json?id=" + id,
      dataType: "JSON",
      success: function (json) {
        $("select[name=shipping_districts]").html(
          "<option>Pilih Kecamatan</option>"
        );
        $("select[name=shipping_village]").html(
          "<option>-sedang mengambil data...-</option>"
        );
        for (i in json) {
          var str_select = "";
          $("select[name=shipping_districts]").append(
            '<option value="' +
              json[i].id +
              '" ' +
              str_select +
              ">" +
              json[i].name +
              "</option>"
          );
        }
      },
    });
  });

  $(document).on("change", "select[name=shipping_districts]", function () {
    var id = $(this).val();
    $.ajax({
      url: base_url + "general/getwilayahvillages_json?id=" + id,
      dataType: "JSON",
      success: function (json) {
        $("select[name=shipping_village]").html("<option>Pilih Desa</option>");
        for (i in json) {
          var str_select = "";
          $("select[name=shipping_village]").append(
            '<option value="' +
              json[i].id +
              '" ' +
              str_select +
              ">" +
              json[i].name +
              "</option>"
          );
        }
      },
    });
  });
});

var ttt = $("select[name=date]").attr("isvalue");
var bbb = $("select[name=month]").attr("isvalue");
var yyy = $("select[name=year]").attr("isvalue");
$("select[name=date]").val(ttt);
$("select[name=month]").val(bbb);
$("select[name=year]").val(yyy);

$(".detail-btn").click(function (data) {
  id_rfq = $(this).data("id");
  url = base_url + "member/get_detail_penawaran";

  $.post(url, { id_rfq: id_rfq }, function (data) {
    $(".modal-body").html(data);
  });
});

$(document).on("change", "input[type=file]", function () {
  var str = $(this).val();
  readURL(this);
  $(this).attr(
    "data-content",
    "..." + str.substring(str.length, str.length - 9)
  );
  $("input[name=img_new]").val("yes");
});

function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      $(".blah").attr("src", e.target.result);
    };

    reader.readAsDataURL(input.files[0]);
  }
}
