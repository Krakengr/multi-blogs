<?php defined('BLUDIT') or die('Bludit CMS.');

	if ( $url->parameter('edit') !== false )
	{
		$html .= '<h3>'.$L->get('redir-seo-edit').'</h3>';
		
		$id = $url->parameter('edit');
		
		$redirs = $this->openDB( DB_REDIRS );
		
		if ( !empty( $redirs ) && isset( $redirs[$id] ) )
		{
			$html .= '<input type="hidden" id="jsredirEdit" name="redirEdit" value="true">' . PHP_EOL;
			$html .= '<input type="hidden" id="jsredirID" name="redirID" value="' . $id . '">' . PHP_EOL;
			$html .= '<input type="hidden" id="jsRedirect" name="DoRedirect" value="' . $this->site_url() . 'admin/content?type=redirs">' . PHP_EOL;
			
			$html .= '<div>';
			$html .= '<label>' . $L->get('old-url') . '</label>';
			$html .= '<input id="jsaoldurl" name="old-url" type="text" value="' . $redirs[$id]['oldUrl'] . '" placeholder="/post-title.html" required>';
			$html .= '<span class="tip">' . $L->get('old-url-tip') . '</span>';
			$html .= '</div>';
			
			$html .= '<div>';
			$html .= '<label>' . $L->get('new-url') . '</label>';
			$html .= '<input id="jsanewurl" name="new-url" type="text" value="' . $redirs[$id]['newUrl'] . '" placeholder="' . $this->site_url() . 'post-title" required>';
			$html .= '<span class="tip">' . $L->get('new-url-tip') . '</span>';
			$html .= '</div>';
		}
		
		else
		{
			$html .= '<div class="alert alert-warning" role="alert">' . $L->get( 'nothing-found' ) . '</div>';
		}
	}
	
	else
	{
		$html .= '<input type="hidden" id="jsredir" name="redirForm" value="true">' . PHP_EOL;

		$html .= '<h3>'.$L->get('redir-seo').'</h3>';
		$html .= '<div>';
		$html .= '<label>' . $L->get('old-url') . '</label>';
		$html .= '<input id="jsaoldurl" name="old-url" type="text" value="" placeholder="/post-title.html" required>';
		$html .= '<span class="tip">' . $L->get('old-url-tip') . '</span>';
		$html .= '</div>';
		
		$html .= '<div>';
		$html .= '<label>' . $L->get('new-url') . '</label>';
		$html .= '<input id="jsanewurl" name="new-url" type="text" value="" placeholder="' . $this->site_url() . 'post-title" required>';
		$html .= '<span class="tip">' . $L->get('new-url-tip') . '</span>';
		$html .= '</div>';
		
	}