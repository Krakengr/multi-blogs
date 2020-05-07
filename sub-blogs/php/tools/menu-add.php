<?php defined('BLUDIT') or die('Bludit CMS.');

$html .= '<a href="' . THIS_HTML . '?menu=true"><span class="fa fa-arrow-left"></span>' . $L->get( 'menu-settings' ) . '</a>';

$html .= '<input type="hidden" id="jsRedirect" name="DoRedirect" value="' . THIS_HTML . '?menu=true">' . PHP_EOL;

$html .= '<input type="hidden" id="jsmenuAdd" name="menuAdd" value="true">' . PHP_EOL;

//Add a new blog
$html .= '<div>';
$html .= '<label>' . $L->get( 'menu-name' ) . '</label>';
$html .= '<input name="menuName" type="text" class="form-control" placeholder="' . $L->get( 'menu-name' ) . '" value="" required>';
$html .= '<span class="tip">' . $L->get( 'menu-name-info' ) . '</span>';
$html .= '</div>' . PHP_EOL;

if ( $this->getValue( 'enable-langs' ) )
{
	$langs = $this->openDB( DB_LANGS );
	
	$html .= '<div>';
	$html .= '<label>' . $L->get( 'menu-lang' ) . '</label>';
	$html .= '<select name="menuLang">';
	$html .= '<option value="everywhere"> ' . $L->get( 'menu-everywhere' ).'</option>';
	$html .= '<option value="default">' . $L->get( 'menu-default' ) . '</option>';

	if ( !empty( $langs ) )
	{
		foreach ( $langs as $key => $lang )
		{
			$html .= '<option value="' . $key . '">' . sprintf( $L->get( 'menu-on-other-lang' ), $lang['name'] ) . '</option>';
			
		}
		
	}
		
	$html .= '</select>';
	$html .= '<span class="tip">'.$L->get('menu-lang-info').'</span>';
	$html .= '</div>' . PHP_EOL;
}