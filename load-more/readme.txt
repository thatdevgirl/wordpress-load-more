=== Load More Stuff ===
Contributors: thatdevgirl
Tags: pagination, search, posts
Donate Link: https://www.paypal.me/thatdevgirl
Requires at least: 3.0.1
Tested up to: 4.9
Stable tag: 1.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Add a "load more" button to your archive and search results pages to dynamically load additional posts without pagination or page loads.

== Description ==

This plugin supports pagination on a WordPress page via a "Load More" button.  Clicking on the button will add additional posts from a query to the bottom of the page in intervals set by the maximum number of posts option in the WordPress admin.

The number of posts to be updated will be automatically adjusted based on the number of remaining posts to be added and the button will automatically hide when there are no more posts to load.

== Installation ==

This directory should be placed in the plugins directory in your WordPress installation.  Place the following code wherever you would like the "Load More" button to be displayed, for example, in your index.php or archive.php template file:

`<?php load_more_posts(); ?>`

If this plugin is being used on a search results page, the button will query for results other than posts (i.e. other content types, pages, etc).  On a search results page template, for example, search.php, place the following code wherever you would like the "Load More" button to be displayed.

`<?php load_more_search(); ?>`

== Changelog ==

= 1.2 =
* Tested plugin on v4.9
* Updating code to be more compliant with WP PHP code standards.
* Finally minifying JS and CSS files.

= 1.1 =
* Tested plugin on v4.7.1
* Fixed a bug that did not allow articles to load if no #primary ID exists in DOM.

= 1.0 =
* Initial release.
