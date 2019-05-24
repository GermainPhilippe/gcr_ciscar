<?php
class ListeDiffusion {
	private $myID;
	private $myNom;
	private $myType;
	private $mySiteID;
	const TYPE_SYMPLE = 'Simple';
	const TYPE_SIMPLE_OU = 'SimpleOU';
	const TYPE_SIMPLE_ET = 'SimpleET';
	const TYPE_SPECIFIQUE = 'Specifique';
	const TYPE_SPECIFIQUE_OU = 'SpecifiqueOU';
	const TYPE_SPECIFIQUE_ET = 'SpecifiqueET';

	// Maj germain 20150324 ajout du type CSV
	const TYPE_CSV = 'csv';
	const TYPE_CSV_OU = 'csvOU';
	const TYPE_CSV_ET = 'csvET';
	public function __construct() {
		$this->myID = NULL;
		$this->myNom = '';
		$this->myType = self::TYPE_SIMPLE_ET;
		$this->mySiteID = NULL;
	}

	// ### GETTER ###
	public function getID() {
		return $this->myID;
	}
	public function getNom() {
		return $this->myNom;
	}
	public function getType() {
		return $this->myType;
	}
	public function getSiteID() {
		return $this->mySiteID;
	}
	public function isNew() {
		return (is_null ( $this->myID ) || empty ( $this->myID ));
	}

	// ### SETTER ###
	public function setID($newValue) {
		if (is_int ( $newValue ) && ! empty ( $newValue )) {
			$this->myID = $newValue;
		} else {
			$this->myID = NULL;
			trigger_error ( 'Champ ID Invalide !' );
		}
	}
	public function setNom($newValue) {
		if (is_string ( $newValue ) && ! empty ( $newValue )) {
			$this->myNom = $newValue;
		} else {
			$this->myNom = '';
			trigger_error ( 'Champ Nom Invalide !' );
		}
	}
	public function setType($newValue) {
		$aTypeArray = array ();
		$aTypeArray [] = self::TYPE_SIMPLE_OU;
		$aTypeArray [] = self::TYPE_SIMPLE_ET;
		$aTypeArray [] = self::TYPE_SPECIFIQUE_OU;
		$aTypeArray [] = self::TYPE_SPECIFIQUE_ET;
		$aTypeArray [] = self::TYPE_CSV_OU;
		$aTypeArray [] = self::TYPE_CSV_ET;

		if (is_string ( $newValue ) && in_array ( $newValue, $aTypeArray )) {
			$this->myType = $newValue;
		} else {
			$this->myType = self::TYPE_SIMPLE_OU;
			trigger_error ( 'Champ Type Incorrecte !' );
		}
	}
	public function setSiteID($newValue) {
		if (is_int ( $newValue ) && ! empty ( $newValue )) {
			$this->mySiteID = $newValue;
		} else {
			$this->mySiteID = NULL;
			trigger_error ( 'Champ SiteID Invalide !' );
		}
	}
}
?>