<?php
/**
 * Class utilisée pour la gestion des départements 
 * @author Quentin BRISSON
 * @package app-site-emploi
 * @subpackage mail
 * @version 1.0.4
 *
 */
class ListDepartement {
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

		$sql = "SELECT DepartementID, Libelle, Code FROM annuaire_lva_departement order by Libelle";

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
	public function SQL_FIND_CANDIDATURE_DEPARTEMENT($idDep, $idcv) {
		$sql = "SELECT DepartementID FROM emploi_candidatures_departements ";
		$sql .= " where emploi_candidatures_departements.DepartementID = '%s'";
		$sql .= " and emploi_candidatures_departements.NumCV = '%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $idDep ), mysqli_real_escape_string ($_SESSION['LINK'], $idcv ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
		$rowCount = mysqli_num_rows ( $result );

		mysqli_free_result  ( $result );

		if ($rowCount > 0)
			return TRUE;
		else
			return FALSE;
	}
	public function SQL_FIND_OFFRE_DEPARTEMENT($idDep, $idoffre) {
		$sql = "SELECT DepartementID FROM emploi_offres_departements ";
		$sql .= " where emploi_offres_departements.DepartementID = '%s'";
		$sql .= " and emploi_offres_departements.NumOffre = '%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $idDep ), mysqli_real_escape_string ($_SESSION['LINK'], $idoffre ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
		$rowCount = mysqli_num_rows ( $result );

		mysqli_free_result  ( $result );

		if ($rowCount > 0)
			return TRUE;
		else
			return FALSE;
	}
	public function SQL_SELECT_REGION_DEPARTEMENT($idRegion) {
		$this->myList = array ();

		$sql = "SELECT annuaire_lva_departement.DepartementID, annuaire_lva_departement.Libelle, annuaire_lva_departement.Code FROM annuaire_lva_departement, annuaire_lva_departement_region ";
		$sql .= " where annuaire_lva_departement_region.DepartementID = annuaire_lva_departement.DepartementID";
		$sql .= " and annuaire_lva_departement_region.RegionID = '%s'";
		$sql .= " ORDER BY annuaire_lva_departement.DepartementID";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $idRegion ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aModele = new Departement ();
			$aModele->setid ( $line [0] );
			$aModele->setname ( $line [1] );
			$aModele->setcode ( $line [2] );

			$this->myList [] = $aModele;
		}

		mysqli_free_result  ( $result );
	}
}

?>