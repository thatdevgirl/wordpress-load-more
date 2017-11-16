<?php
/**
 * FUNCTION: load_more_create_results_obj()
 *
 * PARAMETERS:
 *    $query: WP query results object
 *    $posts_per_page: the number of posts to display per page
 *    $paged: the number of the next page to load
 *    $search_param: search parameters (could be blank)
 *
 * USAGE:
 *    Helper function to create and display load more button.
 */

function load_more_create_results_obj( $query, $posts_per_page, $paged, $search_param ) {
	// Get number of posts found, max number of pages, and number of posts to load next.
	$found_posts   = $query->found_posts;
	$max_num_pages = $query->max_num_pages;
	$num_of_posts  = min( $posts_per_page, $found_posts - ( $paged * $posts_per_page ) );

	// Create the return object.
	$obj = (object) array(
		'paged'          => $paged,
		'posts_per_page' => $posts_per_page,
		'max_pages'      => $max_num_pages,
		'found_posts'    => $found_posts,
		'num_of_posts'   => $num_of_posts,
		'search_param'   => $search_param
	);

	return $obj;
}
