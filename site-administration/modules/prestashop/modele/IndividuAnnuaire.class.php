<?php
/**
 * @author Philippe GERMAIN
 * @package site-administration
 * @subpackage prestashop
 * @version 1.0.4
 */
class IndividuAnnuaire {
	private $myList;
	private $individuID;
	private $individuNom;
	private $individuPrenom;
	private $individuLogin;
	private $individuLoginSage;
	private $individuCivilite;
	private $individuMail;
	private $individuPassword;
	private $individuLangues;
	private $individuEtablissement;
	public function __construct() {
		$this->myList = array ();
		$this->individuID = 0;
		$this->individuNom = '';
		$this->individuPrenom = '';
		$this->individuLogin = '';
		$this->individuLoginSage = '';
		$this->individuCivilite = 1;
		$this->individuMail = '';
		$this->individuPassword = '';
		$this->individuLangues = 0;
		$this->individuEtablissement = '';
	}

	// ###
	public function getList() {
		return $this->myList;
	}
	public function getIndividuID() {
		return $this->individuID;
	}
	public function getIndividuNom() {
		return $this->individuNom;
	}
	public function getIndividuPrenom() {
		return $this->individuPrenom;
	}
	public function getIndividuLogin() {
		return $this->individuLogin;
	}
	public function getIndividuLoginSage() {
		return $this->individuLoginSage;
	}
	public function getIndividuCivilite() {
		return $this->individuCivilite;
	}
	public function getIndividuMail() {
		return $this->individuMail;
	}
	public function getIndividuPassword() {
		return $this->individuPassword;
	}
	public function getIndividuEtablissement() {
		return $this->individuEtablissement;
	}
	public function setList($newValue) {
		$this->myList = $newValue;
	}

	// ###
	public function SQL_SELECT_INDIVIDU_BY_ID($individuID) {

		$this->myList = array ();

		$sql = "SELECT IndividuID, Nom, Prenom, Login, annuaire_etablissement.LoginSage, Civilite, annuaire_individu.Mail, Password, RaisonSociale 
				FROM annuaire_individu, annuaire_etablissement WHERE LieuTravailID = EtablissementID and annuaire_individu.AnnuaireID= 1 and IndividuID = '%s'";
		$query = sprintf ( $sql, mysqli_real_escape_string ( $_SESSION['LINK'] , $individuID ) );

		$result = mysqli_query ( $_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array ( $result );

			$this->individuID = $line [0];
			$this->individuNom = $line [1];
			$this->individuPrenom = $line [2];
			$this->individuLogin = $line [3];
			$this->individuLoginSage = $line [4];
			$this->individuCivilite = $line [5];
			$this->individuMail = $line [6];
			$this->individuPassword = $line [7];
			$this->individuEtablissement = $line [8];
		}

		mysqli_free_result ( $result );
	}
}
?>