<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package jeodotheme
 */

get_header();
?>

<div class="content-wrapper">
	<main id="primary" class="site-main main-content">

		<?php
		if ( have_posts() ) :
		?>
		
		<div class="news-list-container" id="news-list-ajax">
			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();
				$category = get_the_category();
				$category_name = !empty($category) ? $category[0]->name : '';
			?>
				<article class="news-item">
					<div class="news-item-content">
						<?php if ( $category_name ) : ?>
							<div class="news-item-category"><?php echo esc_html($category_name); ?></div>
						<?php endif; ?>
						
						<h2 class="news-item-title">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h2>
						
						<div class="news-item-excerpt">
							<?php echo wp_trim_words( get_the_excerpt(), 35, '...' ); ?>
						</div>
					</div>
					
					<?php if ( has_post_thumbnail() ) : ?>
						<div class="news-item-thumbnail">
							<a href="<?php the_permalink(); ?>">
								<?php the_post_thumbnail('medium'); ?>
							</a>
						</div>
					<?php endif; ?>
				</article>
			<?php
			endwhile;
			?>
		</div>
		
		<!-- Pagination -->
		<div class="news-pagination" id="news-pagination">
			<?php
			the_posts_pagination( array(
				'mid_size'  => 2,
				'prev_text' => __( '←', 'jeodotheme' ),
				'next_text' => __( '→', 'jeodotheme' ),
				'before_page_number' => '<span class="page-number">',
				'after_page_number' => '</span>',
			) );
			?>
		</div>

		<?php
		else :
			get_template_part( 'template-parts/content', 'none' );
		endif;
		?>

	</main><!-- #main -->

	<!-- Sidebar -->
	<aside class="sidebar-content">
		<!-- Popular Posts Widget - No Title -->
		<div class="sidebar-widget-notitle">
			<div class="widget-news-list">
				<?php
				$popular_query = new WP_Query( array(
					'posts_per_page' => 2,
					'orderby' => 'comment_count',
					'order' => 'DESC'
				));
				
				if ( $popular_query->have_posts() ) :
					while ( $popular_query->have_posts() ) : $popular_query->the_post();
				?>
					<article class="widget-news-card">
						<?php if ( has_post_thumbnail() ) : ?>
							<div class="widget-card-thumbnail">
								<a href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail('medium'); ?>
								</a>
							</div>
						<?php endif; ?>
						
						<div class="widget-card-content">
							<h4 class="widget-card-title">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h4>
							<p class="widget-card-excerpt">
								<?php echo wp_trim_words( get_the_excerpt(), 20, '...' ); ?>
							</p>
						</div>
					</article>
				<?php 
					endwhile;
					wp_reset_postdata();
				endif;
				?>
			</div>
		</div>
	</aside>
</div>

<!-- Bottom News Sections -->
<div class="bottom-news-sections">
	<div class="bottom-news-column">
		<h3 class="section-title">오늘의 주요 뉴스</h3>
		<div class="bottom-news-grid">
			<?php
			$featured_query = new WP_Query( array(
				'posts_per_page' => 3,
				'orderby' => 'date',
				'order' => 'DESC'
			));
			
			if ( $featured_query->have_posts() ) :
				while ( $featured_query->have_posts() ) : $featured_query->the_post();
			?>
				<article class="bottom-news-card">
					<?php if ( has_post_thumbnail() ) : ?>
						<div class="bottom-news-image">
							<a href="<?php the_permalink(); ?>">
								<?php the_post_thumbnail('medium'); ?>
							</a>
						</div>
					<?php endif; ?>
					
					<div class="bottom-news-text">
						<h4 class="bottom-news-title">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h4>
						
						<p class="bottom-news-excerpt">
							<?php echo wp_trim_words( get_the_excerpt(), 15, '...' ); ?>
						</p>
					</div>
				</article>
			<?php 
				endwhile;
				wp_reset_postdata();
			endif;
			?>
		</div>
	</div>
	
	<div class="bottom-news-column">
		<h3 class="section-title">핫 뉴스</h3>
		<div class="bottom-news-grid">
			<?php
			$hot_query = new WP_Query( array(
				'posts_per_page' => 3,
				'orderby' => 'comment_count',
				'order' => 'DESC'
			));
			
			if ( $hot_query->have_posts() ) :
				while ( $hot_query->have_posts() ) : $hot_query->the_post();
			?>
				<article class="bottom-news-card">
					<?php if ( has_post_thumbnail() ) : ?>
						<div class="bottom-news-image">
							<a href="<?php the_permalink(); ?>">
								<?php the_post_thumbnail('medium'); ?>
							</a>
						</div>
					<?php endif; ?>
					
					<div class="bottom-news-text">
						<h4 class="bottom-news-title">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h4>
						
						<p class="bottom-news-excerpt">
							<?php echo wp_trim_words( get_the_excerpt(), 15, '...' ); ?>
						</p>
					</div>
				</article>
			<?php 
				endwhile;
				wp_reset_postdata();
			endif;
			?>
		</div>
	</div>
</div>

<?php
get_footer();