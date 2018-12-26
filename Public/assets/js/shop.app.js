/*
 * Template Name: Unify - Responsive Bootstrap Template
 * Description: Business, Corporate, Portfolio, E-commerce and Blog Theme.
 * Version: 1.6
 * Author: @htmlstream
 * Website: http://htmlstream.com
*/

var App = function () {

    function handleBootstrap() {
        /*Bootstrap Carousel*/
        $('.carousel').carousel({
            interval: 15000,
            pause: 'hover'
        });

        /*Tooltips*/
        $('.tooltips').tooltip();
        $('.tooltips-show').tooltip('show');      
        $('.tooltips-hide').tooltip('hide');       
        $('.tooltips-toggle').tooltip('toggle');       
        $('.tooltips-destroy').tooltip('destroy');       

        /*Popovers*/
        $('.popovers').popover();
        $('.popovers-show').popover('show');
        $('.popovers-hide').popover('hide');
        $('.popovers-toggle').popover('toggle');
        $('.popovers-destroy').popover('destroy');
    }

    function handleSearchV1() {
        $('.search-button').click(function () {
            $('.search-open').slideDown();
        });

        $('.search-close').click(function () {
            $('.search-open').slideUp();
        });

        $(window).scroll(function(){
          if($(this).scrollTop() > 1) $('.search-open').fadeOut('fast');
        });

    }

    function handleToggle() {
        $('.list-toggle').on('click', function() {
            $(this).toggleClass('active');
        });

        /*
        $('#serviceList').on('shown.bs.collapse'), function() {
            $(".servicedrop").addClass('glyphicon-chevron-up').removeClass('glyphicon-chevron-down');
        }

        $('#serviceList').on('hidden.bs.collapse'), function() {
            $(".servicedrop").addClass('glyphicon-chevron-down').removeClass('glyphicon-chevron-up');
        }
        */
    }

    function handleBoxed() {
        $('.boxed-layout-btn').click(function(){
            $(this).addClass("active-switcher-btn");
            $(".wide-layout-btn").removeClass("active-switcher-btn");
            $("body").addClass("boxed-layout container");
        });
        $('.wide-layout-btn').click(function(){
            $(this).addClass("active-switcher-btn");
            $(".boxed-layout-btn").removeClass("active-switcher-btn");
            $("body").removeClass("boxed-layout container");
        });
    }

    function handleHeader() {
         $(window).scroll(function() {
            if ($(window).scrollTop()>100){
                $(".header-fixed .header-static").addClass("header-fixed-shrink");
            }
            else {
                $(".header-fixed .header-static").removeClass("header-fixed-shrink");
            }
        });
    }

    function handleMegaMenu() {
        $(document).on('click', '.mega-menu .dropdown-menu', function(e) {
            e.stopPropagation()
        })
    }

    function handleScrollBar() {
        $(document).ready(function ($) {
            "use strict";
            $('.contentHolder').perfectScrollbar();
        });
    }

    return {
        init: function () {
            handleBootstrap();
            handleSearchV1();
            handleToggle();
            handleBoxed();
            handleHeader();
            handleMegaMenu();
            handleScrollBar();
        },

        initCounter: function () {
            $('.counter').counterUp({
                delay: 10,
                time: 1000
            });
        },

        initParallaxBg: function () {
            $('.parallaxBg').parallax("50%", 0.2);
            $('.parallaxBg1').parallax("50%", 0.4);
        },

        initMouseWheel: function () {
            $('.slider-snap').noUiSlider({
                start: [ 120, 420 ],
                snap: true,
                connect: true,
                range: {
                    'min': 0,
                    '5%': 20,
                    '10%': 40,
                    '15%': 80,
                    '20%': 120,
                    '25%': 160,
                    '30%': 200,
                    '35%': 240,
                    '40%': 280,
                    '50%': 300,
                    '60%': 340,
                    '70%': 380,
                    '80%': 420,
                    '90%': 460,
                    'max': 500
                }
            });
            $('.slider-snap').Link('lower').to($('.slider-snap-value-lower'));
            $('.slider-snap').Link('upper').to($('.slider-snap-value-upper'));
        },
    };

}();