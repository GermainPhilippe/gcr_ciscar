<?php
/**
 * @author Florent DESPIERRES
 * @package portail-ciscar
 * @subpackage categorie
 * @version 1.0.4
 */
class CategorieList {
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
		
		$result = mysqli_query ( $_SESSION['LINK'] ,"SELECT DocCategorieID, SiteID, DocCatParentID, Description,URL_Image FROM wcm_document_categorie WHERE SiteID='" . $_SESSION ['SITE'] ['ID'] . "' ORDER BY Description" ) or die ( mysqli_error ($_SESSION['LINK']) );
		
		while ( $line = mysqli_fetch_array ( $result ) ) {
			$aModele = new Categorie ();
			$aModele->setID ( $line [0] );
			$aModele->setSiteID ( $line [1] );
			$aModele->setParentID ( $line [2] );
			$aModele->setDescription ( $line [3] );
			$aModele->setURLImage ( $line [4] );
			
			$this->myList [] = $aModele;
		}
		
		mysqli_free_result ( $result );
	}
	public function SQL_select_all_type() {
		$this->myList = array ();
		
		$result = mysqli_query ( $_SESSION['LINK'] ,"SELECT DocCategorieID, SiteID, DocCatParentID, Description FROM wcm_document_categorie WHERE SiteID='" . $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] . "' AND DocCatParentID IS NULL ORDER BY Description" ) or die ( mysqli_error ($_SESSION['LINK']) );
		
		while ( $line = mysqli_fetch_array ( $result ) ) {
			$aModele = new Categorie ();
			$aModele->setID ( $line [0] );
			$aModele->setSiteID ( $line [1] );
			$aModele->setParentID ( $line [2] );
			$aModele->setDescription ( $line [3] );
			
			$this->myList [] = $aModele;
		}
		
		mysqli_free_result ( $result );
	}
	public function SQL_select_all_souscat($CatID) {
		// $this->myList = array();
		$result = mysqli_query ( $_SESSION['LINK'] ,"SELECT DocCategorieID, SiteID, DocCatParentID, Description FROM wcm_document_categorie WHERE DocCatParentID='" . $CatID . "' ORDER BY Description" ) or die ( mysqli_error ($_SESSION['LINK']) );
		
		while ( $line = mysqli_fetch_array ( $result ) ) {
			$aModele = new Categorie ();
			$aModele->setID ( $line [0] );
			$aModele->setSiteID ( $line [1] );
			$aModele->setParentID ( $line [2] );
			$aModele->setDescription ( $line [3] );
			
			$this->myList [] = $aModele;
		}
		
		mysqli_free_result ( $result );
	}
	public function SQL_SELECT_THEME_AVEC_DOC($id) {
		$sql = "SELECT DISTINCT(i.CatThemeID), c.Description, c.SiteID, c.DocCatParentID, c.Description";
		$sql .= " FROM wcm_document_infodyn_compact i, wcm_document_categorie c";
		$sql .= " WHERE i.CatThemeID = c.DocCategorieID";
		$sql .= " AND i.CatTypeID = '%s'";
		$sql .= " AND i.SiteID='" . $_SESSION ['SITE'] ['ID'] . "'";
		$sql .= " AND (((i.DateDebut IS NULL) AND (i.DateFin IS NULL)) OR ((curdate() >= i.DateDebut) AND (curdate() <= i.DateFin)) OR((curdate() >= i.DateDebut) AND (i.DateFin IS NULL)) OR ((i.DateDebut IS NULL) AND (curdate() <= i.DateFin)))";
		$sql .= " AND LCAGroupeID IN (" . $this->MergeArray ( $_SESSION [$_SESSION ['SITE'] ['NAME']] ['USER'] ['GROUPS'] ) . ")";
		$sql .= " ORDER BY c.Description";
		
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'] , $id ) );
		
		$result = mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
		
		while ( $line = mysqli_fetch_array ( $result ) ) {
			$aModele = new Categorie ();
			$aModele->setID ( $line [0] );
			$aModele->setSiteID ( $line [2] );
			$aModele->setParentID ( $line [2] );
			$aModele->setDescription ( $line [1] );
			
			$this->myList [] = $aModele;
		}
		mysqli_free_result ( $result );
	}
	public function SQL_SELECT_METIER_AVEC_DOC($id) {
		$sql = "SELECT DISTINCT(i.CatThemeID), c.Description, c.SiteID, c.DocCatParentID, c.Description";
		$sql .= " FROM wcm_document_infodyn_compact i, wcm_document_categorie c";
		$sql .= " WHERE i.CatMetierID = c.DocCategorieID";
		$sql .= " AND i.CatThemeID = '%s'";
		$sql .= " AND i.SiteID='" . $_SESSION ['SITE'] ['ID'] . "'";
		$sql .= " AND (((i.DateDebut IS NULL) AND (i.DateFin IS NULL)) OR ((curdate() >= i.DateDebut) AND (curdate() <= i.DateFin)) OR((curdate() >= i.DateDebut) AND (i.DateFin IS NULL)) OR ((i.DateDebut IS NULL) AND (curdate() <= i.DateFin)))";
		$sql .= " AND LCAGroupeID IN (" . $this->MergeArray ( $_SESSION [$_SESSION ['SITE'] ['NAME']] ['USER'] ['GROUPS'] ) . ")";
		$sql .= " ORDER BY c.Description";
		
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'] , $id ) );
		
		$result = mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
		
		while ( $line = mysqli_fetch_array ( $result ) ) {
			$aModele = new Categorie ();
			$aModele->setID ( $line [0] );
			$aModele->setSiteID ( $line [2] );
			$aModele->setParentID ( $line [2] );
			$aModele->setDescription ( $line [1] );
			
			$this->myList [] = $aModele;
		}
		mysqli_free_result ( $result );
	}
	private function MergeArray($aArray) {
		$result = '';
		foreach ( $aArray as $aElement ) {
			$result .= ($result == '' ? '' : ',') . $aElement;
		}
		return $result;
	}
}
?>