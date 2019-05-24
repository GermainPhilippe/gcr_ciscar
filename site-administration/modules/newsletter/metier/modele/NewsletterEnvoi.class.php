<?php
class NewsletterEnvoi {
	private $myNewsletterID;
	private $myEnvoiID;
	private $myListeDiffusionID;
	private $myListeDiffusionName;
	private $myNbEnvois;
	public function __construct() {
		$this->myNewsletterID = NULL;
		$this->myEnvoiID = NULL;
		$this->myListeDiffusionID = NULL;
		$this->myListeDiffusionName = NULL;
		$this->myNbEnvois = 0;
	}

	// ### GETTER ###
	public function getNewsletterID() {
		return $this->myNewsletterID;
	}
	public function getEnvoiID() {
		return $this->myEnvoiID;
	}
	public function getListeDiffusionID() {
		return $this->myListeDiffusionID;
	}
	public function getListeDiffusionName() {
		return $this->myListeDiffusionName;
	}
	public function getNbEnvois() {
		return $this->myNbEnvois;
	}

	// ### SETTER ###
	public function setNewsletterID($newValue) {
		if (is_int ( $newValue ) && ! empty ( $newValue )) {
			$this->myNewsletterID = $newValue;
		} else {
			$this->myNewsletterID = NULL;
			trigger_error ( 'Champ NewsletterID incorrect!' );
		}
	}
	public function setEnvoiID($newValue) {
		if (is_int ( $newValue ) && ! empty ( $newValue )) {
			$this->myEnvoiID = $newValue;
		} else {
			$this->myEnvoiID = NULL;
			trigger_error ( 'Champ EnvoiID incorrect!' );
		}
	}
	public function setListeDiffusionID($newValue) {
		if (! empty ( $newValue )) {
			$this->myListeDiffusionID = $newValue;
		} else {
			$this->myListeDiffusionID = "";
		}
	}
	public function setListeDiffusionName($newValue) {
		if (! empty ( $newValue )) {
			$this->myListeDiffusionName = $newValue;
		} else {
			$this->myListeDiffusionName = "";
		}
	}
	public function setNbEnvois($newValue) {
		if (! empty ( $newValue )) {
			$this->myNbEnvois = $newValue;
		} else {
			$this->myNbEnvois = 0;
		}
	}
}
?>