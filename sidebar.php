<?php
/**
 * The sidebar containing the article widget areas
 *
 * @package jeodotheme
 */

if ( ! is_active_sidebar( 'article-sidebar-featured' ) && 
     ! is_active_sidebar( 'article-sidebar-ad-1' ) && 
     ! is_active_sidebar( 'article-sidebar-hot' ) &&
     ! is_active_sidebar( 'article-sidebar-ad-2' ) &&
     ! is_active_sidebar( 'article-sidebar-general' ) ) {
    return;
}
?>

<aside class="article-sidebar">
    
    <!-- Featured Posts Widget Area -->
    <?php if ( is_active_sidebar( 'article-sidebar-featured' ) ) : ?>
        <div class="sidebar-widget featured-posts-widget">
            <h4>오늘의 주요 뉴스</h4>
            <div class="featured-posts-list">
                <?php
                $featured = new WP_Query(array(
                    'posts_per_page' => 1,
                    'orderby' => 'date',
                    'post__not_in' => array( get_the_ID() )
                ));
                
                if($featured->have_posts()) :
                    while($featured->have_posts()) : $featured->the_post();
                ?>
                    <div class="featured-main-post">
                        <?php if(has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink(); ?>" class="featured-image">
                                <?php the_post_thumbnail('medium'); ?>
                            </a>
                        <?php endif; ?>
                        <h5>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h5>
                        <p class="excerpt"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>
                    </div>
                <?php 
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
                
                <!-- Related Tags/Categories -->
                <div class="related-tags">
                    <h5>국민안전 관슴크</h5>
                    <div class="tag-buttons">
                        <?php
                        $categories = get_categories(array('number' => 6));
                        foreach($categories as $category) :
                        ?>
                            <a href="<?php echo get_category_link($category->term_id); ?>" class="tag-btn">
                                <?php echo $category->name; ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Advertisement Widget Area 1 -->
    <?php if ( is_active_sidebar( 'article-sidebar-ad-1' ) ) : ?>
        <?php dynamic_sidebar( 'article-sidebar-ad-1' ); ?>
    <?php endif; ?>

    <!-- Hot News Widget Area -->
    <?php if ( is_active_sidebar( 'article-sidebar-hot' ) ) : ?>
        <div class="sidebar-widget hot-news-widget">
            <h4>핫 뉴스</h4>
            <div class="hot-news-list">
                <?php
                $hot_news = new WP_Query(array(
                    'posts_per_page' => 3,
                    'orderby' => 'comment_count',
                    'order' => 'DESC',
                    'post__not_in' => array( get_the_ID() )
                ));
                
                if($hot_news->have_posts()) :
                    while($hot_news->have_posts()) : $hot_news->the_post();
                ?>
                    <div class="hot-news-item">
                        <?php if(has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink(); ?>" class="hot-news-image">
                                <?php the_post_thumbnail('medium'); ?>
                            </a>
                        <?php endif; ?>
                        <h5>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h5>
                        <p class="excerpt"><?php echo wp_trim_words(get_the_excerpt(), 12); ?></p>
                    </div>
                <?php 
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
        </div>
    <?php endif; ?>

    <!-- Advertisement Widget Area 2 -->
    <?php if ( is_active_sidebar( 'article-sidebar-ad-2' ) ) : ?>
        <?php dynamic_sidebar( 'article-sidebar-ad-2' ); ?>
    <?php endif; ?>

    <!-- General Widget Area -->
    <?php if ( is_active_sidebar( 'article-sidebar-general' ) ) : ?>
        <?php dynamic_sidebar( 'article-sidebar-general' ); ?>
    <?php endif; ?>

</aside>