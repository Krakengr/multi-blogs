<?php defined('BLUDIT') or die('Bludit CMS.');
//print_r($_POST);exit;
if ( isset( $_POST['menuForm'] ) )
{
	$menu = $this->openDB( DB_MENU );
	
	$menu = json_decode( $_POST['hide'], TRUE );
	
	$this->addDB ( $menu, DB_MENU );
}

if ( isset( $_POST['postDeleteForm'] ) )
{
	$isForum = $_POST['isForum'];
	
	$key = $_POST['pageKey'];
	
	$hash = $_POST['nonce'];
	
	if ( checkFormHash( $hash ) )
	{
		$this->deleteData ( $key, $isForum );
		
		header( 'Location:' . $this->site_url() . 'admin/content' );
		exit;
	}
}

if ( $url->slug() == 'new-category' )
{
	$lang = Sanitize::html( $_POST['lang'] );
	$key = Sanitize::html( $_POST['name'] );
	$blog = Sanitize::html( $_POST['blog'] );

	$this->addCategory( $key, $lang, $blog );
}
			
if ( isset( $_POST['TransPost'] ) )
{
	//print_r($_POST);exit;
	$key = Sanitize::html( $_POST['slug'] );
	$blog = ( isset( $_POST['blog'] ) ? Sanitize::html( $_POST['blog'] ) : '' );
	$lang = ( isset( $_POST['lang'] ) ? Sanitize::html( $_POST['lang'] ) : '' );
	$parent = ( isset( $_POST['parentPost'] ) ? Sanitize::html( $_POST['parentPost'] ) : '' );
	$uuid = ( isset( $_POST['uuid'] ) ? Sanitize::html( $_POST['uuid'] ) : '' );

	$this->addPage( $key, $blog, $lang, $parent, $uuid, $_POST );

}

if ( strpos( $url->slug(), 'edit-category/' ) !== false )
{
	$this->updateCategory( $_POST );
				
	if ( isset( $_POST['DoRedirect'] ) && !empty( $_POST['DoRedirect'] ) && ( $_POST['action'] !== 'delete' ) )
	{
		header( 'Location:' . $_POST['DoRedirect'] );
		exit;
	}
}

