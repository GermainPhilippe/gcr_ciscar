<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage individu
 * @version 1.0.4
 */
class TypeCelluleListe {
	private $typeCelluleListe;

	function __construct()
	{
		$this->typeCelluleListe = array ();
	}
	function TypeCelluleListe() {
		self::__construct();
	}

	// #################
	function addTypeCellule($aTypeCellule) {
		$this->typeCelluleListe [] = $aTypeCellule;
	}
	function removeTypeCellule($i) {
		unset ( $this->typeCelluleListe [$i] );
	}
	function getTypeCelluleListe() {
		return $this->typeCelluleListe;
	}
	function setTypeCelluleListe($newValue) {
		$this->typeCelluleListe = $newValue;
	}
	function getNbTypeCellule() {
		return count ( $this->typeCelluleListe );
	}

	// ##################
	function select_all_typecellule() {
		$result = mysqli_query ($_SESSION['LINK'], "SELECT TypeCelluleID,Libelle FROM annuaire_lva_typecelluleprospective" ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aMarque = new TypeCellule ();

			$aMarque->setID ( $line [0] );
			$aMarque->setName ( $line [1] );

			$this->typeCelluleListe [] = $aMarque;
		}

		mysqli_free_result  ( $result );
	}
}
?>