<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage lva
 * @version 1.0.4
 */
class FonctionCommission {
	private $id;
	private $name;
	private $obj_annuaire;

	function __construct()
	{
		$this->id = NULL;
		$this->name = '';
		$this->obj_annuaire = NULL;
	}
	function FonctionCommission() {
		self::__construct();
	}
	
	// ################
	function getID() {
		return $this->id;
	}
	function getName() {
		return $this->name;
	}
	function getAnnuaire() {
		return $this->obj_annuaire;
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

	// ################
	function create_fonctioncommission() {
		$query = sprintf ( "INSERT INTO annuaire_lva_fonctioncommission VALUES(NULL,'%s','%s')", mysqli_real_escape_string ($_SESSION['LINK'], ($this->obj_annuaire != NULL ? $this->obj_annuaire->getID () : NULL) ), mysqli_real_escape_string ($_SESSION['LINK'], $this->name ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	function update_fonctioncommission() {
		$query = sprintf ( "UPDATE annuaire_lva_fonctioncommission SET Libelle='%s' WHERE FonctionCommissionID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $this->name ), mysqli_real_escape_string ($_SESSION['LINK'], $this->id ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	function remove_fonctioncommission() {
		$query = sprintf ( "DELETE FROM annuaire_lva_fonctioncommission WHERE FonctionCommissionID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $this->id ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	function select_fonctioncommission($annuaireID) {
		$query = sprintf ( "SELECT FonctionCommissionID, AnnuaireID, Libelle FROM annuaire_lva_fonctioncommission WHERE FonctionCommissionID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $annuaireID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array  ( $result );
			$this->setID ( $line [0] );
			$this->setName ( $line [2] );

			$aAnnuaire = new Annuaire ();
			$aAnnuaire->select_annuaire ( $line [1] );
			$this->setAnnuaire ( $aAnnuaire );
		} else {
			$this->id = NULL;
			$this->name = '';
			$this->obj_annuaire = NULL;
		}

		mysqli_free_result  ( $result );
	}
}

?>