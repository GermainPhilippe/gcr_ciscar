<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage site
 * @version 1.0.4
 */
class ListeSite {
	private $siteListe;
	
	function __construct()
	{
		$this->siteListe = array ();
	}
	function ListeSite() {
		self::__construct();
	}

	// #################
	function addSite($aSite) {
		$this->siteListe [] = $aSite;
	}
	function removeSite($i) {
		unset ( $this->siteListe [$i] );
	}
	function getSiteListe() {
		return $this->siteListe;
	}
	function setSiteListe($newValue) {
		$this->siteListe = $newValue;
	}
	function getNbSite() {
		return count ( $this->siteListe );
	}

	// ###################
	function select_all_site() {
		$result = mysqli_query ($_SESSION['LINK'], "SELECT SiteID, Nom, AnnuaireID, url_logo FROM annuaire_site" ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aSite = new Site ();
			$aSite->setID ( $line [0] );
			$aSite->setName ( $line [1] );

			$aAnnuaire = new Annuaire ();
			$aAnnuaire->select_annuaire ( $line [2] );
			$aSite->setAnnuaire ( $aAnnuaire );

			$aSite->setUrlLogo ( $line [3] );

			$this->siteListe [] = $aSite;
		}

		mysqli_free_result  ( $result );
	}
}

?>