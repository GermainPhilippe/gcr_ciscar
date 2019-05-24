<?php
class FonctionBNControler {
	function run() {
		switch ($_GET ['action']) {
			// Creer un User
			case 'c' :
				if (! isset ( $_POST ['Nom'] )) {
					$modele = new FonctionBN ();
					$vue = new FonctionBNView ( $modele );
					$vue->render ( 'c' );
				} else {
					$aFonctionBN = new FonctionBN ();
					$aFonctionBN->setName ( trim ( $_POST ['Nom'] ) );
					$aFonctionBN->setNumeroOrdre ( trim ( $_POST ['NumeroOrdre'] ) );

					$aAnnuaire = new Annuaire ();
					$aAnnuaire->select_annuaire ( trim ( $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ) );
					$aFonctionBN->setAnnuaire ( $aAnnuaire );

					$aFonctionBN->create_fonctionbn ();

					echo CommunFunction::goToURL ( '?' );
				}
				break;
			case 'u' :
				if (! isset ( $_POST ['Nom'] )) {
					$modele = new FonctionBN ();
					$modele->select_fonctionbn ( trim ( $_GET ['id'] ) );
					$vue = new FonctionBNView ( $modele );
					$vue->render ( 'u' );
				} else {
					$aFonctionBN = new FonctionBN ();
					$aFonctionBN->setID ( trim ( $_GET ['id'] ) );
					$aFonctionBN->setName ( trim ( $_POST ['Nom'] ) );
					$aFonctionBN->setNumeroOrdre ( trim ( $_POST ['NumeroOrdre'] ) );

					$aAnnuaire = new Annuaire ();
					$aAnnuaire->select_annuaire ( trim ( $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ) );
					$aFonctionBN->setAnnuaire ( $aAnnuaire );

					$aFonctionBN->update_fonctionbn ();

					echo CommunFunction::goToURL ( '?' );
				}
				break;
			case 'd' :
				if (isset ( $_GET ['id'] )) {
					$aFonctionBN = new FonctionBN ();
					$aFonctionBN->setID ( $_GET ['id'] );
					$aFonctionBN->remove_fonctionbn ();

					echo CommunFunction::goToURL ( '?' );
				}
				break;
		}
	}
}
?>