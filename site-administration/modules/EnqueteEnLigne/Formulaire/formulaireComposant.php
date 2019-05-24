<?php
session_start ();

if (! isset ( $_SESSION ['ADMIN'] )) {
	$_SESSION ['ADMIN'] ['USER'] ['FULLNAME'] = 'Visitor';
	$_SESSION ['ADMIN'] ['USER'] ['SiteName'] = '';
	$_SESSION ['ADMIN'] ['USER'] ['CONNECTED'] = false;
	$_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] = 0;
}

$_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] = 2;

$baseURLModule = '../../../modules/';
require ('../../mvc_inc.php');
include ('../../../../config/configuration.php');
include ('../../../include/DbConnexion.php');

if ($_SESSION ['ADMIN'] ['USER'] ['CONNECTED']) {

	$controller = new EnqueteFormulaireComposantController ();
	$controller->run ();
} else {
	// Formulaire de connexion
	$aff = '<script type="text/javascript">';
	$aff .= 'document.location.href="../../index.php";';
	$aff .= '</script>';
	echo $aff;
}
include ('../../../include/DbDeconnexion.php');
?>