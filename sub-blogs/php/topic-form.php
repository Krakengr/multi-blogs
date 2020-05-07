<?php defined('BLUDIT') or die('Bludit CMS.');

$shtml .= '<div class="form-group">';

$shtml .= '<select name="forum_parent">';

$shtml .= '<option value="">' . $L->get( 'select-forum' ) . '</option>';

if ( !empty( $forumList ) ) 
{
	$posts = $this->openDB( DB_PAGES );
	
	foreach ( $forumList as $key ) 
	{             
		$searchTopic = $this->searchKey( $key, 'topics' );
		
		if ( empty( $searchTopic ) )
			$shtml .= '<option value="' . $key . '">' . stripslashes( $posts[$key]['title'] ) . '</option>';
	}
}

$shtml .= '</select></div>';