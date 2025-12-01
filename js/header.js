/**
 * Header JavaScript
 * File: js/header.js
 */

(function($) {
    'use strict';

    $(document).ready(function() {
        
        // Search Toggle
        $('.search-toggle').on('click', function(e) {
            e.preventDefault();
            $('.search-overlay').fadeIn(300);
            $('.search-overlay .search-field').focus();
        });
        
        // Close Search Overlay
        $('.search-close').on('click', function(e) {
            e.preventDefault();
            $('.search-overlay').fadeOut(300);
        });
        
        // Close on ESC key
        $(document).on('keydown', function(e) {
            if (e.key === 'Escape' || e.keyCode === 27) {
                $('.search-overlay').fadeOut(300);
            }
        });
        
        // Close when clicking outside
        $('.search-overlay').on('click', function(e) {
            if ($(e.target).is('.search-overlay')) {
                $(this).fadeOut(300);
            }
        });
        
    });

})(jQuery);