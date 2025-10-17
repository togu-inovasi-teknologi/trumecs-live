var base_url = $("body").attr("baseurl");
$(document).ready(function () {
  init_select();

  function init_select() {
    $(".js-example-basic-single").select2({
      ajax: {
        url: base_url + "product/prospek/get_products",
        dataType: "json",
        data: function (params) {
          return {
            q: params.term, // search term
            page: params.page,
          };
        },
        processResults: function (data, params) {
          // parse the results into the format expected by Select2
          // since we are using custom formatting functions we do not need to
          // alter the remote JSON data, except to indicate that infinite
          // scrolling can be used
          return {
            results: data,
          };
        },
        cache: true,
      },
      placeholder: "Pilih item",
      minimumInputLength: 1,
    });

    $(".select-member").select2({
      ajax: {
        url: base_url + "backendmember/get_members",
        dataType: "json",
        data: function (params) {
          return {
            q: params.term, // search term
            page: params.page,
          };
        },
        processResults: function (data, params) {
          // parse the results into the format expected by Select2
          // since we are using custom formatting functions we do not need to
          // alter the remote JSON data, except to indicate that infinite
          // scrolling can be used
          return {
            results:
              data.length > 0
                ? data
                : [{ name: params.term, id: 0, text: params.term }],
          };
        },
        cache: true,
      },
      placeholder: "Pilih member",
      minimumInputLength: 1,

      templateResult: (data) => {
        return data.name;
      },
    });
    $(".select-marketing").select2({
      ajax: {
        url: base_url + "backendmember/get_admins",
        dataType: "json",
        data: function (params) {
          return {
            q: params.term, // search term
            page: params.page,
          };
        },
        processResults: function (data, params) {
          console.log(data);
          // parse the results into the format expected by Select2
          // since we are using custom formatting functions we do not need to
          // alter the remote JSON data, except to indicate that infinite
          // scrolling can be used
          return {
            results: data,
          };
        },
        cache: true,
      },
      placeholder: "Pilih member",
      minimumInputLength: 1,

      templateResult: (data) => {
        return data.name;
      },
    });
  }

  $(document).on("click", ".btn-add-item", function () {
    var html = "";
    html += "<tr>";
    html += "<td>";
    html +=
      '<select name="id_produk[]" class="js-example-basic-single form-control" placeholder="Nama produk" >';
    html += '<option value="">-- Pilih Item --</option></select></td>';
    html +=
      '<td width="50"><input class="form-control" name="qty[]" type="number" min="0" value="0" /></td>';
    html += '<td><span class="weight">0</span> <small>kg</small></td>';
    html +=
      '<td><div class="input-group"><span class="input-group-addon" id="basic-addon1">Rp</span><input name="harga[]" class="form-control" value="0" /><span class="input-group-addon" id="basic-addon1">/ <small class="unit">Unit</small></span></div></td>';
    html += '<td>Rp <span class="harga">0</span></small></td>';
    html += '<td><span class="warranty"></span></td>';
    html += '<td><button class="item-remove" type="button">X</button></td>';
    html += "</tr>";

    $(".group-item").append(html);
    init_select();
  });

  $(document).on("click", ".item-remove", function () {
    var confirmation = confirm("Anda yakin ingin menghapus item ini?");
    if (confirmation == true) {
      $(this).parent().parent().remove();
      hitung_total();
    }
  });

  $(document).on("select2:select", ".js-example-basic-single", function (e) {
    var data = e.params.data;
    var parent = $(this).parent().parent();
    var qty = parent.find('input[name="qty[]"]').val();
    parent.find(".weight").text(data.weight);
    parent.find("input[name='harga[]']").val(data.price);
    parent.find(".unit").text(data.unit);
    parent.find(".warranty").text(data.warranty);
    total = new Intl.NumberFormat("id-ID").format(qty * data.price);
    parent.find(".harga").text(total);
    hitung_total();
  });

  $(document).on("select2:select", ".select-member", function (e) {
    var data = e.params.data;
    $("input[name='email']").val(data.email);
    $("input[name='phone']").val(data.phone);
    $("input[name='level']").val(data.level);
    $("input[name='member_name']").val(data.name);
    $("input[name='billing_name']").val(data.name);
    $("input[name='billing_phone']").val(data.phone);
    $("input[name='billing_company']").val(data.Company);
    $("input[name='billing_address']").val(data.address);
    $("input[name='shipping_name']").val(data.name);
    $("input[name='shipping_phone']").val(data.phone);
    $("input[name='shipping_company']").val(data.Company);
    $("input[name='shipping_address']").val(data.address);
    $(".billing-province").val(data.shipping_idprovince);
    $(".shipping-province").val(data.shipping_idprovince);
    change_province(
      $(".shipping-province"),
      $(".shipping-province").val(),
      "double",
      data.shipping_idcity
    );
    //$(".billing-regency").val(data.shipping_idcity);
    //$(".shipping-regency").val(data.shipping_idcity);
    change_regency(
      $(".shipping-regency"),
      data.shipping_idcity,
      "double",
      data.shipping_iddistricts
    );
    //$(".billing-district").val(data.shipping_iddistricts);
    //$(".shipping-district").val(data.shipping_iddistricts);
    change_district(
      $(".shipping-district"),
      data.shipping_iddistricts,
      "double",
      data.shipping_idvillage
    );
    //$(".billing-village").val(data.shipping_idvillage);
    //$(".shipping-village").val(data.shipping_idvllage);
    $("input[name='billing_kodepos']").val(data.shipping_kodepos);
    $("input[name='shipping_kodepos']").val(data.shipping_kodepos);
  });

  $(document).on("change", 'input[name="qty[]"]', function () {
    value = $(this).val();
    harga = $(this).parent().parent().find("input[name='harga[]']").val();
    total = new Intl.NumberFormat("id-ID").format(value * harga);
    $(this).parent().parent().find(".harga").text(total);
    hitung_total();
  });

  $(document).on("change", 'input[name="harga[]"]', function () {
    value = $(this).val();
    qty = $(this).parent().parent().find("input[name='qty[]']").val();
    total = new Intl.NumberFormat("id-ID").format(value * qty);
    $(this).parent().parent().find(".harga").text(total);
    hitung_total();
  });

  $(document).on("change", 'input[name="shipping_cost"]', function () {
    hitung_total();
  });

  $('select[name="province"]').on("change", function () {
    change_province($(this), $(this).val(), "single");
    // $('input[name="billing_province"]').val($('select[name="province"] option:selected').text());
  });

  $(document).on("change", 'select[name="regency"]', function () {
    change_regency($(this), $(this).val(), "single");
  });

  $(document).on("change", 'select[name="district"]', function () {
    change_district($(this), $(this).val(), "single");
  });
});

