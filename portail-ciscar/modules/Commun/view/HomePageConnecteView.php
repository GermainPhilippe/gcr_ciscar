<?php
/**
 * @author Florent DESPIERRES
 * @package portail-ciscar
 * @subpackage commun
 * @version 1.0.4
 */
class HomePageConnecteView {
	public function __construct() {
	}
	public function render2HTML() {
		$aff = '<html>';
		$aff .= '<head>';
		$aff .= '<title>Ciscar : La centrale d\'achats des professionnels du secteur automobile</title>';
		$aff .= '<meta http-equiv="Content-type" content="text/html; charset=ISO-8859-1" />';
		$aff .= '<script src="include/js/jquery-1.4.2.js"></script>';
		$aff .= '<script src="include/js/Commun.js"></script>';
		$aff .= '<link rel="stylesheet" href="include/css/Commun.css"/>';
		$aff .= '<!--[if IE]>';
		$aff .= '<link rel="stylesheet" type="text/css" media="screen" href="include/css/CommunIE7.css" />';
		$aff .= '<![endif]-->';
		$aff .= '</head>';
		$aff .= '<body>';
		$aff .= '<table id="wrapper"><tr><td>';
		$aff .= '<div id="header">';
		$aff .= '<table width="100%" cellspacing="0" cellpadding="0">';
		$aff .= '<tr>';
		$aff .= '<td width="170"><img src="include/images/kit/100592.gif"/></td>';
		$aff .= '<td width="790" height="96">';
		/*
		 * $aff .= '<object align="left" width="790" height="96" id="banner.swf" valign="up" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000">';
		 * $aff .= '<param value="/include/images/kit/banner.swf" name="src">';
		 * $aff .= '<param value="high" name="quality">';
		 * $aff .= '<param value="mscssid=%7BFC687A65-CF7B-4457-A3B3-8A4FBE1B64A3%7D" name="FlashVars">';
		 * $aff .= '<embed width="790" height="96" flashvars="mscssid=%7BFC687A65-CF7B-4457-A3B3-8A4FBE1B64A3%7D" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" src="/include/images/kit/banner.swf">';
		 * $aff .= '</object>';
		 */
		$aff .= '<img src="/include/images/kit/bandeau_portail_ciscar.jpg" Border="0" USEMAP="#Map">';
		$aff .= '<MAP NAME="Map">
					<AREA SHAPE="rect" HREF="mailto://infos@ciscar.fr" COORDS="600,40,800,90">
				</MAP>';
		$aff .= '</td>';
		$aff .= '</tr>';
		$aff .= '</table>';
		$aff .= '</div>';
		
		// Menu bar
		$aff .= '<div id="menubar">';
		$aff .= '<table width="100%" height="100%" border=0 cellspacing=0>';
		$aff .= '<tr>';
		$aff .= '<td>';
		$aff .= '<ul class="menu">';
		$aff .= '<li><a href="?">Accueil</a></li>';
		$aff .= '<li><a href="?action=doc&id=6B5CCA3E8362C66AC125748A004BD6D7">Infos Pratiques</a></li>';
		$aff .= '<li><a href="?action=doc&id=07C3D40BE3DADB09C125748A0045A36F">Infos Soci&eacute;t&eacute;</a></li>';
		$aff .= '<li><a href="?action=doc&id=0732EDE3EB21A899C1257488004B4992">Contact</a></li>';
		$aff .= '</ul>';
		$aff .= '</td>';
		$aff .= '<td width="280px" valign="middle" align=right>';
		$aff .= '<form action="?action=recherche" method="POST"><input type="text" size="24" name="Recherche" id="Recherche" value="mots cl&eacute;s / r&eacute;f."> <input type="submit" value="ok"/></form>';
		$aff .= '</td>';
		$aff .= '</tr>';
		$aff .= '</table>';
		$aff .= '</div>';
		
		$aff .= '<p align="right" style="margin:5px;margin-right:150px;color:#666666;font-weight:bold;font-size:12;">Bonjour ' . stripslashes ( $_SESSION ['CISCAR'] ['USER'] ['FULLNAME'] ) . ' (<a href="?action=q">D&eacute;connexion</a>)</p>';
		
		// Banner
		if (! isset ( $_GET ['action'] )) {
			$aParam = new Param ();
			$aParam2 = new Param ();
			
			// Profile RENAULT //
			if (in_array ( 8, $_SESSION [$_SESSION ['SITE'] ['NAME']] ['USER'] ['GROUPS'] )) {
				$aParam->search_param ( $_SESSION ['SITE'] ['NAME'] . '_WCM_DEFAULT_BANNER' );
				$aParam2->search_param ( $_SESSION ['SITE'] ['NAME'] . '_WCM_DEFAULT_URL_BANNER' );
			}
			// Profile Hors Renault //
			if (in_array ( 9, $_SESSION [$_SESSION ['SITE'] ['NAME']] ['USER'] ['GROUPS'] )) {
				$aParam->search_param ( 'CISCAR_WCM_HORS_RENAULT_BANNER' );
				$aParam2->search_param ( 'CISCAR_WCM_HORS_RENAULT_URL_BANNER' );
			}
			// Profile INDRA //
			if (in_array ( 15, $_SESSION [$_SESSION ['SITE'] ['NAME']] ['USER'] ['GROUPS'] )) {
				$aParam->search_param ( 'CISCAR_WCM_INDRA_BANNER' );
				$aParam2->search_param ( 'CISCAR_WCM_INDRA_URL_BANNER' );
			}
			
			// on affiche une image ou une animation flash
			if ($aParam->getValue () != '') {
				$aff .= '<div id="banner"><table width="100%"><tr>';
				$aff .= '<td width="778px" align="center">';
				if (strpos ( $aParam->getValue (), "swf" ) === false) {
					$aff .= '<a href="' . $aParam2->getValue () . '" target="_BLANK">';
					$aff .= '<img src="' . $aParam->getValue () . '" Border="0"></a>';
				} else {
					$aff .= '<object align="left" width="760" height="100" id="banner.swf" valign="up" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000">';
					$aff .= '<param value="' . $aParam->getValue () . '" name="src">';
					$aff .= '<param value="high" name="quality">';
					$aff .= '<param value="transparent" name="wmode" >';
					$aff .= '<param value="mscssid=%7BFC687A65-CF7B-4457-A3B3-8A4FBE1B64A3%7D" name="FlashVars">';
					$aff .= '<embed width="760" height="100" wmode="transparent" flashvars="mscssid=%7BFC687A65-CF7B-4457-A3B3-8A4FBE1B64A3%7D" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" src="' . $aParam->getValue () . '">';
					$aff .= '</object>';
				}
				
				$aff .= '</td><td>';
				$aff .= '<img src="include/images/kit/en-ce-moment.jpg"/>';
				$aff .= '</td></tr></table></div>';
			}
		}
		
		// Menu
		$aff .= '<div id="main-container">';
		$aff .= '<table width="100%"><tr><td width="181" valign="top">';
		$aff .= '<div id="menu">';
		
		// Menu Profil Renault //
		if (in_array ( 8, $_SESSION [$_SESSION ['SITE'] ['NAME']] ['USER'] ['GROUPS'] )) {
			$aMenuModeRenaultView = new MenuModeRenaultView ();
			$aff .= $aMenuModeRenaultView->renderHTML ();
		}
		// Menu Profil Hors Renault //
		if (in_array ( 9, $_SESSION [$_SESSION ['SITE'] ['NAME']] ['USER'] ['GROUPS'] )) {
			$aMenuModeNonRenaultView = new MenuModeNonRenaultView ();
			$aff .= $aMenuModeNonRenaultView->render2HTML ();
		}
		// Menu Profil INDRA //
		if (in_array ( 15, $_SESSION [$_SESSION ['SITE'] ['NAME']] ['USER'] ['GROUPS'] )) {
			$aMenuModeINDRAView = new MenuModeINDRAView ();
			$aff .= $aMenuModeINDRAView->render2HTML ();
		}
		
		// PUB
		$aParam = new Param ();
		$aParam->search_param ( $_SESSION ['SITE'] ['NAME'] . '_PUB_MENU_IMAGE' );
		$aParam2 = new Param ();
		$aParam2->search_param ( $_SESSION ['SITE'] ['NAME'] . '_PUB_MENU_URL' );
		
		if ($aParam->getValue () != '') {
			$aff .= '<div id="menuPub">';
			if (strpos ( $aParam->getValue (), "swf" ) === false) {
				$aff .= '<a href="' . $aParam2->getValue () . '" target="_BLANK">';
				$aff .= '<img src="' . $aParam->getValue () . '" Border="0" width="181"></a>';
			} else {
				$aff .= '<object align="left" width="181" id="bannerPub.swf" valign="up" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000">';
				$aff .= '<param value="' . $aParam->getValue () . '" name="src">';
				$aff .= '<param value="high" name="quality">';
				$aff .= '<param value="transparent" name="wmode" >';
				$aff .= '<param value="mscssid=%7BFC687A65-CF7B-4457-A3B3-8A4FBE1B64A3%7D" name="FlashVars">';
				$aff .= '<embed width="181" wmode="transparent" flashvars="mscssid=%7BFC687A65-CF7B-4457-A3B3-8A4FBE1B64A3%7D" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" src="' . $aParam->getValue () . '">';
				$aff .= '</object>';
			}
			$aff .= '</div>';
		}
		
		$aff .= '</div>';
		$aff .= '</td><td valign="top">';
		
		// Main
		if (isset ( $_GET ['action'] )) {
			$aDocumentControler = new DocumentControler ();
			$aff .= $aDocumentControler->run ();
		} else {
			$aff .= '</td><td valign="top">';
			$aDocInfoDynALaUneList = new DocInfoDynALaUneList ();
			$aDocInfoDynALaUneList->SQL_select_all ();
			$aDocInfoDynALaUneView = new DocInfoDynALaUneView ( $aDocInfoDynALaUneList->getList () );
			$aff .= $aDocInfoDynALaUneView->renderHTML ();
			$aff .= '</td><td width="200" valign="top">';
			$aff .= '<div id="zoom" style="border-left:solid 2px #CCC;">';
			$aDocZoomList = new DocZoomList ();
			$aDocZoomList->SQL_select_all ();
			$aDocZoomListView = new DocZoomListView ( $aDocZoomList->getList () );
			$aff .= $aDocZoomListView->renderHTML ();
			$aff .= '</div>';
		}
		
		$aff .= '</td></tr></table>';
		$aff .= '</div>';
		
		// FOOTER
		// $aff .= '<div id="footer">';
		// $aff .= '<a target="_BLANK" href="?action=doc&id=5703">E-Commerce</a> | <a target="_BLANK" href="/modules/AutoLogin/?type=carterie">Carterie</a> | <a target="_BLANK" href="/modules/AutoLogin/?type=ciscom">Cis-Com</a> | <a href="?action=docStatic&id=156">Plan du site</a>';
		// $aff .= '<a href="/modules/AutoLogin/?type=ecommerce" target="_BLANK">E-Commerce</a> | <a href="http://ciscar.fr/modules/AutoLogin/?type=carterie">Carterie</a> | <a href="http://ciscar.fr/modules/AutoLogin/?type=ciscom">Cis-Com</a> | <a href="">Plan du site</a>';
		// $aff .= '</div>';
		$aff .= '</td></tr></table>';
		
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