<?php
class Survey {
	private $id;
	private $name;
	private $dateCreation;
	private $status;
	const STATUS_DRAFT = 'DRAFT';
	const STATUS_INPROGRESS = 'INPROGRESS';
	const STATUS_CLOSED = 'CLOSED';
	private $envoiInvitation;
	private $envoiRelance;
	public function __construct() {
		$this->id = NULL;
		$this->name = '';
		$this->dateCreation = '';
		$this->status = self::STATUS_DRAFT;
		$this->envoiInvitation = '0';
		$this->envoiRelance = '0';
	}

	// ### GETTER ###
	public function getID() {
		return $this->id;
	}
	public function getName() {
		return $this->name;
	}
	public function getDateCreation() {
		return $this->dateCreation;
	}
	public function getStatus() {
		return $this->status;
	}
	public function getEnvoiInvitation() {
		return $this->envoiInvitation;
	}
	public function getEnvoiRelance() {
		return $this->envoiRelance;
	}

	// ### SETTER ###
	public function setID($newValue) {
		if (is_int ( $newValue ) && ! empty ( $newValue )) {
			$this->id = $newValue;
		} else {
			throw new InvalidArgumentException ();
		}
	}
	public function setName($newValue) {
		if (is_string ( $newValue )) {
			$this->name = $newValue;
		} else {
			throw new InvalidArgumentException ();
		}
	}
	public function setDateCreation($newValue) {
		if (is_string ( $newValue )) {
			$this->dateCreation = $newValue;
		} else {
			throw new InvalidArgumentException ();
		}
	}
	public function setStatus($newValue) {
		if (is_string ( $newValue ) && in_array ( $newValue, array (
				self::STATUS_DRAFT,
				self::STATUS_INPROGRESS,
				self::STATUS_CLOSED
		) )) {
			$this->status = $newValue;
		} else {
			throw new InvalidArgumentException ();
		}
	}
	public function setEnvoiInvitation($newValue) {
		if (is_string ( $newValue )) {
			$this->envoiInvitation = $newValue;
		} else {
			throw new InvalidArgumentException ();
		}
	}
	public function setEnvoiRelance($newValue) {
		if (is_string ( $newValue )) {
			$this->envoiRelance = $newValue;
		} else {
			throw new InvalidArgumentException ();
		}
	}
}
?>