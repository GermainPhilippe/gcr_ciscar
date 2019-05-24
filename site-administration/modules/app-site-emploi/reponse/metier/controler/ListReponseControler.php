<?php
/**
 * Controleur permettant l'affichage de la liste des réponses avec la gestion du filtre et de la pagination
 * @author Alexandre Diallo
 * @package app-site-emploi
 * @subpackage reponse
 * @version 1.0.4
 */
class ListReponseControler {
	public function __construct() {
	}
	public function run() {

		// Avec Recherche
		if (isset ( $_POST ['recherche'] ) && $_POST ['recherche'] != NULL) {
			$NbEntre = 0;
			$aModele = new ListReponse ();
			$aModele->SQL_SELECT_ALL ( $_POST ['recherche'], isset ( $_GET ['tri'] ) ? $_GET ['tri'] : '1', isset ( $_GET ['ordre'] ) ? $_GET ['ordre'] : 'z' );
			// Element Max
			$NbEntre = $aModele->SQL_SEARCH_COUNT ( $_POST ['Recherche'] );
		} elseif (isset ( $_GET ['recherche'] ) && $_GET ['recherche'] != NULL) {
			$NbEntre = 0;
			$aModele = new ListReponse ();
			$aModele->SQL_SELECT_ALL ( $_GET ['recherche'], isset ( $_GET ['tri'] ) ? $_GET ['tri'] : '1', isset ( $_GET ['ordre'] ) ? $_GET ['ordre'] : 'z' );
			// Element Max
			$NbEntre = $aModele->SQL_SEARCH_COUNT ( $_GET ['Recherche'] );
		} // Sans Recherche
		else {
			$NbEntre = 0;
			$aModele = new ListReponse ();
			$aModele->SQL_SELECT_ALL ( '', isset ( $_GET ['tri'] ) ? $_GET ['tri'] : '1', isset ( $_GET ['ordre'] ) ? $_GET ['ordre'] : 'z' );
			// Element Max
			$NbEntre = $aModele->SQL_SEARCH_COUNT ( '' );
		}

		$aView = new ListeReponseView ( $aModele, $NbEntre );
		$aView->renderHTML ();
	}
}

?>