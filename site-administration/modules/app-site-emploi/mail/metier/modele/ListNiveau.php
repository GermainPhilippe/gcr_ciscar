<?php
/**
 * Class utilisée pour la gestion des niveaux
 * @author Quentin BRISSON
 * @package app-site-emploi
 * @subpackage mail
 * @version 1.0.4
 *
 */
class ListNiveau {
	private $myList;
	public function __constructList($aList) {
		$this->myList = $aList;
	}

	// ###
	/**
	 * Retourne l'ensemble des niveaux
	 */
	public function getList() {
		return $this->myList;
	}
	/**
	 * Insére l'ensemble des niveaux
	 */
	public function setList($newValue) {
		$this->myList = $newValue;
	}

	// ###
	/**
	 * Sélectionne l'ensemble des niveaux
	 */
	public function SQL_SELECT_ALL() {
		$this->myList = array ();

		$sql = "SELECT IDNiveau, Niveau FROM emploi_niveau";

		$result = mysqli_query ($_SESSION['LINK'], $sql ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aModele = new Niveau ();
			$aModele->setidniveau ( $line [0] );
			$aModele->setniveau ( $line [1] );

			$this->myList [] = $aModele;
		}

		mysqli_free_result  ( $result );
	}
}
?>