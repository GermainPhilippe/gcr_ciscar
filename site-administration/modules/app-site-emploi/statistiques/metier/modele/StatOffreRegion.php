<?php
/**
 * Class permettant d'avoir toutes les offres par région et domaine
 * @author Alexandre DIALLO
 * @package app-site-emploi
 * @subpackage statistiques
 * @version 1.0.4
 */
class StatOffreRegion {
	private $myList;
	public function __construct() {
	}

	// ###
	/**
	 * Retourne la liste des offres par région
	 */
	public function getList() {
		return $this->myList;
	}
	/**
	 * Insére la liste des offres par région
	 */
	public function setList($newValue) {
		$this->myList = $newValue;
	}

	// ###
	/**
	 *
	 * Sélectionne les offres par région et domaine sous forme de tableau en fonction du mois et de l'année
	 *
	 * @param int $mois
	 * @param int $anne
	 */
	public function SQL_SELECT_BY_REG($mois, $anne) {
		$this->myList = array ();

		$sql = "SELECT CONCAT(RegionID,'-', IDDomaine), count( * ) FROM `emploi_offres` WHERE MONTH(DateOffre) = %s AND YEAR(DateOffre) = %s GROUP BY CONCAT(RegionID,'-', IDDomaine)";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $mois ), mysqli_real_escape_string ($_SESSION['LINK'], $anne ) );
		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {

			$this->myList [$line [0]] = $line [1];
		}

		mysqli_free_result  ( $result );
	}
	/**
	 *
	 * Renvoi le nombre d'offre pour un domaine
	 *
	 * @param int $id
	 * @param int $mois
	 * @param int $anne
	 */
	public function SQL_COUNT_TOT($id, $mois, $anne) {
		$this->myList = array ();

		$sql = "SELECT COUNT( * ) ";
		$sql .= "FROM emploi_offres";
		$sql .= " WHERE  IDDomaine = %s AND MONTH(DateOffre)=%s AND YEAR(DateOffre)=%s";

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
		$sql = " SELECT DateOffre FROM emploi_offres ORDER BY DateOffre ASC LIMIT 0,1";
		$result = mysqli_query ($_SESSION['LINK'], $sql ) or die ( mysqli_error ($_SESSION['LINK']) );
		$line = mysqli_fetch_array  ( $result );
		return $line [0];

		mysqli_free  ( $result );
	}
}
?>