<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage individu
 * @version 1.0.4
 */
class Simple_Individu {
	private $ID;
	private $Nom;
	private $Prenom;
	private $Mail;
	private $LoginSage;
	private $EtablissementID;
	public function __construct() {
		$this->ID = NULL;
		$this->Nom = '';
		$this->Prenom = '';
		$this->Mail = '';
		$this->LoginSage = '';
		$this->EtablissementID = NULL;
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
	public function getEtablissementID() {
		return $this->EtablissementID;
	}
	public function getLoginSage() {
		return $this->LoginSage;
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
	public function setEtablissementID($newValue) {
		$this->EtablissementID = $newValue;
	}
	public function setLoginSage($newValue) {
		$this->LoginSage = $newValue;
	}

	// ###
	public function SQL_SELECT($IndividuID) {
		$sql = "SELECT IndividuID, Nom, Prenom, Mail, LoginSage FROM annuaire_individu WHERE IndividuID='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $IndividuID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array  ( $result );

			$this->ID = $line [0];
			$this->Nom = $line [1];
			$this->Prenom = $line [2];
			$this->Mail = $line [3];
			$this->LoginSage = $line [4];
		} else {
			$this->__construct ();
		}

		mysqli_free_result  ( $result );
	}
	public function SQL_SELECT_DA() {
		$sql = "SELECT da.Libelle FROM annuaire_role r,annuaire_role_domainactivite rda,annuaire_lva_domainactivite da, annuaire_lva_domainactivite_fonction fda 
		WHERE r.RoleID=rda.RoleID AND rda.DomainActiviteID=da.DomainActiviteID AND rda.FonctionDAID=fda.FonctionDAID AND r.IndividuID='%s' 
		ORDER BY da.NumOrdre,r.RoleID ASC LIMIT 1";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $this->ID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array  ( $result );
			mysqli_free_result  ( $result );
			return $line [0];
		} else {
			mysqli_free_result  ( $result );
			return "";
		}
	}
	public function SQL_SELECT_FxDA() {
		$sql = "SELECT fda.Libelle FROM annuaire_role r,annuaire_role_domainactivite rda,annuaire_lva_domainactivite da, annuaire_lva_domainactivite_fonction fda 
		WHERE r.RoleID=rda.RoleID AND rda.DomainActiviteID=da.DomainActiviteID AND rda.FonctionDAID=fda.FonctionDAID AND r.IndividuID='%s'
		ORDER BY da.NumOrdre,r.RoleID ASC LIMIT 1";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $this->ID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array  ( $result );
			mysqli_free_result  ( $result );
			return $line [0];
		} else {
			mysqli_free_result  ( $result );
			return "";
		}
	}
}
?>