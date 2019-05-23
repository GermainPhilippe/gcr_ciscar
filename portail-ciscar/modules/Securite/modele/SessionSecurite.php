<?php
/**
 * @author Florent DESPIERRES
 * @package portail-ciscar
 * @subpackage securite
 * @version 1.0.4
 */
class SessionSecurite {
	// Attributs SITE
	private $mySiteID;
	private $mySiteName;
	
	// Attributs USER
	private $myUserID;
	private $myUserFullname;
	private $myNomUser;
	private $myPrenomUser;
	private $myCiviliteUser;
	private $myMailUser;
	private $myRaisonSocialUser;
	private $myAdresse1User;
	private $myAdresse2User;
	private $myCodePostalUser;
	private $myVilleUser;
	private $myUserConnected;
	private $myUserGroups;
	private $myLoginUser;
	private $myLoginCli;
	private $myLoginRgpd;
	private $myPasswordRgpd;
	private $myPwdUser;
	private $myPwdUserStatut;
	
	public function __construct() {
		$this->mySiteID = 0;
		$this->mySiteName = '';
		
		$this->myUserID = 0;
		$this->myUserFullname = 'Visiteur';
		$this->myNomUser = '';
		$this->myPrenomUser = '';
		$this->myCiviliteUser = '';
		$this->myMailUser = '';
		$this->myRaisonSocialUser = '';
		$this->myAdresse1User = '';
		$this->myAdresse2User = '';
		$this->myCodePostalUser = '';
		$this->myVilleUser = '';
		$this->myUserConnected = false;
		$this->myUserGroups = array ();
		$this->myLoginUser = '';
		$this->myLoginCli = '';
		$this->myLoginRgpd = '';
		$this->myPasswordRgpd = '';
		$this->myPwdUser = '';
		$this->myPwdUserStatut = 0;
	}
	public function initSession() {
		$_SESSION [$this->mySiteName] ['SITE'] ['ID'] = $this->mySiteID;
		$_SESSION [$this->mySiteName] ['SITE'] ['NAME'] = $this->mySiteName;
		$_SESSION [$this->mySiteName] ['USER'] ['ID'] = $this->myUserID;
		$_SESSION [$this->mySiteName] ['USER'] ['FULLNAME'] = $this->myUserFullname;
		$_SESSION [$this->mySiteName] ['USER'] ['CONNECTED'] = $this->myUserConnected;
		$_SESSION [$this->mySiteName] ['USER'] ['GROUPS'] = $this->myUserGroups;
	}
	
