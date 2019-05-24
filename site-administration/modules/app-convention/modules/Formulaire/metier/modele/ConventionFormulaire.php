<?php
class ConventionFormulaire {
	private $ID;
	private $ConventionID;
	private $Nom;
	public function __construct() {
		$this->ID = NULL;
		$this->ConventionID = NULL;
		$this->Nom = '';
	}

	// ###
	public function getID() {
		return $this->ID;
	}
	public function getConventionID() {
		return $this->ConventionID;
	}
	public function getNom() {
		return stripcslashes ( $this->Nom );
	}
	public function setID($newValue) {
		$this->ID = $newValue;
	}
	public function setConventionID($newValue) {
		$this->ConventionID = $newValue;
	}
	public function setNom($newValue) {
		$this->Nom = $newValue;
	}
}
?>