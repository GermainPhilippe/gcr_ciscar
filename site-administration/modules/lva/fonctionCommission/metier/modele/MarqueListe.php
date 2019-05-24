<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage lva
 * @version 1.0.4
 */
class FonctionCommissionListe {
	private $fonctionCommissionListe;

	function __construct()
	{
		$this->fonctionCommissionListe = array ();
	}
	function FonctionCommissionListe() {
		self::__construct();
	}

	// #################
	function addFonctionCommission($FonctionCommission) {
		$this->fonctionCommissionListe [] = $aFonctionCommission;
	}
	function removeFonctionCommission($i) {
		unset ( $this->fonctionCommissionListe [$i] );
	}
	function getFonctionCommissionListe() {
		return $this->fonctionCommissionListe;
	}
	function setFonctionCommissionListe($newValue) {
		$this->fonctionCommissionListe = $newValue;
	}
	function getNbFonctionCommission() {
		return count ( $this->fonctionCommissionListe );
	}

	// ##################
	function select_all_fonctioncommission() {
		$result = mysqli_query ($_SESSION['LINK'], "SELECT FonctionCommissionID, AnnuaireID, Libelle FROM annuaire_lva_fonctioncommission WHERE AnnuaireID='" . $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] . "' ORDER BY Libelle" ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aMarque = new FonctionCommission ();

			$aMarque->setID ( $line [0] );
			$aMarque->setName ( $line [2] );

			$aAnnuaire = new Annuaire ();
			$aAnnuaire->select_annuaire ( $line [1] );
			$aMarque->setAnnuaire ( $aAnnuaire );

			$this->fonctionCommissionListe [] = $aMarque;
		}

		mysqli_free_result  ( $result );
	}
}
?>