<?php
/**
 * Class utilisée pour la gestion des pays 
 * @author Quentin BRISSON
 * @package app-site-emploi
 * @subpackage mail
 * @version 1.0.4
 *
 */
class Pays {
	private $idpays;
	private $nompays;
	public function __construct() {
		$this->idpays = NULL;
		$this->nompays = '';
	}
	/**
	 *
	 * Retourne l'id du pays
	 *
	 * @return int
	 */
	public function getidpays() {
		return $this->idpays;
	}
	/**
	 *
	 * retourne le nom du pays
	 *
	 * @return string
	 */
	public function getnompays() {
		return $this->nompays;
	}
	/**
	 *
	 * insére l'id du pays
	 *
	 * @param int $newvalue
	 */
	public function setidpays($newvalue) {
		$this->idpays = $newvalue;
	}
	/**
	 *
	 * insére le nom du pays
	 *
	 * @param string $newvalue
	 */
	public function setnompays($newvalue) {
		$this->nompays = $newvalue;
	}
	/**
	 *
	 * @deprecated
	 *
	 */
	public function sql_insert_pays() {
	}
	/**
	 * Sélectionne le pays demandé
	 */
	public function sql_select_pays() {
		$sql = "SELECT IDPays, NomPays FROM emploi_pays WHERE IDPays = '%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $this->idpays ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array  ( $result );

			$this->idpays = $line [0];
			$this->nompays = $line [1];
		}

		mysqli_free_result  ( $result );
	}
	/**
	 *
	 * @deprecated
	 *
	 */
	public function sql_delete_pays() {
	}
	/**
	 *
	 * @deprecated
	 *
	 */
	public function sql_update_pays() {
	}
}
?>