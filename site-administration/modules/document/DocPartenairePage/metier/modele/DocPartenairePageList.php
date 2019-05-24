<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage document
 * @version 1.0.4
 */
class DocPartenairePageList {
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
	public function SQL_select_all($DocID) {
		$this->myList = array ();

		$query = sprintf ( "SELECT DocPartenairePageID, DocPartenaireID, Titre, ContenuRichText, SiteID FROM wcm_document_partenaire_page WHERE SiteID='%s' AND DocPartenaireID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ), mysqli_real_escape_string ($_SESSION['LINK'], $DocID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aModele = new DocPartenairePage ();
			$aModele->setID ( $line [0] );
			$aModele->setDocPartenaireID ( $line [1] );
			$aModele->setTitre ( $line [2] );
			$aModele->setContenuRichText ( $line [3] );
			$aModele->setSiteID ( $line [4] );

			$this->myList [] = $aModele;
		}

		mysqli_free_result  ( $result );
	}
}
?>