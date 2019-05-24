<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage lva
 * @version 1.0.4
 */
class DomaineActiviteListe {
	private $domaineActiviteListe;

	function __construct()
	{
		$this->domaineActiviteListe = array ();
	}
	function DomaineActiviteListe() {
		self::__construct();
	}
	
	// #################
	function addDomaineActivite($aDomaineActivite) {
		$this->domaineActiviteListe [] = $aDomaineActivite;
	}
	function removeDomaineActivite($i) {
		unset ( $this->domaineActiviteListe [$i] );
	}
	function getDomaineActiviteListe() {
		return $this->domaineActiviteListe;
	}
	function setDomaineActiviteListe($newValue) {
		$this->domaineActiviteListe = $newValue;
	}
	function getNbDomaineActivite() {
		return count ( $this->domaineActiviteListe );
	}

	// ##################
	function select_all_domaineactivite() {
		$result = mysqli_query ($_SESSION['LINK'], "SELECT DomainActiviteID, AnnuaireID, Libelle, NumOrdre FROM annuaire_lva_domainactivite WHERE AnnuaireID='" . $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] . "' ORDER BY Libelle,NumOrdre" ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aMarque = new DomaineActivite ();

			$aMarque->setID ( $line [0] );
			$aMarque->setName ( $line [2] );
			$aMarque->setNumOrdre ( $line [3] );

			$aAnnuaire = new Annuaire ();
			$aAnnuaire->select_annuaire ( $line [1] );
			$aMarque->setAnnuaire ( $aAnnuaire );

			$this->domaineActiviteListe [] = $aMarque;
		}

		mysqli_free_result  ( $result );
	}

	// méthode utilisé dans les statistiques
	function select_all_domaineactivite_stat($site) {
		$sql = "SELECT DomainActiviteID, AnnuaireID, Libelle, NumOrdre FROM annuaire_lva_domainactivite WHERE AnnuaireID='%s' ORDER BY NumOrdre";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $site ) );
		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aMarque = new DomaineActivite ();

			$aMarque->setID ( $line [0] );
			$aMarque->setName ( $line [2] );
			$aMarque->setNumOrdre ( $line [3] );

			$aAnnuaire = new Annuaire ();
			$aAnnuaire->select_annuaire ( $line [1] );
			$aMarque->setAnnuaire ( $aAnnuaire );

			$this->domaineActiviteListe [] = $aMarque;
		}

		mysqli_free_result  ( $result );
	}
}
?>