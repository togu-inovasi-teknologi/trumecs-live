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
})):i.postSlide(e),i.animateHeight(),void 0):(c!==!0?i.animateSlide(h,function(){i.postSlide(e)}):i.postSlide(e),void 0)))},b.prototype.startLoad=function(){var a=this;a.options.arrows===!0&&a.slideCount>a.options.slidesToShow&&(a.$prevArrow.hide(),a.$nextArrow.hide()),a.options.dots===!0&&a.slideCount>a.options.slidesToShow&&a.$dots.hide(),a.$slider.addClass("slick-loading")},b.prototype.swipeDirection=function(){var a,b,c,d,e=this;return a=e.touchObject.startX-e.touchObject.curX,b=e.touchObject.startY-e.touchObject.curY,c=Math.atan2(b,a),d=Math.round(180*c/Math.PI),0>d&&(d=360-Math.abs(d)),45>=d&&d>=0?e.options.rtl===!1?"left":"right":360>=d&&d>=315?e.options.rtl===!1?"left":"right":d>=135&&225>=d?e.options.rtl===!1?"right":"left":e.options.verticalSwiping===!0?d>=35&&135>=d?"left":"right":"vertical"},b.prototype.swipeEnd=function(){var c,b=this;if(b.dragging=!1,b.shouldClick=b.touchObject.swipeLength>10?!1:!0,void 0===b.touchObject.curX)return!1;if(b.touchObject.edgeHit===!0&&b.$slider.trigger("edge",[b,b.swipeDirection()]),b.touchObject.swipeLength>=b.touchObject.minSwipe)switch(b.swipeDirection()){case"left":c=b.options.swipeToSlide?b.checkNavigable(b.currentSlide+b.getSlideCount()):b.currentSlide+b.getSlideCount(),b.slideHandler(c),b.currentDirection=0,b.touchObject={},b.$slider.trigger("swipe",[b,"left"]);break;case"right":c=b.options.swipeToSlide?b.checkNavigable(b.currentSlide-b.getSlideCount()):b.currentSlide-b.getSlideCount(),b.slideHandler(c),b.currentDirection=1,b.touchObject={},b.$slider.trigger("swipe",[b,"right"])}else b.touchObject.startX!==b.touchObject.curX&&(b.slideHandler(b.currentSlide),b.touchObject={})},b.prototype.swipeHandler=function(a){var b=this;if(!(b.options.swipe===!1||"ontouchend"in document&&b.options.swipe===!1||b.options.draggable===!1&&-1!==a.type.indexOf("mouse")))switch(b.touchObject.fingerCount=a.originalEvent&&void 0!==a.originalEvent.touches?a.originalEvent.touches.length:1,b.touchObject.minSwipe=b.listWidth/b.options.touchThreshold,b.options.verticalSwiping===!0&&(b.touchObject.minSwipe=b.listHeight/b.options.touchThreshold),a.data.action){case"start":b.swipeStart(a);break;case"move":b.swipeMove(a);break;case"end":b.swipeEnd(a)}},b.prototype.swipeMove=function(a){var d,e,f,g,h,b=this;return h=void 0!==a.originalEvent?a.originalEvent.touches:null,!b.dragging||h&&1!==h.length?!1:(d=b.getLeft(b.currentSlide),b.touchObject.curX=void 0!==h?h[0].pageX:a.clientX,b.touchObject.curY=void 0!==h?h[0].pageY:a.clientY,b.touchObject.swipeLength=Math.round(Math.sqrt(Math.pow(b.touchObject.curX-b.touchObject.startX,2))),b.options.verticalSwiping===!0&&(b.touchObject.swipeLength=Math.round(Math.sqrt(Math.pow(b.touchObject.curY-b.touchObject.startY,2)))),e=b.swipeDirection(),"vertical"!==e?(void 0!==a.originalEvent&&b.touchObject.swipeLength>4&&a.preventDefault(),g=(b.options.rtl===!1?1:-1)*(b.touchObject.curX>b.touchObject.startX?1:-1),b.options.verticalSwiping===!0&&(g=b.touchObject.curY>b.touchObject.startY?1:-1),f=b.touchObject.swipeLength,b.touchObject.edgeHit=!1,b.options.infinite===!1&&(0===b.currentSlide&&"right"===e||b.currentSlide>=b.getDotCount()&&"left"===e)&&(f=b.touchObject.swipeLength*b.options.edgeFriction,b.touchObject.edgeHit=!0),b.swipeLeft=b.options.vertical===!1?d+f*g:d+f*(b.$list.height()/b.listWidth)*g,b.options.verticalSwiping===!0&&(b.swipeLeft=d+f*g),b.options.fade===!0||b.options.touchMove===!1?!1:b.animating===!0?(b.swipeLeft=null,!1):(b.setCSS(b.swipeLeft),void 0)):void 0)},b.prototype.swipeStart=function(a){var c,b=this;return 1!==b.touchObject.fingerCount||b.slideCount<=b.options.slidesToShow?(b.touchObject={},!1):(void 0!==a.originalEvent&&void 0!==a.originalEvent.touches&&(c=a.originalEvent.touches[0]),b.touchObject.startX=b.touchObject.curX=void 0!==c?c.pageX:a.clientX,b.touchObject.startY=b.touchObject.curY=void 0!==c?c.pageY:a.clientY,b.dragging=!0,void 0)},b.prototype.unfilterSlides=b.prototype.slickUnfilter=function(){var a=this;null!==a.$slidesCache&&(a.unload(),a.$slideTrack.children(this.options.slide).detach(),a.$slidesCache.appendTo(a.$slideTrack),a.reinit())},b.prototype.unload=function(){var b=this;a(".slick-cloned",b.$slider).remove(),b.$dots&&b.$dots.remove(),b.$prevArrow&&b.htmlExpr.test(b.options.prevArrow)&&b.$prevArrow.remove(),b.$nextArrow&&b.htmlExpr.test(b.options.nextArrow)&&b.$nextArrow.remove(),b.$slides.removeClass("slick-slide slick-active slick-visible slick-current").attr("aria-hidden","true").css("width","")},b.prototype.unslick=function(a){var b=this;b.$slider.trigger("unslick",[b,a]),b.destroy()},b.prototype.updateArrows=function(){var b,a=this;b=Math.floor(a.options.slidesToShow/2),a.options.arrows===!0&&a.slideCount>a.options.slidesToShow&&!a.options.infinite&&(a.$prevArrow.removeClass("slick-disabled").attr("aria-disabled","false"),a.$nextArrow.removeClass("slick-disabled").attr("aria-disabled","false"),0===a.currentSlide?(a.$prevArrow.addClass("slick-disabled").attr("aria-disabled","true"),a.$nextArrow.removeClass("slick-disabled").attr("aria-disabled","false")):a.currentSlide>=a.slideCount-a.options.slidesToShow&&a.options.centerMode===!1?(a.$nextArrow.addClass("slick-disabled").attr("aria-disabled","true"),a.$prevArrow.removeClass("slick-disabled").attr("aria-disabled","false")):a.currentSlide>=a.slideCount-1&&a.options.centerMode===!0&&(a.$nextArrow.addClass("slick-disabled").attr("aria-disabled","true"),a.$prevArrow.removeClass("slick-disabled").attr("aria-disabled","false")))},b.prototype.updateDots=function(){var a=this;null!==a.$dots&&(a.$dots.find("li").removeClass("slick-active").attr("aria-hidden","true"),a.$dots.find("li").eq(Math.floor(a.currentSlide/a.options.slidesToScroll)).addClass("slick-active").attr("aria-hidden","false"))},b.prototype.visibility=function(){var a=this;document[a.hidden]?(a.paused=!0,a.autoPlayClear()):a.options.autoplay===!0&&(a.paused=!1,a.autoPlay())},b.prototype.initADA=function(){var b=this;b.$slides.add(b.$slideTrack.find(".slick-cloned")).attr({"aria-hidden":"true",tabindex:"-1"}).find("a, input, button, select").attr({tabindex:"-1"}),b.$slideTrack.attr("role","listbox"),b.$slides.not(b.$slideTrack.find(".slick-cloned")).each(function(c){a(this).attr({role:"option","aria-describedby":"slick-slide"+b.instanceUid+c})}),null!==b.$dots&&b.$dots.attr("role","tablist").find("li").each(function(c){a(this).attr({role:"presentation","aria-selected":"false","aria-controls":"navigation"+b.instanceUid+c,id:"slick-slide"+b.instanceUid+c})}).first().attr("aria-selected","true").end().find("button").attr("role","button").end().closest("div").attr("role","toolbar"),b.activateADA()},b.prototype.activateADA=function(){var a=this,b=a.$slider.find("*").is(":focus");a.$slideTrack.find(".slick-active").attr({"aria-hidden":"false",tabindex:"0"}).find("a, input, button, select").attr({tabindex:"0"}),b&&a.$slideTrack.find(".slick-active").focus()},b.prototype.focusHandler=function(){var b=this;b.$slider.on("focus.slick blur.slick","*",function(c){c.stopImmediatePropagation();var d=a(this);setTimeout(function(){b.isPlay&&(d.is(":focus")?(b.autoPlayClear(),b.paused=!0):(b.paused=!1,b.autoPlay()))},0)})},a.fn.slick=function(){var g,a=this,c=arguments[0],d=Array.prototype.slice.call(arguments,1),e=a.length,f=0;for(f;e>f;f++)if("object"==typeof c||"undefined"==typeof c?a[f].slick=new b(a[f],c):g=a[f].slick[c].apply(a[f].slick,d),"undefined"!=typeof g)return g;return a}});$(document).ready(function(){
  $('.slide-mobile').fadeIn();
  $(".slick-banner-home").slick({
    arrows: false, 
    variableWidth: false,
    autoplay: true,
    dots: true,
    centerMode: false,
    focusOnSelect: true,
    swipeToSlide: true,
    slidesToShow:1,
    speed: 1000,
    
  });
  $(".slick-top-product").slick({
    arrows: true, 
    variableWidth: false,
    autoplay: true,
    dots: true,
    centerMode: false,
    focusOnSelect: true,
    swipeToSlide: true,
    slidesToShow:1,
    speed: 1000,
  });
  $(".slick-banner-home-2").slick({
    arrows: true, 
    variableWidth: false,
    autoplay: true,
    dots: false,
    centerMode: false,
    focusOnSelect: true,
    swipeToSlide: true,
    slidesToShow:1,
    speed: 2000,
    prevArrow: '.prev-banner-home',
    nextArrow: '.next-banner-home',
  });
  $(".slick-article-home").slick({
    arrows: true, 
    variableWidth: false,
    autoplay: true,
    dots: false,
    centerMode: false,
    focusOnSelect: true,
    swipeToSlide: true,
    slidesToShow: 3,
    speed: 1000,
    prevArrow: '.prev-article-home',
    nextArrow: '.next-article-home',
  });
  
  $(".slick-promo-home").slick({
    arrows: true, 
    variableWidth: false,
    autoplay: true,
    dots: false,
    centerMode: false,
    focusOnSelect: true,
    swipeToSlide: true,
    slidesToShow: 2,
    speed: 1000,
    prevArrow: '.prev-promo-home',
    nextArrow: '.next-promo-home',
  });
  $(".slick-brands-even").slick({
    arrows: true, 
    variableWidth: false,
    autoplay: true,
    dots: false,
    centerMode: false,
    focusOnSelect: true,
    swipeToSlide: true,
    slidesToShow: 6,
    speed: 1000,
    prevArrow: '.prev-brands',
    nextArrow: '.next-brands',
  });
  $(".slick-brands-odd").slick({
    arrows: true, 
    variableWidth: false,
    autoplay: true,
    dots: false,
    centerMode: false,
    focusOnSelect: true,
    swipeToSlide: true,
    slidesToShow: 6,
    speed: 1000,
    prevArrow: '.prev-brands',
    nextArrow: '.next-brands',
  });
  $(".slick-brands-even-mobile").slick({
    arrows: false, 
    variableWidth: false,
    autoplay: true,
    dots: false,
    centerMode: false,
    focusOnSelect: true,
    swipeToSlide: true,
    slidesToShow: 3,
    speed: 1000,
  });
  $(".slick-brands-odd-mobile").slick({
    arrows: false, 
    variableWidth: false,
    autoplay: true,
    dots: false,
    centerMode: false,
    focusOnSelect: true,
    swipeToSlide: true,
    slidesToShow: 3,
    speed: 1000,
  });
  $(".slick-promo-home-mobile").slick({
    arrows: false, 
    variableWidth: false,
    autoplay: true,
    dots: true,
    centerMode: false,
    focusOnSelect: true,
    swipeToSlide: true,
    slidesToShow: 1,
    speed: 1000
  });
  $(".slick-article-home-mobile").slick({
    arrows: false, 
    variableWidth: false,
    autoplay: true,
    dots: false,
    centerMode: false,
    focusOnSelect: true,
    swipeToSlide: true,
    slidesToShow: 2,
    speed:1000
  });
  $(".slick-product-home").slick({
    arrows:true,
    variableWidth: false,
    autoplay:true,
    dots: true,
    centerMode: false,
    focusOnSelect: true,
    slidesToShow: 5,
    swipeToSlide: true,
    speed: 1000,
    prevArrow: '.prev-product-home',
    nextArrow: '.next-product-home',
  });
  $(".slick-product-home-mobile").slick({
    arrows:false,
    // variableWidth: false,
    autoplay:true,
    dots: true,
    centerMode: false,
    focusOnSelect: true,
    slidesToShow: 2,
    swipeToSlide: true,
    speed: 1000,
  });
  $(".slick-product-home-mobile-new-product").slick({
    arrows:false,
    // variableWidth: false,
    autoplay:true,
    dots: true,
    centerMode: false,
    focusOnSelect: true,
    slidesToShow: 2,
    swipeToSlide: true,
    speed: 1000,
  });

  $(".slick-best-seller-home").slick({
    arrows:true,
    variableWidth: false,
    autoplay:true,
    dots: true,
    centerMode: false,
    focusOnSelect: true,
    slidesToShow: 5,
    swipeToSlide: true,
    speed: 1000,
    prevArrow: '.prev-best-seller-home',
    nextArrow: '.next-best-seller-home',
  });
  
  $(".slick-product-category-home").slick({
    arrows:false,
    variableWidth: false,
    autoplay:false,
    dots: true,
    centerMode: false,
    focusOnSelect: true,
    slidesToShow: 4,
  });
  $(".slickbigslide").find("img").css("width",screen.width);
  $(".test-list").slick({
    arrows:true,
    variableWidth: false,
    autoplay:false,
    dots: true,
    centerMode: false,
    focusOnSelect: true,
    slidesToShow: 6,
    slidesToScroll: 6
  });
  $(".mobile-home-list").slick({
    arrows:false,
    variableWidth: false,
    autoplay:false,
    dots: true,
    centerMode: false,
    focusOnSelect: true,
    slidesToShow: 2,
    swipeToSlide:true,
  });
  $(".slick-banner-landpage").slick({
    arrows:false,
    variableWidth: false,
    autoplay:true,
    dots: true,
    centerMode: false,
    focusOnSelect: true,
    slidesToShow: 1,
    swipeToSlide: true,
    speed: 1000,
  });
});

