<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage individu
 * @version 1.0.4
 */
class CommissionIndividuListe {
	private $commissionIndividuListe;

	function __construct()
	{
		$this->commissionIndividuListe = array ();
	}
	function CommissionIndividu() {
		self::__construct();
	}
	
	// #################
	function addCommissionIndividu($aCommissionIndividu) {
		$this->commissionIndividuListe [] = $aCommissionIndividu;
	}
	function removeCommissionIndividu($i) {
		unset ( $this->commissionIndividuListe [$i] );
	}
	function getCommissionIndividuListe() {
		return $this->commissionIndividuListe;
	}
	function setCommissionIndividuListe($newValue) {
		$this->tommissionIndividuListe = $newValue;
	}
	function getNbCommissionIndividu() {
		return count ( $this->commissionIndividuListe );
	}

	// ##################
	function select_all_commissionindividu($individuID) {
		$result = mysqli_query ($_SESSION['LINK'], "SELECT CommissionID, IndividuID, FonctionCommissionID FROM annuaire_individucommission WHERE IndividuID='" . $individuID . "'" ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aCommissionIndividu = new CommissionIndividu ();

			$aCommission = new Commission ();
			$aCommission->select_commission ( $line [0] );
			$aCommissionIndividu->setCommission ( $aCommission );

			$aIndividu = new Individu ();
			$aIndividu->select_individu ( $line [1] );
			$aCommissionIndividu->setIndividu ( $aIndividu );

			$aFonctionCommission = new FonctionCommission ();
			$aFonctionCommission->select_fonctioncommission ( $line [2] );
			$aCommissionIndividu->setFonctionCommission ( $aFonctionCommission );

			$this->commissionIndividuListe [] = $aCommissionIndividu;
		}

		mysqli_free_result  ( $result );
	}
}
?>