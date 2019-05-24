<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage lca
 * @version 1.0.4
 */
class GroupeLCA {
	private $id;
	private $name;
	private $obj_parent;
	private $obj_site;
	private $obj_typeGroupe;

	function __construct()
	{
		$this->id = NULL;
		$this->name = '';
		$this->obj_parent = NULL;
		$this->obj_site = NULL;
		$this->obj_typeGroupe = NULL;
	}
	function GroupeLCA() {
		self::__construct();
	}
	
	// ###################
	function getID() {
		return $this->id;
	}
	function getName() {
		return $this->name;
	}
	function getParent() {
		return $this->obj_parent;
	}
	function getSite() {
		return $this->obj_site;
	}
	function getTypeGroupe() {
		return $this->obj_typeGroupe;
	}
	function setID($newValue) {
		$this->id = $newValue;
	}
	function setName($newValue) {
		$this->name = $newValue;
	}
	function setParent($newValue) {
		$this->obj_parent = $newValue;
	}
	function setSite($newValue) {
		$this->obj_site = $newValue;
	}
	function setTypeGroupe($newValue) {
		$this->obj_typeGroupe = $newValue;
	}

	// ###################
	function create_groupelca() {
		$sql = "INSERT INTO annuaire_lca_groupe VALUES(NULL,'%s','%s'";
		$sql .= ($this->obj_site == NULL || $this->obj_site->getID () == NULL) ? ',NULL' : ',' . $this->obj_site->getID ();
		$sql .= ($this->obj_parent == NULL || $this->obj_parent->getID () == NULL) ? ',NULL' : ',' . $this->obj_site->getID ();

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $this->obj_typeGroupe->getID () ), mysqli_real_escape_string ($_SESSION['LINK'], $this->name ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	function groupe_addmember($individuID) {
		$query = sprintf ( "INSERT INTO annuaire_lca_groupeindividu VALUES('%s','%s')", mysqli_real_escape_string ($_SESSION['LINK'], $this->getID () ), mysqli_real_escape_string ($_SESSION['LINK'], $individuID ) );
		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	function groupe_removemember($individuID) {
		$query = sprintf ( "DELETE FROM annuaire_lca_groupeindividu WHERE GroupeID='%s' and IndividuID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $this->getID () ), mysqli_real_escape_string ($_SESSION['LINK'], $individuID ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
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

			$aGroupeLCA = new GroupeLCA ();
			$aGroupeLCA->select_groupelca ( $line [4] );
			$this->setParent ( $aGroupeLCA );
		} else {
			$this->id = NULL;
			$this->name = '';
			$this->obj_parent = NULL;
			$this->obj_site = NULL;
			$this->obj_typeGroupe = NULL;
		}

		mysqli_free_result  ( $result );
	}
}

?>