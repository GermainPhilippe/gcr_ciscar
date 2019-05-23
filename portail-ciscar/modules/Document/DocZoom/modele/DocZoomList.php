<?php
/**
 * @author Florent DESPIERRES
 * @package portail-ciscar
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
	private function MergeArray($aArray) {
		$result = '';
		foreach ( $aArray as $aElement ) {
			$result .= ($result == '' ? '' : ',') . $aElement;
		}
		return $result;
	}
	public function SQL_select_all() {
		$this->myList = array ();
		
		$sql = "SELECT DISTINCT(z.DocInfoDynID), z.DocZoomID, z.Titre, z.Accroche, z.ImagePortail";
		$sql .= " FROM `wcm_document_zoom` z, wcm_document_infodyn i, wcm_document_infodyn_lca l";
		$sql .= " WHERE z.SiteID='%s' AND z.Publication='1' AND z.DocInfoDynID=i.DocInfoDynID AND l.DocInfoDynID=z.DocInfoDynID";
		$sql .= " AND (((i.DateDebut IS NULL) AND (i.DateFin IS NULL)) OR ((curdate() >= i.DateDebut) AND (curdate() <= i.DateFin)) OR((curdate() >= i.DateDebut) AND (i.DateFin IS NULL)) OR ((i.DateDebut IS NULL) AND (curdate() <= i.DateFin)))";
		$sql .= " AND l.LCAGroupeID IN (" . $this->MergeArray ( $_SESSION [$_SESSION ['SITE'] ['NAME']] ['USER'] ['GROUPS'] ) . ")";
		$sql .= " ORDER BY z.NumOrdre";
		
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'] , $_SESSION ['SITE'] ['ID'] ) );
		
		$result = mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
		
		while ( $line = mysqli_fetch_array ( $result ) ) {
			$aModele = new DocZoom ();
			$aModele->setID ( $line [1] );
			$aModele->setTitre ( $line [2] );
			$aModele->setAccroche ( $line [3] );
			$aModele->setImagePortail ( $line [4] );
			$aModele->setDocInfoDynID ( $line [0] );
			
			$this->myList [] = $aModele;
		}
		
		mysqli_free_result ( $result );
	}
}
?>