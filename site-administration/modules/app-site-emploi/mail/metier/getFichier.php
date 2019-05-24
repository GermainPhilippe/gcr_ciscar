<?php
/**
 * Export des fichier
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
	include ('modele/VerifOffre.php');
	include ('../../../../../config/configuration.php');

	$link_fi = mysqli_connect ( $CONFIG_MYSQL_HOSTNAME, $CONFIG_MYSQL_USERNAME, $CONFIG_MYSQL_PASSWORD,$CONFIG_MYSQL_BASENAME );
	$_SESSION['LINK_FI'] = $link_fi;
	
	$aModele = new VerifOffre ();
	$aModele->SQL_SELECT_BLOB_FICHIER ( $_GET ['id'] );

	header ( 'Content-type: ' . $aModele->getmimefichier () );
	header ( 'Content-Length: ' . $aModele->getsizefichier () );
	header ( 'Content-Disposition: inline; filename="' . $aModele->getfichier () . '"' );
	echo stripslashes ( $aModele->getblobfichier () );
}
?>