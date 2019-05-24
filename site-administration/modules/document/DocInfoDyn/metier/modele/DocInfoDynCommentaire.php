<?php
/**
 * Cette classe permet de gerer les commentaires des document DocInfoDyn
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage document
 * @version 2.0.1
 *
 */
class DocInfoDynCommentaire {
	private $myID;
	private $myAuthorID;
	private $myDocInfoDynID;
	private $myRichTextContentValue;
	private $myDateCreation;
	private $mySiteID;
	public function __construct() {
		$this->myID = NULL;
		$this->myAuthorID = NULL;
		$this->myDocInfoDynID = NULL;
		$this->myRichTextContentValue = '';
		$this->myDateCreation = time ();
		$this->mySiteID = NULL;
	}

	// ### GETTER ###
	public function getID() {
		return $this->myID;
	}
	public function getAuthorID() {
		return $this->myAuthorID;
	}
	public function getDocInfoDynID() {
		return $this->myDocInfoDynID;
	}
	public function getRichTextContentValue() {
		return $this->myRichTextContentValue;
	}
	public function getDateCreation() {
		return $this->myDateCreation;
	}
	public function getSiteID() {
		return $this->mySiteID;
	}
	public function isNew() {
		return is_null ( $this->myID );
	}

	// ### SETTER ###
	public function setID($newValue) {
		if (is_int ( $newValue ) && ! empty ( $newValue )) {
			$this->myID = ( int ) $newValue;
		} else {
			$this->myID = NULL;
			trigger_error ( 'Champ ID Incorrecte !' );
		}
	}
	public function setAuthorID($newValue) {
		if (is_int ( $newValue ) && ! empty ( $newValue )) {
			$this->myAuthorID = ( int ) $newValue;
		} else {
			$this->myAuthorID = NULL;
			trigger_error ( 'Champ AuthorID Incorrecte !' );
		}
	}
	public function setDocInfoDynID($newValue) {
		if (is_int ( $newValue ) && ! empty ( $newValue )) {
			$this->myDocInfoDynID = ( int ) $newValue;
		} else {
			$this->myDocInfoDynID = NULL;
			trigger_error ( 'Champ DocInfoDynID Incorrecte !' );
		}
	}
	public function setRichTextContentValue($newValue) {
		if (is_string ( $newValue ) && ! empty ( $newValue )) {
			$this->myRichTextContentValue = $newValue;
		} else {
			$this->myRichTextContentValue = '';
			trigger_error ( 'Champ RichTextContentValue Incorrecte !' );
		}
	}
	public function setDateCreation($newValue) {
		$this->myDateCreation = $newValue;
	}
	public function setSiteID($newValue) {
		if (is_int ( $newValue ) && ! empty ( $newValue )) {
			$this->mySiteID = $newValue;
		} else {
			$this->mySiteID = NULL;
			trigger_error ( 'Champ SiteID Incorrecte !' );
		}
	}
}
?>