<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage site
 * @version 1.0.4
 */
class Site {
	private $id;
	private $name;
	private $obj_annuaire;
	private $urlLogo;

	function __construct()
	{
		$this->id = NULL;
		$this->name = '';
		$this->obj_annuaire = NULL;
		$this->urlLogo = '';
	}
	function Site() {
		self::__construct();
	}
	
	// #######################
	function getID() {
		return $this->id;
	}
	function getName() {
		return $this->name;
	}
	function getAnnuaire() {
		return $this->obj_annuaire;
	}
	function getUrlLogo() {
		return $this->urlLogo;
	}
	function setID($newValue) {
		$this->id = $newValue;
	}
	function setName($newValue) {
		$this->name = $newValue;
	}
	function setAnnuaire($newValue) {
		$this->obj_annuaire = $newValue;
	}
	function setUrlLogo($newValue) {
		$this->urlLogo = $newValue;
	}

	// #######################
	function create_site() {
		$aAnnuaire = new Annuaire ();
		$aAnnuaire->setName ( $this->name );
		$aAnnuaire->create_annuaire ();
		$aAnnuaire->find_id ();

		$query = sprintf ( "INSERT INTO annuaire_site VALUES(NULL,'%s','%s','%s')", mysqli_real_escape_string ($_SESSION['LINK'], $this->name ), mysqli_real_escape_string ($_SESSION['LINK'], $aAnnuaire->getID () ), mysqli_real_escape_string ($_SESSION['LINK'], $this->urlLogo ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	function update_site() {
		$aAnnuaire = new Annuaire ();
		$aSite = new Site ();
		$aSite->select_site ( $this->id );
		$aAnnuaire->select_annuaire_parID ( $aSite->getAnnuaire ()->getID () );
		$aAnnuaire->setName ( $this->name );
		$aAnnuaire->update_annuaire ();

		$query = sprintf ( "UPDATE annuaire_site SET Nom='%s', url_logo='%s' WHERE SiteID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $this->name ), mysqli_real_escape_string ($_SESSION['LINK'], $this->urlLogo ), mysqli_real_escape_string ($_SESSION['LINK'], $this->id ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	function remove_site() {
		$aAnnuaire = new Annuaire ();
		$aSite = new Site ();
		$aSite->select_site ( $this->id );
		$aAnnuaire->select_annuaire_parID ( $aSite->getAnnuaire ()->getID () );
		$aAnnuaire->setName ( $this->name );

		$query = sprintf ( "DELETE FROM annuaire_site WHERE SiteID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $this->id ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		$aAnnuaire->remove_annuaire ();
	}
	function select_site($siteID) {
		$query = sprintf ( "SELECT SiteID, Nom, AnnuaireID, url_logo FROM annuaire_site WHERE SiteID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $siteID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array  ( $result );
			$this->setID ( $line [0] );
			$this->setName ( $line [1] );

			$aAnnuaire = new Annuaire ();
			$aAnnuaire->select_annuaire_parID ( $line [2] );
			$this->setAnnuaire ( $aAnnuaire );

			$this->setUrlLogo ( $line [3] );
		} else {
			$this->setID ( NULL );
			$this->setName ( '' );
			$this->setAnnuaire ( NULL );
			$this->setUrlLogo ( '' );
		}

		mysqli_free_result  ( $result );
	}
	function select_site_by_name() {
		$query = sprintf ( "SELECT SiteID, Nom, AnnuaireID, url_logo FROM annuaire_site WHERE Nom='%s' and AnnuaireID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['SiteName'] ), mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array  ( $result );
			$this->setID ( $line [0] );
			$this->setName ( $line [1] );

			$aAnnuaire = new Annuaire ();
			$aAnnuaire->select_annuaire_parID ( $line [2] );
			$this->setAnnuaire ( $aAnnuaire );

			$this->setUrlLogo ( $line [3] );
		} else {
			$this->setID ( NULL );
			$this->setName ( '' );
			$this->setAnnuaire ( NULL );
			$this->setUrlLogo ( '' );
		}

		mysqli_free_result  ( $result );
	}
}
?>