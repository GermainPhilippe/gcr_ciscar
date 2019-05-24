<?php
/**
 * @author Florent DESPIERRES
 * @package app-convention
 * @subpackage Parametre
 * @version 1.0.4
 */
class ParametreList {
	private $myList;
	public function __constructList($aList) {
		$this->myList = $aList;
	}

	// ###
	public function getList() {
		return $this->myList;
	}
	public function setList($newValue) {
		$this->myList = $newValue;
	}

	// ###
	public function SQL_SELECT_ALL() {
		$this->myList = array ();

		$sql = "SELECT ParametreID, Nom, Valeur FROM conv_parametre";

		$result = mysqli_query ($_SESSION['LINK'], $sql ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aModele = new Parametre ();
			$aModele->setID ( $line [0] );
			$aModele->setNom ( $line [1] );
			$aModele->setValeur ( $line [2] );

			$this->myList [] = $aModele;
		}

		mysqli_free_result  ( $result );
	}
}
?>