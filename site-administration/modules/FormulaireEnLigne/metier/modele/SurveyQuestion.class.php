<?php
class SurveyQuestion {
	private $id;
	private $surveyID;
	private $description;
	private $type;
	private $choix1;
	private $choix2;
	private $choix3;
	private $choix4;
	private $choix5;
	private $choix6;
	const TYPE_CHECKBOX = 'CHECKBOX';
	const TYPE_RADIO = 'RADIO';
	const TYPE_SIMPLE = 'SIMPLE';
	const TYPE_TEXTAREA = 'TEXTAREA';
	const TYPE_LIST = 'LIST';
	public function __construct() {
		$this->id = NULL;
		$this->surveyID = NULL;
		$this->description = '';
		$this->type = self::TYPE_SIMPLE;
		$this->choix1 = '';
		$this->choix2 = '';
		$this->choix3 = '';
		$this->choix4 = '';
		$this->choix5 = '';
		$this->choix6 = '';
	}

	// ### GETTER ###
	public function getID() {
		return $this->id;
	}
	public function getSurveyID() {
		return $this->surveyID;
	}
	public function getDescription() {
		return $this->description;
	}
	public function getType() {
		return $this->type;
	}
	public function getChoix1() {
		return $this->choix1;
	}
	public function getChoix2() {
		return $this->choix2;
	}
	public function getChoix3() {
		return $this->choix3;
	}
	public function getChoix4() {
		return $this->choix4;
	}
	public function getChoix5() {
		return $this->choix5;
	}
	public function getChoix6() {
		return $this->choix6;
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
	public function setDescription($newValue) {
		if (is_string ( $newValue ) && ! empty ( $newValue )) {
			$this->description = $newValue;
		} else {
			throw new InvalidArgumentException ();
		}
	}
	public function setType($newValue) {
		if (is_string ( $newValue ) && in_array ( $newValue, array (
				self::TYPE_CHECKBOX,
				self::TYPE_RADIO,
				self::TYPE_SIMPLE,
				self::TYPE_TEXTAREA,
				self::TYPE_LIST
		) )) {
			$this->type = $newValue;
		} else {
			throw new InvalidArgumentException ();
		}
	}
	public function setChoix1($newValue) {
		if (is_string ( $newValue )) {
			$this->choix1 = $newValue;
		} else {
			throw new InvalidArgumentException ();
		}
	}
	public function setChoix2($newValue) {
		if (is_string ( $newValue )) {
			$this->choix2 = $newValue;
		} else {
			throw new InvalidArgumentException ();
		}
	}
	public function setChoix3($newValue) {
		if (is_string ( $newValue )) {
			$this->choix3 = $newValue;
		} else {
			throw new InvalidArgumentException ();
		}
	}
	public function setChoix4($newValue) {
		if (is_string ( $newValue )) {
			$this->choix4 = $newValue;
		} else {
			throw new InvalidArgumentException ();
		}
	}
	public function setChoix5($newValue) {
		if (is_string ( $newValue )) {
			$this->choix5 = $newValue;
		} else {
			throw new InvalidArgumentException ();
		}
	}
	public function setChoix6($newValue) {
		if (is_string ( $newValue )) {
			$this->choix6 = $newValue;
		} else {
			throw new InvalidArgumentException ();
		}
	}
}
?>