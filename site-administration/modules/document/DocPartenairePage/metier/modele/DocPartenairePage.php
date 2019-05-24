<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage document
 * @version 1.0.4
 */
class DocPartenairePage {
	private $ID;
	private $DocPartenaireID;
	private $Titre;
	private $ContenuRichText;
	private $SiteID;
	private $PictoTitre;
	public function __construct() {
		$this->ID = NULL;
		$this->DocPartenaireID = NULL;
		$this->Titre = '';
		$this->ContenuRichText = '';
		$this->SiteID = NULL;
		$this->PictoTitre = '';
	}

	// ###
	public function getID() {
		return $this->ID;
	}
	public function getDocPartenaireID() {
		return $this->DocPartenaireID;
	}
	public function getTitre() {
		return $this->Titre;
	}
	public function getContenuRichText() {
		return $this->ContenuRichText;
	}
	public function getSiteID() {
		return $this->SiteID;
	}
	public function getPictoTitre() {
		return $this->PictoTitre;
	}
	public function setID($newValue) {
		$this->ID = $newValue;
	}
	public function setDocPartenaireID($newValue) {
		$this->DocPartenaireID = $newValue;
	}
	public function setTitre($newValue) {
		$this->Titre = $newValue;
	}
	public function setContenuRichText($newValue) {
		$this->ContenuRichText = $newValue;
	}
	public function setSiteID($newValue) {
		$this->SiteID = $newValue;
	}
	public function setPictoTitre($newValue) {
		$this->PictoTitre = $newValue;
	}

	// ###
	public function SQL_create() {
		$sql = "INSERT INTO wcm_document_partenaire_page (DocPartenairePageID, DocPartenaireID, Titre,PictoTitre, ContenuRichText, SiteID)";
		$sql .= " VALUES(NULL, '%s', '%s', '%s', '%s', '%s')";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $this->DocPartenaireID ), mysqli_real_escape_string ($_SESSION['LINK'], $this->Titre ), mysqli_real_escape_string ($_SESSION['LINK'], $this->PictoTitre ), mysqli_real_escape_string ($_SESSION['LINK'], $this->ContenuRichText ), mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function SQL_update() {
		$sql = "UPDATE wcm_document_partenaire_page SET ";
		$sql .= " Titre='%s',";
		$sql .= " PictoTitre='%s',";
		$sql .= " ContenuRichText='%s'";
		$sql .= " WHERE DocPartenairePageID='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $this->Titre ), mysqli_real_escape_string ($_SESSION['LINK'], $this->PictoTitre ), mysqli_real_escape_string ($_SESSION['LINK'], $this->ContenuRichText ), mysqli_real_escape_string ($_SESSION['LINK'], $this->ID ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function SQL_delete() {
		$query = sprintf ( "DELETE FROM wcm_document_partenaire_page WHERE DocPartenairePageID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $this->ID ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function SQL_select($DocID) {
		$query = sprintf ( "SELECT DocPartenairePageID, DocPartenaireID, Titre, PictoTitre, ContenuRichText, SiteID FROM wcm_document_partenaire_page WHERE DocPartenairePageID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $DocID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array  ( $result );

			$this->ID = $line [0];
			$this->DocPartenaireID = $line [1];
			$this->Titre = $line [2];
			$this->PictoTitre = $line [3];
			$this->ContenuRichText = $line [4];
			$this->SiteID = $line [5];
		} else {
			$this->__construct ();
		}

		mysqli_free_result  ( $result );
	}
}
?>