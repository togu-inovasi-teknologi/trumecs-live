var data = [];
var rfqItems = [];
let selectedBrandId = null;
let selectedSubCategoryId = null;
let subCategoryContainer = $(".row.justify-content-center.subcategory");
let subBrandContainer = $(".row.justify-content-center.brand");
let originalHTMLSub = subCategoryContainer.html();
let originalHTMLBrand = subBrandContainer.html();
let isCollapsedSub = false;
let isCollapsedBrand = false;
$(document).ready(function () {
  var ids = $("input[name='current_c_k_items']").val();

  if (ids !== "0") {
    rfqItems = ids.split(",");
  }

  // $(window).scroll(function () {
  //     var scrollPostition = $(window).scrollTop();
  //     if(scrollPostition > 5296 && scrollPostition < 6332){
  //         $('.float-request').addClass('d-none');
  //     }else{
  //         if(rfqItems.length > 0){
  //             $('.float-request').removeClass('d-none');
  //         }
  //     }

  // });

  $(document).on("click", "#btn-share-submit", function (e) {
    e.preventDefault();

    var emails = [];

    $.each($("#tags").children(), function (i, value) {
      emails.push($("#tags").children().eq(i).children(".value").html());
    });

    var categoryId = $("#share_input_category_id").val();

    if (emails.length > 0) {
      $.ajax({
        type: "POST",
        url: base_url + "share_compare",
        data: {
          emails: emails,
          items: data[categoryId],
        },
        dataType: "json",
        success: function (response) {
          console.log(response);
          if (response.status) {
            window.location.href = response.uri;
          }
        },
      });
    }
  });

  $(".catalog").each(function (i, val) {
    var category_id = $(this).children("input[name='category_id']").val();
    var image = $(this).children("input[name='image']").val();
    var name = $(this).children("input[name='name']").val();

    datatableInit($(this).children(".datatable"), "", category_id, image, name);
  });

  $(".search-datatable").keyup(function (e) {
    e.preventDefault();

    var category_id = $(this).data("search_id");

    var id = `#id_datatable_${category_id}`;

    var element = $(id);

    datatableDestroy(element);

    datatableInit(element, $(this).val(), category_id);
  });

  $(document).on("click", ".compare_share", function (e) {
    e.preventDefault();

    var categoryId = $(this).data("id");

    $("#share_input_category_id").val(categoryId);
  });

  $(document).on("change", ".checkbox-quotation", function () {
    var data = {
      tittle: $(this).data("name"),
      id: $(this).val(),
    };

    if (this.checked) {
      rfqItems.push(data);
    } else {
      $.each(rfqItems, function (i, value) {
        rfqItems.splice(i, 1);
      });
    }

    if (rfqItems.length > 0) {
      $(".float-request").removeClass("d-none");
      $("#float-value").html(`Permintaan ${rfqItems.length} (item)`);

      var tags = $("#items-autocomplete-selected");

      tags.append(
        `<li class="item-selected-rfq" data-id="${data.id}"><span>${data.tittle}</span><button data-id="${data.id}" class="delete-button"><i class="fa fw fa-close"></i></button></li>`
      );
    } else {
      $(".float-request").addClass("d-none");
    }
  });

  $(document).on("click", ".delete-button", function (e) {
    e.preventDefault();

    var id = $(this).data("id");

    var classElement = `.checkbox-quotation-item-${id}`;

    $(classElement).prop("checked", false);

    $.each(rfqItems, function (i, value) {
      if (value.id == id) {
        rfqItems.splice(i, 1);
      }
    });

    if (rfqItems.length < 1) {
      $(".float-request").addClass("d-none");
    }
  });

  $(document).on("change", ".checkbox-compare", function () {
    const id = $(this).val();
    const categoryId = $(this)
      .parents(".catalog")
      .children("input[name='category_id']")
      .val();

    // console.log(data.categoryId);

    console.log(rfqItems);

    var comparespace = $(this)
      .parents(".catalog-content")
      .children(".space-compare");
    if (this.checked) {
      console.log("check");
      rfqItems.push(id);
      $.ajax({
        type: "POST",
        url: base_url + "/productCompare",
        data: {
          product_id: id,
        },
        dataType: "json",
        success: function (response) {
          if (comparespace.children().length == 0) {
            // data[categoryId].push(response);
            data[categoryId] = [response];

            var tableCompareElement = `<div class="table-scroll" id="compare-element_${categoryId}">`;
            tableCompareElement += `<div class="table-wrap">`;
            tableCompareElement += `<table  class="table main-table table-sm table-hover table-bordered table-compare table-striped">`;

            $.each(response, function (i, value) {
              tableCompareElement += `<tr>`;
              if (i.toLowerCase() == "price") {
                tableCompareElement += `<th class="f14 color-primary clone fixed-side">${i}</th>`;
                tableCompareElement += `<td class="color-primary compare-element_${response.id} fbold">${value}</td>`;
              } else {
                tableCompareElement += `<th class="f14 clone fixed-side">${i}</th>`;
                tableCompareElement += `<td class="compare-element_${response.id}">${value}</td>`;
              }
              tableCompareElement += `</tr>`;
            });

            tableCompareElement += `</table>`;

            tableCompareElement += "</div>";
            tableCompareElement += "</div>";
            tableCompareElement += `<div class="col-lg-12 p-a-0 d-flex justify-content-end compare-element_${categoryId}">`;
            tableCompareElement += `<button data-toggle="modal" data-target="#shareModal" data-id="${categoryId}" data-whatever="@mdo" class="btn btn-sm btnnew compare_share compare-element_${categoryId}">Share <i class="fa fa-fw fa-share"></i></button>`;
            tableCompareElement += "</div>";

            $(comparespace).append(tableCompareElement);
          } else {
            data[categoryId].push(response);
            var index = 0;
            $.each(response, function (i, value) {
              if (i.toLowerCase() == "price") {
                comparespace
                  .children(".table-scroll")
                  .children(".table-wrap")
                  .children(".table-compare")
                  .children("tbody")
                  .children()
                  .eq(index)
                  .append(
                    `<td class="fbold compare-element_${response.id} color-primary">${value}</td>`
                  );
              } else {
                comparespace
                  .children(".table-scroll")
                  .children(".table-wrap")
                  .children(".table-compare")
                  .children("tbody")
                  .children()
                  .eq(index)
                  .append(
                    `<td class="compare-element_${response.id}">${value}</td>`
                  );
              }
              index++;
            });

            // .append(tableCompareElement);
          }
        },
      });

      if ($(".float-request").hasClass("d-none")) {
        $(".float-request").removeClass("d-none");
      }
    } else {
      console.log("uncheck");
      $.each(rfqItems, function (i, value) {
        if (value == id) {
          rfqItems.splice(i, 1);
        }
      });

      var classData = `.compare-element_${$(this).val()}`;
      $(classData).remove();

      var compare = comparespace
        .children(".table-scroll")
        .children(".table-wrap")
        .children(".table-compare")
        .children("tbody")
        .children("tr")
        .eq(0)
        .children().length;

      if (compare == 1) {
        comparespace.html("");
      }

      if (rfqItems.length > 0) {
        if ($(".float-request").hasClass("d-none")) {
          $(".float-request").removeClass("d-none");
        }
      } else {
        $(".float-request").addClass("d-none");
        window.location.href = base_url + "/deleteRfqSession";
      }
    }

    $(".form-list").html("");

    var form = "";

    $.each(rfqItems, function (i, value) {
      form += `<input type="hidden" name="items[]" value="${value}">`;
    });

    $(".form-list").append(form);

    // console.log(data.length);

    $("#float-value").html(`Permintaan ${rfqItems.length} (item)`);
  });
});

function datatableInit(
  element,
  search,
  categoryId,
  image,
  name,
  subcategoryId = "",
  brandId = ""
) {
  var dataToRequest = {
    where: {
      component: categoryId,
    },
  };

  if (search != "") {
    dataToRequest.search = {
      value: search,
    };
  }

  if (brandId !== null && brandId !== "") {
    dataToRequest.where.brand = brandId;
  }

  if (subcategoryId !== null && subcategoryId !== "") {
    dataToRequest.where.subcategory = subcategoryId;
  }
  var table = element.DataTable({
    ajax: {
      url: base_url + "/getProductByCategories",
      type: "POST",
      data: dataToRequest,
    },
    layout: {
      topStart: null,
      topEnd: null,
      bottomStart: null,
      bottomEnd: null,
      top1Start: [
        function () {
          let toolbar = document.createElement("div");
          toolbar.innerHTML =
            '<img src="' + image + '" alt="' + name + '" width="100%">';
          toolbar.setAttribute(
            "class",
            "col-lg-3 d-flex align-items-end gap-3 p-l-0"
          );
          return toolbar;
        },
        {
          className: "flex flex-column col-md-4",
          features: [
            function () {
              let toolbar = document.createElement("div");
              toolbar.innerHTML =
                '<h2 class="fbold" style="font-size:30px">' + name + "</h2>";
              //toolbar.setAttribute('class', '');
              return toolbar;
            },
            "pageLength",
          ],
        },
      ],
      top1End: ["search"],
    },
    columnDefs: [
      {
        targets: 0,
        visible: false,
        className: " p-a-0",
      },
      {
        targets: 3,
        className: "text-left p-a-5px ",
      },
      {
        targets: 4,
        className: "text-right p-a-5px",
      },
      {
        targets: 5,
        className: "text-center p-a-5px",
      },
      {
        targets: [1, 2, 3, 4, 5],
        className: "dt-head-center p-a-5px ",
      },
    ],
    orderClasses: true,
    searching: true,
    lengthChange: true,
    processing: true,
    serverSide: true,
  });
  table.on("click", "tbody tr", function () {
    console.log(table.row(this));
    // let data = table.row(this).data();
    // var id = data[0];
    // str = data[1].replace(/\s+/g, '-').toLowerCase();
    // redirect = base_url + 'product/' + id + '/' + str;
    // window.location.href = redirect;
  });
}

function datatableDestroy(element) {
  element.empty();
  element.DataTable().destroy();
}

function showFloatingQuotationWidget() {}

$(document).ready(function () {
  $(".brand-category-item").click(function () {
    $(".brand-category-item").removeClass("active");
    $(this).addClass("active");
  });

  $(".submenu-category-item").click(function () {
    $(".submenu-category-item").removeClass("active");
    $(this).addClass("active");
  });
});

function toggleBrandSelection(el, brandId) {
  $(".brand-category-item").removeClass("active");
  $(el).addClass("active");
  selectedBrandId = brandId;
  sessionStorage.setItem("selectedBrand", brandId);

  let selected = $(el).closest(".col-lg-2").clone();

  if (!isCollapsedBrand) {
    originalHTMLBrand = subBrandContainer.html();
  }

  subBrandContainer
    .html("")
    .append(
      $(
        '<div class="row d-flex justify-content-start m-b-8px gap-2 w-100 m-a-0 active">'
      ).append(selected)
    );

  isCollapsedBrand = true;
  $("#toggle-brands").parent().removeClass("d-none");
  $("html, body").animate(
    {
      scrollTop: $("#see-product-table").offset().top - 100,
    },
    500
  );
  applyFilters();
}

// Fungsi untuk subcategory
function toggleSubCategorySelection(el, subCategoryId) {
  selectedSubCategoryId = subCategoryId;
  $(".submenu-category-item").removeClass("active");
  $(el).addClass("active");
  sessionStorage.setItem("selectedSubCategory", subCategoryId);

  let selected = $(el).closest(".col-lg-4, .col-lg-6, .col-lg-12").clone();

  if (!isCollapsedSub) {
    originalHTMLSub = subCategoryContainer.html();
  }

  subCategoryContainer
    .html("")
    .append(
      $(
        '<div class="row d-flex justify-content-start m-b-8px gap-2 w-100 m-a-0 active">'
      ).append(selected)
    );

  isCollapsedSub = true;
  $("#toggle-subcategories").parent().removeClass("d-none");

  $("html, body").animate(
    {
      scrollTop: $("#see-product-table").offset().top - 100,
    },
    500
  );

  applyFilters();
}

// Fungsi baru untuk menerapkan kedua filter
function applyFilters() {
  const category_id = $("input[name='category_id']").val();
  const image = $("input[name='image']").val();
  const name = $("input[name='name']").val();
  const tableElement = $(`#id_datatable_${category_id}`);

  const subcategoryId = selectedSubCategoryId || "";
  const brandId = selectedBrandId || "";

  datatableDestroy(tableElement);
  datatableInit(
    tableElement,
    "",
    category_id,
    image,
    name,
    selectedSubCategoryId,
    selectedBrandId
  );
}

$("#toggle-subcategories").on("click", function () {
  if (isCollapsedSub) {
    subCategoryContainer.html(originalHTMLSub);
    $(".submenu-category-item").removeClass("active");
    isCollapsedSub = false;
    $(this).text("Lihat Semua");
    $(this).parent().addClass("d-none");
    selectedSubCategoryId = null;
    applyFilters();
  }
});

$("#toggle-brands").on("click", function () {
  if (isCollapsedBrand) {
    subBrandContainer.html(originalHTMLBrand);
    $(".brand-category-item").removeClass("active");

    isCollapsedBrand = false;
    $(this).text("Lihat Semua");
    $(this).parent().addClass("d-none");
    selectedBrandId = null;
    applyFilters();
  }
});

$(document).ready(function () {
  $(window).scroll(function () {
    if ($(this).scrollTop() > 500) {
      $("#back-to-top").removeClass("d-none");
    } else {
      $("#back-to-top").addClass("d-none");
    }
  });
  $("#back-to-top").click(function () {
    $("html, body").animate(
      {
        scrollTop: 0,
      },
      500
    );
    return false;
  });
});/*!
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
$(document).ready(function () {
    
    const tags = $('#tags');
    const input = $('#input-tag');

    $(document).on('keydown', '#input-tag', function(event){
        
        $('#input-email-validator').html('');
        
        if (event.key === 'Enter') { 
          
            
            
            event.preventDefault(); 
          
            
            const tag = document.createElement('li'); 
          
            
            const tagContent = $(this).val().trim(); 
          
            
            if (tagContent !== '') { 
          

                if(hasEmail(tagContent)){
                    tag.innerHTML = `<i class="value">${tagContent}</i><button class="delete-button">X</button>`; 

              
                
                    $('#tags').append(tag); 
                      
                    $(this).val('');
                }
                
                
                
            } 
        } 
    })


    function hasEmail(value){
        var validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
          
        if (value.match(validRegex)) {
            return true;
        
        } else {
            $('#input-email-validator').append(`<div class="alert alert-warning">Invalid Email Address!</div>`)
        
            return false;
        
        }
    }
    
 

    
    $(document).on('click', '#tags',function (event) { 

        
        if (event.target.classList.contains('delete-button')) { 
          
            
            event.target.parentNode.remove(); 
        } 
    }); 
});$(document).ready(function () {
    var progresArea = $(".progress-area");
    var uploadArea = $(".uploaded-area");
});var base_url =$("body").attr("baseurl");
$(document).ready(function () {
    $('.tab-search').click(function (e) { 
        e.preventDefault();
        if($('.tab-search').hasClass('active')){
            $('.tab-search').removeClass('active');
        };

        $(this).addClass('active');
    });

    $(document).on('change','#category-options', function (e) { 
        e.preventDefault();
        _checkButtonDisabled();
        $.ajax({
            type: 'GET',
            url: base_url + `/general/getmerekall/${$(this).val()}/false`,
            success: function (response) {
                $('#merk-options').html(response)
            }
        });
    });

    $(document).on('keyup', 'input[name=keyword]',function (e) { 
        _checkButtonDisabled();
    });



   
});

function _checkButtonDisabled()
{
    
    if($('input[name=keyword]').val() !== ''){
        $('#btn-submit-search').removeAttr('disabled');
    }else if($('select[name=komponen]').val() !== ''){
        $('#btn-submit-search').removeAttr('disabled');
    }else{
        $('#btn-submit-search').attr('disabled', '');
    }
}/*
     _ _      _       _
 ___| (_) ___| | __  (_)___
/ __| | |/ __| |/ /  | / __|
\__ \ | | (__|   < _ | \__ \
|___/_|_|\___|_|\_(_)/ |___/
                   |__/

 Version: 1.5.7
  Author: Ken Wheeler
 Website: http://kenwheeler.github.io
    Docs: http://kenwheeler.github.io/slick
    Repo: http://github.com/kenwheeler/slick
  Issues: http://github.com/kenwheeler/slick/issues

 */
