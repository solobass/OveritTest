<?php get_header(); ?>

<?php
	$page_image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'page-image');
	if ($page_image):	
?>
<div class="page-image" data-pageimage="<?php echo $page_image[0]; ?>"></div>
<?php
	endif;
?>

			<div id="content">

				<div id="inner-content" class="wrap cf">
				
						<?php orlo_subnav($post->ID, 'top'); ?>

						<div id="main" class="m-all cf" role="main">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

								<header class="article-header">

									<h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>
									<div class="page-title-dots"></div>

								</header> <?php // end article header ?>

								<section class="entry-content cf" itemprop="articleBody">
									<?php
										// the content (pretty self explanatory huh)
										the_content();
										
										wp_nav_menu();

									?>
								</section> <?php // end article section ?>

								<footer class="article-footer cf">

								</footer>

							</article>

							<?php endwhile; else : ?>

									<article id="post-not-found" class="hentry cf">
										<header class="article-header">
											<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
										</header>
										<section class="entry-content">
											<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
										</section>
										<footer class="article-footer">
												<p><?php _e( 'This is the error message in the page.php template.', 'bonestheme' ); ?></p>
										</footer>
									</article>

							<?php endif; ?>

						</div>

						<?php orlo_subnav($post->ID, 'bottom'); ?>

				</div>

			</div>
			

<?php orlo_callout($post->ID); ?>			

<?php get_footer(); ?>
