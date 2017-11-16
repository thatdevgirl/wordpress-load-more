<?php
/**
 * FUNCTION: load_more_search()
 *
 * PARAMETERS:
 *    $search_query: the search query
 *
 * USAGE:
 *    Pass this function the search query as if it was the $args variable for WP_Query.
 *    Also, if your search archive uses a filter for how many posts to show, pass that number
 *    here as the second argument.
 */

function load_more_search() {
	// Initial query
	$search_query = load_more_get_search_query();
	$query = new WP_Query( $search_query );
	$search_param = $search_query['s'];

	// Get pagination options.
	$posts_per_page = get_option( 'posts_per_page' );

	// Paginate & merge results
	$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
	query_posts( array_merge( $query->query, array( 'paged' => $paged ) ) );

	// Create the results object.
	$obj = load_more_create_results_obj( $query, $posts_per_page, $paged, $search_param );

	// Create the load more button.
	load_more_create_button( $obj );
}

// For backwards compatibility
function loadMore__search() {
  load_more_search();
}
