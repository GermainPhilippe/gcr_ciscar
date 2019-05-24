<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage lva
 * @version 1.0.4
 */
class Departement {
	private $id;
	private $code;
	private $name;

	function __construct()
	{
		$this->id = NULL;
		$this->code = '';
		$this->name = '';
	}
	function Departement() {
		self::__construct();
	}

	// ##############
	function getID() {
		return $this->id;
	}
	function getName() {
		return $this->name;
	}
	function getCode() {
		return $this->code;
	}
	function setID($newValue) {
		$this->id = $newValue;
	}
	function setName($newValue) {
		$this->name = $newValue;
	}
	function setCode($newValue) {
		$this->code = $newValue;
	}

	// ################
	function create_departement() {
		$query = sprintf ( "INSERT INTO annuaire_lva_departement VALUES(NULL,'%s','%s')", mysqli_real_escape_string ($_SESSION['LINK'], $this->code ), mysqli_real_escape_string ($_SESSION['LINK'], $this->name ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	function update_departement() {
		$query = sprintf ( "UPDATE annuaire_lva_departement SET Code='%s', Libelle='%s' WHERE DepartementID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $this->code ), mysqli_real_escape_string ($_SESSION['LINK'], $this->name ), mysqli_real_escape_string ($_SESSION['LINK'], $this->id ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	function remove_departement() {
		$query = sprintf ( "DELETE FROM annuaire_lva_departement WHERE DepartementID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $this->id ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	function select_departement($departementID) {
		$query = sprintf ( "SELECT DepartementID, Code, Libelle FROM annuaire_lva_departement WHERE DepartementID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $departementID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array  ( $result );

			$this->setID ( $line [0] );
			$this->setCode ( $line [1] );
			$this->setName ( $line [2] );
		} else {
			$this->id = NULL;
			$this->code = '';
			$this->name = '';
		}

		mysqli_free_result  ( $result );
	}
}

?>