<?php
/**
 * @author Philippe GERMAIN
 * @package site-administration
 * @subpackage Liste Diffusion
 * @version 1.0.4
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

echo HelperHead::includeJS ( '../../include/js/script.js' );
echo HelperHead::includeJS ( '../../include/js/jquery/jquery-1.4.2.js' );
echo HelperHead::includeCSS ( '../../include/js/jquery_pagination/pagination.css' );
echo HelperHead::includeJS ( '../../include/js/jquery_pagination/jquery.pagination.js' );
echo HelperHead::includeJS ( '../../include/js/listeDiffusion.js' );
echo HelperHead::includeJS ( '../../include/js/jquery/datepicker/jquery-ui.min.js' );
echo HelperHead::includeCSS ( '../../include/js/jquery/datepicker/jquery-ui.css' );
?>

<div class="page">
<?php
if ($_SESSION ['ADMIN'] ['USER'] ['CONNECTED']) {
	// Connexion BDD
	include ('../../../config/configuration.php');
	require ('../../include/DbConnexion.php');

	$aViewList = new ListeDiffusion_CsvView ();

	// Traitement des actions
	if (isset ( $_GET ['action'] )) {
		$aCsvControler = new ListeDiffusionControler ();
		$aCsvControler->run ();
	}

	// Afficher le formulaire de recherche de fichier
	if (! isset ( $_GET ['action'] )) {
		$aViewList->renderHTML ( '' );
	}

	// Deconnexion BDD
	require ('../../include/DbDeconnexion.php');
} else {
	// Formulaire de connexion
	echo CommunFunction::goToURL ( '../../index.php' );
}
?>
</div>
