<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage lva
 * @version 1.0.4
 */
class RegionListe {
	private $regionListe;

	function __construct()
	{
		$this->regionListe = array ();
	}
	function RegionListe() {
		self::__construct();
	}

	// #################
	function addRegion($aRegion) {
		$this->regionListe [] = $aRegion;
	}
	function removeRegion($i) {
		unset ( $this->regionListe [$i] );
	}
	function getRegionListe() {
		return $this->regionListe;
	}
	function setRegionListe($newValue) {
		$this->regionListe = $newValue;
	}
	function getNbRegion() {
		return count ( $this->regionListe );
	}

	// ##################
	function select_all_region_lva($annu) {
		if ($annu == '0')
			$annu = $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'];

		$result = mysqli_query ($_SESSION['LINK'], "SELECT RegionID, AnnuaireID, Libelle FROM annuaire_lva_region WHERE AnnuaireID='" . $annu . "' ORDER BY Libelle" ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aRegion = new Region ();

			$aRegion->setID ( $line [0] );
			$aRegion->setName ( $line [2] );

			$aAnnuaire = new Annuaire ();
			$aAnnuaire->select_annuaire ( $line [1] );
			$aRegion->setAnnuaire ( $aAnnuaire );

			$this->regionListe [] = $aRegion;
		}

		mysqli_free_result  ( $result );
	}
	function select_all_region() {
		$annu = $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'];

		$result = mysqli_query ($_SESSION['LINK'], "SELECT RegionID, AnnuaireID, Libelle FROM annuaire_lva_region WHERE AnnuaireID='" . $annu . "' ORDER BY Libelle" ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aRegion = new Region ();

			$aRegion->setID ( $line [0] );
			$aRegion->setName ( $line [2] );

			$aAnnuaire = new Annuaire ();
			$aAnnuaire->select_annuaire ( $line [1] );
			$aRegion->setAnnuaire ( $aAnnuaire );

			$this->regionListe [] = $aRegion;
		}

		mysqli_free_result  ( $result );
	}

	// Fonction appelée dans la partie statistiques
	function select_all_region_stat($site) {
		$sql = "SELECT RegionID, AnnuaireID, Libelle FROM annuaire_lva_region WHERE AnnuaireID = %s";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $site ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aRegion = new Region ();

			$aRegion->setID ( $line [0] );
			$aRegion->setName ( $line [2] );

			$aAnnuaire = new Annuaire ();
			$aAnnuaire->select_annuaire ( $line [1] );
			$aRegion->setAnnuaire ( $aAnnuaire );

			$this->regionListe [] = $aRegion;
		}

		mysqli_free_result  ( $result );
	}
}
?>