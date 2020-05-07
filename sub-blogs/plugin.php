<?php

class pluginSubBlogs extends Plugin {
	
	/**
	 * @var blogs
	 * @access private
	 */	
	private $blogs;
	
	/**
     * @var langs
     * @access private
     */ 
    private $langs;
	
	/**
     * @var uri
     * @access private
     */ 
    private $uri;
	
	/**
     * @var uri
     * @access private
     */ 
    private $array;
	
	/**
     * @var sitemaps
     * @access private
     */ 
    private $sitemaps;
	
	/**
     * @var currency
     * @access private
     */ 
    private $currency;
	
	/**
     * @var countries
     * @access private
     */ 
    private $countries;
	
	/**
     * @var userID
     * @access private
     */ 
    private $userID;
	
	
	public function init()
	{
        global $url;
				
		require ( $this->phpPath() . 'php' . DS . 'helpers' . DS . 'init.php' );
		
        $this->buildBlogsArray();//Remove this
		
		if ( ( $_SERVER['REQUEST_METHOD'] == 'POST' ) && ( $url->whereAmI() == 'admin' ) )
		{
			require ( PHP_FOLDER . 'post.php' );
		}
		
		if ( $this->hideButtons() )
			$this->formButtons = false;
	}
		
	public function setMenu()
	{		
		$menu = '';
		
		if ( $this->getValue( 'enableMenu' ) === 'manual' )
		{
			$uri = $this->uri;
			
			$menuDB = $this->openDB( DB_MENU );
			
			foreach( $menuDB as $id => $row )
			{
				if ( empty( $uri['lang'] ) && ( ( $row['lang'] == 'everywhere' ) || ( $row['lang'] == 'default' ) ) )
				{
					$data = $menuDB[$id]['menu'];
					
					break;
				}
				
				elseif ( !empty( $uri['lang'] ) && ( ( $row['lang'] == 'everywhere' ) || ( $row['lang'] == $uri['lang'] ) ) )
				{
					$data = $menuDB[$id]['menu'];
					
					break;
				}
			}
			
			unset( $menuDB );
			
			$menu .= '<ul class="nav-menu">';
			
			if ( !empty( $data ) )
			{
				$i = 0;
				
				foreach ( $data as $item )
				{
					$i++;
					$key = '';
					$menu .= '<li id="menu-item-' . $i . '" class="menu-item menu-item-type-post_type ' . ( !empty( $item['children'] ) ? 'menu-item-has-children' : '' ) . ( ( $i == 1 ) ? ' menu-item-home ' : '' ) .  ( ( ( $i == 1 ) && !isset( $uri['pageSlug'] ) || empty( $uri['blog'] ) ) ? 'current-menu-item' : '' ) . 
					
					( ( $i > 1 ) ? ' menu-item-object-custom ' . ( ( isset( $uri['blog'] ) && !empty( $uri['blog'] ) && ( $uri['blog'] == $key ) ) ? 'current-menu-item' : '' ) : '' ) . ' page_item menu-item-' . $i . '"><a href="' . $item['href'] . '" aria-current="page">' . $item['text'] . '</a>';
					
					if ( !empty( $item['children'] ) )
					{
						$menu .= '<ul class="sub-menu">';
						
						foreach( $item['children'] as $child )
						{
							$i++;
					
							$menu .= '<li id="menu-item-' . $i . '" class="menu-item menu-item-type-taxonomy menu-item-' . $i . '"><a href="' . $child['href'] . '">' . $child['text'] . '</a></li>';
						}
						
						$menu .= '</ul>';
						
					}
				}
				
			}
			
			$menu .= '</ul>';
		}
		
		if ( $this->getValue( 'enableMenu' ) === 'auto' )
		{
			global $categoriesHome, $categoriesList, $uri, $langDetails, $L, $pagesList;
			
			$i = 1;
			
			$menu .= '<ul class="nav-menu">';
			
			$menu .= '<li id="menu-item-' . $i . '" class="menu-item menu-item-type-post_type menu-item-object-page ' . ( !empty( $categoriesHome ) ? 'menu-item-has-children' : '' ) . ' menu-item-home ' . ( ( !isset( $uri['pageSlug'] ) || empty( $uri['blog'] ) ) ? 'current-menu-item' : '' ) . ' page_item menu-item-' . $i . '"><a href="' . $langDetails['url'] . '" aria-current="page">' . $L->get( 'nav-home' ) . '</a>';
			
			if ( !empty( $categoriesHome ) )
			{
				
				$menu .= '<ul class="sub-menu">';
				
				foreach ( $categoriesHome as $key => $fields )
				{
					$i++;
					
					$menu .= '<li id="menu-item-' . $i . '" class="menu-item menu-item-type-taxonomy menu-item-' . $i . '"><a href="' . $fields['url'] . '">' . $fields['name'] . '</a></li>';
					
				}
				
				$menu .= '</ul>';
				
			}
			
			$menu .= '</li>';
			
			if ( !empty( $categoriesList ) )
			{
				foreach ( $categoriesList as $key => $fields )
				{
				
					$i++;
					
					$menu .= '<li id="menu-item-' . $i . '" class="menu-item menu-item-type-custom menu-item-object-custom ' . ( ( isset( $uri['blog'] ) && !empty( $uri['blog'] ) && ( $uri['blog'] == $key ) ) ? 'current-menu-item' : '' ) . ' ' . ( !empty( $fields['cats'] ) ? 'menu-item-has-children' : '' ) . ' menu-item-' . $i . '"><a href="' . $fields['url'] . '">' . $fields['name'] . '</a>';
					
				
					if ( !empty( $fields['cats'] ) )
					{
						
						$menu .= '<ul class="sub-menu">';
						
						foreach ( $fields['cats'] as $k=>$f )
						{
							$i++;
							
							$menu .= '<li id="menu-item-' . $i . '" class="menu-item menu-item-type-taxonomy menu-item-object-post_tag menu-item-' . $i . '"><a href="' . $f['url'] . '">' . $f['name'] . '</a></li>';
							
						}
						
						$menu .= '</ul>';
						
					}
				}
				
				$menu .= '</li>';
			}
			
			if ( !empty( $pagesList ) )
			{
				$i++;
				
				$menu .= '<li id="menu-item-' . $i . '" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-' . $i . '"><a href="#">' . $L->get( 'nav-more' ) . '</a>';
			
			
				$menu .= '<ul class="sub-menu">';
				
				foreach ( $pagesList as $pa )
				{
					$i++;
					
					$menu .= '<li id="menu-item-' . $i . '" class="menu-item menu-item-type-taxonomy menu-item-' . $i . '"><a href="' . $pa->permalink() . '">' . $pa->title() . '</a></li>';
					
				}
				
				$menu .= '</ul>';
				
				$menu .= '</li>';
				
			}
				
			if ( isset( $langDetails['contactPage'] ) && !empty( $langDetails['contactPage']['url'] ) )
			{
				$i++;
				
				$menu .= '<li id="menu-item-' . $i . '" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-' . $i . '"><a href="' . $langDetails['contactPage']['url'] . '">' . $langDetails['contactPage']['title'] . '</a></li>';
				
			}
			
			$menu .= '</ul>';

		}
		
		return $menu;
	}
		
	private function siteNoIndex()
	{
		
	}
	
	private function hideButtons()
	{
		global $url;
		
		$hide = false;
		
		if ( $url->parameter('menu') !== false )
		{
			$hide = true;
			
			if ( $url->parameter('sa') == 'add' )
				$hide = false;
		}
		
		return $hide;
	}
	
	public function selectCategories( $lang = '' )
    {
		global $categories;
		
		$data = array();
		
		$langs = array();
		
		if ( $this->getValue( 'enable-langs' ) )
			$langs = $this->openDB( DB_LANGS );
		
		$blogs = $this->blogs;
		
		$categoriesDB = $categories->db;
		
		if ( !empty( $langs ) && empty( $lang ) )
		{
			$defaultLang = $this->getValue( 'default-lang' );
			
			//ADD the default categories first
			foreach ( $categoriesDB as $catKey => $r )
			{
				$search = $this->searchCategory ( $catKey, false, true );
				
				$searchLang = $this->searchCategory ( $catKey, true, false );
					
				if ( empty( $search ) && empty( $searchLang ) )
					$data['langs'][$defaultLang['lang']]['Default'][$catKey] = array( 'key' => $catKey, 'name' => $r['name'], 'blogKey' => 'default', 'blog' => 'Default', 'langKey' => $defaultLang['code'], 'lang' => $defaultLang['lang'] );
			}
			
			//Now add the categories according to the blog they belong
			foreach ( $blogs as $blogKey => $blog )
			{
				if ( $blog['disable'] )
					continue;
					
				if ( ( $blog['enabled'] !== 'everywhere' ) && ( $blog['enabled'] !== $defaultLang['code'] ) )
					continue;
				
				foreach ( $categoriesDB as $catKey => $r )
				{
					$search = $this->searchCategory ( $catKey, false, true );
					
					$searchLang = $this->searchCategory ( $catKey, true, false );
					
					if ( !empty( $search ) && empty( $searchLang ) && ( $search['blog'] == $blogKey ) )
						$data['langs'][$defaultLang['lang']][$blog['name']][$catKey] = array( 'key' => $catKey, 'name' => $r['name'], 'blogKey' => $blogKey, 'blog' => $blog['name'], 'langKey' => $defaultLang['code'], 'lang' => $defaultLang['lang'] );
					
				}
			}
			
			foreach( $langs as $l => $s )
			{
				//ADD the default categories for this lang first
				foreach ( $categoriesDB as $catKey => $r )
				{
					$search = $this->searchCategory ( $catKey, false, true );
					
					$searchLang = $this->searchCategory ( $catKey, true, false );
						
					if ( empty( $search ) && !empty( $searchLang ) && ( $searchLang['code'] == $s['code'] ) )
						$data['langs'][$s['name']]['Default'][$catKey] = array( 'key' => $catKey, 'name' => $r['name'], 'blogKey' => 'default', 'blog' => 'Default', 'langKey' => $l, 'lang' => $s['name'] );
						
				}
				
				foreach ( $blogs as $blogKey => $blog )
				{
					if ( $blog['disable'] )
						continue;
					
					if ( ( $blog['enabled'] !== 'everywhere' ) && ( $blog['enabled'] !== $s['code'] ) )
						continue;
					
					foreach ( $categoriesDB as $catKey => $r )
					{
						$search = $this->searchCategory ( $catKey, false, true );
						
						$searchLang = $this->searchCategory ( $catKey, true, false );
						
						if ( !empty( $search ) && ( $search['blog'] == $blogKey ) && !empty( $searchLang ) && ( $searchLang['code'] == $s['code'] ) )
							$data['langs'][$s['name']][$blog['name']][$catKey] = array( 'key' => $catKey, 'name' => $r['name'], 'blogKey' => $blogKey, 'blog' => $blog['name'], 'langKey' => $l, 'lang' => $s['name'] );
					}
					
				}
			}
		}
		
		//Maybe we don't have langs. But do we have blogs?
		elseif ( !empty( $blogs ) )
		{
			foreach ( $blogs as $blogKey => $blog )
			{
				if ( $blog['disable'] )
					continue;
					
				if ( ( $blog['enabled'] !== 'everywhere' ) && ( $blog['enabled'] !== $s['code'] ) )
					continue;
					
				foreach ( $categories->db as $catKey => $r )
				{
					$search = $this->searchCategory ( $catKey, false, true );
					
					if ( !empty( $lang ) )
					{
						$searchLang = $this->searchCategory ( $catKey, true, false );
						
						if ( !empty( $searchLang ) && ( $searchLang['code'] !== $lang ) )
							continue;
					}
					
					if ( !empty( $search ) && ( $search['blog'] == $blogKey ) )
					{
						if ( !empty( $lang ) )
							$data['blogs'][$lang][$blog['name']] = array( $r['name'] => array( 'key' => $catKey ) );
						else
							$data['blogs'][$blog['name']][$catKey] = array( 'key' => $catKey, 'name' => $r['name'], 'blogKey' => $blogKey, 'blog' => $blog['name'] );
					}
				}
			}
		}
		else
		{
			//Nothing! Just grab the categories
			foreach ( $categories->db as $catKey => $r )
			{
				$data['categories'][] = array( $r['name'] => array( 'key' => $catKey ) );
			}
		}
		
		//return ( !empty ( $data ) ? json_encode( $data, JSON_PRETTY_PRINT) : array() );
		//print_r($data);exit;
		return $data;
	}
	
	public function post()
    {
		require ( PHP_FOLDER . 'save-db.php' );

		if ( isset( $_POST['DoRedirect'] ) && !empty( $_POST['DoRedirect'] ) )
		{
			//We have a redirection request. Save the DB first before do anything
			$this->save();
				
			header( 'Location:' . $_POST['DoRedirect'] );
			
			exit;
		}
		else
			return $this->save();
    }
	
	public function saveReview( $data )
	{
		if ( !is_array( $data ) || empty( $data ) )
            return;
		
		global $site;
		
		$posts = $this->openDB( DB_PAGES );
		
		$postKey = sanitize( $data['productKey'] );
		
		$author = sanitize( $data['author'] );
		
		$rating = ( !is_numeric( $data['rating'] ) ? 0 : ( ( $data['rating'] > 5 ) ? 5 : (int) $data['rating'] ) );
		
		$post = strip_tags( sanitize( $data['comment'] ) );
		
		$email = sanitize( $data['emaillkjkl'] );
		
		$uuid = md5( uniqid() . time() );
		
		if ( !isset( $posts[$postKey] ) )
			return;
		
		$dir = PATH_PAGES . $postKey . DS;
		
		if ( !is_dir( $dir ) )
			return;
		
		$file = $dir . 'reviews.php';
		
		$reviews = ( file_exists( $file ) ? $this->openDB( $file ) : array() );
		
		$reviews[$uuid] = array(
								'date' => date( $site->dateFormat(), time() ),
								'dateUnix' => time(),
								'dateC' => date( 'c', time() ),
								'author' => $author,
								'email' => $email,
								'post' => $post,
								'rating' => $rating
		);
		
		return $this->addDB ( $reviews, $file );
	}
	
	public function saveThread ( $data ) 
	{
		if ( !is_array( $data ) || empty( $data ) )
            return;
		
		//Load the necessary DBs
		$blogs = $this->blogs;
		$langs = $this->openDB( DB_LANGS );
		$topics = $this->openDB ( DB_TOPICS );
		
		//Get the forum slug
		$forum = $this->getValue( 'enable-forum' );
				
		$topic = sanitize( $data['topicPost'] );
		
		$page = $this->addPageAsThread( $data );
		
		if ( $page )
		{
			if ( isset( $blogs[$forum] ) )
			{
				if ( !in_array( $page, $blogs[$forum]['list'] ) )
					array_push( $blogs[$forum]['list'], $page );
			}
			
			if ( isset( $topics[$topic] ) )
			{
				if ( !in_array( $page, $topics[$topic]['list'] ) )
					array_push( $topics[$topic]['list'], $page );
			}
			else
			{
				$topics[$topic] = array( 'list' => array() );
				
				array_push( $topics[$topic]['list'], $page );
			}
			
			if ( isset( $data['lang'] ) && !empty( $data['lang'] ) )
			{
				if ( isset( $langs[$data['lang']] ) && !in_array( $page, $langs[$data['lang']]['list'] ) )
				{
					array_push( $langs[$data['lang']]['list'], $page );
					
					$this->addDB ( $langs, DB_LANGS );
				}
			}
			
			$this->addDB ( $blogs, DB_BLOGS );
			
			$this->addDB ( $topics, DB_TOPICS );
			
			return $page;
		}
		
		return false;
	}

	public function addPageAsThread( $data )
    {
        if ( empty ( $data ) )
            return;
		
		if ( !isset( $data['user_id'] ) )
		{
			$userID = $this->userID;
			
			if ( empty( $userID ) )
			{
				$login = new Login();

				if ( $login->isLogged() )
					$userName = $login->username();
				else
					$userName = 'admin';
			}
			else
				$userName = $userID;
		}
		else
			$userName = sanitize( $data['user_id'] );
		
		$email = ( isset( $data['emaillkjkl'] ) ? sanitize( $data['emaillkjkl'] ) : '' );
		
		$posts = $this->openDB( DB_PAGES );
				
		$firstKey = $this->pagePosition ();
		
		$title = sanitize( $data['title'] );
		
		$key = ( !empty( $data['title'] ) ? Text::cleanUrl( $title ) : generate_key() );
		
		$pos = ( !empty( $firstKey ) ? ( $firstKey + 1 ) : 0 );
		
		$date = date( 'Y-m-d H:i:s', time() );
		
		$post = sanitize( $data['post'] );
		
		$uuid = md5( uniqid() );
		
		$p_dir = PATH_PAGES . $key . DS;
		
		$uploadDir = PATH_UPLOADS . $uuid . DS;
		
		//We can't continue if the post can't be saved
		@mkdir( $p_dir, 0755, true );
		
		if ( !is_dir( $p_dir ) )
			return;
		
		//Now create the uploads dir
		@mkdir( $uploadDir, 0755, true );
		
		//We want the name of the file also
		$f_name = $p_dir . 'index.txt';
		
		file_put_contents( $f_name, $post, LOCK_EX );
		
		//Set the checksum of the file
		$checksum = md5_file( $f_name );
				
		$topicType = ( isset( $data['bbp_stick_topic'] ) ? $data['bbp_stick_topic'] : 'published' );
		
		$topicStatus = ( ( isset( $data['bbp_topic_status'] ) && ( $data['bbp_topic_status'] == 'closed' ) ) ? false : true );
				
		//$topic = sanitize( $data['topicPost'] );
				
		$posts[$key] = array
		(
					'title' => mb_convert_encoding($title, "UTF-8"),
					'description' => mb_convert_encoding( generateDescr( $post ) , "UTF-8"),
					'username' => $userName,
					'tags' => array(),
					'type' => $topicType,
					'date' => $date,
					'dateModified' => '',
					'position' => $pos,
					'coverImage' => '',
					'category' => '',
					'md5file' => $checksum,
					'uuid' => $uuid,
					'allowComments' => $topicStatus,
					'template' => "",
					'noindex' => false,
					'nofollow' => false,
					'noarchive' => false
		);
		
		array_multisort( array_column( $posts, 'position' ), SORT_DESC, SORT_NUMERIC, $posts );
		
		$this->addDB ( $posts, DB_PAGES );

		return $key;
    }
	
	public function pagePosition ( $type = 'first' )
	{
		$posts = $this->openDB( DB_PAGES );
		
		array_multisort( array_column( $posts, 'position' ), SORT_DESC, SORT_NUMERIC, $posts );
		
		foreach( $posts as $key => $row ) 
		{
            return $row['position'];
        }
		
		return;
	}
	
	public function saveReply ( $data ) 
	{
		if ( !is_array( $data ) || empty( $data ) )
            return;
		
		if ( !isset( $data['user_id'] ) )
		{
			$userID = $this->userID;
			
			if ( empty( $userID ) )
			{
				$login = new Login();

				if ( $login->isLogged() )
					$userName = $login->username();
				else
					$userName = 'admin';
			}
			else
				$userName = $userID;
		}
		else
			$userName = sanitize( $data['user_id'] );
		
		$replies = array();
		
		$topic = $data['topicPost'];
		
		$topicID = $this->getUUID ( $data['topicPost'] );
		
		$file = PATH_PAGES . $topic . DS . 'replies.php';
		
		if ( file_exists ( $file ) )
			$replies = $this->openDB( $file );
		
		$uuid = md5( uniqid() . time() );
		
		$forumData = $this->getValue( 'forum-settings' );
		
		$lastID = ( ( !isset( $forumData['last-id'] ) || empty( $forumData['last-id'] ) ) ? 1 : ( $forumData['last-id'] + 1 ) );
		
		$replies[$uuid] = array( 'title' => $data['title'], 'date' => time(), 'user' => $userName, 'id' => $lastID,
		'post' => sanitize( $data['post'] ) );
		
		$this->addDB ( $replies, $file );
		
		$this->db['forum-settings']['last-id'] = $lastID;
		
		$this->save();
				
		return $lastID;
	}
	
	public function adminBodyEnd() 
    {
       
        if ( !$this->getValue( 'enable' ) )
            return;
        
        global $published, $url, $L;

        $blogs = $this->blogs;
        
        $p = 0;
        $shtml = '';
        $phtml = '';
        $thtml = '';
        $html  = '';
        $from_blog = '';
		
		$fullURL = ( ( isset( $_SERVER['HTTPS'] ) && ( $_SERVER['HTTPS'] == 'on' ) ) ? 'https' : 'http' ) . '://' . $_SERVER["SERVER_NAME"] . $_SERVER['REQUEST_URI'];
        
        $page = explode( "/", $_SERVER['REQUEST_URI']);
        $page = end($page);

        if ( strpos( $page, '?' ) !== false )
        {
            $page = explode("?", $page);
			$from_blog = ( isset( $_GET['blog'] ) ? $_GET['blog'] : '' );
			//( !empty( $url->parameter('blog') ) ? $url->parameter('blog') : '' );
            
            $page = $page['0'];
        }

        require ( $this->phpPath() . 'php' . DS . 'admin-header.php' );
		
		if ( ( $this->getValue( 'enableMenu' ) === 'manual' ) && ( $url->parameter('menu') !== false ) )
		{
			$html .= '<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>'.PHP_EOL;
			
			
			$html .= '<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>'.PHP_EOL;
        
			$html .= '<script type="text/javascript" src="' . $this->htmlPath() . 'plugins/jquery-menu-editor/jquery-menu-editor.js"></script>'.PHP_EOL;
			
			$html .= '<script type="text/javascript" src="' . $this->htmlPath() . 'plugins/jquery-menu-editor/bs-iconpicker/js/bootstrap-iconpicker.min.js"></script>'.PHP_EOL;
			
			$html .= '<script src="' . $this->htmlPath() . 'plugins/jquery-menu-editor/bs-iconpicker/js/iconset/iconset-fontawesome-4.2.0.min.js"></script>'.PHP_EOL;
        
			$html .= '<link rel="stylesheet" href="' . $this->htmlPath() . 'plugins/jquery-menu-editor/bs-iconpicker/css/bootstrap-iconpicker.min.css">'.PHP_EOL;
		}
		
		if ( ( $url->parameter('widgets') !== false ) && $this->getValue( 'enableWidgets' ) )
		{
			$html .= '<script>
			$(document).ready(function() {
			$(".btn-primary").on("click", function() {
				var tmp = [];
				$("div.list-item").each(function() {
					tmp.push( $(this).attr("data-id") );
				});
				$("#jswidgets").attr("value", tmp.join(",") );
				$("#jsform").submit();
			});
			});
			</script>';
		}
		
		return $html;
    }
	
	private function searchuuid( $key, $parent = true, $lang = '' )
    {
		if ( $key === '' )
            return;
		
		$found = array();
		
		$langData = $this->openDB( DB_LANGS );
		
		if ( empty( $lang ) )
		{
			foreach ( $langData as $la => $va )
			{
				foreach ( $va['translations'] as $uuid => $data )
				{
					if ( $parent )
					{
						if ( $data['parent'] === $key )
						{
							$found['name'] = $langData[$la]['name'];

							$found['locale'] = $langData[$la]['locale'];

							$found['code'] = $langData[$la]['code'];

							$found['lang'] = $la;
							
							$found['key'] = $data['key'];
							
							$found['parent'] = $data['parent'];

							break;
						}
					}
					else
					{
						if ( $data['key'] === $key )
						{
							$found['name'] = $langData[$la]['name'];

							$found['locale'] = $langData[$la]['locale'];

							$found['code'] = $langData[$la]['code'];

							$found['lang'] = $la;
							
							$found['key'] = $data['key'];
							
							$found['parent'] = $data['parent'];

							break;
						}
					}
				}
			}
		}
		else
		{
			if ( isset( $langData[$lang] ) )
			{
				foreach ( $langData[$lang]['translations'] as $uuid => $data )
				{
					if ( $parent )
					{
						if ( $data['parent'] === $key )
						{
							$found['name'] = $langData[$la]['name'];

							$found['locale'] = $langData[$la]['locale'];

							$found['code'] = $langData[$la]['code'];

							$found['lang'] = $la;
							
							$found['key'] = $data['key'];
							
							$found['parent'] = $data['parent'];

							break;
						}
					}
					else
					{
						if ( $data['key'] === $key )
						{
							$found['name'] = $langData[$la]['name'];

							$found['locale'] = $langData[$la]['locale'];

							$found['code'] = $langData[$la]['code'];

							$found['lang'] = $la;
							
							$found['key'] = $data['key'];
							
							$found['parent'] = $data['parent'];

							break;
						}
					}
				}
			}
		}
		
		return $found;
	}

    private function searchKey( $key, $filter = 'blogs' )
    {
        if ( $key === '' )
            return;

        $found = array();

        if ( $filter == 'blogs' )
        {
            $blogs = $this->blogs;

            if ( empty( $blogs ) )
                return;

            foreach ( $blogs as $blog => $val ) 
            {
                foreach ( $val['list'] as $k => $s )
                {
                   if ( $s == $key )
                   {
                        $found['name'] = $blogs[$blog]['name'];

                        $found['blog'] = $blog;

                        break;
                   }
                }
            }
        }
		
		elseif ( $filter == 'redirs' )
        {
			if ( !$this->getValue( 'enable-redirs' ) )
			   return;
		   
		    $redirs = $this->openDB ( DB_REDIRS );
			
			if ( !empty( $redirs ) )
			{
				foreach ( $redirs as $k => $s )
				{
					  if ( $s['oldUrl'] === $key )
					  {
						$found['key'] = $key;
						
						$found['id'] = $k;

						$found['oldUrl'] = $s['oldUrl'];
						
						$found['newUrl'] = $s['newUrl'];

						break;
					  }
				}
			}
		}
		
		elseif ( $filter == 'forums' )
        {
			if ( $this->getValue( 'enable-forum' ) === 'disable' )
			   return;
		   
			$forum = $this->getValue( 'enable-forum' );
			
			$blogs = $this->blogs;

            if ( empty( $blogs ) || !isset( $blogs[$forum] ) )
                return;
			
			$list = $blogs[$forum]['list'];
			
            if ( !empty( $list ) )
			{
				foreach ( $list as $k => $s )
				{
					  if ( $s == $key )
					  {
						$found['key'] = $key;

						$found['forum'] = $forum;
						//$found['parent'] = $topics[$topic]['list'][$s['parent']];

						break;
					  }
				}
			}
        }
		
		elseif ( $filter == 'topics' )
        {
            $topics = $this->openDB ( DB_TOPICS );

            if ( empty( $topics ) )
                return;

            foreach ( $topics as $topic => $val ) 
            {
				if ( !empty( $val['list'] ) )
				{
					foreach ( $val['list'] as $k => $s )
					{
					   if ( $s == $key )
					   {
							$found['key'] = $key;

							$found['topic'] = $topic;
							
							//$found['parent'] = $topics[$topic]['list'][$s['parent']];

							break;
					   }
					}
				}
            }
			/*
			if ( !empty( $found ) ) 
			{
				$langData = $this->openDB( DB_LANGS );

				if ( !empty( $langData ) )
				{
					foreach ( $langData as $lang => $val ) 
					{
						foreach ( $val['list'] as $k => $s )
						{
						   if ( $s == $key )
						   {
								$found['name'] = $langData[$lang]['name'];

								$found['locale'] = $langData[$lang]['locale'];

								$found['code'] = $langData[$lang]['code'];

								$found['lang'] = $lang;

								break;
						   }
						}
					}
				}
			}*/
        }

        elseif ( $filter == 'langs' )
        {

            $langData = $this->openDB( DB_LANGS );

            if ( empty( $langData ) )
                return;

            foreach ( $langData as $lang => $val ) 
            {
                foreach ( $val['list'] as $k => $s )
                {
                   if ( $s == $key )
                   {
                        $found['name'] = $langData[$lang]['name'];

                        $found['locale'] = $langData[$lang]['locale'];

                        $found['code'] = $langData[$lang]['code'];

                        $found['lang'] = $lang;

                        break;
                   }
                }
            }

        }
		
		elseif ( $filter == 'code' )
        {

            $langData = $this->openDB( DB_LANGS );

            if ( empty( $langData ) )
                return;

            foreach ( $langData as $lang => $val ) 
            {
                if ( $val['code'] == $key )
                {
                    $found['name'] = $langData[$lang]['name'];

                    $found['locale'] = $langData[$lang]['locale'];

                    $found['code'] = $langData[$lang]['code'];

                    $found['lang'] = $lang;

                    break;
                }
            }

        }
		
		elseif ( $filter == 'categories' )
        {

            $langData = $this->openDB( DB_LANGS );
			
			$blogs = $this->blogs;
			
			if ( !empty( $langData ) )
			{

				foreach ( $langData as $lang => $val ) 
				{
					if ( isset( $val['cats'] ) && !empty( $val['cats'] ) )
					{
						foreach ( $val['cats'] as $k => $s )
						{
						   if ( $s == $key )
						   {
								$found['name'] = $langData[$lang]['name'];

								$found['locale'] = $langData[$lang]['locale'];

								$found['code'] = $langData[$lang]['code'];

								$found['lang'] = $lang;

								break;
						   }
						}
					}
				}
			}
			
			if ( !empty( $blogs ) )
			{
				foreach ( $blogs as $blog => $val ) 
				{
					if ( isset( $val['cats'] ) && !empty( $val['cats'] ) )
					{
						foreach ( $val['cats'] as $k => $s )
						{
						   if ( $s == $key )
						   {
								$found['name'] = $blogs[$blog]['name'];

								$found['blog'] = $blog;

								break;
						   }
						}
					}
				}
			}

        }

        return $found;    
    }
			
