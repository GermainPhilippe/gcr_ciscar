<?php
/**
 * Export de la répartition par type
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
	if (isset ( $_GET ['export'] )) {

		switch ($_GET ['site']) {
			case 1 :
				$site = 'CISCAR';
				break;
			case 3 :
				$site = 'ACNF';
				break;
			case 2 :
				$site = 'GCR';
				break;
			case 7 :
				$site = 'GCRE';
				break;
		}

		switch ($_GET ['export']) {
			/**
			 * Exporter les données affichées
			 */
			case 1 :

				include ('../../../../config/configuration.php');
				$baseURLModule = '../../../modules/';
				require ('../../../include/DbConnexion.php');
				require ('../../mvc_inc.php');
				$time = time ();
				$aModele = new StatConsultType ();
				$aCount = $aModele->SQL_COUNT ( isset ( $_GET ['m'] ) ? $_GET ['m'] : date ( 'm', $time ), isset ( $_GET ['a'] ) ? $_GET ['a'] : date ( 'Y', $time ), $_GET ['site'], '0' );
				$aModele->SQL_SELECT_TYPE_DOC_GRAPH ( isset ( $_GET ['m'] ) ? $_GET ['m'] : date ( 'm', $time ), isset ( $_GET ['a'] ) ? $_GET ['a'] : date ( 'Y', $time ), $_GET ['site'] );
				$aCategorie = new CategorieDocInfoDynList ();
				$aCategorie->SQL_select_all_type ();
				header ( 'Content-Type:application/csv-tab-delimited-table' );
				header ( 'Content-disposition: filename="Répartitions par Type ' . $site . ' ' . FunctionDate::getMois ( $_GET ['m'] ) . ' ' . $_GET ['a'] . '.csv"' );

				echo "Type;";
				// echo "Publication;;";
				echo "Nombre de consultations;";
				echo "Pourcentage;";
				echo "\n";
				foreach ( $aModele->getList () as $aCle => $aVerif ) {
					$aConsult = new StatConsultType ();
					echo $aConsult->SQL_SELECT_NAME ( $aCle ) . ';';
					echo $aVerif . ';';
					echo round ( ($aVerif / $aCount) * 100 ) . '%;';
					echo "\n";
				}
				echo "Total;";
				echo $aCount . ';';
				echo "100%;";
				require ('../../../include/DbDeconnexion.php');
				break;

			/**
			 * Exporter toutes les données - Non utilisé dans la version courante
			 */

			case 2 :

				include ('../../../../config/configuration.php');
				$baseURLModule = '../../../modules/';
				require ('../../../include/DbConnexion.php');
				require ('../../mvc_inc.php');
				$time = time ();
				$annee = date ( 'Y', $time );
				$mois = date ( 'm', $time );
				$aStat = new StatConsultDoc ();

				$date_fin = explode ( '-', $aStat->SQL_SELECT_LAST_DATE () );

				header ( 'Content-Type: application/csv-tab-delimited-table' );
				header ( 'Content-disposition: filename="Répartitions par Type ' . $site . '.csv"' );

				while ( $annee >= $date_fin [0] ) {
					while ( $mois >= $date_fin [1] ) {
						$time = time ();
						$aModele = new StatConsultType ();
						$aCount = $aModele->SQL_COUNT ( $mois, $annee, $_GET ['site'], '0' );
						$aModele->SQL_SELECT_TYPE_DOC_GRAPH ( $mois, $annee, $_GET ['site'] );
						$aCategorie = new CategorieDocInfoDynList ();
						$aCategorie->SQL_select_all_type ();
						$aff = FunctionDate::getMois ( $mois ) . '; ' . $annee . ';';
						echo "\n";
						echo $aff;
						echo "\n";
						echo "Type;";
						echo "Nombre de consultations;";
						echo "\n";
						echo "Total;";
						echo ";";
						echo $aCount . ';';
						echo "100%;";
						echo "\n";

						foreach ( $aModele->getList () as $aCle => $aVerif ) {
							$aConsult = new StatConsultType ();
							echo $aConsult->SQL_SELECT_NAME ( $aCle ) . ';';
							echo ';' . $aVerif . ';';
							echo round ( ($aVerif / $aCount) * 100 ) . '%;';
							echo "\n";
						}
						($mois == 01) ? $mois = 12 : $mois --;
					}
					echo "\n";
					$annee --;
					echo "\n";
				}
				require ('../../../include/DbDeconnexion.php');
				break;
		}
	}
}
?>