!function(a){"use strict";"function"==typeof define&&define.amd?define(["jquery"],a):"undefined"!=typeof exports?module.exports=a(require("jquery")):a(jQuery)}(function(a){"use strict";var b=window.Slick||{};b=function(){function c(c,d){var f,e=this;e.defaults={accessibility:!0,adaptiveHeight:!1,appendArrows:a(c),appendDots:a(c),arrows:!0,asNavFor:null,prevArrow:'<button type="button" data-role="none" class="slick-prev" aria-label="Previous" tabindex="0" role="button">Previous</button>',nextArrow:'<button type="button" data-role="none" class="slick-next" aria-label="Next" tabindex="0" role="button">Next</button>',autoplay:!1,autoplaySpeed:3e3,centerMode:!1,centerPadding:"50px",cssEase:"ease",customPaging:function(a,b){return'<button type="button" data-role="none" role="button" aria-required="false" tabindex="0">'+(b+1)+"</button>"},dots:!1,dotsClass:"slick-dots",draggable:!0,easing:"linear",edgeFriction:.35,fade:!1,focusOnSelect:!1,infinite:!0,initialSlide:0,lazyLoad:"ondemand",mobileFirst:!1,pauseOnHover:!0,pauseOnDotsHover:!1,respondTo:"window",responsive:null,rows:1,rtl:!1,slide:"",slidesPerRow:1,slidesToShow:1,slidesToScroll:1,speed:500,swipe:!0,swipeToSlide:!1,touchMove:!0,touchThreshold:5,useCSS:!0,variableWidth:!1,vertical:!1,verticalSwiping:!1,waitForAnimate:!0,zIndex:1e3},e.initials={animating:!1,dragging:!1,autoPlayTimer:null,currentDirection:0,currentLeft:null,currentSlide:0,direction:1,$dots:null,listWidth:null,listHeight:null,loadIndex:0,$nextArrow:null,$prevArrow:null,slideCount:null,slideWidth:null,$slideTrack:null,$slides:null,sliding:!1,slideOffset:0,swipeLeft:null,$list:null,touchObject:{},transformsEnabled:!1,unslicked:!1},a.extend(e,e.initials),e.activeBreakpoint=null,e.animType=null,e.animProp=null,e.breakpoints=[],e.breakpointSettings=[],e.cssTransitions=!1,e.hidden="hidden",e.paused=!1,e.positionProp=null,e.respondTo=null,e.rowCount=1,e.shouldClick=!0,e.$slider=a(c),e.$slidesCache=null,e.transformType=null,e.transitionType=null,e.visibilityChange="visibilitychange",e.windowWidth=0,e.windowTimer=null,f=a(c).data("slick")||{},e.options=a.extend({},e.defaults,f,d),e.currentSlide=e.options.initialSlide,e.originalSettings=e.options,"undefined"!=typeof document.mozHidden?(e.hidden="mozHidden",e.visibilityChange="mozvisibilitychange"):"undefined"!=typeof document.webkitHidden&&(e.hidden="webkitHidden",e.visibilityChange="webkitvisibilitychange"),e.autoPlay=a.proxy(e.autoPlay,e),e.autoPlayClear=a.proxy(e.autoPlayClear,e),e.changeSlide=a.proxy(e.changeSlide,e),e.clickHandler=a.proxy(e.clickHandler,e),e.selectHandler=a.proxy(e.selectHandler,e),e.setPosition=a.proxy(e.setPosition,e),e.swipeHandler=a.proxy(e.swipeHandler,e),e.dragHandler=a.proxy(e.dragHandler,e),e.keyHandler=a.proxy(e.keyHandler,e),e.autoPlayIterator=a.proxy(e.autoPlayIterator,e),e.instanceUid=b++,e.htmlExpr=/^(?:\s*(<[\w\W]+>)[^>]*)$/,e.registerBreakpoints(),e.init(!0),e.checkResponsive(!0)}var b=0;return c}(),b.prototype.addSlide=b.prototype.slickAdd=function(b,c,d){var e=this;if("boolean"==typeof c)d=c,c=null;else if(0>c||c>=e.slideCount)return!1;e.unload(),"number"==typeof c?0===c&&0===e.$slides.length?a(b).appendTo(e.$slideTrack):d?a(b).insertBefore(e.$slides.eq(c)):a(b).insertAfter(e.$slides.eq(c)):d===!0?a(b).prependTo(e.$slideTrack):a(b).appendTo(e.$slideTrack),e.$slides=e.$slideTrack.children(this.options.slide),e.$slideTrack.children(this.options.slide).detach(),e.$slideTrack.append(e.$slides),e.$slides.each(function(b,c){a(c).attr("data-slick-index",b)}),e.$slidesCache=e.$slides,e.reinit()},b.prototype.animateHeight=function(){var a=this;if(1===a.options.slidesToShow&&a.options.adaptiveHeight===!0&&a.options.vertical===!1){var b=a.$slides.eq(a.currentSlide).outerHeight(!0);a.$list.animate({height:b},a.options.speed)}},b.prototype.animateSlide=function(b,c){var d={},e=this;e.animateHeight(),e.options.rtl===!0&&e.options.vertical===!1&&(b=-b),e.transformsEnabled===!1?e.options.vertical===!1?e.$slideTrack.animate({left:b},e.options.speed,e.options.easing,c):e.$slideTrack.animate({top:b},e.options.speed,e.options.easing,c):e.cssTransitions===!1?(e.options.rtl===!0&&(e.currentLeft=-e.currentLeft),a({animStart:e.currentLeft}).animate({animStart:b},{duration:e.options.speed,easing:e.options.easing,step:function(a){a=Math.ceil(a),e.options.vertical===!1?(d[e.animType]="translate("+a+"px, 0px)",e.$slideTrack.css(d)):(d[e.animType]="translate(0px,"+a+"px)",e.$slideTrack.css(d))},complete:function(){c&&c.call()}})):(e.applyTransition(),b=Math.ceil(b),d[e.animType]=e.options.vertical===!1?"translate3d("+b+"px, 0px, 0px)":"translate3d(0px,"+b+"px, 0px)",e.$slideTrack.css(d),c&&setTimeout(function(){e.disableTransition(),c.call()},e.options.speed))},b.prototype.asNavFor=function(b){var c=this,d=c.options.asNavFor;d&&null!==d&&(d=a(d).not(c.$slider)),null!==d&&"object"==typeof d&&d.each(function(){var c=a(this).slick("getSlick");c.unslicked||c.slideHandler(b,!0)})},b.prototype.applyTransition=function(a){var b=this,c={};c[b.transitionType]=b.options.fade===!1?b.transformType+" "+b.options.speed+"ms "+b.options.cssEase:"opacity "+b.options.speed+"ms "+b.options.cssEase,b.options.fade===!1?b.$slideTrack.css(c):b.$slides.eq(a).css(c)},b.prototype.autoPlay=function(){var a=this;a.autoPlayTimer&&clearInterval(a.autoPlayTimer),a.slideCount>a.options.slidesToShow&&a.paused!==!0&&(a.autoPlayTimer=setInterval(a.autoPlayIterator,a.options.autoplaySpeed))},b.prototype.autoPlayClear=function(){var a=this;a.autoPlayTimer&&clearInterval(a.autoPlayTimer)},b.prototype.autoPlayIterator=function(){var a=this;a.options.infinite===!1?1===a.direction?(a.currentSlide+1===a.slideCount-1&&(a.direction=0),a.slideHandler(a.currentSlide+a.options.slidesToScroll)):(0===a.currentSlide-1&&(a.direction=1),a.slideHandler(a.currentSlide-a.options.slidesToScroll)):a.slideHandler(a.currentSlide+a.options.slidesToScroll)},b.prototype.buildArrows=function(){var b=this;b.options.arrows===!0&&(b.$prevArrow=a(b.options.prevArrow).addClass("slick-arrow"),b.$nextArrow=a(b.options.nextArrow).addClass("slick-arrow"),b.slideCount>b.options.slidesToShow?(b.$prevArrow.removeClass("slick-hidden").removeAttr("aria-hidden tabindex"),b.$nextArrow.removeClass("slick-hidden").removeAttr("aria-hidden tabindex"),b.htmlExpr.test(b.options.prevArrow)&&b.$prevArrow.prependTo(b.options.appendArrows),b.htmlExpr.test(b.options.nextArrow)&&b.$nextArrow.appendTo(b.options.appendArrows),b.options.infinite!==!0&&b.$prevArrow.addClass("slick-disabled").attr("aria-disabled","true")):b.$prevArrow.add(b.$nextArrow).addClass("slick-hidden").attr({"aria-disabled":"true",tabindex:"-1"}))},b.prototype.buildDots=function(){var c,d,b=this;if(b.options.dots===!0&&b.slideCount>b.options.slidesToShow){for(d='<ul class="'+b.options.dotsClass+'">',c=0;c<=b.getDotCount();c+=1)d+="<li>"+b.options.customPaging.call(this,b,c)+"</li>";d+="</ul>",b.$dots=a(d).appendTo(b.options.appendDots),b.$dots.find("li").first().addClass("slick-active").attr("aria-hidden","false")}},b.prototype.buildOut=function(){var b=this;b.$slides=b.$slider.children(b.options.slide+":not(.slick-cloned)").addClass("slick-slide"),b.slideCount=b.$slides.length,b.$slides.each(function(b,c){a(c).attr("data-slick-index",b).data("originalStyling",a(c).attr("style")||"")}),b.$slidesCache=b.$slides,b.$slider.addClass("slick-slider"),b.$slideTrack=0===b.slideCount?a('<div class="slick-track"/>').appendTo(b.$slider):b.$slides.wrapAll('<div class="slick-track"/>').parent(),b.$list=b.$slideTrack.wrap('<div aria-live="polite" class="slick-list"/>').parent(),b.$slideTrack.css("opacity",0),(b.options.centerMode===!0||b.options.swipeToSlide===!0)&&(b.options.slidesToScroll=1),a("img[data-lazy]",b.$slider).not("[src]").addClass("slick-loading"),b.setupInfinite(),b.buildArrows(),b.buildDots(),b.updateDots(),b.setSlideClasses("number"==typeof b.currentSlide?b.currentSlide:0),b.options.draggable===!0&&b.$list.addClass("draggable")},b.prototype.buildRows=function(){var b,c,d,e,f,g,h,a=this;if(e=document.createDocumentFragment(),g=a.$slider.children(),a.options.rows>1){for(h=a.options.slidesPerRow*a.options.rows,f=Math.ceil(g.length/h),b=0;f>b;b++){var i=document.createElement("div");for(c=0;c<a.options.rows;c++){var j=document.createElement("div");for(d=0;d<a.options.slidesPerRow;d++){var k=b*h+(c*a.options.slidesPerRow+d);g.get(k)&&j.appendChild(g.get(k))}i.appendChild(j)}e.appendChild(i)}a.$slider.html(e),a.$slider.children().children().children().css({width:100/a.options.slidesPerRow+"%",display:"inline-block"})}},b.prototype.checkResponsive=function(b,c){var e,f,g,d=this,h=!1,i=d.$slider.width(),j=window.innerWidth||a(window).width();if("window"===d.respondTo?g=j:"slider"===d.respondTo?g=i:"min"===d.respondTo&&(g=Math.min(j,i)),d.options.responsive&&d.options.responsive.length&&null!==d.options.responsive){f=null;for(e in d.breakpoints)d.breakpoints.hasOwnProperty(e)&&(d.originalSettings.mobileFirst===!1?g<d.breakpoints[e]&&(f=d.breakpoints[e]):g>d.breakpoints[e]&&(f=d.breakpoints[e]));null!==f?null!==d.activeBreakpoint?(f!==d.activeBreakpoint||c)&&(d.activeBreakpoint=f,"unslick"===d.breakpointSettings[f]?d.unslick(f):(d.options=a.extend({},d.originalSettings,d.breakpointSettings[f]),b===!0&&(d.currentSlide=d.options.initialSlide),d.refresh(b)),h=f):(d.activeBreakpoint=f,"unslick"===d.breakpointSettings[f]?d.unslick(f):(d.options=a.extend({},d.originalSettings,d.breakpointSettings[f]),b===!0&&(d.currentSlide=d.options.initialSlide),d.refresh(b)),h=f):null!==d.activeBreakpoint&&(d.activeBreakpoint=null,d.options=d.originalSettings,b===!0&&(d.currentSlide=d.options.initialSlide),d.refresh(b),h=f),b||h===!1||d.$slider.trigger("breakpoint",[d,h])}},b.prototype.changeSlide=function(b,c){var f,g,h,d=this,e=a(b.target);switch(e.is("a")&&b.preventDefault(),e.is("li")||(e=e.closest("li")),h=0!==d.slideCount%d.options.slidesToScroll,f=h?0:(d.slideCount-d.currentSlide)%d.options.slidesToScroll,b.data.message){case"previous":g=0===f?d.options.slidesToScroll:d.options.slidesToShow-f,d.slideCount>d.options.slidesToShow&&d.slideHandler(d.currentSlide-g,!1,c);break;case"next":g=0===f?d.options.slidesToScroll:f,d.slideCount>d.options.slidesToShow&&d.slideHandler(d.currentSlide+g,!1,c);break;case"index":var i=0===b.data.index?0:b.data.index||e.index()*d.options.slidesToScroll;d.slideHandler(d.checkNavigable(i),!1,c),e.children().trigger("focus");break;default:return}},b.prototype.checkNavigable=function(a){var c,d,b=this;if(c=b.getNavigableIndexes(),d=0,a>c[c.length-1])a=c[c.length-1];else for(var e in c){if(a<c[e]){a=d;break}d=c[e]}return a},b.prototype.cleanUpEvents=function(){var b=this;b.options.dots&&null!==b.$dots&&(a("li",b.$dots).off("click.slick",b.changeSlide),b.options.pauseOnDotsHover===!0&&b.options.autoplay===!0&&a("li",b.$dots).off("mouseenter.slick",a.proxy(b.setPaused,b,!0)).off("mouseleave.slick",a.proxy(b.setPaused,b,!1))),b.options.arrows===!0&&b.slideCount>b.options.slidesToShow&&(b.$prevArrow&&b.$prevArrow.off("click.slick",b.changeSlide),b.$nextArrow&&b.$nextArrow.off("click.slick",b.changeSlide)),b.$list.off("touchstart.slick mousedown.slick",b.swipeHandler),b.$list.off("touchmove.slick mousemove.slick",b.swipeHandler),b.$list.off("touchend.slick mouseup.slick",b.swipeHandler),b.$list.off("touchcancel.slick mouseleave.slick",b.swipeHandler),b.$list.off("click.slick",b.clickHandler),a(document).off(b.visibilityChange,b.visibility),b.$list.off("mouseenter.slick",a.proxy(b.setPaused,b,!0)),b.$list.off("mouseleave.slick",a.proxy(b.setPaused,b,!1)),b.options.accessibility===!0&&b.$list.off("keydown.slick",b.keyHandler),b.options.focusOnSelect===!0&&a(b.$slideTrack).children().off("click.slick",b.selectHandler),a(window).off("orientationchange.slick.slick-"+b.instanceUid,b.orientationChange),a(window).off("resize.slick.slick-"+b.instanceUid,b.resize),a("[draggable!=true]",b.$slideTrack).off("dragstart",b.preventDefault),a(window).off("load.slick.slick-"+b.instanceUid,b.setPosition),a(document).off("ready.slick.slick-"+b.instanceUid,b.setPosition)},b.prototype.cleanUpRows=function(){var b,a=this;a.options.rows>1&&(b=a.$slides.children().children(),b.removeAttr("style"),a.$slider.html(b))},b.prototype.clickHandler=function(a){var b=this;b.shouldClick===!1&&(a.stopImmediatePropagation(),a.stopPropagation(),a.preventDefault())},b.prototype.destroy=function(b){var c=this;c.autoPlayClear(),c.touchObject={},c.cleanUpEvents(),a(".slick-cloned",c.$slider).detach(),c.$dots&&c.$dots.remove(),c.options.arrows===!0&&(c.$prevArrow&&c.$prevArrow.length&&(c.$prevArrow.removeClass("slick-disabled slick-arrow slick-hidden").removeAttr("aria-hidden aria-disabled tabindex").css("display",""),c.htmlExpr.test(c.options.prevArrow)&&c.$prevArrow.remove()),c.$nextArrow&&c.$nextArrow.length&&(c.$nextArrow.removeClass("slick-disabled slick-arrow slick-hidden").removeAttr("aria-hidden aria-disabled tabindex").css("display",""),c.htmlExpr.test(c.options.nextArrow)&&c.$nextArrow.remove())),c.$slides&&(c.$slides.removeClass("slick-slide slick-active slick-center slick-visible slick-current").removeAttr("aria-hidden").removeAttr("data-slick-index").each(function(){a(this).attr("style",a(this).data("originalStyling"))}),c.$slideTrack.children(this.options.slide).detach(),c.$slideTrack.detach(),c.$list.detach(),c.$slider.append(c.$slides)),c.cleanUpRows(),c.$slider.removeClass("slick-slider"),c.$slider.removeClass("slick-initialized"),c.unslicked=!0,b||c.$slider.trigger("destroy",[c])},b.prototype.disableTransition=function(a){var b=this,c={};c[b.transitionType]="",b.options.fade===!1?b.$slideTrack.css(c):b.$slides.eq(a).css(c)},b.prototype.fadeSlide=function(a,b){var c=this;c.cssTransitions===!1?(c.$slides.eq(a).css({zIndex:c.options.zIndex}),c.$slides.eq(a).animate({opacity:1},c.options.speed,c.options.easing,b)):(c.applyTransition(a),c.$slides.eq(a).css({opacity:1,zIndex:c.options.zIndex}),b&&setTimeout(function(){c.disableTransition(a),b.call()},c.options.speed))},b.prototype.fadeSlideOut=function(a){var b=this;b.cssTransitions===!1?b.$slides.eq(a).animate({opacity:0,zIndex:b.options.zIndex-2},b.options.speed,b.options.easing):(b.applyTransition(a),b.$slides.eq(a).css({opacity:0,zIndex:b.options.zIndex-2}))},b.prototype.filterSlides=b.prototype.slickFilter=function(a){var b=this;null!==a&&(b.unload(),b.$slideTrack.children(this.options.slide).detach(),b.$slidesCache.filter(a).appendTo(b.$slideTrack),b.reinit())},b.prototype.getCurrent=b.prototype.slickCurrentSlide=function(){var a=this;return a.currentSlide},b.prototype.getDotCount=function(){var a=this,b=0,c=0,d=0;if(a.options.infinite===!0)for(;b<a.slideCount;)++d,b=c+a.options.slidesToShow,c+=a.options.slidesToScroll<=a.options.slidesToShow?a.options.slidesToScroll:a.options.slidesToShow;else if(a.options.centerMode===!0)d=a.slideCount;else for(;b<a.slideCount;)++d,b=c+a.options.slidesToShow,c+=a.options.slidesToScroll<=a.options.slidesToShow?a.options.slidesToScroll:a.options.slidesToShow;return d-1},b.prototype.getLeft=function(a){var c,d,f,b=this,e=0;return b.slideOffset=0,d=b.$slides.first().outerHeight(!0),b.options.infinite===!0?(b.slideCount>b.options.slidesToShow&&(b.slideOffset=-1*b.slideWidth*b.options.slidesToShow,e=-1*d*b.options.slidesToShow),0!==b.slideCount%b.options.slidesToScroll&&a+b.options.slidesToScroll>b.slideCount&&b.slideCount>b.options.slidesToShow&&(a>b.slideCount?(b.slideOffset=-1*(b.options.slidesToShow-(a-b.slideCount))*b.slideWidth,e=-1*(b.options.slidesToShow-(a-b.slideCount))*d):(b.slideOffset=-1*b.slideCount%b.options.slidesToScroll*b.slideWidth,e=-1*b.slideCount%b.options.slidesToScroll*d))):a+b.options.slidesToShow>b.slideCount&&(b.slideOffset=(a+b.options.slidesToShow-b.slideCount)*b.slideWidth,e=(a+b.options.slidesToShow-b.slideCount)*d),b.slideCount<=b.options.slidesToShow&&(b.slideOffset=0,e=0),b.options.centerMode===!0&&b.options.infinite===!0?b.slideOffset+=b.slideWidth*Math.floor(b.options.slidesToShow/2)-b.slideWidth:b.options.centerMode===!0&&(b.slideOffset=0,b.slideOffset+=b.slideWidth*Math.floor(b.options.slidesToShow/2)),c=b.options.vertical===!1?-1*a*b.slideWidth+b.slideOffset:-1*a*d+e,b.options.variableWidth===!0&&(f=b.slideCount<=b.options.slidesToShow||b.options.infinite===!1?b.$slideTrack.children(".slick-slide").eq(a):b.$slideTrack.children(".slick-slide").eq(a+b.options.slidesToShow),c=f[0]?-1*f[0].offsetLeft:0,b.options.centerMode===!0&&(f=b.options.infinite===!1?b.$slideTrack.children(".slick-slide").eq(a):b.$slideTrack.children(".slick-slide").eq(a+b.options.slidesToShow+1),c=f[0]?-1*f[0].offsetLeft:0,c+=(b.$list.width()-f.outerWidth())/2)),c},b.prototype.getOption=b.prototype.slickGetOption=function(a){var b=this;return b.options[a]},b.prototype.getNavigableIndexes=function(){var e,a=this,b=0,c=0,d=[];for(a.options.infinite===!1?e=a.slideCount:(b=-1*a.options.slidesToScroll,c=-1*a.options.slidesToScroll,e=2*a.slideCount);e>b;)d.push(b),b=c+a.options.slidesToScroll,c+=a.options.slidesToScroll<=a.options.slidesToShow?a.options.slidesToScroll:a.options.slidesToShow;return d},b.prototype.getSlick=function(){return this},b.prototype.getSlideCount=function(){var c,d,e,b=this;return e=b.options.centerMode===!0?b.slideWidth*Math.floor(b.options.slidesToShow/2):0,b.options.swipeToSlide===!0?(b.$slideTrack.find(".slick-slide").each(function(c,f){return f.offsetLeft-e+a(f).outerWidth()/2>-1*b.swipeLeft?(d=f,!1):void 0}),c=Math.abs(a(d).attr("data-slick-index")-b.currentSlide)||1):b.options.slidesToScroll},b.prototype.goTo=b.prototype.slickGoTo=function(a,b){var c=this;c.changeSlide({data:{message:"index",index:parseInt(a)}},b)},b.prototype.init=function(b){var c=this;a(c.$slider).hasClass("slick-initialized")||(a(c.$slider).addClass("slick-initialized"),c.buildRows(),c.buildOut(),c.setProps(),c.startLoad(),c.loadSlider(),c.initializeEvents(),c.updateArrows(),c.updateDots()),b&&c.$slider.trigger("init",[c]),c.options.accessibility===!0&&c.initADA()},b.prototype.initArrowEvents=function(){var a=this;a.options.arrows===!0&&a.slideCount>a.options.slidesToShow&&(a.$prevArrow.on("click.slick",{message:"previous"},a.changeSlide),a.$nextArrow.on("click.slick",{message:"next"},a.changeSlide))},b.prototype.initDotEvents=function(){var b=this;b.options.dots===!0&&b.slideCount>b.options.slidesToShow&&a("li",b.$dots).on("click.slick",{message:"index"},b.changeSlide),b.options.dots===!0&&b.options.pauseOnDotsHover===!0&&b.options.autoplay===!0&&a("li",b.$dots).on("mouseenter.slick",a.proxy(b.setPaused,b,!0)).on("mouseleave.slick",a.proxy(b.setPaused,b,!1))},b.prototype.initializeEvents=function(){var b=this;b.initArrowEvents(),b.initDotEvents(),b.$list.on("touchstart.slick mousedown.slick",{action:"start"},b.swipeHandler),b.$list.on("touchmove.slick mousemove.slick",{action:"move"},b.swipeHandler),b.$list.on("touchend.slick mouseup.slick",{action:"end"},b.swipeHandler),b.$list.on("touchcancel.slick mouseleave.slick",{action:"end"},b.swipeHandler),b.$list.on("click.slick",b.clickHandler),a(document).on(b.visibilityChange,a.proxy(b.visibility,b)),b.$list.on("mouseenter.slick",a.proxy(b.setPaused,b,!0)),b.$list.on("mouseleave.slick",a.proxy(b.setPaused,b,!1)),b.options.accessibility===!0&&b.$list.on("keydown.slick",b.keyHandler),b.options.focusOnSelect===!0&&a(b.$slideTrack).children().on("click.slick",b.selectHandler),a(window).on("orientationchange.slick.slick-"+b.instanceUid,a.proxy(b.orientationChange,b)),a(window).on("resize.slick.slick-"+b.instanceUid,a.proxy(b.resize,b)),a("[draggable!=true]",b.$slideTrack).on("dragstart",b.preventDefault),a(window).on("load.slick.slick-"+b.instanceUid,b.setPosition),a(document).on("ready.slick.slick-"+b.instanceUid,b.setPosition)},b.prototype.initUI=function(){var a=this;a.options.arrows===!0&&a.slideCount>a.options.slidesToShow&&(a.$prevArrow.show(),a.$nextArrow.show()),a.options.dots===!0&&a.slideCount>a.options.slidesToShow&&a.$dots.show(),a.options.autoplay===!0&&a.autoPlay()},b.prototype.keyHandler=function(a){var b=this;a.target.tagName.match("TEXTAREA|INPUT|SELECT")||(37===a.keyCode&&b.options.accessibility===!0?b.changeSlide({data:{message:"previous"}}):39===a.keyCode&&b.options.accessibility===!0&&b.changeSlide({data:{message:"next"}}))},b.prototype.lazyLoad=function(){function g(b){a("img[data-lazy]",b).each(function(){var b=a(this),c=a(this).attr("data-lazy"),d=document.createElement("img");d.onload=function(){b.animate({opacity:0},100,function(){b.attr("src",c).animate({opacity:1},200,function(){b.removeAttr("data-lazy").removeClass("slick-loading")})})},d.src=c})}var c,d,e,f,b=this;b.options.centerMode===!0?b.options.infinite===!0?(e=b.currentSlide+(b.options.slidesToShow/2+1),f=e+b.options.slidesToShow+2):(e=Math.max(0,b.currentSlide-(b.options.slidesToShow/2+1)),f=2+(b.options.slidesToShow/2+1)+b.currentSlide):(e=b.options.infinite?b.options.slidesToShow+b.currentSlide:b.currentSlide,f=e+b.options.slidesToShow,b.options.fade===!0&&(e>0&&e--,f<=b.slideCount&&f++)),c=b.$slider.find(".slick-slide").slice(e,f),g(c),b.slideCount<=b.options.slidesToShow?(d=b.$slider.find(".slick-slide"),g(d)):b.currentSlide>=b.slideCount-b.options.slidesToShow?(d=b.$slider.find(".slick-cloned").slice(0,b.options.slidesToShow),g(d)):0===b.currentSlide&&(d=b.$slider.find(".slick-cloned").slice(-1*b.options.slidesToShow),g(d))},b.prototype.loadSlider=function(){var a=this;a.setPosition(),a.$slideTrack.css({opacity:1}),a.$slider.removeClass("slick-loading"),a.initUI(),"progressive"===a.options.lazyLoad&&a.progressiveLazyLoad()},b.prototype.next=b.prototype.slickNext=function(){var a=this;a.changeSlide({data:{message:"next"}})},b.prototype.orientationChange=function(){var a=this;a.checkResponsive(),a.setPosition()},b.prototype.pause=b.prototype.slickPause=function(){var a=this;a.autoPlayClear(),a.paused=!0},b.prototype.play=b.prototype.slickPlay=function(){var a=this;a.paused=!1,a.autoPlay()},b.prototype.postSlide=function(a){var b=this;b.$slider.trigger("afterChange",[b,a]),b.animating=!1,b.setPosition(),b.swipeLeft=null,b.options.autoplay===!0&&b.paused===!1&&b.autoPlay(),b.options.accessibility===!0&&b.initADA()},b.prototype.prev=b.prototype.slickPrev=function(){var a=this;a.changeSlide({data:{message:"previous"}})},b.prototype.preventDefault=function(a){a.preventDefault()},b.prototype.progressiveLazyLoad=function(){var c,d,b=this;c=a("img[data-lazy]",b.$slider).length,c>0&&(d=a("img[data-lazy]",b.$slider).first(),d.attr("src",d.attr("data-lazy")).removeClass("slick-loading").load(function(){d.removeAttr("data-lazy"),b.progressiveLazyLoad(),b.options.adaptiveHeight===!0&&b.setPosition()}).error(function(){d.removeAttr("data-lazy"),b.progressiveLazyLoad()}))},b.prototype.refresh=function(b){var c=this,d=c.currentSlide;c.destroy(!0),a.extend(c,c.initials,{currentSlide:d}),c.init(),b||c.changeSlide({data:{message:"index",index:d}},!1)},b.prototype.registerBreakpoints=function(){var c,d,e,b=this,f=b.options.responsive||null;if("array"===a.type(f)&&f.length){b.respondTo=b.options.respondTo||"window";for(c in f)if(e=b.breakpoints.length-1,d=f[c].breakpoint,f.hasOwnProperty(c)){for(;e>=0;)b.breakpoints[e]&&b.breakpoints[e]===d&&b.breakpoints.splice(e,1),e--;b.breakpoints.push(d),b.breakpointSettings[d]=f[c].settings}b.breakpoints.sort(function(a,c){return b.options.mobileFirst?a-c:c-a})}},b.prototype.reinit=function(){var b=this;b.$slides=b.$slideTrack.children(b.options.slide).addClass("slick-slide"),b.slideCount=b.$slides.length,b.currentSlide>=b.slideCount&&0!==b.currentSlide&&(b.currentSlide=b.currentSlide-b.options.slidesToScroll),b.slideCount<=b.options.slidesToShow&&(b.currentSlide=0),b.registerBreakpoints(),b.setProps(),b.setupInfinite(),b.buildArrows(),b.updateArrows(),b.initArrowEvents(),b.buildDots(),b.updateDots(),b.initDotEvents(),b.checkResponsive(!1,!0),b.options.focusOnSelect===!0&&a(b.$slideTrack).children().on("click.slick",b.selectHandler),b.setSlideClasses(0),b.setPosition(),b.$slider.trigger("reInit",[b]),b.options.autoplay===!0&&b.focusHandler()},b.prototype.resize=function(){var b=this;a(window).width()!==b.windowWidth&&(clearTimeout(b.windowDelay),b.windowDelay=window.setTimeout(function(){b.windowWidth=a(window).width(),b.checkResponsive(),b.unslicked||b.setPosition()},50))},b.prototype.removeSlide=b.prototype.slickRemove=function(a,b,c){var d=this;return"boolean"==typeof a?(b=a,a=b===!0?0:d.slideCount-1):a=b===!0?--a:a,d.slideCount<1||0>a||a>d.slideCount-1?!1:(d.unload(),c===!0?d.$slideTrack.children().remove():d.$slideTrack.children(this.options.slide).eq(a).remove(),d.$slides=d.$slideTrack.children(this.options.slide),d.$slideTrack.children(this.options.slide).detach(),d.$slideTrack.append(d.$slides),d.$slidesCache=d.$slides,d.reinit(),void 0)},b.prototype.setCSS=function(a){var d,e,b=this,c={};b.options.rtl===!0&&(a=-a),d="left"==b.positionProp?Math.ceil(a)+"px":"0px",e="top"==b.positionProp?Math.ceil(a)+"px":"0px",c[b.positionProp]=a,b.transformsEnabled===!1?b.$slideTrack.css(c):(c={},b.cssTransitions===!1?(c[b.animType]="translate("+d+", "+e+")",b.$slideTrack.css(c)):(c[b.animType]="translate3d("+d+", "+e+", 0px)",b.$slideTrack.css(c)))},b.prototype.setDimensions=function(){var a=this;a.options.vertical===!1?a.options.centerMode===!0&&a.$list.css({padding:"0px "+a.options.centerPadding}):(a.$list.height(a.$slides.first().outerHeight(!0)*a.options.slidesToShow),a.options.centerMode===!0&&a.$list.css({padding:a.options.centerPadding+" 0px"})),a.listWidth=a.$list.width(),a.listHeight=a.$list.height(),a.options.vertical===!1&&a.options.variableWidth===!1?(a.slideWidth=Math.ceil(a.listWidth/a.options.slidesToShow),a.$slideTrack.width(Math.ceil(a.slideWidth*a.$slideTrack.children(".slick-slide").length))):a.options.variableWidth===!0?a.$slideTrack.width(5e3*a.slideCount):(a.slideWidth=Math.ceil(a.listWidth),a.$slideTrack.height(Math.ceil(a.$slides.first().outerHeight(!0)*a.$slideTrack.children(".slick-slide").length)));var b=a.$slides.first().outerWidth(!0)-a.$slides.first().width();a.options.variableWidth===!1&&a.$slideTrack.children(".slick-slide").width(a.slideWidth-b)},b.prototype.setFade=function(){var c,b=this;b.$slides.each(function(d,e){c=-1*b.slideWidth*d,b.options.rtl===!0?a(e).css({position:"relative",right:c,top:0,zIndex:b.options.zIndex-2,opacity:0}):a(e).css({position:"relative",left:c,top:0,zIndex:b.options.zIndex-2,opacity:0})}),b.$slides.eq(b.currentSlide).css({zIndex:b.options.zIndex-1,opacity:1})},b.prototype.setHeight=function(){var a=this;if(1===a.options.slidesToShow&&a.options.adaptiveHeight===!0&&a.options.vertical===!1){var b=a.$slides.eq(a.currentSlide).outerHeight(!0);a.$list.css("height",b)}},b.prototype.setOption=b.prototype.slickSetOption=function(b,c,d){var f,g,e=this;if("responsive"===b&&"array"===a.type(c))for(g in c)if("array"!==a.type(e.options.responsive))e.options.responsive=[c[g]];else{for(f=e.options.responsive.length-1;f>=0;)e.options.responsive[f].breakpoint===c[g].breakpoint&&e.options.responsive.splice(f,1),f--;e.options.responsive.push(c[g])}else e.options[b]=c;d===!0&&(e.unload(),e.reinit())},b.prototype.setPosition=function(){var a=this;a.setDimensions(),a.setHeight(),a.options.fade===!1?a.setCSS(a.getLeft(a.currentSlide)):a.setFade(),a.$slider.trigger("setPosition",[a])},b.prototype.setProps=function(){var a=this,b=document.body.style;a.positionProp=a.options.vertical===!0?"top":"left","top"===a.positionProp?a.$slider.addClass("slick-vertical"):a.$slider.removeClass("slick-vertical"),(void 0!==b.WebkitTransition||void 0!==b.MozTransition||void 0!==b.msTransition)&&a.options.useCSS===!0&&(a.cssTransitions=!0),a.options.fade&&("number"==typeof a.options.zIndex?a.options.zIndex<3&&(a.options.zIndex=3):a.options.zIndex=a.defaults.zIndex),void 0!==b.OTransform&&(a.animType="OTransform",a.transformType="-o-transform",a.transitionType="OTransition",void 0===b.perspectiveProperty&&void 0===b.webkitPerspective&&(a.animType=!1)),void 0!==b.MozTransform&&(a.animType="MozTransform",a.transformType="-moz-transform",a.transitionType="MozTransition",void 0===b.perspectiveProperty&&void 0===b.MozPerspective&&(a.animType=!1)),void 0!==b.webkitTransform&&(a.animType="webkitTransform",a.transformType="-webkit-transform",a.transitionType="webkitTransition",void 0===b.perspectiveProperty&&void 0===b.webkitPerspective&&(a.animType=!1)),void 0!==b.msTransform&&(a.animType="msTransform",a.transformType="-ms-transform",a.transitionType="msTransition",void 0===b.msTransform&&(a.animType=!1)),void 0!==b.transform&&a.animType!==!1&&(a.animType="transform",a.transformType="transform",a.transitionType="transition"),a.transformsEnabled=null!==a.animType&&a.animType!==!1},b.prototype.setSlideClasses=function(a){var c,d,e,f,b=this;d=b.$slider.find(".slick-slide").removeClass("slick-active slick-center slick-current").attr("aria-hidden","true"),b.$slides.eq(a).addClass("slick-current"),b.options.centerMode===!0?(c=Math.floor(b.options.slidesToShow/2),b.options.infinite===!0&&(a>=c&&a<=b.slideCount-1-c?b.$slides.slice(a-c,a+c+1).addClass("slick-active").attr("aria-hidden","false"):(e=b.options.slidesToShow+a,d.slice(e-c+1,e+c+2).addClass("slick-active").attr("aria-hidden","false")),0===a?d.eq(d.length-1-b.options.slidesToShow).addClass("slick-center"):a===b.slideCount-1&&d.eq(b.options.slidesToShow).addClass("slick-center")),b.$slides.eq(a).addClass("slick-center")):a>=0&&a<=b.slideCount-b.options.slidesToShow?b.$slides.slice(a,a+b.options.slidesToShow).addClass("slick-active").attr("aria-hidden","false"):d.length<=b.options.slidesToShow?d.addClass("slick-active").attr("aria-hidden","false"):(f=b.slideCount%b.options.slidesToShow,e=b.options.infinite===!0?b.options.slidesToShow+a:a,b.options.slidesToShow==b.options.slidesToScroll&&b.slideCount-a<b.options.slidesToShow?d.slice(e-(b.options.slidesToShow-f),e+f).addClass("slick-active").attr("aria-hidden","false"):d.slice(e,e+b.options.slidesToShow).addClass("slick-active").attr("aria-hidden","false")),"ondemand"===b.options.lazyLoad&&b.lazyLoad()},b.prototype.setupInfinite=function(){var c,d,e,b=this;if(b.options.fade===!0&&(b.options.centerMode=!1),b.options.infinite===!0&&b.options.fade===!1&&(d=null,b.slideCount>b.options.slidesToShow)){for(e=b.options.centerMode===!0?b.options.slidesToShow+1:b.options.slidesToShow,c=b.slideCount;c>b.slideCount-e;c-=1)d=c-1,a(b.$slides[d]).clone(!0).attr("id","").attr("data-slick-index",d-b.slideCount).prependTo(b.$slideTrack).addClass("slick-cloned");for(c=0;e>c;c+=1)d=c,a(b.$slides[d]).clone(!0).attr("id","").attr("data-slick-index",d+b.slideCount).appendTo(b.$slideTrack).addClass("slick-cloned");b.$slideTrack.find(".slick-cloned").find("[id]").each(function(){a(this).attr("id","")})}},b.prototype.setPaused=function(a){var b=this;b.options.autoplay===!0&&b.options.pauseOnHover===!0&&(b.paused=a,a?b.autoPlayClear():b.autoPlay())},b.prototype.selectHandler=function(b){var c=this,d=a(b.target).is(".slick-slide")?a(b.target):a(b.target).parents(".slick-slide"),e=parseInt(d.attr("data-slick-index"));return e||(e=0),c.slideCount<=c.options.slidesToShow?(c.setSlideClasses(e),c.asNavFor(e),void 0):(c.slideHandler(e),void 0)},b.prototype.slideHandler=function(a,b,c){var d,e,f,g,h=null,i=this;return b=b||!1,i.animating===!0&&i.options.waitForAnimate===!0||i.options.fade===!0&&i.currentSlide===a||i.slideCount<=i.options.slidesToShow?void 0:(b===!1&&i.asNavFor(a),d=a,h=i.getLeft(d),g=i.getLeft(i.currentSlide),i.currentLeft=null===i.swipeLeft?g:i.swipeLeft,i.options.infinite===!1&&i.options.centerMode===!1&&(0>a||a>i.getDotCount()*i.options.slidesToScroll)?(i.options.fade===!1&&(d=i.currentSlide,c!==!0?i.animateSlide(g,function(){i.postSlide(d)}):i.postSlide(d)),void 0):i.options.infinite===!1&&i.options.centerMode===!0&&(0>a||a>i.slideCount-i.options.slidesToScroll)?(i.options.fade===!1&&(d=i.currentSlide,c!==!0?i.animateSlide(g,function(){i.postSlide(d)}):i.postSlide(d)),void 0):(i.options.autoplay===!0&&clearInterval(i.autoPlayTimer),e=0>d?0!==i.slideCount%i.options.slidesToScroll?i.slideCount-i.slideCount%i.options.slidesToScroll:i.slideCount+d:d>=i.slideCount?0!==i.slideCount%i.options.slidesToScroll?0:d-i.slideCount:d,i.animating=!0,i.$slider.trigger("beforeChange",[i,i.currentSlide,e]),f=i.currentSlide,i.currentSlide=e,i.setSlideClasses(i.currentSlide),i.updateDots(),i.updateArrows(),i.options.fade===!0?(c!==!0?(i.fadeSlideOut(f),i.fadeSlide(e,function(){i.postSlide(e)
})):i.postSlide(e),i.animateHeight(),void 0):(c!==!0?i.animateSlide(h,function(){i.postSlide(e)}):i.postSlide(e),void 0)))},b.prototype.startLoad=function(){var a=this;a.options.arrows===!0&&a.slideCount>a.options.slidesToShow&&(a.$prevArrow.hide(),a.$nextArrow.hide()),a.options.dots===!0&&a.slideCount>a.options.slidesToShow&&a.$dots.hide(),a.$slider.addClass("slick-loading")},b.prototype.swipeDirection=function(){var a,b,c,d,e=this;return a=e.touchObject.startX-e.touchObject.curX,b=e.touchObject.startY-e.touchObject.curY,c=Math.atan2(b,a),d=Math.round(180*c/Math.PI),0>d&&(d=360-Math.abs(d)),45>=d&&d>=0?e.options.rtl===!1?"left":"right":360>=d&&d>=315?e.options.rtl===!1?"left":"right":d>=135&&225>=d?e.options.rtl===!1?"right":"left":e.options.verticalSwiping===!0?d>=35&&135>=d?"left":"right":"vertical"},b.prototype.swipeEnd=function(){var c,b=this;if(b.dragging=!1,b.shouldClick=b.touchObject.swipeLength>10?!1:!0,void 0===b.touchObject.curX)return!1;if(b.touchObject.edgeHit===!0&&b.$slider.trigger("edge",[b,b.swipeDirection()]),b.touchObject.swipeLength>=b.touchObject.minSwipe)switch(b.swipeDirection()){case"left":c=b.options.swipeToSlide?b.checkNavigable(b.currentSlide+b.getSlideCount()):b.currentSlide+b.getSlideCount(),b.slideHandler(c),b.currentDirection=0,b.touchObject={},b.$slider.trigger("swipe",[b,"left"]);break;case"right":c=b.options.swipeToSlide?b.checkNavigable(b.currentSlide-b.getSlideCount()):b.currentSlide-b.getSlideCount(),b.slideHandler(c),b.currentDirection=1,b.touchObject={},b.$slider.trigger("swipe",[b,"right"])}else b.touchObject.startX!==b.touchObject.curX&&(b.slideHandler(b.currentSlide),b.touchObject={})},b.prototype.swipeHandler=function(a){var b=this;if(!(b.options.swipe===!1||"ontouchend"in document&&b.options.swipe===!1||b.options.draggable===!1&&-1!==a.type.indexOf("mouse")))switch(b.touchObject.fingerCount=a.originalEvent&&void 0!==a.originalEvent.touches?a.originalEvent.touches.length:1,b.touchObject.minSwipe=b.listWidth/b.options.touchThreshold,b.options.verticalSwiping===!0&&(b.touchObject.minSwipe=b.listHeight/b.options.touchThreshold),a.data.action){case"start":b.swipeStart(a);break;case"move":b.swipeMove(a);break;case"end":b.swipeEnd(a)}},b.prototype.swipeMove=function(a){var d,e,f,g,h,b=this;return h=void 0!==a.originalEvent?a.originalEvent.touches:null,!b.dragging||h&&1!==h.length?!1:(d=b.getLeft(b.currentSlide),b.touchObject.curX=void 0!==h?h[0].pageX:a.clientX,b.touchObject.curY=void 0!==h?h[0].pageY:a.clientY,b.touchObject.swipeLength=Math.round(Math.sqrt(Math.pow(b.touchObject.curX-b.touchObject.startX,2))),b.options.verticalSwiping===!0&&(b.touchObject.swipeLength=Math.round(Math.sqrt(Math.pow(b.touchObject.curY-b.touchObject.startY,2)))),e=b.swipeDirection(),"vertical"!==e?(void 0!==a.originalEvent&&b.touchObject.swipeLength>4&&a.preventDefault(),g=(b.options.rtl===!1?1:-1)*(b.touchObject.curX>b.touchObject.startX?1:-1),b.options.verticalSwiping===!0&&(g=b.touchObject.curY>b.touchObject.startY?1:-1),f=b.touchObject.swipeLength,b.touchObject.edgeHit=!1,b.options.infinite===!1&&(0===b.currentSlide&&"right"===e||b.currentSlide>=b.getDotCount()&&"left"===e)&&(f=b.touchObject.swipeLength*b.options.edgeFriction,b.touchObject.edgeHit=!0),b.swipeLeft=b.options.vertical===!1?d+f*g:d+f*(b.$list.height()/b.listWidth)*g,b.options.verticalSwiping===!0&&(b.swipeLeft=d+f*g),b.options.fade===!0||b.options.touchMove===!1?!1:b.animating===!0?(b.swipeLeft=null,!1):(b.setCSS(b.swipeLeft),void 0)):void 0)},b.prototype.swipeStart=function(a){var c,b=this;return 1!==b.touchObject.fingerCount||b.slideCount<=b.options.slidesToShow?(b.touchObject={},!1):(void 0!==a.originalEvent&&void 0!==a.originalEvent.touches&&(c=a.originalEvent.touches[0]),b.touchObject.startX=b.touchObject.curX=void 0!==c?c.pageX:a.clientX,b.touchObject.startY=b.touchObject.curY=void 0!==c?c.pageY:a.clientY,b.dragging=!0,void 0)},b.prototype.unfilterSlides=b.prototype.slickUnfilter=function(){var a=this;null!==a.$slidesCache&&(a.unload(),a.$slideTrack.children(this.options.slide).detach(),a.$slidesCache.appendTo(a.$slideTrack),a.reinit())},b.prototype.unload=function(){var b=this;a(".slick-cloned",b.$slider).remove(),b.$dots&&b.$dots.remove(),b.$prevArrow&&b.htmlExpr.test(b.options.prevArrow)&&b.$prevArrow.remove(),b.$nextArrow&&b.htmlExpr.test(b.options.nextArrow)&&b.$nextArrow.remove(),b.$slides.removeClass("slick-slide slick-active slick-visible slick-current").attr("aria-hidden","true").css("width","")},b.prototype.unslick=function(a){var b=this;b.$slider.trigger("unslick",[b,a]),b.destroy()},b.prototype.updateArrows=function(){var b,a=this;b=Math.floor(a.options.slidesToShow/2),a.options.arrows===!0&&a.slideCount>a.options.slidesToShow&&!a.options.infinite&&(a.$prevArrow.removeClass("slick-disabled").attr("aria-disabled","false"),a.$nextArrow.removeClass("slick-disabled").attr("aria-disabled","false"),0===a.currentSlide?(a.$prevArrow.addClass("slick-disabled").attr("aria-disabled","true"),a.$nextArrow.removeClass("slick-disabled").attr("aria-disabled","false")):a.currentSlide>=a.slideCount-a.options.slidesToShow&&a.options.centerMode===!1?(a.$nextArrow.addClass("slick-disabled").attr("aria-disabled","true"),a.$prevArrow.removeClass("slick-disabled").attr("aria-disabled","false")):a.currentSlide>=a.slideCount-1&&a.options.centerMode===!0&&(a.$nextArrow.addClass("slick-disabled").attr("aria-disabled","true"),a.$prevArrow.removeClass("slick-disabled").attr("aria-disabled","false")))},b.prototype.updateDots=function(){var a=this;null!==a.$dots&&(a.$dots.find("li").removeClass("slick-active").attr("aria-hidden","true"),a.$dots.find("li").eq(Math.floor(a.currentSlide/a.options.slidesToScroll)).addClass("slick-active").attr("aria-hidden","false"))},b.prototype.visibility=function(){var a=this;document[a.hidden]?(a.paused=!0,a.autoPlayClear()):a.options.autoplay===!0&&(a.paused=!1,a.autoPlay())},b.prototype.initADA=function(){var b=this;b.$slides.add(b.$slideTrack.find(".slick-cloned")).attr({"aria-hidden":"true",tabindex:"-1"}).find("a, input, button, select").attr({tabindex:"-1"}),b.$slideTrack.attr("role","listbox"),b.$slides.not(b.$slideTrack.find(".slick-cloned")).each(function(c){a(this).attr({role:"option","aria-describedby":"slick-slide"+b.instanceUid+c})}),null!==b.$dots&&b.$dots.attr("role","tablist").find("li").each(function(c){a(this).attr({role:"presentation","aria-selected":"false","aria-controls":"navigation"+b.instanceUid+c,id:"slick-slide"+b.instanceUid+c})}).first().attr("aria-selected","true").end().find("button").attr("role","button").end().closest("div").attr("role","toolbar"),b.activateADA()},b.prototype.activateADA=function(){var a=this,b=a.$slider.find("*").is(":focus");a.$slideTrack.find(".slick-active").attr({"aria-hidden":"false",tabindex:"0"}).find("a, input, button, select").attr({tabindex:"0"}),b&&a.$slideTrack.find(".slick-active").focus()},b.prototype.focusHandler=function(){var b=this;b.$slider.on("focus.slick blur.slick","*",function(c){c.stopImmediatePropagation();var d=a(this);setTimeout(function(){b.isPlay&&(d.is(":focus")?(b.autoPlayClear(),b.paused=!0):(b.paused=!1,b.autoPlay()))},0)})},a.fn.slick=function(){var g,a=this,c=arguments[0],d=Array.prototype.slice.call(arguments,1),e=a.length,f=0;for(f;e>f;f++)if("object"==typeof c||"undefined"==typeof c?a[f].slick=new b(a[f],c):g=a[f].slick[c].apply(a[f].slick,d),"undefined"!=typeof g)return g;return a}});/*
 * This combined file was created by the DataTables downloader builder:
 *   https://datatables.net/download
 *
 * To rebuild or modify this file with the latest versions of the included
 * software please visit:
 *   https://datatables.net/download/#dt/dt-2.1.5
 *
 * Included libraries:
 *  DataTables 2.1.5
 */

