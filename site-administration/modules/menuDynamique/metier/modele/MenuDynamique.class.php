<?php
class MenuDynamique {
	private $id;
	private $name;
	private $parentID;

	// Niveau 1
	private $iconeDeplie;
	private $iconePlie;
	private $statutDepart;

	// Niveau 1,2
	private $typeVueID;
	private $elementID;
	private $numOrdre;
	const STATUT_DEPLIE = 'DEPLIE';
	const STATUT_PLIE = 'PLIE';
	const STATUT_FIXE_DEPLIE = 'FIXE_DEPLIE';
	const STATUT_FIXE_PLIE = 'FIXE_PLIE';
	public function __construct() {
		$this->id = NULL;
		$this->name = '';
		$this->parentID = NULL;

		$this->iconeDeplie = '';
		$this->iconePlie = '';
		$this->statutDepart = self::STATUT_PLIE;

		$this->typeVueID = NULL;
		$this->elementID = NULL;
		$this->numOrdre = 0;
	}

	// ### GETTER ###
	public function getID() {
		return $this->id;
	}
	public function getName() {
		return $this->name;
	}
	public function getParentID() {
		return $this->parentID;
	}
	public function getIconeDeplie() {
		return $this->iconeDeplie;
	}
	public function getIconePlie() {
		return $this->iconePlie;
	}
	public function getStatutDepart() {
		return $this->statutDepart;
	}
	public function getTypeVueID() {
		return $this->typeVueID;
	}
	public function getElementID() {
		return $this->elementID;
	}
	public function getNumOrdre() {
		return $this->numOrdre;
	}

	// ### SETTER ###
	public function setID($newValue) {
		if (is_int ( $newValue ) && ! empty ( $newValue )) {
			$this->id = $newValue;
		} else {
			new InvalidArgumentException ();
		}
	}
	public function setName($newValue) {
		if (is_string ( $newValue ) && ! empty ( $newValue )) {
			$this->name = $newValue;
		} else {
			throw new InvalidArgumentException ();
		}
	}
	public function setParentID($newValue) {
		if (is_int ( $newValue ) || empty ( $newValue )) {
			$this->parentID = $newValue;
		} else {
			throw new InvalidArgumentException ();
		}
	}
	public function setIconeDeplie($newValue) {
		if (is_string ( $newValue ) || empty ( $newValue )) {
			$this->iconeDeplie = $newValue;
		} else {
			throw new InvalidArgumentException ();
		}
	}
	public function setIconePlie($newValue) {
		if (is_string ( $newValue ) || empty ( $newValue )) {
			$this->iconePlie = $newValue;
		} else {
			throw new InvalidArgumentException ();
		}
	}
	public function setStatutDepart($newValue) {
		if (is_string ( $newValue ) && in_array ( $newValue, array (
				self::STATUT_DEPLIE,
				self::STATUT_PLIE,
				self::STATUT_FIXE_DEPLIE,
				self::STATUT_FIXE_PLIE
		) )) {
			$this->statutDepart = $newValue;
		} else {
			throw new InvalidArgumentException ();
		}
	}
	public function setTypeVueID($newValue) {
		if (is_int ( $newValue )) {
			$this->typeVueID = $newValue;
		} else {
			throw new InvalidArgumentException ();
		}
	}
	public function setElementID($newValue) {
		if (is_string ( $newValue ) || empty ( $newValue )) {
			$this->elementID = $newValue;
		} else {
			throw new InvalidArgumentException ();
		}
	}
	public function setNumOrdre($newValue) {
		if (is_int ( $newValue )) {
			$this->numOrdre = $newValue;
		} else {
			throw new InvalidArgumentException ();
		}
	}
}
?>