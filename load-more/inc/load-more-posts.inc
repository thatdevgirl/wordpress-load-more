<?php
/**
 * FUNCTION: load_more_posts()
 *
 * USAGE:
 *    Call this function in your posts/archive template to add a "load more" button for pagination.
 *    This function takes no parameters.
 */

function load_more_posts() {
	// Get pagination options.
	$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
	$posts_per_page = get_option( 'posts_per_page' );

	// Set up arguments for the posts query.
	$args = array(
		'paged'          => $paged,
		'posts_per_page' => $posts_per_page,
		'post_type'      => 'post',
		'tag'            => single_tag_title( '', false )
	);

	// Make the query.
	$query = new WP_Query( $args );

	// Create the results object.
	$obj = load_more_create_results_obj( $query, $posts_per_page, $paged, null );

	// Create the load more button.
	load_more_create_button( $obj );
}

// For backwards compatibility
function loadMore__posts() {
  load_more_posts();
}
