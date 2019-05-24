<?php
/**
 * Export de la Répartition par domaine
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
				$aStat = new StatConsultDomaine ();
				$aCount = $aStat->SQL_COUNT ( isset ( $_GET ['m'] ) ? $_GET ['m'] : date ( 'm', $time ), isset ( $_GET ['a'] ) ? $_GET ['a'] : date ( 'Y', $time ), $_GET ['site'], isset ( $_GET ['type'] ) ? $_GET ['type'] : '3' );
				$aStat->SQL_SELECT_DOMAINE ( isset ( $_GET ['m'] ) ? $_GET ['m'] : date ( 'm', $time ), isset ( $_GET ['a'] ) ? $_GET ['a'] : date ( 'Y', $time ), isset ( $_GET ['type'] ) ? $_GET ['type'] : '3', $_GET ['site'] );
				header ( 'Content-Type:application/csv-tab-delimited-table' );
				header ( 'Content-disposition: filename="Répartitions par Domaine ' . $site . ' ' . FunctionDate::getMois ( $_GET ['m'] ) . ' ' . $_GET ['a'] . '.csv"' );
				echo "Domaine;";
				echo "Nombre de consultations;";
				echo "Pourcentage;";
				echo "\n";
				foreach ( $aStat->getList () as $aCle => $aVerif ) {
					if ($aCle != NULL) {
						$aConsult = new DomaineActivite ();
						$aConsult->select_name ( $aCle );
						echo $aConsult->getName () . ';';

						echo $aVerif . ';';
						$total = round ( ($aVerif / $aCount) * 100 );
						echo $total . '%;';
						echo "\n";
					} else {

						echo 'Indéfini;';
						echo $aVerif . ';';
						$total = round ( ($aVerif / $aCount) * 100 );
						echo $total . '%;';
						echo "\n";
					}
				}
				echo "Total;";
				echo $aCount . ';';
				echo "100%;";
				echo "\n";
				echo "\n";

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
				$aStat = new StatConsultDomaine ();
				$date_fin = explode ( '-', $aStat->SQL_SELECT_LAST_DATE () );
				header ( 'Content-Type: application/csv-tab-delimited-table' );
				header ( 'Content-disposition: filename="Répartitions par Domaine ' . $site . '.csv"' );
				while ( $annee >= $date_fin [0] ) {
					while ( $mois >= $date_fin [1] ) {
						$aStat = new StatConsultDomaine ();
						$aCount = $aStat->SQL_COUNT ( $mois, $annee, $_GET ['site'], isset ( $_GET ['type'] ) ? $_GET ['type'] : '3' );
						$aStat->SQL_SELECT_DOMAINE ( $mois, $annee, isset ( $_GET ['type'] ) ? $_GET ['type'] : '3', $_GET ['site'] );
						$aff = FunctionDate::getMois ( $mois ) . '; ' . $annee . ';';
						echo $aff;
						echo "\n";
						echo "Domaine ;;;";
						echo " Nombre de consultations ;";
						echo "\n";
						echo "Total;;;";
						echo $aCount . ';';
						echo "100%;";
						echo "\n";
						foreach ( $aStat->getList () as $aCle => $aVerif ) {
							if ($aCle != NULL) {
								$aConsult = new DomaineActivite ();
								$aConsult->select_name ( $aCle );
								echo $aConsult->getName () . ';;;';
								echo $aVerif . ';';
								$total = round ( ($aVerif / $aCount) * 100 );
								echo $total . '%;';
								echo "\n";
							} else {
								echo 'Indéfini;;;';
								echo $aVerif . ';';
								$total = round ( ($aVerif / $aCount) * 100 );
								echo $total . '%;';
								echo "\n";
							}
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