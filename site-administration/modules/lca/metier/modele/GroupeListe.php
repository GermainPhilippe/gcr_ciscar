<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage lca
 * @version 1.0.4
 */
class GroupeListe {
	private $groupeListe;
	
	function __construct()
	{
		$this->groupeListe = array ();
	}
	function GroupeListe() {
		self::__construct();
	}

	// #################
	function addGroupe($aGroupe) {
		$this->groupeListe [] = $aGroupe;
	}
	function removeGroupe($i) {
		unset ( $this->groupeListe [$i] );
	}
	function getGroupeListe() {
		return $this->groupeListe;
	}
	function setGroupeListe($newValue) {
		$this->groupeListe = $newValue;
	}
	function getNbGroupe() {
		return count ( $this->groupeListe );
	}

	// ###################
	function select_all_groupe_systeme() {
		$result = mysqli_query ($_SESSION['LINK'], "SELECT GroupeID, TypeGroupeID, Libelle, SiteID, ParentID FROM annuaire_lca_groupe WHERE TypeGroupeID='1'" ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aGroupeLCA = new GroupeLCA ();

			$aGroupeLCA->setID ( $line [0] );
			$aGroupeLCA->setName ( $line [2] );

			$aTypeGroupe = new TypeGroupe ();
			$aTypeGroupe->select_typegroupe ( $line [1] );
			$aGroupeLCA->setTypeGroupe ( $aTypeGroupe );

			$aSite = new Site ();
			$aSite->select_site ( $line [3] );
			$aGroupeLCA->setSite ( $aSite );

			$aGroupeLCAParent = new GroupeLCA ();
			$aGroupeLCAParent->select_groupelca ( $line [4] );
			$aGroupeLCA->setParent ( $aGroupeLCAParent );

			$this->groupeListe [] = $aGroupeLCA;
		}

		mysqli_free_result  ( $result );
	}
	function select_all_groupe() {
		$result = mysqli_query ($_SESSION['LINK'], "SELECT GroupeID, TypeGroupeID, Libelle, SiteID, ParentID FROM annuaire_lca_groupe" ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aGroupeLCA = new GroupeLCA ();

			$aGroupeLCA->setID ( $line [0] );
			$aGroupeLCA->setName ( $line [2] );

			$aTypeGroupe = new TypeGroupe ();
			$aTypeGroupe->select_typegroupe ( $line [1] );
			$aGroupeLCA->setTypeGroupe ( $aTypeGroupe );

			$aSite = new Site ();
			$aSite->select_site ( $line [3] );
			$aGroupeLCA->setSite ( $aSite );

			$aGroupeLCAParent = new GroupeLCA ();
			$aGroupeLCAParent->select_groupelca ( $line [4] );
			$aGroupeLCA->setParent ( $aGroupeLCAParent );

			$this->groupeListe [] = $aGroupeLCA;
		}

		mysqli_free_result  ( $result );
	}
}

?>