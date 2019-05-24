<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage lva
 * @version 1.0.4
 */
class FonctionDAList {
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
	public function SQL_SELECT_ALL($DomainActiviteID) {
		$this->myList = array ();

		$sql = "SELECT FonctionDAID, DomainActiviteID, NumOrdre, Libelle FROM annuaire_lva_domainactivite_fonction WHERE DomainActiviteID='%s' ORDER BY Libelle, NumOrdre";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $DomainActiviteID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aMarque = new FonctionDA ();
			$aMarque->setID ( $line [0] );
			$aMarque->setDomaineActiviteID ( $line [1] );
			$aMarque->setNumOrdre ( $line [2] );
			$aMarque->setLibelle ( $line [3] );

			$this->myList [] = $aMarque;
		}

		mysqli_free_result  ( $result );
	}
}
?>