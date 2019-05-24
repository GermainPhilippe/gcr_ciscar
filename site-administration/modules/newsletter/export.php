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

	if (isset ( $_GET ['envid'] )) {
		$aNewsletterEnvoisDetailsManager = new NewsletterEnvoisDetailsManager ();
		$SQLRqt = $aNewsletterEnvoisDetailsManager->getSqlEnvoisDetails ( $_GET ['envid'] );

		$resQuery = mysqli_query ($_SESSION['LINK'], $SQLRqt ) or die ( mysqli_error ($_SESSION['LINK']) . '<br/>' . $SQLRqt );

		header ( "Content-Type: application/csv-tab-delimited-table" );
		$filename = 'Detail_Envoi_' . $_GET ['envid'] . '.csv';
		header ( "Content-disposition: filename=" . $filename );

		if (mysqli_num_rows ( $resQuery ) > 0) {
			// titre des colonnes
			$fields = mysqli_num_fields ( $resQuery );
			$i = 0;
			while ( $i < $fields ) {
				echo '"' . mysqli_fetch_field_direct($resQuery, $i)->name . '"' . ";";
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