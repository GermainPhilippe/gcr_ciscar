<?php
/**
 * Class utilisée pour la gestion des paramétres de l'accueil
 * @author Quentin BRISSON
 * @package app-site-emploi
 * @subpackage mail
 * @version 1.0.4
 *
 */
class ParamAccueil {
	private $paramemploirenault;
	private $parampictpartenaireacc;
	private $parampictpartenairecand;
	private $parampictpartenaireconcess;
	private $paramconcess;
	private $paramcandidat;
	private $paramlienconcession;
	private $paramliencandidat;
	private $paramlibelleco1;
	private $paramlibelleco2;
	private $paramlibelleca1;
	private $paramlibelleca2;
	private $paramlienpublicite;
	private $paramaffichecompteur;
	private $paramhtmlmetakeyacc;
	private $paramhtmlmetakeyconcess;
	private $paramhtmlmetakeycand;
	function __construct() {
		$this->paramemploirenault = '';
		$this->parampictpartenaireacc = '';
		$this->parampictpartenairecand = '';
		$this->parampictpartenaireconcess = '';
		$this->paramconcess = '';
		$this->paramcandidat = '';
		$this->paramlienconcession = '';
		$this->paramliencandidat = '';
		$this->paramlibelleco1 = '';
		$this->paramlibelleco2 = '';
		$this->paramlibelleca1 = '';
		$this->paramlibelleca2 = '';
		$this->paramlienpublicite = '';
		$this->paramaffichecompteur = null;
		$this->paramhtmlmetakeyacc = '';
		$this->paramhtmlmetakeyconcess = '';
		$this->paramhtmlmetakeycand = '';
	}

	// #################
	// Get et Set pour le paramètrage de l'accueil
	// Getteur
	/**
	 *
	 * retourne le param renault
	 *
	 * @return string
	 */
	function getparamemploirenault() {
		return $this->paramemploirenault;
	}
	/**
	 *
	 * retourne le param picto partenaire accueil
	 *
	 * @return string
	 */
	function getparampictpartenaireacc() {
		return $this->parampictpartenaireacc;
	}
	/**
	 *
	 * retourne le param picto partenaire candidat
	 *
	 * @return string
	 */
	function getparampictpartenairecand() {
		return $this->parampictpartenairecand;
	}
	/**
	 *
	 * retourne le param picto partenaire concess
	 *
	 * @return string
	 */
	function getparampictpartenaireconcess() {
		return $this->parampictpartenaireconcess;
	}
	/**
	 *
	 * retourne le paramètre concess
	 *
	 * @return string
	 */
	function getparamconcess() {
		return $this->paramconcess;
	}
	/**
	 *
	 * retourne le paramètre candidat
	 *
	 * @return string
	 */
	function getparamcandidat() {
		return $this->paramcandidat;
	}
	/**
	 *
	 * retourne le paramètre lien concess
	 *
	 * @return string
	 */
	function getparamlienconcession() {
		return $this->paramlienconcession;
	}
	/**
	 *
	 * retourne le paramètre lien candidat
	 *
	 * @return string
	 */
	function getparamliencandidat() {
		return $this->paramliencandidat;
	}
	/**
	 *
	 * retourne le paramétre libelle colonne 1
	 *
	 * @return string
	 */
	function getparamlibelleco1() {
		return $this->paramlibelleco1;
	}
	/**
	 *
	 * retourne le paramétre libelle colonne 2
	 *
	 * @return string
	 */
	function getparamlibelleco2() {
		return $this->paramlibelleco2;
	}
	/**
	 *
	 * retourne le paramétre libelle ca1
	 *
	 * @return string
	 */
	function getparamlibelleca1() {
		return $this->paramlibelleca1;
	}
	/**
	 *
	 * retourne le paramétre libelle ca2
	 *
	 * @return string
	 */
	function getparamlibelleca2() {
		return $this->paramlibelleca2;
	}
	/**
	 *
	 * retourne le paramètre lien publicité
	 *
	 * @return string
	 */
	function getparamlienpublicite() {
		return $this->paramlienpublicite;
	}
	/**
	 *
	 * retourne le paramètre compteur
	 *
	 * @return string
	 */
	function getparamaffichecompteur() {
		return $this->paramaffichecompteur;
	}
	/**
	 *
	 * retourne les mots clés accueil
	 *
	 * @return string
	 */
	function getparamhtmlmetakeyacc() {
		return $this->paramhtmlmetakeyacc;
	}
	/**
	 *
	 * retourne les mots clés concess
	 *
	 * @return string
	 */
	function getparamhtmlmetakeyconcess() {
		return $this->paramhtmlmetakeyconcess;
	}
	/**
	 *
	 * retourne les mots clés candidat
	 *
	 * @return string
	 */
	function getparamhtmlmetakeycand() {
		return $this->paramhtmlmetakeycand;
	}

