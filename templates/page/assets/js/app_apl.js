var DECENTTHEMES = DECENTTHEMES || {};

(function($){

  // USE STRICT
  "use strict";

  DECENTTHEMES.initialize = {

    init: function(){
      DECENTTHEMES.initialize.defaults();
      DECENTTHEMES.initialize.swiper();
      DECENTTHEMES.initialize.background();
      DECENTTHEMES.initialize.background_parallax();
      DECENTTHEMES.initialize.portfolio_filter();
      DECENTTHEMES.initialize.skills();
      DECENTTHEMES.initialize.owl_slider();
      DECENTTHEMES.initialize.map();
      DECENTTHEMES.initialize.countup();
      DECENTTHEMES.initialize.section_switch();
      DECENTTHEMES.initialize.mixitup();
      DECENTTHEMES.initialize.mobile_menu();

    },
    defaults: function() {
      /* Wow init */
      new WOW().init()

      /* Search Open */
      $('.gp-search').on('click', function(){
        $('#search_popup_wrapper').addClass('dialog--open');
      });

      $('.action').on('click', function(){
        $('#search_popup_wrapper').removeClass('dialog--open');
      });

      $('.dialog__overlay').on('click', function(){
        $('#search_popup_wrapper').removeClass('dialog--open');
      });

      /* JPush Menu Init */
      $('.menu-toggle').jPushMenu();

      /* Loader Init */

      $(".loading").delay(1e3).addClass("loaded");

    },

    mixitup: function() {
      $('.portfolio_container').mixItUp();

      $('.portfolioFilter').each( function( i, buttonGroup ) {
        var $buttonGroup = $( buttonGroup );
        $buttonGroup.on( 'click', 'a', function(e) {
          e.preventDefault();
          $('.current', $buttonGroup).removeClass('current');
          $( this ).addClass('current');
        });
      });
    },

    swiper: function() {
      $('[data-carousel="swiper"]').each( function() {

        var $this       = $(this);
        var $container   = $this.find('[data-swiper="container"]');
        var $asControl   = $this.find('[data-swiper="ascontrol"]');

        var conf = function(element) {
          var obj = {
            slidesPerView: element.data('items'),
            centeredSlides: element.data('center'),
            loop: element.data('loop'),
            initialSlide: element.data('initial'),
            effect: element.data('effect'),
            spaceBetween: element.data('space'),
            autoplay: element.data('autoplay'),
            direction: element.data('direction'),
            paginationType: element.data('pagination-type'),
            paginationClickable: true,
            breakpoints: element.data('breakpoints'),
            slideToClickedSlide: element.data('click-to-slide'),
            loopedSlides: element.data('looped'),
            fade: {
              crossFade: element.data('crossfade')
            },
            speed: 700
          };
          return obj;
        }

        var $primaryConf = conf($container);
        $primaryConf.prevButton = $this.find('[data-swiper="prev"]');
        $primaryConf.nextButton = $this.find('[data-swiper="next"]');
        $primaryConf.pagination = $this.find('[data-swiper="pagination"]');

        var $ctrlConf = conf($asControl);

        function animateSwiper(selector, slider) {
          var makeAnimated = function animated() {
            selector.find('.swiper-slide-active [data-animate]').each(function(){
              var anim = $(this).data('animate');
              var delay = $(this).data('delay');
              var duration = $(this).data('duration');

              $(this).addClass(anim + ' animated')
              .css({
                webkitAnimationDelay: delay,
                animationDelay: delay,
                webkitAnimationDuration: duration,
                animationDuration: duration
              })
              .one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
                $(this).removeClass(anim + ' animated');
              });
            });
          };
          makeAnimated();
          slider.on('SlideChangeStart', function() {
            selector.find('[data-animate]').each(function(){
              var anim = $(this).data('animate');
              $(this).removeClass(anim + ' animated');
            });
          });
          slider.on('SlideChangeEnd', makeAnimated);
        };

        if ($container.length) {
          var $swiper = new Swiper( $container, $primaryConf);
          animateSwiper($this, $swiper);

          if ($asControl.length) {
            var $control = new Swiper( $asControl, $ctrlConf);
            $swiper.params.control = $control;
            $control.params.control = $swiper;
          }

        } else {
          console.log('Swiper container is not defined!');
        };

      });
    },

    background: function() {
      $('[data-bg-image]').each(function() {

        var img = $(this).data('bg-image');

        $(this).css({
          backgroundImage: 'url(' + img + ')',
        });
      });

      $('[data-bg-color]').each(function() {

        var value = $(this).data('bg-color');

        $(this).css({
          backgroundColor: value,
        });
      });
    },

    background_parallax: function() {
      $('[data-parallax="image"]').each(function() {

        var actualHeight = $(this).position().top;
        var speed      = $(this).data('parallax-speed');
        var reSize     = actualHeight - $(window).scrollTop();
        var makeParallax = -(reSize/2);
        var posValue   = makeParallax + "px";

        $(this).css({
          backgroundPosition: '50% ' + posValue,
        });
      });
    },

    mobile_menu: function() {
      var $hasSub   = $('.menu-item-has-children'),
      $children   = $hasSub.children('.sub-menu');

      $hasSub.each(function() {
        var $this = $(this),
        $sub = $this.children('.sub-menu');

        $this.on('click', '> a', function(event) {

          if ($(this).parent('.menu-item-has-children').hasClass('children-menu-visible')) {
            $this.removeClass('children-menu-visible');
          } else {
            $hasSub.not($this.parents()).removeClass('children-menu-visible');
            $this.addClass('children-menu-visible');
          }
          event.preventDefault();
          event.stopPropagation();
        });
      });
    },

    portfolio_filter: function() {

      $(".portfolio_container").each(function () {
        $(".dt-popup-link", this).magnificPopup({
          type: "image",

          gallery: {
            enabled: true
          }

        });
      });
    },

    countup: function() {
      var options = {
        useEasing : true,
        useGrouping : true,
        separator : ',',
        decimal : '.',
        prefix : '',
        suffix : ''
      };

      var counteEl = $('[data-counter]');

      if (counteEl) {
        counteEl.each(function() {
         var val = $(this).data('counter');

         var countup = new CountUp(this, 0, val, 0, 2.5, options);
         $(this).appear(function() {
          countup.start();
        }, {accX: 0, accY: 0})
       });
      }
    },

    skills: function() {
      $(function() {
        $('progress').each(function() {

          var max = $(this).val();

          $(this).appear(function() {
            $(this).val(0).animate({ value: max }, { duration: 2000});
          }, {accX: 0, accY: 0})
        });
      });
    },

    owl_slider: function() {
      $('#feedback-slider').owlCarousel({
        loop:true,
        margin:10,
        items : 1,
        nav:true,
        autoplay:true,
        autoplayTimeout:5000,
        autoplayHoverPause:true,
        smartSpeed: 600
      })

      $('#feedback-slider2').owlCarousel({
        loop:true,
        margin:10,
        items : 3,
        nav:false,
        autoplay:true,
        autoplayTimeout:5000,
        autoplayHoverPause:true,
        smartSpeed: 600,
        responsiveClass:true,
        responsive:{
          0:{
            items:1,
            nav:true
          },
          500:{
            items:2,
            nav:false
          },
          900:{
            items:3
          }
        }
      })

      $('.brand').owlCarousel({
        loop:true,
        margin:10,
        items : 5,
        nav:false,
        autoplay:true,
        smartSpeed: 600,
        autoplayTimeout:5000,
        autoplayHoverPause:true,
        responsiveClass:true,
        responsive:{
          0:{
            items:1,
            nav:true
          },
          500:{
            items:2,
            nav:false
          },
          768:{
            items:2,
            nav:false
          },
          900:{
            items:3,
            nav:true,
            loop:false
          },
          1024:{
            items:5,
            nav:true,
            loop:false
          }
        }
      })

      $('#team-slider').owlCarousel({
        loop:true,
        margin:30,
        items : 3,
        autoplay:true,
        smartSpeed: 600,
        navigation:true,
        autoplayTimeout:5000,
        autoplayHoverPause:true,
        navText: [" "],
        responsiveClass:true,
        responsive:{
          0:{
            items:1,
            nav:false
          },
          600:{
            items:2,
            nav:false
          },
          900:{
            items:3,
            nav:true
          }
        }
      })
    },

    map: function() {

      $('.gmap3-area').each(function() {
        var $this  = $(this),
        key    = $this.data('key'),
        lat    = $this.data('lat'),
        lng    = $this.data('lng'),
        mrkr   = $this.data('mrkr');

        $this.gmap3({
          center: [lat, lng],
          zoom: 16,
          scrollwheel: false,
          mapTypeId : google.maps.MapTypeId.ROADMAP,
          styles: [{"featureType":"landscape.man_made","elementType":"geometry","stylers":[{"color":"#f7f1df"}]},{"featureType":"landscape.natural","elementType":"geometry","stylers":[{"color":"#d0e3b4"}]},{"featureType":"landscape.natural.terrain","elementType":"geometry","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"poi.business","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"poi.medical","elementType":"geometry","stylers":[{"color":"#fbd3da"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#bde6ab"}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"on"}]},{"featureType":"road","elementType":"labels.icon","stylers":[{"visibility":"on"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffe15f"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#efd151"}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"road.local","elementType":"geometry.fill","stylers":[{"color":"black"}]},{"featureType":"transit.station.airport","elementType":"geometry.fill","stylers":[{"color":"#cfb2db"}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#a2daf2"}]}]
        })
        .marker(function (map) {
          return {
            position: map.getCenter(),
            icon: mrkr
          };
        })

      });
    },

    navbar_scroll: function() {
      if ($(window).scrollTop() > 120 ){
        $('#header').addClass('navbar-bg');
      } else {
        $('#header').removeClass('navbar-bg');
      }

      if ($(window).scrollTop() > 200){
        $('.return-to-top').addClass('back-top');
      } else {
        $('.return-to-top').removeClass('back-top');
      }

    },

    section_switch: function() {
      $('[data-type="section-switch"], .gp-primary-menu a, .menu-menu a').on('click', function() {
        if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
          var target = $(this.hash);
          if (target.length > 0) {

            target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
            $('html,body').animate({
              scrollTop: target.offset().top
            }, 1000);
            return false;
          }
        }
      });
    },

  };


  DECENTTHEMES.documentOnReady = {
    init: function(){
      DECENTTHEMES.initialize.init();
       $('.portfolio_container').mixItUp();
    },
  };

  DECENTTHEMES.documentOnLoad = {
    init: function(){
       DECENTTHEMES.initialize.mixitup();


    },

  };

  DECENTTHEMES.documentOnScroll = {
    init: function(){
      DECENTTHEMES.initialize.navbar_scroll();
      DECENTTHEMES.initialize.background_parallax();


    },
  };

  $(document).ready( DECENTTHEMES.documentOnReady.init );
  $(window).on( 'load', DECENTTHEMES.documentOnLoad.init );
  $(document).on( 'scroll', DECENTTHEMES.documentOnScroll.init );

})(jQuery);
