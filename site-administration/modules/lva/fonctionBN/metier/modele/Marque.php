<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage lva
 * @version 1.0.4
 */
class FonctionBN {
	private $id;
	private $name;
	private $obj_annuaire;
	private $NumeroOrdre;

	function __construct()
	{
		$this->id = NULL;
		$this->name = '';
		$this->obj_annuaire = NULL;
		$this->NumeroOrdre = 0;
	}
	function FonctionBN() {
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
	function getNumeroOrdre() {
		return $this->NumeroOrdre;
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
	function setNumeroOrdre($newValue) {
		$this->NumeroOrdre = $newValue;
	}

	// ################
	function create_fonctionbn() {
		$query = sprintf ( "INSERT INTO annuaire_lva_fonctionbn VALUES(NULL,'%s','%s','%s')", mysqli_real_escape_string ($_SESSION['LINK'], ($this->obj_annuaire != NULL ? $this->obj_annuaire->getID () : NULL) ), mysqli_real_escape_string ($_SESSION['LINK'], $this->NumeroOrdre ), mysqli_real_escape_string ($_SESSION['LINK'], $this->name ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	function update_fonctionbn() {
		$query = sprintf ( "UPDATE annuaire_lva_fonctionbn SET Libelle='%s', NumeroOrdre='%s' WHERE FonctionBNID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $this->name ), mysqli_real_escape_string ($_SESSION['LINK'], $this->NumeroOrdre ), mysqli_real_escape_string ($_SESSION['LINK'], $this->id ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	function remove_fonctionbn() {
		$query = sprintf ( "DELETE FROM annuaire_lva_fonctionbn WHERE FonctionBNID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $this->id ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	function select_fonctionbn($annuaireID) {
		$query = sprintf ( "SELECT FonctionBNID, AnnuaireID, Libelle, NumeroOrdre FROM annuaire_lva_fonctionbn WHERE FonctionBNID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $annuaireID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array  ( $result );
			$this->setID ( $line [0] );
			$this->setName ( $line [2] );

			$this->setNumeroOrdre ( $line [3] );

			$aAnnuaire = new Annuaire ();
			$aAnnuaire->select_annuaire ( $line [1] );
			$this->setAnnuaire ( $aAnnuaire );
		} else {
			$this->id = NULL;
			$this->name = '';
			$this->obj_annuaire = NULL;
			$this->NumeroOrdre = 0;
		}

		mysqli_free_result  ( $result );
	}
}

?>