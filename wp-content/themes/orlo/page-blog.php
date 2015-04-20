<?php 

/* TEMPLATE NAME: Blog */

$post_sort = 'date_desc';
if (array_key_exists('sort', $_GET)) {
	$post_sort = trim(strip_tags($_GET['sort']));
}

$post_cat = 0;
if (array_key_exists('cat', $_GET)) {
	$post_cat = trim(strip_tags($_GET['cat']));
}

get_header(); ?>

<script>
var blog_sort = "<?php echo $post_sort; ?>";
var blog_category = "<?php echo $post_cat; ?>";
var blog_offset = 9;
</script>

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
			

<?php echo blog_widgets(); ?>


<div id="blog-posts" class="cf">
<?php
	$args = array(
		'sort' => $post_sort,
		'category' => $post_cat
	);
	$blog_posts = blog_get_posts($args, 0, 9);
	foreach ($blog_posts as $bp) {
		echo $bp;
	}
?>
</div>

<?php if (count($blog_posts) == 9): ?>
<div class="see-more-container">
	<a href="#">
		<span class="see-more-icon">+</span>
		<span class="see-more-label">See More</span>
	</a>
</div>
<?php endif; ?>


<script>
jQuery(document).ready(function($) {


	$('#blog-widgets .blog-categories').each(function() {
		$('.links-container', this).hide();
		$(this).addClass('quicklinked');
	});
	$('#blog-widgets .blog-categories.quicklinked h4').click(function() {
	
		if ($(this).hasClass('open')) {
		
			$(this).siblings('.links-container').slideUp('fast');
			$(this).removeClass('open');
		
		} else {
		
			$(this).siblings('.links-container').slideDown();
			$(this).addClass('open');
		
		}
	
	});
	
	
	$('#blog-posts .blog-post').hover(
		function() {
			$(this).children('.blog-post-thumb').stop(true, true).animate({
				left: '-320px'
			}, 500);
		},
		function() {
			$(this).children('.blog-post-thumb').stop(true, true).animate({
				left: '0'
			}, 250);
		}
	);
	$('#blog-posts .blog-post').addClass('hovered');
		
});
</script>
	

<?php get_footer(); ?>
