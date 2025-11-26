<?php get_header(); ?>

<div class="container main-grid">
	<main id="primary" class="site-main content-area">

		<?php
		while ( have_posts() ) :
			the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header single-header">
                    <div class="entry-meta-top">Category Name</div>
                    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                    <div class="entry-meta">
                        <?php echo get_the_date(); ?> | By <?php the_author(); ?>
                    </div>
                </header>

                <?php if(has_post_thumbnail()): ?>
                    <div class="single-featured-image">
                        <?php the_post_thumbnail('large'); ?>
                        <div class="caption"><?php the_post_thumbnail_caption(); ?></div>
                    </div>
                <?php endif; ?>

                <div class="entry-content">
                    <?php the_content(); ?>
                </div>

                <div class="related-posts-bottom">
                    <h3>Recommended News</h3>
                    <div class="related-grid">
                        <div class="related-item">Checking logic...</div>
                        <div class="related-item">Government policies...</div>
                        <div class="related-item">Economic shifts...</div>
                    </div>
                </div>

                <?php
			    // If comments are open or we have at least one comment, load up the comment template.
			    if ( comments_open() || get_comments_number() ) :
				    comments_template();
			    endif;
            ?>
            </article>
            <?php
		endwhile; // End of the loop.
		?>

	</main><aside class="sidebar-area">
        <?php get_sidebar(); ?>
    </aside>
</div>

<?php get_footer(); ?>