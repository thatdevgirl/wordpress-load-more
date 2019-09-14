<?php

/**
 * Load More: Set Button
 *
 * Add a class to the page body to indicate that the load more button should appear.
 */

class LoadMoreStuff {

  public function __construct() {
    wp_enqueue_script( 'jquery' );
    add_action( 'wp_enqueue_scripts', array( $this, 'add_assets' ) );

    add_filter( 'body_class', array( $this, 'add_class' ) );
  }

  // Public function to add the JS to the front-end.
  public function add_assets() {
    $frontEndJs = '../build/load-more-stuff.min.js';

    wp_enqueue_script(
      'load-more-js',
      plugin_dir_url( __FILE__ ) . $frontEndJs,
      array(),
      filemtime( plugin_dir_path( __FILE__ ) . $frontEndJs )
    );
  }

  // Public function to add the initializing class to the body of archive pages.
  public function add_class( $classes ) {
    // Check to see what page we are on.
    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

    // Let's only load the load more button on page 1 of an archive.
    // Chances are, that is the page users will land on, but it's possible they
    // can directly access a subsequent page directly. We only want the load more
    // functionality to exist on the first page of an archive.
    if ( is_archive() && $paged == 1 ) {
      $classes[] = 'load-more';
    }

    return $classes;
  }

}

new LoadMoreStuff;
