<?php
class FlashInfoDomaineActivite {
	private $flashInfoID;
	private $domaineActiviteID;
	public function __construct() {
		$this->flashInfoID = NULL;
		$this->domaineActiviteID = NULL;
	}

	// ### GETTER ###
	public function getFlashInfoID() {
		return $this->flashInfoID;
	}
	public function getDomaineActiviteID() {
		return $this->domaineActiviteID;
	}

	// ### SETTER ###
	public function setFlashInfoID($newValue) {
		if (is_int ( $newValue ) && ! empty ( $newValue )) {
			$this->flashInfoID = $newValue;
		} else {
			throw new InvalidArgumentException ();
		}
	}
	public function setDomaineActiviteID($newValue) {
		if (is_int ( $newValue ) && ! empty ( $newValue )) {
			$this->domaineActiviteID = $newValue;
		} else {
			throw new InvalidArgumentException ();
		}
	}
}
?>