<?php defined('BLUDIT') or die('Bludit CMS.');

$html .= '<input type="hidden" id="jswidgets" name="widgetsSort" value="true">' . PHP_EOL;
		
$html .= '<input type="hidden" id="jsRedirect" name="DoRedirect" value="' . $fullURL . '">' . PHP_EOL;

$html .= '<a href="' . THIS_HTML . '?widgets=true&sa=add"><span class="fa fa-plus"></span>' . $L->get('widgets-add') . '</a>';

$html .= '<div class="alert alert-primary">' . $L->get('widgets-sort') . '</div>';

$html .= '<input type="hidden" id="jswidgets" name="widget-list" value="">';

if ( empty( $widgets ) )
{
	$html .= '<div class="alert alert-warning">' . $L->get('no-widgets') . '</div>';
}

else 
{
	$html .= '<div class="container-fluid d-flex justify-content-center">
				<div class="list list-row card" id="sortable" data-sortable-id="0" aria-dropeffect="move">';
	$i = 0;
	
	foreach ( $widgets as $id => $widget ) 
	{
		$html .= '<div class="list-item" data-id="' . $id . '" data-item-sortable-id="' . $i . '" draggable="true" role="option" aria-grabbed="false" style="">
                            <div class="flex"> <a href="#" class="item-name text-color" data-abc="true">' . $widget['widgetName'] . '</a>
                                <div class="item-except text-muted text-sm h-1x">' . $widget['widgetCode'] . '</div>
                            </div>
							 <div class="no-wrap">
                                <div class="item-type text-muted text-sm d-none d-md-block">' . $widget['widgetType'] . (  ( $widget['widgetVisibility'] !== 'false' && $widget['widgetVisibilityType'] !== 'false' ) ? ' (' . $widget['widgetVisibility'] . ' in ' . $widget['widgetVisibilityType'] . ')' : '' ) . '</div>
                            </div>
                            <div>
                                <div class="item-action dropdown"> <a href="#" data-toggle="dropdown" class="text-muted" data-abc="true"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical">
                                            <circle cx="12" cy="12" r="1"></circle>
                                            <circle cx="12" cy="5" r="1"></circle>
                                            <circle cx="12" cy="19" r="1"></circle>
                                        </svg> </a>
                                    <div class="dropdown-menu dropdown-menu-right bg-black" role="menu"> <a class="dropdown-item edit" data-abc="true" href="' . THIS_HTML . '?widgets=true&sa=edit&id=' . $id . '">' . $L->get('edit') . '</a>
                                        <div class="dropdown-divider"></div> <a class="dropdown-item trash" data-abc="true" href="' . THIS_HTML . '?widgets=true&sa=delete&id=' . $id . '" onclick="return confirm(\'' . $L->get('delete-widget-warning') . '\');">' . $L->get('delete-widget') . '</a>
                                    </div>
                                </div>
                            </div>
                        </div>';
		$i++;
	}
    
	$html .= '</div></div>';
}
?>