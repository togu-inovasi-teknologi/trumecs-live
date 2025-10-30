/*!
 * Validator v0.9.0 for Bootstrap 3, by @1000hz
 * Copyright 2015 Cina Saffary
 * Licensed under http://opensource.org/licenses/MIT
 *
 * https://github.com/1000hz/bootstrap-validator
 */

+function ($) {
  'use strict';

  // VALIDATOR CLASS DEFINITION
  // ==========================

  var Validator = function (element, options) {
    this.$element = $(element)
    this.options  = options

    options.errors = $.extend({}, Validator.DEFAULTS.errors, options.errors)

    for (var custom in options.custom) {
      if (!options.errors[custom]) throw new Error('Missing default error message for custom validator: ' + custom)
    }

    $.extend(Validator.VALIDATORS, options.custom)

    this.$element.attr('novalidate', true) // disable automatic native validation
    this.toggleSubmit()

    this.$element.on('input.bs.validator change.bs.validator focusout.bs.validator', $.proxy(this.validateInput, this))
    this.$element.on('submit.bs.validator', $.proxy(this.onSubmit, this))

    this.$element.find('[data-match]').each(function () {
      var $this  = $(this)
      var target = $this.data('match')

      $(target).on('input.bs.validator', function (e) {
        $this.val() && $this.trigger('input.bs.validator')
      })
    })
  }

  Validator.INPUT_SELECTOR = ':input:not([type="submit"], button):enabled:visible'

  Validator.DEFAULTS = {
    delay: 500,
    html: false,
    disable: true,
    custom: {},
    errors: {
      match: 'Does not match',
      minlength: 'Not long enough'
    },
    feedback: {
      success: 'glyphicon-ok',
      error: 'glyphicon-remove'
    }
  }

  Validator.VALIDATORS = {
    'native': function ($el) {
      var el = $el[0]
      return el.checkValidity ? el.checkValidity() : true
    },
    'match': function ($el) {
      var target = $el.data('match')
      return !$el.val() || $el.val() === $(target).val()
    },
    'minlength': function ($el) {
      var minlength = $el.data('minlength')
      return !$el.val() || $el.val().length >= minlength
    }
  }

  Validator.prototype.validateInput = function (e) {
    var $el        = $(e.target)
    var prevErrors = $el.data('bs.validator.errors')
    var errors

    if ($el.is('[type="radio"]')) $el = this.$element.find('input[name="' + $el.attr('name') + '"]')

    this.$element.trigger(e = $.Event('validate.bs.validator', {relatedTarget: $el[0]}))

    if (e.isDefaultPrevented()) return

    var self = this

    this.runValidators($el).done(function (errors) {
      $el.data('bs.validator.errors', errors)

      errors.length ? self.showErrors($el) : self.clearErrors($el)

      if (!prevErrors || errors.toString() !== prevErrors.toString()) {
        e = errors.length
          ? $.Event('invalid.bs.validator', {relatedTarget: $el[0], detail: errors})
          : $.Event('valid.bs.validator', {relatedTarget: $el[0], detail: prevErrors})

        self.$element.trigger(e)
      }

      self.toggleSubmit()

      self.$element.trigger($.Event('validated.bs.validator', {relatedTarget: $el[0]}))
    })
  }


  Validator.prototype.runValidators = function ($el) {
    var errors   = []
    var deferred = $.Deferred()
    var options  = this.options

    $el.data('bs.validator.deferred') && $el.data('bs.validator.deferred').reject()
    $el.data('bs.validator.deferred', deferred)

    function getErrorMessage(key) {
      return $el.data(key + '-error')
        || $el.data('error')
        || key == 'native' && $el[0].validationMessage
        || options.errors[key]
    }

    $.each(Validator.VALIDATORS, $.proxy(function (key, validator) {
      if (($el.data(key) || key == 'native') && !validator.call(this, $el)) {
        var error = getErrorMessage(key)
        !~errors.indexOf(error) && errors.push(error)
      }
    }, this))

    if (!errors.length && $el.val() && $el.data('remote')) {
      this.defer($el, function () {
        var data = {}
        data[$el.attr('name')] = $el.val()
        $.get($el.data('remote'), data)
          .fail(function (jqXHR, textStatus, error) { errors.push(getErrorMessage('remote') || error) })
          .always(function () { deferred.resolve(errors)})
      })
    } else deferred.resolve(errors)

    return deferred.promise()
  }

  Validator.prototype.validate = function () {
    var delay = this.options.delay

    this.options.delay = 0
    this.$element.find(Validator.INPUT_SELECTOR).trigger('input.bs.validator')
    this.options.delay = delay

    return this
  }

  Validator.prototype.showErrors = function ($el) {
    var method = this.options.html ? 'html' : 'text'

    this.defer($el, function () {
      var $group = $el.closest('.form-group')
      var $block = $group.find('.help-block.with-errors')
      var $feedback = $group.find('.form-control-feedback')
      var errors = $el.data('bs.validator.errors')

      if (!errors.length) return

      errors = $('<ul/>')
        .addClass('list-unstyled')
        .append($.map(errors, function (error) { return $('<li/>')[method](error) }))

      $block.data('bs.validator.originalContent') === undefined && $block.data('bs.validator.originalContent', $block.html())
      $block.empty().append(errors)
      $group.addClass('has-error')

      $feedback.length
        && $feedback.removeClass(this.options.feedback.success)
        && $feedback.addClass(this.options.feedback.error)
        && $group.removeClass('has-success')
    })
  }

  Validator.prototype.clearErrors = function ($el) {
    var $group = $el.closest('.form-group')
    var $block = $group.find('.help-block.with-errors')
    var $feedback = $group.find('.form-control-feedback')

    $block.html($block.data('bs.validator.originalContent'))
    $group.removeClass('has-error')

    $feedback.length
      && $feedback.removeClass(this.options.feedback.error)
      && $feedback.addClass(this.options.feedback.success)
      && $group.addClass('has-success')
  }

  Validator.prototype.hasErrors = function () {
    function fieldErrors() {
      return !!($(this).data('bs.validator.errors') || []).length
    }

    return !!this.$element.find(Validator.INPUT_SELECTOR).filter(fieldErrors).length
  }

  Validator.prototype.isIncomplete = function () {
    function fieldIncomplete() {
      return this.type === 'checkbox' ? !this.checked                                   :
             this.type === 'radio'    ? !$('[name="' + this.name + '"]:checked').length :
                                        $.trim(this.value) === ''
    }

    return !!this.$element.find(Validator.INPUT_SELECTOR).filter('[required]').filter(fieldIncomplete).length
  }

  Validator.prototype.onSubmit = function (e) {
    this.validate()
    if (this.isIncomplete() || this.hasErrors()) e.preventDefault()
  }

  Validator.prototype.toggleSubmit = function () {
    if(!this.options.disable) return

    var $btn = $('button[type="submit"], input[type="submit"]')
      .filter('[form="' + this.$element.attr('id') + '"]')
      .add(this.$element.find('input[type="submit"], button[type="submit"]'))

    $btn.toggleClass('disabled', this.isIncomplete() || this.hasErrors())
  }

  Validator.prototype.defer = function ($el, callback) {
    callback = $.proxy(callback, this)
    if (!this.options.delay) return callback()
    window.clearTimeout($el.data('bs.validator.timeout'))
    $el.data('bs.validator.timeout', window.setTimeout(callback, this.options.delay))
  }

  Validator.prototype.destroy = function () {
    this.$element
      .removeAttr('novalidate')
      .removeData('bs.validator')
      .off('.bs.validator')

    this.$element.find(Validator.INPUT_SELECTOR)
      .off('.bs.validator')
      .removeData(['bs.validator.errors', 'bs.validator.deferred'])
      .each(function () {
        var $this = $(this)
        var timeout = $this.data('bs.validator.timeout')
        window.clearTimeout(timeout) && $this.removeData('bs.validator.timeout')
      })

    this.$element.find('.help-block.with-errors').each(function () {
      var $this = $(this)
      var originalContent = $this.data('bs.validator.originalContent')

      $this
        .removeData('bs.validator.originalContent')
        .html(originalContent)
    })

    this.$element.find('input[type="submit"], button[type="submit"]').removeClass('disabled')

    this.$element.find('.has-error').removeClass('has-error')

    return this
  }

  // VALIDATOR PLUGIN DEFINITION
  // ===========================


  function Plugin(option) {
    return this.each(function () {
      var $this   = $(this)
      var options = $.extend({}, Validator.DEFAULTS, $this.data(), typeof option == 'object' && option)
      var data    = $this.data('bs.validator')

      if (!data && option == 'destroy') return
      if (!data) $this.data('bs.validator', (data = new Validator(this, options)))
      if (typeof option == 'string') data[option]()
    })
  }

  var old = $.fn.validator

  $.fn.validator             = Plugin
  $.fn.validator.Constructor = Validator


  // VALIDATOR NO CONFLICT
  // =====================

  $.fn.validator.noConflict = function () {
    $.fn.validator = old
    return this
  }


  // VALIDATOR DATA-API
  // ==================

  $(window).on('load', function () {
    $('form[data-toggle="validator"]').each(function () {
      var $form = $(this)
      Plugin.call($form, $form.data())
    })
  })

}(jQuery);
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

