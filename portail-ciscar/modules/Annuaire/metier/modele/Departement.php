<?php
/**
 * @author Florent DESPIERRES
 * @package portail-gcr
 * @subpackage annuaire
 * @version 1.0.4
 */
class Departement {
	private $ID;
	private $Code;
	private $Libelle;
	public function __construct() {
		$this->ID = NULL;
		$this->Code = '';
		$this->Libelle = '';
	}
	public function getID() {
		return $this->ID;
	}
	public function getCode() {
		return $this->Code;
	}
	public function getLibelle() {
		return $this->Libelle;
	}
	public function setID($newValue) {
		$this->ID = $newValue;
	}
	public function setCode($newValue) {
		$this->Code = $newValue;
	}
	public function setLibelle($newValue) {
		$this->Libelle = $newValue;
	}
	
	// ###
	public function SQL_SELECT_ALL() {
		$aList = array ();
		
		$result = mysqli_query ( $_SESSION['LINK'] ,"SELECT DepartementID, Code, Libelle FROM annuaire_lva_departement" ) or die ( mysqli_error ($_SESSION['LINK']) );
		while ( $line = mysqli_fetch_array ( $result ) ) {
			$aModele = new Departement ();
			$aModele->setID ( $line [0] );
			$aModele->setCode ( $line [1] );
			$aModele->setLibelle ( $line [2] );
			$aList [] = $aModele;
		}
		mysqli_free_result ( $result );
		
		return $aList;
	}
}
?>