<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage individu
 * @version 1.0.4
 */
class TypeMembreBNListe {
	private $typeMembreBNListe;

	function __construct()
	{
		$this->typeMembreBNListe = array ();
	}
	function TypeMembreBNListe() {
		self::__construct();
	}
	
	// #################
	function addTypeMembreBN($aTypeMembreBN) {
		$this->typeMembreBNListe [] = $aTypeMembreBN;
	}
	function removeTypeMembreBN($i) {
		unset ( $this->typeMembreBNListe [$i] );
	}
	function getTypeMembreBNListe() {
		return $this->typeMembreBNListe;
	}
	function setTypeMembreBNListe($newValue) {
		$this->typeMembreBNListe = $newValue;
	}
	function getNbTypeMembreBN() {
		return count ( $this->typeMembreBNListe );
	}

	// ##################
	function select_all_typemembrebn() {
		$result = mysqli_query ($_SESSION['LINK'], "SELECT TypeMembreBNID,Libelle FROM annuaire_lva_typemembrebn" ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aMarque = new TypeMembreBN ();

			$aMarque->setID ( $line [0] );
			$aMarque->setName ( $line [1] );

			$this->typeMembreBNListe [] = $aMarque;
		}

		mysqli_free_result  ( $result );
	}
}
?>