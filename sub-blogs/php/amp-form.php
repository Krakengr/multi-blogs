<?php defined('BLUDIT') or die('Bludit CMS.');
						
	$html .= '<input type="hidden" id="jsAmp" name="AmpForm" value="true">' . PHP_EOL;
	
	$amp = $this->getValue('amp-settings');

	$html .= '<h3>'.$L->get('amp-settings').'</h3>';
	$html .= '<div>';
	$html .= '<label>' . $L->get('adclient') . '</label>';
	$html .= '<input id="jsadclient" name="adclient" type="text" value="' . ( isset( $amp['adclient'] ) ? $amp['adclient'] : '' ) . '" placeholder="ca-pub-xxxxxxxxxxxxx">';
	$html .= '<span class="tip">'.$L->get('ad-tip').'</span>';
	$html .= '</div>';
	
	$html .= '<div>';
	$html .= '<label>' . $L->get('adslot') . '</label>';
	$html .= '<input id="jsadslot" name="adslot" type="text" value="' . ( isset( $amp['adslot'] ) ? $amp['adslot'] : '' ) . '" placeholder="xxxxxxxxx">';
	$html .= '<span class="tip">'.$L->get('ad-tip').'</span>';
	$html .= '</div>';
	
	$html .= '<div>';
	$html .= '<label>'.$L->get('enableautoads').'</label>';
	$html .= '<input type="checkbox" name="enableautoads" id="jsenableautoads" value="true" ' . ( ( isset( $amp['enableautoads'] ) && $amp['enableautoads'] ) ? 'checked' : '' ) . '>';
	$html .= '<span class="tip">'.$L->get('autoads-tip').'</span>';
	$html .= '</div>';
		
	$html .= '<div>';
	$html .= '<label>' . $L->get('googleanalytics') . '</label>';
	$html .= '<input id="jsgoogleanalytics" name="googleanalytics" type="text" value="' . ( isset( $amp['googleanalytics'] ) ? $amp['googleanalytics'] : '' ) . '" placeholder="UA-XXXXXX-XX">';
	$html .= '</div>';