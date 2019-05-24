<?php
/**
 * Class utilisée pour la gestion des domaines 
 * @author Quentin BRISSON
 * @package app-site-emploi
 * @subpackage mail
 * @version 1.0.4
 *
 */
class Domaine {
	private $iddomaine;
	private $nomdomaine;
	public function __construct() {
		$this->iddomaine = NULL;
		$this->nomdomaine = '';
	}
	/**
	 *
	 * Retourne l'id du domaine
	 *
	 * @return int
	 */
	public function getiddomaine() {
		return $this->iddomaine;
	}
	/**
	 *
	 * retourne le nom du domaine
	 *
	 * @return string
	 */
	public function getnomdomaine() {
		return $this->nomdomaine;
	}
	/**
	 *
	 * insére l'id du domaine
	 *
	 * @param int $newvalue
	 */
	public function setiddomaine($newvalue) {
		$this->iddomaine = $newvalue;
	}
	/**
	 *
	 * insére le nom du domaine
	 *
	 * @param string $newvalue
	 */
	public function setnomdomaine($newvalue) {
		$this->nomdomaine = $newvalue;
	}
	/**
	 *
	 * @deprecated
	 *
	 */
	public function sql_insert_pays() {
	}
	/**
	 * Sélectionne le domaine demandé
	 */
	public function sql_select_domaine() {
		$sql = "SELECT IDDomaine, NomDomaine FROM emploi_domaine WHERE IDDomaine = '%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $this->iddomaine ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array  ( $result );

			$this->iddomaine = $line [0];
			$this->nomdomaine = $line [1];
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