<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage lva
 * @version 1.0.4
 */
class StatutEtablissementListe {
	private $statutEtablissementListe;

	function __construct()
	{
		$this->statutEtablissementListe = array ();
	}
	function StatutEtablissementListe() {
		self::__construct();
	}

	// #################
	function addStatutEtablissement($aStatutEtablissement) {
		$this->statutEtablissementListe [] = $aStatutEtablissement;
	}
	function removeStatutEtablissement($i) {
		unset ( $this->statutEtablissementListe [$i] );
	}
	function getStatutEtablissementListe() {
		return $this->statutEtablissementListe;
	}
	function setStatutEtablissementListe($newValue) {
		$this->statutEtablissementListe = $newValue;
	}
	function getNbStatutEtablissement() {
		return count ( $this->statutEtablissementListe );
	}

	// ##################
	function select_all_statutetablissement() {
		$result = mysqli_query ($_SESSION['LINK'], "SELECT StatutID, AnnuaireID, Libelle FROM annuaire_lva_statut_etablissement WHERE AnnuaireID='" . $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] . "' ORDER BY Libelle" ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aStatutEtablissement = new StatutEtablissement ();

			$aStatutEtablissement->setID ( $line [0] );
			$aStatutEtablissement->setName ( $line [2] );

			$aAnnuaire = new Annuaire ();
			$aAnnuaire->select_annuaire ( $line [1] );
			$aStatutEtablissement->setAnnuaire ( $aAnnuaire );

			$this->statutEtablissementListe [] = $aStatutEtablissement;
		}

		mysqli_free_result  ( $result );
	}
}
?>