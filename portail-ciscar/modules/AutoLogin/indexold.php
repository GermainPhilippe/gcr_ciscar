<?php
/**
 * @author Florent DESPIERRES
 * @package portail-ciscar
 * @subpackage autologin
 * @version 1.0.4
 */
session_start ();

$BaseURL = '../../';
include ('../../include/mvc_inc.php');

if (isset ( $_GET ['type'] )) {
	include ('../../../config/configuration.php');
	include ('../../include/DbConnexion.php');
	// print_r($_SESSION['SITE']);
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
		echo stripslashes ( $aParam->getValue () );
	} else {
		// Recherche des Concessions
		$sql = "SELECT e.EtablissementID, e.RaisonSociale, e.LoginSage, i.Login, i.LoginSage";
		$sql .= " FROM annuaire_role r, annuaire_individu i, annuaire_etablissement e";
		$sql .= " WHERE r.IndividuID=i.IndividuID AND r.EtablissementID=e.EtablissementID AND e.NumRRF!='' AND e.LoginSage!='' AND i.IndividuID='%s'";
		
		if (isset ( $_POST ['EtablissementID'] )) {
			$sql .= " AND r.EtablissementID='%s'";
			$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'] , $_SESSION [$_SESSION ['SITE'] ['NAME']] ['USER'] ['ID'] ), mysqli_real_escape_string ($_SESSION['LINK'] , $_POST ['EtablissementID'] ) );
		} else {
			$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'] , $_SESSION [$_SESSION ['SITE'] ['NAME']] ['USER'] ['ID'] ) );
		}
		
		$result = mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
		
		if (mysqli_num_rows ( $result ) > 0) {
			// Concession multiple
			if (mysqli_num_rows ( $result ) > 1 && $ParamName == 'E-COMMERCE') {
				$aff = '<table><tr><td width="170"><img src="/include/images/100592.gif" border="0"/></td><td><object align="left" width="790" height="96" id="banner_ciscar.swf" valign="up" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000">';
				$aff .= '<param value="/include/images/banner_ciscar.swf" name="src">';
				$aff .= '<param value="high" name="quality">';
				$aff .= '<param value="mscssid=%7BFC687A65-CF7B-4457-A3B3-8A4FBE1B64A3%7D" name="FlashVars">';
				$aff .= '<embed width="790" height="96" flashvars="mscssid=%7BFC687A65-CF7B-4457-A3B3-8A4FBE1B64A3%7D" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" src="/include/images/banner_ciscar.swf">';
				$aff .= '</object></td></tr><tr><td colspan="2">';
				echo $aff;
				
				$aParam->search_param ( $_SESSION ['SITE'] ['NAME'] . '_' . $ParamName . '_PAGE_CONNEXION' );
				echo stripslashes ( $aParam->getValue () ) . '</td></tr><tr><td colspan="2">';
				
				$aff = '<form method="POST" action="?type=' . $_GET ['type'] . '">';
				$aff .= '<select name="EtablissementID" onselect="this.submit()">';
				while ( $line = mysqli_fetch_array ( $result ) ) {
					$aff .= '<option value="' . $line [0] . '">' . $line [1] . '</option>';
				}
				$aff .= '</select><input type="submit" value="ok"/></form>';
				echo $aff . '</td></tr></table>';
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
								$URL = 'http://ciscar.channel-portal.com/ciscarIn.asp';
								$params = '?action=' . $action;
								$params .= '&loginCode=' . $loginCode;
								$params .= '&loginType=' . $loginType;
								$params .= '&stamp=' . $stampWEB;
								$params .= '&signature=' . $signature;
								$params .= '&contactCode=' . $loginGCR;
								break;
							case 'ACNF' :
								$loginCode = $line [2];
								$signature = MD5 ( $loginType . $loginCode . $stamp . $clefAutologin );
								// $URL = 'http://commerce.sage.com/ciscar/';
								$URL = 'http://ciscar.channel-portal.com/ciscarIn.asp';
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
								$URL = 'http://ciscar.channel-portal.com/ciscarIn.asp';
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
				header ( 'Location: ' . $URL . $params );
			}
		} else {
			$aParam->search_param ( $_SESSION ['SITE'] ['NAME'] . '_' . $ParamName . '_MESSAGE_ERREUR' );
			echo stripslashes ( $aParam->getValue () );
		}
	}
	
	include ('../../include/DbDeconnexion.php');
} else {
	header ( 'HTTP/1.0 404 Not Found' );
	echo '<h4>ERROR 404</h4>';
	exit ();
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