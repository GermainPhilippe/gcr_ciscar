<?php
class FonctionDelegationControler {
	function run() {
		switch ($_GET ['action']) {
			// Creer un User
			case 'c' :
				if (! isset ( $_POST ['Nom'] )) {
					$modele = new FonctionDelegation ();
					$vue = new FonctionDelegationView ( $modele );
					$vue->render ( 'c' );
				} else {
					$aMarque = new FonctionDelegation ();
					$aMarque->setName ( trim ( $_POST ['Nom'] ) );

					$aAnnuaire = new Annuaire ();
					$aAnnuaire->select_annuaire ( trim ( $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ) );
					$aMarque->setAnnuaire ( $aAnnuaire );

					$aMarque->create_fonctiondelegation ();

					echo CommunFunction::goToURL ( '?' );
				}
				break;
			case 'u' :
				if (! isset ( $_POST ['Nom'] )) {
					$modele = new FonctionDelegation ();
					$modele->select_fonctiondelegation ( trim ( $_GET ['id'] ) );
					$vue = new FonctionDelegationView ( $modele );
					$vue->render ( 'u' );
				} else {
					$aMarque = new FonctionDelegation ();
					$aMarque->setID ( trim ( $_GET ['id'] ) );
					$aMarque->setName ( trim ( $_POST ['Nom'] ) );

					$aAnnuaire = new Annuaire ();
					$aAnnuaire->select_annuaire ( trim ( $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ) );
					$aMarque->setAnnuaire ( $aAnnuaire );

					$aMarque->update_fonctiondelegation ();

					echo CommunFunction::goToURL ( '?' );
				}
				break;
			case 'd' :
				if (isset ( $_GET ['id'] )) {
					$aMarque = new FonctionDelegation ();
					$aMarque->setID ( trim ( $_GET ['id'] ) );
					$aMarque->remove_fonctiondelegation ();

					echo CommunFunction::goToURL ( '?' );
				}
				break;
		}
	}
}
?>