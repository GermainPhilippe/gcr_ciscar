<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage lca
 * @version 1.0.4
 */
class SiteGroupeLCAListe {
	private $mySiteGroupeLCAListe;

	function __construct() {
		$this->mySiteGroupeLCAListe = array ();
	}
	
	function SiteGroupeLCAListe()
	{
		self::__construct();
	}
	
	// ###############
	function addSiteGroupeLCA($aSiteGroupeLCA) {
		$this->mySiteGroupeLCAListe [] = $aSiteGroupeLCA;
	}
	function removeSiteGroupeLCA($i) {
		unset ( $this->mySiteGroupeLCAListe [$i] );
	}
	function getSiteGroupeLCAListe() {
		return $this->mySiteGroupeLCAListe;
	}
	function setSiteGroupeLCAListe($newValue) {
		$this->mySiteGroupeLCAListe = $newValue;
	}
	function getNbSiteGroupeLCA() {
		return count ( $this->mySiteGroupeLCAListe );
	}

	// ###################
	function select_all_sitegroupelca_parent() {
		$result = mysqli_query ($_SESSION['LINK'], "SELECT GroupeID FROM annuaire_lca_groupe WHERE TypeGroupeID='2' AND ParentID IS NULL" ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aSiteGroupeLCA = new SiteGroupeLCA ();
			$aSiteGroupeLCA->select_groupelca ( $line [0] );
			$this->mySiteGroupeLCAListe [] = $aSiteGroupeLCA;
		}

		mysqli_free_result  ( $result );
	}
	function select_all_sitegroupelca_fils($ParentID) {
		$result = mysqli_query ($_SESSION['LINK'], "SELECT GroupeID FROM annuaire_lca_groupe WHERE TypeGroupeID='2' AND ParentID='$ParentID'" ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aSiteGroupeLCA = new SiteGroupeLCA ();
			$aSiteGroupeLCA->select_groupelca ( $line [0] );
			$this->mySiteGroupeLCAListe [] = $aSiteGroupeLCA;
		}

		mysqli_free_result  ( $result );
	}
	function select_all_sitegroupelca() {
		$result = mysqli_query ($_SESSION['LINK'], "SELECT GroupeID FROM annuaire_lca_groupe WHERE TypeGroupeID='2'" ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aSiteGroupeLCA = new SiteGroupeLCA ();
			$aSiteGroupeLCA->select_groupelca ( $line [0] );
			$this->mySiteGroupeLCAListe [] = $aSiteGroupeLCA;
		}

		mysqli_free_result  ( $result );
	}
	function select_all_sitegroupelca_membre($IndividuID) {
		$result = mysqli_query ($_SESSION['LINK'], "SELECT GroupeID FROM annuaire_lca_groupeindividu WHERE IndividuID='$IndividuID'" ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aSiteGroupeLCA = new SiteGroupeLCA ();
			$aSiteGroupeLCA->select_groupelca ( $line [0] );
			$this->mySiteGroupeLCAListe [] = $aSiteGroupeLCA;
		}

		mysqli_free_result  ( $result );
	}
	function sitegroupe_exist($siteGroupeID) {
		foreach ( $this->mySiteGroupeLCAListe as $aSite ) {
			if ($aSite->getID () == $siteGroupeID) {
				return true;
			}
		}
		return false;
	}
}

?>