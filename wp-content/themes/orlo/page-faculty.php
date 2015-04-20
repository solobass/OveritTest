<?php 

/* TEMPLATE NAME: Faculty */

get_header(); ?>

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

										/*
										 * Link Pages is used in case you have posts that are set to break into
										 * multiple pages. You can remove this if you don't plan on doing that.
										 *
										 * Also, breaking content up into multiple pages is a horrible experience,
										 * so don't do it. While there are SOME edge cases where this is useful, it's
										 * mostly used for people to get more ad views. It's up to you but if you want
										 * to do it, you're wrong and I hate you. (Ok, I still love you but just not as much)
										 *
										 * http://gizmodo.com/5841121/google-wants-to-help-you-avoid-stupid-annoying-multiple-page-articles
										 *
										*/
										wp_link_pages( array(
											'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'bonestheme' ) . '</span>',
											'after'       => '</div>',
											'link_before' => '<span>',
											'link_after'  => '</span>',
										) );
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

				</div>

			</div>
			

<?php orlo_callout($post->ID); ?>


<?php

	$staff = employee_fetch();
	foreach ($staff as $i => $s):
	
		$s_classes = array('text-block', 'employee');
		if ($i % 2 == 0) {
			$s_classes[] = 'even';
		} else {
			$s_classes[] = 'odd';
		}
	

?>
	<div class="<?php echo implode(' ', $s_classes); ?>"><div class="wrap cf">
	
		<div class="left-side">
			<?php echo get_the_post_thumbnail( $s->ID, 'staff-thumb' ); ?>
		</div>
		
		<div class="right-side">
		
			<h4><?php echo $s->post_title; ?></h4>
			
			<?php
				$jb = $s->post_excerpt;
				if ($jb):
			?>
			<span class="subheading"><?php echo $jb; ?></span>
			<?php endif; ?>
			
			<div class="right-text go-read-more">
				<?php echo apply_filters('the_content', $s->post_content); ?>
			</div>
			
		</div>
	
	</div></div>
<?php
	endforeach; // staff
?>
	

<script>
jQuery(document).ready(function($) {

	var per_click = 2;
	var showing = per_click;

	var numstaff = $('.employee').length;
	if (numstaff > per_click) {
		$('.employee:gt(' + (per_click - 1).toString() + ')').hide();
		
		var html = '<div class="see-more-container"><a href="#">';
		html += '<span class="see-more-icon">+</span>';
		html += '<span class="see-more-label">See More</span>';
		html += '</a></div>';
		$('.employee:last').after(html);
		
		$('.see-more-container').click(function(e) {
		
			e.preventDefault();
			
			console.log('now showing ' + showing.toString());
		
			showing += per_click;
			$('.employee:lt(' + (showing).toString() + ')').slideDown();
			
			if (showing >= numstaff) $(this).remove();
			
		});
		
	}
});
</script>	
	
							<?php orlo_subnav($post->ID, 'bottom'); ?>

	

<?php get_footer(); ?>
