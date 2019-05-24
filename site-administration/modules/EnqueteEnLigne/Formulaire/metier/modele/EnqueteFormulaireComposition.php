<?php
class EnqueteFormulaireComposition {
	private $id;
	private $formulaireid;
	private $numordre;
	private $type;
	const TYPE_FIELD = 'field';
	const TYPE_COMPOSANT = 'composant';
	public function __construct() {
		$this->id = null;
		$this->formulaireid = null;
		$this->numordre = 0;
		$this->type = self::TYPE_FIELD;
	}

	// Getters & Setters //
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
	}
	public function getFormulaireId() {
		return $this->formulaireid;
	}
	public function setFormulaireId($formulaireid) {
		$this->formulaireid = $formulaireid;
	}
	public function getNumOrdre() {
		return $this->numordre;
	}
	public function setNumOrdre($numordre) {
		$this->numordre = $numordre;
	}
	public function getType() {
		return $this->type;
	}
	public function setType($type) {
		$this->type = $type;
	}
}