	public function adminHead()
	{
		global $url;
		
		$html = '';
		
		if ( $url->parameter('topic') !== null )
		{
			
			$html .= '<link rel="stylesheet" type="text/css" href="' . $this->htmlPath() . 'plugins/easymde/css/bludit.css">'.PHP_EOL;
			
			$html .= '<link rel="stylesheet" type="text/css" href="' . $this->htmlPath() . 'plugins/easymde/css/easymde.min.css">'.PHP_EOL;
			
			$html .= '<script src="'.$this->htmlPath().'plugins/easymde/js/easymde.min.js"></script>';
			
		}
		
		if ( ( $this->getValue( 'enableMenu' ) === 'manual' ) && ( $url->parameter('menu') !== false ) )
		{
			$html .= '<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"/>'.PHP_EOL;
		}
		
		if ( ( $url->parameter('widgets') !== false ) && $this->getValue( 'enableWidgets' ) )
		{
			$html .= '<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>' . PHP_EOL;
			
			$html .= '<script>
				$(function() {
					$("#sortable").sortable();
					$("#sortable").disableSelection();
				});
			</script>';
			
			$html .= '<style id="sort-list-widget">.flex{-webkit-box-flex:1;-ms-flex:1 1 auto;flex:1 1 auto}@media (max-width:991.98px){.padding{padding:1.5rem}}@media (max-width:767.98px){.padding{padding:1rem}}.padding{padding:5rem}.card{background:#fff;border-width:0;border-radius:.25rem;box-shadow:0 1px 3px rgba(0,0,0,.05);margin-bottom:1.5rem}.card{position:relative;display:flex;flex-direction:column;min-width:0;word-wrap:break-word;background-color:#fff;background-clip:border-box;border:1px solid rgba(19,24,44,.125);border-radius:.25rem}.list-item{position:relative;display:-ms-flexbox;display:flex;-ms-flex-direction:column;flex-direction:column;min-width:0;word-wrap:break-word}.list-item.block .media{border-bottom-left-radius:0;border-bottom-right-radius:0}.list-item.block .list-content{padding:1rem}.w-40{width:40px!important;height:40px!important}.avatar{position:relative;line-height:1;border-radius:500px;white-space:nowrap;font-weight:700;border-radius:100%;display:-ms-flexbox;display:flex;-ms-flex-pack:center;justify-content:center;-ms-flex-align:center;align-items:center;-ms-flex-negative:0;flex-shrink:0;border-radius:500px;box-shadow:0 5px 10px 0 rgba(50,50,50,.15)}.avatar img{border-radius:inherit;width:100%}.gd-primary{color:#fff;border:none;background:#448bff linear-gradient(45deg,#448bff,#44e9ff)}.flex{-webkit-box-flex:1;-ms-flex:1 1 auto;flex:1 1 auto}.text-color{color:#5e676f}.text-sm{font-size:.825rem}.h-1x{height:1.25rem;overflow:hidden;display:-webkit-box;-webkit-line-clamp:1;-webkit-box-orient:vertical}.no-wrap{white-space:nowrap}.list-row .list-item{-ms-flex-direction:row;flex-direction:row;-ms-flex-align:center;align-items:center;padding:.75rem .625rem}.list-item{position:relative;display:-ms-flexbox;display:flex;-ms-flex-direction:column;flex-direction:column;min-width:0;word-wrap:break-word}.list-row .list-item>*{padding-left:.625rem;padding-right:.625rem}.dropdown{position:relative}a:focus,a:hover{text-decoration:none}list-item{background:#fff}</style>';
		}
		
		return $html;
	}
	
	public function getPreviousNextURL( $key = '', $lang = '', $blog = '' )
	{
		if ( empty( $key ) )
			return;
			
		$keys = array();
		
		$uri = $this->uri;
		
		if ( $uri['whereAmI'] !== 'page' )
			return;
			
		if ( !empty( $lang ) )
		{
			if ( !$this->getValue( 'enable-langs' ) )
				return;
				
			$data = $this->openDB( DB_LANGS );
			
			if ( empty ( $data ) || !isset( $data[$lang] ) )
				return;
				
			$posts = $this->openDB( DB_PAGES );
			
			//If page doens't exists or is not published, don't continue
			if ( !isset( $posts[$key] ) || ( $posts[$key]['type'] !== 'published' ) )
				return;
			
			$blogs = $this->blogs;
					
			$temp = array();
			
			$list = $data[$lang]['list'];
			
			$position = $posts[$key]['position'];
			
			foreach ( $list as $p )
			{
				$search = $this->searchKey( $p );
				
				$searchLang = $this->searchKey( $p, 'langs' );
				
				$searchTopic = $this->searchKey( $p, 'topics' );
				
				$searchForum = $this->searchKey( $p, 'forums' );
				
				if ( !empty( $search ) && !empty( $blogs[$search['blog']]['disable'] ) ) 
					continue;
				
				if ( empty( $searchLang ) ) 
					continue;
				
				//Make sure we don't have any topics in here
				if ( !empty( $searchTopic ) ) 
					continue;
				
				//And Forums
				if ( !empty( $searchForum ) ) 
					continue;
				
				if ( $posts[$p]['type'] !== 'published' )
					continue;
				
				$temp[] = array( 'key' => $p, 'position' => $posts[$p]['position'] );
			}
				
			array_multisort( array_column( $temp, 'position' ), SORT_ASC, SORT_NUMERIC, $temp );// SORT_NUMERIC 

			$key = array_search( $position, array_column( $temp, 'position' ) );
			
			$keys['next'] = ( ( ( $key !== false ) && ( $key > 0 ) && isset( $temp[$key+1] ) ) ? $temp[$key+1]['key'] : '' );
			
			$keys['prev'] = ( ( ( $key !== false ) && ( $key > 0 ) && isset( $temp[$key-1] ) ) ? $temp[$key-1]['key'] : '' );
			
			unset( $temp ) ;
		}
		
		elseif ( !empty( $blog ) )
		{
			$blogs = $this->blogs;
			
			if ( empty ( $blogs ) || !isset( $blogs[$blog] ) )
				return;
				
			$posts = $this->openDB( DB_PAGES );
			
			//If page doens't exists or is not published, don't continue
			if ( !isset( $posts[$key] ) || ( $posts[$key]['type'] !== 'published' ) )
				return;

			$temp = array();
			
			$list = $blogs[$blog]['list'];
			
			$position = $posts[$key]['position'];
			
			foreach ( $list as $p )
			{
				if ( !isset( $posts[$p] ) )
					continue;
				
				$search = $this->searchKey( $p );
				
				if ( !empty( $search ) && !empty( $blogs[$search['blog']]['disable'] ) ) 
					continue;
				
				$searchLang = $this->searchKey( $p, 'langs' );
				
				$searchTopic = $this->searchKey( $p, 'topics' );
				
				$searchForum = $this->searchKey( $p, 'forums' );
				
				//Sorry, we don't want you here
				if ( !empty( $lang ) && empty( $searchLang ) )
					continue;
				
				//Sorry, we don't want you here either
				elseif ( empty( $lang ) && !empty( $searchLang ) )
					continue;
				
				//And you
				elseif ( !empty( $searchTopic ) ) 
					continue;
					
				//And... you
				elseif ( !empty( $searchForum ) ) 
					continue;
				
				$temp[] = array( 'key' => $p, 'position' => $posts[$p]['position'] );
			}
				
			array_multisort( array_column( $temp, 'position' ), SORT_ASC, SORT_NUMERIC, $temp );// SORT_NUMERIC 

			$key = array_search( $position, array_column( $temp, 'position' ) );
			
			$keys['next'] = ( ( ( $key !== false ) && ( $key > 0 ) && isset( $temp[$key+1] ) ) ? $temp[$key+1]['key'] : '' );
			
			$keys['prev'] = ( ( ( $key !== false ) && ( $key > 0 ) && isset( $temp[$key-1] ) ) ? $temp[$key-1]['key'] : '' );
			
			unset( $temp ) ;
		}
		else
		{
			//Don't bother to search for next or previous key, let's use the bludit's functions
			//Don't worry about page slugs here, it will be properly redirected if we have enable it
			global $page;
			
			$keys['next'] = ( !empty( $page->nextKey() ) ? $page->nextKey() : '' );
			
			if ( !empty( $keys['next'] ) )
			{
				$searchTopic = $this->searchKey( $keys['next'], 'topics' );
				
				$searchForum = $this->searchKey( $keys['next'], 'forums' );
				
				//We don't want any thread or forum in here
				if ( !empty( $searchTopic ) || !empty( $searchForum ) )
					$keys['next'] = '';
			}
			
			$keys['prev'] = ( !empty( $page->previousKey() ) ? $page->previousKey() : '' );
			
			if ( !empty( $keys['prev'] ) )
			{
				$searchTopic = $this->searchKey( $keys['prev'], 'topics' );
				
				$searchForum = $this->searchKey( $keys['prev'], 'forums' );
				
				//We don't want any thread or forum in here
				if ( !empty( $searchTopic ) || !empty( $searchForum ) )
					$keys['prev'] = '';
			}
		}
		
		return $keys;
	}

	public function getLangsList( $lang = '', $blog = '' )
    {
		
		$array = array();
		
		$data = $this->openDB( DB_LANGS );
		
		$defaultLang = $this->getValue( 'default-lang' );
			
		if ( empty ( $data ) || empty( $defaultLang ) )
			return;
		
		//If we are on a sub-lang, then act accordingly 
		if ( !empty( $lang ) && $this->getValue( 'enable-langs' ) )
		{
			if ( !isset( $data[$lang] ) )
				return;
			
			$url = $this->site_url() . $lang . ( !empty( $blog ) ? '/' . $blog : '' ) ;
			
			$array[$lang] = array( 'name' => $data[$lang]['name'], 'url' => $url, 'current' => true );
			
			foreach ( $data as $key => $langData )
			{
				if ( $key == $lang )
					continue;
				
				$url = $this->site_url() . $key . ( !empty( $blog ) ? '/' . $blog : '' );

				$array[$key] = array( 'name' => $langData['name'], 'url' => $url, 'current' => false );
			}
			
			$la = $defaultLang['locale'];
			
			$lan = $defaultLang['lang'];
			
			$array[$la] = array( 'name' => $lan, 'url' => $this->site_url(), 'current' => false );
		}
		
		//We are on main lang then
		else
		{
			$la = $defaultLang['locale'];
			
			$lan = $defaultLang['lang'];
			
			$array[$la] = array( 'name' => $lan, 'url' => $this->site_url() . ( !empty( $blog ) ? $blog : '' ), 'current' => true );
			
			foreach ( $data as $key => $langData )
			{
				$url = $this->site_url() . $key . ( !empty( $blog ) ? '/' . $blog : '' );

				$array[$key] = array( 'name' => $langData['name'], 'url' => $url, 'current' => false );
			}
		}
		
		return $array;
	}

	public function getPagesList( $lang = '' )
    {
		global $pages;
		
		if ( !empty( $lang ) )
		{
			$data = $this->openDB( DB_LANGS );
			
			if ( empty ( $data ) || !isset( $data[$lang] ) )
				return;
			
			$list = $data[$lang]['list'];
		}
		else
			$list = $pages->getList( 1, -1, false, true, false, false, false );
		
		$posts = $this->openDB( DB_PAGES );
		
		if ( empty( $list ) )
			return;
		
		$pageList = array();
		
		$content = array();
		
		foreach( $list as $p )
		{
			if ( $posts[$p]['type'] !== 'static' )
				continue;
			
			if ( !isset( $posts[$p] ) )
				continue;
			
			if ( empty( $lang ) && !empty( $this->searchKey( $p, 'langs' ) ) )
				continue;
			
			try 
			{
				$page = new Page( $p );
				
				if ( $page )
				{
					if ( $page->noindex() )
						continue;
					
					$key = '';
					//$url = $this->site_url();
				
					if ( !$this->getValue( 'hide-slug' ) && !empty( $lang ) )
					{
						$key .= $lang . '/';
					}
					
					$key .= $p;
					
					$page->setField('key', $key);
					
					$pageList[$p] = $page;
					
					//array_push( $pageList, $page );
					
				}
			}
			catch (Exception $e) 
				{
					// Continue
				}
		}

		//array_multisort( array_column( $pageList, 'date' ), SORT_DESC, SORT_LOCALE_STRING, $pageList );// SORT_NUMERIC 
		
		unset( $posts, $data, $list );
				
		return $pageList;
	}
	
    public function getCategoriesList( $blog = '', $lang = '' )
    {
		global $categories;
				
		$cats = array();
		
        if ( !empty( $lang ) )
		{
			$data = $this->openDB( DB_LANGS );
			
			if ( empty ( $data ) || !isset( $data[$lang] ) )
				return;
			
			$list = $data[$lang]['cats'];
		}
				
		elseif ( !empty( $blog ) )
		{
			$data = $this->blogs;
			
			//Nothing to do here if we don't have any page
			if ( empty ( $data ) || !isset( $data[$blog] ) )
				return;
			
			$list = ( ( isset( $data[$blog]['cats'] ) && !empty( $data[$blog]['cats'] ) ) ? $data[$blog]['cats'] : array() );
		}
		
		if ( !empty( $list ) && ( !empty( $blog ) || !empty( $lang ) ) ) 
		{
			foreach ( $categories->db as $key => $fields ) 
			{
				if ( !in_array( $key, $list ) )
					continue;
				
				$url = $this->site_url();
				
				if ( !$this->getValue( 'hide-slug' ) )
				{
					if ( !empty( $lang ) )
					{
						$url .= $lang . '/';
					}
					
					if ( !empty( $blog ) )
					{
						$url .= $blog . '/';
					}
				}
				
				$url .= 'category/' . $key . '/';
				
				$cats[$key] = array( 'name' => $fields['name'], 'url' => $url );
			}
			
		}
		elseif ( empty( $blog ) && empty( $lang ) )
		{
						
			foreach ( $categories->db as $key => $fields ) 
			{
				if ( $this->searchKey( $key, 'categories' ) )
					continue;
				
				$cats[$key] = array( 'name' => $fields['name'], 'url' => DOMAIN_CATEGORIES . $key );
			}
		}
		
		return $cats;
    }
			
	public function getHomeList( $category = '' )
    {
		global $pages;
		
		//We need them all. I use this function to get the posts sorted by date and avoid use more arrays to do that	
        $list = $pages->getList( 1, -1, true, false, true, false, false );
		
		$posts = array();
		
		$catList = array();
		
		if ( !empty( $category ) )
		{
			//First search if the category is on the correct lang
			$searchLang = $this->searchCategory ( $category, true, false );
			
			if ( empty( $searchLang ) )
			{
				global $categories;
				
				if ( isset( $categories->db[$category] ) && !empty( $categories->db[$category]['list'] ) )
				{
					$catList = $categories->db[$category]['list'];
				}
			}
			
			//If we asked for a category, but this category has no post, return just an empty array
			if ( empty( $catList ) )
				return $posts;
		}
		
        foreach ( $list as $pageKey )
        {
			$searchKey = $this->searchKey( $pageKey );
			
            $searchLang = $this->searchKey( $pageKey, 'langs' );
			
			if ( !empty( $searchKey ) )
			{
				continue;
			}
			
			if ( !empty( $searchLang ) )
			{
                continue;
			}
			
			if ( !empty( $catList ) && !in_array( $pageKey, $catList ) )
				continue;
			
			array_push( $posts, $pageKey ) ;
		}
				
		return $posts;
	}
	
	public function getList( $lang = '', $blog = '', $cat = '', $numItems = 0 )
    {
		if ( !empty( $lang ) && empty( $blog ) && empty( $cat ) )
		{
			$data = $this->openDB( DB_LANGS );
			
			if ( empty ( $data ) || !isset( $data[$lang] ) )
				return;
			
			$list = $data[$lang]['list'];
		}
				
		elseif ( !empty( $blog ) && empty( $cat ) )
		{
			$data = $this->blogs;
			
			//Nothing to do here if we don't have any page or the blog doesn't exists
			if ( empty ( $data ) || !isset( $data[$blog] ) || empty( $data[$blog]['list'] ) )
				return;
			
			$list = $data[$blog]['list'];
		}
		elseif ( !empty( $cat ) )
		{
			global $categories;
			
			if ( !isset( $categories->db[$cat] ) || empty( $categories->db[$cat]['list'] ) )
				return;
			
			$list = $categories->db[$cat]['list'];
		}
			
		if ( empty( $list ) )
			return;
		
		$posts = $this->openDB( DB_PAGES );
		
		$pageList = array();
		
		$listKey = array();
				
		foreach( $list as $p )
		{
			
			if ( !isset( $posts[$p] ) )
				continue;
			
			if ( $posts[$p]['type'] !== 'published' )
				continue;
			
			$searchLang = $this->searchKey( $p, 'langs' );
			
			$search = $this->searchKey( $p );
			
			if ( empty( $lang ) && !empty( $searchLang ) )
				continue;
			
			if ( !empty( $lang ) && empty( $searchLang ) )
				continue;
			
			if ( empty( $blog ) && !empty( $search ) )
				continue;
			
			if ( !empty( $blog ) && empty( $search ) )
				continue;
			
			$pageList[$p] = array( 'date' => $posts[$p]['date'] );
		}
		
		//function custom_sort( $a,$b ) { return $a['date'] < $b['date']; };
		//usort($pageList, "custom_sort_price");
		
		array_multisort( array_column( $pageList, 'date' ), SORT_DESC, SORT_LOCALE_STRING, $pageList );// SORT_NUMERIC 
		
		unset( $posts, $data, $list, $listKey );
		
		if ( $numItems )
			$pageList = array_slice( $pageList, 0, $numItems );
		
		return $pageList;
    }
	
	public function buildAdminList ( $nav = 1, $type = 'published', $blog = '', $lang = '' )
	{
		$posts = $this->openDB( DB_PAGES );
		
		$content = array();
		
		$items = array();
		
		$page = ( ( is_numeric( $nav ) && $nav > 0 ) ? $nav : 1 );
		
		$from = ( ( $page * ITEMS_PER_PAGE_ADMIN ) - ITEMS_PER_PAGE_ADMIN );
		
		if ( $type == 'topics' )
		{
			$topics = $this->openDB( DB_TOPICS );
		
			if ( empty( $topics ) )
				return;
			
			foreach ( $topics as $cat => $topic )
			{
				if ( empty( $topic['list'] ) )
					continue;
				
				foreach ( $topic['list'] as $p )
				{
					$items[$p] = array( 'forum' => $posts[$cat]['title'], 'forumKey' =>$cat, 'date' => $posts[$p]['date'], 'title' => $posts[$p]['title'] );
				}
			}

		}
		
		elseif ( $type == 'users' )
		{
			$topics = $this->openDB( DB_TOPICS );
		
			if ( empty( $topics ) )
				return;
			
			foreach ( $topics as $cat => $topic )
			{
				if ( empty( $topic['list'] ) )
					continue;
				
				foreach ( $topic['list'] as $p )
				{
					$items[$p] = array( 'forum' => $posts[$cat]['title'], 'forumKey' =>$cat, 'date' => $posts[$p]['date'], 'title' => $posts[$p]['title'] );
				}
			}

		}
		
		elseif ( $type == 'redirs' )
		{
			if ( !$this->getValue( 'enable-redirs' ) )
				return;
			
			$redirs = $this->openDB( DB_REDIRS );
		
			if ( empty( $redirs ) )
				return;
			
			foreach ( $redirs as $p => $redir )
			{
				$items[$p] = array( 'oldUrl' => $redir['oldUrl'], 'newUrl' => $redir['newUrl'], 'views' => $redir['views'] );
			}

		}
		
		else
		{
			
			if ( $type == 'forum' )
				$blog = $this->getValue( 'enable-forum' );
			
			if ( $type == 'shop' )
				$blog = $this->getValue( 'enable-shop' );
						
			foreach( $posts as $p => $x )
			{
				if ( ( $type == 'published' ) && ( $posts[$p]['type'] !== 'published' ) )
					continue;
				
				if ( ( $type == 'static' ) && ( $posts[$p]['type'] !== 'static' ) )
					continue;
				
				if ( ( $type == 'sticky' ) && ( $posts[$p]['type'] !== 'sticky' ) )
					continue;
				
				if ( ( $type == 'scheduled' ) && ( $posts[$p]['type'] !== 'scheduled' ) )
					continue;
				
				if ( ( $type == 'draft' ) && ( $posts[$p]['type'] !== 'draft' ) )
					continue;
				
				if ( ( $type == 'autosave' ) && ( $posts[$p]['type'] !== 'autosave' ) )
					continue;
						
				$searchLang = $this->searchKey( $p, 'langs' );
					
				$search = $this->searchKey( $p );
				
				$searchTopic = $this->searchKey( $p, 'topics' );
				
				//$searchStore = $this->searchKey( $p, 'topics' );

				if ( empty( $lang ) && !empty( $searchLang ) )
					continue;
					
				if ( !empty( $lang ) && empty( $searchLang ) )
					continue;
				
				if ( !empty( $lang ) && !empty( $searchLang ) && ( $searchLang['lang'] !== $lang ) )
					continue;
					
				if ( empty( $blog ) && !empty( $search ) )
					continue;
					
				if ( !empty( $blog ) && empty( $search ) )
					continue;
				
				if ( !empty( $blog ) && !empty( $search ) && ( $search['blog'] !== $blog ) )
					continue;
				
				if ( ( $type == 'forum' ) && !empty( $searchTopic ) )
					continue;
				
				if ( ( $type == 'shop' ) && empty( $search ) )
					continue;
					
				$items[$p] = array( 'date' => $posts[$p]['date'], 'title' => $posts[$p]['title'] );
			}
			
			array_multisort( array_column( $items, 'date' ), SORT_DESC, SORT_LOCALE_STRING, $items );
		}
		
		$totalItems = count( $items );
		
		if ( empty( $totalItems ) )
			return $content;
			
		$totalPages = ceil( $totalItems / ITEMS_PER_PAGE_ADMIN );
				
		$items = array_slice( $items, $from, ITEMS_PER_PAGE_ADMIN );
		
		$url = $this->site_url() . 'admin/content' . ( !empty( $type ) ? '?type=' . $type : '' );
		
		$url .= ( !empty( $blog ) ? '&blog=' . $blog : '' );
		
		$url .= ( !empty( $lang ) ? '&lang=' . $lang : '' );
		
		$content['prev_page'] = ( ( $page > 1 ) ? ( $page - 1 ) : 0 );
		$content['next_page'] = ( ( $page < $totalPages ) ? ( $page + 1 ) : 0 );
		$content['prev_url'] = ( $content['prev_page'] ? $url . '&pg=' . $content['prev_page'] : 0 );
		$content['next_url'] = ( $content['next_page'] ? $url . '&pg=' . $content['next_page'] : 0 );
		$content['first_page'] = ( ( $page > 1 ) ? $url . '&pg=1' : 0 );
		$content['last_page'] = ( ( $totalPages > 1 ) ? $url . '&pg=' . $totalPages : 0 );
		
		$content['list'] = $items;
				
		return $content;
	}
	
	public function adminBodyBegin()
	{
		global $url, $L;

		$html = '';
		
		$storeData = $this->getValue( 'store-settings' );
		
		$forumData = $this->getValue( 'forum-settings' );
		
		if ( !empty( $url->parameter('product') ) && ( $this->getValue( 'enable-shop' ) === 'disable' ) )
			$html .= '<div class="alert alert-warning" role="alert">' . $L->get( 'no-shop-enabled-error' ) . '</div>';
			
		if ( !empty( $url->parameter('product') ) && empty( $storeData ) )
			$html .= '<div class="alert alert-warning" role="alert">' . $L->get( 'no-shop-settings-error' ) . '</div>';
			
		if ( !empty( $url->parameter('forum') ) && empty( $forumData ) && ( strpos( $url->slug(), 'new-content' ) !== false ) )
			$html .= '<div class="alert alert-warning" role="alert">' . $L->get( 'no-forum-settings-error' ) . '</div>';
			
		if ( !empty( $url->parameter('topic') ) && empty( $forumData ) )
			$html .= '<div class="alert alert-warning" role="alert">' . $L->get( 'no-forum-settings-topic-error' ) . '</div>';
		
		return $html;
	}
	
    public function buildHomepage( $blog = '', $lang = '', $category = '' )
    {
        global $url, $site;
		
		$posts = array();
		
		$LangDetails = '';
		
		$uri = $this->uri;

		$nav = $url->parameter('page');
		
		$itemsPerPage = $site->itemsPerPage();

		$pagenum = ( ( is_numeric( $nav ) && $nav > 0 ) ? $nav : 1 );
		
		$from = ( ( $pagenum * $itemsPerPage ) - $itemsPerPage );
        
        //$content = array();
		
		//We are in forum here. So we have to make a few things first
		if ( !empty( $uri['postType'] ) && ( $uri['postType'] == 'forum' ) )
		{
			global $categories;
			
			$lang = $uri['lang'];
			
			$forumData = $this->getValue( 'forum-settings' );
			
			$totalItems = 0;
			
			if ( !empty( $forumData ) && isset( $forumData['topics-per-page'] ) && !empty( $forumData['topics-per-page'] ) )
				$itemsPerPage = $forumData['topics-per-page'];
			
			$from = ( ( $pagenum * $itemsPerPage ) - $itemsPerPage );
			
			//$forumData = $this->getValue( 'forum-settings' );
			
			//First, make sure we are in the homepage
			if ( empty( $category ) )
			{
				$blogs = $this->blogs;
				
				$forumBlog = $uri['blog'];
				
				$catList = $blogs[$forumBlog]['cats'];
				
				sort($catList);
			
				if ( empty( $catList ) )
				{
					//We have nothing to work with. Return an empty array
					Paginator::set('numberOfPages', 0);
					return $content;
				}

				$catDB = $categories->db;
				
				$totalItems = count( $catList );
				
				$totalPages = ceil( $itemsPerPage / $totalItems );
				
				$catList = array_slice( $catList, $from, $itemsPerPage);
				
				//$canBrowse = true;
				
				$user = $this->getUserDetails();
				
				$content = array( 
								'canBrowse' => $user['canBrowse'],
								'cats' => array()
							);
							
				$posts = $this->openDB( DB_PAGES );
				
				foreach ( $catList as $cat )
				{
					$searchCat = $this->searchCategory ( $cat, true );
					
					if ( empty( $lang ) && !empty( $searchCat ) )
						continue;
					
					if ( !empty( $lang ) && empty( $searchCat ) )
						continue;
					
					$catPageList = $catDB[$cat]['list'];
					
					$catUrl = $this->site_url();
					
					if ( !empty( $uri['lang'] ) )
						$catUrl .= $uri['lang'] . '/';
					
					if ( !$this->getValue( 'hide-slug' ) )
						$catUrl .= $uri['blog'] . '/';
					
					$catUrl .= 'category/' . $cat;
					
					$content['cats'][$cat] = array(
										'title' => $catDB[$cat]['name'],
										'descr' => $catDB[$cat]['description'],
										'items' => count( $catList ),
										'url' => $catUrl,
										'list' => array()
										);
										
					if ( !empty( $catPageList ) )
					{
						foreach ( $catPageList as $frm )
						{							
							if ( isset( $posts[$frm] ) )
							{
								$forumUrl = $this->site_url();
								
								if ( !$this->getValue( 'hide-slug' ) )
								{
									if ( !empty( $uri['lang'] ) )
										$forumUrl .= $uri['lang'] . '/';
					
										$forumUrl .= $uri['blog'] . '/';
								}
					
								$forumUrl .= $frm;
								
								$topics = $this->getTopics( $frm );
								
								$content['cats'][$cat]['list'][$frm] = array( 'title' => $posts[$frm]['title'],
													'descr' => $posts[$frm]['description'],
													'numTopics' => ( !empty( $topics ) ? count ( $topics ) : 0 ),
													'numPosts' => 0,
													'url' => $forumUrl
													);
							}
						}
					}
				}
				
				//Unset the posts to save some memory
				unset( $posts );
			}
			
			else
			{
				
				
			}
			
		}
		
		elseif ( !empty( $uri['postType'] ) && ( $uri['postType'] == 'shop' ) )
		{
			$content = array();
			
			$s = $this->getList( $lang, $blog, $category );
							
			if ( !empty( $s ) )
			{
				$posts += $s;
					
				unset( $s ) ;
			}
			
			if ( !empty( $posts ) )
			{
				$format = $site->dateFormat();
												
				if ( !empty( $uri['lang'] ) ) 
				{
					$langs = $this->openDB( DB_LANGS );
								
					if ( !empty( $langs[$uri['lang']]['dateFormat'] ) )
						$format = $langs[$uri['lang']]['dateFormat'];
					
					unset( $langs );
				}
				
				$pagesDB = $this->openDB( DB_PAGES );
				
				$catDB = $this->openDB( DB_CATEGORIES );
				
				$totalItems = count( $posts );
			
				$totalPages = ceil( $itemsPerPage / $totalItems );
			
				$pages = array_slice( $posts, $from, $itemsPerPage);
				
				foreach ( $pages as $key => $post )
				{
					if ( !isset( $pagesDB[$key] ) )
						continue;
					
					$date = date( $format, strtotime( $pagesDB[$key]['date'] ) );
					
					$file = PATH_PAGES . $key . DS . 'values.php';
					
					$uuid = $pagesDB[$key]['uuid'];
					
					if ( !empty( $pagesDB[$key]['coverImage'] ) )
						$image = $this->site_url() . 'bl-content/uploads/pages/' . $uuid . '/' . $pagesDB[$key]['coverImage'];
					else
						$image = $this->htmlPath() . 'files/noimage.png';
					
					$values = array();
					
					if ( file_exists ( $file ) )
						$values = $this->openDB( $file );
					
					$catKey = $pagesDB[$key]['category'];
					
					$cat = ( !empty( $pagesDB[$key]['category'] ) ? $catDB[$pagesDB[$key]['category']] : '' );
					
					$catURL = $prodURL = $this->site_url();
					
					if ( !$this->getValue( 'hide-slug' ) )
					{
						if ( !empty( $lang ) )
						{
							$catURL .= $lang . '/';
							
							$prodURL .= $lang . '/';
						}
						
						if ( !empty( $blog ) )
						{
							$catURL .= $blog . '/';
							
							$prodURL .= $blog . '/';
						}
					}

					$catURL .= 'category/' . $catKey;
					
					$prodURL .= $key;
					
					//Don't add a link to cart, if the product is affilliate
					$addToCartUrl = ( ( !empty( $values ) && ( $values['type'] == 'normal' ) ) ? $prodURL . '?add=' . $uuid : '' );
					
					$priceFormatted = ( ( !empty( $values ) && !empty( $values['price-sale'] ) ) ? $this->formatPrice( $values['price-sale'] ) : '' );
					
					$priceRegFormatted = ( ( !empty( $values ) && !empty( $values['price-regular'] ) ) ? $this->formatPrice( $values['price-regular'] ) : '' );
					
					//$currency = $this->getCurrencyData();
					
					//the product data as array
					$content[$key] = array(
										'title' => $pagesDB[$key]['title'],
										'description' => $pagesDB[$key]['description'],
										'date' => $date,
										'uuid' => $uuid,
										'priceNormal' => $priceFormatted,
										'priceReg' => $priceRegFormatted,
										//'currency' => $currency,
										'addToCartUrl' => $addToCartUrl,
										'image' => $image,
										'permalink' => $prodURL,
										'categoryKey' => $catKey,
										'categoryURL' => $catURL,
										'category' => ( $cat ? $cat['name'] : '' ),
										'values' => $values
									);
				}
			}
			else
			{
				$totalItems = 0;
			
				$totalPages = 0;
			
				$pages = 0;
			}
			
		}
		
		else
		{
			####################################################
			if ( !empty( $blog ) )
			{
				$s = $this->getList( $lang, $blog, $category );
							
				if ( !empty( $s ) )
				{
					$posts += $s;
					
					unset( $s ) ;
				}

			}
		
			elseif ( !empty( $lang ) && empty( $blog ) )
			{
				$s = $this->getList( $lang, '', $category );
		
				if ( !empty( $s ) )
				{
					$posts += $s;
					
					unset( $s ) ;
				}
				
				$LangDetails = $this->getLangDetails( $lang );
				
			}
		
			if ( empty( $blog ) && empty( $lang ) )
			{
				$s = $this->getHomeList( $category );

				if ( !empty( $s ) )
				{
					$posts += $s;
					
					unset( $s ) ;
				}
			}
			else
				$posts = array_keys( $posts );
		
			//If there are no posts, return an empty array and set the Paginator to 0
			if ( empty( $posts ) )
			{
				//Paginator::set('numberOfItems', 0);
				Paginator::set('numberOfPages', 0);
				return $posts;
			}
			
			$content = array();
			
			####################################################
			
			$totalItems = count( $posts );
			
			$totalPages = ceil( $itemsPerPage / $totalItems );
			
			$pages = array_slice( $posts, $from, $itemsPerPage);

			foreach ( $pages as $pageKey )
			{
				$page = buildPage( $pageKey );
					
				if ( $page )
				{
					$key = '';
					
					if ( !$this->getValue( 'hide-slug' ) )
					{
						if ( !empty( $lang ) )
						{
							$key .= $lang . '/';
						}
						
						if ( !empty( $blog ) )
						{
							$key .= $blog . '/';
						}
					}

					$key .= $pageKey;
					
					if ( !$this->getValue( 'hide-slug' ) )
						$page->setField('key', $key); //$page->setField('content', $blog . '/' . $pageKey);
					
					//$page->setField('dateRaw', date( 'm/d/y', strtotime( $page->dateRaw() ) ) );
					
					array_push( $content, $page );
				}
			}
		}
		
		Paginator::set('itemsPerPage', $itemsPerPage);

		// Amount of items
		Paginator::set('numberOfItems', $totalItems);

		// Amount of pages
		$numberOfPages = (int) max( ceil( $totalItems / $itemsPerPage ), 1 ); //$numberOfPages = ceil($all / $itemsPerPage);
		Paginator::set('numberOfPages', $numberOfPages);

		// TRUE if exists a next page to show
		$showNext = $numberOfPages > $pagenum;
		Paginator::set('showNext', $showNext);

		// TRUE if exists a previous page to show
		$showPrev = $pagenum > Paginator::firstPage();
		Paginator::set('showPrev', $showPrev);

		// TRUE if exists a next and previous page to show
		$showNextPrev = $showNext && $showPrev;
		Paginator::set('showNextPrev', $showNextPrev);

		// Integer with the next page
		$nextPage = max(0, $pagenum+1);
		Paginator::set('nextPage', $nextPage);

		// Integer with the previous page
		$prevPage = min($numberOfPages, $pagenum-1);
		Paginator::set('prevPage', $prevPage);
		                    
        //return ( !empty( $content ) ? $content : null );
		
		return $content;
    }
	
