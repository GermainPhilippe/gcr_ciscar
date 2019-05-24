<?php
/**
 * Class utilisée pour la gestion des départements dans les stats
 * @author Alexandre DIALLO
 * @package app-site-emploi
 * @subpackage statistiques
 * @version 1.0.4
 *
 */
class StatListDepartement {
	private $myList;
	public function __constructList($aList) {
		$this->myList = $aList;
	}

	// ###
	/**
	 * Retourne l'ensemble des départements
	 */
	public function getList() {
		return $this->myList;
	}
	/**
	 * Insére l'ensemble des départements
	 */
	public function setList($newValue) {
		$this->myList = $newValue;
	}

	// ###
	/**
	 * Sélectionne tous les départements
	 */
	public function SQL_SELECT_ALL() {
		$this->myList = array ();

		$sql = "SELECT DepartementID, Libelle, Code FROM annuaire_lva_departement";

		$result = mysqli_query ($_SESSION['LINK'], $sql ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aModele = new StatDepartement ();
			$aModele->setiddepartement ( $line [0] );
			$aModele->setlibelle ( $line [1] );
			$aModele->setcode ( $line [2] );

			$this->myList [] = $aModele;
		}

		mysqli_free_result  ( $result );
	}
	/**
	 *
	 * Sélectionne le nom d'un département
	 *
	 * @param
	 *        	int
	 */
	public function SQL_SELECT_DEPARTEMENT($id) {
		$sql = "SELECT Libelle FROM annuaire_lva_departement WHERE  DepartementID = '%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $id ) );
		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
		$line = mysqli_fetch_array  ( $result );
		return $line [0];
		mysqli_free_result  ( $result );
	}
}

?>
