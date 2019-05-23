<?php
/**
 * @author Florent DESPIERRES
 * @package portail-gcr
 * @subpackage annuaire
 * @version 1.0.4
 */
class Individu {
	private $ID;
	private $Nom;
	private $Prenom;
	private $Telephone;
	private $Fax;
	private $Email;
	private $nbLoginRgpd;
	private $RaisonSociale;
	private $Adresse1;
	private $Adresse2;
	private $CodePostal;
	private $Ville;
	private $Login;
	private $LoginRgpd;
	private $Password;
	private $PasswordRgpd;
	private $PasswordRgpdStatut;
	private $LoginSage;
	public function __construct() {
		// Info Generales
		$this->ID = NULL;
		$this->Nom = '';
		$this->Prenom = '';
		$this->Telephone = '';
		$this->Fax = '';
		$this->Email = '';
		$this->nbLoginRgpd = 0;
		
		// Lieu de travail
		$this->RaisonSociale = '';
		$this->Adresse1 = '';
		$this->Adresse2 = '';
		$this->CodePostal = '';
		$this->Ville = '';
		
		// Info Sage
		$this->Login = '';
		$this->LoginRgpd = '';
		$this->Password = '';
		$this->PasswordRgpd = '';
		$this->PasswordRgpdStatut = 0;
		$this->LoginSage = '';
	}
	
	// ###
	public function getID() {
		return $this->ID;
	}
	public function getNom() {
		return $this->Nom;
	}
	public function getPrenom() {
		return $this->Prenom;
	}
	public function getTelephone() {
		return $this->Telephone;
	}
	public function getFax() {
		return $this->Fax;
	}
	public function getEmail() {
		return $this->Email;
	}
	public function getnbLoginRgpd() {
		return $this->nbLoginRgpd;
	}
	public function getRaisonSociale() {
		return $this->RaisonSociale;
	}
	public function getAdresse1() {
		return $this->Adresse1;
	}
	public function getAdresse2() {
		return $this->Adresse2;
	}
	public function getCodePostal() {
		return $this->CodePostal;
	}
	public function getVille() {
		return $this->Ville;
	}
	public function getLogin() {
		return $this->Login;
	}
	public function getLoginRgpd() {
		return $this->LoginRgpd;
	}
	public function getPassword() {
		return $this->Password;
	}
	public function getPasswordRgpd() {
		return $this->PasswordRgpd;
	}
	public function getPasswordRgpdStatut() {
		return $this->PasswordRgpdStatut;
	}
	public function getLoginSage() {
		return $this->LoginSage;
	}
	
	// ###
	public function setID($newValue) {
		$this->ID = $newValue;
	}
	public function setNom($newValue) {
		$this->Nom = $newValue;
	}
	public function setPrenom($newValue) {
		$this->Prenom = $newValue;
	}
	public function setTelephone($newValue) {
		$this->Telephone = $newValue;
	}
	public function setFax($newValue) {
		$this->Fax = $newValue;
	}
	public function setEmail($newValue) {
		$this->Email = $newValue;
	}
	public function setnbLoginRgpd($newValue) {
		$this->nbLoginRgpd = $newValue;
	}
	public function setRaisonSociale($newValue) {
		$this->RaisonSociale = $newValue;
	}
	public function setAdresse1($newValue) {
		$this->Adresse1 = $newValue;
	}
	public function setAdresse2($newValue) {
		$this->Adresse2 = $newValue;
	}
	public function setCodePostal($newValue) {
		$this->CodePostal = $newValue;
	}
	public function setVille($newValue) {
		$this->Ville = $newValue;
	}
	public function setLogin($newValue) {
		$this->Login = $newValue;
	}
	public function setLoginRgpd($newValue) {
		$this->LoginRgpd = $newValue;
	}
	public function setPassword($newValue) {
		$this->Password = $newValue;
	}
	public function setPasswordRgpd($newValue) {
		$this->PasswordRgpd = $newValue;
	}
	public function setPasswordRgpdStatut($newValue) {
		$this->PasswordRgpdStatut = $newValue;
	}
	public function setLoginSage($newValue) {
		$this->LoginSage = $newValue;
	}
	
