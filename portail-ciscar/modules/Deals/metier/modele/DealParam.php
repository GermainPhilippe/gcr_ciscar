<?php
/**
 * @author Philippe GERMAIN
 * @package portail-ciscar
 * @subpackage deals
 * @version 1.0.4
 */
class DealParam {
	private $ParamID;
	private $DealsID;
	private $ParamLibelle;
	private $ParamInput;
	private $ParamQteCmd;
	public function __construct() {
		$this->ParamID = NULL;
		$this->DealsID = NULL;
		$this->ParamLibelle = '';
		$this->ParamInput = '';
		$this->ParamQteCmd = 0;
	}
	
	// ###
	public function getParamID() {
		return $this->ParamID;
	}
	public function getDealsID() {
		return $this->DealsID;
	}
	public function getParamLibelle() {
		return $this->ParamLibelle;
	}
	public function getParamInput() {
		return $this->ParamInput;
	}
	public function getParamQteCmd() {
		return $this->ParamQteCmd;
	}
	public function setParamID($newValue) {
		$this->ParamID = $newValue;
	}
	public function setDealsID($newValue) {
		$this->DealsID = $newValue;
	}
	public function setParamLibelle($newValue) {
		$this->ParamLibelle = $newValue;
	}
	public function setParamInput($newValue) {
		$this->ParamInput = $newValue;
	}
	public function setParamQteCmd($newValue) {
		$this->ParamQteCmd = $newValue;
	}
	
	// ###
}
?>