function hitung_total() {
  var total = 0;
  $(".harga").each(function (item) {
    harga = $(this).text();
    total += parseInt(harga.replace(/\./g, ""));
  });
  shipping = parseInt(
    $("input[name='shipping_cost']").val().replace(/\./g, "")
  );
  total = new Intl.NumberFormat("id-ID").format(total + shipping);
  $(".total").text(total);

  var total = 0;
  $(".weight").each(function (item) {
    weight = $(this).text();
    qty = $(this).parent().parent().find('input[name="qty[]"]').val();
    total += parseInt(weight.replace(/\./g, "")) * qty;
  });
  $(".total-weight").text(total);
}

function change_province(el, val, type, id_regency = null) {
  parent = el.parent();

  id_province = val;
  url = base_url + "product/prospek/get_regencies";
  $.post(
    url,
    { class: el.data("type"), id_province: id_province },
    function (data) {
      select = "";
      data = jQuery.parseJSON(data);
      $.each(data, function (index, item) {
        select += "<option value='" + item.id + "'>" + item.name + "</option>";
      });

      if (type == "double") {
        $('select[name="regency"]').each(function (index, item) {
          $(item).html(select);
          $(item).val(id_regency);
          $(item).css({ textTransform: "capitalize" });
        });
      } else {
        parent.children("." + el.data("type") + "-regency").html(select);
        parent
          .children("." + el.data("type") + "-regency")
          .css({ textTransform: "capitalize" });
      }
    }
  );
}

function change_regency(el, val, type, id_district = null) {
  parent = el.parent();
  id_regency = val;

  url = base_url + "product/prospek/get_districts";
  $.post(url, { id_regency: id_regency }, function (data) {
    select = "";
    data = jQuery.parseJSON(data);
    $.each(data, function (index, item) {
      select += "<option value='" + item.id + "'>" + item.name + "</option>";
    });
    if (type == "double") {
      $('select[name="district"]').each(function (index, item) {
        $(item).html(select);
        $(item).val(id_district);
      });
    } else {
      parent.find("select[name='district']").html(select);
    }
  });
}

function change_district(el, val, type, id_village = null) {
  parent = el.parent();
  id_district = val;
  url = base_url + "product/prospek/get_villages";
  $.post(url, { id_district: id_district }, function (data) {
    select = "";
    data = jQuery.parseJSON(data);
    $.each(data, function (index, item) {
      select += "<option value='" + item.id + "'>" + item.name + "</option>";
    });

    if (type == "double") {
      $('select[name="village"]').each(function (index, item) {
        $(item).html(select);
        $(item).val(id_village);
      });
    } else {
      parent.find("select[name='village']").html(select);
    }
  });
}
