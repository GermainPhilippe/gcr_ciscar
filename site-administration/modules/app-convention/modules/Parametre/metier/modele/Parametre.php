<?php
/**
 * @author Florent DESPIERRES
 * @package app-convention
 * @subpackage Parametre
 * @version 1.0.4
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
	public function getID() {
		return $this->ID;
	}
	public function getNom() {
		return $this->Nom;
	}
	public function getValeur() {
		return $this->Valeur;
	}
	public function setID($newValue) {
		$this->ID = $newValue;
	}
	public function setNom($newValue) {
		$this->Nom = $newValue;
	}
	public function setValeur($newValue) {
		$this->Valeur = $newValue;
	}

	// ###
	public function SQL_create() {
		$sql = "INSERT INTO conv_parametre (ParametreID, Nom, Valeur)";
		$sql .= " VALUES(NULL, '%s', '%s')";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $this->Nom ), mysqli_real_escape_string ($_SESSION['LINK'], $this->Valeur ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function SQL_update() {
		$sql = "UPDATE conv_parametre SET Nom='%s', Valeur='%s'";
		$sql .= " WHERE ParametreID='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $this->Nom ), mysqli_real_escape_string ($_SESSION['LINK'], $this->Valeur ), mysqli_real_escape_string ($_SESSION['LINK'], $this->ID ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function SQL_delete() {
		$sql = "DELETE FROM conv_parametre WHERE ParametreID='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $this->ID ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function SQL_select($ParametreID) {
		$sql = "SELECT ParametreID, Nom, Valeur FROM conv_parametre";
		$sql .= " WHERE ParametreID='%s'";

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
	public function SQL_select_by_name($ParametreName) {
		$sql = "SELECT ParametreID, Nom, Valeur FROM conv_parametre";
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