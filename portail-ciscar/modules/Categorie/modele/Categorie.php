<?php
/**
 * @author Florent DESPIERRES
 * @package portail-ciscar
 * @subpackage categorie
 * @version 1.0.4
 */
class Categorie {
	private $ID;
	private $SiteID;
	private $ParentCategorieID;
	private $Description;
	private $URLImage;
	public function __construct() {
		$this->ID = NULL;
		$this->SiteID = NULL;
		$this->ParentCategorieID = NULL;
		$this->Description = '';
		$this->URLImage = '';
	}
	
	// ###
	public function getID() {
		return $this->ID;
	}
	public function getSiteID() {
		return $this->SiteID;
	}
	public function getParentID() {
		return $this->ParentCategorieID;
	}
	public function getDescription() {
		return $this->Description;
	}
	public function getURLImage() {
		return $this->URLImage;
	}
	public function setID($newValue) {
		$this->ID = $newValue;
	}
	public function setSiteID($newValue) {
		$this->SiteID = $newValue;
	}
	public function setParentID($newValue) {
		$this->ParentCategorieID = $newValue;
	}
	public function setDescription($newValue) {
		$this->Description = $newValue;
	}
	public function setURLImage($newValue) {
		$this->URLImage = $newValue;
	}
	
	// ###
	public function SQL_select($CategorieID) {
		$query = sprintf ( "SELECT DocCategorieID, SiteID, DocCatParentID, Description,URL_Image FROM wcm_document_categorie WHERE DocCategorieID='%s'", mysqli_real_escape_string ($_SESSION['LINK'] , $CategorieID ) );
		
		$result = mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
		
		if (mysqli_num_rows ( $result ) > 0) {
			$line = mysqli_fetch_array ( $result );
			
			$this->ID = $line [0];
			$this->SiteID = $line [1];
			$this->ParentCategorieID = $line [2];
			$this->Description = $line [3];
			$this->URLImage = $line [4];
		} else {
			$this->ID = NULL;
			$this->SiteID = NULL;
			$this->ParentCategorieID = NULL;
			$this->Description = '';
			$this->URLImage = '';
		}
		
		mysqli_free_result ( $result );
	}
	public function SQL_SEARCH($CatName) {
		$query = sprintf ( "SELECT DocCategorieID, SiteID, DocCatParentID, Description,URL_Image FROM wcm_document_categorie WHERE DocCatParentID IS NULL AND SiteID='%s' AND Description='%s'", mysqli_real_escape_string ($_SESSION['LINK'] , $_SESSION ['SITE'] ['ID'] ), mysqli_real_escape_string ($_SESSION['LINK'] , $CatName ) );
		
		$result = mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
		
		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array ( $result );
			
			$this->ID = $line [0];
			$this->SiteID = $line [1];
			$this->ParentCategorieID = $line [2];
			$this->Description = $line [3];
			$this->URLImage = $line [4];
		} else {
			$this->__construct ();
		}
		
		mysqli_free_result ( $result );
	}
}
?>