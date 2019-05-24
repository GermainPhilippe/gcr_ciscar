<?php
/**
 * @author Florent DESPIERRES
 * @package app-convention
 * @subpackage annuaire
 * @version 1.0.4
 */
class AnnuaireAction {
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
	public function SQL_create() {
	}
	public function SQL_update() {
	}
	public function SQL_delete() {
	}
	public function SQL_select($AnnuaireActionID) {
	}
}
?>