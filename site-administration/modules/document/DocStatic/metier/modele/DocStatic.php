<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage document
 * @version 1.0.4
 */
class DocStatic {
	private $ID;
	private $CatTypeID;
	private $Titre;
	private $ContenuRichText;
	private $SiteID;
	public function __construct() {
		$this->ID = NULL;
		$this->CatTypeID = NULL;
		$this->Titre = '';
		$this->ContenuRichText = '';
		$this->SiteID = NULL;
	}

	// ###
	public function getID() {
		return $this->ID;
	}
	public function getCatTypeID() {
		return $this->CatTypeID;
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
	public function setID($newValue) {
		$this->ID = $newValue;
	}
	public function setCatTypeID($newValue) {
		$this->CatTypeID = $newValue;
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

	// ###
	public function SQL_create() {
		$sql = "INSERT INTO wcm_document_static (DocStaticID, CatTypeID, Titre, ContenuRichText, SiteID)";
		$sql .= " VALUES(NULL, ";
		$sql .= is_null ( $this->CatTypeID ) ? "NULL," : "'%s',";
		$sql .= " '%s', '%s','%s')";

		if (is_null ( $this->CatTypeID )) {
			$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $this->Titre ), mysqli_real_escape_string ($_SESSION['LINK'], $this->ContenuRichText ), mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ) );
		} else {
			$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $this->CatTypeID ), mysqli_real_escape_string ($_SESSION['LINK'], $this->Titre ), mysqli_real_escape_string ($_SESSION['LINK'], $this->ContenuRichText ), mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ) );
		}

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function SQL_update() {
		$sql = "UPDATE wcm_document_static SET ";
		$sql .= is_null ( $this->CatTypeID ) ? "CatTypeID=NULL," : "CatTypeID='%s',";
		$sql .= " Titre='%s', ContenuRichText='%s'";
		$sql .= " WHERE DocStaticID='%s'";

		if (is_null ( $this->CatTypeID )) {
			$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $this->Titre ), mysqli_real_escape_string ($_SESSION['LINK'], $this->ContenuRichText ), mysqli_real_escape_string ($_SESSION['LINK'], $this->ID ) );
		} else {
			$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $this->CatTypeID ), mysqli_real_escape_string ($_SESSION['LINK'], $this->Titre ), mysqli_real_escape_string ($_SESSION['LINK'], $this->ContenuRichText ), mysqli_real_escape_string ($_SESSION['LINK'], $this->ID ) );
		}

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function SQL_delete() {
		$query = sprintf ( "DELETE FROM wcm_document_static WHERE DocStaticID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $this->ID ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function SQL_select($DocID) {
		$query = sprintf ( "SELECT DocStaticID, CatTypeID, Titre, ContenuRichText, SiteID FROM wcm_document_static WHERE DocStaticID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $DocID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array  ( $result );

			$this->ID = $line [0];
			$this->CatTypeID = $line [1];
			$this->Titre = $line [2];
			$this->ContenuRichText = $line [3];
			$this->SiteID = $line [4];
		} else {
			$this->ID = NULL;
			$this->CatTypeID = NULL;
			$this->Titre = '';
			$this->ContenuRichText = '';
			$this->SiteID = NULL;
		}

		mysqli_free_result  ( $result );
	}
}
?>