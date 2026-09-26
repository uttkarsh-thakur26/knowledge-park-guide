<?php
// Rank Math baseline config, run with: wp eval-file - < rank-math-setup.php
// Re-runnable: it only sets the keys below and leaves every other setting alone.

$general = get_option( 'rank-math-options-general' );
$general['strip_category_base']   = 'on';  // hubs live at /getting-here/, not /category/getting-here/
$general['breadcrumbs']           = 'on';
$general['breadcrumbs_separator'] = '›';
update_option( 'rank-math-options-general', $general );

$titles = get_option( 'rank-math-options-titles' );
$titles['knowledgegraph_type']          = 'company'; // Organization schema: "Knowledge Park Guide"
$titles['title_separator']              = '|';
$titles['pt_page_default_rich_snippet'] = 'off';     // pages (Home, About) get WebPage, not Article
update_option( 'rank-math-options-titles', $titles );

// Keep only what this site uses; the 404 monitor + redirections feed the Milestone II audit.
$modules = [ 'link-counter', 'seo-analysis', 'sitemap', 'rich-snippet', 'instant-indexing', '404-monitor', 'redirections' ];
update_option( 'rank_math_modules', $modules );
// Turning modules on in the dashboard also creates their DB tables. Setting the option directly doesn't,
// and without the tables, redirections/404 queries fail and break pages with query strings (502s).
\RankMath\Installer::create_tables( $modules );

// Same as clicking "Skip" on the setup wizard's account-connect step. The free plugin works without an
// account, but it won't load its front end (titles, schema, sitemap) until connect is done or skipped.
update_option( 'rank_math_registration_skip', 1 );
update_option( 'rank_math_is_configured', 1, false );

flush_rewrite_rules();
echo "Rank Math configured\n";
