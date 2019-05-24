<?php
/**
 * @author Florent DESPIERRES
 * @package app-convention
 * @subpackage Parametre
 * @version 1.0.4
 */
class ParametreMail {
	private $MailFrom;
	private $MailSubject;
	private $MailHeader;
	private $MailFooter;
	public function __construct() {
		$this->MailFrom = '';
		$this->MailSubject = '';
		$this->MailHeader = '';
		$this->MailFooter = '';
	}

	// ###
	public function getMailFrom() {
		return $this->MailFrom;
	}
	public function getMailSubject() {
		return $this->MailSubject;
	}
	public function getMailHeader() {
		return $this->MailHeader;
	}
	public function getMailFooter() {
		return $this->MailFooter;
	}
	public function setMailFrom($newValue) {
		$this->MailFrom = $newValue;
	}
	public function setMailSubject($newValue) {
		$this->MailSubject = $newValue;
	}
	public function setMailHeader($newValue) {
		$this->MailHeader = $newValue;
	}
	public function setMailFooter($newValue) {
		$this->MailFooter = $newValue;
	}
}
?>