	// ###
	public function SQL_SEARCH_COUNT($Nom, $DomaineActiviteID) {
		$sql = "SELECT DISTINCT(i.IndividuID), i.Nom, i.Prenom, i.Telephone, i.Fax, i.Mail, e.RaisonSociale, e.Adresse1, e.Adresse2, e.CodePostal, e.ville";
		$sql .= " FROM `annuaire_role` r, annuaire_individu i, annuaire_etablissement e, annuaire_role_domainactivite d";
		$sql .= " WHERE r.IndividuID=i.IndividuID AND r.EtablissementID=e.EtablissementID AND r.AnnuaireID='%s' AND r.RoleID=d.RoleID AND i.EnSommeil='0' AND e.EnSommeil='0'";
		
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'] , $_SESSION ['SITE'] ['ID'] ) );
		// Restriction sur le nom
		if (! empty ( $Nom )) {
			$query = $query . sprintf ( " AND i.Nom LIKE '%s' ", '%' . mysqli_real_escape_string ($_SESSION['LINK'] , trim ( $Nom ) . '%' ) );
		}
		// Restriction sur le Domaine d'activite
		if ($DomaineActiviteID != '0') {
			$query = $query . sprintf ( " AND d.DomainActiviteID='%s'", mysqli_real_escape_string ($_SESSION['LINK'] , $DomaineActiviteID ) );
		}
		$result = mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
		
		return mysqli_num_rows ( $result );
	}
	public function SQL_SEARCH($Nom, $DomaineActiviteID, $NumPage, $NumEntry) {
		$aList = array ();
		
		$sql = "SELECT DISTINCT(i.IndividuID), i.Nom, i.Prenom, i.Telephone, i.Fax, i.Mail, e.RaisonSociale, e.Adresse1, e.Adresse2, e.CodePostal, e.ville";
		$sql .= " FROM `annuaire_role` r, annuaire_individu i, annuaire_etablissement e, annuaire_role_domainactivite d";
		$sql .= " WHERE r.IndividuID=i.IndividuID AND r.EtablissementID=e.EtablissementID AND r.AnnuaireID='%s' AND r.RoleID=d.RoleID AND i.EnSommeil='0' AND e.EnSommeil='0'";
		
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'] , $_SESSION ['SITE'] ['ID'] ) );
		// Restriction sur le nom
		if (! empty ( $Nom )) {
			$query = $query . sprintf ( " AND i.Nom LIKE '%s' ", '%' . mysqli_real_escape_string ($_SESSION['LINK'] , trim ( $Nom ) . '%' ) );
		}
		// Restriction sur le Domaine d'activite
		if ($DomaineActiviteID != '0') {
			$query = $query . sprintf ( " AND d.DomainActiviteID='%s'", mysqli_real_escape_string ($_SESSION['LINK'] , $DomaineActiviteID ) );
		}
		
		$query = $query . sprintf ( " ORDER BY i.Nom LIMIT %d, %d", ($NumPage - 1) * $NumEntry, $NumEntry );
		$result = mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
		while ( $line = mysqli_fetch_array ( $result ) ) {
			$aModele = new Individu ();
			$aModele->setID ( $line [0] );
			$aModele->setNom ( $line [1] );
			$aModele->setPrenom ( $line [2] );
			$aModele->setTelephone ( $line [3] );
			$aModele->setFax ( $line [4] );
			$aModele->setEmail ( $line [5] );
			
			$aModele->setRaisonSociale ( $line [6] );
			$aModele->setAdresse1 ( $line [7] );
			$aModele->setAdresse2 ( $line [8] );
			$aModele->setCodePostal ( $line [9] );
			$aModele->setVille ( $line [10] );
			$aList [] = $aModele;
		}
		mysqli_free_result ( $result );
		
		return $aList;
	}
	public function SQL_SELECT($IndividuID) {
		$query = sprintf ( "SELECT i.IndividuID, i.Nom, i.Prenom, i.Telephone, i.TelephonePortable, i.Fax, i.Mail, i.LoginSage, i.Login, i.Password, i.LoginRgpd, i.PasswordRgpd FROM annuaire_individu i, annuaire_role r WHERE r.IndividuID = i.IndividuID AND i.IndividuID='%s' AND i.AnnuaireID='%s' AND i.EnSommeil='0' LIMIT 1", mysqli_real_escape_string ($_SESSION['LINK'] , $IndividuID ), mysqli_real_escape_string ($_SESSION['LINK'] , $_SESSION ['SITE'] ['ID'] ) );
		
		$result = mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
		
		if (mysqli_num_rows ( $result ) > 0) {
			$line = mysqli_fetch_array ( $result );
			$this->ID = $line [0];
			$this->Nom = $line [1];
			$this->Prenom = $line [2];
			$this->Telephone = $line [3];
			$this->TelephonePortable = $line [4];
			$this->Fax = $line [5];
			$this->Email = $line [6];
			$this->LoginSage = $line [7];
			$this->Login = $line [8];
			$this->Password = $line [9];
			$this->LoginRgpd = $line [10];
			$this->PasswordRgpd = $line [11];
			
			$query2 = sprintf ( "SELECT e.RaisonSociale, e.Adresse1, e.Adresse2, e.CodePostal, e.Ville FROM annuaire_individu i, annuaire_etablissement e WHERE i.LieuTravailID = e.EtablissementID AND i.IndividuID='%s' AND i.AnnuaireID='%s' LIMIT 1", mysqli_real_escape_string ($_SESSION['LINK'] , $this->ID ), mysqli_real_escape_string ($_SESSION['LINK'] , $_SESSION ['SITE'] ['ID'] ) );
			
			$result2 = mysqli_query ( $_SESSION['LINK'] ,$query2 ) or die ( mysqli_error ($_SESSION['LINK']) );
			if (mysqli_num_rows ( $result2 ) > 0) {
				$line2 = mysqli_fetch_array ( $result2 );
				$this->RaisonSociale = $line2 [0];
				$this->Adresse1 = $line2 [1];
				$this->Adresse2 = $line2 [2];
				$this->CodePostal = $line2 [3];
				$this->Ville = $line2 [4];
			}
		} else {
			$this->__construct ();
		}
		
		mysqli_free_result ( $result );
	}
	public function SQL_SELECT_ALL_DomaineActvitie($IndividuID) {
		$aList = array ();
		
		$sql = "SELECT e.RaisonSociale, e.ville, da.Libelle, e.EtablissementID, fda.Libelle
				FROM annuaire_role_domainactivite rda, annuaire_role r, annuaire_lva_domainactivite da, annuaire_lva_domainactivite_fonction fda, annuaire_etablissement e
				WHERE rda.RoleID = r.RoleID
				AND rda.DomainActiviteID = da.DomainActiviteID
				AND rda.FonctionDAID = fda.FonctionDAID
				AND r.EtablissementID = e.EtablissementID
				AND e.AnnuaireID='%s' AND r.IndividuID ='%s'";
		
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'] , $_SESSION ['SITE'] ['ID'] ), mysqli_real_escape_string ($_SESSION['LINK'] , $IndividuID ) );
		
		$result = mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
		while ( $line = mysqli_fetch_array ( $result ) ) {
			$aList [] = $line;
		}
		return $aList;
	}
	public function SQL_SELECT_BureauNationnal() {
		$aList = array ();
		
		$query = sprintf ( "SELECT ibn.IndividuID, i.Nom, i.Prenom, i.Mail, i.Telephone, bn.Libelle FROM annuaire_individufonctionbn ibn, annuaire_individu i, annuaire_lva_fonctionbn bn WHERE ibn.IndividuID = i.IndividuID AND bn.FonctionBNID = ibn.FonctionBNID AND i.AnnuaireID='%s' ORDER BY bn.NumeroOrdre ASC", mysqli_real_escape_string ($_SESSION['LINK'] , $_SESSION ['SITE'] ['ID'] ) );
		
		$result = mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
		while ( $line = mysqli_fetch_array ( $result ) ) {
			$aList [] = $line;
		}
		return $aList;
	}
	public function SQL_SELECT_CommissionList() {
		$aList = array ();
		
		$query = sprintf ( "SELECT CommissionID,Libelle FROM `annuaire_lva_commission` WHERE annuaireid='%s'", mysqli_real_escape_string ($_SESSION['LINK'] , $_SESSION ['SITE'] ['ID'] ) );
		
		$result = mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
		while ( $line = mysqli_fetch_array ( $result ) ) {
			$aList [] = $line;
		}
		return $aList;
	}
	public function SQL_SELECT_CommissionContactList($id) {
		$aList = array ();
		
		$query = sprintf ( "SELECT i.IndividuID, i.Nom, i.Prenom, i.Telephone, i.Mail, fc.Libelle FROM annuaire_individu i, annuaire_individucommission ic, annuaire_lva_fonctioncommission fc WHERE i.IndividuID = ic.IndividuID AND fc.FonctionCommissionID = ic.FonctionCommissionID AND i.AnnuaireID='%s' AND ic.CommissionID='%s'", mysqli_real_escape_string ($_SESSION['LINK'] , $_SESSION ['SITE'] ['ID'] ), mysqli_real_escape_string ($_SESSION['LINK'] , $id ) );
		
		$result = mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
		while ( $line = mysqli_fetch_array ( $result ) ) {
			$aList [] = $line;
		}
		return $aList;
	}
	public function SQL_SELECT_DelegationContactList($id) {
		$aList = array ();
		
		$query = sprintf ( "SELECT i.IndividuID, i.Nom, i.Prenom, i.Telephone, i.Mail, fd.Libelle FROM annuaire_delegationregionale dr, annuaire_individu i, annuaire_lva_fonctiondelegation fd WHERE dr.FonctiondelegationID = fd.FonctiondelegationID AND i.IndividuID = dr.IndividuID AND i.AnnuaireID='%s' AND dr.RegionID='%s'", mysqli_real_escape_string ($_SESSION['LINK'] , $_SESSION ['SITE'] ['ID'] ), mysqli_real_escape_string ($_SESSION['LINK'] , $id ) );
		
		$result = mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
		while ( $line = mysqli_fetch_array ( $result ) ) {
			$aList [] = $line;
		}
		return $aList;
	}
	public function SQL_SELECT_DelegationFonction() {
		$aList = array ();
		
		$query = sprintf ( "SELECT i.IndividuID, i.Nom, i.Prenom, i.Telephone, i.Mail, fd.Libelle FROM annuaire_delegationregionale dr, annuaire_individu i, annuaire_lva_fonctiondelegation fd WHERE dr.FonctiondelegationID = fd.FonctiondelegationID AND i.IndividuID = dr.IndividuID AND i.AnnuaireID='%s' AND (dr.FonctionDelegationID=19 OR dr.FonctionDelegationID=20)", mysqli_real_escape_string ($_SESSION['LINK'] , $_SESSION ['SITE'] ['ID'] ) );
		
		$result = mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
		while ( $line = mysqli_fetch_array ( $result ) ) {
			$aList [] = $line;
		}
		return $aList;
	}
	
