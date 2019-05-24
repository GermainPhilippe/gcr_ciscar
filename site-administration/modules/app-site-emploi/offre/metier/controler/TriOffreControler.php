<?php
/**
 * Controleur permettant l'affichage de la liste des CV avec la gestion du filtre et de la pagination
 * @author Alexandre Diallo
 * @package app-site-emploi
 * @subpackage offre
 * @version 1.0.4
 */
class TriOffreControler {
	public function __construct() {
	}
	/**
	 * Affichage de la liste avec une nouvelle recherche, une recherche prédemment enregistré ou une recherche vide
	 */
	public function run() {

		// Avec Recherche
		if (isset ( $_POST ['Recherche'] ) && $_POST ['Recherche'] != NULL) {
			$NbEntre = 0;
			$aModele = new ListOffre ();
			$aModele->SQL_SEARCH ( $_POST ['Recherche'], isset ( $_GET ['page'] ) ? $_GET ['page'] + 1 : 1, 50, isset ( $_GET ['tri'] ) ? $_GET ['tri'] : '1', isset ( $_GET ['ordre'] ) ? $_GET ['ordre'] : 'd' );
			// Element Max
			$NbEntre = $aModele->SQL_SEARCH_COUNT ( $_POST ['Recherche'] );
		} elseif (isset ( $_GET ['Recherche'] ) && $_GET ['Recherche'] != NULL) {
			$NbEntre = 0;
			$aModele = new ListOffre ();
			$aModele->SQL_SEARCH ( $_GET ['Recherche'], isset ( $_GET ['page'] ) ? $_GET ['page'] + 1 : 1, 50, isset ( $_GET ['tri'] ) ? $_GET ['tri'] : '1', isset ( $_GET ['ordre'] ) ? $_GET ['ordre'] : 'd' );
			// Element Max
			$NbEntre = $aModele->SQL_SEARCH_COUNT ( $_GET ['Recherche'] );
		} // Sans Recherche
		else {
			$NbEntre = 0;
			$aModele = new ListOffre ();
			$aModele->SQL_SEARCH ( '', isset ( $_GET ['page'] ) ? $_GET ['page'] + 1 : 1, 50, isset ( $_GET ['tri'] ) ? $_GET ['tri'] : '1', isset ( $_GET ['ordre'] ) ? $_GET ['ordre'] : 'd' );
			// Element Max
			$NbEntre = $aModele->SQL_COUNT ();
		}
		$aView = new ListOffreDefautView ( $aModele, $NbEntre );
		$aView->renderHTML ();
	}
}