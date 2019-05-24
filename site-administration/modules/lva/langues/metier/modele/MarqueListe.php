<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage lva
 * @version 1.0.4
 */
class LangueListe {
	private $LangueListe;
	private $LangueListeIndividu;
	private $ID;
	function LangueListe() {
		$this->LangueListe = array ();
	}
	public function __construct() {
		$this->LangueListeIndividu();
	}
	function LangueListeIndividu() {
		$this->LangueListeIndividu = array ();
	}

	// #################
	function addLangue($aLangue) {
		$this->LangueListe [] = $aLangue;
	}
	function removeLangue($i) {
		unset ( $this->LangueListe [$i] );
	}
	function setLangueListe($newValue) {
		$this->LangueListe = $newValue;
	}
	function getLangueListe() {
		return $this->LangueListe;
	}
	function getLangueListeByCodes() {
		return $this->LangueListeByCodes;
	}
	function getLangueListeIndividu() {
		return $this->LangueListeIndividu;
	}
	function getNbLangue() {
		return count ( $this->LangueListe );
	}

	// ##################
	function select_all_Langue() {
		$result = mysqli_query ($_SESSION['LINK'], "SELECT LangueID, Code, Libelle FROM annuaire_lva_langue ORDER BY Code" ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aLangue = new Langue ();

			$aLangue->setID ( $line [0] );
			$aLangue->setCode ( $line [1] );
			$aLangue->setName ( $line [2] );

			$this->LangueListe [] = $aLangue;
		}

		mysqli_free_result  ( $result );
	}
	function select_all_Langue_Individu($IndividuID) {
		$result = mysqli_query ($_SESSION['LINK'], "SELECT LangueID FROM annuaire_individulangue WHERE IndividuID=" . $IndividuID . " ORDER BY LangueID" ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$this->LangueListeIndividu [] = $line [0];
		}

		mysqli_free_result  ( $result );
	}
	function select_all_Langue_By_Code($ListeCodes) {
		$result = mysqli_query ($_SESSION['LINK'], "SELECT LangueID, Code, Libelle FROM annuaire_lva_langue WHERE Code in " . $ListeCodes );
		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aLangue = new Langue ();

			$aLangue->setID ( $line [0] );
			$aLangue->setCode ( $line [1] );
			$aLangue->setName ( $line [2] );

			$this->LangueListe [] = $aLangue;
		}

		mysqli_free_result  ( $result );
	}
	function Langue_exist($LangueID) {
		if ($this->LangueListeIndividu != '') {
			foreach ( $this->LangueListeIndividu as $ID ) {
				if ($ID == $LangueID) {
					return true;
				}
			}
		}
		return false;
	}
	function create_individu($individuID) {
		if (isset ( $this->LangueListe )) {
			foreach ( $this->LangueListe as $aLangue ) {
				$query = sprintf ( "INSERT INTO annuaire_individulangue VALUES('%s','%s')", mysqli_real_escape_string ($_SESSION['LINK'], $individuID ), mysqli_real_escape_string ($_SESSION['LINK'], $aLangue->getID () ) );

				mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
			}
		}
	}
	function update_individu($individuID) {
		$query = sprintf ( "DELETE FROM annuaire_individulangue WHERE IndividuID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $individuID ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		if (isset ( $this->LangueListe )) {
			foreach ( $this->LangueListe as $aLangue ) {
				$query = sprintf ( "INSERT INTO annuaire_individulangue VALUES('%s','%s')", mysqli_real_escape_string ($_SESSION['LINK'], $individuID ), mysqli_real_escape_string ($_SESSION['LINK'], $aLangue->getID () ) );

				mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
			}
		}
	}
}
?>