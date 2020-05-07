<?php defined('BLUDIT') or die('Bludit CMS.');

global $pages, $site;

$format = $site->dateFormat();

$get = $_GET;

$type = ( isset( $get['type'] ) ? $get['type'] : 'published' );

$blog = ( isset( $get['blog'] ) ? $get['blog'] : '' );

$lang = ( isset( $get['lang'] ) ? $get['lang'] : '' );

$nav = ( isset( $get['pg'] ) ? (int) $get['pg'] : 0 );

$iconsHtml = $this->htmlPath() . 'flags/';

$iconsPath = $this->phpPath() . 'flags/';

if ( $this->getValue( 'enable-langs' ) )
{
	$defaultLang = $this->getValue( 'default-lang' );
	
	$langs = $this->openDB( DB_LANGS );
}

$deleteMessage = $L->get( 'delete-message' );

if ( isset( $get['type'] ) && ( $get['type'] == 'forum' ) )
	$deleteMessage = $L->get( 'delete-forum-message' );

if ( isset( $get['type'] ) && ( $get['type'] == 'topics' ) )
	$deleteMessage = $L->get( 'delete-topic-message' );

$thtml = '<!-- NAV TABS --><nav class="mb-3"><div class="nav nav-tabs" id="nav-tab" role="tablist">';
	
$thtml .= '<a class="nav-item nav-link ' . ( ( !isset( $get['type'] ) || ( $get['type'] == 'published' ) ) ? 'active' : '' ) . '" href="' . $this->site_url() . 'admin/content">' . $L->get( 'tab-published' ) . '</a>';

if ( $this->getValue( 'enable-forum' ) !== 'disable' )
{
	$thtml .= '<a class="nav-item nav-link ' . ( ( isset( $get['type'] ) && ( $get['type'] == 'forum' ) ) ? 'active' : '' ) . '" href="' . $this->site_url() . 'admin/content?type=forum">' . $L->get( 'forums' ) . '</a>';
	
	$thtml .= '<a class="nav-item nav-link ' . ( ( isset( $get['type'] ) && ( $get['type'] == 'topics' ) ) ? 'active' : '' ) . '" href="' . $this->site_url() . 'admin/content?type=topics">' . $L->get( 'tab-topics' ) . '</a>';
}

if ( $this->getValue( 'enable-shop' ) !== 'disable' )
{
	$thtml .= '<a class="nav-item nav-link ' . ( ( isset( $get['type'] ) && ( $get['type'] == 'shop' ) ) ? 'active' : '' ) . '" href="' . $this->site_url() . 'admin/content?type=shop">' . $L->get( 'tab-shop' ) . '</a>';
}

if ( $this->getValue( 'allow-users' ) )
	$thtml .= '<a class="nav-item nav-link ' . ( ( isset( $get['type'] ) && ( $get['type'] == 'users' ) ) ? 'active' : '' ) . '" href="' . $this->site_url() . 'admin/content?type=users">' . $L->get( 'members' ) . '</a>';

if ( $this->getValue( 'enable-redirs' ) )
	$thtml .= '<a class="nav-item nav-link ' . ( ( isset( $get['type'] ) && ( $get['type'] == 'redirs' ) ) ? 'active' : '' ) . '" href="' . $this->site_url() . 'admin/content?type=redirs">' . $L->get( 'redirs' ) . '</a>';

$thtml .= '<a class="nav-item nav-link ' . ( ( isset( $get['type'] ) && ( $get['type'] == 'static' ) ) ? 'active' : '' ) . '" href="' . $this->site_url() . 'admin/content?type=static">' . $L->get( 'tab-static' ) . '</a>';

$thtml .= '<a class="nav-item nav-link ' . ( ( isset( $get['type'] ) && ( $get['type'] == 'sticky' ) ) ? 'active' : '' ) . '" href="' . $this->site_url() . 'admin/content?type=sticky">' . $L->get( 'tab-sticky' ) . '</a>';

$thtml .= '<a class="nav-item nav-link ' . ( ( isset( $get['type'] ) && ( $get['type'] == 'scheduled' ) ) ? 'active' : '' ) . '" href="' . $this->site_url() . 'admin/content?type=scheduled">' . $L->get( 'tab-scheduled' ) . '</a>';

