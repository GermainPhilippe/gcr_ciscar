<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage document
 * @version 1.0.4
 */
class DocInfoDynCategorieList {
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
	public function getNbElement() {
		return count ( $this->myList ) + 1;
	}

	// ###
	public function SQL_select_all($DocInfoDynID) {
		$this->myList = array ();

		$sql = "SELECT DocInfoDynID, CatTypeID, CatThemeID, CatMetierID,CatUne ";
		$sql .= "FROM wcm_document_infodyn_categorie ";
		$sql .= "WHERE DocInfoDynID='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $DocInfoDynID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aModele = new DocInfoDynCategorie ();
			$aModele->setDocInfoDynID ( $line [0] );
			$aModele->setCatTypeID ( $line [1] );
			$aModele->setCatThemeID ( $line [2] );
			$aModele->setCatMetierID ( $line [3] );
			$aModele->setCatUne ( $line [4] );
			$this->myList [] = $aModele;
		}

		mysqli_free_result  ( $result );
	}
	public function SQL_delete_all($DocInfoDynID) {
		$sql = "DELETE FROM wcm_document_infodyn_categorie WHERE";
		$sql .= is_null ( $DocInfoDynID ) ? " DocInfoDynID=NULL" : " DocInfoDynID='" . $DocInfoDynID . "'";

		mysqli_query ($_SESSION['LINK'], $sql ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
}
?>