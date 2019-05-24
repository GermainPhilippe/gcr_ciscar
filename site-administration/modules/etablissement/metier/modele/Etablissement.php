<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage etablissement
 * @version 1.0.4
 */
class Etablissement {
	private $id;
	private $raisonSociale;
	private $adresse1;
	private $adresse2;
	private $bureauDistributeur;
	private $codePostal;
	private $ville;
	private $pays;
	private $telephone;
	private $fax;
	private $mail;
	private $siteWeb;
	private $siret;
	private $numCompteVN;
	private $numCompteMPR;
	private $numRRF;
	private $contratVN;
	private $effectifs;
	private $nbVar;
	private $nbAgentsTotal;
	private $loginSage;
	private $passwordSage;
	private $enSommeil;
	private $importActif;
	private $AccesSiteEmploi;
	private $obj_annuaire;
	private $obj_marque1;
	private $obj_marque2;
	private $obj_marque3;
	private $obj_marque4;
	private $obj_marque5;
	private $obj_statut;
	private $obj_nature;
	private $obj_typologie;
	private $obj_region;
	private $obj_groupe;
	private $Adhesion_GCR;
	private $Adhesion_CISCAR;
	private $Adhesion_GCR_Immo;
	private $Adhesion_GCR_SA;
	public function __construct() {
		$this->id = NULL;
		$this->raisonSociale = '';
		$this->adresse1 = '';
		$this->adresse2 = '';
		$this->bureauDistributeur = '';
		$this->codePostal = '';
		$this->ville = '';
		$this->pays = '';
		$this->telephone = '';
		$this->fax = '';
		$this->mail = '';
		$this->siteWeb = '';
		$this->siret = '';
		$this->numCompteVN = '';
		$this->numCompteMPR = '';
		$this->numRRF = '';
		$this->contratVN = '';
		$this->effectifs = 0;
		$this->nbVar = 0;
		$this->nbAgentsTotal = 0;
		$this->loginSage = '';
		$this->passwordSage = '';
		$this->enSommeil = 0;
		$this->importActif = 0;
		$this->AccesSiteEmploi = 0;

		$this->obj_annuaire = NULL;
		$this->obj_marque1 = NULL;
		$this->obj_marque2 = NULL;
		$this->obj_marque3 = NULL;
		$this->obj_marque4 = NULL;
		$this->obj_marque5 = NULL;
		$this->obj_statut = NULL;
		$this->obj_nature = NULL;
		$this->obj_typologie = NULL;
		$this->obj_region = NULL;
		$this->obj_groupe = NULL;

		$this->Adhesion_GCR = NULL;
		$this->Adhesion_CISCAR = NULL;
		$this->Adhesion_GCR_Immo = NULL;
		$this->Adhesion_GCR_SA = NULL;
	}

	// ###############
	public function getAdhesionGCR() {
		return $this->Adhesion_GCR;
	}
	public function getAdhesionCISCAR() {
		return $this->Adhesion_CISCAR;
	}
	public function getAdhesionGCRImmo() {
		return $this->Adhesion_GCR_Immo;
	}
	public function getAdhesionGCRSA() {
		return $this->Adhesion_GCR_SA;
	}
	public function setAdhesionGCR($value) {
		$this->Adhesion_GCR = $value;
	}
	public function setAdhesionCISCAR($value) {
		$this->Adhesion_CISCAR = $value;
	}
	public function setAdhesionGCRImmo($value) {
		$this->Adhesion_GCR_Immo = $value;
	}
	public function setAdhesionGCRSA($value) {
		$this->Adhesion_GCR_SA = $value;
	}

