<?php
/**
 * Export des lettres de motivation
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
	include ('modele/VerifCV.php');
	include ('../../../../../config/configuration.php');

	$link_lm = mysqli_connect ( $CONFIG_MYSQL_HOSTNAME, $CONFIG_MYSQL_USERNAME, $CONFIG_MYSQL_PASSWORD,$CONFIG_MYSQL_BASENAME );
	$_SESSION['LINK_LM'] = $link_lm;
	
	$aModele = new VerifCV ();
	$aModele->SQL_SELECT_BLOB_LM ( $_GET ['id'] );

	header ( 'Content-type: ' . $aModele->getmimelm () );
	header ( 'Content-Length: ' . $aModele->getsizelm () );
	header ( 'Content-Disposition: inline; filename="' . $aModele->getlettrem () . '"' );
	echo $aModele->getbloblm ();
}
?>