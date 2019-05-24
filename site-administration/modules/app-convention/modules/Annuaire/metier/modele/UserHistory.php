<?php
class UserHistory {
	private $id;
	private $dateAction;
	private $description;
	private $userId;
	private $zone;
	public function __construct() {
		$this->id = null;
		$this->dateAction = null;
		$this->description = '';
		$this->userId = null;
		$this->zone = 'Individu';
	}

	// Getters & Setters
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
	}
	public function getDateAction() {
		return $this->dateAction;
	}
	public function setDateAction($date) {
		$this->dateAction = $date;
	}
	public function getDescription() {
		return $this->description;
	}
	public function setDescription($description) {
		$this->description = $description;
	}
	public function getUserId() {
		return $this->userId;
	}
	public function setUserId($userid) {
		$this->userId = $userid;
	}
	public function getActionRealiseePar() {
		return $this->zone;
	}
	public function setActionRealiseePar($zone) {
		$this->zone = $zone;
	}
}