var data = [];
var rfqItems = [];
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

  function datatableInit(element, search, categoryId, image, name) {
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

    var table = element.DataTable({
      ajax: {
        url: base_url + "/getProductByCategories",
        type: "POST",
        data: dataToRequest,
      },
      layout:{
        topStart: null,
        topEnd: null,
        bottomStart:null,
        bottomEnd:null,
        top1Start: [
          function () {
              let toolbar = document.createElement('div');
              toolbar.innerHTML = '<img src="'+image+'" alt="'+name+'" width="100%">';
              toolbar.setAttribute('class', 'col-lg-3 d-flex align-items-end gap-3 p-l-0');
              return toolbar;
          },
          {
            
              className: "flex flex-column col-md-4",
              features: [
                function () {
                  let toolbar = document.createElement('div');
                  toolbar.innerHTML = '<h2 class="fbold" style="font-size:30px">'+name+'</h2>';
                  //toolbar.setAttribute('class', '');
                  return toolbar;
                },
                'pageLength'
              ]
            
          },
          
        ],
        top1End:[
          'search'
        ]
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
          targets: [1,2,3, 4, 5],
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
      // console.log(table.row(this));
      // let data = table.row(this).data();
      // var id = data[0];
      // str = data[1].replace(/\s+/g, '-').toLowerCase();
      // redirect = base_url + 'product/' + id + '/' + str;
      // window.location.href = redirect;
    });
  }

  function datatableDestroy(element) {
    // console.log(element.DataTable());
    element.empty();
    element.DataTable().destroy();
  }
});

