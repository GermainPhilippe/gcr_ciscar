<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage lca
 * @version 1.0.4
 */
class Simple_LCAGroupeMembreList {
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
	public function SQL_SELECT_ALL_SITE($aIndividuID) {
		$tab = array ();

		$query = sprintf ( "SELECT AnnuaireID FROM annuaire_individu WHERE Login=(SELECT Login FROM annuaire_individu WHERE IndividuID='%s')", mysqli_real_escape_string ($_SESSION['LINK'], $aIndividuID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$tab [] = $line [0];
		}

		mysqli_free_result  ( $result );

		return $tab;
	}
	public function SQL_SELECT_ALL_GROUPE($aIndividuID) {
		$this->myList = array ();

		$query = sprintf ( "SELECT g.GroupeID, g.Libelle FROM annuaire_lca_groupeindividu gi, annuaire_lca_groupe g WHERE gi.GroupeID = g.GroupeID AND TypeGroupeID=2 AND individuId='%s' ORDER BY g.Libelle", mysqli_real_escape_string ($_SESSION['LINK'], $aIndividuID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aModele = new Simple_LCAGroupe ();
			$aModele->setID ( $line [0] );
			$aModele->setLibelle ( $line [1] );
			$this->myList [] = $aModele;
		}

		mysqli_free_result  ( $result );
	}
	public function SQL_SELECT_ALL_MEMBRE($aID) {
		$this->myList = array ();

		$query = sprintf ( "SELECT i.IndividuID, i.Nom, i.Prenom, i.Mail FROM annuaire_lca_groupeindividu gi, annuaire_individu i WHERE gi.IndividuID= i.IndividuID AND i.AnnuaireID='%s' and gi.GroupeID='%s' ORDER BY i.Nom, i.Prenom", mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ), mysqli_real_escape_string ($_SESSION['LINK'], $aID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aModele = new Simple_LCAGroupeMembre ();
			$aModele->setID ( $line [0] );
			$aModele->setNom ( $line [1] );
			$aModele->setPrenom ( $line [2] );
			$aModele->setMail ( $line [3] );
			$this->myList [] = $aModele;
		}

		mysqli_free_result  ( $result );
	}
	public function SQL_SELECT_ALL_NON_MEMBRE($aID) {
		$this->myList = array ();

		$query = sprintf ( "SELECT i.IndividuID, i.Nom, i.Prenom FROM annuaire_individu i WHERE i.AnnuaireID='%s' AND i.IndividuID NOT IN (SELECT i.IndividuID FROM annuaire_lca_groupeindividu gi, annuaire_individu i WHERE gi.IndividuID= i.IndividuID AND i.AnnuaireID='%s' and gi.GroupeID='%s') ORDER BY i.Nom, i.Prenom", mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ), mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ), mysqli_real_escape_string ($_SESSION['LINK'], $aID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aModele = new Simple_LCAGroupeMembre ();
			$aModele->setID ( $line [0] );
			$aModele->setNom ( $line [1] );
			$aModele->setPrenom ( $line [2] );
			$this->myList [] = $aModele;
		}

		mysqli_free_result  ( $result );
	}
	public function SQL_SEARCH($aID, $Recherche, $page, $pas, $tri, $ordre) {
		$this->myList = array ();
		switch ($tri) {
			case 1 :
				$tri = 'IndividuID';
				break;
			case 2 :
				$tri = 'Nom';
				break;
			case 3 :
				$tri = 'Prenom';
				break;
			default :
				$tri = 'Nom';
				break;
		}

		switch ($ordre) {
			case 'a' :
				$ordre = 'ASC';
				break;
			case 'd' :
				$ordre = 'DESC';
				break;
			default :
				$ordre = 'DESC';
				break;
		}
		if ($aID == '14') {
			$sql = "SELECT IndividuID, Nom, Prenom FROM annuaire_individu";
			$sql .= " WHERE IndividuID NOT IN(SELECT DISTINCT(r.IndividuID) FROM annuaire_role r WHERE r.AnnuaireID='%s')";
			$sql .= " AND IndividuID NOT IN(SELECT i.IndividuID FROM annuaire_lca_groupeindividu gi, annuaire_individu i WHERE gi.IndividuID= i.IndividuID AND i.AnnuaireID='%s' and gi.GroupeID='%s')";
			$sql .= " AND AnnuaireID='%s' AND (IndividuID LIKE '%s' OR Nom LIKE '%s' OR Prenom LIKE '%s')";
			$sql .= " ORDER BY %s %s LIMIT %d, %d";

			$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ), mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ), mysqli_real_escape_string ($_SESSION['LINK'], $aID ), mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $Recherche . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $Recherche . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $Recherche . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], $tri ), mysqli_real_escape_string ($_SESSION['LINK'], $ordre ), mysqli_real_escape_string ($_SESSION['LINK'], ($page - 1) * $pas ), mysqli_real_escape_string ($_SESSION['LINK'], $pas ) );
		} else {

			$sql = "SELECT i.IndividuID, i.Nom, i.Prenom FROM annuaire_individu i WHERE i.AnnuaireID='%s' AND i.IndividuID NOT IN (SELECT i.IndividuID FROM annuaire_lca_groupeindividu gi, annuaire_individu i WHERE gi.IndividuID= i.IndividuID AND i.AnnuaireID='%s' and gi.GroupeID='%s')";
			$sql .= "AND (i.IndividuID LIKE '%s' OR i.Nom LIKE '%s' OR i.Prenom LIKE '%s')";
			$sql .= " ORDER BY %s %s LIMIT %d, %d";

			$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ), mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ), mysqli_real_escape_string ($_SESSION['LINK'], $aID ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $Recherche . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $Recherche . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $Recherche . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], $tri ), mysqli_real_escape_string ($_SESSION['LINK'], $ordre ), mysqli_real_escape_string ($_SESSION['LINK'], ($page - 1) * $pas ), mysqli_real_escape_string ($_SESSION['LINK'], $pas ) );
		}

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aModele = new Simple_LCAGroupeMembre ();
			$aModele->setID ( $line [0] );
			$aModele->setNom ( $line [1] );
			$aModele->setPrenom ( $line [2] );
			$this->myList [] = $aModele;
		}

		mysqli_free_result  ( $result );
	}
	public function SQL_COUNT($aID) {
		if ($aID == '14') {
			$sql = "SELECT count(*) FROM annuaire_individu";
			$sql .= " WHERE AnnuaireID='%s' AND IndividuID NOT IN(SELECT DISTINCT(r.IndividuID) FROM annuaire_role r WHERE r.AnnuaireID='%s')";
			$sql .= " AND IndividuID NOT IN(SELECT i.IndividuID FROM annuaire_lca_groupeindividu gi, annuaire_individu i WHERE gi.IndividuID= i.IndividuID AND i.AnnuaireID='%s' and gi.GroupeID='%s')";

			$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ), mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ), mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ), mysqli_real_escape_string ($_SESSION['LINK'], $aID ) );
		} else {
			$sql = "SELECT COUNT(*)  FROM annuaire_individu i WHERE i.AnnuaireID=%s AND i.IndividuID NOT IN (SELECT i.IndividuID FROM annuaire_lca_groupeindividu gi, annuaire_individu i WHERE gi.IndividuID= i.IndividuID AND i.AnnuaireID='%s' AND gi.GroupeID='%s')";

			$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ), mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ), mysqli_real_escape_string ($_SESSION['LINK'], $aID ) );
		}

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
		$line = mysqli_fetch_array  ( $result );
		return $line [0];
	}
	public function SQL_SEARCH_COUNT($aID, $Recherche) {
		if ($aID == '14') {
			$sql = "SELECT count(*) FROM annuaire_individu";
			$sql .= " WHERE IndividuID NOT IN(SELECT DISTINCT(r.IndividuID) FROM annuaire_role r WHERE r.AnnuaireID='%s')";
			$sql .= " AND IndividuID NOT IN(SELECT i.IndividuID FROM annuaire_lca_groupeindividu gi, annuaire_individu i WHERE gi.IndividuID= i.IndividuID AND i.AnnuaireID='%s' and gi.GroupeID='%s')";
			$sql .= " AND AnnuaireID='%s' AND (IndividuID LIKE '%s' OR Nom LIKE '%s' OR Prenom LIKE '%s')";

			$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ), mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ), mysqli_real_escape_string ($_SESSION['LINK'], $aID ), mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $Recherche . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $Recherche . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $Recherche . '%' ) );
		} else {
			$sql = "SELECT COUNT(*)  FROM annuaire_individu i WHERE i.AnnuaireID='%s' AND i.IndividuID NOT IN (SELECT i.IndividuID FROM annuaire_lca_groupeindividu gi, annuaire_individu i WHERE gi.IndividuID= i.IndividuID AND i.AnnuaireID='%s' AND gi.GroupeID='%s')";
			$sql .= "AND (i.IndividuID LIKE '%s' OR i.Nom LIKE '%s' OR i.Prenom LIKE '%s')";

			$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ), mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ), mysqli_real_escape_string ($_SESSION['LINK'], $aID ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $Recherche . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $Recherche . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $Recherche . '%' ) );
		}
		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
		$line = mysqli_fetch_array  ( $result );
		return $line [0];
	}
}

?>