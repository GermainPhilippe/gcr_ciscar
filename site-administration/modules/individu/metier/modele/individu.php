<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage individu
 * @version 1.0.4
 */
class Individu {
	private $id;
	private $nom;
	private $prenom;
	private $telephone;
	private $telephonePortable;
	private $fax;
	private $mail;
	private $mail2;
	private $mail3;
	private $mail4;
	private $dateCreat;
	private $loginSage;
	private $passwordSage;
	private $enSommeil;
	private $cliInfo;
	private $cliMercham;
	private $cliGarage;
	private $importActif;
	private $login;
	private $password;
	private $loginRgpg;
	private $passwordRgpd;
	private $statutRgpd;
	private $civilite;
	private $idSage;
	private $lieuTravailID;
	private $individuRole;
	private $obj_lieuTravail;
	private $obj_annuaire;
	private $obj_langueListe;

	function __construct()
	{
		$this->id = NULL;
		$this->nom = '';
		$this->prenom = '';
		$this->telephone = '';
		$this->telephonePortable = '';
		$this->fax = '';
		$this->mail = '';
		$this->mail2 = '';
		$this->mail3 = '';
		$this->mail4 = '';
		$this->dateCreat = '';
		$this->loginSage = '';
		$this->passwordSage = '';
		$this->enSommeil = 0;
		$this->cliInfo = 0;
		$this->cliMercham = 0;
		$this->cliGarage = 0;
		$this->importActif = 0;
		$this->login = '';
		$this->password = '';
		$this->loginRgpd = '';
		$this->passwordRgpd = '';
		$this->statutRgpd = 0;
		$this->civilite = 1;
		$this->idSage = '';
		$this->lieuTravailID = 0;
		$this->individuRole = 0;
		
		$this->obj_lieuTravail = NULL;
		$this->obj_annuaire = NULL;
		$this->obj_langueListe = NULL;
	}
	function Individu() {
		self::__construct();
	}

