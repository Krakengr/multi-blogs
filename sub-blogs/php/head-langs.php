<?php defined('BLUDIT') or die('Bludit CMS.');
$lang = ( ( !empty( $uri ) && !empty( $uri['lang'] ) ) ? $uri['lang'] : '' );
			
			$blog = ( ( !empty( $uri ) && !empty( $uri['blog'] ) ) ? $uri['blog'] : '' );
			
			$langList = $this->getLangsList( $lang, $blog );

			if ( !empty( $langList ) )
			{

				if ( $uri['whereAmI'] == 'page' )
				{
					$url = $this->buildUrlByKey( $uri['pageSlug'] );
					
					if ( !empty( $lang ) )
					{
						$searchTrans = $this->searchuuid( $uri['pageSlug'], false );
						$otherURL = ( !empty( $searchTrans ) ? $this->buildUrlByKey( $searchTrans['parent'] ) : '' );
					}
					else
					{
						$searchTrans = $this->searchuuid( $uri['pageSlug'], true );
						$otherURL = ( !empty( $searchTrans ) ? $this->buildUrlByKey( $searchTrans['key'] ) : '' );
					}
					
					//We have a post with translations. So we have to add the hreflang for all the languages
					if ( !empty( $searchTrans ) )
					{
						foreach ( $langList as $id=>$la )
						{
							if ( !empty( $la['current'] ) ) 
							{
								$html .= '<link href="' . $url . '" hreflang="' . $id . '" rel="alternate" />' . PHP_EOL;
								
								//break;
								
							}
							
							else
								$html .= '<link href="' . $otherURL . '" hreflang="' . $id . '" rel="alternate" />' . PHP_EOL;
						}
					}
					
					//We don't have a post with translations. So we have to add only one hreflang
					else
					{
						//$url = $this->buildUrlByKey( $uri['pageSlug'] );
						
						foreach ( $langList as $id=>$la )
						{
							if ( !empty( $la['current'] ) ) 
							{
								$html .= '<link href="' . $url . '" hreflang="' . $id . '" rel="alternate" />' . PHP_EOL;
								
								break;
								
							}
							
							else
								continue;
						}
						
					}
				}
				
				elseif ( $uri['whereAmI'] == 'home' )
				{
						
					foreach ( $langList as $id=>$la )
					{
						if ( empty( $blog ) )
						{
							$html .= '<link href="' . $la['url'] . '" hreflang="' . $id . '" rel="alternate" />' . PHP_EOL;	
						}
						else
						{
							if ( !empty( $la['current'] ) ) 
							{
								$url = 'https://' . $_SERVER["SERVER_NAME"] . $_SERVER['REQUEST_URI'];
								
								$html .= '<link href="' . $url . '" hreflang="' . $id . '" rel="alternate" />' . PHP_EOL;	
								
								break;
							}
							
							else
								continue;
						}
							/*if ( !empty( $lang ) )
							{
								$url = $this->site_url();
								
								$url .= ( !empty ( $lang && ( $id !== $mainLang['code'] ) ) ? $lang . '/' : ( empty( $lang ) ? $id : '' ) );
								
								$url .= ( !empty ( $uri['blog'] ) ? $uri['blog'] . '/' : '' );
								
							} 
							else
								$url = $la['url'];
							*/
							
							//if ( !empty ( $uri['blog'] ) )
								//$url = $this->site_url();
							//$url = ( !empty( $la['current'] ) ? $this->buildURL( '', $lang, $uri['blog'] ) : $la['url'] );
							
						
					}

				}
			
			}