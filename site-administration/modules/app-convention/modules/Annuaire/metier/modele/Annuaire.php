<?php
/**
 * @author Florent DESPIERRES
 * @package app-convention
 * @subpackage annuaire
 * @version 1.0.4
 */
class Annuaire {
	private $ID;
	private $ConventionID;
	private $DomainActiviteID;
	private $DirectionRegionale;
	private $Civilite;
	private $Nom;
	private $Prenom;
	private $Societe;
	private $Adresse;
	private $CodePostal;
	private $Ville;
	private $Mail;
	private $Login;
	private $Password;
	private $TypeInscription;
	private $Presence;
	private $Repas;
	private $Taxi;
	private $Diner;
	private $AnnuaireTypeID;
	private $IndividuID;
	private $miseAJour;
	private $Repondu;
	public function __construct() {
		$this->ID = NULL;
		$this->ConventionID = NULL;
		$this->Civilite = 1;
		$this->Nom = '';
		$this->Prenom = '';
		$this->Societe = '';
		$this->Adresse = '';
		$this->CodePostal = '';
		$this->Ville = '';
		$this->Mail = '';
		$this->Login = '';
		$this->Password = '';
		$this->TypeInscription = 1;
		$this->Presence = 0;
		$this->Repas = 0;
		$this->Repondu = 0;
		$this->Taxi = 2;
		$this->Diner = 2;
		$this->AnnuaireTypeID = 1;
		$this->DomainActiviteID = NULL;
		$this->IndividuID = NULL;
		$this->DirectionRegionale = NULL;
		$this->MiseAJour = NULL;
	}

	// ###
	public function passwdGenerator() {
		$aParamLenght = new Parametre ();
		$aParamLenght->SQL_select_by_name ( 'PASSWD_LENGTH' );
		$aParamChars = new Parametre ();
		$aParamChars->SQL_select_by_name ( 'PASSWD_CHARS' );
		$result = '';

		for($i = 0; $i < $aParamLenght->getValeur (); $i ++) {
			$nb = rand ( 0, (strlen ( $aParamChars->getValeur () ) - 1) );
			$result .= substr ( $aParamChars->getValeur (), $nb, 1 );
		}

		return $result;
	}
	public function loginGenerator() {
		$aParamLenght = new Parametre ();
		$aParamLenght->SQL_select_by_name ( 'PASSWD_COUNTER' );
		$aParamLenght->setValeur ( $aParamLenght->getValeur () + 1 );
		$aParamLenght->SQL_update ();

		$result = $aParamLenght->getValeur ();

		if ($aParamLenght->getValeur () < 10) {
			$result = '0' . $result;
		}

		if ($aParamLenght->getValeur () < 100) {
			$result = '0' . $result;
		}

		if ($aParamLenght->getValeur () < 1000) {
			$result = '0' . $result;
		}

		return $this->Nom . '-' . $result;
	}
	public function getRepondu() {
		return $this->Repondu;
	}
	public function setRepondu($newValue) {
		$this->Repondu = $newValue;
	}
	public function getDomainActiviteID() {
		return $this->DomainActiviteID;
	}
	public function setDomainActiviteID($newValue) {
		$this->DomainActiviteID = $newValue;
	}
	public function setDirectionRegionale($directionRegionale) {
		$this->DirectionRegionale = $directionRegionale;
	}
	public function getDirectionRegionale() {
		return $this->DirectionRegionale;
	}
	public function setMiseAJour($miseAJour) {
		$this->MiseAJour = $miseAJour;
	}
	public function getMiseAJour() {
		return $this->MiseAJour;
	}
	public function getID() {
		return $this->ID;
	}
	public function getConventionID() {
		return $this->ConventionID;
	}
	public function getCivilite() {
		return $this->Civilite;
	}
	public function getStringCivilite() {
		switch ($this->Civilite) {
			case 0 :
				return ' ';
				break;
			case 1 :
				return 'M.';
				break;
			case 2 :
				return 'Mme';
				break;
			case 3 :
				return 'Mlle';
				break;
			default :
				return ' ';
		}
	}
	public function getStringCher() {
		switch ($this->Civilite) {
			case 0 :
				return '';
				break;
			case 1 :
				return 'Cher';
				break;
			case 2 :
				return 'Chère';
				break;
			case 3 :
				return 'Chère';
				break;
			default :
				return '';
		}
	}
	public function getNom() {
		return $this->Nom;
	}
	public function getPrenom() {
		return $this->Prenom;
	}
	public function getSociete() {
		return $this->Societe;
	}
	public function getAdresse() {
		return $this->Adresse;
	}
	public function getCodePostal() {
		return $this->CodePostal;
	}
	public function getVille() {
		return $this->Ville;
	}
	public function getMail() {
		return $this->Mail;
	}
	public function getLogin() {
		return $this->Login;
	}
	public function getPassword() {
		return $this->Password;
	}
	public function getTypeInscription() {
		return $this->TypeInscription;
	}
	public function getPresence() {
		return $this->Presence;
	}
	public function getRepas() {
		return $this->Repas;
	}
	public function getTaxi() {
		return $this->Taxi;
	}
	public function getDiner() {
		return $this->Diner;
	}
	public function getAnnuaireTypeID() {
		return $this->AnnuaireTypeID;
	}
	public function getIndividuID() {
		return $this->IndividuID;
	}

