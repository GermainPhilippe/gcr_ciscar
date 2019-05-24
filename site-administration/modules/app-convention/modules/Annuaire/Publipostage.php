<?php
/**
 * @author Florent DESPIERRES
 * @package app-convention
 * @subpackage annuaire
 * @version 1.0.4
 */
// Liste les données de la table
// -------------------------------------------
include ('../../../../../config/configuration.php');
include ('../../../../include/DbConnexion.php');

if (isset ( $_GET ['id'] )) {
	$query = sprintf ( "SELECT Nom, Prenom AS 'Prénom', Adresse, CodePostal, Ville FROM conv_annuaire WHERE Presence='1' AND ConventionID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $_GET ['id'] ) );
	$resQuery = mysqli_query ($_SESSION['LINK'], $query );

	header ( "Content-Type: application/csv-tab-delimited-table" );
	header ( "Content-disposition: filename=publipostage.csv" );

	if (mysqli_num_rows ( $resQuery ) != 0) {
		// titre des colonnes
		$fields = mysqli_num_fields ( $resQuery );
		$i = 0;
		while ( $i < $fields ) {
			//echo mysqli_field_name ( $resQuery, $i ) . ";";
			echo mysqli_fetch_field_direct($resQuery, $i)->name . ";";
			$i ++;
		}
		echo "\n";

		// données de la table
		while ( $arrSelect = mysqli_fetch_array  ( $resQuery, MYSQLI_ASSOC ) ) {
			foreach ( $arrSelect as $elem ) {
				echo "$elem;";
			}
			echo "\n";
		}
	}
}
include ('../../../../include/DbDeconnexion.php');
?>