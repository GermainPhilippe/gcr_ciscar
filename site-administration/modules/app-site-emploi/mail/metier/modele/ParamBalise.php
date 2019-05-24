<?php
/**
 * Class utilisée pour la gestion des paramétres balises
 * @author Quentin BRISSON
 * @package app-site-emploi
 * @subpackage mail
 * @version 1.0.4
 *
 */
class ParamBalise {
	private $paramtitrepage;
	private $paramhtmlmetadescacc;
	private $paramhtmlmetarobotacc;
	private $paramhtmlmetakeyacc;
	private $paramhtmlmetadescconcess;
	private $paramhtmlmetarobotconcess;
	private $paramhtmlmetakeyconcess;
	private $paramhtmlmetadesccand;
	private $paramhtmlmetarobotcand;
	private $paramhtmlmetakeycand;
	private $paramh1acc1;
	private $paramh2acc2;
	private $nomsite;
	function __construct() {
		$this->paramtitrepage = '';
		$this->paramhtmlmetadescacc = '';
		$this->paramhtmlmetarobotacc = '';
		$this->paramhtmlmetakeyacc = '';
		$this->paramhtmlmetadescconcess = '';
		$this->paramhtmlmetarobotconcess = '';
		$this->paramhtmlmetakeyconcess = '';
		$this->paramhtmlmetadesccand = '';
		$this->paramhtmlmetarobotcand = '';
		$this->paramhtmlmetakeycand = '';
		$this->paramh1acc1 = '';
		$this->paramh2acc2 = '';
		$this->nomsite = '';
	}

	// #################
	// Get et Set pour le paramètrage de l'accueil
	// Getteur
	/**
	 *
	 * retourne le titre la page
	 *
	 * @return string
	 */
	function getparamtitrepage() {
		return $this->paramtitrepage;
	}
	/**
	 *
	 * retourne les meta description de l'accueil
	 *
	 * @return string
	 */
	function getparamhtmlmetadescacc() {
		return $this->paramhtmlmetadescacc;
	}
	/**
	 *
	 * retourne les meta robots de l'accueil
	 *
	 * @return string
	 */
	function getparamhtmlmetarobotacc() {
		return $this->paramhtmlmetarobotacc;
	}
	/**
	 *
	 * retourne les meta mots-clés de l'accueil
	 *
	 * @return string
	 */
	function getparamhtmlmetakeyacc() {
		return $this->paramhtmlmetakeyacc;
	}
	/**
	 *
	 * retourne les meta description concess
	 *
	 * @return string
	 */
	function getparamhtmlmetadescconcess() {
		return $this->paramhtmlmetadescconcess;
	}
	/**
	 *
	 * retourne les meta robots concess
	 *
	 * @return string
	 */
	function getparamhtmlmetarobotconcess() {
		return $this->paramhtmlmetarobotconcess;
	}
	/**
	 *
	 * retourne les meta mots-clés concess
	 *
	 * @return string
	 */
	function getparamhtmlmetakeyconcess() {
		return $this->paramhtmlmetakeyconcess;
	}
	/**
	 *
	 * retourne les meta description cand
	 *
	 * @return string
	 */
	function getparamhtmlmetadesccand() {
		return $this->paramhtmlmetadesccand;
	}
	/**
	 *
	 * retourne les meta robots cand
	 *
	 * @return string
	 */
	function getparamhtmlmetarobotcand() {
		return $this->paramhtmlmetarobotcand;
	}
	/**
	 *
	 * retourne les meta mots-clés cand
	 *
	 * @return string
	 */
	function getparamhtmlmetakeycand() {
		return $this->paramhtmlmetakeycand;
	}
	/**
	 *
	 * retourne le param h1 accueil1
	 *
	 * @return string
	 */
	function getparamh1acc1() {
		return $this->paramh1acc1;
	}
	/**
	 *
	 * retourne le param h2 accueil2
	 *
	 * @return string
	 */
	function getparamh2acc2() {
		return $this->paramh2acc2;
	}
	/**
	 *
	 * retourne le nom du site
	 *
	 * @return string
	 */
	function getnomsite() {
		return $this->nomsite;
	}

