<?php
/**
 * Knowledge Park Guide theme: an "On this page" contents list and a related-guides list for guides.
 * Both are server-rendered blocks used in templates/single.html, so they need no JavaScript.
 */

/** A text-based id for a heading ("Why students use Pari Chowk" -> "why-students-use-pari-chowk"), unique per page. */
function kpg_heading_id( $text, array &$used ) {
	$base = sanitize_title( $text );
	if ( '' === $base ) {
		$base = 'section';
	}
	$id = $base;
	for ( $n = 2; isset( $used[ $id ] ); $n++ ) {
		$id = $base . '-' . $n;
	}
	$used[ $id ] = true;
	return $id;
}

/** The post's H2 headings in order, as [ id, text ] pairs. An id already set on a heading is kept. */
function kpg_post_headings( $post ) {
	$headings = array();
	$used     = array();
	$walk     = function ( $blocks ) use ( &$walk, &$headings, &$used ) {
		foreach ( $blocks as $block ) {
			if ( 'core/heading' === $block['blockName'] && 2 === (int) ( $block['attrs']['level'] ?? 2 ) ) {
				$text = trim( wp_strip_all_tags( $block['innerHTML'] ) );
				if ( preg_match( '/<h2[^>]*\sid="([^"]+)"/', $block['innerHTML'], $m ) ) {
					$id          = $m[1];
					$used[ $id ] = true;
				} else {
					$id = kpg_heading_id( $text, $used );
				}
				$headings[] = array( $id, $text );
			}
			if ( ! empty( $block['innerBlocks'] ) ) {
				$walk( $block['innerBlocks'] );
			}
		}
	};
	$walk( parse_blocks( $post->post_content ) );
	return $headings;
}

/** Give each H2 in a guide the same id the contents list links to. */
add_filter(
	'render_block_core/heading',
	function ( $html, $block ) {
		static $ids = null;
		if ( ! is_singular( 'post' ) || 2 !== (int) ( $block['attrs']['level'] ?? 2 ) || preg_match( '/^<h2[^>]*\sid=/', ltrim( $html ) ) ) {
			return $html;
		}
		if ( null === $ids ) {
			$ids = array();
			foreach ( kpg_post_headings( get_queried_object() ) as list( $id, $text ) ) {
				$ids[ $text ][] = $id;
			}
		}
		$text = trim( wp_strip_all_tags( $html ) );
		if ( empty( $ids[ $text ] ) ) {
			return $html;
		}
		return preg_replace( '/^(\s*<h2\b)/', '$1 id="' . esc_attr( array_shift( $ids[ $text ] ) ) . '"', $html, 1 );
	},
	10,
	2
);

/** "On this page": a collapsed list on phones, a sticky sidebar on wide screens (see the CSS in theme.json). */
function kpg_render_toc() {
	if ( ! is_singular( 'post' ) ) {
		return '';
	}
	$headings = kpg_post_headings( get_queried_object() );
	if ( count( $headings ) < 3 ) {
		return '';
	}
	$items = '';
	foreach ( $headings as list( $id, $text ) ) {
		$items .= '<li><a href="#' . esc_attr( $id ) . '">' . esc_html( wptexturize( $text ) ) . '</a></li>';
	}
	return '<nav class="kpg-toc" aria-label="On this page">'
		. '<details class="kpg-toc-mobile"><summary>On this page</summary><ol>' . $items . '</ol></details>'
		. '<div class="kpg-toc-desktop"><p class="kpg-toc-title">On this page</p><ol>' . $items . '</ol></div>'
		. '</nav>';
}

/** Up to three other guides: same category first, then the newest. */
function kpg_render_related() {
	if ( ! is_singular( 'post' ) ) {
		return '';
	}
	$post    = get_queried_object();
	$args    = array(
		'post_type'           => 'post',
		'post_status'         => 'publish',
		'numberposts'         => 3,
		'ignore_sticky_posts' => true,
		'post__not_in'        => array( $post->ID ),
	);
	$cats    = wp_get_post_categories( $post->ID );
	$related = $cats ? get_posts( $args + array( 'category__in' => $cats ) ) : array();
	if ( count( $related ) < 3 ) {
		$args['numberposts']  = 3 - count( $related );
		$args['post__not_in'] = array_merge( array( $post->ID ), wp_list_pluck( $related, 'ID' ) );
		$related              = array_merge( $related, get_posts( $args ) );
	}
	if ( ! $related ) {
		return '';
	}
	$items = '';
	foreach ( $related as $p ) {
		$items .= '<li><a href="' . esc_url( get_permalink( $p ) ) . '">' . esc_html( get_the_title( $p ) ) . '</a>'
			. '<p>' . esc_html( wp_trim_words( get_the_excerpt( $p ), 22 ) ) . '</p></li>';
	}
	return '<section class="kpg-related" aria-labelledby="kpg-related-title"><h2 id="kpg-related-title">Related guides</h2><ul>' . $items . '</ul></section>';
}

add_action(
	'init',
	function () {
		register_block_type( 'kpg/toc', array( 'render_callback' => 'kpg_render_toc' ) );
		register_block_type( 'kpg/related', array( 'render_callback' => 'kpg_render_related' ) );
	}
);
