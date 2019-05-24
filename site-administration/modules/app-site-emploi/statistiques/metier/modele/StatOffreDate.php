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
class StatOffreDate {
	private $myList;
	public function __construct() {
	}

	// ###
	/**
	 *
	 * @deprecated
	 *
	 */
	public function getList() {
		return $this->myList;
	}
	/**
	 *
	 * @deprecated
	 *
	 */
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

		$sql = "SELECT DateOffre, TitreOffre FROM emploi_offres WHERE MONTH(DateOffre)=%s AND YEAR(DateOffre)=%s ORDER BY DateOffre  DESC";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $mois ), mysqli_real_escape_string ($_SESSION['LINK'], $anne ) );
		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aModele = new VerifOffre ();
			$aModele->setdateoffre ( $line [0] );
			$aModele->settitreoffre ( $line [1] );

			$this->myList [] = $aModele;
		}

		mysqli_free_result  ( $result );
	}
	/**
	 *
	 * @deprecated
	 *
	 */
	public function SQL_SELECT_LAST() {
		$sql = "SELECT DateOffre, TitreOffre FROM emploi_offres ORDER BY DateOffre  ASC LIMIT 0,1";

		$result = mysqli_query ($_SESSION['LINK'], $sql ) or die ( mysqli_error ($_SESSION['LINK']) );

		$line = mysqli_fetch_array  ( $result );
		return $line [0];

		mysqli_free_result  ( $result );
	}
}

?>