<?php
class NewsletterHistorique {
	private $myID;
	private $myNewsletterID;
	private $myDateCreation;
	private $myEnvoiID;
	private $myNbTot;
	private $myNbOuv;
	private $myNbLecteurs;
	private $myNbClicks;
	private $myDescription;
	private $myJ;
	private $myListeDiffusion;
	private $myListeArticles;
	public function __construct() {
		$this->myID = NULL;
		$this->myNewsletterID = NULL;
		$this->myDateCreation = NULL;
		$this->myEnvoiID = NULL;
		$this->myNbTot = 0;
		$this->myNbOuv = 0;
		$this->myNbLecteurs = 0;
		$this->myNbClicks = 0;
		$this->myDescription = '';
		$this->myJ = 0;
		$this->myListeDiffusion = '';
		$this->myListeArticles = '';
	}

	// ### GETTER ###
	public function getID() {
		return $this->myID;
	}
	public function getNewsletterID() {
		return $this->myNewsletterID;
	}
	public function getEnvoiID() {
		return $this->myEnvoiID;
	}
	public function getNbTot() {
		return $this->myNbTot;
	}
	public function getNbOuv() {
		return $this->myNbOuv;
	}
	public function getNbLecteurs() {
		return $this->myNbLecteurs;
	}
	public function getNbClicks() {
		return $this->myNbClicks;
	}
	public function getDateCreation() {
		return $this->myDateCreation;
	}
	public function getDescription() {
		return $this->myDescription;
	}
	public function isNew() {
		return (is_null ( $this->myID ) || empty ( $this->myID ));
	}
	public function getJ() {
		return $this->myJ;
	}
	public function getListeDiffusion() {
		return $this->myListeDiffusion;
	}
	public function getListeArticles() {
		return $this->myListeArticles;
	}

	// ### SETTER ###
	public function setID($newValue) {
		if (is_int ( $newValue ) && ! empty ( $newValue )) {
			$this->myID = $newValue;
		} else {
			$this->myID = NULL;
			trigger_error ( 'Champ ID incorrect!' );
		}
	}
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
	public function setNbTot($newValue) {
		$this->myNbTot = $newValue;
	}
	public function setNbOuv($newValue) {
		$this->myNbOuv = $newValue;
	}
	public function setNbLecteurs($newValue) {
		$this->myNbLecteurs = $newValue;
	}
	public function setNbClicks($newValue) {
		$this->myNbClicks = $newValue;
	}
	public function setDateCreation($newValue) {
		if (is_string ( $newValue ) && ! empty ( $newValue )) {
			$this->myDateCreation = $newValue;
		} else {
			$this->myDateCreation = NULL;
			trigger_error ( 'Champ DateCreation incorrect!' );
		}
	}
	public function setDescription($newValue) {
		if (is_string ( $newValue ) && ! empty ( $newValue )) {
			$this->myDescription = $newValue;
		} else {
			$this->myDescription = NULL;
			trigger_error ( 'Champ Description incorrect!' );
		}
	}
	public function setJ($newValue) {
		$this->myJ = $newValue;
	}
	public function setListeDiffusion($newValue) {
		$this->myListeDiffusion = $newValue;
	}
	public function setListeArticles($newValue) {
		$this->myListeArticles = $newValue;
	}
}
?>