function showFloatingQuotationWidget() {}
var itemsRfq = [];

$(document).ready(function () {
  var base_url = $("body").attr("baseurl");
  var id_shipping_province = $("select[name=shipping_province]").attr("id");
  var id_shipping_city = $("select[name=shipping_city]").attr("id");
  var id_shipping_districts = $("select[name=shipping_districts]").attr("id");
  var id_shipping_village = $("select[name=shipping_village]").attr("id");
  $("select[name=shipping_province]").val(id_shipping_province);

  var previewNode = document.querySelector("#template");
  previewNode.id = "";
  var previewTemplate = previewNode.parentNode.innerHTML;
  previewNode.parentNode.removeChild(previewNode);
  $("#uploader").dropzone({
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
        $("#uploader").addClass("drag-enter");
      });
      this.on("dragleave", function () {
        $("#uploader").removeClass("drag-enter");
      });
      this.on("complete", (file) => {
        $(file).each(function (index, item) {
          response = JSON.parse(item.xhr.response);
          $("#uploader").removeClass("drag-enter");
          $("#uploader").append(
            '<input type="hidden" name="files[]" value="' +
              response.name +
              '" />'
          );
          setTimeout(function () {
            $(item.previewElement).find(".progress").fadeOut(1000);
          }, 500);
        });
      });
      this.on("removedfile", (file) => {
        response = JSON.parse(file.xhr.response);
        filename = response.name;
        $.post(
          base_url + "bulk/remove",
          { filename: filename },
          function (data) {
            $('input[value="' + filename + '"]').remove();
          }
        );
      });
    },
  });

  $("#new-items").click(function (e) {
    e.preventDefault();
    var inputItemElement = `<input type="hidden" class="form-control m-b-1" name="items[]">`;
    inputItemElement += `<input type="text" class="form-control form-autocomplete-item m-b-1" name="item_names[]" placeholder="cari daftar item">`;
    var qtyElement = `<input type="number" class="form-control m-b-1" value="1" name="qty[]" placeholder="Quantity">`;
    $(".form-item-new").append(inputItemElement);
    $(".form-qty-new").append(qtyElement);
  });

  $(document).on("click", ".nav-contact", function (e) {
    e.preventDefault();
    $(".nav-contact").removeClass("active");
    $(this).addClass("active");
  });

  $(document).on("keyup", ".form-autocomplete-item", function (e) {
    setItemAutocomplete($(this));
  });

  $("#show-address-list").click(function (e) {
    e.preventDefault();
    setTimeout(datatableAddress, 2000);
  });

  $(document).on("click", "#modal-address-close", function (e) {
    e.preventDefault();
    $("#datatable-address").DataTable().destroy();
  });

  $(document).on("click", ".btn-address-datatable", function (e) {
    e.preventDefault();

    var id = $(this).data("id");

    $('input[name="village_id"]').val(id);

    $.ajax({
      type: "POST",
      url: base_url + "bulk/getAddressDetail",
      data: {
        village_id: id,
      },
      dataType: "json",
      success: function (response) {
        $("#location").html(`<div class="alert alert-info" role="alert">
                                <i class="fa fa-fw fa-map-marker"></i>${response.village}, ${response.district}, ${response.regencies}, ${response.province}
                            </div>`);
      },
    });
    $("#datatable-address").DataTable().destroy();
  });

  $(document).on("click", ".delete-button", function (e) {
    e.preventDefault();

    var id = $(this).data("id");

    $(this).closest(".item-selected-rfq").remove();

    $.each(itemsRfq, function (i, value) {
      if (value.id == id) {
        itemsRfq.splice(i, 1);
        var currentValue = $('input[name="item_keyword"]').val();
        var newValue = currentValue.replace(value.tittle, "");
        $('input[name="item_keyword"]').val(newValue);
      }
    });
  });

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
          $(".resultjneservice").load(
            base_url +
              "general/getservice_trumecsdelivery?id=" +
              id_shipping_city +
              "&id_kab=" +
              $("select[name=shipping_city]").val(),
            function () {
              $(".loader").fadeOut();
            }
          );
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
    var id_kab = $("select[name=shipping_city]").val();
    $(".loadernewaddress").fadeIn();
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
        $(".resultjneservice").load(
          base_url +
            "general/getservice_trumecsdelivery?id=" +
            id +
            "&id_kab=" +
            id_kab,
          function () {
            $(".loadernewaddress").fadeOut();
          }
        );
      },
    });
  });

  $(document).on("click", ".btn-switch-register", function () {
    $(".login-form").hide();
    $(".register-form").show();
  });

  $(document).on("click", ".btn-switch-login", function () {
    $(".login-form").show();
    $(".register-form").hide();
  });

  $(document).on("click", ".btn-alamat", function () {
    $(".alamat-placeholder").html("");
    $(".alamat-nama").html($('input[name="alamat_name"]').val());
    $(".alamat-phone").html(
      $('input[name="alamat_phone"]').val() != ""
        ? " ( " + $('input[name="alamat_phone"]').val() + " )"
        : ""
    );
    $(".alamat-company").html($('input[name="alamat_company"]').val());
    $(".alamat-jalan").html($('textarea[name="shipping_address"]').val());
    $(".alamat-provinsi").html(
      jQuery.isNumeric($('select[name="shipping_province"]').val())
        ? $('select[name="shipping_province"] option:selected').text() + " "
        : ""
    );
    $(".alamat-kabupaten").html(
      jQuery.isNumeric($('select[name="shipping_city"]').val())
        ? $('select[name="shipping_city"] option:selected').text()
        : ""
    );
    $(".alamat-kecamatan").html(
      jQuery.isNumeric($('select[name="shipping_districts"]').val())
        ? $('select[name="shipping_districts"] option:selected').text() + " "
        : ""
    );
    $(".alamat-kelurahan").html(
      jQuery.isNumeric($('select[name="shipping_village"]').val())
        ? " " + $('select[name="shipping_village"] option:selected').text()
        : ""
    );
    $(".alamat-kodepos").html($('input[name="shipping_kodepos"]').val());
    $(".popup_alamat").modal("hide");
  });

  $(document).on("click", ".btn-catatan", function () {
    $(".text-catatan").html($('textarea[name="bulk_note"]').val());
    $(".popup_catatan").modal("hide");
  });

  var previewNode = document.querySelector("#template");
  previewNode.id = "";
  var previewTemplate = previewNode.parentNode.innerHTML;
  previewNode.parentNode.removeChild(previewNode);

  $("#uploader").dropzone({
    url: base_url + "bulk/upload",
    parallelUploads: 3,
    clickable: ".btn-upload",
    previewTemplate: previewTemplate,
    autoQueue: true,
    maxFiles: 3,
    previewsContainer: "#previews",
    acceptedFiles: ".xls, .xlsx",
    init: function () {
      this.on("dragenter", function () {
        $("#uploader").addClass("drag-enter");
      });
      this.on("dragleave", function () {
        $("#uploader").removeClass("drag-enter");
      });
      this.on("complete", (file) => {
        $(file).each(function (index, item) {
          response = JSON.parse(item.xhr.response);
          $("#uploader").removeClass("drag-enter");
          $("#uploader").append(
            '<input type="hidden" name="files[]" value="' +
              response.name +
              '" />'
          );
          setTimeout(function () {
            $(item.previewElement).find(".progress").fadeOut(1000);
          }, 500);
        });
      });
      this.on("removedfile", (file) => {
        response = JSON.parse(file.xhr.response);
        filename = response.name;
        $.post(
          base_url + "bulk/remove",
          { filename: filename },
          function (data) {
            $('input[value="' + filename + '"]').remove();
          }
        );
      });
    },
  });

  $(document).on("submit", "#form-login", function (data) {
    $.post(
      base_url + "bulk/login",
      {
        email: $('#form-login input[name="email"]').val(),
        password: $('#form-login input[name="password"]').val(),
      },
      function (data) {
        response = JSON.parse(data);
        if (response.status == "success") {
          $("#form-upload").submit();
        } else {
        }
      }
    );
    return false;
  });

  $(document).on("submit", "#form-signup", function (data) {
    $.post(
      base_url + "bulk/signup",
      {
        email: $('#form-signup input[name="email"]').val(),
        password: $('#form-signup input[name="password"]').val(),
        phone: $('#form-signup input[name="phone"]').val(),
        name: $('#form-signup input[name="name"]').val(),
      },
      function (data) {
        response = JSON.parse(data);
        if (response.status == "success") {
          $("#form-upload").submit();
        } else {
        }
      }
    );
    return false;
  });

  $(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();
  });
});

