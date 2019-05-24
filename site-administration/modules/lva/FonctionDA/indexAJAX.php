<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage lva
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
	// Connexion BDD
	include ('../../../../config/configuration.php');
	require ('../../../include/DbConnexion.php');

	$baseURLModule = '../../../modules/';
	require ('../../mvc_inc.php');
	// Traitement des actions
	if (isset ( $_GET ['action'] )) {
		$aFonctionDAControler = new FonctionDAControler ();
		$aFonctionDAControler->run ();
	}

	// Deconnexion BDD
	require ('../../../include/DbDeconnexion.php');
} else {
	// Formulaire de connexion
	$aff = '<script type="text/javascript">';
	$aff .= 'document.location.href="../../../index.php";';
	$aff .= '</script>';
	echo $aff;
}
?>