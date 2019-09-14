/**
 * Load More button functionality.
 */

( ( $ ) => {

  const LoadMoreButton = {

    // Replace the existing WP core pagination block with the load more button.
    add: function() {
      const wp_pagination = $( '.load-more nav.pagination' );

      const load_more_button = `
        <div>
          <p>
            <button class="load-more">Load More</button>
          </p>
        </div>
      `;

      // First, add the button after the pagination block.
      $( wp_pagination ).after( load_more_button );

      // Then, remove the existing WP core pagination.
      $( wp_pagination ).remove();
    }

  }

  // Kick this off!
  $( document ).ready( () => { LoadMoreButton.add(); } );

} )( jQuery );
