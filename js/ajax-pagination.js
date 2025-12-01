/**
 * AJAX Pagination for News Layout
 * File: js/ajax-pagination.js
 */

(function($) {
    'use strict';

    // AJAX Pagination Handler
    function initAjaxPagination() {
        $(document).on('click', '.news-pagination .page-numbers', function(e) {
            e.preventDefault();
            
            var $this = $(this);
            
            // Don't do anything if clicking current page or dots
            if ($this.hasClass('current') || $this.hasClass('dots')) {
                return false;
            }
            
            var pageUrl = $this.attr('href');
            
            if (!pageUrl) {
                return false;
            }
            
            // Add loading state
            $('#news-list-ajax').addClass('loading');
            
            // Scroll to top of news list smoothly
            $('html, body').animate({
                scrollTop: $('#news-list-ajax').offset().top - 100
            }, 400);
            
            // AJAX request to load new content
            $.ajax({
                url: pageUrl,
                type: 'GET',
                success: function(response) {
                    var $response = $(response);
                    
                    // Extract new content
                    var newContent = $response.find('#news-list-ajax').html();
                    var newPagination = $response.find('#news-pagination').html();
                    
                    // Replace content
                    $('#news-list-ajax').html(newContent);
                    $('#news-pagination').html(newPagination);
                    
                    // Remove loading state
                    $('#news-list-ajax').removeClass('loading');
                    
                    // Update URL without reload
                    if (history.pushState) {
                        history.pushState(null, null, pageUrl);
                    }
                },
                error: function() {
                    // Remove loading state on error
                    $('#news-list-ajax').removeClass('loading');
                    
                    // Fallback to normal navigation
                    window.location.href = pageUrl;
                }
            });
            
            return false;
        });
    }
    
    // Initialize when document is ready
    $(document).ready(function() {
        initAjaxPagination();
    });

})(jQuery);