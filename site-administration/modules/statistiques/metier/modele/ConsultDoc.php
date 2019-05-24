<?php
/**
 * Class utilisée dans l'ensemble des stats contenant toutes les infos d'un document
 * @author Alexandre DIALLO
 * @package site-administration
 * @subpackage statistiques
 * @version 1.0.4
 */
class ConsultDoc {
	private $title;
	private $consult;
	private $type;
	private $theme;
	private $metier;
	private $date;
	private $categorie;
	private $region;
	private $domaine;
	public function __construct() {
		$this->title = '';
		$this->consult = '';
		$this->type = '';
		$this->theme = '';
		$this->metier = '';
		$this->date = '';
		$this->categorie = '';
		$this->region = '';
		$this->domaine = '';
	}

	// ###

	// getteurs
	/**
	 * Retourne le titre du document
	 *
	 * @return string
	 */
	public function gettitle() {
		return $this->title;
	}
	/**
	 * Retourne le nombre de consultations
	 *
	 * @return int
	 */
	public function getconsult() {
		return $this->consult;
	}
	/**
	 * Retourne le Libelle du type
	 *
	 * @return string
	 */
	public function gettype() {
		return $this->type;
	}
	/**
	 * Retourne le Libelle du theme
	 *
	 * @return string
	 */
	public function gettheme() {
		return $this->theme;
	}
	/**
	 * Retourne le Libelle du metier
	 *
	 * @return string
	 */
	public function getmetier() {
		return $this->metier;
	}
	/**
	 * Retourne la date de la consultation
	 *
	 * @return date (Y-m-d)
	 */
	public function getdate() {
		return $this->date;
	}
	/**
	 * Retourne la catégorie
	 *
	 * @return int 0.DocInfoDyn
	 *         1.DocStatic
	 *         2.DocPartenaire
	 */
	public function getcategorie() {
		return $this->categorie;
	}
	/**
	 * Retourne le Libelle de la région
	 *
	 * @return string
	 */
	public function getregion() {
		return $this->region;
	}
	/**
	 * Retourne le Libelle du domaine
	 *
	 * @return string
	 */
	public function getdomaine() {
		return $this->domaine;
	}
	// setteurs
	/**
	 * Insére le titre du document
	 */
	public function settitle($newValue) {
		$this->title = $newValue;
	}
	/**
	 * Insére le nombre de consultations
	 */
	public function setconsult($newValue) {
		$this->consult = $newValue;
	}
	/**
	 * Insére le Libelle du type
	 */
	public function settype($newValue) {
		$this->type = $newValue;
	}
	/**
	 * Insére le Libelle du theme
	 */
	public function settheme($newValue) {
		$this->theme = $newValue;
	}
	/**
	 * Insére le Libelle du Metier
	 */
	public function setmetier($newValue) {
		$this->metier = $newValue;
	}
	/**
	 * Insére la date de la consultation
	 */
	public function setdate($newValue) {
		$this->date = $newValue;
	}
	/**
	 * Insére la catégorie du document
	 *
	 * @param int $newValue
	 *        	0.DocInfoDyn
	 *        	1.DocStatic
	 *        	2.DocPartenaire
	 */
	public function setcategorie($newValue) {
		$this->categorie = $newValue;
	}
	/**
	 * Retourne le Libelle de la région
	 */
	public function setregion($newValue) {
		$this->region = $newValue;
	}
	/**
	 * Insére le Libelle du domaine
	 */
	public function setdomaine($newValue) {
		$this->domaine = $newValue;
	}
}
	