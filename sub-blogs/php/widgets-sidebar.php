<?php defined('BLUDIT') or die('Bludit CMS.');

$blogs = $this->openDB( DB_BLOGS );
	
foreach ( $widgets as $id => $w )
{
	$html .= '<div id="' . $id  . '" class="widget widget_' . $w['widgetType'] . '">';
				
	if ( !empty( $w['widgetName'] ) )
		$html .= '<h4 class="widget-title">' . $w['widgetName'] . '</h4>';
				
	$html .= '<div class="textwidget">';//Change that later
				
	if ( ( $w['widgetType'] == 'premade' ) && ( $w['widgetType'] !== 'false' ) )
	{
		if ( $w['widgetPre'] == 'langSelector' )
			$html .= $this->langSelector();
					
		elseif ( $w['widgetPre'] == 'aboutSite' )
			$html .= siteAbout();
			
		elseif ( $w['widgetPre'] == 'categoriesList' )
		{
			$html .= ( $w['widgetDropDown'] ? '<select onChange="window.location.href=this.value">' : '<ul>' );
			
			foreach( $categories->db as $key => $fields )
			{
				$blog = $this->searchCategory ( $key, false, true );
					
				if ( !empty( $blog ) && !empty( $blog['blog'] ) && ( ( ( $blog['blog'] == $this->getValue( 'enable-forum' ) ) || ( $blog['blog'] == $this->getValue( 'enable-shop' ) ) ) || ( !empty( $blogs[$blog['blog']]['disable'] ) ) ) )
					continue;
				
				$count = count( $fields['list'] );
				
				if ( $count > 0 )
				{
					$url = $this->getCagegoryURL( $key );
					
					$html .= ( $w['widgetDropDown'] ? '<option value="' . $url . '"' . ( ( !empty( $uri ) && !empty( $uri['categorySlug'] ) && ( $uri['categorySlug'] == $key ) ) ? ' selected' : '' ) . '>' : '<li>' );

					$html .= '<a href="' . $url . '">' . $fields['name'] . ( $w['widgetShowNum'] ? ' (' . $count . ')' : '' ) . '</a>';
					
					$html .= ( $w['widgetDropDown'] ? '</option>' : '</li>' );
				}
				
			}
			
			$html .= ( $w['widgetDropDown'] ? '</select>' : '</ul>' );
		}

		elseif ( $w['widgetPre'] == 'latestPosts' )
		{
			if( currentLang() )
				$list = $this->getList( currentLang(), false, false, $w['widgetPreNum'] );
			else
				$list = $pages->getList( 1, $w['widgetPreNum'], true, false, true, false, false );

			$html .= '<ul>';
						
			foreach( $list as $p )
			{
				try 
				{
					$page = new Page( $p );
								
					$html .= '<li><a href="' . $this->buildUrlByKey( $p ) . '">' . $page->title() . '</a></li>';
			
				} catch (Exception $e) 
				{

				}							
			}

			$html .= '</ul>';
		}
	}
				
	elseif ( ( $w['widgetType'] == 'simple' ) )
		$html .= $w['widgetCode'];
				
	elseif ( ( $w['widgetType'] == 'html' ) )
		$html .= html_entity_decode( $w['widgetCode'] );
					
	elseif ( ( $w['widgetType'] == 'php' ) )
	{
		$code = html_entity_decode( $w['widgetCode'] );
					
		$html .= ( eval("?> $code <?php ") );

	}

	$html .= '</div></div>';

}