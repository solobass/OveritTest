<?php
/* Events
This page walks you through creating 
a Event type and taxonomies. You
can edit this one or copy the following code 
to create another one. 

I put this in a separate file so as to 
keep it organized. I find it easier to edit
and change things if they are concentrated
in their own file.

Developed by: Eddie Machado
URL: http://themble.com/bones/
*/

// Flush rewrite rules for Event types
#add_action( 'after_switch_theme', 'bones_flush_rewrite_rules' );

// Flush your rewrite rules
#function bones_flush_rewrite_rules() {
#	flush_rewrite_rules();
#}

// let's create the function for the Event
function custom_post_event() { 
	// creating (registering) the Event 
	register_post_type( 'event', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this Event
		array( 'labels' => array(
			'name' => __( 'Events', 'bonestheme' ), /* This is the Title of the Group */
			'singular_name' => __( 'Evente', 'bonestheme' ), /* This is the individual type */
			'all_items' => __( 'All Events', 'bonestheme' ), /* the all items menu item */
			'add_new' => __( 'Add New', 'bonestheme' ), /* The add new menu item */
			'add_new_item' => __( 'Add New Event', 'bonestheme' ), /* Add New Display Title */
			'edit' => __( 'Edit', 'bonestheme' ), /* Edit Dialog */
			'edit_item' => __( 'Edit Events', 'bonestheme' ), /* Edit Display Title */
			'new_item' => __( 'New Event', 'bonestheme' ), /* New Display Title */
			'view_item' => __( 'View Event', 'bonestheme' ), /* View Display Title */
			'search_items' => __( 'Search Event', 'bonestheme' ), /* Search Event Title */ 
			'not_found' =>  __( 'Nothing found in the Database.', 'bonestheme' ), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __( 'Nothing found in Trash', 'bonestheme' ), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'This is the example Event type', 'bonestheme' ), /* Event Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => true,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => get_stylesheet_directory_uri() . '/library/images/custom-post-icon.png', /* the icon for the Event type menu */
			'rewrite'	=> array( 'slug' => 'event', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'event', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'excerpt' )
		) /* end of options */
	); /* end of register Event */
	
	
}

	// adding the function to the Wordpress init
	add_action( 'init', 'custom_post_event');


/**
 * i'm using the EXCERPT field to store the event date and times
 * first line is the event date, such as 4/1/2014
 * second line is the event start time, such as 12:00pm OPTIONAL
 * third line is the event end time, such as 1:00pm OPTIONAL
 */
function event_fetch($m, $y = 0) {

	if ($y == 0) $y = date('Y');
	
	$fetch_begin = strtotime($m . '/01/' . $y);
	$fetch_end   = strtotime('+1 month', $fetch_begin);
	$fetch_end   = strtotime('-1 day', $fetch_end);
	
	$events = array();

	// the actual event date is stored in the post excerpt

	// get all the events
	$all_events = get_posts(array(
	
		'post_type' => 'event',
		'posts_per_page' => -1,
		'order' => 'ASC'
	
	));
	
	// keep only the events in this month
	foreach ($all_events as $e) {
	
		$ee = explode_trim(chr(10), $e->post_excerpt);
	
		$ed = strtotime($ee[0]);
		
		if (!$ed) continue;
		if ($ed < $fetch_begin) continue;
		if ($ed > $fetch_end) continue;
		
		$key = date('Ymd', $ed) . $e->ID;
		$events[$key] = $e;
	
	}
	
	// sort those for me please
	ksort($events);
	
	return $events;

}

function event_get_date($excerpt) {
	$foo = explode_trim(chr(10), $excerpt);
	return $foo[0];
}

function event_get_start($excerpt) {
	$foo = explode_trim(chr(10), $excerpt);
	if (count($foo) > 1) return $foo[1];
}

function event_get_end($excerpt) {
	$foo = explode_trim(chr(10), $excerpt);
	if (count($foo) > 2) return $foo[2];
}


	
?>
