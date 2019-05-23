<?php
/**
 * @author philippe GERMAIN
 * @package portail-ciscar
 * @subpackage securite
 * @version 1.0.4
 * Enregistrement des ouvertures de mails lorsque dans une newsletter un pixele de visu a été déclaré sous le forme
 * http://www.ciscar.fr/stats_visu.php?login=germain-4414&pwd=Locky75015&news=521&env=871" border="0" alt="" width="1" height="1"
 */
// include ('config/configuration.php');
$BaseURL = './';

// include ('../config/configuration.php');
include ('include/DbConnexion.php');

if (isset ( $_GET ['login'] ) && isset ( $_GET ['news'] ) && isset ( $_GET ['env'] )) {
	if ($_GET ['login'] != '' && $_GET ['news'] != '' && $_GET ['env'] != '') {
		$aSecurite = new SessionSecurite ();
		$aSecurite->setSiteID ( $_SESSION ['SITE'] ['ID'] );
		$aSecurite->setSiteName ( $_SESSION ['SITE'] ['NAME'] );
		
		$username = $_GET ['login'];
		
		$password = base64_decode ( $_GET ['pwd'] );
		
		$resultat = $aSecurite->SQL_checkUser ( $username, $password );
		
		switch ($resultat) {
			case '0' :
				if (! isset ( $_GET ['lien'] )) {
					$sql = "INSERT INTO wcm_newsletter_visu(IndividuID, NewsID, EnvoiID, LienId, DateVisu, ModVisu)";
					$sql .= " VALUES('%s', '%s', '%s', 0, NOW(), 'OUV')";
					
					$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'] , $aSecurite->getUserID () ), mysqli_real_escape_string ($_SESSION['LINK'] , $_GET ['news'] ), mysqli_real_escape_string ($_SESSION['LINK'] , $_GET ['env'] ) );
				} else {
					if (isset ( $_GET ['idProduct'] ))
						$idproduct = $_GET ['idProduct'];
					else
						$idproduct = "";
					$sql = "INSERT INTO wcm_newsletter_visu(IndividuID, NewsID, EnvoiID, LienId, DateVisu, ModVisu, productID)";
					$sql .= " VALUES('%s', '%s', '%s', '%s', NOW(), 'LIEN','%s')";
					
					$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'] , $aSecurite->getUserID () ), mysqli_real_escape_string ($_SESSION['LINK'] , $_GET ['news'] ), mysqli_real_escape_string ($_SESSION['LINK'] , $_GET ['env'] ), mysqli_real_escape_string ($_SESSION['LINK'] , $_GET ['lien'] ), mysqli_real_escape_string ($_SESSION['LINK'] , $idproduct ) );
				}
				
				mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
				
				break;
		}
		$_GET ['env'] = NULL;
		$_GET ['news'] = NULL;
	}
}

include ('include/DbDeconnexion.php');
?>