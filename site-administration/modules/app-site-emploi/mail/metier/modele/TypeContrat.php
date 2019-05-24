<?php
/**
 * Class utilisée pour la gestion des types de contrat
 * @author Quentin BRISSON
 * @package app-site-emploi
 * @subpackage mail
 * @version 1.0.4
 *
 */
class TypeContrat {
	private $idtype;
	private $nomtype;
	public function __construct() {
		$this->idtype = NULL;
		$this->nomtype = '';
	}

	// Getteur
	/**
	 *
	 * Retourne l'id du type de contrat
	 *
	 * @return int
	 */
	public function getidtype() {
		return $this->idtype;
	}
	/**
	 *
	 * retourne le nom du type de contrat
	 *
	 * @return string
	 */
	public function getnomtype() {
		return $this->nomtype;
	}

	// Setteur
	/**
	 *
	 * insére l'id du type de contrat
	 *
	 * @param int $newvalue
	 */
	public function setidtype($newvalue) {
		$this->idtype = $newvalue;
	}
	/**
	 *
	 * insére le nom du type de contrat
	 *
	 * @param string $newvalue
	 */
	public function setnomtype($newvalue) {
		$this->nomtype = $newvalue;
	}
	/**
	 * Sélectionne le type de contrat demandé
	 */
	public function sql_select() {
		$sql = "SELECT IDType, NomType FROM emploi_type_contrat WHERE IDType = '%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $this->idtype ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array  ( $result );

			$this->idtype = $line [0];
			$this->nomtype = $line [1];
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