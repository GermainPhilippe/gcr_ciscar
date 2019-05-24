<?php
/**
 * @author Florent DESPIERRES
 * @package app-convention
 * @subpackage Convention
 * @version 1.0.4
 */
class ConventionHistorique {
	private $ID;
	private $DateAction;
	private $Description;
	private $ConventionID;
	public function __construct() {
	}

	// ###
	public function getID() {
		return $this->ID;
	}
	public function getDateAction() {
		return $this->DateAction;
	}
	public function getDescription() {
		return $this->Description;
	}
	public function getConventionID() {
		return $this->ConventionID;
	}
	public function setID($newValue) {
		$this->ID = $newValue;
	}
	public function setDateAction($newValue) {
		$this->DateAction = $newValue;
	}
	public function setDescription($newValue) {
		$this->Description = $newValue;
	}
	public function setConventionID($newValue) {
		$this->ConventionID = $newValue;
	}

	// ###
	public function SQL_CREATE() {
		$sql = "INSERT INTO conv_convention_historique (HistoriqueID, DateAction, Description, ConventionID)";
		$sql .= " VALUES(NULL, date(now()),'%s', '%s')";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $this->Description ), mysqli_real_escape_string ($_SESSION['LINK'], $this->ConventionID ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
}
?>