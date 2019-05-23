<?php
session_start ();

$BaseURL = '../../';
include ('../../include/mvc_inc.php');

if (isset ( $_GET ['type'] )) {
	include ('../../../config/configuration.php');
	include ('../../include/DbConnexion.php');
	
	$aParam = new Param ();
	
	switch ($_GET ['type']) {
		case 'ciscom' :
			$ParamName = 'CIS-COM';
			break;
		case 'carterie' :
			$ParamName = 'CARTERIE';
			break;
		default :
			$ParamName = 'E-COMMERCE';
			break;
	}
	
	// Recherche des droits de l'individu
	if (! verifDroit ()) {
		$aParam->search_param ( $_SESSION ['SITE'] ['NAME'] . '_' . $ParamName . '_MESSAGE_ERREUR_LOGIN' );
		renderHTML ( stripslashes ( $aParam->getValue () ) );
	} else {
		// Recherche des Concessions
		$sql = "SELECT e.EtablissementID, e.RaisonSociale, e.LoginSage, i.Login, i.LoginSage, e.Ville";
		$sql .= " FROM annuaire_role r, annuaire_individu i, annuaire_etablissement e";
		$sql .= " WHERE r.IndividuID=i.IndividuID AND r.EtablissementID=e.EtablissementID AND e.NumRRF!='' AND e.LoginSage!='' AND e.EnSommeil='0' AND i.IndividuID='%s'";
		
		if (isset ( $_POST ['EtablissementID'] )) {
			$sql .= " AND r.EtablissementID='%s'";
			$sql .= " ORDER BY e.RaisonSociale, e.Ville";
			
			$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'] , $_SESSION [$_SESSION ['SITE'] ['NAME']] ['USER'] ['ID'] ), mysqli_real_escape_string ($_SESSION['LINK'] , $_POST ['EtablissementID'] ) );
		} else {
			$sql .= " ORDER BY e.RaisonSociale, e.Ville";
			$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'] , $_SESSION [$_SESSION ['SITE'] ['NAME']] ['USER'] ['ID'] ) );
		}
		$result = mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
		
		if (mysqli_num_rows ( $result ) > 0) {
			// Concession multiple
			// if (mysqli_num_rows ( $result ) > 1 && $ParamName == 'E-COMMERCE') {
			if (mysqli_num_rows ( $result ) == 0 && $ParamName == 'E-COMMERCE') {
				$aParam->search_param ( $_SESSION ['SITE'] ['NAME'] . '_' . $ParamName . '_PAGE_CONNEXION' );
				$aff = stripslashes ( $aParam->getValue () ) . '<br><br/>';
				
				$aff .= '<form method="POST" action="?type=' . $_GET ['type'] . '">';
				$aff .= '<p align="center"><select name="EtablissementID" onselect="this.submit()">';
				while ( $line = mysqli_fetch_array ( $result ) ) {
					$aff .= '<option value="' . $line [0] . '">' . $line [1] . ' - ' . $line [5] . '</option>';
				}
				$aff .= '</select>&nbsp;&nbsp;&nbsp;<input type="submit" value="ok"/></p></form>';
				renderHTML ( $aff );
			} else {
				// Concession unique
				$aParam->search_param ( $_SESSION ['SITE'] ['NAME'] . '_' . $ParamName . '_CLEF_AUTOLOGIN' );
				$line = mysqli_fetch_array ( $result );
				// Traitement
				$clefAutologin = $aParam->getValue ();
				$loginType = '2';
				$action = 'autoLogin';
				$loginGCR = $line [3];
				$stamp = date ( 'Y-m-d H:i:s' ); // yyyy-mm-dd hh:mm:ss GMT
				$stampWEB = date ( 'Y-m-d%20H:i:s' );
				switch ($_GET ['type']) {
					case 'ciscom' :
						switch ($_SESSION ['SITE'] ['NAME']) {
							/*
							 * case 'CISCAR':
							 * $loginCode = $line[4];
							 * $URL = 'http://www.cis-com.eu/MailingGcr/logMd5.aspx';
							 * $signature = MD5($loginode.$stamp.$loginGCR.$clefAutologin);
							 * $params = '?action='.$action;
							 * $params .= '&loginCode='.$loginCode;
							 * $params .= '&stamp='.$stampWEB;
							 * $params .= '&loginGCR='.$loginGCR;
							 * $params .= '&signature='.$signature;
							 * break;
							 */
							case 'ACNF' :
								$loginCode = $line [4];
								$URL = 'http://www.cis-com.eu/Nissan/logMd5.aspx';
								$signature = MD5 ( $loginCode . $stamp . $loginGCR . $clefAutologin );
								$params = '?action=' . $action;
								$params .= '&loginCode=' . $loginCode;
								$params .= '&stamp=' . $stampWEB;
								$params .= '&loginNissan=' . $loginGCR;
								$params .= '&signature=' . $signature;
								break;
							case 'CISCAR' :
							case 'GCR' :
								$loginCode = $line [4];
								$URL = 'http://www.cis-com.eu/MailingGcr/logMd5.aspx';
								$signature = MD5 ( $loginCode . $stamp . $loginGCR . $clefAutologin );
								$params = '?action=' . $action;
								$params .= '&loginCode=' . $loginCode;
								$params .= '&stamp=' . $stampWEB;
								$params .= '&loginGCR=' . $loginGCR;
								$params .= '&signature=' . $signature;
								break;
						}
						break;
					case 'carterie' :
						
						switch ($_SESSION ['SITE'] ['NAME']) {
							case 'CISCAR' :
								$loginCode = $line [4];
								$signature = MD5 ( $loginCode . $stamp . $loginGCR . $clefAutologin );
								$URL = 'http://pro.feuilleafeuille.org/CISCAR/Login.aspx';
								//$URL = 'maintenance.html';
								$params = '?action=' . $action;
								$params .= '&loginCode=' . $loginCode;
								$params .= '&stamp=' . $stampWEB;
								$params .= '&loginGCR=' . $loginGCR;
								$params .= '&signature=' . $signature;
								break;
							case 'ACNF' :
								$loginCode = $line [4];
								$signature = MD5 ( $loginCode . $stamp . $loginGCR . $clefAutologin );
								$URL = 'http://pro.feuilleafeuille.org/ciscar/Login.aspx';
								// $URL = 'maintenance.html';
								$params = '?action=' . $action;
								$params .= '&loginCode=' . $loginCode;
								$params .= '&stamp=' . $stampWEB;
								$params .= '&loginGCR=' . $loginGCR;
								$params .= '&signature=' . $signature;
								break;
							case 'GCR' :
								$loginCode = $line [4];
								$signature = MD5 ( $loginCode . $stamp . $loginGCR . $clefAutologin );
								$URL = 'http://pro.feuilleafeuille.org/CISCAR/Login.aspx';
								// $URL = 'maintenance.html';
								$params = '?action=' . $action;
								$params .= '&loginCode=' . $loginCode;
								$params .= '&stamp=' . $stampWEB;
								$params .= '&loginGCR=' . $loginGCR;
								$params .= '&signature=' . $signature;
								break;
						}
						break;
					default :
						switch ($_SESSION ['SITE'] ['NAME']) {
							case 'CISCAR' :
								$loginCode = $line [2];
								$signature = MD5 ( $loginType . $loginCode . $stamp . $clefAutologin ); // MD5 32 CHARS
								                                                                        // $URL = 'http://commerce.sage.com/ciscar/';
								$URL = 'http://ecommerce.ciscar.fr/localisation/ciscar/ciscarin.aspx';
								// $URL = 'http://www.ciscar.fr/ftp/16/coming-soon/new-ecommerce.html';
								$params = '?action=' . $action;
								$params .= '&loginCode=' . $loginCode;
								$params .= '&loginType=' . $loginType;
								$params .= '&stamp=' . $stampWEB;
								$params .= '&signature=' . $signature;
								$params .= '&contactCode=' . $loginGCR;
								if (isset ( $_GET ['idProduct'] ) && $_GET ['idProduct'] != "")
									$params .= '&idProduct=' . $_GET ['idProduct'];
								if (isset ( $_GET ['promo'] ) && $_GET ['promo'] == "on")
								{
									$URL = 'http://ecommerce.ciscar.fr/catalogue/catproductlist2.aspx?chkpromo=on';
									$params = str_replace('?', '&', $params);
								}
								break;
							case 'ACNF' :
								$loginCode = $line [2];
								$signature = MD5 ( $loginType . $loginCode . $stamp . $clefAutologin );
								// $URL = 'http://commerce.sage.com/ciscar/';
								$URL = 'http://ecommerce.ciscar.fr/localisation/ciscar/ciscarin.aspx';
								// $URL = 'http://www.ciscar.fr/ftp/16/coming-soon/new-ecommerce.html';
								$params = '?action=' . $action;
								$params .= '&loginCode=' . $loginCode;
								$params .= '&loginType=' . $loginType;
								$params .= '&stamp=' . $stampWEB;
								$params .= '&signature=' . $signature;
								$params .= '&contactCode=' . $loginGCR;
								break;
							case 'GCR' :
								$loginCode = $line [2];
								$signature = MD5 ( $loginType . $loginCode . $stamp . $clefAutologin );
								// $URL = 'http://commerce.sage.com/ciscar/';
								$URL = 'http://ecommerce.ciscar.fr/localisation/ciscar/ciscarin.aspx';
								// $URL = 'http://www.ciscar.fr/ftp/16/coming-soon/new-ecommerce.html';
								$params = '?action=' . $action;
								$params .= '&loginCode=' . $loginCode;
								$params .= '&loginType=' . $loginType;
								$params .= '&stamp=' . $stampWEB;
								$params .= '&signature=' . $signature;
								$params .= '&contactCode=' . $loginGCR;
								break;
						}
						break;
				}
				
				// CALL THE AUTOLOGIN URL
				$aff = '<script type="text/javascript">';
				$aff .= 'document.location.href="' . $URL . $params . '";';
				$aff .= '</script>';
				
				echo $aff;
				// header('Location: '.$URL.$params);
			}
		} else {
			$aParam->search_param ( $_SESSION ['SITE'] ['NAME'] . '_' . $ParamName . '_MESSAGE_ERREUR' );
			renderHTML ( stripslashes ( $aParam->getValue () ) );
		}
	}
	
	include ('../../include/DbDeconnexion.php');
} else {
	header ( 'HTTP/1.0 404 Not Found' );
	renderHTML ( stripslashes ( '<h4>ERROR 404</h4>' ) );
}
function renderHTML($content) {
	$aff = '<html>';
	$aff .= '<head>';
	$aff .= '<title>Ciscar : La centrale d\'achats des professionnels du secteur automobile</title>';
	$aff .= '<meta http-equiv="Content-type" content="text/html; charset=ISO-8859-1" />';
	$aff .= '<script src="../../include/js/jquery-1.4.2.js"></script>';
	$aff .= '<script src="../../include/js/Commun.js"></script>';
	$aff .= '<link rel="stylesheet" href="../../include/css/Commun.css"/>';
	$aff .= '<!--[if IE]>';
	$aff .= '<link rel="stylesheet" type="text/css" media="screen" href="../../include/css/CommunIE7.css" />';
	$aff .= '<![endif]-->';
	$aff .= '</head>';
	$aff .= '<body>';
	$aff .= '<table id="wrapper"><tr><td>';
	$aff .= '<div id="header">';
	$aff .= '<table width="100%" cellspacing="0" cellpadding="0">';
	$aff .= '<tr>';
	$aff .= '<td width="170"><img src="../../include/images/kit/100592.gif"/></td>';
	$aff .= '<td width="790" height="96">';
	// $aff .= '<object align="left" width="790" height="96" id="banner.swf" valign="up" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000">';
	// $aff .= '<param value="/include/images/kit/banner.swf" name="src">';
	// $aff .= '<param value="high" name="quality">';
	// $aff .= '<param value="mscssid=%7BFC687A65-CF7B-4457-A3B3-8A4FBE1B64A3%7D" name="FlashVars">';
	// $aff .= '<embed width="790" height="96" flashvars="mscssid=%7BFC687A65-CF7B-4457-A3B3-8A4FBE1B64A3%7D" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" src="/include/images/kit/banner.swf">';
	// $aff .= '</object>';
	$aff .= '<img src="/include/images/kit/bandeau_portail_ciscar.jpg" Border="0" USEMAP="#Map">';
	$aff .= '<MAP NAME="Map">
					<AREA SHAPE="rect" HREF="mailto://infos@ciscar.fr" COORDS="600,40,800,90">
				</MAP>';
	$aff .= '</td>';
	$aff .= '</tr>';
	$aff .= '</table>';
	$aff .= '</div>';
	$aff .= '<div id="main-container">';
	$aff .= '<br/><br/><br/><style>p {font-family:arial;text-align:center;font-size:14px;}</style><p>' . $content . '</p><br/><br/><br/>';
	if (isset ( $_GET ['type'] ) && $_GET ['type'] == 'ciscom') {
		$aff .= '<p align="center"><img src="../../include/images/kit/hp/CISCOM_Trans_H161.gif" width="126"/></p>';
	}
	$aff .= '<img src="../../include/images/kit/hp/filigrane.jpg" height="243" style="margin-left:-9px;">';
	$aff .= '</div>';
	$aff .= '</td></tr></table>';
	$aff .= '</body>';
	$aff .= '</html>';
	
	echo $aff;
}
function verifDroit() {
	if (! empty ( $_SESSION ['CISCAR'] ['USER'] ['GROUPS'] )) {
		switch ($_GET ['type']) {
			case 'ciscom' :
				return in_array ( 12, $_SESSION ['CISCAR'] ['USER'] ['GROUPS'] );
				break;
			case 'carterie' :
				return in_array ( 13, $_SESSION ['CISCAR'] ['USER'] ['GROUPS'] );
				break;
			default :
				return true;
				break;
		}
	}
	return false;
}
?>