	public function userRoles ()
	{
		$roles = array(
						'shop_manager' => 'Shop manager',
						'customer' => 'Customer',
						'subscriber' => 'Subscriber',
						'contributor' => 'Contributor',
						'author' => 'Author',
						'editor' => 'Editor',
						'administrator' => 'Administrator'		
		);
		
		return $roles;
	}
	
	public function setSlug ( $slug = '', $whereAmI = 'home', $notFound = false )
	{
		global $url;
		
		if ( empty( $notFound ) )
		{
			$url->setSlug( $slug );
            $url->setWhereAmI( $whereAmI );

            $url->setHttpCode();
            $url->setHttpMessage(); 
		}
		else
			$url->setNotFound();
	}
	
	public function getFirstPage( $lang ) 
	{
		$page = '';
		
		$uri = $this->uri;
		
		if ( $lang !== '' )
		{
			$langs = $this->openDB( DB_LANGS );
		
			if ( !isset( $langs[$lang] ) || ( $langs[$lang]['homePage'] === '' ) )
				return false;
			
			$pageSlug = $langs[$lang]['homePage'];
			
			$page = buildPage( $pageSlug ) ;
		}
		else
		{
			global $site;
			
			$pageSlug = $site->homepage();
			
			$page = buildPage( $pageSlug );
		}
		
		return $page;
	}
	
	public function contentAuto()
	{
		global $pages;
		
		require ( $this->phpPath() . 'plugins' . DS . 'simplepie' . DS . 'autoloader.php' );
		
		$auto = $this->openDB( DB_AUTO );
		
		$cacheDir = PATH_PLUGINS_DATABASES . 'sub-blogs' . DS . 'cache' . DS;
		
		if ( !is_dir( $cacheDir ) )
			mkdir( $cacheDir, 0777 );
		
		if ( !empty( $auto ) )
		{
			$change = 0;
			
			$added = 0;
				
			foreach ( $auto as $key => $row )
			{
				if ( $row['disabled'] )
					continue;
				
				$feed = new SimplePie();

				$feed->set_feed_url( $row['source'] );
				
				$maxItems = ( $row['maxPosts'] ? $row['maxPosts'] : 15 );
				
				$oldPosts = ( $row['oldPosts'] ? ( $row['oldPosts'] * 86400 ) : 0 );

				$feed->set_item_limit( $row['maxPosts'] );
				
				if ( $this->getValue( 'enableAutoContentCache' ) )
				{
					$feed->set_cache_location( $cacheDir );
					$feed->set_cache_duration( 86400 );
				}
				
				$feed->init();
				$feed->handle_content_type();
								
				if ( $feed->get_items() )
				{
					foreach ( $feed->get_items() as $item )
					{
						$img = '';
						
						$date = $item->get_date( DB_DATE_FORMAT );
						
						$dateUnix = strtotime( $date );
						
						if ( $oldPosts && ( $oldPosts > ( time() - $oldPosts ) ) )
							continue;
					
						if ( $enclosure = $item->get_enclosure() )
						{
							$img = $enclosure->get_link();
						}
						
						else
						{
							$imgs = $this->getImage( $item->get_description() );
							
							if ( $row['skipnoimages'] && empty( $imgs ) )
								continue;
							
							if ( $row['firstCover'] )
								$img = $imgs;
						}

						$url = $item->get_permalink();

						$uuid = md5( $url );
						
						$title = htmlspecialchars_decode( html_entity_decode( $item->get_title() ) );
						
						if ( !empty( $row['sourceWords'] ) && $this->checkSkipWords( $title, $row['sourceWords'] ) )
							continue;
						
						//Search if we have this post already
						if ( $this->searchIdPost( $uuid ) )
							continue;
						
						if ( $source = $item->get_source() )
						{
							$sourceName = $source->get_title();
						}
						else
							$sourceName = get_HostName ( $url );
							
						$descr = generateDescr ( $item->get_description(), 150 );
						
						$args = array(
									'uuid' => $uuid,
									'key' => $this->createKey( $title ),//Text::cleanUrl( $title ),
									'username' => $row['user'],
									'coverImage' => $img,
									'copyImage' => ( $row['copyImages'] ? true : false ),
									'setSource' => ( $row['setsourceurl'] ? true : false ),
									'category' => $row['category'],
									'type' => $row['status'],
									'title' => $title,
									'date' => $date,
									'sourceURL' => $url,
									'sourceName' => $sourceName,
									'descr' => generateDescr ( $item->get_description(), 150 ),
									'content' => ( $row['striphtml'] ? strip_tags( $item->get_description() ) : $item->get_description() )
						);
						
						$this->addNewPage( $args );
						
						$auto[$key]['list'][$uuid] = array( 'key' => $args['key'], 'date' => $args['date'] );
						
						//array_push( $auto[$key]['list'], $arr );

						//Save some memory
						unset( $item, $args, $arr ); 
						
						$change++;
						
						$added++;
						
					}

				}
				
				//Destruct and unset the feed to save some memory
				$feed->__destruct();
				unset( $feed );
			}
			
			//Use the build-in function to reindex the categories
			reindexCategories();
				
			$this->addDB ( $auto, DB_AUTO );
			
			unset( $auto );
				
			$deleted = $this->deleteOldPosts();
			
			$this->sitemapIndex();
			
			echo 'Done<br />';
			
			echo $added . ' items added<br />';
			
			echo $deleted . ' items deleted<br />';
		}
	}
	
	/**
	 * Creates a key from a string and searches if the key exists
	 *
	 * @access private
	 * @param string $string
	 * @return string
	 */
	private function createKey( $string )
	{
		$posts = $this->openDB( DB_PAGES );
		
		$sef = $this->URLify( $string ); //URLify::filter( $string );
		
		if ( isset( $posts[$sef] ) )
		{
			for ( $i=0; $i<10; $i++ )
			{
				$sef = $sef . '-' . $i;
				
				if ( !isset( $posts[$sef] ) )
					break;
			}
		}
		
		return $sef;
	}
	
	/**
	 * Deletes the old posts from auto content
	 *
	 * @access private
	 */
	private function deleteOldPosts ()
	{
		$auto = $this->openDB( DB_AUTO );
		
		if ( empty( $auto ) )
			return;
		
		$deleted = 0;
				
		foreach ( $auto as $key => $row )
		{
			//Don't bother with disabled feeds, because reasons
			if ( $row['disabled'] )
				continue;
			
			//If the list is empty, don't waist my time
			if ( empty( $row['list'] ) )
				continue;
			
			//If the user wants to keep the post, continue
			if ( empty( $row['autoDelete'] ) )
				continue;
			
			$autoDelete = ( $row['autoDelete'] * 86400 );
			
			foreach( $row['list'] as $k => $l )
			{
				
				$dateUnix = strtotime( $l['date'] );
				
				if ( $autoDelete > ( time() - $autoDelete ) )
					continue;
				
				if ( deletePage( $l['key'] ) )
				{
					$this->deleteKey( $l['key'] );	
					
					unset( $auto[$key]['list'][$k] );
					
					$deleted++;
				}
			}
		}
		
		$this->addDB ( $auto, DB_AUTO );
		
		return $deleted;
	}
	
	private function checkSkipWords ( $title, $sourcewords )
	{
		if ( strpos ( $sourcewords, ',' ) !== false )
		{
			$words = explode ( ',', $sourcewords );
			
			foreach( $words as $word )
			{
				if ( mb_strpos ( strtolower( $title ) , strtolower( $word ) ) !== false )
					return true;
			}
		}
		else
		{
			if ( mb_strpos ( strtolower( $title ) , strtolower( $sourcewords ) ) !== false )
				return true;
		}
		
		return false;
	}
	
	private function searchIdPost( $uuid )
	{
		$posts = $this->openDB( DB_PAGES );
		
		if ( !empty( $posts ) )
		{
			foreach( $posts as $key => $row )
			{
				if ( $row['uuid'] === $uuid )
					return true;
			}
		}
		
		return false;		
	}
		
	private function addNewPage( $args )
	{
		if ( empty( $args ) )
			return false;
		
		$posts = $this->openDB( DB_PAGES );
		
		$categories = $this->openDB( DB_CATEGORIES );
		
		$img = '';
		
		//array_multisort( array_column( $posts, 'position' ), SORT_ASC, SORT_NUMERIC, $posts );
		
		//$end = end( $posts );
		
		//$pos = ( $end['position'] + 1 );
		
		$pos = ( $this->pagePosition() + 1 );
		
		//$pos = ( $pos + 1 );
		
		$p_dir = PATH_PAGES . $args['key'] . DS;
		
		$this->createDir( $p_dir );
		
		$uploadDir = PATH_UPLOADS_PAGES . $args['uuid'] . DS;
		
		$thumbDir = $uploadDir . 'thumbnails' . DS;
		
		$this->createDir( $uploadDir );
		$this->createDir( $thumbDir );
		
		if ( !empty( $args['coverImage'] ) )
		{
			if ( $args['copyImage'] )
			{
				$name = returnImgName( $args['coverImage'] );
			
				$img = create_image( $args['coverImage'], $uploadDir, $name );
			}
			else
				$img = $args['coverImage'];
		}
				
		$f_name = $p_dir . 'index.txt';
		
		$content = $args['content'];
		
		if ( $args['copyImage'] )
		{
			$content = $this->replaceImage( $content , $args['uuid'], $uploadDir, $thumbDir, $img );
		}
		
		//Replace any internal link
		$content = replaceLinks ( $content, $args['sourceURL'] );
		
		if ( $args['setSource'] )
		{
			$content .= '<p><a href="' . $args['sourceURL'] . '" target="_blank">Via</a></p>';
		}

		@file_put_contents( $f_name, $content );

		//Database
		$posts[$args['key']] = array
		(
			'title' => mb_convert_encoding( $args['title'], "UTF-8"),
			'description' => mb_convert_encoding( $args['descr'] , "UTF-8"),
			'username' => $args['username'],
			'tags' => $this->createTags( $args['title'], $args['key'] ),
			'type' => $args['type'],
			'date' => $args['date'],
			'dateModified' => "",
			'allowComments' => true,
			'position' => $pos,
			'coverImage' => $img,
			'md5file' => md5_file( $f_name ),
			'category' => $args['category'],
			'uuid' => $args['uuid'],
			'parent' => "",
			'template' => "",
			'noindex' => false,
			'nofollow' => false,
			'noarchive' => false
		);
		
		array_multisort( array_column( $posts, 'position' ), SORT_DESC, SORT_NUMERIC, $posts );
		
		array_push( $categories[$args['category']]['list'], $args['key'] );
		
		$this->addDB ( $categories, DB_CATEGORIES );
		
		$this->addDB ( $posts, DB_PAGES );
		
		$searchLang = $this->searchCategory ( $args['category'], true, false );
			
		$searchBlog = $this->searchCategory ( $args['category'], false, true );
		
		$lang = ( !empty( $searchLang ) ? $searchLang['lang'] : '' );
		
		$blog = ( !empty( $searchBlog ) ? $searchBlog['blog'] : '' );
		
		$this->addPage( $args['key'], $blog, $lang );
	}
	
	
	private function createTags ( $title, $sef )
	{
		$array = array();
		
		$tags = $this->openDB( DB_TAGS );
		
		$title = trim( preg_replace( "/\([^)]+\)/", "", $title ) );
		
		$slug_array = array_diff(explode(" ", $title ), tags_stop_words());
		
		if ( !empty( $slug_array ) )
		{
			foreach ( $slug_array as $slug )
			{
				$tag = Text::cleanUrl( $slug );
				
				if ( isset( $tags[$tag] ) )
					array_push ( $tags[$tag]['list'], $sef );
				else
				{
					$tags[$tag] = array( 'name' => $slug, 'list' => array() );
					array_push ( $tags[$tag]['list'], $sef );
				}
				
				$array[] = $tag;
			}
			
			$this->addDB ( $tags, DB_TAGS );
		}
		
		return $array;
	}
	
		
	public function beforeAll()
	{
		global $uri;

		if ( ( $this->getValue( 'enable-sitemap' ) !== 'disable' ) && $this->webhook( 'sitemap.xml' ) ) 
		{
			$this->sitemapLoad();
			
			exit(0);
		}
		
		if ( $this->getValue( 'enableAutoContent' ) && $this->webhook( 'feed-' . $this->getValue( 'feedHash' ) ) )
		{
			$this->contentAuto();
			
			exit(0);
		}

		//Run the buildUri function before anything else
		$uri = $this->buildUri();
		
		//Check if we asked for a sitemap file
		if ( !empty( $uri['sitemap'] ) )
		{
			$this->sitemapLoad( $uri['pageSlug'] );
			
			exit(0);
			
		}

		if ( !empty( $uri['amp'] ) )
		{
			$temp = buildPage( $uri['pageSlug'] );
			
			if ( $temp )
			{
				if ( $uri['postType'] == 'thread' )
				{
					global $content, $L;
					
					$content = $this->buildThread ( $temp, true );
					
				}
				elseif ( $uri['postType'] == 'topic' )
				{
					global $content, $L;
					$content = $this->buildTopic( $temp );
				}
				elseif ( $uri['postType'] == 'product' )
				{
					global $content, $L;
					$content = $this->buildProduct( $temp );
				}

				$langDetails = $this->getLangDetails( $uri['lang'] );
				
				//Set the post's permalink here
				$permalink = ( !empty( $uri['isLang'] ) ? $this->buildURL( $uri['pageSlug'], $uri['lang'] ) : $temp->permalink() );
				
				$pageContent = $temp->content();

				$pageContent = $this->embedURL( $pageContent, true );
		
				$temp->setField('content', $pageContent);

				$page = $temp;
				
				$ampSettings = $this->getValue( 'amp-settings' );
								
				//We are ready, let's load the amp theme
				require( $this->phpPath() . 'amp' . DS . 'index.php' );
				
				unset( $temp );

				//Stop the fun here
				exit(0);
				
			}
		}
		
		$this->setRedirs();
	}
		
	public function buildUri()
    {
		
		$uri = $this->buildUriArray();
		
        $data = array();
	
		//General data to prevent any errors in our theme
		$data = array( 'blog' => '', 'whereAmI' => 'home', 'pageSlug' => '', 'lang' => '', 'amp' => false, 'sitemap' => false, 'postType' => '', 'categorySlug' => '', 'noIndex' => false );
		
		//The first thing we have to see is that we have something to work with
		if ( empty( $uri['0'] ) )
		{
			//Set the uri before exiting...
			$this->uri = $data;
			
			return $data;
		}
		
		//Build our sitemap array here
		$this->sitemapXmlArray();

		$blogs = $this->blogs;

        $langCodes = $this->buildLangCodes();
		
		$defaultLang = $this->getValue( 'default-lang' );
		
		if ( ( $uri['0'] == 'category' ) && !empty( $uri['1'] ) )
		{
			$categorySlug = $uri['1'];
			
			$data = array( 'blog' => '', 'whereAmI' => 'home', 'pageSlug' => '', 'lang' => '', 'amp' => false, 'sitemap' => false, 'postType' => '', 'categorySlug' => $categorySlug, 'noIndex' => false );
					
			$this->setSlug ( $categorySlug );
		}
		
		elseif ( empty( $uri['1'] ) && ( $this->getValue( 'enable-sitemap' ) !== 'disable' ) && !empty( $this->sitemaps ) && in_array( $uri['0'], $this->sitemaps ) )
		{
			$data = array( 'blog' => '', 'whereAmI' => '', 'pageSlug' => $uri['0'], 'lang' => '', 'amp' => false, 'sitemap' => true, 'postType' => '', 'categorySlug' => '', 'noIndex' => false );
					
			$this->setSlug ( $uri['0'] );
		}
		
		//AMP
		elseif ( $this->getValue( 'enable-amp' ) && ( $uri['0'] == 'amp' ) && !empty( $uri['1'] ) )
		{
			$postType = '';
			
			//Load only the keys of the posts to save some memory
			$posts = $this->openDB( DB_PAGES );
					
			if ( isset( $posts[$uri['1']] ) && ( ( $posts[$uri['1']]['type'] === 'published' ) || ( $posts[$uri['1']]['type'] === 'sticky' ) ) )
			{
				$searchLang = $this->searchKey( $uri['1'], 'langs' );
					
				$searchTopic = $this->searchKey( $uri['1'], 'topics' );
					
				$searchForum = $this->searchKey( $uri['1'], 'forums' );
				
				$search = $this->searchKey( $uri['1'] );
					
				$blog = ( !empty( $search ) ? $search['blog'] : '' );

				$lang = ( !empty( $searchLang ) ? $searchLang['lang'] : '' );
					
				$postType = ( !empty( $searchForum ) ? 'thread' : $postType );
					
				$postType = ( !empty( $searchTopic ) ? 'topic' : $postType );
				
				$postType = ( ( ( $this->getValue( 'enable-shop' ) !== 'disable' ) && !empty( $search ) && ( $this->getValue( 'enable-shop' ) == $search['blog'] ) ) ? 'product' : 'normal' );

				$data = array( 'blog' => $blog, 'whereAmI' => 'page', 'pageSlug' => $uri['1'], 'lang' => $lang, 'amp' => true, 'sitemap' => false, 'postType' => $postType, 'noIndex' => false );
						
				$this->setSlug ( $uri['1'] );
			}
		}
		
		//TOPIC?
		elseif ( ( $this->getValue( 'enable-forum' ) !== 'disable' ) && ( $uri['0'] == 'topic' ) && !empty( $uri['1'] ) )
		{
			$posts = $this->openDB( DB_PAGES  );
					
			if ( isset( $posts[$uri['1']] ) && ( ( $posts[$uri['1']]['type'] === 'published' ) || ( $posts[$uri['1']]['type'] === 'sticky' ) ) )
			{
				$blog = $this->getValue( 'enable-forum' );
				
				$noIndex = ( !empty( $blogs[$blog]['noindex'] ) ? true : false );
				
				$data = array( 'blog' => $blog, 'whereAmI' => 'page', 'pageSlug' => $uri['1'], 'lang' => '', 'amp' => false, 'sitemap' => false, 'postType' => 'topic', 'noIndex' => $noIndex );
						
				$this->setSlug ( $uri['1'] );
			}
			else
			{
				$this->setSlug ( '', '', true );
				return $data;
			}
			
		}
		
		//User?
		elseif ( ( $this->getValue( 'enable-forum' ) !== 'disable' ) && ( $uri['0'] == 'user' ) && !empty( $uri['1'] ) )
		{
			$users = $this->getAllMembers();
					
			if ( !empty( $users ) && ( in_array( $uri['1'], $users ) ) )
			{
				//Users are a part of the forum
				$blog = $this->getValue( 'enable-forum' );
				
				$noIndex = ( !empty( $blogs[$blog]['noindex'] ) ? true : false );
				
				$data = array( 'blog' => $blog, 'whereAmI' => 'page', 'pageSlug' => $uri['1'], 'lang' => '', 'amp' => false, 'sitemap' => false, 'postType' => 'user', 'noIndex' => $noIndex );
						
				$this->setSlug ( $uri['1'] );
			}
			else
			{
				$this->setSlug ( '', '', true );
				return $data;
			}
			
		}
		
		elseif ( !isset( $blogs[$uri['0']] ) && ( !in_array( $uri['0'], $langCodes ) ) )
		{
			//Load only the keys of the posts to save some memory
			$posts = $this->openDB( DB_PAGES, true );

			//We want a post, simply as that 
			if ( in_array( $uri['0'], $posts ) )//if ( isset( $posts[$uri['0']] ) )
			{
				$postSlug = $uri['0'];

				$search = $this->searchKey( $postSlug, 'langs' );
				
				$searchBlog = $this->searchKey( $postSlug );
				
				if ( !empty( $searchBlog ) && !empty( $blogs[$searchBlog['blog']]['disable'] ) )
				{
					//We asked for a post that belongs to a disabled blog, so we need to stop here
					$this->setSlug ( '', '', true );
					return $data;
				}
				else
				{
					if ( !empty( $search ) )
					{
						
						$langs = $this->openDB( DB_LANGS );
							
						$searchLang = $search['lang'];
						
						$blog = ( ( $this->getValue( 'hide-slug' ) && !empty( $searchBlog ) ) ? $searchBlog['blog'] : '' );
						
						$Lang = ( $this->getValue( 'hide-slug' ) ? $search['lang'] : '' );
						
						$noIndex = ( ( !empty( $blog ) && !empty( $blogs[$blog]['noindex'] ) ) ? true : false );
						
						$postType = ( ( !empty( $blog ) && ( $this->getValue( 'enable-shop' ) !== 'disable' ) && ( $this->getValue( 'enable-shop' ) == $blog ) ) ? 'product' : '' );
			
						$postType = ( ( !empty( $blog ) && ( $this->getValue( 'enable-forum' ) !== 'disable' ) && ( $this->getValue( 'enable-forum' ) == $blogSlug ) ) ? 'thread' : $postType );
						
						if ( !empty( $searchLang ) && !$langs[$searchLang]['disable'] )
						{
							$data = array( 'blog' => $blog, 'whereAmI' => 'page', 'pageSlug' => $postSlug, 'lang' => $Lang, 'amp' => false, 'sitemap' => false, 'postType' => $postType, 'categorySlug' => '', 'noIndex' => $noIndex );
						}
						////elseif ( empty( $searchLang ) )
						//{
							//$data = array( 'blog' => $blog, 'whereAmI' => 'page', 'pageSlug' => $postSlug, 'lang' => '', 'amp' => false, 'sitemap' => false, 'postType' => '', 'categorySlug' => '' );
						//}
						else
						{
							//We asked for a post that belongs to a disabled blog, so we need to stop here
							$this->setSlug ( '', '', true );
							return $data;
						}
					}
					else
					{	//echo ( empty( $this->getValue( 'hide-slug' ) ) && !empty( $searchBlog ) ) ;
						$blog = ( ( $this->getValue( 'hide-slug' ) && !empty( $searchBlog ) ) ? $searchBlog['blog'] : '' );
						
						$data = array( 'blog' => $blog, 'whereAmI' => 'page', 'pageSlug' => $postSlug, 'lang' => '', 'amp' => false, 'sitemap' => false, 'postType' => '', 'categorySlug' => '' );
					}
				}
			}
		}
				
		elseif ( isset( $blogs[$uri['0']] ) && ( empty( $blogs[$uri['0']]['disable'] ) && ( ( $blogs[$uri['0']]['enabled'] == 'everywhere' ) || ( $blogs[$uri['0']]['enabled'] == $defaultLang['code'] ) ) ) )
		{
			$blogSlug = $uri['0'];
			
			$postType = ( ( ( $this->getValue( 'enable-shop' ) !== 'disable' ) && ( $this->getValue( 'enable-shop' ) == $blogSlug ) ) ? 'shop' : '' );
			
			$postType = ( ( ( $this->getValue( 'enable-forum' ) !== 'disable' ) && ( $this->getValue( 'enable-forum' ) == $blogSlug ) ) ? 'forum' : $postType );
			
			$noIndex = ( !empty( $blogs[$blogSlug]['noindex'] ) ? true : false );
				
			if ( empty( $uri['1'] ) ) 
			{
				//We are in a blog dir, but we have it enabled here?
				if ( empty( $blogs[$blogSlug]['disable'] ) && ( ( $blogs[$blogSlug]['enabled'] == 'everywhere' ) || ( $blogs[$blogSlug]['enabled'] == $defaultLang['code'] ) ) )
				{
					$data = array( 'blog' => $blogSlug, 'whereAmI' => 'home', 'pageSlug' => '', 'lang' => '', 'amp' => false, 'sitemap' => false, 'postType' => $postType, 'categorySlug' => '', 'noIndex' => $noIndex );
					
					$this->setSlug ( $blogSlug );
				}
			}
			
			elseif ( ( $uri['1'] == 'category' ) && !empty( $uri['2'] ) )
			{
				$categorySlug = $uri['2'];
				
				$data = array( 'blog' => $blogSlug, 'whereAmI' => 'home', 'pageSlug' => '', 'lang' => '', 'amp' => false, 'sitemap' => false, 'postType' => $postType, 'categorySlug' => $categorySlug, 'noIndex' => $noIndex );
							
				$this->setSlug ( $categorySlug );
			}
			
			else
			{
				//Where are in a blog's page, so let's find out if we can show this post here
				$posts = $this->openDB( DB_PAGES, true );
					
				$postSlug = $uri['1'];
					
				if ( in_array( $postSlug, $posts ) )//if ( isset( $posts[$postSlug] ) )
				{
					$postType = ( ( ( $this->getValue( 'enable-shop' ) !== 'disable' ) && ( $this->getValue( 'enable-shop' ) == $blogSlug ) ) ? 'product' : 'normal' );
								
					$postType = ( ( ( $this->getValue( 'enable-forum' ) !== 'disable' ) && ( $this->getValue( 'enable-forum' ) == $blogSlug ) ) ? 'thread' : $postType );
								
					$data['blog'] = $blogSlug;
							
					$data['whereAmI'] = 'page';
								
					$data['pageSlug'] = $postSlug;
								
					$data['postType'] = $postType;
					
					$data['noIndex'] = $noIndex;

					$this->setSlug ( $postSlug, 'page' );
				}
			}
		}
			
		elseif ( in_array( $uri['0'], $langCodes ) )
		{
			$langs = $this->openDB( DB_LANGS );
				
			$langSlug = $uri['0'];
				
			if ( !$langs[$langSlug]['disable'] )
			{
				if ( empty( $uri['1'] ) )
				{
					$data = array( 'blog' => '', 'whereAmI' => 'home', 'pageSlug' => $langSlug, 'lang' => $langSlug, 'amp' => false, 'sitemap' => false, 'postType' => '', 'categorySlug' => '' );
						
					$this->setSlug ( $langSlug );
				}
				
				elseif ( ( $uri['1'] == 'category' ) && !empty( $uri['2'] ) )
				{
					$categorySlug = $uri['2'];
					
					$data = array( 'blog' => '', 'whereAmI' => 'home', 'pageSlug' => '', 'lang' => $langSlug, 'amp' => false, 'sitemap' => false, 'postType' => '', 'categorySlug' => $categorySlug );
							
					$this->setSlug ( $categorySlug );
				}
				
				//TOPIC?
				elseif ( ( $this->getValue( 'enable-forum' ) !== 'disable' ) && ( $uri['1'] == 'topic' ) && !empty( $uri['2'] ) )
				{
					$posts = $this->openDB( DB_PAGES  );
							
					if ( isset( $posts[$uri['2']] ) && ( ( $posts[$uri['2']]['type'] === 'published' ) || ( $posts[$uri['2']]['type'] === 'sticky' ) ) )
					{
						$blog = $this->getValue( 'enable-forum' );
						
						$noIndex = ( !empty( $blogs[$blog]['noindex'] ) ? true : false );
						
						$data = array( 'blog' => $blog, 'whereAmI' => 'page', 'pageSlug' => $uri['2'], 'lang' => $langSlug, 'amp' => false, 'sitemap' => false, 'postType' => 'topic', 'noIndex' => $noIndex );
								
						$this->setSlug ( $uri['2'] );
					}
					else
					{
						$this->setSlug ( '', '', true );
						return $data;
					}
					
				}
				
				//AMP
				elseif ( $this->getValue( 'enable-amp' ) && ( $uri['1'] == 'amp' ) && !empty( $uri['2'] ) )
				{
					//$lang = '';
					
					//Load only the keys of the posts to save some memory
					$posts = $this->openDB( DB_PAGES );
							
					if ( isset( $posts[$uri['2']] ) && ( $posts[$uri['2']]['type'] === 'published' ) )
					{
						if ( $this->getValue( 'hide-slug' ) )
						{
							//$search = $this->searchKey( $uri['2'], 'langs' );
									
							//$lang = ( !empty( $search ) ? $search['lang'] : $lang );
						}
							
						$data = array( 'blog' => '', 'whereAmI' => 'page', 'pageSlug' => $uri['2'], 'lang' => $langSlug, 'amp' => true, 'sitemap' => false, 'postType' => '' );
								
						$this->setSlug ( $uri['2'] );
					}
				}
				
				//User?
				elseif ( ( $this->getValue( 'enable-forum' ) !== 'disable' ) && ( $uri['1'] == 'user' ) && !empty( $uri['2'] ) )
				{
					$users = $this->getAllMembers();
							
					if ( !empty( $users ) && ( in_array( $uri['2'], $users ) ) )
					{
						//Users are a part of the forum
						$blog = $this->getValue( 'enable-forum' );
						
						$noIndex = ( !empty( $blogs[$blog]['noindex'] ) ? true : false );
						
						$data = array( 'blog' => $blog, 'whereAmI' => 'page', 'pageSlug' => $uri['2'], 'lang' => '', 'amp' => false, 'sitemap' => false, 'postType' => 'user', 'noIndex' => $noIndex );
								
						$this->setSlug ( $uri['2'] );
					}
					else
					{
						$this->setSlug ( '', '', true );
						return $data;
					}
					
				}
				
				elseif ( !empty( $uri['1'] ) )
				{
					if ( isset( $blogs[$uri['1']] ) )
					{
						$blogSlug = $uri['1'];
						
						$postType = ( ( ( $this->getValue( 'enable-shop' ) !== 'disable' ) && ( $this->getValue( 'enable-shop' ) == $blogSlug ) ) ? 'shop' : '' );
			
						$postType = ( ( ( $this->getValue( 'enable-forum' ) !== 'disable' ) && ( $this->getValue( 'enable-forum' ) == $blogSlug ) ) ? 'forum' : $postType );
									
						$noIndex = ( !empty( $blogs[$blogSlug]['noindex'] ) ? true : false );
						
						if ( empty( $uri['2'] ) )
						{
							$data = array( 'blog' => $blogSlug, 'whereAmI' => 'home', 'pageSlug' => $blogSlug, 'lang' => $langSlug, 'amp' => false, 'sitemap' => false, 'postType' => $postType, 'categorySlug' => '', 'noIndex' => $noIndex );
						
							$this->setSlug ( $blogSlug );
						}
						
						elseif ( ( $uri['2'] == 'category' ) && !empty( $uri['3'] ) )
						{
							$categorySlug = $uri['3'];
								
							$data = array( 'blog' => $blogSlug, 'whereAmI' => 'home', 'pageSlug' => '', 'lang' => $langSlug, 'amp' => false, 'sitemap' => false, 'postType' => $postType, 'categorySlug' => $categorySlug, 'noIndex' => $noIndex );
										
							$this->setSlug ( $categorySlug );
						}
			
						else
						{
							$posts = $this->openDB( DB_PAGES, true );
							
							$postSlug = $uri['2'];
							
							if ( in_array( $postSlug, $posts ) )//if ( isset( $posts[$postSlug] ) )
							{
								$postType = ( ( ( $this->getValue( 'enable-shop' ) !== 'disable' ) && ( $this->getValue( 'enable-shop' ) == $blogSlug ) ) ? 'product' : 'normal' );
								
								$postType = ( ( ( $this->getValue( 'enable-forum' ) !== 'disable' ) && ( $this->getValue( 'enable-forum' ) == $blogSlug ) ) ? 'thread' : $postType );
											
								//$data['blog'] = $blogSlug;
										
								//$data['whereAmI'] = 'page';
											
								//$data['pageSlug'] = $postSlug;
											
								//$data['postType'] = $postType;
								//$data['noIndex'] = $noIndex;

								//$this->setSlug ( $postSlug, 'page' );
					
								$data = array( 'blog' => $blogSlug, 'whereAmI' => 'page', 'pageSlug' => $postSlug, 'lang' => $langSlug, 'amp' => false, 'sitemap' => false, 'postType' => $postType, 'categorySlug' => '', 'noIndex' => $noIndex );
								
								$this->setSlug ( $postSlug, 'page' );
							}
						}
					}
					else
					{
						$posts = $this->openDB( DB_PAGES, true );
							
						$postSlug = $uri['1'];
						
						if ( in_array( $postSlug, $posts ) )//if ( isset( $posts[$postSlug] ) )
						{
							//$postType = ( ( ( $this->getValue( 'enable-shop' ) !== 'disable' ) && ( $this->getValue( 'enable-shop' ) == $blogSlug ) ) ? 'product' : 'normal' );
										
							//$data['blog'] = $blogSlug;
							
							$data = array( 'blog' => '', 'whereAmI' => 'page', 'pageSlug' => $postSlug, 'lang' => $langSlug, 'amp' => false, 'sitemap' => false, 'postType' => '', 'categorySlug' => '' );
									
							//$data['whereAmI'] = 'page';
										
							//$data['pageSlug'] = $postSlug;
										
							//$data['postType'] = $postType;

							$this->setSlug ( $postSlug, 'page' );
						}
					}
				}
				
			}
			else
			{
				//We asked for a language that is disabled
				$this->setSlug ( '', '', true );
				return $data;
			}
		}
		else
		{
			$this->setSlug ( '', '', true );
			return $data;
		}
		
		//Set the uri beforebefore anything else
		$this->uri = $data;
		     
		return $data;
    }
	
