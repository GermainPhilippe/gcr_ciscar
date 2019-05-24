<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage individu
 * @version 1.0.4
 */
class IndividuFonctionBN {
	private $myIndividuID;
	private $myFonctionBNID;
	private $myNomIndividu;
	private $myPrenomIndividu;
	private $myMailIndividu;
	public function __construct() {
		$this->myIndividuID = NULL;
		$this->myFonctionBNID = NULL;
		$this->myNomIndividu = '';
		$this->myPrenomIndividu = '';
		$this->myMailIndividu = '';
	}
	public function getFonctionBNID() {
		return $this->myFonctionBNID;
	}
	public function getIndividuID() {
		return $this->myIndividuID;
	}
	public function getNomIndividu() {
		return $this->myNomIndividu;
	}
	public function getPrenomIndividu() {
		return $this->myPrenomIndividu;
	}
	public function getMailIndividu() {
		return $this->myMailIndividu;
	}
	public function setFonctionBNID($newValue) {
		$this->myFonctionBNID = $newValue;
	}
	public function setIndividuID($newValue) {
		$this->myIndividuID = $newValue;
	}
	public function setNomIndividu($newValue) {
		$this->myNomIndividu = $newValue;
	}
	public function setPrenomIndividu($newValue) {
		$this->myPrenomIndividu = $newValue;
	}
	public function setMailIndividu($newValue) {
		$this->myMailIndividu = $newValue;
	}

	// ###
	public function SQL_REMOVE_ALL() {
		$sql = "DELETE FROM annuaire_individufonctionbn WHERE IndividuID='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $this->myIndividuID ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function SQL_CREATE() {
		$sql = "INSERT INTO annuaire_individufonctionbn (FonctionBNID, IndividuID)";
		$sql .= " VALUES('%s','%s')";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $this->myFonctionBNID ), mysqli_real_escape_string ($_SESSION['LINK'], $this->myIndividuID ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function SQL_UPDATE() {
	}
	public function SQL_DELETE() {
	}
}
?>