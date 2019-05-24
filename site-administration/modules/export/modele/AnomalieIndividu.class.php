<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage export
 * @version 1.0.4
 */
class AnomalieIndividu implements DefaultModeleList {
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

		$sql = "SELECT IndividuID, Nom, Prenom,Mail FROM annuaire_individu WHERE IndividuID NOT IN (SELECT DISTINCT IndividuID FROM annuaire_role WHERE AnnuaireID='%s') AND AnnuaireID='%s'";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aID ), mysqli_real_escape_string ($_SESSION['LINK'], $aID ) );
		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$this->myList [] = $line;
		}

		mysqli_free_result  ( $result );
	}
	public function SQL_SELECT_ALL() {
		$this->myList = array ();

		$sql = "SELECT IndividuID, Nom, Prenom,Mail FROM annuaire_individu WHERE IndividuID NOT IN (SELECT DISTINCT IndividuID FROM annuaire_role)";
		$result = mysqli_query ($_SESSION['LINK'], $sql ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$this->myList [] = $line;
		}

		mysqli_free_result  ( $result );
	}

	// Renvoi le nb max d'éléments sans recherche
	public function SQL_COUNT($aID) {
		$sql = "SELECT COUNT(IndividuID) FROM annuaire_individu WHERE IndividuID NOT IN (SELECT DISTINCT IndividuID FROM annuaire_role WHERE AnnuaireID='%s') AND AnnuaireID='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aID ), mysqli_real_escape_string ($_SESSION['LINK'], $aID ) );
		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
		$line = mysqli_fetch_array  ( $result );
		return $line [0];
	}

	// Renvoi le nb max d'éléments avec recherche
	public function SQL_SEARCH_COUNT($aID, $Recherche) {
		$sql = "SELECT COUNT(IndividuID) FROM annuaire_individu WHERE IndividuID NOT IN (SELECT DISTINCT IndividuID FROM annuaire_role WHERE AnnuaireID='%s') AND AnnuaireID='%s'";
		$sql .= "AND (IndividuID LIKE '%s' OR Nom LIKE '%s' OR Prenom LIKE '%s' OR Mail LIKE '%s')";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aID ), mysqli_real_escape_string ($_SESSION['LINK'], $aID ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $Recherche . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $Recherche . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $Recherche . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $Recherche . '%' ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
		$line = mysqli_fetch_array  ( $result );
		return $line [0];
	}
	public function SQL_SEARCH($aID, $Recherche, $NumPage, $NumEntry, $tri, $ordre) {
		$this->myList = array ();

		switch ($tri) {
			case 1 :
				$tri = 'IndividuID';
				break;
			case 2 :
				$tri = 'Nom';
				break;
			case 3 :
				$tri = 'Prenom';
				break;
			case 4 :
				$tri = 'Mail';
				break;
			default :
				$tri = 'IndividuID';
				break;
		}

		switch ($ordre) {
			case 'a' :
				$ordre = 'ASC';
				break;
			case 'd' :
				$ordre = 'DESC';
				break;
			default :
				$ordre = 'DESC';
				break;
		}
		$sql = "SELECT IndividuID, Nom, Prenom,Mail FROM annuaire_individu WHERE IndividuID NOT IN (SELECT DISTINCT IndividuID FROM annuaire_role WHERE AnnuaireID='%s') AND AnnuaireID='%s'";
		$sql .= "AND (IndividuID LIKE '%s' OR Nom LIKE '%s' OR Prenom LIKE '%s' OR Mail LIKE '%s') ORDER BY %s %s LIMIT %d, %d";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aID ), mysqli_real_escape_string ($_SESSION['LINK'], $aID ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $Recherche . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $Recherche . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $Recherche . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $Recherche . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], $tri ), mysqli_real_escape_string ($_SESSION['LINK'], $ordre ), ($NumPage - 1) * $NumEntry, $NumEntry );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$this->myList [] = $line;
		}

		mysqli_free_result  ( $result );
	}
}

?>