<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage role
 * @version 1.0.4
 */
class DomaineActiviteFonction {
	private $RoleID;
	private $DomainActiviteID;
	private $FonctionDAID;
	public function __construct() {
		$this->RoleID = NULL;
		$this->DomainActiviteID = NULL;
		$this->FonctionDAID = NULL;
	}
	public function getRoleID() {
		return $this->RoleID;
	}
	public function getDomaineActiviteID() {
		return $this->DomainActiviteID;
	}
	public function getFonctionDAID() {
		return $this->FonctionDAID;
	}
	public function setRoleID($newValue) {
		$this->RoleID = $newValue;
	}
	public function setDomaineActiviteID($newValue) {
		$this->DomainActiviteID = $newValue;
	}
	public function setFonctionDAID($newValue) {
		$this->FonctionDAID = $newValue;
	}

	// ###
	public function SQL_CREATE() {
		$sql = "INSERT IGNORE INTO annuaire_role_domainactivite (RoleID, DomainActiviteID,FonctionDAID)";
		$sql .= " VALUES('%s','%s',";
		$sql .= is_null ( $this->FonctionDAID ) || $this->FonctionDAID == 0 ? "NULL)" : $this->FonctionDAID . ")";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $this->RoleID ), mysqli_real_escape_string ($_SESSION['LINK'], $this->DomainActiviteID ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function SQL_UPDATE() {
	}
	public function SQL_DELETE() {
	}
}
?>