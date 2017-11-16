/**
 * load-more.js
 *
 * Handles "load more" pagination at the bottom of archive pages, etc.
 */

(function($) {
	const loadMorePosts = {
		go: function() {
			const _this = this;

			$('#loadMoreBtn').on('click', (e) => {
				e.preventDefault();

				let btn = $('#loadMoreBtn');
				btn.text('Loading...');

				const params = this.getParams(btn);
				const href = this.getHref(params);

				$('<div />').load(href, function() {
					const data = $(this);

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
			return {
				paged:        btn.attr('data-paged'),
				max_pages:    btn.attr('data-maxpages'),
				per_page:     btn.attr('data-perpage'),
				found_posts:  btn.attr('data-foundposts'),
				search_param: btn.attr('data-searchparam')
			};
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
				const articles = $('article');
				const i = articles.length - 1;

				$(this).insertAfter(articles[i]);
			});
		},

		// Update the button after displaying the next page of posts.
		updateBtn: function(btn, params) {
			// If we loaded the last page, hide the button.
			if (!Number(params.paged) || Number(params.paged) >= Number(params.max_pages)) {
				btn.hide();
			}

			// Otherwise, update the button to load the next page.
			else {
				let num_posts = Number(params.found_posts) - ( Number(params.paged) * Number(params.per_page) );

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

  $(document).ready(function() {
    loadMorePosts.go();
  });

})(jQuery);
