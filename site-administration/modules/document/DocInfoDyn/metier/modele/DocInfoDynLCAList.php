<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage document
 * @version 1.0.4
 */
class DocInfoDynLCAList {
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
	public function exist($LCAGroupeID) {
		foreach ( $this->myList as $aLCAGroupe ) {
			if ($aLCAGroupe->getLCAGroupeID () == $LCAGroupeID) {
				return true;
			}
		}

		return false;
	}

	// ###
	public function SQL_SELECT_ALL_GroupeLCA() {
		$this->myList = array ();

		$sql = "SELECT GroupeID, Libelle FROM annuaire_lca_groupe WHERE TypeGroupeID='4'";
		if ($_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] == '1') {
			$sql .= " OR GroupeID IN (8, 9, 15)";
		}
		// $query = sprintf($sql, mysql_real_escape_string($_SESSION['ADMIN']['USER']['AnnuaireID']));
		$result = mysqli_query ($_SESSION['LINK'], $sql ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$this->myList [] = $line;
		}

		mysqli_free_result  ( $result );
	}
	public function SQL_SELECT_ALL_DA() {
		$this->myList = array ();

		$sql = "SELECT LCAGroupeID, Libelle FROM annuaire_lva_domainactivite WHERE AnnuaireID='%s'";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ) );
		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$this->myList [] = $line;
		}

		mysqli_free_result  ( $result );
	}
	public function SQL_SELECT_ALL_Commission() {
		$this->myList = array ();

		$sql = "SELECT LCAGroupeID, Libelle FROM annuaire_lva_commission WHERE AnnuaireID='%s'";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ) );
		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$this->myList [] = $line;
		}

		mysqli_free_result  ( $result );
	}
	public function SQL_SELECT_ALL_Region() {
		$this->myList = array ();

		$sql = "SELECT LCAGroupeID, Libelle FROM annuaire_lva_region WHERE AnnuaireID='%s'";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ) );
		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$this->myList [] = $line;
		}

		mysqli_free_result  ( $result );
	}
	public function SQL_SELECT_ALL_GROUPE($DocInfoDynID) {
		$this->myList = array ();

		$sql = "SELECT DISTINCT(LCAGroupeID) FROM wcm_document_infodyn_lca WHERE DocInfoDynID='%s'";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $DocInfoDynID ) );
		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$this->myList [] = $line [0];
		}

		mysqli_free_result  ( $result );
	}
	// ###
	public function SQL_select_all($DocInfoDynID) {
		$this->myList = array ();

		$sql = "SELECT DISTINCT DocInfoDynID, LCAGroupeID ";
		$sql .= "FROM wcm_document_infodyn_lca ";
		$sql .= "WHERE DocInfoDynID='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $DocInfoDynID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aModele = new DocInfoDynLCA ();
			$aModele->setDocInfoDynID ( $line [0] );
			$aModele->setLCAGroupeID ( $line [1] );

			$this->myList [] = $aModele;
		}

		mysqli_free_result  ( $result );
	}
	public function SQL_delete_all($DocInfoDynID) {
		$sql = "DELETE FROM wcm_document_infodyn_lca WHERE ";
		$sql .= is_null ( $DocInfoDynID ) ? "DocInfoDynID=NULL" : "DocInfoDynID='" . $DocInfoDynID . "'";

		mysqli_query ($_SESSION['LINK'], $sql ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
}
?>