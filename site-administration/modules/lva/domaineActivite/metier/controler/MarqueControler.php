<?php
class DomaineActiviteControler {
	function run() {
		switch ($_GET ['action']) {
			// Creer un User
			case 'c' :
				if (! isset ( $_POST ['Nom'] )) {
					$modele = new DomaineActivite ();
					$vue = new DomaineActiviteView ( $modele );
					$vue->render ( 'c' );
				} else {
					$aMarque = new DomaineActivite ();
					$aMarque->setName ( trim ( $_POST ['Nom'] ) );
					$aMarque->setNumOrdre ( trim ( $_POST ['NumeroOrdre'] ) );

					$aAnnuaire = new Annuaire ();
					$aAnnuaire->select_annuaire ( trim ( $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ) );
					$aMarque->setAnnuaire ( $aAnnuaire );

					$aMarque->create_domaineactivite ();

					echo CommunFunction::goToURL ( '?' );
				}
				break;
			case 'u' :
				if (! isset ( $_POST ['Nom'] )) {
					$modele = new DomaineActivite ();
					$modele->select_domaineactivite ( trim ( $_GET ['id'] ) );
					$vue = new DomaineActiviteView ( $modele );
					$vue->render ( 'u' );
				} else {
					$aMarque = new DomaineActivite ();
					$aMarque->setID ( trim ( $_GET ['id'] ) );
					$aMarque->setName ( trim ( $_POST ['Nom'] ) );
					$aMarque->setNumOrdre ( $_POST ['NumeroOrdre'] );

					$aAnnuaire = new Annuaire ();
					$aAnnuaire->select_annuaire ( trim ( $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ) );
					$aMarque->setAnnuaire ( $aAnnuaire );

					$aMarque->update_domaineactivite ();

					echo CommunFunction::goToURL ( '?' );
				}
				break;
			case 'd' :
				if (isset ( $_GET ['id'] )) {
					$aMarque = new DomaineActivite ();
					$aMarque->setID ( $_GET ['id'] );
					$aMarque->remove_domaineactivite ();

					echo CommunFunction::goToURL ( '?' );
				}
				break;
		}
	}
}
?>