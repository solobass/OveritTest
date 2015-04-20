<?php 

/* TEMPLATE NAME: Calendar */

$current_date = date('U');

if (array_key_exists('d', $_GET)) {
	$rd = trim(strip_tags($_GET['d']));
	$rd = explode("_", $rd);
	if (count($rd) > 1) {
		$rd = strtotime($rd[0] . '/01/' . $rd[1]);
		if ($rd) $current_date = $rd;
	}
}

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

							</article>
							
							<?php endwhile; endif; ?>
							
						</div>
				</div>
			</div>


<div id="calendar-container"><div class="wrap cf">


	<div id="calendar-header">
	
		<div class="calendar-nav calendar-previous">
			<a href="?d=<?php
				$p = strtotime('-1 month', $current_date);
				echo date('m_Y', $p);
			?>">Previous Month</a>
		</div>
		
		<div class="calendar-title"><?php
			echo date('F', $current_date);
		?></div>
		
		<div class="calendar-nav calendar-next">
			<a href="?d=<?php
				$p = strtotime('+1 month', $current_date);
				echo date('m_Y', $p);
			?>">Next Month</a>
		</div>
	
	</div>
	
	<div id="calendar-events">
	<?php
	
		$events = event_fetch(date('m', $current_date), date('Y', $current_date));

		if (count($events) == 0) {
			echo '<h4>Sorry, no events this month.</h4>';
		} else {
		
			$i = 1;
			foreach ($events as $e) {
				$edate = event_get_date($e->post_excerpt);
				$edate = strtotime($edate);
				
				$estart = event_get_start($e->post_excerpt);
				if ($estart) {
					$foo = date('m/d/Y', $edate) . ' ' . $estart;
					$estart = date('g:ia', strtotime($foo));
				}
				$eend   = event_get_end($e->post_excerpt);
				if ($eend) {
					$foo = date('m/d/Y', $edate) . ' ' . $eend;
					$eend = date('g:ia', strtotime($foo));
				}
				
	?>
		<div class="event <?php if ($i == count($events)) echo 'last'; ?>">
		
			<div class="event-date-container">
				<div class="event-month"><?php echo date('M', $edate); ?></div>
				<div class="event-day"><?php echo date('j', $edate); ?></div>
			</div>
			
			<div class="event-info-container">
				<div class="event-title"><?php echo $e->post_title; ?></div>
				<div class="event-date"><?php
					echo date('F j, Y', $edate);
					if ($estart) {
						echo ' &bull; ' . $estart;
						if ($eend) echo ' - ' . $eend;
					}
				?></div>
				<div class="event-text"><?php echo apply_filters('the_content', $e->post_content); ?></div>
			</div>
		
		</div>
	<?php
				$i++;
			} // end foreach events
		
		} // end else if there are events
	
	?>
	</div>





</div></div>
	

<?php get_footer(); ?>
