<?php
/**
 * @author Florent DESPIERRES
 * @package app-convention
 * @subpackage Convention
 * @version 1.0.4
 */
class Convention {
	private $ID;
	private $DateCreation;
	private $Statut; // 1 : Brouillon, 2 : Ouvert, 3 : Clos

	// Phase Inscription
	private $DateDebutInscription;
	private $DateFinInscription;
	private $PageClotureInscription;

	// Phase Satisfaction
	private $DateDebutSatisfaction;
	private $DateFinSatisfaction;
	private $PageClotureSatisfaction;
	private $Nom;
	private $lca11; // Profile 1 Inscription
	private $lca12; // Profile 2 Inscription
	private $lca13; // Profile 3 Inscription
	private $lca14; // Profile 4 Inscription
	private $lca15; // Profile 5 Inscription
	private $lca16; // Profile 6 Inscription
	private $lca17; // Profile 7 Inscription
	private $lca18; // Profile 8 Inscription
	private $lca19; // Profile 9 Inscription
	private $lca21; // Profile 1 Satisfaction
	private $lca22; // Profile 2 Satisfaction
	private $lca23; // Profile 3 Satisfaction
	private $lca24; // Profile 4 Satisfaction
	private $lca25; // Profile 5 Satisfaction
	private $lca26; // Profile 6 Satisfaction
	private $lca27; // Profile 7 Satisfaction
	private $lca28; // Profile 8 Satisfaction
	private $lca29; // Profile 9 Satisfaction
	public function __construct() {
		$this->ID = null;
		$this->DateCreation = '';
		$this->Statut = PhaseConvention::$PHASE_EN_CREATION;
		// Phase Inscription
		$this->DateDebutInscription = null;
		$this->DateFinInscription = null;
		$this->PageClotureInscription = '';
		// Phase Satisfaction
		$this->DateDebutSatisfaction = null;
		$this->DateFinSatisfaction = null;
		$this->PageClotureSatisfaction = '';

		$this->Nom = '';
		$this->lca11 = null;
		$this->lca12 = null;
		$this->lca13 = null;
		$this->lca14 = null;
		$this->lca15 = null;
		$this->lca16 = null;
		$this->lca17 = null;
		$this->lca18 = null;
		$this->lca19 = null;

		$this->lca21 = null;
		$this->lca22 = null;
		$this->lca23 = null;
		$this->lca24 = null;
		$this->lca25 = null;
		$this->lca26 = null;
		$this->lca27 = null;
		$this->lca28 = null;
		$this->lca29 = null;
	}

