<?php
/**
 * @author Philippe GERMAIN
 * @package portail-ciscar
 * @subpackage securite-web
 * @version 1.0.4
 */
session_cache_limiter ( 'private, must-revalidate' );
session_start ();

include ('../../../config/configuration.php');

$BaseURL = '../../';
include ('../../include/mvc_inc.php');

// pour enregistrer l'ouverture du lien sur click à partir de la newsletter
if ((isset ( $_GET ['login'] ) && isset ( $_GET ['news'] ) && isset ( $_GET ['env'] )) && ! isset ( $_GET ['action'] )) {
	if ($_GET ['login'] != '' && $_GET ['news'] != '' && $_GET ['env'] != '')
		include ('../../stats_visu.php');
}

include ('../../config/configuration.php');
include ('../../include/DbConnexion.php');

$aSessionSecurite = new SessionSecurite ();
$aSessionSecurite->setSiteID ( $_SESSION ['SITE'] ['ID'] );
$aSessionSecurite->setSiteName ( $_SESSION ['SITE'] ['NAME'] );

if (isset ( $_GET ['deal'] ) && $_GET ['deal'] == 3)
	$aDealsView = new DealsView3 ();
else {
	if (isset ( $_GET ['deal'] ) && $_GET ['deal'] == 4)
		$aDealsView = new DealsView4 ();
	else
		$aDealsView = new DealsView ();
}

if (isset ( $_GET ['action'] )) {
	if ($_GET ['action'] == 'connexion') {
		$aDealsController = new DealsController ();
		$msg = $aDealsController->run ();
		echo $aDealsView->renderHTML ( $msg );
	} else {
		if ($_GET ['action'] == 'mailconnexion') {
			$aDealsController = new DealsController ();
			$userID = $aDealsController->run ();
			
			if ($userID != '0') {
				$msg = 'ko1';
				echo $aDealsView->renderHTML ( $msg );
				
				// header('Location: index.php?deal='.$_GET['deal'].'&action=connexion&individuID='.$userID);
				// exit();
			} else {
				echo $aDealsView->renderHTML ();
			}
		} else {
			if ($_GET ['action'] == 'ajaxmotdepasseperdu') {
				$aDealsController = new DealsController ();
				$msg = $aDealsController->run ();
			} else {
				echo $aDealsView->renderHTML ();
			}
		}
	}
} else {
	
	echo $aDealsView->renderHTML ();
}

include ('../../include/DbDeconnexion.php');

?>