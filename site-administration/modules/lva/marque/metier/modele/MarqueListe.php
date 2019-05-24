<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage lva
 * @version 1.0.4
 */
class MarqueListe {
	private $marqueListe;

	function __construct()
	{
		$this->marqueListe = array ();
	}
	function MarqueListe() {
		self::__construct();
	}

	// #################
	function addMarque($aMarque) {
		$this->marqueListe [] = $aMarque;
	}
	function removeMarque($i) {
		unset ( $this->marqueListe [$i] );
	}
	function getMarqueListe() {
		return $this->marqueListe;
	}
	function setmarqueListe($newValue) {
		$this->marqueListe = $newValue;
	}
	function getNbMarque() {
		return count ( $this->marqueListe );
	}

	// ##################
	function select_all_marque() {
		$result = mysqli_query ($_SESSION['LINK'], "SELECT MarqueID, AnnuaireID, Libelle FROM annuaire_lva_marque WHERE AnnuaireID='" . $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] . "' ORDER BY Libelle ASC" ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aMarque = new Marque ();

			$aMarque->setID ( $line [0] );
			$aMarque->setName ( $line [2] );

			$aAnnuaire = new Annuaire ();
			$aAnnuaire->select_annuaire ( $line [1] );
			$aMarque->setAnnuaire ( $aAnnuaire );

			$this->marqueListe [] = $aMarque;
		}

		mysqli_free_result  ( $result );
	}
}
?>