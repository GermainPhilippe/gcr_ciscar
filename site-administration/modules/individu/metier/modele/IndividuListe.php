<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage individu
 * @version 1.0.4
 */
class IndividuListe {
	private $individuListe;

	function __construct()
	{
		$this->individuListe = array ();
	}
	function IndividuListe() {
		self::__construct();
	}

	// #################
	function addIndividu($aIndividu) {
		$this->individuListe [] = $aIndividu;
	}
	function removeIndividu($i) {
		unset ( $this->individuListe [$i] );
	}
	function getIndividuListe() {
		return $this->individuListe;
	}
	function setIndividuListe($newValue) {
		$this->individuListe = $newValue;
	}
	function getNbIndividu() {
		return count ( $this->individuListe );
	}

	// ###################
	function select_all_individu() {
		$result = mysqli_query ($_SESSION['LINK'], "SELECT IndividuID, Nom, Prenom, Telephone, TelephonePortable, Fax, Mail, LoginSage, PasswordSage, EnSommeil, ImportActif, Login, Password, Civilite, LieuTravailID, AnnuaireID FROM annuaire_individu WHERE AnnuaireID='" . $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] . "'" ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aIndividu = new Individu ();
			$aIndividu->setID ( $line [0] );
			$aIndividu->setNom ( $line [1] );
			$aIndividu->setPrenom ( $line [2] );
			$aIndividu->setTelephone ( $line [3] );
			$aIndividu->setTelephonePortable ( $line [4] );
			$aIndividu->setFax ( $line [5] );
			$aIndividu->setMail ( $line [6] );
			$aIndividu->setLoginSage ( $line [7] );
			$aIndividu->setPasswordSage ( $line [8] );
			$aIndividu->setEnSommeil ( $line [9] );
			$aIndividu->setImportActif ( $line [10] );
			$aIndividu->setLogin ( $line [11] );
			$aIndividu->setPassword ( $line [12] );
			$aIndividu->setCivilite ( $line [13] );

			$aEtablissement = new Etablissement ();
			$aEtablissement->select_etablissement ( $line [14] );
			$aIndividu->setLieuTravail ( $aEtablissement );

			$aAnnuaire = new Annuaire ();
			$aAnnuaire->select_annuaire ( $line [15] );
			$aIndividu->setAnnuaire ( $aAnnuaire );

			$this->individuListe [] = $aIndividu;
		}

