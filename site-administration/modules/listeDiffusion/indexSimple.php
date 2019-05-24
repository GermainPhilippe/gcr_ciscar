<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage listeDiffusion
 * @version 2.0.1
 */
session_start ();

if (! isset ( $_SESSION ['ADMIN'] )) {
	$_SESSION ['ADMIN'] ['USER'] ['FULLNAME'] = 'Visitor';
	$_SESSION ['ADMIN'] ['USER'] ['SiteName'] = '';
	$_SESSION ['ADMIN'] ['USER'] ['CONNECTED'] = false;
	$_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] = 0;
}

$baseURLModule = '../../modules/';
require ('../mvc_inc.php');

echo HelperHead::includeCSS ( '../../include/css/Commun.css' );
echo HelperHead::includeCSS ( '../../include/css/CommunLayout.css' );
echo HelperHead::includeJS ( '../../include/js/jquery/jquery-1.4.2.js' );
echo HelperHead::includeJS ( '../../include/js/jquery/datepicker/jquery-ui.min.js' );
echo HelperHead::includeCSS ( '../../include/js/jquery/datepicker/jquery-ui.css' );
echo HelperHead::includeJS ( '../../include/js/jquery/treeTable/treeTable.js' );
echo HelperHead::includeCSS ( '../../include/js/jquery/treeTable/treeTable.css' );

echo HelperHead::includeJS ( '../../include/js/listeDiffusion.js' );

echo '<div class="page">';
if ($_SESSION ['ADMIN'] ['USER'] ['CONNECTED']) {
	// Connexion BDD
	include ('../../../config/configuration.php');
	require ('../../include/DbConnexion.php');

	// Traitement des actions
	if (isset ( $_GET ['action'] )) {
		$aControler = new listeDiffusionControler ();
		$aControler->run ();
	}
	// Deconnexion BDD
	require ('../../include/DbDeconnexion.php');
}
echo '</div>';
?>