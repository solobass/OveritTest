			<footer class="footer" role="contentinfo">

				<div id="inner-footer" class="wrap cf">
				
					<?php get_sidebar('sidebar2'); ?>

					<div id="sidebar3">
					<div class="footer-nav-title">More to Explore</div>
					<nav role="navigation">
						<?php wp_nav_menu(array(
    					'container' => '',                              // remove nav container
    					'container_class' => 'footer-links cf',         // class of container (should you choose to use it)
    					'menu' => __( 'Footer Links', 'bonestheme' ),   // nav name
    					'menu_class' => 'nav footer-nav cf',            // adding custom nav class
    					'theme_location' => 'footer-links',             // where it's located in the theme
    					'before' => '',                                 // before the menu
        			'after' => '',                                  // after the menu
        			'link_before' => '',                            // before each link
        			'link_after' => '',                             // after each link
        			'depth' => 0,                                   // limit the depth of the nav
    					'fallback_cb' => 'bones_footer_links_fallback'  // fallback function
						)); ?>
					</nav>
					
					<div class="footer-social cf">
					
						<span class="label">Connect With Us:</span>
						
						<a class="tw" target="_blank" href="https://twitter.com/TheOrloSchool"></a>
						<a class="fb" target="_blank" href="https://www.facebook.com/theorloschool"></a>
						<a class="yt" target="_blank" href="http://www.youtube.com/user/TheOrloSchool"></a>
						<a class="pi" target="_blank" href="http://www.pinterest.com/theorloschool"></a> 
						<a class="gp" target="_blank" href="https://plus.google.com/105599180315096877962/about"></a>
					
					</div>
					</div>

				</div>

				<div class="black-out">				
				<div id="outer-footer" class="wrap cf">
					<p class="source-org copyright">
						&copy; Copyright <?php echo date('Y'); ?> 
						The Orlo School of Hair Design & Cosmetology.
					</p>
				</div>
				</div>

			</footer>

		</div>

		<?php // all js scripts are loaded in library/bones.php ?>
		<?php wp_footer(); ?>

	</body>

</html> <!-- end of site. what a ride! -->
