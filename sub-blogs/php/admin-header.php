<?php defined('BLUDIT') or die('Bludit CMS.');

//if ( strpos( $url->slug(), 'edit-category/' ) !== false )
if ( strpos( $_SERVER['REQUEST_URI'], 'edit-category/' ) !== false )
    {
		//$shtml .= '<input type="hidden" id="jsRedirect" name="DoRedirect" value="' . $fullURL . '">';
        $shtml .= '<div class="form-group">';
        // $shtml .= '<label>Blog</label><br />';
        $shtml .= '<select name="blog">';

        $shtml .= '<option value="">' . $L->get( 'select-blog' ) . '</option>';
                        
            foreach ( $this->blogs as $key=>$row ) 
            {             
                $search = $this->searchCategory ( $page, false, true );

                $shtml .= '<option value="' . $key . '" ' . ( ( !empty( $search ) && ( $search['blog'] == $key ) ) ? 'selected' : '' ) . '>' . stripslashes( $row['name'] ) . '</option>';
            }
            
            $shtml .= '</select></div>';

            if ( $this->getValue( 'enable-langs' ) )
            {
                $langs = $this->buildLangsArray();

                if ( !empty( $langs ) )
                {
                   
                    $shtml .= '<div class="form-group">';

                    $shtml .= '<select name="lang">';

                    $shtml .= '<option value="">' . $L->get( 'select-lang' ) . '</option>';
                                
                    foreach ( $langs as $code=>$lang )
                    {
                        $search = $this->searchCategory ( $page, $code, '' );

                        $shtml .= '<option value="' . $code . '"  ' . ( !empty( $search ) ? 'selected' : '' ) . '>' . stripslashes( $lang['lang'] ) . '</option>';
                    }
                    
                    $shtml .= '</select></div>';
                }
            }
                                
            $html .=<<<EOT
<script>
        $("#jstokenCSRF").before(
            '$shtml'
        );
</script>
EOT;

        }
		
		//Settings
		/*
		if ( $page == 'settings' )
        {
			$phtml = "";
			
			if ( $this->getValue( 'enable-shop' ) !== 'disable' )
            {
				$shtml .= '<a class="nav-item nav-link" id="nav-general-tab" data-toggle="tab" href="#store" role="tab" aria-controls="nav-general" aria-selected="false">' . $L->get( 'store-settings' ) . '</a>';
			}
			
			if ( !empty( $this->blogs ) )
			{
				$shtml .= '<a class="nav-item nav-link" id="nav-general-tab" data-toggle="tab" href="#blogs" role="tab" aria-controls="nav-general" aria-selected="false">' . $L->get( 'blogs-sidebar-menu' ) . '</a>';	
				
				$thtml = "<!-- Blog Settings --><div class=\"tab-pane fade\" id=\"blogs\" role=\"tabpanel\" aria-labelledby=\"blogs-tab\">";
				
				foreach ( $this->blogs as $key => $row ) 
				{
					$thtml .= "<h6 class=\"mt-4 mb-2 pb-2 border-bottom text-uppercase\">" . stripslashes( $row['name'] ) . "</h6>";
					
					$thtml .= "<!-- Start --><div class=\"form-group row\"><label for=\"jsBlogName\" class=\"col-sm-2 col-form-label\">" . $L->get( 'blog-title' ) . "</label><div class=\"col-sm-10\"><input class=\"form-control \" id=\"jsBlogName\" name=\"blogz[$key][name]\" value=\"" . ( !empty($row['name']) ? $row['name'] : '' ) . "\" placeholder=\"\" type=\"text\"><small class=\"form-text text-muted\">" . $L->get( 'blog-title-info' ) . "</small></div></div><!-- End --><!-- Start --><div class=\"form-group row\"><label for=\"jsBlogEnabled\" class=\"col-sm-2 col-form-label\">" . $L->get( 'blog-enabled' ) . "</label><div class=\"col-sm-10\"><select name=\"blogz[$key][enabled]\"><option value=\"everywhere\" " . ( $row['enabled'] === 'everywhere' ? 'selected' : '' ) . ">" . $L->get( 'blog-everywhere' ) . "</option>";
					
					$langs = $this->buildLangsArray();
					 
					if ( !empty(  $langs ) )
					{
						foreach ( $langs as $code=>$lang )
						{
							$thtml .= '<option value="' . $code . '"  ' . ( $row['enabled'] === $code ? 'selected' : '' ) . '>' . sprintf( $L->get( 'blog-language-enable' ), stripslashes( $lang['lang'] ) ) . '</option>';
						}
						
					}
					
					$thtml .= '</select>';
					
					$thtml .="<small class=\"form-text text-muted\">" . $L->get( 'blog-enabled-info' ) . "</small></div></div><!-- End --><!-- Start --><div class=\"form-group row\"><label for=\"jsdisableBlog\" class=\"col-sm-2 col-form-label\">" . $L->get( 'blog-disable' ) . "</label><div class=\"col-sm-10\"><input type=\"checkbox\" name=\"blogz[$key][disable]\" id=\"jsdisableBlog\" value=\"true\" " . ( !empty( $row['disable'] ) ? 'checked' : '' ) . "><small class=\"form-text text-muted\">" . $L->get( 'blog-disable-info' ) . "</small></div></div><!-- End --><!-- Start --><div class=\"form-group row\"><label for=\"jsBlogTag\" class=\"col-sm-2 col-form-label\">" . $L->get( 'blog-tag' ) . "</label><div class=\"col-sm-10\"><input class=\"form-control \" id=\"jsBlogTag\" name=\"blogz[$key][tag]\" value=\"" . ( !empty( $row['tag'] ) ? $row['tag'] : '' ) . "\" placeholder=\"\" type=\"text\"><small class=\"form-text text-muted\">" . $L->get( 'blog-tag-info' ) . "</small></div></div><!-- End --><!-- Start --><div class=\"form-group row\"><label for=\"jsBlogDescription\" class=\"col-sm-2 col-form-label\">" . $L->get( 'blog-description' ) . "</label><div class=\"col-sm-10\"><input class=\"form-control \" id=\"jsBlogDescription\" name=\"blogz[$key][description]\" value=\"" . ( !empty( $row['description'] ) ? $row['description'] : '' ) . "\" placeholder=\"\" type=\"text\"><small class=\"form-text text-muted\">" . $L->get( 'blog-description-info' ) . "</small></div></div><!-- End -->";
						
				}
				
				$thtml .= "<\/div><!-- //Blog Settings -->";

				$phtml .= "$(\"nav[class*='mb-3'] \").after(" . PHP_EOL;
				$phtml .= "'$thtml'" . PHP_EOL;
				$phtml .= ");" . PHP_EOL;						

			}
			
			$html.=<<<EOT
<script>$(document).ready(function(){    
    $phtml
});</script>
EOT;
			/*
			
			if ( $this->getValue( 'enable-langs' ) )
            {
				$phtml = '';
                $langs = $this->openDB( DB_LANGS );

                if ( !empty( $langs ) )
                {
					foreach ( $langs as $lan => $val ) 
					{
						
						$shtml .= '<a class="nav-item nav-link" id="nav-general-tab" data-toggle="tab" href="#Lan-' . $lan . '" role="tab" aria-controls="nav-general" aria-selected="false">' . $val['name'] . '</a>';	

						$thtml = "<!-- Lan-$lan Settings --><div class=\"tab-pane fade\" id=\"Lan-$lan\" role=\"tabpanel\" aria-labelledby=\"Lan-$lan-tab\"><div class=\"form-group row\"><label for=\"jssiteName\" class=\"col-sm-2 col-form-label\">" . $L->get( 'site-title' ) . "</label><div class=\"col-sm-10\"><input class=\"form-control \" id=\"jssiteName\" name=\"langz[$lan][siteName]\" value=\"" . ( !empty($val['siteName']) ? $val['siteName'] : '' ) . "\" placeholder=\"\" type=\"text\"><small class=\"form-text text-muted\">" . $L->get( 'site-title-info' ) . "</small></div></div><!--//Setting--><!--Setting--><div class=\"form-group row\"><label for=\"jssiteDescription\" class=\"col-sm-2 col-form-label\">" . $L->get( 'site-description' ) . "</label><div class=\"col-sm-10\"><input class=\"form-control \" id=\"jssiteDescription\" name=\"langz[$lan][siteDescription]\" value=\"" . ( !empty($val['siteDescription']) ? $val['siteDescription'] : '' ) . "\" placeholder=\"\" type=\"text\"><small class=\"form-text text-muted\">" . $L->get( 'site-description-info' ) . "</small></div></div><!--//Setting--><!--Setting--><div class=\"form-group row\"><label for=\"jssiteSlogan\" class=\"col-sm-2 col-form-label\">" . $L->get( 'site-slogan' ) . "</label><div class=\"col-sm-10\"><input class=\"form-control \" id=\"jssiteSlogan\" name=\"langz[$lan][siteSlogan]\" value=\"" . ( !empty($val['siteSlogan']) ? $val['siteSlogan'] : '' ) . "\" placeholder=\"\" type=\"text\"><small class=\"form-text text-muted\">" . $L->get( 'site-slogan-info' ) . "</small></div></div><!--//Setting--><!--Setting--><div class=\"form-group row\"><label for=\"jssiteAbout\" class=\"col-sm-2 col-form-label\">" . $L->get( 'site-about' ) . "</label><div class=\"col-sm-10\"><input class=\"form-control \" id=\"jssiteAbout\" name=\"langz[$lan][siteAbout]\" value=\"" . ( !empty($val['siteAbout']) ? $val['siteAbout'] : '' ) . "\" placeholder=\"\" type=\"text\"><small class=\"form-text text-muted\">" . $L->get( 'site-about-info' ) . "</small></div></div><!--//Setting--><!--Setting--><div class=\"form-group row\"><label for=\"jsdateFormat\" class=\"col-sm-2 col-form-label\">" . $L->get( 'date-format' ) . "</label><div class=\"col-sm-10\"><input class=\"form-control \" id=\"jsdateFormat\" name=\"langz[$lan][dateFormat]\" value=\"" . ( !empty($val['dateFormat']) ? $val['dateFormat'] : '' ) . "\" placeholder=\"\" type=\"text\"><small class=\"form-text text-muted\">" . sprintf( $L->get( 'date-format-info' ), date( $val['dateFormat'], time() ) ) . "</small></div></div><!--//Setting--><!--Setting--><div class=\"form-group row\"><label for=\"jsauthorAbout\" class=\"col-sm-2 col-form-label\">" . $L->get( 'author-about' ) . "</label><div class=\"col-sm-10\"><input class=\"form-control \" id=\"jsauthorAbout\" name=\"langz[$lan][authorAbout]\" value=\"" . ( !empty($val['authorAbout']) ? $val['authorAbout'] : '' ) . "\" placeholder=\"\" type=\"text\"><small class=\"form-text text-muted\">" . $L->get( 'author-about-info' ) . "</small></div></div><!--//Setting--><!--Setting--><div class=\"form-group row\"><label for=\"jsdisqusCode\" class=\"col-sm-2 col-form-label\">" . $L->get( 'disqus-code' ) . "</label><div class=\"col-sm-10\"><input class=\"form-control \" id=\"jsdisqusCode\" name=\"langz[$lan][disqusCode]\" value=\"" . ( !empty($val['disqusCode']) ? $val['disqusCode'] : '' ) . "\" placeholder=\"\" type=\"text\"><small class=\"form-text text-muted\">" . $L->get( 'disqus-code-info' ) . "</small></div></div><!--//Setting--><\/div><!-- //Lan-$lan Settings -->";
						$thtml = "<!-- Lan-$lan Settings --><div class=\"tab-pane fade\" id=\"Lan-$lan\" role=\"tabpanel\" aria-labelledby=\"Lan-$lan-tab\"><div class=\"form-group row\"><label for=\"jssiteName\" class=\"col-sm-2 col-form-label\">" . $L->get( 'site-title' ) . "</label><div class=\"col-sm-10\"><input class=\"form-control \" id=\"jssiteName\" name=\"langz[$lan][siteName]\" value=\"" . ( !empty($val['siteName']) ? $val['siteName'] : '' ) . "\" placeholder=\"\" type=\"text\"><small class=\"form-text text-muted\">" . $L->get( 'site-title-info' ) . "</small></div></div><!--//Setting--><!--Setting--><div class=\"form-group row\"><label for=\"jssiteDescription\" class=\"col-sm-2 col-form-label\">" . $L->get( 'site-description' ) . "</label><div class=\"col-sm-10\"><input class=\"form-control \" id=\"jssiteDescription\" name=\"langz[$lan][siteDescription]\" value=\"" . ( !empty($val['siteDescription']) ? $val['siteDescription'] : '' ) . "\" placeholder=\"\" type=\"text\"><small class=\"form-text text-muted\">" . $L->get( 'site-slogan-info' ) . "</small></div></div><!--//Setting--><!--Setting--><div class=\"form-group row\"><label for=\"jssiteSlogan\" class=\"col-sm-2 col-form-label\">" . $L->get( 'site-slogan' ) . "</label><div class=\"col-sm-10\"><input class=\"form-control \" id=\"jssiteSlogan\" name=\"langz[$lan][siteSlogan]\" value=\"" . ( !empty($val['siteSlogan']) ? $val['siteSlogan'] : '' ) . "\" placeholder=\"\" type=\"text\"><small class=\"form-text text-muted\">" . $L->get( 'site-slogan-info' ) . "</small></div></div><!--//Setting--><!--Setting--><div class=\"form-group row\"><label for=\"jssiteAbout\" class=\"col-sm-2 col-form-label\">" . $L->get( 'site-about' ) . "</label><div class=\"col-sm-10\"><input class=\"form-control \" id=\"jssiteAbout\" name=\"langz[$lan][siteAbout]\" value=\"" . ( !empty($val['siteAbout']) ? $val['siteAbout'] : '' ) . "\" placeholder=\"\" type=\"text\"><small class=\"form-text text-muted\">" . $L->get( 'site-about-info' ) . "</small></div></div><!--//Setting--><!--Setting--><div class=\"form-group row\"><label for=\"jsdateFormat\" class=\"col-sm-2 col-form-label\">" . $L->get( 'date-format' ) . "</label><div class=\"col-sm-10\"><input class=\"form-control \" id=\"jsdateFormat\" name=\"langz[$lan][dateFormat]\" value=\"" . ( !empty($val['dateFormat']) ? $val['dateFormat'] : '' ) . "\" placeholder=\"\" type=\"text\"><small class=\"form-text text-muted\">" . sprintf( $L->get( 'date-format-info' ), date( $val['dateFormat'], time() ) ) . "</small></div></div><!--//Setting--><!--Setting--><div class=\"form-group row\"><label for=\"jsauthorAbout\" class=\"col-sm-2 col-form-label\">" . $L->get( 'author-about' ) . "</label><div class=\"col-sm-10\"><input class=\"form-control \" id=\"jsauthorAbout\" name=\"langz[$lan][authorAbout]\" value=\"" . ( !empty($val['authorAbout']) ? $val['authorAbout'] : '' ) . "\" placeholder=\"\" type=\"text\"><small class=\"form-text text-muted\">" . $L->get( 'author-about-info' ) . "</small></div></div><!--//Setting--><!--Setting--><div class=\"form-group row\"><label for=\"jsdisqusCode\" class=\"col-sm-2 col-form-label\">" . $L->get( 'disqus-code' ) . "</label><div class=\"col-sm-10\"><input class=\"form-control \" id=\"jsdisqusCode\" name=\"langz[$lan][disqusCode]\" value=\"" . ( !empty($val['disqusCode']) ? $val['disqusCode'] : '' ) . "\" placeholder=\"\" type=\"text\"><small class=\"form-text text-muted\">" . $L->get( 'disqus-code-info' ) . "</small></div></div><!--//Setting--><\/div><!-- //Lan-$lan Settings -->";

						$phtml .= "$(\"nav[class*='mb-3'] \").after(" . PHP_EOL;
						$phtml .= "'$thtml'" . PHP_EOL;
						$phtml .= ");" . PHP_EOL;						
					}
					
				}
				
				
			}
			* /
			
			$html.=<<<EOT
<script>
    $(document).ready(function(){
    $("div[class*='nav nav-tabs'] > a:last").after(
            '$shtml'
        );
    
    $phtml

EOT;

$html.=<<<EOT
        
    });
</script>
EOT;
			
		}
*/

        if ( $page == 'categories' )
        {
            global $categories;
			
			$blogs = $this->blogs;

            $thtml = '<table class="table table-striped mt-3"><thead><tr>';
			
			$thtml .= '<th class="border-bottom-0" scope="col">Name</th>';
			$thtml .= '<th class="border-bottom-0" scope="col">URL</th>';
			
			$thtml .= '<th class="border-bottom-0" scope="col">Blog</th>';
			
			if ( $this->getValue( 'enable-langs' ) )
            {
				//$defaultLang = $this->getValue( 'default-lang' );
				
				//$iconsHtml = $this->htmlPath() . 'flags/';

				//$iconsPath = $this->phpPath() . 'flags/';		
				
               $langs = $this->openDB( DB_LANGS );
				
				$thtml .= '<th class="border-bottom-0" scope="col">Language</th>';

                if ( !empty( $langs ) )
                {
					
					
					/*
					$file = ( file_exists( $iconsPath . $defaultLang['name'] . '.png' ) ? '<img src="' . $iconsHtml . $defaultLang['name'] . '.png" />' : $defaultLang['lang'] ); 
					
					foreach( $langs as $key => $row )
					{
						$file = ( file_exists( $iconsPath . $row['code'] . '.png' ) ? '<img src="' . $iconsHtml . $row['code'] . '.png" />' : $row['name'] ); 
						
						$thtml .= '<th class="border-bottom-0" scope="col">' . $file . '</th>';
						
					}
					*/
				}
				
			}
			
			$thtml .= '</tr></thead><tbody>';
			
            foreach ( $categories->db as $key => $fields ) 
            {
				$blog = $this->searchCategory ( $key, false, true );
								
                $catUrl = $this->getCagegoryURL( $key );
				
				$thtml .= '<tr>';

                $thtml .= '<td><a href="' . $this->site_url() . 'admin/edit-category/' . $key . '">' . $fields['name'] . '</a></td>';
				
				$thtml .= '<td><a href="' . $catUrl . '">' . $catUrl . '</a></td>';
				
				$thtml .= '<td>' . ( !empty( $blog ) ? $blogs[$blog['blog']]['name'] : 'Default' ) . '</td>';
				
				if ( $this->getValue( 'enable-langs' ) )
				{
				
					$searchLang = $this->searchCategory ( $key, true, false );
					
					$thtml .= '<td>' . ( !empty( $searchLang ) ? $langs[$searchLang['lang']]['name'] : 'Default' ) . '</td>';
				}
				
				$thtml .= '</tr>';
            }
			
			$thtml .= '</tbody></table>';

            $html.=<<<EOT
<script>
    $(document).ready(function(){
    $("table[class*='table table-striped mt-3']").hide();
	
	$("table[class*='table table-striped mt-3']").before(
            '$thtml'
        );
EOT;

$html.=<<<EOT
        
    });
</script>
EOT;

        }
		
        if ( $page == 'new-category' )
        {

            $shtml .= '<div class="form-group">';
           // $shtml .= '<label>Blog</label><br />';
            $shtml .= '<select name="blog">';

            $shtml .= '<option value="">' . $L->get( 'select-blog' ) . '</option>';
                        
            foreach ( $this->blogs as $key=>$row ) 
            {                            
                $shtml .= '<option value="' . $key . '">' . stripslashes( $row['name'] ) . '</option>';
            }
            
            $shtml .= '</select></div>';

            if ( $this->getValue( 'enable-langs' ) )
            {
                $langs = $this->buildLangsArray();

                if ( !empty($langs ) )
                {
                   
                    $shtml .= '<div class="form-group">';

                    $shtml .= '<select name="lang">';

                    $shtml .= '<option value="">' . $L->get( 'select-lang' ) . '</option>';
                                
                    foreach ( $langs as $code=>$lang )
                    {                            
                        $shtml .= '<option value="' . $code . '">' . stripslashes( $lang['lang'] ) . '</option>';
                    }
                    
                    $shtml .= '</select></div>';
                }
            }
                                
            $html .=<<<EOT
<script>
        $("#jstokenCSRF").after(
            '$shtml'
        );
</script>
EOT;

        }
		
		if ( strpos( $_SERVER['REQUEST_URI'], 'edit-content/' ) !== false )
        {
			$uri = explode ( '/' , $url->slug() );
			
			$postKey = end ($uri);
			
			$searchKey = $this->searchKey( $postKey );
			
			$searchLang = $this->searchKey( $postKey, 'langs' );
			
			$shtml .= '<div class="form-group">';
           // $shtml .= '<label>Blog</label><br />';
            $shtml .= '<select name="blog">';

            $shtml .= '<option value="">' . $L->get( 'select-blog' ) . '</option>';
                        
            foreach ( $this->blogs as $key => $row ) 
            {                            
                $shtml .= '<option value="' . $key . '" ' . ( ( !empty( $searchKey ) && ( $searchKey['blog'] == $key ) ) ? 'selected' : '' ) . '>' . stripslashes( $row['name'] ) . '</option>';
            }
            
            $shtml .= '</select></div>';

            if ( $this->getValue( 'enable-langs' ) )
            {
                $langs = $this->buildLangsArray();

                if ( !empty($langs ) )
                {
					//$parent = $url->parameter('from');
			
					//$postLang = $url->parameter('lang');
					
                    $shtml .= '<div class="form-group">';

                    $shtml .= '<select name="lang">';

                    $shtml .= '<option value="">' . $L->get( 'select-lang' ) . '</option>';
                                
                    foreach ( $langs as $code => $lang )
                    {
                        $shtml .= '<option value="' . $code . '" ' . ( ( !empty( $searchLang ) && ( $searchLang['lang'] == $code ) ) ? 'selected' : '' ) . '>' . stripslashes( $lang['lang'] ) . '</option>';
                    }
                    
                    $shtml .= '</select></div>';
					
					$shtml .= '<input type="hidden" id="jsEditPost" name="EditPost" value="true">';
					
					//if ( $parent !== null )
						//$shtml .= '<input type="hidden" id="jsParentPost" name="parentPost" value="' . $parent . '">';
                }
            }
                                
            $html .=<<<EOT
<script>
        $("#jstitle").after(
            '$shtml'
        );
</script>
EOT;
			
		}

        if ( $page == 'new-content' )
        {
			//We need this value to disable the language from if the shop is for one language only
			$disableF = '';
			
			$disableL = false;
			
			$shopH = '';
									
			$is_thread = false;
			
			$is_forum = false;
			
			$is_product = false;
						
			//if ( ( $this->getValue( 'enable-forum' ) !== 'disable' ) && !empty( $url->parameter('topic') ) )
			//{
				//$is_thread = false;
			//}
			
			if ( ( $this->getValue( 'enable-forum' ) !== 'disable' ) && ( !empty( $url->parameter('forum') ) || !empty( $url->parameter('topic') ) ) )
			{
				$forumBlog = $this->getValue( 'enable-forum' );
								
				$forumData = $this->getValue( 'forum-settings' );
				
				if ( isset( $this->blogs[$forumBlog] ) && empty( $this->blogs[$forumBlog]['disable'] ) && !empty( $forumData ) )
				{
					$blogValues = $this->blogs[$forumBlog];
					
					if ( !empty( $url->parameter('forum') ) )
						$is_forum = true;
					
					elseif ( !empty( $url->parameter('topic') ) )
						$is_thread = true;
					
					$defaultLang = $this->getValue( 'default-lang' );
					
					//Don't let the user change language, if the store is for the default-lang only
					if ( ( $blogValues['enabled'] !== 'everywhere' ) && ( $blogValues['enabled'] == $defaultLang['code'] ) )
						$disableF = 'disabled';
				}
			}
			
			if ( ( $this->getValue( 'enable-shop' ) !== 'disable' ) && !empty( $url->parameter('product') ) )
			{
				$shopBlog = $this->getValue( 'enable-shop' );
				
				$storeData = $this->getValue( 'store-settings' );
				
				if ( isset( $this->blogs[$shopBlog] ) && empty( $this->blogs[$shopBlog]['disable'] ) && !empty( $storeData ) )
				{
					$blogValues = $this->blogs[$shopBlog];
					
					$is_product = true;
					
					$defaultLang = $this->getValue( 'default-lang' );
					
					//Don't let the user change language, if the store is for the default-lang only
					if ( ( $blogValues['enabled'] !== 'everywhere' ) && ( $blogValues['enabled'] == $defaultLang['code'] ) )
						$disableF = 'disabled';
				}
				
			}
			
			if ( $is_product )
			{
				$shtml .= '<input type="hidden" id="jsBlog" name="blog" value="' . $shopBlog . '">';
				
				require_once ( PHP_FOLDER . 'arrays.php' );
				
				require( PHP_FOLDER . 'shop' . DS . 'shop-form.php' );
								
				$phtml .= "$(\"nav > div[class*='nav nav-tabs'] > a[id*='nav-seo-tab'] \").after(" . PHP_EOL;
				//$phtml .= "$(\"textarea[id*='jseditor']\").before(" . PHP_EOL;
                $phtml .= "'$shopH'" . PHP_EOL;
                $phtml .= ");" . PHP_EOL;
				
				$phtml .= "$(\"div[id*='nav-seo']\").before(" . PHP_EOL;
				//$phtml .= "$(\"input[id*='jstitle']\").before(" . PHP_EOL;
                $phtml .= "'$shopL'" . PHP_EOL;
                $phtml .= ");" . PHP_EOL;
			}
			
			elseif ( $is_forum || $is_thread )
			{
				$shtml .= '<input type="hidden" id="jsBlog" name="blog" value="' . $forumBlog . '">';
				
				$shtml .= '<input type="hidden" id="jsTransPost" name="TransPost" value="true">';
				
				if ( $is_forum )
					require( $this->phpPath() . 'php' . DS . 'forum-form.php' );
				
				if ( $is_thread )
				{
					$forumList = $this->blogs[$forumBlog]['list'];
					
					require( $this->phpPath() . 'php' . DS . 'topic-form.php' );
				
					$disableL = true;
					
				}
			}
			else
			{

				$t = $this->selectCategories();
				
				$s = '';
				
				if ( !empty( $t ) )
				{
					if ( isset( $t['langs'] ) && !empty( $t['langs'] ) )
						$s = $t['langs'];
					
					elseif ( isset( $t['blogs'] ) && !empty( $t['blogs'] ) )
						$s = $t['blogs'];

				}
				
				if ( !empty( $s ) )
				{
					$shtml .= '<div class="form-group"><br /><select id="langSel" size="1" name="lang"><option value="" selected="selected">-- Language --</option></select><select id="blogSel" size="1" name="blog"><option value="" selected="selected">-- Blog --</option></select><select id="catSel" size="1" name="category"><option value="" selected="selected">-- Category --</option></select></div>';
					
				}

				$langs = $this->openDB( DB_LANGS );
				
				if ( !empty( $s ) )
				{
					$html .= '<script>';
					
					//Hide categories selection
					$html .= '$("#jscategory").hide();' . PHP_EOL;
					
					$html .= "$(\"label[for*='jscategory']\").hide();" . PHP_EOL;
					
					//Load the data array
					$html .= "var categoriesDB = " . json_encode( $s, JSON_PRETTY_PRINT ) . "
				
				window.onload = function () {
					//Get html elements" . PHP_EOL;
					
					if ( isset( $t['langs'] ) )
						$html .= "var langSel = document.getElementById(\"langSel\");
						var blogSel = document.getElementById(\"blogSel\");
						var catSel = document.getElementById(\"catSel\");";
					
					elseif ( isset( $t['blogs'] ) )
						$html .= "var blogSel = document.getElementById(\"blogSel\");
						var catSel = document.getElementById(\"catSel\");";
						
					elseif ( isset( $t['categories'] ) )
						$html .= "var catSel = document.getElementById(\"catSel\");";
					
					$html .= "
					
					//Load languages
					for (var lang in categoriesDB) {
						var temp = categoriesDB[lang];
						iterator = Object.values(temp);
						var x = iterator[0];
						var s = Object.values(x);
						var langKey = s[0]['langKey'];
						langSel.options[langSel.options.length] = new Option(lang, langKey);
					}
					
					//Lang Changed
					langSel.onchange = function () {
						blogSel.length = 1; // remove all options bar first
						catSel.length = 1; // remove all options bar first
						
						if (this.selectedIndex < 1)
							return;
						
						//Loop through array to find the language
						for ( var x in categoriesDB ) {
							var temp = categoriesDB[x];
							iterator = Object.values(temp);
							var x = iterator[0];
							var s = Object.values(x);
							var langKey = s[0]['langKey'];
							var lang = s[0]['lang'];
							
							if ( langKey === this.value ) { break; }
						}
						//console.log(langKey);
						//for (var blog in categoriesDB[this.value]) {
						for (var blog in categoriesDB[lang]) {
							//console.log(lang);
							var temp = categoriesDB[lang];
							var temp2 = categoriesDB[lang][blog];
							var iterator = Object.values(temp2);
							var blogKey = iterator[0]['blogKey'];
							//var langKey = iterator[0]['langKey'];
							
							blogSel.options[blogSel.options.length] = new Option(blog, blogKey);
						}
					}
					
					//Blog Changed
					blogSel.onchange = function () {
						
						catSel.length = 1; // remove all options bar first
						
						if (this.selectedIndex < 1)
							return; // done
						
						//Loop through array to find the language
						for ( var x in categoriesDB ) {
							var temp = categoriesDB[x];
							iterator = Object.values(temp);
							var x = iterator[0];
							var s = Object.values(x);
							var langKey = s[0]['langKey'];
							var lang = s[0]['lang'];
							
							if ( langKey === langSel.value ) { break; }
						}
						
						var temp = categoriesDB[lang];

						for (var t in temp) {
							var x = categoriesDB[lang][t];
							var iterator = Object.values(x);
							var z = iterator[0]['blogKey'];
							var blog = iterator[0]['blog'];
							if ( z === this.value ) { break; }
						}
						
						for (var cat in categoriesDB[lang][blog]) {
							var tempv = categoriesDB[lang][blog][cat];
							var ator = Object.values(tempv);
							//var catKey = tempv['key'];
							var catName = tempv['name'];
							//console.log(catKey);
							catSel.options[catSel.options.length] = new Option(catName, cat);
						}
					}
	
				}
				</script>";
				}
			}

            if ( $this->getValue( 'enable-langs' ) && empty( $disableL ) )
            {
                $langs = $this->buildLangsArray();

                if ( !empty( $langs ) )
                {
					$parent = $url->parameter('from');
			
					$shtml .= '<input type="hidden" id="jsTransPost" name="TransPost" value="true">';
					
					if ( $parent !== null )
						$shtml .= '<input type="hidden" id="jsParentPost" name="parentPost" value="' . $parent . '">';
                }
            }
                                
            $html .=<<<EOT
<script>
        $("#jstitle").after(
            '$shtml'
        );
		$phtml
</script>
EOT;
        
        }
                
        if ( $page == 'content' )
        {
			require( $this->phpPath() . 'php' . DS . 'admin-content.php' );

$html .=<<<EOT
<script>
    $(document).ready(function(){
	$("ul[class*='nav nav-tabs']").hide();
	$("div[class*='tab-content']").hide();
    $("ul[class*='nav nav-tabs']").before(
            '$thtml'
        );
EOT;

$html.=<<<EOT
        
    });
</script>
EOT;

$html .= '<script>$(document).ready(function(){
$(\'#deleteModal\').on(\'show.bs.modal\', function(e) {
var Id = $(e.relatedTarget).data(\'pagekey\');
$(e.currentTarget).find(\'input[name="pageKey"]\').val(Id);
});});
</script>';
        }
		
		if ( isset( $_GET['addReply'] ) )
		{
			$html .= '<script>
			var easymde = null;

			// Insert an image in the editor at the cursor position
			// Function required for Bludit
			function editorInsertMedia(filename) {
				var text = easymde.value();
				easymde.value(text + "![Image description]("+filename+")" + "\n");
				easymde.codemirror.refresh();
			}

			// Returns the content of the editor
			// Function required for Bludit
			function editorGetContent() {
				return easymde.value();
			}

			easymde = new EasyMDE({
				element: document.getElementById("jseditor"),
				status: false,
				toolbarTips: true,
				toolbarGuideIcon: true,
				autofocus: false,
				placeholder: "",
				lineWrapping: true,
				autoDownloadFontAwesome: false,
				indentWithTabs: true,
				tabSize: 2,
				spellChecker: false,
				toolbar: ["bold", "italic", "heading", "|", "quote", "unordered-list", "|", "link", "image", "code", "horizontal-rule", "|", "preview", "side-by-side", "fullscreen",
					"|",
					{
					name: "pageBreak",
					action: function addPageBreak(editor){
						var cm = editor.codemirror;
						output = "<?php echo $pageBreak ?>";
						cm.replaceSelection(output);
						},
					className: "fa fa-crop",
					title: "Page break",
					}]
			});

			</script>';
		}
		/*
		$html .= <<<EOT
<script>
	$(document).ready(function(){
		$("li > a[href*='/admin/plugins']").after(
			'<li class="nav-item">'
		+		'<a class="nav-link" href="/admin/configure-plugin/pluginG3Nshop?">- kk</a>'
		+	'</li>'
		);
		$("li > a[href*='/admin/new-content']").after(
			'<li class="nav-item ml-3">'
		+		'<a class="nav-link" href="/admin/new-content?GS"><span class="oi oi-plus"></span>ll</a>'
		+	'</li>'
		);
EOT;
	* /
	        $html.=<<<EOT
<script>
$(document).ready(function(){
EOT;

	if ( $this->getValue( 'enable-shop' ) !== 'disable' )
	{
		$stml = '<li class="nav-item"><a class="nav-link" href="' . $this->site_url() . 'admin/new-content?product=true"><span class="fa fa-plus-circle"></span>' . $L->get( 'new-product' ) . '</a></li>';
		
		$html.=<<<EOT
		$("li > a[href*='/admin/new-content']").before(
			'$stml'
		);
EOT;
	}
	/*
	if ( $this->getValue( 'enable-forum' ) !== 'disable' )
	{
		//$ftml = '<li class="nav-item mt-3"><h4>' . $L->get( 'blogs-sidebar-menu' ) . '</h4></li>';
		
		$ftml = '<li class="nav-item"><a class="nav-link" href="' . $this->site_url() . 'admin/new-content?forum=true"><span class="fa fa-plus-circle"></span>' . $L->get( 'new-forum' ) . '</a></li>';
		
		$ftml .= '<li class="nav-item"><a class="nav-link" href="' . $this->site_url() . 'admin/new-content?thread=true"><span class="fa fa-plus-circle"></span>' . $L->get( 'new-thread' ) . '</a></li>';
		
		$ftml .= '<li class="nav-item"><a class="nav-link" href="' . $this->site_url() . 'admin/new-content?topic=true"><span class="fa fa-plus-circle"></span>' . $L->get( 'new-topic' ) . '</a></li>';
		
		$html.=<<<EOT
		$("li > a[href*='/admin/new-content']").after(
			'$ftml'
		);
EOT;
	}
	
		$shtml = '<li class="nav-item mt-3"><h4>' . $L->get( 'blogs-sidebar-menu' ) . '</h4></li>';
		
		$shtml .= '<li class="nav-item"><a class="nav-link" href="' . $this->site_url() . 'admin/configure-plugin/pluginSubBlogs">' . $L->get( 'main-settings' ) . '</a></li>';
		
		if ( $this->getValue( 'enable' ) )
			$shtml .= '<li class="nav-item"><a class="nav-link" href="' . $this->site_url() . 'admin/configure-plugin/pluginSubBlogs?blogs=true">' . $L->get( 'blogs-settings' ) . '</a></li>';
		
		if ( $this->getValue( 'enable-shop' ) !== 'disable' )
			$shtml .= '<li class="nav-item"><a class="nav-link" href="' . $this->site_url() . 'admin/configure-plugin/pluginSubBlogs?store=true">' . $L->get( 'store-settings' ) . '</a></li>';
		
		if ( $this->getValue( 'enable-forum' ) !== 'disable' )
			$shtml .= '<li class="nav-item"><a class="nav-link" href="' . $this->site_url() . 'admin/configure-plugin/pluginSubBlogs?forum=true">' . $L->get( 'forum-settings' ) . '</a></li>';
		
		if ( $this->getValue( 'enable-seo' ) )
			$shtml .= '<li class="nav-item"><a class="nav-link" href="' . $this->site_url() . 'admin/configure-plugin/pluginSubBlogs?seo=true">' . $L->get( 'seo-settings' ) . '</a></li>';
		
		if ( $this->getValue( 'enable-amp' ) )
			$shtml .= '<li class="nav-item"><a class="nav-link" href="' . $this->site_url() . 'admin/configure-plugin/pluginSubBlogs?amp=true">' . $L->get( 'amp-settings' ) . '</a></li>';
		
		if ( $this->getValue( 'enable-langs' ) )
			$shtml .= '<li class="nav-item"><a class="nav-link" href="' . $this->site_url() . 'admin/configure-plugin/pluginSubBlogs?langs=true">' . $L->get( 'langs-settings' ) . '</a></li>';
		        
$html.=<<<EOT
        $("li > a[href*='/admin/users']").after(
            '$shtml'
        );
EOT;

$html.=<<<EOT
		});
</script>
EOT;
*/