	// ###
	public function SQL_BureauNational($aID) {
		$aList = array ();
		$query = sprintf ( "SELECT DISTINCT(f.Libelle) FROM `annuaire_individufonctionbn` bn, annuaire_lva_fonctionbn f where bn.FonctionBNID=f.FonctionBNID AND bn.IndividuID='%s' ORDER BY NumeroOrdre ASC", mysqli_real_escape_string ($_SESSION['LINK'] , $aID ) );
		
		$result = mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
		while ( $line = mysqli_fetch_array ( $result ) ) {
			$aList [] = $line;
		}
		return $aList;
	}
	public function SQL_DelegationRegionale($aID) {
		$query = sprintf ( "SELECT r.RegionID, r.Libelle, f.FonctionDelegationID, f.Libelle FROM `annuaire_delegationregionale` dr, annuaire_lva_fonctiondelegation f, annuaire_lva_region r WHERE dr.RegionID = r.RegionID AND dr.FonctionDelegationID=f.FonctionDelegationID AND dr.IndividuID='%s'", mysqli_real_escape_string ($_SESSION['LINK'] , $aID ) );
		
		$result = mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
		
		return mysqli_fetch_array ( $result );
	}
	public function SQL_CommissionsNationales($aID) {
		$aList = array ();
		
		$query = sprintf ( "SELECT c.CommissionID, c.Libelle, f.FonctionCommissionID, f.Libelle FROM `annuaire_individucommission` ic, annuaire_lva_fonctioncommission f, annuaire_lva_commission c WHERE ic.CommissionID = c.CommissionID AND ic.FonctionCommissionID=f.FonctionCommissionID AND ic.IndividuID='%s'", mysqli_real_escape_string ($_SESSION['LINK'] , $aID ) );
		
		$result = mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
		while ( $line = mysqli_fetch_array ( $result ) ) {
			$aList [] = $line;
		}
		return $aList;
	}
	public function SQL_SELECT_Individu_MotDePassePerdu($email) {
		$query = sprintf ( "SELECT IndividuID, Nom, Prenom, Mail, Login, Password FROM annuaire_individu WHERE AnnuaireID='%s' AND UPPER(Mail)=UPPER('%s') LIMIT 1", mysqli_real_escape_string ($_SESSION['LINK'] , $_SESSION ['SITE'] ['ID'] ), mysqli_real_escape_string ($_SESSION['LINK'] , $email ) );
		
		$result = mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
		
		if (mysqli_num_rows ( $result ) > 0) {
			$line = mysqli_fetch_array ( $result );
			$this->ID = $line [0];
			$this->Nom = $line [1];
			$this->Prenom = $line [2];
			$this->Email = $line [3];
			$this->Login = $line [4];
			$this->Password = $line [5];
		} else {
			$this->__construct ();
		}
		
		mysqli_free_result ( $result );
	}

