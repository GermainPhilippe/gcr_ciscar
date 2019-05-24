<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage role
 * @version 1.0.4
 */
class DomaineActiviteFonctionList {
	private $myList;
	public function __construct() {
		$this->myList = array ();
	}
	public function getList() {
		return $this->myList;
	}
	public function setList($newValue) {
		$this->myList = $newValue;
	}

	// ###
	public function SQL_SELECT_ALL($RoleID) {
		$sql = "SELECT RoleID, DomainActiviteID, FonctionDAID FROM annuaire_role_domainactivite WHERE RoleID='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $RoleID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aModele = new DomaineActiviteFonction ();
			$aModele->setDomaineActiviteID ( $line [1] );
			$aModele->setFonctionDAID ( $line [2] );
			$aModele->setRoleID ( $line [0] );
			$this->myList [] = $aModele;
		}

		mysqli_free_result  ( $result );
	}
	public function SQL_DELETE_ALL($RoleID) {
		$sql = "DELETE FROM annuaire_role_domainactivite WHERE RoleID='%s'";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $RoleID ) );
		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
}
?>