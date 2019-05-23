<?php
/**
 * @author Florent DESPIERRES
 * @package portail-gcr
 * @subpackage document
 * @version 1.0.4
 */
class DocInfoDyn {
	private $ID;
	private $Titre;
	private $Accroche;
	private $ContenuRichText;
	private $BanniereID;
	private $PublicationALaUne;
	private $DateDebut;
	private $DateFin;
	private $AuteurID;
	private $VignetteAccroche;
	private $DateCreation;
	private $CatTypeID;
	private $CommentaireActif;
	public function __construct() {
		$this->ID = NULL;
		$this->Titre = '';
		$this->Accroche = '';
		$this->ContenuRichText = '';
		$this->BanniereID = NULL;
		$this->PublicationALaUne = '0';
		$this->DateDebut = '';
		$this->DateFin = '';
		$this->AuteurID = NULL;
		$this->VignetteAccroche = '';
		$this->DateCreation = '';
		$this->CatTypeID = '';
		$this->CommentaireActif = 0;
	}
	
	// ###
	public function getID() {
		return $this->ID;
	}
	public function getTitre() {
		return $this->Titre;
	}
	public function getAccroche() {
		return $this->Accroche;
	}
	public function getContenuRichText() {
		return $this->ContenuRichText;
	}
	public function getBanniereID() {
		return $this->BanniereID;
	}
	public function getPublicationALaUne() {
		return $this->PublicationALaUne;
	}
	public function getDateDebut() {
		return $this->DateDebut;
	}
	public function getDateFin() {
		return $this->DateFin;
	}
	public function getAuteurID() {
		return $this->AuteurID;
	}
	public function getVignetteAccroche() {
		return $this->VignetteAccroche;
	}
	public function getDateCreation() {
		return $this->DateCreation;
	}
	public function getCatTypeID() {
		return $this->CatTypeID;
	}
	public function getCommentaireActif() {
		return $this->CommentaireActif;
	}
	
	// ###
	public function getDateFR($DateEN) {
		$tab = preg_split ( "/-+/", $DateEN, 3 );
		return $tab [2] . '/' . $tab [1] . '/' . $tab [0];
	}
	
	// ###
	public function setID($newValue) {
		$this->ID = $newValue;
	}
	public function setTitre($newValue) {
		$this->Titre = $newValue;
	}
	public function setAccroche($newValue) {
		$this->Accroche = $newValue;
	}
	public function setContenuRichText($newValue) {
		$this->ContenuRichText = $newValue;
	}
	public function setBanniereID($newValue) {
		$this->BanniereID = $newValue;
	}
	public function setPublicationALaUne($newValue) {
		$this->PublicationALaUne = $newValue;
	}
	public function setDateDebut($newValue) {
		$this->DateDebut = $newValue;
	}
	public function setDateFin($newValue) {
		$this->DateFin = $newValue;
	}
	public function setAuteurID($newValue) {
		$this->AuteurID = $newValue;
	}
	public function setVignetteAccroche($newValue) {
		$this->VignetteAccroche = $newValue;
	}
	public function setDateCreation($newValue) {
		$this->DateCreation = $newValue;
	}
	public function setCatTypeID($newValue) {
		$this->CatTypeID = $newValue;
	}
	public function setCommentaireActif($newValue) {
		$this->CommentaireActif = $newValue;
	}
	
	// ###
	public function SQL_SELECT_DEFAULT_CATEGORIE() {
		$sql = "SELECT cc.URL_Image, cc.Description";
		$sql .= " FROM wcm_document_infodyn_categorie c, wcm_document_categorie cc";
		$sql .= " WHERE c.CatUne = cc.DocCategorieID AND c.DocInfoDynID='%s' LIMIT 1";
		
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'] , $this->ID ) );
		
		$result = mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
		return mysqli_fetch_array ( $result );
	}
	private function MergeArray($aArray) {
		$result = '';
		foreach ( $aArray as $aElement ) {
			$result .= ($result == '' ? '' : ',') . $aElement;
		}
		return $result;
	}
	public function SQL_select($DocID) {
		$sql = "SELECT DISTINCT(DocInfoDynID), Titre, Accroche, ContenuRichText, BanniereID, PublicationALaUne, DateDebut, DateFin, AuteurID, VignetteAccroche, CommentaireActif";
		$sql .= " FROM wcm_document_infodyn_compact";
		if (strlen ( $DocID ) == 32) {
			$sql .= " WHERE Unid='%s'";
		} else {
			$sql .= " WHERE DocInfoDynID='%s'";
		}
		$sql .= " AND (((DateDebut IS NULL) AND (DateFin IS NULL)) OR ((curdate() >= DateDebut) AND (curdate() <= DateFin)) OR((curdate() >= DateDebut) AND (DateFin IS NULL)) OR ((DateDebut IS NULL) AND (curdate() <=DateFin)))";
		$sql .= " AND SiteID='%s'";
		$sql .= " AND LCAGroupeID IN (" . $this->MergeArray ( $_SESSION [$_SESSION ['SITE'] ['NAME']] ['USER'] ['GROUPS'] ) . ")";
		$sql .= " GROUP BY Titre, Accroche, ContenuRichText, BanniereID, PublicationALaUne, DateDebut, DateFin, AuteurID ORDER BY DateDebut DESC";
		
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'] , $DocID ), mysqli_real_escape_string ($_SESSION['LINK'] , $_SESSION ['SITE'] ['ID'] ) );
		
		$result = mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
		
		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array ( $result );
			
			$this->ID = $line [0];
			$this->Titre = $line [1];
			$this->Accroche = $line [2];
			$this->ContenuRichText = $line [3];
			$this->BanniereID = $line [4];
			$this->PublicationALaUne = $line [5];
			$this->DateDebut = $line [6];
			$this->DateFin = $line [7];
			$this->AuteurID = $line [8];
			$this->VignetteAccroche = $line [9];
			$this->CommentaireActif = $line [10];
		} else {
			$this->__construct ();
		}
		
		mysqli_free_result ( $result );
	}
}
?>