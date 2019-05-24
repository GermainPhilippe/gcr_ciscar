<?php
/**
 * Export des consultations
 * @author Quentin BRISSON
 * @author Alexandre DIALLO
 * @package app-site-emploi
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
	if (isset ( $_GET ['export'] )) {

		switch ($_GET ['export']) {
			// Exporter les données affichées
			case 1 :

				include ('../../../../../config/configuration.php');
				$baseURLModule = '../../../../modules/';
				require ('../../../../include/DbConnexion.php');
				require ('../../../mvc_inc.php');
				$time = time ();
				$aModele = new StatConsult ();
				$aModele->SQL_SELECT_CONSULT ( isset ( $_GET ['m'] ) ? $_GET ['m'] : date ( 'm', $time ), isset ( $_GET ['a'] ) ? $_GET ['a'] : date ( 'Y', $time ) );
				header ( 'Content-Type:application/csv-tab-delimited-table' );
				header ( 'Content-disposition: filename="Site Emploi - Nombre de consultations par page ' . FunctionDate::getMois ( $_GET ['m'] ) . ' ' . $_GET ['a'] . '.csv"' );

				echo "Espace ;";
				echo " Titre de la page ;";
				echo " Nombre de consultations ;";
				echo "\n";
				foreach ( $aModele->getList () as $aConsult ) {
					echo $aConsult->getespace ();
					echo ";";
					echo $aConsult->gettitle ();
					echo ";";
					echo $aConsult->getconsult ();
					echo ";";
					echo "\n";
				}
				echo "\n";

				require ('../../../../include/DbDeconnexion.php');
				break;

			// Exporter toutes les données
			// Non utilisé

			case 2 :

				include ('../../../../../config/configuration.php');
				$baseURLModule = '../../../../modules/';
				require ('../../../../include/DbConnexion.php');

				require ('../../../mvc_inc.php');
				$time = time ();
				$annee = date ( 'Y', $time );
				$mois = date ( 'm', $time );

				$aModele = new StatConsult ();
				$date_fin = explode ( '-', $aModele->SQL_SELECT_LAST_DATE () );
				header ( 'Content-Type: application/csv-tab-delimited-table' );
				header ( 'Content-disposition: filename="Site Emploi - Nombre de consultations par page.csv"' );

				while ( $annee >= $date_fin [0] ) {
					while ( $mois >= $date_fin [1] ) {
						$aModele = new StatConsult ();
						$aModele->SQL_SELECT_CONSULT ( $mois, $annee );
						echo "\n";
						$aff = FunctionDate::getMois ( $mois ) . '; ' . $annee . ';';
						echo $aff;
						echo "\n Espace ;;";
						echo " Titre de la page ;;;";
						echo " Nombre de consultations ;";
						echo "\n";
						echo "\n";
						foreach ( $aModele->getList () as $aConsult ) {
							echo $aConsult->getespace ();
							echo ";;";
							echo $aConsult->gettitle ();
							echo ";;;;";
							echo $aConsult->getconsult ();
							echo ";";
							echo "\n";
						}
						($mois == 01) ? $mois = 12 : $mois --;
					}
					echo "\n";
					$annee --;
				}
				require ('../../../../include/DbDeconnexion.php');
				break;
		}
	}
}

?>