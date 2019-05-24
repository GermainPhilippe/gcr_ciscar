<?php
class SurveyHistory {
	private $id;
	private $surveyID;
	private $dateCreation;
	private $description;
	public function __construct() {
		$this->id = NULL;
		$this->surveyID = NULL;
		$this->dateCreation = '';
		$this->description = '';
	}

	// ### GETTER ###
	public function getID() {
		return $this->id;
	}
	public function getSurveyID() {
		return $this->surveyID;
	}
	public function getDateCreation() {
		return $this->dateCreation;
	}
	public function getDescription() {
		return $this->description;
	}

	// ### SETTER ###
	public function setID($newValue) {
		if (is_int ( $newValue ) && ! empty ( $newValue )) {
			$this->id = $newValue;
		} else {
			throw new InvalidArgumentException ();
		}
	}
	public function setSurveyID($newValue) {
		if (is_int ( $newValue ) && ! empty ( $newValue )) {
			$this->surveyID = $newValue;
		} else {
			throw new InvalidArgumentException ();
		}
	}
	public function setDateCreation($newValue) {
		if (is_string ( $newValue )) {
			$this->dateCreation = $newValue;
		} else {
			throw new InvalidArgumentException ();
		}
	}
	public function setDescription($newValue) {
		if (is_string ( $newValue )) {
			$this->description = $newValue;
		} else {
			throw new InvalidArgumentException ();
		}
	}
}
?>