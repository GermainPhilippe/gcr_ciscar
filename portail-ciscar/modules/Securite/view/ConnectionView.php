<?php
/**
 * @author Florent DESPIERRES
 * @package portail-ciscar
 * @subpackage securite
 * @version 1.0.4
 */
class ConnectionView {
	public function __construct() {
	}
	public function renderHTML($msg) {
		header ("content-type: text/html; charset=ISO-8859-1");
		$aff = '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">';
		$aff .= '<html>';
		$aff .= '<head>';
		$aff .= '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">';
		$aff .= '<title>Ciscar : La centrale d\'achats des professionnels du secteur automobile</title>';
		$aff .= '<script src="include/js/jquery-1.4.2.js"></script>';
		$aff .= '<style>';
		$aff .= '* {margin:0px; padding:0px;}';
		$aff .= 'body{background:#cfcfcf; font-family:arial;}';
		$aff .= '#wrapper{margin:0px auto;width:1210px;height:100%;background:#FFFFFF url(\'include/images/kit/hp/background.jpg\') repeat-y;text-align:center;border:0px solid #000000;}';
		$aff .= '#wrapper #menu{width:1002px;height:213px;background:transparent url(\'include/images/kit/hp/filigrane.jpg\') no-repeat center top;text-align:center;margin-left:100px;padding-top:30px;border:0px solid #000000;}';
		$aff .= '#wrapper #footer{width:1000px;height:260px;background:transparent url(\'include/images/kit/hp/photos2.jpg\') no-repeat center top;text-align:center;margin-left:100px;border:0px solid #000000;}';
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
		</script>';
		$aff .= '</head>';
		$aff .= '<body onload="$(\'#username\').focus();">';
		$aff .= '<div id="wrapper">';
		$aff .= '<div id="header"><img src="include/images/kit/hp/logo.jpg"/></div>';
		$aff .= '<div id="menu">';
		
		$aff .= '<form method="POST" name="FormConnection">';
		$aff .= '<span id="formErr">' . $msg . '</span>';
		$aff .= '<table cellspacing="10" style="margin-left:300px;margin-top:30px;text-align:right;">';
		$aff .= '<tr>';
		$aff .= '<td style="color:#666666;font-weight:bold;font-size:10px;">Nom d\'utilisateur</td>';
		$aff .= '<td><input type="text" value="" id="username" name="username" size="20" style="width:150px;"/></td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '<td style="color:#666666;font-weight:bold;font-size:10px;">Mot de passe</td>';
		$aff .= '<td><input type="password" value="" id="password" name="password" size="20" style="width:150px;"/></td>';
		$aff .= '</tr>';
		
		$aff .= '<tr>';
		$aff .= '<td><input type="checkbox" value="1" name="loginAuto"' . (isset ( $_COOKIE ['LoginAuto'] ) ? ' CHECKED' : '') . '></td>';
		$aff .= '<td style="color:#666666;font-weight:bold;font-size:10px;text-align:left;">Me reconnaître lors de ma prochaine visite</td>';
		$aff .= '</tr>';
		
		$aff .= '<tr>';
		$aff .= '<td colspan="2" valign="middle">';
		$aff .= '<input type="submit" style="display:none;" name="submitButton" />';
		$aff .= '<input type="image"  src="include/images/kit/bt_connexion.gif" onclick="document.forms[0].submit()" />';
		// $aff .= '<a style="cursor:pointer;" onclick="document.FormConnection.submit()"><img src="include/images/kit/bt_connexion.gif" border="0" /></a><br/><br/>';
		$aff .= '<p style="font-size:10px;">Vous avez perdu vos identifiants ? <a href="?action=motdepasseperdu" style="font-size:10px;">Cliquez ici</a></p>';
		$aff .= '<p style="font-size:10px;">Vous n\'avez pas d\'identifiants ? <a href="?action=premierevisite" style="font-size:10px;">Demandez les !</a></p>';
		$aff .= '<p style="font-size:10px;color:black;">Visitez notre site Ecommerce en mode visiteur. <a href="http://ciscar.channel-portal.com/" target="_BLANK">Cliquez ici</a></p>';
		// $aff .= '<p style="font-size:10px;">Rendez vous sur notre site <a href="http://ciscar.channel-portal.com/index.asp?mscssid=%7B586849EC-86D2-40EB-9BD9-4DFAFD3DAB5A%7D&flLargeAccountPage=1" style="font-size:10px;" target="_BLANK">E-commerce en mode d&eacute;connect&eacute;</a></p>';
		
		$aff .= '</td>';
		// $aff .= '<td colspan="2" valign="middle"><input type="submit" name="submitButton" /><a style="cursor:pointer;" onclick="document.forms[0].submit()"><img src="include/images/kit/bt_connexion.gif" border="0" /></a><br/><br/><p style="font-size:10px;">Vous avez perdu vos identifiants ? <a href="?action=motdepasseperdu" style="font-size:12px;">cliquez ici</a></p></td>';
		$aff .= '</tr>';
		$aff .= '</table>';
		
		$aff .= '<p style="font-size:10px;"><font style="color:black;">Si vous n\'avez pas de code</font>, <font style="color:blue;font-weight:bold;"><a style="text-decoration:none;" href="http://www.ciscar.fr/?action=premierevisite">une inscription en ligne est nécessaire pour consulter nos sites et passer des commandes. Cliquez ici !</a></p>';
		
		$aff .= '</form>';
		
		$aff .= '</div>';
		$aff .= '<div id="footer"></div>';
		$aff .= '</div>';
		
		// GOOGLE ANALYTICS
		$aff .= '<script type="text/javascript">
		
		var _gaq = _gaq || [];
		_gaq.push([\'_setAccount\', \'UA-27893097-2\']);
		_gaq.push([\'_trackPageview\']);
		
		(function() {
		var ga = document.createElement(\'script\'); ga.type = \'text/javascript\'; ga.async = true;
		ga.src = (\'https:\' == document.location.protocol ? \'https://ssl\' : \'http://www\') + \'.google-analytics.com/ga.js\';
		var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(ga, s);
		})();
		
		</script>';
		$aff .= '</body>';
		$aff .= '</html>';
		return $aff;
	}
}
?>