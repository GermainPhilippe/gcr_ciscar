<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage lva
 * @version 1.0.4
 */
class AnnuaireListe {
	private $annuaireListe;

	function __construct()
	{
		$this->annuaireListe = array ();
	}
	function AnnuaireListe() {
		self::__construct();
	}

	// #################
	function addAnnuaire($aAnnuaire) {
		$this->annuaireListe [] = $aAnnuaire;
	}
	function removeAnnuaire($i) {
		unset ( $this->annuaireListe [$i] );
	}
	function getAnnuaireListe() {
		return $this->annuaireListe;
	}
	function setAnnuaireListe($newValue) {
		$this->annuaireListe = $newValue;
	}
	function getNbAnnuaire() {
		return count ( $this->annuaireListe );
	}

	// ##################
	function select_all_annuaire() {
		$result = mysqli_query ($_SESSION['LINK'], "SELECT AnnuaireID, Nom FROM annuaire_lva_annuaire" ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aAnnuaire = new Annuaire ();

			$aAnnuaire->setID ( $line [0] );
			$aAnnuaire->setName ( $line [1] );

			$this->annuaireListe [] = $aAnnuaire;
		}

		mysqli_free_result  ( $result );
	}
}
?>