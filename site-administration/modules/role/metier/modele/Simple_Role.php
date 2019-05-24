<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage role
 * @version 1.0.4
 */
class Simple_Role {
	private $ID;
	private $IndividuID;
	private $EtablissementID;
	private $AnnuaireID;
	public function __construct() {
		$this->ID = NULL;
		$this->IndividuID = NULL;
		$this->EtablissementID = NULL;
		$this->AnnuaireID = NULL;
	}

	// ###
	public function getID() {
		return $this->ID;
	}
	public function getIndividuID() {
		return $this->IndividuID;
	}
	public function getEtablissementID() {
		return $this->EtablissementID;
	}
	public function getAnnuaireID() {
		return $this->AnnuaireID;
	}
	public function setID($newValue) {
		$this->ID = $newValue;
	}
	public function setIndividuID($newValue) {
		$this->IndividuID = $newValue;
	}
	public function setEtablissementID($newValue) {
		$this->EtablissementID = $newValue;
	}
	public function setAnnuaireID($newValue) {
		$this->AnnuaireID = $newValue;
	}

	// ###
	public function SQL_CREATE() {
		$sql = "INSERT INTO annuaire_role (RoleID, IndividuID, EtablissementID, AnnuaireID)";
		$sql .= " VALUES(NULL, '%s','%s','%s')";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $this->IndividuID ), mysqli_real_escape_string ($_SESSION['LINK'], $this->EtablissementID ), mysqli_real_escape_string ($_SESSION['LINK'], $this->AnnuaireID ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}

	/* Un Role ne peux etre mis a jour */
	public function SQL_UPDATE() {
	}
	public function SQL_DELETE() {
		$query = sprintf ( "DELETE FROM annuaire_role WHERE RoleID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $this->ID ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function SQL_SELECT($RoleID) {
		$sql = "SELECT RoleID, IndividuID, EtablissementID, AnnuaireID FROM annuaire_role WHERE RoleID='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $RoleID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array  ( $result );

			$this->ID = $line [0];
			$this->IndividuID = $line [1];
			$this->EtablissementID = $line [2];
			$this->AnnuaireID = $line [3];
		} else {
			$this->__construct ();
		}

		mysqli_free_result  ( $result );
	}
}
?>