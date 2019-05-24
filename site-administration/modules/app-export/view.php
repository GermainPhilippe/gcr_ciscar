<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage app-export
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

if ($_SESSION ['ADMIN'] ['USER'] ['CONNECTED']) {
	// Connexion BDD
	include ('../../../config/configuration.php');
	require ('../../include/DbConnexion.php');
	$aManager = new ExportRequestManager ();
	if (isset ( $_GET ['id'] )) {
		$aExportRequest = $aManager->get ( $_GET ['id'] );
	}
	if (isset ( $_GET ['name'] )) {
		$aExportRequest = $aManager->getByName ( $_GET ['name'] );
	}

	$SQLRqt = stripslashes ( $aExportRequest->getSQLRequest () );

	$ParamList = explode ( "|", $aExportRequest->getColumnName () );

	$count = 0;
	if (count ( $ParamList ) > 0) {
		// on charge dans un tableau les valeurs passées en querystring
		foreach ( $ParamList as $aParam ) {
			$args [$count] = mysqli_real_escape_string ($_SESSION['LINK'], isset ( $_GET [$aParam] ) ? $_GET [$aParam] : '' );
			$count += 1;
		}
		// on remplace les variables de la requête avec le contenu du tableau
		$SQLRqt = vsprintf ( $SQLRqt, $args );
	}

	$resQuery = mysqli_query ($_SESSION['LINK'], $SQLRqt ) or die ( mysqli_error ($_SESSION['LINK']) . '<br/>' . $SQLRqt );

	header ( "Content-Type: application/csv-tab-delimited-table" );
	$filename = $aExportRequest->getOutputFilename ();
	if (isset ( $_GET ['GroupeID'] ))
		$filename = str_replace ( '.csv', '_' . $_GET ['GroupeID'] . '.csv', $filename );
	header ( "Content-disposition: filename=" . $filename );

	if (mysqli_num_rows ( $resQuery ) > 0) {
		// titre des colonnes
		$fields = mysqli_num_fields ( $resQuery );
		$i = 0;
		while ( $i < $fields ) {
			echo '"' . str_replace ( "Taxi", "Parking", mysqli_fetch_field_direct($resQuery, $i)->name ) . '"' . ";";
			$i ++;
		}
		echo "\n";

		// données de la table
		while ( $arrSelect = mysqli_fetch_array  ( $resQuery, MYSQLI_ASSOC ) ) {
			foreach ( $arrSelect as $elem ) {
				echo '"' . $elem . '"' . ";";
			}
			echo "\n";
		}
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