	public function getAllMembers( $full = false )
	{
		$data = array();
		
		$users = $this->openDB( DB_USERS  );
		
		foreach( $users as $user => $row )
		{
			if ( $full )
			{
				$data[$user] = $row;
			}
			else
			{
				$data[] = $user;
			}
			
			unset( $users );
		}
		
		if ( $this->getValue( 'allow-users' ) && file_exists( DB_MEMBERS ) )
		{
			$users = $this->openDB( DB_MEMBERS  );
			
			if ( !empty( $users ) )
			{
				foreach( $users as $user => $row )
				{
					if ( $full )
					{
						$data[$user] = $row;
					}
					else
					{
						$data[] = $user;
					}
				}
				
				unset( $users );
			}
		}
		
		return $data;
		
	}
	
	public function adminSidebar()
	{
		global $L;
		
		$html = '';
		
		require( $this->phpPath() . 'php' . DS . 'admin-sidebar.php' );
		
		return $html;
	
	}
		
	public function addForumThread( $key, $title, $lang = '', $parent = '', $uuid = '', $post = '' )
    {
		
	}
	
	public function addForumComment( $key, $comment, $user )
    {
		if ( $key === '' )
			return false;
		
		
	}
	
	public function checkRecaptcha ( $response )
	{
		if ( $this->getValue( 'enableantispam' ) )
		{
			$antiSpamData = $this->getValue( 'antispam-settings' );

			if ( !empty( $antiSpamData['secretKey'] ) )
			{
				$recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';

				// Make and decode POST request:
				$recaptcha = file_get_contents( $recaptcha_url . '?secret=' . $antiSpamData['secretKey'] . '&response=' . $response );
				
				$recaptcha = json_decode( $recaptcha );

				return $recaptcha->success;
			}
		}
		
		return;
	}
		
	public function beforeSiteLoad()
    {
		global $site;
				
		//echo postClass->foo();
		//First check if we want to add a new comment
		if ( ( $this->getValue( 'enable-forum' ) !== 'disable' ) && $this->webhook( 'add-comment.php' ) ) 
		{
			//Make sure we redirect the page, either way
			$redirect = ( ( isset( $_POST['redirect_to'] ) && !empty( $_POST['redirect_to'] ) ) ? $this->sanitize( $_POST['redirect_to'] ) : $this->site_url() );
			
			//Make sure we have the correct nonce, then add the comment
			if ( isset( $_POST['nonce'] ) && !empty( $_POST['nonce'] ) && checkFormHash( $this->sanitize( $_POST['nonce'] ) ) && !isset( $_POST['name'] ) && !isset( $_POST['email'] ) )
			{
				if ( isset( $_POST['g-recaptcha-response'] ) )
				{
					if ( $this->checkRecaptcha ( $_POST['g-recaptcha-response'] ) )
						$save = $this->saveReply( $_POST );
				}
				else
					$save = $this->saveReply( $_POST );
				
				if ( $save )
					$redirect .= '#post-' . $save;
			}
			
			header ( 'Location: ' . $redirect );
			
			exit(0);
		}
		
		//A Review maybe?
		if ( ( $this->getValue( 'enable-shop' ) !== 'disable' ) && $this->webhook( 'add-review.php' ) ) 
		{
			//Make sure we redirect the page, either way
			$redirect = ( ( isset( $_POST['redirect_to'] ) && !empty( $_POST['redirect_to'] ) ) ? $this->sanitize( $_POST['redirect_to'] ) : $this->site_url() );
			
			// isset($_POST['recaptcha_response']
			//Make sure we have the correct nonce, then add the comment
			if ( isset( $_POST['nonce'] ) && !empty( $_POST['nonce'] ) && checkFormHash( $this->sanitize( $_POST['nonce'] ) ) && ( !isset( $_POST['name'] ) || ( isset( $_POST['name'] ) && empty( $_POST['name'] ) ) ) && ( !isset( $_POST['email'] ) || ( isset( $_POST['email'] ) && empty( $_POST['email'] ) ) ) )
			{
				if ( isset( $_POST['g-recaptcha-response'] ) )
				{
					if ( $this->checkRecaptcha ( $_POST['g-recaptcha-response'] ) )
						$save = $this->saveReview( $_POST );
				}
				
				else
					$save = $this->saveReview( $_POST );
			}
			
			header ( 'Location: ' . $redirect );
			
			exit(0);
		}
		
		//Or a new thread?
		if ( ( $this->getValue( 'enable-forum' ) !== 'disable' ) && $this->webhook( 'add-thread.php' ) ) 
		{
			//Make sure we redirect the page, either way
			$redirect = ( ( isset( $_POST['redirect_to'] ) && !empty( $_POST['redirect_to'] ) ) ? $this->sanitize( $_POST['redirect_to'] ) : $this->site_url() );
			
			//Make sure we have the correct nonce, then add the comment
			if ( isset( $_POST['nonce'] ) && !empty( $_POST['nonce'] ) && checkFormHash( $this->sanitize( $_POST['nonce'] ) ) && ( !isset( $_POST['name'] ) || ( isset( $_POST['name'] ) && empty( $_POST['name'] ) ) ) && ( !isset( $_POST['email'] ) || ( isset( $_POST['email'] ) && empty( $_POST['email'] ) ) ) )
			{
				if ( isset( $_POST['g-recaptcha-response'] ) )
				{
					if ( $this->checkRecaptcha ( $_POST['g-recaptcha-response'] ) )
						$save = $this->saveThread( $_POST );
				}
				else
					$save = $this->saveThread( $_POST );
				
				if ( $save )
					$redirect = $this->site_url() . 'topic/' . $save;
			}
			
			header ( 'Location: ' . $redirect );
			
			exit(0);
		}
		
		//Continue as usual
        global $content, $WHERE_AM_I;
		
        $uri = $this->uri;//$this->buildUri();

		//If there is nothing to play with, just return the default values to avoid any errors
        if ( empty( $uri ) )
            return $this->loadDetails ();
		
		$WHERE_AM_I = $uri['whereAmI'];
				
		$hasHomePage = false;
		
		$siteHomePage = (string) $site->homepage();
		
		if ( !empty( $siteHomePage ) && ( $WHERE_AM_I == 'home' ) && empty( $uri['blog'] ) )
		{
			$page = $this->getFirstPage( $uri['lang'] );
			
			if ( $page )
			{
				$WHERE_AM_I = 'page';
				
				$hasHomePage = true;
			}
		}

		$pageSlug = $uri['pageSlug'];
			
		if ( $WHERE_AM_I == 'home' )
		{
			$content = '';
				
			$content = $this->buildHomepage( $uri['blog'], $uri['lang'], $uri['categorySlug'] );
				
		}

		elseif ( ( $WHERE_AM_I == 'page' ) && !$hasHomePage )
		{
			//global $page;
			$uri = $this->uri;

			if ( !empty( $uri['postType'] ) && ( $uri['postType'] == 'user' ) )
			{
				global $content;
				global $site;
				
				$nav = ( ( isset( $_GET['switch'] ) && !empty( $_GET['switch'] ) ) ? sanitize ( $_GET['switch'] ) : '' );
				
				$content = array();
					
				$format = $site->dateFormat();
											
				if ( !empty( $uri['lang'] ) ) 
				{
					$langs = $this->openDB( DB_LANGS );
							
					if ( !empty( $langs[$uri['lang']]['dateFormat'] ) )
						$format = $langs[$uri['lang']]['dateFormat'];
							
					unset( $langs );
				}
					
				$user = $this->getUser( $uri['pageSlug'], $format );
				
				if ( $user )
				{
					$content = $user;
					//$content['mainURL'] = currentURL();
				}
			}
			
			else
			{
				global $page;
				$temp = $page; //$buildPage( $pageSlug ) ;

				if ( $temp )
				{
					if ( !$this->getValue( 'hide-slug' ) )
						$temp->setField('key', $pageSlug);
					
					if ( !empty( $uri['postType'] ) && ( $uri['postType'] == 'thread' ) )
					{
						global $content;
						
						$content = $this->buildThread( $temp );
					}

					elseif ( !empty( $uri['postType'] ) && ( $uri['postType'] == 'topic' ) )
					{
						global $content;
						
						//global $site;
									
						$content = array();
						
						//$page = buildPage( $pageSlug ) ;
										
						if ( $page )
						{
							$content = $this->buildTopic( $page );
						}
						//else
							//return $content;
					}
					
					elseif ( !empty( $uri['postType'] ) && ( $uri['postType'] == 'product' ) )
					{
						$content = $this->buildProduct( $page );
					}
					
					else
					{
						$pageContent = $temp->content();

						$pageDescr = $temp->description();
											
						$pageContent = $this->embedURL( $pageContent );
						$pageDescr = $this->embedURL( $pageDescr );
						
						if ( checkKey( $this->getValue( 'seo-settings' ), 'noFollowExt' ) || checkKey( $this->getValue( 'seo-settings' ), 'newTabExt' )  )
							$pageContent = $this->editLinks( $pageContent );
						
						if ( checkKey( $this->getValue( 'seo-settings' ), 'lazyLoad' ) )
							$pageContent = lazyLoad( $pageContent );
						
						if ( checkKey( $this->getValue( 'seo-settings' ), 'addSeoAlt' ) )
							$pageContent = $this->addAltToImages( $pageContent );

						$temp->setField('content', $pageContent);
						$temp->setField('description', $pageDescr);

						$page = $temp;
						
						unset($pageContent, $pageDescr, $temp);
					}
				}
			}
		}

		$this->loadDetails ( $uri['lang'], $uri['blog'], $uri['pageSlug'] );
	}
	
	public function buildProduct ( $page, $amp = false )
	{
		global $site;
		
		$format = $site->dateFormat();
												
		if ( !empty( $uri['lang'] ) ) 
		{
			$langs = $this->openDB( DB_LANGS );
								
			if ( !empty( $langs[$uri['lang']]['dateFormat'] ) )
				$format = $langs[$uri['lang']]['dateFormat'];
							
			unset( $langs );
		
		}

		$date = date( $format, strtotime( $page->dateRaw() ) );
						
		$file = PATH_PAGES . $page->key() . DS . 'values.php';
						
		$fileReviews = PATH_PAGES . $page->key() . DS . 'reviews.php';
						
		$uuid = $page->uuid();
						
		$images = '';
						
		if ( !empty( $page->coverImage() ) )
		{
			$image = $page->coverImage( true );
							
			$path_parts = pathinfo( $image );
							
			$filename = $path_parts['filename'];
							
			$dir = PATH_UPLOADS_PAGES . $uuid . DS;
							
			if ( is_dir( $dir ) )
				$images = $this->scanFiles ( $dir, $uuid, $page->coverImage() );
		
		}
		
		else
		{
			$image = $this->htmlPath() . 'files/noimage.png';
							
			$filename = 'noimage';
		
		}
						
		$values = array();
						
		$reviews = array();
						
						//$related = $this->getProductRelated ( $page->key() );
												
		if ( file_exists ( $file ) )
			$values = $this->openDB( $file );
						
		$rate = 0;
		
		$finalRate = 0;
						
		if ( file_exists ( $fileReviews ) )
		{
			$reviews = $this->openDB( $fileReviews );
							
			if ( !empty( $reviews ) )
			{
				$totalRatings = 0;
								
				foreach ( $reviews as $k => $r )
				{
					$totalRatings += $r['rating'];
				}
								
				$rate = ceil( $totalRatings / 5 );
								
				$finalRate = ceil( 20 * $rate );
			}
		
		}

		$catKey = $page->categoryKey();
						
		$cat = $page->category();
						
		$catURL = $prodURL = $this->site_url();
						
		if ( !$this->getValue( 'hide-slug' ) )
		{
			if ( !empty( $uri['lang'] ) )
			{
				$catURL .= $uri['lang'] . '/';
								
				$prodURL .= $uri['lang'] . '/';
			}
							
			if ( !empty( $uri['blog'] ) )
			{
				$catURL .= $uri['blog'] . '/';
								
				$prodURL .= $uri['blog'] . '/';
			}
		}

		$catURL .= 'category/' . $catKey;
						
		$prodURL .= $page->key();
						
		//Don't add a link to cart, if the product is affilliate
		$addToCartUrl = ( ( !empty( $values ) && ( $values['type'] == 'normal' ) ) ? $prodURL . '?add=' . $uuid : '' );
						
		$price = ( ( !empty( $values ) && !empty( $values['price-sale'] ) ) ? $this->formatPrice( $values['price-sale'] ) : '' );
						
		$priceReg = ( ( !empty( $values ) && !empty( $values['price-regular'] ) ) ? $this->formatPrice( $values['price-regular'] ) : '' );
								
		//the product data as array
		$content = array(
											'title' => $page->title(),
											'description' => $page->description(),
											'content' => wpautop( $page->content() ),
											'id' => $page->position(),
											'date' => $date,
											'productSef' => $page->key(),
											'uuid' => $uuid,
											'addToCartUrl' => $addToCartUrl,
											'price' => $price,
											'priceReg' => $priceReg,
											'image' => $image,
											'filename' => $filename,
											'permalink' => $prodURL,
											'categoryKey' => $catKey,
											'categoryURL' => $catURL,
											'category' => $cat,
											'images' => $images,
											'values' => $values,
											'totalRates' => $rate,
											'ratings' => $finalRate,
											'reviewsNum' => count( $reviews ),
											'reviews' => $reviews,
											'related' => $this->getProductRelated ( $page->key(), $page->categoryKey() )
					);
					
		return $content;
	}
	
	/**
	 * Replace all empty images with an alt title
	 *
	 * @param string $post
	 * @param string $title
	 * @return string
	 */
	public function addAltToImages ( $post )
	{
		//Find only the images that don't have an alt parameter
		$pattern = '#<img(?!.*alt=")(.+src="(([^"]+/)?(.+)\..+)"[^ /]*)( ?\/?)>#i';

		preg_match_all( $pattern, $post, $matches );

		if ( !empty ( $matches ) )
		{
			$post = preg_replace_callback($pattern, function ($matches) 
			{
				static $incr = 0;
				++$incr;
				$title = htmlspecialchars( $this->buildTitle( false ) );
				return "<img$matches[1] alt=\"$title $incr\"$matches[5]>";
			}, $post);
		
		}
		
		return $post;
	}
	
	public function editLinks( $post )
	{
		$post = preg_replace_callback('/<a.+href=[\'"]([^\'"]+)[\'"].*>([^<]*)<\/a>/i', function( $m ) 
		{
			if ( get_HostName ( $m['1'] ) !== get_HostName ( $this->site_url() ) )
				return '<a href="' . $m['1'] . '" ' . ( checkKey( $this->getValue( 'seo-settings' ), 'noFollowExt' ) ? 'rel="nofollow"' : '' ) . ' ' . ( checkKey( $this->getValue( 'seo-settings' ), 'newTabExt' ) ? 'target="_blank"' : '' ) . '>' . $m['2'] . '</a>';
			else
				return '<a href="' . $m['1'] . '">' . $m['2'] . '</a>';
		}, $post);

		return $post;
	}
	
	public function buildTopic ( $page, $amp = false )
	{
		global $site;
		
		$uri = $this->uri;
		
		$pageSlug = $uri['pageSlug'];
		
		$content = array();
		
		$replies = $this->getReplies( $pageSlug );
						
		$forumData = $this->getValue( 'forum-settings' );
												
		$allow_embed = $forumData['auto-embed-links'];
							
		$format = $site->dateFormat();
											
		if ( !empty( $uri['lang'] ) ) 
		{
			$langs = $this->openDB( DB_LANGS );
								
			if ( !empty( $langs[$uri['lang']]['dateFormat'] ) )
				$format = $langs[$uri['lang']]['dateFormat'];
								
			unset( $langs );
		}
										
		$user = $this->getUserDetails( $format );
		
		$nav = ( ( isset( $_GET['page'] ) && is_numeric( $_GET['page'] ) ) ? int ( $_GET['page'] ) : 0 );
							
		$i = 0;
							
		$avatar = gravatarUrl( $user['email'] );
							
		$search = $this->searchKey( $pageSlug, 'topics' );
							
		if ( !empty( $search ) )
		{
			$posts = $this->openDB( DB_PAGES );
								
			$parent = array(
							'title' => $posts[$search['topic']]['title'],
							'url' => $this->site_url() . ( !empty( $uri['lang'] ) ? $uri['lang'] . '/' : '' ) . $uri['blog'] . '/' . $search['topic'],
						);
								
			unset( $posts, $search );
		
		}
		
		else
			$parent = array();
							
		if ( !empty( $replies ) )
		{
			array_multisort( array_column( $replies, 'date' ), SORT_ASC, SORT_NUMERIC, $replies );
									
			$last = end ( $replies );
								
			$lastUpdate = $last['date'];
			$lastUpdateUser = $last['user'];
			$lastUpdateNice = niceTime( $last['date'] );
			unset( $last );
		}
		
		else
		{
			$lastUpdate = strtotime( $page->dateRaw() );
			$lastUpdateUser = $page->username();
			$lastUpdateNice = niceTime( $lastUpdate );
		}
							
		$lUserDetails = $this->getUserDetails( $format, $lastUpdateUser );
													
		$canReply = false;
							
		if ( !empty( $user['isLogged'] ) || !empty( $forumData['anonymous'] ) )
			$canReply = true;
							
		$userUrl = $this->site_url() . ( !empty( $uri['lang'] ) ? $uri['lang'] . '/' : '' ) . 'user/';
							
		$content = array(
						'topicTitle' => $page->title(),
						'topicID' => $page->position(),
						'parent' => $parent,
						'topicSef' => $pageSlug,
						'topicDate' => $page->date(),
						'allowComments' => $page->allowComments(),
						'allowAnonymous' => $forumData['anonymous'],
						'allowFormatting' => $forumData['post-formatting'],
						'numReplies' => count( $replies ),
						'lastUpdate' => array(
											'date' => date ( $format, $lastUpdate ),
											'niceTime' => $lastUpdateNice,
											'username' => $lastUpdateUser,
											'nickname' => ( $lUserDetails['nickName'] ? $lUserDetails['nickName'] : $lastUpdateUser ),
											'url' => $userUrl . $lastUpdateUser
										),
										
						'currentUser' => array(
											'isLogged' => $user['isLogged'],
											'registered' => $user['registered'],
											'userName' => $user['userName'],
											'email' => $user['email'],
											'avatar' => $avatar,
											'canReply' => $canReply,
											'canBrowse' => $user['canBrowse'],
											'nickName' => $user['nickName'],
											'isAdmin' => $user['isAdmin'],
											'isMod' => $user['isMod']
										),
						'replies' => array()
				);
							
		unset( $lUserDetails );
							
		//If we are in the first page, add the 1st post here					
							if ( empty( $nav ) ) 
							{
								$userPost = new User ( $page->username() );
								
								$userRegistered = @date ( $dateFormat, strtotime( $userPost->registered() ) );
								
								$avatar = gravatarUrl( $userPost->email() );
								
								$canEdit = false;
								
								$canMod = false;
								
								//Only logged-in users can edit a post, even if the post created by guests
								if ( !empty( $user['isLogged'] ) )
								{
									//Admins and mods go first, no need to check the post
									if ( !empty( $user['isAdmin'] ) || !empty( $user['isMod'] ) )
									{
										$canEdit = true;
									}
									
									//If the user has made the post, then maybe we allow him to edit it
									elseif ( $page->username() == $user['userName'] )
									{
										//Do we have enabled the editign?
										if ( !empty( $forumData['editing'] ) )
										{
											//What about the time allowed?
											if ( empty( $forumData['editing-time'] ) )
											{
												$canEdit = true;
											}
											else
											{
												if ( $forumData['editing-time'] > ( time() - $forumData['editing-time'] ) )
													$canEdit = true;
											}
										}
									}
									
									if ( !empty( $user['isAdmin'] ) || !empty( $user['isMod'] ) )
									{									
										$canMod = true;
									}
								}
								
								$role = ( ( $userPost->role() == 'admin' ) ? 'Admin' : 'Member' );
								
								$content['replies'][$i] = array(
																'title' => $page->title(),
																'date' => $page->date(),
																'id' => $page->position(),
																'user' => $page->username(),
																'userNick' => ( $userPost->nickname() ? $userPost->nickname() : $page->username() ),
																'role' => $role,
																'email' => $userPost->email(),
																'avatar' => $avatar,
																'canEdit' => $canEdit,
																'canMod' => $canMod,
																'registered' => $userRegistered,
																'post' => ( $allow_embed ? $this->embedURL( $page->content() ) : $page->content() ),
																'userUrl' => $userUrl . $page->username(),
																'modified' => array()
															);
							}
							
							foreach ( $replies as $id => $reply )
							{
								$i++;
															
								$canEdit = false;
								
								$canMod = false;
							
								if ( !empty( $user['isLogged'] ) )
								{
									//Admins and mods go first, no need to check the post
									if ( !empty( $user['isAdmin'] ) || !empty( $user['isMod'] ) )
									{
										$canEdit = true;
									}
									
									//If the user has made the post, then maybe we allow him to edit it
									elseif ( $reply['user'] == $user['userName'] )
									{
										//Do we have enabled the editign?
										if ( !empty( $forumData['editing'] ) )
										{
											//What about the time allowed?
											if ( empty( $forumData['editing-time'] ) )
											{
												$canEdit = true;
											}
											else
											{
												if ( $forumData['editing-time'] > ( time() - $forumData['editing-time'] ) )
													$canEdit = true;
											}
										}
									}
									
									if ( !empty( $user['isAdmin'] ) || !empty( $user['isMod'] ) )
									{
										$canMod = true;
									}
								}
								
								$userPost = new User ( $reply['user'] );
								
								$userRegistered = @date ( $dateFormat, strtotime( $userPost->registered() ) );
								
								$avatar = gravatarUrl( $userPost->email() );
								
								$role = ( ( $userPost->role() == 'admin' ) ? 'Admin' : 'Member' );

								$content['replies'][$i] = array(
																'title' => $reply['title'],
																'date' => date ( $format, $reply['date'] ),
																'id' => $reply['id'],
																'user' => $reply['user'],
																'userNick' => ( $userPost->nickname() ? $userPost->nickname() : $reply['user'] ),
																'role' => $role,
																'email' => $userPost->email(),
																'avatar' => $avatar,
																'canEdit' => $canEdit,
																'canMod' => $canMod,
																'registered' => $userRegistered,
																'post' => ( $allow_embed ? $this->embedURL( $reply['post'] ) : $reply['post'] ),
																'userUrl' => $userUrl . $reply['user'],
																'modified' => array()
															);
							}
		return $content;
	}
	
