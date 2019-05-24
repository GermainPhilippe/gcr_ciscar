<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage lva
 * @version 1.0.4
 */
class TypeCommissionListe {
	private $typeCommissionListe;

	function __construct()
	{
		$this->typeCommissionListe = array ();
	}
	function TypeCommissionListe() {
		self::__construct();
	}
	
	// #################
	function addTypeCommission($aTypeCommission) {
		$this->typeCommissionListe [] = $aTypeCommission;
	}
	function removeTypeCommission($i) {
		unset ( $this->typeCommissionListe [$i] );
	}
	function getTypeCommissionListe() {
		return $this->typeCommissionListe;
	}
	function setTypeCommissionListe($newValue) {
		$this->typeCommissionListe = $newValue;
	}
	function getNbTypeCommission() {
		return count ( $this->typeCommissionListe );
	}

	// ##################
	function select_all_typecommission() {
		$result = mysqli_query ($_SESSION['LINK'], "SELECT TypeCommissionID, Libelle FROM annuaire_lva_typecommission" ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aTypeCommission = new TypeCommission ();

			$aTypeCommission->setID ( $line [0] );
			$aTypeCommission->setName ( $line [1] );

			$this->typeCommissionListe [] = $aTypeCommission;
		}

		mysqli_free_result  ( $result );
	}
}
?>