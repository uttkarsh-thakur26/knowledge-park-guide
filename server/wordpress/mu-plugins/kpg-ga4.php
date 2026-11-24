<?php
/**
 * Plugin Name: KPG – Google Analytics 4
 * Description: Adds the GA4 tag (G-GXEZPFG9L6) to every front-end page, skipping logged-in users so our own visits stay out of the reports. Also sends a custom faq_open event when a reader expands an FAQ question.
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
// Custom event: which FAQ questions readers open. "toggle" doesn't bubble, so listen in the capture phase.
document.addEventListener('toggle', function (e) {
	var d = e.target;
	if (!d.open || !d.classList || !d.classList.contains('kpg-faq')) { return; }
	var q = d.querySelector('summary');
	gtag('event', 'faq_open', {
		faq_question: q ? q.textContent.trim().slice(0, 100) : '',
		page_path: location.pathname
	});
}, true);
</script>
	<?php
}, 1 );
