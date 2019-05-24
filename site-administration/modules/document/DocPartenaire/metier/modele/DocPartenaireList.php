<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage document
 * @version 1.0.4
 */
class DocPartenaireList {
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
	public function SQL_SELECT_ALL_ACTIF() {
		$this->myList = array ();

		$query = sprintf ( "SELECT LogoPosition FROM wcm_document_partenaire WHERE SiteID='%s' AND Publication='1'", mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {

			$this->myList [] = $line [0];
		}

		mysqli_free_result  ( $result );
	}
	public function SQL_select_all() {
		$this->myList = array ();

		$query = sprintf ( "SELECT DocPartenaireID, Nom, Adresse, CodePostal, BureauDistributeur, Ville, Telephone, Fax, Mail, NomContact, MailContact, LogoURLSmall, LogoURLBig, LogoPosition, URL, Publication, SiteID FROM wcm_document_partenaire WHERE SiteID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aModele = new DocPartenaire ();
			$aModele->setID ( $line [0] );
			$aModele->setNom ( $line [1] );
			$aModele->setAdresse ( $line [2] );
			$aModele->setCodePostal ( $line [3] );
			$aModele->setBureauDistributeur ( $line [4] );
			$aModele->setVille ( $line [5] );
			$aModele->setTelephone ( $line [6] );
			$aModele->setFax ( $line [7] );
			$aModele->setMail ( $line [8] );
			$aModele->setNomContact ( $line [9] );
			$aModele->setMailContact ( $line [10] );
			$aModele->setLogoURLSmall ( $line [11] );
			$aModele->setLogoURLBig ( $line [12] );
			$aModele->setLogoPosition ( $line [13] );
			$aModele->setURL ( $line [14] );
			$aModele->setPublication ( $line [15] );
			$aModele->setSiteID ( $line [16] );

			$this->myList [] = $aModele;
		}

		mysqli_free_result  ( $result );
	}
	public function SQL_SELECT_ALL_TRI($column = '1', $Order = 'a') {
		$this->myList = array ();

		$sql = "SELECT DocPartenaireID, Nom, Adresse, CodePostal, BureauDistributeur, Ville, Telephone, Fax, Mail, NomContact, MailContact, LogoURLSmall, LogoURLBig, LogoPosition, URL, Publication, SiteID FROM wcm_document_partenaire WHERE SiteID='%s'";
		switch ($column) {
			case '2' :
				$sql .= " ORDER BY Nom";
				break;
			case '3' :
				$sql .= " ORDER BY Publication";
				break;
			default :
				$sql .= " ORDER BY DocPartenaireID";
				break;
		}

		$query = sprintf ( $sql . ($Order == 'a' ? ' ASC' : ' DESC'), mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aModele = new DocPartenaire ();
			$aModele->setID ( $line [0] );
			$aModele->setNom ( $line [1] );
			$aModele->setAdresse ( $line [2] );
			$aModele->setCodePostal ( $line [3] );
			$aModele->setBureauDistributeur ( $line [4] );
			$aModele->setVille ( $line [5] );
			$aModele->setTelephone ( $line [6] );
			$aModele->setFax ( $line [7] );
			$aModele->setMail ( $line [8] );
			$aModele->setNomContact ( $line [9] );
			$aModele->setMailContact ( $line [10] );
			$aModele->setLogoURLSmall ( $line [11] );
			$aModele->setLogoURLBig ( $line [12] );
			$aModele->setLogoPosition ( $line [13] );
			$aModele->setURL ( $line [14] );
			$aModele->setPublication ( $line [15] );
			$aModele->setSiteID ( $line [16] );

			$this->myList [] = $aModele;
		}

		mysqli_free_result  ( $result );
	}
}
?>