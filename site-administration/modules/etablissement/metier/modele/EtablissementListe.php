<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage etablissement
 * @version 1.0.4
 */
class EtablissementListe {
	private $etablissementListe;

	function __construct()
	{
		$this->etablissementListe = array ();
	}
	function EtablissementListe() {
		self::__construct();
	}

	// #################
	function addEtablissement($aEtablissement) {
		$this->etablissementListe [] = $aEtablissement;
	}
	function removeEtablissement($i) {
		unset ( $this->etablissementListe [$i] );
	}
	function getEtablissementListe() {
		return $this->etablissementListe;
	}
	function setEtablissementListe($newValue) {
		$this->etablissementListe = $newValue;
	}
	function getNbEtablissement() {
		return count ( $this->etablissementListe );
	}

	// ###################
	function select_all_etablissement() {
		$result = mysqli_query ($_SESSION['LINK'], "SELECT EtablissementID, AnnuaireID, RaisonSociale, Adresse1, Adresse2, BureauDistributeur, CodePostal, Ville, Telephone, Fax, Mail, SiteWeb, NumCompteVN, NumCompteMPR, NumRRF, ContratVN, Effectifs, NbVar, NbAgentsTotal, LoginSage, PasswordSage, EnSommeil, ImportActif, Marque1_ID, StatutID, NatureID, TypologieID, RegionID, GroupeID, AccesSiteEmploi, Marque2_ID, Marque3_ID, Marque4_ID, Marque5_ID, Pays FROM annuaire_etablissement WHERE AnnuaireID='" . $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] . "'" ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aEtablissement = new Etablissement ();
			$aEtablissement->setID ( $line [0] );
			$aEtablissement->setRaisonSociale ( $line [2] );
			$aEtablissement->setAdresse1 ( $line [3] );
			$aEtablissement->setAdresse2 ( $line [4] );
			$aEtablissement->setBureauDistributeur ( $line [5] );
			$aEtablissement->setCodePostal ( $line [6] );
			$aEtablissement->setVille ( $line [7] );
			$aEtablissement->setPays ( $line [34] );
			$aEtablissement->setTelephone ( $line [8] );
			$aEtablissement->setFax ( $line [9] );
			$aEtablissement->setMail ( $line [10] );
			$aEtablissement->setSiteWeb ( $line [11] );
			$aEtablissement->setNumCompteVN ( $line [12] );
			$aEtablissement->setNumCompteMPR ( $line [13] );
			$aEtablissement->setNumRRF ( $line [14] );
			$aEtablissement->setContratVN ( $line [15] );
			$aEtablissement->setEffectifs ( $line [16] );
			$aEtablissement->setNbVar ( $line [17] );
			$aEtablissement->setNbAgentsTotal ( $line [18] );
			$aEtablissement->setLoginSage ( $line [19] );
			$aEtablissement->setPasswordSage ( $line [20] );
			$aEtablissement->setEnSommeil ( $line [21] );
			$aEtablissement->setImportActif ( $line [22] );
			$aEtablissement->setAccesSiteEmploi ( $line [29] );

			$aAnnuaire = new Annuaire ();
			$aAnnuaire->select_annuaire ( $line [1] );
			$aEtablissement->setAnnuaire ( $aAnnuaire );

			$aMarque = new Marque ();
			$aMarque->select_marque ( $line [23] );
			$aEtablissement->setMarque1 ( $aMarque );
			$aMarque = new Marque ();
			$aMarque->select_marque ( $line [30] );
			$aEtablissement->setMarque2 ( $aMarque );
			$aMarque = new Marque ();
			$aMarque->select_marque ( $line [31] );
			$aEtablissement->setMarque3 ( $aMarque );
			$aMarque = new Marque ();
			$aMarque->select_marque ( $line [32] );
			$aEtablissement->setMarque4 ( $aMarque );
			$aMarque = new Marque ();
			$aMarque->select_marque ( $line [33] );
			$aEtablissement->setMarque5 ( $aMarque );

			$aStatut = new StatutEtablissement ();
			$aStatut->select_statutetablissement ( $line [24] );
			$aEtablissement->setStatut ( $aStatut );

			$aNature = new Nature ();
			$aNature->select_nature ( $line [25] );
			$aEtablissement->setNature ( $aNature );

			$aTypologie = new Typologie ();
			$aTypologie->select_typologie ( $line [26] );
			$aEtablissement->setTypologie ( $aTypologie );

			$aRegion = new Region ();
			$aRegion->select_region ( $line [27] );
			$aEtablissement->setRegion ( $aRegion );

			$aGroupe = new GroupeEtablissement ();
			$aGroupe->select_groupeetablissement ( $line [28] );
			$aEtablissement->setGroupe ( $aGroupe );

			$this->etablissementListe [] = $aEtablissement;
		}

