<?php
/*
Author: Eddie Machado
URL: htp://themble.com/bones/

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images,
sidebars, comments, ect.
*/

// LOAD BONES CORE (if you remove this, the theme will break)
require_once( 'library/bones.php' );

// USE THIS TEMPLATE TO CREATE CUSTOM POST TYPES EASILY
//require_once( 'library/custom-post-type.php' );
require_once( 'library/post-type-employee.php' );
require_once( 'library/post-type-events.php' );
require_once( 'library/post-type-alumni.php' );


// CUSTOMIZE THE WORDPRESS ADMIN (off by default)
// require_once( 'library/admin.php' );

/*********************
LAUNCH BONES
Let's get everything up and running.
*********************/

function bones_ahoy() {

  // let's get language support going, if you need it
  load_theme_textdomain( 'bonestheme', get_template_directory() . '/library/translation' );

  // launching operation cleanup
  add_action( 'init', 'bones_head_cleanup' );
  // A better title
  add_filter( 'wp_title', 'rw_title', 10, 3 );
  // remove WP version from RSS
  add_filter( 'the_generator', 'bones_rss_version' );
  // remove pesky injected css for recent comments widget
  add_filter( 'wp_head', 'bones_remove_wp_widget_recent_comments_style', 1 );
  // clean up comment styles in the head
  add_action( 'wp_head', 'bones_remove_recent_comments_style', 1 );
  // clean up gallery output in wp
  add_filter( 'gallery_style', 'bones_gallery_style' );

  // enqueue base scripts and styles
  add_action( 'wp_enqueue_scripts', 'bones_scripts_and_styles', 999 );
  // ie conditional wrapper

  // launching this stuff after theme setup
  bones_theme_support();

  // adding sidebars to Wordpress (these are created in functions.php)
  add_action( 'widgets_init', 'bones_register_sidebars' );

  // cleaning up random code around images
  add_filter( 'the_content', 'bones_filter_ptags_on_images' );
  // cleaning up excerpt
  add_filter( 'excerpt_more', 'bones_excerpt_more' );

} /* end bones ahoy */

// let's get this party started
add_action( 'after_setup_theme', 'bones_ahoy' );


/************* OEMBED SIZE OPTIONS *************/

if ( ! isset( $content_width ) ) {
	$content_width = 640;
}

/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
add_image_size( 'bones-thumb-600', 600, 150, true );
add_image_size( 'bones-thumb-300', 300, 100, true );
add_image_size( 'page-image', 1396, 212, true );
add_image_size( 'staff-thumb', 200, 200, true );
add_image_size( 'blog-thumb', 320, 320, true );
add_image_size( 'blog-image', 685, 325, true );

/*
to add more sizes, simply copy a line from above
and change the dimensions & name. As long as you
upload a "featured image" as large as the biggest
set width or height, all the other sizes will be
auto-cropped.

To call a different size, simply change the text
inside the thumbnail function.

For example, to call the 300 x 300 sized image,
we would use the function:
<?php the_post_thumbnail( 'bones-thumb-300' ); ?>
for the 600 x 100 image:
<?php the_post_thumbnail( 'bones-thumb-600' ); ?>

You can change the names and dimensions to whatever
you like. Enjoy!
*/

add_filter( 'image_size_names_choose', 'bones_custom_image_sizes' );

function bones_custom_image_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'bones-thumb-600' => __('600px by 150px'),
        'bones-thumb-300' => __('300px by 100px'),
    ) );
}

