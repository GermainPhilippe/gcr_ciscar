<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage export
 * @version 1.0.4
 */
class AnomalieRole implements DefaultModeleList {
	private $myList;
	public function __construct() {
		$this->myList = array ();
	}

	// ###
	public function setList($newValue) {
		$this->myList = $newValue;
	}
	public function getList() {
		return $this->myList;
	}

	// ###
	public function SQL_SELECT_BY_SITE($aID) {
		$this->myList = array ();

		$sql = "SELECT r.RoleID, i.Nom, i.Prenom, e.RaisonSociale FROM annuaire_role r, annuaire_individu i, annuaire_etablissement e WHERE RoleID NOT IN ( SELECT DISTINCT RoleID FROM annuaire_role_domainactivite ) AND r.IndividuID=i.IndividuID AND r.EtablissementID=e.EtablissementID AND r.AnnuaireID='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aID ) );
		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$this->myList [] = $line;
		}

		mysqli_free_result  ( $result );
	}
	public function SQL_SELECT_ALL() {
		$this->myList = array ();

		$sql = "SELECT r.RoleID, i.Nom, i.Prenom, e.RaisonSociale FROM annuaire_role r, annuaire_individu i, annuaire_etablissement e WHERE RoleID NOT IN ( SELECT DISTINCT RoleID FROM annuaire_role_domainactivite ) AND r.IndividuID=i.IndividuID AND r.EtablissementID=e.EtablissementID";

		$result = mysqli_query ($_SESSION['LINK'], $sql ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$this->myList [] = $line;
		}

		mysqli_free_result  ( $result );
	}
}
?>