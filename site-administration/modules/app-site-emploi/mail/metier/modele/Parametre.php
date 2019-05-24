<?php
/**
 * Class utilisée pour la gestion des paramétres
 * @author Alexandre DIALLO
 * @package app-site-emploi
 * @subpackage mail
 * @version 1.0.4
 *
 */
class Parametre {
	private $ID;
	private $Nom;
	private $Valeur;
	public function __construct() {
		$this->ID = NULL;
		$this->Nom = '';
		$this->Valeur = '';
	}

	// ###
	/**
	 *
	 * Retourne l'id du paramètre
	 *
	 * @return int
	 */
	public function getID() {
		return $this->ID;
	}
	/**
	 *
	 * retourne le nom du paramètre
	 *
	 * @return string
	 */
	public function getNom() {
		return $this->Nom;
	}
	/**
	 *
	 * retourne le nom du paramètre
	 *
	 * @return string
	 */
	public function getValeur() {
		return $this->Valeur;
	}
	/**
	 *
	 * insére l'id du paramètre
	 *
	 * @param int $newvalue
	 */
	public function setID($newValue) {
		$this->ID = $newValue;
	}
	/**
	 *
	 * insére le nom du paramètre
	 *
	 * @param string $newvalue
	 */
	public function setNom($newValue) {
		$this->Nom = $newValue;
	}
	/**
	 *
	 * insére le nom du paramètre
	 *
	 * @param string $newvalue
	 */
	public function setValeur($newValue) {
		$this->Valeur = $newValue;
	}

	// ###
	/**
	 * Ajout d'un nouveau paramètre
	 */
	public function SQL_create() {
		$sql = "INSERT INTO emploi_parametre_mail (ParametreID, Nom, Valeur)";
		$sql .= " VALUES(NULL, '%s', '%s')";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $this->Nom ), mysqli_real_escape_string ($_SESSION['LINK'], $this->Valeur ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	/**
	 * Mise à jour de la valeur d'un paramètre
	 */
	public function SQL_update() {
		$sql = "UPDATE emploi_parametre_mail SET  Valeur='%s'";
		$sql .= " WHERE Nom='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $this->Valeur ), mysqli_real_escape_string ($_SESSION['LINK'], $this->Nom ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	/**
	 * Suppression d'un paramètre
	 */
	public function SQL_delete() {
		$sql = "DELETE FROM emploi_parametre_mail WHERE ParametreID='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $this->ID ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	/**
	 *
	 * Sélection d'un paramètre par son id
	 *
	 * @param int $ParametreID
	 */
	public function SQL_select($ParametreID) {
		$sql = "SELECT ParametreID, Nom, Valeur FROM emploi_parametre_mail";
		$sql .= " WHERE Nom='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $ParametreID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array  ( $result );

			$this->ID = $line [0];
			$this->Nom = $line [1];
			$this->Valeur = $line [2];
		} else {
			$this->__construct ();
		}

		mysqli_free_result  ( $result );
	}
	/**
	 * Sélection d'un paramètre par son nom
	 */
	public function SQL_select_by_name($ParametreName) {
		$sql = "SELECT ParametreID, Nom, Valeur FROM emploi_parametre_mail";
		$sql .= " WHERE Nom='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $ParametreName ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array  ( $result );

			$this->ID = $line [0];
			$this->Nom = $line [1];
			$this->Valeur = $line [2];
		} else {
			$this->__construct ();
		}

		mysqli_free_result  ( $result );
	}
}
?>