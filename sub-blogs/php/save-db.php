<?php defined('BLUDIT') or die('Bludit CMS.');

if ( isset( $_POST['autoEditForm'] ) )
{
	if ( !empty( $_POST['feeds'] ) ) 
	{
		$auto = $this->openDB( DB_AUTO );
		
		foreach( $_POST['feeds'] as $key => $row ) 
		{
			
			if ( isset( $auto[$key] ) )
			{
				if ( isset ( $row['deleteFeed'] ) )
				{
					unset( $auto[$key] );
					
					continue;
				}
	
				$auto[$key] = array( 
						'source' => $row['sourceURL'],
						'category' => $row['sourceCategory'],
						'copyImages' => ( isset ( $row['copyImages'] ) ? true : false ),
						'firstCover' => ( isset ( $row['firstCover'] ) ? true : false ),
						'setsourceurl' => ( isset ( $row['setsourceurl'] ) ? true : false ),
						'striphtml' => ( isset ( $row['striphtml'] ) ? true : false ),
						'skipnoimages' => ( isset ( $row['skipnoimages'] ) ? true : false ),
						'user' =>  Sanitize::html( $row['user'] ),
						'sourceWords' =>  Sanitize::html( $row['sourceWords'] ),
						'status' => Sanitize::html( $row['status'] ),
						'autoDelete' => Sanitize::html( $row['autoDelete'] ),
						'maxPosts' => Sanitize::html( $row['maxPosts'] ),
						'oldPosts' => Sanitize::html( $row['oldPosts'] ),
						'disabled' => ( isset ( $row['disabled'] ) ? true : false ),
						'list' => $auto[$key]['list']
				);

			}
		}
		
		$this->addDB ( $auto, DB_AUTO );
	}

}

if ( isset( $_POST['seoForm'] ) )
{
	$array = array 
	(
			'defaultImage' => Sanitize::html( $_POST['defaultImage'] ),
			'fbpage' => Sanitize::html( $_POST['fbpage'] ),
			'site-description' => Sanitize::html( $_POST['site-description'] ),
			'referrer-policy' => $_POST['referrer-policy'],
			'google' => Sanitize::html( $_POST['google'] ),
			'bing' => Sanitize::html( $_POST['bing'] ),
			'yandex' => Sanitize::html( $_POST['yandex'] ),
			'enable-no-follow' => Sanitize::html( $_POST['enable-no-follow'] ),
			'addSeoAlt' => ( ( isset( $_POST['addSeoAlt'] ) && ( $_POST['addSeoAlt'] == 'true' ) ) ? true : false ),
			'lazyLoad' => ( ( isset( $_POST['lazyLoad'] ) && ( $_POST['lazyLoad'] == 'true' ) ) ? true : false ),
			'noFollowExt' => ( ( isset( $_POST['noFollowExt'] ) && ( $_POST['noFollowExt'] == 'true' ) ) ? true : false ),
			'newTabExt' => ( ( isset( $_POST['newTabExt'] ) && ( $_POST['newTabExt'] == 'true' ) ) ? true : false ),
			'sitemapImages' => ( ( isset( $_POST['sitemapImages'] ) && ( $_POST['sitemapImages'] == 'true' ) ) ? true : false ),
			'sitemapFeatured' => ( ( isset( $_POST['sitemapFeatured'] ) && ( $_POST['sitemapFeatured'] == 'true' ) ) ? true : false ),
			'sitemapPing' => ( ( isset( $_POST['sitemapPing'] ) && ( $_POST['sitemapPing'] == 'true' ) ) ? true : false )
	);

	$this->db['seo-settings'] = $array;
}
		