$thtml .= '<a class="nav-item nav-link ' . ( ( isset( $get['type'] ) && ( $get['type'] == 'draft' ) ) ? 'active' : '' ) . '" href="' . $this->site_url() . 'admin/content?type=draft">' . $L->get( 'tab-draft' ) . '</a>';

$thtml .= '<a class="nav-item nav-link ' . ( ( isset( $get['type'] ) && ( $get['type'] == 'autosave' ) ) ? 'active' : '' ) . '" href="' . $this->site_url() . 'admin/content?type=autosave">' . $L->get( 'tab-autosave' ) . '</a>';

$thtml .= '</div></nav>';

if ( !isset( $get['type'] ) || ( isset( $get['type'] ) && ( ( $get['type'] !== 'topics' ) && ( $get['type'] !== 'users' ) && ( $get['type'] !== 'redirs' ) ) ) )
{
	$thtml .= '<div class="form-group">';

	$thtml .= '<select class="form-control inline-select" id="blog_choice" name="blog_key" onchange="location = this.value;">';

	$thtml .= '<option value="' . $this->site_url() . 'admin/content">' . $L->get( 'select-blog' ) . '</option>';
	 
	foreach ( $this->blogs as $key => $row ) 
	{
		if ( $this->getValue( 'enable-forum' ) == $key )
			continue;
		
		if ( $this->getValue( 'enable-shop' ) == $key )
			continue;
		
		$thtml .= '<option value="' . $this->site_url() . 'admin/content?type=' . $type . '&blog=' . $key . ( isset( $get['lang'] ) ? '&lang=' . $get['lang'] : '' ) . '" ' . ( ( isset( $get['blog'] ) && ( $get['blog'] == $key ) ) ? 'selected' : '' ) . '>' . stripslashes( $row['name'] ) . '</option>';
	}
				
	$thtml .= '</select>';
	$thtml .= '</div>';
}

if ( !isset( $get['type'] ) || ( isset( $get['type'] ) && ( ( $get['type'] !== 'topics' ) && ( $get['type'] !== 'users' ) && ( $get['type'] !== 'redirs' ) ) ) )
{
	
	if ( $this->getValue( 'enable-langs' ) )
	{
		$thtml .= '<div class="form-group">';
		
		if ( !empty( $langs ) )
		{			
			$thtml .= '<select class="form-control inline-select" id="lang_choice" name="lang_key" onchange="location = this.value;">';

			$thtml .= '<option value="' . $this->site_url() . 'admin/content">' . $defaultLang['lang'] . '</option>';
			 
			foreach ( $langs as $key => $row )
			{
				
				$thtml .= '<option value="' . $this->site_url() . 'admin/content?type=' . $type . ( isset( $get['blog'] ) ? '&blog=' . $get['blog'] : '' ) . '&lang=' . $key . '" ' . ( ( isset( $get['lang'] ) && ( $get['lang'] == $key ) ) ? 'selected' : '' ) . '>' . stripslashes( $row['name'] ) . '</option>';
			}
					
			$thtml .= '</select>';
			$thtml .= '</div>';
		}
	}
}

$content = $this->buildAdminList ( $nav, $type, $blog, $lang );

