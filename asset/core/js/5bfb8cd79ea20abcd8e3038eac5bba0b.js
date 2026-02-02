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
var base_url = $("body").attr("baseurl");

// KODE UTAMA DALAM SATU $(document).ready()
$(document).ready(function () {
  console.log("trumecs.effect.js loaded");

  // Dropdown hover
  $(".dropdown").hover(
    function () {
      $(this).addClass("open");
    },
    function () {
      $(this).removeClass("open");
    }
  );

  // Fungsi search
  function redirectToSearch() {
    var url =
      base_url +
      "c/all/query?q=on&nama=" +
      $("#inputsearch").find("#searchInput").val();
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
  function redirectToSearch() {
    var searchInput = $("#inputsearch").find("#searchInput");
    var searchValue = searchInput.val().trim();

    if (searchValue) {
      var url =
        base_url + "c/all/query?q=on&nama=" + encodeURIComponent(searchValue);
      window.location.href = url;
    } else {
      // Optional: Show error message or focus the input
      searchInput.focus();
      console.log("Search input is empty");
    }
  }

  // Event listener untuk Enter key
  $(".inputsearch")
    .find("input[type=text]")
    .on("keydown", function (e) {
      if (e.key === "Enter" || e.keyCode === 13) {
        e.preventDefault(); // Mencegah form submission jika ada
        redirectToSearch();
      }
    });

  // Event listener untuk search button
  $("#searchbuttontemplate").click(function () {
    redirectToSearch();
  });

  // Optional: Juga bisa menggunakan form submission jika ada form
  $(".inputsearch form").on("submit", function (e) {
    e.preventDefault();
    redirectToSearch();
  });

  // Remove unwanted scripts
  var telkomspeedy = $('[src*="u-ad.info"]');
  if (telkomspeedy) {
    telkomspeedy.remove();
  }
  $('script:contains("u-ad.info")').remove();

  // Mobile menu collapse
  $(".collapsedecategorymobile").on("shown.bs.collapse", function () {
    $(".hiddenin").css("display", "").not($(this)).fadeOut().removeClass("in");
    $(this).find("li").css("background-color", "rgba(128, 128, 128, 0.22)");
  });

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

  $(".list_brand_category").css("display", "inline");

  // Modal processing
  $(document).on("click", ".proccessshow", function (e) {
    e.preventDefault();
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
  });

  // Popup
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

  $(document).on("click", ".closemodalpopup_spadukbig", function (e) {
    $(".popup_spadukbig").modal("hide");
  });

  $(document).on("click", ".close_alert", function (e) {
    e.preventDefault();
  });

  $(".popup").on("close.bs.alert", function () {
    var session = $(this).attr("session");
    var sessionval = $(this).attr("sessionval");
    var url = base_url + "general/addsession/" + session + "/" + sessionval;
    $.post(url, function (data) {});
  });

  $(".fadeslidebig").fadeIn("fast");

  // Mask input uang
  $(".uang").mask("000.000.000.000.000.000", {
    reverse: true,
  });

  // Sidebar collapse
  $("#sidebarCollapse").on("click", function () {
    $("#sidebar").toggleClass("active");
  });

  console.log("All JavaScript initialized");
}); // END OF $(document).ready()
