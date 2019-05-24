<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage lva
 * @version 1.0.4
 */
class AnnuaireControler {
	function run() {
		switch ($_GET ['action']) {
			// Creer un User
			case 'c' :
				if (! isset ( $_POST ['Nom'] )) {
					$modele = new Annuaire ();
					$vue = new AnnuaireView ( $modele );
					$vue->render ( 'c' );
				} else {
					$aAnnuaire = new Annuaire ();
					$aAnnuaire->setName ( trim ( $_POST ['Nom'] ) );

					$aAnnuaire->create_annuaire ();

					$vue = new AnnuaireView ( NULL );
					$vue->redirection ( '?' );
				}
				break;
			case 'u' :
				if (! isset ( $_POST ['AnnuaireID'] )) {
					$modele = new Annuaire ();
					$modele->select_annuaire ( trim ( $_GET ['id'] ) );
					$vue = new AnnuaireView ( $modele );
					$vue->render ( 'u' );
				} else {
					$aAnnuaire = new Annuaire ();
					$aAnnuaire->setID ( trim ( $_POST ['AnnuaireID'] ) );
					$aAnnuaire->setName ( trim ( $_POST ['Nom'] ) );

					$aAnnuaire->update_annuaire ();

					$vue = new AnnuaireView ( NULL );
					$vue->redirection ( '?' );
				}
				break;
			case 'd' :
				if (! isset ( $_POST ['AnnuaireID'] )) {
					$modele = new Annuaire ();
					$modele->select_annuaire ( trim ( $_GET ['id'] ) );
					$vue = new AnnuaireView ( $modele );
					$vue->render ( 'd' );
				} else {
					$aAnnuaire = new Annuaire ();
					$aAnnuaire->setID ( trim ( $_POST ['AnnuaireID'] ) );
					$aAnnuaire->remove_annuaire ();

					$vue = new AnnuaireView ( NULL );
					$vue->redirection ( '?' );
				}
				break;
		}
	}
}
?>