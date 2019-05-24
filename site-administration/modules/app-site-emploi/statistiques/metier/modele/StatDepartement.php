<?php
/**
 * Class utilisée pour la gestion des départements dans les stats
 * @author Alexandre DIALLO
 * @package app-site-emploi
 * @subpackage statistiques
 * @version 1.0.4
 *
 */
class StatDepartement {
	private $iddepartement;
	private $libelle;
	private $code;
	public function __construct() {
		$this->iddepartement = NULL;
		$this->libelle = '';
		$this->code = '';
	}
	/**
	 *
	 * Retourne l'id département
	 *
	 * @return int
	 */
	public function getiddepartement() {
		return $this->iddepartement;
	}
	/**
	 *
	 * Retourne le nom du département
	 *
	 * @return string
	 */
	public function getlibelle() {
		return $this->libelle;
	}
	/**
	 *
	 * Retourne le numéro du département
	 *
	 * @return int
	 */
	public function getcode() {
		return $this->code;
	}
	/**
	 *
	 * Insére l'id du département
	 *
	 * @param int $newvalue
	 */
	public function setiddepartement($newvalue) {
		$this->iddepartement = $newvalue;
	}
	/**
	 *
	 * Insére le nom du département
	 *
	 * @param string $newvalue
	 */
	public function setlibelle($newvalue) {
		$this->libelle = $newvalue;
	}
	/**
	 * Insére le numéro du département
	 *
	 * @param int $newvalue
	 */
	public function setcode($newvalue) {
		$this->code = $newvalue;
	}
	/**
	 *
	 * @deprecated
	 *
	 */
	public function sql_insert_pays() {
	}
	/**
	 * Sélectionne le département demandé
	 */
	public function sql_select_departement() {
		$sql = "SELECT DepartementID, Libelle, Code FROM annuaire_lva_departement WHERE DepartementID = '%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $this->iddepartement ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array  ( $result );

			$this->iddepartement = $line [0];
			$this->libelle = $line [1];
			$this->code = $line [2];
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