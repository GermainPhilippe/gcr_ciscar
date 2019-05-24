<?php
class SurveyDraftRecipient {
	private $surveyID;
	private $listeDiffusionID;
	public function __construct() {
		$this->surveyID = NULL;
		$this->listeDiffusionID = NULL;
	}

	// ### GETTER ###
	public function getSurveyID() {
		return $this->surveyID;
	}
	public function getListeDiffusionID() {
		return $this->listeDiffusionID;
	}

	// ### SETTER ###
	public function setSurveyID($newValue) {
		if (is_int ( $newValue ) && ! empty ( $newValue )) {
			$this->surveyID = $newValue;
		} else {
			throw new InvalidArgumentException ();
		}
	}
	public function setListeDiffusionID($newValue) {
		if (is_int ( $newValue ) && ! empty ( $newValue )) {
			$this->listeDiffusionID = $newValue;
		} else {
			throw new InvalidArgumentException ();
		}
	}
}
?>