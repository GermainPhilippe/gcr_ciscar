<?php
/**
 * Class non utilisée
 * Enter description here ...
 * @author Alexandre DIALLO
 * @package app-site-emploi
 * @subpackage statistiques
 * @version 1.0.4
 *
 */
class StatCVDate {
	private $myList;
	public function __constructList() {
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

	/**
	 *
	 * @deprecated
	 *
	 */
	public function SQL_SELECT_BY_DATE($mois, $anne) {
		$this->myList = array ();

		$sql = "SELECT date_cand, TitreCandidature FROM emploi_candidature WHERE MONTH(date_cand)=%s AND YEAR(date_cand)=%s ORDER BY date_cand DESC";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $mois ), mysqli_real_escape_string ($_SESSION['LINK'], $anne ) );
		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aModele = new VerifCV ();

			$aModele->setdatecand ( $line [0] );
			$aModele->settitrecand ( $line [1] );

			$this->myList [] = $aModele;
		}

		mysqli_free_result  ( $result );
	}
}

?>