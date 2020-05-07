<?php defined('BLUDIT') or die('Bludit CMS.');

$html .= '<a href="' . THIS_HTML . '?widgets=true"><span class="fa fa-arrow-left"></span>' . $L->get( 'widgets-settings' ) . '</a>';

$html .= '<input type="hidden" id="jsRedirect" name="DoRedirect" value="' . THIS_HTML . '?widgets=true">' . PHP_EOL;

$html .= '<input type="hidden" id="jswidgetAdd" name="widgetAdd" value="true">' . PHP_EOL;

//Add a new blog
$html .= '<div>';
$html .= '<label>' . $L->get( 'widget-name' ) . '</label>';
$html .= '<input name="widgetName" type="text" class="form-control" placeholder="' . $L->get( 'widget-name' ) . '" value="">';
$html .= '<span class="tip">' . $L->get( 'widget-name-info' ) . '</span>';
$html .= '</div>' . PHP_EOL;

$html .= '<div>';
$html .= '<label>' . $L->get( 'widget-type' ) . '</label>';
$html .= '<select name="widgetType">';
$html .= '<option value="simple"> ' . $L->get( 'widget-simple' ).'</option>';
$html .= '<option value="html">' . $L->get( 'widget-html' ) . '</option>';
$html .= '<option value="php">' . $L->get( 'widget-php' ) . '</option>';
$html .= '<option value="premade">' . $L->get( 'widget-premade' ) . '</option>';
$html .= '</select>';
$html .= '<span class="tip">'.$L->get('widget-type-info').'</span>';
$html .= '</div>' . PHP_EOL;


$html .= '<div>';
$html .= '<label>' . $L->get( 'widget-code' ) . '</label>';
$html .= '<textarea cols="70" rows="5" name="widgetCode"></textarea>';
$html .= '<span class="tip">' . $L->get( 'widget-code-info' ) . '</span>';
$html .= '</div>' . PHP_EOL;


$html .= '<div>';
$html .= '<label>' . $L->get( 'widget-visibility' ) . '</label>';
$html .= '<div align="left">';
$html .= '<select name="widgetVisibility" disabled>';
$html .= '<option value="false">----</option>';
$html .= '<option value="show">' . $L->get( 'widget-show' ).'</option>';
$html .= '<option value="hide">' . $L->get( 'widget-hide' ) . '</option>';
$html .= '</select>';
$html .= '</div>';
$html .= '<div align="right">';
$html .= '<select name="widgetVisibilityType" disabled>';
$html .= '<option value="false">----</option>';
$html .= '<option value="page">' . $L->get( 'widget-page' ) . '</option>';
$html .= '<option value="post">' . $L->get( 'widget-post' ) . '</option>';
$html .= '<option value="category">' . $L->get( 'widget-category' ) . '</option>';
$html .= '<option value="tag">' . $L->get( 'widget-tag' ) . '</option>';
$html .= '<option value="home">' . $L->get( 'widget-home' ) . '</option>';
$html .= '<option value="archive">' . $L->get( 'widget-archive' ) . '</option>';
$html .= '</select>';
$html .= '</div>';
$html .= '<span class="tip">'.$L->get('widget-type-info').'</span>';
$html .= '</div>' . PHP_EOL;