<?php
class SurveyRecipientResponse {
	private $surveyID;
	private $questionID;
	private $userID;
	private $response;
	public function __construct() {
		$this->surveyID = NULL;
		$this->userID = NULL;
		$this->questionID = NULL;
		$this->response = '';
	}

	// ### GETTER ###
	public function getSurveyID() {
		return $this->surveyID;
	}
	public function getUserID() {
		return $this->userID;
	}
	public function getQuestionID() {
		return $this->questionID;
	}
	public function getResponse() {
		return $this->response;
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
	public function setQuestionID($newValue) {
		if (is_int ( $newValue ) && ! empty ( $newValue )) {
			$this->questionID = $newValue;
		} else {
			throw new InvalidArgumentException ();
		}
	}
	public function setResponse($newValue) {
		if (is_string ( $newValue )) {
			$this->response = $newValue;
		} else {
			throw new InvalidArgumentException ();
		}
	}
}
?>