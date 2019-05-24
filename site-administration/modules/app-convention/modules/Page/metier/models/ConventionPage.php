<?php
class ConventionPage {
	private $id;
	private $title;
	private $htmlContent;
	public function __construct() {
		$this->id = null;
		$this->title = '';
		$this->htmlContent = '';
	}

	// Getters & Setters //
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
	}
	public function getTitle() {
		return $this->title;
	}
	public function setTitle($title) {
		$this->title = $title;
	}
	public function getHtmlContent() {
		return $this->htmlContent;
	}
	public function setHtmlContent($htmlContent) {
		$this->htmlContent = $htmlContent;
	}
}