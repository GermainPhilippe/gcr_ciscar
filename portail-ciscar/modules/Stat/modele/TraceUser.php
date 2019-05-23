<?php
class TraceUser {
	private $id;
	private $user_id;
	private $date_action;
	private $description_in;
	private $url_in;
	private $description_out;
	private $url_out;
	private $site_id;
	public function __construct() {
		$this->id = null;
		$this->user_id = null;
		$this->date_action = null;
		$this->description_in = '';
		$this->url_in = '';
		$this->description_out = '';
		$this->url_out = '';
		$this->site_id = '1';
	}
	
	// Getters & Setters //
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
	}
	public function getUserId() {
		return $this->user_id;
	}
	public function setUserId($userid) {
		$this->user_id = $userid;
	}
	public function getDateAction() {
		return $this->date_action;
	}
	public function setDateAction($date) {
		$this->date_action = $date;
	}
	public function getDescriptionIn() {
		return $this->description_in;
	}
	public function setDescriptionIn($description) {
		$this->description_in = $description;
	}
	public function getUrlIn() {
		return $this->url_in;
	}
	public function setUrlIn($url) {
		$this->url_in = $url;
	}
	public function getDescriptionOut() {
		return $this->description_out;
	}
	public function setDescriptionOut($description) {
		$this->description_out = $description;
	}
	public function getUrlOut() {
		return $this->url_out;
	}
	public function setUrlOut($url) {
		$this->url_out = $url;
	}
	public function getSiteId() {
		return $this->site_id;
	}
	public function setSiteId($site_id) {
		$this->site_id = $site_id;
	}
}