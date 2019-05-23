<?php
/**
 * @author Florent DESPIERRES
 * @package portail-ciscar
 * @subpackage commun
 * @version 1.0.4
 */
class InscriptionSite {
	private $ID;
	private $SiteID;
	private $Nom;
	private $Prenom;
	private $AdresseMail;
	private $VotreMarqueDistribuee;
	private $Categorie;
	private $RaisonSociale;
	private $NumeroSiret;
	private $CodeClientCiscar;
	private $Adresse;
	private $ComplementAdresse;
	private $CodePostal;
	private $Ville;
	private $NumeroTelephone;
	private $NumeroMobile;
	private $NumeroFax;
	private $Fonction;
	private $Groupe;
	private $DateDemande;
	public function __construct() {
		$this->ID = NULL;
		$this->SiteID = NULL;
		$this->Nom = '';
		$this->Prenom = '';
		$this->AdresseMail = '';
		$this->VotreMarqueDistribuee = '';
		$this->Categorie = '';
		$this->RaisonSociale = '';
		$this->NumeroSiret = '';
		$this->CodeClientCiscar = '';
		$this->Adresse = '';
		$this->ComplementAdresse = '';
		$this->CodePostal = '';
		$this->Ville = '';
		$this->NumeroTelephone = '';
		$this->NumeroMobile = '';
		$this->NumeroFax = '';
		
		$this->Fonction = '';
		$this->Groupe = '';
		$this->DateDemande = '';
	}
	
	// ###
	public function getGroupe() {
		return $this->Groupe;
	}
	public function setGroupe($value) {
		$this->Groupe = $value;
	}
	public function getFonction() {
		return $this->Fonction;
	}
	public function setFonction($value) {
		$this->Fonction = $value;
	}
	public function getID() {
		return $this->ID;
	}
	public function getSiteID() {
		return $this->SiteID;
	}
	public function getNom() {
		return $this->Nom;
	}
	public function getPrenom() {
		return $this->Prenom;
	}
	public function getAdresseMail() {
		return $this->AdresseMail;
	}
	public function getVotreMarqueDistribuee() {
		return $this->VotreMarqueDistribuee;
	}
	public function getCategorie() {
		return $this->Categorie;
	}
	public function getRaisonSociale() {
		return $this->RaisonSociale;
	}
	public function getNumeroSiret() {
		return $this->NumeroSiret;
	}
	public function getCodeClientCiscar() {
		return $this->CodeClientCiscar;
	}
	public function getAdresse() {
		return $this->Adresse;
	}
	public function getComplementAdresse() {
		return $this->ComplementAdresse;
	}
	public function getCodePostal() {
		return $this->CodePostal;
	}
	public function getVille() {
		return $this->Ville;
	}
	public function getNumeroTelephone() {
		return $this->NumeroTelephone;
	}
	public function getNumeroMobile() {
		return $this->NumeroMobile;
	}
	public function getNumeroFax() {
		return $this->NumeroFax;
	}
	public function getDateDemande() {
		return $this->DateDemande;
	}
	
	// ###
	public function setID($newValue) {
		$this->ID = $newValue;
	}
	public function setSiteID($newValue) {
		$this->SiteID = $newValue;
	}
	public function setNom($newValue) {
		$this->Nom = $newValue;
	}
	public function setPrenom($newValue) {
		$this->Prenom = $newValue;
	}
	public function setAdresseMail($newValue) {
		$this->AdresseMail = $newValue;
	}
	public function setVotreMarqueDistribuee($newValue) {
		$this->VotreMarqueDistribuee = $newValue;
	}
	public function setCategorie($newValue) {
		$this->Categorie = $newValue;
	}
	public function setRaisonSociale($newValue) {
		$this->RaisonSociale = $newValue;
	}
	public function setNumeroSiret($newValue) {
		$this->NumeroSiret = $newValue;
	}
	public function setCodeClientCiscar($newValue) {
		$this->CodeClientCiscar = $newValue;
	}
	public function setAdresse($newValue) {
		$this->Adresse = $newValue;
	}
	public function setComplementAdresse($newValue) {
		$this->ComplementAdresse = $newValue;
	}
	public function setCodePostal($newValue) {
		$this->CodePostal = $newValue;
	}
	public function setVille($newValue) {
		$this->Ville = $newValue;
	}
	public function setNumeroTelephone($newValue) {
		$this->NumeroTelephone = $newValue;
	}
	public function setNumeroMobile($newValue) {
		$this->NumeroMobile = $newValue;
	}
	public function setNumeroFax($newValue) {
		$this->NumeroFax = $newValue;
	}
	public function setDateDemande($newValue) {
		$this->DateDemande = $newValue;
	}
	
