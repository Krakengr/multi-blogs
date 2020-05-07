<?php defined('BLUDIT') or die('Bludit CMS.');
	
	$html .= '<h3>' . $L->get('blogs-settings') . '</h3>';
	
    if ( isset( $_GET['sa'] ) && ( $_GET['sa'] == 'new' ) )
		require( PHP_FOLDER . 'tools' . DS . 'blogs-add.php' );
	else
		require( PHP_FOLDER . 'tools' . DS . 'blogs-edit.php' );