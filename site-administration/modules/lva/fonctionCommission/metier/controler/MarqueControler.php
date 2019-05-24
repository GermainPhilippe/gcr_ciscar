<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage lva
 * @version 1.0.4
 */
class FonctionCommissionControler {
	function run() {
		switch ($_GET ['action']) {
			// Creer un User
			case 'c' :
				if (! isset ( $_POST ['Nom'] )) {
					$modele = new FonctionCommission ();
					$vue = new FonctionCommissionView ( $modele );
					$vue->render ( 'c' );
				} else {
					$aMarque = new FonctionCommission ();
					$aMarque->setName ( trim ( $_POST ['Nom'] ) );

					$aAnnuaire = new Annuaire ();
					$aAnnuaire->select_annuaire ( trim ( $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ) );
					$aMarque->setAnnuaire ( $aAnnuaire );

					$aMarque->create_fonctioncommission ();

					echo CommunFunction::goToURL ( '?' );
				}
				break;
			case 'u' :
				if (! isset ( $_POST ['Nom'] )) {
					$modele = new FonctionCommission ();
					$modele->select_fonctioncommission ( trim ( $_GET ['id'] ) );
					$vue = new FonctionCommissionView ( $modele );
					$vue->render ( 'u' );
				} else {
					$aMarque = new FonctionCommission ();
					$aMarque->setID ( trim ( $_GET ['id'] ) );
					$aMarque->setName ( trim ( $_POST ['Nom'] ) );

					$aAnnuaire = new Annuaire ();
					$aAnnuaire->select_annuaire ( trim ( $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ) );
					$aMarque->setAnnuaire ( $aAnnuaire );

					$aMarque->update_fonctioncommission ();

					echo CommunFunction::goToURL ( '?' );
				}
				break;
			case 'd' :
				if (isset ( $_GET ['id'] )) {
					$aMarque = new FonctionCommission ();
					$aMarque->setID ( $_GET ['id'] );
					$aMarque->remove_fonctioncommission ();

					echo CommunFunction::goToURL ( '?' );
				}
				break;
		}
	}
}
?>