<?php
/**
 * Export de la répartition par DR
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
				$aModele = new StatConsultDR ();
				$aTotal = $aModele->SQL_COUNT ( isset ( $_GET ['m'] ) ? $_GET ['m'] : date ( 'm', $time ), isset ( $_GET ['a'] ) ? $_GET ['a'] : date ( 'Y', $time ), $_GET ['site'], '0' );
				$aModele->SQL_SELECT_DR ( isset ( $_GET ['m'] ) ? $_GET ['m'] : date ( 'm', $time ), isset ( $_GET ['a'] ) ? $_GET ['a'] : date ( 'Y', $time ), $_GET ['site'] );
				$aRegion = new RegionListe ();
				$aRegion->select_all_region_stat ( $_GET ['site'] == '7' ? '2' : $_GET ['site'] );

				header ( 'Content-Type:application/csv-tab-delimited-table' );
				header ( 'Content-disposition: filename="Répartitions par DR ' . $site . ' ' . FunctionDate::getMois ( $_GET ['m'] ) . ' ' . $_GET ['a'] . '.csv"' );

				echo "Région;";
				echo "Domaine;";
				echo "Publication;";
				echo "Nombre de consultations;";
				echo "Pourcentage;";
				echo "\n";
				foreach ( $aRegion->getRegionListe () as $aCle => $aVerif ) {
					// Ligne Région
					echo $aVerif->getName () . ";;;";
					$Nom_Region = $aVerif->getName ();
					$id = $aVerif->getID ();
					$aStat = new StatConsultDR ();
					$aStat->SQL_SELECT_DR ( isset ( $_GET ['m'] ) ? $_GET ['m'] : date ( 'm', $time ), isset ( $_GET ['a'] ) ? $_GET ['a'] : date ( 'Y', $time ), $_GET ['site'] );
					$aCount = $aStat->SQL_COUNT_DR ( $_GET ['site'], isset ( $_GET ['m'] ) ? $_GET ['m'] : date ( 'm', $time ), isset ( $_GET ['a'] ) ? $_GET ['a'] : date ( 'Y', $time ), $aVerif->getID () );
					echo $aCount . ";";
					$tot = round ( ($aCount / $aTotal) * 100 );
					echo $tot . "%;;";
					echo "\n";
					$aStat->SQL_SELECT_DOMAINE_DR ( isset ( $_GET ['m'] ) ? $_GET ['m'] : date ( 'm', $time ), isset ( $_GET ['a'] ) ? $_GET ['a'] : date ( 'Y', $time ), '0', $_GET ['site'], $aVerif->getID () );
					foreach ( $aStat->getList () as $aCle_DR => $aVerif_DR ) {
						// Ligne Région - Domaine
						$aConsult = new DomaineActivite ();
						echo $Nom_Region . ";";
						if ($aCle_DR != NULL) {
							// Si c'est un domaine quelconque
							$aConsult->select_name ( $aCle_DR );
							echo $aConsult->getName () . ';;';
							$Nom_Domaine = $aConsult->getName ();
						} else {
							// Sinon il n'y a pas de domaine défini
							echo "Indéfini;;";
							$aCle_DR = 'NULL';
							$Nom_Domaine = "Indéfini";
						}

						echo $aVerif_DR . ';';
						$tot = round ( ($aVerif_DR / $aTotal) * 100 );
						echo $tot . '%;';
						echo " \n";
						$aModele = new StatConsultDR ();
						$aModele->SQL_SELECT_DOMAINE_DR_DOC ( $_GET ['m'], $_GET ['a'], $_GET ['type'], $_GET ['site'], $id . '-' . $aCle_DR );
						foreach ( $aModele->getList () as $aCle => $aVerif ) { // Ligne documents
							echo $Nom_Region . ";";
							echo $Nom_Domaine . ";";
							echo $aCle . ';';
							echo $aVerif . ';';
							$tot = round ( ($aVerif / $aTotal) * 100 );
							echo $tot . '%;';
							echo "\n";
						}
					}
				}

				// Région non définie
				// Ligne Région
				echo "Indéfini;;;";
				$aStat = new StatConsultDR ();
				$aStat->SQL_SELECT_DR ( isset ( $_GET ['m'] ) ? $_GET ['m'] : date ( 'm', $time ), isset ( $_GET ['a'] ) ? $_GET ['a'] : date ( 'Y', $time ), $_GET ['site'] );
				$aCount = $aStat->SQL_COUNT_DR ( $_GET ['site'], isset ( $_GET ['m'] ) ? $_GET ['m'] : date ( 'm', $time ), isset ( $_GET ['a'] ) ? $_GET ['a'] : date ( 'Y', $time ), 'NULL' );
				echo $aCount . ";";
				$tot = round ( ($aCount / $aTotal) * 100 );
				echo $tot . "%;;";
				echo "\n";
				$aStat->SQL_SELECT_DOMAINE_DR ( isset ( $_GET ['m'] ) ? $_GET ['m'] : date ( 'm', $time ), isset ( $_GET ['a'] ) ? $_GET ['a'] : date ( 'Y', $time ), '0', $_GET ['site'], 'NULL' );
				foreach ( $aStat->getList () as $aCle_DR => $aVerif_DR ) { // Ligne Domaine
					echo "Indéfini;";
					if ($aCle_DR != NULL) {
						// Si on a un domaine quelconque
						$aConsult = new DomaineActivite ();
						$aConsult->select_name ( $aCle_DR );
						echo $aConsult->getName () . ';;';
						echo $aVerif_DR . ';';
						$tot = round ( ($aVerif_DR / $aTotal) * 100 );
						echo $tot . '%;';
						echo " \n";
						$aModele = new StatConsultDR ();
						$aModele->SQL_SELECT_DOMAINE_DR_DOC ( isset ( $_GET ['m'] ) ? $_GET ['m'] : date ( 'm', $time ), isset ( $_GET ['a'] ) ? $_GET ['a'] : date ( 'Y', $time ), '0', $_GET ['site'], 'NULL-' . $aCle_DR );
						foreach ( $aModele->getList () as $aCle => $aVerif ) { // Ligne document
							echo "Indéfini;";
							echo $aConsult->getName () . ';;;';
							echo ";;;" . $aCle . ';;;';
							echo $aVerif . ';';
							$tot = round ( ($aVerif / $aTotal) * 100 );
							echo $tot . '%;';
							echo "\n";
						}
					} else {
						// Sinon on a pas de domaine défini
						echo 'Indéfini;;';
						echo $aVerif_DR . ';';
						$tot = round ( ($aVerif_DR / $aTotal) * 100 );
						echo $tot . '%;';
						echo " \n";
						$aModele = new StatConsultDR ();
						$aModele->SQL_SELECT_DOMAINE_DR_DOC ( isset ( $_GET ['m'] ) ? $_GET ['m'] : date ( 'm', $time ), isset ( $_GET ['a'] ) ? $_GET ['a'] : date ( 'Y', $time ), '0', $_GET ['site'], 'NULL-NULL' );
						foreach ( $aModele->getList () as $aCle => $aVerif ) { // Ligne document
							echo 'Indéfini;Indéfini;';
							echo $aCle . ';';
							echo $aVerif . ';';
							$tot = round ( ($aVerif / $aTotal) * 100 );
							echo $tot . '%;';
							echo "\n";
						}
					}
				}

				echo "Total;;;";
				echo $aTotal . ';';
				echo "100%;";
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

				$aStat = new StatConsultDoc ();

				$date_fin = explode ( '-', $aStat->SQL_SELECT_LAST_DATE () );

				header ( 'Content-Type: application/csv-tab-delimited-table' );
				header ( 'Content-disposition: filename="Répartitions par DR ' . $site . '.csv"' );

				while ( $annee >= $date_fin [0] ) {
					while ( $mois >= $date_fin [1] ) {
						$aModele = new StatConsultDR ();

						$aCount = $aModele->SQL_COUNT ( isset ( $_GET ['m'] ) ? $_GET ['m'] : date ( 'm', $time ), isset ( $_GET ['a'] ) ? $_GET ['a'] : date ( 'Y', $time ), $_GET ['site'], '0' );
						$aModele->SQL_SELECT_DR ( $mois, $annee, $_GET ['site'] );
						$aRegion = new RegionListe ();
						$aRegion->select_all_region_stat ( $_GET ['site'] );
						$aff = FunctionDate::getMois ( $mois ) . '; ' . $annee . ';';
						echo $aff;
						echo "\n";
						echo "Région;;";
						echo "Domaine;;;";
						echo "Publication;;";
						echo "Nombre de consultations;;";
						echo "%;";
						echo "\n";
						echo "Total;;";
						echo ";;;";
						echo ";;";
						echo $aCount . ';';
						echo "100%;";
						echo "\n";

						foreach ( $aRegion->getRegionListe () as $aCle => $aVerif ) {
							echo "\n";
							echo $aVerif->getName () . ";;";

							$aModele = new StatConsultDR ();
							$aCount = $aModele->SQL_COUNT_DOMAINE ( $mois, $annee, $_GET ['type'], $_GET ['site'], $aVerif->getID () );
							$aModele->SQL_SELECT_DOMAINE_DR ( $mois, $annee, $_GET ['type'], $_GET ['site'], $aVerif->getID () );

							foreach ( $aModele->getList () as $aCle_DR => $aVerif_DR ) {
								$aConsult = new DomaineActivite ();
								$aConsult->select_name ( $aCle_DR );
								echo ";;";
								echo $aConsult->getName () . ';;;';
								echo ";;";
								echo $aVerif_DR . ';';

								$tot = round ( ($aVerif_DR / $aCount) * 100 );
								echo $tot . '%;';
								echo " \n";
								$aModele = new StatConsultDR ();
								$aCount = $aModele->SQL_COUNT_DOMAINE ( $mois, $annee, $_GET ['type'], $_GET ['site'], $aVerif->getID () . '-' . $aCle_DR );
								$aModele->SQL_SELECT_DOMAINE_DR_DOC ( $mois, $annee, $_GET ['type'], $_GET ['site'], $aVerif->getID () . '-' . $aCle_DR );
								foreach ( $aModele->getList () as $aCle => $aVerif ) {
									echo ";;;;" . $aCle . ';;;';
									echo $aVerif . ';';
									$tot = round ( ($aVerif / $aCount) * 100 );
									echo $tot . '%;';
									echo "\n";
								}
							}
						}
						echo "\n";
						echo "Indéfini ;;";
						echo "\n";
						$aModele = new StatConsultDR ();
						$aCount = $aModele->SQL_COUNT_DOMAINE ( $mois, $annee, $_GET ['type'], $_GET ['site'], 0 );
						$aModele->SQL_SELECT_DOMAINE_DR ( $mois, $annee, $_GET ['type'], $_GET ['site'], 0 );

						foreach ( $aModele->getList () as $aCle_DR => $aVerif_DR ) {
							$aConsult = new DomaineActivite ();
							$aConsult->select_name ( $aCle_DR );
							echo ";;";
							echo $aConsult->getName () . ';;;';
							echo ";;";
							echo $aVerif_DR . ';';

							$tot = round ( ($aVerif_DR / $aCount) * 100 );
							echo $tot . '%;';
							echo " \n";

							$aModele = new StatConsultDR ();
							$aCount = $aModele->SQL_COUNT_DOMAINE ( $mois, $annee, $_GET ['type'], $_GET ['site'], '0-' . $aCle_DR );
							$aModele->SQL_SELECT_DOMAINE_DR_DOC ( $mois, $annee, $_GET ['type'], $_GET ['site'], '0-' . $aCle_DR );
							foreach ( $aModele->getList () as $aCle => $aVerif ) {
								echo ";;;;" . $aCle . ';;;';
								echo $aVerif . ';';
								$tot = round ( ($aVerif / $aCount) * 100 );
								echo $tot . '%;';
								echo "\n";
							}
						}

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