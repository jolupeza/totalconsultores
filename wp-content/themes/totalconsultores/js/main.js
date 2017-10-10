'use strict';

var j = jQuery.noConflict();

(function ($) {
  var $win = j(window),
      $doc = j(document),
      $animationElements = j('.animation-element'),
      sldExpert, sldCustomer;

  function affixHeader() {
    j('.Header').affix({
      offset: {
        top: function () {
          return 20;
        }
      }
    });
  }

  function checkIfInView() {
    var windowHeight = $win.height();
    var windowTopPosition = $win.scrollTop();
    var windowBottomPosition = (windowTopPosition + windowHeight);

    j.each($animationElements, function(){
      var element = j(this);
      var animation = element.data('animation');
      var elementHeight = element.outerHeight();
      var elementTopPosition = element.offset().top;
      var elementBottomPosition = (elementTopPosition + elementHeight);

      if ((elementBottomPosition >= windowTopPosition) && (elementTopPosition <= windowBottomPosition)) {
        element.addClass(animation);
      } else {
        element.removeClass(animation);
      }
    });
  }

  $win.on('scroll resize', checkIfInView);

  $win.on('resize', function() {
    if (map) {
      var $map = j('#map');

      if ($map.length) {
        var lat = $map.data('lat'),
            long = $map.data('long');

        map.setCenter({lat: lat, lng: long});
      }
    }

    if (j('.Bxslider-list').length) {
      var bx = j('.Bxslider-list'),
          widthBxSlider = parseInt(bx.width()),
          widthBxSlider = $win.width() > 600 ? (widthBxSlider * 42) / 100 : 0,
          slides = $win.width() > 600 ? 3 : 1;

      sldExpert.reloadSlider({
        auto: true,
        autoHover: true,
        minSlides: slides,
        maxSlides: slides,
        slideWidth: widthBxSlider,
        slideMargin: 15,
        nextText: '<i class="icon-arrow-right2"></i>',
        prevText: '<i class="icon-arrow-left2"></i>',
        pager: false,
        onSlidePrev: function($slideElement, oldIndex, newIndex) {
          sldExpert.goToSlide(newIndex);
          sldExpert.stopAuto();
          sldExpert.startAuto();
          return false;
        },
        onSlideNext: function($slideElement, oldIndex, newIndex) {
          sldExpert.goToSlide(newIndex);
          sldExpert.stopAuto();
          sldExpert.startAuto();
          return false;
        }
        /*onSliderLoad: function() {
          j('.bx-controls-direction a').on('click', function(){
            var i = $(this).attr('data-slide-index');
              sldExpert.goToSlide(i);
              sldExpert.stopAuto();
              sldExpert.startAuto();
              return false;
          });
        }*/
      });
    }

    if (j('.Bxslider-customer').length) {
      var bx = j('.Bxslider-customer'),
          widthBxSlider = parseInt(bx.width()),
          widthBxSlider = $win.width() > 600 ? (widthBxSlider * 42) / 100 : 0,
          slides = $win.width() > 600 ? 5 : 1;

      sldCustomer.reloadSlider({
        auto: true,
        autoHover: true,
        minSlides: slides,
        maxSlides: slides,
        slideWidth: widthBxSlider,
        moveSlides: 1,
        slideMargin: 15,
        nextText: '<i class="icon-arrow-right2"></i>',
        prevText: '<i class="icon-arrow-left2"></i>',
        pager: false,
        onSlidePrev: function($slideElement, oldIndex, newIndex) {
          sldCustomer.goToSlide(newIndex);
          sldCustomer.stopAuto();
          sldCustomer.startAuto();
          return false;
        },
        onSlideNext: function($slideElement, oldIndex, newIndex) {
          sldCustomer.goToSlide(newIndex);
          sldCustomer.stopAuto();
          sldCustomer.startAuto();
          return false;
        }
      });
    }
  });

  $win.on('scroll', function(event) {
    var arrow = j('.ArrowTop');

    if ( j(this).scrollTop() > 150) {
      arrow.fadeIn();
    } else {
      arrow.fadeOut();
    }
  });

  $doc.on('ready', function () {
    affixHeader();

    j('.ArrowTop').on('click', function(ev){
      ev.preventDefault();
      j('html, body').animate({scrollTop: 0}, 800);
    });

    j('.js-move-scroll').on('click', function(event) {
      event.preventDefault();
      var $this = j(this);
      var dest = $this.data('href');

      dest = (typeof dest === 'undefined') ? $this.attr('href') : dest;

      dest = (dest.charAt(0) === '#') ? dest : '#' + dest;

      j('html, body').stop().animate({
        scrollTop: j(dest).offset().top
      }, 2000, 'easeInOutExpo');
    });

    j('.js-menu-move-scroll a').on('click', function(event) {
      event.preventDefault();
      var $this = j(this);
      var dest = $this.attr('href');

      j('html, body').stop().animate({
        scrollTop: j(dest).offset().top
      }, 2000, 'easeInOutExpo');
    });

    j('#js-frm-contact').formValidation({
      locale: 'es_ES',
      framework: 'bootstrap',
      icon: {
        valid: 'glyphicon glyphicon-ok',
        invalid: 'glyphicon glyphicon-remove',
        validating: 'glyphicon glyphicon-refresh'
      }
    }).on('err.field.fv', function(e, data){
      var field = e.target;
      j('small.help-block[data-bv-result="INVALID"]').addClass('hide');
    }).on('success.form.fv', function(e){
      e.preventDefault();

      var $form = j(e.target),
          fv = j(e.target).data('formValidation');

      var msg     = j('#js-form-contact-msg'),
          loader  = j('#js-form-contact-loader');

      loader.removeClass('hidden').addClass('infinite animated');
      msg.text('');

      var data = $form.serialize() + '&nonce=' + TCAjax.nonce + '&action=register_contact';

      j.post(TCAjax.url, data, function(data){
        $form.data('formValidation').resetForm(true);

        if (data.result) {
          msg.text('Ya tenemos su consulta. En breve nos pondremos en contacto con usted.');
        } else {
          msg.text(data.error);
        }

        loader.addClass('hidden').removeClass('infinite animated');
        msg.fadeIn('slow');
        setTimeout(function(){
          msg.fadeOut('slow', function(){
              j(this).text('');
          });
        }, 5000);
      }, 'json').fail(function(){
        alert('No se pudo realizar la operación solicitada. Por favor vuelva a intentarlo.');
      });
    });

    j('.js-toggle-slidebar').on('click', function(ev) {
      ev.preventDefault();
      var slidebar = j('.Slidebar');

      if (slidebar.hasClass('active')) {
        slidebar.removeClass('active');
      } else {
        slidebar.addClass('active');
      }
    });

    if (j('.Bxslider-customer').length) {
      var bx = j('.Bxslider-customer'),
          widthBxSlider = parseInt(bx.width()),
          widthBxSlider = $win.width() > 600 ? (widthBxSlider * 42) / 100 : 0,
          slides = $win.width() > 600 ? 5 : 1;

      sldCustomer = bx.bxSlider({
        auto: true,
        autoHover: true,
        minSlides: slides,
        maxSlides: slides,
        slideWidth: widthBxSlider,
        moveSlides: 1,
        nextText: '<i class="icon-arrow-right2"></i>',
        prevText: '<i class="icon-arrow-left2"></i>',
        pager: false,
        onSlidePrev: function($slideElement, oldIndex, newIndex) {
          sldCustomer.goToSlide(newIndex);
          sldCustomer.stopAuto();
          sldCustomer.startAuto();
          return false;
        },
        onSlideNext: function($slideElement, oldIndex, newIndex) {
          sldCustomer.goToSlide(newIndex);
          sldCustomer.stopAuto();
          sldCustomer.startAuto();
          return false;
        }
      });
    }

    if (j('.Bxslider-list').length) {
      var bx = j('.Bxslider-list'),
          widthBxSlider = parseInt(bx.width()),
          widthBxSlider = $win.width() > 600 ? (widthBxSlider * 42) / 100 : 0,
          slides = $win.width() > 600 ? 3 : 1;

      sldExpert = bx.bxSlider({
        auto: true,
        autoHover: true,
        minSlides: slides,
        maxSlides: slides,
        slideWidth: widthBxSlider,
        slideMargin: 15,
        nextText: '<i class="icon-arrow-right2"></i>',
        prevText: '<i class="icon-arrow-left2"></i>',
        pager: false,
        onSlidePrev: function($slideElement, oldIndex, newIndex) {
          sldExpert.goToSlide(newIndex);
          sldExpert.stopAuto();
          sldExpert.startAuto();
          return false;
        },
        onSlideNext: function($slideElement, oldIndex, newIndex) {
          sldExpert.goToSlide(newIndex);
          sldExpert.stopAuto();
          sldExpert.startAuto();
          return false;
        }
        /*onSliderLoad: function() {
          j('.bx-controls-direction a').on('click', function(){
            var i = $(this).attr('data-slide-index');
              sldExpert.goToSlide(i);
              sldExpert.stopAuto();
              sldExpert.startAuto();
              return false;
          });
        }*/
      });
    }
  });
})(jQuery);
