<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage lva
 * @version 1.0.4
 */
class NatureControler {
	function run() {
		switch ($_GET ['action']) {
			// Creer un User
			case 'c' :
				if (! isset ( $_POST ['Nom'] )) {
					$modele = new Nature ();
					$vue = new NatureView ( $modele );
					$vue->render ( 'c' );
				} else {
					$aNature = new Nature ();
					$aNature->setName ( trim ( $_POST ['Nom'] ) );

					$aAnnuaire = new Annuaire ();
					$aAnnuaire->select_annuaire ( trim ( $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ) );
					$aNature->setAnnuaire ( $aAnnuaire );

					$aNature->create_Nature ();

					echo CommunFunction::goToURL ( '?' );
				}
				break;
			case 'u' :
				if (! isset ( $_POST ['Nom'] )) {
					$modele = new Nature ();
					$modele->select_Nature ( trim ( $_GET ['id'] ) );
					$vue = new NatureView ( $modele );
					$vue->render ( 'u' );
				} else {
					$aNature = new Nature ();
					$aNature->setID ( trim ( $_GET ['id'] ) );
					$aNature->setName ( trim ( $_POST ['Nom'] ) );

					$aAnnuaire = new Annuaire ();
					$aAnnuaire->select_annuaire ( trim ( $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ) );
					$aNature->setAnnuaire ( $aAnnuaire );

					$aNature->update_Nature ();

					echo CommunFunction::goToURL ( '?' );
				}
				break;
			case 'd' :
				if (isset ( $_GET ['id'] )) {
					$aNature = new Nature ();
					$aNature->setID ( $_GET ['id'] );
					$aNature->remove_Nature ();

					echo CommunFunction::goToURL ( '?' );
				}
				break;
		}
	}
}
?>