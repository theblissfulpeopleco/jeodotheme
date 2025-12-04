<?php
/**
 * The header for our theme
 * Update: User Icon links to the custom Login Page
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        .header-top-row, .banner-box { display: none !important; }
    </style>
    
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">

    <?php 
    // Check if Elementor Pro Theme Builder is active and a Header template is applied
    if ( function_exists( 'elementor_theme_do_location' ) && elementor_theme_do_location( 'header' ) ) {
        // Elementor Pro is handling the header.
    } else {
        // Fall back to the custom hardcoded header structure.
    ?>
    
        <header id="masthead" class="site-header">
            <div class="header-container"> 
                
                <div class="header-mid-row header-flex-layout" style="display: flex !important; align-items: center !important; justify-content: space-between !important; padding: 15px 20px;">
                    
                    <div class="header-logo">
                        <?php 
                        // Logo logic - Ensures the logo is retrieved and correctly wrapped
                        $custom_logo_id = get_theme_mod( 'custom_logo' );
                        $logo_content = '';

                        if ( $custom_logo_id ) {
                            $logo_content = wp_get_attachment_image( $custom_logo_id, 'full', false, array( 
                                'class' => 'custom-logo',
                                // INLINE STYLE FORCING SIZE: Keeps the image small
                                'style' => 'max-height: 80px !important; width: auto !important;' 
                            ) );
                        } else {
                            $logo_content = get_bloginfo( 'name' );
                        }

                        if ( ! empty( $logo_content ) ) :
                        ?>
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="main-logo custom-logo-link">
                                <?php echo $logo_content; ?>
                            </a>
                        <?php endif; ?>
                    </div>

                    <div class="header-utils-right" style="position: static !important; transform: none !important;">
                        <span class="date-display">
                            <?php echo date_i18n( 'Y년 n월 j일' ); ?>
                        </span>
                        
                        <?php if ( is_user_logged_in() ) : ?>
                            <a href="<?php echo home_url('/account'); ?>" class="icon-link" aria-label="My Account">
                                <i class="fa-regular fa-user"></i>
                            </a>
                        <?php else : ?>
                            <a href="<?php echo home_url('/login'); ?>" class="icon-link" aria-label="Login">
                                <i class="fa-regular fa-user"></i>
                            </a>
                        <?php endif; ?>

                        <button class="icon-btn search-toggle" aria-label="Search">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </div> 
              <nav id="site-navigation" class="main-navigation">
                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'menu-1',
                        'menu_id'        => 'primary-menu',
                        'container'      => false, 
                    )
                );
                ?>
            </nav>
            </div> </header>
    <?php } // End Elementor fallback check ?>

    <div class="search-overlay" style="display: none;">
        <div class="search-overlay-content">
            <button class="search-close">&times;</button>
            <?php get_search_form(); ?>
        </div>
    </div>
    
    <div id="content" class="site-content">
    <div id="primary" class="content-area">
    <main id="main" class="site-main">