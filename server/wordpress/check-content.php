<?php
// Compare the pages and category hub intros in /tmp/kpg-content.json with what WordPress holds. Changes nothing.
// Each item is run through the same sanitizing WordPress applies on save, so "same" means a publish would be a no-op.
// Run: wp eval-file - < check-content.php (content/publish-pages.py --check does this)

$admins = get_users( [ 'role' => 'administrator', 'number' => 1, 'fields' => 'ID' ] );
wp_set_current_user( $admins[0] ); // same user as apply-content.php, so the same save filters apply

$data = json_decode( file_get_contents( '/tmp/kpg-content.json' ), true );
$seo  = [ 'meta_title' => 'rank_math_title', 'meta_description' => 'rank_math_description', 'focus_keyword' => 'rank_math_focus_keyword' ];

function kpg_report( $label, $diffs ) {
	echo $label . ': ' . ( $diffs ? 'DIFFERS (' . implode( ', ', $diffs ) . ')' : 'same' ) . "\n";
}

foreach ( $data['pages'] ?? [] as $p ) {
	$page = get_page_by_path( $p['slug'] );
	if ( ! $page ) { echo "page {$p['slug']}: not on the site yet\n"; continue; }
	$diffs    = [];
	$expected = wp_unslash( sanitize_post_field( 'post_content', wp_slash( $p['content'] ), $page->ID, 'db' ) );
	if ( rtrim( $page->post_content ) !== rtrim( $expected ) ) { $diffs[] = 'content'; }
	if ( $page->post_title !== $p['title'] ) { $diffs[] = 'title'; }
	foreach ( $seo as $key => $meta ) {
		if ( (string) get_post_meta( $page->ID, $meta, true ) !== $p[ $key ] ) { $diffs[] = $key; }
	}
	kpg_report( "page {$p['slug']} (ID {$page->ID})", $diffs );
}

foreach ( $data['categories'] ?? [] as $c ) {
	$term = get_term_by( 'slug', $c['slug'], 'category' );
	if ( ! $term ) { echo "category {$c['slug']}: not on the site\n"; continue; }
	$diffs    = [];
	$expected = wp_unslash( sanitize_term_field( 'description', wp_slash( $c['content'] ), $term->term_id, 'category', 'db' ) );
	if ( trim( $term->description ) !== trim( $expected ) ) { $diffs[] = 'content'; }
	foreach ( $seo as $key => $meta ) {
		if ( (string) get_term_meta( $term->term_id, $meta, true ) !== $c[ $key ] ) { $diffs[] = $key; }
	}
	kpg_report( "category {$c['slug']}", $diffs );
}
