<?php defined('BLUDIT') or die('Bludit CMS.');

global $categories;

$categoriesDB = $categories->db;

$html .= '<input type="hidden" id="jsautocontentedit" name="autoEditForm" value="true">' . PHP_EOL;

$html .= '<input type="hidden" id="jsRedirect" name="DoRedirect" value="' . $fullURL . '">' . PHP_EOL;

$html .= '<div class="alert alert-primary" role="alert">' . $L->get( 'edit-settings-tip' ) . '</div>';

$html .= '<button type="button" class="btn btn-light"><a href="' . THIS_HTML . '?auto-content=true">' . $L->get( 'back' ) . '</a></button>';
	
$html .= '<table class="table mt-3"><thead><tr><th class="border-0" scope="col">URL</th><th class="border-0" scope="col">' . $L->get('category') . '</th><th class="border-0 text-center d-sm-table-cell" scope="col">' . $L->get('disable-feed') . '</th><th class="border-0 text-center d-sm-table-cell" scope="col">' . $L->get('delete-feed') . '</th><th class="border-0 text-center d-sm-table-cell" scope="col">' . $L->get('settings') . '</th></tr></thead>';

$html .= '<tbody>';

if ( !empty( $auto ) ) 
{
	foreach ( $auto as $key => $row ) 
	{
		$html .= '<tr><td class="pt-3">' . $row['source'] . '</td>';
		
		$searchLang = $this->searchCategory ( $row['category'], true, false );
			
		$searchBlog = $this->searchCategory ( $row['category'], false, true );
		
		$url = $this->site_url() . ( !empty( $searchLang ) ? $searchLang['lang'] . '/' : '' ) . ( !empty( $searchBlog ) ? $searchBlog['blog'] . '/' : '' ) . 'category/' . $row['category'];
		
		$html .= '<td class="pt-3"><a target="_blank" href="' . $url . '">' . $categoriesDB[$row['category']]['name'] . '</a></td>';
		
		$html .= '<td class="pt-3 text-center"><input type="checkbox" name="feeds[' . $key . '][disabled]" id="jsdisabled" value="true" ' . ( $row['disabled'] ? 'checked' : '' ) . '></td>';
		
		$html .= '<td class="pt-3 text-center"><input type="checkbox" name="feeds[' . $key . '][deleteFeed]" id="jsdeletefeed" value="true" onclick="if (this.checked) return confirm(\'' . $L->get('delete-confirm') . '\');"></td>';
		
		//$html .= '<td class="pt-3"><a target="_blank" href="' . $url . '">' . $categoriesDB[$row['category']]['name'] . '</a></td>';
		/*
		$html .= '<td class="pt-1"><select name="sourceCategory">';

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

		$html .= '</select></td>';*/
		
		$html .= '<td class="contentTools pt-3 text-center d-sm-table-cell"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Modal-' . $key . '">' . $L->get('open-settings') . '</button></td></tr>';

		$html .= '<!-- Modal -->
		<div class="modal fade bd-example-modal-lg" id="Modal-' . $key . '" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">' . $L->get('settings') . '</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			  <div class="modal-body">';
			  
			  
				$html .= '<div class="form-group">
					<label class="col-form-label">'.$L->get('source-url').'</label>
					<input id="jssourceurl" name="feeds[' . $key . '][sourceURL]" type="text" value="' . $row['source'] . '" placeholder="http://mysite.com/feed/" required>
				</div>';
				
				$html .= '<div class="form-group">
				<label class="col-form-label">'.$L->get('source-category').'</label>
				<select name="feeds[' . $key . '][sourceCategory]">';

				foreach ( $cats['langs'] as $lang => $value )
				{
					$html .= '<optgroup label="' . $lang . '">';

					foreach( $value as $s => $v )
					{
						$html .= '<optgroup label="' . $s . '">';

						foreach ( $v as $c => $t )
						{

							$html .= '<option value="' . $c . '" ' . (  ( $c == $row['category'] ) ? 'selected' : '' ) . '>' . $t['name'] . '</option>';
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
			$html .= '<input id="jssourcewords" name="feeds[' . $key . '][sourceWords]" type="text" value="' . $row['sourceWords'] . '" placeholder="text1,text2,text3">';
			$html .= '<span class="tip">' . $L->get('source-words-tip') . '</span>';
			$html .= '</div>';
			
			$html .= '<div class="form-group">';
			$html .= '<label class="col-form-label">' . $L->get('copy-images') . '</label>';
			$html .= '<input type="checkbox" name="feeds[' . $key . '][copyImages]" id="jscopyimages" value="true" ' . ( $row['copyImages'] ? 'checked' : '' ) . '>';
			$html .= '<span class="tip">' . $L->get('copy-images-tip') . '</span>';
			$html .= '</div>';

			$html .= '<div class="form-group">';
			$html .= '<label class="col-form-label">' . $L->get('first-image-cover') . '</label>';
			$html .= '<input type="checkbox" name="feeds[' . $key . '][firstCover]" id="jsfirstimagecover" value="true" ' . ( $row['firstCover'] ? 'checked' : '' ) . '>';
			$html .= '</div>';

			$html .= '<div class="form-group">';
			$html .= '<label class="col-form-label">' . $L->get('set-source-url') . '</label>';
			$html .= '<input type="checkbox" name="feeds[' . $key . '][setsourceurl]" id="jssetsourceurl" value="true" ' . ( $row['setsourceurl'] ? 'checked' : '' ) . '>';
			$html .= '</div>';

			$html .= '<div class="form-group">';
			$html .= '<label class="col-form-label">' . $L->get('strip-html') . '</label>';
			$html .= '<input type="checkbox" name="feeds[' . $key . '][striphtml]" id="jsstriphtml" value="true" ' . ( $row['striphtml'] ? 'checked' : '' ) . '>';
			$html .= '<span class="tip">' . $L->get('strip-html-tip') . '</span>';
			$html .= '</div>';

			$html .= '<div class="form-group">';
			$html .= '<label class="col-form-label">' . $L->get('skip-no-images') . '</label>';
			$html .= '<input type="checkbox" name="feeds[' . $key . '][skipnoimages]" id="jsstriphtml" value="true" ' . ( $row['skipnoimages'] ? 'checked' : '' ) . '>';
			$html .= '<span class="tip">' . $L->get('skip-no-images-tip') . '</span>';
			$html .= '</div>';

			$users = $this->openDB( DB_USERS  );

			$html .= '<div class="form-group">';
			$html .= '<label class="col-form-label">' . $L->get('source-user') . '</label>';
			$html .= '<select name="feeds[' . $key . '][user]">';

			foreach ( $users as $userKey => $user )
			{
				$html .= '<option value="' . $userKey . '" ' . ( ( $userKey == $row['user'] ) ? 'selected' : '' ) . '>' . ( !empty( $user['nickname'] ) ? $user['nickname'] : $userKey ) . '</option>';
			}

			$html .= '</select>';
			$html .= '<span class="tip">' . $L->get('source-user-tip') . '</span>';
			$html .= '</div>';

			$html .= '<div class="form-group">';
			$html .= '<label class="col-form-label">' . $L->get('post-status') . '</label>';
			$html .= '<select name="feeds[' . $key . '][status]">';

			$html .= '<option value="published" ' . ( ( $row['status'] == 'published' ) ? 'selected' : '' ) . '>' . $L->get('published') . '</option>';

			$html .= '<option value="draft" ' . ( ( $row['status'] == 'draft' ) ? 'selected' : '' ) . '>' . $L->get('draft') . '</option>';

			$html .= '</select>';
			$html .= '<span class="tip">' . $L->get('post-status-tip') . '</span>';
			$html .= '</div>';

			$html .= '<div class="form-group">';
			$html .= '<label class="col-form-label">' . $L->get('enable-auto-delete') . '</label>';
			$html .= '<input value="' . $row['autoDelete'] . '" type="number" name="feeds[' . $key . '][autoDelete]" step="any" min="0" max="365">';
			$html .= '<span class="tip">' . $L->get('enable-auto-delete-tip') . '</span>';
			$html .= '</div>';

			$html .= '<div class="form-group">';
			$html .= '<label class="col-form-label">' . $L->get('select-max-posts') . '</label>';
			$html .= '<input value="' . $row['maxPosts'] . '" type="number" name="feeds[' . $key . '][maxPosts]" step="any" min="0" max="365">';
			$html .= '<span class="tip">' . $L->get('select-max-posts-tip') . '</span>';
			$html .= '</div>';

			$html .= '<div class="form-group">';
			$html .= '<label class="col-form-label">' . $L->get('skip-old-posts') . '</label>';
			$html .= '<input value="' . $row['oldPosts'] . '" type="number" name="feeds[' . $key . '][oldPosts]" step="any" min="0" max="365">';
			$html .= '<span class="tip">' . $L->get('skip-old-posts-tip') . '</span>';
			$html .= '</div>';
			
			$html .= '</div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
			</div>
		  </div>
		</div>';
	}
	
}

$html .= '</tbody></table>';

$html .= '<script>$("#jsddeletefeed").change(function(event){
        if (this.checked){
            alert("You have selected to show your checkout history.");
        } else {
            alert("You have selected to turn off checkout history.");
        }
    });</script>';