jQuery(document).ready(function($) {
    
    // Calculate and set body padding based on header height
    function adjustBodyPadding() {
        var headerHeight = $('.site-header').outerHeight();
        var adminBarHeight = $('#wpadminbar').length ? $('#wpadminbar').outerHeight() : 0;
        $('body').css('padding-top', headerHeight + 'px');
    }
    
    // Adjust on load and resize
    adjustBodyPadding();
    $(window).on('resize', adjustBodyPadding);
    
    // Mobile Menu Toggle
    $('.menu-toggle').on('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        
        $(this).toggleClass('active');
        $('.main-navigation .nav-menu').toggleClass('active');
        
        // Recalculate body padding when menu opens
        setTimeout(adjustBodyPadding, 10);
        
        // Animate menu icon to X
        if ($(this).hasClass('active')) {
            $(this).find('.menu-icon:nth-child(1)').css({
                'transform': 'rotate(45deg) translateY(8px)'
            });
            $(this).find('.menu-icon:nth-child(2)').css({
                'opacity': '0'
            });
            $(this).find('.menu-icon:nth-child(3)').css({
                'transform': 'rotate(-45deg) translateY(-8px)'
            });
        } else {
            $(this).find('.menu-icon').css({
                'transform': 'none',
                'opacity': '1'
            });
        }
    });

    // Search Toggle
    $('.search-toggle').on('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        
        $('.header-search-form').slideToggle(200, function() {
            adjustBodyPadding();
        });
        
        setTimeout(function() {
            $('.header-search-form .search-field').focus();
        }, 200);
    });

    // Close search button
    $('.search-close').on('click', function(e) {
        e.preventDefault();
        $('.header-search-form').slideUp(200, function() {
            adjustBodyPadding();
        });
    });

    // Close search when clicking outside
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.search-toggle, .header-search-form').length) {
            if ($('.header-search-form').is(':visible')) {
                $('.header-search-form').slideUp(200, function() {
                    adjustBodyPadding();
                });
            }
        }
    });

    // Close mobile menu when clicking outside
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.menu-toggle, .main-navigation').length) {
            if ($('.menu-toggle').hasClass('active')) {
                $('.menu-toggle').removeClass('active');
                $('.main-navigation .nav-menu').removeClass('active');
                $('.menu-toggle .menu-icon').css({
                    'transform': 'none',
                    'opacity': '1'
                });
                setTimeout(adjustBodyPadding, 10);
            }
        }
    });

    // Close mobile menu when clicking a menu item
    $('.main-navigation .menu-item a').on('click', function() {
        if ($(window).width() <= 968) {
            $('.menu-toggle').removeClass('active');
            $('.main-navigation .nav-menu').removeClass('active');
            $('.menu-toggle .menu-icon').css({
                'transform': 'none',
                'opacity': '1'
            });
            setTimeout(adjustBodyPadding, 10);
        }
    });

    // Highlight active category
    var currentUrl = window.location.href;
    $('.main-navigation .menu-item a').each(function() {
        if (this.href === currentUrl) {
            $(this).parent().addClass('current-menu-item');
        }
    });

    // Prevent body scroll when mobile menu is open
    $('.menu-toggle').on('click', function() {
        if ($(this).hasClass('active') && $(window).width() <= 968) {
            $('body').addClass('menu-open');
        } else {
            $('body').removeClass('menu-open');
        }
    });
    
    // Add scroll class for styling (optional)
    $(window).on('scroll', function() {
        if ($(window).scrollTop() > 50) {
            $('.site-header').addClass('scrolled');
        } else {
            $('.site-header').removeClass('scrolled');
        }
    });

});