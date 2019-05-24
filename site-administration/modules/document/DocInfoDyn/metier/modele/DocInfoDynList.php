<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage document
 * @version 1.0.4
 */
class DocInfoDynList {
	private $myList;
	public function __construct() {
		$this->myList = array ();
	}

	// ###
	public function getList() {
		return $this->myList;
	}
	public function setList($newValue) {
		$this->myList = $newValue;
	}
	public function getNbDocument() {
		return count ( $this->myList );
	}

	// ###
	public function SQL_SELECT_BY_CATEGORIE($search, $CatID) {
		$this->myList = array ();
		$sql = "SELECT  i.DocInfoDynID, i.Titre, i.Accroche, i.BanniereID, i.PublicationALaUne, i.DateDebut, i.DateFin, i.AuteurID";
		$sql .= " FROM wcm_document_infodyn i, wcm_document_infodyn_categorie c";
		$sql .= " WHERE i.DocInfoDynID = c.DocInfoDynID AND i.SiteID='" . $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] . "' AND (c.CatTypeID='%s' OR c.CatThemeID='%s' OR c.CatMetierID='%s') AND (i.Titre LIKE '%s' OR i.DocInfoDynID LIKE '%s' OR i.DateDebut LIKE '%s' OR i.DateFin LIKE '%s') ORDER BY i.DateCreation DESC, i.DocInfoDynID DESC";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $CatID ), mysqli_real_escape_string ($_SESSION['LINK'], $CatID ), mysqli_real_escape_string ($_SESSION['LINK'], $CatID ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $search . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $search . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $search . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $search . '%' ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aModele = new DocInfoDyn ();
			$aModele->setID ( $line [0] );
			$aModele->setTitre ( $line [1] );
			$aModele->setAccroche ( $line [2] );
			$aModele->setBanniereID ( $line [3] );
			$aModele->setPublicationALaUne ( $line [4] );
			$aModele->setDateDebut ( $line [5] );
			$aModele->setDateFin ( $line [6] );
			$aModele->setAuteurID ( $line [7] );

			$this->myList [] = $aModele;
		}

		mysqli_free_result  ( $result );
	}
	public function SQL_SEARCH($search) {
		$this->myList = array ();
		$sql = "SELECT  i.DocInfoDynID, i.Titre, i.Accroche, i.BanniereID, i.PublicationALaUne, i.DateDebut, i.DateFin, i.AuteurID";
		$sql .= " FROM wcm_document_infodyn i";
		$sql .= " WHERE (i.Titre LIKE '%s' OR i.DocInfoDynID LIKE '%s' OR i.DateDebut LIKE '%s' OR i.DateFin LIKE '%s') AND i.SiteID='" . $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] . "' ORDER BY i.DateCreation DESC, i.DocInfoDynID DESC";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], '%' . $search . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $search . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $search . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $search . '%' ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aModele = new DocInfoDyn ();
			$aModele->setID ( $line [0] );
			$aModele->setTitre ( $line [1] );
			$aModele->setAccroche ( $line [2] );
			$aModele->setBanniereID ( $line [3] );
			$aModele->setPublicationALaUne ( $line [4] );
			$aModele->setDateDebut ( $line [5] );
			$aModele->setDateFin ( $line [6] );
			$aModele->setAuteurID ( $line [7] );

			$this->myList [] = $aModele;
		}

		mysqli_free_result  ( $result );
	}
	public function SQL_select_all_by_categorie($CatTypeID, $CatThemeID, $CatMetierID) {
		$this->myList = array ();

		$sql = "SELECT DocInfoDynID,Titre,Accroche,BanniereID,PublicationALaUne,DateDebut,DateFin,AuteurID";
		$sql .= " FROM wcm_document_infodyn";
		$sql .= " WHERE DocInfoDynID IN";
		$sql .= " (SELECT DocInfoDynID";
		$sql .= " FROM wcm_document_infodyn_categorie";
		$sql .= " WHERE CatTypeID='%s' AND CatThemeID='%s' AND CatMetierID='%s') ORDER BY DateDebut DESC";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $CatTypeID ), mysqli_real_escape_string ($_SESSION['LINK'], $CatThemeID ), mysqli_real_escape_string ($_SESSION['LINK'], $CatMetierID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aModele = new DocInfoDyn ();
			$aModele->setID ( $line [0] );
			$aModele->setTitre ( $line [1] );
			$aModele->setAccroche ( $line [2] );
			$aModele->setBanniereID ( $line [3] );
			$aModele->setPublicationALaUne ( $line [4] );
			$aModele->setDateDebut ( $line [5] );
			$aModele->setDateFin ( $line [6] );
			$aModele->setAuteurID ( $line [7] );

			$this->myList [] = $aModele;
		}

		mysqli_free_result  ( $result );
	}
	public function SQL_select_all() {
		$this->myList = array ();

		$result = mysqli_query ($_SESSION['LINK'], "SELECT DocInfoDynID,Titre,Accroche,BanniereID,PublicationALaUne,DateDebut,DateFin,AuteurID FROM wcm_document_infodyn WHERE SiteID='" . $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] . "' ORDER BY DateCreation DESC, DocInfoDynID DESC" ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aModele = new DocInfoDyn ();
			$aModele->setID ( $line [0] );
			$aModele->setTitre ( $line [1] );
			$aModele->setAccroche ( $line [2] );
			$aModele->setBanniereID ( $line [3] );
			$aModele->setPublicationALaUne ( $line [4] );
			$aModele->setDateDebut ( $line [5] );
			$aModele->setDateFin ( $line [6] );
			$aModele->setAuteurID ( $line [7] );

			$this->myList [] = $aModele;
		}

		mysqli_free_result  ( $result );
	}
}
?>