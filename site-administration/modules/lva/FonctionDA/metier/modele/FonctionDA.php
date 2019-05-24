<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage lva
 * @version 1.0.4
 */
class FonctionDA {
	private $ID;
	private $DomaineActiviteID;
	private $Libelle;
	private $NumOrdre;
	public function __construct() {
		$this->ID = NULL;
		$this->DomaineActiviteID = NULL;
		$this->Libelle = '';
		$this->NumOrdre = 100;
	}
	public function getID() {
		return $this->ID;
	}
	public function getDomaineActiviteID() {
		$this->DomaineActiviteID;
	}
	public function getLibelle() {
		return $this->Libelle;
	}
	public function getNumOrdre() {
		return $this->NumOrdre;
	}
	public function setID($newValue) {
		$this->ID = $newValue;
	}
	public function setDomaineActiviteID($newValue) {
		$this->DomaineActiviteID = $newValue;
	}
	public function setLibelle($newValue) {
		$this->Libelle = $newValue;
	}
	public function setNumOrdre($newValue) {
		$this->NumOrdre = $newValue;
	}

	// ###
	public function SQL_CREATE() {
		$sql = "INSERT INTO annuaire_lva_domainactivite_fonction (FonctionDAID,DomainActiviteID,NumOrdre,Libelle)";
		$sql .= " VALUES(NULL,'%s','%s','%s')";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $this->DomaineActiviteID ), mysqli_real_escape_string ($_SESSION['LINK'], $this->NumOrdre ), mysqli_real_escape_string ($_SESSION['LINK'], $this->Libelle ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function SQL_UPDATE() {
		$query = sprintf ( "UPDATE annuaire_lva_domainactivite_fonction SET Libelle='%s', NumOrdre='%s' WHERE FonctionDAID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $this->Libelle ), mysqli_real_escape_string ($_SESSION['LINK'], $this->NumOrdre ), mysqli_real_escape_string ($_SESSION['LINK'], $this->ID ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function SQL_DELETE() {
		$query = sprintf ( "DELETE FROM annuaire_lva_domainactivite_fonction WHERE FonctionDAID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $this->ID ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function SQL_SELECT($FonctionDAID) {
		$query = sprintf ( "SELECT FonctionDAID,DomainActiviteID,NumOrdre,Libelle FROM annuaire_lva_domainactivite_fonction WHERE FonctionDAID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $FonctionDAID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array  ( $result );
			$this->ID = $line [0];
			$this->DomaineActiviteID = $line [1];
			$this->NumOrdre = $line [2];
			$this->Libelle = $line [3];
		} else {
			$this->__construct ();
		}

		mysqli_free_result  ( $result );
	}
}
?>