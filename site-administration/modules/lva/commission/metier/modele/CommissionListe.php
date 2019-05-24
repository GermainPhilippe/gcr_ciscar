<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage lva
 * @version 1.0.4
 */
class CommissionListe {
	private $commissionListe;

	function __construct()
	{
		$this->commissionListe = array ();
	}
	function CommissionListe() {
		self::__construct();
	}
	
	// #################
	function addCommission($aCommission) {
		$this->commissionListe [] = $aCommission;
	}
	function removeCommission($i) {
		unset ( $this->commissionListe [$i] );
	}
	function getCommissionListe() {
		return $this->commissionListe;
	}
	function setCommissionListe($newValue) {
		$this->commissionListe = $newValue;
	}
	function getNbCommission() {
		return count ( $this->commissionListe );
	}

	// ##################
	function select_all_commission() {
		$result = mysqli_query ($_SESSION['LINK'], "SELECT CommissionID, ParentID, AnnuaireID, Libelle, Description, TypeCommissionID FROM annuaire_lva_commission WHERE AnnuaireID='" . $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] . "' ORDER BY Libelle" ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$modele = new Commission ();

			$modele->setID ( $line [0] );

			$aCommission = new Commission ();
			$aCommission->select_commission ( $line [1] );
			$modele->setCommissionParent ( $aCommission );

			$aAnnuaire = new Annuaire ();
			$aAnnuaire->select_annuaire ( $line [2] );
			$modele->setAnnuaire ( $aAnnuaire );

			$modele->setName ( $line [3] );
			$modele->setDescription ( $line [4] );

			$aTypeCommission = new TypeCommission ();
			$aTypeCommission->select_typecommission ( $line [5] );
			$modele->setTypeCommission ( $aTypeCommission );

			$this->commissionListe [] = $modele;
		}

		mysqli_free_result  ( $result );
	}
	function select_all_commission_ParType($Type) {
		$result = mysqli_query ($_SESSION['LINK'], "SELECT CommissionID, ParentID, AnnuaireID, Libelle, Description, TypeCommissionID  FROM annuaire_lva_commission WHERE AnnuaireID='" . $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] . "' and TypeCommissionID='" . $Type . "'" ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$modele = new Commission ();

			$modele->setID ( $line [0] );

			$aCommission = new Commission ();
			$aCommission->select_commission ( $line [1] );
			$modele->setCommissionParent ( $aCommission );

			$aAnnuaire = new Annuaire ();
			$aAnnuaire->select_annuaire ( $line [2] );
			$modele->setAnnuaire ( $aAnnuaire );

			$modele->setName ( $line [3] );
			$modele->setDescription ( $line [4] );

			$aTypeCommission = new TypeCommission ();
			$aTypeCommission->select_typecommission ( $line [5] );
			$modele->setTypeCommission ( $aTypeCommission );

			$this->commissionListe [] = $modele;
		}

		mysqli_free_result  ( $result );
	}
	function select_all_commission_selected($individuID) {
		$result = mysqli_query ($_SESSION['LINK'], "SELECT CommissionID FROM annuaire_individucommission WHERE IndividuID='" . $individuID . "'" ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$modele = new Commission ();
			$modele->select_commission ( $line [0] );

			$this->commissionListe [] = $modele;
		}

		mysqli_free_result  ( $result );
	}
}
?>