	// Setteur
	/**
	 *
	 * insére le titre la page
	 *
	 * @param string $newvalue
	 */
	public function setparamtitrepage($newValue) {
		$this->paramtitrepage = $newValue;
	}
	/**
	 *
	 * insére les meta description de l'accueil
	 *
	 * @param string $newvalue
	 */
	public function setparamhtmlmetadescacc($newValue) {
		$this->paramhtmlmetadescacc = $newValue;
	}
	/**
	 *
	 * insére les meta robots de l'accueil
	 *
	 * @param string $newvalue
	 */
	public function setparamhtmlmetarobotacc($newValue) {
		$this->paramhtmlmetarobotacc = $newValue;
	}
	/**
	 *
	 * insére les meta mots-clés de l'accueil
	 *
	 * @param string $newvalue
	 */
	public function setparamhtmlmetakeyacc($newValue) {
		$this->paramhtmlmetakeyacc = $newValue;
	}
	/**
	 *
	 * insére les meta description concess
	 *
	 * @param string $newvalue
	 */
	public function setparamhtmlmetadescconcess($newValue) {
		$this->paramhtmlmetadescconcess = $newValue;
	}
	/**
	 *
	 * insére les meta robots concess
	 *
	 * @param string $newvalue
	 */
	public function setparamhtmlmetarobotconcess($newValue) {
		$this->paramhtmlmetarobotconcess = $newValue;
	}
	/**
	 *
	 * insére les meta mots-clés concess
	 *
	 * @param string $newvalue
	 */
	public function setparamhtmlmetakeyconcess($newValue) {
		$this->paramhtmlmetakeyconcess = $newValue;
	}
	/**
	 *
	 * insére les meta description cand
	 *
	 * @param string $newvalue
	 */
	public function setparamhtmlmetadesccand($newValue) {
		$this->paramhtmlmetadesccand = $newValue;
	}
	/**
	 *
	 * insére les meta robots cand
	 *
	 * @param string $newvalue
	 */
	public function setparamhtmlmetarobotcand($newValue) {
		$this->paramhtmlmetarobotcand = $newValue;
	}
	/**
	 *
	 * insére les meta mots-clés cand
	 *
	 * @param string $newvalue
	 */
	public function setparamhtmlmetakeycand($newValue) {
		$this->paramhtmlmetakeycand = $newValue;
	}
	/**
	 *
	 * insére le param h1 accueil1
	 *
	 * @param string $newvalue
	 */
	public function setparamh1acc1($newValue) {
		$this->paramh1acc1 = $newValue;
	}
	/**
	 *
	 * insére le param h2 accueil2
	 *
	 * @param string $newvalue
	 */
	public function setparamh2acc2($newValue) {
		$this->paramh2acc2 = $newValue;
	}
	/**
	 *
	 * insére le nom du site
	 *
	 * @param string $newvalue
	 */
	public function setnomsite($newValue) {
		$this->nomsite = $newValue;
	}

	/**
	 * Met à jour l'ensemble des balises
	 */
	function sql_update_balise() {
		$sql = " UPDATE emploi_param_balise ";
		$sql .= " SET ParamTitrePage = '%s', ParamHtmlMetaDescAccueil = '%s', ParamHtmlMetaRobotAccueil = '%s', ParamHtmlMetaKeywordsAccueil = '%s', ParamHtmlMetaKeywordsConcess = '%s', ";
		$sql .= " ParamHtmlMetaDescConcess = '%s', ParamHtmlMetaRobotConcess = '%s', ParamHtmlMetaKeywordsCandidat = '%s', ";
		$sql .= " ParamHtmlMetaDescCandidat = '%s', ParamHtmlMetaRobotCandidat = '%s', ParamH1Accueil1 = '%s', ";
		$sql .= " ParamH2Acceuil2 = '%s', NomSite = '%s' ";
		$sql .= " WHERE IDBalise = 1";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->paramtitrepage ) ), mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->paramhtmlmetadescacc ) ), mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->paramhtmlmetarobotacc ) ), mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->paramhtmlmetakeyacc ) ), mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->paramhtmlmetakeyconcess ) ), mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->paramhtmlmetadescconcess ) ), mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->paramhtmlmetarobotconcess ) ), mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->paramhtmlmetakeycand ) ), mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->paramhtmlmetadesccand ) ), mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->paramhtmlmetarobotcand ) ), mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->paramh1acc1 ) ), mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->paramh2acc2 ) ), mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->nomsite ) ) );
		

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	/**
	 * Sélectionne l'ensemble des balises
	 */
	function sql_select_balise() {
		$sql = " SELECT ParamTitrePage, ParamHtmlMetaDescAccueil, ParamHtmlMetaRobotAccueil, ParamHtmlMetaKeywordsAccueil, ParamHtmlMetaKeywordsConcess, ";
		$sql .= " ParamHtmlMetaDescConcess, ParamHtmlMetaRobotConcess, ParamHtmlMetaKeywordsCandidat, ";
		$sql .= " ParamHtmlMetaDescCandidat, ParamHtmlMetaRobotCandidat, ParamH1Accueil1, ";
		$sql .= " ParamH2Acceuil2, NomSite ";
		$sql .= " FROM emploi_param_balise ";
		$sql .= " WHERE IDBalise = 1";

		$result = mysqli_query ($_SESSION['LINK'], $sql ) or die ( mysqli_error ($_SESSION['LINK']) );

		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array  ( $result );

			$this->paramtitrepage = $line [0];
			$this->paramhtmlmetadescacc = $line [1];
			$this->paramhtmlmetarobotacc = $line [2];
			$this->paramhtmlmetakeyacc = $line [3];
			$this->paramhtmlmetakeyconcess = $line [4];
			$this->paramhtmlmetadescconcess = $line [5];

			$this->paramhtmlmetarobotconcess = $line [6];
			$this->paramhtmlmetakeycand = $line [7];
			$this->paramhtmlmetadesccand = $line [8];

			$this->paramhtmlmetarobotcand = $line [9];
			$this->paramh1acc1 = $line [10];
			$this->paramh2acc2 = $line [11];

			$this->nomsite = $line [12];
		}
	}
}

?>