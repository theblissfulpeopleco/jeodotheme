<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package jeodotheme
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;400;700&display=swap" rel="stylesheet">
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">

	<header id="masthead" class="site-header">
        <div class="header-container">
            <div class="site-branding">
                <?php the_custom_logo(); ?>
                <?php if ( is_front_page() && is_home() ) : ?>
                    <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                <?php else : ?>
                    <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
                <?php endif; ?>
            </div><nav id="site-navigation" class="main-navigation">
                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'menu-1',
                        'menu_id'        => 'primary-menu',
                    )
                );
                ?>
            </nav><div class="header-utils">
                <button class="search-toggle"><i class="icon-search"></i> 🔍</button>
                <a href="/login" class="user-login"><i class="icon-user"></i> 👤</a>
            </div>
        </div>
	</header>```

### 2. The Homepage Layout (`index.php`)
Referencing **Image 2**: There is a featured top section and a list bottom section. This code sets up the main grid.

```php
<?php get_header(); ?>

<main id="primary" class="site-main">
    <div class="container main-grid">
        
        <div class="content-area">
            
            <div class="featured-news-section">
                <h2>Today's Major News</h2>
                </div>

            <div class="latest-news-list">
                <?php
                if ( have_posts() ) :
                    while ( have_posts() ) :
                        the_post();
                        ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class('news-list-item'); ?>>
                            <?php if ( has_post_thumbnail() ) : ?>
                                <div class="post-thumbnail">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('medium'); // Make sure to add_image_size in functions.php ?>
                                    </a>
                                </div>
                            <?php endif; ?>

                            <div class="entry-wrapper">
                                <header class="entry-header">
                                    <?php the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
                                </header>
                                <div class="entry-summary">
                                    <?php the_excerpt(); ?>
                                </div>
                                <div class="entry-meta">
                                    <?php echo get_the_date(); ?>
                                </div>
                            </div>
                        </article>
                        <?php
                    endwhile;

                    the_posts_navigation();

                else :
                    // fallback
                endif;
                ?>
            </div>
        </div> <aside class="sidebar-area">
            <?php get_sidebar(); ?>
        </aside>

    </div> </main>

<?php get_footer(); ?>