<?php
/**
 * @author Florent DESPIERRES
 * @package portail-ciscar
 * @subpackage recherche
 * @version 1.0.4
 */
class RechercheDocument {
	public function __construct() {
	}
	private function MergeArray($aArray) {
		$result = '';
		foreach ( $aArray as $aElement ) {
			$result .= ($result == '' ? '' : ',') . $aElement;
		}
		return $result;
	}
	public function SQL_SEARCH($mot) {
		$aList = array ();
		
		$sql = "SELECT DISTINCT(i.DocInfoDynID), i.Titre, i.Accroche, i.DateCreation, Min(i.CatTypeID), c.URL_ImageSmall, c.Description";
		$sql .= " FROM wcm_document_infodyn_compact i, wcm_document_categorie c";
		$sql .= " WHERE i.CatTypeID = c.DocCategorieID";
		$sql .= " AND (i.Titre LIKE '%s' OR i.Accroche  LIKE '%s' OR i.ContenuRichText  LIKE '%s')";
		$sql .= " AND i.SiteID='%s'";
		$sql .= " AND (((i.DateDebut IS NULL) AND (i.DateFin IS NULL)) OR ((curdate() >= i.DateDebut) AND (curdate() <= i.DateFin)) OR((curdate() >= i.DateDebut) AND (i.DateFin IS NULL)) OR ((i.DateDebut IS NULL) AND (curdate() <= i.DateFin)))";
		$sql .= " AND LCAGroupeID IN (" . $this->MergeArray ( $_SESSION [$_SESSION ['SITE'] ['NAME']] ['USER'] ['GROUPS'] ) . ")";
		$sql .= " GROUP BY i.DocInfoDynID, i.Titre, i.Accroche, i.DateCreation";
		$sql .= " ORDER BY i.DateCreation DESC";
		
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'] , '%' . $mot . '%' ), mysqli_real_escape_string ($_SESSION['LINK'] , '%' . $mot . '%' ), mysqli_real_escape_string ($_SESSION['LINK'] , '%' . $mot . '%' ), mysqli_real_escape_string ($_SESSION['LINK'] , $_SESSION ['SITE'] ['ID'] ) );
		
		$result = mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
		
		while ( $line = mysqli_fetch_array ( $result ) ) {
			$aList [] = $line;
		}
		
		return $aList;
	}
}
?>