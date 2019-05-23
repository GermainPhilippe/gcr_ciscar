<?php
/**
 * @author Florent DESPIERRES
 * @package portail-ciscar
 * @subpackage statistique
 * @version 1.0.4
 */
class StatDoc {
	private $Id;
	private $time;
	private $Iduser;
	private $DocID;
	private $SiteID;
	private $TypeDoc;
	function __construct() {
		$this->Id = NULL;
		$this->time = NULL;
		$this->Iduser = (isset ( $_SESSION ['CISCAR'] ['USER'] ['ID'] ) ? $_SESSION ['CISCAR'] ['USER'] ['ID'] : NULL);
		$this->DocID = '';
		$this->SiteID = '1';
		$this->TypeDoc = '';
	}
	
	// set
	public function setId($newValue) {
		$this->Id = $newValue;
	}
	public function setIduser($newValue) {
		$this->Iduser = $newValue;
	}
	public function settime($newValue) {
		$this->time = $newValue;
	}
	public function setDocID($newValue) {
		$this->DocID = $newValue;
	}
	public function setSiteID($newValue) {
		$this->SiteID = $newValue;
	}
	public function setTypeDoc($newValue) {
		$this->TypeDoc = $newValue;
	}
	
	// get
	public function getId() {
		return $this->Id;
	}
	public function getIduser() {
		return $this->Iduser;
	}
	public function gettime() {
		return $this->time;
	}
	public function getDocId() {
		return $this->DocID;
	}
	public function getSiteID() {
		return $this->SiteID;
	}
	public function getTypeDoc() {
		return $this->TypeDoc;
	}
	public function SQL_INSERT_DOC() {
		switch ($this->TypeDoc) {
			// DocInfoDyn
			case 0 :
				$CatTypeID = NULL;
				$CatTypeLibelle = '';
				$CatThemeID = NULL;
				$CatThemeLibelle = '';
				$CatMetierID = NULL;
				$CatMetierLibelle = '';
				$DomaineActiviteID = NULL;
				$DomaineActiviteLibelle = '';
				$RegionID = NULL;
				$RegionLibelle = '';
				$DocTitre = '';
				
				// ### Recuperation Catégorie ###
				$sql = "SELECT ic.CatTypeID, c1.Description,ic.CatThemeID, c2.Description,ic.CatMetierID, c3.Description, i.Titre
						FROM wcm_document_infodyn_categorie ic, wcm_document_categorie c1, wcm_document_categorie c2, wcm_document_categorie c3, wcm_document_infodyn i
						WHERE ic.CatTypeID = c1.DocCategorieID
						AND ic.CatThemeID = c2.DocCategorieID
						AND ic.CatMetierID = c3.DocCategorieID
						AND ic.CatUne = ic.CatTypeID
						AND i.DocInfoDynID = ic.DocInfoDynID
						AND ic.`DocInfoDynID`='%s' LIMIT 1";
				$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'] , $this->DocID ) );
				$result = mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
				if (mysqli_num_rows ( $result ) > 0) {
					$line = mysqli_fetch_array ( $result );
					
					$CatTypeID = $line [0];
					$CatTypeLibelle = $line [1];
					$CatThemeID = $line [2];
					$CatThemeLibelle = $line [3];
					$CatMetierID = $line [4];
					$CatMetierLibelle = $line [5];
					$DocTitre = $line [6];
				}
				mysqli_free_result ( $result );
				
				// ## Recuperation Domaine d'activite ###
				$sql = "SELECT rda.DomainActiviteID, d.Libelle, Min(d.NumOrdre)
						FROM annuaire_role r, annuaire_role_domainactivite rda, annuaire_lva_domainactivite d
						WHERE r.RoleID = rda.RoleID AND rda.DomainActiviteID =d.DomainActiviteID AND r.IndividuID='%s'";
				$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'] , $this->Iduser ) );
				$result = mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
				if (mysqli_num_rows ( $result ) > 0) {
					$line = mysqli_fetch_array ( $result );
					$DomaineActiviteID = $line [0];
					$DomaineActiviteLibelle = $line [1];
				}
				mysqli_free_result ( $result );
				
				// ### Region Etablissement utilisateur ###
				$sql = "SELECT e.RegionID, re.Libelle
						FROM annuaire_role r, annuaire_etablissement e, annuaire_lva_region re
						WHERE r.IndividuID='%s' AND e.EtablissementID = r.EtablissementID AND e.RegionID = re.RegionID";
				$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'] , $this->Iduser ) );
				$result = mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
				if (mysqli_num_rows ( $result ) > 0) {
					$line = mysqli_fetch_array ( $result );
					$RegionID = $line [0];
					$RegionLibelle = $line [1];
				}
				mysqli_free_result ( $result );
				
				// ## CREATION de la STAT ##
				$sql = "INSERT INTO stat_line_doc (ID, Date, IDUser, IDDoc, TypeDoc, SiteID, CatType, CatMetier, CatTheme, Domaine, Region, Titre, Libelle_Region, Libelle_Domaine, Libelle_CatType, Libelle_CatTheme, Libelle_CatMetier)";
				$sql .= " VALUES(NULL, NULL, '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')";
				
				$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'] , $this->Iduser ), mysqli_real_escape_string ($_SESSION['LINK'] , $this->DocID ), mysqli_real_escape_string ($_SESSION['LINK'] , $this->TypeDoc ), mysqli_real_escape_string ($_SESSION['LINK'] , $this->SiteID ), mysqli_real_escape_string ($_SESSION['LINK'] , $CatTypeID ), mysqli_real_escape_string ($_SESSION['LINK'] , $CatMetierID ), mysqli_real_escape_string ($_SESSION['LINK'] , $CatThemeID ), mysqli_real_escape_string ($_SESSION['LINK'] , $DomaineActiviteID ), mysqli_real_escape_string ($_SESSION['LINK'] , $RegionID ), mysqli_real_escape_string ($_SESSION['LINK'] , $DocTitre ), mysqli_real_escape_string ($_SESSION['LINK'] , $RegionLibelle ), mysqli_real_escape_string ($_SESSION['LINK'] , $DomaineActiviteLibelle ), mysqli_real_escape_string ($_SESSION['LINK'] , $CatTypeLibelle ), mysqli_real_escape_string ($_SESSION['LINK'] , $CatThemeLibelle ), mysqli_real_escape_string ($_SESSION['LINK'] , $CatMetierLibelle ) );
				mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
				$this->setId ( mysqli_insert_id ($_SESSION['LINK']) );
				break;
			
			// DOC STATIC
			case 1 :
				$CatTypeID = NULL;
				$CatTypeLibelle = '';
				$CatThemeID = NULL;
				$CatThemeLibelle = '';
				$CatMetierID = NULL;
				$CatMetierLibelle = '';
				$DomaineActiviteID = NULL;
				$DomaineActiviteLibelle = '';
				$RegionID = NULL;
				$RegionLibelle = '';
				$DocTitre = '';
				
				// ## Recuperation Domaine d'activite ###
				$sql = "SELECT rda.DomainActiviteID, d.Libelle, Min(d.NumOrdre)
						FROM annuaire_role r, annuaire_role_domainactivite rda, annuaire_lva_domainactivite d
						WHERE r.RoleID = rda.RoleID AND rda.DomainActiviteID =d.DomainActiviteID AND r.IndividuID='%s'";
				$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'] , $this->Iduser ) );
				$result = mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
				if (mysqli_num_rows ( $result ) > 0) {
					$line = mysqli_fetch_array ( $result );
					$DomaineActiviteID = $line [0];
					$DomaineActiviteLibelle = $line [1];
				}
				mysqli_free_result ( $result );
				
				// ### Region Etablissement utilisateur ###
				$sql = "SELECT e.RegionID, re.Libelle
						FROM annuaire_role r, annuaire_etablissement e, annuaire_lva_region re
						WHERE r.IndividuID='%s' AND e.EtablissementID = r.EtablissementID AND e.RegionID = re.RegionID";
				$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'] , $this->Iduser ) );
				$result = mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
				if (mysqli_num_rows ( $result ) > 0) {
					$line = mysqli_fetch_array ( $result );
					$RegionID = $line [0];
					$RegionLibelle = $line [1];
				}
				mysqli_free_result ( $result );
				
				// ## CREATION de la STAT ##
				$sql = "INSERT INTO stat_line_doc (ID, Date, IDUser, IDDoc, TypeDoc, SiteID, Domaine, Region, Titre, Libelle_Region, Libelle_Domaine)";
				$sql .= " VALUES(NULL, NULL, '%s', '%s', '%s', '%s', '%s', '%s', (SELECT Titre FROM wcm_document_static WHERE DocStaticID='%s'),'%s','%s')";
				
				$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'] , $this->Iduser ), mysqli_real_escape_string ($_SESSION['LINK'] , $this->DocID ), mysqli_real_escape_string ($_SESSION['LINK'] , $this->TypeDoc ), mysqli_real_escape_string ($_SESSION['LINK'] , $this->SiteID ), mysqli_real_escape_string ($_SESSION['LINK'] , $DomaineActiviteID ), mysqli_real_escape_string ($_SESSION['LINK'] , $RegionID ), mysqli_real_escape_string ($_SESSION['LINK'] , $this->DocID ), mysqli_real_escape_string ($_SESSION['LINK'] , $RegionLibelle ), mysqli_real_escape_string ($_SESSION['LINK'] , $DomaineActiviteLibelle ) );
				mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
				$this->setId ( mysqli_insert_id ($_SESSION['LINK']) );
				break;
			// Doc partenaire
			case 2 :
				$CatTypeID = NULL;
				$CatTypeLibelle = '';
				$CatThemeID = NULL;
				$CatThemeLibelle = '';
				$CatMetierID = NULL;
				$CatMetierLibelle = '';
				$DomaineActiviteID = NULL;
				$DomaineActiviteLibelle = '';
				$RegionID = NULL;
				$RegionLibelle = '';
				$DocTitre = '';
				
				// ## Recuperation Domaine d'activite ###
				$sql = "SELECT rda.DomainActiviteID, d.Libelle, Min(d.NumOrdre)
						FROM annuaire_role r, annuaire_role_domainactivite rda, annuaire_lva_domainactivite d
						WHERE r.RoleID = rda.RoleID AND rda.DomainActiviteID =d.DomainActiviteID AND r.IndividuID='%s'";
				$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'] , $this->Iduser ) );
				$result = mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
				if (mysqli_num_rows ( $result ) > 0) {
					$line = mysqli_fetch_array ( $result );
					$DomaineActiviteID = $line [0];
					$DomaineActiviteLibelle = $line [1];
				}
				mysqli_free_result ( $result );
				
				// ### Region Etablissement utilisateur ###
				$sql = "SELECT e.RegionID, re.Libelle
						FROM annuaire_role r, annuaire_etablissement e, annuaire_lva_region re
						WHERE r.IndividuID='%s' AND e.EtablissementID = r.EtablissementID AND e.RegionID = re.RegionID";
				$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'] , $this->Iduser ) );
				$result = mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
				if (mysqli_num_rows ( $result ) > 0) {
					$line = mysqli_fetch_array ( $result );
					$RegionID = $line [0];
					$RegionLibelle = $line [1];
				}
				mysqli_free_result ( $result );
				
				// ## CREATION de la STAT ##
				$sql = "INSERT INTO stat_line_doc (ID, Date, IDUser, IDDoc, TypeDoc, SiteID,  Domaine, Region, Titre, Libelle_Region, Libelle_Domaine)";
				$sql .= " VALUES(NULL, NULL, '%s', '%s', '%s', '%s', '%s', '%s', (SELECT Titre FROM wcm_document_partenaire_page WHERE DocPartenairePageID='%s'), '%s', '%s'
				)";
				
				$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'] , $this->Iduser ), mysqli_real_escape_string ($_SESSION['LINK'] , $this->DocID ), mysqli_real_escape_string ($_SESSION['LINK'] , $this->TypeDoc ), mysqli_real_escape_string ($_SESSION['LINK'] , $this->SiteID ), mysqli_real_escape_string ($_SESSION['LINK'] , $DomaineActiviteID ), mysqli_real_escape_string ($_SESSION['LINK'] , $RegionID ), mysqli_real_escape_string ($_SESSION['LINK'] , $this->DocID ), mysqli_real_escape_string ($_SESSION['LINK'] , $RegionLibelle ), mysqli_real_escape_string ($_SESSION['LINK'] , $DomaineActiviteLibelle ) );
				mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
				$this->setId ( mysqli_insert_id ($_SESSION['LINK']) );
				
				break;
		}
	}
}
?>