<?php
/**
 * The header for our theme
 *
 * @package jeodotheme
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
    
    <header id="masthead" class="site-header">
        
        <!-- Top Bar: Logo, Date, Profile, Search -->
        <div class="header-top-bar">
            <div class="header-top-container">
                
                <!-- Logo Section -->
                <div class="site-branding">
                    <?php
                    if ( has_custom_logo() ) {
                        the_custom_logo();
                    } else {
                        // Fallback logo with customizer option
                        $logo_text = get_theme_mod( 'jeodo_logo_text', 'COMPANY LOGO' );
                        ?>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="custom-logo-link" rel="home">
                            <div class="logo-placeholder">
                                <?php echo esc_html( $logo_text ); ?>
                            </div>
                        </a>
                        <?php
                    }
                    ?>
                </div>

                <!-- Right Section: Date, Profile, Search -->
                <div class="header-right">
                    <span class="header-date">
                        <?php echo date_i18n( 'Y년 n월 j일' ); ?>
                    </span>
                    
                    <div class="header-actions">
                        <!-- Profile Icon -->
                        <?php if ( is_user_logged_in() ) : ?>
                            <a href="<?php echo esc_url( admin_url() ); ?>" class="profile-link" aria-label="Profile">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M10 10a4 4 0 100-8 4 4 0 000 8zM3 18a7 7 0 0114 0" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                                </svg>
                            </a>
                        <?php else : ?>
                            <a href="<?php echo esc_url( wp_login_url() ); ?>" class="profile-link" aria-label="Login">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M10 10a4 4 0 100-8 4 4 0 000 8zM3 18a7 7 0 0114 0" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                                </svg>
                            </a>
                        <?php endif; ?>
                        
                        <!-- Search Icon -->
                        <button class="search-toggle" aria-label="Search">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M9 17A8 8 0 1 0 9 1a8 8 0 0 0 0 16zM19 19l-4.35-4.35" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </div>
                </div>

            </div>
        </div>

        <!-- Navigation Bar: Categories Menu -->
        <div class="header-navigation-bar">
            <div class="header-nav-container">
                
                <nav id="site-navigation" class="main-navigation">
                    <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                        <span class="menu-icon"></span>
                        <span class="menu-icon"></span>
                        <span class="menu-icon"></span>
                    </button>
                    
                    <div class="nav-menu">
                        <?php
                        // Get all categories
                        $categories = get_categories( array(
                            'orderby' => 'name',
                            'order'   => 'ASC',
                            'hide_empty' => true,
                            'number'  => 10,
                        ) );

                        if ( ! empty( $categories ) ) {
                            echo '<ul id="primary-menu" class="menu">';
                            
                            // Home link
                            $home_class = ( is_home() || is_front_page() ) ? ' current-menu-item' : '';
                            echo '<li class="menu-item' . $home_class . '">';
                            echo '<a href="' . esc_url( home_url( '/' ) ) . '">홈</a>';
                            echo '</li>';
                            
                            // Category links
                            foreach ( $categories as $category ) {
                                $active_class = ( is_category( $category->term_id ) ) ? ' current-menu-item' : '';
                                echo '<li class="menu-item' . $active_class . '">';
                                echo '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '">';
                                echo esc_html( $category->name );
                                echo '</a>';
                                echo '</li>';
                            }
                            
                            echo '</ul>';
                        }
                        ?>
                    </div>
                </nav>

            </div>
        </div>

        <!-- Search Form (Hidden by default) -->
        <div class="header-search-form" style="display: none;">
            <div class="search-form-container">
                <?php get_search_form(); ?>
                <button class="search-close" aria-label="Close search">×</button>
            </div>
        </div>

    </header><!-- #masthead -->