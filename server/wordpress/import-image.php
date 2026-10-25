<?php
// Import one photo into the media library as WebP: upright, metadata stripped, at most 1600 px wide.
// Inputs, uploaded by content/add-image.py: /tmp/kpg-image-src (the photo) and /tmp/kpg-image.json ({name, alt}).
// Run: wp eval-file - < import-image.php
require_once ABSPATH . 'wp-admin/includes/file.php';
require_once ABSPATH . 'wp-admin/includes/media.php';
require_once ABSPATH . 'wp-admin/includes/image.php';

$admins = get_users( [ 'role' => 'administrator', 'number' => 1, 'fields' => 'ID' ] );
wp_set_current_user( $admins[0] );

$job  = json_decode( file_get_contents( '/tmp/kpg-image.json' ), true );
$name = sanitize_file_name( $job['name'] );
$out  = "/tmp/$name.webp";

$img = new Imagick( '/tmp/kpg-image-src' );
// Phones store rotation as an EXIF flag; apply it to the pixels before the EXIF is stripped.
switch ( $img->getImageOrientation() ) {
	case Imagick::ORIENTATION_BOTTOMRIGHT: $img->rotateImage( '#000', 180 ); break;
	case Imagick::ORIENTATION_RIGHTTOP:    $img->rotateImage( '#000', 90 ); break;
	case Imagick::ORIENTATION_LEFTBOTTOM:  $img->rotateImage( '#000', -90 ); break;
}
$img->setImageOrientation( Imagick::ORIENTATION_TOPLEFT );
$img->stripImage(); // drops EXIF, including GPS location
if ( $img->getImageWidth() > 1600 ) {
	$img->resizeImage( 1600, 0, Imagick::FILTER_LANCZOS, 1 );
}
$img->setImageFormat( 'webp' );
$img->setImageCompressionQuality( 80 );
$img->writeImage( $out );

$id = media_handle_sideload( [ 'name' => "$name.webp", 'tmp_name' => $out ], 0, null, [ 'post_title' => $job['alt'] ] );
if ( is_wp_error( $id ) ) {
	@unlink( $out );
	echo 'error: ' . $id->get_error_message() . "\n";
	return;
}
update_post_meta( $id, '_wp_attachment_image_alt', $job['alt'] );
$meta = wp_get_attachment_metadata( $id );
echo "attachment $id  {$meta['width']}x{$meta['height']}  " . wp_get_attachment_url( $id ) . "\n";
