<?php
/**
 * Export du Nombre de consultations
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
				$time = time ();
				$aStat = new StatConsultDoc ();
				$aStat->SQL_CONSULT_GRAPH ( isset ( $_GET ['m'] ) ? $_GET ['m'] : date ( 'm', $time ), isset ( $_GET ['a'] ) ? $_GET ['a'] : date ( 'Y', $time ), $_GET ['site'], (isset ( $_GET ['type'] ) ? $_GET ['type'] : '3'), '' );
				header ( 'Content-Type:application/csv-tab-delimited-table' );
				header ( 'Content-disposition: filename="Nombre de consultations ' . $site . ' ' . FunctionDate::getMois ( $_GET ['m'] ) . ' ' . $_GET ['a'] . '.csv"' );

				if (isset ( $_GET ['type'] ) && $_GET ['type'] != '3') {
				} else {
					echo "Catégorie ;";
				}
				echo "Type ;";
				echo "Thème ;";
				echo "Métier ;";
				echo " Titre de la page ;";
				echo " Nombre de consultations ;";
				echo "\n";
				if ($aStat->getList () != NULL) {
					foreach ( $aStat->getList () as $aVerif ) {

						$aConsult = new StatConsultDoc ();
						if (isset ( $_GET ['type'] ) && $_GET ['type'] != '3') {
						} else {
							switch ($aVerif->getcategorie ()) {
								case '0' :
									echo 'DocInfoDyn';
									break;
								case '1' :
									echo 'DocStatic';
									break;
								case '2' :
									echo 'DocPartenaire';
									break;
							}
							echo ';';
						}
						echo $aVerif->gettype () . ';' . $aVerif->gettheme () . ';' . $aVerif->getmetier ();
						echo ";";
						echo $aVerif->gettitle ();
						echo ";";
						echo $aVerif->getconsult ();
						echo ";";
						echo "\n";
					}
				} else {
					echo "Aucune donnée;;;";
					echo "\n";
				}
				echo "\n";
				require ('../../../include/DbDeconnexion.php');
				break;

			/**
			 * Exporter toutes les données - Non utilisée dans la version courante
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
				header ( 'Content-disposition: filename="Nombre de consultations ' . $site . '.csv"' );
				while ( $annee >= $date_fin [0] ) {
					while ( $mois >= $date_fin [1] ) {
						$time = time ();
						$aStat = new StatConsultDoc ();
						$aStat->SQL_CONSULT_GRAPH ( $mois, $annee, $_GET ['site'], (isset ( $_GET ['type'] ) ? $_GET ['type'] : '3'), '' );
						$aff = FunctionDate::getMois ( $mois ) . '; ' . $annee . ';';
						echo $aff;
						echo "\n";
						echo "Catégorie ;;;";
						echo " Titre de la page ;;;";
						echo " Nombre de consultations ;";
						echo "\n";
						if ($aStat->getList () != NULL) {
							foreach ( $aStat->getList () as $aVerif ) {
								$aConsult = new StatConsultDoc ();
								echo $aConsult->SQL_SELECT_NAME ( $aVerif->gettype () ) . ' ' . $aConsult->SQL_SELECT_NAME ( $aVerif->gettheme () ) . ' ' . $aConsult->SQL_SELECT_NAME ( $aVerif->getmetier () );
								echo ";;;";
								echo $aVerif->gettitle ();
								echo ";;;;";
								echo $aVerif->getconsult ();
								echo ";;;;";
								echo "\n";
							}
						} else {
							echo "Aucune donnée;;;";
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