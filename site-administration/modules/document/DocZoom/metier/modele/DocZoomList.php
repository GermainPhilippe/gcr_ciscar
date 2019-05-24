<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage document
 * @version 1.0.4
 */
class DocZoomList {
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

	// ###
	public function SQL_SELECT_ALL_TRI($column = '1', $Order = 'a') {
		$this->myList = array ();

		$sql = "SELECT z.DocZoomID, z.Titre, z.Accroche, z.ImagePortail, z.DocInfoDynID, z.NumOrdre, z.Publication, z.SiteID,i.DateCreation FROM wcm_document_zoom z, wcm_document_infodyn i WHERE i.DocInfoDynID=z.DocInfoDynID AND z.SiteID='%s'";
		switch ($column) {
			case '2' :
				$sql .= " ORDER BY z.NumOrdre";
				break;
			case '3' :
				$sql .= " ORDER BY z.Publication";
				break;
			case '4' :
				$sql .= " ORDER BY i.DateCreation";
				break;
			default :
				$sql .= " ORDER BY z.Titre";
				break;
		}

		$query = sprintf ( $sql . ($Order == 'a' ? ' ASC' : ' DESC'), mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aModele = new DocZoom ();
			$aModele->setID ( $line [0] );
			$aModele->setTitre ( $line [1] );
			$aModele->setAccroche ( $line [2] );
			$aModele->setImagePortail ( $line [3] );
			$aModele->setDocInfoDynID ( $line [4] );
			$aModele->setNumOrdre ( $line [5] );
			$aModele->setPublication ( $line [6] );
			$aModele->setSiteID ( $line [7] );
			$aModele->setDateCreationDocInfoDyn ( $line [8] );

			$this->myList [] = $aModele;
		}

		mysqli_free_result  ( $result );
	}
	public function SQL_select_all() {
		$this->myList = array ();

		$query = sprintf ( "SELECT z.DocZoomID, z.Titre, z.Accroche, z.ImagePortail, z.DocInfoDynID, z.NumOrdre, z.Publication, z.SiteID,i.DateCreation FROM wcm_document_zoom z, wcm_document_infodyn i WHERE i.DocInfoDynID=z.DocInfoDynID AND z.SiteID='%s' ORDER BY z.Titre ASC, i.DateCreation DESC, z.NumOrdre ASC, z.Publication DESC", mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aModele = new DocZoom ();
			$aModele->setID ( $line [0] );
			$aModele->setTitre ( $line [1] );
			$aModele->setAccroche ( $line [2] );
			$aModele->setImagePortail ( $line [3] );
			$aModele->setDocInfoDynID ( $line [4] );
			$aModele->setNumOrdre ( $line [5] );
			$aModele->setPublication ( $line [6] );
			$aModele->setSiteID ( $line [7] );
			$aModele->setDateCreationDocInfoDyn ( $line [8] );

			$this->myList [] = $aModele;
		}

		mysqli_free_result  ( $result );
	}
	public function SQL_SELECT_BY_DOCINFODYN($DocInfoDynID) {
		$this->myList = array ();

		$query = sprintf ( "SELECT DocZoomID, Titre, Accroche, ImagePortail, DocInfoDynID, NumOrdre, Publication, SiteID FROM wcm_document_zoom WHERE SiteID='%s' AND DocInfoDynID='%s' ORDER BY NumOrdre", mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ), mysqli_real_escape_string ($_SESSION['LINK'], $DocInfoDynID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aModele = new DocZoom ();
			$aModele->setID ( $line [0] );
			$aModele->setTitre ( $line [1] );
			$aModele->setAccroche ( $line [2] );
			$aModele->setImagePortail ( $line [3] );
			$aModele->setDocInfoDynID ( $line [4] );
			$aModele->setNumOrdre ( $line [5] );
			$aModele->setPublication ( $line [6] );
			$aModele->setSiteID ( $line [7] );

			$this->myList [] = $aModele;
		}

		mysqli_free_result  ( $result );
	}
}
?>