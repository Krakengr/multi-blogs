<?php defined('BLUDIT') or die('Bludit CMS.');

global $langDetails, $site;

$html .= PHP_EOL . '<!-- SEO Begin -->' . PHP_EOL;

//Build the whole url here, there is no point to search for the post
$canonic = ( ( isset( $_SERVER['HTTPS'] ) && ( $_SERVER['HTTPS'] == 'on' ) ) ? 'https' : 'http' ) . '://' . $_SERVER["SERVER_NAME"] . $_SERVER['REQUEST_URI'];

$html .= '<link rel="canonical" href="' . $canonic . '" />' . PHP_EOL;

$seo = $this->getValue('seo-settings');

if ( $uri['whereAmI'] == 'page' )
{
	global $page;
	
	$og = array(
	
		'noindex' => ( $page->noindex() ? true : false ),	

		'nofollow' => ( $page->nofollow() ? true : false ),
		
		'noarchive' => ( $page->noarchive() ? true : false )
		
	);
	
	$image = '';
	
	if ( $page->coverImage() )
		$image = $page->coverImage();
	else
	{
		$img = $this->getImage( $page->content() );
		
		if ( !empty( $img ) )
			$image = $img;
		
		elseif ( $seo['defaultImage'] !== '' )
			$image = $seo['defaultImage'];
	}
		
	if ( ( $og['noindex'] ) || ( $og['nofollow'] ) || ( $og['noarchive'] ) )
	{
		$robots = array();
				
		if ( $og['noindex'] )
			$robots['noindex'] = 'noindex';
				

		if ( $og['nofollow'] )
			$robots['nofollow'] = 'nofollow';
				

		if ( $og['noarchive'] )
			$robots['noarchive'] = 'noarchive';
				
		$html .= '<meta name="robots" content="' . implode(',', $robots) . '"/>' . PHP_EOL;
	}
	
	//General Option
	elseif ( isset( $uri['noIndex'] ) && !empty( $uri['noIndex'] ) )
		$html .= '<meta name="robots" content="noindex, follow"/>' . PHP_EOL;
	else
		$html .= '<meta name="robots" content="max-snippet:-1, max-image-preview:large, max-video-preview:-1" />' . PHP_EOL;
		
	
	$html .= '<meta property="og:locale" content="' . themeLocale() . '" />' . PHP_EOL;
	
	$html .= '<meta property="og:type" content="article" />' . PHP_EOL;
	$html .= '<meta property="og:title" content="' . $this->buildTitle() . '" />' . PHP_EOL;
	$html .= '<meta property="og:description" content="' . $this->builDescription() . '" />' . PHP_EOL;
	$html .= '<meta property="og:url" content="' . $canonic . '" />' . PHP_EOL;
	$html .= '<meta property="og:site_name" content="' . htmlspecialchars( siteName(), ENT_QUOTES ) . '" />' . PHP_EOL;
	
	if ( $page->category() )
		$html .= '<meta property="article:section" content="' . htmlspecialchars( $page->category(), ENT_QUOTES ) . '" />' . PHP_EOL;
	
	$uri = $this->uri;
	
	if ( !empty( $uri ) && !empty( $uri['lang'] ) )
	{
		$nextPrev = $this->getPreviousNextURL( $page->slug(), $uri['lang'] );
		
		if ( !empty( $nextPrev['next'] ) )
		{
			$link = $this->buildUrlByKey( $nextPrev['next'] );
			
			$html .= '<link rel="next" href="' . $link . '" />' . PHP_EOL;	
		}
		
		if ( !empty( $nextPrev['prev'] ) )
		{
			$link = $this->buildUrlByKey( $nextPrev['prev'] );
			
			$html .=  '<link rel="prev" href="' . $link . '" />' . PHP_EOL;
		}
	}
	
	else
	{
		
	}
	
	$tags = $page->tags( true );
			
	if ( !empty( $tags ) ) 
	{
		$tagnum = 0;
		$num_tags = count( $tags );
		
		$html .= '<meta name="keywords" content="';
		
		foreach( $tags as $tagKey => $tagName )
		{
			$tagnum++;
						
			$html .= htmlspecialchars( $tagName, ENT_QUOTES );
						
				if ($tagnum < $num_tags)
					$html .= ',';
			}
					
			$html .= '">' . PHP_EOL;
			
		foreach( $tags as $tagKey => $tagName )
			$html .= '<meta property="article:tag" content="' . htmlspecialchars( $tagName, ENT_QUOTES ) . '" />' . PHP_EOL;
	}
		
	//$html .= '<meta property="article:publisher" content="https://www.facebook.com/yoast" />' . PHP_EOL;
		
	//if ( $page->coverImage() )
	if ( $image !== '' )
	{
		list($img_width, $img_height) = @getimagesize( $image );//@getimagesize( $page->coverImage() );

		$html .= '<meta property="og:image" content="' . $image . '" />' . PHP_EOL;
		
		if ( substr( $image, 0, 5 ) == "https" )
			$html .= '<meta property="og:image:secure_url" content="' . $image . '" />' . PHP_EOL;
		
		if ( !empty( $img_width ) && !empty( $img_height ) ) 
		{
			$html .= '<meta property="og:image:width" content="' . $img_width . '" />' . PHP_EOL;
			$html .= '<meta property="og:image:height" content="' . $img_width . '" />' . PHP_EOL;
		}
		
		$html .= '<meta name="twitter:card" content="summary_large_image" />' . PHP_EOL;
	}
	
	$html .= '<meta name="twitter:description" content="' . $this->builDescription() . '" />' . PHP_EOL;
	$html .= '<meta name="twitter:title" content="' . $this->buildTitle() . '" />' . PHP_EOL;
	//$html .= '<meta name="twitter:site" content="@yoast" />' . PHP_EOL;
	//if ( $page->coverImage() )
	if ( $image !== '' )
		$html .= '<meta name="twitter:image" content="' . $image . '" />' . PHP_EOL;
	//$html .= '<meta name="twitter:creator" content="@yoast" />' . PHP_EOL;
}

