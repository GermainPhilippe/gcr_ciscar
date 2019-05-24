<?php
class EnqueteFormulaire {
	private $ID;
	private $EnqueteID;
	private $Nom;
	private $Statut;
	public function __construct() {
		$this->ID = NULL;
		$this->EnqueteID = NULL;
		$this->Nom = '';
		$this->Statut = NULL;
	}

	// ###
	public function getID() {
		return $this->ID;
	}
	public function getEnqueteID() {
		return $this->EnqueteID;
	}
	public function getNom() {
		return stripcslashes ( $this->Nom );
	}
	public function setID($newValue) {
		$this->ID = $newValue;
	}
	public function setEnqueteID($newValue) {
		$this->EnqueteID = $newValue;
	}
	public function setNom($newValue) {
		$this->Nom = $newValue;
	}
	public function getStatut() {
		return $this->Statut;
	}
	public function setStatut($newStatut) {
		$this->Statut = $newStatut;
	}
}
?>