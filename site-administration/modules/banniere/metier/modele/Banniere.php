<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
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
	private $SiteID;
	public function __construct() {
		$this->ID = NULL;
		$this->Titre = '';
		$this->Url = '';
		$this->UrlImage = '';
		$this->DateDebut = NULL;
		$this->DateFin = NULL;
		$this->Publication = 0;
		$this->ParDefaut = 0;
		$this->SiteID = NULL;
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
	public function getSiteID() {
		return $this->SiteID;
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
	public function setSiteID($newValue) {
		$this->SiteID = $newValue;
	}

	// ###
	public function SQL_create() {
		$sql = "INSERT INTO wcm_banniere (BanniereID, Titre, URL, URL_Image,Publication" . (! is_null ( $this->DateDebut ) ? ',DateDebut' : '') . "" . (! is_null ( $this->DateFin ) ? ',DateFin' : '') . ", ParDefaut, SiteID)";
		$sql .= " VALUES(NULL,'%s','%s','%s','%s'";
		$sql .= is_null ( $this->DateDebut ) ? '' : ", '" . $this->DateDebut . "'";
		$sql .= is_null ( $this->DateFin ) ? '' : ", '" . $this->DateFin . "'";
		$sql .= ",'%s','%s')";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $this->Titre ), mysqli_real_escape_string ($_SESSION['LINK'], $this->Url ), mysqli_real_escape_string ($_SESSION['LINK'], $this->UrlImage ), mysqli_real_escape_string ($_SESSION['LINK'], $this->Publication ), mysqli_real_escape_string ($_SESSION['LINK'], $this->ParDefaut ), mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function SQL_update() {
		$sql = "UPDATE wcm_banniere SET Titre='%s', URL='%s', URL_Image='%s', Publication='%s'";
		$sql .= is_null ( $this->DateDebut ) ? ", DateDebut=NULL" : ", DateDebut='" . $this->DateDebut . "'";
		$sql .= is_null ( $this->DateFin ) ? ", DateFin=NULL" : ", DateFin='" . $this->DateFin . "'";
		$sql .= ", ParDefaut='%s' WHERE BanniereID='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $this->Titre ), mysqli_real_escape_string ($_SESSION['LINK'], $this->Url ), mysqli_real_escape_string ($_SESSION['LINK'], $this->UrlImage ), mysqli_real_escape_string ($_SESSION['LINK'], $this->Publication ), mysqli_real_escape_string ($_SESSION['LINK'], $this->ParDefaut ), mysqli_real_escape_string ($_SESSION['LINK'], $this->ID ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		/*
		 * $query = sprintf("UPDATE wcm_banniere SET ParDefaut='0' WHERE ParDefaut='1' AND BanniereID!='%s' AND SiteID='%s'",
		 * mysql_real_escape_string($this->ID),
		 * mysql_real_escape_string($_SESSION['ADMIN']['USER']['AnnuaireID']));
		 *
		 * mysql_query($query) or die(mysql_error());
		 */
	}
	public function SQL_delete() {
		$query = sprintf ( "DELETE FROM wcm_banniere WHERE BanniereID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $this->ID ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function SQL_select($BanniereID) {
		$query = sprintf ( "SELECT BanniereID, Titre, URL, URL_Image, Publication, DateDebut, DateFin, ParDefaut, SiteID FROM wcm_banniere WHERE BanniereID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $BanniereID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array  ( $result );

			$this->ID = $line [0];
			$this->Titre = $line [1];
			$this->Url = $line [2];
			$this->UrlImage = $line [3];
			$this->DateDebut = $line [5];
			$this->DateFin = $line [6];
			$this->Publication = $line [4];
			$this->ParDefaut = $line [7];
			$this->SiteID = $line [8];
		} else {
			$this->__construct ();
		}

		mysqli_free_result  ( $result );
	}
	public function SQL_select_default() {
		$query = sprintf ( "SELECT BanniereID, Titre, URL, URL_Image, Publication, DateDebut, DateFin, ParDefaut, SiteID FROM wcm_banniere WHERE ParDefaut='1' AND SiteID='%s' LIMIT 1", mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array  ( $result );

			$this->ID = $line [0];
			$this->Titre = $line [1];
			$this->Url = $line [2];
			$this->UrlImage = $line [3];
			$this->DateDebut = $line [5];
			$this->DateFin = $line [6];
			$this->Publication = $line [4];
			$this->ParDefaut = $line [7];
			$this->SiteID = $line [8];
		} else {
			$this->__construct ();
		}
		mysqli_free_result  ( $result );
	}
}

?>