else
{
	//global $url;
	
	$uri = $this->uri;
	
	$whereAmI = $uri['whereAmI'];
	
	$noindex = false;
	
	$next_tag = '';
	
	$prev_tag = '';
	
	if ( !empty( $uri['categorySlug'] ) && ( ( $seo['enable-no-follow'] == 'categories' ) || ( $seo['enable-no-follow'] == 'everywhere' ) ) )
		$noindex = true;
	
	if ( ( $whereAmI == 'tag' ) && ( ( $seo['enable-no-follow'] == 'tags' ) || ( $seo['enable-no-follow'] == 'everywhere' ) ) )
		$noindex = true;
	
	if ( isset( $uri['noIndex'] ) && !empty( $uri['noIndex'] ) )
		$noindex = true;
	
	if ( strpos( $_SERVER['REQUEST_URI'], 'page=' ) !== false )
	{
		if ( ( $seo['enable-no-follow'] == 'pages' ) || ( $seo['enable-no-follow'] == 'everywhere' ) )
			$noindex = true;
		
		$amountOfPages = Paginator::numberOfPages();

		if ( $amountOfPages > 1 && isset( $_GET['page'] ) ) 
		{
			$site_url = $this->site_url();
			
			$site_url .= ( ( !empty( $uri ) && !empty( $uri['lang'] ) ) ? $uri['lang'] . '/' : '' );
			
			$site_url .= ( ( !empty( $uri ) && !empty( $uri['blog'] ) ) ? $uri['blog'] . '/' : '' );
			
			$current = (int) $_GET['page'];
			
			$next = ( $current + 1 );
			
			$prev = ( $current - 1 );		
					
			if ( $amountOfPages > $current ) 
			{
				$next_tag = '<link rel="next" href="' . $site_url . '?page=' . $next . '" />' . PHP_EOL;	
			}
					
			if ( $prev > 0 )
			{
				$prev_tag =  '<link rel="prev" href="' . $site_url . '?page=' . $prev . '" />' . PHP_EOL;
			}		

		}
	}
	
	if ( empty( $noindex ) )
		$html .= '<meta name="robots" content="max-snippet:-1, max-image-preview:large, max-video-preview:-1" />' . PHP_EOL;
	else
		$html .= '<meta name="robots" content="noindex, follow"/>' . PHP_EOL;
	
	$html .= '<meta property="og:locale" content="' . themeLocale() . '" />' . PHP_EOL;
	
	$html .= '<meta property="og:type" content="website" />' . PHP_EOL;
	$html .= '<meta property="og:title" content="' . $this->buildTitle() . '" />' . PHP_EOL;
	$html .= '<meta property="og:description" content="' . $this->builDescription() . '" />' . PHP_EOL;
	$html .= '<meta property="og:url" content="' . $canonic . '" />' . PHP_EOL;
	$html .= '<meta property="og:site_name" content="' . htmlspecialchars( ( siteName() ), ENT_QUOTES ) . '" />' . PHP_EOL;
	
	if ( $prev_tag !== '' )
		$html .= $prev_tag;
	
	if ( $next_tag !== '' )
		$html .= $next_tag;
	
	if ( $seo['defaultImage'] !== '' )
	{
		$image = $seo['defaultImage'];
		
		list($img_width, $img_height) = @getimagesize( $image );
		
		$html .= '<meta property="og:image" content="' . $image . '" />' . PHP_EOL;
		
		if ( substr( $image, 0, 5 ) == "https" )
			$html .= '<meta property="og:image:secure_url" content="' . $image . '" />' . PHP_EOL;
	
		if ( !empty( $img_width ) && !empty( $img_height ) ) 
		{
			$html .= '<meta property="og:image:width" content="' . $img_width . '" />' . PHP_EOL;
			$html .= '<meta property="og:image:height" content="' . $img_width . '" />' . PHP_EOL;
		}
		
		$html .= '<meta name="twitter:card" content="summary_large_image" />' . PHP_EOL;
		
		$html .= '<meta name="twitter:image" content="' . $image . '" />' . PHP_EOL;
	}
	
	$html .= '<meta name="twitter:description" content="' . $this->builDescription() . '" />' . PHP_EOL;
	$html .= '<meta name="twitter:title" content="' . $this->buildTitle() . '" />' . PHP_EOL;
	
	//$html .= '<meta name="twitter:site" content="@yoast" />' . PHP_EOL;
	
	//$html .= '<meta name="twitter:creator" content="@jdevalk" />' . PHP_EOL;
}

if ( $seo['google'] )
	$html .= '<meta name="google-site-verification" content="' . $seo['google'] . '">' . PHP_EOL;
		
if ( $seo['bing'] )
	$html .= '<meta name="msvalidate.01" content="' . $seo['bing'] . '">' . PHP_EOL;
		
if ( $seo['yandex'] )
	$html .= '<meta name="yandex-verification" content="' . $seo['yandex'] . '">' . PHP_EOL;

$html .= '<meta name="application-name" content="&nbsp;" />' . PHP_EOL;

if ( $seo['referrer-policy'] !== 'none' )
	$html .= '<meta name="referrer" content="' . $seo['referrer-policy'] . '" />' . PHP_EOL;

$html .= '<!-- SEO END -->' . PHP_EOL;
