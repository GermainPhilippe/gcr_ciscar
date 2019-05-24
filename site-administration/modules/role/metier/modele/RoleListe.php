<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage role
 * @version 1.0.4
 */
class RoleListe {
	private $roleListe;

	function __construct()
	{
		$this->roleListe = array ();
	}
	function RoleListe() {
		self::__construct();
	}

	// #################
	function addRole($aRole) {
		$this->roleListe [] = $aRole;
	}
	function removeRole($i) {
		unset ( $this->roleListe [$i] );
	}
	function getRoleListe() {
		return $this->roleListe;
	}
	function setRoleListe($newValue) {
		$this->roleListe = $newValue;
	}
	function getNbRole() {
		return count ( $this->roleListe );
	}

	// ###################
	function select_all_role() {
		$result = mysqli_query ($_SESSION['LINK'], "SELECT RoleID,IndividuID,EtablissementID,AnnuaireID FROM annuaire_role WHERE AnnuaireID='" . $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] . "'" ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aRole = new Role ();
			$aRole->setID ( $line [0] );

			$aIndividu = new Individu ();
			$aIndividu->select_individu ( $line [1] );
			$aRole->setIndividu ( $aIndividu );

			$aEtablissement = new Etablissement ();
			$aEtablissement->select_etablissement ( $line [2] );
			$aRole->setEtablissement ( $aEtablissement );

			$aAnnuaire = new Annuaire ();
			$aAnnuaire->select_annuaire ( $line [3] );
			$aRole->setAnnuaire ( $aAnnuaire );

			$this->roleListe [] = $aRole;
		}

		mysqli_free_result  ( $result );
	}
	function select_all_role_paginer($page, $pas) {
		// on regarde si on a demandé un tri particulier sinon requete par défaut
		if (isset ( $_GET ['tri'] )) {
			$sql = "SELECT RoleID,IndividuID,EtablissementID,AnnuaireID FROM annuaire_role WHERE AnnuaireID='" . $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] . "'ORDER BY ";
			$sql .= $_GET ['tri'];
			$sql .= ' ' . $_GET ['ordre'];
			$sql .= " LIMIT " . (($page - 1) * $pas) . " , " . $pas . "";
			$result = mysqli_query ($_SESSION['LINK'], $sql );
		} 
		else {
			$result = mysqli_query ($_SESSION['LINK'], "SELECT RoleID,IndividuID,EtablissementID,AnnuaireID FROM annuaire_role WHERE AnnuaireID='" . $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] . "' LIMIT " . (($page - 1) * $pas) . " , " . $pas . "" ) or die ( mysqli_error ($_SESSION['LINK']) );
		}

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aRole = new Role ();
			$aRole->setID ( $line [0] );

			$aIndividu = new Individu ();
			$aIndividu->select_individu ( $line [1] );
			$aRole->setIndividu ( $aIndividu );

			$aEtablissement = new Etablissement ();
			$aEtablissement->select_etablissement ( $line [2] );
			$aRole->setEtablissement ( $aEtablissement );

			$aAnnuaire = new Annuaire ();
			$aAnnuaire->select_annuaire ( $line [3] );
			$aRole->setAnnuaire ( $aAnnuaire );

			$this->roleListe [] = $aRole;
		}

		mysqli_free_result  ( $result );
	}
}
?>