if ( !empty( $content['list'] ) )
{
	
	$thtml .= '<!-- TABS -->';
	$thtml .= '<div class="tab-content">';

	$thtml .= '<!-- Main tab -->';
	$thtml .= '<div class="tab-pane fade show active" id="main" role="tabpanel" aria-labelledby="main-tab">';

	$thtml .= '<table class="table mt-3"><thead><tr>';
	
	if ( $type == 'redirs' )
	{
		$thtml .= '<th class="border-0" scope="col">' . $L->get( 'tab-old-url' ) . '</th>';
		
		$thtml .= '<th class="border-0" scope="col">' . $L->get( 'tab-redir-url' ) . '</th>';
		
		$thtml .= '<th class="border-0" scope="col">' . $L->get( 'tab-views' ) . '</th>';
	}
	
	else
	{

		$thtml .= '<th class="border-0" scope="col">' . $L->get( 'tab-title' ) . '</th>';
	
		$thtml .= '<th class="border-0" scope="col">' . $L->get( 'tab-url' ) . '</th>';
		
		
		if ( ( $this->getValue( 'enable-langs' ) ) && ( ( $type !== 'topics' ) && ( $type !== 'redirs' ) && ( $type !== 'users' ) ) )
		
		{
			if ( !empty( $langs ) )
			{		
				$file = ( file_exists( $iconsPath . $defaultLang['name'] . '.png' ) ? '<img src="' . $iconsHtml . $defaultLang['name'] . '.png" />' : $defaultLang['lang'] ); 
						
				$thtml .= '<th class="border-0 text-center d-sm-table-cell" scope="col">' . $file . '</th>';
				
				foreach ( $langs as $key => $row )
				{
					$file = ( file_exists( $iconsPath . $row['code'] . '.png' ) ? '<img src="' . $iconsHtml . $row['code'] . '.png" />' : $row['name'] ); 
					
					$thtml .= '<th class="border-0 text-center d-sm-table-cell" scope="col">' . $file . '</th>';
				}
			}
		}

		if ( $type == 'topics' )
		{
			$thtml .= '<th class="border-0 text-center d-sm-table-cell" scope="col">' . $L->get( 'forum-nav' ) . '</th>';
		}
		
	}
	
	$thtml .= '<th class="border-0 text-center d-sm-table-cell" scope="col">' . $L->get( 'tab-actions' ) . '</th>';

	$thtml .= '</tr></thead><tbody>';
	
	//Build the content tabs	
	if ( $type == 'redirs' )
	{
		foreach ( $content['list'] as $key => $row )
		{
			$editLink = $this->site_url() . 'admin/configure-plugin/pluginSubBlogs?redirs=true&edit=' . $key;
			
			$thtml .= '<tr>';
			
			$thtml .= '<td class="pt-3"><div>' . $row['oldUrl'] . '</div></td>';
			
			$thtml .= '<td class="pt-3"><a target="_blank" href="' . $row['newUrl'] . '">' . cutBigText( $row['newUrl'] ) . '</a></td>';
			
			$thtml .= '<td class="pt-3">' . $row['views'] . '</td>';
			
			$thtml .= '<td class="contentTools pt-3 text-center d-sm-table-cell"><a class="text-secondary d-none d-md-inline" target="_blank" href="' . $row['newUrl'] . '"><i class="fa fa-desktop"></i>' . $L->get( 'view-article' ) . '</a><a class="text-secondary d-none d-md-inline ml-2" href="' . $editLink . '"><i class="fa fa-edit"></i>' . $L->get( 'edit-article' ) . '</a>';
			
			$thtml .= '<a href="#" id="deletePageButton" class="ml-2 text-danger deletePageButton d-block d-sm-inline" data-toggle="modal" data-target="#deleteModal" data-pagekey="' . $key . '"><i class="fa fa-trash"></i>' . $L->get( 'delete-article' ) . '</a>';
			
			$thtml .= '</td></tr>';
		}
	}
	
	else
	{

		foreach ( $content['list'] as $key => $row )
		{
			$link = $this->buildUrlByKey( $key );
			
			$date = date( $format, strtotime( $row['date'] ) );
			
			$editLink = $this->site_url() . 'admin/edit-content/' . $key;
			
			$thtml .= '<tr><td class="pt-3"><div><a style="font-size: 1.1em" href="' . $editLink . '">' . htmlspecialchars( $row['title'], ENT_QUOTES ) . '</a></div>';
			
			if ( !isset( $get['type'] ) || ( $get['type'] !== 'forum' ) )
				$thtml .= '<div><p style="font-size: 0.8em" class="m-0 text-uppercase text-muted">' . $date . '</p></div></td>';
			
			$thtml .= '<td class="pt-3"><a target="_blank" href="' . $link . '">/' . $key . '</a></td>';
			
			if ( $type == 'topics' )
			{
				$thtml .= '<td class="pt-3 text-center"><a target="_blank" href="' . $this->buildUrlByKey( $row['forumKey'] ) . '">' . $row['forum'] . '</a></td>';
			}
			
			if ( ( $this->getValue( 'enable-langs' ) ) && ( $type !== 'topics' ) )
			{
				$searchLang = $this->searchKey( $key, 'langs' );

				$edit = '<a title="Edit" href="' . $editLink . '" target="_blank"><i class="fa fa-edit"></i>';
				
				$add = '<a title="Add" href="' . $editLink . '" target="_blank"><i class="fa fa-plus-circle"></i>';
				
				$thtml .= '<td class="pt-3 text-center">' . ( ( empty( $searchLang ) && empty( $lang ) ) ? $edit : $add ) . '</td>';
				
				if ( !empty( $langs ) )
				{
					foreach ( $langs as $Lkey => $row )
					{
						$searchTrans = $this->searchuuid( $key, true, $lang );

						if ( !empty( $searchTrans ) )
							$thtml .= '<td class="pt-3 text-center"><a title="Edit this translation" href="' . $this->site_url() . 'admin/edit-content/' . $searchTrans['key'] . '" target="_blank"><i class="fa fa-edit"></i></a></td>';
						else
							$thtml .= '<td class="pt-3 text-center"><a href="' . $this->site_url() . 'admin/new-content?lang=' . $Lkey . '&from=' . $key . '" target="_blank" title="Translate this post to ' . htmlspecialchars( $row['name'] ) . ' language"><i class="fa fa-plus-circle"></i></td>';
					}
				}
				
			}
					
			$thtml .= '<td class="contentTools pt-3 text-center d-sm-table-cell"><a class="text-secondary d-none d-md-inline" target="_blank" href="' . $link . '"><i class="fa fa-desktop"></i>' . $L->get( 'view-article' ) . '</a><a class="text-secondary d-none d-md-inline ml-2" href="' . $editLink . '"><i class="fa fa-edit"></i>' . $L->get( 'edit-article' ) . '</a>';
			
			//$thtml .= '<a href="url_to_delete" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"></i>' . $L->get( 'delete-article' ) . '</a>';
			
			$thtml .= '<a href="#" id="deletePageButton" class="ml-2 text-danger deletePageButton d-block d-sm-inline" data-toggle="modal" data-target="#deleteModal" data-pagekey="' . $key . '"><i class="fa fa-trash"></i>' . $L->get( 'delete-article' ) . '</a>';
			
			$thtml .= '</td></tr>';

		}
		
	}


$thtml .= '</tbody></table>';

$thtml .= '<ul class="pagination flex-wrap justify-content-center"><li class="page-item ' . ( empty( $content['first_page'] ) ? 'disabled' : '' ) . '"><a class="page-link" href="' . $content['first_page'] . '"><span class="align-middle fa fa-media-skip-backward"></span> ' . $L->get( 'nav-first' ) . '</a></li><li class="page-item ' . ( empty( $content['prev_url'] ) ? 'disabled' : '' ) . '"><a class="page-link" href="' . $content['prev_url'] . '">' . $L->get( 'nav-previous' ) . '</a></li><li class="page-item ' . ( empty( $content['next_url'] ) ? 'disabled' : '' ) . '"><a class="page-link" href="' . $content['next_url'] . '">' . $L->get( 'nav-next' ) . '</a></li><li class="page-item ' . ( empty( $content['last_page'] ) ? 'disabled' : '' ) . '"><a class="page-link" href="' . $content['last_page'] . '">' . $L->get( 'nav-last' ) . ' <span class="align-middle fa fa-media-skip-forward"></span></a></li></ul>';
}
else
	$thtml .= '<div class="alert alert-warning" role="alert">' . $L->get( 'nothing-found' ) . '</div>';
	//$thtml .= '<p>Nothing Found</p>';

$thtml .= '<!-- Modal --><div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true"><form id="formDelete" class="form-delete" action="' . $this->site_url() . 'admin/content" method="post"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header"><h5 class="modal-title" id="deleteModalLabel">' . $L->get( 'delete-content' ) . '</h5><button type="button" class="close" data-dismiss="modal" aria-label="' . $L->get( 'close' ) . '"><span aria-hidden="true">&times;</span></button></div><div class="modal-body">' . $deleteMessage . '<input type="hidden" name="postDeleteForm" value="true"><input type="hidden" name="pageKey" value=""><input type="hidden" name="nonce" value="' . generateFormHash() . '"><input type="hidden" name="isForum" value="' . ( ( isset( $get['type'] ) && ( $get['type'] == 'forum' ) ) ? 'forum' : ( ( isset( $get['type'] ) && ( $get['type'] == 'topics' ) ) ? 'topic' : '' ) ) . '"></div><div class="modal-footer"><span id="modal-key"></span><button type="button" class="btn btn-secondary" data-dismiss="modal">' . $L->get( 'close' ) . '</button><input type="submit" name="submit" class="btn btn-primary" value="' . $L->get( 'delete' ) . '" /></div></div></div></form></div>';