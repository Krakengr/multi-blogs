<?php defined('BLUDIT') or die('Bludit CMS.');

$id = $url->parameter('id');
	
if ( !isset( $widgets[$id] ) )
{
	header( 'Location:' . THIS_HTML . '?widgets=true' );
			
	exit;
}

$widget = $widgets[$id];
	
$html .= '<a href="' . THIS_HTML . '?widgets=true"><span class="fa fa-arrow-left"></span>' . $L->get( 'widgets-settings' ) . '</a>';

$html .= '<input type="hidden" id="jsRedirect" name="DoRedirect" value="' . THIS_HTML . '?widgets=true&sa=edit&id=' . $id . '">' . PHP_EOL;

$html .= '<input type="hidden" id="jswidgetAdd" name="widgetAdd" value="true">' . PHP_EOL;

$html .= '<input type="hidden" id="jswidgetKey" name="widgetKey" value="' . $id . '">' . PHP_EOL;

//Add a new blog
$html .= '<div>';
$html .= '<label>' . $L->get( 'widget-name' ) . '</label>';
$html .= '<input name="widgetName" type="text" class="form-control" placeholder="' . $L->get( 'widget-name' ) . '" value="' . $widget['widgetName'] . '">';
$html .= '<span class="tip">' . $L->get( 'widget-name-info' ) . '</span>';
$html .= '</div>' . PHP_EOL;

$html .= '<div>';
$html .= '<label>' . $L->get( 'widget-type' ) . '</label>';
$html .= '<select name="widgetType">';
$html .= '<option value="simple" ' . ( ( $widget['widgetType'] === 'simple' ) ? 'selected' : '' ) . '>' . $L->get( 'widget-simple' ).'</option>';
$html .= '<option value="html" ' . ( ( $widget['widgetType'] === 'html' ) ? 'selected' : '' ) . '>' . $L->get( 'widget-html' ) . '</option>';
$html .= '<option value="php" ' . ( ( $widget['widgetType'] === 'php' ) ? 'selected' : '' ) . '>' . $L->get( 'widget-php' ) . '</option>';
$html .= '<option value="premade" ' . ( ( $widget['widgetType'] === 'premade' ) ? 'selected' : '' ) . '>' . $L->get( 'widget-premade' ) . '</option>';
$html .= '</select>';
$html .= '<span class="tip">'.$L->get('widget-type-info').'</span>';
$html .= '</div>' . PHP_EOL;

$pre = ( ( ( $widget['widgetPre'] === 'latestPosts' ) || ( $widget['widgetPre'] === 'latestTopics' ) || ( $widget['widgetPre'] === 'latestReplies' ) || ( $widget['widgetPre'] === 'latestProducts' ) || ( $widget['widgetPre'] === 'latestPriceDrops' )  ) ? true : false );

