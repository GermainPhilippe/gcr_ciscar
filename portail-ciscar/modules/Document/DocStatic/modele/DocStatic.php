<?php
/**
 * @author Florent DESPIERRES
 * @package portail-ciscar
 * @subpackage document
 * @version 1.0.4
 */
class DocStatic {
	private $ID;
	private $CatTypeID;
	private $Titre;
	private $ContenuRichText;
	private $SiteID;
	public function __construct() {
		$this->ID = NULL;
		$this->CatTypeID = NULL;
		$this->Titre = '';
		$this->ContenuRichText = '';
		$this->SiteID = NULL;
	}
	
	// ###
	public function getID() {
		return $this->ID;
	}
	public function getCatTypeID() {
		return $this->CatTypeID;
	}
	public function getTitre() {
		return $this->Titre;
	}
	public function getContenuRichText() {
		return $this->ContenuRichText;
	}
	public function getSiteID() {
		return $this->SiteID;
	}
	public function setID($newValue) {
		$this->ID = $newValue;
	}
	public function setCatTypeID($newValue) {
		$this->CatTypeID = $newValue;
	}
	public function setTitre($newValue) {
		$this->Titre = $newValue;
	}
	public function setContenuRichText($newValue) {
		$this->ContenuRichText = $newValue;
	}
	public function setSiteID($newValue) {
		$this->SiteID = $newValue;
	}
	
	// ###
	public function SQL_select($DocID) {
		$sql = "SELECT DocStaticID, CatTypeID, Titre, ContenuRichText, SiteID FROM wcm_document_static";
		if (strlen ( $DocID ) == 32) {
			$sql .= " WHERE Unid='%s' AND SiteID='" . $_SESSION ['SITE'] ['ID'] . "'";
		} else {
			$sql .= " WHERE DocStaticID='%s' AND SiteID='" . $_SESSION ['SITE'] ['ID'] . "'";
		}
		
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'] , $DocID ) );
		$result = mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
		
		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array ( $result );
			$this->ID = $line [0];
			$this->CatTypeID = $line [1];
			$this->Titre = $line [2];
			$this->ContenuRichText = $line [3];
			$this->SiteID = $line [4];
		} else {
			$this->__construct ();
		}
		mysqli_free_result ( $result );
	}
	public function SQL_select_By_UNID($DocID) {
		$sql = "SELECT DocStaticID, CatTypeID, Titre, ContenuRichText, SiteID FROM wcm_document_static";
		if (strlen ( $DocID ) == 32) {
			$sql .= " WHERE Unid='%s' AND SiteID='" . $_SESSION ['SITE'] ['ID'] . "'";
		} else {
			$sql .= " WHERE DocStaticID='%s' AND SiteID='" . $_SESSION ['SITE'] ['ID'] . "'";
		}
		
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'] , $DocID ) );
		$result = mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
		
		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array ( $result );
			$this->ID = $line [0];
			$this->CatTypeID = $line [1];
			$this->Titre = $line [2];
			$this->ContenuRichText = $line [3];
			$this->SiteID = $line [4];
		} else {
			$this->__construct ();
		}
		mysqli_free_result ( $result );
	}
}
?>