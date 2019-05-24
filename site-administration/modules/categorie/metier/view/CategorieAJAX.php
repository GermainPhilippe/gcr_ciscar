<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage categorie
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
	if (isset ( $_POST ['CategorieParentID'] )) {
		// Connexion db
		include ('../../../../../config/configuration.php');
		include ('../../../../include/DbConnexion.php');

		$query = sprintf ( "SELECT DocCategorieID, Description FROM wcm_document_categorie WHERE SiteID='%s' AND DocCatParentID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ), mysqli_real_escape_string ($_SESSION['LINK'], $_POST ['CategorieParentID'] ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		$aff = '<option value="0" selected="selected"></option>';
		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aff .= '<option value="' . $line [0] . '">' . htmlentities ( $line [1], ENT_QUOTES ) . '</option>';
		}

		mysqli_free_result  ( $result );

		// Deconnexion BD
		include ('../../../../include/DbDeconnexion.php');

		echo $aff;
	} else {
		echo '<option selected="selected">error</option>';
	}
}
?>