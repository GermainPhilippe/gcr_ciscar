<?php
/**
 * Class utilisée pour la gestion des types de contrat
 * @author Quentin BRISSON
 * @package app-site-emploi
 * @subpackage mail
 * @version 1.0.4
 *
 */
class ListTypeContrat {
	private $myList;
	public function __constructList($aList) {
		$this->myList = $aList;
	}

	// ###
	/**
	 * Retourne l'ensemble des types de contrat
	 */
	public function getList() {
		return $this->myList;
	}
	/**
	 * Insére l'ensemble des types de contrat
	 */
	public function setList($newValue) {
		$this->myList = $newValue;
	}

	// ###
	/**
	 * Sélectionne l'ensemble des types de contrat
	 */
	public function SQL_SELECT_ALL() {
		$this->myList = array ();

		$sql = "SELECT IDType, NomType FROM emploi_type_contrat";

		$result = mysqli_query ($_SESSION['LINK'], $sql ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aModele = new TypeContrat ();
			$aModele->setidtype ( $line [0] );
			$aModele->setnomtype ( $line [1] );

			$this->myList [] = $aModele;
		}

		mysqli_free_result  ( $result );
	}
}

?>