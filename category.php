<?php
/**
 * The template for displaying category archives
 *
 * @package jeodotheme
 */

get_header();
?>

<div class="category-archive-wrapper">
    <!-- Left Content Area -->
    <div class="category-content-area">
        <div class="category-header">
            <h1 class="category-title"><?php single_cat_title(); ?></h1>
            <?php if ( category_description() ) : ?>
                <div class="category-description"><?php echo category_description(); ?></div>
            <?php endif; ?>
        </div>

        <div id="category-posts-container" class="category-posts-grid">
            <?php if ( have_posts() ) : ?>
                <?php while ( have_posts() ) : the_post(); ?>
                    <article class="category-post-card">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="category-post-thumbnail">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('medium_large'); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        
                        <div class="category-post-content">
                            <div class="category-post-meta">
                                <span class="post-category">
                                    <?php 
                                    $categories = get_the_category();
                                    if ( ! empty( $categories ) ) {
                                        echo esc_html( $categories[0]->name );
                                    }
                                    ?>
                                </span>
                                <span class="post-date"><?php echo get_the_date(); ?></span>
                            </div>
                            
                            <h2 class="category-post-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                            
                            <div class="category-post-excerpt">
                                <?php echo wp_trim_words( get_the_excerpt(), 30, '...' ); ?>
                            </div>
                            
                            <a href="<?php the_permalink(); ?>" class="read-more-link">
                                더 읽기 →
                            </a>
                        </div>
                    </article>
                <?php endwhile; ?>
            <?php else : ?>
                <p>게시물이 없습니다.</p>
            <?php endif; ?>
        </div>

        <!-- AJAX Pagination -->
        <div id="category-pagination" class="category-pagination">
            <?php
            $big = 999999999;
            echo paginate_links( array(
                'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                'format' => '?paged=%#%',
                'current' => max( 1, get_query_var('paged') ),
                'total' => $GLOBALS['wp_query']->max_num_pages,
                'prev_text' => '←',
                'next_text' => '→',
                'type' => 'list',
                'end_size' => 1,
                'mid_size' => 2,
            ) );
            ?>
        </div>
    </div>

    <!-- Right Sidebar Area -->
    <aside class="category-sidebar">
        <?php if ( is_active_sidebar( 'category-sidebar' ) ) : ?>
            <?php dynamic_sidebar( 'category-sidebar' ); ?>
        <?php else : ?>
            <!-- Default Sidebar Content -->
            <div class="sidebar-widget">
                <h4 class="widget-title">인기 게시물</h4>
                <?php
                $popular_posts = new WP_Query( array(
                    'posts_per_page' => 5,
                    'meta_key' => 'post_views_count',
                    'orderby' => 'meta_value_num',
                    'order' => 'DESC'
                ) );
                
                if ( $popular_posts->have_posts() ) : ?>
                    <ul class="popular-posts-list">
                        <?php while ( $popular_posts->have_posts() ) : $popular_posts->the_post(); ?>
                            <li class="popular-post-item">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <div class="popular-post-thumb">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail('thumbnail'); ?>
                                        </a>
                                    </div>
                                <?php endif; ?>
                                <div class="popular-post-info">
                                    <h5 class="popular-post-title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h5>
                                    <span class="popular-post-date"><?php echo get_the_date(); ?></span>
                                </div>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                    <?php wp_reset_postdata(); ?>
                <?php endif; ?>
            </div>

            <div class="sidebar-widget">
                <h4 class="widget-title">최근 게시물</h4>
                <?php
                $recent_posts = new WP_Query( array(
                    'posts_per_page' => 5,
                    'orderby' => 'date',
                    'order' => 'DESC'
                ) );
                
                if ( $recent_posts->have_posts() ) : ?>
                    <ul class="popular-posts-list">
                        <?php while ( $recent_posts->have_posts() ) : $recent_posts->the_post(); ?>
                            <li class="popular-post-item">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <div class="popular-post-thumb">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail('thumbnail'); ?>
                                        </a>
                                    </div>
                                <?php endif; ?>
                                <div class="popular-post-info">
                                    <h5 class="popular-post-title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h5>
                                    <span class="popular-post-date"><?php echo get_the_date(); ?></span>
                                </div>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                    <?php wp_reset_postdata(); ?>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </aside>
</div>

<?php
get_footer();
?>