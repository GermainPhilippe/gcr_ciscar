<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage categorie
 * @version 1.0.4
 */
class CategorieDocInfoDyn {
	private $ID;
	private $SiteID;
	private $ParentCategorieID;
	private $Description;
	private $URLImage;
	private $URLImageSmall;
	private $NbDocinfodyn;
	public function __construct() {
		$this->ID = NULL;
		$this->SiteID = NULL;
		$this->ParentCategorieID = NULL;
		$this->Description = '';
		$this->URLImage = '';
		$this->URLImageSmall = '';
		$this->NbDocinfodyn = 0;
	}

	// ###
	public function getID() {
		return $this->ID;
	}
	public function getSiteID() {
		return $this->SiteID;
	}
	public function getParentID() {
		return $this->ParentCategorieID;
	}
	public function getDescription() {
		return $this->Description;
	}
	public function getURLImage() {
		return $this->URLImage;
	}
	public function getURLImageSmall() {
		return $this->URLImageSmall;
	}
	public function getNbDocinfodyn() {
		$query = sprintf ( "SELECT count(*) FROM wcm_document_infodyn_categorie d WHERE (d.CatTypeID='%s' OR d.CatThemeID='%s' OR d.CatMetierID='%s')", mysqli_real_escape_string ($_SESSION['LINK'], $this->ID ), mysqli_real_escape_string ($_SESSION['LINK'], $this->ID ), mysqli_real_escape_string ($_SESSION['LINK'], $this->ID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
		$line = 0;
		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array  ( $result );
			$line = $line [0];
		}
		mysqli_free_result  ( $result );

		return $line;
	}
	public function setID($newValue) {
		$this->ID = $newValue;
	}
	public function setSiteID($newValue) {
		$this->SiteID = $newValue;
	}
	public function setParentID($newValue) {
		$this->ParentCategorieID = $newValue;
	}
	public function setDescription($newValue) {
		$this->Description = $newValue;
	}
	public function setURLImage($newValue) {
		$this->URLImage = $newValue;
	}
	public function setURLImageSmall($newValue) {
		$this->URLImageSmall = $newValue;
	}
	public function getCategorieType() {
		if (is_null ( $this->ParentCategorieID )) {
			return '1';
		} else {
			$query = sprintf ( "SELECT DocCatParentID FROM wcm_document_categorie WHERE DocCategorieID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $this->ParentCategorieID ) );

			$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
			$line = mysqli_fetch_array  ( $result );
			mysqli_free_result  ( $result );

			return is_null ( $line [0] ) ? '2' : '3';
		}
	}

	// ###
	public function SQL_create() {
		$sql = "INSERT INTO wcm_document_categorie (DocCategorieID, SiteID, DocCatParentID, Description, URL_Image, URL_ImageSmall)";
		$sql .= " VALUES(NULL";
		$sql .= is_null ( $this->SiteID ) ? ",NULL" : ", '" . $this->SiteID . "'";
		$sql .= is_null ( $this->ParentCategorieID ) ? ",NULL" : ", '" . $this->ParentCategorieID . "'";
		$sql .= ",'%s'";
		$sql .= ! is_null ( $this->ParentCategorieID ) ? ",'','')" : ", '%s', '%s')";

		if (! is_null ( $this->ParentCategorieID )) {
			$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $this->Description ) );
		} else {
			$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $this->Description ), mysqli_real_escape_string ($_SESSION['LINK'], $this->URLImage ), mysqli_real_escape_string ($_SESSION['LINK'], $this->URLImageSmall ) );
		}

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function SQL_update() {
		$sql = "UPDATE wcm_document_categorie SET Description='%s'";
		$sql .= is_null ( $this->ParentCategorieID ) ? ", DocCatParentID=NULL" : ", DocCatParentID='" . $this->ParentCategorieID . "'";
		$sql .= ! is_null ( $this->ParentCategorieID ) ? ", URL_Image='', URL_ImageSmall=''" : ", URL_Image='%s', URL_ImageSmall='%s'";
		$sql .= " WHERE DocCategorieID='%s'";

		if (! is_null ( $this->ParentCategorieID )) {
			$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $this->Description ), mysqli_real_escape_string ($_SESSION['LINK'], $this->ID ) );
		} else {
			$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $this->Description ), mysqli_real_escape_string ($_SESSION['LINK'], $this->URLImage ), mysqli_real_escape_string ($_SESSION['LINK'], $this->URLImageSmall ), mysqli_real_escape_string ($_SESSION['LINK'], $this->ID ) );
		}
		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function SQL_delete() {
		$query = sprintf ( "DELETE FROM wcm_document_categorie WHERE DocCategorieID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $this->ID ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function SQL_select($CategorieID) {
		$query = sprintf ( "SELECT DocCategorieID, SiteID, DocCatParentID, Description, URL_Image, URL_ImageSmall FROM wcm_document_categorie WHERE DocCategorieID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $CategorieID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array  ( $result );

			$this->ID = $line [0];
			$this->SiteID = $line [1];
			$this->ParentCategorieID = $line [2];
			$this->Description = $line [3];
			$this->URLImage = $line [4];
			$this->URLImageSmall = $line [5];
		} else {
			$this->__construct ();
		}

		mysqli_free_result  ( $result );
	}
}
?>