	// ###
	public function setID($newValue) {
		$this->ID = $newValue;
	}
	public function setConventionID($newValue) {
		$this->ConventionID = $newValue;
	}
	public function setCivilite($civilite) {
		$this->Civilite = $civilite;
	}
	public function setNom($newValue) {
		$this->Nom = $newValue;
	}
	public function setPrenom($newValue) {
		$this->Prenom = $newValue;
	}
	public function setSociete($newValue) {
		$this->Societe = $newValue;
	}
	public function setAdresse($newValue) {
		$this->Adresse = $newValue;
	}
	public function setCodePostal($newValue) {
		$this->CodePostal = $newValue;
	}
	public function setVille($newValue) {
		$this->Ville = $newValue;
	}
	public function setMail($newValue) {
		$this->Mail = $newValue;
	}
	public function setLogin($newValue) {
		$this->Login = $newValue;
	}
	public function setPassword($newValue) {
		$this->Password = $newValue;
	}
	public function setTypeInscription($newValue) {
		$this->TypeInscription = $newValue;
	}
	public function setPresence($newValue) {
		$this->Presence = $newValue;
	}
	public function setRepas($newValue) {
		$this->Repas = $newValue;
	}
	public function setTaxi($taxi) {
		$this->Taxi = $taxi;
	}
	public function setDiner($newValue) {
		$this->Diner = $newValue;
	}
	public function setAnnuaireTypeID($newValue) {
		$this->AnnuaireTypeID = $newValue;
	}
	public function setIndividuID($newValue) {
		$this->IndividuID = $newValue;
	}

	// ###
	public function SQL_SELECT_ALL_RESPONSE() {
		$tab = array ();

		$sql = "SELECT c.NomHTML, r.Valeur FROM conv_formulaire_reponse r, conv_formulaire_champ c WHERE c.FormChampID = r.ChampID AND UserID = '%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $this->ID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {

			$tab [] = $line;
		}

		mysqli_free_result  ( $result );

