<?php
/* Bones Alumni Type Example
This page walks you through creating 
a Alumni type and taxonomies. You
can edit this one or copy the following code 
to create another one. 

I put this in a separate file so as to 
keep it organized. I find it easier to edit
and change things if they are concentrated
in their own file.

Developed by: Eddie Machado
URL: http://themble.com/bones/
*/

// Flush rewrite rules for Alumni types
#add_action( 'after_switch_theme', 'bones_flush_rewrite_rules' );

// Flush your rewrite rules
#function bones_flush_rewrite_rules() {
#	flush_rewrite_rules();
#}

// let's create the function for the Alumni
function custom_post_alumni() { 
	// creating (registering) the Alumni 
	register_post_type( 'alumni', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this Alumni
		array( 'labels' => array(
			'name' => __( 'Alumni', 'bonestheme' ), /* This is the Title of the Group */
			'singular_name' => __( 'Alumni', 'bonestheme' ), /* This is the individual type */
			'all_items' => __( 'All Alumni', 'bonestheme' ), /* the all items menu item */
			'add_new' => __( 'Add New', 'bonestheme' ), /* The add new menu item */
			'add_new_item' => __( 'Add New Alumni', 'bonestheme' ), /* Add New Display Title */
			'edit' => __( 'Edit', 'bonestheme' ), /* Edit Dialog */
			'edit_item' => __( 'Edit Alumni', 'bonestheme' ), /* Edit Display Title */
			'new_item' => __( 'New Alumni', 'bonestheme' ), /* New Display Title */
			'view_item' => __( 'View Alumni', 'bonestheme' ), /* View Display Title */
			'search_items' => __( 'Search Alumni', 'bonestheme' ), /* Search Alumni Title */ 
			'not_found' =>  __( 'Nothing found in the Database.', 'bonestheme' ), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __( 'Nothing found in Trash', 'bonestheme' ), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'This is the example Alumni type', 'bonestheme' ), /* Alumni Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => true,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => get_stylesheet_directory_uri() . '/library/images/custom-post-icon.png', /* the icon for the Alumni type menu */
			'rewrite'	=> array( 'slug' => 'alumni', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'alumni', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt' )
		) /* end of options */
	); /* end of register Alumni */
	
	
}

	// adding the function to the Wordpress init
	add_action( 'init', 'custom_post_alumni');


function alumni_fetch() {

	$staff = get_posts(array(
	
		'post_type' => 'alumni',
		'posts_per_page' => -1,
		'order' => 'ASC'
	
	));
	
	return $staff;

}
	
?>
