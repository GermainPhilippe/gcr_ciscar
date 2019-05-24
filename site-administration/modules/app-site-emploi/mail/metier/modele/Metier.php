<?php
/**
 * Class gérant les metiers
 * @author Philippe GERMAIN
 * @package site-emploi
 * @subpackage commun
 * @version 1.0.4
 */
class Metier {
	private $idcatmetier;
	private $idmetier;
	private $nommetier;
	private $nomcatmetier;
	public function __construct() {
		$this->idmetier = NULL;
		$this->idcatmetier = NULL;
		$this->nommetier = '';
		$this->nomcatmetier = '';
	}
	public function getidmetier() {
		return $this->idmetier;
	}
	public function getidcatmetier() {
		return $this->idcatmetier;
	}
	public function getnommetier() {
		return $this->nommetier;
	}
	public function getnomcatmetier() {
		return $this->nomcatmetier;
	}
	public function setidmetier($newvalue) {
		$this->idmetier = $newvalue;
	}
	public function setidcatmetier($newvalue) {
		$this->idcatmetier = $newvalue;
	}
	public function setnommetier($newvalue) {
		$this->nommetier = $newvalue;
	}
	public function setnomcatmetier($newvalue) {
		$this->nomcatmetier = $newvalue;
	}
}