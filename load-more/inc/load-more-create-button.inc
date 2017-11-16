<?php
/*
 * FUNCTION: load_more_create_button()
 *
 * PARAMETERS:
 *    $results: object containing query results and attributes.
 *
 * USAGE:
 *    Helper function to create and display load more button.
 */

function load_more_create_button( $results ) {
	$attr  = '';
	$class = 'loadMore';

	if ( $results->max_pages > 1 && $results->paged < $results->max_pages ) {
		$attr  = 'data-paged="'      . ( $results->paged + 1 )    . '" ';
		$attr .= 'data-maxpages="'   . $results->max_pages      . '" ';
		$attr .= 'data-perpage="'    . $results->posts_per_page . '" ';
		$attr .= 'data-foundposts="' . $results->found_posts    . '" ';

		if ( $results->search_param ) {
			$attr .= 'data-searchparam="' . $results->search_param . '" ';
			$class .= ' loadMore--search';
		}

		$btn_text = '';

		if ( $results->num_of_posts == 1 ) {
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
