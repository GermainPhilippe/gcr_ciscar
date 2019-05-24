<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage lva
 * @version 1.0.4
 */
class GroupeEtablissementControler {
	function run() {
		switch ($_GET ['action']) {
			// Creer un User
			case 'c' :
				if (! isset ( $_POST ['Nom'] )) {
					$modele = new GroupeEtablissement ();
					$vue = new GroupeEtablissementView ( $modele );
					$vue->render ( 'c' );
				} else {
					$aGroupeEtablissement = new GroupeEtablissement ();
					$aGroupeEtablissement->setName ( trim ( $_POST ['Nom'] ) );

					$aAnnuaire = new Annuaire ();
					$aAnnuaire->select_annuaire ( trim ( $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ) );
					$aGroupeEtablissement->setAnnuaire ( $aAnnuaire );

					$aGroupeEtablissement->create_groupeetablissement ();

					echo CommunFunction::goToURL ( '?' );
				}
				break;
			case 'u' :
				if (! isset ( $_POST ['Nom'] )) {
					$modele = new GroupeEtablissement ();
					$modele->select_groupeetablissement ( trim ( $_GET ['id'] ) );
					$vue = new GroupeEtablissementView ( $modele );
					$vue->render ( 'u' );
				} else {
					$aGroupeEtablissement = new GroupeEtablissement ();
					$aGroupeEtablissement->setID ( trim ( $_GET ['id'] ) );
					$aGroupeEtablissement->setName ( trim ( $_POST ['Nom'] ) );

					$aAnnuaire = new Annuaire ();
					$aAnnuaire->select_annuaire ( trim ( $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ) );
					$aGroupeEtablissement->setAnnuaire ( $aAnnuaire );

					$aGroupeEtablissement->update_groupeetablissement ();

					echo CommunFunction::goToURL ( '?' );
				}
				break;
			case 'd' :
				if (isset ( $_GET ['id'] )) {
					$aGroupeEtablissement = new GroupeEtablissement ();
					$aGroupeEtablissement->setID ( $_GET ['id'] );
					$aGroupeEtablissement->remove_groupeetablissement ();

					echo CommunFunction::goToURL ( '?' );
				}
				break;
		}
	}
}
?>