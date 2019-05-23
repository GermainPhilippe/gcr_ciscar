<?php
/**
 * @author Florent DESPIERRES
 * @package portail-ciscar
 * @subpackage document
 * @version 1.0.4
 */
class DocInfoDynParType {
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
	public function SQL_select_all($CatTypeID, $CatThemeID) {
		$this->myList = array ();
		
		$sql = "SELECT DISTINCT(DocInfoDynID),Titre,Accroche,DateDebut";
		$sql .= " FROM wcm_document_infodyn_compact";
		$sql .= " WHERE CatTypeID='%s'";
		$sql .= is_null ( $CatThemeID ) ? "" : " AND CatThemeID='%s'";
		$sql .= " AND (((DateDebut IS NULL) AND (DateFin IS NULL)) OR ((curdate() >= DateDebut) AND (curdate() <= DateFin)) OR((curdate() >= DateDebut) AND (DateFin IS NULL)) OR ((DateDebut IS NULL) AND (curdate() <= DateFin)))";
		$sql .= " AND LCAGroupeID IN (" . $this->MergeArray ( $_SESSION [$_SESSION ['SITE'] ['NAME']] ['USER'] ['GROUPS'] ) . ")";
		$sql .= ' GROUP BY Titre,Accroche,DateCreation ORDER BY DateDebut DESC';
		
		if (is_null ( $CatThemeID )) {
			$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'] , $CatTypeID ) );
		} else {
			$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'] , $CatTypeID ), mysqli_real_escape_string ($_SESSION['LINK'] , $CatThemeID ) );
		}
		
		$result = mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
		
		while ( $line = mysqli_fetch_array ( $result ) ) {
			$aModele = new DocInfoDyn ();
			$aModele->setID ( $line [0] );
			$aModele->setTitre ( $line [1] );
			$aModele->setAccroche ( $line [2] );
			$aModele->setDateCreation ( $line [3] );
			
			$this->myList [] = $aModele;
		}
		
		mysqli_free_result ( $result );
	}
}
?>