<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage lca
 * @version 1.0.4
 */
class MembreSiteGroupeLCAListe {
	private $membreListe;
	
	function MembreSiteGroupeLCAListe()
	{
		self::__construct();
	}
	function __construct() {
		$this->membreListe = array ();
	}

	// #################
	function addMembre($aMembre) {
		$this->membreListe [] = $aMembre;
	}
	function removeMembre($i) {
		unset ( $this->membreListe [$i] );
	}
	function getMembreListe() {
		return $this->membreListe;
	}
	function setMembreListe($newValue) {
		$this->membreListe = $newValue;
	}
	function getNbMembre() {
		return count ( $this->membreListe );
	}

	// ###################
	function select_all_membre($i) {
		$result = mysqli_query ($_SESSION['LINK'], "SELECT IndividuID FROM annuaire_lca_groupeindividu WHERE GroupeID=$i" ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aIndividu = new Individu ();
			$aIndividu->select_individu ( $line [0] );

			$this->membreListe [] = $aIndividu;
		}

		mysqli_free_result  ( $result );
	}
	function select_all_non_membre($i) {
		$result = mysqli_query ($_SESSION['LINK'], "SELECT IndividuID FROM annuaire_individu WHERE IndividuID NOT IN (SELECT IndividuID FROM annuaire_lca_groupeindividu WHERE GroupeID=$i)" ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aIndividu = new Individu ();
			$aIndividu->select_individu ( $line [0] );

			$this->membreListe [] = $aIndividu;
		}

		mysqli_free_result  ( $result );
	}
}

?>