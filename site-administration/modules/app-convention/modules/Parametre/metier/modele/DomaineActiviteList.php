<?php
/**
 * @author Florent DESPIERRES
 * @package app-convention
 * @subpackage Parametre
 * @version 1.0.4
 */
class DomaineActiviteList {
	private $myList;
	public function __construct() {
		$this->myList = array ();
	}
	public function getList() {
		return $this->myList;
	}
	public function setList($newValue) {
		$this->myList = $newValue;
	}

	// ###
	public function SQL_SELECT_BY_DA_SELECTED() {
		$sql = "SELECT a.DomainActiviteID, d.Libelle FROM `conv_annuaire_type_domaine` a, annuaire_lva_domainactivite d WHERE a.DomainActiviteID = d.DomainActiviteID ORDER BY d.Libelle";

		$result = mysqli_query ($_SESSION['LINK'], $sql ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aModele = new DomaineActivite ();
			$aModele->setID ( $line [0] );
			$aModele->setLibelle ( $line [1] );
			$this->myList [] = $aModele;
		}

		mysqli_free_result  ( $result );
	}
	public function SQL_SELECT_ALL() {
		$this->myList = array ();

		$query = sprintf ( "SELECT DomainActiviteID, Libelle FROM annuaire_lva_domainactivite WHERE AnnuaireID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aModele = new DomaineActivite ();
			$aModele->setID ( $line [0] );
			$aModele->setLibelle ( $line [1] );
			$this->myList [] = $aModele;
		}

		mysqli_free_result  ( $result );
	}
}
?>