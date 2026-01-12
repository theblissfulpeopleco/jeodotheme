<?php get_header(); ?>

<div class="article-container">
    <div class="article-content">
        <?php
        while ( have_posts() ) :
            the_post();
            ?>
            
            <div class="article-header">
                <div class="category-label">
                    <?php 
                    $categories = get_the_category();
                    if ( ! empty( $categories ) ) {
                        echo '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';
                    }
                    ?>
                </div>
                
                <h1 class="article-title"><?php the_title(); ?></h1>
                
                <div class="article-meta">
                    <span class="article-date"><?php echo get_the_date(); ?></span>
                </div>
            </div>

            <?php if ( has_post_thumbnail() ) : ?>
                <div class="article-featured-image">
                    <?php the_post_thumbnail('large'); ?>
                </div>
            <?php endif; ?>

            <div class="article-body">
                <?php the_content(); ?>
            </div>

            <!-- Comment Section -->
            <div class="article-comments">
                <h3>댓글</h3>
                <?php comments_template(); ?>
            </div>

        <?php endwhile; ?>
    </div>

    <aside class="article-sidebar">
        <?php get_sidebar(); ?>
    </aside>
</div>

<!-- Related News Section -->
<div class="related-news-section">
    <h3>추천 뉴스</h3>
    <div class="related-news-grid">
        <?php
        $related = new WP_Query(array(
            'posts_per_page' => 4,
            'post__not_in' => array(get_the_ID()),
            'orderby' => 'rand'
        ));
        
        if($related->have_posts()) :
            while($related->have_posts()) : $related->the_post();
        ?>
            <div class="related-news-item">
                <?php if(has_post_thumbnail()) : ?>
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail('medium'); ?>
                    </a>
                <?php endif; ?>
            </div>
        <?php 
            endwhile;
            wp_reset_postdata();
        endif;
        ?>
    </div>
</div>

<?php get_footer(); ?>