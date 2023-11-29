$(document).ready(function(){ 
        $('ul.tabs li').click(function () {
            var tab_id = $(this).attr('href');

            $('ul.tabs li').removeClass('current');
            $('.tab-content').removeClass('current');

            $(this).addClass('current');
            $("#" + tab_id).addClass('current');
        })
          $('.test-carousel').owlCarousel({ 
           loop:true,
           margin:10,
           autoplay:true,
           autoplayTimeout:2000,
           responsiveClass:true,
           dots:false,
           nav:false,
           responsive:{
               0:{
                   items:1,
                   nav:false
               },
               600:{
                   items:2,
                   nav:false
               },
               1000:{
                   items:3
               }
           }
         })
         $('.logo-carousel').owlCarousel({
            loop:true,
            margin:10,
            autoplay:false,
            autoplayTimeout:2000,
            responsiveClass:true,
            dots:false,
            nav:false,
            responsive:{
                0:{
                    items:1,
                    nav:false
                },
                600:{
                    items:3,
                    nav:false
                },
                1000:{
                    items:5
                }
            }
          })
         $('.counter').counterUp({
            delay: 10,
            time: 1000
        });
         });

         