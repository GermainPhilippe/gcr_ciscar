<?php
class EnqueteFormulaireComposant {
	private $id;
	private $nom;
	private $valeur;
	private $type;
	const TYPE_LISTE_PAGE = '6';
	const TYPE_BANDEAU = '7';
	const TYPE_ZONE_TEXT = '8';
	const TYPE_FORM_INDIVIDU_INSCRIPTION = '9';
	const TYPE_FORM_INDIVIDU_SATISFACTION = '10';
	const TYPE_FORM_INVITE = '11';
	const TYPE_BUTTON_SUBMIT = '12';
	const TYPE_INVITATION_DINER = '13';
	public function __construct() {
		$this->id = null;
		$this->nom = '';
		$this->valeur = '';
		$this->type = self::TYPE_ZONE_TEXT;
	}

	// Getters & Setters
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
	}
	public function getNom() {
		return $this->nom;
	}
	public function setNom($nom) {
		$this->nom = $nom;
	}
	public function getValeur() {
		return $this->valeur;
	}
	public function setValeur($valeur) {
		$this->valeur = $valeur;
	}
	public function getType() {
		return $this->type;
	}
	public function setType($type) {
		$this->type = $type;
	}
}