	// ###
	public function getID() {
		return $this->ID;
	}
	public function getNom() {
		return $this->Nom;
	}
	public function getLCA11() {
		return $this->lca11;
	}
	public function getLCA12() {
		return $this->lca12;
	}
	public function getLCA13() {
		return $this->lca13;
	}
	public function getLCA14() {
		return $this->lca14;
	}
	public function getLCA15() {
		return $this->lca15;
	}
	public function getLCA16() {
		return $this->lca16;
	}
	public function getLCA17() {
		return $this->lca17;
	}
	public function getLCA18() {
		return $this->lca18;
	}
	public function getLCA19() {
		return $this->lca19;
	}
	public function getLCA21() {
		return $this->lca21;
	}
	public function getLCA22() {
		return $this->lca22;
	}
	public function getLCA23() {
		return $this->lca23;
	}
	public function getLCA24() {
		return $this->lca24;
	}
	public function getLCA25() {
		return $this->lca25;
	}
	public function getLCA26() {
		return $this->lca26;
	}
	public function getLCA27() {
		return $this->lca27;
	}
	public function getLCA28() {
		return $this->lca28;
	}
	public function getLCA29() {
		return $this->lca29;
	}
	public function getDateCreation() {
		return $this->DateCreation;
	}
	public function getStatut() {
		return $this->Statut;
	}
	public function getDateDebutInscription() {
		return $this->DateDebutInscription;
	}
	public function getDateFinInscription() {
		return $this->DateFinInscription;
	}
	public function getPageClotureInscription() {
		return $this->PageClotureInscription;
	}
	public function getDateDebutSatisfaction() {
		return $this->DateDebutSatisfaction;
	}
	public function getDateFinSatisfaction() {
		return $this->DateFinSatisfaction;
	}
	public function getPageClotureSatisfaction() {
		return $this->PageClotureSatisfaction;
	}
	public function setID($newValue) {
		$this->ID = $newValue;
	}
	public function setNom($nom) {
		$this->Nom = $nom;
	}
	public function setLCA11($lca11) {
		$this->lca11 = $lca11;
	}
	public function setLCA12($lca12) {
		$this->lca12 = $lca12;
	}
	public function setLCA13($lca13) {
		$this->lca13 = $lca13;
	}
	public function setLCA14($lca14) {
		$this->lca14 = $lca14;
	}
	public function setLCA15($lca15) {
		$this->lca15 = $lca15;
	}
	public function setLCA16($lca16) {
		$this->lca16 = $lca16;
	}
	public function setLCA17($lca17) {
		$this->lca17 = $lca17;
	}
	public function setLCA18($lca18) {
		$this->lca18 = $lca18;
	}
	public function setLCA19($lca19) {
		$this->lca19 = $lca19;
	}
	public function setLCA21($lca21) {
		$this->lca21 = $lca21;
	}
	public function setLCA22($lca22) {
		$this->lca22 = $lca22;
	}
	public function setLCA23($lca23) {
		$this->lca23 = $lca23;
	}
	public function setLCA24($lca24) {
		$this->lca24 = $lca24;
	}
	public function setLCA25($lca25) {
		$this->lca25 = $lca25;
	}
	public function setLCA26($lca26) {
		$this->lca26 = $lca26;
	}
	public function setLCA27($lca27) {
		$this->lca27 = $lca27;
	}
	public function setLCA28($lca28) {
		$this->lca28 = $lca28;
	}
	public function setLCA29($lca29) {
		$this->lca29 = $lca29;
	}
	public function setDateCreation($newValue) {
		$this->DateCreation = $newValue;
	}
	public function setStatut($newValue) {
		$this->Statut = $newValue;
	}
	public function setDateDebutInscription($newValue) {
		$this->DateDebutInscription = $newValue;
	}
	public function setDateFinInscription($newValue) {
		$this->DateFinInscription = $newValue;
	}
	public function setPageClotureInscription($newValue) {
		$this->PageClotureInscription = $newValue;
	}
	public function setDateDebutSatisfaction($newValue) {
		$this->DateDebutSatisfaction = $newValue;
	}
	public function setDateFinSatisfaction($newValue) {
		$this->DateFinSatisfaction = $newValue;
	}
	public function setPageClotureSatisfaction($newValue) {
		$this->PageClotureSatisfaction = $newValue;
	}

