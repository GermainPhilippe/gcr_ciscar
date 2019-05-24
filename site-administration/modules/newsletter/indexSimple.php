<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage Newsletter
 * @version 2.0.1
 */
session_start ();

if (! isset ( $_SESSION ['ADMIN'] )) {
	$_SESSION ['ADMIN'] ['USER'] ['FULLNAME'] = 'Visitor';
	$_SESSION ['ADMIN'] ['USER'] ['SiteName'] = '';
	$_SESSION ['ADMIN'] ['USER'] ['CONNECTED'] = false;
	$_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] = 0;
}

?>
<style>
.tabEnvois {
	padding: 0px;
	border: 0px solid #999;
	font-size: 10px;
	font-family: Verdana, arial;
	background-color: #fff;
}

.tabEnvois td {
	background-color: #D4D4D4;
	padding: 10px;
	spacing: 1px;
}
</style>

<?php

$baseURLModule = '../../modules/';
require ('../mvc_inc.php');

if ($_SESSION ['ADMIN'] ['USER'] ['CONNECTED']) {
	// Connexion BDD
	include ('../../../config/configuration.php');
	require ('../../include/DbConnexion.php');

	// Traitement des actions
	if (isset ( $_GET ['action'] )) {
		$aControler = new NewsletterControler ();
		$aControler->run ();
	} else {
		$aManager = new NewsletterManager ();
		$aCollectionView = new NewsletterCollectionView ( $aManager->getList () );
		$aCollectionView->renderHTML ();
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