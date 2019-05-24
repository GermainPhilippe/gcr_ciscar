<?php
/**
 * Controleur du module statistiques
 * @author Alexandre DIALLO
 * @package site-administration
 * @subpackage statistiques
 * @version 1.0.4
 */
class StatistiquesControler {
	public function __construct() {
	}

	// ###

	/**
	 * $_GET['action']=?
	 * -'top' affiche les 20 documents les plus consultés par type et mois/année
	 * -'consult' affiche le nombre de consultations de chaque document par mois/année
	 * -'frequentation' affiche le nombre de frequentation par mois/année
	 * -'type' affiche le nombre de consultations de chaque type par mois/année
	 * -'domaine' affiche le nombre de consultations de chaque domaine par mois/année
	 * -'dr' affiche le nombre de consultations de chaque DR par mois/année
	 * -'SplitDRDoc' affiche dans la vue DR le nombre de consultations par domaine pour un DR donné par mois/année
	 * -'SplitDADoc' affiche dans la vue DR le nombre de consultations pour un domaine donnï¿½ et pour un DR donné par mois/année
	 */
	public function run() {
		switch ($_GET ['action']) {

			// 'top' affiche les 20 documents les plus consultés par type et mois/année
			case 'top' :

				$time = time ();
				$aStat = new StatConsultDoc ();
				$aStat->SQL_CONSULT_GRAPH ( isset ( $_GET ['m'] ) ? $_GET ['m'] : date ( 'm', $time ), isset ( $_GET ['a'] ) ? $_GET ['a'] : date ( 'Y', $time ), $_GET ['site'], (isset ( $_GET ['type'] ) ? $_GET ['type'] : '3'), 'top', '1' );
				$aView = new StatConsultTopDocView ( $aStat );
				$aView->renderHTML ();
				break;

			// 'consult' affiche le nombre de consultations de chaque document par mois/année
			case 'consult' :

				$time = time ();
				$aStat = new StatConsultDoc ();
				$aCount = $aStat->SQL_COUNT ( isset ( $_GET ['m'] ) ? $_GET ['m'] : date ( 'm', $time ), isset ( $_GET ['a'] ) ? $_GET ['a'] : date ( 'Y', $time ), $_GET ['site'], (isset ( $_GET ['type'] ) ? $_GET ['type'] : '3') );
				$aStat->SQL_SELECT_CONSULT_DOC ( isset ( $_GET ['m'] ) ? $_GET ['m'] : date ( 'm', $time ), isset ( $_GET ['a'] ) ? $_GET ['a'] : date ( 'Y', $time ), $_GET ['site'], (isset ( $_GET ['type'] ) ? $_GET ['type'] : '3'), '', (isset ( $_GET ['page'] ) ? $_GET ['page'] + 1 : 1) );
				$aView = new StatConsultDocView ( $aStat, $aCount );
				$aView->renderHTML ();

				break;

			// 'frequentation' affiche le nombre de frequentation par mois/année
			case 'frequentation' :

				$time = time ();
				$aModele = new Frequentation ();
				$aModele->SQL_SELECT_FREQUENTATION ( isset ( $_GET ['m'] ) ? $_GET ['m'] : date ( 'm', $time ), isset ( $_GET ['a'] ) ? $_GET ['a'] : date ( 'Y', $time ), $_GET ['site'] );
				$aView = new FrequentationView ( $aModele->getList () );
				$aView->renderHTML ();

				break;

			case 'frequentationIndividu' :

				$time = time ();
				$month = isset ( $_GET ['m'] ) ? $_GET ['m'] : date ( 'm', $time );
				$year = isset ( $_GET ['a'] ) ? $_GET ['a'] : date ( 'Y', $time );
				$user_id = isset ( $_GET ['user_id'] ) ? $_GET ['user_id'] : '';

				$dao = new FrequentationIndividu ();
				$list = $dao->findAllBySiteID ( $_GET ['site'], $month, $year, $user_id );

				$aView = new FrequentationIndividuView ( $list );
				$aView->renderHTML ();

				break;

			// 'type' affiche le nombre de consultations de chaque type par mois/année
			case 'type' :

				$time = time ();
				$aModele = new StatConsultType ();
				$aCount = $aModele->SQL_COUNT ( isset ( $_GET ['m'] ) ? $_GET ['m'] : date ( 'm', $time ), isset ( $_GET ['a'] ) ? $_GET ['a'] : date ( 'Y', $time ), $_GET ['site'], '0' );
				$aModele->SQL_SELECT_TYPE_DOC_GRAPH ( isset ( $_GET ['m'] ) ? $_GET ['m'] : date ( 'm', $time ), isset ( $_GET ['a'] ) ? $_GET ['a'] : date ( 'Y', $time ), $_GET ['site'] );
				$aCategorie = new CategorieDocInfoDynList ();
				$aCategorie->SQL_select_all_type ();
				$aView = new StatTypeDocView ( $aModele, $aCount, $aCategorie );
				$aView->renderHTML ();

				break;

			// 'domaine' affiche le nombre de consultations de chaque domaine par mois/année
			case 'domaine' :

				$time = time ();
				$aDomaine = new DomaineActiviteListe ();
				$aDomaine->select_all_domaineactivite_stat ( $_GET ['site'] == '7' ? '2' : $_GET ['site'] );
				$aModele = new StatConsultDomaine ();
				$aCount = $aModele->SQL_COUNT ( isset ( $_GET ['m'] ) ? $_GET ['m'] : date ( 'm', $time ), isset ( $_GET ['a'] ) ? $_GET ['a'] : date ( 'Y', $time ), $_GET ['site'], isset ( $_GET ['type'] ) ? $_GET ['type'] : '3' );
				$aModele->SQL_SELECT_DOMAINE ( isset ( $_GET ['m'] ) ? $_GET ['m'] : date ( 'm', $time ), isset ( $_GET ['a'] ) ? $_GET ['a'] : date ( 'Y', $time ), isset ( $_GET ['type'] ) ? $_GET ['type'] : '3', $_GET ['site'] );
				$aView = new StatConsultDomainView ( $aModele->getList (), $aCount, $aDomaine );
				$aView->renderHTML ();

				break;

			case 'dr' :

				// 'dr' affiche le nombre de consultations de chaque DR par mois/année
				$time = time ();
				$aModele = new StatConsultDR ();
				$aCount = $aModele->SQL_COUNT ( isset ( $_GET ['m'] ) ? $_GET ['m'] : date ( 'm', $time ), isset ( $_GET ['a'] ) ? $_GET ['a'] : date ( 'Y', $time ), $_GET ['site'], '0' );
				$aModele->SQL_SELECT_DR ( isset ( $_GET ['m'] ) ? $_GET ['m'] : date ( 'm', $time ), isset ( $_GET ['a'] ) ? $_GET ['a'] : date ( 'Y', $time ), $_GET ['site'] );
				$aRegion = new RegionListe ();
				$aRegion->select_all_region_stat ( $_GET ['site'] == 7 ? 2 : $_GET ['site'] );
				$aView = new StatConsultDRView ( $aModele, $aCount, $aRegion );
				$aView->renderHTML ();

				break;

			// 'SplitDRDoc' affiche le nombre de consultations par domaine pour un DR donné par mois/année
			case 'SplitDRDoc' :

				$time = time ();
				$aModele = new StatConsultDR ();
				$aCount = $aModele->SQL_COUNT ( isset ( $_GET ['m'] ) ? $_GET ['m'] : date ( 'm', $time ), isset ( $_GET ['a'] ) ? $_GET ['a'] : date ( 'Y', $time ), $_GET ['site'], '0' );
				$aModele->SQL_SELECT_DOMAINE_DR ( $_GET ['m'], $_GET ['a'], '0', $_GET ['site'], $_GET ['id'] );
				$aView = new SplitDRDocView ( $aModele->getList (), $aCount, $_GET ['id'] );
				$aView->renderdomaine ();
				break;

			case 'SplitDADoc' :

				// 'SplitDADoc' affiche le nombre de consultations pour un domaine donné et pour un DR donné par mois/année

				$time = time ();
				$aModele = new StatConsultDR ();
				$aCount = $aModele->SQL_COUNT ( isset ( $_GET ['m'] ) ? $_GET ['m'] : date ( 'm', $time ), isset ( $_GET ['a'] ) ? $_GET ['a'] : date ( 'Y', $time ), $_GET ['site'], '0' );
				$aModele->SQL_SELECT_DOMAINE_DR_DOC ( $_GET ['m'], $_GET ['a'], '0', $_GET ['site'], $_GET ['id'] );
				$aView = new SplitDRDADocView ( $aModele->getList (), $aCount, $_GET ['id'] );
				$aView->renderdomaine ();
				break;
		}
	}
}
?>