	// ###
	public function SQL_create() {
		$sql = "INSERT INTO conv_convention (ConventionID, DateCreation, Statut)";
		$sql .= " VALUES(NULL, date(now()),'%s')";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $this->Statut ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function SQL_update() {
		$sql = "UPDATE conv_convention SET";
		$sql .= ! is_null ( $this->DateDebutInscription ) ? " DateDebutInscription='" . $this->DateDebutInscription . "'" : " DateDebutInscription=NULL";
		$sql .= ! is_null ( $this->DateFinInscription ) ? ", DateFinInscription='" . $this->DateFinInscription . "'" : ", DateFinInscription=NULL";
		$sql .= ! is_null ( $this->DateDebutSatisfaction ) ? ", DateDebutSatisfaction='" . $this->DateDebutSatisfaction . "'" : ", DateDebutSatisfaction=NULL";
		$sql .= ! is_null ( $this->DateFinSatisfaction ) ? ", DateFinSatisfaction='" . $this->DateFinSatisfaction . "'" : ", DateFinSatisfaction=NULL";
		$sql .= ", Statut='%s', PageClotureInscription='%s', PageClotureSatisfaction='%s', Nom='%s',";
		$sql .= " lca11='%s', lca12='%s', lca13='%s', lca14='%s', lca15='%s', lca16='%s', lca17='%s', lca18='%s', lca19='%s', ";
		$sql .= " lca21='%s', lca22='%s', lca23='%s', lca24='%s', lca25='%s', lca26='%s', lca27='%s', lca28='%s', lca29='%s' WHERE ConventionID='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $this->Statut ), mysqli_real_escape_string ($_SESSION['LINK'], $this->PageClotureInscription ), mysqli_real_escape_string ($_SESSION['LINK'], $this->PageClotureSatisfaction ), mysqli_real_escape_string ($_SESSION['LINK'], $this->Nom ), mysqli_real_escape_string ($_SESSION['LINK'], $this->lca11 ), mysqli_real_escape_string ($_SESSION['LINK'], $this->lca12 ), mysqli_real_escape_string ($_SESSION['LINK'], $this->lca13 ), mysqli_real_escape_string ($_SESSION['LINK'], $this->lca14 ), mysqli_real_escape_string ($_SESSION['LINK'], $this->lca15 ), mysqli_real_escape_string ($_SESSION['LINK'], $this->lca16 ), mysqli_real_escape_string ($_SESSION['LINK'], $this->lca17 ), mysqli_real_escape_string ($_SESSION['LINK'], $this->lca18 ), mysqli_real_escape_string ($_SESSION['LINK'], $this->lca19 ), mysqli_real_escape_string ($_SESSION['LINK'], $this->lca21 ), mysqli_real_escape_string ($_SESSION['LINK'], $this->lca22 ), mysqli_real_escape_string ($_SESSION['LINK'], $this->lca23 ), mysqli_real_escape_string ($_SESSION['LINK'], $this->lca24 ), mysqli_real_escape_string ($_SESSION['LINK'], $this->lca25 ), mysqli_real_escape_string ($_SESSION['LINK'], $this->lca26 ), mysqli_real_escape_string ($_SESSION['LINK'], $this->lca27 ), mysqli_real_escape_string ($_SESSION['LINK'], $this->lca28 ), mysqli_real_escape_string ($_SESSION['LINK'], $this->lca29 ), mysqli_real_escape_string ($_SESSION['LINK'], $this->ID ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function SQL_delete() {
		$sql = "DELETE FROM conv_convention WHERE ConventionID='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $this->ID ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function SQL_select($ConventionID) {
		$query = sprintf ( "SELECT ConventionID, Nom,  DateCreation, Statut, DateDebutInscription, DateFinInscription, PageClotureInscription, DateDebutSatisfaction, DateFinSatisfaction, PageClotureSatisfaction, lca11, lca12, lca13, lca14, lca15, lca16, lca17, lca18, lca19, lca21, lca22, lca23, lca24, lca25, lca26, lca27, lca28, lca29 FROM conv_convention WHERE ConventionID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $ConventionID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array  ( $result );

			$this->ID = $line [0];
			$this->Nom = $line [1];
			$this->DateCreation = $line [2];
			$this->Statut = $line [3];
			$this->DateDebutInscription = $line [4];
			$this->DateFinInscription = $line [5];
			$this->PageClotureInscription = $line [6];
			$this->DateDebutSatisfaction = $line [7];
			$this->DateFinSatisfaction = $line [8];
			$this->PageClotureSatisfaction = $line [9];
			$this->lca11 = $line [10];
			$this->lca12 = $line [11];
			$this->lca13 = $line [12];
			$this->lca14 = $line [13];
			$this->lca15 = $line [14];
			$this->lca16 = $line [15];
			$this->lca17 = $line [16];
			$this->lca18 = $line [17];
			$this->lca19 = $line [18];

			$this->lca21 = $line [19];
			$this->lca22 = $line [20];
			$this->lca23 = $line [21];
			$this->lca24 = $line [22];
			$this->lca25 = $line [23];
			$this->lca26 = $line [24];
			$this->lca27 = $line [25];
			$this->lca28 = $line [26];
			$this->lca29 = $line [27];
		} else {
			$this->__construct ();
		}

		mysqli_free_result  ( $result );
	}
}
?>