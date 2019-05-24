<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage lva
 * @version 1.0.4
 */
class GroupeEtablissementListe {
	private $groupeEtablissementListe;

	function __construct()
	{
		$this->groupeEtablissementListe = array ();
	}
	function GroupeEtablissementListe() {
		self::__construct();
	}
	
	// #################
	function addGroupeEtablissement($aGroupeEtablissement) {
		$this->groupeEtablissementListe [] = $aGroupeEtablissement;
	}
	function removeGroupeEtablissement($i) {
		unset ( $this->groupeEtablissementListe [$i] );
	}
	function getGroupeEtablissementListe() {
		return $this->groupeEtablissementListe;
	}
	function setGroupeEtablissementListe($newValue) {
		$this->groupeEtablissementListe = $newValue;
	}
	function getNbGroupeEtablissement() {
		return count ( $this->groupeEtablissementListe );
	}

	// ##################
	function select_all_groupeetablissement() {
		$result = mysqli_query ($_SESSION['LINK'], "SELECT GroupeID, AnnuaireID, Libelle FROM annuaire_lva_groupe_etablissement WHERE AnnuaireID='" . $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] . "' ORDER BY Libelle" ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aGroupeEtablissement = new GroupeEtablissement ();

			$aGroupeEtablissement->setID ( $line [0] );
			$aGroupeEtablissement->setName ( $line [2] );

			$aAnnuaire = new Annuaire ();
			$aAnnuaire->select_annuaire ( $line [1] );
			$aGroupeEtablissement->setAnnuaire ( $aAnnuaire );

			$this->groupeEtablissementListe [] = $aGroupeEtablissement;
		}

		mysqli_free_result  ( $result );
	}
}
?>