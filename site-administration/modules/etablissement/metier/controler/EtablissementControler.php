<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage etablissement
 * @version 1.0.4
 */
class EtablissementControler {
	function run() {
		switch ($_GET ['action']) {
			// Creer un User
			case 'new' :
			case 'c' :
				if (! isset ( $_POST ['RaisonSociale'] )) {
					$modele = new Etablissement ();
					$vue = new EtablissementView ( $modele );
					$vue->render ( 'c' );
				} else {
					$aEtablissement = new Etablissement ();
					$aEtablissement->setRaisonSociale ( stripslashes ( trim ( $_POST ['RaisonSociale'] ) ) );
					$aEtablissement->setAdresse1 ( stripslashes ( trim ( $_POST ['Adresse1'] ) ) );
					$aEtablissement->setAdresse2 ( stripslashes ( trim ( $_POST ['Adresse2'] ) ) );
					$aEtablissement->setBureauDistributeur ( stripslashes ( trim ( $_POST ['BureauDistributeur'] ) ) );
					$aEtablissement->setCodePostal ( stripslashes ( trim ( $_POST ['CodePostal'] ) ) );
					$aEtablissement->setVille ( stripslashes ( trim ( $_POST ['Ville'] ) ) );
					$aEtablissement->setPays ( stripslashes ( trim ( $_POST ['Pays'] ) ) );
					$aEtablissement->setTelephone ( stripslashes ( trim ( $_POST ['Telephone'] ) ) );
					$aEtablissement->setFax ( stripslashes ( trim ( $_POST ['Fax'] ) ) );
					$aEtablissement->setMail ( stripslashes ( trim ( $_POST ['Mail'] ) ) );
					$aEtablissement->setSiteWeb ( stripslashes ( trim ( $_POST ['SiteWeb'] ) ) );
					$aEtablissement->setSiret ( stripslashes ( trim ( $_POST ['Siret'] ) ) );
					$aEtablissement->setNumCompteVN ( stripslashes ( trim ( $_POST ['NumCompteVN'] ) ) );
					$aEtablissement->setNumCompteMPR ( stripslashes ( trim ( $_POST ['NumCompteMPR'] ) ) );
					$aEtablissement->setNumRRF ( stripslashes ( trim ( $_POST ['NumRRF'] ) ) );
					$aEtablissement->setContratVN ( stripslashes ( trim ( $_POST ['ContratVN'] ) ) );
					$aEtablissement->setEffectifs ( stripslashes ( trim ( $_POST ['Effectifs'] ) ) );
					$aEtablissement->setNbVar ( stripslashes ( trim ( $_POST ['NombreVAR'] ) ) );
					$aEtablissement->setNbAgentsTotal ( stripslashes ( trim ( $_POST ['NombreAgentsTotal'] ) ) );
					$aEtablissement->setLoginSage ( stripslashes ( trim ( $_POST ['LoginSage'] ) ) );
					// $aEtablissement->setPasswordSage(trim($_POST['PasswordSage']));
					$aEtablissement->setEnSommeil ( trim ( $_POST ['EnSommeil'] ) );
					$aEtablissement->setImportActif ( trim ( $_POST ['ImportActif'] ) );
					$aEtablissement->setAccesSiteEmploi ( trim ( $_POST ['AccesSiteEmploi'] ) );

					$aEtablissement->setAdhesionGCR ( trim ( $_POST ['Adhesion_GCR'] ) );
					$aEtablissement->setAdhesionCISCAR ( trim ( $_POST ['Adhesion_CISCAR'] ) );
					$aEtablissement->setAdhesionGCRImmo ( trim ( $_POST ['Adhesion_GCR_Immo'] ) );
					$aEtablissement->setAdhesionGCRSA ( trim ( $_POST ['Adhesion_GCR_SA'] ) );

					$aAnnuaire = new Annuaire ();
					$aAnnuaire->select_annuaire ( trim ( $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ) );
					$aEtablissement->setAnnuaire ( $aAnnuaire );

					$aMarque = new Marque ();
					$aMarque->select_marque ( trim ( $_POST ['Marque1ID'] ) );
					$aEtablissement->setMarque1 ( $aMarque );
					$aMarque = new Marque ();
					$aMarque->select_marque ( trim ( $_POST ['Marque2ID'] ) );
					$aEtablissement->setMarque2 ( $aMarque );
					$aMarque = new Marque ();
					$aMarque->select_marque ( trim ( $_POST ['Marque3ID'] ) );
					$aEtablissement->setMarque3 ( $aMarque );
					$aMarque = new Marque ();
					$aMarque->select_marque ( trim ( $_POST ['Marque4ID'] ) );
					$aEtablissement->setMarque4 ( $aMarque );
					$aMarque = new Marque ();
					$aMarque->select_marque ( trim ( $_POST ['Marque5ID'] ) );
					$aEtablissement->setMarque5 ( $aMarque );

					$aStatut = new StatutEtablissement ();
					$aStatut->select_statutetablissement ( trim ( $_POST ['StatutID'] ) );
					$aEtablissement->setStatut ( $aStatut );

					$aNature = new Nature ();
					$aNature->select_nature ( trim ( $_POST ['NatureID'] ) );
					$aEtablissement->setNature ( $aNature );

					$aTypologie = new Typologie ();
					$aTypologie->select_typologie ( trim ( $_POST ['TypologieID'] ) );
					$aEtablissement->setTypologie ( $aTypologie );

					$aRegion = new Region ();
					$aRegion->select_region ( trim ( $_POST ['RegionID'] ) );
					$aEtablissement->setRegion ( $aRegion );

					$aGroupe = new GroupeEtablissement ();
					$aGroupe->select_groupeetablissement ( trim ( $_POST ['GroupeEtablissementID'] ) );
					$aEtablissement->setGroupe ( $aGroupe );

					$aEtablissement->create_etablissement ();

					echo CommunFunction::goToURL ( ! isset ( $_GET ['url_return'] ) ? '?' : $_GET ['url_return'] );
				}
				break;
			case 'edit' :
			case 'u' :
				if (! isset ( $_POST ['EtablissementID'] )) {
					$modele = new Etablissement ();
					$modele->select_etablissement ( $_GET ['id'] );
					$vue = new EtablissementView ( $modele );
					$vue->render ( 'u' );
				} else {
					$aEtablissement = new Etablissement ();
					$aEtablissement->setID ( trim ( $_POST ['EtablissementID'] ) );
					$aEtablissement->setRaisonSociale ( stripslashes ( trim ( $_POST ['RaisonSociale'] ) ) );
					$aEtablissement->setAdresse1 ( stripslashes ( trim ( $_POST ['Adresse1'] ) ) );
					$aEtablissement->setAdresse2 ( stripslashes ( trim ( $_POST ['Adresse2'] ) ) );
					$aEtablissement->setBureauDistributeur ( stripslashes ( trim ( $_POST ['BureauDistributeur'] ) ) );
					$aEtablissement->setCodePostal ( stripslashes ( trim ( $_POST ['CodePostal'] ) ) );
					$aEtablissement->setVille ( stripslashes ( trim ( $_POST ['Ville'] ) ) );
					$aEtablissement->setPays ( stripslashes ( trim ( $_POST ['Pays'] ) ) );
					$aEtablissement->setTelephone ( stripslashes ( trim ( $_POST ['Telephone'] ) ) );
					$aEtablissement->setFax ( stripslashes ( trim ( $_POST ['Fax'] ) ) );
					$aEtablissement->setMail ( stripslashes ( trim ( $_POST ['Mail'] ) ) );
					$aEtablissement->setSiteWeb ( stripslashes ( trim ( $_POST ['SiteWeb'] ) ) );
					$aEtablissement->setSiret ( stripslashes ( trim ( $_POST ['Siret'] ) ) );
					$aEtablissement->setNumCompteVN ( stripslashes ( trim ( $_POST ['NumCompteVN'] ) ) );
					$aEtablissement->setNumCompteMPR ( stripslashes ( trim ( $_POST ['NumCompteMPR'] ) ) );
					$aEtablissement->setNumRRF ( stripslashes ( trim ( $_POST ['NumRRF'] ) ) );
					$aEtablissement->setContratVN ( stripslashes ( trim ( $_POST ['ContratVN'] ) ) );
					$aEtablissement->setEffectifs ( stripslashes ( trim ( $_POST ['Effectifs'] ) ) );
					$aEtablissement->setNbVar ( stripslashes ( trim ( $_POST ['NombreVAR'] ) ) );
					$aEtablissement->setNbAgentsTotal ( stripslashes ( trim ( $_POST ['NombreAgentsTotal'] ) ) );
					$aEtablissement->setLoginSage ( stripslashes ( trim ( $_POST ['LoginSage'] ) ) );
					// $aEtablissement->setPasswordSage(trim($_POST['PasswordSage']));
					$aEtablissement->setEnSommeil ( trim ( $_POST ['EnSommeil'] ) );
					$aEtablissement->setImportActif ( trim ( $_POST ['ImportActif'] ) );
					$aEtablissement->setAccesSiteEmploi ( trim ( $_POST ['AccesSiteEmploi'] ) );

					$aEtablissement->setAdhesionGCR ( trim ( $_POST ['Adhesion_GCR'] ) );
					$aEtablissement->setAdhesionCISCAR ( trim ( $_POST ['Adhesion_CISCAR'] ) );
					$aEtablissement->setAdhesionGCRImmo ( trim ( $_POST ['Adhesion_GCR_Immo'] ) );
					$aEtablissement->setAdhesionGCRSA ( trim ( $_POST ['Adhesion_GCR_SA'] ) );

					$aAnnuaire = new Annuaire ();
					$aAnnuaire->select_annuaire ( trim ( $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ) );
					$aEtablissement->setAnnuaire ( $aAnnuaire );

					$aMarque = new Marque ();
					$aMarque->select_marque ( trim ( $_POST ['Marque1ID'] ) );
					$aEtablissement->setMarque1 ( $aMarque );
					$aMarque = new Marque ();
					$aMarque->select_marque ( trim ( $_POST ['Marque2ID'] ) );
					$aEtablissement->setMarque2 ( $aMarque );
					$aMarque = new Marque ();
					$aMarque->select_marque ( trim ( $_POST ['Marque3ID'] ) );
					$aEtablissement->setMarque3 ( $aMarque );
					$aMarque = new Marque ();
					$aMarque->select_marque ( trim ( $_POST ['Marque4ID'] ) );
					$aEtablissement->setMarque4 ( $aMarque );
					$aMarque = new Marque ();
					$aMarque->select_marque ( trim ( $_POST ['Marque5ID'] ) );
					$aEtablissement->setMarque5 ( $aMarque );

					$aStatut = new StatutEtablissement ();
					$aStatut->select_statutetablissement ( trim ( $_POST ['StatutID'] ) );
					$aEtablissement->setStatut ( $aStatut );

					$aNature = new Nature ();
					$aNature->select_nature ( trim ( $_POST ['NatureID'] ) );
					$aEtablissement->setNature ( $aNature );

					$aTypologie = new Typologie ();
					$aTypologie->select_typologie ( trim ( $_POST ['TypologieID'] ) );
					$aEtablissement->setTypologie ( $aTypologie );

					$aRegion = new Region ();
					$aRegion->select_region ( trim ( $_POST ['RegionID'] ) );
					$aEtablissement->setRegion ( $aRegion );

					$aGroupe = new GroupeEtablissement ();
					$aGroupe->select_groupeetablissement ( trim ( $_POST ['GroupeEtablissementID'] ) );
					$aEtablissement->setGroupe ( $aGroupe );

					$aEtablissement->update_etablissement ();

					echo CommunFunction::goToURL ( ! isset ( $_GET ['url_return'] ) ? '?' : $_GET ['url_return'] );
				}
				break;
			case 'delete' :
			case 'd' :
				if (isset ( $_GET ['id'] )) {
					$aEtablissement = new Etablissement ();
					$aEtablissement->setID ( trim ( $_GET ['id'] ) );
					$aEtablissement->remove_etablissement ();

					echo CommunFunction::goToURL ( ! isset ( $_GET ['url_return'] ) ? '?' : $_GET ['url_return'] );
				}
				break;
			case 'm' :
				$modele = new IndividuListe ();
				if (isset ( $_GET ['page'] )) {
					$modele->select_all_individu_etablissement_paginer ( trim ( $_GET ['id'] ), ($_GET ['page'] + 1), 50, isset ( $_GET ['tri'] ) ? $_GET ['tri'] : '1', isset ( $_GET ['ordre'] ) ? $_GET ['ordre'] : 'd' );
				} else {
					$modele->select_all_individu_etablissement_paginer ( trim ( $_GET ['id'] ), 1, 50, isset ( $_GET ['tri'] ) ? $_GET ['tri'] : '1', isset ( $_GET ['ordre'] ) ? $_GET ['ordre'] : 'd' );
				}
				$vue = new IndividuListeViewEtablissement ( $modele );
				$vue->render ();
				break;
		}
	}
}
?>