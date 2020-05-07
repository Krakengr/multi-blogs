<?php defined('BLUDIT') or die('Bludit CMS.');

	$seoSett = $this->getValue('seo-settings');
	
	$origin = array('strict-origin-when-cross-origin', 'no-referrer', 'no-referrer-when-downgrade', 'same-origin',
						'origin', 'strict-origin', 'origin-when-cross-origin', 'strict-origin-when-cross-origin',
						'unsafe-url');
						
	$html .= '<input type="hidden" id="jsSeo" name="seoForm" value="true">' . PHP_EOL;
	
	$html .= '<input type="hidden" id="jsRedirect" name="DoRedirect" value="' . $fullURL . '">' . PHP_EOL;
	
	$html .= '<h4 class="mt-4 mb-2 pb-2 border-bottom">' . $L->get('seo-settings') . '</h4>';
	
	$html .= '<h5 class="mt-4 mb-2 pb-2 border-bottom">' . $L->get('general-settings') . '</h5>';
	
	$html .= '<div>';
	$html .= '<label>' . $L->get('default-image') . '</label>';
	$html .= '<input id="jsdefaultImage" name="defaultImage" type="text" value="' . ( isset( $seoSett['defaultImage'] ) ? $seoSett['defaultImage'] : '' ) . '" placeholder="https://">';
	$html .= '</div>';
		
	$html .= '<div>';
	$html .= '<label>' . $L->get('seo-description') . '</label>';
	$html .= '<input id="jsdescription" name="site-description" type="text" value="' . ( isset( $seoSett['site-description'] ) ? $seoSett['site-description'] : '' ) . '" />';
	$html .= '</div>';
		
	$html .= '<div>';
	$html .= '<label>' . $L->get('fbpage') . '</label>';
	$html .= '<input id="jsfbpage" name="fbpage" type="text" value="' . ( isset( $seoSett['fbpage'] ) ? $seoSett['fbpage'] : '' ) . '" />';
	$html .= '</div>';
		
	$html .= '<div>';
	$html .= '<label>' . $L->get('referrer-policy') . '</label>';
	$html .= '<select name="referrer-policy">'.PHP_EOL;
	$html .= '<option value="none">'.$L->get('seo-none').'</option>'.PHP_EOL;
		
	foreach ($origin as $key)
		$html .= '<option value="'.$key.'" ' . ( ( isset( $seoSett['referrer-policy'] ) && ( $seoSett['referrer-policy'] == $key ) ) ? 'selected' : '' ) . '>'.$key.'</option>'.PHP_EOL;
			
	$html .= '</select>';
	$html .= '<span class="tip">'.$L->get('referrer').'</span>';
	$html .= '</div>';
	
	$html .= '<div>';
	$html .= '<label>' . $L->get('enable-no-follow') . '</label>';
	$html .= '<select name="enable-no-follow">'.PHP_EOL;
	$html .= '<option value="disable" ' . ( ( isset( $seoSett['enable-no-follow'] ) && ( $seoSett['enable-no-follow'] == 'disable' ) ) ? 'selected' : '' ) . '>' . $L->get( 'Disabled' ) . '</option>' . PHP_EOL;
		
	$html .= '<option value="pages" ' . ( ( isset( $seoSett['enable-no-follow'] ) && ( $seoSett['enable-no-follow'] == 'pages' ) ) ? 'selected' : '') . '>' . $L->get( 'nofollow-pages' ) . '</option>'.PHP_EOL;
	
	$html .= '<option value="categories" ' . ( ( isset( $seoSett['enable-no-follow'] ) && ( $seoSett['enable-no-follow'] == 'categories' ) ) ? 'selected' : '' ) . '>' . $L->get( 'nofollow-categories' ) . '</option>'.PHP_EOL;
	
	$html .= '<option value="tags" ' . ( ( isset( $seoSett['enable-no-follow'] ) && ( $seoSett['enable-no-follow'] == 'tags' ) ) ? 'selected' : '' ) . '>' . $L->get( 'nofollow-tags' ) . '</option>'.PHP_EOL;
	
	$html .= '<option value="everywhere" '.( ( isset( $seoSett['enable-no-follow'] ) && ( $seoSett['enable-no-follow'] == 'everywhere' ) ) ? 'selected':'') . '>' . $L->get( 'nofollow-everywhere' ) . '</option>'.PHP_EOL;
			
	$html .= '</select>';
	$html .= '<span class="tip">'.$L->get('no-follow-tip').'</span>';
	$html .= '</div>' . PHP_EOL;
	
	$html .= '<div>';
    $html .= '<label>' . $L->get( 'seo-alt' ) . '</label>';
	$html .= '<select name="addSeoAlt">';
	$html .= '<option value="false" ' . ( ( isset( $seoSett['addSeoAlt'] ) && ( $seoSett['addSeoAlt'] === false ) ) ? 'selected':'' ) . '> ' . $L->get( 'Disabled' ).'</option>';
	$html .= '<option value="true" ' . ( ( isset( $seoSett['addSeoAlt'] ) && ( $seoSett['addSeoAlt'] === true ) ) ? 'selected' : '' ) . '>' . $L->get( 'Enabled' ) . '</option>';
	$html .= '</select>';
	$html .= '<span class="tip">'.$L->get('seo-alt-tip').'</span>';
	$html .= '</div>' . PHP_EOL;
	
	$html .= '<div>';
    $html .= '<label>' . $L->get( 'lazy-load' ) . '</label>';
	$html .= '<select name="lazyLoad">';
	$html .= '<option value="false" ' . ( ( isset( $seoSett['lazyLoad'] ) && ( $seoSett['lazyLoad'] === false ) ) ? 'selected':'' ) . '> ' . $L->get( 'Disabled' ).'</option>';
	$html .= '<option value="true" ' . ( ( isset( $seoSett['lazyLoad'] ) && ( $seoSett['lazyLoad'] === true ) ) ? 'selected' : '' ) . '>' . $L->get( 'Enabled' ) . '</option>';
	$html .= '</select>';
	$html .= '<span class="tip">'.$L->get('lazy-load-tip').'</span>';
	$html .= '</div>' . PHP_EOL;
	
	$html .= '<div>';
    $html .= '<label>' . $L->get( 'nofollow-external-links' ) . '</label>';
	$html .= '<select name="noFollowExt">';
	$html .= '<option value="false" ' . ( ( isset( $seoSett['noFollowExt'] ) && ( $seoSett['noFollowExt'] === false ) ) ? 'selected':'' ) . '> ' . $L->get( 'Disabled' ).'</option>';
	$html .= '<option value="true" ' . ( ( isset( $seoSett['noFollowExt'] ) && ( $seoSett['noFollowExt'] === true ) ) ? 'selected' : '' ) . '>' . $L->get( 'Enabled' ) . '</option>';
	$html .= '</select>';
	$html .= '<span class="tip">'.$L->get('lazy-load-tip').'</span>';
	$html .= '</div>' . PHP_EOL;
	
	$html .= '<div>';
    $html .= '<label>' . $L->get( 'new-tab-external-links' ) . '</label>';
	$html .= '<select name="newTabExt">';
	$html .= '<option value="false" ' . ( ( isset( $seoSett['newTabExt'] ) && ( $seoSett['newTabExt'] === false ) ) ? 'selected':'' ) . '> ' . $L->get( 'Disabled' ).'</option>';
	$html .= '<option value="true" ' . ( ( isset( $seoSett['newTabExt'] ) && ( $seoSett['newTabExt'] === true ) ) ? 'selected' : '' ) . '>' . $L->get( 'Enabled' ) . '</option>';
	$html .= '</select>';
	$html .= '<span class="tip">'.$L->get('new-tab-external-tip').'</span>';
	$html .= '</div>' . PHP_EOL;
	
	#############################################################################
	$html .= '<h5 class="mt-4 mb-2 pb-2 border-bottom">' . $L->get('sitemap-settings') . '</h5>';
	
	$html .= '<div>';
    $html .= '<label>' . $L->get( 'sitemap-images' ) . '</label>';
	$html .= '<select name="sitemapImages">';
	$html .= '<option value="false" ' . ( ( isset( $seoSett['sitemapImages'] ) && ( $seoSett['sitemapImages'] === false ) ) ? 'selected':'' ) . '> ' . $L->get( 'Disabled' ).'</option>';
	$html .= '<option value="true" ' . ( ( isset( $seoSett['sitemapImages'] ) && ( $seoSett['sitemapImages'] === true ) ) ? 'selected' : '' ) . '>' . $L->get( 'Enabled' ) . '</option>';
	$html .= '</select>';
	$html .= '<span class="tip">'.$L->get('sitemap-images-tip').'</span>';
	$html .= '</div>' . PHP_EOL;
	
	$html .= '<div>';
    $html .= '<label>' . $L->get( 'sitemap-featured-image' ) . '</label>';
	$html .= '<select name="sitemapFeatured">';
	$html .= '<option value="false" ' . ( ( isset( $seoSett['sitemapFeatured'] ) && ( $seoSett['sitemapFeatured'] === false ) ) ? 'selected':'' ) . '> ' . $L->get( 'Disabled' ).'</option>';
	$html .= '<option value="true" ' . ( ( isset( $seoSett['sitemapFeatured'] ) && ( $seoSett['sitemapFeatured'] === true ) ) ? 'selected' : '' ) . '>' . $L->get( 'Enabled' ) . '</option>';
	$html .= '</select>';
	$html .= '<span class="tip">'.$L->get('sitemap-featured-tip').'</span>';
	$html .= '</div>' . PHP_EOL;
	
	$html .= '<div>';
    $html .= '<label>' . $L->get( 'sitemap-ping' ) . '</label>';
	$html .= '<select name="sitemapPing">';
	$html .= '<option value="false" ' . ( ( isset( $seoSett['sitemapPing'] ) && ( $seoSett['sitemapPing'] === false ) ) ? 'selected':'' ) . '> ' . $L->get( 'Disabled' ).'</option>';
	$html .= '<option value="true" ' . ( ( isset( $seoSett['sitemapPing'] ) && ( $seoSett['sitemapPing'] === true ) ) ? 'selected' : '' ) . '>' . $L->get( 'Enabled' ) . '</option>';
	$html .= '</select>';
	$html .= '<span class="tip">'.$L->get('sitemap-ping-tip').'</span>';
	$html .= '</div>' . PHP_EOL;
	
	#############################################################################
	$html .= '<h5 class="mt-4 mb-2 pb-2 border-bottom">' . $L->get('webverification') . '</h5>';
	$html .= '<p><em>' . $L->get('webexplain') . '</em></p>';
		
	$html .= '<div>';
	$html .= '<label>' . $L->get('google_title') . '</label>';
	$html .= '<input id="jsgoogle" name="google" type="text" placeholder="dB222vburAxi537Rp9qi5uG2174Vb6JwHwIRwPSLIK8" value="' . ( isset( $seoSett['google'] ) ? $seoSett['google'] : '' ) . '" />';
	$html .= '<span class="tip">'.$L->get('google').'</span>';
	$html .= '</div>';
		
	$html .= '<div>';
	$html .= '<label>' . $L->get('bing_title') . '</label>';
	$html .= '<input id="jsbing" name="bing" type="text" placeholder="12C1203B508334455E94EB3A3D9830B2E" value="' . ( isset( $seoSett['bing'] ) ? $seoSett['bing'] : '' ) . '" />';
	$html .= '<span class="tip">' . $L->get('bing') . '</span>';
	$html .= '</div>';
		
	$html .= '<div>';
	$html .= '<label>' . $L->get('yandex_title') . '</label>';
	$html .= '<input id="jsdyandex" name="yandex" type="text" placeholder="44d68e13344409f40" value="' . ( isset( $seoSett['yandex'] ) ? $seoSett['yandex'] : '' ) . '" />';
	$html .= '<span class="tip">'.$L->get('yandex').'</span>';
	$html .= '</div>';
	
	