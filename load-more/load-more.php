<?php
/*
 * Plugin Name: Load More Stuff
 * Description: Adds "Load More" pagination button to archive and search pages.
 * Version: 1.2
 * Author: Joni Halabi
 * Author URI: http://www.thatdevgirl.com
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */

// Required functions.
require('inc/load-more-posts.inc');
require('inc/load-more-search.inc');
require('inc/load-more-create-results-obj.inc');
require('inc/load-more-get-search-query.inc');
require('inc/load-more-create-button.inc');

// JS and CSS assets.
wp_enqueue_script( 'load_more_js', plugin_dir_url( __FILE__ ) . '/js/load-more.min.js', array('jquery'), '20171116', true );
wp_enqueue_style( 'load_more_css', plugin_dir_url( __FILE__ ) . '/css/load-more.min.css');
