<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage lva
 * @version 1.0.4
 */
class DepartementListe {
	private $departementListe;

	function __construct()
	{
		$this->departementListe = array ();
	}
	function DepartementListe() {
		self::__construct();
	}
	
	// #################
	function addDepartement($aDepartement) {
		$this->departementListe [] = $aDepartement;
	}
	function removeDepartement($i) {
		unset ( $this->departementListe [$i] );
	}
	function getDepartementListe() {
		return $this->departementListe;
	}
	function setDepartementListe($newValue) {
		$this->departementListe = $newValue;
	}
	function getNbDepartement() {
		return count ( $this->departementListe );
	}

	// ##################
	function select_all_departement() {
		$result = mysqli_query ($_SESSION['LINK'], "SELECT DepartementID, Code, Libelle FROM annuaire_lva_departement" ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aDepartement = new Departement ();

			$aDepartement->setID ( $line [0] );
			$aDepartement->setCode ( $line [1] );
			$aDepartement->setName ( $line [2] );

			$this->departementListe [] = $aDepartement;
		}

		mysqli_free_result  ( $result );
	}
	function select_all_selected_departement($regionID) {
		$query = sprintf ( "SELECT DepartementID FROM annuaire_lva_departement_region WHERE RegionID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $regionID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aDepartement = new Departement ();
			$aDepartement->select_departement ( $line [0] );

			$this->departementListe [] = $aDepartement;
		}

		mysqli_free_result  ( $result );
	}
	function departement_exist($departementID) {
		foreach ( $this->departementListe as $aDepartement ) {
			if ($aDepartement->getID () == $departementID) {
				return true;
			}
		}
		return false;
	}
	function create_region($regionID) {
		foreach ( $this->departementListe as $aDepartement ) {
			$query = sprintf ( "INSERT INTO annuaire_lva_departement_region VALUES('%s','%s')", mysqli_real_escape_string ($_SESSION['LINK'], $regionID ), mysqli_real_escape_string ($_SESSION['LINK'], $aDepartement->getID () ) );

			mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
		}
	}
	function update_region($regionID) {
		$query = sprintf ( "DELETE FROM annuaire_lva_departement_region WHERE RegionID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $regionID ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		foreach ( $this->departementListe as $aDepartement ) {
			$query = sprintf ( "INSERT INTO annuaire_lva_departement_region VALUES('%s','%s')", mysqli_real_escape_string ($_SESSION['LINK'], $regionID ), mysqli_real_escape_string ($_SESSION['LINK'], $aDepartement->getID () ) );

			mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
		}
	}
}
?>