	public function buildThread ( $temp, $amp = false )
	{
		global $site;
		
		$uri = $this->uri;
		
		$pageSlug = $uri['pageSlug'];
		
		$content = array();
						
		$topics = $this->getTopics( $uri['pageSlug'] );
						
		$forumData = $this->getValue( 'forum-settings' );
						
		$format = $site->dateFormat();
													
		if ( !empty( $uri['lang'] ) ) 
		{
			$langs = $this->openDB( DB_LANGS );
									
			if ( !empty( $langs[$uri['lang']]['dateFormat'] ) )
				$format = $langs[$uri['lang']]['dateFormat'];
							
			unset( $langs );
		}
							
		$user = $this->getUserDetails( $format );
							
		$avatar = gravatarUrl( $user['email'] );
							
		$posts = $this->openDB( DB_PAGES );
							
		$canReply = false;
													
		if ( !empty( $user['isLogged'] ) || !empty( $forumData['anonymous'] ) )
		{
			$canReply = true;
		}
							
		$content = array(
							'topicTitle' => $posts[$pageSlug]['title'],
							'topicPos' => $posts[$pageSlug]['position'],
							'topicSef' => $pageSlug,
							'lang' => ( !empty( $uri['lang'] ) ? $uri['lang'] : '' ),
							'allowAnonymous' => ( !empty( $forumData) ? $forumData['anonymous'] : false ),
							'allowFormatting' => ( !empty( $forumData) ? $forumData['post-formatting'] : false ),
							'currentUser' => array(
																	'isLogged' => $user['isLogged'],
																	'registered' => $user['registered'],
																	'userName' => $user['userName'],
																	'email' => $user['email'],
																	'avatar' => $avatar,
																	'canReply' => $canReply,
																	//'canBrowse' => $canBrowse,
																	'canBrowse' => $user['canBrowse'],
																	'nickName' => $user['nickName'],
																	'isAdmin' => $user['isAdmin'],
																	'isMod' => $user['isMod']
															),
							'list' => array() 
						);
																
		
		if ( !empty( $topics ) )
		{
			$tempTopics = array();
							
			//Get the sticky posts first
			foreach ( $topics as $temp )
			{
				if ( !isset( $posts[$temp] ) )
					continue;
								
				if ( $posts[$temp]['type'] !== 'sticky' )
					continue;
								
				$tempTopics[$temp] = array( 'date' => $posts[$temp]['date'] );
			}
							
			//Get normal posts
			foreach ( $topics as $temp )
			{
				if ( !isset( $posts[$temp] ) )
					continue;
								
				if ( $posts[$temp]['type'] !== 'published' )
					continue;
								
					$tempTopics[$temp] = array( 'date' => $posts[$temp]['date'] );
			}
							
			@array_multisort( array_column( $tempTopics, 'date' ), SORT_DESC, SORT_LOCALE_STRING, $tempTopics );
							
			foreach ( $tempTopics as $topic => $s )
			{
								//if ( !isset( $posts[$topic] ) )
									//continue;
								
				$postStarter = $this->getUserDetails( $format, $posts[$topic]['username'] );
								
				$replies = $this->getReplies( $topic );
								
				if ( !empty( $replies ) )
				{
					//order the replies according to their date
					array_multisort( array_column( $replies, 'date' ), SORT_ASC, SORT_NUMERIC, $replies );
									
					$last = end ( $replies );
					
					$topicUrl = $this->site_url() . ( !empty( $uri['lang'] ) ? $uri['lang'] . '/' : '' ) . 'topic/' . $topic . '#post-' . $last['id'];
					
					if ( $amp )
						$topicUrl = $this->site_url() . ( !empty( $uri['lang'] ) ? $uri['lang'] . '/' : '' ) . 'amp/' . $topic . '#post-' . $last['id'];
									
					$lastReply = array
								(
												'title' => htmlspecialchars( $last['title'] ),
												'topicURL' => $topicUrl,
												'date' => $last['date'],
												'dateNice' => niceTime( $last['date'] )
								);
									
					unset( $last );
									
				}
				
				else
					$lastReply = array();
								
				$date = date ( $format, strtotime( $posts[$topic]['date'] ) );
								
				$userUrl = $this->site_url() . ( !empty( $uri['lang'] ) ? $uri['lang'] . '/' : '' ) . 'user/';
				
				$url = $this->site_url() . ( !empty( $uri['lang'] ) ? $uri['lang'] . '/' : '' ) . 'topic/' . $topic;
				
				if ( $amp )
					$url = $this->site_url() . ( !empty( $uri['lang'] ) ? $uri['lang'] . '/' : '' ) . 'amp/' . $topic;
								
				$content['list'][$topic] = array(
													'title' => $posts[$topic]['title'],
													'isSticky' => ( ( $posts[$topic]['type'] === 'sticky' ) ? true : false ),
													'date' => $date,
													'postStarter' => array(
																	'username' => $postStarter['userName'],
																	'nickcame' => $postStarter['nickName'],
																	'profileURL' => $userUrl . $postStarter['userName'],
																	'email' => $postStarter['email'],
																	'registered' => $postStarter['registered'],
																	'avatar' => gravatarUrl( $postStarter['email'] ) 
																),
													'topicReplies' => count( $replies ),
													'lastReply' => $lastReply,
													'url' => $url
											);
			}
		}
		
		return $content;
	}
	
	public function getProductRelated ( $key, $cat, $total = 4 ) 
	{
		global $categories;
		
		$db = $categories->db;
		
		$uri = $this->uri;
		
		$posts = $this->openDB( DB_PAGES );

		$related = array();
		
		if ( !empty( $cat ) && isset( $db[$cat] ) )
		{
			$list = $db[$cat]['list'];
			
			if ( !empty( $list ) )
			{
				$i = 0;
				
				foreach( $list as $p )
				{
					if ( $p == $key )
						continue;
					
					if ( $i == $total )
						break;
					
					if ( isset( $posts[$p] ) )
					{
						$page = $posts[$p];
						
						$uuid = $page['uuid'];
						
						if ( !empty( $page['coverImage'] ) )
						{
							$image = $this->site_url() . 'bl-content/uploads/pages/' . $uuid . '/' . $page['coverImage'];
							
							$path_parts = pathinfo( $image );
							
							$filename = $path_parts['filename'];
						}
						else
						{
							$image = $this->htmlPath() . 'files/noimage.png';
							
							$filename = 'noimage';
						}
						
						$values = array();
						
						$reviews = array();
						
						$file = PATH_PAGES . $p . DS . 'values.php';
						
						$fileReviews = PATH_PAGES . $p . DS . 'reviews.php';
												
						if ( file_exists ( $file ) )
							$values = $this->openDB( $file );
						
						$rate = 0;
						$finalRate = 0;
						
						if ( file_exists ( $fileReviews ) )
						{
							$reviews = $this->openDB( $fileReviews );
							
							if ( !empty( $reviews ) )
							{
								$totalRatings = 0;
								
								foreach ( $reviews as $k => $r )
								{
									$totalRatings += $r['rating'];
								}
								
								$rate = ceil( $totalRatings / 5 );
								
								$finalRate = ceil( 20 * $rate );
							}
						}
						
						$prodURL = $this->site_url();
						
						if ( !$this->getValue( 'hide-slug' ) )
						{
							if ( !empty( $uri['lang'] ) )
							{								
								$prodURL .= $uri['lang'] . '/';
							}
							
							if ( !empty( $uri['blog'] ) )
							{							
								$prodURL .= $uri['blog'] . '/';
							}
						}
						
						$prodURL .= $p;
						
						//Don't add a link to cart, if the product is affilliate
						$addToCartUrl = ( ( !empty( $values ) && ( $values['type'] == 'normal' ) ) ? $prodURL . '?add=' . $uuid : '' );
						
						$price = ( ( !empty( $values ) && !empty( $values['price-sale'] ) ) ? $this->formatPrice( $values['price-sale'] ) : '' );
						
						$priceReg = ( ( !empty( $values ) && !empty( $values['price-regular'] ) ) ? $this->formatPrice( $values['price-regular'] ) : '' );
						
						$related[$p] = array(
												'title' => $page['title'],
												'position' => $page['position'],
												'image' => $image,
												'uuid' => $uuid,
												'url' => $prodURL,
												'addToCartUrl' => $addToCartUrl,
												'first' => ( empty( $i ) ? true : false ),
												'categoryKey' => $cat,
												'priceReg' => $priceReg,
												'price' => $price,
												'filename' => $filename,
												'totalRates' => $rate,
												'ratings' => $finalRate,
												'reviewsNum' => count( $reviews ),
						);
					}
					
					$i++;
				}
				
			}
		}
		
		return $related;
	}
	
	public function scanFiles ( $dir, $uuid, $avoid = '' ) 
	{
		$files = array();
		
		$img = false;
		
		if ( !empty( $avoid ) )
		{
			$avoid = explode ( '/', $avoid );
			
			$img = end ( $avoid );
		}
		
		if ( $handle = opendir( $dir ) ) 
		{
			while ( false !== ( $entry = readdir( $handle ) ) ) 
			{
				if ( $entry != "." && $entry != ".." ) 
				{
					if ( $img && ( $img == $entry ) )
						continue;
					
					if ( is_dir( $entry ) || ( $entry == 'thumbnails' ) )
						continue;
					
					$path_parts = pathinfo( $entry );
					
					$files[] = array( 'name' => $path_parts['filename'] , 'url' => $this->site_url() . 'bl-content/uploads/pages/' . $uuid . '/' . $entry );
				}
			}

			closedir( $handle );
		}
		
		return $files;
	}
	
	/**
	 * Returns the currency information
	 *
	 * @return array
	 * /
	public function getCurrencyData ()
	{
		if ( $this->getValue( 'enable-shop' ) === 'disable' )
			return;
		
		$curr = array();
		
		require ( $this->phpPath() . 'php' . DS . 'arrays.php' );
		
		$data = $this->getValue( 'store-settings' );
		
		if ( !empty( $data['currency'] ) )
			$cur = $data['currency'];
		
		if ( isset( $currency[$cur] ) )
			$curr = $currency[$cur];
		
		return $curr;
	}
	*/
	
	/**
	 * Return the price formatted
	 *
	 * Returns the price data of a page formatted with currency
	 *
	 * @param float $price The price of the page to return
	 * @param string $currency The currency you want to use.
	 * @return string
	 */
	public function formatPrice( $price, $thoussep = ',', $decsep = '.', $dec = 0, $cur = '', $pos = 'right' )
	{

		if ( $this->getValue( 'enable-shop' ) === 'disable' )
			return false;

		require ( $this->phpPath() . 'php' . DS . 'arrays.php' );
		
		$data = $this->getValue( 'store-settings' );
		
		if ( !empty( $data ) )
		{
			if ( !empty( $data['currencyposition'] ) )
				$pos = (string) $data['currencyposition'];
			
			if ( !empty( $data['currency'] ) )
				$cur = (string) $data['currency'];
			else
				$cur = 'euro-eur';
			
			if ( !empty( $data['decimalsep'] ) )
				$decsep = (string) $data['decimalsep'];
			
			if ( !empty( $data['decimalnum'] ) )
				$dec = (int) $data['decimalnum'];
			
			if ( !empty( $data['thousandsep'] ) )
				$thoussep = (string) $data['thousandsep'];
			
		}
		
		$curr = ( isset( $currency[$cur] ) ? $currency[$cur] : '' ); //$currency[$cur]['symbol'] : '€' );
		
		$symbol = ( $curr ? $currency[$cur]['symbol'] : '' );
		
		$price = str_replace( ',', '.', trim( $price ) );
		
		$p = number_format ( $price, $dec, $decsep, $thoussep );
		
		switch ( $pos ) 
		{
			case 'left':
				$f = $symbol . $p;
				break;
			case 'left-space':
				$f = $symbol . ' ' . $p;
				break;
			case 'right-space':
				$f = $p . ' ' . $symbol;
				break;
			case 'right':
				$f = $p . $symbol;
				break;
			default:
				$f = $symbol . $p;
		}
			
		//$f = ( ( $pos == 'left' ) ? $symbol : '' );
		
		//$f = ( ( $pos == 'left-space' ) ? $symbol . ' ' : '' ) );
		
		//$f .= $p;
		
		//$f .= ( ( ( $pos == 'right' ) || ( $pos == 'right-space' ) ) ? $symbol . ( ( $pos == 'right-space' ) ? ' ' : '' ) );
		
		//$f .= ( ( $pos == 'right' ) ? ' ' . $symbol : '' );
		
		$format = array(
						'price' => $price,
						'priceNoCur' => $p,
						'priceFormatted' => $f,
						'currencySymbol' => ( $curr ? $currency[$cur]['symbol'] : '€' ),
						'currencyName' => ( $curr ? $currency[$cur]['title'] : 'Euro' ),
						'currencycode' => ( $curr ? $currency[$cur]['code'] : 'EUR' )
		);
	
		return $format;
	
	}
	
	public function getUser( $username, $dateFormat )
	{
		$users = $this->getAllMembers( true );
		
		if ( !isset( $users[$username] ) )
			return false;
		
		global $L;
		
		$uri = $this->uri;
		
		$temp = $users[$username];
		
		unset( $users );
		
		$isAdmin = ( ( $temp['role'] === 'admin' ) ? true : false );
		
		$isMod = ( $isAdmin ? true : false );
		
		$userRegistered = @date ( $dateFormat, strtotime( $temp['registered'] ) );
		
		$userRegisteredNice = niceTime( strtotime( $temp['registered'] ) );
		
		$url = $this->site_url() . ( !empty( $uri['lang'] ) ? $uri['lang'] . '/' : '' ) . 'user/' . $username;

		$user = array(
					'isAdmin' => $isAdmin,
					'isMod' => $isMod,
					'isLogged' => false,//change this later
					'userName' => $username,
					'nickName' => $temp['nickname'],
					'userRole' => $temp['role'],
					'email' => $temp['email'],
					'avatar' => gravatarUrl( $temp['email'] ),
					'canBrowse' => true,
					'description' => $temp['description'],
					'social' => array(
									'facebook' => array( 'name' => 'Facebook', 'url' => $temp['facebook'] ),
									'twitter' => array( 'name' => 'Twitter', 'url' => $temp['twitter'] ),
									'instagram' => array( 'name' => 'Instagram', 'url' => $temp['instagram'] ),
									'github' => array( 'name' => 'Github', 'url' => $temp['github'] ),
									'linkedin' => array( 'name' => 'Linkedin', 'url' => $temp['linkedin'] ),
									'vk' => array( 'name' => 'VK', 'url' => $temp['vk'] )
								),
					'urls' => array(
									'profile' => array( 'url' => $url, 'title' => $L->get( 'profile' ), 'current' => ( empty( $_GET ) ? true : false ) ),
									'topics' => array( 'url' => $url . '?topics', 'title' => $L->get( 'topics-started' ), 'current' => ( isset( $_GET['topics'] ) ? true : false ) ),
									'replies' => array( 'url' => $url . '?replies', 'title' => $L->get( 'replies-created' ), 'current' => ( isset( $_GET['replies'] ) ? true : false ) ),
									//'engagements' => $url . '?engagements',
									//'favorites' => $url . '?favorites'
								),
						'registered' => $userRegistered,
						'registeredNice' => $userRegisteredNice
					);
					
		return $user;
	}
	
	
	
	public function pageBegin()
	{
		$uri = $this->uri;
		
		if ( empty( $uri ) )
			return false;

		global $L;

		$html = '';
		
		if ( !empty( $uri['postType'] ) && ( $uri['postType'] == 'product' ) )
		{
			global $content;
			
			$storeUrl = $this->site_url() . ( !empty( $uri['lang'] ) ? $uri['lang'] . '/' : '' ) . $uri['blog'];
			
			$html = '<nav class="woocommerce-breadcrumb"><a href="' . $this->site_url() . '">' . $L->get( 'forum-home' ) . '</a>&nbsp;&#47;&nbsp;<a href="' . $storeUrl . '">' . $L->get( 'tab-shop' ) . '</a>&nbsp;&#47;&nbsp;<a href="' . $content['categoryURL'] . '">' . $content['category'] . '</a>&nbsp;&#47;&nbsp;' . $content['title'] . '</nav>';
		}
		
		if ( !empty( $uri['postType'] ) && ( $uri['postType'] == 'forum' ) )
		{
			$html .= '<div class="breadcrumb">';
			
			$html .= '<p><a href="' . $this->site_url() . '" class="bbp-breadcrumb-home">' . $L->get( 'forum-home' ) . '</a> <span class="bbp-breadcrumb-sep">&rsaquo;</span> <span class="bbp-breadcrumb-current">' . $L->get( 'forum-nav' ) . '</span></p>';
			
			$html .= '</div>';
		}
		
		if ( !empty( $uri['postType'] ) && ( $uri['postType'] == 'thread' ) )
		{
			global $content;
			
			if ( !empty( $content ) )
			{
				$html .= '<div class="breadcrumb">';
				
				$html .= '<p><a href="' . $this->site_url() . '" class="bbp-breadcrumb-home">' . $L->get( 'forum-home' ) . '</a> <span class="bbp-breadcrumb-sep">&rsaquo;</span> <a href="' . $this->site_url() . ( !empty( $uri['lang'] ) ? $uri['lang'] . '/' : '' ) . $uri['blog'] . '" class="bbp-breadcrumb-root">' . $L->get( 'forum-nav' ) . '</a> <span class="bbp-breadcrumb-sep">&rsaquo;</span> <span class="bbp-breadcrumb-current">' . $content['topicTitle'] . '</span></p>';
				
				$html .= '</div>';
			}
		}
		
		if ( !empty( $uri['postType'] ) && ( $uri['postType'] == 'topic' ) )
		{
			global $content;
			
			$html .= '<div class="breadcrumb">';
			
			$fullURL = ( ( isset( $_SERVER['HTTPS'] ) && ( $_SERVER['HTTPS'] == 'on' ) ) ? 'https' : 'http' ) . '://' . $_SERVER["SERVER_NAME"] . $_SERVER['REQUEST_URI'];
			if ( !empty( $content ) )
			{
				$html .= '<p><a href="' . $this->site_url() . '" class="bbp-breadcrumb-home">' . $L->get( 'forum-home' ) . '</a> <span class="bbp-breadcrumb-sep">&rsaquo;</span> <a href="' . $this->site_url() . ( !empty( $uri['lang'] ) ? $uri['lang'] . '/' : '' ) . $uri['blog'] . '" class="bbp-breadcrumb-root">' . $L->get( 'forum-nav' ) . '</a> <span class="bbp-breadcrumb-sep">&rsaquo;</span> <a href="' . $content['parent']['url'] . '" class="bbp-breadcrumb-root">' . $content['parent']['title'] . '</a> <span class="bbp-breadcrumb-sep">&rsaquo;</span> <span class="bbp-breadcrumb-current">' . $content['topicTitle'] . '</span></p>';
			
				if ( !empty( $content['currentUser']['isLogged'] ) )
				{
					$html .= '<span id="subscription-toggle">&nbsp;|&nbsp;<span id="subscribe-41"  ><a href="' . $fullURL . '?action=forum_subscribe&#038;object_id=41&#038;object_type=post&#038;_wpnonce=143c83e09a" class="subscription-toggle" data-bbp-object-id="41" data-bbp-object-type="0" data-bbp-nonce="143c83e09a" rel="nofollow">Subscribe</a></span></span>';
					
					$html .= '<span id="favorite-toggle"><span id="favorite-41"  ><a href="' . $fullURL . '?action=forum_favorite_add&#038;object_id=41&#038;_wpnonce=2c8106f923" class="favorite-toggle" data-bbp-object-id="41" data-bbp-object-type="post" data-bbp-nonce="2c8106f923" rel="nofollow">Favorite</a></span></span>';
				}
			
				$url = '<a href="' . $content['lastUpdate']['url'] . '" title="View ' . $content['lastUpdate']['nickname'] . '&#039;s profile" class="bbp-author-link"><span  class="bbp-author-name">' . $content['lastUpdate']['nickname'] . '</span></a>';
			
				$html .= '<div class="bbp-template-notice info"><ul><li class="bbp-topic-description">' . sprintf( $L->get( 'topic-has-replies' ), $content['numReplies'] ) . '. ' . sprintf( $L->get( 'topic-last-updated' ), $content['lastUpdate']['niceTime'], $url ) . '.</li></ul></div>';
				
			}
			
			$html .= '</div>';
		}
				
		return $html;
	}
	
	public function siteBodyEnd()
	{
		global $L;
		
		$html = '';
		
		$uri = $this->uri;
		
		if ( !empty( $uri['postType'] ) && ( ( $uri['postType'] == 'product' ) || ( $uri['postType'] == 'thread' ) || ( $uri['postType'] == 'topic' ) ) )
		{
			if ( $this->getValue( 'enableantispam' ) )
			{
				$antiSpamData = $this->getValue( 'antispam-settings' );

				if ( !empty( $antiSpamData['siteKey'] ) && !empty( $antiSpamData['secretKey']) )
					$html .= '<script src="https://www.google.com/recaptcha/api.js" async defer></script>'. PHP_EOL;
					
			}
		}
		
		if ( $this->getValue( 'cookieconsent' ) === true )
		{
			global $langDetails;
			
			$html .= '<!-- Begin Cookie Consent plugin by Silktide - http://silktide.com/cookieconsent -->'.PHP_EOL;
			
			$options = array(
							'message' => htmlspecialchars( $langDetails['cookieConsentMessage'] ),
							'dismiss' => $langDetails['cookieConsentButtonText'],
							'learnMore' => $langDetails['cookieConsentMoreText'],
							'link' => $langDetails['cookieConsentUrl'],
							'theme' => $this->getValue( 'cookieconsenttheme' )
			);
			
			$html .= '<script type="text/javascript">' . PHP_EOL;
						
			$html .= 'window.cookieconsent_options = ' . json_encode( $options, JSON_UNESCAPED_UNICODE ) . PHP_EOL;
			
			$html .= '</script>' . PHP_EOL;

			$html .= '<script async type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/1.0.9/cookieconsent.min.js"></script>' . PHP_EOL;
			
			$html .= '<!-- End Cookie Consent -->' . PHP_EOL;
		}
		
		if ( checkKey( $this->getValue( 'seo-settings' ), 'lazyLoad' ) )
		{
			$html .= '<script src="' . $this->htmlPath() . 'plugins/lazysizes-gh-pages/lazysizes.min.js"></script>'.PHP_EOL;
		}
		
		return $html;
	}
	
	public function contactPage()
	{
		$uri = $this->uri;
		
		if ( empty( $uri ) )
			return false;
				
		if ( !empty( $uri['whereAmI'] ) && ( $uri['whereAmI'] == 'page' ) )
		{
			if ( !empty( $uri['lang'] ) )
			{
				$data = $this->openDB( DB_LANGS );
				
				if ( isset( $data[$uri['lang']] ) )
				{
					$contactPage = $data[$uri['lang']]['contactPageSlug'];
					
					if ( !empty( $contactPage ) && ( $contactPage === $uri['pageSlug'] ) )
						return true;
				}
				
				unset( $data );
			}
			
			else
			{
				if ( !empty( $this->getValue( 'default-lang-extra' ) ) )
				{
					$contactPage = ( isset( $this->getValue( 'default-lang-extra' )['contactPageSlug'] ) ? $this->getValue( 'default-lang-extra' )['contactPageSlug'] : '' );
				
					if ( !empty( $contactPage ) && ( $contactPage === $uri['pageSlug'] ) )
						return true;
				}
				
				return false;
			}
		}
		
		return false;
	}
	
	public function contactPageTitle()
	{
		$uri = $this->uri;
		
		if ( empty( $uri ) )
			return false;
		
		$contactPageTitle = ( checkKey( $this->getValue( 'default-lang-extra' ), 'contactPageTitle' ) ? $this->getValue( 'default-lang-extra' )['contactPageTitle'] : '' );
		
		if ( !empty( $uri['lang'] ) )
		{
			$data = $this->openDB( DB_LANGS );
				
			if ( isset( $data[$uri['lang']] ) )
			{
				$title = $data[$uri['lang']]['contactPageTitle'];
					
				if ( !empty( $title ) )
					$contactPageTitle = $title;
			}
				
			unset( $data );
		}

		return $contactPageTitle;
	}
	
	public function archivePageTitle()
	{
		$uri = $this->uri;
		
		if ( empty( $uri ) )
			return false;
		
		$archivePageTitle = ( checkKey( $this->getValue( 'default-lang-extra' ), 'archivePageTitle' ) ? $this->getValue( 'default-lang-extra' )['archivePageTitle'] : '' );
		
		if ( !empty( $uri['lang'] ) )
		{
			$data = $this->openDB( DB_LANGS );
				
			if ( isset( $data[$uri['lang']] ) )
			{
				$title = $data[$uri['lang']]['archivePageTitle'];
					
				if ( !empty( $title ) )
					$archivePageTitle = $title;
			}
				
			unset( $data );
		}

		return $archivePageTitle;
	}
	
	public function archivePage()
	{
		$uri = $this->uri;
		
		if ( empty( $uri ) )
			return false;
				
		if ( !empty( $uri['whereAmI'] ) && ( $uri['whereAmI'] == 'page' ) )
		{
			if ( !empty( $uri['lang'] ) )
			{
				$data = $this->openDB( DB_LANGS );
				
				if ( isset( $data[$uri['lang']] ) )
				{
					$archivePage = $data[$uri['lang']]['archivePageSlug'];
					
					if ( !empty( $archivePage ) && ( $archivePage === $uri['pageSlug'] ) )
						return true;
				}
				
				unset( $data );
			}
			
			else
			{
				if ( !empty( $this->getValue( 'default-lang-extra' ) ) )
				{
					$archivePage = ( isset( $this->getValue( 'default-lang-extra' )['archivePageSlug'] ) ? $this->getValue( 'default-lang-extra' )['archivePageSlug'] : '' );
				
					if ( !empty( $archivePage ) && ( $archivePage === $uri['pageSlug'] ) )
						return true;
				}
				
				return false;
			}
		}
		
		return false;
	}
	
	private function archivePageHTML()
	{
		global $L, $categories;
		
		$uri = $this->uri;
		
		$html = '<h2>' . $this->archivePageTitle() . '</h2>';
		
		$html .= '<ul>';
		
		$blogs = $this->blogs;
		
		$posts = $this->openDB( DB_PAGES );
		
		$categoriesDB = $categories->db;
		
		$html .= '<ul>';
		
		//This will add every post that is not in any other blogs
		foreach ( $posts as $pageKey => $post )
		{
			$searchLang = $this->searchKey( $pageKey, 'langs' );
			
			$searchBlog = $this->searchKey( $pageKey );
			
			if ( !empty( $searchBlog ) )
				continue;
			
			//Skip the page, if we don't have a lang
			if ( empty( $uri['lang'] ) && !empty( $searchLang ) )
				continue;
					
			if ( !empty( $uri['lang'] ) && empty( $searchLang ) )
				continue;
			
			$url = $this->site_url() . ( !empty( $uri['lang'] ) ? $uri['lang'] . '/' : '' ) . $pageKey;
			
			$html .= '<li><a href="' . $url . '">' . $post['title'] . '</a></li>';

		}
		
		//Categories
		$html .= '<ul>';
		
		$html .= '<h2>' . $L->get( 'categories' ) . '</h2>';
				
		foreach ( $categoriesDB as $key => $fields)
		{
			$searchLang = $this->searchCategory ( $key, true, false );
			
			$searchBlog = $this->searchCategory ( $key, false, true );
					
			if ( !empty( $searchBlog ) )
				continue;
					
			//Skip the category, if we don't have a lang
			if ( empty( $uri['lang'] ) && !empty( $searchLang ) )
				continue;
					
			if ( !empty( $uri['lang'] ) && empty( $searchLang ) )
				continue;
					
			$count = count( $fields['list'] );
					
			$url = $this->site_url() . ( !empty( $uri['lang'] ) ? $uri['lang'] . '/' : '' ) . '/category/' . $key;
						
			if ( $count > 0 ) 
			{
				$html .= '<li>';
				$html .= '<a href="' . $url . '">';
				$html .= $fields['name'];
				$html .= ' ('. $count .')';
				$html .= '</a>';
				$html .= '</li>';
			}
		}

		$html .= '</ul>';
		
		$html .= '</ul>';
			
		//Nothing to do here if we don't have any page
		if ( !empty ( $blogs ) )
		{
			foreach ( $blogs as $blogKey => $blog )
			{
				//If the blog is not enabled for this lang, skip it
				if ( !empty( $uri['lang'] ) && ( ( $blog['enabled'] !== 'everywhere' ) || ( $blog['enabled'] !== $uri['lang'] ) ) )
					continue;
				
				//If the blog is disabled, then skip it
				if ( !empty( $blog['disable'] ) )
					continue;
				
				//If the blog has no posts, then skip it
				if ( empty( $blog['list'] ) )
					continue;
				
				$html .= '<ul><h2>' . $blog['name'] . '</h2>';
				 
				foreach( $blog['list'] as $page )
				{
					if ( !isset( $posts[$page] ) )
						continue;
					
					$searchLang = $this->searchKey( $page, 'langs' );
					
					//Skip the page, if we don't have a lang
					if ( empty( $uri['lang'] ) && !empty( $searchLang ) )
						continue;
					
					if ( !empty( $uri['lang'] ) && empty( $searchLang ) )
						continue;

					$link = $this->buildUrlByKey( $page );
					
					$html .= '<li><a href="' . $link . '">' . $posts[$page]['title'] . '</a></li>';
					
				}
				 
				$html .= '</ul>';
				
				if ( ( $this->getValue( 'enable-forum' ) !== 'disable' ) && ( $this->getValue( 'enable-forum' ) == $blogKey ) )
					continue;
				
				//Categories
				$html .= '<ul>';
				$html .= '<h2>' . $L->get( 'categories' ) . '</h2>';
				
				foreach ( $categoriesDB as $key=>$fields)
				{
					$searchLang = $this->searchCategory ( $key, true, false );
			
					$searchBlog = $this->searchCategory ( $key, false, true );
					
					if ( empty( $searchBlog ) || ( $searchBlog['blog'] !== $blogKey ) )
						continue;
					
					//Skip the page, if we don't have a lang
					if ( empty( $uri['lang'] ) && !empty( $searchLang ) )
						continue;
					
					if ( !empty( $uri['lang'] ) && empty( $searchLang ) )
						continue;
					
					$count = count($fields['list']);
					
					$url = $this->site_url() . ( !empty( $uri['lang'] ) ? $uri['lang'] . '/' : '' ) . $blogKey . '/category/' . $key;
						
					if ( $count > 0 ) 
					{
						$html .= '<li>';
						$html .= '<a href="' . $url . '">';
						$html .= $fields['name'];
						$html .= ' ('. $count .')';
						$html .= '</a>';
						$html .= '</li>';
					}
				}
				
				$html .= '</ul>';
			}

			$html .= '</ul>';
		}
		
		$html .= '</ul>';
		
		return $html;
	}
	
