<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage lca
 * @version 1.0.4
 */
class Simple_LCAGroupeList {
	private $myList;
	public function __construct() {
		$this->myList = array ();
	}

	// ###
	public function getList() {
		return $this->myList;
	}
	public function setList($newValue) {
		$this->myList = $newValue;
	}

	// ###
	public function SQL_SELECT_ALL_SYSTEM() {
		$this->myList = array ();

		$result = mysqli_query ($_SESSION['LINK'], "SELECT GroupeID, Libelle FROM annuaire_lca_groupe WHERE TypeGroupeID='1' ORDER BY Libelle" ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aModele = new Simple_LCAGroupe ();
			$aModele->setID ( $line [0] );
			$aModele->setLibelle ( $line [1] );
			$this->myList [] = $aModele;
		}

		mysqli_free_result  ( $result );
	}
	public function SQL_SELECT_ALL_PERSO() {
		$this->myList = array ();

		$result = mysqli_query ($_SESSION['LINK'], "SELECT GroupeID, Libelle FROM annuaire_lca_groupe WHERE TypeGroupeID='4' ORDER BY Libelle" ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aModele = new Simple_LCAGroupe ();
			$aModele->setID ( $line [0] );
			$aModele->setLibelle ( $line [1] );
			$this->myList [] = $aModele;
		}

		mysqli_free_result  ( $result );
	}
	public function SQL_SELECT_ALL() {
		$this->myList = array ();

		$result = mysqli_query ($_SESSION['LINK'], "SELECT GroupeID, Libelle FROM annuaire_lca_groupe WHERE TypeGroupeID='1' ORDER BY Libelle" ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aModele = new Simple_LCAGroupe ();
			$aModele->setID ( $line [0] );
			$aModele->setLibelle ( $line [1] );
			$this->myList [] = $aModele;
		}

		mysqli_free_result  ( $result );
	}
}
?>