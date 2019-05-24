<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage document
 * @version 1.0.4
 */
class GroupeList {
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
	public function SQL_select_all() {
		$this->myList = array ();

		$result = mysqli_query ($_SESSION['LINK'], "SELECT GroupeID, Libelle FROM annuaire_lca_groupe WHERE TypeGroupeID IN('1','2','3') AND SiteID='3'" ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aModele = new Groupe ();
			$aModele->setID ( $line [0] );
			$aModele->setName ( $line [1] );
			$this->myList [] = $aModele;
		}

		mysqli_free_result  ( $result );
	}
}
?>