<?php
class SSOToken {
	private $id;
	private $dateCreation;
	private $userID;
	private $siteSource;
	private $siteDest;
	private $token;
	public function __construct() {
		$this->id = NULL;
		$this->dateCreation = NULL;
		$this->userID = NULL;
		$this->siteSource = NULL;
		$this->siteDest = NULL;
		$this->token = '';
	}
	
	// ###
	public function getID() {
		return $this->id;
	}
	public function getDateCreation() {
		return $this->dateCreation;
	}
	public function getUserID() {
		return $this->userID;
	}
	public function getSiteSource() {
		return $this->siteSource;
	}
	public function getSiteDest() {
		return $this->siteDest;
	}
	public function getToken() {
		return $this->token;
	}
	
	// ###
	public function setID($newValue) {
		$this->id = $newValue;
	}
	public function setDateCreation($newValue) {
		$this->dateCreation = $newValue;
	}
	public function setUserID($newValue) {
		$this->userID = $newValue;
	}
	public function setSiteSource($newValue) {
		$this->siteSource = $newValue;
	}
	public function setSiteDest($newValue) {
		$this->siteDest = $newValue;
	}
	public function setToken($newValue) {
		$this->token = $newValue;
	}
}