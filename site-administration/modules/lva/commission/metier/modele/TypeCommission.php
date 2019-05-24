<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage lva
 * @version 1.0.4
 */
class TypeCommission {
	private $id;
	private $name;

	function __construct()
	{
		$this->id = NULL;
		$this->name = '';
	}
	function TypeCommission() {
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
	function create_typecommission() {
		$query = sprintf ( "INSERT INTO annuaire_lva_typecommission VALUES(NULL,'%s')", mysqli_real_escape_string ($_SESSION['LINK'], $this->name ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	function update_typecommission() {
		$query = sprintf ( "UPDATE annuaire_lva_typecommission SET Libelle='%s' WHERE TypeCommissionID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $this->name ), mysqli_real_escape_string ($_SESSION['LINK'], $this->id ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	function remove_typecommission() {
		$query = sprintf ( "DELETE FROM annuaire_lva_typecommission WHERE TypeCommissionID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $this->id ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	function select_typecommission($typeCommissionID) {
		$query = sprintf ( "SELECT TypeCommissionID, Libelle FROM annuaire_lva_typecommission WHERE TypeCommissionID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $typeCommissionID ) );

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