	// ###
	public function getSiteID() {
		return $this->mySiteID;
	}
	public function getSiteName() {
		return $this->mySiteName;
	}
	public function getUserID() {
		return $this->myUserID;
	}
	public function getNomUser() {
		return $this->myNomUser;
	}
	public function getPrenomUser() {
		return $this->myPrenomUser;
	}
	public function getCiviliteUser() {
		switch ($this->myCiviliteUser) {
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
	public function getCherUser() {
		switch ($this->myCiviliteUser) {
			case 0 :
				return ' ';
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
				return ' ';
		}
	}
	public function getMailUser() {
		return $this->myMailUser;
	}
	public function getRaisonSocialUser() {
		return $this->myRaisonSocialUser;
	}
	public function getAdresse1User() {
		return $this->myAdresse1User;
	}
	public function getAdresse2User() {
		return $this->myAdresse2User;
	}
	public function getCodePostalUser() {
		return $this->myCodePostalUser;
	}
	public function getVilleUser() {
		return $this->myVilleUser;
	}
	public function getUserFullname() {
		return $this->myUserFullname;
	}
	public function getConnected() {
		return $this->myUserConnected;
	}
	public function getUserGroups() {
		return $this->myUserGroups;
	}
	public function getLoginUser() {
		return $this->myLoginUser;
	}
	public function getLoginCli() {
		return $this->myLoginCli;
	}
	public function getLoginRgpd() {
		return $this->myLoginRgpd;
	}
	public function getPasswordRgpd() {
		return $this->myPasswordRgpd;
	}
	public function getPwdUser() {
		return $this->myPwdUser;
	}
	public function getPwdUserStatut() {
		return $this->myPwdUserStatut;
	}
	public function setSiteID($newValue) {
		$this->mySiteID = $newValue;
	}
	public function setSiteName($newValue) {
		$this->mySiteName = $newValue;
	}
	public function setUserID($newValue) {
		$this->myUserID = $newValue;
	}
	public function setNomUser($newValue) {
		$this->myNomUser = $newValue;
	}
	public function setPrenomUser($newValue) {
		$this->myPrenomUser = $newValue;
	}
	public function setCiviliteUser($newValue) {
		$this->myCiviliteUser = $newValue;
	}
	public function setRaisonSocialUser($newValue) {
		$this->myRaisonSocialUser = $newValue;
	}
	public function setAdresse1User($newValue) {
		$this->myAdresse1User = $newValue;
	}
	public function setAdresse2User($newValue) {
		$this->myAdresse2User = $newValue;
	}
	public function setCodePostalUser($newValue) {
		$this->myCodePostalUser = $newValue;
	}
	public function setVilleUser($newValue) {
		$this->myVilleUser = $newValue;
	}
	public function setMailUser($newValue) {
		$this->myMailUser = $newValue;
	}
	public function setUserFullname($newValue) {
		$this->myUserFullname = $newValue;
	}
	public function setUserConnected($newValue) {
		$this->myUserConnected = $newValue;
	}
	public function setUserGroups($newValue) {
		$this->myUserGroups = $newValue;
	}
	public function setLoginUser($newValue) {
		$this->myLoginUser = $newValue;
	}
	public function setLoginCli($newValue) {
		$this->myLoginCli = $newValue;
	}
	public function setLoginRgpd($newValue) {
		$this->myLoginRgpd = $newValue;
	}
	public function setPasswordRgpd($newValue) {
		$this->myPasswordRgpd = $newValue;
	}
	public function setPwdUser($newValue) {
		$this->myPwdUser = $newValue;
	}
	public function setPwdUserStatut($newValue) {
		$this->myPwdUserStatut = $newValue;
	}
	public function SQL_checkUser($aUserName, $aPassword) {
		// Vérification si l'utilisateur existe
		$sql = "SELECT i.IndividuID FROM annuaire_individu i WHERE UPPER(Login)=UPPER('%s') AND UPPER(Password)=UPPER('%s') and AnnuaireID = 1";
		
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'] , $aUserName ), mysqli_real_escape_string ($_SESSION['LINK'] , $aPassword ) );
		
		$result = mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
		// L'utilisateur existe
		if (mysqli_num_rows ( $result ) > 0) {
			$line = mysqli_fetch_array ( $result );
			mysqli_free_result ( $result );
			$this->setUserID ( $line [0] );
			return '0';
		} else {
			// utilisateur inconnu
			return '1';
		}
	}
	public function SQL_checkMailUser($aMailUser) {
		// Vérification si l'utilisateur existe
		$sql = "SELECT  i.individuID FROM annuaire_individu i WHERE Mail = '%s' and AnnuaireID = 1 limit 1";
		
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'] , $aMailUser ) );
		
		$result = mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
		
		// L'utilisateur existe
		if (mysqli_num_rows ( $result ) > 0) {
			$line = mysqli_fetch_array ( $result );
			mysqli_free_result ( $result );
			$this->setUserID ( $line [0] );
			return $line [0];
		} else {
			// utilisateur inconnu
			return '0';
		}
	}
	public function SQL_recupInfosUser($aUserID) {
		// Vérification si l'utilisateur existe
		$sql = "SELECT i.Nom, i.Prenom, i.Civilite, i.mail, i.Login, i.Password FROM annuaire_individu i WHERE IndividuID = '%s'";
		
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'] , $aUserID ) );
		
		$result = mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
		// L'utilisateur existe
		if (mysqli_num_rows ( $result ) > 0) {
			$line = mysqli_fetch_array ( $result );
			mysqli_free_result ( $result );
			$this->setNomUser ( $line [0] );
			$this->setPrenomUser ( $line [1] );
			$this->setCiviliteUser ( $line [2] );
			$this->setMailUser ( $line [3] );
			$this->setLoginUser ( $line [4] );
			$this->setPwdUser ( $line [5] );
			return '0';
		} else {
			// utilisateur inconnu
			return '1';
		}
	}
	public function SQL_recupRoleUser($aUserID) {
		$this->myList = array ();
		
		$sql = "SELECT e.RaisonSociale, e.Adresse1, e.Adresse2, e.CodePostal, e.Ville, e.LoginSage";
		$sql .= " FROM `annuaire_role` r, annuaire_etablissement e,  annuaire_individu i";
		$sql .= " WHERE r.EtablissementID= e.EtablissementID";
		$sql .= " AND  r.IndividuID = i.individuID";
		$sql .= " AND  r.EtablissementID = i.lieuTravailID";
		$sql .= " AND r.IndividuID='%s'";
		
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'] , $aUserID ) );
		
		$result = mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
		
		if (mysqli_num_rows ( $result ) > 0) {
			$line = mysqli_fetch_array ( $result );
			mysqli_free_result ( $result );
			$this->setRaisonSocialUser ( $line [0] );
			$this->setAdresse1User ( $line [1] );
			$this->setAdresse2User ( $line [2] );
			$this->setCodePostalUser ( $line [3] );
			$this->setVilleUser ( $line [4] );
			$this->setLoginCli ( $line [5] );
			return '0';
		} else {
			// utilisateur inconnu
			return '1';
		}
	}
	
	// ###
	public function SQL_checkUserInfo($aUserName, $aPassword) {
		// Vérification si l'utilisateur existe
		$sql = "SELECT i.IndividuID, i.Nom, i.Prenom, i.EnSommeil, i.PasswordRgpdStatut, i.Mail, i.LoginRgpd, i.PasswordRgpd, i.Login FROM annuaire_individu i, annuaire_lca_groupeindividu g WHERE i.IndividuID=g.IndividuID AND i.AnnuaireID='%s' AND g.GroupeID='%s' 
				AND 
				((UPPER(Login)=UPPER('%s') AND UPPER(Password)=UPPER('%s')) || 
				(UPPER(LoginRgpd)=UPPER('%s') AND UPPER(PasswordRgpd)=UPPER('%s') ))";
		
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'] , $_SESSION ['SITE'] ['ID'] != '7' ? $_SESSION ['SITE'] ['ID'] : '2' ), 
				mysqli_real_escape_string ($_SESSION['LINK'] , $_SESSION ['SITE'] ['LCA_GROUP_ID'] ), 
				mysqli_real_escape_string ($_SESSION['LINK'] , $aUserName ), 
				mysqli_real_escape_string ($_SESSION['LINK'] , $aPassword ), 
				mysqli_real_escape_string ($_SESSION['LINK'] , $aUserName ),
				mysqli_real_escape_string ($_SESSION['LINK'] , substr($aPassword, 0,2).hash('sha256',$aPassword).$aPassword[strlen($aPassword)-1]) );

		$result = mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
		// L'utilisateur existe
		if (mysqli_num_rows ( $result ) > 0) {
			$line = mysqli_fetch_array ( $result );
			mysqli_free_result ( $result );
			
			if ($line [3] == '1') {
				// Compte en sommeil
				$this->__construct ();
				$this->initSession ();
				return '2';
			} else {
				// Vérification si TOUTES les concession ne sont pas en sommeil
				$sql2 = "select count(e.EtablissementID), sum(e.EnSommeil) FROM annuaire_role r, annuaire_etablissement e WHERE IndividuID = '%s' AND IndividuID = r.IndividuID AND r.EtablissementID = e.EtablissementID ";
				$query2 = sprintf ( $sql2, mysqli_real_escape_string ($_SESSION['LINK'] , $line [0] ) );
				$result2 = mysqli_query ( $_SESSION['LINK'] ,$query2 ) or die ( mysqli_error ($_SESSION['LINK']) );
				$line2 = mysqli_fetch_array ( $result2 );
				mysqli_free_result ( $result2 );

				// Vérification si l'utilisateur appartient au groupe "Utilisateurs sans Concession"
				$sql3 = "SELECT GroupeID FROM annuaire_lca_groupeindividu WHERE IndividuID='%s' AND GroupeID='14'";
				$query3 = sprintf ( $sql3, mysqli_real_escape_string ($_SESSION['LINK'] , $line [0] ) );
				$result3 = mysqli_query ( $_SESSION['LINK'] ,$query3 ) or die ( mysqli_error ($_SESSION['LINK']) );
				
				if (($line2 [0] > 0 && $line2 [1] == 0) || mysqli_num_rows ( $result3 ) > 0) {
					mysqli_free_result ( $result3 );
					
					$this->setUserID ( $line [0] );
					$this->setUserFullname ( $line [2] . ' ' . $line [1] );
					$this->setUserConnected ( true );
					$this->setPwdUserStatut($line [4]);
					$this->setMailUser($line [5]);
					$this->setLoginRgpd($line [6]);
					$this->setPasswordRgpd($line [7]);
					$this->setLoginUser($line [8]);
					
					// Chargement des Groupes LCA USER
					$aTab = array ();
					$this->setUserGroups ( $aTab );
					
					$sql4 = "SELECT GroupeID FROM annuaire_lca_groupeindividu WHERE IndividuID='%s'";
					$query4 = sprintf ( $sql4, mysqli_real_escape_string ($_SESSION['LINK'] , $line [0] ) );
					$result4 = mysqli_query ( $_SESSION['LINK'] ,$query4 ) or die ( mysqli_error ($_SESSION['LINK']) );
					$aTab [] = '0';
					while ( $line4 = mysqli_fetch_array ( $result4 ) ) {
						$aTab [] = $line4 [0];
					}
					mysqli_free_result ( $result4 );
					
					$this->setUserGroups ( $aTab );
					
					$this->initSession ();
					return '0';
				} else {
					// Compte en sommeil ou sans rôle
					$this->__construct ();
					$this->initSession ();
					return '2';
				}
			}
		} else {
			// utilisateur inconnu
			$this->__construct ();
			$this->initSession ();
			return '1';
		}
	}
	public function SQL_checkUserBe($aUserId) {
		$sql = "SELECT * FROM annuaire_lca_groupeindividu WHERE IndividuID='%s' AND GroupeID='6'";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'] , $aUserId ) );
		$result = mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
		if (mysqli_num_rows ( $result ) > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
}
?>