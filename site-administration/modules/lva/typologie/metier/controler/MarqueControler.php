<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage lva
 * @version 1.0.4
 */
class TypologieControler {
	function run() {
		switch ($_GET ['action']) {
			// Creer un User
			case 'c' :
				if (! isset ( $_POST ['Nom'] )) {
					$modele = new Typologie ();
					$vue = new TypologieView ( $modele );
					$vue->render ( 'c' );
				} else {
					$aTypologie = new Typologie ();
					$aTypologie->setName ( trim ( $_POST ['Nom'] ) );

					$aAnnuaire = new Annuaire ();
					$aAnnuaire->select_annuaire ( trim ( $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ) );
					$aTypologie->setAnnuaire ( $aAnnuaire );

					$aTypologie->create_typologie ();

					echo CommunFunction::goToURL ( '?' );
				}
				break;
			case 'u' :
				if (! isset ( $_POST ['Nom'] )) {
					$modele = new Typologie ();
					$modele->select_typologie ( trim ( $_GET ['id'] ) );
					$vue = new TypologieView ( $modele );
					$vue->render ( 'u' );
				} else {
					$aTypologie = new Typologie ();
					$aTypologie->setID ( trim ( $_GET ['id'] ) );
					$aTypologie->setName ( trim ( $_POST ['Nom'] ) );

					$aAnnuaire = new Annuaire ();
					$aAnnuaire->select_annuaire ( trim ( $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ) );
					$aTypologie->setAnnuaire ( $aAnnuaire );

					$aTypologie->update_typologie ();

					echo CommunFunction::goToURL ( '?' );
				}
				break;
			case 'd' :
				if (isset ( $_GET ['id'] )) {
					$aTypologie = new Typologie ();
					$aTypologie->setID ( $_GET ['id'] );
					$aTypologie->remove_typologie ();

					echo CommunFunction::goToURL ( '?' );
				}
				break;
		}
	}
}
?>