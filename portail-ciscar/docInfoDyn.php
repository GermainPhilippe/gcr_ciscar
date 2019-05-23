<?php
session_start ();

include ('config/configuration.php');

$BaseURL = './';
include ('include/mvc_inc.php');

include ('../config/configuration.php');
include ('include/DbConnexion.php');

$aSessionSecurite = new SessionSecurite ();
$aSessionSecurite->setSiteID ( $_SESSION ['SITE'] ['ID'] );
$aSessionSecurite->setSiteName ( $_SESSION ['SITE'] ['NAME'] );

// Si utilisateur Non-connecte
if (! isset ( $_SESSION [$_SESSION ['SITE'] ['NAME']] ) || $_SESSION [$_SESSION ['SITE'] ['NAME']] ['USER'] ['CONNECTED'] == false) {
	include ('include/DbDeconnexion.php');
	
	header ( 'HTTP/1.0 404 Not Found' );
	echo '<h4>ERROR 404</h4>';
	exit ();
} else {
	if (isset ( $_GET ['id'] )) {
		$aDoc = new DocInfoDyn ();
		$aDoc->SQL_select ( $_GET ['id'] );
		$aView = new DocInfoDynView ( $aDoc );
		echo $aView->renderHTMLPrint ();
		
		include ('include/DbDeconnexion.php');
		unset ( $aView );
		unset ( $aDoc );
	} else {
		include ('include/DbDeconnexion.php');
		
		header ( 'HTTP/1.0 404 Not Found' );
		echo '<h4>ERROR 404</h4>';
		exit ();
	}
}
?>
