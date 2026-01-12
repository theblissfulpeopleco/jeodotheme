/**
 * AJAX Pagination for Category Archive
 * File: js/category-ajax.js
 */

(function($) {
    'use strict';

    // AJAX Pagination Handler for Category Pages
    function initCategoryAjaxPagination() {
        $(document).on('click', '.category-pagination .page-numbers', function(e) {
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
            $('#category-posts-container').addClass('loading');
            
            // Scroll to top of category posts smoothly
            $('html, body').animate({
                scrollTop: $('.category-header').offset().top - 100
            }, 400);
            
            // AJAX request to load new content
            $.ajax({
                url: pageUrl,
                type: 'GET',
                success: function(response) {
                    var $response = $(response);
                    
                    // Extract new content
                    var newContent = $response.find('#category-posts-container').html();
                    var newPagination = $response.find('#category-pagination').html();
                    
                    // Replace content
                    $('#category-posts-container').html(newContent);
                    $('#category-pagination').html(newPagination);
                    
                    // Remove loading state
                    $('#category-posts-container').removeClass('loading');
                    
                    // Update URL without reload
                    if (history.pushState) {
                        history.pushState(null, null, pageUrl);
                    }
                },
                error: function() {
                    // Remove loading state on error
                    $('#category-posts-container').removeClass('loading');
                    
                    // Fallback to normal navigation
                    window.location.href = pageUrl;
                }
            });
            
            return false;
        });
    }
    
    // Initialize when document is ready
    $(document).ready(function() {
        initCategoryAjaxPagination();
    });

})(jQuery);