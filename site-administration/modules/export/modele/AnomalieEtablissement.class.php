<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage export
 * @version 1.0.4
 */
class AnomalieEtablissement implements DefaultModeleList {
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

		$sql = "SELECT EtablissementID, RaisonSociale, Adresse1, BureauDistributeur, CodePostal, Ville FROM annuaire_etablissement WHERE EtablissementID NOT IN (SELECT DISTINCT EtablissementID FROM annuaire_role WHERE AnnuaireID='%s') AND AnnuaireID='%s'";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aID ), mysqli_real_escape_string ($_SESSION['LINK'], $aID ) );
		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$this->myList [] = $line;
		}

		mysqli_free_result  ( $result );
	}
	public function SQL_SELECT_ALL() {
		$this->myList = array ();

		$sql = "SELECT EtablissementID, RaisonSociale, Adresse1, BureauDistributeur, CodePostal, Ville FROM annuaire_etablissement WHERE EtablissementID NOT IN (SELECT DISTINCT EtablissementID FROM annuaire_role)";
		$result = mysqli_query ($_SESSION['LINK'], $sql ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$this->myList [] = $line;
		}

		mysqli_free_result  ( $result );
	}

	// Renvoi le nb max d'éléments sans recherche
	public function SQL_COUNT($aID) {
		$sql = "SELECT COUNT(EtablissementID) FROM annuaire_etablissement WHERE EtablissementID NOT IN (SELECT DISTINCT EtablissementID FROM annuaire_role WHERE AnnuaireID='%s') AND AnnuaireID='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aID ), mysqli_real_escape_string ($_SESSION['LINK'], $aID ) );
		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
		$line = mysqli_fetch_array  ( $result );
		return $line [0];
	}

	// Renvoi le nb max d'éléments avec recherche
	public function SQL_SEARCH_COUNT($aID, $Recherche) {
		$sql = "SELECT COUNT(EtablissementID) FROM annuaire_etablissement WHERE EtablissementID NOT IN (SELECT DISTINCT EtablissementID FROM annuaire_role WHERE AnnuaireID='%s') AND AnnuaireID='%s'";
		$sql .= "AND (EtablissementID LIKE '%s' OR RaisonSociale LIKE '%s' OR Adresse1 LIKE '%s' OR BureauDistributeur LIKE '%s' OR CodePostal LIKE '%s' OR Ville LIKE '%s' )";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aID ), mysqli_real_escape_string ($_SESSION['LINK'], $aID ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $Recherche . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $Recherche . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $Recherche . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $Recherche . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $Recherche . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $Recherche . '%' ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
		$line = mysqli_fetch_array  ( $result );
		return $line [0];
	}
	public function SQL_SEARCH($aID, $Recherche, $NumPage, $NumEntry, $tri, $ordre) {
		$this->myList = array ();

		switch ($tri) {
			case 1 :
				$tri = 'EtablissementID';
				break;
			case 2 :
				$tri = 'RaisonSociale';
				break;
			case 3 :
				$tri = 'Adresse1';
				break;
			case 4 :
				$tri = 'BureauDistributeur';
				break;
			case 5 :
				$tri = 'CodePostal';
				break;
			case 6 :
				$tri = 'Ville';
				break;
			default :
				$tri = 'EtablissementID';
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
		$sql = "SELECT EtablissementID, RaisonSociale, Adresse1, BureauDistributeur, CodePostal, Ville FROM annuaire_etablissement WHERE ";
		$sql .= "(EtablissementID LIKE '%s' OR RaisonSociale LIKE '%s' OR Adresse1 LIKE '%s' OR BureauDistributeur LIKE '%s' OR CodePostal LIKE '%s' OR Ville LIKE '%s' ) AND";
		$sql .= " EtablissementID NOT IN (SELECT DISTINCT EtablissementID FROM annuaire_role WHERE AnnuaireID='%s') AND AnnuaireID='%s' ORDER BY %s  %s  LIMIT %d, %d  ";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], '%' . $Recherche . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $Recherche . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $Recherche . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $Recherche . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $Recherche . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $Recherche . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], $aID ), mysqli_real_escape_string ($_SESSION['LINK'], $aID ), mysqli_real_escape_string ($_SESSION['LINK'], $tri ), mysqli_real_escape_string ($_SESSION['LINK'], $ordre ), ($NumPage - 1) * $NumEntry, $NumEntry );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$this->myList [] = $line;
		}

		mysqli_free_result  ( $result );
	}
}

?>