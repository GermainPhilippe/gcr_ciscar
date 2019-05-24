<?php
/**
 * Class permettant d'avoir toutes les cv par région et domaine
 * @author Alexandre DIALLO
 * @package app-site-emploi
 * @subpackage statistiques
 * @version 1.0.4
 */
class StatCVRegion {
	private $myList;
	public function __construct() {
	}

	// ###
	/**
	 * Retourne la liste des cv par région
	 */
	public function getList() {
		return $this->myList;
	}
	/**
	 * Insére la liste des cv par région
	 */
	public function setList($newValue) {
		$this->myList = $newValue;
	}

	// ###
	/**
	 *
	 * Sélectionne les cv par région et domaine sous forme de tableau en fonction du mois et de l'année
	 *
	 * @param int $mois
	 * @param int $anne
	 */
	public function SQL_SELECT_BY_REG($mois, $anne) {
		$this->myList = array ();

		$sql = "SELECT CONCAT(ar.RegionID,'-', IDDomaine), count( * ) ";
		$sql .= "FROM emploi_candidature e, annuaire_lva_departement_region ad, annuaire_lva_region ar";
		$sql .= " WHERE e.DepartementID = ad.DepartementID";
		$sql .= " AND ad.RegionID = ar.RegionID  AND MONTH(date_cand)=%s AND YEAR(date_cand)=%s";
		$sql .= " GROUP BY CONCAT(RegionID,'-', IDDomaine)";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $mois ), mysqli_real_escape_string ($_SESSION['LINK'], $anne ) );
		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {

			$this->myList [$line [0]] = $line [1];
		}

		mysqli_free_result  ( $result );
	}
	/**
	 *
	 * Renvoi le nombre de cv pour une région
	 *
	 * @param int $id
	 * @param int $mois
	 * @param int $anne
	 */
	public function SQL_COUNT($id, $mois, $anne) {
		$this->myList = array ();

		$sql = "SELECT COUNT( * ) ";
		$sql .= "FROM emploi_candidature ";
		$sql .= " WHERE DepartementID = 0 AND IDDomaine = %s AND MONTH(date_cand)=%s AND YEAR(date_cand)=%s";

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
		$sql = " SELECT date_cand FROM emploi_candidature ORDER BY date_cand ASC LIMIT 0,1";
		$result = mysqli_query ($_SESSION['LINK'], $sql ) or die ( mysqli_error ($_SESSION['LINK']) );
		$line = mysqli_fetch_array  ( $result );
		return $line [0];

		mysqli_free  ( $result );
	}
	/**
	 *
	 * Renvoi le nombre de cv pour un domaine
	 *
	 * @param int $id
	 * @param int $mois
	 * @param int $anne
	 */
	public function SQL_COUNT_TOT($id, $mois, $anne) {
		$this->myList = array ();

		$sql = "SELECT COUNT( * ) ";
		$sql .= "FROM emploi_candidature ";
		$sql .= " WHERE  IDDomaine = %s AND MONTH(date_cand)=%s AND YEAR(date_cand)=%s";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $id ), mysqli_real_escape_string ($_SESSION['LINK'], $mois ), mysqli_real_escape_string ($_SESSION['LINK'], $anne ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
		$line = mysqli_fetch_array  ( $result );
		return $line [0];
		echo $line [0];
		mysqli_free_result  ( $result );
	}
}
?>