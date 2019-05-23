<?php
/**
 * @author Philippe GERMAIN
 * @package portail-ciscar
 * @subpackage deals
 * @version 1.0.4
 */
class Deals {
	private $DealsID;
	private $DealsMaxID;
	private $DealCmdID;
	private $Titre;
	private $Description;
	private $Url;
	private $UrlImage;
	private $DateDebut;
	private $DateFin;
	private $PrixPromo;
	private $QuantiteMin;
	private $QuantiteCmd;
	private $QuantiteCmdIndividu;
	private $DealsAtteint;
	private $RaisonSociale_fac;
	private $Adresse1_fac;
	private $Adresse2_fac;
	private $CodePostal_fac;
	private $Ville_fac;
	private $RaisonSociale_liv;
	private $Destinataire_liv;
	private $Adresse1_liv;
	private $Adresse2_liv;
	private $CodePostal_liv;
	private $Ville_liv;
	private $IndividuID;
	private $Nom;
	private $Prenom;
	private $Tel;
	private $Mail;
	private $Remarque;
	public function __construct() {
		$this->DealsID = NULL;
		$this->DealsMaxID = NULL;
		$this->DealCmdID = NULL;
		$this->Titre = '';
		$this->Description = '';
		$this->Url = '';
		$this->UrlImage = '';
		$this->DateDebut = NULL;
		$this->DateFin = NULL;
		$this->PrixPromo = 0;
		$this->QuantiteMin = 0;
		$this->QuantiteCmd = 0;
		$this->QuantiteCmdIndividu = 0;
		$this->RaisonSociale_fac = '';
		$this->Adresse1_fac = '';
		$this->Adresse2_fac = '';
		$this->CodePostal_fac = '';
		$this->Ville_fac = '';
		$this->RaisonSociale_liv = '';
		$this->Destinataire_liv = '';
		$this->Adresse1_liv = '';
		$this->Adresse2_liv = '';
		$this->CodePostal_liv = '';
		$this->Ville_liv = '';
		$this->IndividuID = NULL;
		$this->Nom = '';
		$this->Prenom = '';
		$this->Tel = '';
		$this->Mail = '';
		$this->Remarque = '';
	}
	
