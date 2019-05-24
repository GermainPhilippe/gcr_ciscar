<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage document
 * @version 1.0.4
 */
class Groupe {
	private $ID;
	private $Name;
	public function __construct() {
		$this->ID = NULL;
		$this->Name = '';
	}

	// ###
	public function getID() {
		return $this->ID;
	}
	public function getName() {
		return $this->Name;
	}
	public function setID($newValue) {
		$this->ID = $newValue;
	}
	public function setName($newValue) {
		$this->Name = $newValue;
	}

	// ###
	public function SQL_select($GroupeID) {
		$query = sprintf ( "SELECT GroupeID, Libelle FROM annuaire_lca_groupe WHERE GroupeID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $GroupeID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array  ( $result );

			$this->ID = $line [0];
			$this->Name = $line [1];
		} else {
			$this->ID = NULL;
			$this->Name = '';
		}

		mysqli_free_result  ( $result );
	}
}
?>