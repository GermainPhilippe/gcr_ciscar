<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage etablissement
 * @version 1.0.4
 */
class Simple_EtablissementList {
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
	public function SQL_COUNT() {
		$sql = "SELECT count(*) FROM annuaire_etablissement WHERE AnnuaireID='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ) );
		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
		$line = mysqli_fetch_array  ( $result );
		return $line [0];
	}
	public function SQL_SELECT_ALL() {
		$this->myList = array ();

		$sql = "SELECT EtablissementID, AnnuaireID, RaisonSociale, Ville, CodePostal, BureauDistributeur, LoginSage, NumRRF, Pays FROM annuaire_etablissement WHERE AnnuaireID='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aModele = new Simple_Etablissement ();
			$aModele->setID ( $line [0] );
			$aModele->setRaisonSociale ( $line [2] );
			$aModele->setVille ( $line [3] );
			$aModele->setPays ( $line [8] );
			$aModele->setCodePostal ( $line [4] );
			$aModele->setBureauDistributeur ( $line [5] );
			$aModele->setLoginSage ( $line [6] );
			$aModele->setNumRRF ( $line [7] );

			$this->myList [] = $aModele;
		}

		mysqli_free_result  ( $result );
	}
	public function SQL_SELECT_PAGE($NumPage, $NumEntry, $tri, $ordre) {
		$this->myList = array ();
		switch ($ordre) {
			case 'a' :
				$ordre = 'ASC';
				break;
			case 'd' :
				$ordre = 'DESC';
				break;
			default :
				$ordre = 'ASC';
		}
		switch ($tri) {

			case '1' :
				$tri = 'RaisonSociale';
				break;
			case '2' :
				$tri = 'CodePostal';
				break;
			case '3' :
				$tri = 'BureauDistributeur';
				break;
			case '4' :
				$tri = 'Ville';
				break;
			case '5' :
				$tri = 'LoginSage';
				break;
			case '6' :
				$tri = 'NumRRF';
				break;
			default :
				$tri = 'RaisonSociale';
				break;
		}
		$sql = "SELECT EtablissementID, AnnuaireID, RaisonSociale, Ville, CodePostal, BureauDistributeur, LoginSage, NumRRF, RegionID FROM annuaire_etablissement WHERE AnnuaireID='%s' ORDER BY %s %s LIMIT %d, %d ";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ), mysqli_real_escape_string ($_SESSION['LINK'], $tri ), mysqli_real_escape_string ($_SESSION['LINK'], $ordre ), ($NumPage - 1) * $NumEntry, $NumEntry );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aModele = new Simple_Etablissement ();
			$aModele->setID ( $line [0] );
			$aModele->setRaisonSociale ( $line [2] );
			$aModele->setVille ( $line [3] );
			$aModele->setCodePostal ( $line [4] );
			$aModele->setBureauDistributeur ( $line [5] );
			$aModele->setLoginSage ( $line [6] );
			$aModele->setNumRRF ( $line [7] );
			$aModele->setRegionID ( $line [8] );

			$this->myList [] = $aModele;
		}

		mysqli_free_result  ( $result );
	}
	public function SQL_SEARCH($NumPage, $NumEntry, $Recherche, $tri, $ordre) {
		$this->myList = array ();
		switch ($ordre) {
			case 'a' :
				$ordre = 'ASC';
				break;
			case 'd' :
				$ordre = 'DESC';
				break;
			default :
				$ordre = 'ASC';
		}
		switch ($tri) {

			case '1' :
				$tri = 'EtablissementID';
				break;
			case '2' :
				$tri = 'Ville';
				break;
			case '3' :
				$tri = 'RaisonSociale';
				break;
			case '4' :
				$tri = 'CodePostal';
				break;
			case '5' :
				$tri = 'BureauDistributeur';
				break;
			default :
				$tri = 'EtablissementID';
				break;
		}
		$sql = "SELECT EtablissementID, AnnuaireID, RaisonSociale, Ville, CodePostal, BureauDistributeur, LoginSage, NumRRF, RegionID FROM annuaire_etablissement WHERE AnnuaireID='%s' AND ( UPPER(EtablissementID) LIKE UPPER('%s') OR UPPER(Ville) LIKE UPPER('%s')  OR UPPER(RaisonSociale) LIKE UPPER('%s') OR UPPER(CodePostal) LIKE UPPER('%s') OR UPPER(BureauDistributeur) LIKE UPPER('%s') OR UPPER(LoginSage) LIKE UPPER('%s') OR UPPER(Pays) LIKE UPPER('%s')) ORDER BY %s %s LIMIT %d, %d ";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . trim ( $Recherche ) . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . trim ( $Recherche ) . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . trim ( $Recherche ) . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . trim ( $Recherche ) . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . trim ( $Recherche ) . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . trim ( $Recherche ) . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . trim ( $Recherche ) . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], $tri ), mysqli_real_escape_string ($_SESSION['LINK'], $ordre ), ($NumPage - 1) * $NumEntry, $NumEntry );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aModele = new Simple_Etablissement ();
			$aModele->setID ( $line [0] );
			$aModele->setRaisonSociale ( $line [2] );
			$aModele->setVille ( $line [3] );
			$aModele->setCodePostal ( $line [4] );
			$aModele->setBureauDistributeur ( $line [5] );
			$aModele->setLoginSage ( $line [6] );
			$aModele->setNumRRF ( $line [7] );
			$aModele->setRegionID ( $line [8] );

			$this->myList [] = $aModele;
		}

		mysqli_free_result  ( $result );
	}
	public function SQL_SEARCH_COUNT($Recherche) {
		$sql = "SELECT count(*) FROM annuaire_etablissement WHERE AnnuaireID='%s' AND (EtablissementID LIKE '%s' OR  Ville LIKE '%s' OR  Pays LIKE '%s'  OR RaisonSociale LIKE '%s' OR CodePostal LIKE '%s'	OR BureauDistributeur LIKE '%s')";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $Recherche . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $Recherche . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $Recherche . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $Recherche . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $Recherche . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $Recherche . '%' ) );
		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
		$line = mysqli_fetch_array  ( $result );
		return $line [0];
	}
}
?>