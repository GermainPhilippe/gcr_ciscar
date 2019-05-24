<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage export
 * @version 1.0.4
 */
class ExportControler implements DefaultControler {
	public function __construct() {
	}

	// ###
	public function run() {
		switch ($_GET ['action']) {
			case 'autologin':
				/*
				$aExportAutologin = new ExportAutologin();
				$aExportAutologin->SQL_SELECT_ALL();
				$aExportAutologinView = new ExportAutologinView($aExportAutologin->getList());
				$aExportAutologinView->renderHTML();
				*/
				header ( "Content-Type: application/csv-tab-delimited-table" );
				header ( "Content-disposition: filename=CISCAR_Contact_Template.csv" );
				readfile ( '/home/icom/file/CISCAR_Contact_Template.csv' );
				// readfile('C:\Users\pgermain\Desktop\CISCAR_Contact_Template.csv');
				break;
			case 'anomalie_etablissement' :

				// Avec Recherche
				if (isset ( $_POST ['Recherche'] ) && $_POST ['Recherche'] != NULL) {
					$NbEntre = 0;
					$aAnomalieEtablissement = new AnomalieEtablissement ();
					$aAnomalieEtablissement->SQL_SEARCH ( $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'], $_POST ['Recherche'], isset ( $_GET ['page'] ) ? $_GET ['page'] + 1 : 1, 50, isset ( $_GET ['tri'] ) ? $_GET ['tri'] : '2', isset ( $_GET ['ordre'] ) ? $_GET ['ordre'] : 'a' );
					// Element Max
					$NbEntre = $aAnomalieEtablissement->SQL_SEARCH_COUNT ( $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'], $_POST ['Recherche'] );
				} elseif (isset ( $_GET ['Recherche'] ) && $_GET ['Recherche'] != NULL) {
					$NbEntre = 0;
					$aAnomalieEtablissement = new AnomalieEtablissement ();
					$aAnomalieEtablissement->SQL_SEARCH ( $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'], $_GET ['Recherche'], isset ( $_GET ['page'] ) ? $_GET ['page'] + 1 : 1, 50, isset ( $_GET ['tri'] ) ? $_GET ['tri'] : '2', isset ( $_GET ['ordre'] ) ? $_GET ['ordre'] : 'a' );
					// Element Max
					$NbEntre = $aAnomalieEtablissement->SQL_SEARCH_COUNT ( $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'], $_GET ['Recherche'] );
				} // Sans Recherche
				else {
					$NbEntre = 0;
					$aAnomalieEtablissement = new AnomalieEtablissement ();
					$aAnomalieEtablissement->SQL_SEARCH ( $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'], '', isset ( $_GET ['page'] ) ? $_GET ['page'] + 1 : 1, 50, isset ( $_GET ['tri'] ) ? $_GET ['tri'] : '2', isset ( $_GET ['ordre'] ) ? $_GET ['ordre'] : 'a' );
					// Element Max
					$NbEntre = $aAnomalieEtablissement->SQL_COUNT ( $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] );
				}
				$aAnomalieEtablissementView = new AnomalieEtablissementView ( $aAnomalieEtablissement, $NbEntre );
				$aAnomalieEtablissementView->renderHTML ();
				break;

			case 'anomalie_individu' :

				// Avec Recherche
				if (isset ( $_POST ['Recherche'] ) && $_POST ['Recherche'] != NULL) {
					$NbEntre = 0;
					$aAnomalieIndividu = new AnomalieIndividu ();
					$aAnomalieIndividu->SQL_SEARCH ( $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'], $_POST ['Recherche'], isset ( $_GET ['page'] ) ? $_GET ['page'] + 1 : 1, 50, isset ( $_GET ['tri'] ) ? $_GET ['tri'] : '2', isset ( $_GET ['ordre'] ) ? $_GET ['ordre'] : 'a' );
					// Element Max
					$NbEntre = $aAnomalieIndividu->SQL_SEARCH_COUNT ( $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'], $_POST ['Recherche'] );
				} elseif (isset ( $_GET ['Recherche'] ) && $_GET ['Recherche'] != NULL) {
					$NbEntre = 0;
					$aAnomalieIndividu = new AnomalieIndividu ();
					$aAnomalieIndividu->SQL_SEARCH ( $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'], $_GET ['Recherche'], isset ( $_GET ['page'] ) ? $_GET ['page'] + 1 : 1, 50, isset ( $_GET ['tri'] ) ? $_GET ['tri'] : '2', isset ( $_GET ['ordre'] ) ? $_GET ['ordre'] : 'a' );
					// Element Max
					$NbEntre = $aAnomalieIndividu->SQL_SEARCH_COUNT ( $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'], $_GET ['Recherche'] );
				} // Sans Recherche
				else {
					$NbEntre = 0;
					$aAnomalieIndividu = new AnomalieIndividu ();
					$aAnomalieIndividu->SQL_SEARCH ( $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'], '', isset ( $_GET ['page'] ) ? $_GET ['page'] + 1 : 1, 50, isset ( $_GET ['tri'] ) ? $_GET ['tri'] : '2', isset ( $_GET ['ordre'] ) ? $_GET ['ordre'] : 'a' );
					// Element Max
					$NbEntre = $aAnomalieIndividu->SQL_COUNT ( $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] );
				}
				$aAnomalieIndividuView = new AnomalieIndividuView ( $aAnomalieIndividu, $NbEntre );
				$aAnomalieIndividuView->renderHTML ();
				break;
			case 'anomalie_Sageindividu' :

				// Avec Recherche
				if (isset ( $_POST ['Recherche'] ) && $_POST ['Recherche'] != NULL) {
					$NbEntre = 0;
					$aAnomalieIndividu = new AnomalieSageIndividu ();
					$aAnomalieIndividu->SQL_SEARCH ( $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'], $_POST ['Recherche'], isset ( $_GET ['page'] ) ? $_GET ['page'] + 1 : 1, 50, isset ( $_GET ['tri'] ) ? $_GET ['tri'] : '2', isset ( $_GET ['ordre'] ) ? $_GET ['ordre'] : 'a' );
					// Element Max
					$NbEntre = $aAnomalieIndividu->SQL_SEARCH_COUNT ( $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'], $_POST ['Recherche'] );
				} elseif (isset ( $_GET ['Recherche'] ) && $_GET ['Recherche'] != NULL) {
					$NbEntre = 0;
					$aAnomalieIndividu = new AnomalieSageIndividu ();
					$aAnomalieIndividu->SQL_SEARCH ( $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'], $_GET ['Recherche'], isset ( $_GET ['page'] ) ? $_GET ['page'] + 1 : 1, 50, isset ( $_GET ['tri'] ) ? $_GET ['tri'] : '2', isset ( $_GET ['ordre'] ) ? $_GET ['ordre'] : 'a' );
					// Element Max
					$NbEntre = $aAnomalieIndividu->SQL_SEARCH_COUNT ( $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'], $_GET ['Recherche'] );
				} // Sans Recherche
				else {
					$NbEntre = 0;
					$aAnomalieIndividu = new AnomalieSageIndividu ();
					$aAnomalieIndividu->SQL_SEARCH ( $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'], '', isset ( $_GET ['page'] ) ? $_GET ['page'] + 1 : 1, 50, isset ( $_GET ['tri'] ) ? $_GET ['tri'] : '2', isset ( $_GET ['ordre'] ) ? $_GET ['ordre'] : 'a' );
					// Element Max
					$NbEntre = $aAnomalieIndividu->SQL_COUNT ( $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] );
				}
				$aAnomalieIndividuView = new AnomalieSageIndividuView ( $aAnomalieIndividu, $NbEntre );
				$aAnomalieIndividuView->renderHTML ();
				break;

			case 'anomalie_role' :
				$aAnomalieRole = new AnomalieRole ();
				$aAnomalieRole->SQL_SELECT_BY_SITE ( $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] );
				$aAnomalieRoleView = new AnomalieRoleView ( $aAnomalieRole->getList () );
				$aAnomalieRoleView->renderHTML ();
				break;

			case 'sage_etablissement' :
				$aSageEtablissement = new SageEtablissement ();
				$aSageEtablissement->SQL_SELECT_BY_SITE ( $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] );
				$aSageEtablissementView = new SageEtablissementView ( $aSageEtablissement->getList () );
				$aSageEtablissementView->renderHTML ();
				break;

			case 'sage_individu' :
				$aSageIndividu = new SageIndividu ();
				$aSageIndividu->SQL_SELECT_BY_SITE ( $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] );
				$aSageIndividuView = new SageIndividuView ( $aSageIndividu->getList () );
				$aSageIndividuView->renderHTML ();
				break;

			case 'export_faf' :
				$aExportFaf = new ExportFaf ();
				// $aExportFaf->SQL_SELECT_BY_SITE($_SESSION['ADMIN']['USER']['AnnuaireID']);
				$aExportFaf->SQL_SELECT_NEW_ALL ();
				$aExportFafView = new ExportFafView ( $aExportFaf->getListIndividu (), $aExportFaf->getListEtablissement () );
				$aExportFafView->renderHTML ();
				break;
		}
	}
}
?>
