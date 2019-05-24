<?php
class FlashInfo {
	private $id;
	private $nom;
	private $dateDebut;
	private $dateFin;
	private $information;
	private $docInfoDynID;
	public function __construct() {
		$this->id = NULL;
		$this->nom = '';
		$this->dateDebut = NULL;
		$this->dateFin = NULL;
		$this->information = '';
		$this->docInfoDynID = NULL;
	}

	// ### GETTER ###
	public function getID() {
		return $this->id;
	}
	public function getNom() {
		return $this->nom;
	}
	public function getDateDebut() {
		return $this->dateDebut;
	}
	public function getDateFin() {
		return $this->dateFin;
	}
	public function getInformation() {
		return $this->information;
	}
	public function getDocInfoDynID() {
		return $this->docInfoDynID;
	}

	// ### SETTER ###
	public function setID($newValue) {
		if (is_int ( $newValue ) && ! empty ( $newValue )) {
			$this->id = $newValue;
		} else {
			throw new InvalidArgumentException ();
		}
	}
	public function setNom($newValue) {
		if (is_string ( $newValue )) {
			$this->nom = $newValue;
		} else {
			throw new InvalidArgumentException ();
		}
	}
	public function setDateDebut($newValue) {
		if (is_string ( $newValue ) && ! empty ( $newValue )) {
			$this->dateDebut = $newValue;
		} else {
			throw new InvalidArgumentException ();
		}
	}
	public function setDateFin($newValue) {
		if (is_string ( $newValue ) && ! empty ( $newValue )) {
			$this->dateFin = $newValue;
		} else {
			throw new InvalidArgumentException ();
		}
	}
	public function setInformation($newValue) {
		if (is_string ( $newValue ) && ! empty ( $newValue )) {
			$this->information = $newValue;
		} else {
			throw new InvalidArgumentException ();
		}
	}
	public function setDocInfoDynID($newValue) {
		if (is_int ( $newValue ) || empty ( $newValue )) {
			$this->docInfoDynID = $newValue;
		} else {
			throw new InvalidArgumentException ();
		}
	}
}
?>