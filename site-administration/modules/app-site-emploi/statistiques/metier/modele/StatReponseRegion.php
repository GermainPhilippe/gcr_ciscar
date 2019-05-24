<?php
/**
 * Class permettant d'avoir toutes les réponses par région et domaine
 * @author Alexandre DIALLO
 * @package app-site-emploi
 * @subpackage statistiques
 * @version 1.0.4
 */
class StatReponseRegion {
	private $myList;
	public function __construct() {
	}

	// ###
	/**
	 * Retourne la liste des réponses par région
	 */
	public function getList() {
		return $this->myList;
	}
	/**
	 * Insére la liste des réponses par région
	 */
	public function setList($newValue) {
		$this->myList = $newValue;
	}

	// ###
	/**
	 *
	 * Sélectionne les réponses par région et domaine sous forme de tableau en fonction du mois et de l'année
	 *
	 * @param int $mois
	 * @param int $anne
	 */
	public function SQL_SELECT_BY_REG($mois, $anne) {
		$this->myList = array ();

		$sql = "SELECT CONCAT(ar.RegionID,'-', IDDomaineCandRep), count( * ) ";
		$sql .= "FROM emploi_reponse r, annuaire_lva_departement_region ad, annuaire_lva_region ar";
		$sql .= " WHERE r.DepartementID = ad.DepartementID";
		$sql .= " AND ad.RegionID = ar.RegionID  AND MONTH(DateReponse)= %s AND YEAR(DateReponse)=%s";
		$sql .= " GROUP BY CONCAT(RegionID,'-', IDDomaineCandRep)";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $mois ), mysqli_real_escape_string ($_SESSION['LINK'], $anne ) );
		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {

			$this->myList [$line [0]] = $line [1];
		}

		mysqli_free_result  ( $result );
	}
	public function SQL_COUNT($id) {
		$this->myList = array ();

		$sql = "SELECT COUNT(*) ";
		$sql .= "FROM emploi_reponse ";
		$sql .= " WHERE DepartementID = 0 AND IDDomaineCandRep = %s";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $id ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
		$line = mysqli_fetch_array  ( $result );
		return 0;
		echo $line [0];
		mysqli_free_result  ( $result );
	}
	/**
	 *
	 * Renvoi le nombre de réponses pour une région
	 *
	 * @param int $id
	 * @param int $mois
	 * @param int $anne
	 */
	public function SQL_COUNT_TOT($id, $mois, $anne) {
		$this->myList = array ();

		$sql = "SELECT COUNT( * ) ";
		$sql .= "FROM emploi_reponse";
		$sql .= " WHERE   IDDomaineCandRep = %s AND MONTH(DateReponse)=%s AND YEAR(DateReponse)=%s";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $id ), mysqli_real_escape_string ($_SESSION['LINK'], $mois ), mysqli_real_escape_string ($_SESSION['LINK'], $anne ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
		$line = mysqli_fetch_array  ( $result );
		return $line [0];
		echo $line [0];
		mysqli_free_result  ( $result );
	}
	/**
	 *
	 * @deprecated
	 *
	 */
	public function SQL_SELECT_LAST_DATE() {
		$sql = " SELECT DateReponse FROM emploi_reponse ORDER BY DateReponse ASC LIMIT 0,1";
		$result = mysqli_query ($_SESSION['LINK'], $sql ) or die ( mysqli_error ($_SESSION['LINK']) );
		$line = mysqli_fetch_array  ( $result );
		return $line [0];

		mysqli_free  ( $result );
	}
}
?>