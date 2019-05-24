<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage document
 * @version 1.0.4
 */
class DocPartenaire {
	private $ID;
	private $Nom;
	private $Adresse;
	private $CodePostal;
	private $BureauDistributeur;
	private $Ville;
	private $Telephone;
	private $Fax;
	private $Mail;
	private $NomContact;
	private $MailContact;
	private $LogoURLSmall;
	private $LogoURLBig;
	private $LogoPosition;
	private $URL;
	private $Publication;
	private $SiteID;
	public function __construct() {
		$this->ID = NULL;
		$this->Nom = '';
		$this->Adresse = '';
		$this->CodePostal = '';
		$this->BureauDistributeur = '';
		$this->Ville = '';
		$this->Telephone = '';
		$this->Fax = '';
		$this->Mail = '';
		$this->NomContact = '';
		$this->MailContact = '';
		$this->LogoURLSmall = '';
		$this->LogoURLBig = '';
		$this->LogoPosition = 0;
		$this->URL = '';
		$this->Publication = 0;
		$this->SiteID = NULL;
	}

	// ###
	public function getID() {
		return $this->ID;
	}
	public function getNom() {
		return $this->Nom;
	}
	public function getAdresse() {
		return $this->Adresse;
	}
	public function getCodePostal() {
		return $this->CodePostal;
	}
	public function getBureauDistributeur() {
		return $this->BureauDistributeur;
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
	public function getNomContact() {
		return $this->NomContact;
	}
	public function getMailContact() {
		return $this->MailContact;
	}
	public function getLogoURLSmall() {
		return $this->LogoURLSmall;
	}
	public function getLogoURLBig() {
		return $this->LogoURLBig;
	}
	public function getLogoPosition() {
		return $this->LogoPosition;
	}
	public function getURL() {
		return $this->URL;
	}
	public function getPublication() {
		return $this->Publication;
	}
	public function getSiteID() {
		return $this->SiteID;
	}

	// ###
	public function setID($newValue) {
		$this->ID = $newValue;
	}
	public function setNom($newValue) {
		$this->Nom = $newValue;
	}
	public function setAdresse($newValue) {
		$this->Adresse = $newValue;
	}
	public function setCodePostal($newValue) {
		$this->CodePostal = $newValue;
	}
	public function setBureauDistributeur($newValue) {
		$this->BureauDistributeur = $newValue;
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
	public function setNomContact($newValue) {
		$this->NomContact = $newValue;
	}
	public function setMailContact($newValue) {
		$this->MailContact = $newValue;
	}
	public function setLogoURLSmall($newValue) {
		$this->LogoURLSmall = $newValue;
	}
	public function setLogoURLBig($newValue) {
		$this->LogoURLBig = $newValue;
	}
	public function setLogoPosition($newValue) {
		$this->LogoPosition = $newValue;
	}
	public function setURL($newValue) {
		$this->URL = $newValue;
	}
	public function setPublication($newValue) {
		$this->Publication = $newValue;
	}
	public function setSiteID($newValue) {
		$this->SiteID = $newValue;
	}
	// ###
	public function SQL_create() {
		$sql = "INSERT INTO wcm_document_partenaire (DocPartenaireID, Nom, Adresse, CodePostal, BureauDistributeur, Ville, Telephone, Fax, Mail, NomContact, MailContact, LogoURLSmall, LogoURLBig, LogoPosition, URL, Publication, SiteID)";
		$sql .= " VALUES(NULL, '%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s')";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $this->Nom ), mysqli_real_escape_string ($_SESSION['LINK'], $this->Adresse ), mysqli_real_escape_string ($_SESSION['LINK'], $this->CodePostal ), mysqli_real_escape_string ($_SESSION['LINK'], $this->BureauDistributeur ), mysqli_real_escape_string ($_SESSION['LINK'], $this->Ville ), mysqli_real_escape_string ($_SESSION['LINK'], $this->Telephone ), mysqli_real_escape_string ($_SESSION['LINK'], $this->Fax ), mysqli_real_escape_string ($_SESSION['LINK'], $this->Mail ), mysqli_real_escape_string ($_SESSION['LINK'], $this->NomContact ), mysqli_real_escape_string ($_SESSION['LINK'], $this->MailContact ), mysqli_real_escape_string ($_SESSION['LINK'], $this->LogoURLSmall ), mysqli_real_escape_string ($_SESSION['LINK'], $this->LogoURLBig ), mysqli_real_escape_string ($_SESSION['LINK'], $this->LogoPosition ), mysqli_real_escape_string ($_SESSION['LINK'], $this->URL ), mysqli_real_escape_string ($_SESSION['LINK'], $this->Publication ), mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function SQL_update() {
		$sql = "UPDATE wcm_document_partenaire SET ";
		$sql .= "Nom='%s',";
		$sql .= "Adresse='%s',";
		$sql .= "CodePostal='%s',";
		$sql .= "BureauDistributeur='%s',";
		$sql .= "Ville='%s',";
		$sql .= "Telephone='%s',";
		$sql .= "Fax='%s',";
		$sql .= "Mail='%s',";
		$sql .= "NomContact='%s',";
		$sql .= "MailContact='%s',";
		$sql .= "LogoURLSmall='%s',";
		$sql .= "LogoURLBig='%s',";
		$sql .= "LogoPosition='%s',";
		$sql .= "URL='%s',";
		$sql .= "Publication='%s'";
		$sql .= " WHERE DocPartenaireID='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $this->Nom ), mysqli_real_escape_string ($_SESSION['LINK'], $this->Adresse ), mysqli_real_escape_string ($_SESSION['LINK'], $this->CodePostal ), mysqli_real_escape_string ($_SESSION['LINK'], $this->BureauDistributeur ), mysqli_real_escape_string ($_SESSION['LINK'], $this->Ville ), mysqli_real_escape_string ($_SESSION['LINK'], $this->Telephone ), mysqli_real_escape_string ($_SESSION['LINK'], $this->Fax ), mysqli_real_escape_string ($_SESSION['LINK'], $this->Mail ), mysqli_real_escape_string ($_SESSION['LINK'], $this->NomContact ), mysqli_real_escape_string ($_SESSION['LINK'], $this->MailContact ), mysqli_real_escape_string ($_SESSION['LINK'], $this->LogoURLSmall ), mysqli_real_escape_string ($_SESSION['LINK'], $this->LogoURLBig ), mysqli_real_escape_string ($_SESSION['LINK'], $this->LogoPosition ), mysqli_real_escape_string ($_SESSION['LINK'], $this->URL ), mysqli_real_escape_string ($_SESSION['LINK'], $this->Publication ), mysqli_real_escape_string ($_SESSION['LINK'], $this->ID ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function SQL_delete() {
		$query = sprintf ( "DELETE FROM wcm_document_partenaire WHERE DocPartenaireID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $this->ID ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function SQL_selection($DocID) {
		$query = sprintf ( "SELECT DocPartenaireID, Nom, Adresse, CodePostal, BureauDistributeur, Ville, Telephone, Fax, Mail, NomContact, MailContact, LogoURLSmall, LogoURLBig, LogoPosition, URL, Publication, SiteID FROM wcm_document_partenaire WHERE DocPartenaireID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $DocID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array  ( $result );

			$this->ID = $line [0];
			$this->Nom = $line [1];
			$this->Adresse = $line [2];
			$this->CodePostal = $line [3];
			$this->BureauDistributeur = $line [4];
			$this->Ville = $line [5];
			$this->Telephone = $line [6];
			$this->Fax = $line [7];
			$this->Mail = $line [8];
			$this->NomContact = $line [9];
			$this->MailContact = $line [10];
			$this->LogoURLSmall = $line [11];
			$this->LogoURLBig = $line [12];
			$this->LogoPosition = $line [13];
			$this->URL = $line [14];
			$this->Publication = $line [15];
			$this->SiteID = $line [16];
		} else {
			$this->ID = NULL;
			$this->Nom = '';
			$this->Adresse = '';
			$this->CodePostal = '';
			$this->BureauDistributeur = '';
			$this->Ville = '';
			$this->Telephone = '';
			$this->Fax = '';
			$this->Mail = '';
			$this->NomContact = '';
			$this->MailContact = '';
			$this->LogoURLSmall = '';
			$this->LogoURLBig = '';
			$this->LogoPosition = 0;
			$this->URL = '';
			$this->Publication = 0;
			$this->SiteID = NULL;
		}

		mysqli_free_result  ( $result );
	}
}
?>