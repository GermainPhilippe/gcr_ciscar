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

// $BaseURL = './';
// if (isset($_GET['env']) && !isset($_GET['lien']))
// {
include ('../connexion/metier/modele/User.php');
// }

include ('../../../config/configuration.php');
include ('../../include/DbConnexion.php');

if (isset ( $_GET ['login'] ) && isset ( $_GET ['news'] ) && isset ( $_GET ['env'] )) {
	$aUser = new User ();

	$username = $_GET ['login'];
	$password = base64_decode ( $_GET ['pwd'] );

	$result = $aUser->SQL_checkUserVisu ( $username, $password );
	switch ($result) {
		case '0' :
			if (! isset ( $_GET ['lien'] )) {
				$sql = "INSERT INTO wcm_newsletter_visu(IndividuID, NewsID, EnvoiID, LienId, DateVisu, ModVisu)";
				$sql .= " VALUES('%s', '%s', '%s', 0, NOW(), 'OUV')";

				$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aUser->getUserID () ), mysqli_real_escape_string ($_SESSION['LINK'], $_GET ['news'] ), mysqli_real_escape_string ($_SESSION['LINK'], $_GET ['env'] ) );
			} else {
				$sql = "INSERT INTO wcm_newsletter_visu(IndividuID, NewsID, EnvoiID, LienId, DateVisu, ModVisu)";
				$sql .= " VALUES('%s', '%s', '%s', '%s', NOW(), 'LIEN')";

				$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aUser->getUserID () ), mysqli_real_escape_string ($_SESSION['LINK'], $_GET ['news'] ), mysqli_real_escape_string ($_SESSION['LINK'], $_GET ['env'] ), mysqli_real_escape_string ($_SESSION['LINK'], $_GET ['lien'] ) );
			}

			mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

			$_GET ['env'] = NULL;
			break;
	}
}

include ('../../include/DbDeconnexion.php');
?>