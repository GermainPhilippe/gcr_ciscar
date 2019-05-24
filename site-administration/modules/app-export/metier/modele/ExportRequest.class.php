<?php
class ExportRequest {
	private $myID;
	private $myName;
	private $mySQLRequest;
	private $myOutputFilename;
	private $myColumnName;
	public function __construct() {
		$this->myID = NULL;
		$this->myName = '';
		$this->mySQLRequest = '';
		$this->myOutputFilename = '';
		$this->myColumnName = '';
	}

	// ### GETTER ###
	public function getID() {
		return $this->myID;
	}
	public function getName() {
		return $this->myName;
	}
	public function getSQLRequest() {
		return $this->mySQLRequest;
	}
	public function getOutputFilename() {
		return $this->myOutputFilename;
	}
	public function getColumnName() {
		return $this->myColumnName;
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
			trigger_error ( 'Champ ID Incorrect!' );
		}
	}
	public function setName($newValue) {
		if (is_string ( $newValue )) {
			$this->myName = $newValue;
		} else {
			$this->myName = '';
			trigger_error ( 'Champ Name Incorrect!' );
		}
	}
	public function setSQLRequest($newValue) {
		if (is_string ( $newValue )) {
			$this->mySQLRequest = $newValue;
		} else {
			$this->mySQLRequest = '';
			trigger_error ( 'Champ SQLRequest Incorrect!' );
		}
	}
	public function setOutputFilename($newValue) {
		if (is_string ( $newValue )) {
			$this->myOutputFilename = $newValue;
		} else {
			$this->myOutputFilename = '';
			trigger_error ( 'Champ OutputFilename Incorrect!' );
		}
	}
	public function setColumnName($newValue) {
		if (is_string ( $newValue )) {
			$this->myColumnName = $newValue;
		} else {
			$this->myColumnName = '';
			trigger_error ( 'Champ ColumnName Incorrect!' );
		}
	}
}
?>