<?php
/**
 * Class utilisée pour la gestion des pages infos 
 * @author Quentin BRISSON
 * @package app-site-emploi
 * @subpackage mail
 * @version 1.0.4
 *
 */
class PageInfosList {
	private $myList;
	public function __constructList($aList) {
		$this->myList = $aList;
	}

	// ###
	/**
	 * Retourne l'ensemble des pages infos
	 */
	public function getList() {
		return $this->myList;
	}
	/**
	 * Insére l'ensemble des pages infos
	 */
	public function setList($newValue) {
		$this->myList = $newValue;
	}

	// ###
	/**
	 * Sélectionne l'ensemble des pages infos
	 */
	public function SQL_SELECT_ALL() {
		$this->myList = array ();

		$sql = "SELECT IDPageInfo, EspacePage, AffichagePage, Titre FROM emploi_page_info";

		$result = mysqli_query ($_SESSION['LINK'], $sql ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aModele = new PageInfos ();
			$aModele->setidpageinfo ( $line [0] );
			$aModele->setespace ( $line [1] );
			$aModele->setaffichage ( $line [2] );
			$aModele->settitre ( $line [3] );

			$this->myList [] = $aModele;
		}

		mysqli_free_result  ( $result );
	}
}
?>