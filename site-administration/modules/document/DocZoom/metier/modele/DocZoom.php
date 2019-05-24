<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage document
 * @version 1.0.4
 */
class DocZoom {
	private $ID;
	private $Titre;
	private $Accroche;
	private $ImagePortail;
	private $DocInfoDynID;
	private $NumOrdre;
	private $Publication;
	private $SiteID;
	private $DateCreationDocInfoDyn;
	public function __construct() {
		$this->ID = NULL;
		$this->Titre = '';
		$this->Accroche = '';
		$this->ImagePortail = '';
		$this->DocInfoDynID = NULL;
		$this->NumOrdre = 0;
		$this->Publication = 0;
		$this->SiteID = NULL;
		$this->DateCreationDocInfoDyn = '';
	}

	// ###
	public function getID() {
		return $this->ID;
	}
	public function getTitre() {
		return $this->Titre;
	}
	public function getAccroche() {
		return $this->Accroche;
	}
	public function getImagePortail() {
		return $this->ImagePortail;
	}
	public function getDocInfoDynID() {
		return $this->DocInfoDynID;
	}
	public function getNumOrdre() {
		return $this->NumOrdre;
	}
	public function getPublication() {
		return $this->Publication;
	}
	public function getSiteID() {
		return $this->SiteID;
	}
	public function getDateCreationDocInfoDyn() {
		return $this->DateCreationDocInfoDyn;
	}
	public function setID($newValue) {
		$this->ID = $newValue;
	}
	public function setTitre($newValue) {
		$this->Titre = $newValue;
	}
	public function setAccroche($newValue) {
		$this->Accroche = $newValue;
	}
	public function setImagePortail($newValue) {
		$this->ImagePortail = $newValue;
	}
	public function setDocInfoDynID($newValue) {
		$this->DocInfoDynID = $newValue;
	}
	public function setNumOrdre($newValue) {
		$this->NumOrdre = $newValue;
	}
	public function setPublication($newValue) {
		$this->Publication = $newValue;
	}
	public function setSiteID($newValue) {
		$this->SiteID = $newValue;
	}
	public function setDateCreationDocInfoDyn($newValue) {
		$this->DateCreationDocInfoDyn = $newValue;
	}

	// ###
	public function SQL_create() {
		$sql = "INSERT INTO wcm_document_zoom (DocZoomID, Titre, Accroche, ImagePortail, DocInfoDynID, NumOrdre, Publication, SiteID)";
		$sql .= " VALUES(NULL, '%s', '%s', '%s'";
		$sql .= is_null ( $this->DocInfoDynID ) ? ", NULL" : ", '%s'";
		$sql .= ", '%s', '%s', '%s')";

		if (is_null ( $this->DocInfoDynID )) {
			$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $this->Titre ), mysqli_real_escape_string ($_SESSION['LINK'], $this->Accroche ), mysqli_real_escape_string ($_SESSION['LINK'], $this->ImagePortail ), mysqli_real_escape_string ($_SESSION['LINK'], $this->NumOrdre ), mysqli_real_escape_string ($_SESSION['LINK'], $this->Publication ), mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ) );
		} else {
			$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $this->Titre ), mysqli_real_escape_string ($_SESSION['LINK'], $this->Accroche ), mysqli_real_escape_string ($_SESSION['LINK'], $this->ImagePortail ), mysqli_real_escape_string ($_SESSION['LINK'], $this->DocInfoDynID ), mysqli_real_escape_string ($_SESSION['LINK'], $this->NumOrdre ), mysqli_real_escape_string ($_SESSION['LINK'], $this->Publication ), mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ) );
		}

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function SQL_update() {
		$sql = "UPDATE wcm_document_zoom SET ";
		$sql .= "Titre='%s', Accroche='%s', ImagePortail='%s'";
		$sql .= ", NumOrdre='%s', Publication='%s'";
		$sql .= " WHERE DocZoomID='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $this->Titre ), mysqli_real_escape_string ($_SESSION['LINK'], $this->Accroche ), mysqli_real_escape_string ($_SESSION['LINK'], $this->ImagePortail ), mysqli_real_escape_string ($_SESSION['LINK'], $this->NumOrdre ), mysqli_real_escape_string ($_SESSION['LINK'], $this->Publication ), mysqli_real_escape_string ($_SESSION['LINK'], $this->ID ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function SQL_delete() {
		$query = sprintf ( "DELETE FROM wcm_document_zoom WHERE DocZoomID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $this->ID ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function SQL_select($DocID) {
		$query = sprintf ( "SELECT DocZoomID, Titre, Accroche, ImagePortail, DocInfoDynID, NumOrdre, Publication, SiteID FROM wcm_document_zoom WHERE DocZoomID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $DocID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array  ( $result );

			$this->ID = $line [0];
			$this->Titre = $line [1];
			$this->Accroche = $line [2];
			$this->ImagePortail = $line [3];
			$this->DocInfoDynID = $line [4];
			$this->NumOrdre = $line [5];
			$this->Publication = $line [6];
			$this->SiteID = $line [7];
		} else {
			$this->ID = NULL;
			$this->Titre = '';
			$this->Accroche = '';
			$this->ImagePortail = '';
			$this->DocInfoDynID = NULL;
			$this->NumOrdre = 0;
			$this->Publication = 0;
			$this->SiteID = NULL;
		}

		mysqli_free_result  ( $result );
	}
}
?>