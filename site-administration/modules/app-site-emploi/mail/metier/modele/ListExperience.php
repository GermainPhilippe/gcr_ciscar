<?php
/**
 * Class utilisée pour la gestion de l'information expérience
 * @author Quentin BRISSON
 * @package app-site-emploi
 * @subpackage mail
 * @version 1.0.4
 *
 */
class ListExperience {
	private $myList;
	public function __constructList($aList) {
		$this->myList = $aList;
	}

	// ###
	/**
	 * Retourne l'ensemble des expériences
	 */
	public function getList() {
		return $this->myList;
	}
	/**
	 * Insére l'ensemble des expériences
	 */
	public function setList($newValue) {
		$this->myList = $newValue;
	}

	// ###
	/**
	 * Sélectionne l'ensemble des expériences
	 */
	public function SQL_SELECT_ALL() {
		$this->myList = array ();

		$sql = "SELECT IDExp, Experience FROM emploi_experience";

		$result = mysqli_query ($_SESSION['LINK'], $sql ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aModele = new Experience ();
			$aModele->setidexp ( $line [0] );
			$aModele->setexperience ( $line [1] );

			$this->myList [] = $aModele;
		}

		mysqli_free_result  ( $result );
	}
}
?>