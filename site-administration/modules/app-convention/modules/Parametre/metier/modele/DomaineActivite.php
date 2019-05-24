<?php
/**
 * @author Florent DESPIERRES
 * @package app-convention
 * @subpackage Parametre
 * @version 1.0.4
 */
class DomaineActivite {
	private $ID;
	private $Libelle;
	public function __construct() {
		$this->ID = NULL;
		$this->Libelle = '';
	}
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
	public function SQL_getAnnuaireType($DomainActiviteID) {
		$sql = "SELECT AnnuaireTypeID FROM `conv_annuaire_type_domaine` WHERE DomainActiviteID='%s'";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $DomainActiviteID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		$line = mysqli_fetch_array  ( $result );
		return $line [0];
	}
	public function SQL_SELECT($DomaineActiviteID) {
		$query = sprintf ( "SELECT DomainActiviteID, Libelle FROM annuaire_lva_domainactivite WHERE DomainActiviteID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $DomaineActiviteID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		if (mysqli_num_rows ( $result ) == 1) {
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