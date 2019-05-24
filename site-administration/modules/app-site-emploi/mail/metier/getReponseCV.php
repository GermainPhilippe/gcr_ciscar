<?php
/**
 * Export des cv reponses
 * @author Quentin BRISSON
 * @author Alexandre DIALLO
 * @package app-site-emploi
 * @subpackage mail
 * @version 1.0.4
 */
session_start ();

if (! isset ( $_SESSION ['ADMIN'] )) {
	$_SESSION ['ADMIN'] ['USER'] ['FULLNAME'] = 'Visitor';
	$_SESSION ['ADMIN'] ['USER'] ['SiteName'] = '';
	$_SESSION ['ADMIN'] ['USER'] ['CONNECTED'] = false;
	$_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] = 0;
}

if ($_SESSION ['ADMIN'] ['USER'] ['CONNECTED']) {
	include ('../../reponse/metier/modele/VerifReponse.php');
	include ('../../../../../config/configuration.php');

	$link_cv = mysqli_connect ( $CONFIG_MYSQL_HOSTNAME, $CONFIG_MYSQL_USERNAME, $CONFIG_MYSQL_PASSWORD,$CONFIG_MYSQL_BASENAME );
	$_SESSION['LINK_CV'] = $link_cv;
	
	$aModele = new VerifReponse ();
	$aModele->SQL_SELECT_BLOB_CV ( $_GET ['id'] );

	header ( 'Content-type: ' . $aModele->getmimecvcand () );
	header ( 'Content-Length: ' . $aModele->getsizecvcand () );
	header ( 'Content-Disposition: inline; filename="' . $aModele->getcvcand () . '"' );
	echo stripslashes ( $aModele->getblobcvcand () );
}
?>