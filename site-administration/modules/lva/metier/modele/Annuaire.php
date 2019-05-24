<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage lva
 * @version 1.0.4
 */
class Annuaire {
	private $id;
	private $name;

	function __construct()
	{
		$this->id = NULL;
		$this->name = '';
	}
	function Annuaire() {
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
	function create_annuaire() {
		$query = sprintf ( "INSERT INTO annuaire_lva_annuaire VALUES(NULL,'%s')", mysqli_real_escape_string ($_SESSION['LINK'], $this->name ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	function update_annuaire() {
		$query = sprintf ( "UPDATE annuaire_lva_annuaire SET Nom='%s' WHERE AnnuaireID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $this->name ), mysqli_real_escape_string ($_SESSION['LINK'], $this->id ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	function remove_annuaire() {
		$query = sprintf ( "DELETE FROM annuaire_lva_annuaire WHERE AnnuaireID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $this->id ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	function select_annuaire($annuaireID) {
		$query = sprintf ( "SELECT AnnuaireID, Nom FROM annuaire_lva_annuaire WHERE AnnuaireID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $annuaireID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array  ( $result );
			$this->setID ( $line [0] );
			$this->setName ( $line [1] );
		} else {
			$this->setID ( NULL );
			$this->setName ( '' );
		}

		mysqli_free_result  ( $result );
	}
	function select_annuaire_parNom($annuaireName) {
		$query = sprintf ( "SELECT AnnuaireID, Nom FROM annuaire_lva_annuaire WHERE Nom='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $annuaireName ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array  ( $result );
			$this->setID ( $line [0] );
			$this->setName ( $line [1] );
		} else {
			$this->setID ( NULL );
			$this->setName ( '' );
		}

		mysqli_free_result  ( $result );
	}
	function select_annuaire_parID($annuaireID) {
		$query = sprintf ( "SELECT AnnuaireID, Nom FROM annuaire_lva_annuaire WHERE AnnuaireID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $annuaireID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array  ( $result );
			$this->setID ( $line [0] );
			$this->setName ( $line [1] );
		} else {
			$this->setID ( NULL );
			$this->setName ( '' );
		}

		mysqli_free_result  ( $result );
	}
	function find_id() {
		$query = sprintf ( "SELECT AnnuaireID FROM annuaire_lva_annuaire WHERE Nom='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $this->name ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array  ( $result );
			$this->setID ( $line [0] );
		} else {
			$this->setID ( NULL );
		}

		mysqli_free_result  ( $result );
	}
}

?>