		return $tab;
	}

	/*
	 * Function qui verifie si un email existe dÃ©ja dans l'annuaire pour une convention
	 *
	 * @param idc et email
	 * @return TRUE pour n'existe pas sinon FALSE
	 */
	public function SQL_check_email($email, $conventionID) {
		$return = TRUE;
		$sql = "SELECT Mail FROM conv_annuaire WHERE Mail='%s' AND ConventionID='%s '";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $email ), mysqli_real_escape_string ($_SESSION['LINK'], $conventionID ) );
		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
		if (mysqli_num_rows ( $result ) > 0) {
			$return = FALSE;
		}
		return $return;
	}
	public function SQL_create() {
		$sql = "INSERT INTO conv_annuaire (AnnuaireID,ConventionID, DR,Civilite,Nom,Prenom,Societe,Adresse,CodePostal,Ville,Mail,Login,Password,TypeInscription, Repondu, Presence,Repas,Taxi, Diner, AnnuaireTypeID, IndividuID)";
		$sql .= " VALUES(NULL, '%s','%s','%s','%s', '%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s'";
		$sql .= is_null ( $this->IndividuID ) ? ",NULL)" : ", '" . $this->IndividuID . "')";

		$aDomaineActivite = new DomaineActivite ();
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $this->ConventionID ), 
				// mysql_real_escape_string($this->DomainActiviteID),
				mysqli_real_escape_string ($_SESSION['LINK'], $this->DirectionRegionale ), mysqli_real_escape_string ($_SESSION['LINK'], $this->Civilite ), mysqli_real_escape_string ($_SESSION['LINK'], $this->Nom ), mysqli_real_escape_string ($_SESSION['LINK'], $this->Prenom ), mysqli_real_escape_string ($_SESSION['LINK'], $this->Societe ), mysqli_real_escape_string ($_SESSION['LINK'], $this->Adresse ), mysqli_real_escape_string ($_SESSION['LINK'], $this->CodePostal ), mysqli_real_escape_string ($_SESSION['LINK'], $this->Ville ), mysqli_real_escape_string ($_SESSION['LINK'], $this->Mail ), mysqli_real_escape_string ($_SESSION['LINK'], $this->Login ), mysqli_real_escape_string ($_SESSION['LINK'], $this->Password ), mysqli_real_escape_string ($_SESSION['LINK'], $this->TypeInscription ), mysqli_real_escape_string ($_SESSION['LINK'], $this->Repondu ), mysqli_real_escape_string ($_SESSION['LINK'], $this->Presence ), mysqli_real_escape_string ($_SESSION['LINK'], $this->Repas ), mysqli_real_escape_string ($_SESSION['LINK'], $this->Taxi ), mysqli_real_escape_string ($_SESSION['LINK'], $this->Diner ), mysqli_real_escape_string ($_SESSION['LINK'], $this->AnnuaireTypeID ) );
		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function SQL_update() {
		$sql = "UPDATE conv_annuaire SET DR='%s', Civilite='%s', Nom='%s',Prenom='%s',Societe='%s',Adresse='%s',CodePostal='%s',Ville='%s',Mail='%s',Login='%s',Password='%s',TypeInscription='%s',Presence='%s',Repas='%s', Taxi='%s', Diner='%s', AnnuaireTypeID='%s', Repondu='%s' ";
		$sql .= " WHERE AnnuaireID='%s'";

		$aDomaineActivite = new DomaineActivite ();
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $this->DirectionRegionale ), mysqli_real_escape_string ($_SESSION['LINK'], $this->Civilite ), mysqli_real_escape_string ($_SESSION['LINK'], $this->Nom ), mysqli_real_escape_string ($_SESSION['LINK'], $this->Prenom ), mysqli_real_escape_string ($_SESSION['LINK'], $this->Societe ), mysqli_real_escape_string ($_SESSION['LINK'], $this->Adresse ), mysqli_real_escape_string ($_SESSION['LINK'], $this->CodePostal ), mysqli_real_escape_string ($_SESSION['LINK'], $this->Ville ), mysqli_real_escape_string ($_SESSION['LINK'], $this->Mail ), mysqli_real_escape_string ($_SESSION['LINK'], $this->Login ), mysqli_real_escape_string ($_SESSION['LINK'], $this->Password ), mysqli_real_escape_string ($_SESSION['LINK'], $this->TypeInscription ), mysqli_real_escape_string ($_SESSION['LINK'], $this->Presence ), mysqli_real_escape_string ($_SESSION['LINK'], $this->Repas ), mysqli_real_escape_string ($_SESSION['LINK'], $this->Taxi ), mysqli_real_escape_string ($_SESSION['LINK'], $this->Diner ), mysqli_real_escape_string ($_SESSION['LINK'], $this->AnnuaireTypeID ), mysqli_real_escape_string ($_SESSION['LINK'], $this->Repondu ), mysqli_real_escape_string ($_SESSION['LINK'], $this->ID ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}

	/*
	 * Methode qui supprime un individu de l'annuaire
	 *
	 *
	 */
	public function SQL_delete() {
		$sql = "DELETE FROM conv_annuaire WHERE AnnuaireID='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $this->ID ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	/*
	 * Methode qui l'annuaire en entier
	 *
	 *
	 */
	public function SQL_deleteAll($conventionId) {
		$sql = "DELETE FROM conv_annuaire WHERE ConventionID='%s'";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $conventionId ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function SQL_select($AnnuaireID) {
		$sql = "SELECT AnnuaireID,ConventionID,DomainActiviteID,Civilite,Nom,Prenom,Societe,Adresse,CodePostal,Ville,Mail,Login,Password,TypeInscription,Presence,Repas, Taxi, Diner, AnnuaireTypeID, IndividuID, Repondu, DR";
		$sql .= " FROM conv_annuaire WHERE AnnuaireID='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $AnnuaireID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array  ( $result );

			$this->ID = $line [0];
			$this->ConventionID = $line [1];
			$this->DomainActiviteID = $line [2];
			$this->Civilite = $line [3];
			$this->Nom = $line [4];
			$this->Prenom = $line [5];
			$this->Societe = $line [6];
			$this->Adresse = $line [7];
			$this->CodePostal = $line [8];
			$this->Ville = $line [9];
			$this->Mail = $line [10];
			$this->Login = $line [11];
			$this->Password = $line [12];
			$this->TypeInscription = $line [13];
			$this->Presence = $line [14];
			$this->Repas = $line [15];
			$this->Taxi = $line [16];
			$this->Diner = $line [17];
			$this->AnnuaireTypeID = $line [18];
			$this->IndividuID = $line [19];
			$this->Repondu = $line [20];
			$this->DirectionRegionale = $line [21];
		} else {
			$this->__construct ();
		}

		mysqli_free_result  ( $result );
	}
	public function SQL_IMPORT_GCR($ConventionID) {
		$sql = "SELECT * FROM conv_annuaire_import";

		$result = mysqli_query ($_SESSION['LINK'], $sql ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aModele = new Annuaire ();
			$aModele->setConventionID ( $ConventionID );
			$aModele->setIndividuID ( $line [0] );
			$aModele->setDomainActiviteID ( $line [1] );
			$aModele->setCivilite ( $line [2] );
			$aModele->setNom ( $line [3] );
			$aModele->setPrenom ( $line [4] );
			$aModele->setSociete ( $line [5] );
			$aModele->setAdresse ( $line [6] );
			$aModele->setCodePostal ( $line [7] );
			$aModele->setVille ( $line [8] );
			$aModele->setMail ( $line [9] );
			$aModele->setLogin ( $line [10] );
			$aModele->setPassword ( $line [11] );
			$aModele->setDirectionRegionale ( $line [13] );
			// Type GCR/Manuel/Invitï¿½
			$aModele->setTypeInscription ( 0 );
			$aModele->setPresence ( 0 );
			$aModele->setRepas ( 0 );
			// rechercher la table
			$aDomaineActivite = new DomaineActivite ();
			$aModele->setAnnuaireTypeID ( $aDomaineActivite->SQL_getAnnuaireType ( $line [1] ) );
			$aModele->SQL_create ();
		}

		mysqli_free_result  ( $result );
	}
	public function SQL_SELECT_CHAMP_VALUE($ChampID) {
		$sql = "SELECT Valeur FROM conv_formulaire_reponse WHERE ChampID='%s' AND Userid='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $ChampID ), mysqli_real_escape_string ($_SESSION['LINK'], $this->ID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		if (mysqli_num_rows ( $result ) > 0) {
			$line = mysqli_fetch_array  ( $result );
			return $line [0];
		} else {
			return "";
		}
	}
}
?>