AJAX "Load More" Pagination
=========================

__Author:__ Joni Halabi (www.jhalabi.com)

__License:__ GPLv2 or later (http://www.gnu.org/licenses/gpl-2.0.html)

Add a "load more" button to your archive and search results pages to dynamically load additional posts without pagination or page loads.  Clicking on the button will add additional posts from a query to the bottom of the page in intervals set by the maximum number of posts option in the WordPress admin.

The number of posts to be updated will be automatically adjusted based on the number of remaining posts to be added and the button will automatically hide when there are no more posts to load.

Usage
-----------

This directory should be placed in the plugins directory in your WordPress installation.  Place the following code wherever you would like the "Load More" button to be displayed:

```
<?php loadMore__posts(); ?>
```

If this plugin is being used on a search results page, the button will query for results other than posts (i.e. other content types, pages, etc).  On a search results page, place the following code wherever you would like the "Load More" button to be displayed.

```
<?php loadMore__search(); ?>
```
