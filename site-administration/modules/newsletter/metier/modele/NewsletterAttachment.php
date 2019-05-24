<?php
class NewsletterAttachment {
	private $id;
	private $newsletterID;
	private $name;
	private $size;
	private $mime;
	private $data;
	public function __construct() {
		$this->id = NULL;
		$this->newsletterID = NULL;

		$this->name = '';
		$this->size = NULL;
		$this->mime = '';
		$this->data = NULL;
	}

	// ###
	public function getID() {
		return $this->id;
	}
	public function getNewsletterID() {
		return $this->newsletterID;
	}
	public function getName() {
		return $this->name;
	}
	public function getSize() {
		return $this->size;
	}
	public function getMime() {
		return $this->mime;
	}
	public function getData() {
		return $this->data;
	}

	// ###
	public function setID($newValue) {
		$this->id = $newValue;
	}
	public function setNewsletterID($newValue) {
		$this->newsletterID = $newValue;
	}
	public function setName($newValue) {
		$this->name = $newValue;
	}
	public function setSize($newValue) {
		$this->size = $newValue;
	}
	public function setMime($newValue) {
		$this->mime = $newValue;
	}
	public function setData($newValue) {
		$this->data = $newValue;
	}
}