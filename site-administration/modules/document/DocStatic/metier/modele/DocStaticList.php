<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage document
 * @version 1.0.4
 */
class DocStaticList {
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
	public function SQL_select_all() {
		$this->myList = array ();

		$query = sprintf ( "SELECT DocStaticID, CatTypeID, Titre, ContenuRichText FROM wcm_document_static WHERE SiteID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aModele = new DocStatic ();
			$aModele->setID ( $line [0] );
			$aModele->setCatTypeID ( $line [1] );
			$aModele->setTitre ( $line [2] );
			$aModele->setContenuRichText ( $line [3] );

			$this->myList [] = $aModele;
		}

		mysqli_free_result  ( $result );
	}
}
?>