	private function contactPageHTML()
	{
		global $L;
		
		$uri = $this->uri;
		
		$error = false;
		$isBot = false;
		$honeypot = false;
		$recaptcha = false;
		
		$html = '<style>contactPage { margin: 30px 0 }</style>' . PHP_EOL;
		
		$html .= '<div class="contactPage">';
		
		$name = ( isset( $_POST['namekkkk'] ) ? sanitize( $_POST['namekkkk'] ) : '' );
		
		$message = ( isset( $_POST['message'] ) ? sanitize( $_POST['message'] ) : '' );
		
		$email = ( isset( $_POST['emailkkkk'] ) ? sanitizeEmail( $_POST['emailkkkk'] ) : '' );
			
		$emailVal = ( isset( $_POST['emailkkkk'] ) ? validateEmail( $_POST['emailkkkk'] ) : false );
		
		if ( isset( $_POST['submitEmail'] ) )
		{
			if ( !$emailVal )
				$error = $L->get('valid-email');
			
			elseif ( ( isset( $_POST['email'] ) && !empty( $_POST['email'] ) ) || ( isset( $_POST['name'] ) && !empty( $_POST['name'] ) ) || !checkFormHash( $_POST['tokenCSRF'] ) )
				$isBot = true;
			
			elseif ( isset( $_POST['g-recaptcha-response'] ) )
			{
				if ( !$this->checkRecaptcha ( $_POST['g-recaptcha-response'] ) )
					$error = $L->get('valid-recaptcha');
			}
		}

		if ( !$emailVal || $error )
		{
			$html .= '<h3>' . $this->contactPageTitle() . '</h3>' . PHP_EOL;
			$html .= '<form method="post" action="' . currentURL() . '#emailForm" id="emailForm">' . PHP_EOL;
			
			$html .= '<input type="hidden" name="tokenCSRF" value="' . generateFormHash() . '">' . PHP_EOL;
			
			$html .= '<div class="form-group">
			   <input id="name" type="text" name="namekkkk" value="' . $name . '" placeholder="' . $L->get('enter-your-name') . '" class="form-control" required>
			</div>' . PHP_EOL;

			$html .= '<div class="form-group">
			   <input id="email" type="email" name="emailkkkk" value="' . $email . '" placeholder="' . $L->get('enter-your-email') . '" class="form-control" required>
			</div>' . PHP_EOL;

			$html .= '<div class="form-group">
			   <textarea id="message" rows="6" name="message" placeholder="' . $L->get('enter-your-message') . '" class="form-control" required>' . $message . '</textarea>
			</div>' . PHP_EOL;
			
			if ( $this->getValue( 'enableantispam' ) )
			{
				$antiSpamData = $this->getValue( 'antispam-settings' );
								
				if ( isset( $antiSpamData['honeypot'] ) && ( $antiSpamData['honeypot'] === true ) )
					$honeypot = true;
				
				if ( !empty( $antiSpamData['siteKey'] ) && !empty( $antiSpamData['secretKey']) )
					$recaptcha = $antiSpamData['siteKey'];
				
				unset( $antiSpamData );
			}
			
			if ( $recaptcha )
			{
				$html .= '<p><div class="g-recaptcha" data-sitekey="' . $recaptcha . '"></div></p>' . PHP_EOL;
			}
			
			if ( $honeypot )
			{
				$html .= '<label class="ohnohoney" for="name"></label>' . PHP_EOL;
				
				$html .= '<input class="ohnohoney" autocomplete="off" type="text" id="name" name="name" placeholder="Your name here">' . PHP_EOL;
				
				$html .= '<label class="ohnohoney" for="email"></label>' . PHP_EOL;
				
				$html .= '<input class="ohnohoney" autocomplete="off" type="email" id="email" name="email" placeholder="Your e-mail here">';

			}
			
			if ( $error )
				$html .= '<p><strong>' . $error . '</strong></p>';
			
			$html .= '<button id="submit" name="submitEmail" type="submit" class="btn btn-primary">' . $L->get('send') . '</button>' . PHP_EOL;
			$html .= '</form>' . PHP_EOL;
			
			
		}
		else
		{
			//Don't send the email if there is a bot around, but keep it a secret
			if ( !$isBot )
			{
				$this->send_email ( $email, $message, $name );
			}
			
			$html .= '<p><strong>' . $L->get('email-sent') . '</strong></p>';
		}
		
		$html .= '</div>' . PHP_EOL;
		
		return $html;
	}
	
	
	private function send_email ( $email, $message, $name )
	{
		global $site, $L;
		
		$title = '[' . $site->title() .'] ' .  sprintf( $L->get( 'email-sent' ), $name );
		
		$headers = "From: " . $email . "'\r\n";
		$headers .= "Reply-To: " . $email . "'\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=" . CHARSET . "\r\n";
		$headers .= 'Content-transfer-encoding: 8bit' ."\r\n";
		$headers .= 'Date: ' .date("D, j M Y G:i:s O")."\r\n";

		if ( @mail( $email, $title, $message, $headers ) )
			return true;
		else
			return false;
	}
	
	public function pageEnd()
	{
		$uri = $this->uri;
		
		if ( empty( $uri ) )
			return false;
		
		global $L;
		
		$html = '';
		
		$honeypot = false;
		
		$recaptcha = false;
		
		if ( $this->getValue( 'enableantispam' ) )
		{
			$antiSpamData = $this->getValue( 'antispam-settings' );
							
			if ( isset( $antiSpamData['honeypot'] ) && ( $antiSpamData['honeypot'] === true ) )
				$honeypot = true;
			
			if ( !empty( $antiSpamData['siteKey'] ) && !empty( $antiSpamData['secretKey']) )
				$recaptcha = $antiSpamData['siteKey'];
			
			unset( $antiSpamData );
		}
		
		if ( !empty( $uri['whereAmI'] ) && ( $uri['whereAmI'] == 'page' ) && $this->archivePage() )
		{
			$html .= $this->archivePageHTML();
		}
		
		if ( !empty( $uri['whereAmI'] ) && ( $uri['whereAmI'] == 'page' ) && $this->contactPage() )
		{
			$html .= $this->contactPageHTML();
		}
		
		if ( !empty( $uri['postType'] ) && ( $uri['postType'] == 'product' ) )
		{
			global $content;
			
			if ( empty( $content ) )
				return;

			$html .= reviewForm( $content, $this->site_url(), $honeypot, $recaptcha );
		}
		
		if ( !empty( $uri['postType'] ) && ( $uri['postType'] == 'forum' ) )
		{
			global $content;
			
			if ( empty( $content ) )
				return;
			
			if ( empty( $content['canBrowse'] ) )
			{			
				$html .= guestNoBrowse();
			}
		}
		
		if ( !empty( $uri['postType'] ) && ( $uri['postType'] == 'thread' ) )
		{
			global $content;
			
			if ( empty( $content ) )
				return;
			
			if ( empty( $content['currentUser']['canBrowse'] ) )
			{			
				$html .= guestNoBrowse();
			}
			else
			{
				
				if ( !$content['allowAnonymous'] && !$content['currentUser']['isLogged'] )
				{
					$html .= guestForm( $content );
				}
					
				else
				{
					$html .= threadForm( $content, $this->site_url(), $honeypot, $recaptcha );
				}
			}
		}
		
		if ( !empty( $uri['postType'] ) && ( $uri['postType'] == 'topic' ) )
		{
			global $content;
			
			if ( empty( $content ) )
				return;
			
			if ( empty( $content['currentUser']['canBrowse'] ) )
			{			
				$html .= guestNoBrowse();
			}
			else
			{
				//First, let's check if we want comments. If no, allow only the mods
				if ( !$content['allowComments'] && !$content['currentUser']['isMod'] )
				{
					$html .= noReply( $content );
				}
				
				else
				{
					if ( !$content['allowAnonymous'] && !$content['currentUser']['isLogged'] )
					{
						$html .= guestForm( $content );
					}
					
					else
					{
						
						$html .= commentForm( $content, $this->site_url(), $honeypot, $recaptcha );

					}
				}
			}		
		}
		
		return $html;
	}
	
	public function embedURL ( $text, $amp = false )
	{
		if ( $amp )
			return ampEmbed( $text );
		else
			return urlToEmbed( $text );
	}
	
	public function builDescription()
	{
		global $langDetails, $site;
		
		$uri = $this->uri;
		
		$descr = '';
		
		if ( empty( $uri ) )
			return $descr;
		
		if ( $uri['whereAmI'] == 'home' )
		{
			if ( empty ( $uri['blog'] ) ) 
			{
				if ( empty( $langDetails['isLang'] ) )
				{
					$descr .= htmlspecialchars( $site->description() );
				}
				else
				{
					$descr .= htmlspecialchars( html_entity_decode( $langDetails['description'] ) );
				}
				
			}
			else
			{
				$blogs = $this->blogs;
				
				$blog = $blogs[$uri['blog']];
				 
				if ( empty( $langDetails['isLang'] ) )
				{
					$descr .= htmlspecialchars( html_entity_decode( $blog['description'] ) );
				}
				else
				{
					$descr .= htmlspecialchars( html_entity_decode( $langDetails['slogan'] ) );
				}
				
			}
			
		}
		elseif ( $uri['whereAmI'] == 'page' )
		{
			global $page;
			
			if ( empty( $langDetails['isLang'] ) )
			{
				if ( $uri['postType'] == 'user' )
				{
					global $content;
					
					$descr .= htmlspecialchars( $content['nickName'] . '\'s profile on ' .  $site->title() );
				}
				
				else
					$descr .= htmlspecialchars( $page->description() );
			}
			else
			{
				if ( $uri['postType'] == 'user' )
				{
					global $content;
					
					$descr .= htmlspecialchars( $content['nickName'] . '\'s profile on ' .  html_entity_decode( $langDetails['name'] ) );
				}
				
				else
					$descr .= htmlspecialchars( $page->description() );
			}
		}
		
		return $descr;
	}
	
	public function buildTitle( $sitename = true )
	{
		global $langDetails, $site, $url;
		
		$uri = $this->uri;
		
		if ( empty( $uri ) )
		{
			global $L;
			return $L->get( 'page-not-found-error' );
		}
		
		$title = '';
		
		if ( $uri['whereAmI'] == 'home' )
		{
			if ( empty ( $uri['blog'] ) ) 
			{
				if ( empty( $langDetails['isLang'] ) )
				{
					$title .= htmlspecialchars( $site->slogan() );
					
					if ( $url->parameter('page') !== false )
						$title .= ' - Page: ' . $url->parameter('page');
					
					$title .= ( $sitename ? ' | ' . htmlspecialchars( $site->title() ) : '' );
				}
				else
				{
					$title .= htmlspecialchars( html_entity_decode( $langDetails['slogan'] ) ) ;
					
					if ( $url->parameter('page') !== false )
						$title .= ' - Page: ' . $url->parameter('page');
					
					$title .= ( $sitename ? ' | ' . htmlspecialchars( html_entity_decode( $langDetails['name'] ) ) : '' );
				}
				
			}
			else
			{
				$blogs = $this->blogs;
				
				$blog = $blogs[$uri['blog']];
								 
				if ( empty( $langDetails['isLang'] ) )
				{
					$blogTitle = ( !empty( $blog['tag'] ) ? $blog['tag'] : $blog['name'] );
					
					$title .= htmlspecialchars( html_entity_decode( $blogTitle ) );
					
					if ( $url->parameter('page') !== false )
						$title .= ' - Page: ' . $url->parameter('page');
					
					$title .= ( $sitename ? ' | ' . htmlspecialchars( $site->title() ) : '' );
				}
				else
				{
					$title .= htmlspecialchars( html_entity_decode( $blog['name'] ) );
					
					if ( $url->parameter('page') !== false )
						$title .= ' - Page: ' . $url->parameter('page');
					
					$title .= ( $sitename ? ' | ' . htmlspecialchars( html_entity_decode( $langDetails['name'] ) ) : '' );
				}
				
			}
			
		}
		elseif ( $uri['whereAmI'] == 'page' )
		{
			global $page;
			
			if ( empty( $langDetails['isLang'] ) )
			{
				if ( $uri['postType'] == 'user' )
				{
					global $content;
					
					$title .= htmlspecialchars( $content['nickName'] . ( $sitename ? ' | ' . $site->title() : '' ) );
				}
				
				else
					$title .= htmlspecialchars( $page->title() . ( $sitename ? ' | ' . $site->title() : '' ) );
			}
			else
			{
				if ( $uri['postType'] == 'user' )
				{
					global $content;
					
					$title .= htmlspecialchars( $content['nickName'] . ( $sitename ? ' | ' . $site->title() : '' ) );
				}
				else
					$title .= htmlspecialchars( $page->title() . ( $sitename ? ' | ' . $langDetails['name'] : '' ) );
			}
		}
		
		return $title;
	}
	
	public function setPermalink( $amp = false )
	{
		global $langDetails, $page;
		
		$uri = $this->uri;
		
		$permalink = '';
		
		if ( $page )
		{
			if ( $amp )
			{
				$permalink = $this->site_url() . ( !empty( $langDetails['isLang'] ) && ( !$this->getValue( 'hide-slug' ) ) ? $uri['lang'] . '/' : '' );
				
				$permalink .= 'amp/' . $page->slug();
			}
			else
			{
				//Set the post's permalink
				$permalink = ( !empty( $uri['isLang'] ) ? $this->buildURL( $uri['pageSlug'], $uri['lang'] ) : $page->permalink() );
			}
		}
		
		return $permalink;
	}
	
	public function cleanUrl( $string )
    {
		$string = sanitize( $string );
		
		if ( strpos ( $string, '/' ) !== false )
		{
			$s = explode ( '/' , $string );
		
			$string = end ( $s );
		}
		
		$string = str_replace( '/', '', $string );
		
		return trim( $string );
	}
	
	public function setRedirs()
	{
		if ( $this->getValue( 'enable-redirs' ) )
		{
			$request = $this->getUri();
			
			//Don't bother to load the DB, if we are not asked for something
			if ( !empty( $request ) && ( $request !== '/' ) )
			{
				$redirsDB = $this->openDB( DB_REDIRS );
				
				if ( !empty( $redirsDB ) )
				{
					$request = ( ( substr( $request, 0, 1) !== '/' ) ? '/' : '' ) . $request;
					
					$last = $request[strlen($request)-1];
					
					$request =  $request . ( ( ( strpos ( $request, '.html' ) === false ) && ( $last !== '/' ) ) ? '/' : '' );
					
					$search = $this->searchKey( $request, 'redirs' );
					
					if ( !empty( $search ) && !empty( $search['newUrl'] ) )
					{
						$views = $redirsDB[$search['id']]['views'];
						
						$redirsDB[$search['id']]['views'] = ( $views + 1 );
						
						$this->addDB ( $redirsDB, DB_REDIRS );
						
						header( 'Location:' . $search['newUrl'], 301 );
					
						exit;
					}
				}
			}
			
		}
		//exit;
		//return;
		$uri = $this->uri;
		
		if ( empty( $uri ) )
			return;
		
		//We are in a category. Let's check if it needs any redirection
		if ( ( $uri['whereAmI'] == 'home' ) && !empty( $uri['categorySlug'] ) )
		{
			$searchLang = $this->searchCategory ( $uri['categorySlug'], true, false );
			
			$searchBlog = $this->searchCategory ( $uri['categorySlug'], false, true );
			
			if ( empty( $searchLang ) && !empty( $searchBlog ) && ( empty( $uri['blog'] ) || ( $uri['blog'] !== $searchBlog['blog'] ) ) )
			{
				$url = $this->site_url() . $searchBlog['blog'] . '/category/' . $uri['categorySlug'];
				
				header( 'Location:' . $url );
				
				exit;
			}
			
			elseif ( empty( $searchBlog ) && !empty( $searchLang ) && ( empty( $uri['lang'] ) || ( $uri['lang'] !== $searchLang['lang'] ) ) )
			{
				$url = $this->site_url() . $searchLang['lang'] . '/category/' . $uri['categorySlug'];
				
				header( 'Location:' . $url );
				exit;
			}
			
			elseif ( !empty( $searchLang ) && !empty( $searchBlog ) )
			{
				if ( ( empty( $uri['lang'] ) || ( $uri['lang'] !== $searchLang['lang'] ) ) || ( empty( $uri['blog'] ) || ( $uri['blog'] !== $searchBlog['blog'] ) ) )
				{
					$url = $this->site_url();
				
					$url .= $searchLang['lang'] . '/';		
				
					$url .= $searchBlog['blog'] . '/';
				
					$url .= 'category/' . $uri['categorySlug'];
				
					header( 'Location:' . $url );
					
					exit;
				}
			}
		}
		
		//We asked for a page. Let's check if everything is OK
		if ( (  $uri['whereAmI'] == 'page' ) )
		{
		
			$langDetails = $this->getLangDetails( $uri['lang'] );
					
			$slug = $this->getUri();

			if ( $this->getValue( 'hide-slug' ) )
			{
				$slug = ltrim( $slug , '/');
				
				if ( $slug !== $uri['pageSlug'] )
				{
					$postURL = $this->buildUrlByKey( $uri['pageSlug'] );
					
					header( 'Location:' . $postURL );
					
					exit;
				}
			}
			
			else
			{
				
				$search = $this->searchKey( $uri['pageSlug'] );
								
				$searchLang = $this->searchKey( $uri['pageSlug'], 'langs' );
				
				$searchTopic = $this->searchKey( $uri['pageSlug'], 'topics' );

				//print_r($uri);
				if ( !empty( $search ) && empty( $searchLang ) && ( empty( $uri['blog'] ) || ( $search['blog'] !== $uri['blog'] ) ) )
				{
					$url = $this->site_url() . $search['blog'] . '/' . $uri['pageSlug'];
									
					header( 'Location:' . $url );
					
					exit;
					
				}
				
				//Let's see if we have a post here with a blog slash that doesn't belong to main language
				elseif 
				( 
					!empty( $search ) && !empty( $searchLang ) 
					&& 
					(
						( empty( $uri['blog'] ) || empty( $uri['lang'] ) ) 
						|| 
						( !empty( $uri['blog'] ) && ( $search['blog'] !== $uri['blog'] ) ) 
						|| 
						( !empty( $uri['lang'] ) && ( $searchLang['lang'] !== $uri['lang'] ) ) 
					) 
				)
				{
					$url = $this->site_url() . $searchLang['lang'] . '/' . ( !empty( $searchTopic ) ? 'topic' : $search['blog'] ) . '/' . $uri['pageSlug'];
					
					header( 'Location:' . $url );
					
					exit;
				}

				//Let's see if we have a post here that doesn't belong to main language
				elseif ( !empty( $searchLang ) && empty( $search ) && ( empty( $uri['lang'] ) || ( !empty( $uri['lang'] ) && ( $searchLang['lang'] !== $uri['lang'] ) ) ) )
				{
					$url = $this->site_url() . $searchLang['lang'] . '/' . $uri['pageSlug'];
					
					header( 'Location:' . $url );
					
					exit;
				}
				
				elseif ( ( $slug == $uri['pageSlug'] ) && ( !empty( $uri['blog'] ) || !empty( $uri['lang'] ) ) )
				{
					$url = $this->buildURL( $uri['pageSlug'], $uri['lang'], $uri['blog'] );
					
					header( 'Location:' . $url );
					
					exit;
				}
				
			}
		
		}
	}
	
	public function getBase()
	{
		// Base URL
		$base = empty( $_SERVER['SCRIPT_NAME'] ) ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME'];
		
		$base = dirname( $base );
		
		if ( strpos( $_SERVER['REQUEST_URI'], $base ) !== 0 )
			$base = '/';
		
		elseif ( $base != DS ) 
		{
			$base = trim( $base, '/' );
			$base = '/' . $base . '/';
			
		} else
			$base = '/';
			
		return $base;
	}
	
	public function getUUID ( $key )
	{
		if ( empty( $array ) )
            return;
		
		$posts = $this->openDB( DB_PAGES );
		
		if ( !isset( $posts[$key] ) )
			return;
		
		return $posts[$key]['uuid'];
	}
	
	public function addLang ( $key )
	{
		require_once ( PHP_FOLDER . 'helpers' . DS . 'langs.php' );
			
		$addLang = sanitize( $key );
		
		$data = $this->openDB( DB_LANGS );
		 
		if ( isset( $data[$addLang] ) )
			return;
		
		if ( isset( $langs[$addLang] ) )
		{
			$data[$addLang] = array(
									'name' => $langs[$addLang]['lang'],
									'slogan' => '',
									'locale' => $langs[$addLang]['locale'],
									'code' => $langs[$addLang]['code'],
									'siteName' => '',
									'disable' => false,
									'homePage' => '',
									'siteDescription' => '',
									'siteSlogan' => '',
									'siteAbout' => '',
									'dateFormat' => 'M d, Y',
									'authorAbout' => '',
									'disqusCode' => '',
									'contactPageSlug' => '',
									'contactPageTitle' => '',
									'archivePageSlug' => '',
									'archivePageTitle' => '',
									'contactPageTitle' => '',
									'archivePageSlug' => '',
									'archivePageTitle' => '',
									'homePageSlug' => '',
									'cookieConsentMessage' => '',
									'cookieConsentUrl' => '',
									'cookieConsentButtonText' => '',
									'cookieConsentMoreText' => '',
									'list' => array(),
									'cats' => array(),
									'translations' => array(),
									'blogs' => array()
							);
		
			return $this->addDB ( $data, DB_LANGS );
		}
	
		return;		
	}
	
	public function saveLang( $array )
    {
        if ( !is_array( $array ) || empty( $array ) )
            return;
        
        $data = $this->openDB( DB_LANGS );
		
		if ( !is_array ( $data ) )
			$data = array();
			
		foreach ( $array as $lang => $value ) 
		{
			if ( !isset( $data[$lang] ) )
				continue;
			
			foreach ( $value as $key => $val )
			{
				if ( $key == 'disable' )
					$data[$lang][$key] = ( ( $val == 'true' ) ? true : false );
				else
					$data[$lang][$key] = htmlentities( $val );
			}
		}

		$this->addDB ( $data, DB_LANGS );
    }
	
	public function saveblog( $array )
    {
        if ( !is_array( $array ) || empty( $array ) )
            return;
        
        $data = $this->openDB( DB_BLOGS );
				
		foreach ( $array as $blog => $value ) 
		{
			if ( !isset( $data[$blog] ) )
				continue;
			
			if ( isset( $value['deleteBlog'] ) && !empty( $value['deleteBlog'] ) )
			{
				unset( $data[$blog] );
				continue;
			}

			foreach ( $value as $key => $val )
			{
				if ( ( $key == 'disable' ) || ( $key == 'noindex' ) )
					$data[$blog][$key] = ( ( $val == 'true' ) ? true : false );
				else
					$data[$blog][$key] = htmlentities( $val );
			}
		}

        $this->addDB ( $data, DB_BLOGS );

    }
	
	public function form()
    {
        global $L, $url, $site;
		
		$html  = '';
		
		$fullURL = ( ( isset( $_SERVER['HTTPS'] ) && ( $_SERVER['HTTPS'] == 'on' ) ) ? 'https' : 'http' ) . '://' . $_SERVER["SERVER_NAME"] . $_SERVER['REQUEST_URI'];
		
		require ( $this->phpPath() . 'php' . DS . 'admin-form.php' );
    
        return $html;
    }
	
	public function getUri( $trailing = false )
	{
		$uri = $this->sanitize ( $_SERVER['REQUEST_URI'] );
				
		if ( strpos ( $uri, '?' ) !== false )
		{
			$ur = explode ( '?', $uri );
			
			$uri = ( !empty( $ur['0'] ) ? $ur['0'] : $uri );
		}
		
		$base = $this->getBase();
				
		if ( $base !== '/' )
		{
			if ( $trailing )
				$url = str_replace( $base, '/', $uri );
			else
				$url = str_replace( $base, '', $uri );
		}
		else
			$url = $uri;
				
		return $url;
	}
 
	public function siteSidebar()
	{
		$html = '';
		
		if ( $this->getValue( 'enableWidgets' ) )
		{
			$uri = $this->uri;
			
			global $pages, $categories, $tags;
			
			$widgets = $this->openDB( DB_WIDGETS );
			
			if ( empty( $widgets ) )
				return;
			
			require ( PHP_FOLDER . 'widgets-sidebar.php' );
		}

		return $html;
	}
	
