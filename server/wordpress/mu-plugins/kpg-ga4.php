<?php
/**
 * Plugin Name: KPG – Google Analytics 4
 * Description: Adds the GA4 tag (G-GXEZPFG9L6) to every front-end page, skipping logged-in users so our own visits stay out of the reports.
 */

add_action( 'wp_head', function () {
	if ( is_user_logged_in() ) {
		return;
	}
	?>
<script async src="https://www.googletagmanager.com/gtag/js?id=G-GXEZPFG9L6"></script>
<script>
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());
gtag('config', 'G-GXEZPFG9L6');
</script>
	<?php
}, 1 );
