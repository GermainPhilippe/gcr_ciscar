<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage banniere
 * @version 1.0.4
 */
session_start ();

if (! isset ( $_SESSION ['ADMIN'] )) {
	$_SESSION ['ADMIN'] ['USER'] ['FULLNAME'] = 'Visitor';
	$_SESSION ['ADMIN'] ['USER'] ['SiteName'] = '';
	$_SESSION ['ADMIN'] ['USER'] ['CONNECTED'] = false;
	$_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] = 0;
}

if (isset ( $_GET ['id'] )) {
	// DB Connection
	include ('../../../config/configuration.php');
	include ('../../include/DbConnexion.php');

	$baseURLModule = '../../modules/';
	require ('../mvc_inc.php');

	$aModele = new Banniere ();
	$aModele->SQL_select ( $_GET ['id'] );

	// DB Deconnection
	include ('../../include/DbDeconnexion.php');
	$aff = '<html>';
	$aff .= '<head>';
	$aff .= '<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />';
	$aff .= '</head>';
	$aff .= '<body>';
	$aff = '<b>Web Content&nbsp;>&nbsp;Aper&ccedil;u banni&egrave;re</b><br/><br/>';
	$aff .= '<img src="' . $aModele->getURLImage () . '" />';
	$aff .= '<p align="right"><a href="#" class="jqmClose">Fermer</a></p>';
	$aff .= '</body>';
	$aff .= '</html>';
	echo $aff;
}