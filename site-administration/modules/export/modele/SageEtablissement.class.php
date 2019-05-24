<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage export
 * @version 1.0.4
 */
class SageEtablissement implements DefaultModeleList {
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
	public function SQL_SELECT_BY_SITE($aID) {
		$this->myList = array ();

		$sql = "SELECT EtablissementID, RaisonSociale, LoginSage, PasswordSage FROM annuaire_etablissement WHERE AnnuaireID='%s'";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aID ) );
		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$this->myList [] = $line;
		}

		mysqli_free_result  ( $result );
	}
	public function SQL_SELECT_ALL() {
		$this->myList = array ();

		$sql = "SELECT EtablissementID, RaisonSociale, LoginSage, PasswordSage FROM annuaire_etablissement";
		$result = mysqli_query ($_SESSION['LINK'], $sql ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$this->myList [] = $line;
		}

		mysqli_free_result  ( $result );
	}
}
?>