	public function SQL_SELECT_Valid_MailRgpd() {
		$query = sprintf ( "SELECT count(LoginRgpd) FROM annuaire_individu WHERE UPPER(LoginRgpd)=UPPER('%s') ",
				 mysqli_real_escape_string ($_SESSION['LINK'] , $this->getLoginRgpd() ) );
		
		$result = mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
		
		if (mysqli_num_rows ( $result ) > 0)
		{
			$line = mysqli_fetch_array ( $result );
			$this->nbLoginRgpd = $line [0];
		} else {
			$this->__construct ();
		}
		
		mysqli_free_result ( $result );
	}
	
	public function SQL_SELECT_Individu_LoginRgpd() {
		$query = sprintf ( "SELECT count(LoginRgpd) FROM annuaire_individu WHERE Login<>'%s' AND UPPER(LoginRgpd)=UPPER('%s') ", 
		mysqli_real_escape_string ($_SESSION['LINK'] , $this->Login ) , mysqli_real_escape_string ($_SESSION['LINK'] , $this->getLoginRgpd() ) );

		$result = mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
		
		if (mysqli_num_rows ( $result ) > 0) 
		{
			$line = mysqli_fetch_array ( $result );
			$this->nbLoginRgpd = $line [0];
		} else {
			$this->__construct ();
		}
		
		mysqli_free_result ( $result );
	}