function existShortcut(value) {
  var term = value.split("\n");

  if (term.length > 1) {
    for (let i = 0; i < term.length; i++) {
      if (term[i].includes("@")) {
        return term[i];
        break;
      }
    }
  } else if (term.length == 1) {
    var term = value.split(" ");
    for (let i = 0; i < term.length; i++) {
      if (term[i].includes("@")) {
        return term[i];
        break;
      }
    }
  }

  return null;
}

function extractValue(value, newValue) {
  var term = value.split(" ");

  for (let i = 0; i < term.length; i++) {
    if (term[i].includes("@")) {
      term[i] = `@${newValue}`;
    }
  }

  return term;
}

function setItemAutocomplete(element) {
  element
    .autocomplete({
      source: function (request, response) {
        $.ajax({
          type: "POST",
          url: base_url + "/bulk/getAutocompleteProduct/",
          data: {
            keyword: request.term,
          },
          dataType: "json",
          success: function (data) {
            if (data.length > 0) {
              response(data);
            }
          },
        });
      },
      minLength: 3,
      select: function (event, ui) {
        element
          .parent()
          .children()
          .eq(element.index() - 1)
          .val(ui.item.id);

        element.val(ui.item.tittle);
        return false;
      },
    })
    .autocomplete("instance")._renderItem = function (ul, item) {
    label = item.tittle;
    return $("<div class='p-a-1 border-sm bg-white f12'>")
      .append("<div>" + label + "</div>")
      .appendTo(ul);
  };
}

