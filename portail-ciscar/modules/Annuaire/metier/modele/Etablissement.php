<?php
/**
 * @author Florent DESPIERRES
 * @package portail-gcr
 * @subpackage annuaire
 * @version 1.0.4
 */
class Etablissement {
	private $ID;
	private $AnnuaireID;
	private $RaisonSociale;
	private $Adresse1;
	private $Adresse2;
	private $BureauDistributeur;
	private $CodePostal;
	private $Ville;
	private $Telephone;
	private $Fax;
	private $Mail;
	private $NumRRF;
	private $ContratVN;
	private $Effectifs;
	private $NbVar;
	private $NbAgentsTotal;
	private $LoginSage;
	private $EnSommeil;
	private $StatutID;
	private $NatureID;
	private $TypologieID;
	private $RegionID;
	private $GroupeID;
	private $AccesSiteEmploi;
	public function __construct() {
		$this->ID = NULL;
		$this->AnnuaireID = NULL;
		$this->RaisonSociale = '';
		$this->Adresse1 = '';
		$this->Adresse2 = '';
		$this->BureauDistributeur = '';
		$this->CodePostal = '';
		$this->Ville = '';
		$this->Telephone = '';
		$this->Fax = '';
		$this->Mail = '';
		$this->NumRRF = '';
		$this->ContratVN = '';
		$this->Effectifs = '';
		$this->NbVar = '';
		$this->NbAgentsTotal = '';
		$this->LoginSage = '';
		$this->EnSommeil = 0;
		$this->StatutID = NULL;
		$this->NatureID = NULL;
		$this->TypologieID = NULL;
		$this->RegionID = NULL;
		$this->GroupeID = NULL;
		$this->AccesSiteEmploi = 0;
	}
	
	// ###
	public function getID() {
		return $this->ID;
	}
	public function getAnnuaireID() {
		return $this->AnnuaireID;
	}
	public function getRaisonSociale() {
		return $this->RaisonSociale;
	}
	public function getAdresse1() {
		return $this->Adresse1;
	}
	public function getAdresse2() {
		return $this->Adresse2;
	}
	public function getBureauDistributeur() {
		return $this->BureauDistributeur;
	}
	public function getCodePostal() {
		return $this->CodePostal;
	}
	public function getVille() {
		return $this->Ville;
	}
	public function getTelephone() {
		return $this->Telephone;
	}
	public function getFax() {
		return $this->Fax;
	}
	public function getMail() {
		return $this->Mail;
	}
	public function getNumRRF() {
		return $this->NumRRF;
	}
	public function getContratVN() {
		return $this->ContratVN;
	}
	public function getEffectifs() {
		return $this->Effectifs;
	}
	public function getNbVar() {
		return $this->NbVar;
	}
	public function getNbAgentsTotal() {
		return $this->NbAgentsTotal;
	}
	public function getLoginSage() {
		return $this->LoginSage;
	}
	public function getEnSommeil() {
		return $this->EnSommeil;
	}
	public function getStatutID() {
		return $this->StatutID;
	}
	public function getNatureID() {
		return $this->NatureID;
	}
	public function getTypologieID() {
		return $this->TypologieID;
	}
	public function getRegionID() {
		return $this->RegionID;
	}
	public function getGroupeID() {
		return $this->GroupeID;
	}
	public function getAccesSiteEmploi() {
		return $this->AccesSiteEmploi;
	}
	
	// ###
	public function setID($newValue) {
		$this->ID = $newValue;
	}
	public function setAnnuaireID($newValue) {
		$this->AnnuaireID = $newValue;
	}
	public function setRaisonSociale($newValue) {
		$this->RaisonSociale = $newValue;
	}
	public function setAdresse1($newValue) {
		$this->Adresse1 = $newValue;
	}
	public function setAdresse2($newValue) {
		$this->Adresse2 = $newValue;
	}
	public function setBureauDistributeur($newValue) {
		$this->BureauDistributeur = $newValue;
	}
	public function setCodePostal($newValue) {
		$this->CodePostal = $newValue;
	}
	public function setVille($newValue) {
		$this->Ville = $newValue;
	}
	public function setTelephone($newValue) {
		$this->Telephone = $newValue;
	}
	public function setFax($newValue) {
		$this->Fax = $newValue;
	}
	public function setMail($newValue) {
		$this->Mail = $newValue;
	}
	public function setNumRRF($newValue) {
		$this->NumRRF = $newValue;
	}
	public function setContratVN($newValue) {
		$this->ContratVN = $newValue;
	}
	public function setEffectifs($newValue) {
		$this->Effectifs = $newValue;
	}
	public function setNbVar($newValue) {
		$this->NbVar = $newValue;
	}
	public function setNbAgentsTotal($newValue) {
		$this->NbAgentsTotal = $newValue;
	}
	public function setLoginSage($newValue) {
		$this->LoginSage = $newValue;
	}
	public function setEnSommeil($newValue) {
		$this->EnSommeil = $newValue;
	}
	public function setStatutID($newValue) {
		$this->StatutID = $newValue;
	}
	public function setNatureID($newValue) {
		$this->NatureID = $newValue;
	}
	public function setTypologieID($newValue) {
		$this->TypologieID = $newValue;
	}
	public function setRegionID($newValue) {
		$this->RegionID = $newValue;
	}
	public function setGroupeID($newValue) {
		$this->GroupeID = $newValue;
	}
	public function setAccesSiteEmploi($newValue) {
		$this->AccesSiteEmploi = $newValue;
	}
	
