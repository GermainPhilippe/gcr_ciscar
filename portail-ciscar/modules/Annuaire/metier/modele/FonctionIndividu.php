<?php
/**
 * @author Florent DESPIERRES
 * @package portail-gcr
 * @subpackage annuaire
 * @version 1.0.4
 */
class FonctionIndividu {
	private $ID;
	private $Libelle;
	public function __construct() {
		$this->ID = NULL;
		$this->Libelle = '';
	}
	
	// ###
	public function getID() {
		return $this->ID;
	}
	public function getNom() {
		return $this->Libelle;
	}
	public function setID($newValue) {
		return $this->ID = $newValue;
	}
	public function setNom($newValue) {
		return $this->Libelle = $newValue;
	}
	
	// ###
	public function SQL_SELECT_ALL() {
		$aList = array ();
		
		$query = sprintf ( "SELECT DomainActiviteID, Libelle FROM annuaire_lva_domainactivite WHERE AnnuaireID='%s'", mysqli_real_escape_string ($_SESSION['LINK'] , $_SESSION ['SITE'] ['ID'] ) );
		
		$result = mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
		while ( $line = mysqli_fetch_array ( $result ) ) {
			$aModele = new FonctionIndividu ();
			$aModele->setID ( $line [0] );
			$aModele->setNom ( $line [1] );
			$aList [] = $aModele;
		}
		mysqli_free_result ( $result );
		
		return $aList;
	}
}
?>