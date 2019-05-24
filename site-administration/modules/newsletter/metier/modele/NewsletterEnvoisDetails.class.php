<?php
class NewsletterEnvoisDetails {
	private $myEnvoiID;
	private $myDateDerOuv;
	private $myIndividuID;
	private $myNom;
	private $myPrenom;
	private $myMail;
	private $myLoginSage;
	private $myNbOuv;
	private $myNbClicks;
	public function __construct() {
		$this->myEnvoiID = NULL;
		$this->myDateDerOuv = '';
		$this->myIndividuID = NULL;
		$this->myNom = '';
		$this->myPrenom = '';
		$this->myMail = '';
		$this->myLoginSage = '';
		$this->myNbOuv = 0;
		$this->myNbClicks = 0;
	}

	// ### GETTER ###
	public function getEnvoiID() {
		return $this->myEnvoiID;
	}
	public function getDateDerOuv() {
		return $this->myDateDerOuv;
	}
	public function getIndividuID() {
		return $this->myIndividuID;
	}
	public function getNom() {
		return $this->myNom;
	}
	public function getPrenom() {
		return $this->myPrenom;
	}
	public function getMail() {
		return $this->myMail;
	}
	public function getLoginSage() {
		return $this->myLoginSage;
	}
	public function getNbOuv() {
		return $this->myNbOuv;
	}
	public function getNbClicks() {
		return $this->myNbClicks;
	}

	// ### SETTER ###
	public function setEnvoiID($newValue) {
		if (is_int ( $newValue ) && ! empty ( $newValue )) {
			$this->myEnvoiID = $newValue;
		} else {
			$this->myEnvoiID = NULL;
			trigger_error ( 'Champ EnvoiID incorrect!' );
		}
	}
	public function setIndividuID($newValue) {
		if (is_int ( $newValue ) && ! empty ( $newValue )) {
			$this->myIndividuID = $newValue;
		} else {
			$this->myIndividuID = NULL;
			trigger_error ( 'Champ IndividuID incorrect!' );
		}
	}
	public function setNom($newValue) {
		$this->myNom = $newValue;
	}
	public function setPrenom($newValue) {
		$this->myPrenom = $newValue;
	}
	public function setMail($newValue) {
		$this->myMail = $newValue;
	}
	public function setLoginSage($newValue) {
		$this->myLoginSage = $newValue;
	}
	public function setNbOuv($newValue) {
		$this->myNbOuv = $newValue;
	}
	public function setNbClicks($newValue) {
		$this->myNbClicks = $newValue;
	}
	public function setDateDerOuv($newValue) {
		if (is_string ( $newValue ) && ! empty ( $newValue )) {
			$this->myDateDerOuv = $newValue;
		} else {
			$this->myDateDerOuv = NULL;
			trigger_error ( 'Champ DateDerOuv incorrect!' );
		}
	}
}
?>