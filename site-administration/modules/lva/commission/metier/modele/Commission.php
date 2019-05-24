<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage lva
 * @version 1.0.4
 */
class Commission {
	private $id;
	private $name;
	private $description;
	private $obj_commissionParent;
	private $obj_annuaire;
	private $obj_typeCommission;

	function __construct()
	{
		$this->id = NULL;
		$this->name = '';
		$this->description = '';
		$this->obj_commissionParent = NULL;
		$this->obj_annuaire = NULL;
		$this->obj_typeCommission = NULL;
	}
	function Commission() {
		self::__construct();
	}
	
	// ################
	function getID() {
		return $this->id;
	}
	function getName() {
		return $this->name;
	}
	function getDescription() {
		return $this->description;
	}
	function getCommissionParent() {
		return $this->obj_commissionParent;
	}
	function getAnnuaire() {
		return $this->obj_annuaire;
	}
	function getTypeCommission() {
		return $this->obj_typeCommission;
	}
	function setID($newValue) {
		$this->id = $newValue;
	}
	function setName($newValue) {
		$this->name = $newValue;
	}
	function setDescription($newValue) {
		$this->description = $newValue;
	}
	function setCommissionParent($newValue) {
		$this->obj_commissionParent = $newValue;
	}
	function setAnnuaire($newValue) {
		$this->obj_annuaire = $newValue;
	}
	function setTypeCommission($newValue) {
		$this->obj_typeCommission = $newValue;
	}

	// ################
	function create_commission() {
		$tmp = $this->obj_typeCommission->getID ();
		if ($tmp != 2) {
			$query = sprintf ( "INSERT INTO annuaire_lva_commission VALUES(NULL,NULL,'%s','%s','%s','%s',NULL)", mysqli_real_escape_string ($_SESSION['LINK'], ! is_null ( $this->obj_annuaire ) ? $this->obj_annuaire->getID () : NULL ), mysqli_real_escape_string ($_SESSION['LINK'], $this->name ), mysqli_real_escape_string ($_SESSION['LINK'], $this->description ), mysqli_real_escape_string ($_SESSION['LINK'], ! is_null ( $this->obj_typeCommission ) ? $this->obj_typeCommission->getID () : NULL ) );
		} else {
			$query = sprintf ( "INSERT INTO annuaire_lva_commission VALUES(NULL,'%s','%s','%s','%s','%s',NULL)", mysqli_real_escape_string ($_SESSION['LINK'], ! is_null ( $this->obj_commissionParent ) ? $this->obj_commissionParent->getID () : NULL ), mysqli_real_escape_string ($_SESSION['LINK'], ! is_null ( $this->obj_annuaire ) ? $this->obj_annuaire->getID () : NULL ), mysqli_real_escape_string ($_SESSION['LINK'], $this->name ), mysqli_real_escape_string ($_SESSION['LINK'], $this->description ), mysqli_real_escape_string ($_SESSION['LINK'], ! is_null ( $this->obj_typeCommission ) ? $this->obj_typeCommission->getID () : NULL ) );
		}

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	function update_commission() {
		$tmp = $this->obj_typeCommission->getID ();
		if ($tmp != 2) {
			$query = sprintf ( "UPDATE annuaire_lva_commission SET ParentID=NULL, Libelle='%s', Description='%s', TypeCommissionID='%s' WHERE CommissionID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $this->name ), mysqli_real_escape_string ($_SESSION['LINK'], $this->description ), mysqli_real_escape_string ($_SESSION['LINK'], ! is_null ( $this->obj_typeCommission ) ? $this->obj_typeCommission->getID () : NULL ), mysqli_real_escape_string ($_SESSION['LINK'], $this->id ) );
		} else {
			$query = sprintf ( "UPDATE annuaire_lva_commission SET ParentID='%s', Libelle='%s', Description='%s', TypeCommissionID='%s' WHERE CommissionID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], ! is_null ( $this->obj_commissionParent ) ? $this->obj_commissionParent->getID () : NULL ), mysqli_real_escape_string ($_SESSION['LINK'], $this->name ), mysqli_real_escape_string ($_SESSION['LINK'], $this->description ), mysqli_real_escape_string ($_SESSION['LINK'], ! is_null ( $this->obj_typeCommission ) ? $this->obj_typeCommission->getID () : NULL ), mysqli_real_escape_string ($_SESSION['LINK'], $this->id ) );
		}
		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	function remove_commission() {
		$query = sprintf ( "DELETE FROM annuaire_lva_commission WHERE CommissionID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $this->id ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	function select_commission($CommissionID) {
		$query = sprintf ( "SELECT CommissionID, ParentID, AnnuaireID, Libelle, Description, TypeCommissionID FROM annuaire_lva_commission WHERE CommissionID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $CommissionID ) );
		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array  ( $result );
			$this->setID ( $line [0] );

			$aCommission = new Commission ();
			$aCommission->select_commission ( $line [1] );
			$this->setCommissionParent ( $aCommission );

			$aAnnuaire = new Annuaire ();
			$aAnnuaire->select_annuaire ( $line [2] );
			$this->setAnnuaire ( $aAnnuaire );

			$this->setName ( $line [3] );
			$this->setDescription ( $line [4] );

			$aTypeCommission = new TypeCommission ();
			$aTypeCommission->select_typecommission ( $line [5] );
			$this->setTypeCommission ( $aTypeCommission );
		} else {
			$this->id = NULL;
			$this->name = '';
			$this->description = '';
			$this->obj_commissionParent = NULL;
			$this->obj_annuaire = NULL;
			$this->obj_typeCommission = NULL;
		}

		mysqli_free_result  ( $result );
	}
}

?>