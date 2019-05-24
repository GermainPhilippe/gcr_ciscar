<?php
class Newsletter {
	private $myID;
	private $myName;
	private $myFrom;
	private $myReplyTo;
	private $mySubject;
	private $myRichContentValue;
	private $mySiteID;
	private $cssHeader;	
	private $newsBloquee;
	
	public function __construct() {
		$this->myID = NULL;
		$this->myName = '';
		$this->myFrom = '';
		$this->myReplyTo = '';
		$this->mySubject = '';
		$this->myRichContentValue = '';
		$this->mySiteID = NULL;
		$this->newsBloquee = 0;
		
		$this->cssHeader = '';
	}

	// ### GETTER ###
	public function getID() {
		return $this->myID;
	}
	public function getName() {
		return $this->myName;
	}
	public function getNewsBloquee() {
		return $this->newsBloquee;
	}
	public function getFrom() {
		return $this->myFrom;
	}
	public function getReplyTo() {
		return $this->myReplyTo;
	}
	public function getSubject() {
		return $this->mySubject;
	}
	public function getRichContentValue() {
		return $this->myRichContentValue;
	}
	public function getSiteID() {
		return $this->mySiteID;
	}
	public function isNew() {
		return (is_null ( $this->myID ) || empty ( $this->myID ));
	}
	public function getCssHeader() {
		return $this->cssHeader;
	}

	// ### SETTER ###
	public function setID($newValue) {
		if (is_int ( $newValue ) && ! empty ( $newValue )) {
			$this->myID = $newValue;
		} else {
			$this->myID = NULL;
			trigger_error ( 'Champ ID Incorrect !' );
		}
	}
	public function setName($newValue) {
		if (is_string ( $newValue )) {
			$this->myName = $newValue;
		} else {
			$this->myName = NULL;
			trigger_error ( 'Champ Name Incorrect !' );
		}
	}
	public function setNewsBloquee($newValue) {
		$this->newsBloquee = $newValue;
	}
	public function setFrom($newValue) {
		if (is_string ( $newValue ) && ! empty ( $newValue )) {
			$this->myFrom = $newValue;
		} else {
			$this->myFrom = NULL;
			trigger_error ( 'Champ FROM Incorrect !' );
		}
	}
	public function setReplyTo($newValue) {
		if (is_string ( $newValue ) && ! empty ( $newValue )) {
			$this->myReplyTo = $newValue;
		} else {
			$this->myReplyTo = NULL;
			trigger_error ( 'Champ ReplyTo Incorrect !' );
		}
	}
	public function setSubject($newValue) {
		if (is_string ( $newValue )) {
			$this->mySubject = $newValue;
		} else {
			$this->mySubject = NULL;
			trigger_error ( 'Champ Subject Incorrect !' );
		}
	}
	public function setRichContentValue($newValue) {
		if (is_string ( $newValue )) {
			$this->myRichContentValue = $newValue;
		} else {
			$this->myRichContentValue = NULL;
			trigger_error ( 'Champ RichContentValue Incorrect !' );
		}
	}
	public function setCssHeader($newValue) {
		$this->cssHeader = $newValue;
	}
	public function setSiteID($newValue) {
		if (is_int ( $newValue ) && ! empty ( $newValue )) {
			$this->mySiteID = $newValue;
		} else {
			$this->mySiteID = NULL;
			trigger_error ( 'Champ SiteID Incorrect !' );
		}
	}
}
?>