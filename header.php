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
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">

	<header id="masthead" class="site-header">
        <div class="header-container">
            
            <!-- Header Top Row - 3 Banner Boxes -->
            <div class="header-top-row">
                <div class="banner-box">
                    <a href="#">COMPANY LOGO</a>
                </div>
                <div class="banner-box">
                    <a href="#">COMPANY LOGO</a>
                </div>
                <div class="banner-box">
                    <a href="#">COMPANY LOGO</a>
                </div>
            </div>

            <!-- Header Middle Row - Main Logo Center -->
            <div class="header-mid-row">
                <div class="mid-logo-center">
                    <a href="<?php echo home_url(); ?>" class="main-logo">
                        COMPANY LOGO
                    </a>
                </div>

                <div class="header-utils-right">
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

            <!-- Navigation Menu - Recent Posts -->
            <nav id="site-navigation" class="main-navigation">
                <div class="nav-menu-wrapper">
                    <?php
                    // Get recent posts for menu
                    $recent_posts = new WP_Query(array(
                        'posts_per_page' => 10,
                        'orderby' => 'date',
                        'order' => 'DESC'
                    ));
                    
                    if ($recent_posts->have_posts()) :
                        echo '<ul id="primary-menu" class="menu">';
                        
                        while ($recent_posts->have_posts()) : $recent_posts->the_post();
                            // Get category for first item
                            $category = get_the_category();
                            $cat_name = !empty($category) ? $category[0]->name : '';
                            
                            // Get title and limit to 20 characters
                            $title = get_the_title();
                            $short_title = mb_strlen($title) > 20 ? mb_substr($title, 0, 20) . '...' : $title;
                            
                            echo '<li class="menu-item">';
                            echo '<a href="' . get_permalink() . '">';
                            
                            // Show category for first item only
                            if ($recent_posts->current_post == 0 && $cat_name) {
                                echo '<span class="menu-category">' . esc_html($cat_name) . '</span>';
                            }
                            
                            echo '<span class="menu-title">' . esc_html($short_title) . '</span>';
                            echo '</a>';
                            echo '</li>';
                        endwhile;
                        
                        echo '</ul>';
                        wp_reset_postdata();
                    endif;
                    ?>
                </div>
            </nav>

        </div>
	</header>

	<!-- Search Overlay (optional) -->
	<div class="search-overlay" style="display: none;">
		<div class="search-overlay-content">
			<button class="search-close">&times;</button>
			<?php get_search_form(); ?>
		</div>
	</div>