$(document).ready(function () {
  $("#colorNav").change(function () {
    var color = $(this).val();
    $("#afterColorNav").val(color);
  });
  $("#colorNavText").change(function () {
    var color = $(this).val();
    $("#afterColorNavText").val(color);
  });
  $("#colorTextName").change(function () {
    var color = $(this).val();
    $("#afterColorTextName").val(color);
  });
  $("#colorBg").change(function () {
    var color = $(this).val();
    $("#afterColorBg").val(color);
  });
  $("#colorTextTitle").change(function () {
    var color = $(this).val();
    $("#afterColorTextTitle").val(color);
  });
  $("#colorTextContent").change(function () {
    var color = $(this).val();
    $("#afterColorTextContent").val(color);
  });
  $("#colorTextNameCategory").change(function () {
    var color = $(this).val();
    $("#afterColorTextNameCategory").val(color);
  });
  $("#colorCardDescription").change(function () {
    var color = $(this).val();
    $("#afterColorCardDescription").val(color);
  });
  $("#colorCardTitle").change(function () {
    var color = $(this).val();
    $("#afterColorCardTitle").val(color);
  });
  $("#colorCardContent").change(function () {
    var color = $(this).val();
    $("#afterColorCardContent").val(color);
  });
  $("#colorTextNameProduct").change(function () {
    var color = $(this).val();
    $("#afterColorTextNameProduct").val(color);
  });
  $("#colorButton").change(function () {
    var color = $(this).val();
    $("#afterColorButton").val(color);
  });
  $("#colorTitleCover").change(function () {
    var color = $(this).val();
    $("#afterColorTitleCover").val(color);
  });
  $("#colorContentCover").change(function () {
    var color = $(this).val();
    $("#afterColorContentCover").val(color);
  });
  $("#colorCardProduct").change(function () {
    var color = $(this).val();
    $("#afterColorCardProduct").val(color);
  });
  $("#colorTextCardProduct").change(function () {
    var color = $(this).val();
    $("#afterColorTextCardProduct").val(color);
  });
  // $("#table-content-desc").Datatable({
  //   ordering: false,
  //   paging: true,
  //   searching: true,
  //   info: true,
  //   autowidth: false,
  // });
});

tinyMCE.baseURL = base_url + "asset/backend/dist/js/tinymce/";

$(document).ready(function () {
  tinymce.init({
    plugins: "table",
    selector: "#contentDescription",
    menubar: false,
    relative_urls: false,
    remove_script_host: false,
    height: "200",
    paste_block_drop: false,
    paste_data_images: true,
    paste_as_text: true,
    license_key: "gpl",
    toolbar: [
      "undo redo | styleselect table | alignleft aligncenter alignjustify alignright bold italic bullist numlist",
    ],
  });
  tinymce.init({
    plugins: "table",
    selector: "#storeDescription",
    menubar: false,
    relative_urls: false,
    remove_script_host: false,
    height: "200",
    paste_block_drop: false,
    paste_data_images: true,
    paste_as_text: true,
    license_key: "gpl",
    toolbar: [
      "undo redo | styleselect table | alignleft aligncenter alignright bold italic bullist numlist",
    ],
  });
  function initTinyMCE(selector, id) {
    tinymce.init({
      plugins: "table",
      selector: selector,
      menubar: false,
      relative_urls: false,
      remove_script_host: false,
      height: "200",
      paste_block_drop: false,
      paste_data_images: true,
      paste_as_text: true,
      license_key: "gpl",
      toolbar: [
        "undo redo | styleselect table | alignleft aligncenter alignjustify alignright bold italic bullist numlist",
      ],
      setup: function (editor) {
        editor.on("init", function () {
          editor.setContent($("#contentEditDescription-" + id).val());
        });
      },
    });
  }

  $(".content-edit-description").each(function () {
    var id = $(this).data("id");
    initTinyMCE("#contentEditDescription-" + id, id);
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
  $('[data-name="is_image_toggle"]').on("change", function () {
    var isChecked = $(this).prop("checked");
    var id = $(this).val(); // Mendapatkan id dari value input
    var data = { id: id, is_image: isChecked ? 1 : 0 };

    $.ajax({
      url: base_url + "/member/store/toggleSwitchImage",
      type: "POST",
      data: data,
      success: function (response) {
        // Handle successful response
        console.log(response); // Untuk debugging
      },
      error: function (error) {
        // Handle error response
        console.error(error);
        alert("Terjadi kesalahan saat menyimpan data.");
      },
    });
  });
  $('[data-name="direction_image_toggle"]').on("change", function () {
    var isChecked = $(this).prop("checked");
    var id = $(this).val(); // Mendapatkan id dari value input
    var data = { id: id, direction_image: isChecked ? 1 : 0 };

    $.ajax({
      url: base_url + "/member/store/toggleSwitchImageDirection",
      type: "POST",
      data: data,
      success: function (response) {
        // Handle successful response
        console.log(response); // Untuk debugging
      },
      error: function (error) {
        // Handle error response
        console.error(error);
        alert("Terjadi kesalahan saat menyimpan data.");
      },
    });
  });
  $('[data-name="direction_image_cover_toggle"]').on("change", function () {
    var isChecked = $(this).prop("checked");
    var id = $(this).val(); // Mendapatkan id dari value input
    var data = { id: id, direction_title_image: isChecked ? 1 : 0 };

    $.ajax({
      url: base_url + "/member/store/toggleSwitchImageDirectionCover",
      type: "POST",
      data: data,
      success: function (response) {
        // Handle successful response
        console.log(response); // Untuk debugging
      },
      error: function (error) {
        // Handle error response
        console.error(error);
        alert("Terjadi kesalahan saat menyimpan data.");
      },
    });
  });
});
$(document).ready(function () {
  var valueColL = $(".value_col_left").val() || 6;
  var valueColR = $(".value_col_right").val() || 6;

  function populateDropdown(dropdownId, nilai) {
    $(`#${dropdownId}`).empty();

    for (let i = 1; i <= 11; i++) {
      const option = $(`<option value="${i}">${i}</option>`);
      if (parseInt(i) === parseInt(nilai)) {
        option.prop("selected", true);
      }
      $(`#${dropdownId}`).append(option);
    }
  }

  function calculateOtherDropdown(selectedValue, dropdownId) {
    const otherDropdownId =
      dropdownId === "col_left" ? "col_right" : "col_left";
    $(`#${otherDropdownId}`).val(12 - selectedValue);
  }

  populateDropdown("col_left", valueColL);
  populateDropdown("col_right", valueColR);

  $("#col_left, #col_right").change(function () {
    const selectedValue = $(this).val();
    const dropdownId = this.id;
    const otherDropdownId =
      dropdownId === "col_left" ? "col_right" : "col_left";

    const calculatedValue = Math.min(Math.max(12 - selectedValue, 1), 11);
    $(`#${otherDropdownId}`).val(calculatedValue);
    $("#value_col_left").val($("#col_left").val());
    $("#value_col_right").val($("#col_right").val());
  });
});
