<?php defined('BLUDIT') or die('Bludit CMS.');
	
	$html .= '<h3>' . $L->get('langs-settings') . '</h3>';
	
	$main = true;
	
	$langGet = '';
	
	if ( $url->parameter('lang') !== false )
	{
		$langGet = $url->parameter('lang');
		
		$main = false;
	}
	
	$langs = $this->openDB( DB_LANGS );

    $html .= '<!-- NAV TABS --><nav class="mb-3"><div class="nav nav-tabs" id="nav-tab" role="tablist">';
	
	$html .= '<a class="nav-item nav-link ' . ( $main ? 'active' : '' ) . '" href="' . $this->site_url() . 'admin/configure-plugin/pluginSubBlogs?langs=true">Main</a>' . PHP_EOL;
	
	if ( !empty( $langs ) )
    {
		foreach ( $langs as $lan => $val ) 
		{
			//$html .= '<a class="nav-item nav-link" data-toggle="tab" href="#' . $lan . '">' . $val['name'] . '</a>' . PHP_EOL;
			
			$html .= '<a class="nav-item nav-link ' . ( ( empty( $main ) && ($langGet == $lan ) ) ? 'active' : '' ) . '" href="' . $this->site_url() . 'admin/configure-plugin/pluginSubBlogs?langs=true&lang=' . $lan . '">' . $val['name'] . '</a>' . PHP_EOL;
			
		}
		
	}

	$html .= '</div></nav>' . PHP_EOL;
				
	$html .= '<input type="hidden" id="jsLangs" name="LangsForm" value="true">' . PHP_EOL;
	
	$html .= '<input type="hidden" id="jsRedirect" name="DoRedirect" value="' . $fullURL . '">' . PHP_EOL;
		
	$html .= '<!-- TABS -->' . PHP_EOL;
	$html .= '<div class="tab-content">' . PHP_EOL;
	
	if ( $main )
	{
		$default = $this->getValue( 'default-lang' );
		
		$html .= '<input type="hidden" id="jsLangMain" name="LangMain" value="true">' . PHP_EOL;
		
		$xtra = $this->getValue( 'default-lang-extra' );
		
		$html .= '<!-- Main tab -->' . PHP_EOL;
		
		if ( !empty( $default ) && empty( $default['changed'] ) )
		{
			$html .= '<div class="alert alert-primary" role="alert">';
	
			$html .= $L->get( 'default-lang-not-changed' );
	
			$html .= '</div>';
		}
			
		$html .= '<div class="tab-pane fade show active" id="main" role="tabpanel" aria-labelledby="main-tab">';
		
		if ( empty( $this->getValue( 'default-lang' ) ) )
			$html .= '<div class="alert alert-primary" role="alert">' . $L->get('no-primary-lang') . '</div>';
				
		$html .= '<h5 class="mt-4 mb-2 pb-2 border-bottom">' . $L->get('select-default-lang') . '</h5>';
		
		$html .= '<div class="form-group row">';
		
		$html .= '<select name = "defaultlang" ' . ( ( !empty( $default ) && !empty( $default['changed'] ) ) ? 'disabled' : '' ) . ' />';
		
		//require_once ( $this->phpPath() . 'php' . DS . 'langs.php' );
		foreach ( $langz as $key=>$row ) 
		{
			$html .= '<option value="' . $key . '" ' . ( ( !empty( $default ) && ( $default['name'] == $key ) ) ? 'selected' : '' ) . '>' . $row['lang'] . ' (' . $row['locale'] . ')</option>';
		}
							
		$html .= '</select>';
		$html .= '</div>';
		
		$html .= '<h5 class="mt-4 mb-2 pb-2 border-bottom">' . $L->get('add-lang') . '</h5>';
		
		$html .= '<div class="form-group row">';
		//$html .= '<label for="jsdefaultLang" class="col-sm-2 col-form-label">' . $L->get( 'select-default-lang' ) . '</label>';
		$html .= '<select name = "addlang">';
		
		$html .= '<option value="0" selected>-----</option>';
		
		//require_once ( $this->phpPath() . 'php' . DS . 'langs.php' );
		foreach ( $langz as $key=>$row ) 
		{
			if ( !empty( $default ) && ( $default['name'] == $key ) )
				continue;
			
			//Is already installed this language?
			$searchKey = $this->searchKey( $key, 'code' );
			
			if ( !empty( $searchKey ) )
				continue;
					
			$html .= '<option value="' . $key . '" ' . ( ( !empty( $default ) && ( $default['name'] == $key ) ) ? 'selected' : '' ) . '>' . $row['lang'] . ' (' . $row['locale'] . ')</option>';
		}
							
		$html .= '</select>';	
		$html .= '</div>';
			
		$html .= '</div>' . PHP_EOL;
		
		//Extra Settings
		$html .= '<h4 class="mt-4 mb-2 pb-2 border-bottom">' . $L->get('main-lang-settings') . '</h4>';
		
		$html .= '<h5 class="mt-4 mb-2 pb-2 border-bottom">' . $L->get('contact-page-settings') . '</h5>';
		//Contact Page Selection
		$html .= '<div>';
		$html .= '<label>' . $L->get( 'contact-page' ) . '</label>';
		$html .= '<select name="contactPageSlug">';
		$html .= '<option value="" ' . ( ( isset( $xtra['contactPageSlug'] ) && $xtra[ 'contactPageSlug'] === '' ) ? 'selected' : '' ) . '>' . $L->get( 'Disabled' ) . '</option>';
			
		$staticPages = $this->getPagesList();
				
		if ( !empty( $staticPages ) )
		{
			foreach ( $staticPages as $staticKey => $staticRow )
				$html .= '<option value="' . $staticKey . '" ' . ( ( isset( $xtra['contactPageSlug'] ) && $xtra[ 'contactPageSlug'] === $staticKey ) ? 'selected':'' ) . '> ' . $staticRow->title() .'</option>';
		}
				
		$html .= '</select>';
		$html .= '<small class="form-text text-muted">' . $L->get( 'contact-page-info' ) . '</small>';
		$html .= '</div>' . PHP_EOL;
		
		if ( isset( $xtra['contactPageSlug'] ) && !empty( $xtra[ 'contactPageSlug'] ) )
		{
			//Contact menu title
			$html .= '<div>';
			$html .= '<label>' . $L->get( 'contact-menu-title' ) . '</label>';
			$html .= '<input name="contactPageTitle" type="text" class="form-control" value="' . ( isset( $xtra['contactPageTitle'] ) ? $xtra['contactPageTitle'] : '' ) . '" />';
			$html .= '<span class="tip">' . $L->get( 'contact-menu-info' ) . '</span>';
			$html .= '</div>' . PHP_EOL;
			
		}
		
		$html .= '<h5 class="mt-4 mb-2 pb-2 border-bottom">' . $L->get('archive-page-settings') . '</h5>';
		//Archive Page Selection
		$html .= '<div>';
		$html .= '<label>' . $L->get( 'archive-page' ) . '</label>';
		$html .= '<select name="archivePageSlug">';
		$html .= '<option value="" ' . ( isset( $xtra['archivePageSlug'] ) && ( $xtra['archivePageSlug'] === '' ) ? 'selected' : '' ) . '>' . $L->get( 'Disabled' ) . '</option>';
			
		if ( !empty( $staticPages ) )
		{
			foreach ( $staticPages as $staticKey => $staticRow )
				$html .= '<option value="' . $staticKey . '" ' . ( ( isset( $xtra['archivePageSlug'] ) && $xtra['archivePageSlug'] === $staticKey ) ? 'selected' : '' ) . '> ' . $staticRow->title() .'</option>';
		}
				
		$html .= '</select>';
		$html .= '<small class="form-text text-muted">' . $L->get( 'archive-page-info' ) . '</small>';
		$html .= '</div>' . PHP_EOL;
			
		if ( isset( $xtra['archivePageSlug'] ) && !empty( $xtra[ 'archivePageSlug'] ) )
		{
			//Archive menu title
			$html .= '<div>';
			$html .= '<label>' . $L->get( 'archive-menu-title' ) . '</label>';
			$html .= '<input name="archivePageTitle" type="text" class="form-control" value="' . ( isset( $xtra['archivePageTitle'] ) ? $xtra['archivePageTitle'] : '' ) . '" />';
			$html .= '<span class="tip">' . $L->get( 'archive-menu-info' ) . '</span>';
			$html .= '</div>' . PHP_EOL;
		}
		
		$html .= '<h5 class="mt-4 mb-2 pb-2 border-bottom">' . $L->get('site-related-settings') . '</h5>';
		$html .= '<div>';
		$html .= '<label>' . $L->get( 'disqus-code' ) . '</label>';
		$html .= '<input name="disqusCode" type="text" class="form-control" value="' . ( isset( $xtra['disqusCode'] ) ? $xtra['disqusCode'] : '' ) . '" />';
		$html .= '<span class="tip">' . $L->get( 'disqus-code-info' ) . '</span>';
		$html .= '</div>' . PHP_EOL;
		
		$html .= '<div>';
		$html .= '<label>' . $L->get( 'author-about' ) . '</label>';
		$html .= '<textarea rows="4" cols="40" name="authorAbout">' . ( isset( $xtra['authorAbout'] ) ? $xtra['authorAbout'] : '' ) . '</textarea>';
		$html .= '<span class="tip">' . $L->get( 'author-about-info' ) . '</span>';
		$html .= '</div>' . PHP_EOL;
		
		$html .= '<div>';
		$html .= '<label>' . $L->get( 'site-about' ) . '</label>';
		$html .= '<textarea rows="4" cols="40" name="siteAbout">' . ( isset( $xtra['siteAbout'] ) ? $xtra['siteAbout'] : '' ) . '</textarea>';
		$html .= '<span class="tip">' . $L->get( 'site-about-info' ) . '</span>';
		$html .= '</div>' . PHP_EOL;
			
		$html .= '<h5 class="mt-4 mb-2 pb-2 border-bottom">' . $L->get('cookie-consent-settings') . '</h5>';
		$html .= '<div>';
		$html .= '<label>' . $L->get( 'cookie-consent-message' ) . '</label>';
		$html .= '<textarea rows="4" cols="40" name="cookieConsentMessage" ' . ( !$this->getValue( 'cookieconsent' ) ? 'disabled' : '' ) . '>' . ( isset( $xtra['cookieConsentMessage'] ) ? $xtra['cookieConsentMessage'] : '' ) . '</textarea>';
		$html .= '<span class="tip">' . $L->get( 'cookie-message-info' ) . '</span>';
		$html .= '</div>' . PHP_EOL;
		
		$html .= '<div>';
		$html .= '<label>' . $L->get( 'cookie-consent-url' ) . '</label>';
		$html .= '<input name="cookieConsentUrl" type="text" class="form-control" value="' . ( isset( $xtra['cookieConsentUrl'] ) ? $xtra['cookieConsentUrl'] : '' ) . '" ' . ( !$this->getValue( 'cookieconsent' ) ? 'disabled' : '' ) . ' />';
		$html .= '</div>' . PHP_EOL;
		
		$html .= '<div>';
		$html .= '<label>' . $L->get( 'cookie-more-text' ) . '</label>';
		$html .= '<input name="cookieConsentMoreText" type="text" class="form-control" value="' . ( isset( $xtra['cookieConsentMoreText'] ) ? $xtra['cookieConsentMoreText'] : '' ) . '" ' . ( !$this->getValue( 'cookieconsent' ) ? 'disabled' : '' ) . ' />';
		$html .= '</div>' . PHP_EOL;
		
		$html .= '<div>';
		$html .= '<label>' . $L->get( 'cookie-dismiss-text' ) . '</label>';
		$html .= '<input name="cookieConsentButtonText" type="text" class="form-control" value="' . ( isset( $xtra['cookieConsentButtonText'] ) ? $xtra['cookieConsentButtonText'] : '' ) . '" ' . ( !$this->getValue( 'cookieconsent' ) ? 'disabled' : '' ) . ' />';
		$html .= '</div>' . PHP_EOL;

	}
	elseif ( !empty( $langs ) && isset( $langs[$langGet] ) )
	{
		global $site;
		
		$html .= '<input type="hidden" id="jsLangSub" name="LangSub" value="true">' . PHP_EOL;
		
		$val = $langs[$langGet];
		//print_r($val);
		$html .= '<!-- Lan-' . $langGet . ' tab --><div class="tab-pane fade show active" id="main" role="tabpanel" aria-labelledby="main-tab"><div class="form-group row"><label for="jssiteName" class="col-sm-2 col-form-label">' . $L->get( 'site-title' ) . '</label><div class="col-sm-10"><input class="form-control" id="jssiteName" name="langz[' . $langGet . '][siteName]" value="' . ( !empty($val['siteName']) ? $val['siteName'] : '' ) . '" placeholder="" type="text"><small class="form-text text-muted">' . $L->get( 'site-title-info' ) . '</small></div></div><!--//Setting-->' . PHP_EOL;
			
		$html .= '<!--Setting--><div class="form-group row"><label for="jssiteDescription" class="col-sm-2 col-form-label">' . $L->get( 'site-description' ) . '</label><div class="col-sm-10"><input class="form-control" id="jssiteDescription" name="langz[' . $langGet . '][siteDescription]" value="' . ( !empty($val['siteDescription']) ? $val['siteDescription'] : '' ) . '" placeholder="" type="text"><small class="form-text text-muted">' . $L->get( 'site-description-info' ) . '</small></div></div><!--//Setting-->' . PHP_EOL;
			
		$html .= '<!--Setting--><div class="form-group row"><label for="jssiteSlogan" class="col-sm-2 col-form-label">' . $L->get( 'site-slogan' ) . '</label><div class="col-sm-10"><input class="form-control" id="jssiteSlogan" name="langz[' . $langGet . '][siteSlogan]" value="' . ( !empty($val['siteSlogan']) ? $val['siteSlogan'] : '' ) . '" placeholder="" type="text"><small class="form-text text-muted">' . $L->get( 'site-slogan-info' ) . '</small></div></div><!--//Setting-->' . PHP_EOL;
			
		$html .= '<!--Setting--><div class="form-group row"><label for="jssiteAbout" class="col-sm-2 col-form-label">' . $L->get( 'site-about' ) . '</label><div class="col-sm-10"><textarea rows="4" cols="40" name="langz[' . $langGet . '][siteAbout]">' . ( !empty($val['siteAbout']) ? $val['siteAbout'] : '' ) . '</textarea><small class="form-text text-muted">' . $L->get( 'site-about-info' ) . '</small></div></div><!--//Setting-->' . PHP_EOL;
			
		$html .= '<!--Setting--><div class="form-group row"><label for="jsdateFormat" class="col-sm-2 col-form-label">' . $L->get( 'date-format' ) . '</label><div class="col-sm-10"><input class="form-control" id="jsdateFormat" name="langz[' . $langGet . '][dateFormat]" value="' . ( !empty($val['dateFormat']) ? $val['dateFormat'] : '' ) . '" placeholder="" type="text"><small class="form-text text-muted">' . sprintf( $L->get( 'date-format-info' ), date( $val['dateFormat'], time() ) ) . '</small></div></div><!--//Setting-->' . PHP_EOL;
			
		$html .= '<!--Setting--><div class="form-group row"><label for="jsauthorAbout" class="col-sm-2 col-form-label">' . $L->get( 'author-about' ) . '</label><div class="col-sm-10"><textarea rows="4" cols="40" name="langz[' . $langGet . '][authorAbout]">' . ( !empty($val['authorAbout']) ? $val['authorAbout'] : '' ) . '</textarea><small class="form-text text-muted">' . $L->get( 'author-about-info' ) . '</small></div></div><!--//Setting-->' . PHP_EOL;
		
		$html .= '<div class="form-group row">';
		$html .= '<label for="jscontactpage" class="col-sm-2 col-form-label">' . $L->get( 'contact-page' ) . '</label>';
		$html .= '<div class="col-sm-10">';
		$html .= '<select name="langz[' . $langGet . '][contactPageSlug]">';
		$html .= '<option value="" ' . ( $val['contactPageSlug'] === '' ? 'selected' : '' ) . '>' . $L->get( 'Disabled' ) . '</option>';
			
		$staticPages = $this->getPagesList( $langGet );
			
		if ( !empty( $staticPages ) )
		{
			foreach ( $staticPages as $staticKey => $staticRow )
				$html .= '<option value="' . $staticKey . '" ' . ( ( !empty( $val['contactPageSlug'] ) && $val['contactPageSlug'] === $staticKey ) ? 'selected':'' ) . '> ' . $staticRow->title() .'</option>';
		}
			
		$html .= '</select>';
		$html .= '<small class="form-text text-muted">' . $L->get( 'contact-page-info' ) . '</small>';
		$html .= '</div></div>' . PHP_EOL;
		
		if ( !empty( $val['contactPageSlug'] ) )
		{
			$html .= '<!--Setting--><div class="form-group row"><label for="jscontactTitle" class="col-sm-2 col-form-label">' . $L->get( 'contact-menu-title' ) . '</label><div class="col-sm-10"><input class="form-control" id="jscontactTitle" name="langz[' . $langGet . '][contactPageTitle]" value="' . ( !empty($val['contactPageTitle']) ? $val['contactPageTitle'] : '' ) . '" placeholder="" type="text"><small class="form-text text-muted">' . $L->get( 'contact-menu-info' ) . '</small></div></div><!--//Setting-->' . PHP_EOL;
		}
		
		$html .= '<div class="form-group row">';
		$html .= '<label for="jsarchivepage" class="col-sm-2 col-form-label">' . $L->get( 'archive-page' ) . '</label>';
		$html .= '<div class="col-sm-10">';
		$html .= '<select name="langz[' . $langGet . '][archivePageSlug]">';
		$html .= '<option value="" ' . ( $val['archivePageSlug'] === '' ? 'selected' : '' ) . '>' . $L->get( 'Disabled' ) . '</option>';
			
		if ( !empty( $staticPages ) )
		{
			foreach ( $staticPages as $staticKey => $staticRow )
				$html .= '<option value="' . $staticKey . '" ' . ( ( !empty( $val['archivePageSlug'] ) && $val['archivePageSlug'] === $staticKey ) ? 'selected':'' ) . '> ' . $staticRow->title() .'</option>';
		}
			
		$html .= '</select>';
		$html .= '<small class="form-text text-muted">' . $L->get( 'archive-page-info' ) . '</small>';
		$html .= '</div></div>' . PHP_EOL;
		
		if ( !empty( $val['archivePageSlug'] ) )
		{
			$html .= '<!--Setting--><div class="form-group row"><label for="jsarchivePageTitle" class="col-sm-2 col-form-label">' . $L->get( 'contact-menu-title' ) . '</label><div class="col-sm-10"><input class="form-control" id="jsarchivePageTitle" name="langz[' . $langGet . '][archivePageTitle]" value="' . ( !empty($val['archivePageTitle']) ? $val['archivePageTitle'] : '' ) . '" placeholder="" type="text"><small class="form-text text-muted">' . $L->get( 'archive-menu-info' ) . '</small></div></div><!--//Setting-->' . PHP_EOL;
		}

		$html .= '<!--Setting--><div class="form-group row"><label for="jsdisqusCode" class="col-sm-2 col-form-label">' . $L->get( 'disqus-code' ) . '</label><div class="col-sm-10"><input class="form-control" id="jsdisqusCode" name="langz[' . $langGet . '][disqusCode]" value="' . ( !empty($val['disqusCode']) ? $val['disqusCode'] : '' ) . '" placeholder="" type="text"><small class="form-text text-muted">' . $L->get( 'disqus-code-info' ) . '</small></div></div><!--//Setting-->' . PHP_EOL;
		
		if ( $site->homepage() !== '' )
		{
			$html .= '<div class="form-group row">';
			$html .= '<label for="jsdisableBlog" class="col-sm-2 col-form-label">' . $L->get( 'lang-homepage-select' ) . '</label>';
			$html .= '<div class="col-sm-10">';
			$html .= '<select name="langz[' . $langGet . '][homePage]">';
			$html .= '<option value="" ' . ( $val['homePage'] === '' ? 'selected' : '' ) . '>' . $L->get( 'Disabled' ) . '</option>';
			
			//$staticPages = $this->getPagesList( $langGet );
			
			if ( !empty( $staticPages ) )
			{
				foreach ( $staticPages as $staticKey => $staticRow )
					$html .= '<option value="' . $staticKey . '" ' . ( $val['homePage'] === $staticKey ? 'selected':'' ) . '> ' . $staticRow->title() .'</option>';
			}
			
			$html .= '</select>';
			$html .= '<small class="form-text text-muted">' . $L->get( 'lang-homepage-info' ) . '</small>';
			$html .= '</div></div>' . PHP_EOL;
		}
		
		$html .= '<h5 class="mt-4 mb-2 pb-2 border-bottom">' . $L->get('cookie-consent-settings') . '</h5>';
		
		$html .= '<!--Setting--><div class="form-group row"><label for="jscookieConsentMessage" class="col-sm-2 col-form-label">' . $L->get( 'cookie-consent-message' ) . '</label><div class="col-sm-10"><textarea rows="4" cols="40" name="langz[' . $langGet . '][cookieConsentMessage]">' . ( !empty($val['cookieConsentMessage']) ? $val['cookieConsentMessage'] : '' ) . '</textarea><small class="form-text text-muted">' . $L->get( 'cookie-message-info' ) . '</small></div></div><!--//Setting-->' . PHP_EOL;
		
		$html .= '<!--Setting--><div class="form-group row"><label for="jscookieConsentUrl" class="col-sm-2 col-form-label">' . $L->get( 'cookie-consent-url' ) . '</label><div class="col-sm-10"><input class="form-control" id="jscookieConsentUrl" name="langz[' . $langGet . '][cookieConsentUrl]" value="' . ( !empty($val['cookieConsentUrl']) ? $val['cookieConsentUrl'] : '' ) . '" placeholder="" type="text"></div></div><!--//Setting-->' . PHP_EOL;
		
		$html .= '<!--Setting--><div class="form-group row"><label for="jscookieConsentMoreText" class="col-sm-2 col-form-label">' . $L->get( 'cookie-more-text' ) . '</label><div class="col-sm-10"><input class="form-control" id="jscookieConsentMoreText" name="langz[' . $langGet . '][cookieConsentMoreText]" value="' . ( !empty($val['cookieConsentMoreText']) ? $val['cookieConsentMoreText'] : '' ) . '" placeholder="" type="text"></div></div><!--//Setting-->' . PHP_EOL;
		
		$html .= '<!--Setting--><div class="form-group row"><label for="jscookieConsentButtonText" class="col-sm-2 col-form-label">' . $L->get( 'cookie-dismiss-text' ) . '</label><div class="col-sm-10"><input class="form-control" id="jscookieConsentButtonText" name="langz[' . $langGet . '][cookieConsentButtonText]" value="' . ( !empty($val['cookieConsentButtonText']) ? $val['cookieConsentButtonText'] : '' ) . '" placeholder="" type="text"></div></div><!--//Setting-->' . PHP_EOL;
		
		$html .= '<h5 class="mt-4 mb-2 pb-2 border-bottom">' . $L->get('lang-disable') . '</h5>';
		
		$html .= '<div class="form-group row">';
        $html .= '<label for="jsdisableBlog" class="col-sm-2 col-form-label">' . $L->get( 'lang-disable' ) . '</label>';
		$html .= '<div class="col-sm-10">';
        $html .= '<select name="langz[' . $langGet . '][disable]">';
        $html .= '<option value="true" ' . ( $val['disable'] === true ? 'selected' : '' ) . '>' . $L->get( 'Enabled' ) . '</option>';
        $html .= '<option value="false" ' . ( $val['disable'] === false ? 'selected':'' ) . '> ' . $L->get( 'Disabled' ).'</option>';
        $html .= '</select>';
		$html .= '<small class="form-text text-muted">' . $L->get( 'lang-disable-info' ) . '</small>';
        $html .= '</div></div>' . PHP_EOL;
			
		$html .= '</div><!-- //Lan-' . $langGet . ' tab -->' . PHP_EOL;
			
	}
	/*
	if ( !empty( $langs ) )
    {
		foreach ( $langs as $lan => $val ) 
		{

			$html .= '<!-- Lan-' . $lan . ' tab --><div class="tab-pane" id="' . $lan . '"><div class="form-group row"><label for="jssiteName" class="col-sm-2 col-form-label">' . $L->get( 'site-title' ) . '</label><div class="col-sm-10"><input class="form-control" id="jssiteName" name="langz[' . $lan . '][siteName]" value="' . ( !empty($val['siteName']) ? $val['siteName'] : '' ) . '" placeholder="" type="text"><small class="form-text text-muted">' . $L->get( 'site-title-info' ) . '</small></div></div><!--//Setting-->' . PHP_EOL;
			
			$html .= '<!--Setting--><div class="form-group row"><label for="jssiteDescription" class="col-sm-2 col-form-label">' . $L->get( 'site-description' ) . '</label><div class="col-sm-10"><input class="form-control" id="jssiteDescription" name="langz[' . $lan . '][siteDescription]" value="' . ( !empty($val['siteDescription']) ? $val['siteDescription'] : '' ) . '" placeholder="" type="text"><small class="form-text text-muted">' . $L->get( 'site-description-info' ) . '</small></div></div><!--//Setting-->' . PHP_EOL;
			
			$html .= '<!--Setting--><div class="form-group row"><label for="jssiteSlogan" class="col-sm-2 col-form-label">' . $L->get( 'site-slogan' ) . '</label><div class="col-sm-10"><input class="form-control" id="jssiteSlogan" name="langz[' . $lan . '][siteSlogan]" value="' . ( !empty($val['siteSlogan']) ? $val['siteSlogan'] : '' ) . '" placeholder="" type="text"><small class="form-text text-muted">' . $L->get( 'site-slogan-info' ) . '</small></div></div><!--//Setting-->' . PHP_EOL;
			
			$html .= '<!--Setting--><div class="form-group row"><label for="jssiteAbout" class="col-sm-2 col-form-label">' . $L->get( 'site-about' ) . '</label><div class="col-sm-10"><input class="form-control" id="jssiteAbout" name="langz[' . $lan . '][siteAbout]" value="' . ( !empty($val['siteAbout']) ? $val['siteAbout'] : '' ) . '" placeholder="" type="text"><small class="form-text text-muted">' . $L->get( 'site-about-info' ) . '</small></div></div><!--//Setting-->' . PHP_EOL;
			
			$html .= '<!--Setting--><div class="form-group row"><label for="jsdateFormat" class="col-sm-2 col-form-label">' . $L->get( 'date-format' ) . '</label><div class="col-sm-10"><input class="form-control" id="jsdateFormat" name="langz[' . $lan . '][dateFormat]" value="' . ( !empty($val['dateFormat']) ? $val['dateFormat'] : '' ) . '" placeholder="" type="text"><small class="form-text text-muted">' . sprintf( $L->get( 'date-format-info' ), date( $val['dateFormat'], time() ) ) . '</small></div></div><!--//Setting-->' . PHP_EOL;
			
			$html .= '<!--Setting--><div class="form-group row"><label for="jsauthorAbout" class="col-sm-2 col-form-label">' . $L->get( 'author-about' ) . '</label><div class="col-sm-10"><input class="form-control" id="jsauthorAbout" name="langz[' . $lan . '][authorAbout]" value="' . ( !empty($val['authorAbout']) ? $val['authorAbout'] : '' ) . '" placeholder="" type="text"><small class="form-text text-muted">' . $L->get( 'author-about-info' ) . '</small></div></div><!--//Setting-->' . PHP_EOL;
			
			$html .= '<!--Setting--><div class="form-group row"><label for="jsdisqusCode" class="col-sm-2 col-form-label">' . $L->get( 'disqus-code' ) . '</label><div class="col-sm-10"><input class="form-control" id="jsdisqusCode" name="langz[' . $lan . '][disqusCode]" value="' . ( !empty($val['disqusCode']) ? $val['disqusCode'] : '' ) . '" placeholder="" type="text"><small class="form-text text-muted">' . $L->get( 'disqus-code-info' ) . '</small></div></div><!--//Setting-->' . PHP_EOL;
			
			$html .= '</div><!-- //Lan-' . $lan . ' tab -->' . PHP_EOL;
		}
		
	}*/
		
	$html .= '</div>' . PHP_EOL;