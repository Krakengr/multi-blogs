<?php defined('BLUDIT') or die('Bludit CMS.');
	
	$auto = $this->openDB( DB_AUTO );
	
	$cats = $this->selectCategories();
	
	$html .= '<h3>' . $L->get('auto-content-settings') . '</h3>';
		
	if ( isset( $_GET['sa'] ) && ( $_GET['sa'] == 'feeds' ) )
		require( PHP_FOLDER . 'tools' . DS . 'auto-content-edit.php' );
	else
		require( PHP_FOLDER . 'tools' . DS . 'auto-content-add.php' );