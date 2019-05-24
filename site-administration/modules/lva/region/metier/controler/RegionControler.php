<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage lva
 * @version 1.0.4
 */
class RegionControler {
	function run() {
		if (isset ( $_GET ['annu'] ) && $_GET ['annu'] != '0')
			$annu = $_GET ['annu'];
		else
			$annu = 0;

		switch ($_GET ['action']) {
			// Creer un User
			case 'c' :
				if (! isset ( $_POST ['Nom'] )) {
					$modele = new Region ();

					$vue = new RegionView ( $modele );

					if ($annu != '0')
						$vue->render ( 'c', $annu );
					else
						$vue->render ( 'c', '0' );
				} else {
					$aRegion = new Region ();
					$aRegion->setName ( trim ( $_POST ['Nom'] ) );

					$aAnnuaire = new Annuaire ();

					// si region pour site emploi
					if ($annu != '0')
						$aAnnuaire->select_annuaire ( $annu );
					else
						$aAnnuaire->select_annuaire ( trim ( $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ) );

					$aRegion->setAnnuaire ( $aAnnuaire );

					// Recuperation de la liste des departements selectionnés
					$aDepartementListe = new DepartementListe ();
					$aDepartementListe->select_all_departement ();
					$aDepartementListeSeleted = new DepartementListe ();

					foreach ( $aDepartementListe->getDepartementListe () as $aDepartement ) {
						if (! empty ( $_POST ['dep_' . $aDepartement->getID ()] )) {
							$aDepartementListeSeleted->addDepartement ( $aDepartement );
						}
					}

					$aRegion->setDepartementListe ( $aDepartementListeSeleted );

					$aRegion->create_region ();

					echo CommunFunction::goToURL ( '?annu=' . $annu );
				}
				break;
			case 'u' :
				if (! isset ( $_POST ['Nom'] )) {
					$modele = new Region ();
					$modele->select_region ( trim ( $_GET ['id'] ) );
					$vue = new RegionView ( $modele );
					if ($annu != '0')
						$vue->render ( 'u', $annu );
					else
						$vue->render ( 'u', '0' );
				} else {
					$aRegion = new Region ();
					$aRegion->setID ( trim ( $_GET ['id'] ) );
					$aRegion->setName ( trim ( $_POST ['Nom'] ) );

					$aAnnuaire = new Annuaire ();
					// si region pour site emploi
					if ($annu != '0')
						$aAnnuaire->select_annuaire ( $annu );
					else
						$aAnnuaire->select_annuaire ( trim ( $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ) );
					$aRegion->setAnnuaire ( $aAnnuaire );

					// Recuperation de la liste des departements selectionnés
					$aDepartementListe = new DepartementListe ();
					$aDepartementListe->select_all_departement ();
					$aDepartementListeSeleted = new DepartementListe ();

					foreach ( $aDepartementListe->getDepartementListe () as $aDepartement ) {
						if (! empty ( $_POST ['dep_' . $aDepartement->getID ()] )) {
							$aDepartementListeSeleted->addDepartement ( $aDepartement );
						}
					}

					$aRegion->setDepartementListe ( $aDepartementListeSeleted );

					$aRegion->update_region ();

					echo CommunFunction::goToURL ( '?annu=' . $annu );
				}
				break;
			case 'd' :
				if (isset ( $_GET ['id'] )) {
					$aMarque = new Region ();
					$aMarque->setID ( $_GET ['id'] );
					$aMarque->remove_region ();

					echo CommunFunction::goToURL ( '?annu=' . $annu );
				}
				break;
		}
	}
}
?>