if ( isset( $_POST['usersForm'] ) && isset( $_POST['users'] ) && !empty( $_POST['users'] ) )
{
			$array = array();
			
			foreach( $_POST['users'] as $key => $value )
			{
				if ( ( $value == 'true' ) || ( $value == 'false' ) )
					$array[$key] = ( ( $value == 'true' ) ? true : false );
				
				elseif ( ( ( $key == 'agreement-text' ) || ( $key == 'privacy-policy' ) ) )
				{
					$array['last-update-' . $key] = ( !empty( $value ) ? time() : '' );
					
					$array[$key] = htmlentities( $value );
				}
					
				else
					$array[$key] = htmlentities( $value );
			}
			
			$this->db['users-settings'] = $array;
}
		
if ( isset( $_POST['AntiSpamForm'] ) && isset( $_POST['spam'] ) && !empty( $_POST['spam'] ) )
{
			$array = array();
			
			foreach( $_POST['spam'] as $key => $value )
			{
				if ( ( $value == 'true' ) || ( $value == 'false' ) )
					$array[$key] = ( ( $value == 'true' ) ? true : false );
				else
					$array[$key] = htmlentities( $value );
			}
			
			$this->db['antispam-settings'] = $array;
}
		
if ( isset( $_POST['redirForm'] ) )
{
			$redirsDB = $this->openDB( DB_REDIRS );
			
			$uuid = md5( uniqid() . time() );
			
			$redirsDB[$uuid] = array(
									'oldUrl' => Sanitize::html( $_POST['old-url'] ),
									'newUrl' => Sanitize::html( $_POST['new-url'] ),
									'views' => 0
			);
}

if ( isset( $_POST['redirEdit'] ) )
{
		$redirsDB = $this->openDB( DB_REDIRS );
			
		$uuid = $_POST['redirID'];
		
		if ( isset( $redirsDB[$uuid]  ) )
		{			
			$redirsDB[$uuid] = array(
									'oldUrl' => Sanitize::html( $_POST['old-url'] ),
									'newUrl' => Sanitize::html( $_POST['new-url'] ),
									'views' => $redirsDB[$uuid]['views']
			);
			
			$this->addDB ( $redirsDB, DB_REDIRS );
		}
}

if ( isset( $_POST['autoForm'] ) )
{
	if ( !empty( $_POST['sourceURL'] ) )
	{
		$auto = $this->openDB( DB_AUTO );
		
		$md5 = md5( $_POST['sourceURL'] );
		
		$auto[$md5] = array( 
							'source' => $_POST['sourceURL'],
							'category' => $_POST['sourceCategory'],
							'copyImages' => ( isset ( $_POST['copyImages'] ) ? true : false ),
							'firstCover' => ( isset ( $_POST['firstCover'] ) ? true : false ),
							'setsourceurl' => ( isset ( $_POST['setsourceurl'] ) ? true : false ),
							'striphtml' => ( isset ( $_POST['striphtml'] ) ? true : false ),
							'skipnoimages' => ( isset ( $_POST['skipnoimages'] ) ? true : false ),
							'user' =>  Sanitize::html( $_POST['user'] ),
							'sourceWords' =>  Sanitize::html( $_POST['sourceWords'] ),
							'status' => Sanitize::html( $_POST['status'] ),
							'autoDelete' => Sanitize::html( $_POST['autoDelete'] ),
							'maxPosts' => Sanitize::html( $_POST['maxPosts'] ),
							'oldPosts' => Sanitize::html( $_POST['oldPosts'] ),
							'disabled' => false,
							'list' => array()
							
		);
		
		$this->addDB ( $auto, DB_AUTO );
	}
	
	$this->db['enableAutoContentCache'] = ( isset( $_POST['enableCache'] ) ? true : false ) ;

}
		
