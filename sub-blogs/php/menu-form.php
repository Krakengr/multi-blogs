<?php defined('BLUDIT') or die('Bludit CMS.');

$menu = $this->openDB( DB_MENU );

if ( $url->parameter('sa') == 'add' )
	require ( PHP_FOLDER . 'tools' . DS . 'menu-add.php' );

elseif ( $url->parameter('sa') == 'edit' )
{
	$id = $url->parameter('id');
	
	if ( !isset( $menu[$id] ) )
	{
		header( 'Location:' . THIS_HTML . '?menu=true' );
				
		exit;
	}
	
	$menuData = json_encode( $menu[$id]['menu'] );
	
	require ( PHP_FOLDER . 'tools' . DS . 'menu-edit.php' );
}
	
elseif ( $url->parameter('sa') == 'delete' )
{
	$id = $url->parameter('id');
	
	if ( isset( $menu[$id] ) )
	{
		unset( $menu[$id] );
		
		$this->addDB ( $menu, DB_MENU );
	}
	
	header( 'Location:' . THIS_HTML . '?menu=true' );
			
	exit;
}
	
else
	require ( PHP_FOLDER . 'tools' . DS . 'menu-sort.php' );