	// Setteur
	/**
	 *
	 * insére le param renault
	 *
	 * @param string $newvalue
	 */
	public function setparamemploirenault($newValue) {
		$this->paramemploirenault = $newValue;
	}
	/**
	 *
	 * insére le param picto partenaire accueil
	 *
	 * @param string $newvalue
	 */
	public function setparampictpartenaireacc($newValue) {
		$this->parampictpartenaireacc = $newValue;
	}
	/**
	 *
	 * insére le param picto partenaire candidat
	 *
	 * @param string $newvalue
	 */
	public function setparampictpartenairecand($newValue) {
		$this->parampictpartenairecand = $newValue;
	}
	/**
	 *
	 * insére le param picto partenaire concess
	 *
	 * @param string $newvalue
	 */
	public function setparampictpartenaireconcess($newValue) {
		$this->parampictpartenaireconcess = $newValue;
	}
	/**
	 *
	 * insére le paramètre concess
	 *
	 * @param string $newvalue
	 */
	public function setparamconcess($newValue) {
		$this->paramconcess = $newValue;
	}
	/**
	 *
	 * insére le paramètre candidat
	 *
	 * @param string $newvalue
	 */
	public function setparamcandidat($newValue) {
		$this->paramcandidat = $newValue;
	}
	/**
	 *
	 * insére le paramètre lien concess
	 *
	 * @param string $newvalue
	 */
	public function setparamlienconcession($newValue) {
		$this->paramlienconcession = $newValue;
	}
	/**
	 *
	 * insére le paramètre lien candidat
	 *
	 * @param string $newvalue
	 */
	public function setparamliencandidat($newValue) {
		$this->paramliencandidat = $newValue;
	}
	/**
	 *
	 * insére le paramétre libelle colonne 1
	 *
	 * @param string $newvalue
	 */
	public function setparamlibelleco1($newValue) {
		$this->paramlibelleco1 = $newValue;
	}
	/**
	 *
	 * insére le paramétre libelle colonne 2
	 *
	 * @param string $newvalue
	 */
	public function setparamlibelleco2($newValue) {
		$this->paramlibelleco2 = $newValue;
	}
	/**
	 *
	 * insére le paramétre libelle ca1
	 *
	 * @param string $newvalue
	 */
	public function setparamlibelleca1($newValue) {
		$this->paramlibelleca1 = $newValue;
	}
	/**
	 *
	 * insére le paramétre libelle ca2
	 *
	 * @param string $newvalue
	 */
	public function setparamlibelleca2($newValue) {
		$this->paramlibelleca2 = $newValue;
	}
	/**
	 *
	 * insére le paramètre lien publicité
	 *
	 * @param string $newvalue
	 */
	public function setparamlienpublicite($newValue) {
		$this->paramlienpublicite = $newValue;
	}
	/**
	 *
	 * insére le paramètre compteur
	 *
	 * @param string $newvalue
	 */
	public function setparamaffichecompteur($newValue) {
		$this->paramaffichecompteur = $newValue;
	}
	/**
	 *
	 * insére les mots clés accueil
	 *
	 * @param string $newvalue
	 */
	public function setparamhtmlmetakeyacc($newValue) {
		$this->paramhtmlmetakeyacc = $newValue;
	}
	/**
	 *
	 * insére les mots clés concess
	 *
	 * @param string $newvalue
	 */
	public function setparamhtmlmetakeyconcess($newValue) {
		$this->paramhtmlmetakeyconcess = $newValue;
	}
	/**
	 *
	 * insére les mots clés candidat
	 *
	 * @param string $newvalue
	 */
	public function setparamhtmlmetakeycand($newValue) {
		$this->paramhtmlmetakeycand = $newValue;
	}

