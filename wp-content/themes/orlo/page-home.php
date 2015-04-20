<?php 

/* TEMPLATE NAME: Home */

get_header(); ?>


<div id="home-container"><div class="wrap cf">


	<div class="home-block darkteal tools1 block-1">
		<div class="home-block-icon"></div>
		<div class="home-link"><a href="<?php echo get_permalink(6); ?>">Program</a></div>
	</div>

	<div class="home-block man apply block-2">
		<div class="home-block-icon"></div>
		<div class="home-link"><a href="<?php echo get_permalink(15); ?>">Apply</a></div>
	</div>

	<div class="home-block darkpurple schedule block-3">
		<div class="home-block-icon"></div>
		<div class="home-link"><a href="<?php echo get_permalink(31); ?>">Schedule a Tour</a></div>
	</div>


	<?php /* second row */ ?>

	<div class="home-block extra block-4">
		<?php
			echo render_extra(196);
		?>
	</div>

	<div class="home-block welcome block-5">
		<?php if (have_posts()): while (have_posts()): the_post(); ?>
		<div class="home-welcome">
		
			<?php the_content(); ?>
			<div class="orlo-button"><a href="<?php echo get_permalink(4); ?>">Learn More</a></div>
		
		</div>
		<?php endwhile; endif; ?>
	</div>

	<div class="home-block woman calendar block-6">
		<div class="home-block-icon"></div>
		<div class="home-link"><a href="<?php echo get_permalink(82); ?>">Calendar</a></div>
	</div>


	<?php /* third row */ ?>


	<div class="home-block purple tools2 block-7">
		<div class="home-block-icon"></div>
		<div class="home-link"><a href="<?php echo get_permalink(140); ?>">Student Salon Services</a></div>
	</div>
	
	<div class="home-block glam video block-8">
		<div class="home-block-icon"></div>
		<div class="home-link"><a href="http://www.youtube.com/channel/UCXjIsyUrys48jjpiHvRZ5FQ" target="_blank">Our Videos</a></div>
	</div>

	<?php
		$options = get_option( 'wpsg_settings' );
		$class_status = $options['wpsg_select_field_0'];
		if (!$class_status) $class_status = 1; // default to "everything is fine
		$block9 = array('home-block', 'block-9', 'alert' . $class_status);
	?>
	<div class="<?php echo implode(' ', $block9); ?>"></div>


</div></div>
	

<?php get_footer(); ?>

<?php

function render_extra($pid) {
	$extra = get_page($pid);
	$the_content = $extra->post_content;
	
	$the_content = str_replace('[/first-line]', '</p>', $the_content);
	$the_content = str_replace('[first-line]', '<p class="first-line">', $the_content);
	
	$the_content = str_replace('[/second-line]', '</p>', $the_content);
	$the_content = str_replace('[second-line]', '<p class="second-line">', $the_content);
	
	$the_content = apply_filters('the_content', $the_content);		
	
	return $the_content;
}