		mysqli_free_result  ( $result );
	}
	function select_all_individu_etablissement($etablissementID) {
		$result = mysqli_query ($_SESSION['LINK'], "SELECT IndividuID, Nom, Prenom, Telephone, TelephonePortable, Fax, Mail, LoginSage, PasswordSage, EnSommeil, ImportActif, Login, Password, Civilite, LieuTravailID, AnnuaireID, IdSage FROM annuaire_individu WHERE IndividuID in (select IndividuID from annuaire_role WHERE EtablissementID='" . $etablissementID . "')" ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aIndividu = new Individu ();
			$aIndividu->setID ( $line [0] );
			$aIndividu->setNom ( $line [1] );
			$aIndividu->setPrenom ( $line [2] );
			$aIndividu->setTelephone ( $line [3] );
			$aIndividu->setTelephonePortable ( $line [4] );
			$aIndividu->setFax ( $line [5] );
			$aIndividu->setMail ( $line [6] );
			$aIndividu->setLoginSage ( $line [7] );
			$aIndividu->setPasswordSage ( $line [8] );
			$aIndividu->setEnSommeil ( $line [9] );
			$aIndividu->setImportActif ( $line [10] );
			$aIndividu->setLogin ( $line [11] );
			$aIndividu->setPassword ( $line [12] );
			$aIndividu->setCivilite ( $line [13] );
			$aIndividu->setIdSage ( $line [16] );

			$aEtablissement = new Etablissement ();
			$aEtablissement->select_etablissement ( $line [14] );
			$aIndividu->setLieuTravail ( $aEtablissement );

			$aAnnuaire = new Annuaire ();
			$aAnnuaire->select_annuaire ( $line [15] );
			$aIndividu->setAnnuaire ( $aAnnuaire );

			$this->individuListe [] = $aIndividu;
		}

		mysqli_free_result  ( $result );
	}
	function select_all_individu_etablissement_paginer($etablissementID, $page, $pas, $tri, $ordre) {
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
				$tri = 'IndividuID';
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

		$sql = "SELECT i.IndividuID, i.Nom, i.Prenom, i.Telephone, i.TelephonePortable, i.Fax, i.Mail, i.LoginSage, i.PasswordSage,";
		$sql .= " i.EnSommeil, i.ImportActif, i.Login, i.Password, i.Civilite, i.LieuTravailID, i.AnnuaireID, r.RoleID, i.IdSage ";
		$sql .= " FROM annuaire_individu i, annuaire_role r WHERE  i.individuID = r.IndividuID and r.EtablissementID = '%s'  ";
		// Requête de tri+ordre
		$sql .= " ORDER BY %s %s LIMIT %d, %d";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $etablissementID ), mysqli_real_escape_string ($_SESSION['LINK'], $tri ), mysqli_real_escape_string ($_SESSION['LINK'], $ordre ), mysqli_real_escape_string ($_SESSION['LINK'], ($page - 1) * $pas ), mysqli_real_escape_string ($_SESSION['LINK'], $pas ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		// $result = mysql_query("SELECT i.IndividuID, i.Nom, i.Prenom, i.Telephone, i.TelephonePortable, i.Fax, i.Mail, i.LoginSage, i.PasswordSage, i.EnSommeil, i.ImportActif, i.Login, i.Password, i.Civilite, i.LieuTravailID, i.AnnuaireID, r.RoleID, i.IdSage FROM annuaire_individu i, annuaire_role r WHERE i.individuID = r.IndividuID and r.EtablissementID = '".$etablissementID."' ORDER BY i.IndividuID desc LIMIT ".(($page-1)*$pas)." , ".$pas."") or die(mysql_error());

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aIndividu = new Individu ();
			$aIndividu->setID ( $line [0] );
			$aIndividu->setNom ( $line [1] );
			$aIndividu->setPrenom ( $line [2] );
			$aIndividu->setTelephone ( $line [3] );
			$aIndividu->setTelephonePortable ( $line [4] );
			$aIndividu->setFax ( $line [5] );
			$aIndividu->setMail ( $line [6] );
			$aIndividu->setLoginSage ( $line [7] );
			$aIndividu->setPasswordSage ( $line [8] );
			$aIndividu->setEnSommeil ( $line [9] );
			$aIndividu->setImportActif ( $line [10] );
			$aIndividu->setLogin ( $line [11] );
			$aIndividu->setPassword ( $line [12] );
			$aIndividu->setCivilite ( $line [13] );
			$aIndividu->setIdSage ( $line [17] );

			$aEtablissement = new Etablissement ();
			$aEtablissement->select_etablissement ( $line [14] );
			$aIndividu->setLieuTravail ( $aEtablissement );

			$aAnnuaire = new Annuaire ();
			$aAnnuaire->select_annuaire ( $line [15] );
			$aIndividu->setIndividuRole ( $line [16] );
			$aIndividu->setAnnuaire ( $aAnnuaire );

			$this->individuListe [] = $aIndividu;
		}

		mysqli_free_result  ( $result );
	}

	// Méthode plus utilisée
	function select_individu_sauf_existant($etablissementID) {
		$result = mysqli_query ($_SESSION['LINK'], "SELECT IndividuID, Nom, Prenom, Telephone, TelephonePortable, Fax, Mail, LoginSage, PasswordSage, EnSommeil, ImportActif, Login, Password, Civilite, LieuTravailID, AnnuaireID, IdSage FROM annuaire_individu WHERE AnnuaireID='" . $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] . "' AND IndividuID not in (select IndividuID from annuaire_role WHERE EtablissementID='" . $etablissementID . "')" ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aIndividu = new Individu ();
			$aIndividu->setID ( $line [0] );
			$aIndividu->setNom ( $line [1] );
			$aIndividu->setPrenom ( $line [2] );
			$aIndividu->setTelephone ( $line [3] );
			$aIndividu->setTelephonePortable ( $line [4] );
			$aIndividu->setFax ( $line [5] );
			$aIndividu->setMail ( $line [6] );
			$aIndividu->setLoginSage ( $line [7] );
			$aIndividu->setPasswordSage ( $line [8] );
			$aIndividu->setEnSommeil ( $line [9] );
			$aIndividu->setImportActif ( $line [10] );
			$aIndividu->setLogin ( $line [11] );
			$aIndividu->setPassword ( $line [12] );
			$aIndividu->setCivilite ( $line [13] );
			$aIndividu->setIdSage ( $line [16] );

			$aEtablissement = new Etablissement ();
			$aEtablissement->select_etablissement ( $line [14] );
			$aIndividu->setLieuTravail ( $aEtablissement );

			$aAnnuaire = new Annuaire ();
			$aAnnuaire->select_annuaire ( $line [15] );
			$aIndividu->setAnnuaire ( $aAnnuaire );

			$this->individuListe [] = $aIndividu;
		}

		mysqli_free_result  ( $result );
	}

	// Méthode plus utilisée
	function select_individu_sauf_existant_paginer($etablissementID, $page, $pas) {
		$result = mysqli_query ($_SESSION['LINK'], "SELECT IndividuID, Nom, Prenom, Telephone, TelephonePortable, Fax, Mail, LoginSage, PasswordSage, EnSommeil, ImportActif, Login, Password, Civilite, LieuTravailID, AnnuaireID, IdSage FROM annuaire_individu WHERE AnnuaireID='" . $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] . "' AND IndividuID not in (select IndividuID from annuaire_role WHERE EtablissementID='" . $etablissementID . "') LIMIT " . (($page - 1) * $pas) . " , " . $pas . "" ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aIndividu = new Individu ();
			$aIndividu->setID ( $line [0] );
			$aIndividu->setNom ( $line [1] );
			$aIndividu->setPrenom ( $line [2] );
			$aIndividu->setTelephone ( $line [3] );
			$aIndividu->setTelephonePortable ( $line [4] );
			$aIndividu->setFax ( $line [5] );
			$aIndividu->setMail ( $line [6] );
			$aIndividu->setLoginSage ( $line [7] );
			$aIndividu->setPasswordSage ( $line [8] );
			$aIndividu->setEnSommeil ( $line [9] );
			$aIndividu->setImportActif ( $line [10] );
			$aIndividu->setLogin ( $line [11] );
			$aIndividu->setPassword ( $line [12] );
			$aIndividu->setCivilite ( $line [13] );
			$aIndividu->setIdSage ( $line [16] );

			$aEtablissement = new Etablissement ();
			$aEtablissement->select_etablissement ( $line [14] );
			$aIndividu->setLieuTravail ( $aEtablissement );

			$aAnnuaire = new Annuaire ();
			$aAnnuaire->select_annuaire ( $line [15] );
			$aIndividu->setAnnuaire ( $aAnnuaire );

			$this->individuListe [] = $aIndividu;
		}

		mysqli_free_result  ( $result );
	}
	function select_all_individu_paginer($page, $pas) {
		$result = mysqli_query ($_SESSION['LINK'], "SELECT IndividuID, Nom, Prenom, Telephone, TelephonePortable, Fax, Mail, LoginSage, PasswordSage, EnSommeil, ImportActif, Login, Password, Civilite, LieuTravailID, AnnuaireID, IdSage FROM annuaire_individu WHERE AnnuaireID='" . $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] . "' LIMIT " . (($page - 1) * $pas) . " , " . $pas . "" ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aIndividu = new Individu ();
			$aIndividu->setID ( $line [0] );
			$aIndividu->setNom ( $line [1] );
			$aIndividu->setPrenom ( $line [2] );
			$aIndividu->setTelephone ( $line [3] );
			$aIndividu->setTelephonePortable ( $line [4] );
			$aIndividu->setFax ( $line [5] );
			$aIndividu->setMail ( $line [6] );
			$aIndividu->setLoginSage ( $line [7] );
			$aIndividu->setPasswordSage ( $line [8] );
			$aIndividu->setEnSommeil ( $line [9] );
			$aIndividu->setImportActif ( $line [10] );
			$aIndividu->setLogin ( $line [11] );
			$aIndividu->setPassword ( $line [12] );
			$aIndividu->setCivilite ( $line [13] );
			$aIndividu->setIdSage ( $line [16] );

			$aEtablissement = new Etablissement ();
			$aEtablissement->select_etablissement ( $line [14] );
			$aIndividu->setLieuTravail ( $aEtablissement );

			$aAnnuaire = new Annuaire ();
			$aAnnuaire->select_annuaire ( $line [15] );
			$aIndividu->setAnnuaire ( $aAnnuaire );

			$this->individuListe [] = $aIndividu;
		}

		mysqli_free_result  ( $result );
	}
	function SQL_SELECT_ALL_PAGINER($NumPage, $NbEntry, $SiteID) {
	}

	// Eléments max sans recherche
	function SQL_COUNT($etablissementID) {
		$sql = "SELECT COUNT(*) FROM annuaire_individu WHERE AnnuaireID= %s AND IndividuID not in (select IndividuID from annuaire_role WHERE EtablissementID= %s )";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ), mysqli_real_escape_string ($_SESSION['LINK'], $etablissementID ) );
		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
		$line = mysqli_fetch_array  ( $result );
		return $line [0];
	}

	// Eléments max avec recherche
	function SQL_SEARCH_COUNT($etablissementID, $Recherche) {
		$sql = "SELECT COUNT(*) FROM annuaire_individu WHERE AnnuaireID= %s AND IndividuID not in (select IndividuID from annuaire_role WHERE EtablissementID= %s )";
		$sql .= "AND ( IndividuID LIKE '%s' OR Nom LIKE '%s' OR Prenom LIKE '%s')";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ), mysqli_real_escape_string ($_SESSION['LINK'], $etablissementID ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $Recherche . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $Recherche . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $Recherche . '%' ) );
		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
		$line = mysqli_fetch_array  ( $result );
		return $line [0];
	}
	function SQL_SEARCH($etablissementID, $page, $pas, $Recherche, $tri, $ordre) {
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

		$sql = "SELECT IndividuID, Nom, Prenom, Telephone, TelephonePortable, Fax, Mail, LoginSage,";
		$sql .= " PasswordSage, EnSommeil, ImportActif, Login, Password, Civilite, LieuTravailID, AnnuaireID, IdSage";
		$sql .= " FROM annuaire_individu WHERE AnnuaireID= %s AND IndividuID not in (select IndividuID from annuaire_role  WHERE EtablissementID = %s) ";
		// Requête de recherche
		$sql .= " AND  ( IndividuID LIKE '%s' OR Nom LIKE '%s' OR Prenom LIKE '%s')";
		// Requête de tri+ordre
		$sql .= " ORDER BY %s %s LIMIT %d, %d";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ), mysqli_real_escape_string ($_SESSION['LINK'], $etablissementID ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $Recherche . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $Recherche . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $Recherche . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], $tri ), mysqli_real_escape_string ($_SESSION['LINK'], $ordre ), mysqli_real_escape_string ($_SESSION['LINK'], ($page - 1) * $pas ), mysqli_real_escape_string ($_SESSION['LINK'], $pas ) );
		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aIndividu = new Individu ();
			$aIndividu->setID ( $line [0] );
			$aIndividu->setNom ( $line [1] );
			$aIndividu->setPrenom ( $line [2] );
			$aIndividu->setTelephone ( $line [3] );
			$aIndividu->setTelephonePortable ( $line [4] );
			$aIndividu->setFax ( $line [5] );
			$aIndividu->setMail ( $line [6] );
			$aIndividu->setLoginSage ( $line [7] );
			$aIndividu->setPasswordSage ( $line [8] );
			$aIndividu->setEnSommeil ( $line [9] );
			$aIndividu->setImportActif ( $line [10] );
			$aIndividu->setLogin ( $line [11] );
			$aIndividu->setPassword ( $line [12] );
			$aIndividu->setCivilite ( $line [13] );
			$aIndividu->setIdSage ( $line [16] );

			$aEtablissement = new Etablissement ();
			$aEtablissement->select_etablissement ( $line [14] );
			$aIndividu->setLieuTravail ( $aEtablissement );

			$aAnnuaire = new Annuaire ();
			$aAnnuaire->select_annuaire ( $line [15] );
			$aIndividu->setAnnuaire ( $aAnnuaire );

			$this->individuListe [] = $aIndividu;
		}
		mysqli_free_result  ( $result );
	}
}

?>