<?php defined('BLUDIT') or die('Bludit CMS.');

if ( ( $url->parameter('store') !== false ) && ( $this->getValue( 'enable-shop' ) !== 'disable' ) )
{
	require ( PHP_FOLDER . 'arrays.php' );
	
	$this->countries = $countries;
	
	$this->currency = $currency;
		 
	require ( PHP_FOLDER . 'store-form.php' );
}

elseif ( ( $url->parameter('auto-content') !== false ) && $this->getValue( 'enableAutoContent' ) )
{
	require ( PHP_FOLDER . 'auto-content-form.php' );
}

elseif ( ( $url->parameter('widgets') !== false ) && $this->getValue( 'enableWidgets' ) )
{
	require ( PHP_FOLDER . 'widgets-form.php' );
}

elseif ( ( $url->parameter('users') !== false ) && $this->getValue( 'allow-users' ) )
{
	if ( $url->parameter('do') == 'add' )
		require ( PHP_FOLDER . 'tools' . DS . 'users-add.php' );
	
	elseif ( $url->parameter('do') == 'edit' )
		require ( PHP_FOLDER . 'tools' . DS . 'users-edit.php' );
		
	elseif ( $url->parameter('do') == 'roles' )
		require ( PHP_FOLDER . 'tools' . DS . 'users-roles.php' );
		
	else
		require ( PHP_FOLDER . 'tools' . DS . 'users-form.php' );
}

elseif ( ( $url->parameter('menu') !== false ) && ( $this->getValue( 'enableMenu' ) === 'manual' ) )
{
	require ( PHP_FOLDER . 'menu-form.php' );
}

elseif ( ( $url->parameter('redirs') !== false ) && $this->getValue( 'enable-redirs' ) )
{
	
	require ( PHP_FOLDER . 'redir-form.php' );
}

elseif ( ( $url->parameter('seo') !== false ) && $this->getValue( 'enable-seo' ) )
{
	require ( PHP_FOLDER . 'seo-form.php' );
}

elseif ( ( $url->parameter('addReply') !== false ) && $this->getValue( 'enable-forum' ) )
{
	$topic = $url->parameter('topic');
	
	require ( PHP_FOLDER . 'new-reply-form.php' );
}

elseif ( ( $url->parameter('forum') !== false ) && ( $this->getValue( 'enable-forum' ) !== 'disable' ) )
{
	require ( PHP_FOLDER . 'forum-general-form.php' );
}
	
elseif ( ( $url->parameter('langs') !== false ) && $this->getValue( 'enable-langs' ) )
{
	require_once ( PHP_FOLDER . 'langs.php' );
		
	$langz = $langs;
		
	unset( $langs );
		
	$default = $this->getValue( 'default-lang' );
		
	require ( PHP_FOLDER . 'langs-form.php' );
}
	
elseif ( ( $url->parameter('blogs') !== false ) && $this->getValue( 'enable' ) )
{
	require ( PHP_FOLDER . 'blogs-form.php' );
}
	
elseif ( ( $url->parameter('amp') !== false ) && $this->getValue( 'enable-amp' ) )
{
	require ( PHP_FOLDER . 'amp-form.php' );
}

elseif ( ( $url->parameter('antispam') !== false ) && $this->getValue( 'enableantispam' ) )
{
	require ( PHP_FOLDER . 'antispam-form.php' );
}
	
else
	require ( PHP_FOLDER . 'form.php' );