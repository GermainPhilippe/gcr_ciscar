<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage lca
 * @version 1.0.4
 */
class SiteGroupeLCA {
	private $id;
	private $name;
	private $obj_parentGroupe;
	private $obj_typeGroupe;
	private $obj_site;
	
	public function SiteGroupeLCA()
	{
		self::__construct();
	}
	public function __construct() {
		$this->id = NULL;
		$this->name = '';
		$this->obj_typeGroupe = NULL;
		$this->obj_parentGroupe = NULL;
		$this->obj_site = NULL;
	}

	// #############
	function getID() {
		return $this->id;
	}
	function getName() {
		return $this->name;
	}
	function getParentGroupe() {
		return $this->obj_parentGroupe;
	}
	function getTypeGroupe() {
		return $this->obj_typeGroupe;
	}
	function getSite() {
		return $this->obj_site;
	}
	function setID($newValue) {
		$this->id = $newValue;
	}
	function setName($newValue) {
		$this->name = $newValue;
	}
	function setParentGroupe($newValue) {
		$this->obj_parentGroupe = $newValue;
	}
	function setTypeGroupe($newValue) {
		$this->obj_typeGroupe = $newValue;
	}
	function setSite($newValue) {
		$this->obj_site = $newValue;
	}

	// #############
	function select_groupelca($GroupeLCAID) {
		$query = sprintf ( "SELECT GroupeID, TypeGroupeID, Libelle, SiteID, ParentID FROM annuaire_lca_groupe WHERE GroupeID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $GroupeLCAID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array  ( $result );

			$this->setID ( $line [0] );
			$this->setName ( $line [2] );

			$aTypeGroupe = new TypeGroupe ();
			$aTypeGroupe->select_typegroupe ( $line [1] );
			$this->setTypeGroupe ( $aTypeGroupe );

			$aSite = new Site ();
			$aSite->select_site ( $line [3] );
			$this->setSite ( $aSite );

			$aParentGroupe = new SiteGroupeLCA ();
			$aParentGroupe->select_groupelca ( $line [4] );
			$this->setParentGroupe ( $aParentGroupe );
		} else {
			$this->id = NULL;
			$this->name = '';
			$this->obj_typeGroupe = NULL;
			$this->obj_parentGroupe = NULL;
			$this->obj_site = NULL;
		}

		mysqli_free_result  ( $result );
	}
	function groupe_addmember($individuID) {
		$query = sprintf ( "INSERT INTO annuaire_lca_groupeindividu VALUES('%s','%s')", mysqli_real_escape_string ($_SESSION['LINK'], $this->getID () ), mysqli_real_escape_string ($_SESSION['LINK'], $individuID ) );
		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	function groupe_removemember($individuID) {
		$query = sprintf ( "DELETE FROM annuaire_lca_groupeindividu WHERE GroupeID='%s' and IndividuID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $this->getID () ), mysqli_real_escape_string ($_SESSION['LINK'], $individuID ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
}

?>