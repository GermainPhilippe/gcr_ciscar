<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage individu
 * @version 1.0.4
 */
class CommissionIndividu {
	private $obj_commission;
	private $obj_individu;
	private $obj_fonctionCommission;

	function __construct()
	{
		$this->obj_commission = NULL;
		$this->obj_individu = NULL;
		$this->obj_fonctionCommission = NULL;
	}
	function CommissionIndividu() {
		self::__construct();
	}

	// ##################
	function getCommission() {
		return $this->obj_commission;
	}
	function getIndividu() {
		return $this->obj_individu;
	}
	function getFonctionCommission() {
		return $this->obj_fonctionCommission;
	}
	function setCommission($newValue) {
		$this->obj_commission = $newValue;
	}
	function setIndividu($newValue) {
		$this->obj_individu = $newValue;
	}
	function setFonctionCommission($newValue) {
		$this->obj_fonctionCommission = $newValue;
	}

	// ##################
	function create_commissionindividu() {
		$query = sprintf ( "INSERT INTO annuaire_individucommission VALUES('%s','%s','%s')", mysqli_real_escape_string ($_SESSION['LINK'], $this->obj_commission->getID () ), mysqli_real_escape_string ($_SESSION['LINK'], $this->obj_individu->getID () ), mysqli_real_escape_string ($_SESSION['LINK'], $this->obj_fonctionCommission->getID () ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	function remove_commissionindividu() {
		$query = sprintf ( "DELETE FROM annuaire_individucommission WHERE IndividuID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $this->obj_individu->getID () ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	function select_commissionindividu($IndividuID, $CommissionID) {
		$query = sprintf ( "SELECT CommissionID, IndividuID, FonctionCommissionID FROM annuaire_individucommission WHERE CommissionID='%s' and IndividuID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $IndividuID ), mysqli_real_escape_string ($_SESSION['LINK'], $CommissionID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array  ( $result );

			$aCommission = new Commission ();
			$aCommission->select_commission ( $line [0] );
			$this->setCommission ( $aCommission );

			$aIndividu = new Individu ();
			$aIndividu->select_individu ( $line [1] );
			$this->setIndividu ( $aIndividu );

			$aFonctionCommission = new FonctionCommission ();
			$aFonctionCommission->select_fonctioncommission ( $line [2] );
			$this->setAnnuaire ( $aFonctionCommission );
		} else {
			$this->obj_commission = NULL;
			$this->obj_individu = NULL;
			$this->obj_fonctionCommission = NULL;
		}

		mysqli_free_result  ( $result );
	}
}
?>