<!DOCTYPE html>
<html ⚡>
<head>
    <?php include('php/head.php') ?>
</head>

<body class="amp-template">
    <header class="main-header">
        <nav class="blog-title">
            <a href="<?php echo siteURL() ?>"><?php echo siteName() ?></a>
        </nav>
    </header>
	<?php if ( checkKey( $ampSettings, 'enableautoads' ) && checkKey( $ampSettings, 'adclient' ) ) : ?>
	<amp-auto-ads type="adsense"
			data-ad-client="<?php echo $ampSettings['adclient'] ?>">
		</amp-auto-ads>
	<?php endif ?>

    <main class="content" role="main">
	 <?php 
		if ( isProduct() )
			include( AMP_PHP_PATH . 'product.php' );
			
		elseif ( isThread() )
			include( AMP_PHP_PATH . 'thread.php' );
				
		elseif ( isTopic() )
			include( AMP_PHP_PATH . 'topic.php' );

		else
			include( AMP_PHP_PATH . 'page.php' );
	 
	 //include('php/page.php'); ?>
    </main>
    <footer class="site-footer clearfix">
	<div class="better-amp-main-link"><a href="<?php echo $page->permalink(); ?>">View Desktop Version</a></div>
        <section class="copyright"><a href="<?php echo siteURL() ?>"><?php echo siteName() ?></a> &copy; <?=date('Y', time());?></section>
        <section class="poweredby">Powered By <a href="https://www.bludit.com/" target="_blank">Bludit</a></section>
    </footer>
	
<?php if ( checkKey( $ampSettings, 'googleanalytics' ) ) : ?>
<amp-analytics type="googleanalytics">
<script type="application/json">
{
  "vars": {
    "account": "<?php echo $ampSettings['googleanalytics'] ?>"
  },
  "triggers": {
    "trackPageview": {
      "on": "visible",
      "request": "pageview"
    }
  }
}
</script>
</amp-analytics>
<?php endif ?>
</body>
</html>