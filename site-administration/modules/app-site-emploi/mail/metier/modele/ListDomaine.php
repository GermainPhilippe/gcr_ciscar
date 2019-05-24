<?php
/**
 * Class utilisée pour la gestion des domaines 
 * @author Quentin BRISSON
 * @package app-site-emploi
 * @subpackage mail
 * @version 1.0.4
 *
 */
class ListDomaine {
	private $myList;
	public function __constructList($aList) {
		$this->myList = $aList;
	}

	// ###
	/**
	 * Retourne l'ensemble des domaines
	 */
	public function getList() {
		return $this->myList;
	}
	/**
	 * Insére l'ensemble des domaines
	 */
	public function setList($newValue) {
		$this->myList = $newValue;
	}

	// ###
	/**
	 * Sélectionne tous les domaines
	 */
	public function SQL_SELECT_ALL() {
		$this->myList = array ();

		$sql = "SELECT IDDomaine, NomDomaine FROM emploi_domaine";

		$result = mysqli_query ($_SESSION['LINK'], $sql ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aModele = new StatDomaine ();
			$aModele->setiddomaine ( $line [0] );
			$aModele->setnomdomaine ( $line [1] );

			$this->myList [] = $aModele;
		}

		mysqli_free_result  ( $result );
	}
	/**
	 *
	 * Sélectionne un domaine en fonction de son id
	 *
	 * @param int $id
	 */
	public function SQL_SELECT_DOMAINE($id) {
		$sql = "SELECT NomDomaine FROM emploi_domaine WHERE  IDDomaine = '%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $id ) );
		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
		$line = mysqli_fetch_array  ( $result );
		return $line [0];
		mysqli_free_result  ( $result );
	}
}

?>