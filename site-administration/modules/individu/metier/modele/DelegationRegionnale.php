<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage individu
 * @version 1.0.4
 */
class DelegationRegionnale {
	private $obj_region;
	private $obj_individu;
	private $obj_fonctionDelegation;

	function __construct()
	{
		$this->obj_region = NULL;
		$this->obj_individu = NULL;
		$this->obj_fonctionDelegation = NULL;
	}
	function DelegationRegionnale() {
		self::__construct();
	}
	
	// ####################
	function getRegion() {
		return $this->obj_region;
	}
	function getIndividu() {
		return $this->obj_individu;
	}
	function getFonctionDelegation() {
		return $this->obj_fonctionDelegation;
	}
	function setRegion($newValue) {
		$this->obj_region = $newValue;
	}
	function setIndividu($newValue) {
		$this->obj_individu = $newValue;
	}
	function setFonctionDelegation($newValue) {
		$this->obj_fonctionDelegation = $newValue;
	}

	// ################
	function create_delegationregionnale() {
		$query = sprintf ( "INSERT INTO annuaire_delegationregionale VALUES('%s','%s','%s')", mysqli_real_escape_string ($_SESSION['LINK'], $this->obj_region->getID () ), mysqli_real_escape_string ($_SESSION['LINK'], $this->obj_individu->getID () ), mysqli_real_escape_string ($_SESSION['LINK'], $this->obj_fonctionDelegation->getID () ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	function remove_delegationregionnale() {
		$query = sprintf ( "DELETE FROM annuaire_delegationregionale WHERE IndividuID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $this->obj_individu->getID () ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	function select_delegationregionnale($individuID) {
		$query = sprintf ( "SELECT RegionID, IndividuID, FonctionDelegationID FROM annuaire_delegationregionale WHERE IndividuID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $individuID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array  ( $result );

			$aRegion = new Region ();
			$aRegion->select_region ( $line [0] );
			$this->obj_region = $aRegion;

			$aIndividu = new Individu ();
			$aIndividu->select_individu ( $line [1] );
			$this->obj_individu = $aIndividu;

			$aFonctionDelegation = new FonctionDelegation ();
			$aFonctionDelegation->select_fonctiondelegation ( $line [2] );
			$this->obj_fonctionDelegation = $aFonctionDelegation;
		} else {
			$this->obj_region = NULL;
			$this->obj_individu = NULL;
			$this->obj_fonctionDelegation = NULL;
		}

		mysqli_free_result  ( $result );
	}
}
?>