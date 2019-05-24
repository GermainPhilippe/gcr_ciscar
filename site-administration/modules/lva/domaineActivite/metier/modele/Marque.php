<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage lva
 * @version 1.0.4
 */
class DomaineActivite {
	private $id;
	private $name;
	private $obj_annuaire;
	private $NumOrdre;
	private $NbRole;
	function __construct() {
		$this->id = NULL;
		$this->name = '';
		$this->obj_annuaire = NULL;
		$this->NumOrdre = 100;
		$this->NbRole = 0;
	}

	// ################
	function getID() {
		return $this->id;
	}
	function getName() {
		return str_replace ( '\\', '', $this->name );
	}
	function getAnnuaire() {
		return $this->obj_annuaire;
	}
	public function getNumOrdre() {
		return $this->NumOrdre;
	}
	public function getNbRole() {
		$query = sprintf ( "SELECT count(*) FROM annuaire_role_domainactivite WHERE DomainActiviteID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $this->id ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
		$line = 0;
		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array  ( $result );
			$line = $line [0];
		}
		mysqli_free_result  ( $result );

		return $line;
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
	public function setNumOrdre($newValue) {
		$this->NumOrdre = $newValue;
	}

	// ################
	function create_domaineactivite() {
		$sql = "INSERT INTO annuaire_lva_domainactivite (DomainActiviteID, LCAGroupeID, AnnuaireID, Libelle, NumOrdre)";
		$sql .= " VALUES(NULL,NULL,'%s','%s','%s')";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], ! is_null ( $this->obj_annuaire ) ? $this->obj_annuaire->getID () : NULL ), mysqli_real_escape_string ($_SESSION['LINK'], $this->name ), mysqli_real_escape_string ($_SESSION['LINK'], $this->NumOrdre ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	function update_domaineactivite() {
		$query = sprintf ( "UPDATE annuaire_lva_domainactivite SET Libelle='%s', NumOrdre='%s' WHERE DomainActiviteID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $this->getName () ), mysqli_real_escape_string ($_SESSION['LINK'], $this->NumOrdre ), mysqli_real_escape_string ($_SESSION['LINK'], $this->id ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	function remove_domaineactivite() {
		$query = sprintf ( "DELETE FROM annuaire_lva_domainactivite WHERE DomainActiviteID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $this->id ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	function select_domaineactivite($annuaireID) {
		$query = sprintf ( "SELECT DomainActiviteID, AnnuaireID, Libelle, NumOrdre FROM annuaire_lva_domainactivite WHERE DomainActiviteID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $annuaireID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array  ( $result );
			$this->setID ( $line [0] );
			$this->setName ( $line [2] );
			$this->setNumOrdre ( $line [3] );
			$aAnnuaire = new Annuaire ();
			$aAnnuaire->select_annuaire ( $line [1] );
			$this->setAnnuaire ( $aAnnuaire );
		} else {
			$this->__construct ();
		}

		mysqli_free_result  ( $result );
	}
	function select_name($id) {
		$query = sprintf ( "SELECT  Libelle FROM annuaire_lva_domainactivite WHERE DomainActiviteID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $id ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array  ( $result );

			$this->setName ( $line [0] );
		} else {
			$this->__construct ();
		}

		mysqli_free_result  ( $result );
	}
}

?>