	// ###
	public function getDealCmdID() {
		return $this->DealCmdID;
	}
	public function getDealsID() {
		return $this->DealsID;
	}
	public function getDealsMaxID() {
		return $this->DealsMaxID;
	}
	public function getTitre() {
		return $this->Titre;
	}
	public function getDescription() {
		return $this->Description;
	}
	public function getURL() {
		return $this->Url;
	}
	public function getURLImage() {
		return $this->UrlImage;
	}
	public function getDateDebut() {
		return $this->DateDebut;
	}
	public function getDateFin() {
		return $this->DateFin;
	}
	public function getPrixPromo() {
		return $this->PrixPromo;
	}
	public function getQuantiteMin() {
		return $this->QuantiteMin;
	}
	public function getQuantiteCmd() {
		return $this->QuantiteCmd;
	}
	public function getQuantiteCmdIndividu() {
		return $this->QuantiteCmdIndividu;
	}
	public function getDealsAtteint() {
		return $this->DealsAtteint;
	}
	public function getRaisonSociale_fac() {
		return $this->RaisonSociale_fac;
	}
	public function getAdresse1_fac() {
		return $this->Adresse1_fac;
	}
	public function getAdresse2_fac() {
		return $this->Adresse2_fac;
	}
	public function getCodePostal_fac() {
		return $this->CodePostal_fac;
	}
	public function getVille_fac() {
		return $this->Ville_fac;
	}
	public function getRaisonSociale_liv() {
		return $this->RaisonSociale_liv;
	}
	public function getDestinataire_liv() {
		return $this->Destinataire_liv;
	}
	public function getAdresse1_liv() {
		return $this->Adresse1_liv;
	}
	public function getAdresse2_liv() {
		return $this->Adresse2_liv;
	}
	public function getCodePostal_liv() {
		return $this->CodePostal_liv;
	}
	public function getVille_liv() {
		return $this->Ville_liv;
	}
	public function getIndividuID() {
		return $this->IndividuID;
	}
	public function getNom() {
		return $this->Nom;
	}
	public function getPrenom() {
		return $this->Prenom;
	}
	public function getTel() {
		return $this->Tel;
	}
	public function getMail() {
		return $this->Mail;
	}
	public function getRemarque() {
		return $this->Remarque;
	}
	public function setDealsID($newValue) {
		$this->DealsID = $newValue;
	}
	public function setDealsMaxID($newValue) {
		$this->DealsMaxID = $newValue;
	}
	public function setDealCmdID($newValue) {
		$this->DealCmdID = $newValue;
	}
	public function setTitre($newValue) {
		$this->Titre = $newValue;
	}
	public function setDescription($newValue) {
		$this->Description = $newValue;
	}
	public function setURL($newValue) {
		$this->Url = $newValue;
	}
	public function setURLImage($newValue) {
		$this->UrlImage = $newValue;
	}
	public function setDateDebut($newValue) {
		$this->DateDebut = $newValue;
	}
	public function setDateFin($newValue) {
		$this->DateFin = $newValue;
	}
	public function setPrixPromo($newValue) {
		$this->PrixPromo = $newValue;
	}
	public function setQuantiteMin($newValue) {
		$this->QuantiteMin = $newValue;
	}
	public function setQuantiteCmd($newValue) {
		$this->QuantiteCmd = $newValue;
	}
	public function setQuantiteCmdIndividu($newValue) {
		$this->QuantiteCmdIndividu = $newValue;
	}
	public function setDealsAtteint($newValue) {
		$this->DealsAtteint = $newValue;
	}
	public function setRaisonSociale_liv($newValue) {
		$this->RaisonSociale_liv = $newValue;
	}
	public function setDestinataire_liv($newValue) {
		$this->Destinataire_liv = $newValue;
	}
	public function setAdresse1_liv($newValue) {
		$this->Adresse1_liv = $newValue;
	}
	public function setAdresse2_liv($newValue) {
		$this->Adresse2_liv = $newValue;
	}
	public function setCodePostal_liv($newValue) {
		$this->CodePostal_liv = $newValue;
	}
	public function setVille_liv($newValue) {
		$this->Ville_liv = $newValue;
	}
	public function setRaisonSociale_fac($newValue) {
		$this->RaisonSociale_fac = $newValue;
	}
	public function setAdresse1_fac($newValue) {
		$this->Adresse1_fac = $newValue;
	}
	public function setAdresse2_fac($newValue) {
		$this->Adresse2_fac = $newValue;
	}
	public function setCodePostal_fac($newValue) {
		$this->CodePostal_fac = $newValue;
	}
	public function setVille_fac($newValue) {
		$this->Ville_fac = $newValue;
	}
	public function setIndividuID($newValue) {
		$this->ID = $newValue;
	}
	public function setNom($newValue) {
		$this->Nom = $newValue;
	}
	public function setPrenom($newValue) {
		$this->Prenom = $newValue;
	}
	public function setTel($newValue) {
		$this->Tel = $newValue;
	}
	public function setMail($newValue) {
		$this->Mail = $newValue;
	}
	public function setRemarque($newValue) {
		$this->Remarque = $newValue;
	}
	
	// ###
	public function SQL_selectMaxDeal() {
		$sql = "SELECT max(DealsID) FROM wcm_deals ";
		
		$result = mysqli_query ( $_SESSION['LINK'] ,$sql ) or die ( mysqli_error ($_SESSION['LINK']) );
		
		if (mysqli_num_rows ( $result ) > 0) {
			$line = mysqli_fetch_array ( $result );
			
			$this->DealsMaxID = $line [0];
		} else {
			$this->__construct ();
		}
		
		mysqli_free_result ( $result );
	}
	public function SQL_selectDeal($DealsID) {
		$sql = "SELECT d.DealsID, Date_Debut, Date_Fin, Titre, Description, Quantite_Min, Prix_Promo, Deals_Atteint, ";
		$sql .= " Ifnull((select sum(Quantite_cmd) FROM wcm_deals_commandes c WHERE c.DealsID = d.DealsID),0) as NB_CMD ";
		$sql .= " FROM wcm_deals d WHERE d.DealsID ='%s'";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'] , $DealsID ) );
		
		$result = mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
		
		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array ( $result );
			
			$this->DealsID = $line [0];
			$this->DateDebut = $line [1];
			$this->DateFin = $line [2];
			$this->Titre = $line [3];
			$this->Description = $line [4];
			$this->QuantiteMin = $line [5];
			$this->PrixPromo = $line [6];
			$this->DealsAtteint = $line [7];
			$this->QuantiteCmd = $line [8];
		} else {
			$this->__construct ();
		}
		
