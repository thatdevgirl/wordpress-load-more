/**
 * load-more.js
 *
 * Handles "load more" pagination at the bottom of archive pages, etc.
 */

( function($) {
	var loadMorePosts = {
		go: function() {
			var _this = this;

			$('#loadMoreBtn').on('click', function(e) {
				e.preventDefault();
				
				var btn = $('#loadMoreBtn');
				btn.innerHTML = 'Loading...';
				
				var params = _this.getParams(btn);
				var href   = _this.getHref(params);
			
				$('<div />').load(href, function() {
					var data = $(this);

					_this.loadNextPage(data);
					_this.updateBtn(btn, params);

					// TODO: Highlight search terms of AJAX content if we're on a search page
					//if (term !== undefined && term !== ""){
					//	highlightSearchTerms(term);
					//}
				});
			});		
		},

		// Get the button parameters.
		getParams: function(btn) {
			var params = {
				paged:        btn.attr('data-paged'),
				max_pages:    btn.attr('data-maxpages'),
				per_page:     btn.attr('data-perpage'),
				found_posts:  btn.attr('data-foundposts'),
				search_param: btn.attr('data-searchparam')
			};

			return params;
		},

		// Construct the search URL for the next page of posts.
		getHref: function(params) {
			if (params.search_param) {
				return '?s=' + params.search_param + '&paged=' + params.paged;;
			} else {
				return '?paged=' + params.paged;
			}
		},

		// Load all data found after the last post article
		loadNextPage: function(data) {
			data.find('article').each(function() {
				var articles = $('#primary article');
				var i = articles.length - 1;

				$(this).insertAfter(articles[i]);
			});
		},

		// Update the button after displaying the next page of posts.
		updateBtn: function(btn, params) {
			// If we loaded the last page, hide the button.
			if ( !Number(params.paged) || Number(params.paged) >= Number(params.max_pages) ) {
				btn.hide();
			}

			// Otherwise, update the button to load the next page. 
			else {
				var num_posts = Number(params.found_posts) - ( Number(params.paged) * Number(params.per_page) );
			
				if ( Number(params.per_page) < Number(num_posts) ) {
					num_posts = Number(params.per_page);
				}
		
				// Update the button text.
				if (num_posts == 1)  {
					btn.text('Load 1 more article');
				} else {
					btn.text('Load ' + num_posts + ' more articles');
				}
		
				// Update the button page attribute.
				params.paged++;
				btn.attr('data-paged', params.paged);
			}
		
			return true;
		}
	};

	loadMorePosts.go();

} )(jQuery);
