<?php
/**
 * @author Florent DESPIERRES
 * @package portail-gcr
 * @subpackage securite
 * @version 1.0.4
 */
class MotDePassePerduView {
	public function __construct() {
	}
	public function renderHTML($msg = '') {
		$aff = '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">';
		$aff .= '<html>';
		$aff .= '<head>';
		$aff .= '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">';
		$aff .= '<META NAME="robots" CONTENT="noindex,nofollow">';
		$aff .= '<title>CISCAR</title>';
		$aff .= '<script src="include/js/jquery-1.4.2.js"></script>';
		$aff .= '<style>';
		$aff .= '* {margin:0px; padding:0px;}';
		$aff .= 'body{background:#cfcfcf;font-family:arial;}';
		$aff .= '#wrapper{margin:0px auto;width:1210px;height:100%;background:#FFFFFF url(\'include/images/kit/hp/background.jpg\') repeat-y;text-align:center;border:0px solid #000000;}';
		$aff .= '#wrapper #menu{width:1002px;height:193px;background:transparent url(\'include/images/kit/hp/filigrane.jpg\') no-repeat center top;text-align:center;margin-left:100px;padding-top:50px;border:0px solid #000000;}';
		$aff .= '#wrapper #footer{width:1000px;height:260px;background:transparent url(\'include/images/kit/hp/photos.jpg\') no-repeat center top;text-align:center;margin-left:100px;border:0px solid #000000;}';
		$aff .= '</style>';
		
		$aff .= '<!--[if IE 7]>';
		$aff .= '<style>';
		$aff .= '#wrapper #menu{margin-left:-10px;}';
		$aff .= '#wrapper #footer{margin-left:-10px;}';
		$aff .= '</style>';
		$aff .= '<![endif]-->';
		
		$aff .= '<script type="text/javascript">
		function OuvrirDoc(id, target)
		{
			document.location.href="?action=doc&id="+id;
		}
		function validateForm()
		{
			var mail = document.motdepasseperdu.mail.value;
			return(!mail==\'\');
		}
		</script>';
		$aff .= '</head>';
		$aff .= '<body>';
		$aff .= '<div id="wrapper">';
		$aff .= '<div id="header"><img src="include/images/kit/hp/logo.jpg"/></div>';
		$aff .= '<div id="menu">';
		
		$aff .= '<form action="?action=motdepasseperdu" method="POST" name="motdepasseperdu" onsubmit="return validateForm()">';
		$aff .= '<table cellspacing="5" style="margin-left:300px;text-align:right;">';
		$aff .= '<tr>';
		$aff .= '<td colspan="2" style="border-bottom:dashed 1px #000;"><h3>Mot de passe perdu ?</h3></td>';
		$aff .= '</tr>';
		if ($msg == '-1') {
			$aff .= '<tr>';
			$aff .= '<td colspan="2" style="font-size:10px;">Vos identifiants de connexion viennent de vous &ecirc;tre envoy&eacute;s par Mail<br/><a href="?action=acces">Me connecter</a></td>';
			$aff .= '</tr>';
		} else {
			$aff .= '<tr>';
			$aff .= '<td colspan="2">' . $msg . '</td>';
			$aff .= '</tr>';
			$aff .= '<tr>';
			$aff .= '<td style="color:#666666;font-weight:bold;font-size:10px;">Votre adresse Mail</td>';
			$aff .= '<td><input type="text" value="" id="mail" name="mail" size="20" style="width:300px;"/></td>';
			$aff .= '</tr>';
			$aff .= '<tr>';
			$aff .= '<td colspan="2"><input type="submit" value="Poursuivre" name="submitButton"/></td>';
			$aff .= '</tr>';
		}
		
		$aff .= '</table>';
		$aff .= '</form>';
		
		$aff .= '</div>';
		$aff .= '<div id="footer"></div>';
		$aff .= '</div>';
		$aff .= '</body>';
		$aff .= '</html>';
		return $aff;
	}
}
?>