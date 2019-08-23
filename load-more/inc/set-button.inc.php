<?php

/**
 * Load More: Set Button
 *
 * Add the load more posts button to the page.
 */

class LoadMoreButton {

  public function __construct() {
    add_filter( 'body_class', array( $this, 'add_load_more' ) );
    //print '<button id="loadMoreBtn">Load more</button>';
  }

  // Function to append the load more button to the end of the content.
  public function add_load_more( $classes ) {
    if ( is_archive() ) {
      $classes[] = 'load-more';
    }

    return $classes;
  }

}

// Instantiate this class.
new LoadMoreButton;
