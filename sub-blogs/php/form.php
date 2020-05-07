<?php defined('BLUDIT') or die('Bludit CMS.');

	$html .= '<h3>' . $L->get('main-settings') . '</h3>';
	
	$html .= '<input type="hidden" id="jsMainForm" name="MainForm" value="true">' . PHP_EOL;
	
	// Check if the option is enabled
        if ( !$this->getValue( 'enable' ) ) 
        {
            $html .= '<div>';
            $html .= '<label>'.$L->get('enable-sublogs-mode').'</label>';
            $html .= '<select name="enable">';
            $html .= '<option value="true" ' . ( $this->getValue( 'enable' ) === true ? 'selected' : '' ) . '>' . $L->get( 'Enabled' ) . '</option>';
            $html .= '<option value="false" ' . ( $this->getValue( 'enable' ) === false ? 'selected':'' ) . '> ' . $L->get( 'Disabled' ).'</option>';
            $html .= '</select>';
			$html .= '<span class="tip">'.$L->get('enable-sublogs-mode-info').'</span>';
            $html .= '</div>';
        
        }
        else    
        {
            $html .= '<div>';
            $html .= '<label>'.$L->get('enable-sublogs-mode').'</label>';
            $html .= '<select name="enable">';
            $html .= '<option value="true" ' . ( $this->getValue( 'enable' ) === true ? 'selected' : '' ) . '>' . $L->get( 'Enabled' ) . '</option>';
            $html .= '<option value="false" ' . ( $this->getValue( 'enable' ) === false ? 'selected':'' ) . '> ' . $L->get( 'Disabled' ).'</option>';
            $html .= '</select>';
			$html .= '<span class="tip">'.$L->get('enable-sublogs-mode-info').'</span>';
            $html .= '</div>' . PHP_EOL;
			
		}

            $html .= '<div>';
            $html .= '<label>'.$L->get('enable-langs-mode').'</label>';
            $html .= '<select name="enable-langs">';
            $html .= '<option value="true" ' . ( $this->getValue( 'enable-langs' ) === true ? 'selected' : '' ) . '>' . $L->get( 'Enabled' ) . '</option>';
            $html .= '<option value="false" ' . ( $this->getValue( 'enable-langs' ) === false ? 'selected':'' ) . '> ' . $L->get( 'Disabled' ).'</option>';
            $html .= '</select>';
            $html .= '</div>' . PHP_EOL;

            $html .= '<div>';
            $html .= '<label>' . $L->get( 'delete-sublogs-data' ) . '</label>';
            $html .= '<select name="delete-data" disabled>';
            $html .= '<option value="true" ' . ( $this->getValue( 'delete-data' ) === true ? 'selected' : '' ) . '>' . $L->get( 'Enabled' ) . '</option>';
            $html .= '<option value="false" ' . ( $this->getValue( 'delete-data' ) === false ? 'selected':'' ) . '> ' . $L->get( 'Disabled' ).'</option>';
            $html .= '</select>';
            $html .= '<span class="tip">'.$L->get('delete-sublogs-info').'</span>';
            $html .= '</div>' . PHP_EOL;
			
			$html .= '<div>';
            $html .= '<label>' . $L->get( 'hide-slug' ) . '</label>';
            $html .= '<select name="hide-slug">';
            $html .= '<option value="true" ' . ( $this->getValue( 'hide-slug' ) === true ? 'selected' : '' ) . '>' . $L->get( 'Enabled' ) . '</option>';
            $html .= '<option value="false" ' . ( $this->getValue( 'hide-slug' ) === false ? 'selected':'' ) . '> ' . $L->get( 'Disabled' ).'</option>';
            $html .= '</select>';
            $html .= '<span class="tip">'.$L->get('hide-slug-info').'</span>';
            $html .= '</div>' . PHP_EOL;
			
			$html .= '<div>';
            $html .= '<label>' . $L->get( 'enable-sitemap' ) . '</label>';
            $html .= '<select name="enable-sitemap">';
            $html .= '<option value="disable" ' . ( $this->getValue( 'enable-sitemap' ) === 'disable' ? 'selected' : '' ) . '>' . $L->get( 'Disabled' ) . '</option>';
            $html .= '<option value="enable-nogroup" ' . ( $this->getValue( 'enable-sitemap' ) === 'enable-nogroup' ? 'selected':'' ) . ' disabled> ' . $L->get( 'enable-nogroup' ).'</option>';
			$html .= '<option value="enable-group" ' . ( $this->getValue( 'enable-sitemap' ) === 'enable-group' ? 'selected':'' ) . '> ' . $L->get( 'enable-group' ).'</option>';
            $html .= '</select>';
            $html .= '<span class="tip">'.$L->get('enable-sitemap-info').'</span>';
            $html .= '</div>' . PHP_EOL;
			
			$html .= '<div>';
            $html .= '<label>' . $L->get( 'enable-seo' ) . '</label>';
            $html .= '<select name="enable-seo">';
			 $html .= '<option value="false" ' . ( $this->getValue( 'enable-seo' ) === false ? 'selected':'' ) . '> ' . $L->get( 'Disabled' ).'</option>';
            $html .= '<option value="true" ' . ( $this->getValue( 'enable-seo' ) === true ? 'selected' : '' ) . '>' . $L->get( 'Enabled' ) . '</option>';
            $html .= '</select>';
            $html .= '<span class="tip">'.$L->get('enable-seo-info').'</span>';
            $html .= '</div>' . PHP_EOL;
			
			$html .= '<div>';
            $html .= '<label>' . $L->get( 'enable-amp' ) . '</label>';
            $html .= '<select name="enable-amp">';
            $html .= '<option value="false" ' . ( $this->getValue( 'enable-amp' ) === false ? 'selected':'' ) . '> ' . $L->get( 'Disabled' ).'</option>';
			$html .= '<option value="true" ' . ( $this->getValue( 'enable-amp' ) === true ? 'selected' : '' ) . '>' . $L->get( 'Enabled' ) . '</option>';
            $html .= '</select>';
            $html .= '<span class="tip">'.$L->get('enable-amp-info').'</span>';
            $html .= '</div>' . PHP_EOL;
			
			$html .= '<div>';
            $html .= '<label>' . $L->get( 'allow-users' ) . '</label>';
            $html .= '<select name="allow-users" disabled>';
			$html .= '<option value="false" ' . ( $this->getValue( 'allow-users' ) === false ? 'selected':'' ) . '> ' . $L->get( 'Disabled' ).'</option>';
            $html .= '<option value="true" ' . ( $this->getValue( 'allow-users' ) === true ? 'selected' : '' ) . '>' . $L->get( 'Enabled' ) . '</option>';
            $html .= '</select>';
            $html .= '<span class="tip">'.$L->get('allow-users-tip').'</span>';
            $html .= '</div>' . PHP_EOL;
			
			$html .= '<div>';
            $html .= '<label>' . $L->get( 'enable-redirs' ) . '</label>';
            $html .= '<select name="enable-redirs">';
			$html .= '<option value="false" ' . ( $this->getValue( 'enable-redirs' ) === false ? 'selected':'' ) . '> ' . $L->get( 'Disabled' ).'</option>';
            $html .= '<option value="true" ' . ( $this->getValue( 'enable-redirs' ) === true ? 'selected' : '' ) . '>' . $L->get( 'Enabled' ) . '</option>';
            $html .= '</select>';
            $html .= '<span class="tip">'.$L->get('enable-redirs-tip').'</span>';
            $html .= '</div>' . PHP_EOL;
			
			###################################################################################
			$html .= '<div>';
            $html .= '<label>' . $L->get( 'enable-anti-spam' ) . '</label>';
            $html .= '<select name="enableantispam">';
            $html .= '<option value="false" ' . ( $this->getValue( 'enableantispam' ) === false ? 'selected':'' ) . '> ' . $L->get( 'Disabled' ).'</option>';
			$html .= '<option value="true" ' . ( $this->getValue( 'enableantispam' ) === true ? 'selected' : '' ) . '>' . $L->get( 'Enabled' ) . '</option>';
            $html .= '</select>';
            $html .= '<span class="tip">'.$L->get('enable-spam-info').'</span>';
            $html .= '</div>' . PHP_EOL;
			
			###################################################################################
			$html .= '<div>';
            $html .= '<label>' . $L->get( 'blog-store' ) . '</label>';
            $html .= '<select name="enable-shop" disabled>';
            $html .= '<option value="disable" ' . ( $this->getValue( 'enable-shop' ) === 'disable' ? 'selected' : '' ) . '>' . $L->get( 'Disabled' ) . '</option>';
			$html .= '<option value="default" ' . ( $this->getValue( 'enable-shop' ) === 'default' ? 'selected' : '' ) . '>' . $L->get( 'use-store-default' ) . '</option>';
			
			$forumBlog = $this->getValue( 'enable-forum' );
			
			foreach ( $this->blogs as $key => $row ) 
			{
				//We can't use the forum blog as a store
				if ( ( $forumBlog !== 'disable' ) && ( $forumBlog == $key ) )
					continue;
				
				$html .= '<option value="' . $key . '" ' . ( $this->getValue( 'enable-shop' ) === $key ? 'selected':'' ) . '> ' . sprintf( $L->get( 'blog-store-enable' ), stripslashes( $row['name'] ) ) . ( ( $row['disable'] ) ? ' [' . $L->get('blog-disabled') . ']' : '' ) .'</option>';
				
			}
            $html .= '</select>';
            $html .= '<span class="tip">'.$L->get('blog-store-info').'</span>';
            $html .= '</div>' . PHP_EOL;
			
			###################################################################################
			//Add Forum Selection
			$html .= '<div>';
            $html .= '<label>' . $L->get( 'blog-forum' ) . '</label>';
            $html .= '<select name="enable-forum" disabled>';
            $html .= '<option value="disable" ' . ( $this->getValue( 'enable-forum' ) === 'disable' ? 'selected' : '' ) . '>' . $L->get( 'Disabled' ) . '</option>';
			$html .= '<option value="default" ' . ( $this->getValue( 'enable-forum' ) === 'default' ? 'selected' : '' ) . '>' . $L->get( 'use-forum-default' ) . '</option>';
			
			$storeBlog = $this->getValue( 'enable-shop' );

			foreach ( $this->blogs as $key => $row ) 
			{
				//We can't use the store blog as a forum
				if ( ( $storeBlog !== 'disable' ) && ( $storeBlog == $key ) )
					continue;
				
				$html .= '<option value="' . $key . '" ' . ( $this->getValue( 'enable-forum' ) === $key ? 'selected':'' ) . '> ' . sprintf( $L->get( 'blog-forum-enable' ), stripslashes( $row['name'] ) ) . ( ( $row['disable'] ) ? ' [' . $L->get('blog-disabled') . ']' : '' ) .'</option>';
				
			}
            $html .= '</select>';
            $html .= '<span class="tip">'.$L->get('blog-forum-info').'</span>';
            $html .= '</div>' . PHP_EOL;
			
			###################################################################################
			//Add Auto Content Selection
			$html .= '<div>';
            $html .= '<label>' . $L->get( 'enable-auto-content' ) . '</label>';
            $html .= '<select name="enableAutoContent">';
            $html .= '<option value="false" ' . ( $this->getValue( 'enableAutoContent' ) === false ? 'selected':'' ) . '> ' . $L->get( 'Disabled' ).'</option>';
			$html .= '<option value="true" ' . ( $this->getValue( 'enableAutoContent' ) === true ? 'selected' : '' ) . '>' . $L->get( 'Enabled' ) . '</option>';
            $html .= '</select>';
            $html .= '<span class="tip">'.$L->get('enable-auto-content-info').'</span>';
            $html .= '</div>' . PHP_EOL;
			
			###################################################################################
			//Add Menu Selection
			$html .= '<div>';
            $html .= '<label>' . $L->get( 'enable-menu-creation' ) . '</label>';
            $html .= '<select name="enableMenu">';
            $html .= '<option value="disable" ' . ( $this->getValue( 'enableMenu' ) === 'disable' ? 'selected' : '' ) . '> ' . $L->get( 'Disabled' ).'</option>';
			$html .= '<option value="auto" ' . ( $this->getValue( 'enableMenu' ) === 'auto' ? 'selected' : '' ) . '>' . $L->get( 'auto-menu-creation' ) . '</option>';
			$html .= '<option value="manual" ' . ( $this->getValue( 'enableMenu' ) === 'manual' ? 'selected' : '' ) . '>' . $L->get( 'manual-menu-creation' ) . '</option>';
            $html .= '</select>';
            $html .= '<span class="tip">'.$L->get('enable-menu-tip').'</span>';
            $html .= '</div>' . PHP_EOL;
			
			###################################################################################
			//Add Widgets Selection
			$html .= '<div>';
            $html .= '<label>' . $L->get( 'enable-widgets-creation' ) . '</label>';
            $html .= '<select name="enableWidgets">';
            $html .= '<option value="false" ' . ( $this->getValue( 'enableWidgets' ) === false ? 'selected' : '' ) . '> ' . $L->get( 'Disabled' ).'</option>';
			$html .= '<option value="true" ' . ( $this->getValue( 'enableWidgets' ) === true ? 'selected' : '' ) . '>' . $L->get( 'Enabled' ) . '</option>';
            $html .= '</select>';
            $html .= '<span class="tip">'.$L->get('enable-widgets-tip').'</span>';
            $html .= '</div>' . PHP_EOL;
			
			###################################################################################
			//Add cookie consent
			$html .= '<div>';
			$html .= '<label>' . $L->get( 'enable-cookie-consent' ) . '</label>';
			$html .= '<select name="cookieconsent">';
			$html .= '<option value="false" ' . ( $this->getValue( 'cookieconsent' ) === false ? 'selected':'' ) . '> ' . $L->get( 'Disabled' ).'</option>';
			$html .= '<option value="true" ' . ( $this->getValue( 'cookieconsent' ) === true ? 'selected' : '' ) . '>' . $L->get( 'Enabled' ) . '</option>';
			$html .= '</select>';
			$html .= '<span class="tip">'.$L->get('enable-cookie-consent-info').'</span>';
			$html .= '</div>' . PHP_EOL;
			
			###################################################################################
			$html .= '<br />' . PHP_EOL;