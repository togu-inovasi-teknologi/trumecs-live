var baseurl = $("body").attr("baseurl");
var bsContainerWidth = $("body").find(".container").width();

var format = function (num) {
  var str = num.toString().replace("", ""),
    parts = false,
    output = [],
    i = 1,
    formatted = null;
  if (str.indexOf(".") > 0) {
    parts = str.split(".");
    str = parts[0];
  }
  str = str.split("").reverse();
  for (var j = 0, len = str.length; j < len; j++) {
    if (str[j] != ".") {
      output.push(str[j]);
      if (i % 3 == 0 && j < len - 1) {
        output.push(".");
      }
      i++;
    }
  }
  formatted = output.reverse().join("");
  return "" + formatted + (parts ? "." + parts[1].substr(0, 2) : "");
};
$("input[name='nama-foto']").change(function () {
  const namaFoto = $(this).val().split("\\").pop();
  $("#nama-foto").text(namaFoto);
});
$(document).ready(function () {
  $(".add-rfq").click(function () {
    $("html, body").animate(
      {
        scrollTop:
          bsContainerWidth <= 768
            ? $("#tambahRfq").offset().top - 55
            : $("#tambahRfq").offset().top - 10,
      },
      100
    );
  });
});

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
  var id_shipping_province = $("select[name=alamat_province]").attr("id");
  var id_shipping_city = $("select[name=alamat_city]").attr("id");
  var id_shipping_districts = $("select[name=alamat_districts]").attr("id");
  var id_shipping_village = $("select[name=alamat_village]").attr("id");
  $("select[name=alamat_province]").val(id_shipping_province);
  /*	
	$.ajax({
	    url: base_url+ "general/getwilayahprovince_json",
	    dataType: "JSON",
	    success: function(json){
	    	$("select[name=alamat_province]").html("");
	        for (i in json)
				{	
	    			var str_select="";
					if (id_shipping_province==json[i].id) {str_select="selected"};
					$("select[name=alamat_province]").append('<option value="'+json[i].id+'" '+str_select+'>'+json[i].name+'</option>');
				}*/
  $.ajax({
    url:
      base_url + "general/getwilayahrigences_json?id=" + id_shipping_province,
    dataType: "JSON",
    success: function (json) {
      $("select[name=alamat_city]").html("");
      for (i in json) {
        var str_select = "";
        if (id_shipping_city == json[i].id) {
          str_select = "selected";
        }
        $("select[name=alamat_city]").append(
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
          $("select[name=alamat_districts]").html("");
          for (i in json) {
            var str_select = "";
            if (id_shipping_districts == json[i].id) {
              str_select = "selected";
            }
            $("select[name=alamat_districts]").append(
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
              $("select[name=alamat_village]").html("");
              for (i in json) {
                var str_select = "";
                if (id_shipping_village == json[i].id) {
                  str_select = "selected";
                }
                $("select[name=alamat_village]").append(
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
  $(document).on("change", "select[name=alamat_province]", function () {
    var id = $(this).val();
    $.ajax({
      url: base_url + "general/getwilayahrigences_json?id=" + id,
      dataType: "JSON",
      success: function (json) {
        $("select[name=alamat_city]").html("<option>Pilih Kabupaten</option>");
        $("select[name=alamat_districts]").html(
          "<option>-sedang mengambil data...-</option>"
        );
        $("select[name=alamat_village]").html(
          "<option>-sedang mengambil data...-</option>"
        );

        for (i in json) {
          var str_select = "";
          $("select[name=alamat_city]").append(
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

  $(document).on("change", "select[name=alamat_city]", function () {
    var id = $(this).val();
    $.ajax({
      url: base_url + "general/getwilayahdistricts_json?id=" + id,
      dataType: "JSON",
      success: function (json) {
        $("select[name=alamat_districts]").html(
          "<option>Pilih Kecamatan</option>"
        );
        $("select[name=alamat_village]").html(
          "<option>-sedang mengambil data...-</option>"
        );
        for (i in json) {
          var str_select = "";
          $("select[name=alamat_districts]").append(
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

  $(document).on("change", "select[name=alamat_districts]", function () {
    var id = $(this).val();
    $.ajax({
      url: base_url + "general/getwilayahvillages_json?id=" + id,
      dataType: "JSON",
      success: function (json) {
        $("select[name=alamat_village]").html("<option>Pilih Desa</option>");
        for (i in json) {
          var str_select = "";
          $("select[name=alamat_village]").append(
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

$(document).on("click", ".btn-alamat-rfq", function () {
  var province = $('select[name="alamat_province"] option:selected').text();
  var district = $('select[name="alamat_districts"] option:selected').text();
  var city = $('select[name="alamat_city"] option:selected').text();
  var village = $('select[name="alamat_village"] option:selected').text();
  $(".alamat-nama").html($('input[name="alamat_name"]').val().toUpperCase());
  $(".alamat-phone").html(
    $('input[name="alamat_phone"]').val() != ""
      ? " ( " + $('input[name="alamat_phone"]').val() + " )"
      : ""
  );
  $(".alamat-company").html($('input[name="alamat_company"]').val());
  $(".alamat-jalan").html($('textarea[name="alamat_address"]').val());
  $(".alamat-provinsi").html(
    jQuery.isNumeric($('select[name="alamat_province"]').val())
      ? $('select[name="alamat_province"] option:selected').text() + " "
      : ""
  );
  $(".alamat-kabupaten").html(
    jQuery.isNumeric($('select[name="alamat_city"]').val())
      ? $('select[name="alamat_city"] option:selected').text()
      : ""
  );
  $(".alamat-kecamatan").html(
    jQuery.isNumeric($('select[name="alamat_districts"]').val())
      ? $('select[name="alamat_districts"] option:selected').text() + " "
      : ""
  );
  $(".alamat-kelurahan").html(
    jQuery.isNumeric($('select[name="alamat_village"]').val())
      ? " " + $('select[name="alamat_village"] option:selected').text()
      : ""
  );
  $(".alamat-kodepos").html($('input[name="alamat_kodepos"]').val());
  $("#editAlamat").modal("hide");
  $('input[name="alamat_province"]').val(province);
  $('input[name="alamat_city"]').val(city);
  $('input[name="alamat_districts"]').val(district);
  $('input[name="alamat_village"]').val(village);
});

$(document).ready(function () {
  $(".fileExtension").each(function () {
    var filename = $(this).data("filename");
    var fileExtension = filename.split(".").pop().toLowerCase();
    var iconPath = getIconPathByExtension(fileExtension);
    var path = getPathByExtension(fileExtension);
    $(this).find(".fileIcon").attr("src", iconPath);
    $(this)
      .find(".filePath")
      .attr("href", path + filename);
  });
});
function getIconPathByExtension(extension) {
  var iconMapping = {
    png: baseurl + "public/icon/fileicon/png.png",
    xls: baseurl + "public/icon/fileicon/xls.png",
    xlsx: baseurl + "public/icon/fileicon/xlsx.png",
    jpg: baseurl + "public/icon/fileicon/jpg.png",
    jpeg: baseurl + "public/icon/fileicon/jpeg.png",
  };
  return iconMapping[extension] || "public/icon/fileicon/default.png";
}
function getPathByExtension(extension) {
  var pathMapping = {
    xls: baseurl + "public/sourcing/",
    xlsx: baseurl + "public/sourcing/",
    png: baseurl + "public/sourcing/foto/",
    jpg: baseurl + "public/sourcing/foto/",
    jpeg: baseurl + "public/sourcing/foto/",
  };
  return pathMapping[extension] || "public/sourcing/";
}
$(".lihat-alamat").click(function () {
  var alamatDetail = $(this).siblings(".alamat-detail");
  alamatDetail.toggle();
  $(this).text(function (i, text) {
    return text === "Lihat Selengkapnya" ? "Sembunyikan" : "Lihat Selengkapnya";
  });
});

$(document).ready(function () {
  var maxHeight = 75;
  var isExpanded = [];

  function setHeight(index, height) {
    $(".detail-rfq")
      .eq(index)
      .css("max-height", height + "px");
    $(".detail-rfq").eq(index).css("overflow-y", "hidden");
  }
  $(".detail-rfq").each(function (index) {
    if ($(this).height() > maxHeight) {
      setHeight(index, maxHeight);
      $(".lihat-selengkapnya").eq(index).show();
      isExpanded[index] = false;
    } else {
      $(".lihat-selengkapnya").eq(index).hide();
      isExpanded[index] = true;
    }
  });
  $(".lihat-selengkapnya").click(function () {
    var index = $(".lihat-selengkapnya").index(this);
    $(".label-new").eq(index).hide();
    if (!isExpanded[index]) {
      setHeight(index, $(".detail-rfq").eq(index)[0].scrollHeight);
      $(this).html('<i class="fa fa-angle-up"></i>');
      isExpanded[index] = true;
    } else {
      setHeight(index, maxHeight);
      $(this).html('<i class="fa fa-angle-down"></i>');
      isExpanded[index] = false;
    }
  });
  $(document).on("click", ".harga-fix", function () {
    var container = $(this).closest(".table-nego");
    var priceElement = container.find(".input-nego");
    var inputQty = container.find(".input-nego-qty");
    var priceFix = container.find(".price-fix").val();
    var action = container.find(".action-nego");
    inputQty.prop("readonly", true);
    priceElement.val(priceFix);
    bsContainerWidth <= 768
      ? action.html(
          "<button type='button' class='btn btn-info btn-block f8 redo-nego'><i class='fa fa-refresh'></i></button>"
        )
      : action.html(
          "<button type='button' class='btn btn-info btn-block f12 redo-nego'><i class='fa fa-refresh'></i></button>"
        );
  });
  $(document).on("click", ".change-nego", function () {
    var container = $(this).closest(".table-nego");
    var inputNego = container.find(".input-nego");
    var inputQty = container.find(".input-nego-qty");
    var action = container.find(".action-nego");
    inputNego.prop("readonly", false);
    inputQty.prop("readonly", true);
    bsContainerWidth <= 768
      ? action.html(
          '<button type="button" class="btn btn-warning f8 fbold change-qty">Ubah Qty</button><button type="button" class="btn btn-success f8 fix-nego"><i class="fa fa-check"></i></button>'
        )
      : action.html(
          '<button type="button" class="btn btn-success f12 btn-block fix-nego mb-5px"><i class="fa fa-check"></i></button><button type="button" class="btn btn-warning btn-block f12 fbold change-qty">Ubah Qty</button>'
        );
  });
  $(document).on("click", ".fix-nego", function () {
    var container = $(this).closest(".table-nego");
    var inputNego = container.find(".input-nego");
    var action = container.find(".action-nego");
    inputNego.prop("readonly", true);
    bsContainerWidth <= 768
      ? action.html(
          '<button type="button" class="btn btn-info btn-block f8 redo-nego"><i class="fa fa-refresh"></i></button>'
        )
      : action.html(
          '<button type="button" class="btn btn-info btn-block f12 redo-nego"><i class="fa fa-refresh"></i></button>'
        );
  });
  $(document).on("click", ".change-qty", function () {
    var container = $(this).closest(".table-nego");
    var priceElement = container.find(".input-nego");
    var priceFix = container.find(".price-fix").val();
    var inputNego = container.find(".input-nego");
    var inputQty = container.find(".input-nego-qty");
    var action = container.find(".action-nego");
    priceElement.val(priceFix);
    inputQty.prop("readonly", false);
    inputNego.prop("readonly", true);
    bsContainerWidth <= 768
      ? action.html(
          '<button type="button" class="btn btn-warning f8 fbold change-nego">Ubah Harga</button><button type="button" class="btn btn-success f8 fbold fix-qty"><i class="fa fa-check"></i></button>'
        )
      : action.html(
          '<button type="button" class="btn btn-success f12 btn-block fbold fix-qty mb-5px"><i class="fa fa-check"></i></button><button type="button" class="btn btn-warning btn-block f12 fbold change-nego">Ubah Harga</button>'
        );
  });
  $(document).on("click", ".change-qty-after", function () {
    var container = $(this).closest(".table-nego");
    var inputQty = container.find(".input-nego-qty");
    var action = container.find(".action-nego");
    inputQty.prop("readonly", false);
    bsContainerWidth <= 768
      ? action.html(
          '<button type="button" class="btn btn-success f8 btn-block fbold fix-qty-after"><i class="fa fa-check"></i>'
        )
      : action.html(
          '<button type="button" class="btn btn-success f12 btn-block fbold fix-qty-after"><i class="fa fa-check"></i>'
        );
  });
  $(document).on("click", ".fix-qty", function () {
    var container = $(this).closest(".table-nego");
    var inputQty = container.find(".input-nego-qty");
    var action = container.find(".action-nego");
    inputQty.prop("readonly", true);
    bsContainerWidth <= 768
      ? action.html(
          '<button type="button" class="btn btn-info btn-block f8 redo-nego"><i class="fa fa-refresh"></i></button>'
        )
      : action.html(
          '<button type="button" class="btn btn-info btn-block f12 redo-nego"><i class="fa fa-refresh"></i></button>'
        );
  });
  $(document).on("click", ".fix-qty-after", function () {
    var container = $(this).closest(".table-nego");
    var inputQty = container.find(".input-nego-qty");
    var action = container.find(".action-nego");
    inputQty.prop("readonly", true);
    bsContainerWidth <= 768
      ? action.html(
          '<button type="button" class="btn btn-info btn-block f8 redo-qty-after"><i class="fa fa-refresh"></i></button>'
        )
      : action.html(
          '<button type="button" class="btn btn-info btn-block f12 redo-qty-after"><i class="fa fa-refresh"></i></button>'
        );
  });
  $(document).on("click", ".redo-qty-after", function () {
    var container = $(this).closest(".table-nego");
    var inputQty = container.find(".input-nego-qty");
    var action = container.find(".action-nego");
    inputQty.prop("readonly", false);
    bsContainerWidth <= 768
      ? action.html(
          '<button type="button" class="btn btn-success f8 btn-block fbold fix-qty-after"><i class="fa fa-check"></i>'
        )
      : action.html(
          '<button type="button" class="btn btn-success f12 btn-block fbold fix-qty-after"><i class="fa fa-check"></i>'
        );
  });
  $(document).on("click", ".redo-nego", function () {
    var container = $(this).closest(".table-nego");
    var action = container.find(".action-nego");
    bsContainerWidth <= 768
      ? action.html(
          '<button type="button" class="btn btn-warning f8 fbold change-qty">Ubah Qty</button><button type="button" class="btn btn-danger f8 fbold change-nego">Harga tidak sesuai</button><button type="button" class="btn btn-success f8 fbold harga-fix">Harga Setuju</button>'
        )
      : action.html(
          '<button type="button" class="btn btn-success btn-block f12 fbold harga-fix mb-5px">Harga Setuju</button><button type="button" class="btn btn-danger btn-block f12 fbold change-nego mb-5px">Harga tidak sesuai</button><button type="button" class="btn btn-warning btn-block f12 fbold change-qty">Ubah Qty</button>'
        );
  });
  $(".input-nego-qty").each(function () {
    $(this).on("input", function () {
      var container = $(this).closest(".table-nego");
      var inputQty = $(this).val();
      var harga = container.find(".price-fix").val();
      var hargaInt = harga.replace(/\./g, "");
      var inputNego = container.find(".input-nego").val();
      var inputNegoInt = inputNego.replace(/\./g, "");
      var total = container.find(".total-harga");
      var totalHarga = hargaInt * inputQty;
      var totalInputNego = inputNegoInt * inputQty;
      if (inputNego !== null && inputNego.length !== 0) {
        total.text("Rp " + format(totalInputNego));
      } else {
        total.text("Rp " + format(totalHarga));
      }
    });
  });

  $(".input-nego").each(function () {
    $(this).on("input", function () {
      var container = $(this).closest(".table-nego");
      var inputNego = $(this).val();
      var inputNegoInt = inputNego.replace(/\./g, "");
      var harga = container.find(".price-fix").val();
      var hargaInt = harga.replace(/\./g, "");
      var inputQty = container.find(".input-nego-qty").val();
      var total = container.find(".total-harga");
      var totalInputNego = inputNegoInt * inputQty;
      var totalHarga = hargaInt * inputQty;
      console.log(totalInputNego, totalHarga, inputQty);
      if (inputNego.length !== 0) {
        total.text("Rp " + format(totalInputNego));
      } else {
        total.text("Rp " + format(totalHarga));
      }
    });
  });
});

$("*[jq-model]").on("change", function (argument) {
  var name = $(this).attr("jq-model");
  $('span[js-result="' + name + '"]').text($(this).val());
});
$(document).ready(function () {
  $("#cari-rfq").on("keyup", function () {
    var value = $(this).val().toLowerCase();
    $(".list-rfq").filter(function () {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
    });
  });
});
var previewNode = document.querySelector("#template");
previewNode.id = "";
var previewTemplate = previewNode.parentNode.innerHTML;
previewNode.parentNode.removeChild(previewNode);
$("#field_bulk").dropzone({
  url: base_url + "bulk/upload",
  parallelUploads: 3,
  clickable: ".btn-upload",
  previewTemplate: previewTemplate,
  autoQueue: true,
  maxFiles: 3,
  previewsContainer: "#previews",
  acceptedFiles: ".xls, .xlsx, .png, .jpg, .jpeg,",
  init: function () {
    this.on("dragenter", function () {
      $("#field_bulk").addClass("drag-enter");
    });
    this.on("dragleave", function () {
      $("#field_bulk").removeClass("drag-enter");
    });
    this.on("complete", (file) => {
      $(file).each(function (index, item) {
        response = JSON.parse(item.xhr.response);
        $("#field_bulk").removeClass("drag-enter");
        $("#field_bulk").append(
          '<input type="hidden" name="files[]" value="' + response.name + '" />'
        );
        setTimeout(function () {
          $(item.previewElement).find(".progress").fadeOut(1000);
        }, 500);
      });
    });
    this.on("removedfile", (file) => {
      response = JSON.parse(file.xhr.response);
      filename = response.name;
      $.post(base_url + "bulk/remove", { filename: filename }, function (data) {
        $('input[value="' + filename + '"]').remove();
      });
    });
  },
});
$(document).ready(function () {
  $("#autocomplete-input")
    .autocomplete({
      source: function (request, response) {
        $.ajax({
          url: baseurl + "member/autocomplete_wilayah",
          type: "get",
          dataType: "json",
          data: { term: request.term },
          success: function (resp) {
            response(
              $.map(resp, function (item) {
                return {
                  label: item.label,
                  value: item.value,
                };
              })
            );
          },
        });
      },
      minLength: 1,
      select: function (event, ui) {
        $("#autocomplete-input").val(ui.item.label);
        return false;
      },
    })
    .autocomplete("instance")._renderItem = function (ul, item) {
    term = $("#autocomplete-input").val();
    var upperCaseTerm = term.toUpperCase();
    var re = new RegExp(term, "gi");
    label = item.label;
    return $("<div class='p-a-1 bg-white f10'>")
      .append(
        "<div>" +
          label.replace(re, "<strong>" + upperCaseTerm + "</strong>") +
          "</div>"
      )
      .appendTo(ul);
  };
});
