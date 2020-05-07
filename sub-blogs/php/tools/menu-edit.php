<?php defined('BLUDIT') or die('Bludit CMS.');

$html .= '<a href="' . THIS_HTML . '?menu=true"><span class="fa fa-arrow-left"></span>' . $L->get( 'menu-settings' ) . '</a>';

$html .= '<input type="hidden" id="jsRedirect" name="DoRedirect" value="' . $fullURL . '">' . PHP_EOL;

$html .= '<input type="hidden" id="jsmenuEdit" name="menuEdit" value="true">' . PHP_EOL;

$html .= '<input type="hidden" id="jsmenuID" name="menuID" value="' . $id . '">' . PHP_EOL;

$html .= '<div class="alert alert-primary">' . $L->get('menu-creation-help') . '</div>';

$html .= '<div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="card-header"><h5 class="float-left">Menu</h5>
						<div class="pull-right">
            <button id="btnOut" type="button" class="btn btn-success"> <i class="glyphicon glyphicon-ok"></i> Save</button>
          </div>
                            <div class="card-body">
                            <ul id="myEditor" class="sortableLists list-group">
                            </ul>
                        </div>
                        </div>
                    </div>
                </div>
				
				<div class="card-body">
                <div class="col-md-6">
                    <div class="card border-primary mb-3">
                        <div class="card-header bg-primary text-white">Edit item</div>
                        <div class="card-body">
                           <!-- <form id="frmEdit" class="form-horizontal">-->
                                <div class="form-group">
                                    <label for="text">Text</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control item-menu" name="text" id="text" placeholder="Text">
                                        <!--<div class="input-group-append">
                                            <button type="button" id="myEditor_icon" class="btn btn-outline-secondary"></button>
                                        </div>-->
                                    </div>
                                    <input type="hidden" name="icon" class="item-menu">
                                </div>
                                <div class="form-group">
                                    <label for="href">URL</label>
                                    <input type="text" class="form-control item-menu" id="href" name="href" placeholder="URL">
                                </div>
                                <div class="form-group">
                                    <label for="target">Target</label>
                                    <select name="target" id="target" class="form-control item-menu">
                                        <option value="_self">Self</option>
                                        <option value="_blank">Blank</option>
                                        <option value="_top">Top</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="title">Tooltip</label>
                                    <input type="text" name="title" class="form-control item-menu" id="title" placeholder="Tooltip">
                                </div>
                            <!--</form>-->
                        </div>
                        <div class="card-footer">
                            <button type="button" id="btnUpdate" class="btn btn-primary" disabled><i class="fas fa-sync-alt"></i> Update</button>
                            <button type="button" id="btnAdd" class="btn btn-success"><i class="fas fa-plus"></i> Add</button>
                        </div>
                    </div>
                </div>
				
				
            </div>
			
			<div class="display:none;"><textarea type="hidden" id="out" name="hide" style="display:none;"></textarea>
                    </div>
        </div>';
        
$html .= '<script>
 jQuery(document).ready(function () {
                // menu items
                var arrayjson = ' . $menuData . ';
                // icon picker options
                var iconPickerOptions = {searchText: "Buscar...", labelHeader: "{0}/{1}"};
                // sortable list options
                var sortableListOptions = {
                    placeholderCss: {\'background-color\': "#cccccc"}
                };

                var editor = new MenuEditor(\'myEditor\', {listOptions: sortableListOptions, iconPicker: iconPickerOptions});
                editor.setForm($(\'#jsform\'));
                editor.setUpdateButton($(\'#btnUpdate\'));
                editor.setData(arrayjson);

                $("#btnUpdate").click(function(){
                    editor.update();
                });

                $(\'#btnAdd\').click(function(){
                    editor.add();
                });
				
				$(\'#btnOut\').on(\'click\', function () {
                    var str = editor.getString();
                    $("#out").text(str);
					$(\'form#jsform\').submit();
                });
                /* ====================================== */
            });
</script>';