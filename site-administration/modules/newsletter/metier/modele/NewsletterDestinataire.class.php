<?php
class NewsletterDestinataire {
	private $myNewsletterID;
	private $myListeDiffusionID;
	public function __construct() {
		$this->myNewsletterID = NULL;
		$this->myListeDiffusionID = NULL;
	}

	// ### GETTER ###
	public function getNewsletterID() {
		return $this->myNewsletterID;
	}
	public function getListeDiffusionID() {
		return $this->myListeDiffusionID;
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
	public function setListeDiffusionID($newValue) {
		if (is_int ( $newValue ) && ! empty ( $newValue )) {
			$this->myListeDiffusionID = $newValue;
		} else {
			$this->myListeDiffusionID = NULL;
			trigger_error ( 'Champ ListeDiffusionID incorrect!' );
		}
	}
}
?>