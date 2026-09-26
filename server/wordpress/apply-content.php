<?php
// Publish pages and category hub intros from content/ (uploaded to /tmp/kpg-content.json), with Rank Math meta.
// Re-runnable: pages are matched by slug and categories by slug, so running it again updates in place.
// Run: wp eval-file - < apply-content.php

$admins = get_users( [ 'role' => 'administrator', 'number' => 1, 'fields' => 'ID' ] );
wp_set_current_user( $admins[0] ); // run as an admin so saves behave like the dashboard

$data = json_decode( file_get_contents( '/tmp/kpg-content.json' ), true );

foreach ( $data['pages'] ?? [] as $p ) {
	$existing = get_page_by_path( $p['slug'] );
	$id = wp_insert_post( [
		'ID'           => $existing ? $existing->ID : 0,
		'post_type'    => 'page',
		'post_status'  => 'publish',
		'post_name'    => $p['slug'],
		'post_title'   => $p['title'],
		'post_content' => $p['content'],
	], true );
	if ( is_wp_error( $id ) ) { echo "page {$p['slug']}: " . $id->get_error_message() . "\n"; continue; }
	update_post_meta( $id, 'rank_math_title', $p['meta_title'] );
	update_post_meta( $id, 'rank_math_description', $p['meta_description'] );
	update_post_meta( $id, 'rank_math_focus_keyword', $p['focus_keyword'] );
	echo "page {$p['slug']} => ID $id\n";
}

foreach ( $data['posts'] ?? [] as $p ) {
	$existing = get_posts( [ 'name' => $p['slug'], 'post_type' => 'post', 'post_status' => 'any', 'numberposts' => 1 ] );
	$cat = get_term_by( 'slug', $p['category'], 'category' );
	$id = wp_insert_post( [
		'ID'            => $existing ? $existing[0]->ID : 0,
		'post_type'     => 'post',
		'post_status'   => $p['status'], // 'draft' until the author approves, then 'publish'
		'post_name'     => $p['slug'],
		'post_title'    => $p['title'],
		'post_excerpt'  => $p['excerpt'],
		'post_content'  => $p['content'],
		'post_category' => $cat ? [ $cat->term_id ] : [],
	], true );
	if ( is_wp_error( $id ) ) { echo "post {$p['slug']}: " . $id->get_error_message() . "\n"; continue; }
	update_post_meta( $id, 'rank_math_title', $p['meta_title'] );
	update_post_meta( $id, 'rank_math_description', $p['meta_description'] );
	update_post_meta( $id, 'rank_math_focus_keyword', $p['focus_keyword'] );
	echo "post {$p['slug']} => ID $id ({$p['status']})\n";
}

foreach ( $data['categories'] ?? [] as $c ) {
	$term = get_term_by( 'slug', $c['slug'], 'category' );
	if ( ! $term ) { echo "category {$c['slug']}: not found\n"; continue; }
	wp_update_term( $term->term_id, 'category', [ 'description' => $c['content'] ] );
	update_term_meta( $term->term_id, 'rank_math_title', $c['meta_title'] );
	update_term_meta( $term->term_id, 'rank_math_description', $c['meta_description'] );
	update_term_meta( $term->term_id, 'rank_math_focus_keyword', $c['focus_keyword'] );
	echo "category {$c['slug']} updated\n";
}

$home = get_page_by_path( 'home' );
$guides = get_page_by_path( 'guides' );
if ( $home && $guides && ! empty( $data['pages'] ) ) {
	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $home->ID );
	update_option( 'page_for_posts', $guides->ID );
	echo "front page = {$home->ID}, posts page = {$guides->ID}\n";
}
