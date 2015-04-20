jQuery(document).ready(function($) {


	// BLOG WIDGETS
	$('#blog-widgets .blog-sort').each(function() {
		$('.links-container', this).hide();
		$(this).addClass('quicklinked');
	});
	$('#blog-widgets .blog-sort.quicklinked h4').click(function() {
	
		if ($(this).hasClass('open')) {
		
			$(this).siblings('.links-container').slideUp('fast');
			$(this).removeClass('open');
		
		} else {
		
			$(this).siblings('.links-container').slideDown();
			$(this).addClass('open');
		
		}
	
	});


	// BLOG SEE MORE
	$('.see-more-container').click(function(e) {
	
		e.preventDefault();

		var data = {
			action: 'fetch_blog_posts',
			sort: blog_sort,
			category: blog_category,
			offset: blog_offset
		};
		
		// We can also pass the url value separately from ajaxurl for front end AJAX implementations
		jQuery.post(ajax_object.ajax_url, data, function(response) {
		
			jQuery('#blog-posts').append(response);
			blog_offset += 3;
			
			jQuery('#blog-posts .blog-post:not(.hovered)').hover(
				function() {
					jQuery(this).children('.blog-post-thumb').stop(true, true).animate({
						left: '-320px'
					}, 500);
				},
				function() {
					jQuery(this).children('.blog-post-thumb').stop(true, true).animate({
						left: '0'
					}, 250);
				}
			).addClass('hovered');
			
			if (response.indexOf('<!') > 0) {
				$('.see-more-container').hide();
			}
			
			
		});		
		
	});
});