<?php
/**
 * @author Florent DESPIERRES
 * @package portail-ciscar
 * @subpackage banniere
 * @version 1.0.4
 */
class Banniere {
	private $ID;
	private $Titre;
	private $Url;
	private $UrlImage;
	private $DateDebut;
	private $DateFin;
	private $Publication;
	private $ParDefaut;
	public function __construct() {
		$this->ID = NULL;
		$this->Titre = '';
		$this->Url = '';
		$this->UrlImage = '';
		$this->DateDebut = NULL;
		$this->DateFin = NULL;
		$this->Publication = 0;
		$this->ParDefaut = 0;
	}
	
	// ###
	public function getID() {
		return $this->ID;
	}
	public function getTitre() {
		return $this->Titre;
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
	public function getPublication() {
		return $this->Publication;
	}
	public function getParDefaut() {
		return $this->ParDefaut;
	}
	public function setID($newValue) {
		$this->ID = $newValue;
	}
	public function setTitre($newValue) {
		$this->Titre = $newValue;
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
	public function setPublication($newValue) {
		$this->Publication = $newValue;
	}
	public function setParDefaut($newValue) {
		$this->ParDefaut = $newValue;
	}
	
	// ###
	public function SQL_select($BanniereID) {
		$sql = "SELECT BanniereID, Titre, URL, URL_Image, Publication, DateDebut, DateFin, ParDefaut FROM wcm_banniere WHERE SiteID='%s' AND Publication='1' AND ((DateDebut IS NULL AND DateFin IS NULL) OR (Date(Now())>=DateDebut AND Date(Now())<=DateFin)) AND BanniereID='%s'";
		
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'] , $_SESSION ['SITE'] ['ID'] ), mysqli_real_escape_string ($_SESSION['LINK'] , $BanniereID ) );
		
		$result = mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
		
		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array ( $result );
			
			$this->ID = $line [0];
			$this->Titre = $line [1];
			$this->Url = $line [2];
			$this->UrlImage = $line [3];
			$this->DateDebut = $line [5];
			$this->DateFin = $line [6];
			$this->Publication = $line [4];
			$this->ParDefaut = $line [7];
		} else {
			$this->__construct ();
		}
		
		mysqli_free_result ( $result );
	}
}
?>