<?php defined('BLUDIT') or die('Bludit CMS.');

	$antiSpamData = $this->getValue( 'antispam-settings' );
						
	$html .= '<input type="hidden" id="jsAntiSpamForm" name="AntiSpamForm" value="true">' . PHP_EOL;

	$html .= '<h3>'.$L->get('antispam-settings').'</h3>';
	
	$html .= '<div>';
	$html .= '<label>' . $L->get('antispam-site-key') . '</label>';
	$html .= '<input id="jssiteKey" name="spam[siteKey]" type="text" value="' . ( isset( $antiSpamData['siteKey'] ) ? $antiSpamData['siteKey'] : '' ) . '" placeholder="6566UywXXXXXILZzWFoAa6uHyA0ODrvmc3hcjLs">';
	$html .= '<span class="tip">'.$L->get('site-key-tip').'</span>';
	$html .= '</div>';
	
	$html .= '<div>';
	$html .= '<label>' . $L->get('antispam-secret-key') . '</label>';
	$html .= '<input id="jssiteKey" name="spam[secretKey]" type="text" value="' . ( isset( $antiSpamData['secretKey'] ) ? $antiSpamData['secretKey'] : '' ) . '" placeholder="6566UywXXXXXILZzWFZUSDuHyA0ODrvmc3kssS">';
	$html .= '<span class="tip">'.$L->get('site-key-tip').'</span>';
	$html .= '</div>';
	
	$html .= '<div>';
    $html .= '<label>' . $L->get('enable-honeypot-mode') . '</label>';
    $html .= '<select name="spam[honeypot]">';
    $html .= '<option value="true" ' . ( ( isset( $antiSpamData['honeypot'] ) && $antiSpamData['honeypot'] === true ) ? 'selected' : '' ) . '>' . $L->get( 'Enabled' ) . '</option>';
    $html .= '<option value="false" ' . ( ( isset( $antiSpamData['honeypot'] ) && $antiSpamData['honeypot'] === false ) ? 'selected' : '' ) . '> ' . $L->get( 'Disabled' ).'</option>';
    $html .= '</select>';
	$html .= '<span class="tip">'.$L->get('honeypot-tip').'</span>';
    $html .= '</div>' . PHP_EOL;
	
	$html .= '<h5 class="mt-4 mb-2 pb-2 border-bottom">' . $L->get('users-verification-title') . '</h5>';
	$html .= '<div>';
	$html .= '<label>' . $L->get('require-verification-register') . '</label>';
	$html .= '<select name="spam[onRegister]">';
	$html .= '<option value="false" ' . ( ( isset( $antiSpamData['onRegister'] ) && $antiSpamData['onRegister'] === false ) ? 'selected' : '' ) . '> ' . $L->get( 'Disabled' ).'</option>';
    $html .= '<option value="true" ' . ( ( isset( $antiSpamData['onRegister'] ) && $antiSpamData['onRegister'] === true ) ? 'selected' : '' ) . '>' . $L->get( 'Enabled' ) . '</option>';
    $html .= '</select>';
	$html .= '<span class="tip">'.$L->get('ver-register-tip').'</span>';
	$html .= '</div>';
	
	$html .= '<div>';
	$html .= '<label>' . $L->get('require-verification-login') . '</label>';
	$html .= '<select name="spam[onLogin]">';
	$html .= '<option value="false" ' . ( ( isset( $antiSpamData['onLogin'] ) && $antiSpamData['onLogin'] === false ) ? 'selected' : '' ) . '> ' . $L->get( 'Disabled' ).'</option>';
    $html .= '<option value="true" ' . ( ( isset( $antiSpamData['onLogin'] ) && $antiSpamData['onLogin'] === true ) ? 'selected' : '' ) . '>' . $L->get( 'Enabled' ) . '</option>';
    $html .= '</select>';
	$html .= '<span class="tip">'.$L->get('ver-login-tip').'</span>';
	$html .= '</div>';