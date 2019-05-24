<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage lva
 * @version 1.0.4
 */
class MarqueControler {
	function run() {
		switch ($_GET ['action']) {
			// Creer un User
			case 'c' :
				if (! isset ( $_POST ['Nom'] )) {
					$modele = new Marque ();
					$vue = new MarqueView ( $modele );
					$vue->render ( 'c' );
				} else {
					$aMarque = new Marque ();
					$aMarque->setName ( trim ( $_POST ['Nom'] ) );

					$aAnnuaire = new Annuaire ();
					$aAnnuaire->select_annuaire ( trim ( $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ) );
					$aMarque->setAnnuaire ( $aAnnuaire );

					$aMarque->create_marque ();

					echo CommunFunction::goToURL ( '?' );
				}
				break;
			case 'u' :

				// if(!isset($_POST['MarqueID']))
				if (! isset ( $_POST ['Nom'] )) {
					$modele = new Marque ();
					$modele->select_marque ( trim ( $_GET ['id'] ) );
					$vue = new MarqueView ( $modele );
					$vue->render ( 'u' );
				} else {
					$aMarque = new Marque ();
					$aMarque->setID ( trim ( $_GET ['id'] ) );
					$aMarque->setName ( trim ( $_POST ['Nom'] ) );

					$aAnnuaire = new Annuaire ();
					$aAnnuaire->select_annuaire ( trim ( $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ) );
					$aMarque->setAnnuaire ( $aAnnuaire );

					$aMarque->update_marque ();

					echo CommunFunction::goToURL ( '?' );
				}
				break;
			case 'd' :
				if (isset ( $_GET ['id'] )) {
					$aMarque = new Marque ();
					$aMarque->setID ( $_GET ['id'] );
					$aMarque->remove_marque ();

					echo CommunFunction::goToURL ( '?' );
				}
				break;
		}
	}
}
?>