<?php
/**
 * Class utilisée pour la gestion des paramétres mail
 * @author Quentin BRISSON
 * @package app-site-emploi
 * @subpackage mail
 * @version 1.0.4
 *
 */
class ParametreMail {
	private $MailObjet;
	private $MailTete;
	private $MailPied;
	public function __construct() {
		$this->MailObjet = '';
		$this->MailTete = '';
		$this->Mailpied = '';
	}

	// ###

	/**
	 * Récupère l'objet du mail
	 */
	public function getMailObjet() {
		return $this->MailObjet;
	}
	/**
	 * Récupère l'entête du mail
	 */
	public function getMailTete() {
		return $this->MailTete;
	}
	/**
	 * Récupère le pied du mail
	 */
	public function getMailPied() {
		return $this->MailPied;
	}

	/**
	 * Insère l'objet du mail
	 */
	public function setMailObjet($newValue) {
		$this->MailObjet = $newValue;
	}
	/**
	 * Insère l'entête du mail
	 */
	public function setMailTete($newValue) {
		$this->MailTete = $newValue;
	}
	/**
	 * Insère le pied du mail
	 */
	public function setMailPied($newValue) {
		$this->MailPied = $newValue;
	}
}
?>