	// ###
	public function SQL_CREATE() {
		$sql = "INSERT INTO annuaire_inscription (InscriptionID, SiteID, Nom, Prenom, AdresseMail, VotreMarqueDistribuee, Categorie, RaisonSociale, NumeroSiret, CodeClientCiscar, Adresse, ComplementAdresse, CodePostal, Ville, NumeroTelephone, NumeroMobile, NumeroFax, Fonction, Groupe)";
		$sql .= " VALUES(NULL, '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'] , $this->SiteID ), mysqli_real_escape_string ($_SESSION['LINK'] , $this->Nom ), mysqli_real_escape_string ($_SESSION['LINK'] , $this->Prenom ), mysqli_real_escape_string ($_SESSION['LINK'] , $this->AdresseMail ), mysqli_real_escape_string ($_SESSION['LINK'] , $this->VotreMarqueDistribuee ), mysqli_real_escape_string ($_SESSION['LINK'] , $this->Categorie ), mysqli_real_escape_string ($_SESSION['LINK'] , $this->RaisonSociale ), mysqli_real_escape_string ($_SESSION['LINK'] , $this->NumeroSiret ), mysqli_real_escape_string ($_SESSION['LINK'] , $this->CodeClientCiscar ), mysqli_real_escape_string ($_SESSION['LINK'] , $this->Adresse ), mysqli_real_escape_string ($_SESSION['LINK'] , $this->ComplementAdresse ), mysqli_real_escape_string ($_SESSION['LINK'] , $this->CodePostal ), mysqli_real_escape_string ($_SESSION['LINK'] , $this->Ville ), mysqli_real_escape_string ($_SESSION['LINK'] , $this->NumeroTelephone ), mysqli_real_escape_string ($_SESSION['LINK'] , $this->NumeroMobile ), mysqli_real_escape_string ($_SESSION['LINK'] , $this->NumeroFax ), mysqli_real_escape_string ($_SESSION['LINK'] , $this->Fonction ), mysqli_real_escape_string ($_SESSION['LINK'] , $this->Groupe ) );
		
		mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function SQL_CREATE_OUV() {
		$sql = "INSERT INTO annuaire_ouvertures_comptes (OuvId, Nom, Prenom, AdresseMail, VotreMarqueDistribuee, Categorie, RaisonSociale, NumeroSiret, CodeClientCiscar, Adresse, ComplementAdresse, CodePostal, Ville, NumeroTelephone, NumeroMobile, NumeroFax, Fonction, Groupe, DateDemande)";
		$sql .= " VALUES(NULL, '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'] , $this->Nom ), mysqli_real_escape_string ($_SESSION['LINK'] , $this->Prenom ), mysqli_real_escape_string ($_SESSION['LINK'] , $this->AdresseMail ), mysqli_real_escape_string ($_SESSION['LINK'] , $this->VotreMarqueDistribuee ), mysqli_real_escape_string ($_SESSION['LINK'] , $this->Categorie ), mysqli_real_escape_string ($_SESSION['LINK'] , $this->RaisonSociale ), mysqli_real_escape_string ($_SESSION['LINK'] , $this->NumeroSiret ), mysqli_real_escape_string ($_SESSION['LINK'] , $this->CodeClientCiscar ), mysqli_real_escape_string ($_SESSION['LINK'] , $this->Adresse ), mysqli_real_escape_string ($_SESSION['LINK'] , $this->ComplementAdresse ), mysqli_real_escape_string ($_SESSION['LINK'] , $this->CodePostal ), mysqli_real_escape_string ($_SESSION['LINK'] , $this->Ville ), mysqli_real_escape_string ($_SESSION['LINK'] , $this->NumeroTelephone ), mysqli_real_escape_string ($_SESSION['LINK'] , $this->NumeroMobile ), mysqli_real_escape_string ($_SESSION['LINK'] , $this->NumeroFax ), mysqli_real_escape_string ($_SESSION['LINK'] , $this->Fonction ), mysqli_real_escape_string ($_SESSION['LINK'] , $this->Groupe ), mysqli_real_escape_string ($_SESSION['LINK'] , $this->DateDemande ) );
		mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
}
?>