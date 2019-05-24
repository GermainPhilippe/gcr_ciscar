<?php
class StatutEtablissementControler {
	function run() {
		switch ($_GET ['action']) {
			// Creer un User
			case 'c' :
				if (! isset ( $_POST ['Nom'] )) {
					$modele = new StatutEtablissement ();
					$vue = new StatutEtablissementView ( $modele );
					$vue->render ( 'c' );
				} else {
					$aStatutEtablissement = new StatutEtablissement ();
					$aStatutEtablissement->setName ( trim ( $_POST ['Nom'] ) );

					$aAnnuaire = new Annuaire ();
					$aAnnuaire->select_annuaire ( trim ( $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ) );
					$aStatutEtablissement->setAnnuaire ( $aAnnuaire );

					$aStatutEtablissement->create_statutetablissement ();

					echo CommunFunction::goToURL ( '?' );
				}
				break;
			case 'u' :
				if (! isset ( $_POST ['Nom'] )) {
					$modele = new StatutEtablissement ();
					$modele->select_statutetablissement ( trim ( $_GET ['id'] ) );
					$vue = new StatutEtablissementView ( $modele );
					$vue->render ( 'u' );
				} else {
					$aStatutEtablissement = new StatutEtablissement ();
					$aStatutEtablissement->setID ( trim ( $_GET ['id'] ) );
					$aStatutEtablissement->setName ( trim ( $_POST ['Nom'] ) );

					$aAnnuaire = new Annuaire ();
					$aAnnuaire->select_annuaire ( trim ( $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ) );
					$aStatutEtablissement->setAnnuaire ( $aAnnuaire );

					$aStatutEtablissement->update_statutetablissement ();

					echo CommunFunction::goToURL ( '?' );
				}
				break;
			case 'd' :
				if (isset ( $_GET ['id'] )) {
					$aStatutEtablissement = new StatutEtablissement ();
					$aStatutEtablissement->setID ( $_GET ['id'] );
					$aStatutEtablissement->remove_statutetablissement ();

					echo CommunFunction::goToURL ( '?' );
				}
				break;
		}
	}
}
?>