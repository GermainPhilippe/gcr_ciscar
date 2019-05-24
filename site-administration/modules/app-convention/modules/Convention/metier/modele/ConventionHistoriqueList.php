<?php
/**
 * @author Florent DESPIERRES
 * @package app-convention
 * @subpackage Convention
 * @version 1.0.4
 */
class ConventionHistoriqueList {
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
	public function SQL_SELECT_ALL($ConventionID) {
		$this->myList = array ();

		$query = sprintf ( "SELECT HistoriqueID, DateAction, Description, ConventionID FROM conv_convention_historique WHERE ConventionID='%s' ORDER BY HistoriqueID DESC", mysqli_real_escape_string ($_SESSION['LINK'], $ConventionID ) );
		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aConventionHistorique = new ConventionHistorique ();
			$aConventionHistorique->setID ( $line [0] );
			$aConventionHistorique->setDateAction ( $line [1] );
			$aConventionHistorique->setDescription ( $line [2] );
			$aConventionHistorique->setConventionID ( $line [3] );
			$this->myList [] = $aConventionHistorique;
		}
	}
}
?>