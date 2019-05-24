<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage role
 * @version 1.0.4
 */
class Role {
	private $id;
	private $obj_individu;
	private $obj_etablissement;
	// private $obj_domaineActivite;
	private $obj_annuaire;
	private $LieuTravailID;
	// private $fonction;
	function __construct() {
		$this->id = NULL;
		$this->obj_individu = NULL;
		$this->obj_etablissement = NULL;
		$this->obj_annuaire = NULL;
		$this->LieuTravailID = 0;
	}

	// ################
	function getID() {
		return $this->id;
	}
	function getIndividu() {
		return $this->obj_individu;
	}
	function getEtablissement() {
		return $this->obj_etablissement;
	}
	function getAnnuaire() {
		return $this->obj_annuaire;
	}
	function getLieuTravailID() {
		return $this->LieuTravailID;
	}
	function setID($newValue) {
		$this->id = $newValue;
	}
	function setIndividu($newValue) {
		$this->obj_individu = $newValue;
	}
	function setEtablissement($newValue) {
		$this->obj_etablissement = $newValue;
	}
	function setAnnuaire($newValue) {
		$this->obj_annuaire = $newValue;
	}
	function setLieuTravailID($newValue) {
		$this->LieuTravailID = $newValue;
	}

	// ###########
	function create_role() {
		$sql = "INSERT INTO annuaire_role (RoleID, IndividuID, EtablissementID, AnnuaireID)";
		$sql .= " VALUES(NULL, '%s','%s','%s')";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $this->obj_individu->getID () ), mysqli_real_escape_string ($_SESSION['LINK'], $this->obj_etablissement->getID () ), mysqli_real_escape_string ($_SESSION['LINK'], $this->obj_annuaire->getID () ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	function update_role() {
	}
	function remove_role() {
		$query = sprintf ( "DELETE FROM annuaire_role WHERE RoleID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $this->getID () ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	function SQL_DELETE($EtablissmentID) {
		$query = sprintf ( "DELETE FROM annuaire_role WHERE IndividuID='%s' AND EtablissementID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $this->getID () ), mysqli_real_escape_string ($_SESSION['LINK'], $EtablissmentID ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	function select_role($i) {
		$sql = "SELECT RoleID, IndividuID, EtablissementID, AnnuaireID FROM annuaire_role WHERE RoleID='%s'";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $i ) );
		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array  ( $result );

			$this->setID ( $line [0] );

			$aIndividu = new Individu ();
			$aIndividu->select_individu ( $line [1] );
			$this->setIndividu ( $aIndividu );

			$aEtablissement = new Etablissement ();
			$aEtablissement->select_etablissement ( $line [2] );
			$this->setEtablissement ( $aEtablissement );

			$aAnnuaire = new Annuaire ();
			$aAnnuaire->select_annuaire ( $line [3] );
			$this->setAnnuaire ( $aAnnuaire );
		} else {
			$this->__construct ();
		}

		mysqli_free_result  ( $result );
	}
	function select_rolePrincipal($i) {
		$sql = "SELECT i.LieuTravailID FROM annuaire_individu i, annuaire_role r WHERE r.EtablissementID = i.LieuTravailID and r.IndividuID = i.IndividuID and r.RoleID ='%s'";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $i ) );
		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array  ( $result );
			$this->setLieuTravailID ( $line [0] );
		} else {
			$this->setLieuTravailID ( 0 );
		}

		mysqli_free_result  ( $result );
	}
	function select_verif_rolePrincipal($etablissementID, $individuID) {
		$sql = "SELECT i.LieuTravailID FROM annuaire_individu i, annuaire_role r WHERE r.EtablissementID = i.LieuTravailID and r.IndividuID = i.IndividuID and r.IndividuID ='%s' and r.EtablissementID = '%s'";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $individuID ), mysqli_real_escape_string ($_SESSION['LINK'], $etablissementID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array  ( $result );
			$this->setLieuTravailID ( $line [0] );
		} else {
			$this->setLieuTravailID ( 0 );
		}

		mysqli_free_result  ( $result );
	}

	// Recherche de l'établissement du premier role pour l'individu passé en paramètre
	function sql_new_rolePrincipal($individuID) {
		$sql = "SELECT EtablissementID FROM annuaire_role WHERE IndividuID= '%s' LIMIT 1 ";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $individuID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array  ( $result );
			return $line [0];
		} else {
			return 0;
		}
	}
}

?>