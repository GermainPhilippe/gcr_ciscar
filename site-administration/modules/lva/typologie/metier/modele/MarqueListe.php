<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage lva
 * @version 1.0.4
 */
class TypologieListe {
	private $typologieListe;

	function __construct()
	{
		$this->typologieListe = array ();
	}
	function TypologieListe() {
		self::__construct();
	}
	
	// #################
	function addTypologie($aTypologie) {
		$this->typologieListe [] = $aTypologie;
	}
	function removeTypologie($i) {
		unset ( $this->typologieListe [$i] );
	}
	function getTypologieListe() {
		return $this->typologieListe;
	}
	function setTypologieListe($newValue) {
		$this->typologieListe = $newValue;
	}
	function getNbTypologie() {
		return count ( $this->typologieListe );
	}

	// ##################
	function select_all_typologie() {
		$result = mysqli_query ($_SESSION['LINK'], "SELECT TypologieID, AnnuaireID, Libelle FROM annuaire_lva_typologie WHERE AnnuaireID='" . $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] . "' ORDER BY Libelle" ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aTypologie = new Typologie ();

			$aTypologie->setID ( $line [0] );
			$aTypologie->setName ( $line [2] );

			$aAnnuaire = new Annuaire ();
			$aAnnuaire->select_annuaire ( $line [1] );
			$aTypologie->setAnnuaire ( $aAnnuaire );

			$this->typologieListe [] = $aTypologie;
		}

		mysqli_free_result  ( $result );
	}
}
?>