<?php
/**
 * Class utilisée pour la gestion de l'information niveau
 * @author Quentin BRISSON
 * @package app-site-emploi
 * @subpackage mail
 * @version 1.0.4
 *
 */
class Niveau {
	private $idniveau;
	private $niveau;
	public function __construct() {
		$this->idniveau = NULL;
		$this->niveau = '';
	}

	// Getteur
	/**
	 *
	 * Retourne l'id du niveau
	 *
	 * @return int
	 */
	public function getidniveau() {
		return $this->idniveau;
	}
	/**
	 *
	 * retourne le nom du niveau
	 *
	 * @return string
	 */
	public function getniveau() {
		return $this->niveau;
	}

	// Setteur
	/**
	 *
	 * insére l'id du niveau
	 *
	 * @param int $newvalue
	 */
	public function setidniveau($newvalue) {
		$this->idniveau = $newvalue;
	}
	/**
	 *
	 * insére le nom du niveau
	 *
	 * @param string $newvalue
	 */
	public function setniveau($newvalue) {
		$this->niveau = $newvalue;
	}
	/**
	 * Sélectionne le niveau demandé
	 */
	public function sql_select() {
		$sql = "SELECT IDNiveau, Niveau FROM emploi_niveau WHERE IDNiveau = '%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $this->idniveau ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array  ( $result );

			$this->idniveau = $line [0];
			$this->niveau = $line [1];
		}

		mysqli_free_result  ( $result );
	}
	/**
	 *
	 * @deprecated
	 *
	 */
	public function sql_delete() {
	}
	/**
	 *
	 * @deprecated
	 *
	 */
	public function sql_insert() {
	}
	/**
	 *
	 * @deprecated
	 *
	 */
	public function sql_update() {
	}
}

?>