	/**
	 * Met à jour les paramètres des l'accueil
	 */
	function sql_update_accueil() {
		$sql = " UPDATE emploi_param_accueil ";
		$sql .= " SET ParamEmploiRenault = '%s', ParamPictPartenairesAccueil = '%s', ParamPictPartenairesCandidat = '%s', ParamPictPartenairesConcess = '%s', ParamConcession = '%s', ";
		$sql .= " ParamCandidat = '%s', ParamLienConcession = '%s', ParamLienCandidat = '%s', ";
		$sql .= " ParamLibelleCo1 = '%s', ParamLibelleCo2 = '%s', ParamLibelleCa1 = '%s', ";
		$sql .= " ParamLibelleCa2 = '%s', ParamLienPublicite = '%s', ParamAfficheCompteurs = '%s', ";
		$sql .= " ParamHtmlMetaKeywordsAccueil = '%s', ParamHtmlMetaKeywordsConcess = '%s', ParamHtmlMetaKeywordsCandidat = '%s' ";
		$sql .= " WHERE IDAccueil = 1";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->paramemploirenault ) ), mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->parampictpartenaireacc ) ), mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->parampictpartenairecand ) ), mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->parampictpartenaireconcess ) ), mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->paramconcess ) ), mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->paramcandidat ) ), mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->paramlienconcession ) ), mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->paramliencandidat ) ), mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->paramlibelleco1 ) ), mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->paramlibelleco2 ) ), mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->paramlibelleca1 ) ), mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->paramlibelleca2 ) ), mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->paramlienpublicite ) ), mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->paramaffichecompteur ) ), mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->paramhtmlmetakeyacc ) ), mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->paramhtmlmetakeyconcess ) ), mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->paramhtmlmetakeycand ) ) );
		

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	/**
	 * Sélectionne les paramétres de l'accueil
	 */
	function sql_select_accueil() {
		$sql = " SELECT IDAccueil, ParamEmploiRenault, ParamPictPartenairesAccueil, ParamPictPartenairesCandidat, ParamPictPartenairesConcess, ParamConcession, ";
		$sql .= " ParamCandidat, ParamLienConcession, ParamLienCandidat, ";
		$sql .= " ParamLibelleCo1, ParamLibelleCo2, ParamLibelleCa1, ";
		$sql .= " ParamLibelleCa2, ParamLienPublicite, ParamAfficheCompteurs, ";
		$sql .= " ParamHtmlMetaKeywordsAccueil, ParamHtmlMetakeywordsConcess, ParamHtmlMetaKeywordsCandidat ";
		$sql .= " FROM emploi_param_accueil ";
		$sql .= " WHERE IDAccueil = 1";

		$result = mysqli_query ($_SESSION['LINK'], $sql ) or die ( mysqli_error ($_SESSION['LINK']) );

		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array  ( $result );

			$this->idaccueil = $line [0];
			$this->paramemploirenault = $line [1];
			$this->parampictpartenaireacc = $line [2];
			$this->parampictpartenairecand = $line [3];
			$this->parampictpartenaireconcess = $line [4];
			$this->paramconcess = $line [5];

			$this->paramcandidat = $line [6];
			$this->paramlienconcession = $line [7];
			$this->paramliencandidat = $line [8];

			$this->paramlibelleco1 = $line [9];
			$this->paramlibelleco2 = $line [10];
			$this->paramlibelleca1 = $line [11];

			$this->paramlibelleca2 = $line [12];
			$this->paramlienpublicite = $line [13];
			$this->paramaffichecompteur = $line [14];

			$this->paramhtmlmetakeyacc = $line [15];
			$this->paramhtmlmetakeyconcess = $line [16];
			$this->paramhtmlmetakeycand = $line [17];
		}
	}
}

?>