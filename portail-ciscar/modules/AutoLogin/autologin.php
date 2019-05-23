<?php
/**
 * @author Florent DESPIERRES
 * @package portail-ciscar
 * @subpackage autologin
 * @version 1.0.4
 */
session_start ();

if (isset ( $_GET ['url'] )) {
	include ('../../../config/configuration.php');
	include ('../../include/DbConnexion.php');
	
	$sql = "SELECT DISTINCT e.EtablissementID, e.RaisonSociale, e.LoginSage FROM annuaire_role r INNER JOIN annuaire_etablissement e ON (r.EtablissementID=e.EtablissementID) WHERE e.NumRRF!='' AND r.IndividuID='%s'";
	$sql .= isset ( $_POST ['EtablissementID'] ) ? " AND e.EtablissementID='%s'" : "";
	
	if (isset ( $_POST ['EtablissementID'] )) {
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'] , $_SESSION [$_SESSION ['SITE'] ['NAME']] ['USER'] ['ID'] ), mysqli_real_escape_string ($_SESSION['LINK'] , $_POST ['EtablissementID'] ) );
	} else {
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'] , $_SESSION [$_SESSION ['SITE'] ['NAME']] ['USER'] ['ID'] ) );
	}
	
	$result = mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
	
	if (mysqli_num_rows ( $result ) > 1) {
		// Selection de la concession
		$aff = '<form method="POST" action="?url=' . $_GET ['url'] . '"><select name="EtablissementID" onselect="this.submit()">';
		
		while ( $line = mysqli_fetch_array ( $result ) ) {
			$aff .= '<option value="' . $line [0] . '">' . $line [1] . '</option>';
		}
		include ('../../include/DbDeconnexion.php');
		$aff .= '</select><input type="submit" value="ok"/></form>';
		echo $aff;
	} else {
		$line = mysqli_fetch_array ( $result );
		include ('../../include/DbDeconnexion.php');
		
		// Traitement
		$URL = $_GET ['url'];
		$action = 'autoLogin'; // CONSTANT
		$clefAutologin = 'ecommerce104'; // CONSTANT
		$loginCode = $line [2];
		$loginType = '2'; // CONSTANT
		$stamp = date ( 'Y-m-d H:i:s' ); // yyyy-mm-dd hh:mm:ss GMT
		$stampWEB = date ( 'Y-m-d%20H:i:s' );
		$signature = MD5 ( $loginType . $loginCode . $stamp . $clefAutologin ); // MD5 32 CHARS
		
		if (isset ( $_GET ['method'] ) && $_GET ['method'] == 'POST') {
			// Method POST
			$aff = 'Auto Login en cours....';
			$aff .= '<form id="autologin" action="' . $URL . '" method="POST">';
			$aff .= '	<input type="hidden" id="action" name="action" value="' . $action . '"/>';
			$aff .= '	<input type="hidden" id="loginCode" name="loginCode" value="' . $loginCode . '"/>';
			$aff .= '	<input type="hidden" id="loginType" name="loginType" value="' . $loginType . '"/>';
			$aff .= '	<input type="hidden" name="stamp" id="stamp" value="' . $stampWEB . '"/>';
			$aff .= '	<input type="hidden" name="signature" id="signature" value="' . $signature . '"/>';
			$aff .= '</form>';
			$aff .= '<script>document.forms[0].submit();</script>';
			echo $aff;
		} else {
			// Method GET
			$params = '?action=' . $action;
			$params .= '&loginCode=' . $loginCode;
			$params .= '&loginType=' . $loginType;
			$params .= '&stamp=' . $stampWEB;
			$params .= '&signature=' . $signature;
			
			// CALL THE AUTOLOGIN URL
			header ( 'Location: ' . $URL . $params );
		}
	}
} else {
	header ( 'HTTP/1.0 404 Not Found' );
	echo '<h4>ERROR 404</h4>';
	exit ();
}
?>

