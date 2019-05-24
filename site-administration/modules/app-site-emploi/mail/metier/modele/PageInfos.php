<?php
/**
 * Class utilisée pour la gestion des pages infos
 * @author Quentin BRISSON
 * @package app-site-emploi
 * @subpackage mail
 * @version 1.0.4
 *
 */
class PageInfos {
	private $idpageinfo;
	private $espace;
	private $affichage;
	private $titre;
	private $metatag;
	private $contenu;
	public function __construct() {
		$this->idpageinfo = NULL;
		$this->espace = NULL;
		$this->affichage = NULL;
		$this->titre = '';
		$this->metatag = '';
		$this->contenu = '';
	}

	// Getteur
	/**
	 *
	 * Retourne l'id de la page info
	 *
	 * @return int
	 */
	function getidpageinfo() {
		return $this->idpageinfo;
	}
	/**
	 *
	 * Retourne l'espace de la page info
	 *
	 * @return string
	 */
	function getespace() {
		return $this->espace;
	}
	/**
	 *
	 * Retourne l'affichage de la page info
	 *
	 * @return string
	 */
	function getaffichage() {
		return $this->affichage;
	}
	/**
	 *
	 * Retourne le titre la page
	 *
	 * @return string
	 */
	function gettitre() {
		return $this->titre;
	}
	/**
	 *
	 * Retourne les meta
	 *
	 * @return string
	 */
	function getmetatag() {
		return $this->metatag;
	}
	/**
	 *
	 * Retourne le contenu de la page
	 *
	 * @return string
	 */
	function getcontenu() {
		return $this->contenu;
	}

	// Setteur
	/**
	 *
	 * Insére l'id de la page
	 *
	 * @return int
	 */
	public function setidpageinfo($newValue) {
		$this->idpageinfo = $newValue;
	}
	/**
	 *
	 * Insére l'espace de la page
	 *
	 * @return string
	 */
	public function setespace($newValue) {
		$this->espace = $newValue;
	}
	/**
	 *
	 * Insére l'affichage de la page
	 *
	 * @return string
	 */
	public function setaffichage($newValue) {
		$this->affichage = $newValue;
	}
	/**
	 *
	 * Insére le titre de la page
	 *
	 * @return string
	 */
	public function settitre($newValue) {
		$this->titre = $newValue;
	}
	/**
	 *
	 * Insére les meta de la page
	 *
	 * @return string
	 */
	public function setmetatag($newValue) {
		$this->metatag = $newValue;
	}
	/**
	 *
	 * Insére le contenu de la page
	 *
	 * @return string
	 */
	public function setcontenu($newValue) {
		$this->contenu = $newValue;
	}

	// ##############
	/**
	 * Insére une nouvelle page
	 */
	public function sql_insert_page() {
		$sql = "INSERT INTO emploi_page_info (EspacePage, AffichagePage, Titre, MetaTags, Contenu) VALUES ('%s', '%s', '%s', '%s', '%s')";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $this->espace ), mysqli_real_escape_string ($_SESSION['LINK'], $this->affichage ), mysqli_real_escape_string ($_SESSION['LINK'], $this->titre ), mysqli_real_escape_string ($_SESSION['LINK'], $this->metatag ), mysqli_real_escape_string ($_SESSION['LINK'], $this->contenu ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	/**
	 *
	 * Sélectionne une page en fonction de son id
	 *
	 * @param int $id
	 */
	public function sql_select_page($id) {
		$sql = "SELECT IDPageInfo, EspacePage, AffichagePage, Titre, MetaTags, Contenu FROM emploi_page_info WHERE IDPageInfo = '%s'";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $id ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		$line = mysqli_fetch_array  ( $result );

		$this->idpageinfo = $line [0];
		$this->espace = $line [1];
		$this->affichage = $line [2];
		$this->titre = $line [3];
		$this->metatag = $line [4];
		$this->contenu = $line [5];

		mysqli_free_result  ( $result );
	}
	/**
	 * Met à jour une page info
	 */
	public function sql_update_page() {
		$sql = " UPDATE emploi_page_info ";
		$sql .= " SET EspacePage = '%s', AffichagePage = '%s', Titre = '%s', MetaTags = '%s', Contenu = '%s' ";
		$sql .= " WHERE IDPageInfo = '%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $this->espace ), mysqli_real_escape_string ($_SESSION['LINK'], $this->affichage ), mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->titre ) ), mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->metatag ) ), mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->contenu ) ), mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->idpageinfo ) ) );
		

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	/**
	 * Supprime une page info
	 */
	public function sql_delete_page() {
		$sql = "DELETE FROM emploi_page_info WHERE IDPageInfo='%s'";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $this->idpageinfo ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
}