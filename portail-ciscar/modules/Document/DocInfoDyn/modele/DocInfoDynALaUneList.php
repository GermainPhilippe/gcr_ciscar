<?php
/**
 * @author Florent DESPIERRES
 * @package portail-ciscar
 * @subpackage document
 * @version 1.0.4
 */
class DocInfoDynALaUneList {
	private $myList;
	public function __construct() {
		$this->myList = array ();
	}
	public function getList() {
		return $this->myList;
	}
	private function MergeArray($aArray) {
		$result = '';
		foreach ( $aArray as $aElement ) {
			$result .= ($result == '' ? '' : ',') . $aElement;
		}
		return $result;
	}
	public function SQL_SELECT_ALL() {
		$this->myList = array ();
		
		$sql = "SELECT DISTINCT(a.DocInfoDynID), a.Titre, a.Accroche, a.VignetteAccroche, a.DateCreation, a.CatTypeID, c.CatUne";
		$sql .= " FROM wcm_document_infodyn_alaune a, wcm_document_infodyn_categorie c";
		$sql .= " WHERE a.SiteID='%s' AND c.DocInfoDynID=a.DocInfoDynID";
		$sql .= " AND (((a.DateDebut IS NULL) AND (a.DateFin IS NULL)) OR ((curdate() >= a.DateDebut) AND (curdate() <= a.DateFin)) OR((curdate() >= a.DateDebut) AND (a.DateFin IS NULL)) OR ((a.DateDebut IS NULL) AND (curdate() <= a.DateFin)))";
		$sql .= " AND LCAGroupeID IN (" . $this->MergeArray ( $_SESSION [$_SESSION ['SITE'] ['NAME']] ['USER'] ['GROUPS'] ) . ")";
		$sql .= " GROUP BY Titre, Accroche, VignetteAccroche ORDER BY a.DateDebut DESC";
		
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'] , $_SESSION ['SITE'] ['ID'] ) );
		
		$result = mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
		
		while ( $line = mysqli_fetch_array ( $result ) ) {
			$aModele = new DocInfoDyn ();
			$aModele->setID ( $line [0] );
			$aModele->setTitre ( $line [1] );
			$aModele->setAccroche ( $line [2] );
			$aModele->setVignetteAccroche ( $line [3] );
			$aModele->setDateCreation ( $line [4] );
			$aModele->setCatTypeID ( $line [6] );
			
			$this->myList [] = $aModele;
		}
		
		mysqli_free_result ( $result );
	}
}
?>