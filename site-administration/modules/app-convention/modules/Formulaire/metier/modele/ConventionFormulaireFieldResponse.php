<?php
class ConventionFormulaireFieldResponse {
	private $id;
	private $fieldId;
	private $userId;
	private $valeur;
	public function __construct() {
		$this->id = null;
		$this->fieldId = null;
		$this->userId = null;
		$this->valeur = '';
	}

	// Getters & Setters //
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
	}
	public function getUserId() {
		return $this->userId;
	}
	public function setUserId($userid) {
		$this->userId = $userid;
	}
	public function getFieldId() {
		return $this->fieldId;
	}
	public function setFieldId($fieldid) {
		$this->fieldId = $fieldid;
	}
	public function getValeur() {
		return $this->valeur;
	}
	public function setValeur($valeur) {
		$this->valeur = $valeur;
	}
}