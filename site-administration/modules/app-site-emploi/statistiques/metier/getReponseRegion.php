<?php
/**
 * Export des réponses par région et domaine
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
				$aRegion = new StatListRegion ();
				$aRegion->SQL_SELECT_ALL ();
				$aDomaine = new StatListDomaine ();
				$aDomaine->SQL_SELECT_ALL ();
				$aStat = new StatReponseRegion ();
				$aStat->SQL_SELECT_BY_REG ( isset ( $_GET ['m'] ) ? $_GET ['m'] : date ( 'm', $time ), isset ( $_GET ['a'] ) ? $_GET ['a'] : date ( 'Y', $time ) );
				$myaStat = $aStat->getList ();

				header ( 'Content-Type: application/csv-tab-delimited-table' );
				header ( 'Content-disposition: filename="Réponse par région et domaine ' . FunctionDate::getMois ( $_GET ['m'] ) . ' ' . $_GET ['a'] . '.csv"' );

				echo "Région ;";
				foreach ( $aDomaine->getList () as $aDA ) {
					echo $aDA->getnomdomaine () . ';';
				}
				echo "Total;";
				echo "\n";
				foreach ( $aRegion->getList () as $aRegion ) {
					if ($aRegion->getlibelle () == 'Toute la France') {
						$total_ligne = 0;
						echo $aRegion->getlibelle () . ';';
						foreach ( $aDomaine->getList () as $aDA ) {
							$aStatAll = new StatReponseRegion ();
							$data = $aStatAll->SQL_COUNT ( $aDA->getiddomaine (), isset ( $_GET ['m'] ) ? $_GET ['m'] : date ( 'm', $time ), isset ( $_GET ['a'] ) ? $_GET ['a'] : date ( 'Y', $time ) );
							echo $data . ';';
							$total_ligne += $data;
						}
						echo "\n";
					} else {
						$total_ligne = 0;
						echo $aRegion->getlibelle () . ';';
						foreach ( $aDomaine->getList () as $aDA ) {
							$aff = (array_key_exists ( $aRegion->getidregion () . '-' . $aDA->getiddomaine (), $myaStat ) ? $myaStat [$aRegion->getidregion () . '-' . $aDA->getiddomaine ()] : 0);
							echo $aff . ';';
							$total_ligne += $aff;
						}
						echo $total_ligne . ";";
						echo "\n";
					}
				}
				echo "Total;";
				$total = 0;
				foreach ( $aDomaine->getList () as $aDA ) {
					$aStatAll = new StatReponseRegion ();
					$data = $aStatAll->SQL_COUNT_TOT ( $aDA->getiddomaine (), isset ( $_GET ['m'] ) ? $_GET ['m'] : date ( 'm', $time ), isset ( $_GET ['a'] ) ? $_GET ['a'] : date ( 'Y', $time ) );
					echo $data . ';';
					$total += $data;
				}
				echo $total . ';';

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

				$aStat = new StatCVRegion ();
				$date_fin = explode ( '-', $aStat->SQL_SELECT_LAST_DATE () );

				header ( 'Content-Type: application/csv-tab-delimited-table' );
				header ( 'Content-disposition: filename=">Réponse par région et domaine .csv"' );

				while ( $annee >= $date_fin [0] ) {
					while ( $mois >= $date_fin [1] ) {

						$aRegion = new StatListRegion ();
						$aRegion->SQL_SELECT_ALL ();
						$aDomaine = new StatListDomaine ();
						$aDomaine->SQL_SELECT_ALL ();
						$aStat = new StatReponseRegion ();
						$aStat->SQL_SELECT_BY_REG ( $mois, $annee );
						$myaStat = $aStat->getList ();

						echo "\n ;";
						echo "\n";
						$aff = FunctionDate::getMois ( $mois ) . ' ;' . $annee;
						echo $aff;

						echo "\n \n Région ;;";

						foreach ( $aDomaine->getList () as $aDA ) {
							echo $aDA->getnomdomaine () . ';';
						}
						echo "\n";
						foreach ( $aRegion->getList () as $aRegion ) {
							if ($aRegion->getlibelle () == 'Toute la France') {
								$total_ligne = 0;
								echo $aRegion->getlibelle () . ';;';
								foreach ( $aDomaine->getList () as $aDA ) {
									$aStatAll = new StatReponseRegion ();
									$data = $aStatAll->SQL_COUNT ( $aDA->getiddomaine (), $mois, $annee );
									echo $data . ';';
									$total_ligne += $data;
								}
								echo "\n";
							} else {
								$total_ligne = 0;
								echo $aRegion->getlibelle () . ';;';
								foreach ( $aDomaine->getList () as $aDA ) {
									$aff = (array_key_exists ( $aRegion->getidregion () . '-' . $aDA->getiddomaine (), $myaStat ) ? $myaStat [$aRegion->getidregion () . '-' . $aDA->getiddomaine ()] : 0);
									echo $aff . ';';
									$total_ligne += $aff;
								}
								echo $total_ligne . ";";
								echo "\n";
							}
						}
						echo "Total;;";
						$total = 0;
						foreach ( $aDomaine->getList () as $aDA ) {
							$aStatAll = new StatReponseRegion ();
							$data = $aStatAll->SQL_COUNT_TOT ( $aDA->getiddomaine (), $mois, $annee );
							echo $data . ';';
							$total += $data;
						}
						echo $total . ';';

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