		mysqli_free_result  ( $result );
	}
	function select_all_etablissement_paginer($page, $pas) {
		$result = mysqli_query ($_SESSION['LINK'], "SELECT EtablissementID, AnnuaireID, RaisonSociale, Adresse1, Adresse2, BureauDistributeur, CodePostal, Ville, Telephone, Fax, Mail, SiteWeb, NumCompteVN, NumCompteMPR, NumRRF, ContratVN, Effectifs, NbVar, NbAgentsTotal, LoginSage, PasswordSage, EnSommeil, ImportActif, Marque1_ID, StatutID, TypologieID, RegionID, GroupeID,AccesSiteEmploi, Marque2_ID, Marque3_ID, Marque4_ID, Marque5_ID, Pays FROM annuaire_etablissement WHERE AnnuaireID='" . $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] . "' LIMIT " . (($page - 1) * $pas) . " , " . $pas . "" ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aEtablissement = new Etablissement ();
			$aEtablissement->setID ( $line [0] );
			$aEtablissement->setRaisonSociale ( $line [2] );
			$aEtablissement->setAdresse1 ( $line [3] );
			$aEtablissement->setAdresse2 ( $line [4] );
			$aEtablissement->setBureauDistributeur ( $line [5] );
			$aEtablissement->setCodePostal ( $line [6] );
			$aEtablissement->setVille ( $line [7] );
			$aEtablissement->setPays ( $line [33] );
			$aEtablissement->setTelephone ( $line [8] );
			$aEtablissement->setFax ( $line [9] );
			$aEtablissement->setMail ( $line [10] );
			$aEtablissement->setSiteWeb ( $line [11] );
			$aEtablissement->setNumCompteVN ( $line [12] );
			$aEtablissement->setNumCompteMPR ( $line [13] );
			$aEtablissement->setNumRRF ( $line [14] );
			$aEtablissement->setContratVN ( $line [15] );
			$aEtablissement->setEffectifs ( $line [16] );
			$aEtablissement->setNbVar ( $line [17] );
			$aEtablissement->setNbAgentsTotal ( $line [18] );
			$aEtablissement->setLoginSage ( $line [19] );
			$aEtablissement->setPasswordSage ( $line [20] );
			$aEtablissement->setEnSommeil ( $line [21] );
			$aEtablissement->setImportActif ( $line [22] );
			$aEtablissement->setAccesSiteEmploi ( $line [28] );

			$aAnnuaire = new Annuaire ();
			$aAnnuaire->select_annuaire ( $line [1] );
			$aEtablissement->setAnnuaire ( $aAnnuaire );

			$aMarque = new Marque ();
			$aMarque->select_marque ( $line [23] );
			$aEtablissement->setMarque1 ( $aMarque );
			$aMarque = new Marque ();
			$aMarque->select_marque ( $line [29] );
			$aEtablissement->setMarque2 ( $aMarque );
			$aMarque = new Marque ();
			$aMarque->select_marque ( $line [30] );
			$aEtablissement->setMarque3 ( $aMarque );
			$aMarque = new Marque ();
			$aMarque->select_marque ( $line [31] );
			$aEtablissement->setMarque4 ( $aMarque );
			$aMarque = new Marque ();
			$aMarque->select_marque ( $line [32] );
			$aEtablissement->setMarque5 ( $aMarque );

			$aStatut = new StatutEtablissement ();
			$aStatut->select_statutetablissement ( $line [24] );
			$aEtablissement->setStatut ( $aStatut );

			$aTypologie = new Typologie ();
			$aTypologie->select_typologie ( $line [25] );
			$aEtablissement->setTypologie ( $aTypologie );

			$aRegion = new Region ();
			$aRegion->select_region ( $line [26] );
			$aEtablissement->setRegion ( $aRegion );

			$aGroupe = new GroupeEtablissement ();
			$aGroupe->select_groupeetablissement ( $line [27] );
			$aEtablissement->setGroupe ( $aGroupe );

			$this->etablissementListe [] = $aEtablissement;
		}

		mysqli_free_result  ( $result );
	}

	// Liste des établissements rattachés à un individu, pour PRESTASHOP
	function select_all_etablissements_by_individu_id($individuID) {

		$sql = "SELECT ae.EtablissementID, RaisonSociale, Adresse1, Adresse2, BureauDistributeur, CodePostal, Ville, Pays,  ae.Telephone, ae.Fax, ae.Mail, SiteWeb, 
		NumRRF, ae.LoginSage, ae.PasswordSage, ae.EnSommeil, ae.ImportActif, Marque1_ID,
		case when (ai.LieuTravailID = ae.EtablissementID) then 1 else 0 end as principal
		FROM annuaire_etablissement ae, annuaire_role ar , annuaire_individu ai
		where ae.EtablissementID = ar.EtablissementID and ar.IndividuID = ai.IndividuID
		and ar.IndividuID = %s
		and ae.AnnuaireID = ar.AnnuaireID
		and ae.AnnuaireID = 1
		order by principal desc, ae.RaisonSociale";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $individuID ) );

		$result = mysqli_query ( $_SESSION['LINK'], $query ) or die ( mysqli_error () );

		while ( $line = mysqli_fetch_array ( $result ) ) {
			$aEtablissement = new Etablissement ();
			$aEtablissement->setID ( $line [0] );
			$aEtablissement->setRaisonSociale ( $line [1] );
			$aEtablissement->setAdresse1 ( $line [2] );
			$aEtablissement->setAdresse2 ( $line [3] );
			$aEtablissement->setBureauDistributeur ( $line [4] );
			$aEtablissement->setCodePostal ( $line [5] );
			$aEtablissement->setVille ( $line [6] );
			$aEtablissement->setPays ( $line [7] );
			$aEtablissement->setTelephone ( $line [8] );
			$aEtablissement->setFax ( $line [9] );
			$aEtablissement->setMail ( $line [10] );
			$aEtablissement->setSiteWeb ( $line [11] );
			$aEtablissement->setNumRRF ( $line [12] );
			$aEtablissement->setLoginSage ( $line [13] );
			$aEtablissement->setPasswordSage ( $line [14] );
			$aEtablissement->setEnSommeil ( $line [15] );
			$aEtablissement->setImportActif ( $line [16] );

			$this->etablissementListe [] = $aEtablissement;
		}

		mysqli_free_result ( $result );
	}
}

?>