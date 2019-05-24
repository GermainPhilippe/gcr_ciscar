<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage categorie
 * @version 1.0.4
 */
class CategorieDocInfoDynList {
	private $myList;
	public function __construct() {
		$this->myList = array ();
	}

	// ###
	public function getList() {
		return $this->myList;
	}
	public function setList($newValue) {
		$this->myList = $newvalue;
	}

	// ###
	public function SQL_select_all() {
		$this->myList = array ();

		$sql = "SELECT c.DocCategorieID, c.SiteID, c.DocCatParentID, c.Description, c.URL_Image, c.URL_ImageSmall FROM wcm_document_categorie c WHERE c.SiteID='%s' ORDER BY Description";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aModele = new CategorieDocInfoDyn ();
			$aModele->setID ( $line [0] );
			$aModele->setSiteID ( $line [1] );
			$aModele->setParentID ( $line [2] );
			$aModele->setDescription ( $line [3] );
			$aModele->setURLImage ( $line [4] );
			$aModele->setURLImageSmall ( $line [5] );

			$this->myList [] = $aModele;
		}

		mysqli_free_result  ( $result );
	}
	public function SQL_select_all_type() {
		$this->myList = array ();

		$sql = "SELECT c.DocCategorieID, c.SiteID, c.DocCatParentID, c.Description,c.URL_Image,c.URL_ImageSmall FROM wcm_document_categorie c WHERE c.SiteID='%s' AND DocCatParentID IS NULL ORDER BY Description";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aModele = new CategorieDocInfoDyn ();
			$aModele->setID ( $line [0] );
			$aModele->setSiteID ( $line [1] );
			$aModele->setParentID ( $line [2] );
			$aModele->setDescription ( $line [3] );
			$aModele->setURLImage ( $line [4] );
			$aModele->setURLImageSmall ( $line [5] );

			$this->myList [] = $aModele;
		}

		mysqli_free_result  ( $result );
	}
	public function SQL_select_all_souscat($CatID) {
		$this->myList = array ();

		$sql = "SELECT c.DocCategorieID, c.SiteID, c.DocCatParentID, c.Description,c.URL_Image,c.URL_ImageSmall FROM wcm_document_categorie c WHERE c.SiteID='%s' AND DocCatParentID='%s' ORDER BY Description";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ), mysqli_real_escape_string ($_SESSION['LINK'], $CatID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aModele = new CategorieDocInfoDyn ();
			$aModele->setID ( $line [0] );
			$aModele->setSiteID ( $line [1] );
			$aModele->setParentID ( $line [2] );
			$aModele->setDescription ( $line [3] );
			$aModele->setURLImage ( $line [4] );
			$aModele->setURLImageSmall ( $line [5] );

			$this->myList [] = $aModele;
		}

		mysqli_free_result  ( $result );
	}
	public function SQL_SEARCH($rech) {
		$this->myList = array ();

		$sql = "SELECT distinct(CatTypeID), c.Description";
		$sql .= " FROM `wcm_document_infodyn_compact` i, wcm_document_categorie c ";
		$sql .= " WHERE i.SiteID='%s' and c.DocCategorieID=i.CatTypeID and i.Titre LIKE '%s' ORDER BY c.Description";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $rech . '%' ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aModele = new CategorieDocInfoDyn ();
			$aModele->setID ( $line [0] );
			$aModele->setDescription ( $line [1] );

			$this->myList [] = $aModele;
		}

		mysqli_free_result  ( $result );
	}
}
?>