/*
The function above adds the ability to use the dropdown menu to select
the new images sizes you have just created from within the media manager
when you add media to your content blocks. If you add more image sizes,
duplicate one of the lines in the array and name it according to your
new image size.
*/

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function bones_register_sidebars() {
	register_sidebar(array(
		'id' => 'sidebar1',
		'name' => __( 'Sidebar 1', 'bonestheme' ),
		'description' => __( 'The first (primary) sidebar.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	register_sidebar(array(
		'id' => 'sidebar2',
		'name' => __( 'Sidebar 2', 'bonestheme' ),
		'description' => __( 'The second (secondary) sidebar.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));


	/*
	to add more sidebars or widgetized areas, just copy
	and edit the above sidebar code. In order to call
	your new sidebar just use the following code:

	Just change the name to whatever your new
	sidebar's id is, for example:

	register_sidebar(array(
		'id' => 'sidebar2',
		'name' => __( 'Sidebar 2', 'bonestheme' ),
		'description' => __( 'The second (secondary) sidebar.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	To call the sidebar in your template, you can just copy
	the sidebar.php file and rename it to your sidebar's name.
	So using the above example, it would be:
	sidebar-sidebar2.php

	*/
} // don't remove this bracket!


/************* COMMENT LAYOUT *********************/

// Comment Layout
function bones_comments( $comment, $args, $depth ) {
   $GLOBALS['comment'] = $comment; ?>
  <div id="comment-<?php comment_ID(); ?>" <?php comment_class('cf'); ?>>
    <article  class="cf">
      <header class="comment-author vcard">
        <?php
        /*
          this is the new responsive optimized comment image. It used the new HTML5 data-attribute to display comment gravatars on larger screens only. What this means is that on larger posts, mobile sites don't have a ton of requests for comment images. This makes load time incredibly fast! If you'd like to change it back, just replace it with the regular wordpress gravatar call:
          echo get_avatar($comment,$size='32',$default='<path_to_url>' );
        */
        ?>
        <?php // custom gravatar call ?>
        <?php
          // create variable
          $bgauthemail = get_comment_author_email();
        ?>
        <img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5( $bgauthemail ); ?>?s=40" class="load-gravatar avatar avatar-48 photo" height="40" width="40" src="<?php echo get_template_directory_uri(); ?>/library/images/nothing.gif" />
        <?php // end custom gravatar call ?>
        <?php printf(__( '<cite class="fn">%1$s</cite> %2$s', 'bonestheme' ), get_comment_author_link(), edit_comment_link(__( '(Edit)', 'bonestheme' ),'  ','') ) ?>
        <time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time(__( 'F jS, Y', 'bonestheme' )); ?> </a></time>

      </header>
      <?php if ($comment->comment_approved == '0') : ?>
        <div class="alert alert-info">
          <p><?php _e( 'Your comment is awaiting moderation.', 'bonestheme' ) ?></p>
        </div>
      <?php endif; ?>
      <section class="comment_content cf">
        <?php comment_text() ?>
      </section>
      <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
    </article>
  <?php // </li> is added by WordPress automatically ?>
<?php
} // don't remove this bracket!


/*
This is a modification of a function found in the
twentythirteen theme where we can declare some
external fonts. If you're using Google Fonts, you
can replace these fonts, change it in your scss files
and be up and running in seconds.
*/
function bones_fonts() {
  wp_register_style('googleFonts', 'http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic');
  wp_enqueue_style( 'googleFonts');
}

#add_action('wp_print_styles', 'bones_fonts');



function orlo_excerpt_length( $length ) {
	return 15;
}
add_filter( 'excerpt_length', 'orlo_excerpt_length', 999 );


function explode_trim($sep, $str) {

	$foo = array();
	
	$bar = explode($sep, $str);
	foreach ($bar as $baz) {
		$foo[] = trim($baz);
	}
	
	return $foo;

}



/**
 * display second level pages, if there are any
 * if we're on a first level page, we need to look at the children
 * if we're on a second level page, we need to get the parent and look at it's children
 */
function orlo_subnav($post_id, $class = '') {

	$p = get_post($post_id);
	if ($p->post_parent != 0) {
		$p = get_post($p->post_parent);
	}
	
	$children = get_pages(array(
		'child_of' => $p->ID,
		'sort_column' => 'menu_order'
	));
	
	if (count($children) == 0) return;

	$output  = '<div class="subnav ' . $class . '">';

	$output .= '<ul>';
	foreach ($children as $c) {
	
		$output .= '<li';
		
		if ($post_id == $c->ID) $output .= ' class="current"';
		
		$output .= '>';
	
		$output .= '<a href="' . get_permalink($c->ID) . '">' . $c->post_title . '</a>';	
		
		if ($post_id == $c->ID) $output .= '<hr />';
		
		$output .= '</li>';
		
	}
	
	
	/** RIDICULOUS EXCEPTIONS BECAUSE THAT'S WHAT I DO OMGLOLROFLBBQ **/
	if ($p->ID == 6) {
		$output .= '<li><a href="http://www.theorloschool.com/gedt/Gedt.html">Disclosures</a></li>';
	}
	
	
	
	$output .= '</ul>';
	
	$output .= '</div>'; // #subnav

	echo $output;

}


function orlo_callout($post_id) {

	$has_callout = array(
	
		15 => array( // apply now
			'title' => 'We are currently accepting new students',
			'url'   => '',
			'image' => 'callout_applynow.png'
		),
	
		27 => array( // tuition & financial aid
			'title' => 'Net Price Calculator',
			'url'   => 'http://www.theorloschool.com/npcalc.htm',
			'image' => 'callout_netpricecalc.png'
		),
		
	);
	
	if (!array_key_exists($post_id, $has_callout)) return;
	
	$callout = $has_callout[$post_id];
	
	$output  = '<div class="callout">';
	
	if ($callout['url'] != '') $output .= '<a href="' . $callout['url'] . '">';
	$output .= '<img alt="' . $callout['title'] . '" ';
	$output .= 'src="' . get_template_directory_uri() . '/library/images/' . $callout['image'] . '" />';
	if ($callout['url'] != '') $output .= '</a>';
	
	$output .= '</div>';
	
	echo $output;

}



/** ACCORDION SHORTCODE **/
/**
	[accordion title="foo"]bar[/accordion]
*/
function orlo_accordion( $atts, $content = '' ) {

	if ($content == '') return '';

	extract( shortcode_atts( array(
		'title' => 'Click Me!',
	), $atts ) );

	$output  = '<div class="accordion">';
	$output .= '<h4>' . $title . '</h4>';
	$output .= '<div class="accordion-text">' . $content . '</div>';
	$output .= '</div>';

	return $output;

}
add_shortcode( 'accordion', 'orlo_accordion' );

/** BUTTON SHORTCODE **/
/**
	[button url="http://www.foo.com" color="green|purple"]Button Label[/button]
**/
function orlo_button( $atts, $content = '' ) {

	if ($content == '') return '';

	extract( shortcode_atts( array(
		'color' => 'green',
		'url'   => ''
	), $atts ) );

	$output  = '<div class="orlo-content-button';
	if ($color != 'green') $output .= ' ' . $color;
	$output .= '">';
	
	$output .= '<a href="' . $url . '">' . $content . '</a>';
	
	$output .= '</div>';

	return $output;

}
add_shortcode( 'button', 'orlo_button' );



function blog_search() {
	$output  = '<div class="blog-widget blog-search">';
	$output .= get_search_form(false);
	$output .= '</div>';
	return $output;
}
function blog_sort() {

	$blog_url = get_permalink(113);

	$output  = '<div class="blog-widget blog-sort">';
	$output .= '<h4>Sort</h4>';
	$output .= '<div class="links-container"><ul>';
	$output .= '<li><a href="' . $blog_url . '?sort=date_asc">Select by oldest</a></li>';
	$output .= '<li><a href="' . $blog_url . '?sort=date_desc">Select by newest</a></li>';
	$output .= '</ul></div>';
	$output .= '</div>';
	return $output;
}
function blog_categories() {

	$label = 'Categories';
	if (array_key_exists('cat', $_GET)) {
		$post_cat = trim(strip_tags($_GET['cat']));
		$label = get_cat_name($post_cat);
	}

	$blog_url = get_permalink(113);
	$categories = get_categories();

	$output  = '<div class="blog-widget blog-categories">';
	$output .= '<h4>' . $label . '</h4>';
	$output .= '<div class="links-container"><ul>';
	foreach ($categories as $cat) {
		$output .= '<li><a href="' . $blog_url . '?cat=' . $cat->term_id . '">' . $cat->name . '</a></li>';
	}
	$output .= '</ul></div>';
	$output .= '</div>';
	return $output;
}



function blog_reset() {
	$output  = '<div class="blog-widget blog-reset"><div class="orlo-content-button gray">';
	$output .= blog_back();
	$output .= '</div></div>';
	return $output;
}

function blog_back($label = 'Go to Archives') {
	return '<a href="' . get_permalink(113) . '">Go to Archives</a>';
}

function blog_widgets() {
	$output  = '<div id="blog-widgets"><div class="wrap cf">';
#	$output .= blog_search();
#	$output .= blog_sort();
	$output .= blog_categories();
#	$output .= blog_reset();
	$output .= '</div></div>';
	return $output;
}

function blog_excerpt($p, $length = 20) {
	$excerpt = $p->post_excerpt;
	if ($excerpt == '') $excerpt = $p->post_content;
	
	$words = explode(" ", $excerpt);
	if (count($words) > $length) {
		$excerpt = implode(" ", array_slice($words, 0, $length)) . '...';
	}
	
	return $excerpt;
}

function blog_format($p, $i = '') {

#	echo '<pre>'; var_dump($p); echo '</pre>';
#	return '';

	$output  = '<div class="blog-post';
	if ($i) $output .= ' post-' . $i;
	if ($i % 2 == 0) {
		$output .= ' even';
	} else {
		$output .= ' odd';
	}
	$output .= '">';
	
	if (has_post_thumbnail($p->ID)) {
		$output .= '<div class="blog-post-thumb">';
		$output .= get_the_post_thumbnail($p->ID, 'blog-thumb');
		$output .= '</div>';
	}
	
	$output .= '<div class="blog-title">' . $p->post_title . '</div>';
	
	$output .= '<div class="blog-date">';
	$output .= date('F j, Y', strtotime($p->post_date));
	$output .= '</div>';
	
	$output .= '<div class="blog-excerpt">';
	$output .= blog_excerpt($p, 15);
	$output .= '</div>';
	
	$output .= '<div class="orlo-button">';
	$output .= '<a href="' . get_permalink($p->ID) . '">Read More</a>';
	$output .= '</div>';
	
	$output .= '</div>';
	
	return $output;

}


/**
 * $args is an array
 * 'sort' can be date_asc
 * 'category' can be a category term_id
 */
function blog_get_posts($args, $offset = 0, $num = 3) {

	$orderby  = 'post_date';
	$order    = 'DESC';
	$category = 0;

	if (array_key_exists('sort', $args)) {
		if ($args['sort'] == 'date_asc') {
			$order = 'ASC';
		}
	}
	
	if (array_key_exists('category', $args)) {
		$category = $args['category'];
	}
	
	if ($category) {
		$numposts = get_category($category)->category_count;
	} else {
		global $wpdb;
		$numposts = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->posts WHERE post_type = 'post' AND post_status = 'publish'");
	}
	
	
	$blog_posts = array();
	
	
	$get_posts_args = array(
		'posts_per_page'	=> $num,
		'offset'			=> $offset,
		'orderby'			=> $orderby,
		'order'				=> $order	
	);
	if ($category) {
		$get_posts_args['category'] = $category;
	}

	$raw_posts = get_posts($get_posts_args);
	
	foreach ($raw_posts as $i => $rp) {
		$blog_posts[] = blog_format($rp, $i);
	}
	
	if ($offset + $num >= $numposts) {
		$blog_posts[] = '<!--NO MORE POSTS-->';
	}
	
	return $blog_posts;

}


add_action( 'init', 'orlo_init' );
function orlo_init() {
        
	wp_enqueue_script( 
		'ajax-script', 
		get_template_directory_uri() . '/library/js/blog_see_more.js', 
		array('jquery') 
	);

	// in javascript, object properties are accessed as ajax_object.ajax_url, ajax_object.we_value
	wp_localize_script( 'ajax-script', 'ajax_object',
            array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) 
    );
}

add_action( 'wp_ajax_fetch_blog_posts', 'blog_posts_fetch_ajax' );
add_action( 'wp_ajax_nopriv_fetch_blog_posts', 'blog_posts_fetch_ajax' );

function blog_posts_fetch_ajax() {

	$output = '';
	
#	foreach ($_POST as $k => $v) {
#		$output .= '<strong>' . $k . '</strong>: ' . $v . '<br />';
#	}
	
	$sort   = trim(strip_tags($_POST['sort']));
	$cat    = trim(strip_tags($_POST['category']));
	$offset = trim(strip_tags($_POST['offset']));
	
	$args = array('sort' => $sort, 'category' => $cat);
	
	$blog_posts = blog_get_posts($args, $offset, 3);
	$output .= implode(chr(10), $blog_posts);

	echo $output;
	die();

}




add_action( 'admin_menu', 'wpsg_add_admin_menu' );
add_action( 'admin_init', 'wpsg_settings_init' );


function wpsg_add_admin_menu(  ) { 

	add_menu_page( 'orlo_classes', 'ORLO Classes', 'manage_options', 'orlo_classes', 'orlo_classes_options_page' );

}


function wpsg_settings_exist(  ) { 

	if( false == get_option( 'orlo_classes_settings' ) ) { 

		add_option( 'orlo_classes_settings' );

	}

}


function wpsg_settings_init(  ) { 

	register_setting( 'pluginPage', 'wpsg_settings' );

	add_settings_section(
		'wpsg_pluginPage_section', 
		__( 'Set the status of classes.', 'wordpress' ), 
		'wpsg_settings_section_callback', 
		'pluginPage'
	);

	add_settings_field( 
		'wpsg_select_field_0', 
		__( 'Status', 'wordpress' ), 
		'wpsg_select_field_0_render', 
		'pluginPage', 
		'wpsg_pluginPage_section' 
	);


}


function wpsg_select_field_0_render(  ) { 

	$options = get_option( 'wpsg_settings' );
	?>
	<select name='wpsg_settings[wpsg_select_field_0]'>
		<option value='1' <?php selected( $options['wpsg_select_field_0'], 1 ); ?>>Scheduled</option>
		<option value='2' <?php selected( $options['wpsg_select_field_0'], 2 ); ?>>Delayed</option>
		<option value='3' <?php selected( $options['wpsg_select_field_0'], 3 ); ?>>Cancelled (Generic)</option>
		<option value='4' <?php selected( $options['wpsg_select_field_0'], 4 ); ?>>Cancelled (Snow)</option>
	</select>

<?php

}


function wpsg_settings_section_callback(  ) { 

	echo __( 'To be displayed on the homepage.', 'wordpress' );

}


function orlo_classes_options_page(  ) { 

	?>
	<form action='options.php' method='post'>
		
		<h2>ORLO Classes</h2>
		
		<?php
		settings_fields( 'pluginPage' );
		do_settings_sections( 'pluginPage' );
		submit_button();
		?>
		
	</form>
	<?php

}






/* DON'T DELETE THIS CLOSING TAG */ ?>