		mysqli_free_result ( $result );
	}
	public function SQL_selectParamDeal($DealsID) {
		$aArray = array ();
		
		$sql = "SELECT ParamID, ParamLibelle, ParamInput ";
		$sql .= " FROM wcm_deals_param WHERE DealsID ='%s'";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'] , $DealsID ) );
		
		$result = mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
		
		while ( $line = mysqli_fetch_array ( $result ) ) {
			$aDealParam = new DealParam ();
			$aDealParam->setParamID ( ( int ) $line [0] );
			$aDealParam->setParamLibelle ( $line [1] );
			$aDealParam->setParamInput ( ( int ) $line [2] );
			$aArray [] = $aDealParam;
		}
		
		mysqli_free_result ( $result );
		
		return $aArray;
	}
	public function SQL_selectCmdParamDeal($DealsCmdID) {
		$aArray = array ();
		
		$sql = "SELECT QteCmd ";
		$sql .= " FROM wcm_deals_commandes_param WHERE DealCmdID ='%s'";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'] , $DealsCmdID ) );
		
		$result = mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
		
		while ( $line = mysqli_fetch_array ( $result ) ) {
			$aDealCmdParam = new DealParam ();
			$aDealCmdParam->setParamQteCmd ( ( int ) $line [0] );
			$aArray [] = $aDealCmdParam;
		}
		
		mysqli_free_result ( $result );
		
		return $aArray;
	}
	public function SQL_select_DealIndividuExiste($DealsID, $IndividuID, $Mail) {
		if ($IndividuID > 0) {
			$sql = "SELECT DealCmdID FROM wcm_deals_commandes c WHERE DealsID='%s' and IndividuID = '%s' ";
			
			$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'] , $DealsID ), mysqli_real_escape_string ($_SESSION['LINK'] , $IndividuID ) );
		} else {
			$sql = "SELECT DealCmdID FROM wcm_deals_commandes c WHERE DealsID='%s' and IndividuID = 0 and Mail = '%s'";
			
			$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'] , $DealsID ), mysqli_real_escape_string ($_SESSION['LINK'] , $Mail ) );
		}
		
		$result = mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
		
		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array ( $result );
			$this->DealCmdID = $line [0];
		} else {
			$this->DealCmdID = NULL;
		}
		
		mysqli_free_result ( $result );
	}
	public function SQL_select_DealCmdIDExiste($DealCmdID) {
		$sql = "SELECT DealsID, IndividuID, Quantite_Cmd, Nom, Prenom, Telephone, Mail, RaisonSociale_fac, Adresse1_fac, Adresse2_fac, CodePostal_liv, Ville_fac, RaisonSociale_liv, Dest_Liv, Adresse1_liv, Adresse2_liv, CodePostal_liv, Ville_liv, Remarque FROM wcm_deals_commandes c WHERE DealCmdID='%s' ";
		
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'] , $DealCmdID ) );
		
		$result = mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
		
		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array ( $result );
			$this->DealsID = $line [0];
			$this->IndividuID = $line [1];
			$this->QuantiteCmdIndividu = $line [2];
			$this->Nom = utf8_encode ( $line [3] );
			$this->Prenom = utf8_encode ( $line [4] );
			$this->Tel = utf8_encode ( $line [5] );
			$this->Mail = utf8_encode ( $line [6] );
			$this->RaisonSociale_fac = utf8_encode ( $line [7] );
			$this->Adresse1_fac = utf8_encode ( $line [8] );
			$this->Adresse2_fac = utf8_encode ( $line [9] );
			$this->CodePostal_fac = utf8_encode ( $line [10] );
			$this->Ville_fac = utf8_encode ( $line [11] );
			$this->RaisonSociale_liv = utf8_encode ( $line [12] );
			$this->Destinataire_liv = utf8_encode ( $line [13] );
			$this->Adresse1_liv = utf8_encode ( $line [14] );
			$this->Adresse2_liv = utf8_encode ( $line [15] );
			$this->CodePostal_liv = utf8_encode ( $line [16] );
			$this->Ville_liv = utf8_encode ( $line [17] );
			$this->Remarque = utf8_encode ( $line [18] );
		} else {
			$this->DealsID = NULL;
		}
		
		mysqli_free_result ( $result );
	}
	public function SQL_select_DealIndividu($DealsID, $IndividuID, $Mail) {
		if ($IndividuID > 0) {
			$sql = "SELECT DealCmdID, DealsID, IndividuID, Quantite_Cmd, Nom, Prenom, Telephone, Mail, RaisonSociale_fac, Adresse1_fac, Adresse2_fac, CodePostal_liv, Ville_fac, RaisonSociale_liv, Dest_Liv, Adresse1_liv, Adresse2_liv, CodePostal_liv, Ville_liv, Remarque FROM wcm_deals_commandes c WHERE DealsID='%s' and IndividuID = '%s' order by DealCmdID desc limit 1 ";
			
			$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'] , $DealsID ), mysqli_real_escape_string ($_SESSION['LINK'] , $IndividuID ) );
		} else {
			$sql = "SELECT DealCmdID, DealsID, IndividuID, Quantite_Cmd, Nom, Prenom, Telephone, Mail, RaisonSociale_fac, Adresse1_fac, Adresse2_fac, CodePostal_liv, Ville_fac, RaisonSociale_liv, Dest_Liv, Adresse1_liv, Adresse2_liv, CodePostal_liv, Ville_liv, Remarque FROM wcm_deals_commandes c WHERE DealsID='%s' and IndividuID = 0 and Mail = '%s' order by DealCmdID desc limit 1 ";
			
			$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'] , $DealsID ), mysqli_real_escape_string ($_SESSION['LINK'] , $Mail ) );
		}
		
		$result = mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
		
		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array ( $result );
			$this->DealCmdID = $line [0];
			$this->QuantiteCmdIndividu = $line [3];
			$this->Nom = utf8_encode ( $line [4] );
			$this->Prenom = utf8_encode ( $line [5] );
			$this->Tel = utf8_encode ( $line [6] );
			$this->Mail = utf8_encode ( $line [7] );
			$this->RaisonSociale_fac = utf8_encode ( $line [8] );
			$this->Adresse1_fac = utf8_encode ( $line [9] );
			$this->Adresse2_fac = utf8_encode ( $line [10] );
			$this->CodePostal_fac = utf8_encode ( $line [11] );
			$this->Ville_fac = utf8_encode ( $line [12] );
			$this->RaisonSociale_liv = utf8_encode ( $line [13] );
			$this->Destinataire_liv = utf8_encode ( $line [14] );
			$this->Adresse1_liv = utf8_encode ( $line [15] );
			$this->Adresse2_liv = utf8_encode ( $line [16] );
			$this->CodePostal_liv = utf8_encode ( $line [17] );
			$this->Ville_liv = utf8_encode ( $line [18] );
			$this->Remarque = utf8_encode ( $line [19] );
		} else {
			$this->DealCmdID = NULL;
			$this->QuantiteCmdIndividu = 0;
		}
		
		mysqli_free_result ( $result );
	}
	public function SQL_select_MailDeal($DealsID, $MailDeal) {
		$sql = "SELECT DealCmdID FROM wcm_deals_commandes c WHERE DealsID='%s' and IndividuID = 0 and Mail='%s'";
		
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'] , $DealsID ), mysqli_real_escape_string ($_SESSION['LINK'] , $MailDeal ) );
		
		$result = mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
		
		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array ( $result );
			$this->DealCmdID = $line [0];
		} else {
			$this->DealCmdID = 0;
		}
		mysqli_free_result ( $result );
	}
	public function SQL_create_Deals($DealsID, $IndividuID, $Mail) {
		$sql = "INSERT INTO wcm_deals_commandes (DealCmdID,DealsID, IndividuID, Nom, Prenom, Telephone, mail, RaisonSociale_fac, Adresse1_fac, Adresse2_fac, CodePostal_fac, Ville_fac, RaisonSociale_liv, Dest_liv, Adresse1_liv, Adresse2_liv, CodePostal_liv, Ville_liv, Quantite_cmd, Remarque )";
		$sql .= " VALUES(NULL,'%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s')";
		
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'] , $DealsID ), mysqli_real_escape_string ($_SESSION['LINK'] , $IndividuID ), utf8_decode ( $this->Nom ), utf8_decode ( $this->Prenom ), mysqli_real_escape_string ($_SESSION['LINK'] , utf8_decode ( $this->Tel ) ), mysqli_real_escape_string ($_SESSION['LINK'] , utf8_decode ( $this->Mail ) ), utf8_decode ( $this->RaisonSociale_fac ), utf8_decode ( $this->Adresse1_fac ), utf8_decode ( $this->Adresse2_fac ), mysqli_real_escape_string ($_SESSION['LINK'] , utf8_decode ( $this->CodePostal_fac ) ), utf8_decode ( $this->Ville_fac ), utf8_decode ( $this->RaisonSociale_liv ), utf8_decode ( $this->Destinataire_liv ), utf8_decode ( $this->Adresse1_liv ), utf8_decode ( $this->Adresse2_liv ), mysqli_real_escape_string ($_SESSION['LINK'] , utf8_decode ( $this->CodePostal_liv ) ), utf8_decode ( $this->Ville_liv ), mysqli_real_escape_string ($_SESSION['LINK'] , $this->QuantiteCmdIndividu ), utf8_decode ( $this->Remarque ) );
		
		mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
		
		$this->setDealCmdID ( ( int ) mysqli_insert_id ($_SESSION['LINK']) );
	}
	public function SQL_create_Deals_commandes_Param($DealCmdID, $ParamID, $Quantite) {
		$sql = "INSERT INTO wcm_deals_commandes_param (DealCmdID,ParamID,QteCmd)";
		$sql .= " VALUES('%s','%s','%s')";
		
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'] , $DealCmdID ), mysqli_real_escape_string ($_SESSION['LINK'] , $ParamID ), mysqli_real_escape_string ($_SESSION['LINK'] , $Quantite ) );
		
		mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function SQL_update_Deals($DealCmdID) {
		$sql = "UPDATE wcm_deals_commandes SET Nom = '%s',Prenom = '%s', Telephone = '%s', Mail = '%s', RaisonSocial_fac ='%s', Adresse1_fac ='%s', Adresse2_fac ='%s', CodePostal_fac ='%s', Ville_fac ='%s', RaisonSocial_liv ='%s', Dest_liv ='%s', Adresse1_liv ='%s', Adresse2_liv ='%s', CodePostal_liv ='%s', Ville_liv ='%s', Quantite_cmd='%s', Remarque='%s'";
		$sql .= " WHERE DealCmdID='%s'";
		
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'] , utf8_decode ( $this->Nom ) ), mysqli_real_escape_string ($_SESSION['LINK'] , utf8_decode ( $this->Prenom ) ), mysqli_real_escape_string ($_SESSION['LINK'] , utf8_decode ( $this->Tel ) ), mysqli_real_escape_string ($_SESSION['LINK'] , utf8_decode ( $this->Mail ) ), mysqli_real_escape_string ($_SESSION['LINK'] , utf8_decode ( $this->RaisonSociale_fac ) ), utf8_decode ( $this->Adresse1_fac ), utf8_decode ( $this->Adresse2_fac ), mysqli_real_escape_string ($_SESSION['LINK'] , utf8_decode ( $this->CodePostal_fac ) ), mysqli_real_escape_string ($_SESSION['LINK'] , utf8_decode ( $this->Ville_fac ) ), mysqli_real_escape_string ($_SESSION['LINK'] , utf8_decode ( $this->RaisonSociale_liv ) ), mysqli_real_escape_string ($_SESSION['LINK'] , utf8_decode ( $this->Destinataire_liv ) ), utf8_decode ( $this->Adresse1_liv ), utf8_decode ( $this->Adresse2_liv ), mysqli_real_escape_string ($_SESSION['LINK'] , utf8_decode ( $this->CodePostal_liv ) ), mysqli_real_escape_string ($_SESSION['LINK'] , utf8_decode ( $this->Ville_liv ) ), mysqli_real_escape_string ($_SESSION['LINK'] , $this->QuantiteCmdIndividu ), mysqli_real_escape_string ($_SESSION['LINK'] , $DealCmdID ), mysqli_real_escape_string ($_SESSION['LINK'] , utf8_decode ( $this->Remarque ) ) );
		
		mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
}
?>