if ( isset( $_POST['widgetAdd'] ) )
{
	$widgets = $this->openDB( DB_WIDGETS );
	
	$md5 = ( isset( $_POST['widgetKey'] ) ? $_POST['widgetKey'] : ( md5( isset( $_POST['widgetName'] ) ? $_POST['widgetName'] : ( 'widget-' . count( $widgets + 1 ) ) ) ) );
	
	$widgets[$md5] = array(
			'widgetName' => Sanitize::html( $_POST['widgetName'] ),
			'widgetType' => Sanitize::html( $_POST['widgetType'] ),
			'widgetCode' => ( $_POST['widgetCode'] ? Sanitize::html( $_POST['widgetCode'] ) : htmlentities( $_POST['widgetCode'] ) ),
			'widgetVisibility' => Sanitize::html( $_POST['widgetVisibility'] ),
			'widgetPre' => ( isset( $_POST['widgetPre'] ) ? Sanitize::html( $_POST['widgetPre'] ) : 'false' ),
			'widgetPreNum' => ( isset( $_POST['widgetPreNum'] ) ? (int) $_POST['widgetPreNum'] : 5 ),
			'widgetDropDown' => ( isset( $_POST['dropDown'] ) ? true : false ),
			'widgetShowNum' => ( isset( $_POST['showPostNum'] ) ? true : false ),
			'widgetVisibilityType' => Sanitize::html( $_POST['widgetVisibilityType'] ),
	);
	
	$this->addDB ( $widgets, DB_WIDGETS );
}

if ( isset( $_POST['menuAdd'] ) )
{
	$menu = $this->openDB( DB_MENU );
	
	$name = Sanitize::html( $_POST['menuName'] );
	
	$id = $this->URLify( $name );
	
	if ( isset( $menu[$id] ) )
	{
		$id = $id . '-' . generateMixed(3);
	}
	
	$menu[$id] = array(
			'menuName' => $name,
			'lang' => Sanitize::html( $_POST['menuLang'] ),
			'menu' => array()
	);
	
	$this->addDB ( $menu, DB_MENU );
}

if ( isset( $_POST['menuEdit'] ) )
{
	$menu = $this->openDB( DB_MENU );
	
	$id = $_POST['menuID'];
	
	if ( !isset( $menu[$id] ) )
	{
		return;
	}
	
	$menu[$id] = array(
			'menuName' => $menu[$id]['menuName'],
			'lang' => $menu[$id]['lang'],
			'menu' => json_decode( $_POST['hide'], true )
	);
	
	$this->addDB ( $menu, DB_MENU );
	
	return;
}

if ( isset( $_POST['widgetsSort'] ) )
{
	$list = explode( ',', $_POST['widgetsSort'] );
	
	if ( !empty( $list ) )
	{
		$widgets = $this->openDB( DB_WIDGETS );
		
		$array = array();
		
		foreach( $list as $id )
		{
			if ( isset( $widgets[$id] ) )
				$array[$id] = $widgets[$id];
		}
		
		if ( !empty( $array ) )
		{
			unset( $widgets );
		
			$widgets = $array;
			
		}
		
		$this->addDB ( $widgets, DB_WIDGETS );
	}
}

if ( isset( $_POST['AmpForm'] ) )
{
	$array = array(
			'adclient' => Sanitize::html( $_POST['adclient'] ),
			'adslot' => Sanitize::html( $_POST['adslot'] ),
			'googleanalytics' => Sanitize::html( $_POST['googleanalytics'] ),
			'headercode' => Sanitize::html( $_POST['headercode'] ),
			'enableautoads' => ( ( isset( $_POST['enableautoads'] ) && ( $_POST['enableautoads'] == 'true' ) ) ? true : false )
	);
	
	$this->db['amp-settings'] = $array;
}

