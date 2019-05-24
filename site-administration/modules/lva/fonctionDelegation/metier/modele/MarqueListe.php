<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage lva
 * @version 1.0.4
 */
class FonctionDelegationListe {
	private $fonctionDelegationListe;

	function __construct()
	{
		$this->fonctionDelegationListe = array ();
	}
	function FonctionDelegationListe() {
		self::__construct();
	}
	
	// #################
	function addFonctionDelegation($aFonctionDelegation) {
		$this->fonctionDelegationListe [] = $aFonctionDelegation;
	}
	function removeFonctionDelegation($i) {
		unset ( $this->fonctionDelegationListe [$i] );
	}
	function getFonctionDelegationListe() {
		return $this->fonctionDelegationListe;
	}
	function setFonctionDelegationListe($newValue) {
		$this->fonctionDelegationListe = $newValue;
	}
	function getNbFonctionDelegation() {
		return count ( $this->fonctionDelegationListe );
	}

	// ##################
	function select_all_fonctiondelegation() {
		$result = mysqli_query ($_SESSION['LINK'], "SELECT FonctionDelegationID, AnnuaireID, Libelle FROM annuaire_lva_fonctiondelegation WHERE AnnuaireID='" . $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] . "' ORDER BY Libelle" ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aMarque = new FonctionDelegation ();

			$aMarque->setID ( $line [0] );
			$aMarque->setName ( $line [2] );

			$aAnnuaire = new Annuaire ();
			$aAnnuaire->select_annuaire ( $line [1] );
			$aMarque->setAnnuaire ( $aAnnuaire );

			$this->fonctionDelegationListe [] = $aMarque;
		}

		mysqli_free_result  ( $result );
	}
}
?>