	public function langSelector()
	{
		$html = '';
		
		if ( !$this->getValue( 'enable-langs' ) )
			return $html;
		
		$uri = $this->uri;
						
		$lang = ( ( !empty( $uri ) && !empty( $uri['lang'] ) ) ? $uri['lang'] : '' );
		
		$blog = ( ( !empty( $uri ) && !empty( $uri['blog'] ) ) ? $uri['blog'] : '' );
				
		$langList = $this->getLangsList( $lang, $blog );
				
		if ( empty( $langList ) )
			return $html;
				
		$langs = array();
		
		//$html .= '<div id="text" class="widget widget_text"><h4 class="widget-title">Languages</h4><div class="textwidget">
		
		$html .= '<select class="form-control inline-select" id="lang_select" name="lang_id">';
		
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
					//$langs[$id] = $la['url'];
					
					if ( !empty( $la['current'] ) ) 
					{
						$langs[$id] = $url;
						$html .= '<option value="' . $id . '" selected>' . $la['name'] . '</option>';
					}
					else
					{
						$langs[$id] = $otherURL;
						$html .= '<option value="' . $id . '">' . $la['name'] . '</option>';
					}
					
						//$html .= '<link href="' . $otherURL . '" hreflang="' . $la['name'] . '" rel="alternate" />' . PHP_EOL;
				}
			}
					
			//We don't have a post with translations. So we have to return the default keys
			else
			{
				foreach ( $langList as $id=>$la )
				{
					$langs[$id] = $la['url'];
					
					$html .= '<option value="' . $id . '" ' . ( ( $la['current'] ) ? 'selected' : '' ) . '>' . $la['name'] . '</option>';
				}

			}
		}
		
		else
		{
			foreach ( $langList as $id=>$la )
			{
				$langs[$id] = $la['url'];
				
				$html .= '<option value="' . $id . '" ' . ( ( $la['current'] ) ? 'selected' : '' ) . '>' . $la['name'] . '</option>';
			}
			
		}
			
        $html .= '</select>' . PHP_EOL;
			
		$html .= '<script type="text/javascript">' . PHP_EOL;
			
		$html .= 'var urls_langs = ' . json_encode( $langs, JSON_PRETTY_PRINT ) . ';' . PHP_EOL;
			
		$html .= 'document.getElementById( "lang_select" ).onchange = function() {' . PHP_EOL;
			
		$html .= 'location.href = urls_langs[this.value];' . PHP_EOL;
			
		$html .= '}</script>';
		
		//$html .= '</div></div>';
				
		return $html;
	}
	
	public function buildURL( $key = '', $lang = '', $blog = '' )
	{
		$url = $this->site_url();
		
		if ( !empty( $lang ) )
			$url .= $lang . '/';
					
		if ( !empty( $blog ) )
			$url .= $blog . '/';
		
		if ( !empty( $key ) )
			$url .= $key;
		
		return $url;
	}
	
	public function buildUrlByKey( $key = '' )
	{
		if ( $key === '' )
			return;
		
		$url = $this->site_url();
		
		if ( !$this->getValue( 'hide-slug' ) )
		{
			$search = $this->searchKey( $key );
			
			$searchLang = $this->searchKey( $key, 'langs' );
			
			$searchTopic = $this->searchKey( $key, 'topics' );
			
			if ( !empty( $searchLang ) )
				$url .= $searchLang['lang'] . '/';
			
			if ( !empty( $search ) && empty( $searchTopic ) )
				$url .= $search['blog'] . '/';
			
			if ( !empty( $searchTopic ) )
				$url .= 'topic/';
		}
		
		$url .= $key;
		
		return $url;
	}
	
	public function siteHead()
	{
		global $L;
		
		$html = '';
		
		$uri = $this->uri;
		
		if ( empty( $uri ) )
			return $html;
		
		if ( $this->getValue( 'enable-seo' ) )
		{
			require( $this->phpPath() . 'php' . DS . 'head-seo.php' );
		}
		
		if ( $this->getValue( 'enable-amp' ) && ( $uri['whereAmI'] == 'page' ) )	
		{
			$url = $this->setPermalink( true );
			
			$html .= PHP_EOL . '<link rel="amphtml" href="' . $url . '">' . PHP_EOL;
			
		}
		
		if ( $this->getValue( 'enable-langs' ) )
		{
			require( $this->phpPath() . 'php' . DS . 'head-langs.php' );
		}
		
		if ( $this->getValue( 'enableantispam' ) )	
		{
			$antiSpamData = $this->getValue( 'antispam-settings' );
			
			if ( isset( $antiSpamData['honeypot'] ) && ( $antiSpamData['honeypot'] === true ) )
			{
				$html .= PHP_EOL . '<style>.ohnohoney{opacity: 0;position: absolute;top: 0;left: 0;height: 0;width: 0;z-index: -1;}</style>' . PHP_EOL;
				
			}
			
			unset( $antiSpamData );
		}
		
		$html .= '<meta name="generator" content="Sub-Blogs &amp; Multilang Plugin for Bludit by LazyTech" />' . PHP_EOL;
				
		return $html;
	}
       
	public function loadDetails ( $lang = '', $blog = '', $key = '' )
	{
		global $langDetails, $categoriesList, $blogList, $title, $description, $categoriesHome;
		global $langList, $pagesList, $categoriesSideList, $nextPrev, $permalink, $menu;
		
		$categoriesList = $this->getCategoriesBlogList( $lang );
		
		$categoriesHome = $this->getCategoriesHomeList( $lang );
		
		$categoriesSideList = $this->getCategoriesList( $blog, $lang );

        $langList = $this->getLangsList( $lang );
		
		$blogList = $this->getBlogsList( $lang );
		
		$pagesList = $this->getPagesList( $lang );
		
		$langDetails = $this->getLangDetails( $lang, $blog );
		
		$nextPrev = $this->getPreviousNextURL( $key, $lang, $blog );
		
		$title = $this->buildTitle();
		
		$description = $this->builDescription();
		
		$permalink = $this->setPermalink();
		
		$menu = $this->setMenu();

	}

    public function afterPageModify()
    {
		return $this->updatePage( $_POST );
    }
	
	public function afterPageCreate()
	{
		if ( !empty( $_POST ) && isset( $_POST['product'] ) )
		{
			$file = PATH_PAGES . $_POST['slug'] . DS . 'values.php';
			
			if ( file_exists ( $file ) )
				$values = $this->openDB( $file );
					
				$values = $_POST['product'];
					
				$this->addDB ( $values, $file );
		}
		
		$this->sitemapIndex();
		
		if ( checkKey( $this->getValue( 'seo-settings' ), 'sitemapPing' ) )
			$this->ping();
	}

    public function afterPageDelete()
    {
		if ( isset( $_POST['key'] ) )
			$this->deleteKey( $_POST['key'] );
		
		$this->sitemapIndex();
    }
	
	public function deletePage( $key )
    {
        if ( $key === '' )
            return;
		
		$posts = $this->openDB( DB_PAGES );
				
		if ( !isset( $posts[$key] ) )
			return;
		
		$postCategory = $posts[$key]['category'];
		
		$uuid = $posts[$key]['uuid'];
		
		$postDir = PATH_PAGES . $key . DS;
		
		$uploadDir = PATH_UPLOADS . $uuid . DS;
		
		unset( $posts[$key] );
		
		array_multisort( array_column( $posts, 'position' ), SORT_DESC, SORT_NUMERIC, $posts );
		
		$this->addDB ( $posts, DB_PAGES );
		
		$this->rrmdir( $postDir );
		
		$this->rrmdir( $uploadDir );
		
		return $postCategory;
    }
	
	public function rrmdir($dir) {
	  if (is_dir($dir)) {
		$objects = scandir($dir);
		foreach ($objects as $object) {
		  if ($object != "." && $object != "..") {
			if (filetype($dir."/".$object) == "dir") 
			   $this->rrmdir($dir."/".$object); 
			else unlink   ($dir."/".$object);
		  }
		}
		reset($objects);
		rmdir($dir);
	  }
	}
	
	public function deleteData ( $key, $forum = false ) 
	{
		$postCategory = $this->deletePage( $key );
		
		if ( !empty( $postCategory ) )
		{
			$categories = $this->openDB( DB_CATEGORIES );
			
			$found = false;
			
			$list = $categories[$postCategory]['list'];
			
			if ( !empty( $list ) )
			{
				foreach ( $list as $k => $s )
				{
					if ( $s == $key )
					{
						unset( $categories[$postCategory]['list'][$k] );

						$found = true;

						break;
					}
				}
			}
			
			if ( $found )
			{
				$categories[$postCategory]['list'] = array_values( $categories[$postCategory]['list'] );
					
				$this->addDB ( $categories, DB_CATEGORIES );
			}
		}
		
		$tags = $this->openDB( DB_TAGS );
		
		if ( !empty( $tags ) )
		{
			$found = false;
			
			foreach ( $tags as $tagKey => $tag )
			{
				if ( !empty( $tag['list'] ) )
				{
					foreach ( $tag['list'] as $k => $s )
					{
						if ( $s == $key )
						{
							unset( $tags[$tagKey]['list'][$k] );

							$found = true;
							
							$tagK = $tagKey;

							break;
						}
					}
				}
			}
			
			if ( $found )
			{
				$tags[$tagK]['list'] = array_values( $tags[$tagK]['list'] );
					
				$this->addDB ( $tags, DB_TAGS );
			}
		}
		
		if ( $forum == 'topic' )
		{
			$topics = $this->openDB ( DB_TOPICS );
			
			$found = false;
			
			if ( !empty( $topics ) )
			{
				foreach ( $topics as $topic => $val ) 
				{
					if ( !empty( $val['list'] ) )
					{
						foreach ( $val['list'] as $k => $s )
						{
							if ( $s == $key )
							{
								unset( $topics[$topic]['list'][$k] );

								$found = true;
								
								$topicFound = $topic;

								break;
							}
						}
					}
				}
				
				if ( $found )
				{
					$topics[$topicFound]['list'] = array_values( $topics[$topicFound]['list'] );
					
					$this->addDB ( $topics, DB_TOPICS );
				}
			}
		}
		
		if ( $forum == 'forum' )
		{
			$topics = $this->openDB ( DB_TOPICS );
			
			if ( isset( $topics[$key] ) )
			{
				$topicList = $topics[$key]['list'];
				
				if ( !empty( $topicList ) )
				{
					foreach ( $topicList as $topic )
						$this->deletePage( $topic );
				}
				
				unset( $topics[$key] );
				
				$this->addDB ( $topics, DB_TOPICS );
			}
			
		}
		
		$this->deleteKey( $key );
		
		return true;
	}

    public function deleteKey( $key )
    {
        if ( $key === '' )
            return;

        $blogs = $this->blogs;

        $found = false;
		
		if ( !empty( $blogs ) )
		{
			foreach ( $blogs as $blog => $val ) 
			{
				foreach ( $val['list'] as $k => $s )
				{
				   if ( $s == $key )
				   {
						unset( $blogs[$blog]['list'][$k] );

						$found = true;

						break;
				   }
				}
			}

			if ( $found )
			{
				$blogs[$blog]['list'] = array_values( $blogs[$blog]['list'] );
				
				$this->addDB ( $blogs, DB_BLOGS );
			}
			
		}
		
		$langs = $this->openDB( DB_LANGS );

        $found = false;
		
		if ( !empty( $langs ) )
		{
			foreach ( $langs as $lang => $val ) 
			{
				foreach ( $val['list'] as $k => $s )
				{
				   if ( $s == $key )
				   {
						unset( $langs[$lang]['list'][$k] );

						$found = true;

						break;
				   }
				}
			}

			if ( $found )
			{
				$langs[$lang]['list'] = array_values( $langs[$lang]['list'] );
				
				$this->addDB ( $langs, DB_LANGS );
			}
			
		}

        return;    
    }
	
    public function addPage( $key, $blog = '', $lang = '', $parent = '', $uuid = '', $post = '' )
    {
        if ( $key === '' )
            return;
		
		//print_r($post);
		
		$key = Text::cleanUrl( $key );
        
		if ( !empty( $blog ) )
		{
			$blogs = $this->blogs;
			
			if ( isset( $blogs[$blog] ) )
			{
				if ( !in_array( $key, $blogs[$blog]['list'] ) )
					array_push( $blogs[$blog]['list'], $key );

				//Maybe is a new topic?
				if ( !empty( $post ) && isset( $post['forum_parent'] ) && !empty( $post['forum_parent'] ) )
				{
					$topics = $this->openDB ( DB_TOPICS );
					
					if ( !isset( $topics[$post['forum_parent']] ) )
						$topics[$post['forum_parent']]['list'] = array();
					
					if ( !in_array( $key, $topics[$post['forum_parent']]['list'] ) )
						array_push( $topics[$post['forum_parent']]['list'], $key );
					
					$this->addDB ( $topics, DB_TOPICS );
				}

				$this->addDB ( $blogs, DB_BLOGS );
			}
		}

		if ( !empty( $lang ) )
		{
			$langs = $this->openDB ( DB_LANGS );
			
			//No need to check if the lang is the default
			//The default lang is not in the array
			if ( isset( $langs[$lang] ) )
			{
				array_push( $langs[$lang]['list'], $key );
				
				if ( ( $parent !== '' ) &&  ( $uuid !== '' ) )
				{
					if ( !isset( $langs[$lang]['translations'][$uuid] ) )
					{
						$langs[$lang]['translations'][$uuid] = array ( 'parent' => $parent, 'key' => $key );
						//array_push( $langs[$lang]['translations'], $parentArray );
						//$langs[$lang]['translations'] = $parentArray;
					}
				}
			
				$this->addDB ( $langs, DB_LANGS );
			}
		}
                        
        return;
    }

    public function searchCategory ( $key, $lang = false, $blog = false )
    {
        if ( $key === '' )
            return;

        $found = array();

        if ( !empty( $lang ) )
        {
            $langs = $this->openDB ( DB_LANGS );

            if ( empty( $langs ) )
                return;

            foreach ( $langs as $lng => $val ) 
            {
                foreach ( $val['cats'] as $k => $s )
                {
                   if ( $s == $key )
                   {
                        $found['name'] = $langs[$lng]['name'];

                        $found['locale'] = $langs[$lng]['locale'];

                        $found['code'] = $langs[$lng]['code'];

                        $found['lang'] = $lng;

                        break;
                   }
                }
            }
        }

        if ( !empty( $blog ) )
        {
            $blogs = $this->openDB ( DB_BLOGS );

            if ( empty( $blogs ) )
                return;

            foreach ( $blogs as $blg => $val ) 
            {
                foreach ( $val['cats'] as $k => $s )
                {
                   if ( $s == $key )
                   {
                        $found['name'] = $blogs[$blg]['name'];

                        $found['blog'] = $blg;

                        break;
                   }
                }
            }
        }

        return $found;
    }
	
	public function updatePage( $data )
    {
        if ( empty( $data ) )
			return;
        
		$postKey = $this->sanitize( $data['slug'] );
		
		$oldKey = $this->sanitize( $data['key'] );
		
		//Do we have the forums enabled?
		if ( $this->getValue( 'enable-forum' ) !== 'disable' )
		{
			$topics = $this->openDB ( DB_TOPICS );
			
			if ( $postKey !== $oldKey )
			{
				$found = false;
				//Loop through every topic to find the old key
				foreach ( $topics as $topic => $val ) 
				{
					foreach ( $val['list'] as $k => $s )
					{
						if ( $s == $oldKey )
						{
							unset( $topics[$topic]['list'][$k] );
							
							$found = true;

							break;
						}
					}
				}
				
				//Now add the new key
				if ( $found ) 
					array_push( $topics[$topic]['list'], $postKey );
			}
			
			//Maybe we have the slug in our forum db, but somewhere else
			else
			{
				if ( isset( $topics[$oldKey] ) )
				{
					$temp = $topics[$oldKey];
					
					unset( $topics[$oldKey] );
					
					$topics[$postKey] = $temp;
				}
			}
			
			//Save the database
			$this->addDB ( $topics, DB_TOPICS );
		}
		
		if ( !empty( $data['blog'] ) )
		{
			//Load the blogs database first
			$blogs = $this->blogs;
			
			$blogKey = $this->sanitize( $data['blog'] );
			
			//Did we change the slug?
			if ( $postKey !== $oldKey )
			{
				//Loop through every blog to find the old key
				foreach ( $blogs as $blog => $val ) 
				{
					foreach ( $val['list'] as $k => $s )
					{
					   if ( $s == $oldKey )
					   {
							unset( $blogs[$blog]['list'][$k] );

							break;
					   }
					}
				}
							
				//Now add the new key
				array_push( $blogs[$blogKey]['list'], $postKey );

			}
			else
			{
				//First, check if we have it in another blog
				$searchKey = $this->searchKey( $postKey );
				
				if ( !empty( $searchKey ) )
				{
					//Do we want this post to another blog?
					if ( $searchKey['blog'] !== $blogKey )
					{
						//Loop through every blog to find the old key
						foreach ( $blogs as $blog => $val ) 
						{
							foreach ( $val['list'] as $k => $s )
							{
							   if ( $s == $postKey )
							   {
									unset( $blogs[$blog]['list'][$k] );

									break;
							   }
							}
						}
						
						//Add the post to the database
						array_push( $blogs[$blogKey]['list'], $postKey );
					}
				}
				else
					array_push( $blogs[$blogKey]['list'], $postKey );
				
			}
			
			$blogs[$blogKey]['list'] = array_values( $blogs[$blogKey]['list'] );
			
			//Finally, save the database
			$this->addDB ( $blogs, DB_BLOGS );
		}
		//What if we had the post in a blog and now we want it to our main blog?
		else
		{
			//First, check if we have it in another blog
			$searchKey = $this->searchKey( $postKey );
				
			if ( !empty( $searchKey ) )
			{
				$blogs = $this->blogs;
				
				$blogKey = $searchKey['blog'];
				
				//Loop through posts to find the key
				foreach ( $blogs[$blogKey]['list'] as $k => $s )
				{
					if ( $s == $postKey )
					{
						unset( $blogs[$blogKey]['list'][$k] );

						break;
					}
				}
				
				$blogs[$blogKey]['list'] = array_values( $blogs[$blogKey]['list'] );
			
				//Finally, save the database
				$this->addDB ( $blogs, DB_BLOGS );
			}
		}
		
		//Now let's do the same and for the languages
		if ( !empty( $data['lang'] ) )
		{
			//Load the langs database first
			$langs = $this->openDB ( DB_LANGS );
			
			$langKey = $this->sanitize( $data['lang'] );
			
			//Do we change the slug?
			if ( $postKey !== $oldKey )
			{
				//Loop through every lang to find the old key
				foreach ( $langs as $lang => $val ) 
				{
					foreach ( $val['list'] as $k => $s )
					{
					   if ( $s == $oldKey )
					   {
							unset( $langs[$lang]['list'][$k] );

							break;
					   }
					}
				}
				
				//Loop through every lang to find the old key
				foreach ( $langs as $lang => $val ) 
				{
					foreach ( $val['translations'] as $uuid => $s )
					{
						//First check the child key
					   if ( $s['key'] == $oldKey )
					   {
							$d = $uuid;
							
							$dt = array( 'parent' => $s['parent'], 'key' => $postKey );

							unset( $langs[$lang]['translations'][$uuid] );
							
							$langs[$lang]['translations'][$d] = $dt;
							
							break;
					   }
					   
					   //First check the child key
					   if ( $s['parent'] == $oldKey )
					   {
							$d = $uuid;
							
							$dt = array( 'parent' => $postKey, 'key' => $s['key'] );

							unset( $langs[$lang]['translations'][$uuid] );
							
							$langs[$lang]['translations'][$d] = $dt;
							
							break;
					   }
					}
				}
							
				//Now add the new key
				array_push( $langs[$langKey]['list'], $postKey );
			}
			else
			{
				//First, check if we have it in another lang
				$searchKey = $this->searchKey( $postKey, 'langs' );
				
				if ( !empty( $searchKey ) )
				{
					//Do we want this post to another blog?
					if ( $searchKey['lang'] !== $langKey )
					{
						//Loop through every blog to find the old key
						foreach ( $langs as $lang => $val ) 
						{
							foreach ( $val['list'] as $k => $s )
							{
							   if ( $s == $postKey )
							   {
									unset( $langs[$lang]['list'][$k] );

									break;
							   }
							}
						}
						
						//Add the post to the database
						array_push( $langs[$langKey]['list'], $postKey );
					}
					
					//Add the post to the database
					//array_push( $langs[$langKey]['list'], $postKey );
				}
				else
					array_push( $langs[$langKey]['list'], $postKey );
				
			}
			
			$langs[$langKey]['list'] = array_values( $langs[$langKey]['list'] );
			
			//Finally, save the database
			$this->addDB ( $langs, DB_LANGS );
		}
		//What if we had the post in a blog and now we want it to our main blog?
		else
		{
			//First, check if we have it in another blog
			$searchKey = $this->searchKey( $postKey, 'langs' );
				
			if ( !empty( $searchKey ) )
			{
				$langs = $this->openDB ( DB_LANGS );
				
				$langKey = $searchKey['lang'];
				
				//Loop through posts to find the key
				foreach ( $langs[$langKey]['list'] as $k => $s )
				{
					if ( $s == $postKey )
					{
						unset( $langs[$langKey]['list'][$k] );

						break;
					}
				}
				
				$langs[$langKey]['list'] = array_values( $langs[$langKey]['list'] );
			
				//Finally, save the database
				$this->addDB ( $langs, DB_LANGS );
			}
		}

    }
	
	public function deleteBlog( $blog ) 
	{
		if ( $blog === '' )
			return;
		
		$blogs = $this->blogs;
        
        if ( isset( $blogs[$blog] ) )
		{
            unset( $blogs[$blog] );
			
			return $this->addDB ( $blogs, DB_BLOGS );
		}
		
		return false;
	}
	
	public function buildArray()
	{
		$blogs = $this->blogs;
		
		if ( !empty( $blogs ) )
		{
			foreach ( $blogs as $b=>$log)
				$this->array[] = $b;
				
		}
		
		$langs = $this->buildLangCodes();
		
		if ( !empty( $langs ) )
		{
			foreach ( $langs as $la)
				$this->array[] = $la;
		}
	}
	
	public function getBlogsList( $lang = '' )
    {
		$blogs = $this->blogs;
		
		$array = array();
		
		if ( empty ( $blogs ) || ( !$this->getValue( 'enable' ) ) )
			return;
		
		foreach ( $blogs as $key => $blog )
		{
			$url = $this->site_url();
			
			if ( !empty( $lang ) )
				$url .= $lang . '/';
			
			$url .= $key;
			
			$array[$key] = array( 'name' => $blog['name'], 'url' => $url );
		}
		
		return $array;
	}
	
	public function getLangDetails( $lang = '', $blog = '' )
    {
		global $site;
		
		$details = array();
				
		if ( !empty( $lang ) && $this->getValue( 'enable-langs' ) )
		{
			$data = $this->openDB( DB_LANGS );
			
			//IF nothing foung, return the default values
			if ( empty ( $data ) || !isset( $data[$lang] ) )
				return $details;
			
			$details['locale'] = $data[$lang]['locale'];
			
			$details['isLang'] = true;
			
			$details['name'] = ( !empty( $data[$lang]['siteName'] ) ? html_entity_decode( $data[$lang]['siteName'] ) : $site->title() );
			
			$details['slogan'] = ( !empty( $data[$lang]['siteSlogan'] ) ? html_entity_decode( $data[$lang]['siteSlogan'] ) : $site->slogan() );
			
			$details['url'] = $this->site_url() . $lang;
			
			$details['thisUrl'] = $this->site_url() . $lang . ( !empty( $blog ) ? '/' . $blog : '' ) ;
			
			$details['description'] = html_entity_decode( $data[$lang]['siteDescription'] );
			
			$details['about'] = html_entity_decode( $data[$lang]['siteAbout'] );
			
			$details['authorAbout'] = html_entity_decode( $data[$lang]['authorAbout'] );
			
			$details['disqusCode'] = $data[$lang]['disqusCode'];
			
			$details['cookieConsentMessage'] = $data[$lang]['cookieConsentMessage'];
			
			$details['cookieConsentUrl'] = $data[$lang]['cookieConsentUrl'];
			
			$details['cookieConsentMoreText'] = $data[$lang]['cookieConsentMoreText'];
			
			$details['cookieConsentButtonText'] = $data[$lang]['cookieConsentButtonText'];
			
			$details['contactPage'] = array(
											'url' => ( !empty( $data[$lang]['contactPageSlug'] ) ? $this->site_url() . $lang . PS . $data[$lang]['contactPageSlug'] : '' ),
											'title' => ( !empty( $data[$lang]['contactPageTitle'] ) ? $data[$lang]['contactPageTitle'] : '' )
									);
			$details['dateFormat'] = $data[$lang]['dateFormat'];
		}
		
		else
		{
			$values = $this->getValue( 'default-lang-extra' );
			
			$details['locale'] = $site->locale();
			
			$details['isLang'] = false;
				
			$details['name'] = $site->title();
				
			$details['slogan'] = $site->slogan();
				
			$details['url'] = $this->site_url();
				
			$details['thisUrl'] = $this->site_url();
				
			$details['description'] = $site->description();
				
			$details['about'] = ( isset( $values['siteAbout'] ) ? $values['siteAbout'] : '' );
				
			$details['authorAbout'] = ( isset( $values['authorAbout'] ) ? $values['authorAbout'] : '' );
				
			$details['disqusCode'] = ( isset( $values['disqusCode'] ) ? $values['disqusCode'] : '' );
				
			$details['contactPage'] = array(
											'url' => ( isset( $values['contactPageSlug'] ) && !empty( $values['contactPageSlug'] ) ? $this->site_url() . $values[ 'contactPageSlug' ] : '' ),
											'title' => ( isset( $values['contactPageTitle'] ) && !empty( $values['contactPageTitle'] ) ? $values['contactPageTitle'] : '' )
									);
			
			$details['archivePage'] = array(
											'url' => ( isset( $values['archivePageSlug'] ) && !empty( $values['archivePageSlug'] ) ? $this->site_url() . $values[ 'archivePageSlug' ] : '' ),
											'title' => ( isset( $values['archivePageTitle'] ) && !empty( $values['archivePageTitle'] ) ? $values['archivePageTitle'] : '' )
									);
		
			$details['dateFormat'] = $site->dateFormat();
			
			$details['cookieConsentMessage'] = ( isset( $values['cookieConsentMessage'] ) && !empty( $values['cookieConsentMessage'] ) ? $values['cookieConsentMessage'] : '' );
			
			$details['cookieConsentUrl'] = ( isset( $values['cookieConsentUrl'] ) && !empty( $values['cookieConsentUrl'] ) ? $values['cookieConsentUrl'] : '' );
			
			$details['cookieConsentMoreText'] = ( isset( $values['cookieConsentMoreText'] ) && !empty( $values['cookieConsentMoreText'] ) ? $values['cookieConsentMoreText'] : '' );
			
			$details['cookieConsentButtonText'] = ( isset( $values['cookieConsentButtonText'] ) && !empty( $values['cookieConsentButtonText'] ) ? $values['cookieConsentButtonText'] : '' );
			
			unset( $values );
		}
		
		return $details;
	}
	
	public function addLanguage ( $lang ) 
	{
		if ( $lang === '' )
			return;
		
		$data = $this->openDB( DB_LANGS );
			
		require ( PHP_FOLDER . 'helpers' . DS . 'langs.php' );

		//If the language is not in our array, then don't continue
		if ( !isset( $langs[$lang] ) )
			return;

		//Don't add the same language twice
		if ( isset( $data[$langs[$lang]['code']] ) )
			return;
		
		$default = $this->getValue( 'default-lang' );
        
		//Don't add the language if is set as default
		if ( !empty( $default ) && ( $default['name'] == $lang ) )
			return;
		
		//Finally, add the language
		$data[$langs[$lang]['code']] = array( 
								'name'=> Sanitize::html( $langs[$lang]['lang'] ),
								'slogan'=> '',
								'locale'=> $langs[$lang]['locale'],
								'code'=> $lang,
								'siteName'=> '',
								'disable' => false,
								'homePage' => '',
								'siteDescription' => '',
								'siteSlogan' => '',
								'siteAbout' => '',
								'dateFormat' => 'M d, Y',
								'authorAbout' => '',
								'disqusCode' => '',
								'contactPageSlug' => '',
								'archivePageSlug' => '',
								'contactPageTitle' => '',
								'archivePageTitle' => '',
								'homePageSlug' => '',
								'list' => array(),
								'cats' => array(),
								'translations' => array(),
								'blogs' => array()
							);
		
		return $this->addDB ( $data, DB_LANGS );
	}
	
	public function addBlog ( $blog, $sef = '' )
	{
		if ( $blog === '' )
			return;
		
		$blogs = $this->blogs;
				
		$blogSef = ( empty( $sef ) ? $this->URLify( $blog ) : $this->URLify( $sef ) );
		
		//Don't add the same blog twice
		if ( isset( $blogs[$blogSef] ) )
			return;
		
		$blogName = $this->sanitize( $blog );
		
		//Add the new blog to the database
        $blogs[$blogSef] = array( 
							'name'=> $blogName,
							'disable'=> false,
							'noindex'=> false,
							'enabled'=> 'everywhere',
							'description'=> '',
							'tag'=> '',
							'list' => array(),
							'values' => array(),
							//'topics' => array(),
							'cats' => array()
						);

		return $this->addDB ( $blogs, DB_BLOGS );
	}
	
	public function getCagegoryURL( $key )
    {
		//$uri = $this->uri;

		//if ( empty( $uri ) )
            //return;
		
		$url = $this->site_url();
		
		$searchLang = $this->searchCategory ( $key, true, false );
			
		$searchBlog = $this->searchCategory ( $key, false, true );
		
		$url .= ( !empty( $searchLang ) ? $searchLang['lang'] . '/' : '' );
		
		$url .= ( !empty( $searchBlog ) ? $searchBlog['blog'] . '/' : '' );
		
		$url .= 'category/' . $key;
		
		return $url;
	}
	
	public function updateCategory( $data )
    {
		if ( empty( $data ) )
			return;
				
		//Don't continue if we don't have the key
		if ( empty( $data['newKey'] ) )
			return;
		
		$oldKey = $this->sanitize( $data['oldKey'] );
		
		$newKey = $this->sanitize( $data['newKey'] );
		
		//If we want to delete a category, search everything and do it
		if ( isset( $data['action'] ) && ( $data['action'] == 'delete' ) )
		{
			$search = $this->searchCategory ( $newKey, false, true );
			
			if ( !empty( $search ) )
			{
				$blogs = $this->blogs;
				
				$blogKey = $search['blog'];
				
				//Loop through posts to find the key
				foreach ( $blogs[$blogKey]['cats'] as $k => $s )
				{
					if ( $s == $newKey )
					{
						unset( $blogs[$blogKey]['cats'][$k] );

						break;
					}
				}
				
				$blogs[$blogKey]['cats'] = array_values( $blogs[$blogKey]['cats'] );
			
				// Now let's save the database
				$this->addDB ( $blogs, DB_BLOGS );
			}
			
			//Do the same and for the languages
			$search = $this->searchCategory ( $newKey, true );
			
			if ( !empty( $search ) )
			{
				$langs = $this->openDB ( DB_LANGS );
				
				$langKey = $search['lang'];
				
				//Loop through posts to find the key
				foreach ( $langs[$langKey]['cats'] as $k => $s )
				{
					if ( $s == $newKey )
					{
						unset( $langs[$langKey]['cats'][$k] );

						break;
					}
				}
				
				$langs[$langKey]['cats'] = array_values( $langs[$langKey]['cats'] );
			
				// Now let's save the database
				$this->addDB ( $langs, DB_LANGS );
				
			}
			
			return;
		}
		
		
		if ( !empty( $data['blog'] ) )
		{
			$blogs = $this->blogs;
			
			$blogKey = $this->sanitize( $data['blog'] );
			
			//Do we change the slug?
			if ( $newKey !== $oldKey )
			{
				//Loop through every blog to find the old key
				foreach ( $blogs as $blog => $val ) 
				{
					foreach ( $val['cats'] as $k => $s )
					{
						if ( $s == $oldKey )
						{
							unset( $blogs[$blog]['cats'][$k] );

							break;
						}
					}
				}
								
					//Now add the new key
					array_push( $blogs[$blogKey]['cats'], $newKey );
			}
			else
			{
				//First, check if we have it in another blog
				$search = $this->searchCategory ( $newKey, false, true );
					
				if ( !empty( $search ) )
				{
					//Do we want this post to another blog?
					if ( $search['blog'] !== $blogKey )
					{
						//Loop through every blog to find the old key
						foreach ( $blogs as $blog => $val ) 
						{
							foreach ( $val['cats'] as $k => $s )
							{
								if ( $s == $newKey )
								{
									unset( $blogs[$blog]['cats'][$k] );

									break;
								}
							}
						}
							
						//Add the post to the database
						array_push( $blogs[$blogKey]['cats'], $newKey );
					}

				}
				else
					array_push( $blogs[$blogKey]['cats'], $newKey );
					
			}
			
			$blogs[$blogKey]['cats'] = array_values( $blogs[$blogKey]['cats'] );
			
			//Finally, save the database
			$this->addDB ( $blogs, DB_BLOGS );
		}
		else
		{
			$search = $this->searchCategory ( $newKey, false, true );
			
			if ( !empty( $search ) )
			{
				$blogs = $this->blogs;
				
				$blogKey = $search['blog'];
				
				//Loop through posts to find the key
				foreach ( $blogs[$blogKey]['cats'] as $k => $s )
				{
					if ( $s == $newKey )
					{
						unset( $blogs[$blogKey]['cats'][$k] );

						break;
					}
				}
				
				$blogs[$blogKey]['cats'] = array_values( $blogs[$blogKey]['cats'] );
			
				//Finally, save the database
				$this->addDB ( $blogs, DB_BLOGS );
			}
		}
		
		if ( !empty( $data['lang'] ) )
		{
			$langs = $this->openDB ( DB_LANGS );
			
			$langKey = $this->sanitize( $data['lang'] );
			
			//Do we change the slug?
			if ( $newKey !== $oldKey )
			{
				//Loop through every blog to find the old key
				foreach ( $langs as $lang => $val ) 
				{
					foreach ( $val['cats'] as $k => $s )
					{
						if ( $s == $oldKey )
						{
							unset( $langs[$lang]['cats'][$k] );

							break;
						}
					}
				}
								
					//Now add the new key
					array_push( $langs[$langKey]['cats'], $newKey );
			}
			else
			{
				//First, check if we have it in another blog
				$search = $this->searchCategory ( $newKey, true  );
					
				if ( !empty( $search ) )
				{
					//Do we want this post to another blog?
					if ( $search['lang'] !== $langKey )
					{
						//Loop through every blog to find the old key
						foreach ( $langs as $lang => $val ) 
						{
							foreach ( $val['cats'] as $k => $s )
							{
								if ( $s == $newKey )
								{
									unset( $langs[$lang]['cats'][$k] );

									break;
								}
							}
						}
							
						//Add the post to the database
						array_push( $langs[$langKey]['cats'], $newKey );
					}

				}
				else
					array_push( $langs[$langKey]['cats'], $newKey );
					
			}
			
			$langs[$langKey]['cats'] = array_values( $langs[$langKey]['cats'] );
			
			//Finally, save the database
			$this->addDB ( $langs, DB_LANGS );
		}
		else
		{
			$search = $this->searchCategory ( $newKey, true );
			
			if ( !empty( $search ) )
			{
				$langs = $this->openDB ( DB_LANGS );
				
				$langKey = $search['lang'];
				
				//Loop through posts to find the key
				foreach ( $langs[$langKey]['cats'] as $k => $s )
				{
					if ( $s == $newKey )
					{
						unset( $langs[$langKey]['cats'][$k] );

						break;
					}
				}
				
				$langs[$langKey]['cats'] = array_values( $langs[$langKey]['cats'] );
			
				//Finally, save the database
				$this->addDB ( $langs, DB_LANGS );
			}
		}
	
    }

    public function addCategory( $key, $lang, $blog )
    {
        if ( $key === '' )
            return;
		
		//Remove any special chars. Use the bludit's build in function for compatibility reasons
		$key = Text::cleanUrl( $key );

        if ( !empty( $blog ) )
        {

            $blogs = $this->openDB ( DB_BLOGS );

            if ( !isset( $blogs[$blog] ) )
                return;

            $search = $this->searchCategory ( $key, false, true );

            if ( !$search )
            {
                if ( !is_array( $blogs[$blog]['cats'] ) )
                    $blogs[$blog]['cats'] = array();

                array_push( $blogs[$blog]['cats'], $key );
            }
                        
            $this->addDB ( $blogs, DB_BLOGS );

        }

        if ( !empty( $lang ) )
        {

            $langs = $this->openDB ( DB_LANGS );

            if ( !isset( $langs[$lang] ) )
                return;

            $search = $this->searchCategory ( $key, true );

            if ( !$search )
            {
                if ( !is_array( $langs[$lang]['cats'] ) )
                    $langs[$lang]['cats'] = array();
                
                array_push( $langs[$lang]['cats'], $key );
            }
                        
            $this->addDB ( $langs, DB_LANGS );

        }
    }
	
	public function getCategoriesHomeList( $lang = '' )
    {
		$cats = array();
		
		$data = $this->blogs;
		
		global $categories;
		
		$categoriesDB = $categories->db;
		
		$url = $this->site_url();
					
		foreach ( $categoriesDB as $key => $fields )
		{
			//If we don't have any posts, then don't add this category
			if ( empty( $fields['list'] ) )
				continue;
			
			$search = $this->searchCategory ( $key, false, true );
			
			//This category belongs to a subblog, so don't add it here
			if ( !empty ( $search ) )
				continue;
			
			$urlCat = $url;
			
			if ( !empty( $lang ) )
			{
				$searchLang = $this->searchCategory ( $key, true, false );
				
				//If the category belongs to our main language, but we are not in that language, don't add it
				if ( empty( $searchLang ) || ( $searchLang['lang'] !== $lang ) )
					continue;
				
				if ( !$this->getValue( 'hide-slug' ) )
					$urlCat .= $lang . '/';
			}
			else
			{
				$searchLang = $this->searchCategory ( $key, true, false );
				
				//If the category belongs to a sub-language, but we are not in that language, don't add it
				if ( !empty( $searchLang ) )
					continue;
			}
			
			$urlCat .= 'category/' . $key . '/';
			
			$cats[$key] = array( 'name' => $fields['name'], 'url' => $urlCat );
			
		}
		
		unset( $categoriesDB, $data );

		return $cats;
		
	}
	public function getCategoriesBlogList( $lang = '' )
    {

		$cats = array();
		
		$data = $this->blogs;
			
		//Nothing to do here if we don't have any page
		if ( empty ( $data ) )
			return;
		
		global $categories;
		
		$categoriesDB = $categories->db;
		
		//We don't need this anymore
		unset( $categories );
		
		$url = $this->site_url();
		        
        if ( !empty( $lang ) )
        {
			$langsDB = $this->openDB( DB_LANGS );
			
			if ( empty ( $langsDB ) || !isset( $langsDB[$lang] ) )
				return;
			
			$catList = $langsDB[$lang]['cats'];
		}
		
		$defaultLang = $this->getValue( 'default-lang' );
		
		$enableForum = $this->getValue( 'enable-forum' );
			
		foreach ( $data as $key => $fields )
		{
			$urlBlog = $url;
			
			if ( !empty( $lang ) )
			{
				$urlBlog .= $lang . '/';
			}
				
			$urlBlog .= $key . '/';
			
			if ( isset( $fields['disable'] ) && !empty( $fields['disable'] ) )
				continue;
			
			if ( ( $fields['enabled'] !== 'everywhere' ) && ( ( !empty( $lang ) && ( $fields['enabled'] !== $lang ) ) || ( !empty( $defaultLang ) && ( $fields['enabled'] !== $defaultLang['code'] ) ) ) )
				continue;
			
			$cats[$key] = array( 'name' => $fields['name'], 'url' => $urlBlog, 'cats' => array() );
			
			if ( !isset( $data[$key]['cats'] ) || empty( $data[$key]['cats'] ) )
				continue;
			
			$keys = $data[$key]['cats'];
			
			foreach ( $keys as $catKey )
			{
				if ( !empty( $lang ) && !empty( $catList ) && !in_array( $catKey, $catList ) )
				{
					continue;
				}
				
				if ( empty( $categoriesDB[$catKey]['list'] ) )
					continue;
				
				if ( ( $enableForum !== 'disable' ) && ( $key == $enableForum ) )
					continue;
				
				$search = $this->searchCategory ( $catKey, true, false );
				
				//If we are not in a language, we shouldn't add the wrong categories
				if ( empty( $lang ) && !empty ( $search ) )
					continue;
				
				//The same goes if we are in a language
				elseif ( !empty( $lang ) && empty ( $search ) )
					continue;
				
				$urlCat = $url;
				
				if ( !$this->getValue( 'hide-slug' ) )
				{
					if ( !empty( $lang ) )
					{
						$urlCat .= $lang . '/';
					}
						
					$urlCat .= $key . '/';
				}
				
				$urlCat .= 'category/' . $catKey;
				
				$catName = $categoriesDB[$catKey]['name'];
				
				$cats[$key]['cats'][$catKey] = array( 'name' => $catName, 'url' => $urlCat );
			}
		}
		
		unset( $categoriesDB, $data, $langsDB );

		return $cats;
    }
		
	/**
	* Sets the user ID
	*
	* @access private
	*/
	private function checkUser()
	{
		
	}
	
	/**
	* Builds the langs codes array
	*
	* @access public
	* @return array
	*/
    public function buildLangCodes()
    {
        $langs = array();

        $langsDB = $this->openDB( DB_LANGS );
        
        if ( !empty( $langsDB ) )
        {
            foreach ( $langsDB as $code=>$lang ) 
                array_push ( $langs, $code );
        }
        
        return $langs;
    }
	
	/**
	* Builds the langs array
	*
	* @access public
	* @return array
	*/
    public function buildLangsArray()
    {
        $languages = array();

        $langsDB = $this->openDB( DB_LANGS );
		
        require( PHP_FOLDER . 'helpers' . DS . 'langs.php' );
        
        if ( !empty( $langsDB ) )
        {
            foreach ( $langsDB as $code=>$lang )
            {
                if ( isset( $langs[$lang['code']] ) )
                    $languages[$code] = $langs[$lang['code']];
                    //array_push ( $langs, $this->$langs[$lang['code']] );
            }
        }
        
        return $languages; //return $this->langs = $langs;
    }
	
	/**
	* Builds the blogs array
	*
	* @access public
	* @return array
	*/
    public function buildBlogsArray()
    {    		
        return $this->blogs = $this->openDB ( DB_BLOGS );
    }
	
	/**
	* Adds a DB file
	*
	* @access public
	* @param array $data
	* @param string $file
	*/
	private function addDB ( $data, $file ) 
	{
		$data = json_encode( $data, JSON_PRETTY_PRINT);

		$data_dt = "<?php defined('BLUDIT') or die('Bludit CMS.'); ?>" . PHP_EOL . $data;
		
		return file_put_contents( $file, $data_dt, LOCK_EX);
	}
	
	/**
	* Opens a DB file
	*
	* @access public
	* @param string $file
	* @param bool $keys
	* @return array
	*/
    private function openDB ( $file, $keys = false )
    {
		if ( !$keys )
			return ( file_exists( $file ) ? json_decode( file_get_contents( $file, NULL, NULL, 50 ), TRUE ) : array() );
		
		else
		{
			$data = ( file_exists( $file ) ? json_decode( file_get_contents( $file, NULL, NULL, 50 ), TRUE ) : array() );
			
			return array_keys( $data );
		}
    }
	
	/**
	* Returns the site's url with trailing slash
	*
	* @access private
	* @return string
	*/
	private function site_url() 
	{
		global $site;
		
		$site_url = (string) $site->url();
		
		if ( empty ( $site_url ) )
		{
			$site_url = ( ( isset( $_SERVER['HTTPS'] ) && ( $_SERVER['HTTPS'] == 'on' ) ) ? 'https' : 'http' ) . '://' . $_SERVER['SERVER_NAME'] . str_replace( 'index.php', '', $_SERVER['SCRIPT_NAME'] );
			
		}
		
		$last = $site_url[strlen($site_url)-1];
							
		if ($last != '/')
			$site_url = $site_url . '/';
			
		return $site_url;
	}
	
	/**
	* Installs the plugin and creates the DB files
	*
	* @access public
	*/
	public function install( $position = 1 )
	{
		global $site;
		
		parent::install($position);
		
		$default_lang = $site->language();
		
		$site_lang = array();
		
		require( PHP_FOLDER . 'helpers' . DS . 'langs.php' );
		
		foreach ( $langs as $key=>$row ) 
		{
			if ( ( $default_lang == $row['name'] ) || ( $default_lang == $row['code'] ) )
			{
				$site_lang = $langs[$key];
				
				break;
			}
		
		}
		
		//Create our DB dir
		$this->createDir( DB_FOLDER );
		
		//Create empty DB files
		$this->createDB ( DB_BLOGS );
		$this->createDB ( DB_LANGS );
		$this->createDB ( DB_TOPICS );
		//$this->createDB ( DB_REPLIES );
		
		$this->db['default-lang'] = $site_lang;
		
		$this->db['default-lang']['changed'] = false;
		
		return $this->save();
	}
	
	/**
	* Creates an empty DB file
	*
	* @access public
	* @param string $file
	*/
	public function createDB ( $file ) 
	{
		if ( !file_exists( $file ) )
			return $this->addDB( array(), $file );
		
		return;
	}
	
	/**
	* Sanitizes a string
	*
	* @access public
	* @param string $string
	* @return string
	*/
	public function sanitize( $string ) 
	{
		return filter_var ( $string, FILTER_SANITIZE_STRING );
	}
	
	public static function getPosts( $test = '' ) 
	{
		//global $data;
		//print_r($data);
		//return $test;
	}
	
	/**
	* Returns the sitemap url
	*
	* @access public
	* @return string
	*/
	public function sitemapURL()
	{
		return $this->site_url() . 'sitemap.xml';
	}
	
	private function siteIndex()
	{
		$doc = new DOMDocument('1.0', 'UTF-8');
		
		//Non Friendly XML code
		$doc->formatOutput = false;
		
		// create urlset element
		$urlset = $doc->createElement("sitemapindex");
		$url_node = $doc->appendChild( $urlset );

		//set attributes
		$url_node->setAttribute("xmlns:xsi","http://www.w3.org/2001/XMLSchema-instance");
		$url_node->setAttribute("xmlns:schemaLocation","http://www.sitemaps.org/schemas/sitemap/0.9");
		$url_node->setAttribute("xmlns","http://www.sitemaps.org/schemas/sitemap/0.9");
		
		$blogs = $this->blogs;
				
		foreach ( $blogs as $key => $values ) 
		{
			if ( $values['disable'] )
				continue;
			
			$url = $this->site_url();
			
			$url .= 'sitemap-' . $key . '.xml';
			
			$index_url = $doc->createElement( 'sitemap' );
			$index_url->appendChild( $doc->createElement( 'loc', $url ) );
			$index_url->appendChild( $doc->createElement( 'lastmod', date( 'c', time() ) ) );		
				
			$urlset->appendChild($index_url);
		}
		
		$url = $this->site_url() . 'sitemap-main.xml';
		
		$index_url = $doc->createElement( 'sitemap' );
		$index_url->appendChild( $doc->createElement( 'loc', $url ) );
		$index_url->appendChild( $doc->createElement( 'lastmod', date( 'c', time() ) ) );		
				
		$urlset->appendChild($index_url);
		
		$url = $this->site_url() . 'sitemap-home.xml';
		
		$index_url = $doc->createElement( 'sitemap' );
		$index_url->appendChild( $doc->createElement( 'loc', $url ) );
		$index_url->appendChild( $doc->createElement( 'lastmod', date( 'c', time() ) ) );		
				
		$urlset->appendChild($index_url);
		
		$this->siteMain();
		
		$this->siteHome();
		
		$this->sitemapChilds();
		
		return $doc->save( $this->workspace() . 'sitemap.xml' );
	}
	
	private function siteMain()
	{
		$posts = $this->openDB( DB_PAGES );
		
		if ( empty( $posts ) )
			return;
		
		$doc = new DOMDocument('1.0', 'UTF-8');
		
		//Non Friendly XML code
		$doc->formatOutput = false;
		
		// create urlset element
		$urlset = $doc->createElement("urlset");
		$url_node = $doc->appendChild( $urlset );

		//set attributes
		$url_node->setAttribute("xmlns:xsi","http://www.w3.org/2001/XMLSchema-instance");
		$url_node->setAttribute("xmlns:schemaLocation","http://www.sitemaps.org/schemas/sitemap/0.9");
		$url_node->setAttribute("xmlns","http://www.sitemaps.org/schemas/sitemap/0.9");
		
		foreach ( $posts as $key=>$row )
		{
			$search = $this->searchKey( $key );
						
			//We don't want any post that belongs to a blog
			if ( !empty( $search ) )
				continue;
			
			$url = $this->site_url();
					
			if ( !$this->getValue( 'hide-slug' ) )
			{
				if ( $this->getValue( 'enable-langs' ) )
				{
					$searchLang = $this->searchKey( $key, 'langs' );
							
					if ( !empty( $searchLang ) ) 
						$url .= $searchLang['lang'] . '/';
				}
			}

			$url .= $key;
			
			$date = ( !empty( $row['date'] ) ? strtotime( $row['date'] ) : time() );
			
			$index_url = $doc->createElement( 'url' );
			$index_url->appendChild( $doc->createElement( 'loc', $url ) );
			$index_url->appendChild( $doc->createElement( 'lastmod', date( 'c', $date ) ) );		
				
			$urlset->appendChild($index_url);
		}
		
		return $doc->save( $this->workspace() . 'sitemap-main.xml' );
	}
	
	private function siteHome()
	{
		$doc = new DOMDocument('1.0', 'UTF-8');
		
		//Non Friendly XML code
		$doc->formatOutput = false;
		
		// create urlset element
		$urlset = $doc->createElement("urlset");
		$url_node = $doc->appendChild( $urlset );

		//set attributes
		$url_node->setAttribute("xmlns:xsi","http://www.w3.org/2001/XMLSchema-instance");
		$url_node->setAttribute("xmlns:schemaLocation","http://www.sitemaps.org/schemas/sitemap/0.9");
		$url_node->setAttribute("xmlns","http://www.sitemaps.org/schemas/sitemap/0.9");
		
		$blogs = $this->blogs;
		
		$data = $this->openDB( DB_LANGS );
				
		foreach ( $blogs as $key => $values ) 
		{
			$url = $this->site_url();
			
			if ( $values['disable'] )
				continue;
			
			if ( $values['enabled'] == 'everywhere' )
			{
				if ( $this->getValue( 'enable-langs' ) )
				{
					foreach ( $data as $k => $v )
					{
						$url .= $k . '/' . $key . '/';
						
						$index_url = $doc->createElement( 'url' );
						$index_url->appendChild( $doc->createElement( 'loc', $url ) );
						$index_url->appendChild( $doc->createElement( 'lastmod', date( 'c', time() ) ) );		
						
						$urlset->appendChild($index_url);
					}
					
				}
				
				$index_url = $doc->createElement( 'url' );
				$index_url->appendChild( $doc->createElement( 'loc', $this->site_url() . $key . '/' ) );
				$index_url->appendChild( $doc->createElement( 'lastmod', date( 'c', time() ) ) );		
				
				$urlset->appendChild($index_url);
			}
			else
			{
				$url .= $key . '/';
				
				$index_url = $doc->createElement( 'url' );
				$index_url->appendChild( $doc->createElement( 'loc', $url ) );
				$index_url->appendChild( $doc->createElement( 'lastmod', date( 'c', time() ) ) );

				$urlset->appendChild( $index_url );				
			}

		}
		
		if ( $this->getValue( 'enable-langs' ) )
		{
			foreach ( $data as $k => $v )
			{
				$index_url = $doc->createElement( 'url' );
				$index_url->appendChild( $doc->createElement( 'loc', $this->site_url() . $k ) );
				$index_url->appendChild( $doc->createElement( 'lastmod', date( 'c', time() ) ) );		
					
				$urlset->appendChild($index_url);
			}
		}
		
		$index_url = $doc->createElement( 'url' );
		$index_url->appendChild( $doc->createElement( 'loc', $this->site_url() ) );
		$index_url->appendChild( $doc->createElement( 'lastmod', date( 'c', time() ) ) );		
			
		$urlset->appendChild($index_url);
		
		return $doc->save( $this->workspace() . 'sitemap-home.xml' );
	}
	
	public function sitemapXmlArray()
	{
		if ( $this->getValue( 'enable-sitemap' ) === 'disable' )
			return '';
		
		$blogs = $this->blogs;
		
		if ( empty( $blogs ) )
			return;
		
		$temp = array( 'sitemap.xml' );
		
		if ( $this->getValue( 'enable-sitemap' ) === 'enable-group' )
		{
		
			foreach ( $blogs as $key => $values ) 
			{
				if ( ( $values['disable'] ) || empty( $values['list'] ) )
					continue;
				
				$siteMapFile = 'sitemap-' . $key . '.xml';
				
				$temp[] = $siteMapFile;
			}
			
			array_push( $temp, 'sitemap-main.xml' );
			
			array_push( $temp, 'sitemap-home.xml' );
		
		}

		return $this->sitemaps = $temp;	
	}

	public function sitemapChilds()
	{
		//There is no point to continue, if we didn't enable this option
		if ( $this->getValue( 'enable-sitemap' ) !== 'enable-group' )
			return;
		
		$blogs = $this->blogs;
		
		$posts = $this->openDB( DB_PAGES );
		
		$imageUrl = $this->site_url() . 'bl-content' . PS . 'uploads' . PS . 'pages' . PS;
				
		foreach ( $blogs as $key => $values ) 
		{
			//Show only the blogs that are enabled and have posts
			if ( ( $values['disable'] ) || empty( $values['list'] ) )
				continue;
			
			if ( !empty( $values['noindex'] ) )
				continue;
			
			$siteMapURL = 'sitemap-' . $key . '.xml';//$this->site_url() . 'sitemap-' . $key . '.xml';
				
			$doc = new DOMDocument('1.0', 'UTF-8');
				
			//Non Friendly XML code
			$doc->formatOutput = false;
				
			// create urlset element
			$urlset = $doc->createElement("urlset");
			$url_node = $doc->appendChild( $urlset );

			//set attributes
			$url_node->setAttribute("xmlns:xsi","http://www.w3.org/2001/XMLSchema-instance");
			$url_node->setAttribute("xmlns","http://www.sitemaps.org/schemas/sitemap/0.9");
			$url_node->setAttribute("xmlns:mobile","http://www.google.com/schemas/sitemap-mobile/1.0");
			$url_node->setAttribute("xmlns:image","http://www.google.com/schemas/sitemap-image/1.1");
			$url_node->setAttribute("xmlns:schemaLocation","http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd");
			
			foreach ( $values['list'] as $pageKey )
			{
				if ( !isset( $posts[$pageKey] ) )
					continue;
				
				//If a post has noIndex enabled, then we can't add it here
				if ( !empty( $posts[$pageKey]['noindex'] ) )
					continue;
				
				$url = $this->site_url();
				
				if ( !$this->getValue( 'hide-slug' ) )
				{
					$search = $this->searchKey( $pageKey );
										
					if ( $this->getValue( 'enable-langs' ) )
					{
						$searchLang = $this->searchKey( $pageKey, 'langs' );
						
						if ( !empty( $searchLang ) ) 
							$url .= $searchLang['lang'] . '/';
					}
					
					if ( !empty( $search ) )
						$url .= $search['blog'] . '/';
				}
				
				$url .= $pageKey;
				
				$date = ( !empty( $posts[$pageKey]['date'] ) ? strtotime( $posts[$pageKey]['date'] ) : time() );

				$post_url = $doc->createElement('url');
				$post_url->appendChild($doc->createElement( 'loc', $url ) );
				$post_url->appendChild($doc->createElement( 'lastmod', date( 'c', $date ) ) );
				
				
				if ( checkKey( $this->getValue( 'seo-settings' ), 'sitemapFeatured' ) && !empty( $posts[$pageKey]['coverImage'] ) )
				{
					$post_image = $imageUrl . $posts[$pageKey]['uuid'] . PS . $posts[$pageKey]['coverImage'];
					
					//Find image's name
					$filename = pathinfo($post_image, PATHINFO_FILENAME);
					
					//Append image
					$img = $post_url->appendChild($doc->createElement('image:image'));
					$img_loc = $img->appendChild($doc->createElement('image:loc', $post_image));
					$img_title = $img->appendChild($doc->createElement('image:title', $filename));
				}
				
				if ( checkKey( $this->getValue( 'seo-settings' ), 'sitemapImages' ) )
				{
					$page = buildPage( $pageKey );
					
					$images = $this->getImages( $page->content() );
					
					if ( $images )
					{
						foreach ( $images as $image )
						{
							if ( get_HostName ( $image ) === get_HostName ( $site->url() ) )
							{
								$post_image = $imageUrl . $posts[$pageKey]['uuid'] . PS . $image;
								
								//Find image's name
								$filename = pathinfo($post_image, PATHINFO_FILENAME);
								
								//Append image
								$img = $post_url->appendChild($doc->createElement('image:image'));
								$img_loc = $img->appendChild($doc->createElement('image:loc', $post_image));
								$img_title = $img->appendChild($doc->createElement('image:title', $filename));
							}
						}
					}
				}
					
				//$post_url->appendChild($doc->createElement( 'changefreq', 'weekly' ) );
				//$post_url->appendChild($doc->createElement( 'priority', '0.3' ) );
				
				$urlset->appendChild($post_url);
			}
			
			$doc->save( $this->workspace() . $siteMapURL );
		}
	}
		
	public function sitemapIndex() 
	{
		
		if ( $this->getValue( 'enable-sitemap' ) === 'disable' )
			return;
		
		//This is the default sitemap listing
		if ( $this->getValue( 'enable-sitemap' ) === 'enable-nogroup' )
		{
			//$this->sitemaps = array( 'sitemap.xml' );
			
			return $this->siteNoIndex();
		}
		
		//This is the advanced sitemap listing
		elseif ( $this->getValue( 'enable-sitemap' ) === 'enable-group' )
		{
			return $this->siteIndex();
		}
	}
	
	/**
	* Loads and echoes a sitemap file
	*
	* @access public
	* @param string $file
	*/
	public function sitemapLoad( $file = '' ) 
	{
		if ( $this->getValue( 'enable-sitemap' ) === 'disable' )
			return;
		
		// Send XML header
		header('Content-type: text/xml');
		$doc = new DOMDocument();

		// Workaround for a bug https://bugs.php.net/bug.php?id=62577
		libxml_disable_entity_loader( false );
		
		if ( !empty( $file ) )
		{
			//If we don't have it, then we can't continue;
			if ( !file_exists( $this->workspace() . $file ) )
				return;
			
			// Load the XML
			$doc->load( $this->workspace() . $file );
		}
		else
		{
			//If we don't have the file, we have to build it first
			if ( !file_exists( $this->workspace() . 'sitemap.xml' ) )
				$this->sitemapIndex();
			
			// Load the XML
			$doc->load( $this->workspace() . 'sitemap.xml' );
		}
		
		libxml_disable_entity_loader( true );
		
		// Print the XML
		echo $doc->saveXML();
	}
	
	/**
	* Builds the uri
	*
	* @access public
	* @return array
	*/
	public function buildUriArray()
    {	
		$uri = array();
				
		if ( strpos( $this->getUri(), '/' ) !== false )
		{
			$tempUri = explode ( '/', $this->getUri() ) ;
			
			$i = 0;
			
			$b = 0;
			
			if ( !empty( $tempUri ) )
			{
				foreach ( $tempUri as $temp )
				{
					if ( empty( $temp ) )
					{
						$b++;
						continue;
					}
					
					$uri[$i] = $tempUri[$b];
					$b++;
					$i++;
				}
			}

			unset( $tempUri );
		}
		else
			$uri['0'] = $this->getUri();
			
		return $uri;
	}
	
	/**
	* Returns all the images found in a text
	*
	* @access public
	* @param string $content
	* @return array
	*/
	public function getImages($content)
	{
		$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/ii', $content, $matches);
			
		if (!empty($matches['1']))
			return $matches['1'];

		return false;
	}
	
	/**
	* Returns the first image from the page content
	*
	* @access public
	* @param string $content
	* @return array
	*/
	public function getImage( $content )
	{
		$output = preg_match_all( '/<img.+src=[\'"]([^\'"]+)[\'"].*>/ii', $content, $matches );
		
		if ( !empty( $matches[1][0] ) )
			return $matches[1][0];

		return false;
	}
	
	/**
	 * Submit the sitemap xml to search engines
	 *
	 * @access public
	 */
	public function ping() 
	{
		
		$sitemap_url = $this->sitemapURL();
			
        $curl_req = array();
        $urls = array();
		
        // below are the SEs that we will be pining
        $urls[] = "https://www.google.com/webmasters/tools/ping?sitemap=" . urlencode( $sitemap_url );
        $urls[] = "https://www.bing.com/webmaster/ping.aspx?siteMap=" . urlencode( $sitemap_url );
		$urls[] = "https://blogs.yandex.ru/pings/?status=success&url=" . urlencode( $sitemap_url );

        foreach ($urls as $url)
        {
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURL_HTTP_VERSION_1_1, 1);
            $curl_req[] = $curl;
        }
       
	   //initiating multi handler
        $multiHandle = curl_multi_init();

        // adding all the single handler to a multi handler
        foreach( $curl_req as $key => $curl )
        {
            curl_multi_add_handle( $multiHandle,$curl );
        }
        
		$isactive = null;
        
		do
        {
            $multi_curl = curl_multi_exec( $multiHandle, $isactive );
        }
        
		while ( $isactive || $multi_curl == CURLM_CALL_MULTI_PERFORM );

        $success = true;
        
		foreach( $curl_req as $curlO )
        {
            if( curl_errno( $curlO ) != CURLE_OK )
            {
                $success = false;
            }
        }
        
		curl_multi_close( $multiHandle );
		
		//$this->db['ping_time'] = time();
        
		return $success;
    }
	
	/**
	 * Replaces every image from string and copies the image locally
	 *
	 * @access private
	 * @param string $content
	 * @param string $uuid
	 * @param string $uploadDir
	 * @param string $thumbDir
	 * @param string $imgCover
	 */
	private function replaceImage( $content, $uuid, $uploadDir, $thumbDir = '', $imgCover = '' )
	{
		//Let's search if there are any images...
		$pattern = '/<img.+src=[\'"]([^\'"]+)[\'"].*>/';
				
		preg_match_all( $pattern, $content, $matches );
		
		$htmlPath = $this->site_url() . 'bl-content/uploads/pages/' . $uuid . '/';

		if ( !empty( $matches['1'] ) )
		{
			foreach ( $matches['1'] as $img ) 
			{
				if ( !empty( $imgCover ) && ( strpos( $img, $imgCover ) !== false ) )
				{	
					$content = str_replace( $img, '', $content );
			
					continue;
				}
				
				$name = returnImgName( $img );
				
				$copy = create_image( returnImgUrl( $img ), $uploadDir, $name );
				
				if ( $copy )
				{
					$content = str_replace( $img, $htmlPath . $name, $content );
					
					//Create the thumbnail also
					create_image( returnImgUrl( $img ), $thumbDir, $name, true );
				}
			}
			
		}
		
		return $content;
	}
	
	/**
	 * Transliterates non-ascii characters for use in URLs
	 *
	 * @access public
	 * @param string $string
	 * @return string
	 */
	public function URLify( $string )
	{
		if ( !class_exists( 'URLify' ) ) 
		{
			require ( $this->phpPath() . 'plugins' . DS . 'urlify' . DS . 'URLify.php' );
		}
		
		return URLify::filter( $string );
	}
	
	/**
	 * Creates a new writeble dir
	 *
	 * @access private
	 * @param string $dir
	 */
	private function createDir( $dir )
	{
		if ( !is_dir( $dir ) )
			mkdir( $dir, 0755, true ) or die ( 'Could not create folder ' . $dir );
	}
}
