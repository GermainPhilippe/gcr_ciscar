<?php
session_start ();

if (! isset ( $_SESSION ['ADMIN'] )) {
	$_SESSION ['ADMIN'] ['USER'] ['FULLNAME'] = 'Visitor';
	$_SESSION ['ADMIN'] ['USER'] ['SiteName'] = '';
	$_SESSION ['ADMIN'] ['USER'] ['CONNECTED'] = false;
	$_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] = 0;
}

$baseURLModule = '../../modules/';
require ('../mvc_inc.php');

if ($_SESSION ['ADMIN'] ['USER'] ['CONNECTED']) {
	// Connexion BDD
	include ('../../../config/configuration.php');
	require ('../../include/DbConnexion.php');

	// Traitement des actions
	if (isset ( $_GET ['action'] )) {
		$aSurveyControler = new SurveyControler ();
		$aSurveyControler->run ();
	} else {
		$aSurveyManager = new SurveyManager ();
		$aSurveyCollectionView = new SurveyCollectionView ( $aSurveyManager->getList () );
		$aSurveyCollectionView->renderHTML ();
	}

	// Deconnexion BDD
	require ('../../include/DbDeconnexion.php');
} else {
	// Formulaire de connexion
	$aff = '<script type="text/javascript">';
	$aff .= 'document.location.href="../../index.php";';
	$aff .= '</script>';
	echo $aff;
}
?>