function datatableAddress() {
  $("#datatable-address").DataTable({
    ajax: {
      url: base_url + "/bulk/fetchAddress",
      type: "POST",
      // data: dataToRequest,
    },
    processing: true,
    serverSide: true,
  });
}

function split(val) {
  var split = val.split(/,\s*/);

  return split;
}
function extractLast(term) {
  return split(term).pop();
}

function getLastValue(term) {
  var linelength = term.split("\n");

  $.each(linelength, function (i, value) {
    var lengthSplitSpace = value.split(" ");
    console.log(`line ${i} value : ${value}`);
    $.each(lengthSplitSpace, function (n, valueOfSplitSpace) {
      console.log(`line ${i} space ${n} value : ${valueOfSplitSpace}`);
      //  console.log(valueOfSplitSpace);
    });
  });

  // if(split.length == 1 && split[0].includes('\n')){
  //     split = term.split('\n');
  // }
  // return split[split.length -1];
}

function changeElementInputToSearchAutocomplete() {
  $("#input-element-container").html("");
  $("#input-element-container").css("margin-bottom", "80px");
  $("#input-element-container").append(
    '<textarea class="form-control border-none shadow" name="text_rfq" placeholder="ketikan nama barang" type="text"></textarea>'
  );
  $('textarea[name="text_rfq"]').focus();
}
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
