<?php defined('BLUDIT') or die('Bludit CMS.');

$html .= '<input type="hidden" id="jsTopic" name="topicPost" value="' . $topic . '">' . PHP_EOL;
$html .= '<input type="hidden" id="jsRedirect" name="DoRedirect" value="' . $this->site_url() . 'admin/content' . '">' . PHP_EOL;

$html .= '<!-- Title -->
<div id="jseditorTitle" class="form-group mb-1">
	<input id="jstitle" name="title" type="text" class="form-control form-control-lg rounded-0" value="" placeholder="Εισάγετε τίτλο">
</div>

<!-- Editor -->
<textarea id="jseditor" name="post" class="editable h-100 mb-1"></textarea>';