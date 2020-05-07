<?php defined('BLUDIT') or die('Bludit CMS.');

$html .= '<a href="' . THIS_HTML . '?blogs=true"><span class="fa fa-arrow-left"></span>' . $L->get( 'edit-blogs' ) . '</a>';

$html .= '<input type="hidden" id="jsRedirect" name="DoRedirect" value="' . THIS_HTML . '?blogs=true">' . PHP_EOL;

$html .= '<input type="hidden" id="jsBlogAdd" name="BlogAdd" value="true">' . PHP_EOL;

//Add a new blog
$html .= '<div>';
$html .= '<label>' . $L->get( 'add-blog' ) . '</label>';
$html .= '<input name="addBlog" type="text" class="form-control" placeholder="' . $L->get( 'add-blog' ) . '" value="">';
$html .= '<span class="tip">' . $L->get( 'add-sublog-info' ) . '</span>';
$html .= '</div>' . PHP_EOL;

$html .= '<div>';
$html .= '<label>' . $L->get( 'add-blog-sef' ) . '</label>';
$html .= '<input name="addBlogSef" type="text" class="form-control" placeholder="' . $L->get( 'add-blog-sef' ) . '" value="">';
$html .= '<span class="tip">' . $L->get( 'add-sublogsef-info' ) . '</span>';
$html .= '</div>' . PHP_EOL;
//Add a blog END