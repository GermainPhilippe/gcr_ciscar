<?php
/**
 * @author Florent DESPIERRES
 * @package app-convention
 * @subpackage Convention
 * @version 1.0.4
 */
class ConventionList {
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
	public function SQL_SELECT_BY_STATUT($StatutID) {
		$this->myList = array ();

		$query = sprintf ( "SELECT ConventionID,Nom, DateCreation, Statut FROM conv_convention WHERE Statut='%s' ORDER BY ConventionID DESC", mysqli_real_escape_string ($_SESSION['LINK'], $StatutID ) );
		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aModele = new Convention ();
			$aModele->setID ( $line [0] );
			$aModele->setNom ( $line [1] );
			$aModele->setDateCreation ( $line [2] );
			$aModele->setStatut ( $line [3] );

			$this->myList [] = $aModele;
		}

		mysqli_free_result  ( $result );
	}
	public function SQL_SELECT_ALL() {
		$this->myList = array ();

		$result = mysqli_query ($_SESSION['LINK'], "SELECT ConventionID,Nom, DateCreation, Statut FROM conv_convention ORDER BY ConventionID DESC" ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aModele = new Convention ();
			$aModele->setID ( $line [0] );
			$aModele->setNom ( $line [1] );
			$aModele->setDateCreation ( $line [2] );
			$aModele->setStatut ( $line [3] );

			$this->myList [] = $aModele;
		}

		mysqli_free_result  ( $result );
	}
}
?>