<?php
/**
 * Index servant à la Vue Répartition par DR (Traitement en AJAX)
 * @author Alexandre DIALLO
 * @package site-administration
 * @subpackage statistiques
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
	// DB Connection
	include ('../../../config/configuration.php');
	include ('../../include/DbConnexion.php');

	$baseURLModule = '../../modules/';
	require ('../mvc_inc.php');

	// Traitement des actions
	if (isset ( $_GET ['action'] )) {
		$aStatistiquesControler = new StatistiquesControler ();
		$aStatistiquesControler->run ();
	}

	// DB Deconnection
	include ('../../include/DbDeconnexion.php');
}
?>
