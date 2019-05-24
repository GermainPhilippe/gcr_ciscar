<?php
class EnqueteFormulaireFieldResponse {
	private $id;
	private $fieldId;
	private $userId;
	private $valeur;
	private $enqueteId;
	private $annuaireUserId;
	private $userLogin;
	private $userFirstname;
	private $userLastname;
	private $userEmail;
	function __construct() {
		$this->id = null;
		$this->fieldId = null;
		$this->userId = null;
		$this->valeur = '';
		$this->enqueteId = null;
		$this->annuaireUserId = 0;
		$this->userLogin = '';
		$this->userFirstname = '';
		$this->userLastname = '';
		$this->userEmail = '';
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
	public function getAnnuaireUserId() {
		return $this->annuaireUserId;
	}
	public function getUserLogin() {
		return $this->userLogin;
	}
	public function getUserFirstname() {
		return $this->userFirstname;
	}
	public function getUserLastname() {
		return $this->userLastname;
	}
	public function getUserEmail() {
		return $this->userEmail;
	}
	public function setUserId($userid) {
		$this->userId = $userid;
	}
	public function setAnnuaireUserId($annuaireUserId) {
		$this->annuaireUserId = $annuaireUserId;
	}
	public function setUserLogin($userLogin) {
		$this->userLogin = $userLogin;
	}
	public function setUserLastname($userLastname) {
		$this->userLastname = $userLastname;
	}
	public function setUserFirstname($Firstname) {
		$this->userFirstname = $Firstname;
	}
	public function setUserEmail($userEmail) {
		$this->userEmail = $userEmail;
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
	public function getEnqueteId() {
		return $this->enqueteId;
	}
	public function setEnqueteId($valeur) {
		$this->enqueteId = $valeur;
	}
}