	// ###
	function getID() {
		return $this->id;
	}
	function getRaisonSociale() {
		return $this->raisonSociale;
	}
	function getAdresse1() {
		return $this->adresse1;
	}
	function getAdresse2() {
		return $this->adresse2;
	}
	function getBureauDistributeur() {
		return $this->bureauDistributeur;
	}
	function getCodePostal() {
		return $this->codePostal;
	}
	function getVille() {
		return $this->ville;
	}
	function getPays() {
		return $this->pays;
	}
	function getTelephone() {
		return $this->telephone;
	}
	function getFax() {
		return $this->fax;
	}
	function getMail() {
		return $this->mail;
	}
	function getSiteWeb() {
		return $this->siteWeb;
	}
	function getSiret() {
		return $this->siret;
	}
	function getNumCompteVN() {
		return $this->numCompteVN;
	}
	function getNumCompteMPR() {
		return $this->numCompteMPR;
	}
	function getNumRRF() {
		return $this->numRRF;
	}
	function getContratVN() {
		return $this->contratVN;
	}
	function getEffectifs() {
		return $this->effectifs;
	}
	function getNbVar() {
		return $this->nbVar;
	}
	function getNbAgentsTotal() {
		return $this->nbAgentsTotal;
	}
	function getLoginSage() {
		return $this->loginSage;
	}
	function getPasswordSage() {
		return $this->passwordSage;
	}
	function getEnSommeil() {
		return $this->enSommeil;
	}
	function getImportActif() {
		return $this->importActif;
	}
	function getAnnuaire() {
		return $this->obj_annuaire;
	}
	function getMarque1() {
		return $this->obj_marque1;
	}
	function getMarque2() {
		return $this->obj_marque2;
	}
	function getMarque3() {
		return $this->obj_marque3;
	}
	function getMarque4() {
		return $this->obj_marque4;
	}
	function getMarque5() {
		return $this->obj_marque5;
	}
	function getStatut() {
		return $this->obj_statut;
	}
	function getNature() {
		return $this->obj_nature;
	}
	function getTypologie() {
		return $this->obj_typologie;
	}
	function getRegion() {
		return $this->obj_region;
	}
	function getGroupe() {
		return $this->obj_groupe;
	}
	public function getAccesSiteEmploi() {
		return $this->AccesSiteEmploi;
	}

	// ###############
	function setID($newValue) {
		$this->id = $newValue;
	}
	function setRaisonSociale($newValue) {
		$this->raisonSociale = $newValue;
	}
	function setAdresse1($newValue) {
		$this->adresse1 = $newValue;
	}
	function setAdresse2($newValue) {
		$this->adresse2 = $newValue;
	}
	function setBureauDistributeur($newValue) {
		$this->bureauDistributeur = $newValue;
	}
	function setCodePostal($newValue) {
		$this->codePostal = $newValue;
	}
	function setVille($newValue) {
		$this->ville = $newValue;
	}
	function setPays($newValue) {
		$this->pays = $newValue;
	}
	function setTelephone($newValue) {
		$this->telephone = $newValue;
	}
	function setFax($newValue) {
		$this->fax = $newValue;
	}
	function setMail($newValue) {
		$this->mail = $newValue;
	}
	function setSiteWeb($newValue) {
		$this->siteWeb = $newValue;
	}
	function setSiret($newValue) {
		$this->siret = $newValue;
	}
	function setNumCompteVN($newValue) {
		$this->numCompteVN = $newValue;
	}
	function setNumCompteMPR($newValue) {
		$this->numCompteMPR = $newValue;
	}
	function setNumRRF($newValue) {
		$this->numRRF = $newValue;
	}
	function setContratVN($newValue) {
		$this->contratVN = $newValue;
	}
	function setEffectifs($newValue) {
		$this->effectifs = $newValue;
	}
	function setNbVar($newValue) {
		$this->nbVar = $newValue;
	}
	function setNbAgentsTotal($newValue) {
		$this->nbAgentsTotal = $newValue;
	}
	function setLoginSage($newValue) {
		$this->loginSage = $newValue;
	}
	function setPasswordSage($newValue) {
		$this->passwordSage = $newValue;
	}
	function setEnSommeil($newValue) {
		$this->enSommeil = $newValue;
	}
	function setImportActif($newValue) {
		$this->importActif = $newValue;
	}
	function setAnnuaire($newValue) {
		$this->obj_annuaire = $newValue;
	}
	function setMarque1($newValue) {
		$this->obj_marque1 = $newValue;
	}
	function setMarque2($newValue) {
		$this->obj_marque2 = $newValue;
	}
	function setMarque3($newValue) {
		$this->obj_marque3 = $newValue;
	}
	function setMarque4($newValue) {
		$this->obj_marque4 = $newValue;
	}
	function setMarque5($newValue) {
		$this->obj_marque5 = $newValue;
	}
	function setStatut($newValue) {
		$this->obj_statut = $newValue;
	}
	function setNature($newValue) {
		$this->obj_nature = $newValue;
	}
	function setTypologie($newValue) {
		$this->obj_typologie = $newValue;
	}
	function setRegion($newValue) {
		$this->obj_region = $newValue;
	}
	function setGroupe($newValue) {
		$this->obj_groupe = $newValue;
	}
	public function setAccesSiteEmploi($newValue) {
		$this->AccesSiteEmploi = $newValue;
	}

