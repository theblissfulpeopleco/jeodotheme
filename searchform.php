<?php
/**
 * Custom template for displaying the search form with modern styling.
 *
 * @package jeodotheme
 */
?>

<form role="search" method="get" class="search-form-wrapper" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label class="custom-hero-search-container">
        <span class="search-icon-wrapper">
            <svg class="search-icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        </span>

        <input 
            type="search" 
            class="search-field" 
            placeholder="<?php echo esc_attr_x( '대형 카페 카테고리', 'placeholder', 'jeodotheme' ); ?>" 
            value="<?php echo get_search_query(); ?>" 
            name="s" 
        />
        <span class="screen-reader-text"><?php echo _x( 'Search for:', 'label', 'jeodotheme' ); ?></span>
    </label>
    
    <button type="submit" class="search-submit-arrow">
        <svg class="arrow-icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
    </button>
</form>