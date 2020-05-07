<?php defined('BLUDIT') or die('Bludit CMS.');

$html .= '<input type="hidden" id="jswidgets" name="widgetsSort" value="true">' . PHP_EOL;
		
$html .= '<input type="hidden" id="jsRedirect" name="DoRedirect" value="' . $fullURL . '">' . PHP_EOL;

$html .= '<a href="' . THIS_HTML . '?menu=true&sa=add"><span class="fa fa-plus"></span>' . $L->get('menu-add') . '</a>';

if ( empty( $menu ) )
{
	$html .= '<div class="alert alert-warning">' . $L->get('no-menu') . '</div>';
}

else 
{	
	$html .= '<table class="table table-striped mt-3"><thead><tr>';
			
	$html .= '<th class="border-bottom-0" scope="col">Name</th>';
	
	if ( $this->getValue( 'enable-langs' ) )
    {
		$langs = $this->openDB( DB_LANGS );
	
		$html .= '<th class="border-bottom-0" scope="col">Language</th>';
	}
			
	$html .= '<th class="pt-3 text-center" scope="col">Actions</th>';
			
			
	$html .= '</tr></thead><tbody>';
	
	foreach ( $menu as $id => $row )
	{
	
		$html .= '<tr>';

		$html .= '<td><a href="' . THIS_HTML . '?menu=true&sa=edit&id=' . $id . '">' . $row['menuName'] . '</a></td>';
				
		if ( $this->getValue( 'enable-langs' ) )
		{
			$html .= '<td>' . ( ( !empty( $langs ) && ( ( $row['lang'] !== 'everywhere' ) && ( $row['lang'] !== 'default' ) ) ) ? $langs[$row['lang']]['name'] : ( ( $row['lang'] == 'everywhere' ) ? 'Everywhere' : 'Default' ) ) . '</td>';
		}
		
		$html .= '<td class="contentTools pt-3 text-center d-sm-table-cell"><a class="text-secondary d-none d-md-inline ml-2" href="' . THIS_HTML . '?menu=true&sa=edit&id=' . $id . '"><i class="fa fa-edit"></i>' . $L->get('edit') . '</a> <a href="' . THIS_HTML . '?menu=true&sa=delete&id=' . $id . '" onclick="return confirm(\'' . $L->get('delete-menu-warning') . '\');"><i class="fa fa-trash"></i>' . $L->get('delete') . '</a></td>';
					
		$html .= '</tr>';
		
	}
    
	$html .= '</tbody></table>';
	
}