	public function SQL_SELECT_Individu_LoginLost() {
		// le mail doit être renseigné dans CISCAR et pas plus d'une fois
		$query = sprintf ( "select count(*) from annuaire_individu WHERE AnnuaireID = 1 AND UPPER(LoginRgpd) = UPPER('%s')  ",
				mysqli_real_escape_string ($_SESSION['LINK'] , $this->getLoginRgpd() ) );

		$result = mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );

		if (mysqli_num_rows ( $result ) > 0)
		{
			$line = mysqli_fetch_array ( $result );
			$this->nbLoginRgpd = $line [0];
		} 
		else 
		{
			$this->nbLoginRgpd = 0;
		}
		mysqli_free_result ( $result );
		
		//si le mail existe une seule fois dans CISCAR, on vérifie qu'il n'existe pas plus d'une fois dans GCR		
		if($this->nbLoginRgpd == 1)
		{
			$query = sprintf ( "select count(*) from annuaire_individu WHERE AnnuaireID = 2 AND UPPER(LoginRgpd) = UPPER('%s')  ",
					mysqli_real_escape_string ($_SESSION['LINK'] , $this->getLoginRgpd() ) );
			
			$result = mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
			
			if (mysqli_num_rows ( $result ) > 0)
			{
				$line = mysqli_fetch_array ( $result );
				$this->nbLoginRgpd += $line [0];
			} else {
				$this->nbLoginRgpd += 0;
			}	
			mysqli_free_result ( $result );
		}
		else 
		{
			//pour ne pas tenir comptes des individus comptés plus d'un fois dans CISCAR
			if($this->nbLoginRgpd > 1)
			   $this->nbLoginRgpd = 3;
		}

	}
	
	public function SQL_UPDATE_individu_Rgpd() {
		$sql = "UPDATE annuaire_individu SET LoginRgpd='%s', PasswordRgpd='%s', PasswordRgpdStatut=2 ";
		$sql .= " WHERE Login='%s'";
		
		$query = sprintf ( $sql, 
				mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->LoginRgpd ) ), 
				mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( substr($this->PasswordRgpd, 0,2).hash('sha256',$this->PasswordRgpd).$this->PasswordRgpd[strlen($this->PasswordRgpd)-1]) ),
				mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->Login ) )); 

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
		
		$this->PasswordRgpdStatut = 2;		
	}
	public function SQL_UPDATE_individu_Lost($status) {
		$sql = "UPDATE annuaire_individu SET LoginRgpd='%s', PasswordRgpd='%s', PasswordRgpdStatut=".$status ;
		$sql .= " WHERE UPPER(LoginRgpd) = UPPER('%s') ";
		
		$query = sprintf ( $sql,
				mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->LoginRgpd ) ),
				mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( substr($this->PasswordRgpd, 0,2).hash('sha256',$this->PasswordRgpd).$this->PasswordRgpd[strlen($this->PasswordRgpd)-1]) ),
				mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->LoginRgpd ) ));

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
		
		$this->PasswordRgpdStatut = $status;
	}
	public function SQL_UPDATE_individu_Confirm() {
		$sql = "UPDATE annuaire_individu SET PasswordRgpdStatut=2 ";
		$sql .= " WHERE (UPPER(mail) = UPPER('%s') or UPPER(LoginRgpd) = UPPER('%s') )";
		
		$query = sprintf ( $sql,
				mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->LoginRgpd ) ),
				mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->LoginRgpd ) ));
		
		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
		
		$this->PasswordRgpdStatut = 2;
	}
	
}
?>
