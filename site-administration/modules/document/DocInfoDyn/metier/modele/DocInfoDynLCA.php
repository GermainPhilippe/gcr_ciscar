<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage document
 * @version 1.0.4
 */
class DocInfoDynLCA {
	private $DocInfoDynID;
	private $LCAGroupeID;
	public function __construct() {
		$this->DocInfoDynID = NULL;
		$this->LCAGroupeID = NULL;
	}

	// ###
	public function getDocInfoDynID() {
		return $this->DocInfoDynID;
	}
	public function getLCAGroupeID() {
		return $this->LCAGroupeID;
	}
	public function setDocInfoDynID($newValue) {
		$this->DocInfoDynID = $newValue;
	}
	public function setLCAGroupeID($newValue) {
		$this->LCAGroupeID = $newValue;
	}

	// ###
	public function SQL_create() {
		$sql = "INSERT INTO wcm_document_infodyn_lca (DocInfoDynID, LCAGroupeID)";
		$sql .= " VALUES(";
		$sql .= is_null ( $this->DocInfoDynID ) ? "NULL" : "'" . $this->DocInfoDynID . "'";
		$sql .= is_null ( $this->LCAGroupeID ) ? ",NULL" : ",'" . $this->LCAGroupeID . "'";
		$sql .= ")";

		mysqli_query ($_SESSION['LINK'], $sql ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function SQL_delete() {
		$sql = "DELETE FROM wcm_document_infodyn_lca WHERE ";
		$sql .= is_null ( $this->DocInfoDynID ) ? "DocInfoDynID=NULL" : "DocInfoDynID='" . $this->DocInfoDynID . "'";
		$sql .= is_null ( $this->LCAGroupeID ) ? " AND LCAGroupeID=NULL" : " AND LCAGroupeID='" . $this->LCAGroupeID . "'";

		mysqli_query ($_SESSION['LINK'], $sql ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
}
?>