<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage role
 * @version 1.0.4
 */
class Simple_RoleList {
	private $myList;
	public function __construct() {
		$this->myList = array ();
	}
	public function setList($newValue) {
		$this->myList = $newValue;
	}
	public function getList() {
		return $this->myList;
	}

	// ###
	public function SQL_COUNT() {
		$sql = "SELECT count(*) FROM annuaire_role WHERE AnnuaireID='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ) );
		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
		$line = mysqli_fetch_array  ( $result );
		return $line [0];
	}
	public function SQL_SELECT_BY_INDIVIDU($aIndividuID) {
		$this->myList = array ();

		// $sql = "SELECT r.RoleID, e.RaisonSociale, r.EtablissementID FROM `annuaire_role` r, annuaire_etablissement e WHERE r.EtablissementID=e.EtablissementID AND r.AnnuaireID='%s' AND r.IndividuID='%s'";

		$sql = "SELECT r.RoleID, e.RaisonSociale, r.EtablissementID, d.Libelle, f.Libelle, d.NumOrdre, e.CodePostal, e.Ville, e.LoginSage";
		$sql .= " FROM `annuaire_role` r, annuaire_etablissement e, annuaire_role_domainactivite rda, annuaire_lva_domainactivite d, annuaire_lva_domainactivite_fonction f";
		$sql .= " WHERE r.RoleID=rda.RoleID AND r.EtablissementID= e.EtablissementID AND rda.DomainActiviteID=d.DomainActiviteID AND rda.FonctionDAID=f.FonctionDAID AND r.AnnuaireID='%s' AND r.IndividuID='%s'";
		$sql .= " ORDER BY d.NumOrdre,r.RoleID";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ), mysqli_real_escape_string ($_SESSION['LINK'], $aIndividuID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$this->myList [] = $line;
		}

		mysqli_free_result  ( $result );
	}
	public function SQL_SELECT_ALL() {
		$this->myList = array ();

		$sql = "SELECT RoleID, IndividuID, AnnuaireID FROM annuaire_role WHERE AnnuaireID='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aModele = new Simple_Role ();
			$aModele->setID ( $line [0] );
			$aModele->setIndividuID ( $line [1] );
			$aModele->setEtablissementID ( $line [2] );
			$aModele->setAnnuaireID ( $line [3] );

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
				$tri = 'IndividuID';
				break;
			case '2' :
				$tri = 'RaisonSociale';
				break;
			case '3' :
				$tri = 'Nom';
				break;
			case '4' :
				$tri = 'Prenom';
				break;
			default :
				$tri = '';
				break;
		}

		if ($tri == 'RaisonSociale') {
			$sql = "SELECT ar.RoleID, ar.IndividuID, ar.EtablissementID, ar.AnnuaireID, ae.RaisonSociale FROM annuaire_role ar, annuaire_etablissement ae WHERE ar.AnnuaireID='%s'AND ar.EtablissementID=ae.EtablissementID ORDER BY ae.RaisonSociale";
			$sql .= " %s LIMIT %d, %d ";

			$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ), mysqli_real_escape_string ($_SESSION['LINK'], $ordre ), ($NumPage - 1) * $NumEntry, $NumEntry );
		} elseif ($tri != '') {
			$sql = "SELECT ar.RoleID, ar.IndividuID, ar.EtablissementID, ar.AnnuaireID, ai.Nom, ai.Prenom FROM annuaire_role ar, annuaire_individu ai WHERE ar.AnnuaireID='%s'AND ar.IndividuID=ai.IndividuID ORDER BY ";
			$sql .= "%s %s LIMIT %d, %d ";

			$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ), mysqli_real_escape_string ($_SESSION['LINK'], $tri ), mysqli_real_escape_string ($_SESSION['LINK'], $ordre ), ($NumPage - 1) * $NumEntry, $NumEntry );
		} else {
			$sql = "SELECT RoleID, IndividuID, EtablissementID, AnnuaireID FROM annuaire_role WHERE AnnuaireID='%s' LIMIT %d, %d ";

			$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ), ($NumPage - 1) * $NumEntry, $NumEntry );
		}

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aModele = new Simple_Role ();
			$aModele->setID ( $line [0] );
			$aModele->setIndividuID ( $line [1] );
			$aModele->setEtablissementID ( $line [2] );
			$aModele->setAnnuaireID ( $line [3] );

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
				$tri = 'IndividuID';
				break;
			case '2' :
				$tri = 'RaisonSociale';
				break;
			case '3' :
				$tri = 'Nom';
				break;
			case '4' :
				$tri = 'Prenom';
				break;
			default :
				$tri = '';
				break;
		}

		if ($tri != '') {
			$sql = "SELECT ar.RoleID, ar.IndividuID, ar.EtablissementID, ar.AnnuaireID, ae.RaisonSociale, ai.Nom, ai.Prenom FROM annuaire_role ar, annuaire_etablissement ae, annuaire_individu ai WHERE ar.AnnuaireID='%s' AND ar.IndividuID=ai.IndividuID AND ar.EtablissementID=ae.EtablissementID  AND ( ar.IndividuID LIKE '%s' OR ai.Nom LIKE '%s' OR ai.Prenom LIKE '%s' OR ae.RaisonSociale LIKE '%s') ORDER BY ";
			$sql .= "%s %s LIMIT %d, %d ";

			$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $Recherche . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $Recherche . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $Recherche . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $Recherche . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], $tri ), mysqli_real_escape_string ($_SESSION['LINK'], $ordre ), ($NumPage - 1) * $NumEntry, $NumEntry );
		} else {
			$sql = "SELECT ar.RoleID, ar.IndividuID, ar.EtablissementID, ar.AnnuaireID, ai.Nom, ai.Prenom, ae.RaisonSociale FROM annuaire_role ar, annuaire_etablissement ae, annuaire_individu ai WHERE ar.AnnuaireID='%s' AND ar.IndividuID=ai.IndividuID AND ar.EtablissementID=ae.EtablissementID  WHERE AnnuaireID='%s'AND (ar.IndividuID LIKE '%s' OR ai.Nom LIKE %s OR ai.Prenom LIKE %s OR ae.RaisonSociale LIKE %s) LIMIT %d, %d ";

			$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $Recherche . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $Recherche . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $Recherche . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $Recherche . '%' ), ($NumPage - 1) * $NumEntry, $NumEntry );
		}

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aModele = new Simple_Role ();
			$aModele->setID ( $line [0] );
			$aModele->setIndividuID ( $line [1] );
			$aModele->setEtablissementID ( $line [2] );
			$aModele->setAnnuaireID ( $line [3] );

			$this->myList [] = $aModele;
		}

		mysqli_free_result  ( $result );
	}
	public function SQL_SEARCH_COUNT($Recherche) {
		$sql = "SELECT count(*) FROM annuaire_role ar, annuaire_etablissement ae, annuaire_individu ai WHERE ar.AnnuaireID='%s' AND ar.IndividuID=ai.IndividuID AND ar.EtablissementID=ae.EtablissementID  AND (ai.Nom LIKE '%s' OR ai.Prenom LIKE '%s' OR ae.RaisonSociale LIKE '%s') ";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $Recherche . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $Recherche . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $Recherche . '%' ) );
		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
		$line = mysqli_fetch_array  ( $result );
		return $line [0];
	}
}
?>