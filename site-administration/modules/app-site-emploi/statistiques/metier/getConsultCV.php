<?php
/**
 * Export des consultations de la CVthéque
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
				$aModele = new StatConsultCV ();
				$aModele->SQL_SELECT_CONSULT_CV ( isset ( $_GET ['m'] ) ? $_GET ['m'] : date ( 'm', $time ), isset ( $_GET ['a'] ) ? $_GET ['a'] : date ( 'Y', $time ) );

				header ( 'Content-Type:application/csv-tab-delimited-table' );
				header ( 'Content-disposition: filename="Site Emploi - Accès à la CVthéque ' . FunctionDate::getMois ( $_GET ['m'] ) . ' ' . $_GET ['a'] . '.csv"' );

				echo "Date;";
				echo "Heure;";
				echo "Nom;";
				echo "Prénom;";
				echo "Domaine d'activité;";
				echo "Fonction;";
				echo "Groupe;";
				echo "\n";

				foreach ( $aModele->getList () as $aVerif ) {
					$date = explode ( ' ', $aVerif->getdate () );
					$fr = FunctionDate::getDateFr ( $date [0] );
					$aff = $fr . ';' . $date [1] . ';';
					$aff .= $aVerif->getnom () . ';';
					$aff .= $aVerif->getprenom () . ';';
					$aff .= $aVerif->getdomaine () . ';';
					$aff .= $aVerif->getfonction () . ';';
					$aff .= $aVerif->getgroupe () . ';';
					echo $aff;
					echo "\n";
				}
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

				$aModele = new StatConsultCV ();
				$date_fin = explode ( '-', $aModele->SQL_SELECT_LAST_DATE () );
				header ( 'Content-Type: application/csv-tab-delimited-table' );
				header ( 'Content-disposition: filename="Site Emploi - Accès à la CVthéque .csv"' );
				while ( $annee >= $date_fin [0] ) {
					while ( $mois >= $date_fin [1] ) {
						$aModele = new StatConsultCV ();
						$aModele->SQL_SELECT_CONSULT_CV ( $mois, $annee );
						echo "\n";
						$aff = FunctionDate::getMois ( $mois ) . '; ' . $annee . ';';
						echo $aff;
						echo "\n";
						echo "Date;;";
						echo "Nom;";
						echo "Prénom;";
						echo "Domaine d'activité;;;";
						echo "Fonction;";
						echo "Groupe;";
						echo "\n";

						foreach ( $aModele->getList () as $aVerif ) {
							$date = explode ( ' ', $aVerif->getdate () );
							$fr = FunctionDate::getDateFr ( $date [0] );
							$aff = $fr . '  à  ' . $date [1] . ';;';
							$aff .= $aVerif->getnom () . ';';
							$aff .= $aVerif->getprenom () . ';';
							$aff .= $aVerif->getdomaine () . ';;;';
							$aff .= $aVerif->getfonction () . ';';
							$aff .= $aVerif->getgroupe () . ';';
							echo $aff;
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