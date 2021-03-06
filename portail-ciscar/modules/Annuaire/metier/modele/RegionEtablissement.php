<?php
/**
 * @author Florent DESPIERRES
 * @package portail-gcr
 * @subpackage annuaire
 * @version 1.0.4
 */
class RegionEtablissement {
	private $ID;
	private $Nom;
	public function __construct() {
		$this->ID = NULL;
		$this->Nom = '';
	}
	
	// ###
	public function getID() {
		return $this->ID;
	}
	public function getNom() {
		return $this->Nom;
	}
	public function setID($newValue) {
		$this->ID = $newValue;
	}
	public function setNom($newValue) {
		$this->Nom = $newValue;
	}
	
	// ###
	public function SQL_SELECT_ALL() {
		$aList = array ();
		
		$query = sprintf ( "SELECT RegionID, Libelle FROM annuaire_lva_region WHERE AnnuaireID='%s'", mysqli_real_escape_string ($_SESSION['LINK'] , $_SESSION ['SITE'] ['ID'] ) );
		
		$result = mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
		while ( $line = mysqli_fetch_array ( $result ) ) {
			$aModele = new RegionEtablissement ();
			$aModele->setID ( $line [0] );
			$aModele->setNom ( $line [1] );
			$aList [] = $aModele;
		}
		mysqli_free_result ( $result );
		
		return $aList;
	}
	public function SQL_SELECT($RegionID) {
		$query = sprintf ( "SELECT RegionID, Libelle FROM annuaire_lva_region WHERE RegionID='%s'", mysqli_real_escape_string ($_SESSION['LINK'] , $RegionID ) );
		
		$result = mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
		
		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array ( $result );
			$this->ID = $line [0];
			$this->Nom = $line [2];
		} else {
			$this->__construct ();
		}
		
		mysqli_free_result ( $result );
	}
}
?>