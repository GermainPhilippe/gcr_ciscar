<?php
class MenuDynamiqueVue {
	private $id;
	private $name;
	public function __construct() {
		$this->id = NULL;
		$this->name = '';
	}

	// ### GETTER ###
	public function getID() {
		return $this->id;
	}
	public function getName() {
		return $this->name;
	}

	// ### SETTER ###
	public function setID($newValue) {
		if (is_int ( $newValue ) && ! empty ( $newValue )) {
			$this->id = $newValue;
		} else {
			throw new InvalidArgumentException ();
		}
	}
	public function setName($newValue) {
		if (is_string ( $newValue ) && ! empty ( $newValue )) {
			$this->name = $newValue;
		} else {
			throw new InvalidArgumentException ();
		}
	}
}
?>