if ( isset( $_POST['MainForm'] ) )
{
			$this->db['enable'] = ( ( $_POST['enable'] == 'true' ) ? true : false );

			$this->db['enable-langs'] = (( $_POST['enable-langs'] == 'true' ) ? true : false );

			$this->db['delete-data'] = ( ( isset( $_POST['delete-data'] ) && ( $_POST['delete-data'] == 'true' ) ) ? true : false );
			
			$this->db['hide-slug'] = ( ( isset( $_POST['hide-slug'] ) && ( $_POST['hide-slug'] == 'true' ) ) ? true : false );
			
			$this->db['enable-amp'] = ( ( isset( $_POST['enable-amp'] ) && ( $_POST['enable-amp'] == 'true' ) ) ? true : false );
			
			$this->db['enable-seo'] = ( ( isset( $_POST['enable-seo'] ) && ( $_POST['enable-seo'] == 'true' ) ) ? true : false );
			
			$this->db['enableantispam'] = ( ( isset( $_POST['enableantispam'] ) && ( $_POST['enableantispam'] == 'true' ) ) ? true : false );
			
			$this->db['enableAutoContent'] = ( ( isset( $_POST['enableAutoContent'] ) && ( $_POST['enableAutoContent'] == 'true' ) ) ? true : false );
			
			$this->db['cookieconsent'] = ( ( isset( $_POST['cookieconsent'] ) && ( $_POST['cookieconsent'] == 'true' ) ) ? true : false );
			
			if ( isset( $_POST['enableAutoContent'] ) && ( $_POST['enableAutoContent'] == 'true' ) )
			{
				if ( !file_exists( DB_AUTO ) )
					$this->createDB ( DB_AUTO );
				
				if ( $this->getValue( 'feedHash' ) == '' )
					$this->db['feedHash'] = generateMixed( 6 );
			}
			
			if ( isset( $_POST['enableWidgets'] ) && ( $_POST['enableWidgets'] == 'true' ) )
			{
				if ( !file_exists( DB_WIDGETS ) )
					$this->createDB ( DB_WIDGETS );
				
				$this->db['enableWidgets'] = ( ( isset( $_POST['enableWidgets'] ) && ( $_POST['enableWidgets'] == 'true' ) ) ? true : false );
			}
			
			$this->db['enable-sitemap'] = $_POST['enable-sitemap'];
			
			$this->db['enable-shop'] = $_POST['enable-shop'];
			
			$this->db['enable-forum'] = $_POST['enable-forum'];
			
			///$this->db['contactPageSlug'] = $_POST['contactPageSlug'];
			
			//$this->db['archivePageSlug'] = $_POST['archivePageSlug'];
						
			$this->db['enableMenu'] = $_POST['enableMenu'];
			
			if ( isset( $_POST['enableMenu'] ) && ( $_POST['enableMenu'] == 'manual' ) )
			{
				if ( !file_exists( DB_MENU ) )
					$this->createDB ( DB_MENU );
				
				/*$menu = array(
								'href' => $this->site_url(),
								'icon' => 'fas fa-home',
								'text' => 'Home',
								'target' => '_top',
								'title' => 'My Home'
							);
				
				//$this->db['menuData'] = $menu;
				$this->addDB ( $menu, DB_MENU );*/
			}
			
			if ( isset( $_POST['allow-users'] ) )
			{
				//If we enable this option for the first time, we need the db file
				if ( !file_exists( DB_MEMBERS ) )
					$this->createDB ( DB_MEMBERS );
				
				$this->db['allow-users'] = ( ( $_POST['allow-users'] == 'true' ) ? true : false );
			}
			
			if ( isset( $_POST['enable-redirs'] ) )
			{
				//If we enable this option for the first time, we need the db file
				if ( !file_exists( DB_REDIRS ) )
					$this->createDB ( DB_REDIRS );
				
				$this->db['enable-redirs'] = ( ( $_POST['enable-redirs'] == 'true' ) ? true : false );
			}
		}
		
       // if ( isset( $_POST['addBlog'] ) && !empty( $_POST['addBlog'] ) )
			//$this->addBlog ( $_POST['addBlog'] );

		if ( isset( $_POST['LangsForm'] ) )
        {
			if ( isset( $_POST['LangMain'] ) )
			{
				$default = $this->getValue( 'default-lang' );
				
				require_once ( $this->phpPath() . 'php' . DS . 'langs.php' );
			
				if ( 
					empty( $default ) 
					|| 
					( !empty( $default ) && isset( $_POST['defaultlang'] ) && ( $default['name'] !== $_POST['defaultlang'] ) ) 
				)
				{
					$key = $this->sanitize( $_POST['defaultlang'] );
					
					if ( isset( $langs[$key] ) )
					{
						$this->db['default-lang'] = $langs[$key];
						
						$this->db['default-lang']['changed'] = true;
					}
				}
				
				if ( isset( $_POST['addlang'] ) && !empty( $_POST['addlang'] ) )
					$this->addLanguage( $_POST['addlang'] );
				
				$array = array(
							'cookieconsentmessage' => Sanitize::html( $_POST['cookieconsentmessage'] ),
							'cookieconsenturl' => Sanitize::html( $_POST['cookieconsenturl'] ),
							'contactPageTitle' => sanitize( $_POST['contactPageTitle'] ),
							'archivePageTitle' => sanitize( $_POST['archivePageTitle'] ),
							'contactPageSlug' => $_POST['contactPageSlug'],
							'archivePageSlug' => $_POST['archivePageSlug'],
							'disqusCode' => $_POST['disqusCode'],
							'authorAbout' => Sanitize::html( $_POST['authorAbout'] ),
							'siteAbout' => Sanitize::html( $_POST['siteAbout'] ),
							'cookieConsentMessage' => ( isset( $_POST['cookieConsentMessage'] ) ? Sanitize::html( $_POST['cookieConsentMessage'] ) : '' ),
							'cookieConsentUrl' => ( isset( $_POST['cookieConsentUrl'] ) ? Sanitize::html( $_POST['cookieConsentUrl'] ) : '' ),
							'cookieConsentMoreText' => ( isset( $_POST['cookieConsentMoreText'] ) ? Sanitize::html( $_POST['cookieConsentMoreText'] ) : '' ),
							'cookieConsentButtonText' => ( isset( $_POST['cookieConsentButtonText'] ) ? Sanitize::html( $_POST['cookieConsentButtonText'] ) : '' ),
					);
					
				$this->db['default-lang-extra'] = $array;
			}
			
			if ( isset( $_POST['LangSub'] ) && !empty ( $_POST['langz'] ) )
				$this->saveLang( $_POST['langz'] );
		}
			
		if ( isset( $_POST['BlogsForm'] ) )
		{
				
			$this->saveblog( $_POST['blogz'] );
		}
		
		if ( isset( $_POST['BlogAdd'] ) )
		{
			$this->addBlog ( $_POST['addBlog'], $_POST['addBlogSef'] );
		}
		
		if ( isset( $_POST['topicPost'] ) && !empty( $_POST['topicPost'] ) )
		{
			$this->saveReply( $_POST );
		}
		
		if ( isset( $_POST['storeForm'] ) && isset( $_POST['shop'] ) && !empty( $_POST['shop'] ) )
        {
			$array = array();
			
			foreach( $_POST['shop'] as $key => $value )
			{
				if ( ( $value == 'true' ) || ( $value == 'false' ) )
					$array[$key] = ( ( $value == 'true' ) ? true : false );
				else
					$array[$key] = htmlentities( $value );
			}
			
			$this->db['store-settings'] = $array;
		}
		
		if ( isset( $_POST['forumForm'] ) && isset( $_POST['forum'] ) && !empty( $_POST['forum'] ) )
        {
			$array = array();
			
			foreach( $_POST['forum'] as $key => $value )
			{
				if ( ( $value == 'true' ) || ( $value == 'false' ) )
					$array[$key] = ( ( $value == 'true' ) ? true : false );
				else
					$array[$key] = htmlentities( $value );
			}
			
			$forumData = $this->getValue( 'forum-settings' );
				
			$array['last-id'] = ( ( isset( $forumData['last-id'] ) && !empty( $forumData['last-id'] ) ) ? $forumData['last-id'] : 0 );
			
			$this->db['forum-settings'] = $array;
		}