	// ###############
	function create_etablissement() {
		$sql = "INSERT INTO annuaire_etablissement (EtablissementID, AnnuaireID, RaisonSociale, Adresse1, Adresse2, BureauDistributeur, CodePostal, Ville, Pays, Telephone, Fax, Mail, SiteWeb,Siret,";
		$sql .= " NumCompteVN, NumCompteMPR, NumRRF, ContratVN, Effectifs, NbVar, NbAgentsTotal, LoginSage, PasswordSage,";
		$sql .= " EnSommeil, ImportActif, Marque1_ID, Marque2_ID, Marque3_ID, Marque4_ID, Marque5_ID, StatutID, NatureID, TypologieID, RegionID, GroupeID, AccesSiteEmploi, Adhesion_GCR, Adhesion_CISCAR, Adhesion_GCR_Immo, Adhesion_GCR_SA)";
		$sql .= " VALUES( NULL, '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s','%s','%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s','%s', '%s',";
		$sql .= ! is_null ( $this->getMarque1 ()->getID () ) ? "'" . $this->getMarque1 ()->getID () . "'," : "NULL,";
		$sql .= ! is_null ( $this->getMarque2 ()->getID () ) ? "'" . $this->getMarque2 ()->getID () . "'," : "NULL,";
		$sql .= ! is_null ( $this->getMarque3 ()->getID () ) ? "'" . $this->getMarque3 ()->getID () . "'," : "NULL,";
		$sql .= ! is_null ( $this->getMarque4 ()->getID () ) ? "'" . $this->getMarque4 ()->getID () . "'," : "NULL,";
		$sql .= ! is_null ( $this->getMarque5 ()->getID () ) ? "'" . $this->getMarque5 ()->getID () . "'," : "NULL,";
		$sql .= ! is_null ( $this->getStatut ()->getID () ) ? "'" . $this->getStatut ()->getID () . "'," : "NULL,";
		$sql .= ! is_null ( $this->getNature ()->getID () ) ? "'" . $this->getNature ()->getID () . "'," : "NULL,";
		$sql .= ! is_null ( $this->getTypologie ()->getID () ) ? "'" . $this->getTypologie ()->getID () . "'," : "NULL,";
		$sql .= ! is_null ( $this->getRegion ()->getID () ) ? "'" . $this->getRegion ()->getID () . "'," : "NULL,";
		$sql .= ! is_null ( $this->getGroupe ()->getID () ) ? "'" . $this->getGroupe ()->getID () . "'," : "NULL,";
		$sql .= " '%s', '%s', '%s', '%s', '%s')";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $this->obj_annuaire->getID () ), mysqli_real_escape_string ($_SESSION['LINK'], $this->raisonSociale ), mysqli_real_escape_string ($_SESSION['LINK'], $this->adresse1 ), mysqli_real_escape_string ($_SESSION['LINK'], $this->adresse2 ), mysqli_real_escape_string ($_SESSION['LINK'], $this->bureauDistributeur ), mysqli_real_escape_string ($_SESSION['LINK'], $this->codePostal ), mysqli_real_escape_string ($_SESSION['LINK'], $this->ville ), mysqli_real_escape_string ($_SESSION['LINK'], $this->pays ), mysqli_real_escape_string ($_SESSION['LINK'], $this->telephone ), mysqli_real_escape_string ($_SESSION['LINK'], $this->fax ), mysqli_real_escape_string ($_SESSION['LINK'], $this->mail ), mysqli_real_escape_string ($_SESSION['LINK'], $this->siteWeb ), mysqli_real_escape_string ($_SESSION['LINK'], $this->siret ), mysqli_real_escape_string ($_SESSION['LINK'], $this->numCompteVN ), mysqli_real_escape_string ($_SESSION['LINK'], $this->numCompteMPR ), mysqli_real_escape_string ($_SESSION['LINK'], $this->numRRF ), mysqli_real_escape_string ($_SESSION['LINK'], $this->contratVN ), mysqli_real_escape_string ($_SESSION['LINK'], $this->effectifs ), mysqli_real_escape_string ($_SESSION['LINK'], $this->nbVar ), mysqli_real_escape_string ($_SESSION['LINK'], $this->nbAgentsTotal ), mysqli_real_escape_string ($_SESSION['LINK'], $this->loginSage ), mysqli_real_escape_string ($_SESSION['LINK'], $this->passwordSage ), mysqli_real_escape_string ($_SESSION['LINK'], $this->enSommeil ), mysqli_real_escape_string ($_SESSION['LINK'], $this->importActif ), mysqli_real_escape_string ($_SESSION['LINK'], $this->AccesSiteEmploi ), mysqli_real_escape_string ($_SESSION['LINK'], $this->Adhesion_GCR ), mysqli_real_escape_string ($_SESSION['LINK'], $this->Adhesion_CISCAR ), mysqli_real_escape_string ($_SESSION['LINK'], $this->Adhesion_GCR_Immo ), mysqli_real_escape_string ($_SESSION['LINK'], $this->Adhesion_GCR_SA ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	function update_etablissement() {
		$sql = "UPDATE annuaire_etablissement SET RaisonSociale='%s', Adresse1='%s', Adresse2='%s', BureauDistributeur='%s',
													CodePostal='%s', Ville='%s', Pays='%s', Telephone='%s', Fax='%s', Mail='%s',
													SiteWeb='%s',Siret='%s', NumCompteVN='%s',	NumCompteMPR='%s',
													NumRRF='%s', ContratVN='%s', Effectifs='%s',
													NbVar='%s',	NbAgentsTotal='%s',	LoginSage='%s',	PasswordSage='%s',
													EnSommeil='%s',	ImportActif='%s', AccesSiteEmploi='%s',
													Adhesion_GCR='%s', Adhesion_CISCAR='%s', Adhesion_GCR_Immo='%s', Adhesion_GCR_SA='%s'";
		$sql .= ! is_null ( $this->getMarque1 ()->getID () ) ? ", Marque1_ID='" . $this->getMarque1 ()->getID () . "'" : ",Marque1_ID=NULL";
		$sql .= ! is_null ( $this->getMarque2 ()->getID () ) ? ", Marque2_ID='" . $this->getMarque2 ()->getID () . "'" : ",Marque2_ID=NULL";
		$sql .= ! is_null ( $this->getMarque3 ()->getID () ) ? ", Marque3_ID='" . $this->getMarque3 ()->getID () . "'" : ",Marque3_ID=NULL";
		$sql .= ! is_null ( $this->getMarque4 ()->getID () ) ? ", Marque4_ID='" . $this->getMarque4 ()->getID () . "'" : ",Marque4_ID=NULL";
		$sql .= ! is_null ( $this->getMarque5 ()->getID () ) ? ", Marque5_ID='" . $this->getMarque5 ()->getID () . "'" : ",Marque5_ID=NULL";
		$sql .= ! is_null ( $this->getStatut ()->getID () ) ? ", StatutID='" . $this->getStatut ()->getID () . "'" : ",StatutID=NULL";
		$sql .= ! is_null ( $this->getNature ()->getID () ) ? ", NatureID='" . $this->getNature ()->getID () . "'" : ",NatureID=NULL";
		$sql .= ! is_null ( $this->getTypologie ()->getID () ) ? ", TypologieID='" . $this->getTypologie ()->getID () . "'" : ",TypologieID=NULL";
		$sql .= ! is_null ( $this->getRegion ()->getID () ) ? ", RegionID='" . $this->getRegion ()->getID () . "'" : ",RegionID=NULL";
		$sql .= ! is_null ( $this->getGroupe ()->getID () ) ? ", GroupeID='" . $this->getGroupe ()->getID () . "'" : ",GroupeID=NULL";

		$sql .= " WHERE EtablissementID='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $this->raisonSociale ), mysqli_real_escape_string ($_SESSION['LINK'], $this->adresse1 ), mysqli_real_escape_string ($_SESSION['LINK'], $this->adresse2 ), mysqli_real_escape_string ($_SESSION['LINK'], $this->bureauDistributeur ), mysqli_real_escape_string ($_SESSION['LINK'], $this->codePostal ), mysqli_real_escape_string ($_SESSION['LINK'], $this->ville ), mysqli_real_escape_string ($_SESSION['LINK'], $this->pays ), mysqli_real_escape_string ($_SESSION['LINK'], $this->telephone ), mysqli_real_escape_string ($_SESSION['LINK'], $this->fax ), mysqli_real_escape_string ($_SESSION['LINK'], $this->mail ), mysqli_real_escape_string ($_SESSION['LINK'], $this->siteWeb ), mysqli_real_escape_string ($_SESSION['LINK'], $this->siret ), mysqli_real_escape_string ($_SESSION['LINK'], $this->numCompteVN ), mysqli_real_escape_string ($_SESSION['LINK'], $this->numCompteMPR ), mysqli_real_escape_string ($_SESSION['LINK'], $this->numRRF ), mysqli_real_escape_string ($_SESSION['LINK'], $this->contratVN ), mysqli_real_escape_string ($_SESSION['LINK'], $this->effectifs ), mysqli_real_escape_string ($_SESSION['LINK'], $this->nbVar ), mysqli_real_escape_string ($_SESSION['LINK'], $this->nbAgentsTotal ), mysqli_real_escape_string ($_SESSION['LINK'], $this->loginSage ), mysqli_real_escape_string ($_SESSION['LINK'], $this->passwordSage ), mysqli_real_escape_string ($_SESSION['LINK'], $this->enSommeil ), mysqli_real_escape_string ($_SESSION['LINK'], $this->importActif ), mysqli_real_escape_string ($_SESSION['LINK'], $this->AccesSiteEmploi ), mysqli_real_escape_string ($_SESSION['LINK'], $this->Adhesion_GCR ), mysqli_real_escape_string ($_SESSION['LINK'], $this->Adhesion_CISCAR ), mysqli_real_escape_string ($_SESSION['LINK'], $this->Adhesion_GCR_Immo ), mysqli_real_escape_string ($_SESSION['LINK'], $this->Adhesion_GCR_SA ), mysqli_real_escape_string ($_SESSION['LINK'], $this->id ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	function remove_etablissement() {
		$query = sprintf ( "DELETE FROM annuaire_etablissement WHERE EtablissementID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $this->id ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	function select_etablissement($i) {
		$query = sprintf ( "SELECT EtablissementID, AnnuaireID, RaisonSociale, Adresse1, Adresse2, BureauDistributeur, CodePostal, Ville, Telephone, Fax, Mail, SiteWeb, Siret, NumCompteVN, NumCompteMPR, NumRRF, ContratVN, Effectifs, NbVar, NbAgentsTotal, LoginSage, PasswordSage, EnSommeil, ImportActif, Marque1_ID, StatutID, NatureID, TypologieID, RegionID, GroupeID,AccesSiteEmploi,Adhesion_GCR, Adhesion_CISCAR, Adhesion_GCR_Immo, Adhesion_GCR_SA, Marque2_ID, Marque3_ID, Marque4_ID, Marque5_ID, Pays FROM annuaire_etablissement WHERE EtablissementID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $i ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array  ( $result );

			$this->setID ( $line [0] );
			$this->setRaisonSociale ( $line [2] );
			$this->setAdresse1 ( $line [3] );
			$this->setAdresse2 ( $line [4] );
			$this->setBureauDistributeur ( $line [5] );
			$this->setCodePostal ( $line [6] );
			$this->setVille ( $line [7] );
			$this->setPays ( $line [39] );
			$this->setTelephone ( $line [8] );
			$this->setFax ( $line [9] );
			$this->setMail ( $line [10] );
			$this->setSiteWeb ( $line [11] );
			$this->setSiret ( $line [12] );
			$this->setNumCompteVN ( $line [13] );
			$this->setNumCompteMPR ( $line [14] );
			$this->setNumRRF ( $line [15] );
			$this->setContratVN ( $line [16] );
			$this->setEffectifs ( $line [17] );
			$this->setNbVar ( $line [18] );
			$this->setNbAgentsTotal ( $line [19] );
			$this->setLoginSage ( $line [20] );
			$this->setPasswordSage ( $line [21] );
			$this->setEnSommeil ( $line [22] );
			$this->setImportActif ( $line [23] );
			$this->AccesSiteEmploi = $line [30];
			$this->Adhesion_GCR = $line [31];
			$this->Adhesion_CISCAR = $line [32];
			$this->Adhesion_GCR_Immo = $line [33];
			$this->Adhesion_GCR_SA = $line [34];

			$aAnnuaire = new Annuaire ();
			$aAnnuaire->select_annuaire ( $line [1] );
			$this->setAnnuaire ( $aAnnuaire );

			$aMarque = new Marque ();
			$aMarque->select_marque ( $line [24] );
			$this->setMarque1 ( $aMarque );
			$aMarque = new Marque ();
			$aMarque->select_marque ( $line [35] );
			$this->setMarque2 ( $aMarque );
			$aMarque = new Marque ();
			$aMarque->select_marque ( $line [36] );
			$this->setMarque3 ( $aMarque );
			$aMarque = new Marque ();
			$aMarque->select_marque ( $line [37] );
			$this->setMarque4 ( $aMarque );
			$aMarque = new Marque ();
			$aMarque->select_marque ( $line [38] );
			$this->setMarque5 ( $aMarque );

			$aStatut = new StatutEtablissement ();
			$aStatut->select_statutetablissement ( $line [25] );
			$this->setStatut ( $aStatut );

			$aNature = new Nature ();
			$aNature->select_nature ( $line [26] );
			$this->setNature ( $aNature );

			$aTypologie = new Typologie ();
			$aTypologie->select_typologie ( $line [27] );
			$this->setTypologie ( $aTypologie );

			$aRegion = new Region ();
			$aRegion->select_region ( $line [28] );
			$this->setRegion ( $aRegion );

			$aGroupe = new GroupeEtablissement ();
			$aGroupe->select_groupeetablissement ( $line [29] );
			$this->setGroupe ( $aGroupe );
		} else {
			$this->__construct ();
		}

		mysqli_free_result  ( $result );
	}
}

?>