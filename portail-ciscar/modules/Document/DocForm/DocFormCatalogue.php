<?php
class DocFormCatalogue {
	public function renderHTML() {
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
		$aff .= '<body style="font-familly:arial;">';
		$aff .= '<table id="wrapper"><tr><td>';
		$aff .= '<div id="header">';
		$aff .= '<table width="100%" cellspacing="0" cellpadding="0">';
		$aff .= '<tr>';
		$aff .= '<td width="170"><img src="include/images/kit/100592.gif"/></td>';
		$aff .= '<td>';
		$aff .= '<object align="left" width="790" height="96" id="banner.swf" valign="up" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000">';
		$aff .= '<param value="/include/images/kit/banner.swf" name="src">';
		$aff .= '<param value="high" name="quality">';
		$aff .= '<param value="mscssid=%7BFC687A65-CF7B-4457-A3B3-8A4FBE1B64A3%7D" name="FlashVars">';
		$aff .= '<embed width="790" height="96" flashvars="mscssid=%7BFC687A65-CF7B-4457-A3B3-8A4FBE1B64A3%7D" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" src="/include/images/kit/banner.swf">';
		$aff .= '</object>';
		$aff .= '</td>';
		$aff .= '</tr>';
		$aff .= '</table>';
		$aff .= '</div>';
		$aParam = new Param ();
		$aParam->search_param ( 'CISCAR_PUB_HOMEPAGE_IMAGE' );
		$aParam2 = new Param ();
		$aParam2->search_param ( 'CISCAR_PUB_HOMEPAGE_URL' );
		$aff .= '<script type="text/javascript">
			function validCatalogue()
			{
				$("#formphase1").hide();
				$("#formphase2").show();
				ok();
				var t= setTimeout("document.forms[0].submit()", 2000);
			}
			function ok()
			{
				window.open("' . ($aParam->getValue () != '' ? $aParam2->getValue () : '?') . '","CISCAR");
			}
		</script>';
		$aff .= '<div id="main-container">';
		$aff .= '<div id="formphase1">';
		$aff .= '<br/><br/>';
		$aff .= '<p align="center">Je souhaite m\'identifier pour consulter le catalogue. J\'inscris les informations ci dessous :</p>';
		$aff .= '<br/><br/>';
		$aff .= '<form method="POST" action="?action=catalogue">';
		$aff .= '<p align="center">';
		$aff .= '<table border="0" cellspacing="0" cellpadding="0">';
		$aff .= '<tr>';
		$aff .= '<td>Nom</td>';
		$aff .= '<td><input type="text" name="pNom" id="pNom" size="50"/></td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '<td>Pr&eacute;nom</td>';
		$aff .= '<td><input type="text" name="pPrenom" id="pPrenom" size="50"/></td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '<td>T&eacute;léphone</td>';
		$aff .= '<td><input type="text" name="pTelephone" id="pTelephone" size="50"/></td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '<td>Mail</td>';
		$aff .= '<td><input type="text" name="pMail" id="pMail" size="50"/></td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '<td colspan="2" align="right"><br/><input type="button" onclick="validCatalogue()" value="Valider"/> <input type="button" onclick="ok()" value="Non merci !"/></td>';
		$aff .= '</tr>';
		$aff .= '</table>';
		$aff .= '</p>';
		$aff .= '</form>';
		$aff .= '<p align="center"><a href="?">Retour au portail CISCAR</a></p>';
		$aff .= '</div>';
		$aff .= '<div id="formphase2" style="display:none;">';
		$aff .= '<br/><br/><p align="center">CISCAR vous remercie pour votre confiance. Vous allez être redirigé vers le catalogue en ligne</p>';
		$aff .= '</div>';
		$aff .= '</div>';
		
		$aff .= '</td></tr></table>';
		$aff .= '</body>';
		$aff .= '</html>';
		
		return $aff;
	}
}
?>