	// ###
	public function SQL_SEARCH($Ville, $RaisonSociale, $Departement, $Groupe, $Region, $Statut) {
		$aList = array ();
		
		// Restriction sur le site
		$query = sprintf ( "SELECT EtablissementID,AnnuaireID,RaisonSociale,Adresse1,Adresse2,BureauDistributeur,CodePostal,Ville,Telephone,Fax,Mail,NumRRF,ContratVN,Effectifs,NbVar,NbAgentsTotal,LoginSage,EnSommeil,StatutID,NatureID,TypologieID,RegionID,GroupeID,AccesSiteEmploi FROM annuaire_etablissement WHERE AnnuaireID='%s' AND EnSommeil='0'", mysqli_real_escape_string ($_SESSION['LINK'] , $_SESSION ['SITE'] ['ID'] ) );
		
		if (! empty ( $Ville )) {
			$query = $query . sprintf ( " AND Ville LIKE '%s' ", '%' . mysqli_real_escape_string ($_SESSION['LINK'] , trim ( $Ville ) . '%' ) );
		}
		
		if (! empty ( $RaisonSociale )) {
			$query = $query . sprintf ( " AND RaisonSociale LIKE '%s' ", '%' . mysqli_real_escape_string ($_SESSION['LINK'] , trim ( $RaisonSociale ) . '%' ) );
		}
		
		if ($Departement != '0') {
			$query = $query . sprintf ( " AND LEFT(CodePostal,2)='%s'", mysqli_real_escape_string ($_SESSION['LINK'] , trim ( $Departement ) ) );
		}
		
		if ($Groupe != '0') {
			$query = $query . sprintf ( " AND GroupeID='%s'", mysqli_real_escape_string ($_SESSION['LINK'] , trim ( $Groupe ) ) );
		}
		
		if ($Region != '0') {
			$query = $query . sprintf ( " AND RegionID='%s'", mysqli_real_escape_string ($_SESSION['LINK'] , trim ( $Region ) ) );
		}
		
		if ($Statut != '0') {
			$query = $query . sprintf ( " AND StatutID='%s'", mysqli_real_escape_string ($_SESSION['LINK'] , trim ( $Statut ) ) );
		}
		
		$query .= " ORDER BY RaisonSociale ASC";
		$result = mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
		while ( $line = mysqli_fetch_array ( $result ) ) {
			$aModele = new Etablissement ();
			$aModele->setID ( $line [0] );
			$aModele->setAnnuaireID ( $line [1] );
			$aModele->setRaisonSociale ( $line [2] );
			$aModele->setAdresse1 ( $line [3] );
			$aModele->setAdresse2 ( $line [4] );
			$aModele->setBureauDistributeur ( $line [5] );
			$aModele->setCodePostal ( $line [6] );
			$aModele->setVille ( $line [7] );
			$aModele->setTelephone ( $line [8] );
			$aModele->setFax ( $line [9] );
			$aModele->setMail ( $line [10] );
			$aModele->setNumRRF ( $line [11] );
			$aModele->setContratVN ( $line [12] );
			$aModele->setEffectifs ( $line [13] );
			$aModele->setNbVar ( $line [14] );
			$aModele->setNbAgentsTotal ( $line [15] );
			$aModele->setLoginSage ( $line [16] );
			$aModele->setEnSommeil ( $line [17] );
			$aModele->setStatutID ( $line [18] );
			$aModele->setNatureID ( $line [19] );
			$aModele->setTypologieID ( $line [20] );
			$aModele->setRegionID ( $line [21] );
			$aModele->setGroupeID ( $line [22] );
			$aModele->setAccesSiteEmploi ( $line [23] );
			$aList [] = $aModele;
		}
		mysqli_free_result ( $result );
		
		return $aList;
	}
	public function SQL_SELECT($EtablissementID) {
		$query = sprintf ( "SELECT EtablissementID,AnnuaireID,RaisonSociale,Adresse1,Adresse2,BureauDistributeur,CodePostal,Ville,Telephone,Fax,Mail,NumRRF,ContratVN,Effectifs,NbVar,NbAgentsTotal,LoginSage,EnSommeil,StatutID,NatureID,TypologieID,RegionID,GroupeID,AccesSiteEmploi FROM annuaire_etablissement WHERE AnnuaireID='%s' AND EtablissementID='%s' LIMIT 1", mysqli_real_escape_string ($_SESSION['LINK'] , $_SESSION ['SITE'] ['ID'] ), mysqli_real_escape_string ($_SESSION['LINK'] , $EtablissementID ) );
		
		$result = mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
		
		if (mysqli_num_rows ( $result ) >= 1) {
			$line = mysqli_fetch_array ( $result );
			
			$this->ID = $line [0];
			$this->AnnuaireID = $line [1];
			$this->RaisonSociale = $line [2];
			$this->Adresse1 = $line [3];
			$this->Adresse2 = $line [4];
			$this->BureauDistributeur = $line [5];
			$this->CodePostal = $line [6];
			$this->Ville = $line [7];
			$this->Telephone = $line [8];
			$this->Fax = $line [9];
			$this->Mail = $line [10];
			$this->NumRRF = $line [11];
			$this->ContratVN = $line [12];
			$this->Effectifs = $line [13];
			$this->NbVar = $line [14];
			$this->NbAgentsTotal = $line [15];
			$this->LoginSage = $line [16];
			$this->EnSommeil = $line [17];
			$this->StatutID = $line [18];
			$this->NatureID = $line [19];
			$this->TypologieID = $line [20];
			$this->RegionID = $line [21];
			$this->GroupeID = $line [22];
			$this->AccesSiteEmploi = $line [23];
		} else {
			$this->__construct ();
		}
		
		mysqli_free_result ( $result );
	}
	public function SQL_SELECT_STATUT($StatutID) {
		$query = sprintf ( "SELECT Libelle FROM annuaire_lva_statut_etablissement WHERE AnnuaireID='%s' AND StatutID='%s'", mysqli_real_escape_string ($_SESSION['LINK'] , $_SESSION ['SITE'] ['ID'] ), mysqli_real_escape_string ($_SESSION['LINK'] , $StatutID ) );
		
		$result = mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
		$line = mysqli_fetch_array ( $result );
		mysqli_free_result ( $result );
		return $line [0];
	}
	public function SQL_SELECT_GROUPE($GroupeID) {
		$query = sprintf ( "SELECT Libelle FROM annuaire_lva_groupe_etablissement WHERE AnnuaireID='%s' AND GroupeID='%s'", mysqli_real_escape_string ($_SESSION['LINK'] , $_SESSION ['SITE'] ['ID'] ), mysqli_real_escape_string ($_SESSION['LINK'] , $GroupeID ) );
		
		$result = mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
		$line = mysqli_fetch_array ( $result );
		mysqli_free_result ( $result );
		return $line [0];
	}
	public function SQL_SELECT_Reseau($ReseauID) {
		$query = sprintf ( "SELECT Libelle FROM annuaire_lva_typologie WHERE AnnuaireID='%s' AND TypologieID='%s'", mysqli_real_escape_string ($_SESSION['LINK'] , $_SESSION ['SITE'] ['ID'] ), mysqli_real_escape_string ($_SESSION['LINK'] , $ReseauID ) );
		
		$result = mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
		$line = mysqli_fetch_array ( $result );
		mysqli_free_result ( $result );
		return $line [0];
	}
	public function SQL_SELECT_Region($RegionID) {
		$query = sprintf ( "SELECT Libelle FROM annuaire_lva_region WHERE AnnuaireID='%s' AND RegionID='%s'", mysqli_real_escape_string ($_SESSION['LINK'] , $_SESSION ['SITE'] ['ID'] ), mysqli_real_escape_string ($_SESSION['LINK'] , $RegionID ) );
		
		$result = mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
		$line = mysqli_fetch_array ( $result );
		mysqli_free_result ( $result );
		return $line [0];
	}
	public function SQL_SELECT_ALL_Contact($EtablissementID) {
		$aList = array ();
		
		// Restriction sur le site
		$sql = "SELECT d.IndividuID, d.Nom, d.Prenom, d.Libelle FROM annuaire_role_detail d, annuaire_lva_domainactivite lva WHERE d.DomainActiviteID = lva.DomainActiviteID AND d.AnnuaireID='%s' AND d.EtablissementID='%s' ORDER BY lva.NumOrdre ASC";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'] , $_SESSION ['SITE'] ['ID'] ), mysqli_real_escape_string ($_SESSION['LINK'] , $EtablissementID ) );
		
		$result = mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
		
		while ( $line = mysqli_fetch_array ( $result ) ) {
			$aList [] = $line;
		}
		
		mysqli_free_result ( $result );
		return $aList;
	}
}

?>