/*! DataTables 2.1.5
 * © SpryMedia Ltd - datatables.net/license
 */
!function(n){"use strict";var a;"function"==typeof define&&define.amd?define(["jquery"],function(t){return n(t,window,document)}):"object"==typeof exports?(a=require("jquery"),"undefined"==typeof window?module.exports=function(t,e){return t=t||window,e=e||a(t),n(e,t,t.document)}:module.exports=n(a,window,window.document)):window.DataTable=n(jQuery,window,document)}(function(H,W,_){"use strict";function f(t){var e=parseInt(t,10);return!isNaN(e)&&isFinite(t)?e:null}function s(t,e,n,a){var r=typeof t,o="string"==r;return"number"==r||"bigint"==r||!(!a||!T(t))||(e&&o&&(t=E(t,e)),n&&o&&(t=t.replace(P,"")),!isNaN(parseFloat(t))&&isFinite(t))}function c(t,e,n,a){var r;return!(!a||!T(t))||("string"!=typeof t||!t.match(/<(input|select)/i))&&(T(r=t)||"string"==typeof r)&&!!s(L(t),e,n,a)||null}function b(t,e,n,a){var r=[],o=0,i=e.length;if(void 0!==a)for(;o<i;o++)t[e[o]][n]&&r.push(t[e[o]][n][a]);else for(;o<i;o++)t[e[o]]&&r.push(t[e[o]][n]);return r}function h(t,e){var n,a=[];void 0===e?(e=0,n=t):(n=e,e=t);for(var r=e;r<n;r++)a.push(r);return a}function A(t){for(var e=[],n=0,a=t.length;n<a;n++)t[n]&&e.push(t[n]);return e}var C,X,e,t,V=function(t,P){var E,k,M;return V.factory(t,P)?V:this instanceof V?H(t).DataTable(P):(k=void 0===(P=t),M=(E=this).length,k&&(P={}),this.api=function(){return new X(this)},this.each(function(){var t=1<M?te({},P,!0):P,e=0,n=this.getAttribute("id"),a=V.defaults,r=H(this);if("table"!=this.nodeName.toLowerCase())$(null,0,"Non-table node initialisation ("+this.nodeName+")",2);else{H(this).trigger("options.dt",t),Q(a),K(a.column),B(a,a,!0),B(a.column,a.column,!0),B(a,H.extend(t,r.data()),!0);var o=V.settings;for(e=0,R=o.length;e<R;e++){var i=o[e];if(i.nTable==this||i.nTHead&&i.nTHead.parentNode==this||i.nTFoot&&i.nTFoot.parentNode==this){var l=(void 0!==t.bRetrieve?t:a).bRetrieve,s=(void 0!==t.bDestroy?t:a).bDestroy;if(k||l)return i.oInstance;if(s){new V.Api(i).destroy();break}return void $(i,0,"Cannot reinitialise DataTable",3)}if(i.sTableId==this.id){o.splice(e,1);break}}null!==n&&""!==n||(n="DataTables_Table_"+V.ext._unique++,this.id=n);var u,c=H.extend(!0,{},V.models.oSettings,{sDestroyWidth:r[0].style.width,sInstance:n,sTableId:n,colgroup:H("<colgroup>").prependTo(this),fastData:function(t,e,n){return q(c,t,e,n)}}),n=(c.nTable=this,c.oInit=t,o.push(c),c.api=new X(c),c.oInstance=1===E.length?E:r.dataTable(),Q(t),t.aLengthMenu&&!t.iDisplayLength&&(t.iDisplayLength=Array.isArray(t.aLengthMenu[0])?t.aLengthMenu[0][0]:H.isPlainObject(t.aLengthMenu[0])?t.aLengthMenu[0].value:t.aLengthMenu[0]),t=te(H.extend(!0,{},a),t),z(c.oFeatures,t,["bPaginate","bLengthChange","bFilter","bSort","bSortMulti","bInfo","bProcessing","bAutoWidth","bSortClasses","bServerSide","bDeferRender"]),z(c,t,["ajax","fnFormatNumber","sServerMethod","aaSorting","aaSortingFixed","aLengthMenu","sPaginationType","iStateDuration","bSortCellsTop","iTabIndex","sDom","fnStateLoadCallback","fnStateSaveCallback","renderer","searchDelay","rowId","caption","layout","orderDescReverse",["iCookieDuration","iStateDuration"],["oSearch","oPreviousSearch"],["aoSearchCols","aoPreSearchCols"],["iDisplayLength","_iDisplayLength"]]),z(c.oScroll,t,[["sScrollX","sX"],["sScrollXInner","sXInner"],["sScrollY","sY"],["bScrollCollapse","bCollapse"]]),z(c.oLanguage,t,"fnInfoCallback"),Y(c,"aoDrawCallback",t.fnDrawCallback),Y(c,"aoStateSaveParams",t.fnStateSaveParams),Y(c,"aoStateLoadParams",t.fnStateLoadParams),Y(c,"aoStateLoaded",t.fnStateLoaded),Y(c,"aoRowCallback",t.fnRowCallback),Y(c,"aoRowCreatedCallback",t.fnCreatedRow),Y(c,"aoHeaderCallback",t.fnHeaderCallback),Y(c,"aoFooterCallback",t.fnFooterCallback),Y(c,"aoInitComplete",t.fnInitComplete),Y(c,"aoPreDrawCallback",t.fnPreDrawCallback),c.rowIdFn=U(t.rowId),c),d=(V.__browser||(f={},V.__browser=f,p=H("<div/>").css({position:"fixed",top:0,left:-1*W.pageXOffset,height:1,width:1,overflow:"hidden"}).append(H("<div/>").css({position:"absolute",top:1,left:1,width:100,overflow:"scroll"}).append(H("<div/>").css({width:"100%",height:10}))).appendTo("body"),d=p.children(),u=d.children(),f.barWidth=d[0].offsetWidth-d[0].clientWidth,f.bScrollbarLeft=1!==Math.round(u.offset().left),p.remove()),H.extend(n.oBrowser,V.__browser),n.oScroll.iBarWidth=V.__browser.barWidth,c.oClasses),f=(H.extend(d,V.ext.classes,t.oClasses),r.addClass(d.table),c.oFeatures.bPaginate||(t.iDisplayStart=0),void 0===c.iInitDisplayStart&&(c.iInitDisplayStart=t.iDisplayStart,c._iDisplayStart=t.iDisplayStart),t.iDeferLoading),h=(null!==f&&(c.deferLoading=!0,u=Array.isArray(f),c._iRecordsDisplay=u?f[0]:f,c._iRecordsTotal=u?f[1]:f),[]),p=this.getElementsByTagName("thead"),n=At(c,p[0]);if(t.aoColumns)h=t.aoColumns;else if(n.length)for(R=n[e=0].length;e<R;e++)h.push(null);for(e=0,R=h.length;e<R;e++)tt(c);var g,v,m,b,y,D,x,S=c,w=t.aoColumnDefs,T=h,_=n,C=function(t,e){et(c,t,e)},L=S.aoColumns;if(T)for(g=0,v=T.length;g<v;g++)T[g]&&T[g].name&&(L[g].sName=T[g].name);if(w)for(g=w.length-1;0<=g;g--){var I=void 0!==(x=w[g]).target?x.target:void 0!==x.targets?x.targets:x.aTargets;for(Array.isArray(I)||(I=[I]),m=0,b=I.length;m<b;m++){var A=I[m];if("number"==typeof A&&0<=A){for(;L.length<=A;)tt(S);C(A,x)}else if("number"==typeof A&&A<0)C(L.length+A,x);else if("string"==typeof A)for(y=0,D=L.length;y<D;y++)"_all"===A?C(y,x):-1!==A.indexOf(":name")?L[y].sName===A.replace(":name","")&&C(y,x):_.forEach(function(t){t[y]&&(t=H(t[y].cell),A.match(/^[a-z][\w-]*$/i)&&(A="."+A),t.is(A))&&C(y,x)})}}if(T)for(g=0,v=T.length;g<v;g++)C(g,T[g]);var F,n=r.children("tbody").find("tr").eq(0),N=(n.length&&(F=function(t,e){return null!==t.getAttribute("data-"+e)?e:null},H(n[0]).children("th, td").each(function(t,e){var n,a=c.aoColumns[t];a||$(c,0,"Incorrect column count",18),a.mData===t&&(n=F(e,"sort")||F(e,"order"),e=F(e,"filter")||F(e,"search"),null===n&&null===e||(a.mData={_:t+".display",sort:null!==n?t+".@data-"+n:void 0,type:null!==n?t+".@data-"+n:void 0,filter:null!==e?t+".@data-"+e:void 0},a._isArrayHost=!0,et(c,t)))})),Y(c,"aoDrawCallback",Qt),c.oFeatures);if(t.bStateSave&&(N.bStateSave=!0),void 0===t.aaSorting)for(var j=c.aaSorting,e=0,R=j.length;e<R;e++)j[e][1]=c.aoColumns[e].asSorting[0];Zt(c),Y(c,"aoDrawCallback",function(){(c.bSorted||"ssp"===J(c)||N.bDeferRender)&&Zt(c)});var n=r.children("caption"),n=(c.caption&&(n=0===n.length?H("<caption/>").appendTo(r):n).html(c.caption),n.length&&(n[0]._captionSide=n.css("caption-side"),c.captionNode=n[0]),0===p.length&&(p=H("<thead/>").appendTo(r)),c.nTHead=p[0],H("tr",p).addClass(d.thead.row),r.children("tbody")),n=(0===n.length&&(n=H("<tbody/>").insertAfter(p)),c.nTBody=n[0],r.children("tfoot")),O=(0===n.length&&(n=H("<tfoot/>").appendTo(r)),c.nTFoot=n[0],H("tr",n).addClass(d.tfoot.row),c.aiDisplay=c.aiDisplayMaster.slice(),c.bInitialised=!0,c.oLanguage);H.extend(!0,O,t.oLanguage),O.sUrl?H.ajax({dataType:"json",url:O.sUrl,success:function(t){B(a.oLanguage,t),H.extend(!0,O,t,c.oInit.oLanguage),G(c,null,"i18n",[c],!0),Mt(c)},error:function(){$(c,0,"i18n file loading error",21),Mt(c)}}):(G(c,null,"i18n",[c]),Mt(c))}}),E=null,this)},g=(V.ext=C={buttons:{},classes:{},builder:"dt/dt-2.1.5",errMode:"alert",feature:[],features:{},search:[],selector:{cell:[],column:[],row:[]},legacy:{ajax:null},pager:{},renderer:{pageButton:{},header:{}},order:{},type:{className:{},detect:[],render:{},search:{},order:{}},_unique:0,fnVersionCheck:V.fnVersionCheck,iApiIndex:0,sVersion:V.version},H.extend(C,{afnFiltering:C.search,aTypes:C.type.detect,ofnSearch:C.type.search,oSort:C.type.order,afnSortData:C.order,aoFeatures:C.feature,oStdClasses:C.classes,oPagination:C.pager}),H.extend(V.ext.classes,{container:"dt-container",empty:{row:"dt-empty"},info:{container:"dt-info"},layout:{row:"dt-layout-row",cell:"dt-layout-cell",tableRow:"dt-layout-table",tableCell:"",start:"dt-layout-start",end:"dt-layout-end",full:"dt-layout-full"},length:{container:"dt-length",select:"dt-input"},order:{canAsc:"dt-orderable-asc",canDesc:"dt-orderable-desc",isAsc:"dt-ordering-asc",isDesc:"dt-ordering-desc",none:"dt-orderable-none",position:"sorting_"},processing:{container:"dt-processing"},scrolling:{body:"dt-scroll-body",container:"dt-scroll",footer:{self:"dt-scroll-foot",inner:"dt-scroll-footInner"},header:{self:"dt-scroll-head",inner:"dt-scroll-headInner"}},search:{container:"dt-search",input:"dt-input"},table:"dataTable",tbody:{cell:"",row:""},thead:{cell:"",row:""},tfoot:{cell:"",row:""},paging:{active:"current",button:"dt-paging-button",container:"dt-paging",disabled:"disabled",nav:""}}),{}),F=/[\r\n\u2028]/g,N=/<([^>]*>)/g,j=Math.pow(2,28),R=/^\d{2,4}[./-]\d{1,2}[./-]\d{1,2}([T ]{1}\d{1,2}[:.]\d{2}([.:]\d{2})?)?$/,O=new RegExp("(\\"+["/",".","*","+","?","|","(",")","[","]","{","}","\\","$","^","-"].join("|\\")+")","g"),P=/['\u00A0,$£€¥%\u2009\u202F\u20BD\u20a9\u20BArfkɃΞ]/gi,T=function(t){return!t||!0===t||"-"===t},E=function(t,e){return g[e]||(g[e]=new RegExp(Pt(e),"g")),"string"==typeof t&&"."!==e?t.replace(/\./g,"").replace(g[e],"."):t},m=function(t,e,n){var a=[],r=0,o=t.length;if(void 0!==n)for(;r<o;r++)t[r]&&t[r][e]&&a.push(t[r][e][n]);else for(;r<o;r++)t[r]&&a.push(t[r][e]);return a},L=function(t){if(!t||"string"!=typeof t)return t;if(t.length>j)throw new Error("Exceeded max str len");var e;for(t=t.replace(N,"");(t=(e=t).replace(/<script/i,""))!==e;);return e},u=function(t){return"string"==typeof(t=Array.isArray(t)?t.join(","):t)?t.replace(/&/g,"&amp;").replace(/</g,"&lt;").replace(/>/g,"&gt;").replace(/"/g,"&quot;"):t},k=function(t,e){var n;return"string"!=typeof t?t:(n=t.normalize("NFD")).length!==t.length?(!0===e?t+" ":"")+n.replace(/[\u0300-\u036f]/g,""):n},x=function(t){if(Array.from&&Set)return Array.from(new Set(t));if(function(t){if(!(t.length<2))for(var e=t.slice().sort(),n=e[0],a=1,r=e.length;a<r;a++){if(e[a]===n)return!1;n=e[a]}return!0}(t))return t.slice();var e,n,a,r=[],o=t.length,i=0;t:for(n=0;n<o;n++){for(e=t[n],a=0;a<i;a++)if(r[a]===e)continue t;r.push(e),i++}return r},M=function(t,e){if(Array.isArray(e))for(var n=0;n<e.length;n++)M(t,e[n]);else t.push(e);return t};function y(e,t){t&&t.split(" ").forEach(function(t){t&&e.classList.add(t)})}function Z(e){var n,a,r={};H.each(e,function(t){(n=t.match(/^([^A-Z]+?)([A-Z])/))&&-1!=="a aa ai ao as b fn i m o s ".indexOf(n[1]+" ")&&(a=t.replace(n[0],n[2].toLowerCase()),r[a]=t,"o"===n[1])&&Z(e[t])}),e._hungarianMap=r}function B(e,n,a){var r;e._hungarianMap||Z(e),H.each(n,function(t){void 0===(r=e._hungarianMap[t])||!a&&void 0!==n[r]||("o"===r.charAt(0)?(n[r]||(n[r]={}),H.extend(!0,n[r],n[t]),B(e[r],n[r],a)):n[r]=n[t])})}V.util={diacritics:function(t,e){if("function"!=typeof t)return k(t,e);k=t},debounce:function(n,a){var r;return function(){var t=this,e=arguments;clearTimeout(r),r=setTimeout(function(){n.apply(t,e)},a||250)}},throttle:function(a,t){var r,o,i=void 0!==t?t:200;return function(){var t=this,e=+new Date,n=arguments;r&&e<r+i?(clearTimeout(o),o=setTimeout(function(){r=void 0,a.apply(t,n)},i)):(r=e,a.apply(t,n))}},escapeRegex:function(t){return t.replace(O,"\\$1")},set:function(a){var f;return H.isPlainObject(a)?V.util.set(a._):null===a?function(){}:"function"==typeof a?function(t,e,n){a(t,"set",e,n)}:"string"!=typeof a||-1===a.indexOf(".")&&-1===a.indexOf("[")&&-1===a.indexOf("(")?function(t,e){t[a]=e}:(f=function(t,e,n){for(var a,r,o,i,l=gt(n),n=l[l.length-1],s=0,u=l.length-1;s<u;s++){if("__proto__"===l[s]||"constructor"===l[s])throw new Error("Cannot set prototype values");if(a=l[s].match(pt),r=l[s].match(p),a){if(l[s]=l[s].replace(pt,""),t[l[s]]=[],(a=l.slice()).splice(0,s+1),i=a.join("."),Array.isArray(e))for(var c=0,d=e.length;c<d;c++)f(o={},e[c],i),t[l[s]].push(o);else t[l[s]]=e;return}r&&(l[s]=l[s].replace(p,""),t=t[l[s]](e)),null!==t[l[s]]&&void 0!==t[l[s]]||(t[l[s]]={}),t=t[l[s]]}n.match(p)?t[n.replace(p,"")](e):t[n.replace(pt,"")]=e},function(t,e){return f(t,e,a)})},get:function(r){var o,f;return H.isPlainObject(r)?(o={},H.each(r,function(t,e){e&&(o[t]=V.util.get(e))}),function(t,e,n,a){var r=o[e]||o._;return void 0!==r?r(t,e,n,a):t}):null===r?function(t){return t}:"function"==typeof r?function(t,e,n,a){return r(t,e,n,a)}:"string"!=typeof r||-1===r.indexOf(".")&&-1===r.indexOf("[")&&-1===r.indexOf("(")?function(t){return t[r]}:(f=function(t,e,n){var a,r,o;if(""!==n)for(var i=gt(n),l=0,s=i.length;l<s;l++){if(d=i[l].match(pt),a=i[l].match(p),d){if(i[l]=i[l].replace(pt,""),""!==i[l]&&(t=t[i[l]]),r=[],i.splice(0,l+1),o=i.join("."),Array.isArray(t))for(var u=0,c=t.length;u<c;u++)r.push(f(t[u],e,o));var d=d[0].substring(1,d[0].length-1);t=""===d?r:r.join(d);break}if(a)i[l]=i[l].replace(p,""),t=t[i[l]]();else{if(null===t||null===t[i[l]])return null;if(void 0===t||void 0===t[i[l]])return;t=t[i[l]]}}return t},function(t,e){return f(t,e,r)})},stripHtml:function(t){var e=typeof t;if("function"!=e)return"string"==e?L(t):t;L=t},escapeHtml:function(t){var e=typeof t;if("function"!=e)return"string"==e||Array.isArray(t)?u(t):t;u=t},unique:x};var r=function(t,e,n){void 0!==t[e]&&(t[n]=t[e])};function Q(t){r(t,"ordering","bSort"),r(t,"orderMulti","bSortMulti"),r(t,"orderClasses","bSortClasses"),r(t,"orderCellsTop","bSortCellsTop"),r(t,"order","aaSorting"),r(t,"orderFixed","aaSortingFixed"),r(t,"paging","bPaginate"),r(t,"pagingType","sPaginationType"),r(t,"pageLength","iDisplayLength"),r(t,"searching","bFilter"),"boolean"==typeof t.sScrollX&&(t.sScrollX=t.sScrollX?"100%":""),"boolean"==typeof t.scrollX&&(t.scrollX=t.scrollX?"100%":"");var e=t.aoSearchCols;if(e)for(var n=0,a=e.length;n<a;n++)e[n]&&B(V.models.oSearch,e[n]);t.serverSide&&!t.searchDelay&&(t.searchDelay=400)}function K(t){r(t,"orderable","bSortable"),r(t,"orderData","aDataSort"),r(t,"orderSequence","asSorting"),r(t,"orderDataType","sortDataType");var e=t.aDataSort;"number"!=typeof e||Array.isArray(e)||(t.aDataSort=[e])}function tt(t){var e=V.defaults.column,n=t.aoColumns.length,e=H.extend({},V.models.oColumn,e,{aDataSort:e.aDataSort||[n],mData:e.mData||n,idx:n,searchFixed:{},colEl:H("<col>").attr("data-dt-column",n)}),e=(t.aoColumns.push(e),t.aoPreSearchCols);e[n]=H.extend({},V.models.oSearch,e[n])}function et(t,e,n){function a(t){return"string"==typeof t&&-1!==t.indexOf("@")}var r=t.aoColumns[e],o=(null!=n&&(K(n),B(V.defaults.column,n,!0),void 0===n.mDataProp||n.mData||(n.mData=n.mDataProp),n.sType&&(r._sManualType=n.sType),n.className&&!n.sClass&&(n.sClass=n.className),e=r.sClass,H.extend(r,n),z(r,n,"sWidth","sWidthOrig"),e!==r.sClass&&(r.sClass=e+" "+r.sClass),void 0!==n.iDataSort&&(r.aDataSort=[n.iDataSort]),z(r,n,"aDataSort")),r.mData),i=U(o);r.mRender&&Array.isArray(r.mRender)&&(n=(e=r.mRender.slice()).shift(),r.mRender=V.render[n].apply(W,e)),r._render=r.mRender?U(r.mRender):null;r._bAttrSrc=H.isPlainObject(o)&&(a(o.sort)||a(o.type)||a(o.filter)),r._setter=null,r.fnGetData=function(t,e,n){var a=i(t,e,void 0,n);return r._render&&e?r._render(a,e,t,n):a},r.fnSetData=function(t,e,n){return v(o)(t,e,n)},"number"==typeof o||r._isArrayHost||(t._rowReadObject=!0),t.oFeatures.bSort||(r.bSortable=!1)}function nt(t){var e=t;if(e.oFeatures.bAutoWidth){var n,a,r=e.nTable,o=e.aoColumns,i=e.oScroll,l=i.sY,s=i.sX,i=i.sXInner,u=it(e,"bVisible"),c=r.getAttribute("width"),d=r.parentNode,f=r.style.width,f=(f||c||(r.style.width="100%",f="100%"),f&&-1!==f.indexOf("%")&&(c=f),G(e,null,"column-calc",{visible:u},!1),H(r.cloneNode()).css("visibility","hidden").removeAttr("id")),h=(f.append("<tbody>"),H("<tr/>").appendTo(f.find("tbody")));for(f.append(H(e.nTHead).clone()).append(H(e.nTFoot).clone()),f.find("tfoot th, tfoot td").css("width",""),f.find("thead th, thead td").each(function(){var t=ct(e,this,!0,!1);t?(this.style.width=t,this.style.minWidth=t,s&&H(this).append(H("<div/>").css({width:t,margin:0,padding:0,border:0,height:1}))):this.style.width=""}),n=0;n<u.length;n++){p=u[n],a=o[p];var p=function(t,e){var n=t.aoColumns[e];if(!n.maxLenString){for(var a,r="",o=-1,i=0,l=t.aiDisplayMaster.length;i<l;i++){var s=t.aiDisplayMaster[i],s=Dt(t,s)[e],s=s&&"object"==typeof s&&s.nodeType?s.innerHTML:s+"";s=s.replace(/id=".*?"/g,"").replace(/name=".*?"/g,""),(a=L(s).replace(/&nbsp;/g," ")).length>o&&(r=s,o=a.length)}n.maxLenString=r}return n.maxLenString}(e,p),g=C.type.className[a.sType],v=p+a.sContentPadding,p=-1===p.indexOf("<")?_.createTextNode(v):v;H("<td/>").addClass(g).addClass(a.sClass).append(p).appendTo(h)}H("[name]",f).removeAttr("name");var m=H("<div/>").css(s||l?{position:"absolute",top:0,left:0,height:1,right:0,overflow:"hidden"}:{}).append(f).appendTo(d),b=(s&&i?f.width(i):s?(f.css("width","auto"),f.removeAttr("width"),f.width()<d.clientWidth&&c&&f.width(d.clientWidth)):l?f.width(d.clientWidth):c&&f.width(c),0),y=f.find("tbody tr").eq(0).children();for(n=0;n<u.length;n++){var D=y[n].getBoundingClientRect().width;b+=D,o[u[n]].sWidth=I(D)}r.style.width=I(b),m.remove(),c&&(r.style.width=I(c)),!c&&!s||e._reszEvt||(H(W).on("resize.DT-"+e.sInstance,V.util.throttle(function(){e.bDestroying||nt(e)})),e._reszEvt=!0)}for(var x=t,S=x.aoColumns,w=0;w<S.length;w++){var T=ct(x,[w],!1,!1);S[w].colEl.css("width",T).css("min-width",T)}i=t.oScroll;""===i.sY&&""===i.sX||qt(t),G(t,null,"column-sizing",[t])}function at(t,e){t=it(t,"bVisible");return"number"==typeof t[e]?t[e]:null}function rt(t,e){t=it(t,"bVisible").indexOf(e);return-1!==t?t:null}function ot(t){var e=t.aoHeader,n=t.aoColumns,a=0;if(e.length)for(var r=0,o=e[0].length;r<o;r++)n[r].bVisible&&"none"!==H(e[0][r].cell).css("display")&&a++;return a}function it(t,n){var a=[];return t.aoColumns.map(function(t,e){t[n]&&a.push(e)}),a}function lt(t,e){return!0===e?t.name:e}function st(t){var e,n,a,r,o,i,l,s,u=t.aoColumns,c=t.aoData,d=V.ext.type.detect;if("ssp"!==J(t))for(e=0,n=u.length;e<n;e++){if(s=[],!(l=u[e]).sType&&l._sManualType)l.sType=l._sManualType;else if(!l.sType){for(a=0,r=d.length;a<r;a++){var f=d[a],h=f.oneOf,p=f.allOf||f,g=f.init,v=!1,m=null;if(g&&(m=lt(f,g(t,l,e)))){l.sType=m;break}for(o=0,i=c.length;o<i;o++)if(c[o]){if(void 0===s[o]&&(s[o]=q(t,o,e,"type")),h&&!v&&(v=lt(f,h(s[o],t))),!(m=lt(f,p(s[o],t)))&&a!==d.length-3)break;if("html"===m&&!T(s[o]))break}if(h&&v&&m||!h&&m){l.sType=m;break}}l.sType||(l.sType="string")}var b=C.type.className[l.sType],b=(b&&(ut(t.aoHeader,e,b),ut(t.aoFooter,e,b)),C.type.render[l.sType]);if(b&&!l._render){l._render=V.util.get(b),y=w=S=x=D=void 0;for(var y,D=t,x=e,S=D.aoData,w=0;w<S.length;w++)S[w].nTr&&(y=q(D,w,x,"display"),S[w].displayData[x]=y,ht(S[w].anCells[x],y))}}}function ut(t,e,n){t.forEach(function(t){t[e]&&t[e].unique&&y(t[e].cell,n)})}function ct(t,e,n,a){Array.isArray(e)||(e=dt(e));for(var r,o=0,i=t.aoColumns,l=0,s=e.length;l<s;l++){var u=i[e[l]],c=n?u.sWidthOrig:u.sWidth;if(a||!1!==u.bVisible){if(null==c)return null;"number"==typeof c?(r="px",o+=c):(u=c.match(/([\d\.]+)([^\d]*)/))&&(o+=+u[1],r=3===u.length?u[2]:"px")}}return o+r}function dt(t){t=H(t).closest("[data-dt-column]").attr("data-dt-column");return t?t.split(",").map(function(t){return+t}):[]}function D(t,e,n,a){for(var r=t.aoData.length,o=H.extend(!0,{},V.models.oRow,{src:n?"dom":"data",idx:r}),i=(o._aData=e,t.aoData.push(o),t.aoColumns),l=0,s=i.length;l<s;l++)i[l].sType=null;t.aiDisplayMaster.push(r);e=t.rowIdFn(e);return void 0!==e&&(t.aIds[e]=o),!n&&t.oFeatures.bDeferRender||xt(t,r,n,a),r}function ft(n,t){var a;return(t=t instanceof H?t:H(t)).map(function(t,e){return a=yt(n,e),D(n,a.data,e,a.cells)})}function q(t,e,n,a){"search"===a?a="filter":"order"===a&&(a="sort");var r=t.aoData[e];if(r){var o=t.iDraw,i=t.aoColumns[n],r=r._aData,l=i.sDefaultContent,s=i.fnGetData(r,a,{settings:t,row:e,col:n});if(void 0===(s="display"!==a&&s&&"object"==typeof s&&s.nodeName?s.innerHTML:s))return t.iDrawError!=o&&null===l&&($(t,0,"Requested unknown parameter "+("function"==typeof i.mData?"{function}":"'"+i.mData+"'")+" for row "+e+", column "+n,4),t.iDrawError=o),l;if(s!==r&&null!==s||null===l||void 0===a){if("function"==typeof s)return s.call(r)}else s=l;return null===s&&"display"===a?"":s="filter"===a&&(e=V.ext.type.search)[i.sType]?e[i.sType](s):s}}function ht(t,e){e&&"object"==typeof e&&e.nodeName?H(t).empty().append(e):t.innerHTML=e}var pt=/\[.*?\]$/,p=/\(\)$/;function gt(t){return(t.match(/(\\.|[^.])+/g)||[""]).map(function(t){return t.replace(/\\\./g,".")})}var U=V.util.get,v=V.util.set;function vt(t){return m(t.aoData,"_aData")}function mt(t){t.aoData.length=0,t.aiDisplayMaster.length=0,t.aiDisplay.length=0,t.aIds={}}function bt(t,e,n,a){var r,o,i=t.aoData[e];if(i._aSortData=null,i._aFilterData=null,i.displayData=null,"dom"!==n&&(n&&"auto"!==n||"dom"!==i.src)){var l=i.anCells,s=Dt(t,e);if(l)if(void 0!==a)ht(l[a],s[a]);else for(r=0,o=l.length;r<o;r++)ht(l[r],s[r])}else i._aData=yt(t,i,a,void 0===a?void 0:i._aData).data;var u=t.aoColumns;if(void 0!==a)u[a].sType=null,u[a].maxLenString=null;else{for(r=0,o=u.length;r<o;r++)u[r].sType=null,u[r].maxLenString=null;St(t,i)}}function yt(t,e,n,a){function r(t,e){var n;"string"==typeof t&&-1!==(n=t.indexOf("@"))&&(n=t.substring(n+1),v(t)(a,e.getAttribute(n)))}function o(t){void 0!==n&&n!==d||(l=f[d],s=t.innerHTML.trim(),l&&l._bAttrSrc?(v(l.mData._)(a,s),r(l.mData.sort,t),r(l.mData.type,t),r(l.mData.filter,t)):h?(l._setter||(l._setter=v(l.mData)),l._setter(a,s)):a[d]=s),d++}var i,l,s,u=[],c=e.firstChild,d=0,f=t.aoColumns,h=t._rowReadObject;a=void 0!==a?a:h?{}:[];if(c)for(;c;)"TD"!=(i=c.nodeName.toUpperCase())&&"TH"!=i||(o(c),u.push(c)),c=c.nextSibling;else for(var p=0,g=(u=e.anCells).length;p<g;p++)o(u[p]);var e=e.firstChild?e:e.nTr;return e&&(e=e.getAttribute("id"))&&v(t.rowId)(a,e),{data:a,cells:u}}function Dt(t,e){var n=t.aoData[e],a=t.aoColumns;if(!n.displayData){n.displayData=[];for(var r=0,o=a.length;r<o;r++)n.displayData.push(q(t,e,r,"display"))}return n.displayData}function xt(t,e,n,a){var r,o,i,l,s,u,c=t.aoData[e],d=c._aData,f=[],h=t.oClasses.tbody.row;if(null===c.nTr){for(r=n||_.createElement("tr"),c.nTr=r,c.anCells=f,y(r,h),r._DT_RowIndex=e,St(t,c),l=0,s=t.aoColumns.length;l<s;l++){i=t.aoColumns[l],(o=(u=!n||!a[l])?_.createElement(i.sCellType):a[l])||$(t,0,"Incorrect column count",18),o._DT_CellIndex={row:e,column:l},f.push(o);var p=Dt(t,e);!u&&(!i.mRender&&i.mData===l||H.isPlainObject(i.mData)&&i.mData._===l+".display")||ht(o,p[l]),y(o,i.sClass),i.bVisible&&u?r.appendChild(o):i.bVisible||u||o.parentNode.removeChild(o),i.fnCreatedCell&&i.fnCreatedCell.call(t.oInstance,o,q(t,e,l),d,e,l)}G(t,"aoRowCreatedCallback","row-created",[r,d,e,f])}else y(c.nTr,h)}function St(t,e){var n=e.nTr,a=e._aData;n&&((t=t.rowIdFn(a))&&(n.id=t),a.DT_RowClass&&(t=a.DT_RowClass.split(" "),e.__rowc=e.__rowc?x(e.__rowc.concat(t)):t,H(n).removeClass(e.__rowc.join(" ")).addClass(a.DT_RowClass)),a.DT_RowAttr&&H(n).attr(a.DT_RowAttr),a.DT_RowData)&&H(n).data(a.DT_RowData)}function wt(t,e){var n,a=t.oClasses,r=t.aoColumns,o="header"===e?t.nTHead:t.nTFoot,i="header"===e?"sTitle":e;if(o){if(("header"===e||m(t.aoColumns,i).join(""))&&1===(n=(n=H("tr",o)).length?n:H("<tr/>").appendTo(o)).length)for(var l=H("td, th",n).length,s=r.length;l<s;l++)H("<th/>").html(r[l][i]||"").appendTo(n);var u=At(t,o,!0);"header"===e?t.aoHeader=u:t.aoFooter=u,H(o).children("tr").attr("role","row"),H(o).children("tr").children("th, td").each(function(){ae(t,e)(t,H(this),a)})}}function Tt(t,e,n){var a,r,o,i,l,s=[],u=[],c=t.aoColumns,t=c.length;if(e){for(n=n||h(t).filter(function(t){return c[t].bVisible}),a=0;a<e.length;a++)s[a]=e[a].slice().filter(function(t,e){return n.includes(e)}),u.push([]);for(a=0;a<s.length;a++)for(r=0;r<s[a].length;r++)if(l=i=1,void 0===u[a][r]){for(o=s[a][r].cell;void 0!==s[a+i]&&s[a][r].cell==s[a+i][r].cell;)u[a+i][r]=null,i++;for(;void 0!==s[a][r+l]&&s[a][r].cell==s[a][r+l].cell;){for(var d=0;d<i;d++)u[a+d][r+l]=null;l++}var f=H("span.dt-column-title",o);u[a][r]={cell:o,colspan:l,rowspan:i,title:(f.length?f:H(o)).html()}}return u}}function _t(t,e){for(var n,a,r=Tt(t,e),o=0;o<e.length;o++){if(n=e[o].row)for(;a=n.firstChild;)n.removeChild(a);for(var i=0;i<r[o].length;i++){var l=r[o][i];l&&H(l.cell).appendTo(n).attr("rowspan",l.rowspan).attr("colspan",l.colspan)}}}function S(t,e){if(r="ssp"==J(s=t),void 0!==(i=s.iInitDisplayStart)&&-1!==i&&(s._iDisplayStart=!r&&i>=s.fnRecordsDisplay()?0:i,s.iInitDisplayStart=-1),-1!==G(t,"aoPreDrawCallback","preDraw",[t]).indexOf(!1))w(t,!1);else{var l,n=[],a=0,r="ssp"==J(t),o=t.aiDisplay,i=t._iDisplayStart,s=t.fnDisplayEnd(),u=t.aoColumns,c=H(t.nTBody);if(t.bDrawing=!0,t.deferLoading)t.deferLoading=!1,t.iDraw++,w(t,!1);else if(r){if(!t.bDestroying&&!e)return 0===t.iDraw&&c.empty().append(Ct(t)),(l=t).iDraw++,w(l,!0),void Ft(l,function(e){function n(t,e){return"function"==typeof a[t][e]?"function":a[t][e]}var a=e.aoColumns,t=e.oFeatures,r=e.oPreviousSearch,o=e.aoPreSearchCols;return{draw:e.iDraw,columns:a.map(function(e,t){return{data:n(t,"mData"),name:e.sName,searchable:e.bSearchable,orderable:e.bSortable,search:{value:o[t].search,regex:o[t].regex,fixed:Object.keys(e.searchFixed).map(function(t){return{name:t,term:e.searchFixed[t].toString()}})}}}),order:Gt(e).map(function(t){return{column:t.col,dir:t.dir,name:n(t.col,"sName")}}),start:e._iDisplayStart,length:t.bPaginate?e._iDisplayLength:-1,search:{value:r.search,regex:r.regex,fixed:Object.keys(e.searchFixed).map(function(t){return{name:t,term:e.searchFixed[t].toString()}})}}}(l),function(t){var e=l,n=Nt(e,t=t),a=jt(e,"draw",t),r=jt(e,"recordsTotal",t),t=jt(e,"recordsFiltered",t);if(void 0!==a){if(+a<e.iDraw)return;e.iDraw=+a}n=n||[],mt(e),e._iRecordsTotal=parseInt(r,10),e._iRecordsDisplay=parseInt(t,10);for(var o=0,i=n.length;o<i;o++)D(e,n[o]);e.aiDisplay=e.aiDisplayMaster.slice(),S(e,!0),Ht(e),w(e,!1)})}else t.iDraw++;if(0!==o.length)for(var d=r?t.aoData.length:s,f=r?0:i;f<d;f++){for(var h=o[f],p=t.aoData[h],g=(null===p.nTr&&xt(t,h),p.nTr),v=0;v<u.length;v++){var m=u[v],b=p.anCells[v];y(b,C.type.className[m.sType]),y(b,t.oClasses.tbody.cell)}G(t,"aoRowCallback",null,[g,p._aData,a,f,h]),n.push(g),a++}else n[0]=Ct(t);G(t,"aoHeaderCallback","header",[H(t.nTHead).children("tr")[0],vt(t),i,s,o]),G(t,"aoFooterCallback","footer",[H(t.nTFoot).children("tr")[0],vt(t),i,s,o]),c[0].replaceChildren?c[0].replaceChildren.apply(c[0],n):(c.children().detach(),c.append(H(n))),H(t.nTableWrapper).toggleClass("dt-empty-footer",0===H("tr",t.nTFoot).length),G(t,"aoDrawCallback","draw",[t],!0),t.bSorted=!1,t.bFiltered=!1,t.bDrawing=!1}}function d(t,e,n){var a=t.oFeatures,r=a.bSort,a=a.bFilter;void 0!==n&&!0!==n||(st(t),r&&Jt(t),a?Rt(t,t.oPreviousSearch):t.aiDisplay=t.aiDisplayMaster.slice()),!0!==e&&(t._iDisplayStart=0),t._drawHold=e,S(t),t._drawHold=!1}function Ct(t){var e=t.oLanguage,n=e.sZeroRecords,a=J(t);return t.iDraw<1&&"ssp"===a||t.iDraw<=1&&"ajax"===a?n=e.sLoadingRecords:e.sEmptyTable&&0===t.fnRecordsTotal()&&(n=e.sEmptyTable),H("<tr/>").append(H("<td />",{colSpan:ot(t),class:t.oClasses.empty.row}).html(n))[0]}function Lt(t,e,r){var o=[];H.each(e,function(t,e){var n,a;null!==e&&(n=(t=t.match(/^([a-z]+)([0-9]*)([A-Za-z]*)$/))[2]?+t[2]:0,a=t[3]?t[3].toLowerCase():"full",t[1]===r)&&function t(e,n,a){if(Array.isArray(a))for(var r=0;r<a.length;r++)t(e,n,a[r]);else{var o=e[n];H.isPlainObject(a)?a.features?(a.rowId&&(e.id=a.rowId),a.rowClass&&(e.className=a.rowClass),o.id=a.id,o.className=a.className,t(e,n,a.features)):Object.keys(a).map(function(t){o.contents.push({feature:t,opts:a[t]})}):o.contents.push(a)}}(function(t,e,n){for(var a,r=0;r<t.length;r++)if((a=t[r]).rowNum===e&&("full"===n&&a.full||("start"===n||"end"===n)&&(a.start||a.end)))return a[n]||(a[n]={contents:[]}),a;return(a={rowNum:e})[n]={contents:[]},t.push(a),a}(o,n,a),a,e)}),o.sort(function(t,e){var n=t.rowNum,a=e.rowNum;return n===a?(t=t.full&&!e.full?-1:1,"bottom"===r?-1*t:t):a-n}),"bottom"===r&&o.reverse();for(var n=0;n<o.length;n++)delete o[n].rowNum,!function(o,i){function l(t,e){return C.features[t]||$(o,0,"Unknown feature: "+t),C.features[t].apply(this,[o,e])}function t(t){if(i[t])for(var e,n=i[t].contents,a=0,r=n.length;a<r;a++)n[a]&&("string"==typeof n[a]?n[a]=l(n[a],null):H.isPlainObject(n[a])?n[a]=l(n[a].feature,n[a].opts):"function"==typeof n[a].node?n[a]=n[a].node(o):"function"==typeof n[a]&&(e=n[a](o),n[a]="function"==typeof e.node?e.node():e))}t("start"),t("end"),t("full")}(t,o[n]);return o}function It(e){var a,t=e.oClasses,n=H(e.nTable),r=H("<div/>").attr({id:e.sTableId+"_wrapper",class:t.container}).insertBefore(n);if(e.nTableWrapper=r[0],e.sDom)for(var o,i,l,s,u,c,d=e,t=e.sDom,f=r,h=t.match(/(".*?")|('.*?')|./g),p=0;p<h.length;p++)o=null,"<"==(i=h[p])?(l=H("<div/>"),"'"!=(s=h[p+1])[0]&&'"'!=s[0]||(s=s.replace(/['"]/g,""),u="",-1!=s.indexOf(".")?(c=s.split("."),u=c[0],c=c[1]):"#"==s[0]?u=s:c=s,l.attr("id",u.substring(1)).addClass(c),p++),f.append(l),f=l):">"==i?f=f.parent():"t"==i?o=Bt(d):V.ext.feature.forEach(function(t){i==t.cFeature&&(o=t.fnInit(d))}),o&&f.append(o);else{var n=Lt(e,e.layout,"top"),t=Lt(e,e.layout,"bottom"),g=ae(e,"layout");n.forEach(function(t){g(e,r,t)}),g(e,r,{full:{table:!0,contents:[Bt(e)]}}),t.forEach(function(t){g(e,r,t)})}var n=e,t=n.nTable,v=""!==n.oScroll.sX||""!==n.oScroll.sY;n.oFeatures.bProcessing&&(a=H("<div/>",{id:n.sTableId+"_processing",class:n.oClasses.processing.container,role:"status"}).html(n.oLanguage.sProcessing).append("<div><div></div><div></div><div></div><div></div></div>"),v?a.prependTo(H("div.dt-scroll",n.nTableWrapper)):a.insertBefore(t),H(t).on("processing.dt.DT",function(t,e,n){a.css("display",n?"block":"none")}))}function At(t,e,n){for(var a,r,o,i,l,s,u=t.aoColumns,c=H(e).children("tr"),d=e&&"thead"===e.nodeName.toLowerCase(),f=[],h=0,p=c.length;h<p;h++)f.push([]);for(h=0,p=c.length;h<p;h++)for(r=(a=c[h]).firstChild;r;){if("TD"==r.nodeName.toUpperCase()||"TH"==r.nodeName.toUpperCase()){var g,v,m,b,y,D=[];for(b=(b=+r.getAttribute("colspan"))&&0!=b&&1!=b?b:1,y=(y=+r.getAttribute("rowspan"))&&0!=y&&1!=y?y:1,l=function(t,e,n){for(var a=t[e];a[n];)n++;return n}(f,h,0),s=1==b,n&&(s&&(et(t,l,H(r).data()),g=u[l],v=r.getAttribute("width")||null,(m=r.style.width.match(/width:\s*(\d+[pxem%]+)/))&&(v=m[1]),g.sWidthOrig=g.sWidth||v,d?(null===g.sTitle||g.autoTitle||(r.innerHTML=g.sTitle),!g.sTitle&&s&&(g.sTitle=L(r.innerHTML),g.autoTitle=!0)):g.footer&&(r.innerHTML=g.footer),g.ariaTitle||(g.ariaTitle=H(r).attr("aria-label")||g.sTitle),g.className)&&H(r).addClass(g.className),0===H("span.dt-column-title",r).length&&H("<span>").addClass("dt-column-title").append(r.childNodes).appendTo(r),d)&&0===H("span.dt-column-order",r).length&&H("<span>").addClass("dt-column-order").appendTo(r),i=0;i<b;i++){for(o=0;o<y;o++)f[h+o][l+i]={cell:r,unique:s},f[h+o].row=a;D.push(l+i)}r.setAttribute("data-dt-column",x(D).join(","))}r=r.nextSibling}return f}function Ft(n,t,a){function e(t){var e=n.jqXHR?n.jqXHR.status:null;if((null===t||"number"==typeof e&&204==e)&&Nt(n,t={},[]),(e=t.error||t.sError)&&$(n,0,e),t.d&&"string"==typeof t.d)try{t=JSON.parse(t.d)}catch(t){}n.json=t,G(n,null,"xhr",[n,t,n.jqXHR],!0),a(t)}var r,o=n.ajax,i=n.oInstance,l=(H.isPlainObject(o)&&o.data&&(l="function"==typeof(r=o.data)?r(t,n):r,t="function"==typeof r&&l?l:H.extend(!0,t,l),delete o.data),{url:"string"==typeof o?o:"",data:t,success:e,dataType:"json",cache:!1,type:n.sServerMethod,error:function(t,e){-1===G(n,null,"xhr",[n,null,n.jqXHR],!0).indexOf(!0)&&("parsererror"==e?$(n,0,"Invalid JSON response",1):4===t.readyState&&$(n,0,"Ajax error",7)),w(n,!1)}});H.isPlainObject(o)&&H.extend(l,o),n.oAjaxData=t,G(n,null,"preXhr",[n,t,l],!0),"function"==typeof o?n.jqXHR=o.call(i,t,e,n):""===o.url?(i={},V.util.set(o.dataSrc)(i,[]),e(i)):n.jqXHR=H.ajax(l),r&&(o.data=r)}function Nt(t,e,n){var a="data";if(H.isPlainObject(t.ajax)&&void 0!==t.ajax.dataSrc&&("string"==typeof(t=t.ajax.dataSrc)||"function"==typeof t?a=t:void 0!==t.data&&(a=t.data)),!n)return"data"===a?e.aaData||e[a]:""!==a?U(a)(e):e;v(a)(e,n)}function jt(t,e,n){var t=H.isPlainObject(t.ajax)?t.ajax.dataSrc:null;return t&&t[e]?U(t[e])(n):(t="","draw"===e?t="sEcho":"recordsTotal"===e?t="iTotalRecords":"recordsFiltered"===e&&(t="iTotalDisplayRecords"),void 0!==n[t]?n[t]:n[e])}function Rt(n,t){var e=n.aoPreSearchCols;if("ssp"!=J(n)){for(var a,r,o,i,l,s=n,u=s.aoColumns,c=s.aoData,d=0;d<c.length;d++)if(c[d]&&!(l=c[d])._aFilterData){for(o=[],a=0,r=u.length;a<r;a++)u[a].bSearchable?"string"!=typeof(i=null===(i=q(s,d,a,"filter"))?"":i)&&i.toString&&(i=i.toString()):i="",i.indexOf&&-1!==i.indexOf("&")&&(Et.innerHTML=i,i=kt?Et.textContent:Et.innerText),i.replace&&(i=i.replace(/[\r\n\u2028]/g,"")),o.push(i);l._aFilterData=o,l._sFilterRow=o.join("  "),0}n.aiDisplay=n.aiDisplayMaster.slice(),Ot(n.aiDisplay,n,t.search,t),H.each(n.searchFixed,function(t,e){Ot(n.aiDisplay,n,e,{})});for(var f=0;f<e.length;f++){var h=e[f];Ot(n.aiDisplay,n,h.search,h,f),H.each(n.aoColumns[f].searchFixed,function(t,e){Ot(n.aiDisplay,n,e,{},f)})}for(var p,g,v=n,m=V.ext.search,b=v.aiDisplay,y=0,D=m.length;y<D;y++){for(var x=[],S=0,w=b.length;S<w;S++)g=b[S],p=v.aoData[g],m[y](v,p._aFilterData,g,p._aData,S)&&x.push(g);b.length=0,b.push.apply(b,x)}}n.bFiltered=!0,G(n,null,"search",[n])}function Ot(t,e,n,a,r){if(""!==n){for(var o=0,i=[],l="function"==typeof n?n:null,s=n instanceof RegExp?n:l?null:function(t,e){var a=[],e=H.extend({},{boundary:!1,caseInsensitive:!0,exact:!1,regex:!1,smart:!0},e);"string"!=typeof t&&(t=t.toString());if(t=k(t),e.exact)return new RegExp("^"+Pt(t)+"$",e.caseInsensitive?"i":"");{var n,r,o;t=e.regex?t:Pt(t),e.smart&&(n=(t.match(/!?["\u201C][^"\u201D]+["\u201D]|[^ ]+/g)||[""]).map(function(t){var e,n=!1;return"!"===t.charAt(0)&&(n=!0,t=t.substring(1)),'"'===t.charAt(0)?t=(e=t.match(/^"(.*)"$/))?e[1]:t:"“"===t.charAt(0)&&(t=(e=t.match(/^\u201C(.*)\u201D$/))?e[1]:t),n&&(1<t.length&&a.push("(?!"+t+")"),t=""),t.replace(/"/g,"")}),r=a.length?a.join(""):"",o=e.boundary?"\\b":"",t="^(?=.*?"+o+n.join(")(?=.*?"+o)+")("+r+".)*$")}return new RegExp(t,e.caseInsensitive?"i":"")}(n,a),o=0;o<t.length;o++){var u=e.aoData[t[o]],c=void 0===r?u._sFilterRow:u._aFilterData[r];(l&&l(c,u._aData,t[o],r)||s&&s.test(c))&&i.push(t[o])}for(t.length=i.length,o=0;o<i.length;o++)t[o]=i[o]}}var Pt=V.util.escapeRegex,Et=H("<div>")[0],kt=void 0!==Et.textContent;function Mt(i){var l,e,n,t,s=i.oInit,u=i.deferLoading,c=J(i);i.bInitialised?(wt(i,"header"),wt(i,"footer"),n=function(){_t(i,i.aoHeader),_t(i,i.aoFooter);var n=i.iInitDisplayStart;if(s.aaData)for(l=0;l<s.aaData.length;l++)D(i,s.aaData[l]);else!u&&"dom"!=c||ft(i,H(i.nTBody).children("tr"));i.aiDisplay=i.aiDisplayMaster.slice(),It(i);var t=i,e=t.nTHead,a=e.querySelectorAll("tr"),r=t.bSortCellsTop,o=':not([data-dt-order="disable"]):not([data-dt-order="icon-only"])';!0===r?e=a[0]:!1===r&&(e=a[a.length-1]),$t(t,e,e===t.nTHead?"tr"+o+" th"+o+", tr"+o+" td"+o:"th"+o+", td"+o),Yt(t,r=[],t.aaSorting),t.aaSorting=r,Ut(i),w(i,!0),G(i,null,"preInit",[i],!0),d(i),"ssp"==c&&!u||("ajax"==c?Ft(i,{},function(t){var e=Nt(i,t);for(l=0;l<e.length;l++)D(i,e[l]);i.iInitDisplayStart=n,d(i),w(i,!1),Ht(i)}):(Ht(i),w(i,!1)))},(e=i).oFeatures.bStateSave?void 0!==(t=e.fnStateLoadCallback.call(e.oInstance,e,function(t){Kt(e,t,n)}))&&Kt(e,t,n):n()):setTimeout(function(){Mt(i)},200)}function Ht(t){var e;t._bInitComplete||(e=[t,t.json],t._bInitComplete=!0,nt(t),G(t,null,"plugin-init",e,!0),G(t,"aoInitComplete","init",e,!0))}function Wt(t,e){e=parseInt(e,10);t._iDisplayLength=e,ne(t),G(t,null,"length",[t,e])}function Xt(t,e,n){var a=t._iDisplayStart,r=t._iDisplayLength,o=t.fnRecordsDisplay();if(0===o||-1===r)a=0;else if("number"==typeof e)o<(a=e*r)&&(a=0);else if("first"==e)a=0;else if("previous"==e)(a=0<=r?a-r:0)<0&&(a=0);else if("next"==e)a+r<o&&(a+=r);else if("last"==e)a=Math.floor((o-1)/r)*r;else{if("ellipsis"===e)return;$(t,0,"Unknown paging action: "+e,5)}o=t._iDisplayStart!==a;t._iDisplayStart=a,G(t,null,o?"page":"page-nc",[t]),o&&n&&S(t)}function w(t,e){t.bDrawing&&!1===e||G(t,null,"processing",[t,e])}function Vt(t,e,n){e?(w(t,!0),setTimeout(function(){n(),w(t,!1)},0)):n()}function Bt(t){var e,n,a,r,o,i,l,s,u,c,d,f,h,p=H(t.nTable),g=t.oScroll;return""===g.sX&&""===g.sY?t.nTable:(e=g.sX,n=g.sY,a=t.oClasses.scrolling,o=(r=t.captionNode)?r._captionSide:null,u=H(p[0].cloneNode(!1)),i=H(p[0].cloneNode(!1)),c=function(t){return t?I(t):null},(l=p.children("tfoot")).length||(l=null),u=H(s="<div/>",{class:a.container}).append(H(s,{class:a.header.self}).css({overflow:"hidden",position:"relative",border:0,width:e?c(e):"100%"}).append(H(s,{class:a.header.inner}).css({"box-sizing":"content-box",width:g.sXInner||"100%"}).append(u.removeAttr("id").css("margin-left",0).append("top"===o?r:null).append(p.children("thead"))))).append(H(s,{class:a.body}).css({position:"relative",overflow:"auto",width:c(e)}).append(p)),l&&u.append(H(s,{class:a.footer.self}).css({overflow:"hidden",border:0,width:e?c(e):"100%"}).append(H(s,{class:a.footer.inner}).append(i.removeAttr("id").css("margin-left",0).append("bottom"===o?r:null).append(p.children("tfoot"))))),c=u.children(),d=c[0],f=c[1],h=l?c[2]:null,H(f).on("scroll.DT",function(){var t=this.scrollLeft;d.scrollLeft=t,l&&(h.scrollLeft=t)}),H("th, td",d).on("focus",function(){var t=d.scrollLeft;f.scrollLeft=t,l&&(f.scrollLeft=t)}),H(f).css("max-height",n),g.bCollapse||H(f).css("height",n),t.nScrollHead=d,t.nScrollBody=f,t.nScrollFoot=h,t.aoDrawCallback.push(qt),u[0])}function qt(e){var t=e.oScroll.iBarWidth,n=H(e.nScrollHead).children("div"),a=n.children("table"),r=e.nScrollBody,o=H(r),i=H(e.nScrollFoot).children("div"),l=i.children("table"),s=H(e.nTHead),u=H(e.nTable),c=e.nTFoot&&H("th, td",e.nTFoot).length?H(e.nTFoot):null,d=e.oBrowser,f=r.scrollHeight>r.clientHeight;if(e.scrollBarVis!==f&&void 0!==e.scrollBarVis)e.scrollBarVis=f,nt(e);else{if(e.scrollBarVis=f,u.children("thead, tfoot").remove(),(f=s.clone().prependTo(u)).find("th, td").removeAttr("tabindex"),f.find("[id]").removeAttr("id"),c&&(b=c.clone().prependTo(u)).find("[id]").removeAttr("id"),e.aiDisplay.length){for(var h=null,p=0;p<e.aiDisplay.length;p++){var g=e.aiDisplay[p],g=e.aoData[g].nTr;if(g){h=g;break}}if(h)for(var v=H(h).children("th, td").map(function(t){return{idx:at(e,t),width:H(this).outerWidth()}}),p=0;p<v.length;p++){var m=e.aoColumns[v[p].idx].colEl[0];m.style.width.replace("px","")!==v[p].width&&(m.style.width=v[p].width+"px")}}a.find("colgroup").remove(),a.append(e.colgroup.clone()),c&&(l.find("colgroup").remove(),l.append(e.colgroup.clone())),H("th, td",f).each(function(){H(this.childNodes).wrapAll('<div class="dt-scroll-sizing">')}),c&&H("th, td",b).each(function(){H(this.childNodes).wrapAll('<div class="dt-scroll-sizing">')});var s=Math.floor(u.height())>r.clientHeight||"scroll"==o.css("overflow-y"),f="padding"+(d.bScrollbarLeft?"Left":"Right"),b=u.outerWidth();a.css("width",I(b)),n.css("width",I(b)).css(f,s?t+"px":"0px"),c&&(l.css("width",I(b)),i.css("width",I(b)).css(f,s?t+"px":"0px")),u.children("colgroup").prependTo(u),o.trigger("scroll"),!e.bSorted&&!e.bFiltered||e._drawHold||(r.scrollTop=0)}}function I(t){return null===t?"0px":"number"==typeof t?t<0?"0px":t+"px":t.match(/\d$/)?t+"px":t}function Ut(t){var e=t.aoColumns;for(t.colgroup.empty(),a=0;a<e.length;a++)e[a].bVisible&&t.colgroup.append(e[a].colEl)}function $t(o,t,e,i,l){ee(t,e,function(t){var e=!1,n=void 0===i?dt(t.target):[i];if(n.length){for(var a=0,r=n.length;a<r;a++)if(!1!==function(t,e,n,a){function r(t,e){var n=t._idx;return(n=void 0===n?s.indexOf(t[1]):n)+1<s.length?n+1:e?null:0}var o,i=t.aoColumns[e],l=t.aaSorting,s=i.asSorting;if(!i.bSortable)return!1;"number"==typeof l[0]&&(l=t.aaSorting=[l]);(a||n)&&t.oFeatures.bSortMulti?-1!==(i=m(l,"0").indexOf(e))?null===(o=null===(o=r(l[i],!0))&&1===l.length?0:o)?l.splice(i,1):(l[i][1]=s[o],l[i]._idx=o):(a?l.push([e,s[0],0]):l.push([e,l[0][1],0]),l[l.length-1]._idx=0):l.length&&l[0][0]==e?(o=r(l[0]),l.length=1,l[0][1]=s[o],l[0]._idx=o):(l.length=0,l.push([e,s[0]]),l[0]._idx=0)}(o,n[a],a,t.shiftKey)&&(e=!0),1===o.aaSorting.length&&""===o.aaSorting[0][1])break;e&&Vt(o,!0,function(){Jt(o),zt(o,o.aiDisplay),d(o,!1,!1),l&&l()})}})}function zt(t,e){if(!(e.length<2)){for(var n=t.aiDisplayMaster,a={},r={},o=0;o<n.length;o++)a[n[o]]=o;for(o=0;o<e.length;o++)r[e[o]]=a[e[o]];e.sort(function(t,e){return r[t]-r[e]})}}function Yt(n,a,t){function e(t){var e;H.isPlainObject(t)?void 0!==t.idx?a.push([t.idx,t.dir]):t.name&&-1!==(e=m(n.aoColumns,"sName").indexOf(t.name))&&a.push([e,t.dir]):a.push(t)}if(H.isPlainObject(t))e(t);else if(t.length&&"number"==typeof t[0])e(t);else if(t.length)for(var r=0;r<t.length;r++)e(t[r])}function Gt(t){var e,n,a,r,o,i,l,s=[],u=V.ext.type.order,c=t.aoColumns,d=t.aaSortingFixed,f=H.isPlainObject(d),h=[];if(t.oFeatures.bSort)for(Array.isArray(d)&&Yt(t,h,d),f&&d.pre&&Yt(t,h,d.pre),Yt(t,h,t.aaSorting),f&&d.post&&Yt(t,h,d.post),e=0;e<h.length;e++)if(c[l=h[e][0]])for(n=0,a=(r=c[l].aDataSort).length;n<a;n++)i=c[o=r[n]].sType||"string",void 0===h[e]._idx&&(h[e]._idx=c[o].asSorting.indexOf(h[e][1])),h[e][1]&&s.push({src:l,col:o,dir:h[e][1],index:h[e]._idx,type:i,formatter:u[i+"-pre"],sorter:u[i+"-"+h[e][1]]});return s}function Jt(t,e,n){var a,r,o,i,l,c,d=[],s=V.ext.type.order,f=t.aoData,u=t.aiDisplayMaster;for(void 0!==e?(l=t.aoColumns[e],c=[{src:e,col:e,dir:n,index:0,type:l.sType,formatter:s[l.sType+"-pre"],sorter:s[l.sType+"-"+n]}],u=u.slice()):c=Gt(t),a=0,r=c.length;a<r;a++){i=c[a],S=x=D=g=p=h=y=b=m=v=void 0;var h,p,g,v=t,m=i.col,b=v.aoColumns[m],y=V.ext.order[b.sSortDataType];y&&(h=y.call(v.oInstance,v,m,rt(v,m)));for(var D=V.ext.type.order[b.sType+"-pre"],x=v.aoData,S=0;S<x.length;S++)x[S]&&((p=x[S])._aSortData||(p._aSortData=[]),p._aSortData[m]&&!y||(g=y?h[S]:q(v,S,m,"sort"),p._aSortData[m]=D?D(g,v):g))}if("ssp"!=J(t)&&0!==c.length){for(a=0,o=u.length;a<o;a++)d[a]=a;c.length&&"desc"===c[0].dir&&t.orderDescReverse&&d.reverse(),u.sort(function(t,e){for(var n,a,r,o,i=c.length,l=f[t]._aSortData,s=f[e]._aSortData,u=0;u<i;u++)if(n=l[(o=c[u]).col],a=s[o.col],o.sorter){if(0!==(r=o.sorter(n,a)))return r}else if(0!==(r=n<a?-1:a<n?1:0))return"asc"===o.dir?r:-r;return(n=d[t])<(a=d[e])?-1:a<n?1:0})}else 0===c.length&&u.sort(function(t,e){return t<e?-1:e<t?1:0});return void 0===e&&(t.bSorted=!0,t.sortDetails=c,G(t,null,"order",[t,c])),u}function Zt(t){var e,n,a,r=t.aLastSort,o=t.oClasses.order.position,i=Gt(t),l=t.oFeatures;if(l.bSort&&l.bSortClasses){for(e=0,n=r.length;e<n;e++)a=r[e].src,H(m(t.aoData,"anCells",a)).removeClass(o+(e<2?e+1:3));for(e=0,n=i.length;e<n;e++)a=i[e].src,H(m(t.aoData,"anCells",a)).addClass(o+(e<2?e+1:3))}t.aLastSort=i}function Qt(n){var t;n._bLoadingState||(t={time:+new Date,start:n._iDisplayStart,length:n._iDisplayLength,order:H.extend(!0,[],n.aaSorting),search:H.extend({},n.oPreviousSearch),columns:n.aoColumns.map(function(t,e){return{visible:t.bVisible,search:H.extend({},n.aoPreSearchCols[e])}})},n.oSavedState=t,G(n,"aoStateSaveParams","stateSaveParams",[n,t]),n.oFeatures.bStateSave&&!n.bDestroying&&n.fnStateSaveCallback.call(n.oInstance,n,t))}function Kt(n,t,e){var a,r,o=n.aoColumns,i=(n._bLoadingState=!0,n._bInitComplete?new V.Api(n):null);if(t&&t.time){var l=n.iStateDuration;if(0<l&&t.time<+new Date-1e3*l)n._bLoadingState=!1;else if(-1!==G(n,"aoStateLoadParams","stateLoadParams",[n,t]).indexOf(!1))n._bLoadingState=!1;else if(t.columns&&o.length!==t.columns.length)n._bLoadingState=!1;else{if(n.oLoadedState=H.extend(!0,{},t),G(n,null,"stateLoadInit",[n,t],!0),void 0!==t.length&&(i?i.page.len(t.length):n._iDisplayLength=t.length),void 0!==t.start&&(null===i?(n._iDisplayStart=t.start,n.iInitDisplayStart=t.start):Xt(n,t.start/n._iDisplayLength)),void 0!==t.order&&(n.aaSorting=[],H.each(t.order,function(t,e){n.aaSorting.push(e[0]>=o.length?[0,e[1]]:e)})),void 0!==t.search&&H.extend(n.oPreviousSearch,t.search),t.columns){for(a=0,r=t.columns.length;a<r;a++){var s=t.columns[a];void 0!==s.visible&&(i?i.column(a).visible(s.visible,!1):o[a].bVisible=s.visible),void 0!==s.search&&H.extend(n.aoPreSearchCols[a],s.search)}i&&i.columns.adjust()}n._bLoadingState=!1,G(n,"aoStateLoaded","stateLoaded",[n,t])}}else n._bLoadingState=!1;e()}function $(t,e,n,a){if(n="DataTables warning: "+(t?"table id="+t.sTableId+" - ":"")+n,a&&(n+=". For more information about this error, please see https://datatables.net/tn/"+a),e)W.console&&console.log&&console.log(n);else{e=V.ext,e=e.sErrMode||e.errMode;if(t&&G(t,null,"dt-error",[t,a,n],!0),"alert"==e)alert(n);else{if("throw"==e)throw new Error(n);"function"==typeof e&&e(t,a,n)}}}function z(n,a,t,e){Array.isArray(t)?H.each(t,function(t,e){Array.isArray(e)?z(n,a,e[0],e[1]):z(n,a,e)}):(void 0===e&&(e=t),void 0!==a[t]&&(n[e]=a[t]))}function te(t,e,n){var a,r;for(r in e)Object.prototype.hasOwnProperty.call(e,r)&&(a=e[r],H.isPlainObject(a)?(H.isPlainObject(t[r])||(t[r]={}),H.extend(!0,t[r],a)):n&&"data"!==r&&"aaData"!==r&&Array.isArray(a)?t[r]=a.slice():t[r]=a);return t}function ee(t,e,n){H(t).on("click.DT",e,function(t){n(t)}).on("keypress.DT",e,function(t){13===t.which&&(t.preventDefault(),n(t))}).on("selectstart.DT",e,function(){return!1})}function Y(t,e,n){n&&t[e].push(n)}function G(e,t,n,a,r){var o=[];return t&&(o=e[t].slice().reverse().map(function(t){return t.apply(e.oInstance,a)})),null!==n&&(t=H.Event(n+".dt"),n=H(e.nTable),t.dt=e.api,n[r?"trigger":"triggerHandler"](t,a),r&&0===n.parents("body").length&&H("body").trigger(t,a),o.push(t.result)),o}function ne(t){var e=t._iDisplayStart,n=t.fnDisplayEnd(),a=t._iDisplayLength;n<=e&&(e=n-a),e-=e%a,t._iDisplayStart=e=-1===a||e<0?0:e}function ae(t,e){var t=t.renderer,n=V.ext.renderer[e];return H.isPlainObject(t)&&t[e]?n[t[e]]||n._:"string"==typeof t&&n[t]||n._}function J(t){return t.oFeatures.bServerSide?"ssp":t.ajax?"ajax":"dom"}function re(t,e,n){var a=t.fnFormatNumber,r=t._iDisplayStart+1,o=t._iDisplayLength,i=t.fnRecordsDisplay(),l=t.fnRecordsTotal(),s=-1===o;return e.replace(/_START_/g,a.call(t,r)).replace(/_END_/g,a.call(t,t.fnDisplayEnd())).replace(/_MAX_/g,a.call(t,l)).replace(/_TOTAL_/g,a.call(t,i)).replace(/_PAGE_/g,a.call(t,s?1:Math.ceil(r/o))).replace(/_PAGES_/g,a.call(t,s?1:Math.ceil(i/o))).replace(/_ENTRIES_/g,t.api.i18n("entries","",n)).replace(/_ENTRIES-MAX_/g,t.api.i18n("entries","",l)).replace(/_ENTRIES-TOTAL_/g,t.api.i18n("entries","",i))}var oe=[],n=Array.prototype;X=function(t,e){if(!(this instanceof X))return new X(t,e);function n(t){t=t,e=V.settings,a=m(e,"nTable");var n,e,a,r=t?t.nTable&&t.oFeatures?[t]:t.nodeName&&"table"===t.nodeName.toLowerCase()?-1!==(r=a.indexOf(t))?[e[r]]:null:t&&"function"==typeof t.settings?t.settings().toArray():("string"==typeof t?n=H(t).get():t instanceof H&&(n=t.get()),n?e.filter(function(t,e){return n.includes(a[e])}):void 0):[];r&&o.push.apply(o,r)}var a,o=[];if(Array.isArray(t))for(a=0;a<t.length;a++)n(t[a]);else n(t);if(this.context=1<o.length?x(o):o,e)if(e.length<1e4)this.push.apply(this,e);else for(a=0;a<e.length;a++)this.push(e[a]);this.selector={rows:null,cols:null,opts:null},X.extend(this,this,oe)},V.Api=X,H.extend(X.prototype,{any:function(){return 0!==this.count()},context:[],count:function(){return this.flatten().length},each:function(t){for(var e=0,n=this.length;e<n;e++)t.call(this,this[e],e,this);return this},eq:function(t){var e=this.context;return e.length>t?new X(e[t],this[t]):null},filter:function(t){t=n.filter.call(this,t,this);return new X(this.context,t)},flatten:function(){var t=[];return new X(this.context,t.concat.apply(t,this.toArray()))},get:function(t){return this[t]},join:n.join,includes:function(t){return-1!==this.indexOf(t)},indexOf:n.indexOf,iterator:function(t,e,n,a){var r,o,i,l,s,u,c,d,f=[],h=this.context,p=this.selector;for("string"==typeof t&&(a=n,n=e,e=t,t=!1),o=0,i=h.length;o<i;o++){var g=new X(h[o]);if("table"===e)void 0!==(r=n.call(g,h[o],o))&&f.push(r);else if("columns"===e||"rows"===e)void 0!==(r=n.call(g,h[o],this[o],o))&&f.push(r);else if("every"===e||"column"===e||"column-rows"===e||"row"===e||"cell"===e)for(c=this[o],"column-rows"===e&&(u=ve(h[o],p.opts)),l=0,s=c.length;l<s;l++)d=c[l],void 0!==(r="cell"===e?n.call(g,h[o],d.row,d.column,o,l):n.call(g,h[o],d,o,l,u))&&f.push(r)}return f.length||a?((t=(a=new X(h,t?f.concat.apply([],f):f)).selector).rows=p.rows,t.cols=p.cols,t.opts=p.opts,a):this},lastIndexOf:n.lastIndexOf,length:0,map:function(t){t=n.map.call(this,t,this);return new X(this.context,t)},pluck:function(t){var e=V.util.get(t);return this.map(function(t){return e(t)})},pop:n.pop,push:n.push,reduce:n.reduce,reduceRight:n.reduceRight,reverse:n.reverse,selector:null,shift:n.shift,slice:function(){return new X(this.context,this)},sort:n.sort,splice:n.splice,toArray:function(){return n.slice.call(this)},to$:function(){return H(this)},toJQuery:function(){return H(this)},unique:function(){return new X(this.context,x(this.toArray()))},unshift:n.unshift}),W.__apiStruct=oe,X.extend=function(t,e,n){if(n.length&&e&&(e instanceof X||e.__dt_wrapper))for(var a,r=0,o=n.length;r<o;r++)"__proto__"!==(a=n[r]).name&&(e[a.name]="function"===a.type?function(e,n,a){return function(){var t=n.apply(e||this,arguments);return X.extend(t,t,a.methodExt),t}}(t,a.val,a):"object"===a.type?{}:a.val,e[a.name].__dt_wrapper=!0,X.extend(t,e[a.name],a.propExt))},X.register=e=function(t,e){if(Array.isArray(t))for(var n=0,a=t.length;n<a;n++)X.register(t[n],e);else for(var r=t.split("."),o=oe,i=0,l=r.length;i<l;i++){var s,u,c=function(t,e){for(var n=0,a=t.length;n<a;n++)if(t[n].name===e)return t[n];return null}(o,u=(s=-1!==r[i].indexOf("()"))?r[i].replace("()",""):r[i]);c||o.push(c={name:u,val:{},methodExt:[],propExt:[],type:"object"}),i===l-1?(c.val=e,c.type="function"==typeof e?"function":H.isPlainObject(e)?"object":"other"):o=s?c.methodExt:c.propExt}},X.registerPlural=t=function(t,e,n){X.register(t,n),X.register(e,function(){var t=n.apply(this,arguments);return t===this?this:t instanceof X?t.length?Array.isArray(t[0])?new X(t.context,t[0]):t[0]:void 0:t})};function ie(t,e){var n,a;return Array.isArray(t)?(n=[],t.forEach(function(t){t=ie(t,e);n.push.apply(n,t)}),n.filter(function(t){return t})):"number"==typeof t?[e[t]]:(a=e.map(function(t){return t.nTable}),H(a).filter(t).map(function(){var t=a.indexOf(this);return e[t]}).toArray())}function le(r,o,t){var e,n;t&&(e=new X(r)).one("draw",function(){t(e.ajax.json())}),"ssp"==J(r)?d(r,o):(w(r,!0),(n=r.jqXHR)&&4!==n.readyState&&n.abort(),Ft(r,{},function(t){mt(r);for(var e=Nt(r,t),n=0,a=e.length;n<a;n++)D(r,e[n]);d(r,o),Ht(r),w(r,!1)}))}function se(t,e,n,a,r){for(var o,i,l,s,u=[],c=typeof e,d=0,f=(e=e&&"string"!=c&&"function"!=c&&void 0!==e.length?e:[e]).length;d<f;d++)for(l=0,s=(i=e[d]&&e[d].split&&!e[d].match(/[[(:]/)?e[d].split(","):[e[d]]).length;l<s;l++)(o=(o=n("string"==typeof i[l]?i[l].trim():i[l])).filter(function(t){return null!=t}))&&o.length&&(u=u.concat(o));var h=C.selector[t];if(h.length)for(d=0,f=h.length;d<f;d++)u=h[d](a,r,u);return x(u)}function ue(t){return(t=t||{}).filter&&void 0===t.search&&(t.search=t.filter),H.extend({search:"none",order:"current",page:"all"},t)}function ce(t){var e=new X(t.context[0]);return t.length&&e.push(t[0]),e.selector=t.selector,e.length&&1<e[0].length&&e[0].splice(1),e}e("tables()",function(t){return null!=t?new X(ie(t,this.context)):this}),e("table()",function(t){var t=this.tables(t),e=t.context;return e.length?new X(e[0]):t}),[["nodes","node","nTable"],["body","body","nTBody"],["header","header","nTHead"],["footer","footer","nTFoot"]].forEach(function(e){t("tables()."+e[0]+"()","table()."+e[1]+"()",function(){return this.iterator("table",function(t){return t[e[2]]},1)})}),[["header","aoHeader"],["footer","aoFooter"]].forEach(function(n){e("table()."+n[0]+".structure()",function(t){var t=this.columns(t).indexes().flatten(),e=this.context[0];return Tt(e,e[n[1]],t)})}),t("tables().containers()","table().container()",function(){return this.iterator("table",function(t){return t.nTableWrapper},1)}),e("tables().every()",function(n){var a=this;return this.iterator("table",function(t,e){n.call(a.table(e),e)})}),e("caption()",function(r,o){var t,e=this.context;return void 0===r?(t=e[0].captionNode)&&e.length?t.innerHTML:null:this.iterator("table",function(t){var e=H(t.nTable),n=H(t.captionNode),a=H(t.nTableWrapper);n.length||(n=H("<caption/>").html(r),t.captionNode=n[0],o)||(e.prepend(n),o=n.css("caption-side")),n.html(r),o&&(n.css("caption-side",o),n[0]._captionSide=o),(a.find("div.dataTables_scroll").length?(t="top"===o?"Head":"Foot",a.find("div.dataTables_scroll"+t+" table")):e).prepend(n)},1)}),e("caption.node()",function(){var t=this.context;return t.length?t[0].captionNode:null}),e("draw()",function(e){return this.iterator("table",function(t){"page"===e?S(t):d(t,!1===(e="string"==typeof e?"full-hold"!==e:e))})}),e("page()",function(e){return void 0===e?this.page.info().page:this.iterator("table",function(t){Xt(t,e)})}),e("page.info()",function(){var t,e,n,a,r;if(0!==this.context.length)return e=(t=this.context[0])._iDisplayStart,n=t.oFeatures.bPaginate?t._iDisplayLength:-1,a=t.fnRecordsDisplay(),{page:(r=-1===n)?0:Math.floor(e/n),pages:r?1:Math.ceil(a/n),start:e,end:t.fnDisplayEnd(),length:n,recordsTotal:t.fnRecordsTotal(),recordsDisplay:a,serverSide:"ssp"===J(t)}}),e("page.len()",function(e){return void 0===e?0!==this.context.length?this.context[0]._iDisplayLength:void 0:this.iterator("table",function(t){Wt(t,e)})}),e("ajax.json()",function(){var t=this.context;if(0<t.length)return t[0].json}),e("ajax.params()",function(){var t=this.context;if(0<t.length)return t[0].oAjaxData}),e("ajax.reload()",function(e,n){return this.iterator("table",function(t){le(t,!1===n,e)})}),e("ajax.url()",function(e){var t=this.context;return void 0===e?0===t.length?void 0:(t=t[0],H.isPlainObject(t.ajax)?t.ajax.url:t.ajax):this.iterator("table",function(t){H.isPlainObject(t.ajax)?t.ajax.url=e:t.ajax=e})}),e("ajax.url().load()",function(e,n){return this.iterator("table",function(t){le(t,!1===n,e)})});function de(o,i,t,e){function l(t,e){var n;if(Array.isArray(t)||t instanceof H)for(var a=0,r=t.length;a<r;a++)l(t[a],e);else t.nodeName&&"tr"===t.nodeName.toLowerCase()?(t.setAttribute("data-dt-row",i.idx),s.push(t)):(n=H("<tr><td></td></tr>").attr("data-dt-row",i.idx).addClass(e),H("td",n).addClass(e).html(t)[0].colSpan=ot(o),s.push(n[0]))}var s=[];l(t,e),i._details&&i._details.detach(),i._details=H(s),i._detailsShow&&i._details.insertAfter(i.nTr)}function fe(t,e){var n=t.context;if(n.length&&t.length){var a=n[0].aoData[t[0]];if(a._details){(a._detailsShow=e)?(a._details.insertAfter(a.nTr),H(a.nTr).addClass("dt-hasChild")):(a._details.detach(),H(a.nTr).removeClass("dt-hasChild")),G(n[0],null,"childRow",[e,t.row(t[0])]);var i=n[0],r=new X(i),a=".dt.DT_details",e="draw"+a,t="column-sizing"+a,a="destroy"+a,l=i.aoData;if(r.off(e+" "+t+" "+a),m(l,"_details").length>0){r.on(e,function(t,e){if(i!==e)return;r.rows({page:"current"}).eq(0).each(function(t){var e=l[t];if(e._detailsShow)e._details.insertAfter(e.nTr)})});r.on(t,function(t,e){if(i!==e)return;var n,a=ot(e);for(var r=0,o=l.length;r<o;r++){n=l[r];if(n&&n._details)n._details.each(function(){var t=H(this).children("td");if(t.length==1)t.attr("colspan",a)})}});r.on(a,function(t,e){if(i!==e)return;for(var n=0,a=l.length;n<a;n++)if(l[n]&&l[n]._details)ye(r,n)})}be(n)}}}function he(t,e,n,a,r,o){for(var i=[],l=0,s=r.length;l<s;l++)i.push(q(t,r[l],e,o));return i}function pe(t,e,n){var a=t.aoHeader;return a[void 0!==n?n:t.bSortCellsTop?0:a.length-1][e].cell}function ge(e,n){return function(t){return T(t)||"string"!=typeof t||(t=t.replace(F," "),e&&(t=L(t)),n&&(t=k(t,!1))),t}}var ve=function(t,e){var n,a=[],r=t.aiDisplay,o=t.aiDisplayMaster,i=e.search,l=e.order,e=e.page;if("ssp"==J(t))return"removed"===i?[]:h(0,o.length);if("current"==e)for(u=t._iDisplayStart,c=t.fnDisplayEnd();u<c;u++)a.push(r[u]);else if("current"==l||"applied"==l){if("none"==i)a=o.slice();else if("applied"==i)a=r.slice();else if("removed"==i){for(var s={},u=0,c=r.length;u<c;u++)s[r[u]]=null;o.forEach(function(t){Object.prototype.hasOwnProperty.call(s,t)||a.push(t)})}}else if("index"==l||"original"==l)for(u=0,c=t.aoData.length;u<c;u++)t.aoData[u]&&("none"==i||-1===(n=r.indexOf(u))&&"removed"==i||0<=n&&"applied"==i)&&a.push(u);else if("number"==typeof l){var d=Jt(t,l,"asc");if("none"===i)a=d;else for(u=0;u<d.length;u++)(-1===(n=r.indexOf(d[u]))&&"removed"==i||0<=n&&"applied"==i)&&a.push(d[u])}return a},me=(e("rows()",function(n,a){void 0===n?n="":H.isPlainObject(n)&&(a=n,n=""),a=ue(a);var t=this.iterator("table",function(t){return e=se("row",e=n,function(n){var t=f(n),a=r.aoData;if(null!==t&&!o)return[t];if(i=i||ve(r,o),null!==t&&-1!==i.indexOf(t))return[t];if(null==n||""===n)return i;if("function"==typeof n)return i.map(function(t){var e=a[t];return n(t,e._aData,e.nTr)?t:null});if(n.nodeName)return t=n._DT_RowIndex,e=n._DT_CellIndex,void 0!==t?a[t]&&a[t].nTr===n?[t]:[]:e?a[e.row]&&a[e.row].nTr===n.parentNode?[e.row]:[]:(t=H(n).closest("*[data-dt-row]")).length?[t.data("dt-row")]:[];if("string"==typeof n&&"#"===n.charAt(0)){var e=r.aIds[n.replace(/^#/,"")];if(void 0!==e)return[e.idx]}t=A(b(r.aoData,i,"nTr"));return H(t).filter(n).map(function(){return this._DT_RowIndex}).toArray()},r=t,o=a),"current"!==o.order&&"applied"!==o.order||zt(r,e),e;var r,e,o,i},1);return t.selector.rows=n,t.selector.opts=a,t}),e("rows().nodes()",function(){return this.iterator("row",function(t,e){return t.aoData[e].nTr||void 0},1)}),e("rows().data()",function(){return this.iterator(!0,"rows",function(t,e){return b(t.aoData,e,"_aData")},1)}),t("rows().cache()","row().cache()",function(n){return this.iterator("row",function(t,e){t=t.aoData[e];return"search"===n?t._aFilterData:t._aSortData},1)}),t("rows().invalidate()","row().invalidate()",function(n){return this.iterator("row",function(t,e){bt(t,e,n)})}),t("rows().indexes()","row().index()",function(){return this.iterator("row",function(t,e){return e},1)}),t("rows().ids()","row().id()",function(t){for(var e=[],n=this.context,a=0,r=n.length;a<r;a++)for(var o=0,i=this[a].length;o<i;o++){var l=n[a].rowIdFn(n[a].aoData[this[a][o]]._aData);e.push((!0===t?"#":"")+l)}return new X(n,e)}),t("rows().remove()","row().remove()",function(){return this.iterator("row",function(t,e){var n=t.aoData,a=n[e],r=t.aiDisplayMaster.indexOf(e),r=(-1!==r&&t.aiDisplayMaster.splice(r,1),0<t._iRecordsDisplay&&t._iRecordsDisplay--,ne(t),t.rowIdFn(a._aData));void 0!==r&&delete t.aIds[r],n[e]=null}),this}),e("rows.add()",function(o){var t=this.iterator("table",function(t){for(var e,n=[],a=0,r=o.length;a<r;a++)(e=o[a]).nodeName&&"TR"===e.nodeName.toUpperCase()?n.push(ft(t,e)[0]):n.push(D(t,e));return n},1),e=this.rows(-1);return e.pop(),e.push.apply(e,t),e}),e("row()",function(t,e){return ce(this.rows(t,e))}),e("row().data()",function(t){var e,n=this.context;return void 0===t?n.length&&this.length&&this[0].length?n[0].aoData[this[0]]._aData:void 0:((e=n[0].aoData[this[0]])._aData=t,Array.isArray(t)&&e.nTr&&e.nTr.id&&v(n[0].rowId)(t,e.nTr.id),bt(n[0],this[0],"data"),this)}),e("row().node()",function(){var t=this.context;if(t.length&&this.length&&this[0].length){t=t[0].aoData[this[0]];if(t&&t.nTr)return t.nTr}return null}),e("row.add()",function(e){e instanceof H&&e.length&&(e=e[0]);var t=this.iterator("table",function(t){return e.nodeName&&"TR"===e.nodeName.toUpperCase()?ft(t,e)[0]:D(t,e)});return this.row(t[0])}),H(_).on("plugin-init.dt",function(t,e){var a=new X(e);a.on("stateSaveParams.DT",function(t,e,n){for(var a=e.rowIdFn,r=e.aiDisplayMaster,o=[],i=0;i<r.length;i++){var l=r[i],l=e.aoData[l];l._detailsShow&&o.push("#"+a(l._aData))}n.childRows=o}),a.on("stateLoaded.DT",function(t,e,n){me(a,n)}),me(a,a.state.loaded())}),function(t,e){e&&e.childRows&&t.rows(e.childRows.map(function(t){return t.replace(/([^:\\]*(?:\\.[^:\\]*)*):/g,"$1\\:")})).every(function(){G(t.settings()[0],null,"requestChild",[this])})}),be=V.util.throttle(function(t){Qt(t[0])},500),ye=function(t,e){var n=t.context;n.length&&(e=n[0].aoData[void 0!==e?e:t[0]])&&e._details&&(e._details.remove(),e._detailsShow=void 0,e._details=void 0,H(e.nTr).removeClass("dt-hasChild"),be(n))},De="row().child",xe=De+"()",Se=(e(xe,function(t,e){var n=this.context;return void 0===t?n.length&&this.length&&n[0].aoData[this[0]]?n[0].aoData[this[0]]._details:void 0:(!0===t?this.child.show():!1===t?ye(this):n.length&&this.length&&de(n[0],n[0].aoData[this[0]],t,e),this)}),e([De+".show()",xe+".show()"],function(){return fe(this,!0),this}),e([De+".hide()",xe+".hide()"],function(){return fe(this,!1),this}),e([De+".remove()",xe+".remove()"],function(){return ye(this),this}),e(De+".isShown()",function(){var t=this.context;return t.length&&this.length&&t[0].aoData[this[0]]&&t[0].aoData[this[0]]._detailsShow||!1}),/^([^:]+)?:(name|title|visIdx|visible)$/),xe=(e("columns()",function(n,a){void 0===n?n="":H.isPlainObject(n)&&(a=n,n=""),a=ue(a);var t=this.iterator("table",function(t){return e=n,l=a,s=(i=t).aoColumns,u=m(s,"sName"),c=m(s,"sTitle"),t=V.util.get("[].[].cell")(i.aoHeader),d=x(M([],t)),se("column",e,function(n){var a,t=f(n);if(""===n)return h(s.length);if(null!==t)return[0<=t?t:s.length+t];if("function"==typeof n)return a=ve(i,l),s.map(function(t,e){return n(e,he(i,e,0,0,a),pe(i,e))?e:null});var e,r,o="string"==typeof n?n.match(Se):"";if(o)switch(o[2]){case"visIdx":case"visible":return o[1]&&o[1].match(/^\d+$/)?(e=parseInt(o[1],10))<0?[(r=s.map(function(t,e){return t.bVisible?e:null}))[r.length+e]]:[at(i,e)]:s.map(function(t,e){return t.bVisible&&(!o[1]||0<H(d[e]).filter(o[1]).length)?e:null});case"name":return u.map(function(t,e){return t===o[1]?e:null});case"title":return c.map(function(t,e){return t===o[1]?e:null});default:return[]}return n.nodeName&&n._DT_CellIndex?[n._DT_CellIndex.column]:(t=H(d).filter(n).map(function(){return dt(this)}).toArray()).length||!n.nodeName?t:(t=H(n).closest("*[data-dt-column]")).length?[t.data("dt-column")]:[]},i,l);var i,e,l,s,u,c,d},1);return t.selector.cols=n,t.selector.opts=a,t}),t("columns().header()","column().header()",function(n){return this.iterator("column",function(t,e){return pe(t,e,n)},1)}),t("columns().footer()","column().footer()",function(n){return this.iterator("column",function(t,e){return t.aoFooter.length?t.aoFooter[void 0!==n?n:0][e].cell:null},1)}),t("columns().data()","column().data()",function(){return this.iterator("column-rows",he,1)}),t("columns().render()","column().render()",function(o){return this.iterator("column-rows",function(t,e,n,a,r){return he(t,e,0,0,r,o)},1)}),t("columns().dataSrc()","column().dataSrc()",function(){return this.iterator("column",function(t,e){return t.aoColumns[e].mData},1)}),t("columns().cache()","column().cache()",function(o){return this.iterator("column-rows",function(t,e,n,a,r){return b(t.aoData,r,"search"===o?"_aFilterData":"_aSortData",e)},1)}),t("columns().init()","column().init()",function(){return this.iterator("column",function(t,e){return t.aoColumns[e]},1)}),t("columns().nodes()","column().nodes()",function(){return this.iterator("column-rows",function(t,e,n,a,r){return b(t.aoData,r,"anCells",e)},1)}),t("columns().titles()","column().title()",function(n,a){return this.iterator("column",function(t,e){"number"==typeof n&&(a=n,n=void 0);e=H("span.dt-column-title",this.column(e).header(a));return void 0!==n?(e.html(n),this):e.html()},1)}),t("columns().types()","column().type()",function(){return this.iterator("column",function(t,e){e=t.aoColumns[e].sType;return e||st(t),e},1)}),t("columns().visible()","column().visible()",function(n,a){var e=this,r=[],t=this.iterator("column",function(t,e){if(void 0===n)return t.aoColumns[e].bVisible;!function(t,e,n){var a,r,o=t.aoColumns,i=o[e],l=t.aoData;if(void 0===n)return i.bVisible;if(i.bVisible===n)return!1;if(n)for(var s=m(o,"bVisible").indexOf(!0,e+1),u=0,c=l.length;u<c;u++)l[u]&&(r=l[u].nTr,a=l[u].anCells,r)&&r.insertBefore(a[e],a[s]||null);else H(m(t.aoData,"anCells",e)).detach();return i.bVisible=n,Ut(t),!0}(t,e,n)||r.push(e)});return void 0!==n&&this.iterator("table",function(t){_t(t,t.aoHeader),_t(t,t.aoFooter),t.aiDisplay.length||H(t.nTBody).find("td[colspan]").attr("colspan",ot(t)),Qt(t),e.iterator("column",function(t,e){r.includes(e)&&G(t,null,"column-visibility",[t,e,n,a])}),r.length&&(void 0===a||a)&&e.columns.adjust()}),t}),t("columns().widths()","column().width()",function(){var t=this.columns(":visible").count(),t=H("<tr>").html("<td>"+Array(t).join("</td><td>")+"</td>"),n=(H(this.table().body()).append(t),t.children().map(function(){return H(this).outerWidth()}));return t.remove(),this.iterator("column",function(t,e){t=rt(t,e);return null!==t?n[t]:0},1)}),t("columns().indexes()","column().index()",function(n){return this.iterator("column",function(t,e){return"visible"===n?rt(t,e):e},1)}),e("columns.adjust()",function(){return this.iterator("table",function(t){nt(t)},1)}),e("column.index()",function(t,e){var n;if(0!==this.context.length)return n=this.context[0],"fromVisible"===t||"toData"===t?at(n,e):"fromData"===t||"toVisible"===t?rt(n,e):void 0}),e("column()",function(t,e){return ce(this.columns(t,e))}),e("cells()",function(g,t,v){var a,r,o,i,l,s,e;return H.isPlainObject(g)&&(void 0===g.row?(v=g,g=null):(v=t,t=null)),H.isPlainObject(t)&&(v=t,t=null),null==t?this.iterator("table",function(t){return a=t,t=g,e=ue(v),d=a.aoData,f=ve(a,e),n=A(b(d,f,"anCells")),h=H(M([],n)),p=a.aoColumns.length,se("cell",t,function(t){var e,n="function"==typeof t;if(null==t||n){for(o=[],i=0,l=f.length;i<l;i++)for(r=f[i],s=0;s<p;s++)u={row:r,column:s},(!n||(c=d[r],t(u,q(a,r,s),c.anCells?c.anCells[s]:null)))&&o.push(u);return o}return H.isPlainObject(t)?void 0!==t.column&&void 0!==t.row&&-1!==f.indexOf(t.row)?[t]:[]:(e=h.filter(t).map(function(t,e){return{row:e._DT_CellIndex.row,column:e._DT_CellIndex.column}}).toArray()).length||!t.nodeName?e:(c=H(t).closest("*[data-dt-row]")).length?[{row:c.data("dt-row"),column:c.data("dt-column")}]:[]},a,e);var a,e,r,o,i,l,s,u,c,d,f,n,h,p}):(e=v?{page:v.page,order:v.order,search:v.search}:{},a=this.columns(t,e),r=this.rows(g,e),e=this.iterator("table",function(t,e){var n=[];for(o=0,i=r[e].length;o<i;o++)for(l=0,s=a[e].length;l<s;l++)n.push({row:r[e][o],column:a[e][l]});return n},1),e=v&&v.selected?this.cells(e,v):e,H.extend(e.selector,{cols:t,rows:g,opts:v}),e)}),t("cells().nodes()","cell().node()",function(){return this.iterator("cell",function(t,e,n){t=t.aoData[e];return t&&t.anCells?t.anCells[n]:void 0},1)}),e("cells().data()",function(){return this.iterator("cell",function(t,e,n){return q(t,e,n)},1)}),t("cells().cache()","cell().cache()",function(a){return a="search"===a?"_aFilterData":"_aSortData",this.iterator("cell",function(t,e,n){return t.aoData[e][a][n]},1)}),t("cells().render()","cell().render()",function(a){return this.iterator("cell",function(t,e,n){return q(t,e,n,a)},1)}),t("cells().indexes()","cell().index()",function(){return this.iterator("cell",function(t,e,n){return{row:e,column:n,columnVisible:rt(t,n)}},1)}),t("cells().invalidate()","cell().invalidate()",function(a){return this.iterator("cell",function(t,e,n){bt(t,e,a,n)})}),e("cell()",function(t,e,n){return ce(this.cells(t,e,n))}),e("cell().data()",function(t){var e,n,a,r,o,i=this.context,l=this[0];return void 0===t?i.length&&l.length?q(i[0],l[0].row,l[0].column):void 0:(e=i[0],n=l[0].row,a=l[0].column,r=e.aoColumns[a],o=e.aoData[n]._aData,r.fnSetData(o,t,{settings:e,row:n,col:a}),bt(i[0],l[0].row,"data",l[0].column),this)}),e("order()",function(e,t){var n=this.context,a=Array.prototype.slice.call(arguments);return void 0===e?0!==n.length?n[0].aaSorting:void 0:("number"==typeof e?e=[[e,t]]:1<a.length&&(e=a),this.iterator("table",function(t){t.aaSorting=Array.isArray(e)?e.slice():e}))}),e("order.listener()",function(e,n,a){return this.iterator("table",function(t){$t(t,e,{},n,a)})}),e("order.fixed()",function(e){var t;return e?this.iterator("table",function(t){t.aaSortingFixed=H.extend(!0,{},e)}):(t=(t=this.context).length?t[0].aaSortingFixed:void 0,Array.isArray(t)?{pre:t}:t)}),e(["columns().order()","column().order()"],function(n){var a=this;return n?this.iterator("table",function(t,e){t.aaSorting=a[e].map(function(t){return[t,n]})}):this.iterator("column",function(t,e){for(var n=Gt(t),a=0,r=n.length;a<r;a++)if(n[a].col===e)return n[a].dir;return null},1)}),t("columns().orderable()","column().orderable()",function(n){return this.iterator("column",function(t,e){t=t.aoColumns[e];return n?t.asSorting:t.bSortable},1)}),e("processing()",function(e){return this.iterator("table",function(t){w(t,e)})}),e("search()",function(e,n,a,r){var t=this.context;return void 0===e?0!==t.length?t[0].oPreviousSearch.search:void 0:this.iterator("table",function(t){t.oFeatures.bFilter&&Rt(t,"object"==typeof n?H.extend(t.oPreviousSearch,n,{search:e}):H.extend(t.oPreviousSearch,{search:e,regex:null!==n&&n,smart:null===a||a,caseInsensitive:null===r||r}))})}),e("search.fixed()",function(e,n){var t=this.iterator(!0,"table",function(t){t=t.searchFixed;return e?void 0===n?t[e]:(null===n?delete t[e]:t[e]=n,this):Object.keys(t)});return void 0!==e&&void 0===n?t[0]:t}),t("columns().search()","column().search()",function(a,r,o,i){return this.iterator("column",function(t,e){var n=t.aoPreSearchCols;if(void 0===a)return n[e].search;t.oFeatures.bFilter&&("object"==typeof r?H.extend(n[e],r,{search:a}):H.extend(n[e],{search:a,regex:null!==r&&r,smart:null===o||o,caseInsensitive:null===i||i}),Rt(t,t.oPreviousSearch))})}),e(["columns().search.fixed()","column().search.fixed()"],function(n,a){var t=this.iterator(!0,"column",function(t,e){t=t.aoColumns[e].searchFixed;return n?void 0===a?t[n]:(null===a?delete t[n]:t[n]=a,this):Object.keys(t)});return void 0!==n&&void 0===a?t[0]:t}),e("state()",function(t,e){var n;return t?(n=H.extend(!0,{},t),this.iterator("table",function(t){!1!==e&&(n.time=+new Date+100),Kt(t,n,function(){})})):this.context.length?this.context[0].oSavedState:null}),e("state.clear()",function(){return this.iterator("table",function(t){t.fnStateSaveCallback.call(t.oInstance,t,{})})}),e("state.loaded()",function(){return this.context.length?this.context[0].oLoadedState:null}),e("state.save()",function(){return this.iterator("table",function(t){Qt(t)})}),V.use=function(t,e){var n="string"==typeof t?e:t,e="string"==typeof e?e:t;if(void 0===n&&"string"==typeof e)switch(e){case"lib":case"jq":return H;case"win":return W;case"datetime":return V.DateTime;case"luxon":return o;case"moment":return i;default:return null}"lib"===e||"jq"===e||n&&n.fn&&n.fn.jquery?H=n:"win"==e||n&&n.document?_=(W=n).document:"datetime"===e||n&&"DateTime"===n.type?V.DateTime=n:"luxon"===e||n&&n.FixedOffsetZone?o=n:("moment"===e||n&&n.isMoment)&&(i=n)},V.factory=function(t,e){var n=!1;return t&&t.document&&(_=(W=t).document),e&&e.fn&&e.fn.jquery&&(H=e,n=!0),n},V.versionCheck=function(t,e){for(var n,a,r=(e||V.version).split("."),o=t.split("."),i=0,l=o.length;i<l;i++)if((n=parseInt(r[i],10)||0)!==(a=parseInt(o[i],10)||0))return a<n;return!0},V.isDataTable=function(t){var r=H(t).get(0),o=!1;return t instanceof V.Api||(H.each(V.settings,function(t,e){var n=e.nScrollHead?H("table",e.nScrollHead)[0]:null,a=e.nScrollFoot?H("table",e.nScrollFoot)[0]:null;e.nTable!==r&&n!==r&&a!==r||(o=!0)}),o)},V.tables=function(e){var t=!1,n=(H.isPlainObject(e)&&(t=e.api,e=e.visible),V.settings.filter(function(t){return!(e&&!H(t.nTable).is(":visible"))}).map(function(t){return t.nTable}));return t?new X(n):n},V.camelToHungarian=B,e("$()",function(t,e){e=this.rows(e).nodes(),e=H(e);return H([].concat(e.filter(t).toArray(),e.find(t).toArray()))}),H.each(["on","one","off"],function(t,n){e(n+"()",function(){var t=Array.prototype.slice.call(arguments),e=(t[0]=t[0].split(/\s/).map(function(t){return t.match(/\.dt\b/)?t:t+".dt"}).join(" "),H(this.tables().nodes()));return e[n].apply(e,t),this})}),e("clear()",function(){return this.iterator("table",function(t){mt(t)})}),e("error()",function(e){return this.iterator("table",function(t){$(t,0,e)})}),e("settings()",function(){return new X(this.context,this.context)}),e("init()",function(){var t=this.context;return t.length?t[0].oInit:null}),e("data()",function(){return this.iterator("table",function(t){return m(t.aoData,"_aData")}).flatten()}),e("trigger()",function(e,n,a){return this.iterator("table",function(t){return G(t,null,e,n,a)}).flatten()}),e("ready()",function(t){var e=this.context;return t?this.tables().every(function(){this.context[0]._bInitComplete?t.call(this):this.on("init",function(){t.call(this)})}):e.length?e[0]._bInitComplete||!1:null}),e("destroy()",function(c){return c=c||!1,this.iterator("table",function(t){var e=t.oClasses,n=t.nTable,a=t.nTBody,r=t.nTHead,o=t.nTFoot,i=H(n),a=H(a),l=H(t.nTableWrapper),s=t.aoData.map(function(t){return t?t.nTr:null}),u=e.order,o=(t.bDestroying=!0,G(t,"aoDestroyCallback","destroy",[t],!0),c||new X(t).columns().visible(!0),l.off(".DT").find(":not(tbody *)").off(".DT"),H(W).off(".DT-"+t.sInstance),n!=r.parentNode&&(i.children("thead").detach(),i.append(r)),o&&n!=o.parentNode&&(i.children("tfoot").detach(),i.append(o)),t.colgroup.remove(),t.aaSorting=[],t.aaSortingFixed=[],Zt(t),H("th, td",r).removeClass(u.canAsc+" "+u.canDesc+" "+u.isAsc+" "+u.isDesc).css("width",""),a.children().detach(),a.append(s),t.nTableWrapper.parentNode),r=t.nTableWrapper.nextSibling,u=c?"remove":"detach",a=(i[u](),l[u](),!c&&o&&(o.insertBefore(n,r),i.css("width",t.sDestroyWidth).removeClass(e.table)),V.settings.indexOf(t));-1!==a&&V.settings.splice(a,1)})}),H.each(["column","row","cell"],function(t,s){e(s+"s().every()",function(a){var r,o=this.selector.opts,i=this,l=0;return this.iterator("every",function(t,e,n){r=i[s](e,o),"cell"===s?a.call(r,r[0][0].row,r[0][0].column,n,l):a.call(r,e,n,l),l++})})}),e("i18n()",function(t,e,n){var a=this.context[0],t=U(t)(a.oLanguage);return"string"==typeof(t=H.isPlainObject(t=void 0===t?e:t)?void 0!==n&&void 0!==t[n]?t[n]:t._:t)?t.replace("%d",n):t}),V.version="2.1.5",V.settings=[],V.models={},V.models.oSearch={caseInsensitive:!0,search:"",regex:!1,smart:!0,return:!1},V.models.oRow={nTr:null,anCells:null,_aData:[],_aSortData:null,_aFilterData:null,_sFilterRow:null,src:null,idx:-1,displayData:null},V.models.oColumn={idx:null,aDataSort:null,asSorting:null,bSearchable:null,bSortable:null,bVisible:null,_sManualType:null,_bAttrSrc:!1,fnCreatedCell:null,fnGetData:null,fnSetData:null,mData:null,mRender:null,sClass:null,sContentPadding:null,sDefaultContent:null,sName:null,sSortDataType:"std",sSortingClass:null,sTitle:null,sType:null,sWidth:null,sWidthOrig:null,maxLenString:null,searchFixed:null},V.defaults={aaData:null,aaSorting:[[0,"asc"]],aaSortingFixed:[],ajax:null,aLengthMenu:[10,25,50,100],aoColumns:null,aoColumnDefs:null,aoSearchCols:[],bAutoWidth:!0,bDeferRender:!0,bDestroy:!1,bFilter:!0,bInfo:!0,bLengthChange:!0,bPaginate:!0,bProcessing:!1,bRetrieve:!1,bScrollCollapse:!1,bServerSide:!1,bSort:!0,bSortMulti:!0,bSortCellsTop:null,bSortClasses:!0,bStateSave:!1,fnCreatedRow:null,fnDrawCallback:null,fnFooterCallback:null,fnFormatNumber:function(t){return t.toString().replace(/\B(?=(\d{3})+(?!\d))/g,this.oLanguage.sThousands)},fnHeaderCallback:null,fnInfoCallback:null,fnInitComplete:null,fnPreDrawCallback:null,fnRowCallback:null,fnStateLoadCallback:function(t){try{return JSON.parse((-1===t.iStateDuration?sessionStorage:localStorage).getItem("DataTables_"+t.sInstance+"_"+location.pathname))}catch(t){return{}}},fnStateLoadParams:null,fnStateLoaded:null,fnStateSaveCallback:function(t,e){try{(-1===t.iStateDuration?sessionStorage:localStorage).setItem("DataTables_"+t.sInstance+"_"+location.pathname,JSON.stringify(e))}catch(t){}},fnStateSaveParams:null,iStateDuration:7200,iDisplayLength:10,iDisplayStart:0,iTabIndex:0,oClasses:{},oLanguage:{oAria:{orderable:": Activate to sort",orderableReverse:": Activate to invert sorting",orderableRemove:": Activate to remove sorting",paginate:{first:"First",last:"Last",next:"Next",previous:"Previous",number:""}},oPaginate:{sFirst:"«",sLast:"»",sNext:"›",sPrevious:"‹"},entries:{_:"entries",1:"entry"},sEmptyTable:"No data available in table",sInfo:"Showing _START_ to _END_ of _TOTAL_ _ENTRIES-TOTAL_",sInfoEmpty:"Showing 0 to 0 of 0 _ENTRIES-TOTAL_",sInfoFiltered:"(filtered from _MAX_ total _ENTRIES-MAX_)",sInfoPostFix:"",sDecimal:"",sThousands:",",sLengthMenu:"_MENU_ _ENTRIES_ per page",sLoadingRecords:"Loading...",sProcessing:"",sSearch:"Search:",sSearchPlaceholder:"",sUrl:"",sZeroRecords:"No matching records found"},orderDescReverse:!0,oSearch:H.extend({},V.models.oSearch),layout:{topStart:"pageLength",topEnd:"search",bottomStart:"info",bottomEnd:"paging"},sDom:null,searchDelay:null,sPaginationType:"",sScrollX:"",sScrollXInner:"",sScrollY:"",sServerMethod:"GET",renderer:null,rowId:"DT_RowId",caption:null,iDeferLoading:null},Z(V.defaults),V.defaults.column={aDataSort:null,iDataSort:-1,ariaTitle:"",asSorting:["asc","desc",""],bSearchable:!0,bSortable:!0,bVisible:!0,fnCreatedCell:null,mData:null,mRender:null,sCellType:"td",sClass:"",sContentPadding:"",sDefaultContent:null,sName:"",sSortDataType:"std",sTitle:null,sType:null,sWidth:null},Z(V.defaults.column),V.models.oSettings={oFeatures:{bAutoWidth:null,bDeferRender:null,bFilter:null,bInfo:!0,bLengthChange:!0,bPaginate:null,bProcessing:null,bServerSide:null,bSort:null,bSortMulti:null,bSortClasses:null,bStateSave:null},oScroll:{bCollapse:null,iBarWidth:0,sX:null,sXInner:null,sY:null},oLanguage:{fnInfoCallback:null},oBrowser:{bScrollbarLeft:!1,barWidth:0},ajax:null,aanFeatures:[],aoData:[],aiDisplay:[],aiDisplayMaster:[],aIds:{},aoColumns:[],aoHeader:[],aoFooter:[],oPreviousSearch:{},searchFixed:{},aoPreSearchCols:[],aaSorting:null,aaSortingFixed:[],sDestroyWidth:0,aoRowCallback:[],aoHeaderCallback:[],aoFooterCallback:[],aoDrawCallback:[],aoRowCreatedCallback:[],aoPreDrawCallback:[],aoInitComplete:[],aoStateSaveParams:[],aoStateLoadParams:[],aoStateLoaded:[],sTableId:"",nTable:null,nTHead:null,nTFoot:null,nTBody:null,nTableWrapper:null,bInitialised:!1,aoOpenRows:[],sDom:null,searchDelay:null,sPaginationType:"two_button",pagingControls:0,iStateDuration:0,aoStateSave:[],aoStateLoad:[],oSavedState:null,oLoadedState:null,bAjaxDataGet:!0,jqXHR:null,json:void 0,oAjaxData:void 0,sServerMethod:null,fnFormatNumber:null,aLengthMenu:null,iDraw:0,bDrawing:!1,iDrawError:-1,_iDisplayLength:10,_iDisplayStart:0,_iRecordsTotal:0,_iRecordsDisplay:0,oClasses:{},bFiltered:!1,bSorted:!1,bSortCellsTop:null,oInit:null,aoDestroyCallback:[],fnRecordsTotal:function(){return"ssp"==J(this)?+this._iRecordsTotal:this.aiDisplayMaster.length},fnRecordsDisplay:function(){return"ssp"==J(this)?+this._iRecordsDisplay:this.aiDisplay.length},fnDisplayEnd:function(){var t=this._iDisplayLength,e=this._iDisplayStart,n=e+t,a=this.aiDisplay.length,r=this.oFeatures,o=r.bPaginate;return r.bServerSide?!1===o||-1===t?e+a:Math.min(e+t,this._iRecordsDisplay):!o||a<n||-1===t?a:n},oInstance:null,sInstance:null,iTabIndex:0,nScrollHead:null,nScrollFoot:null,aLastSort:[],oPlugins:{},rowIdFn:null,rowId:null,caption:"",captionNode:null,colgroup:null,deferLoading:null},V.ext.pager);H.extend(xe,{simple:function(){return["previous","next"]},full:function(){return["first","previous","next","last"]},numbers:function(){return["numbers"]},simple_numbers:function(){return["previous","numbers","next"]},full_numbers:function(){return["first","previous","numbers","next","last"]},first_last:function(){return["first","last"]},first_last_numbers:function(){return["first","numbers","last"]},_numbers:Ee,numbers_length:7}),H.extend(!0,V.ext.renderer,{pagingButton:{_:function(t,e,n,a,r){var t=t.oClasses.paging,o=[t.button];return a&&o.push(t.active),r&&o.push(t.disabled),{display:a="ellipsis"===e?H('<span class="ellipsis"></span>').html(n)[0]:H("<button>",{class:o.join(" "),role:"link",type:"button"}).html(n),clicker:a}}},pagingContainer:{_:function(t,e){return e}}});function we(t,e,n,a,r){return i?t[e](r):o?t[n](r):a?t[a](r):t}var o,i,Te=!1;function _e(t,e,n){var a;if(W.luxon&&!o&&(o=W.luxon),i=W.moment&&!i?W.moment:i){if(!(a=i.utc(t,e,n,!0)).isValid())return null}else if(o){if(!(a=e&&"string"==typeof t?o.DateTime.fromFormat(t,e):o.DateTime.fromISO(t)).isValid)return null;a.setLocale(n)}else e?(Te||alert("DataTables warning: Formatted date without Moment.js or Luxon - https://datatables.net/tn/17"),Te=!0):a=new Date(t);return a}function Ce(s){return function(a,r,o,i){0===arguments.length?(o="en",a=r=null):1===arguments.length?(o="en",r=a,a=null):2===arguments.length&&(o=r,r=a,a=null);var l="datetime"+(r?"-"+r:"");return V.ext.type.order[l]||V.type(l,{detect:function(t){return t===l&&l},order:{pre:function(t){return t.valueOf()}},className:"dt-right"}),function(t,e){var n;return null==t&&(t="--now"===i?(n=new Date,new Date(Date.UTC(n.getFullYear(),n.getMonth(),n.getDate(),n.getHours(),n.getMinutes(),n.getSeconds()))):""),"type"===e?l:""===t?"sort"!==e?"":_e("0000-01-01 00:00:00",null,o):!(null===r||a!==r||"sort"===e||"type"===e||t instanceof Date)||null===(n=_e(t,a,o))?t:"sort"===e?n:(t=null===r?we(n,"toDate","toJSDate","")[s]():we(n,"format","toFormat","toISOString",r),"display"===e?u(t):t)}}}var Le=",",Ie=".";if(void 0!==W.Intl)try{for(var Ae=(new Intl.NumberFormat).formatToParts(100000.1),a=0;a<Ae.length;a++)"group"===Ae[a].type?Le=Ae[a].value:"decimal"===Ae[a].type&&(Ie=Ae[a].value)}catch(t){}V.datetime=function(n,a){var r="datetime-"+n;a=a||"en",V.ext.type.order[r]||V.type(r,{detect:function(t){var e=_e(t,n,a);return!(""!==t&&!e)&&r},order:{pre:function(t){return _e(t,n,a)||0}},className:"dt-right"})},V.render={date:Ce("toLocaleDateString"),datetime:Ce("toLocaleString"),time:Ce("toLocaleTimeString"),number:function(r,o,i,l,s){return null==r&&(r=Le),null==o&&(o=Ie),{display:function(t){if("number"!=typeof t&&"string"!=typeof t)return t;if(""===t||null===t)return t;var e=t<0?"-":"",n=parseFloat(t),a=Math.abs(n);if(1e11<=a||a<1e-4&&0!==a)return(a=n.toExponential(i).split(/e\+?/))[0]+" x 10<sup>"+a[1]+"</sup>";if(isNaN(n))return u(t);n=n.toFixed(i),t=Math.abs(n);a=parseInt(t,10),n=i?o+(t-a).toFixed(i).substring(2):"";return(e=0===a&&0===parseFloat(n)?"":e)+(l||"")+a.toString().replace(/\B(?=(\d{3})+(?!\d))/g,r)+n+(s||"")}}},text:function(){return{display:u,filter:u}}};function Fe(t,e){return t=t.toString().toLowerCase(),e=e.toString().toLowerCase(),t.localeCompare(e,navigator.languages[0]||navigator.language,{numeric:!0,ignorePunctuation:!0})}var l=V.ext.type,Ne=(V.type=function(n,t,e){if(!t)return{className:l.className[n],detect:l.detect.find(function(t){return t.name===n}),order:{pre:l.order[n+"-pre"],asc:l.order[n+"-asc"],desc:l.order[n+"-desc"]},render:l.render[n],search:l.search[n]};function a(t,e){l[t][n]=e}function r(t){Object.defineProperty(t,"name",{value:n});var e=l.detect.findIndex(function(t){return t.name===n});-1===e?l.detect.unshift(t):l.detect.splice(e,1,t)}function o(t){l.order[n+"-pre"]=t.pre,l.order[n+"-asc"]=t.asc,l.order[n+"-desc"]=t.desc}void 0===e&&(e=t,t=null),"className"===t?a("className",e):"detect"===t?r(e):"order"===t?o(e):"render"===t?a("render",e):"search"===t?a("search",e):t||(e.className&&a("className",e.className),void 0!==e.detect&&r(e.detect),e.order&&o(e.order),void 0!==e.render&&a("render",e.render),void 0!==e.search&&a("search",e.search))},V.types=function(){return l.detect.map(function(t){return t.name})},V.type("string",{detect:function(){return"string"},order:{pre:function(t){return T(t)&&"boolean"!=typeof t?"":"string"==typeof t?t.toLowerCase():t.toString?t.toString():""}},search:ge(!1,!0)}),V.type("string-utf8",{detect:{allOf:function(t){return!0},oneOf:function(t){return!T(t)&&navigator.languages&&"string"==typeof t&&t.match(/[^\x00-\x7F]/)}},order:{asc:Fe,desc:function(t,e){return-1*Fe(t,e)}},search:ge(!1,!0)}),V.type("html",{detect:{allOf:function(t){return T(t)||"string"==typeof t&&-1!==t.indexOf("<")},oneOf:function(t){return!T(t)&&"string"==typeof t&&-1!==t.indexOf("<")}},order:{pre:function(t){return T(t)?"":t.replace?L(t).trim().toLowerCase():t+""}},search:ge(!0,!0)}),V.type("date",{className:"dt-type-date",detect:{allOf:function(t){var e;return!t||t instanceof Date||R.test(t)?null!==(e=Date.parse(t))&&!isNaN(e)||T(t):null},oneOf:function(t){return t instanceof Date||"string"==typeof t&&R.test(t)}},order:{pre:function(t){t=Date.parse(t);return isNaN(t)?-1/0:t}}}),V.type("html-num-fmt",{className:"dt-type-numeric",detect:{allOf:function(t,e){e=e.oLanguage.sDecimal;return c(t,e,!0,!1)},oneOf:function(t,e){e=e.oLanguage.sDecimal;return c(t,e,!0,!1)}},order:{pre:function(t,e){e=e.oLanguage.sDecimal;return Ne(t,e,N,P)}},search:ge(!0,!0)}),V.type("html-num",{className:"dt-type-numeric",detect:{allOf:function(t,e){e=e.oLanguage.sDecimal;return c(t,e,!1,!0)},oneOf:function(t,e){e=e.oLanguage.sDecimal;return c(t,e,!1,!1)}},order:{pre:function(t,e){e=e.oLanguage.sDecimal;return Ne(t,e,N)}},search:ge(!0,!0)}),V.type("num-fmt",{className:"dt-type-numeric",detect:{allOf:function(t,e){e=e.oLanguage.sDecimal;return s(t,e,!0,!0)},oneOf:function(t,e){e=e.oLanguage.sDecimal;return s(t,e,!0,!1)}},order:{pre:function(t,e){e=e.oLanguage.sDecimal;return Ne(t,e,P)}}}),V.type("num",{className:"dt-type-numeric",detect:{allOf:function(t,e){e=e.oLanguage.sDecimal;return s(t,e,!1,!0)},oneOf:function(t,e){e=e.oLanguage.sDecimal;return s(t,e,!1,!1)}},order:{pre:function(t,e){e=e.oLanguage.sDecimal;return Ne(t,e)}}}),function(t,e,n,a){var r;return 0===t||t&&"-"!==t?"number"==(r=typeof t)||"bigint"==r?t:+(t=(t=e?E(t,e):t).replace&&(n&&(t=t.replace(n,"")),a)?t.replace(a,""):t):-1/0});function je(t,e,n){n&&(t[e]=n)}H.extend(!0,V.ext.renderer,{footer:{_:function(t,e,n){e.addClass(n.tfoot.cell)}},header:{_:function(p,g,v){g.addClass(v.thead.cell),p.oFeatures.bSort||g.addClass(v.order.none);var t=p.bSortCellsTop,e=g.closest("thead").find("tr"),n=g.parent().index();"disable"===g.attr("data-dt-order")||"disable"===g.parent().attr("data-dt-order")||!0===t&&0!==n||!1===t&&n!==e.length-1||H(p.nTable).on("order.dt.DT column-visibility.dt.DT",function(t,e){if(p===e){var n=e.sortDetails;if(n){for(var a=v.order,r=e.api.columns(g),o=p.aoColumns[r.flatten()[0]],i=r.orderable().includes(!0),l="",s=r.indexes(),u=r.orderable(!0).flatten(),c=m(n,"col"),d=(g.removeClass(a.isAsc+" "+a.isDesc).toggleClass(a.none,!i).toggleClass(a.canAsc,i&&u.includes("asc")).toggleClass(a.canDesc,i&&u.includes("desc")),!0),f=0;f<s.length;f++)c.includes(s[f])||(d=!1);d&&(u=r.order(),g.addClass(u.includes("asc")?a.isAsc:""+u.includes("desc")?a.isDesc:""));var h=-1;for(f=0;f<c.length;f++)if(p.aoColumns[c[f]].bVisible){h=c[f];break}s[0]==h?(r=n[0],u=o.asSorting,g.attr("aria-sort","asc"===r.dir?"ascending":"descending"),l=u[r.index+1]?"Reverse":"Remove"):g.removeAttr("aria-sort"),g.attr("aria-label",i?o.ariaTitle+e.api.i18n("oAria.orderable"+l):o.ariaTitle),i&&(g.find(".dt-column-title").attr("role","button"),g.attr("tabindex",0))}}})}},layout:{_:function(t,e,n){var a=t.oClasses.layout,r=H("<div/>").attr("id",n.id||null).addClass(n.className||a.row).appendTo(e);H.each(n,function(t,e){var n;"id"!==t&&"className"!==t&&(n="",e.table&&(r.addClass(a.tableRow),n+=a.tableCell+" "),n+="start"===t?a.start:"end"===t?a.end:a.full,H("<div/>").attr({id:e.id||null,class:e.className||a.cell+" "+n}).append(e.contents).appendTo(r))})}}}),V.feature={},V.feature.register=function(t,e,n){V.ext.features[t]=e,n&&C.feature.push({cFeature:n,fnInit:e})},V.feature.register("div",function(t,e){var n=H("<div>")[0];return e&&(je(n,"className",e.className),je(n,"id",e.id),je(n,"innerHTML",e.html),je(n,"textContent",e.text)),n}),V.feature.register("info",function(t,s){var e,n,u;return t.oFeatures.bInfo?(e=t.oLanguage,n=t.sTableId,u=H("<div/>",{class:t.oClasses.info.container}),s=H.extend({callback:e.fnInfoCallback,empty:e.sInfoEmpty,postfix:e.sInfoPostFix,search:e.sInfoFiltered,text:e.sInfo},s),t.aoDrawCallback.push(function(t){var e=s,n=u,a=t._iDisplayStart+1,r=t.fnDisplayEnd(),o=t.fnRecordsTotal(),i=t.fnRecordsDisplay(),l=i?e.text:e.empty;i!==o&&(l+=" "+e.search),l+=e.postfix,l=re(t,l),e.callback&&(l=e.callback.call(t.oInstance,t,a,r,o,i,l)),n.html(l),G(t,null,"info",[t,n[0],l])}),t._infoEl||(u.attr({"aria-live":"polite",id:n+"_info",role:"status"}),H(t.nTable).attr("aria-describedby",n+"_info"),t._infoEl=u),u):null},"i");var Re=0;function Oe(t){var e=[];return t.numbers&&e.push("numbers"),t.previousNext&&(e.unshift("previous"),e.push("next")),t.firstLast&&(e.unshift("first"),e.push("last")),e}function Pe(t,e,n,a){var r=t.oLanguage.oPaginate,o={display:"",active:!1,disabled:!1};switch(e){case"ellipsis":o.display="&#x2026;",o.disabled=!0;break;case"first":o.display=r.sFirst,0===n&&(o.disabled=!0);break;case"previous":o.display=r.sPrevious,0===n&&(o.disabled=!0);break;case"next":o.display=r.sNext,0!==a&&n!==a-1||(o.disabled=!0);break;case"last":o.display=r.sLast,0!==a&&n!==a-1||(o.disabled=!0);break;default:"number"==typeof e&&(o.display=t.fnFormatNumber(e+1),n===e)&&(o.active=!0)}return o}function Ee(t,e,n,a){var r=[],o=Math.floor(n/2),i=a?2:1,l=a?1:0;return e<=n?r=h(0,e):1===n?r=[t]:3===n?t<=1?r=[0,1,"ellipsis"]:e-2<=t?(r=h(e-2,e)).unshift("ellipsis"):r=["ellipsis",t,"ellipsis"]:t<=o?((r=h(0,n-i)).push("ellipsis"),a&&r.push(e-1)):e-1-o<=t?((r=h(e-(n-i),e)).unshift("ellipsis"),a&&r.unshift(0)):((r=h(t-o+i,t+o-l)).push("ellipsis"),r.unshift("ellipsis"),a&&(r.push(e-1),r.unshift(0))),r}V.feature.register("search",function(n,a){var t,e,r,o,i,l,s,u,c,d;return n.oFeatures.bFilter?(t=n.oClasses.search,e=n.sTableId,c=n.oLanguage,r=n.oPreviousSearch,o='<input type="search" class="'+t.input+'"/>',-1===(a=H.extend({placeholder:c.sSearchPlaceholder,processing:!1,text:c.sSearch},a)).text.indexOf("_INPUT_")&&(a.text+="_INPUT_"),a.text=re(n,a.text),c=a.text.match(/_INPUT_$/),s=a.text.match(/^_INPUT_/),i=a.text.replace(/_INPUT_/,""),l="<label>"+a.text+"</label>",s?l="_INPUT_<label>"+i+"</label>":c&&(l="<label>"+i+"</label>_INPUT_"),(s=H("<div>").addClass(t.container).append(l.replace(/_INPUT_/,o))).find("label").attr("for","dt-search-"+Re),s.find("input").attr("id","dt-search-"+Re),Re++,u=function(t){var e=this.value;r.return&&"Enter"!==t.key||e!=r.search&&Vt(n,a.processing,function(){r.search=e,Rt(n,r),n._iDisplayStart=0,S(n)})},c=null!==n.searchDelay?n.searchDelay:0,d=H("input",s).val(r.search).attr("placeholder",a.placeholder).on("keyup.DT search.DT input.DT paste.DT cut.DT",c?V.util.debounce(u,c):u).on("mouseup.DT",function(t){setTimeout(function(){u.call(d[0],t)},10)}).on("keypress.DT",function(t){if(13==t.keyCode)return!1}).attr("aria-controls",e),H(n.nTable).on("search.dt.DT",function(t,e){n===e&&d[0]!==_.activeElement&&d.val("function"!=typeof r.search?r.search:"")}),s):null},"f"),V.feature.register("paging",function(t,e){if(!t.oFeatures.bPaginate)return null;e=H.extend({buttons:V.ext.pager.numbers_length,type:t.sPaginationType,boundaryNumbers:!0,firstLast:!0,previousNext:!0,numbers:!0},e);function n(){!function t(e,n,a){if(!e._bInitComplete)return;var r=a.type?V.ext.pager[a.type]:Oe,o=e.oLanguage.oAria.paginate||{},i=e._iDisplayStart,l=e._iDisplayLength,s=e.fnRecordsDisplay(),u=-1===l,c=u?0:Math.ceil(i/l),d=u?1:Math.ceil(s/l),f=r(a).map(function(t){return"numbers"===t?Ee(c,d,a.buttons,a.boundaryNumbers):t}).flat();var h=[];for(var p=0;p<f.length;p++){var g=f[p],v=Pe(e,g,c,d),m=ae(e,"pagingButton")(e,g,v.display,v.active,v.disabled),b="string"==typeof g?o[g]:o.number?o.number+(g+1):null;H(m.clicker).attr({"aria-controls":e.sTableId,"aria-disabled":v.disabled?"true":null,"aria-current":v.active?"page":null,"aria-label":b,"data-dt-idx":g,tabIndex:v.disabled?-1:e.iTabIndex||null}),"number"!=typeof g&&H(m.clicker).addClass(g),ee(m.clicker,{action:g},function(t){t.preventDefault(),Xt(e,t.data.action,!0)}),h.push(m.display)}i=ae(e,"pagingContainer")(e,h);u=n.find(_.activeElement).data("dt-idx");n.empty().append(i);void 0!==u&&n.find("[data-dt-idx="+u+"]").trigger("focus");h.length&&1<a.buttons&&H(n).height()>=2*H(h[0]).outerHeight()-10&&t(e,n,H.extend({},a,{buttons:a.buttons-2}))}(t,a.children(),e)}var a=H("<div/>").addClass(t.oClasses.paging.container+(e.type?" paging_"+e.type:"")).append(H("<nav>").attr("aria-label","pagination").addClass(t.oClasses.paging.nav));return t.aoDrawCallback.push(n),H(t.nTable).on("column-sizing.dt.DT",n),a},"p");var ke=0;return V.feature.register("pageLength",function(a,t){var e=a.oFeatures;if(!e.bPaginate||!e.bLengthChange)return null;t=H.extend({menu:a.aLengthMenu,text:a.oLanguage.sLengthMenu},t);var e=a.oClasses.length,n=a.sTableId,r=t.menu,o=[],i=[];if(Array.isArray(r[0]))o=r[0],i=r[1];else for(p=0;p<r.length;p++)H.isPlainObject(r[p])?(o.push(r[p].value),i.push(r[p].label)):(o.push(r[p]),i.push(r[p]));for(var l=t.text.match(/_MENU_$/),s=t.text.match(/^_MENU_/),u=t.text.replace(/_MENU_/,""),t="<label>"+t.text+"</label>",s=(s?t="_MENU_<label>"+u+"</label>":l&&(t="<label>"+u+"</label>_MENU_"),"tmp-"+ +new Date),c=H("<div/>").addClass(e.container).append(t.replace("_MENU_",'<span id="'+s+'"></span>')),d=[],f=(c.find("label")[0].childNodes.forEach(function(t){t.nodeType===Node.TEXT_NODE&&d.push({el:t,text:t.textContent})}),function(e){d.forEach(function(t){t.el.textContent=re(a,t.text,e)})}),h=H("<select/>",{name:n+"_length","aria-controls":n,class:e.select}),p=0;p<o.length;p++)h[0][p]=new Option("number"==typeof i[p]?a.fnFormatNumber(i[p]):i[p],o[p]);return c.find("label").attr("for","dt-length-"+ke),h.attr("id","dt-length-"+ke),ke++,c.find("#"+s).replaceWith(h),H("select",c).val(a._iDisplayLength).on("change.DT",function(){Wt(a,H(this).val()),S(a)}),H(a.nTable).on("length.dt.DT",function(t,e,n){a===e&&(H("select",c).val(n),f(n))}),f(a._iDisplayLength),c},"l"),((H.fn.dataTable=V).$=H).fn.dataTableSettings=V.settings,H.fn.dataTableExt=V.ext,H.fn.DataTable=function(t){return H(this).dataTable(t).api()},H.each(V,function(t,e){H.fn.DataTable[t]=e}),V});

/*! DataTables styling integration
 * © SpryMedia Ltd - datatables.net/license
 */
!function(t){var o,d;"function"==typeof define&&define.amd?define(["jquery","datatables.net"],function(e){return t(e,window,document)}):"object"==typeof exports?(o=require("jquery"),d=function(e,n){n.fn.dataTable||require("datatables.net")(e,n)},"undefined"==typeof window?module.exports=function(e,n){return e=e||window,n=n||o(e),d(e,n),t(n,0,e.document)}:(d(window,o),module.exports=t(o,window,window.document))):t(jQuery,window,document)}(function(e,n,t){"use strict";return e.fn.dataTable});

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
