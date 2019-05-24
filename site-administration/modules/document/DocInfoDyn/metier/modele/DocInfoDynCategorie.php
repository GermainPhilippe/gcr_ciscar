<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage document
 * @version 1.0.4
 */
class DocInfoDynCategorie {
	private $DocInfoDynID;
	private $CatTypeID;
	private $CatThemeID;
	private $CatMetierID;
	private $CatUne;
	public function __construct() {
		$this->DocInfoDynID = NULL;
		$this->CatTypeID = NULL;
		$this->CatThemeID = NULL;
		$this->CatMetierID = NULL;
		$this->CatUne = NULL;
	}

	// ###
	public function getDocInfoDynID() {
		return $this->DocInfoDynID;
	}
	public function getCatTypeID() {
		return $this->CatTypeID;
	}
	public function getCatThemeID() {
		return $this->CatThemeID;
	}
	public function getCatMetierID() {
		return $this->CatMetierID;
	}
	public function getCatUne() {
		return $this->CatUne;
	}
	public function setDocInfoDynID($newValue) {
		$this->DocInfoDynID = $newValue;
	}
	public function setCatTypeID($newValue) {
		$this->CatTypeID = $newValue;
	}
	public function setCatThemeID($newValue) {
		$this->CatThemeID = $newValue;
	}
	public function setCatMetierID($newValue) {
		$this->CatMetierID = $newValue;
	}
	public function setCatUne($newValue) {
		$this->CatUne = $newValue;
	}

	// ###
	public function SQL_create() {
		$sql = "INSERT INTO wcm_document_infodyn_categorie (DocInfoDynID, CatTypeID, CatThemeID, CatMetierID,CatUne)";
		$sql .= " VALUES(";
		$sql .= is_null ( $this->DocInfoDynID ) ? "NULL" : "'" . $this->DocInfoDynID . "'";
		$sql .= is_null ( $this->CatTypeID ) ? ",NULL" : ",'" . $this->CatTypeID . "'";
		$sql .= is_null ( $this->CatThemeID ) ? ",NULL" : ",'" . $this->CatThemeID . "'";
		$sql .= is_null ( $this->CatMetierID ) ? ",NULL" : ",'" . $this->CatMetierID . "'";
		$sql .= is_null ( $this->CatUne ) ? ",NULL" : ",'" . $this->CatUne . "'";
		$sql .= ")";

		mysqli_query ($_SESSION['LINK'], $sql ) or die ( mysqli_error ($_SESSION['LINK']) );

		$sql = "UPDATE wcm_document_infodyn_categorie SET  CatUne =";
		$sql .= is_null ( $this->CatUne ) ? "NULL" : "'" . $this->CatUne . "'";
		$sql .= "  WHERE DocInfoDynID = " . $this->DocInfoDynID . "";
		mysqli_query ($_SESSION['LINK'], $sql ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function SQL_delete() {
		$sql = "DELETE FROM wcm_document_infodyn_categorie WHERE";
		$sql .= is_null ( $this->DocInfoDynID ) ? " DocInfoDynID=NULL" : " DocInfoDynID='" . $this->DocInfoDynID . "'";
		$sql .= is_null ( $this->CatTypeID ) ? " AND CatTypeID=NULL" : " AND CatTypeID='" . $this->CatTypeID . "'";
		$sql .= is_null ( $this->CatThemeID ) ? " AND CatThemeID=NULL" : " AND CatThemeID='" . $this->CatThemeID . "'";
		$sql .= is_null ( $this->CatMetierID ) ? " AND CatMetierID=NULL" : " AND CatMetierID='" . $this->CatMetierID . "'";
		$sql .= is_null ( $this->CatUne ) ? " AND Catune=NULL" : " AND Catune='" . $this->CatUne . "'";
		mysqli_query ($_SESSION['LINK'], $sql ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
}
?>
