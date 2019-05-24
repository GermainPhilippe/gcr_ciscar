<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage parametre
 * @version 1.0.4
 */
class Param {
	private $id;
	private $name;
	private $valeur;
	private $siteID;
	function __construct() {
		$this->id = NULL;
		$this->name = '';
		$this->valeur = '';
		$this->siteID = NULL;
	}

	// #######################
	function getID() {
		return $this->id;
	}
	function getName() {
		return $this->name;
	}
	function getValue() {
		return $this->valeur;
	}
	function getSiteID() {
		return $this->siteID;
	}
	function setID($newValue) {
		$this->id = $newValue;
	}
	function setName($newValue) {
		$this->name = $newValue;
	}
	function setValue($newValue) {
		$this->valeur = $newValue;
	}
	function setSiteID($newValue) {
		$this->siteID = $newValue;
	}

	// #######################
	function create_param() {
		$sql = "INSERT INTO annuaire_parametre (ParamID, Nom, Valeur, SiteID)";
		$sql .= " VALUES(NULL, '%s', '%s'";
		$sql .= is_null ( $this->siteID ) ? ", NULL)" : ", '%s')";

		if (is_null ( $this->siteID )) {
			$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $this->name ), mysqli_real_escape_string ($_SESSION['LINK'], $this->valeur ) );
		} else {
			$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $this->name ), mysqli_real_escape_string ($_SESSION['LINK'], $this->valeur ), mysqli_real_escape_string ($_SESSION['LINK'], $this->siteID ) );
		}

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	function update_param() {
		$sql = "UPDATE annuaire_parametre SET Nom='%s', Valeur='%s'";
		$sql .= is_null ( $this->siteID ) ? ", SiteID=NULL" : ", SiteID='%s'";
		$sql .= " WHERE ParamID='%s'";
		if (is_null ( $this->siteID )) {
			$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $this->name ), mysqli_real_escape_string ($_SESSION['LINK'], $this->valeur ), mysqli_real_escape_string ($_SESSION['LINK'], $this->id ) );
		} else {
			$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $this->name ), mysqli_real_escape_string ($_SESSION['LINK'], $this->valeur ), mysqli_real_escape_string ($_SESSION['LINK'], $this->siteID ), mysqli_real_escape_string ($_SESSION['LINK'], $this->id ) );
		}

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	function remove_param() {
		$query = sprintf ( "DELETE FROM annuaire_parametre WHERE ParamID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $this->id ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	function select_param($confID) {
		$query = sprintf ( "SELECT ParamID, Nom, Valeur, SiteID FROM annuaire_parametre WHERE ParamID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $confID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array  ( $result );
			$this->setID ( $line [0] );
			$this->setName ( $line [1] );
			$this->setValue ( $line [2] );
			$this->setSiteID ( $line [3] );
		} else {
			$this->__construct ();
		}

		mysqli_free_result  ( $result );
	}
	function search_param($ParamName) {
		$query = sprintf ( "SELECT ParamID, Nom, Valeur, SiteID FROM annuaire_parametre WHERE Nom='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $ParamName ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		if (mysqli_num_rows ( $result ) > 0) {
			$line = mysqli_fetch_array  ( $result );
			$this->setID ( $line [0] );
			$this->setName ( $line [1] );
			$this->setValue ( $line [2] );
			$this->setSiteID ( $line [3] );
		} else {
			$this->__construct ();
		}

		mysqli_free_result  ( $result );
	}
}
?>