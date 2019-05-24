<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage lva
 * @version 1.0.4
 */
class NatureListe {
	private $NatureListe;

	function __construct()
	{
		$this->NatureListe = array ();
	}
	function NatureListe() {
		self::__construct();
	}
	
	// #################
	function addNature($aNature) {
		$this->NatureListe [] = $aNature;
	}
	function removeNature($i) {
		unset ( $this->NatureListe [$i] );
	}
	function getNatureListe() {
		return $this->NatureListe;
	}
	function setNatureListe($newValue) {
		$this->NatureListe = $newValue;
	}
	function getNbNature() {
		return count ( $this->NatureListe );
	}

	// ##################
	function select_all_Nature() {
		$result = mysqli_query ($_SESSION['LINK'], "SELECT NatureID, AnnuaireID, Libelle FROM annuaire_lva_nature WHERE AnnuaireID='" . $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] . "' ORDER BY Libelle" ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aNature = new Nature ();

			$aNature->setID ( $line [0] );
			$aNature->setName ( $line [2] );

			$aAnnuaire = new Annuaire ();
			$aAnnuaire->select_annuaire ( $line [1] );
			$aNature->setAnnuaire ( $aAnnuaire );

			$this->NatureListe [] = $aNature;
		}

		mysqli_free_result  ( $result );
	}
}
?>