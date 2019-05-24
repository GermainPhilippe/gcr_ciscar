<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage lca
 * @version 1.0.4
 */
class Simple_LCAGroupeMembre {
	private $ID;
	private $Nom;
	private $Prenom;
	private $Mail;
	public function __construct() {
		$this->ID = NULL;
		$this->Nom = '';
		$this->Prenom = '';
		$this->Mail = '';
	}

	// ###
	public function getID() {
		return $this->ID;
	}
	public function getNom() {
		return $this->Nom;
	}
	public function getPrenom() {
		return $this->Prenom;
	}
	public function getMail() {
		return $this->Mail;
	}
	public function setID($newValue) {
		$this->ID = $newValue;
	}
	public function setNom($newValue) {
		$this->Nom = $newValue;
	}
	public function setPrenom($newValue) {
		$this->Prenom = $newValue;
	}
	public function setMail($newValue) {
		$this->Mail = $newValue;
	}

	// ###
	public function SQL_SELECT_IndividuID($aLogin) {
		$results = array ();
		$query = sprintf ( "SELECT IndividuID FROM annuaire_individu WHERE Login='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $aLogin ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$results [] = $line [0];
		}
		mysqli_free_result  ( $result );

		return $results;
	}
	public function SQL_SELECT_IndividuID_By_Email($aEmail) {
		$results = array ();
		$query = sprintf ( "SELECT IndividuID FROM annuaire_individu WHERE AnnuaireID in (1,2) and Mail='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $aEmail ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$results [] = $line [0];
		}
		mysqli_free_result  ( $result );

		return $results;
	}
	public function SQL_SELECT($aID) {
		$query = sprintf ( "SELECT i.IndividuID, i.Nom, i.Prenom FROM annuaire_lca_groupeindividu gi, annuaire_individu i WHERE gi.IndividuID= i.IndividuID AND i.IndividuID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $aID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		if (mysqli_num_rows ( $result ) >= 1) {
			$line = mysqli_fetch_array  ( $result );
			$this->ID = $line [0];
			$this->Nom = $line [1];
			$this->Prenom = $line [2];
		} else {
			$this->__construct ();
		}

		mysqli_free_result  ( $result );
	}
	function SQL_GROUPE_ADD_MEMBER($aGroupeID, $aIndividuID) {
		$query = sprintf ( "INSERT IGNORE INTO annuaire_lca_groupeindividu VALUES('%s','%s')", mysqli_real_escape_string ($_SESSION['LINK'], $aGroupeID ), mysqli_real_escape_string ($_SESSION['LINK'], $aIndividuID ) );
		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	function SQL_GROUPE_REMOVE_MEMBER($aGroupeID, $aIndividuID) {
		$query = sprintf ( "DELETE FROM annuaire_lca_groupeindividu WHERE GroupeID='%s' AND IndividuID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $aGroupeID ), mysqli_real_escape_string ($_SESSION['LINK'], $aIndividuID ) );
		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
}
?>