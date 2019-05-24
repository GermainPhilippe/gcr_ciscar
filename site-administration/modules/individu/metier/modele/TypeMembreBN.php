<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage individu
 * @version 1.0.4
 */
class TypeMembreBN {
	private $id;
	private $name;

	function __construct()
	{
		$this->id = NULL;
		$this->name = '';
	}
	function TypeMembreBN() {
		self::__construct();
	}
	
	// ################
	function getID() {
		return $this->id;
	}
	function getName() {
		return $this->name;
	}
	function setID($newValue) {
		$this->id = $newValue;
	}
	function setName($newValue) {
		$this->name = $newValue;
	}

	// ################
	function create_typemembrebn() {
		$query = sprintf ( "INSERT INTO annuaire_lva_typemembrebn VALUES(NULL,'%s')", mysqli_real_escape_string ($_SESSION['LINK'], $this->name ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	function update_typemembrebn() {
		$query = sprintf ( "UPDATE annuaire_lva_typemembrebn SET Libelle='%s' WHERE TypeMembreBNID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $this->name ), mysqli_real_escape_string ($_SESSION['LINK'], $this->id ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	function remove_typebembrebn() {
		$query = sprintf ( "DELETE FROM annuaire_lva_typemembrebn WHERE MarqueID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $this->id ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	function select_typemembrebn($TypeMembreBNID) {
		$query = sprintf ( "SELECT TypeMembreBNID, Libelle FROM annuaire_lva_typemembrebn WHERE TypeMembreBNID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $TypeMembreBNID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array  ( $result );
			$this->setID ( $line [0] );
			$this->setName ( $line [1] );
		} else {
			$this->id = NULL;
			$this->name = '';
		}

		mysqli_free_result  ( $result );
	}
}

?>