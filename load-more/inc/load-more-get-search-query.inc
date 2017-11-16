<?php
/*
 * FUNCTION: load_more_get_search_query()
 *
 * USAGE:
 *    Helper function to retrieve search query from WP.
 */

function load_more_get_search_query() {
	global $query_string;

	$query_args = explode( "&", $query_string );
	$search_query = array();

	foreach( $query_args as $key => $string ) {
		$query_split = explode( "=", $string );
		$search_query[$query_split[0]] = urldecode( $query_split[1] );
	}

	return $search_query;
}
