<?php
class DocInfoDynCommentaireDestinataire {
	private $myDocInfoDynID;
	private $myIndividuID;
	public function __construct() {
		$this->myDocInfoDynID = NULL;
		$this->myIndividuID = NULL;
	}
	
	// ###
	public function getDocInfoDynID() {
		return $this->myDocInfoDynID;
	}
	public function getIndividuID() {
		return $this->myIndividuID;
	}
	public function setDocInfoDynID($newValue) {
		if (is_int ( $newValue ) && ! empty ( $newValue )) {
			$this->myDocInfoDynID = ( int ) $newValue;
		} else {
			$this->myDocInfoDynID = NULL;
			trigger_error ( 'Champ DocInfoDynID Incorrecte !' );
		}
	}
	public function setIndividuID($newValue) {
		if (is_int ( $newValue ) && ! empty ( $newValue )) {
			$this->myIndividuID = ( int ) $newValue;
		} else {
			$this->myIndividuID = NULL;
			trigger_error ( 'Champ IndividuID Incorrecte !' );
		}
	}
}
?>