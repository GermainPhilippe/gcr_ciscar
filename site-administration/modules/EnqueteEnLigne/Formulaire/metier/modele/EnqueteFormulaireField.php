<?php
class EnqueteFormulaireField {
	private $id;
	private $question;
	private $type;
	const TYPE_TEXT_SIMPLE = '1';
	const TYPE_TEXT_SIMPLE_OBLIGATOIRE = '101';
	const TYPE_TEXT_LARGE = '2';
	const TYPE_LIST_DEROULANTE = '3';
	const TYPE_CASE_A_COCHER = '4';
	const TYPE_BOUTON_RADIO = '5';
	private $choix1;
	private $choix2;
	private $choix3;
	private $choix4;
	private $choix5;
	private $choix6;
	private $choix7;
	private $choix8;
	private $choix9;
	private $choix10;
	public function __construct() {
		$this->id = null;
		$this->question = '';
		$this->type = self::TYPE_TEXT_SIMPLE;
		$this->choix1 = '';
		$this->choix2 = '';
		$this->choix3 = '';
		$this->choix4 = '';
		$this->choix5 = '';
		$this->choix6 = '';
		$this->choix7 = '';
		$this->choix8 = '';
		$this->choix9 = '';
		$this->choix10 = '';
	}

	// Getters & Setters //
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
	}
	public function getQuestion() {
		return $this->question;
	}
	public function setQuestion($question) {
		$this->question = $question;
	}
	public function getType() {
		return $this->type;
	}
	public function setType($type) {
		$this->type = $type;
	}
	public function getChoix1() {
		return $this->choix1;
	}
	public function setChoix1($choix) {
		$this->choix1 = $choix;
	}
	public function getChoix2() {
		return $this->choix2;
	}
	public function setChoix2($choix) {
		$this->choix2 = $choix;
	}
	public function getChoix3() {
		return $this->choix3;
	}
	public function setChoix3($choix) {
		$this->choix3 = $choix;
	}
	public function getChoix4() {
		return $this->choix4;
	}
	public function setChoix4($choix) {
		$this->choix4 = $choix;
	}
	public function getChoix5() {
		return $this->choix5;
	}
	public function setChoix5($choix) {
		$this->choix5 = $choix;
	}
	public function getChoix6() {
		return $this->choix6;
	}
	public function setChoix6($choix) {
		$this->choix6 = $choix;
	}
	public function getChoix7() {
		return $this->choix7;
	}
	public function setChoix7($choix) {
		$this->choix7 = $choix;
	}
	public function getChoix8() {
		return $this->choix8;
	}
	public function setChoix8($choix) {
		$this->choix8 = $choix;
	}
	public function getChoix9() {
		return $this->choix9;
	}
	public function setChoix9($choix) {
		$this->choix9 = $choix;
	}
	public function getChoix10() {
		return $this->choix10;
	}
	public function setChoix10($choix) {
		$this->choix10 = $choix;
	}
}