<?php defined('BLUDIT') or die('Bludit CMS.');

$html .= '<a href="' . THIS_HTML . '?blogs=true&sa=new"><span class="fa fa-plus"></span>' . $L->get( 'add-blog' ) . '</a>';

if ( !empty( $this->blogs ) )
    {
		if ( empty( $this->getValue( 'default-lang' ) ) && $this->getValue( 'enable-langs' ) )
			$html .= '<div class="alert alert-primary" role="alert">' . $L->get('no-primary-lang') . '</div>';
		
		$html .= '<input type="hidden" id="jsRedirect" name="DoRedirect" value="' . $fullURL . '">' . PHP_EOL;
		
		$html .= '<!-- NAV TABS -->
		<nav class="mb-3">
					<div class="nav nav-tabs" id="nav-tab" role="tablist">' . PHP_EOL;
		$i = 0;
		
		foreach ( $this->blogs as $key => $row ) 
		{
			$i++;
			
			$html .= '<a class="nav-item nav-link ' . ( ( $i == 1 ) ? 'active' : '' ) . '" data-toggle="tab" href="#' . $key . '">' . $row['name'] . '</a>' . PHP_EOL;
		}

		$html .= '</div>
				</nav>' . PHP_EOL;
		
		$i = 0;
		
		$html .= '<input type="hidden" id="jsBlogs" name="BlogsForm" value="true">' . PHP_EOL;
		
		$html .= '<div class="tab-content">';
		
		foreach ( $this->blogs as $key => $row )
		{
			$i++;
			
			$html .= '<!-- Blog-' . $key . ' tab -->' . PHP_EOL;
			
			$html .= '<div class="tab-pane ' . ( ( $i == 1 ) ? 'active' : '' ) . '" id="' . $key . '">' . PHP_EOL;
			
			$html .= '<h6 class="mt-4 mb-2 pb-2 border-bottom text-uppercase">' . stripslashes( $row['name'] ) . '</h6>' . PHP_EOL;
					
			$html .= '<!-- Start --><div class="form-group row"><label for="jsBlogName" class="col-sm-2 col-form-label">' . $L->get( 'blog-title' ) . '</label><div class="col-sm-10"><input class="form-control " id="jsBlogName" name="blogz[' . $key . '][name]" value="' . ( !empty($row['name']) ? $row['name'] : '' ) . '" placeholder="" type="text" /><small class="form-text text-muted">' . $L->get( 'blog-title-info' ) . '</small></div></div><!-- End -->' . PHP_EOL;
			
			$html .='<!-- Start --><div class="form-group row"><label for="jsBlogEnabled" class="col-sm-2 col-form-label">' . $L->get( 'blog-enabled' ) . '</label><div class="col-sm-10"><select name="blogz[' . $key . '][enabled]"><option value="everywhere" ' . ( $row['enabled'] === 'everywhere' ? 'selected' : '' ) . '>' . $L->get( 'blog-everywhere' ) . '</option>';
					
			$langs = $this->buildLangsArray();
					 
			if ( !empty(  $langs ) && $this->getValue( 'enable-langs' ) )
			{
				$defaultLang = $this->getValue( 'default-lang' );
				
				if ( !empty( $defaultLang ) )
					$html .= '<option value="' . $defaultLang['code'] . '"  ' . ( $row['enabled'] === $defaultLang['code'] ? 'selected' : '' ) . '>' . sprintf( $L->get( 'blog-language-enable' ), stripslashes( $defaultLang['lang'] ) ) . '</option>';
				
				foreach ( $langs as $code=>$lang )
				{
					$html .= '<option value="' . $code . '"  ' . ( $row['enabled'] === $code ? 'selected' : '' ) . '>' . sprintf( $L->get( 'blog-language-enable' ), stripslashes( $lang['lang'] ) ) . '</option>';
				}
						
			}
					
			$html .= '</select>' . PHP_EOL;
					
			$html .='<small class="form-text text-muted">' . $L->get( 'blog-enabled-info' ) . '</small></div></div><!-- End -->' . PHP_EOL;
						
			$html .= '<div class="form-group row">';
            $html .= '<label for="jsdisableBlog" class="col-sm-2 col-form-label">' . $L->get( 'blog-noindex' ) . '</label>';
			$html .= '<div class="col-sm-10">';
            $html .= '<select name="blogz[' . $key . '][noindex]">';
            $html .= '<option value="true" ' . ( $row['noindex'] === true ? 'selected' : '' ) . '>' . $L->get( 'Enabled' ) . '</option>';
            $html .= '<option value="false" ' . ( $row['noindex'] === false ? 'selected':'' ) . '> ' . $L->get( 'Disabled' ).'</option>';
            $html .= '</select>';
			$html .= '<small class="form-text text-muted">' . $L->get( 'blog-noindex-info' ) . '</small>';
            $html .= '</div></div>' . PHP_EOL;
						
			$html .='<!-- Start --><div class="form-group row"><label for="jsBlogTag" class="col-sm-2 col-form-label">' . $L->get( 'blog-tag' ) . '</label><div class="col-sm-10"><input class="form-control " id="jsBlogTag" name="blogz[' . $key . '][tag]" value="' . ( !empty( $row['tag'] ) ? $row['tag'] : '' ) . '" placeholder="" type="text" /><small class="form-text text-muted">' . $L->get( 'blog-tag-info' ) . '</small></div></div><!-- End -->' . PHP_EOL;
			
			$html .='<!-- Start --><div class="form-group row"><label for="jsBlogDescription" class="col-sm-2 col-form-label">' . $L->get( 'blog-description' ) . '</label><div class="col-sm-10"><input class="form-control " id="jsBlogDescription" name="blogz[' . $key . '][description]" value="' . ( !empty( $row['description'] ) ? $row['description'] : '' ) . '" placeholder="" type="text" /><small class="form-text text-muted">' . $L->get( 'blog-description-info' ) . '</small></div></div><!-- End -->' . PHP_EOL;
			
			$html .= '<div class="form-group row">';
            $html .= '<label for="jsdisableBlog" class="col-sm-2 col-form-label">' . $L->get( 'blog-disable' ) . '</label>';
			$html .= '<div class="col-sm-10">';
            $html .= '<select name="blogz[' . $key . '][disable]">';
            $html .= '<option value="true" ' . ( $row['disable'] === true ? 'selected' : '' ) . '>' . $L->get( 'Enabled' ) . '</option>';
            $html .= '<option value="false" ' . ( $row['disable'] === false ? 'selected':'' ) . '> ' . $L->get( 'Disabled' ).'</option>';
            $html .= '</select>';
			$html .= '<small class="form-text text-muted">' . $L->get( 'blog-disable-info' ) . '</small>';
            $html .= '</div></div>' . PHP_EOL;
			
			$html .= '<div class="form-group row">';
            $html .= '<label for="jsdeleteBlog" class="col-sm-2 col-form-label">' . $L->get( 'delete-blog' ) . '</label>';
			$html .= '<div class="col-sm-10">';
			$html .= '<input type="checkbox" name="blogz[' . $key . '][deleteBlog]" id="jsdeleteblog" value="true" onclick="if (this.checked) return confirm(\'' . $L->get('delete-blog-confirm') . '\');">';
			$html .= '<span class="tip">' . $L->get( 'delete-blog-info' ) . '</span>';
			$html .= '</div></div>' . PHP_EOL;
			
			$html .= '</div><!-- //Blog-' . $key . ' tab -->' . PHP_EOL;
			
		}

		$html .= '</div>'; //End Tab Content
	}
	
	else
		$html .= '<div class="alert alert-primary" role="alert">' . $L->get('no-blogs') . '</div>';