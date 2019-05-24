<?php
/**
 * Export de la Fréquentation quotidienne
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
		function jour($id) {
			switch ($id) {
				case 0 :
					return 'Dimanche';
					break;
				case 1 :
					return 'Lundi';
					break;
				case 2 :
					return 'Mardi';
					break;
				case 3 :
					return 'Mercredi';
					break;
				case 4 :
					return 'Jeudi';
					break;
				case 5 :
					return 'Vendredi';
					break;
				case 6 :
					return 'Samedi';
					break;
			}
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
				$aModele = new Frequentation ();
				$m = (isset ( $_GET ['m'] )) ? $_GET ['m'] : date ( 'm', $time );
				$y = (isset ( $_GET ['a'] )) ? $_GET ['a'] : date ( 'Y', $time );
				$aModele->SQL_SELECT_FREQUENTATION ( $m, $y, $_GET ['site'] );
				header ( 'Content-Type:application/csv-tab-delimited-table' );
				header ( 'Content-disposition: filename="Fréquentations ' . $site . ' ' . FunctionDate::getMois ( $_GET ['m'] ) . ' ' . $_GET ['a'] . '.csv"' );
				echo "Jour ;Date;";
				echo "Nombre de connexions;";
				echo "\n";
				foreach ( $aModele->getList () as $aCle => $aVerif ) {
					echo jour ( date ( "w", mktime ( 0, 0, 0, $m, $aCle, $y ) ) ) . ';';
					echo $aCle . '/' . $m . '/' . $y . ';';
					echo $aVerif . ';';
					echo "\n";
				}
				echo "\n";
				require ('../../../include/DbDeconnexion.php');
				break;

			/**
			 * Exporter les données affichées
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
				header ( 'Content-disposition: filename="Fréquentations ' . $site . '.csv"' );

				while ( $annee >= $date_fin [0] ) {
					while ( $mois >= $date_fin [1] ) {
						$aModele = new Frequentation ();
						$aModele->SQL_SELECT_FREQUENTATION ( $mois, $annee, $_GET ['site'] );
						$aff = FunctionDate::getMois ( $mois ) . '; ' . $annee . ';';
						echo $aff;
						echo "\n";
						echo "Jour ;;";
						echo " Nombre de connexions ;";
						echo "\n";
						foreach ( $aModele->getList () as $aCle => $aVerif ) {
							echo $aCle . '/' . $mois . '/' . $annee . ';;;';
							echo $aVerif . ';';
							echo "\n";
						}
						echo "\n";
						($mois == 01) ? $mois = 12 : $mois --;
					}
					echo "\n";
					$annee --;
				}
				require ('../../../include/DbDeconnexion.php');
				break;
		}
	}
}

?>