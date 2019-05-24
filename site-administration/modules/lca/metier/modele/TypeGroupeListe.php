<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage lca
 * @version 1.0.4
 */
class TypeGroupeListe {
	private $typeGroupeListe;

	function __construct()
	{
		$this->typeGroupeListe = array ();
	}
	function TypeGroupeListe() {
		self::__construct();
	}
	
	// #################
	function addTypeGroupe($aTypeGroupe) {
		$this->typeGroupeListe [] = $aTypeGroupe;
	}
	function removeTypeGroupe($i) {
		unset ( $this->typeGroupeListe [$i] );
	}
	function getTypeGroupeListe() {
		return $this->typeGroupeListe;
	}
	function setTypeGroupeListe($newValue) {
		$this->typeGroupeListe = $newValue;
	}
	function getNbTypeGroupe() {
		return count ( $this->typeGroupeListe );
	}

	// ###################
	function select_all_typegroupe() {
		$result = mysqli_query ($_SESSION['LINK'], "SELECT TypeGroupeID,Libelle FROM annuaire_lca_typegroupe" ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aRole = new TypeGroupe ();
			$aRole->setID ( $line [0] );
			$aRole->setName ( $line [1] );

			$this->typeGroupeListe [] = $aRole;
		}

		mysqli_free_result  ( $result );
	}
}

?>