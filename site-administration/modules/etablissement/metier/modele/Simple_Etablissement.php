<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage etablissement
 * @version 1.0.4
 */
class Simple_Etablissement {
	private $ID;
	private $AnnuaireID;
	private $RaisonSociale;
	private $Ville;
	private $Pays;
	private $CodePostal;
	private $BureauDistributeur;
	private $LoginSage;
	private $NumRRF;
	private $RegionID;
	public function __construct() {
		$this->ID = NULL;
		$this->AnnuaireID = NULL;
		$this->RaisonSociale = '';
		$this->Ville = '';
		$this->Pays = '';
		$this->CodePostal = '';
		$this->BureauDistributeur = '';
		$this->LoginSage = '';
		$this->NumRRF = '';
		$this->RegionID = NULL;
	}

	// ###
	public function getID() {
		return $this->ID;
	}
	public function getRaisonSociale() {
		return $this->RaisonSociale;
	}
	public function getVille() {
		return $this->Ville;
	}
	public function getPays() {
		return $this->Pays;
	}
	public function getCodePostal() {
		return $this->CodePostal;
	}
	public function getBureauDistributeur() {
		return $this->BureauDistributeur;
	}
	public function getLoginSage() {
		return $this->LoginSage;
	}
	public function getNumRRF() {
		return $this->NumRRF;
	}
	public function getRegionID() {
		return $this->RegionID;
	}
	public function setID($newValue) {
		$this->ID = $newValue;
	}
	public function setRaisonSociale($newValue) {
		$this->RaisonSociale = $newValue;
	}
	public function setVille($newValue) {
		$this->Ville = $newValue;
	}
	public function setPays($newValue) {
		$this->Pays = $newValue;
	}
	public function setCodePostal($newValue) {
		$this->CodePostal = $newValue;
	}
	public function setBureauDistributeur($newValue) {
		$this->BureauDistributeur = $newValue;
	}
	public function setLoginSage($newValue) {
		$this->LoginSage = $newValue;
	}
	public function setNumRRF($newValue) {
		$this->NumRRF = $newValue;
	}
	public function setRegionID($newValue) {
		$this->RegionID = $newValue;
	}

	// ###
	public function SQL_SELECT($EtablissementID) {
		$sql = "SELECT EtablissementID, AnnuaireID, RaisonSociale, Ville, CodePostal,BureauDistributeur, LoginSage, NumRRF, RegionID, Pays FROM annuaire_etablissement WHERE EtablissementID='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $EtablissementID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		if (mysqli_num_rows ( $result ) > 0) {
			$line = mysqli_fetch_array  ( $result );

			$this->ID = $line [0];
			$this->AnnuaireID = $line [1];
			$this->RaisonSociale = $line [2];
			$this->Ville = $line [3];
			$this->CodePostal = $line [4];
			$this->BureauDistributeur = $line [5];
			$this->Pays = $line [6];
		} else {
			$this->__construct ();
		}

		mysqli_free_result  ( $result );
	}
	public function SQL_SELECT_BY_LOGINSAGE($loginsage) {
		$sql = "SELECT EtablissementID, AnnuaireID, RaisonSociale, Ville, CodePostal,BureauDistributeur, LoginSage, NumRRF, RegionID, Pays FROM annuaire_etablissement WHERE LoginSage='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $loginsage ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		if (mysqli_num_rows ( $result ) > 0) {
			$line = mysqli_fetch_array  ( $result );

			$this->ID = $line [0];
			$this->AnnuaireID = $line [1];
			$this->RaisonSociale = $line [2];
			$this->Ville = $line [3];
			$this->CodePostal = $line [4];
			$this->BureauDistributeur = $line [5];
			$this->Pays = $line [6];
		} else {
			$this->__construct ();
		}

		mysqli_free_result  ( $result );
	}
}
?>