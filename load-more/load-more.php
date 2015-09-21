<?php
/*
 * Plugin Name: Load More
 * Description: Adds "Load More" pagination button to archive and search pages.
 */


/*
 * FUNCTION: loadMore__posts()
 *
 * USAGE: 
 *    Call this function in your posts/archive template to add a "load more" button for pagination.
 *    This function takes no parameters.
 */

function loadMore__posts() {
	// Get pagination options.
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$posts_per_page = get_option('posts_per_page');

	// Set up arguments for the posts query.
	$args = array(
		'paged'          => $paged,
		'posts_per_page' => $posts_per_page, 
		'post_type'      => 'post',
		'tag'            => single_tag_title('', false)
	);
	
	// Make the query.
	$query = new WP_Query($args);

	// Create the results object.
	$obj = loadMore__create_results_obj($query, $posts_per_page, $paged, null);

	// Create the load more button.
	loadMore__create_button($obj);
}


/*
 * FUNCTION: loadMore__search()
 *
 * PARAMETERS:
 *    $search_query: the search query
 *
 * USAGE: 
 *    Pass this function the search query as if it was the $args variable for WP_Query. 
 *    Also, if your search archive uses a filter for how many posts to show, pass that number 
 *    here as the second argument.
 */

function loadMore__search() {
	// Initial query
	$search_query = loadMore__get_search_query();
	$query = new WP_Query($search_query);
	$search_param = $search_query['s'];

	// Get pagination options.
	$posts_per_page = get_option('posts_per_page');	

	// Paginate & merge results
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	query_posts( array_merge($query->query, array('paged' => $paged)) );

	// Create the results object.
	$obj = loadMore__create_results_obj($query, $posts_per_page, $paged, $search_param);

	// Create the load more button.
	loadMore__create_button($obj);
}


/*
 * FUNCTION: loadMore__create_results_obj()
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

function loadMore__create_results_obj($query, $posts_per_page, $paged, $search_param) {
	// Get number of posts found, max number of pages, and number of posts to load next.
	$found_posts   = $query->found_posts;
	$max_num_pages = $query->max_num_pages;
	$num_of_posts  = min($posts_per_page, $found_posts - ($paged * $posts_per_page));

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


/*
 * FUNCTION: loadMore__get_search_query()
 *
 * USAGE: 
 *    Helper function to retrieve search query from WP.
 */

function loadMore__get_search_query() {
	global $query_string;

	$query_args = explode("&", $query_string);
	$search_query = array();

	foreach($query_args as $key => $string) {
		$query_split = explode("=", $string);
		$search_query[$query_split[0]] = urldecode($query_split[1]);
	}

	return $search_query;
}


/*
 * FUNCTION: loadMore__create_button()
 *
 * PARAMETERS:
 *    $results: object containing query results and attributes.
 *
 * USAGE: 
 *    Helper function to create and display load more button.
 */

function loadMore__create_button($results) {
	$attr  = '';
	$class = 'loadMore';

	if ($results->max_pages > 1 && $results->paged < $results->max_pages) {
		$attr  = 'data-paged="'      . ($results->paged + 1)    . '" ';
		$attr .= 'data-maxpages="'   . $results->max_pages      . '" ';
		$attr .= 'data-perpage="'    . $results->posts_per_page . '" ';
		$attr .= 'data-foundposts="' . $results->found_posts    . '" ';

		if ($results->search_param) {
			$attr .= 'data-searchparam="' . $results->search_param . '" ';
			$class .= ' loadMore--search';
		}

		$btn_text = '';

		if ($results->num_of_posts == 1) {
			$btn_text = 'Load 1 more article';
		} else {
			$btn_text = 'Load ' . $results->num_of_posts . ' more articles';
		}

		?>
		<a href="#" id="loadMoreBtn" class="<?php echo $class; ?>" <?php echo $attr; ?>>
			<?php echo $btn_text; ?>
		</a>
		<?
	}
}

// Load the JS and CSS files for this plugin.
wp_enqueue_script( 'load_more_js', plugin_dir_url( __FILE__ ) . '/js/load-more.js', array('jquery'), '20150918', true );
wp_enqueue_style( 'load_more_css', plugin_dir_url( __FILE__ ) . '/css/load-more.css');