	// ###################
	function getID() {
		return $this->id;
	}
	function getNom() {
		return stripslashes ( $this->nom );
	}
	function getPrenom() {
		return stripslashes ( $this->prenom );
	}
	function getTelephone() {
		return $this->telephone;
	}
	function getTelephonePortable() {
		return $this->telephonePortable;
	}
	function getFax() {
		return $this->fax;
	}
	function getMail() {
		return $this->mail;
	}
	function getMail2() {
		return $this->mail2;
	}
	function getMail3() {
		return $this->mail3;
	}
	function getMail4() {
		return $this->mail4;
	}
	function getDateCreat() {
		return $this->dateCreat;
	}
	function getLoginSage() {
		return $this->loginSage;
	}
	function getIdSage() {
		return $this->idSage;
	}
	function getPasswordSage() {
		return $this->passwordSage;
	}
	function getEnSommeil() {
		return $this->enSommeil;
	}
	function getCliInfo() {
		return $this->cliInfo;
	}
	function getCliMercham() {
		return $this->cliMercham;
	}
	function getCliGarage() {
		return $this->cliGarage;
	}
	function getImportActif() {
		return $this->importActif;
	}
	function getLogin() {
		return $this->login;
	}
	function getPassword() {
		return $this->password;
	}
	function getLoginRgpd() {
		return $this->loginRgpd;
	}
	function getPasswordRgpd() {
		if($this->passwordRgpd != '')
			return stripslashes ( substr($this->passwordRgpd, 0,2).'******'.$this->passwordRgpd[strlen($this->passwordRgpd)-1]) ;
		else 
			return $this->passwordRgpd;
	}
	function getStatutRgpd() {
		return $this->statutRgpd;
	}
	function getCivilite() {
		return $this->civilite;
	}
	function getLieuTravail() {
		return $this->obj_lieuTravail;
	}
	function getAnnuaire() {
		return $this->obj_annuaire;
	}
	function getLangueListe() {
		return $this->obj_langueListe;
	}
	public function getStringCivilite() {
		switch ($this->civilite) {
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
		switch ($this->civilite) {
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
	function getIndividuRole() {
		return $this->individuRole;
	}
	function getLieuTravailID() {
		return $this->lieuTravailID;
	}

	// ###################
	function setID($newValue) {
		$this->id = $newValue;
	}
	function setNom($newValue) {
		$this->nom = $newValue;
	}
	function setPrenom($newValue) {
		$this->prenom = $newValue;
	}
	function setTelephone($newValue) {
		$this->telephone = $newValue;
	}
	function setTelephonePortable($newValue) {
		$this->telephonePortable = $newValue;
	}
	function setFax($newValue) {
		$this->fax = $newValue;
	}
	function setMail($newValue) {
		$this->mail = $newValue;
	}
	function setMail2($newValue) {
		$this->mail2 = $newValue;
	}
	function setMail3($newValue) {
		$this->mail3 = $newValue;
	}
	function setMail4($newValue) {
		$this->mail4 = $newValue;
	}
	function setDateCreat($newValue) {
		$this->dateCreat = $newValue;
	}
	function setLoginSage($newValue) {
		$this->loginSage = $newValue;
	}
	function setIdSage($newValue) {
		$this->idSage = $newValue;
	}
	function setPasswordSage($newValue) {
		$this->passwordSage = $newValue;
	}
	function setCliInfo($newValue) {
		$this->cliInfo = $newValue;
	}
	function setCliMercham($newValue) {
		$this->cliMercham = $newValue;
	}
	function setCliGarage($newValue) {
		$this->cliGarage = $newValue;
	}
	function setEnSommeil($newValue) {
		$this->enSommeil = $newValue;
	}
	function setImportActif($newValue) {
		$this->importActif = $newValue;
	}
	function setLogin($newValue) {
		$this->login = $newValue;
	}
	function setPassword($newValue) {
		$this->password = $newValue;
	}
	function setLoginRgpd($newValue) {
		$this->loginRgpd = $newValue;
	}
	function setPasswordRgpd($newValue) {
		$this->passwordRgpd = $newValue;
	}
	function setStatutdRgpd($newValue) {
		$this->statutRgpd = $newValue;
	}
	function setCivilite($newValue) {
		$this->civilite = $newValue;
	}
	function setLieuTravail($newValue) {
		$this->obj_lieuTravail = $newValue;
	}
	function setAnnuaire($newValue) {
		$this->obj_annuaire = $newValue;
	}
	function setLangueListe($newValue) {
		$this->obj_langueListe = $newValue;
	}
	function setIndividuRole($newValue) {
		$this->individuRole = $newValue;
	}
	function setLieuTravailID($newValue) {
		$this->lieuTravailID = $newValue;
	}

	// ####################
	function user_exist() {
		$query = sprintf ( "SELECT IndividuID FROM annuaire_individu WHERE Login='%s' AND AnnuaireID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $this->login ), mysqli_real_escape_string ($_SESSION['LINK'], $this->obj_annuaire->getID () ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		return (mysqli_num_rows ( $result ) == 1);
	}
	function userSage_exist($IdSage) {
		$query = sprintf ( "SELECT Login, Password FROM annuaire_individu WHERE IdSage='%s' AND AnnuaireID='1'", mysqli_real_escape_string ($_SESSION['LINK'], $IdSage ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array  ( $result );

			$this->setLogin ( $line [0] );
			$this->setPassword ( $line [1] );
		} else {
			$this->login = '';
			$this->password = '';
		}
		mysqli_free_result  ( $result );
	}
	function userSage_existDeja($IdSage) {
		$query = sprintf ( "SELECT Nom, Prenom FROM annuaire_individu WHERE IdSage='%s' AND AnnuaireID='1'", mysqli_real_escape_string ($_SESSION['LINK'], $IdSage ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		if (mysqli_num_rows ( $result ) > 1) {
			$line = mysqli_fetch_array  ( $result );

			$this->setNom ( $line [0] );
			$this->setPrenom ( $line [1] );
		} else {
			$this->nom = '';
			$this->prenom = '';
		}
		mysqli_free_result  ( $result );
	}
	function create_individu() {
		$sql = "INSERT INTO annuaire_individu VALUES(NULL,'%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s'";
		$sql .= (! is_null ( $this->getLieuTravail () ) && ! is_null ( $this->getLieuTravail ()->getID () )) ? ",'" . $this->getLieuTravail ()->getID () . "'" : ",NULL";
		$sql .= ! is_null ( $this->getAnnuaire ()->getID () ) ? ",'" . $this->getAnnuaire ()->getID () . "'" : ",NULL";
		$sql .= ",'%s','%s',CURRENT_TIMESTAMP,'%s','%s','')";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $this->nom ), mysqli_real_escape_string ($_SESSION['LINK'], $this->prenom ), mysqli_real_escape_string ($_SESSION['LINK'], $this->telephone ), mysqli_real_escape_string ($_SESSION['LINK'], $this->telephonePortable ), mysqli_real_escape_string ($_SESSION['LINK'], $this->fax ), mysqli_real_escape_string ($_SESSION['LINK'], $this->mail ), mysqli_real_escape_string ($_SESSION['LINK'], $this->mail2 ), mysqli_real_escape_string ($_SESSION['LINK'], $this->mail3 ), mysqli_real_escape_string ($_SESSION['LINK'], $this->mail4 ), mysqli_real_escape_string ($_SESSION['LINK'], $this->loginSage ), mysqli_real_escape_string ($_SESSION['LINK'], $this->passwordSage ), mysqli_real_escape_string ($_SESSION['LINK'], $this->enSommeil ), mysqli_real_escape_string ($_SESSION['LINK'], $this->importActif ), mysqli_real_escape_string ($_SESSION['LINK'], $this->login ), mysqli_real_escape_string ($_SESSION['LINK'], $this->password ), mysqli_real_escape_string ($_SESSION['LINK'], $this->civilite ), mysqli_real_escape_string ($_SESSION['LINK'], $this->idSage ), mysqli_real_escape_string ($_SESSION['LINK'], $this->statutRgpd ), mysqli_real_escape_string ($_SESSION['LINK'], $this->loginRgpd ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
		$this->id = mysqli_insert_id ($_SESSION['LINK']);
		$this->obj_langueListe->create_individu ( $this->id );
	}
	function update_individu() {
		$sql = "UPDATE annuaire_individu SET Nom='%s', Prenom='%s', Telephone='%s', TelephonePortable='%s',
									Fax='%s', Mail='%s', Mail2='%s', Mail3='%s', Mail4='%s', LoginSage='%s', PasswordSage='%s',ImportActif='%s',
									EnSommeil='%s',	Password='%s', Civilite='%s', IdSage='%s'";
		$sql .= " WHERE Login='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $this->nom ), mysqli_real_escape_string ($_SESSION['LINK'], $this->prenom ), mysqli_real_escape_string ($_SESSION['LINK'], $this->telephone ), mysqli_real_escape_string ($_SESSION['LINK'], $this->telephonePortable ), mysqli_real_escape_string ($_SESSION['LINK'], $this->fax ), mysqli_real_escape_string ($_SESSION['LINK'], $this->mail ), mysqli_real_escape_string ($_SESSION['LINK'], $this->mail2 ), mysqli_real_escape_string ($_SESSION['LINK'], $this->mail3 ), mysqli_real_escape_string ($_SESSION['LINK'], $this->mail4 ), mysqli_real_escape_string ($_SESSION['LINK'], $this->loginSage ), mysqli_real_escape_string ($_SESSION['LINK'], $this->passwordSage ), mysqli_real_escape_string ($_SESSION['LINK'], $this->importActif ), mysqli_real_escape_string ($_SESSION['LINK'], $this->enSommeil ), mysqli_real_escape_string ($_SESSION['LINK'], $this->password ), mysqli_real_escape_string ($_SESSION['LINK'], $this->civilite ), mysqli_real_escape_string ($_SESSION['LINK'], $this->idSage ), mysqli_real_escape_string ($_SESSION['LINK'], $this->login ) );
		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	function update_individu_by_site($aSiteID) {
		$sql = "UPDATE annuaire_individu SET Nom='%s', Prenom='%s', Telephone='%s', TelephonePortable='%s',
									Fax='%s', Mail='%s', Mail2='%s', Mail3='%s', Mail4='%s',LoginSage='%s', PasswordSage='%s',ImportActif='%s',
									EnSommeil='%s',	Password='%s', Civilite='%s', IdSage='%s', LoginRgpd='%s', PasswordRgpdStatut='%s'";
		$sql .= " WHERE Login='%s' AND AnnuaireID='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->nom ) ), mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->prenom ) ), mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->telephone ) ), mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->telephonePortable ) ), mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->fax ) ), mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->mail ) ), mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->mail2 ) ), mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->mail3 ) ), mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->mail4 ) ), mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->loginSage ) ), mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->passwordSage ) ), mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->importActif ) ), mysqli_real_escape_string ($_SESSION['LINK'], $this->enSommeil ), mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->password ) ), mysqli_real_escape_string ($_SESSION['LINK'], $this->civilite ), mysqli_real_escape_string ($_SESSION['LINK'], $this->idSage ), mysqli_real_escape_string ($_SESSION['LINK'], $this->loginRgpd ), mysqli_real_escape_string ($_SESSION['LINK'], $this->statutRgpd ), mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->login ) ), mysqli_real_escape_string ($_SESSION['LINK'], $aSiteID ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		$this->obj_langueListe->update_individu ( $this->id );

	}
	function remove_individu() {
		$query = sprintf ( "DELETE FROM annuaire_individu WHERE Login='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $this->login ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	function remove_individu_annuaire($i) {
		$query = sprintf ( "DELETE FROM annuaire_individu WHERE IndividuID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $i ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	function select_individu($i) {
		// , ClientInfo, ClientMercham, ClientGarage
		$query = sprintf ( "SELECT IndividuID, Nom, Prenom, Telephone, TelephonePortable, Fax, Mail, Mail2, Mail3, Mail4, LoginSage, PasswordSage, EnSommeil, ImportActif, Login, Password, Civilite, LieuTravailID, AnnuaireID, IdSage, Date_Creat, LoginRgpd, PasswordRgpd, PasswordRgpdStatut
				FROM annuaire_individu WHERE IndividuID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $i ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array  ( $result );

			$this->setID ( $line [0] );
			$this->setNom ( $line [1] );
			$this->setPrenom ( $line [2] );
			$this->setTelephone ( $line [3] );
			$this->setTelephonePortable ( $line [4] );
			$this->setFax ( $line [5] );
			$this->setMail ( $line [6] );
			$this->setMail2 ( $line [7] );
			$this->setMail3 ( $line [8] );
			$this->setMail4 ( $line [9] );
			$this->setLoginSage ( $line [10] );
			$this->setPasswordSage ( $line [11] );
			$this->setEnSommeil ( $line [12] );
			$this->setImportActif ( $line [13] );
			$this->setLogin ( $line [14] );
			$this->setPassword ( $line [15] );
			$this->setCivilite ( $line [16] );
			$this->setLieuTravailID ( $line [17] );
			$this->setIdSage ( $line [19] );
			$this->setDateCreat ( $line [20] );
			$this->setLoginRgpd($line[21]);
			$this->setPasswordRgpd($line[22]);
			$this->setStatutdRgpd($line[23]);

			$aEtablissement = new Etablissement ();
			$aEtablissement->select_etablissement ( $line [17] );
			$this->setLieuTravail ( $aEtablissement );

			$aAnnuaire = new Annuaire ();
			$aAnnuaire->select_annuaire ( $line [18] );
			$this->setAnnuaire ( $aAnnuaire );
		} else {
			$this->id = NULL;
			$this->nom = '';
			$this->prenom = '';
			$this->telephone = '';
			$this->telephonePortable = '';
			$this->fax = '';
			$this->mail = '';
			$this->mail2 = '';
			$this->mail3 = '';
			$this->mail4 = '';
			$this->loginSage = '';
			$this->passwordSage = '';
			$this->enSommeil = 0;
			$this->importActif = 0;
			$this->login = '';
			$this->password = '';
			$this->loginRgpd = '';
			$this->passwordRgpd = '';
			$this->statutRgpd = 0;
			$this->civilite = 1;
			$this->idSage = '';
			$this->lieuTravailID = 0;
			$this->dateCreat = '';

			$this->obj_lieuTravail = NULL;
			$this->obj_annuaire = NULL;
		}

		mysqli_free_result  ( $result );
	}
	function find_id() {
		$query = sprintf ( "SELECT IndividuID FROM annuaire_individu WHERE Nom='%s' and Prenom='%s' and LieuTravailID='%s' and AnnuaireID='%s' ORDER BY IndividuID LIMIT 1", mysqli_real_escape_string ($_SESSION['LINK'], $this->nom ), mysqli_real_escape_string ($_SESSION['LINK'], $this->prenom ), mysqli_real_escape_string ($_SESSION['LINK'], $this->obj_lieuTravail->getID () ), mysqli_real_escape_string ($_SESSION['LINK'], $this->obj_annuaire->getID () ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array  ( $result );

			$this->setID ( $line [0] );
		} else {
			$this->id = NULL;
		}

		mysqli_free_result  ( $result );
	}
	function groupe_remove_all_acces($individuID) {
		$sql = "DELETE FROM annuaire_lca_groupeindividu";
		$sql .= " WHERE IndividuID='%s' AND GroupeID IN (";
		$sql .= " SELECT * FROM (";
		$sql .= "	SELECT annuaire_lca_groupeindividu.GroupeID";
		$sql .= "	FROM annuaire_lca_groupeindividu";
		$sql .= "	INNER JOIN annuaire_lca_groupe ON annuaire_lca_groupeindividu.GroupeID=annuaire_lca_groupe.GroupeID";
		$sql .= "	WHERE annuaire_lca_groupeindividu.IndividuID='%s' AND annuaire_lca_groupe.TypeGroupeID='2'";
		$sql .= ") tmp";
		$sql .= ")";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $individuID ), mysqli_real_escape_string ($_SESSION['LINK'], $individuID ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	function defineWorkingPlace($uid, $cid, $LoginSage) {
		$query = sprintf ( "UPDATE annuaire_individu SET LieuTravailID='%s' , LoginSage= '%s' WHERE IndividuID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $cid ), mysqli_real_escape_string ($_SESSION['LINK'], $LoginSage ), mysqli_real_escape_string ($_SESSION['LINK'], $uid ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}

	/**
	 * Correction du bug 611
	 */
	public static function detectionAnamalieLieuTravail($id) {
		$query = sprintf ( "SELECT IndividuID FROM annuaire_individu WHERE IndividuID='%s' AND LieuTravailID NOT IN (SELECT r.EtablissementID FROM annuaire_role r WHERE r.IndividuID =IndividuID) AND AnnuaireID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $id ), mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['SITE'] ['ID'] ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		return (mysqli_num_rows ( $result ) == 0);
	}
	public static function SQL_CHECK_UNIQUE($firstname, $lastname) {
		$query = sprintf ( "SELECT IndividuID FROM annuaire_individu WHERE UPPER(Nom)=UPPER('%s') AND UPPER(Prenom)=UPPER('%s') AND AnnuaireID='%s'LIMIT 1", mysqli_real_escape_string ($_SESSION['LINK'], $lastname ), mysqli_real_escape_string ($_SESSION['LINK'], $firstname ), mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['SITE'] ['ID'] ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		if (mysqli_num_rows ( $result ) > 0) {
			$line = mysqli_fetch_array  ( $result );
			return ($line [0]);
		} else {
			return NULL;
		}
	}
	public static function SQL_CHECK_NOT_UNIQUE($firstname, $lastname, $loginRgpd) {
		if ($_SESSION ['SITE'] ['ID'] == 2)
			$sAnnuaire = '1,2';
		else
			$sAnnuaire = '1';

			if ($loginRgpd=='') $loginRgpd='vide';
			
			$query = sprintf ( "SELECT count(IndividuID), AnnuaireID FROM annuaire_individu WHERE ((UPPER(Nom)=UPPER('%s') AND UPPER(Prenom)=UPPER('%s')) OR (UPPER(LoginRgpd)=UPPER('%s')))  AND AnnuaireID in (%s) group by AnnuaireID", mysqli_real_escape_string ($_SESSION['LINK'], $lastname ), mysqli_real_escape_string ($_SESSION['LINK'], $firstname ), mysqli_real_escape_string ($_SESSION['LINK'], $loginRgpd ), mysqli_real_escape_string ($_SESSION['LINK'], $sAnnuaire ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		if (mysqli_num_rows ( $result ) > 0) {

			$myList = array ();
			for($i = 0; $i < ( int ) mysqli_num_rows ( $result ); $i ++) {
				$line = mysqli_fetch_array  ( $result );
				if ($line [1] == 1) {
					if ($_SESSION ['SITE'] ['ID'] == 2) {
						$query1 = sprintf ( "SELECT IDSage FROM annuaire_individu WHERE individuID =" . $_SESSION ['ADMIN'] ['USER'] ['USERID'] . " AND AnnuaireID = 2" );
						$result1 = mysqli_query ($_SESSION['LINK'], $query1 ) or die ( mysqli_error ($_SESSION['LINK']) );

						if (mysqli_num_rows ( $result1 ) > 0) {
							$IDSage = mysqli_fetch_array  ( $result1 );
						} else {
							$IDSage = '';
						}
						$host = 'http://' . str_replace ( 'gcrfrance', 'ciscar', str_replace ( '.com', '.fr', $_SERVER ['HTTP_HOST'] ) );

						$myList [$i] = $line [0] . ' individu(s) avec Nom Pr&eacute;nom OU Mail-RGPD similaires dans annuaire CISCAR. <a href="' . $host . '/admin/index.php?RechercheNOM=' . $lastname . '%2B' . $firstname . '%2B' . $loginRgpd . '%2B2' . '&count=' . $line [0] . '&IDGcr=' . $IDSage [0] . '" target="_blank">Consulter la liste des individus concern&eacute;s</a>';
					} else
						$myList [$i] = $line [0] . ' individu(s) avec Nom Pr&eacute;nom OU Mail-RGPD similaires dans annuaire CISCAR. <a href="index.php?RechercheNOM=' . $lastname . '%2B' . $firstname . '%2B' . $loginRgpd . '%2B1' . '&count=' . $line [0] . '" target="_blank">Consulter la liste des individus concern&eacute;s</a>';
				}
				if ($line [1] == 2)
					$myList [$i] = $line [0] . ' individu(s) avec Nom Pr&eacute;nom OU Mail-RGPD similaires dans annuaire GCR. <a href="../individu/index.php?RechercheNOM=' . $lastname . '%2B' . $firstname . '%2B' . $loginRgpd . '%2B2' . '&count=' . $line [0] . '" target="_blank">Consulter la liste des individus concern&eacute;s</a>';
			}
			return ($myList);
		} else {
			$myList = null;
			return ($myList);
		}
	}
	public static function SQL_CHECK_MAIL($mail) {
		$query = sprintf ( "SELECT IndividuID, AnnuaireID, Nom, Prenom, NULL, Civilite FROM annuaire_individu WHERE UPPER(Mail)=UPPER('%s') AND AnnuaireID='%s' order by AnnuaireID", mysqli_real_escape_string ($_SESSION['LINK'], $mail ), mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['SITE'] ['ID'] ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		$listIdMail = array ();

		if (mysqli_num_rows ( $result ) > 0) {
			for($i = 0; $i < ( int ) mysqli_num_rows ( $result ); $i ++) {
				$line = mysqli_fetch_array  ( $result );
				$listIdMail [$i] = $line;
			}
			return ($listIdMail);
		} else {
			$listIdMail = null;
			return ($listIdMail);
		}
	}
}

?>