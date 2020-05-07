<?php defined('BLUDIT') or die('Bludit CMS.');

$widgets = $this->openDB( DB_WIDGETS );

if ( $url->parameter('sa') == 'add' )
	require ( PHP_FOLDER . 'tools' . DS . 'widget-add.php' );

elseif ( $url->parameter('sa') == 'edit' )
	require ( PHP_FOLDER . 'tools' . DS . 'widget-edit.php' );

elseif ( $url->parameter('sa') == 'delete' )
{
	$id = $url->parameter('id');
	
	if ( isset( $widgets[$id] ) )
	{
		unset( $widgets[$id] );
		
		$this->addDB ( $widgets, DB_WIDGETS );
	}
	
	header( 'Location:' . THIS_HTML . '?widgets=true' );
			
	exit;
}

else
	require ( PHP_FOLDER . 'tools' . DS . 'widget-sort.php' );