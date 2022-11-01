(function($) {
    "use strict";

    $(window).on('elementor/frontend/init', function () {

        /* project slider */
        elementorFrontend.hooks.addAction('frontend/element_ready/ova_project_slider.default', function(){

            $(".slide-project").each(function(){
                var owlsl = $(this) ;
                var owlsl_ops = owlsl.data('options') ? owlsl.data('options') : {};

                var responsive_value = {
                    0:{
                        items:1,
                        stagePadding:0,
                    },
                    767:{
                        items:2,
                        stagePadding:0,
                    },
                    1170:{
                        items:3,
                        stagePadding:0,
                    },
                    1330:{
                        items:owlsl_ops.items
                    }
                };
              
                owlsl.owlCarousel({
                    stagePadding : owlsl_ops.stagePadding,
                    margin: owlsl_ops.margin,
                    items: owlsl_ops.items,
                    loop: owlsl_ops.loop,
                    autoplay: owlsl_ops.autoplay,
                    autoplayTimeout: owlsl_ops.autoplayTimeout,
                    center: owlsl_ops.center,
                    nav: owlsl_ops.nav,
                    dots: owlsl_ops.dots,
                    thumbs: owlsl_ops.thumbs,
                    autoplayHoverPause: owlsl_ops.autoplayHoverPause,
                    slideBy: owlsl_ops.slideBy,
                    smartSpeed: owlsl_ops.smartSpeed,
                    navText:[
                        '<i class="ovaicon-back"></i>',
                        '<i class="ovaicon-next"></i>'
                    ],
                    responsive: responsive_value,
                });

                /* Fixed WCAG */
                owlsl.find(".owl-nav button.owl-prev").attr("title", "Previous");
                owlsl.find(".owl-nav button.owl-next").attr("title", "Next");
                owlsl.find(".owl-dots button").attr("title", "Dots");

            });
        });
      /* end project slider */

      /* project slider 2 */
        elementorFrontend.hooks.addAction('frontend/element_ready/ova_project_slider2.default', function(){

           $(".slide-project-2").each(function(){
                 var owlsl = $(this) ;
                var owlsl_ops = owlsl.data('options') ? owlsl.data('options') : {};

                var responsive_value = {
                     0:{
                        items:1,
                    },
                    576:{
                        items:1,
                    },
                    992:{
                        items:2
                    },
                    1170:{
                        items:owlsl_ops.items
                    }
                };
              
                owlsl.owlCarousel({
                    margin: owlsl_ops.margin,
                    items: owlsl_ops.items,
                    loop: owlsl_ops.loop,
                    autoplay: owlsl_ops.autoplay,
                    autoplayTimeout: owlsl_ops.autoplayTimeout,
                    center: owlsl_ops.center,
                    nav: owlsl_ops.nav,
                    dots: owlsl_ops.dots,
                    thumbs: owlsl_ops.thumbs,
                    autoplayHoverPause: owlsl_ops.autoplayHoverPause,
                    slideBy: owlsl_ops.slideBy,
                    smartSpeed: owlsl_ops.smartSpeed,
                    navText:[
                        '<i class="ovaicon-back"></i>',
                        '<i class="ovaicon-next"></i>'
                    ],
                    responsive: responsive_value,
                });

                /* Fixed WCAG */
                owlsl.find(".owl-nav button.owl-prev").attr("title", "Previous");
                owlsl.find(".owl-nav button.owl-next").attr("title", "Next");
                owlsl.find(".owl-dots button").attr("title", "Dots");

            });
        });
        /* end project slider 2 */

    });

})(jQuery);