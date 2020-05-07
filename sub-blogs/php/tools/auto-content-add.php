<?php defined('BLUDIT') or die('Bludit CMS.');

$count = count ( $auto );
	
$feedURL = $this->site_url() . 'feed-' . $this->getValue( 'feedHash' );

$html .= '<input type="hidden" id="jsautocontent" name="autoForm" value="true">' . PHP_EOL;

$html .= '<input type="hidden" id="jsRedirect" name="DoRedirect" value="' . $fullURL . '">' . PHP_EOL;
	
$editURL = '<a href="' . $this->site_url() . 'admin/configure-plugin/pluginSubBlogs?auto-content=true&amp;sa=feeds">' . $L->get( 'feed-here' ) . '</a>';
	
$html .= '<div class="alert alert-primary" role="alert">';
	
$html .= sprintf( $L->get( 'your-feed-url' ), $feedURL );
	
$html .= '</div>';
	
if ( !empty( $count ) ) 
{
	$html .= '<div class="alert alert-primary" role="alert">';
		
	$html .= sprintf( $L->get( 'your-feeds' ), $count, $editURL );
		
	$html .= '</div>';
}

$html .= '<h3>' . $L->get('global-settings') . '</h3>';

$html .= '<div class="form-group">';
$html .= '<label>' . $L->get('enable-cache') . '</label>';
$html .= '<input type="checkbox" name="enableCache" id="jsenablecache" value="true" ' . ( $this->getValue( 'enableAutoContentCache' ) ? 'checked' : '' ) . '>';
$html .= '<span class="tip">' . $L->get('enable-cache-tip') . '</span>';
$html .= '</div><br />';

$html .= '<h3>' . $L->get('auto-content-add') . '</h3>';

$html .= '<div class="form-group">';
$html .= '<label>'.$L->get('source-url').'</label>';
$html .= '<input id="jssourceurl" name="sourceURL" type="text" value="" placeholder="http://mysite.com/feed/">';

$html .= '<label>'.$L->get('source-category').'</label>';
$html .= '<select name="sourceCategory">';

foreach ( $cats['langs'] as $lang => $value )
{
	$html .= '<optgroup label="' . $lang . '">';

	foreach( $value as $s => $v )
	{
		$html .= '<optgroup label="' . $s . '">';

		foreach ( $v as $c => $t )
		{

			$html .= '<option value="' . $c . '">' . $t['name'] . '</option>';
		}

		$html .= '</optgroup>';
	}

	$html .= '</optgroup>';
}

$html .= '</select>';

$html .= '<span class="tip">' . $L->get('new-source-tip') . '</span>';
$html .= '</div>';

$html .= '<div class="form-group">';
$html .= '<label>'.$L->get('source-words').'</label>';
$html .= '<input id="jssourcewords" name="sourceWords" type="text" value="" placeholder="text1,text2,text3">';
$html .= '<span class="tip">' . $L->get('source-words-tip') . '</span>';
$html .= '</div>';

$html .= '<div class="form-group">';
$html .= '<label>' . $L->get('copy-images') . '</label>';
$html .= '<input type="checkbox" name="copyImages" id="jscopyimages" value="true">';
$html .= '<span class="tip">' . $L->get('copy-images-tip') . '</span>';
$html .= '</div>';

$html .= '<div class="form-group">';
$html .= '<label>' . $L->get('first-image-cover') . '</label>';
$html .= '<input type="checkbox" name="firstCover" id="jsfirstimagecover" value="true">';
$html .= '</div>';

$html .= '<div class="form-group">';
$html .= '<label>' . $L->get('set-source-url') . '</label>';
$html .= '<input type="checkbox" name="setsourceurl" id="jssetsourceurl" value="true">';
$html .= '</div>';

$html .= '<div class="form-group">';
$html .= '<label>' . $L->get('strip-html') . '</label>';
$html .= '<input type="checkbox" name="striphtml" id="jsstriphtml" value="true">';
$html .= '<span class="tip">' . $L->get('strip-html-tip') . '</span>';
$html .= '</div>';

$html .= '<div class="form-group">';
$html .= '<label>' . $L->get('skip-no-images') . '</label>';
$html .= '<input type="checkbox" name="skipnoimages" id="jsstriphtml" value="true">';
$html .= '<span class="tip">' . $L->get('skip-no-images-tip') . '</span>';
$html .= '</div>';

$users = $this->openDB( DB_USERS  );

$html .= '<div class="form-group">';
$html .= '<label>' . $L->get('source-user') . '</label>';
$html .= '<select name="user">';

foreach ( $users as $key => $user )
{
	$html .= '<option value="' . $key . '">' . ( !empty( $user['nickname'] ) ? $user['nickname'] : $key ) . '</option>';
}

$html .= '</select>';
$html .= '<span class="tip">' . $L->get('source-user-tip') . '</span>';
$html .= '</div>';

$html .= '<div class="form-group">';
$html .= '<label>' . $L->get('post-status') . '</label>';
$html .= '<select name="status">';

$html .= '<option value="published">' . $L->get('published') . '</option>';

$html .= '<option value="draft">' . $L->get('draft') . '</option>';

$html .= '</select>';
$html .= '<span class="tip">' . $L->get('post-status-tip') . '</span>';
$html .= '</div>';

$html .= '<div class="form-group">';
$html .= '<label>' . $L->get('enable-auto-delete') . '</label>';
$html .= '<input value="0" type="number" name="autoDelete" step="any" min="0" max="365">';
$html .= '<span class="tip">' . $L->get('enable-auto-delete-tip') . '</span>';
$html .= '</div>';

$html .= '<div class="form-group">';
$html .= '<label>' . $L->get('select-max-posts') . '</label>';
$html .= '<input value="0" type="number" name="maxPosts" step="any" min="0" max="365">';
$html .= '<span class="tip">' . $L->get('select-max-posts-tip') . '</span>';
$html .= '</div>';

$html .= '<div class="form-group">';
$html .= '<label>' . $L->get('skip-old-posts') . '</label>';
$html .= '<input value="0" type="number" name="oldPosts" step="any" min="0" max="365">';
$html .= '<span class="tip">' . $L->get('skip-old-posts-tip') . '</span>';
$html .= '</div>';