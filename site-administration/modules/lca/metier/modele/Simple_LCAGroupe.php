<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage lca
 * @version 1.0.4
 */
class Simple_LCAGroupe {
	private $ID;
	private $Libelle;
	public function __construct() {
		$this->ID = NULL;
		$this->Libelle = '';
	}

	// ###
	public function getID() {
		return $this->ID;
	}
	public function getLibelle() {
		return $this->Libelle;
	}
	public function setID($newValue) {
		$this->ID = $newValue;
	}
	public function setLibelle($newValue) {
		$this->Libelle = $newValue;
	}

	// ###
	public function SQL_INSERT() {
		$query = sprintf ( "INSERT INTO annuaire_lca_groupe(Libelle,TypeGroupeID) VALUES('%s','4')", mysqli_real_escape_string ($_SESSION['LINK'], $this->Libelle ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function SQL_UPDATE() {
		$query = sprintf ( "UPDATE annuaire_lca_groupe SET Libelle='%s' WHERE GroupeID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $this->Libelle ), mysqli_real_escape_string ($_SESSION['LINK'], $this->ID ) );
		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function SQL_DELETE() {
		$query = sprintf ( "DELETE FROM annuaire_lca_groupe WHERE GroupeID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $this->ID ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function SQL_SELECT($aID) {
		$query = sprintf ( "SELECT GroupeID, Libelle FROM annuaire_lca_groupe WHERE GroupeID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $aID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		if (mysqli_num_rows ( $result ) >= 1) {
			$line = mysqli_fetch_array  ( $result );
			$this->ID = $line [0];
			$this->Libelle = $line [1];
		} else {
			$this->__construct ();
		}

		mysqli_free_result  ( $result );
	}
}
?>