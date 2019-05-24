<?php
class SurveyRecipient {
	private $surveyID;
	private $userID;
	private $aRepondu;
	public function __construct() {
		$this->surveyID = NULL;
		$this->userID = NULL;
		$this->aRepondu = '0';
	}

	// ### GETTER ###
	public function getSurveyID() {
		return $this->surveyID;
	}
	public function getUserID() {
		return $this->userID;
	}
	public function getARepondu() {
		return $this->aRepondu;
	}

	// ### SETTER ###
	public function setSurveyID($newValue) {
		if (is_int ( $newValue ) && ! empty ( $newValue )) {
			$this->surveyID = $newValue;
		} else {
			throw new InvalidArgumentException ();
		}
	}
	public function setUserID($newValue) {
		if (is_int ( $newValue ) && ! empty ( $newValue )) {
			$this->userID = $newValue;
		} else {
			throw new InvalidArgumentException ();
		}
	}
	public function setARepondu($newValue) {
		if (is_string ( $newValue )) {
			$this->aRepondu = $newValue;
		} else {
			throw new InvalidArgumentException ();
		}
	}
}
?>