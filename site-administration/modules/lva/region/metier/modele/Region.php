<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage lva
 * @version 1.0.4
 */
class Region {
	private $id;
	private $name;
	private $obj_annuaire;
	private $obj_departementListe;
	private $LCAGroupeID;

	function __construct()
	{
		$this->id = NULL;
		$this->name = '';
		$this->obj_annuaire = NULL;
		$this->obj_departementListe = NULL;
		$this->LCAGroupeID = NULL;
	}
	function Region() {
		self::__construct();
	}

	// ###################
	function getID() {
		return $this->id;
	}
	function getName() {
		return $this->name;
	}
	function getAnnuaire() {
		return $this->obj_annuaire;
	}
	function getDepartementListe() {
		return $this->obj_departementListe;
	}
	function getLCAGroupeID() {
		return $this->LCAGroupeID;
	}
	function setID($newValue) {
		$this->id = $newValue;
	}
	function setName($newValue) {
		$this->name = $newValue;
	}
	function setAnnuaire($newValue) {
		$this->obj_annuaire = $newValue;
	}
	function setDepartementListe($newValue) {
		$this->obj_departementListe = $newValue;
	}
	function setLCAGroupeID($newValue) {
		$this->LCAGroupeID = $newValue;
	}

	// ###################
	function create_region() {
		$query = sprintf ( "INSERT INTO annuaire_lva_region (RegionID,AnnuaireID,Libelle) VALUES(NULL,'%s','%s')", mysqli_real_escape_string ($_SESSION['LINK'], ($this->obj_annuaire != NULL ? $this->obj_annuaire->getID () : NULL) ), mysqli_real_escape_string ($_SESSION['LINK'], $this->name ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		$this->found_id ();

		$this->obj_departementListe->create_region ( $this->id );
	}
	function update_region() {
		$query = sprintf ( "UPDATE annuaire_lva_region SET Libelle='%s' WHERE RegionID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $this->name ), mysqli_real_escape_string ($_SESSION['LINK'], $this->id ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		$this->obj_departementListe->update_region ( $this->id );
	}
	function remove_region() {
		$query = sprintf ( "DELETE FROM annuaire_lva_region WHERE RegionID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $this->id ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	function select_region($regionID) {
		$query = sprintf ( "SELECT RegionID, AnnuaireID, Libelle FROM annuaire_lva_region WHERE RegionID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $regionID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array  ( $result );

			$this->setID ( $line [0] );

			$aAnnuaire = new Annuaire ();
			$aAnnuaire->select_annuaire ( $line [1] );
			$this->setAnnuaire ( $aAnnuaire );

			$this->setName ( $line [2] );
		} else {
			$this->id = NULL;
			$this->name = '';
			$this->obj_annuaire = NULL;
		}

		mysqli_free_result  ( $result );
	}
	function found_id() {
		$query = sprintf ( "SELECT RegionID FROM annuaire_lva_region WHERE AnnuaireID='%s' AND Libelle='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $this->obj_annuaire->getID () ), mysqli_real_escape_string ($_SESSION['LINK'], $this->name ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		$line = mysqli_fetch_array  ( $result );

		$this->setID ( $line [0] );
	}
}
?>