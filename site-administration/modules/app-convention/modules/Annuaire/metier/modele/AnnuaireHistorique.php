<?php
/**
 * @author Florent DESPIERRES
 * @package app-convention
 * @subpackage annuaire
 * @version 1.0.4
 */
class AnnuaireHistorique {
	private $ID;
	private $DateAction;
	private $AnnuaireActionID;
	private $Description;
	public function __construct() {
		$this->ID = NULL;
		$this->DateAction = '';
		$this->AnnuaireActionID = NULL;
		$this->Description = '';
	}

	// ###
	public function getID() {
		return $this->ID;
	}
	public function getDateAction() {
		return $this->DateAction;
	}
	public function getAnnuaireActionID() {
		return $this->AnnuaireActionID;
	}
	public function getDescription() {
		return $this->Description;
	}

	// ###
	public function setID($newValue) {
		$this->ID = $newValue;
	}
	public function setDateAction($newValue) {
		$this->DateAction = $newValue;
	}
	public function setAnnuaireActionID($newValue) {
		$this->AnnuaireActionID = $newValue;
	}
	public function setDescription($newValue) {
		$this->Description = $newValue;
	}

	// ###
	public function SQL_create() {
	}
	public function SQL_update() {
	}
	public function SQL_delete() {
	}
	public function SQL_select($AnnuaireHistoriqueID) {
	}
}
?>