if ( $widget['widgetType'] === 'premade' ) 
{
	$html .= '<div>';
	$html .= '<label>' . $L->get( 'widgets-premade' ) . '</label>';
	$html .= '<select name="widgetPre">';
	$html .= '<option value="false">---</option>';
	$html .= '<option value="latestPosts" ' . ( ( $widget['widgetPre'] === 'latestPosts' ) ? 'selected' : '' ) . '>' . $L->get( 'widget-latest' ) . ( $widget['widgetPreNum'] ? ' (' . $widget['widgetPreNum'] . ')' : '' ) . '</option>';
	
	if ( $this->getValue( 'enable-forum' ) !== 'disable' )
	{
		$html .= '<option value="latestTopics" ' . ( ( $widget['widgetPre'] === 'latestTopics' ) ? 'selected' : '' ) . '>' . $L->get( 'widget-latest-topics' ) . ( $widget['widgetPreNum'] ? ' (' . $widget['widgetPreNum'] . ')' : '' ) . '</option>';
		
		$html .= '<option value="latestReplies" ' . ( ( $widget['widgetPre'] === 'latestReplies' ) ? 'selected' : '' ) . '>' . $L->get( 'widget-latest-replies' ) . ( $widget['widgetPreNum'] ? ' (' . $widget['widgetPreNum'] . ')' : '' ) . '</option>';
		
	}
	
	if ( $this->getValue( 'enable-shop' ) !== 'disable' )
	{
		$html .= '<option value="latestProducts" ' . ( ( $widget['widgetPre'] === 'latestProducts' ) ? 'selected' : '' ) . '>' . $L->get( 'widget-latest-products' ) . ( $widget['widgetPreNum'] ? ' (' . $widget['widgetPreNum'] . ')' : '' ) . '</option>';
		
		$html .= '<option value="latestPriceDrops" ' . ( ( $widget['widgetPre'] === 'latestPriceDrops' ) ? 'selected' : '' ) . '>' . $L->get( 'widget-latest-price-drops' ) . ( $widget['widgetPreNum'] ? ' (' . $widget['widgetPreNum'] . ')' : '' ) . '</option>';
		
	}
	
	if ( $this->getValue( 'enable-langs' ) )
	{
		$html .= '<option value="langSelector" ' . ( ( $widget['widgetPre'] === 'langSelector' ) ? 'selected' : '' ) . '>' . $L->get( 'widget-lang-selector' ) . '</option>';
		
		$html .= '<option value="aboutSite" ' . ( ( $widget['widgetPre'] === 'aboutSite' ) ? 'selected' : '' ) . '>' . $L->get( 'widget-about-site' ) . '</option>';
		
	}
	
	if ( $this->getValue( 'allow-users' ) )
		$html .= '<option value="userCP" ' . ( ( $widget['widgetPre'] === 'userCP' ) ? 'selected' : '' ) . '>' . $L->get( 'widget-user-cp' ) . '</option>';
	
	$html .= '<option value="categoriesList" ' . ( ( $widget['widgetPre'] === 'categoriesList' ) ? 'selected' : '' ) . '>' . $L->get( 'widget-categories' ) . '</option>';
	$html .= '<option value="tagsList" ' . ( ( $widget['widgetPre'] === 'tagsList' ) ? 'selected' : '' ) . ' disabled>' . $L->get( 'widget-tags' ) . '</option>';
	$html .= '</select>';
	$html .= '<span class="tip">'.$L->get('widget-premade-info').'</span>';
	$html .= '</div>' . PHP_EOL;
	
	if ( $pre )
	{
		$html .= '<div>';
		$html .= '<label>' . $L->get( 'widget-posts-num' ) . '</label>';
		$html .= '<input value="' . $widget['widgetPreNum'] . '" type="number" name="widgetPreNum" step="any" min="1" max="10">';
		$html .= '</div>' . PHP_EOL;
	}
	
	if ( ( $widget['widgetPre'] === 'categoriesList' ) || ( $widget['widgetPre'] === 'tagsList' ) )
	{
		$html .= '<div>';
		$html .= '<label>' . $L->get( 'widget-drop-down' ) . '</label>';
		$html .= '<input type="checkbox" name="dropDown" value="true" ' . ( $widget['widgetDropDown'] ? 'checked' : '' ) . '>';
		$html .= '</div>' . PHP_EOL;
		
		$html .= '<div>';
		$html .= '<label>' . $L->get( 'widget-show-num' ) . '</label>';
		$html .= '<input type="checkbox" name="showPostNum" value="true" ' . ( $widget['widgetShowNum'] ? 'checked' : '' ) . '>';
		$html .= '</div>' . PHP_EOL;
	}
}

else
{
	$html .= '<div>';
	$html .= '<label>' . $L->get( 'widget-code' ) . '</label>';
	$html .= '<textarea cols="70" rows="5" name="widgetCode">' . $widget['widgetCode'] . '</textarea>';
	$html .= '<span class="tip">' . $L->get( 'widget-code-info' ) . '</span>';
	$html .= '</div>' . PHP_EOL;
}

$html .= '<div>';
$html .= '<label>' . $L->get( 'widget-visibility' ) . '</label>';
$html .= '<div align="left">';
$html .= '<select name="widgetVisibility" disabled>';
$html .= '<option value="false">----</option>';
$html .= '<option value="show" ' . ( ( $widget['widgetVisibility'] === 'show' ) ? 'selected' : '' ) . '>' . $L->get( 'widget-show' ).'</option>';
$html .= '<option value="hide" ' . ( ( $widget['widgetVisibility'] === 'hide' ) ? 'selected' : '' ) . '>' . $L->get( 'widget-hide' ) . '</option>';
$html .= '</select>';
$html .= '</div>';
$html .= '<div align="right">';
$html .= '<select name="widgetVisibilityType" disabled>';
$html .= '<option value="false">----</option>';
$html .= '<option value="page" ' . ( ( $widget['widgetVisibilityType'] === 'page' ) ? 'selected' : '' ) . '>' . $L->get( 'widget-page' ) . '</option>';
$html .= '<option value="post" ' . ( ( $widget['widgetVisibilityType'] === 'post' ) ? 'selected' : '' ) . '>' . $L->get( 'widget-post' ) . '</option>';
$html .= '<option value="category" ' . ( ( $widget['widgetVisibilityType'] === 'category' ) ? 'selected' : '' ) . '>' . $L->get( 'widget-category' ) . '</option>';
$html .= '<option value="tag" ' . ( ( $widget['widgetVisibilityType'] === 'tag' ) ? 'selected' : '' ) . ' >' . $L->get( 'widget-tag' ) . '</option>';
$html .= '<option value="home" ' . ( ( $widget['widgetVisibilityType'] === 'home' ) ? 'selected' : '' ) . '>' . $L->get( 'widget-home' ) . '</option>';
$html .= '<option value="archive" ' . ( ( $widget['widgetVisibilityType'] === 'archive' ) ? 'selected' : '' ) . '>' . $L->get( 'widget-archive' ) . '</option>';
$html .= '</select>';
$html .= '</div>';
$html .= '<span class="tip">'.$L->get('widget-visibility-info').'</span>';
$html .= '</div>' . PHP_EOL;