<!DOCTYPE html>
<html lang="<?php echo themeLocale() ?>">
<head>
	<?php include( THEME_DIR_PHP . 'header.php' ) ?>
</head>

<body class="home blog">
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content">Skip to content</a>
	<header id="masthead" class="site-header" role="banner">
		<div class="site-branding">
			<h1 class="site-title">
				<a href="<?php echo siteURL() ?>" rel="home"><?php echo siteName() ?></a>
			</h1>
			<p class="site-description"><?php echo siteSlogan() ?></p>
		</div>
	<?php include(THEME_DIR_PHP.'navbar.php'); ?>
		
	</header><!-- #masthead -->

	<div id="content" class="site-content">
		
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

	<?php
		if ($WHERE_AM_I == 'page') {
			include(THEME_DIR_PHP.'page.php');
		} else {
			include(THEME_DIR_PHP.'home.php');
		}
	?>
		
		</main><!-- #main -->
	</div><!-- #primary -->

	<?php include(THEME_DIR_PHP.'sidebar.php'); ?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
				<div class="site-info-wrapper clear">
						<div class="site-info">
				Powered By <a rel="nofollow" target="_blank" href="https://www.bludit.com/">Bludit</a>
				<span class="sep"> ~ </span>
				Theme: Penscratch 2 by <a rel="nofollow" target="_blank" href="https://wordpress.com/themes/" rel="designer">WordPress.com</a>, Ported to Bludit by <a target="_blank" href="https://homebrewgr.info/en/">LazyTech</a>.</div><!-- .site-info -->
		</div><!-- .site-info-wrapper -->
	</footer><!-- #colophon -->
</div><!-- #page -->
<script type='text/javascript' src='<?=HTML_PATH_THEME;?>js/js.php'></script>
		<script>
/*globals jQuery, document */
(function ($) {
    "use strict";

    $(document).ready(function(){        
       /*Creates Captions from Alt tags*/
        $(".entry-content img").each(function() {
            /*Let's put a caption if there is one*/
            if($(this).attr("alt"))
              $(this).wrap('<figure class="wp-caption-text"></figure>')
              .after('<figcaption>'+$(this).attr("alt")+'</figcaption>');
        });
    });
}(jQuery));
</script>

<?php Theme::plugins('siteBodyEnd') ?>

</body>
</html>