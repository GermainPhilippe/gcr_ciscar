<?php
/**
 * @author Florent DESPIERRES
 * @package app-convention
 * @subpackage annuaire
 * @version 1.0.4
 */
class AnnuaireList {
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
	public function SQL_SELECT_ALL_REPONDU_BY_FORM($aFormulaireID) {
		$sql = "SELECT DISTINCT(r.UserID),a.civilite, a.Nom, a.Prenom, a.Societe";
		$sql .= " FROM conv_formulaire_reponse r, conv_formulaire_champ c, conv_formulaire_section s, conv_formulaire_module m, conv_annuaire a";
		$sql .= " WHERE r.ChampID = c.FormChampID AND c.FormSectionID = s.FormSectionID AND s.FormModuleID = m.FormModuleID AND a.AnnuaireID=r.UserID AND m.FormulaireID='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aFormulaireID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aModele = new Annuaire ();
			$aModele->setID ( $line [0] );
			$aModele->setCivilite ( $line [1] );
			$aModele->setNom ( $line [2] );
			$aModele->setPrenom ( $line [3] );
			$aModele->setSociete ( $line [4] );

			$this->myList [] = $aModele;
		}

		mysqli_free_result  ( $result );
	}
	public function SQL_DELETE_ALL_GCR($aConventionID) {
		$sql = "DELETE FROM conv_annuaire WHERE ConventionID='%s' AND TypeInscription='0'";
		$query = sprintf ( $sql, $aConventionID );
		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function SQL_COUNT($ConventionID, $Filter, $search) {
		$sql = "SELECT count(*) FROM conv_annuaire WHERE ConventionID='%s'";

		if (! empty ( $search )) {
			$sql .= " AND (Nom LIKE '%s' OR Mail LIKE '%s' OR Societe LIKE '%s' OR Ville LIKE '%s' OR CodePostal LIKE '%s')";
		}

		$filtre1 = substr ( $Filter, 0, strpos ( $Filter, 'r' ) );
		$filtre2 = substr ( $Filter, strpos ( $Filter, 'r' ), strpos ( $Filter, 'c' ) - strpos ( $Filter, 'r' ) );
		$filtre3 = substr ( $Filter, strpos ( $Filter, 'c' ), strpos ( $Filter, 'p' ) - strpos ( $Filter, 'c' ) );
		$filtre4 = substr ( $Filter, strpos ( $Filter, 'p' ), strpos ( $Filter, 't' ) - strpos ( $Filter, 'p' ) );
		$filtre5 = substr ( $Filter, strpos ( $Filter, 't' ), strlen ( $Filter ) - strpos ( $Filter, 't' ) );

		$filtre1SQL = "";
		$filtre1SQL .= (strpos ( $filtre1, '0' ) != false ? "TypeInscription='0'" : "");
		$filtre1SQL .= (strpos ( $filtre1, '1' ) != false ? ($filtre1SQL != "" ? " OR " : "") . "TypeInscription='1'" : "");
		$filtre1SQL .= (strpos ( $filtre1, '2' ) != false ? ($filtre1SQL != "" ? " OR " : "") . "TypeInscription='2'" : "");
		$sql .= $filtre1SQL != "" ? " AND (" . $filtre1SQL . ")" : "";

		$filtre2SQL = "";
		$filtre2SQL .= (strpos ( $filtre2, '0' ) != false ? "Repondu='0'" : "");
		$filtre2SQL .= (strpos ( $filtre2, '1' ) != false ? ($filtre2SQL != "" ? " OR " : "") . "Repondu='1'" : "");
		$sql .= $filtre2SQL != "" ? " AND (" . $filtre2SQL . ")" : "";

		$filtre3SQL = "";
		$filtre3SQL .= (strpos ( $filtre3, '0' ) != false ? "Presence='0'" : "");
		$filtre3SQL .= (strpos ( $filtre3, '1' ) != false ? ($filtre3SQL != "" ? " OR " : "") . "Presence='1'" : "");
		$sql .= $filtre3SQL != "" ? " AND (" . $filtre3SQL . ")" : "";

		$filtre4SQL = "";
		$filtre4SQL .= (strpos ( $filtre4, '0' ) != false ? "Repas='0'" : "");
		$filtre4SQL .= (strpos ( $filtre4, '1' ) != false ? ($filtre4SQL != "" ? " OR " : "") . "Repas='1'" : "");
		$sql .= $filtre4SQL != "" ? " AND (" . $filtre4SQL . ")" : "";

		$filtre5SQL = "";
		$filtre5SQL .= (strpos ( $filtre5, '1' ) != false ? "AnnuaireTypeID='1'" : "");
		$filtre5SQL .= (strpos ( $filtre5, '2' ) != false ? ($filtre5SQL != "" ? " OR " : "") . "AnnuaireTypeID='2'" : "");
		$filtre5SQL .= (strpos ( $filtre5, '3' ) != false ? ($filtre5SQL != "" ? " OR " : "") . "AnnuaireTypeID='3'" : "");
		$filtre5SQL .= (strpos ( $filtre5, '4' ) != false ? ($filtre5SQL != "" ? " OR " : "") . "AnnuaireTypeID='4'" : "");
		$filtre5SQL .= (strpos ( $filtre5, '5' ) != false ? ($filtre5SQL != "" ? " OR " : "") . "AnnuaireTypeID='5'" : "");
		$filtre5SQL .= (strpos ( $filtre5, '6' ) != false ? ($filtre5SQL != "" ? " OR " : "") . "AnnuaireTypeID='6'" : "");
		$filtre5SQL .= (strpos ( $filtre5, '7' ) != false ? ($filtre5SQL != "" ? " OR " : "") . "AnnuaireTypeID='7'" : "");
		$filtre5SQL .= (strpos ( $filtre5, '8' ) != false ? ($filtre5SQL != "" ? " OR " : "") . "AnnuaireTypeID='8'" : "");
		$filtre5SQL .= (strpos ( $filtre5, '9' ) != false ? ($filtre5SQL != "" ? " OR " : "") . "AnnuaireTypeID='9'" : "");
		$sql .= $filtre5SQL != "" ? " AND (" . $filtre5SQL . ")" : "";

		if (! empty ( $search )) {
			$query = sprintf ( $sql, $ConventionID, '%' . $search . '%', '%' . $search . '%', '%' . $search . '%', '%' . $search . '%', '%' . $search . '%' );
		} else {
			$query = sprintf ( $sql, $ConventionID );
		}
		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
		$line = mysqli_fetch_array  ( $result );
		return $line [0];
	}
	public function SQL_SELECT_ALL_WITHOUT_GUEST($ConventionID) {
		$sql = "SELECT AnnuaireID,ConventionID,DomainActiviteID,Civilite,Nom,Prenom,Societe,Adresse,CodePostal,Ville,Mail,Login,Password,TypeInscription,Presence,Repas, Taxi,Diner,AnnuaireTypeID, Repondu, DR";
		$sql .= " FROM conv_annuaire WHERE ConventionID='%s' AND TypeInscription!='2'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $ConventionID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aModele = new Annuaire ();
			$aModele->setID ( $line [0] );
			$aModele->setConventionID ( $line [1] );
			$aModele->setDomainActiviteID ( $line [2] );
			$aModele->setCivilite ( $line [3] );
			$aModele->setNom ( $line [4] );
			$aModele->setPrenom ( $line [5] );
			$aModele->setSociete ( $line [6] );
			$aModele->setAdresse ( $line [7] );
			$aModele->setCodePostal ( $line [8] );
			$aModele->setVille ( $line [9] );
			$aModele->setMail ( $line [10] );
			$aModele->setLogin ( $line [11] );
			$aModele->setPassword ( $line [12] );
			$aModele->setTypeInscription ( $line [13] );
			$aModele->setPresence ( $line [14] );
			$aModele->setRepas ( $line [15] );
			$aModele->setTaxi ( $line [16] );
			$aModele->setDiner ( $line [17] );
			$aModele->setAnnuaireTypeID ( $line [18] );
			$aModele->setRepondu ( $line [19] );
			$aModele->setDirectionRegionale ( $line [20] );

			$this->myList [] = $aModele;
		}

		mysqli_free_result  ( $result );
	}
	public function SQL_SELECT_ALL($ConventionID) {
		$sql = "SELECT AnnuaireID,ConventionID,DomainActiviteID,Civilite, Nom,Prenom,Societe,Adresse,CodePostal,Ville,Mail,Login,Password,TypeInscription,Presence,Repas,Taxi, Diner AnnuaireTypeID, Repondu, DR";
		$sql .= " FROM conv_annuaire WHERE ConventionID='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $ConventionID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aModele = new Annuaire ();
			$aModele->setID ( $line [0] );
			$aModele->setConventionID ( $line [1] );
			$aModele->setDomainActiviteID ( $line [2] );
			$aModele->setCivilite ( $line [3] );
			$aModele->setNom ( $line [4] );
			$aModele->setPrenom ( $line [5] );
			$aModele->setSociete ( $line [6] );
			$aModele->setAdresse ( $line [7] );
			$aModele->setCodePostal ( $line [8] );
			$aModele->setVille ( $line [9] );
			$aModele->setMail ( $line [10] );
			$aModele->setLogin ( $line [11] );
			$aModele->setPassword ( $line [12] );
			$aModele->setTypeInscription ( $line [13] );
			$aModele->setPresence ( $line [14] );
			$aModele->setRepas ( $line [15] );
			$aModele->setTaxi ( $line [16] );
			$aModele->setDiner ( $line [17] );
			$aModele->setAnnuaireTypeID ( $line [18] );
			$aModele->setRepondu ( $line [19] );
			$aModele->setDirectionRegionale ( $line [20] );

			$this->myList [] = $aModele;
		}

		mysqli_free_result  ( $result );
	}
	public function SQL_SELECT_ALL_GUEST_AND_MANUEL($ConventionID) {
		$sql = "SELECT AnnuaireID,ConventionID,DomainActiviteID,Civilite, Nom,Prenom,Societe,Adresse,CodePostal,Ville,Mail,Login,Password,TypeInscription,Presence,Repas,Taxi, Diner, AnnuaireTypeID, Repondu, DR";
		$sql .= " FROM conv_annuaire WHERE ConventionID='%s' AND TypeInscription IN (1,2)";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $ConventionID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aModele = new Annuaire ();
			$aModele->setID ( $line [0] );
			$aModele->setConventionID ( $line [1] );
			$aModele->setDomainActiviteID ( $line [2] );
			$aModele->setCivilite ( $line [3] );
			$aModele->setNom ( $line [4] );
			$aModele->setPrenom ( $line [5] );
			$aModele->setSociete ( $line [6] );
			$aModele->setAdresse ( $line [7] );
			$aModele->setCodePostal ( $line [8] );
			$aModele->setVille ( $line [9] );
			$aModele->setMail ( $line [10] );
			$aModele->setLogin ( $line [11] );
			$aModele->setPassword ( $line [12] );
			$aModele->setTypeInscription ( $line [13] );
			$aModele->setPresence ( $line [14] );
			$aModele->setRepas ( $line [15] );
			$aModele->setTaxi ( $line [16] );
			$aModele->setDiner ( $line [17] );
			$aModele->setAnnuaireTypeID ( $line [18] );
			$aModele->setRepondu ( $line [19] );
			$aModele->setDirectionRegionale ( $line [20] );

			$this->myList [] = $aModele;
		}

		mysqli_free_result  ( $result );
	}
	public function SQL_SELECT_ALL_RELANCE_WITHOUT_GUEST($ConventionID) {
		$sql = "SELECT AnnuaireID,ConventionID,DomainActiviteID,Civilite,Nom,Prenom,Societe,Adresse,CodePostal,Ville,Mail,Login,Password,TypeInscription,Presence,Repas,Taxi,Diner,AnnuaireTypeID, Repondu, DR";
		$sql .= " FROM conv_annuaire WHERE ConventionID='%s' AND Repondu='0' AND TypeInscription!='2'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $ConventionID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aModele = new Annuaire ();
			$aModele->setID ( $line [0] );
			$aModele->setConventionID ( $line [1] );
			$aModele->setDomainActiviteID ( $line [2] );
			$aModele->setCivilite ( $line [3] );
			$aModele->setNom ( $line [4] );
			$aModele->setPrenom ( $line [5] );
			$aModele->setSociete ( $line [6] );
			$aModele->setAdresse ( $line [7] );
			$aModele->setCodePostal ( $line [8] );
			$aModele->setVille ( $line [9] );
			$aModele->setMail ( $line [10] );
			$aModele->setLogin ( $line [11] );
			$aModele->setPassword ( $line [12] );
			$aModele->setTypeInscription ( $line [13] );
			$aModele->setPresence ( $line [14] );
			$aModele->setRepas ( $line [15] );
			$aModele->setTaxi ( $line [16] );
			$aModele->setDiner ( $line [17] );
			$aModele->setAnnuaireTypeID ( $line [18] );
			$aModele->setRepondu ( $line [19] );

			$this->myList [] = $aModele;
		}

		mysqli_free_result  ( $result );
	}
	public function SQL_SELECT_ALL_RELANCE($ConventionID) {
		$sql = "SELECT AnnuaireID,ConventionID,DomainActiviteID, Civilite, Nom,Prenom,Societe,Adresse,CodePostal,Ville,Mail,Login,Password,TypeInscription,Presence,Repas,Taxi,Diner,AnnuaireTypeID, Repondu, DR";
		$sql .= " FROM conv_annuaire WHERE ConventionID='%s' AND Repondu='0'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $ConventionID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aModele = new Annuaire ();
			$aModele->setID ( $line [0] );
			$aModele->setConventionID ( $line [1] );
			$aModele->setDomainActiviteID ( $line [2] );
			$aModele->setCivilite ( $line [3] );
			$aModele->setNom ( $line [4] );
			$aModele->setPrenom ( $line [5] );
			$aModele->setSociete ( $line [6] );
			$aModele->setAdresse ( $line [7] );
			$aModele->setCodePostal ( $line [8] );
			$aModele->setVille ( $line [9] );
			$aModele->setMail ( $line [10] );
			$aModele->setLogin ( $line [11] );
			$aModele->setPassword ( $line [12] );
			$aModele->setTypeInscription ( $line [13] );
			$aModele->setPresence ( $line [14] );
			$aModele->setRepas ( $line [15] );
			$aModele->setTaxi ( $line [16] );
			$aModele->setDiner ( $line [17] );
			$aModele->setAnnuaireTypeID ( $line [18] );
			$aModele->setRepondu ( $line [19] );
			$aModele->setDirectionRegionale ( $line [20] );

			$this->myList [] = $aModele;
		}

		mysqli_free_result  ( $result );
	}
	public function SQL_SELECT_ALL_SATISFACTION_WITHOUT_GUEST($ConventionID) {
		$sql = "SELECT AnnuaireID,ConventionID,DomainActiviteID,Civilite,Nom,Prenom,Societe,Adresse,CodePostal,Ville,Mail,Login,Password,TypeInscription,Presence,Repas,Taxi,Diner,AnnuaireTypeID, Repondu, DR";
		$sql .= " FROM conv_annuaire WHERE ConventionID='%s' AND Presence='1' AND TypeInscription!='2'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $ConventionID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aModele = new Annuaire ();
			$aModele->setID ( $line [0] );
			$aModele->setConventionID ( $line [1] );
			$aModele->setDomainActiviteID ( $line [2] );
			$aModele->setCivilite ( $line [3] );
			$aModele->setNom ( $line [4] );
			$aModele->setPrenom ( $line [5] );
			$aModele->setSociete ( $line [6] );
			$aModele->setAdresse ( $line [7] );
			$aModele->setCodePostal ( $line [8] );
			$aModele->setVille ( $line [9] );
			$aModele->setMail ( $line [10] );
			$aModele->setLogin ( $line [11] );
			$aModele->setPassword ( $line [12] );
			$aModele->setTypeInscription ( $line [13] );
			$aModele->setPresence ( $line [14] );
			$aModele->setRepas ( $line [15] );
			$aModele->setTaxi ( $line [16] );
			$aModele->setDiner ( $line [17] );
			$aModele->setAnnuaireTypeID ( $line [18] );
			$aModele->setRepondu ( $line [19] );
			$aModele->setDirectionRegionale ( $line [20] );

			$this->myList [] = $aModele;
		}

		mysqli_free_result  ( $result );
	}
	public function SQL_SELECT_ALL_SATISFACTION($ConventionID) {
		$sql = "SELECT AnnuaireID,ConventionID,DomainActiviteID, Civilite,Nom,Prenom,Societe,Adresse,CodePostal,Ville,Mail,Login,Password,TypeInscription,Presence,Repas,Taxi,Diner,AnnuaireTypeID, Repondu, DR";
		$sql .= " FROM conv_annuaire WHERE ConventionID='%s' AND Presence='1' and Repondu = '0'";
		$sql .= " and AnnuaireTypeId not in (1,2) ";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $ConventionID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aModele = new Annuaire ();
			$aModele->setID ( $line [0] );
			$aModele->setConventionID ( $line [1] );
			$aModele->setDomainActiviteID ( $line [2] );
			$aModele->setCivilite ( $line [3] );
			$aModele->setNom ( $line [4] );
			$aModele->setPrenom ( $line [5] );
			$aModele->setSociete ( $line [6] );
			$aModele->setAdresse ( $line [7] );
			$aModele->setCodePostal ( $line [8] );
			$aModele->setVille ( $line [9] );
			$aModele->setMail ( $line [10] );
			$aModele->setLogin ( $line [11] );
			$aModele->setPassword ( $line [12] );
			$aModele->setTypeInscription ( $line [13] );
			$aModele->setPresence ( $line [14] );
			$aModele->setRepas ( $line [15] );
			$aModele->setTaxi ( $line [16] );
			$aModele->setDiner ( $line [17] );
			$aModele->setAnnuaireTypeID ( $line [18] );
			$aModele->setRepondu ( $line [19] );
			$aModele->setDirectionRegionale ( $line [20] );

			$this->myList [] = $aModele;
		}

		mysqli_free_result  ( $result );
	}
	public function SQL_SELECT_ALL_REPONDU($ConventionID) {
		$sql = "SELECT AnnuaireID,ConventionID,DomainActiviteID,Civilite, Nom,Prenom,Societe,Adresse,CodePostal,Ville,Mail,Login,Password,TypeInscription,Presence,Repas,Taxi,Diner,AnnuaireTypeID, Repondu, DR";
		$sql .= " FROM conv_annuaire WHERE ConventionID='%s' AND Repondu='1'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $ConventionID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aModele = new Annuaire ();
			$aModele->setID ( $line [0] );
			$aModele->setConventionID ( $line [1] );
			$aModele->setDomainActiviteID ( $line [2] );
			$aModele->setCivilite ( $line [3] );
			$aModele->setNom ( $line [4] );
			$aModele->setPrenom ( $line [5] );
			$aModele->setSociete ( $line [6] );
			$aModele->setAdresse ( $line [7] );
			$aModele->setCodePostal ( $line [8] );
			$aModele->setVille ( $line [9] );
			$aModele->setMail ( $line [10] );
			$aModele->setLogin ( $line [11] );
			$aModele->setPassword ( $line [12] );
			$aModele->setTypeInscription ( $line [13] );
			$aModele->setPresence ( $line [14] );
			$aModele->setRepas ( $line [15] );
			$aModele->setTaxi ( $line [16] );
			$aModele->setDiner ( $line [17] );
			$aModele->setAnnuaireTypeID ( $line [18] );
			$aModele->setRepondu ( $line [19] );
			$aModele->setDirectionRegionale ( $line [20] );

			$this->myList [] = $aModele;
		}

		mysqli_free_result  ( $result );
	}
	public function SQL_RESET_REPONDU($ConventionID) {
		$sql = "UPDATE conv_annuaire SET Repondu='0' WHERE ConventionID='%s'";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $ConventionID ) );
		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function SQL_SELECT_PAGE($ConventionID, $NumPage, $NumEntry, $Filter, $sort, $order, $search) {
		$sql = "SELECT AnnuaireID,ConventionID,DomainActiviteID,Civilite,Nom,Prenom,Societe,Adresse,CodePostal,Ville,Mail,Login,Password,TypeInscription,Presence,Repas,Taxi,Diner, AnnuaireTypeID, Repondu, DR, MiseAJour";
		$sql .= " FROM conv_annuaire WHERE ConventionID='%s'";

		if (! empty ( $search )) {
			$sql .= " AND (Nom LIKE '%s' OR Mail LIKE '%s' OR Societe LIKE '%s' OR Ville LIKE '%s' OR CodePostal LIKE '%s')";
		}

		$filtre1 = substr ( $Filter, 0, strpos ( $Filter, 'r' ) );
		$filtre2 = substr ( $Filter, strpos ( $Filter, 'r' ), strpos ( $Filter, 'c' ) - strpos ( $Filter, 'r' ) );
		$filtre3 = substr ( $Filter, strpos ( $Filter, 'c' ), strpos ( $Filter, 'p' ) - strpos ( $Filter, 'c' ) );
		$filtre4 = substr ( $Filter, strpos ( $Filter, 'p' ), strpos ( $Filter, 't' ) - strpos ( $Filter, 'p' ) );
		$filtre5 = substr ( $Filter, strpos ( $Filter, 't' ), strlen ( $Filter ) - strpos ( $Filter, 't' ) );

		$filtre1SQL = "";
		$filtre1SQL .= (strpos ( $filtre1, '0' ) != false ? "TypeInscription='0'" : "");
		$filtre1SQL .= (strpos ( $filtre1, '1' ) != false ? ($filtre1SQL != "" ? " OR " : "") . "TypeInscription='1'" : "");
		$filtre1SQL .= (strpos ( $filtre1, '2' ) != false ? ($filtre1SQL != "" ? " OR " : "") . "TypeInscription='2'" : "");
		$sql .= $filtre1SQL != "" ? " AND (" . $filtre1SQL . ")" : "";

		$filtre2SQL = "";
		$filtre2SQL .= (strpos ( $filtre2, '0' ) != false ? "Repondu='0'" : "");
		$filtre2SQL .= (strpos ( $filtre2, '1' ) != false ? ($filtre2SQL != "" ? " OR " : "") . "Repondu='1'" : "");
		$sql .= $filtre2SQL != "" ? " AND (" . $filtre2SQL . ")" : "";

		$filtre3SQL = "";
		$filtre3SQL .= (strpos ( $filtre3, '0' ) != false ? "Presence='0'" : "");
		$filtre3SQL .= (strpos ( $filtre3, '1' ) != false ? ($filtre3SQL != "" ? " OR " : "") . "Presence='1'" : "");
		$sql .= $filtre3SQL != "" ? " AND (" . $filtre3SQL . ")" : "";

		$filtre4SQL = "";
		$filtre4SQL .= (strpos ( $filtre4, '0' ) != false ? "Repas='0'" : "");
		$filtre4SQL .= (strpos ( $filtre4, '1' ) != false ? ($filtre4SQL != "" ? " OR " : "") . "Repas='1'" : "");
		$sql .= $filtre4SQL != "" ? " AND (" . $filtre4SQL . ")" : "";

		$filtre5SQL = "";
		$filtre5SQL .= (strpos ( $filtre5, '1' ) != false ? "AnnuaireTypeID='1'" : "");
		$filtre5SQL .= (strpos ( $filtre5, '2' ) != false ? ($filtre5SQL != "" ? " OR " : "") . "AnnuaireTypeID='2'" : "");
		$filtre5SQL .= (strpos ( $filtre5, '3' ) != false ? ($filtre5SQL != "" ? " OR " : "") . "AnnuaireTypeID='3'" : "");
		$filtre5SQL .= (strpos ( $filtre5, '4' ) != false ? ($filtre5SQL != "" ? " OR " : "") . "AnnuaireTypeID='4'" : "");
		$filtre5SQL .= (strpos ( $filtre5, '5' ) != false ? ($filtre5SQL != "" ? " OR " : "") . "AnnuaireTypeID='5'" : "");
		$filtre5SQL .= (strpos ( $filtre5, '6' ) != false ? ($filtre5SQL != "" ? " OR " : "") . "AnnuaireTypeID='6'" : "");
		$filtre5SQL .= (strpos ( $filtre5, '7' ) != false ? ($filtre5SQL != "" ? " OR " : "") . "AnnuaireTypeID='7'" : "");
		$filtre5SQL .= (strpos ( $filtre5, '8' ) != false ? ($filtre5SQL != "" ? " OR " : "") . "AnnuaireTypeID='8'" : "");
		$filtre5SQL .= (strpos ( $filtre5, '9' ) != false ? ($filtre5SQL != "" ? " OR " : "") . "AnnuaireTypeID='9'" : "");
		$sql .= $filtre5SQL != "" ? " AND (" . $filtre5SQL . ")" : "";

		switch ($sort) {
			case '1' :
				$sql .= ' ORDER BY Nom ' . $order;
				break;
			case '2' :
				$sql .= ' ORDER BY Prenom ' . $order;
				break;
			case '3' :
				$sql .= ' ORDER BY Societe ' . $order;
				break;
			case '4' :
				$sql .= ' ORDER BY AnnuaireTypeID ' . $order;
				break;
			case '5' :
				$sql .= ' ORDER BY MiseAJour ' . $order;
				break;
		}

		$sql .= " LIMIT %d, %d ";

		if (! empty ( $search )) {
			$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $ConventionID ), '%' . $search . '%', '%' . $search . '%', '%' . $search . '%', '%' . $search . '%', '%' . $search . '%', ($NumPage - 1) * $NumEntry, $NumEntry );
		} else {
			$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $ConventionID ), ($NumPage - 1) * $NumEntry, $NumEntry );
		}
		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aModele = new Annuaire ();
			$aModele->setID ( $line [0] );
			$aModele->setConventionID ( $line [1] );
			$aModele->setDomainActiviteID ( $line [2] );
			$aModele->setCivilite ( $line [3] );
			$aModele->setNom ( $line [4] );
			$aModele->setPrenom ( $line [5] );
			$aModele->setSociete ( $line [6] );
			$aModele->setAdresse ( $line [7] );
			$aModele->setCodePostal ( $line [8] );
			$aModele->setVille ( $line [9] );
			$aModele->setMail ( $line [10] );
			$aModele->setLogin ( $line [11] );
			$aModele->setPassword ( $line [12] );
			$aModele->setTypeInscription ( $line [13] );
			$aModele->setPresence ( $line [14] );
			$aModele->setRepas ( $line [15] );
			$aModele->setTaxi ( $line [16] );
			$aModele->setDiner ( $line [17] );
			$aModele->setAnnuaireTypeID ( $line [18] );
			$aModele->setRepondu ( $line [19] );
			$aModele->setDirectionRegionale ( $line [20] );
			$aModele->setMiseAJour ( $line [21] );

			$this->myList [] = $aModele;
		}

		mysqli_free_result  ( $result );
	}
	public function SQL_SELECT_ALL_GUEST($IndividuID) {
		$this->myList = array ();

		$query = sprintf ( "SELECT AnnuaireID,Civilite,Nom,Prenom, Mail, Repondu FROM conv_annuaire WHERE IndividuID='%s' AND TypeInscription='2'", mysqli_real_escape_string ($_SESSION['LINK'], $IndividuID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aModele = new Annuaire ();
			$aModele->setID ( $line [0] );
			$aModele->setCivilite ( $line [1] );
			$aModele->setNom ( $line [2] );
			$aModele->setPrenom ( $line [3] );
			$aModele->setMail ( $line [4] );
			$aModele->setRepondu ( $line [5] );

			$this->myList [] = $aModele;
		}

		mysqli_free_result  ( $result );
	}
	public function SQL_REPORT_COUNTER($ConventionID) {
		$sql = "SELECT Statut FROM conv_convention WHERE ConventionID='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $ConventionID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$Statut = $line [0];
		}

		if ($Statut == '3') {
			$sql = "SELECT 
			(SELECT Count(*) FROM conv_annuaire WHERE `ConventionID`='%s') As TotalAnnuaireConvention,
			(SELECT count(*) FROM `conv_annuaire` WHERE `ConventionID`='%s' AND Repondu='1') AS TotalRepondu,
			(SELECT count(*) FROM `conv_annuaire` WHERE `ConventionID`='%s' AND Repondu='0' AND Presence='1') AS TotalPasRepondu,
			(SELECT count(*) FROM `conv_annuaire` WHERE `ConventionID`='%s' AND Presence='1') AS TotalPresentConvention,
			(SELECT count(*) FROM `conv_annuaire` WHERE `ConventionID`='%s' AND Presence='1' AND Repas='1') AS TotalPresentRepas,
			(SELECT count(*) FROM `conv_annuaire` WHERE `ConventionID`='%s' AND Presence='1' AND Taxi='1') AS TotalTaxi,
			(SELECT count(*) FROM `conv_annuaire` WHERE `ConventionID`='%s' AND Presence='1' AND Diner='1') AS TotalDiner";
		} else {
			$sql = "SELECT
			(SELECT Count(*) FROM conv_annuaire WHERE `ConventionID`='%s') As TotalAnnuaireConvention,
			(SELECT count(*) FROM `conv_annuaire` WHERE `ConventionID`='%s' AND Repondu='1') AS TotalRepondu,
			(SELECT count(*) FROM `conv_annuaire` WHERE `ConventionID`='%s' AND Repondu='0') AS TotalPasRepondu,
			(SELECT count(*) FROM `conv_annuaire` WHERE `ConventionID`='%s' AND Repondu='1' AND Presence='1') AS TotalPresentConvention,
			(SELECT count(*) FROM `conv_annuaire` WHERE `ConventionID`='%s' AND Repondu='1' AND Presence='1' AND Repas='1') AS TotalPresentRepas,
			(SELECT count(*) FROM `conv_annuaire` WHERE `ConventionID`='%s' AND Repondu='1' AND Presence='1' AND Taxi='1') AS TotalTaxi,
			(SELECT count(*) FROM `conv_annuaire` WHERE `ConventionID`='%s' AND Repondu='1' AND Presence='1' AND Diner='1') AS TotalDiner";
		}

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $ConventionID ), mysqli_real_escape_string ($_SESSION['LINK'], $ConventionID ), mysqli_real_escape_string ($_SESSION['LINK'], $ConventionID ), mysqli_real_escape_string ($_SESSION['LINK'], $ConventionID ), mysqli_real_escape_string ($_SESSION['LINK'], $ConventionID ), mysqli_real_escape_string ($_SESSION['LINK'], $ConventionID ), mysqli_real_escape_string ($_SESSION['LINK'], $ConventionID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		return mysqli_fetch_array  ( $result );
	}
	public function SQL_SELECT_ALL_DirectionRegionale() {
		$DR = array ();

		$query = "SELECT RegionID, Libelle FROM annuaire_lva_region WHERE AnnuaireID='2' ORDER BY RegionID";

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$DR [$line [0]] = $line [1];
		}

		return $DR;
	}
}
?>