$(document).ready(function () {
  // console.log("Document ready - mulai eksekusi");

  // // Debug: Cek apakah elemen ada
  // console.log("Value col left element:", $("#value_col_left").length);
  // console.log("Value col right element:", $("#value_col_right").length);
  // console.log("Dropdown left element:", $("#col_left").length);
  // console.log("Dropdown right element:", $("#col_right").length);

  var valueColL = $("#value_col_left").val() || 6;
  var valueColR = $("#value_col_right").val() || 6;

  // console.log("Nilai yang didapat:", valueColL, valueColR);

  function populateDropdown(dropdownId, nilai) {
    // console.log(`Populating ${dropdownId} with value:`, nilai);
    const $dropdown = $(`#${dropdownId}`);

    if ($dropdown.length === 0) {
      // console.error(`Dropdown #${dropdownId} tidak ditemukan!`);
      return;
    }

    $dropdown.empty();

    for (let i = 1; i <= 11; i++) {
      const option = $(`<option value="${i}">${i}</option>`);
      if (parseInt(i) === parseInt(nilai)) {
        option.prop("selected", true);
      }
      $dropdown.append(option);
    }

    // console.log(`Dropdown ${dropdownId} berhasil diisi`);
  }

  populateDropdown("col_left", valueColL);
  populateDropdown("col_right", valueColR);

  // Event handler change
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
var base_url = $("body").attr("baseurl");
var attributes = [];
$(".input-upload").change(function (e) {
  e.preventDefault();
  var id = $(this).data("id");
  var classPrev = `.img-prev-${id}`;
  file = this.files[0];
  if (file) {
    let reader = new FileReader();
    reader.onload = function (event) {
      $(classPrev).attr("src", event.target.result);
    };
    reader.readAsDataURL(file);
  }
});
$('select[name="merek_barang"]').append(
  `<option value="-">Pilih Jenis Produk Terlebih dahulu...</option>`
);

$('select[name="jenis_barang"').change(function (e) {
  e.preventDefault();
  // console.log($(this).val());
  $.ajax({
    type: "POST",
    url: base_url + "/member/store/getBrands",
    data: {
      category_id: $(this).val(),
    },
    dataType: "json",
    success: function (response) {
      $('select[name="merek_barang"]').html(``);
      $.each(response, function (i, value) {
        $('select[name="merek_barang"]').append(
          `<option value="${value.brand_id}">${value.name}</option>`
        );
      });
    },
  });
  $.ajax({
    type: "POST",
    url: base_url + "/member/store/get_product_grade",
    data: {
      category_id: $(this).val(),
    },
    dataType: "json",
    success: function (response) {
      $('select[name="kondisi_barang"]').html(``);
      $.each(response, function (i, value) {
        $('select[name="kondisi_barang"]').append(
          `<option value="${value.id}">${value.grade}</option>`
        );
      });
    },
  });
});

$(".pj-produk").click(function () {
  var val = $(this).data("value");
  if (val == "is_sell") {
    $('input[name="is_sell"').val(1);
    $(".nama-barang").show();
    $("#pilih-jenis-produk").hide();
    $(".nama-jasa").hide();
    $(".nama-rental").hide();
  } else if (val == "is_service") {
    $('input[name="is_service"').val(1);
    $(".nama-barang").hide();
    $("#pilih-jenis-produk").hide();
    $(".nama-jasa").show();
    $(".nama-rental").hide();
  } else if (val == "is_rent") {
    $('input[name="is_rent"').val(1);
    $(".nama-barang").hide();
    $("#pilih-jenis-produk").hide();
    $(".nama-jasa").hide();
    $(".nama-rental").show();
  }
});
$(".metode-pengiriman").click(function () {
  var val = $(this).val();
  if (val == "custom") {
    $(".mp-custom").show();
  } else {
    $(".mp-custom").hide();
  }
});

$(".add-mp").on("click", function () {
  $(".mp-card").append($(".mp-form").html());
});

$(document).on("click", ".del-mp", function () {
  $(this).parent().parent().remove();
});

$(".prev-nama-barang").click(function () {
  $("#pilih-jenis-produk").show();
  $(".nama-barang").hide();
  $("html, body").scrollTop($("#tambah-produk").offset().top - 130);
});
$(".next-nama-barang").click(function () {
  var jenis_barang = $('select[name="jenis_barang"]').val();
  $("#pilih-jenis-produk").hide();
  $(".nama-barang").hide();
  $(".spesifikasi-barang").show();
  $(".spesifikasi-barang").removeClass("d-none");
  $("html, body").scrollTop($("#spesifikasi-barang").offset().top - 130);
  // $.ajax({
  //   type: "POST",
  //   url: base_url + "member/store/get_product_grade",
  //   data: {
  //     category_id: jenis_barang,
  //   },
  //   dataType: "json",
  //   success: function (response) {
  //     setConditionForm(response);
  //   },
  // });
  $.ajax({
    type: "POST",
    url: base_url + "member/store/get_product_attribute",
    data: {
      category_id: jenis_barang,
    },
    dataType: "json",
    success: function (response) {
      console.log(response);
      setSpesificationForm(response);
    },
  });
});

$(".prev-spesifikasi-barang").click(function () {
  $("#pilih-jenis-produk").hide();
  $(".nama-barang").show();
  $(".spesifikasi-barang").hide();
  $("html, body").scrollTop($("#nama-barang").offset().top - 130);
  $("#spesification-space").html("");
});
$(".next-spesifikasi-barang").click(function () {
  $("#pilih-jenis-produk").hide();
  $(".nama-barang").hide();
  $(".spesifikasi-barang").hide();
  $(".harga-barang").show();
  $(".harga-barang").removeClass("d-none");
  $("html, body").scrollTop($("#harga-barang").offset().top - 130);
});
$(".prev-harga-barang").click(function () {
  $("#pilih-jenis-produk").hide();
  $(".nama-barang").hide();
  $(".spesifikasi-barang").show();
  $(".harga-barang").hide();
  $("html, body").scrollTop($("#spesifikasi-barang").offset().top - 130);
});
// $(".next-harga-barang").click(function () {
//   $("#pilih-jenis-produk").hide();
//   $(".nama-barang").hide();
//   $(".spesifikasi-barang").hide();
//   $(".harga-barang").hide();
//   $(".pengiriman-barang").show();
//   $(".pengiriman-barang").removeClass("d-none");
//   $("html, body").scrollTop($("#tambah-produk").offset().top - 130);
// });
// $(".prev-pengiriman-barang").click(function () {
//   $("#pilih-jenis-produk").hide();
//   $(".nama-barang").hide();
//   $(".spesifikasi-barang").hide();
//   $(".harga-barang").show();
//   $(".pengiriman-barang").hide();
//   $("html, body").scrollTop($("#tambah-produk").offset().top - 130);
// });

$(".prev-nama-jasa").click(function () {
  $("#pilih-jenis-produk").show();
  $(".nama-jasa").hide();
  $("html, body").scrollTop($("#tambah-produk").offset().top - 130);
});

$(".prev-nama-rental").click(function () {
  $("#pilih-jenis-produk").show();
  $(".nama-rental").hide();
  $("html, body").scrollTop($("#tambah-produk").offset().top - 130);
});
$(".next-nama-rental").click(function () {
  $("#pilih-jenis-produk").hide();
  $(".nama-rental").hide();
  $(".spesifikasi-rental").show();
  $("html, body").scrollTop($("#tambah-produk").offset().top - 130);
});
$(".prev-spesifikasi-rental").click(function () {
  $("#pilih-jenis-produk").hide();
  $(".nama-rental").show();
  $(".spesifikasi-rental").hide();
  $("html, body").scrollTop($("#tambah-produk").offset().top - 130);
});
$(".next-spesifikasi-rental").click(function () {
  $("#pilih-jenis-produk").hide();
  $(".nama-rental").hide();
  $(".spesifikasi-rental").hide();
  $(".harga-rental").show();
  $("html, body").scrollTop($("#tambah-produk").offset().top - 130);
});
$(".prev-harga-rental").click(function () {
  $("#pilih-jenis-produk").hide();
  $(".nama-rental").hide();
  $(".spesifikasi-rental").show();
  $(".harga-rental").hide();
  $("html, body").scrollTop($("#tambah-produk").offset().top - 130);
});
$(".next-harga-rental").click(function () {
  $("#pilih-jenis-produk").hide();
  $(".nama-rental").hide();
  $(".spesifikasi-rental").hide();
  $(".harga-rental").hide();
  $(".pengiriman-rental").show();
  $("html, body").scrollTop($("#tambah-produk").offset().top - 130);
});
$(".prev-pengiriman-rental").click(function () {
  $("#pilih-jenis-produk").hide();
  $(".nama-rental").hide();
  $(".spesifikasi-rental").hide();
  $(".harga-rental").show();
  $(".pengiriman-rental").hide();
  $("html, body").scrollTop($("#tambah-produk").offset().top - 130);
});

$("select[name=brand]").load(
  base_url +
    "general/getbrandform/" +
    $("select[name=jenisproduct]").attr("tar"),
  function (argument) {
    var mustvalue = $(this).attr("seletedbrand");
    $(this).val(mustvalue);
  }
);

function setConditionForm(attrs) {
  $.each(attrs, function (i, value) {
    var content = "";
    content += `<label class="m-r-1">`;
    content += `<input type="radio" name="kondisi_barang" value="${value.id}" />
      ${value.grade}`;
    content += `</label>`;
    $("#productCondition").append(content);
  });
}
function setSpesificationForm(attrs) {
  $.each(attrs, function (i, value) {
    var content = "";
    content += `<div class="col-lg-6">`;
    content += `<label class="fbold m-t-1">${value.name}</label>`;
    content += `<input type="hidden" name="id_attributes[]" class="form-control" value="${value.attribute_id}" placeholder="${value.name}">`;
    content += `<input type="text" name="attributes[]" class="form-control" value="" placeholder="${value.name}">`;
    content += `</div>`;
    $("#spesification-space").append(content);
  });
}
// var previewNode = document.querySelector("#template-produk");
// previewNode.id = "";
// var previewTemplate = previewNode.parentNode.innerHTML;
// previewNode.parentNode.removeChild(previewNode);

// $(document).on("click", ".btn-upload", function () {
//   $(".btn-upload-hide").click();
// });

// $("#upload-image-produk").dropzone({
//   url: base_url + "member/store/upload_produk",
//   parallelUploads: 3,
//   clickable: ".btn-upload-hide-produk",
//   previewTemplate: previewTemplate,
//   autoQueue: true,
//   maxFiles: 5,
//   previewsContainer: "#previews-produk",
//   acceptedFiles: ".jpg, .jpeg, .png, .zip",
//   init: function () {
//     this.on("complete", (file) => {
//       console.log(file);

//       $(file).each(function (index, item) {
//         response = JSON.parse(item.xhr.response);
//         $("#upload-image-produk").append(
//           '<input type="hidden" name="files[]" value="' + response.name + '" />'
//         );
//         $(".btn-upload-produk").eq(0).remove();

//         setTimeout(function () {
//           $(item.previewElement).find(".progress").fadeOut(1000);
//         }, 500);
//       });
//     });
//     this.on("removedfile", (file) => {
//       response = JSON.parse(file.xhr.response);
//       filename = response.name;
//       $.post(base_url + "bulk/remove", { filename: filename }, function (data) {
//         $('input[value="' + filename + '"]').remove();
//         $(".form-upload-image-produk").append(
//           $("#form-upload-image-produk").html()
//         );
//       });
//     });
//   },
// });

// var previewNodes = document.querySelector("#template-jasa");
// previewNodes.id = "";
// var previewTemplates = previewNodes.parentNode.innerHTML;
// previewNodes.parentNode.removeChild(previewNodes);

// $("#upload-image-jasa").dropzone({
//   url: base_url + "member/store/upload_jasa",
//   parallelUploads: 3,
//   clickable: ".btn-upload-hide-jasa",
//   previewTemplate: previewTemplates,
//   autoQueue: true,
//   maxFiles: 5,
//   previewsContainer: "#previews-jasa",
//   acceptedFiles: ".jpg, .jpeg, .png, .zip",
//   init: function () {
//     this.on("complete", (file) => {
//       console.log(file);

//       $(file).each(function (index, item) {
//         response = JSON.parse(item.xhr.response);
//         $("#upload-image-jasa").append(
//           '<input type="hidden" name="files[]" value="' + response.name + '" />'
//         );
//         $(".btn-upload-jasa").eq(0).remove();

//         setTimeout(function () {
//           $(item.previewElement).find(".progress").fadeOut(1000);
//         }, 500);
//       });
//     });
//     this.on("removedfile", (file) => {
//       response = JSON.parse(file.xhr.response);
//       filename = response.name;
//       $.post(base_url + "bulk/remove", { filename: filename }, function (data) {
//         $('input[value="' + filename + '"]').remove();
//         $(".form-upload-image-jasa").append(
//           $("#form-upload-image-jasa").html()
//         );
//       });
//     });
//   },
// });

// var previewNodes = document.querySelector("#template-rental");
// previewNodes.id = "";
// var previewTemplates = previewNodes.parentNode.innerHTML;
// previewNodes.parentNode.removeChild(previewNodes);

// $("#upload-image-rental").dropzone({
//   url: base_url + "store/upload_rental",
//   parallelUploads: 3,
//   clickable: ".btn-upload-hide-rental",
//   previewTemplate: previewTemplates,
//   autoQueue: true,
//   maxFiles: 5,
//   previewsContainer: "#previews-rental",
//   acceptedFiles: ".jpg, .jpeg, .png, .zip",
//   init: function () {
//     this.on("complete", (file) => {
//       console.log(file);

//       $(file).each(function (index, item) {
//         response = JSON.parse(item.xhr.response);
//         $("#upload-image-rental").append(
//           '<input type="hidden" name="files[]" value="' + response.name + '" />'
//         );
//         $(".btn-upload-rental").eq(0).remove();

//         setTimeout(function () {
//           $(item.previewElement).find(".progress").fadeOut(1000);
//         }, 500);
//       });
//     });
//     this.on("removedfile", (file) => {
//       response = JSON.parse(file.xhr.response);
//       filename = response.name;
//       $.post(base_url + "bulk/remove", { filename: filename }, function (data) {
//         $('input[value="' + filename + '"]').remove();
//         $(".form-upload-image-rental").append(
//           $("#form-upload-image-rental").html()
//         );
//       });
//     });
//   },
// });
var base_url = $("body").attr("baseurl");
$("select[name=jenisproduct]").load(
  base_url + "general/getcomponentall/back",
  function (argument) {
    var mustvalue = $(this).attr("tar");
    $(this).val(mustvalue);
    var seletedgrade = $("select[name=quality]").attr("seletedgrade");
    $("select[name=quality]").val(seletedgrade);
    var seletedcomponent = $("select[name=component]").attr("seletedcomponent");
    $("select[name=component]").val(seletedcomponent);
  }
);
$("select[name=brand]").load(
  base_url +
    "general/getbrandform/" +
    $("select[name=jenisproduct]").attr("tar"),
  function (argument) {
    var mustvalue = $(this).attr("seletedbrand");
    $(this).val(mustvalue);
  }
);
$("select[name=quality]").load(
  base_url +
    "general/getgradeform/" +
    $("select[name=jenisproduct]").attr("tar"),
  function (argument) {
    var mustvalue = $(this).attr("seletedgrade");
    $(this).val(mustvalue);
  }
);
$("select[name=brand_unit]").load(
  base_url + "general/getbrandform/117",
  function (argument) {
    var mustvalue = $(this).attr("seletedbrandunit");
    $(this).val(mustvalue);
  }
);
$("select[name=component]").load(
  base_url +
    "general/getcomponentall_form/" +
    $("select[name=jenisproduct]").attr("tar"),
  function (argument) {
    var mustvalue = $(this).attr("seletedcomponent");
    $(this).val(mustvalue);
  }
);
$("select[name=area]").load(
  base_url + "general/getareaall",
  function (argument) {
    var mustvalue = $(this).attr("seletedarea");
    $(this).val(mustvalue);
  }
);

$("select[name=brand_unit]").change(function (argument) {
  var value = $(this).val();
  $("select[name=type]").load(
    base_url + "general/gettype/" + value,
    function (argument) {}
  );
});

$("select[name=jenisproduct]").change(function (argument) {
  var value = $(this).val();
  $("select[name=quality]").load(
    base_url + "general/getgradeform/" + value,
    function (argument) {
      if (
        $(
          "select[name=quality] option[value='" +
            $(this).attr("seletedgrade") +
            "']"
        ).length > 0
      ) {
        $(this).val($(this).attr("seletedgrade"));
      } else {
        $(this).val("0");
      }
    }
  );
  $("select[name=component]").load(
    base_url + "general/getcomponentall_form/" + value,
    function (argument) {
      if (
        $(
          "select[name=component] option[value='" +
            $(this).attr("seletedcomponent") +
            "']"
        ).length > 0
      ) {
        $(this).val($(this).attr("seletedcomponent"));
      } else {
        $(this).val("0");
      }
    }
  );
  $("select[name=brand]").load(
    base_url + "general/getbrandform/" + value,
    function (argument) {
      if (
        $(
          "select[name=brand] option[value='" +
            $(this).attr("seletedcomponent") +
            "']"
        ).length > 0
      ) {
        $(this).val($(this).attr("seletedproduct"));
      } else {
        $(this).val("");
      }
    }
  );

  if ($("input[name='id']").size() < 1) {
    $(".attribute-card").load(base_url + "general/getattributeform/" + value);
  }

  if (value == "Sparepart" || value == "Aksesoris") {
    $("select[name='brand_unit']").attr({ disabled: false });
    $("select[name='type']").attr({ disabled: false });
    $(".attr-unit").show();
  } else {
    $("select[name='brand_unit']").attr({ disabled: true });
    $("select[name='type']").attr({ disabled: true });
    $(".attr-unit").hide();
  }
});

if (
  $("select[name=jenisproduct]").attr("tar") == "Sparepart" ||
  $("select[name=jenisproduct]").attr("tar") == "Aksesoris"
) {
  $("select[name='brand_unit']").attr({ disabled: false });
  $("select[name='type']").attr({ disabled: false });
  $(".attr-unit").show();
} else {
  $("select[name='brand_unit']").attr({ disabled: true });
  $("select[name='type']").attr({ disabled: true });
  $(".attr-unit").hide();
}

$(document).ready(function (argument) {
  var seletedtype = $("select[name=type]").attr("seletedtype");

  var seletedgrade = $("select[name=quality]").attr("seletedgrade");
  $("select[name=quality]").val(seletedgrade);

  var seletedpackagine = $("select[name=packagin]").attr("seletedpackagine");
  $("select[name=packagin]").val(seletedpackagine);

  var seletedarea = $("select[name=area]").attr("seletedarea");
  $("select[name=area]").val(seletedarea);

  if (seletedtype != "") {
    var mustvalue = $("select[name=brand_unit]").attr("seletedbrandunit");
    $("select[name=type]").load(
      base_url + "general/gettype/" + mustvalue,
      function (argument) {
        $(this).val(seletedtype);
      }
    );
  }

  $(".add-att").on("click", function () {
    $(".attribute-card").append($(".attr-form").html());
  });

  $(document).on("click", ".del-att", function () {
    $(this).parent().parent().remove();
  });
});

$("input[type=file]").on("change", function () {
  var str = $(this).val();
  readURL(this);
  $(".file-custom").attr(
    "data-content",
    "..." + str.substring(str.length, str.length - 9)
  );
});

$("select[name=brand]").on("change", function () {
  $("#changemerek").html($(this).find("option:selected").text());
});
$("select[name=type]").on("change", function () {
  $("#changetipe").html($(this).find("option:selected").text());
});
$("select[name=component]").on("change", function () {
  $("#changekomponent").html($(this).find("option:selected").text());
});
$("select[name=quality]").on("change", function () {
  $("#changequality").html($(this).find("option:selected").text());
});
$("select[name=packagin]").on("change", function () {
  $("#changepackagin").html($(this).find("option:selected").text());
});

$("*[jq-model]").on("change", function (argument) {
  var name = $(this).attr("jq-model");
  $('span[js-result="' + name + '"]').text($(this).val());
});

$(document).ready(function () {
  setTimeout(function () {
    var formsearch = $(".form-filter-search");
    var seletedbrand = formsearch.attr("seletedbrand");
    var seletedtype = formsearch.attr("seletedtype");
    var seletedcomponent = formsearch.attr("seletedcomponent");
    // console.log($("select[name=brand]").val();
    if ($("select[name=brand]").val() != "") {
      $("#changemerek").html(
        $("select[name=brand]").find("option:selected").text()
      );
      $("#changetipe").html(
        $("select[name=type]").find("option:selected").text()
      );
      $("#changekomponent").html(
        $("select[name=component]").find("option:selected").text()
      );
    } else {
      $("#changemerek").html("");
      $("#changetipe").html($(this).find("option:selected").text());
      $("#changekomponent").html($(this).find("option:selected").text());
    }
    setTimeout(function () {
      if (seletedtype != "") {
        $("select[name=tipe]").val(seletedtype);
      }
    }, 2000);
    if (seletedcomponent != "") {
      $("select[name=komponen]").val(seletedcomponent);
    }
  }, 2000);
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

$(document).ready(function () {
  $(".pilihjenisproduk").modal("show");
  $("select[name=jenisproduct]").val(
    $("select[name=jenisproduct]").attr("tar")
  );
});
$(document).on("click", ".choicejenis", function (e) {
  $(".input_choicejenis").val($(this).attr("val"));
  $(".pilihjenisproduk").modal("hide");
  $("select[name=quality]").load(
    base_url + "general/getgradeform/" + $(this).attr("val"),
    function (argument) {}
  );
  $("select[name=brand]").load(
    base_url + "general/getbrandform/" + $(this).attr("val"),
    function (argument) {}
  );
  //$("select[name=quality]").val(seletedgrade);
  $("select[name=component]").load(
    base_url + "general/getcomponentall_form/" + $(this).attr("val"),
    function (argument) {}
  );
  if (
    $(this).attr("val") == "Sparepart" ||
    $(this).attr("val") == "Aksesoris"
  ) {
    $("select[name='brand_unit']").attr({ disabled: false });
    $("select[name='type']").attr({ disabled: false });
    $(".attr-unit").show();
  } else {
    $("select[name='brand_unit']").attr({ disabled: true });
    $("select[name='type']").attr({ disabled: true });
    $(".attr-unit").hide();
  }

  if ($("input[name='id']").size() < 1) {
    $(".attribute-card").load(
      base_url + "general/getattributeform/" + $(this).attr("val")
    );
  }
});
var baseurl = $("body").attr("baseurl");

/*
var one_detect=1;
/*do{
    var ifi = $(".sv_menu_center a.m"+one_detect).hasClass( "m"+one_detect);
    one_detect++;                    
}while(ifi);*/
/*one_detect=$(".sv_menu_center a").length;


var show_menu=4,
_front=1,
_end=one_detect+4;
btn_menu_front = 1,
btn_menu_back=show_menu;


for (i = 1; i<= show_menu; i++) {
    $(".sv_menu_center a.m"+i).clone().appendTo(".menu_center");                        
    $(".sv_menu_center a.m"+i).remove();
};
$("._after").click(function() {
    if (_end!=btn_menu_back) {
        $("li.menu_center a.m"+btn_menu_front).clone().prependTo( ".sv_menu_center" );                        
        $("li.menu_center a.m"+btn_menu_front).toggleClass("m"+btn_menu_front).fadeIn().remove();
        btn_menu_front=btn_menu_front+1;
        btn_menu_back=btn_menu_back+1;
        $(".sv_menu_center a.m"+btn_menu_back).clone().appendTo(".menu_center"); 
        $(".sv_menu_center a.m"+btn_menu_back).remove();
    };
});
$("._before").click(function() {
    if (_front!=btn_menu_front) {
        $("li.menu_center a.m"+btn_menu_back).clone().prependTo( ".sv_menu_center" );                        
        $("li.menu_center a.m"+btn_menu_back).toggleClass("m"+btn_menu_back).fadeIn().remove();
        btn_menu_front=btn_menu_front-1;
        $(".sv_menu_center a.m"+btn_menu_front).clone().prependTo(".menu_center"); 
        $(".sv_menu_center a.m"+btn_menu_front).remove();
        btn_menu_back=btn_menu_back-1;
    };
});*/

$(".dropdown").hover(
  function () {
    $(this).addClass("open");
  },
  function () {
    $(this).removeClass("open");
  }
);

function redirectToSearch() {
  var url =
    baseurl +
    "c/all/query?q=on&nama=" +
    $(".inputsearch").find("input[type=text]").val();
  window.location.href = url;
}

$(".inputsearch")
  .find("input[type=text]")
  .on("keydown", function (e) {
    if (e.which == 13) {
      redirectToSearch();
    }
  });

$("#searchbuttontemplate").click(function () {
  redirectToSearch();
});

$('[data-toggle="popover"]').popover();
$('[role="tablist"]').tab();
//$('.carousel').carousel();

jQuery(document).ready(function ($) {
  var telkomspeedy = $('[src*="u-ad.info"]');
  if (telkomspeedy) {
    telkomspeedy.remove();
  }
  $('script:contains("u-ad.info")').remove();
});
//$("#js-mobile-offcanvas").trigger("offcanvas.toggle");

$(".collapsedecategorymobile").on("shown.bs.collapse", function () {
  $(".hiddenin").css("display", "").not($(this)).fadeOut().removeClass("in");
  $(this).find("li").css("background-color", "rgba(128, 128, 128, 0.22)");
});
$(".collapsedecategorymobile").on("hidden.bs.collapse", function () {});
$(".collapsedecategorymobileprn").click(function (argument) {
  $(".active").toggleClass("active");
  $(this).toggleClass("active");
});
$(".showsearchmobile").click(function (argument) {
  $(".inputsearch")
    .toggleClass("hidden-xs-up")
    .find("input[type=text]")
    .focus();
  $(".hidesearch").toggleClass("hidden-xs-up");
});
$(document).on("blur", ".searchmobile", function (argument) {
  $(".hidesearch").toggleClass("hidden-xs-up");
  $(".inputsearch").toggleClass("hidden-xs-up");
});

$(".carousel").carousel();

// $(".list_brand_category").slick({
//   arrows: true,
//   variableWidth: true,
//   autoplay: true,
//   dots: false,
//   speed: 700,
//   centerMode: false,
//   focusOnSelect: true,
// });

/*var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/56495e0a06a71074263bdb3a/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();*/

/*var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5bd17d8519b86b5920c0d775/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();*/

/* var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5c176e7d82491369ba9e678d/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
 */

$(".list_brand_category").css("display", "inline");

$(document)
  .on("click", ".proccessshow", function (e) {
    e.isDefaultPrevented();
    var form = $(this).parents("form");
    var modalmustshow = $(".modalproccessshow");
    modalmustshow.modal("show");
    var detectvalue = 0;
    var text = $(this).attr("modal-text");
    if (text != "") {
      $(".modal-text").html(text);
    }
    if (form.length != 0) {
      form.find("input").each(function () {
        if ($(this).prop("required")) {
          if ($(this).val() == "") {
            detectvalue = detectvalue + 1;
            return false;
          }
        }
      });
      if (detectvalue >= 1) {
        modalmustshow.modal("toggle");
      }
    } else {
      $(".modalproccessshow").modal("show");
      var text = $(this).attr("modal-text");
      if (text != "") {
        $(".modal-text").html(text);
      }
    }
  })
  .delay(5000);

$(document).ready(function (e) {
  if ($(".popup-check").data("popup") == true) {
    now = new Date();
    now = now.getTime();
    last =
      localStorage.getItem("popTime") != ""
        ? localStorage.getItem("popTime")
        : 0;
    if (now - last >= 3600000) {
      $(".popup_spadukbig").modal("show");
      localStorage.setItem("popTime", now);
    }
  }
});
$(document).on("click", ".closemodalpopup_spadukbig", function (e) {
  $(".popup_spadukbig").modal("hide");
});
$(document).on("click", ".close_alert", function (e) {
  e.preventDefault();
});

$(".popup").on("close.bs.alert", function () {
  var session = $(this).attr("session");
  var sessionval = $(this).attr("sessionval");
  var url = baseurl + "general/addsession/" + session + "/" + sessionval;
  $.post(url, function (data) {});
});
$(".fadeslidebig").fadeIn("fast");
// $(".fadeslidebig").slick({
//   arrows: false,
//   autoplay: true,
//   autoplaySpeed: 5000,
//   slidesToShow: 1,
// });

/*$(".btn-copytext").on("click",function(event) {
    var copytext= $(this);
    copytext.find("textarea").val().select();
    try {
        var successful = copytext.execCommand('copy');
        var msg = successful ? 'successful' : 'unsuccessful';
        console.log('Copying text command was ' + msg);
    } catch (err) {
        console.log('Oops, unable to copy');
    }
});*/

$(document).ready(function () {
  $(".uang").mask("000.000.000.000.000.000", {
    reverse: true,
  });
});

$(document).ready(function () {
  $("#sidebarCollapse").on("click", function () {
    $("#sidebar").toggleClass("active");
  });
});