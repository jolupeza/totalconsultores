'use strict';

var j = jQuery.noConflict();

(function ($) {
  var $win = j(window),
      $doc = j(document),
      $animationElements = j('.animation-element');

  function affixHeader() {
    j('.Header').affix({
      offset: {
        top: function () {
          return j('.Carousel--home').outerHeight(true) / 3;
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

  $win.on('scroll', function(event) {
    var arrow = j('.ArrowTop');

    if ( j(this).scrollTop() > 150) {
      arrow.fadeIn();
    } else {
      arrow.fadeOut();
    }
  });

  $doc.on('ready', function () {
    // affixHeader();

    // j('.ArrowTop').on('click', function(ev){
    //   ev.preventDefault();
    //   j('html, body').animate({scrollTop: 0}, 800);
    // });

    // j('.js-move-scroll').on('click', function(event) {
    //   event.preventDefault();
    //   var $this = j(this);
    //   var dest = $this.data('href');

    //   dest = (typeof dest === 'undefined') ? $this.attr('href') : dest;

    //   dest = (dest.charAt(0) === '#') ? dest : '#' + dest;

    //   j('html, body').stop().animate({
    //     scrollTop: j(dest).offset().top
    //   }, 2000, 'easeInOutExpo');
    // });
  });
})(jQuery);
