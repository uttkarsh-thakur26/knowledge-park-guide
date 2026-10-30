<?php
/**
 * Plugin Name: KPG – SEO rules
 * Description: Keeps hubs without any guides out of search results until their first guide is published.
 */

// An empty hub is only an intro with "no guides yet", so it asks search engines not to index it.
// Indexing comes back on its own once the hub has a published post.
add_filter( 'rank_math/frontend/robots', function ( $robots ) {
	if ( is_category() ) {
		$term = get_queried_object();
		if ( $term instanceof WP_Term && 0 === (int) $term->count ) {
			$robots['index'] = 'noindex';
		}
	}
	return $robots;
} );
