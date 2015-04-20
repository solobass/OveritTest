<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap cf">

					<div id="main" class="m-all cf" role="main">
					
						<article>
								<header class="article-header">

									<h1 class="page-title" itemprop="headline">Our Blog</h1>
									<div class="page-title-dots"></div>

								</header> <?php // end article header ?>
						</article>

					</div>

				</div>

			</div>


<?php /* echo blog_widgets(); */ ?>


<?php if (have_posts()): while (have_posts()): the_post(); ?>

<div id="blog-content"><div id="blog-inner-content" class="wrap cf">

	<?php if (has_post_thumbnail()): ?>
	<div class="blog-post-thumbnail"><?php the_post_thumbnail('blog-image'); ?></div>
	<?php endif; ?>
	
	<h1 class="single-title"><?php the_title(); ?></h1>
	
	<em>
		<?php the_date(); ?>
		<?php
			$cats = get_categories();
			if (count($cats)):
		?>
		//
		<?php
				$blog_url = get_permalink(113);
				$my_cats = array();
				foreach ($cats as $cat) {
					$this_cat = '<a href="' . $blog_url . '?cat=' . $cat->term_id . '">' . $cat->name . '</a>';
					$my_cats[] = $this_cat;
				}
				echo implode(" / ", $my_cats);
			endif;
		?>
	</em>
	
	<div class="blog-post-content"><?php the_content(); ?></div>
	
	<div class="orlo-button">
		<a href="<?php echo get_permalink(113); ?>">Read Less</a>
	</div>
	
	<div class="share-container">
		Share:
		
		<a class="fb" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink(); ?>"></a>
		<a class="tw" href="https://www.facebook.com/sharer.php?u=<?php echo urlencode(get_current_page()); ?>"></a>
		
	</div>

</div></div>

<?php endwhile; endif; ?>


<?php get_footer(); ?>
