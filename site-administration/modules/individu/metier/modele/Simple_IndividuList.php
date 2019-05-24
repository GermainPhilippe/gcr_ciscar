<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage individu
 * @version 1.0.4
 */
class Simple_IndividuList {
	private $myList;
	private $myListMails;
	public function __construct() {
		$this->myList = array ();
		$this->myListMails = '';
	}
	public function getList() {
		return $this->myList;
	}
	public function getListMails() {
		return $this->myListMails;
	}
	public function setList($newValue) {
		$this->myList = $newValue;
	}
	public function setListMails($newValue) {
		$this->myListMails = $newValue;
	}

	// ###

	// Renvoi le nb max d'individu sans recherche
	public function SQL_COUNT() {
		$sql = "SELECT count(*) FROM annuaire_individu WHERE AnnuaireID='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ) );
		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
		$line = mysqli_fetch_array  ( $result );
		return $line [0];
	}

	// Liste diffusion fourni la requete
	public function SQL_SELECT_ALL_WITH_RQT($aRQT) {
		$this->myList = array ();

		$result = mysqli_query ($_SESSION['LINK'], $aRQT ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aModele = new Simple_Individu ();
			$aModele->setID ( $line [0] );
			$aModele->setNom ( $line [1] );
			$aModele->setPrenom ( $line [2] );
			$aModele->setMail ( $line [3] );
			if (isset ( $line [4] ))
				$aModele->setEtablissementID ( $line [4] );

			$this->myList [] = $aModele;
		}

		mysqli_free_result  ( $result );
	}

	// Liste des mails fourni la requete
	public function SQL_SELECT_MAILS_WITH_RQT($aRQT) {
		$this->myListMails = '';

		$result = mysqli_query ($_SESSION['LINK'], $aRQT ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			// on ne tient pas compte des mails en double
			if (! strpos ( $this->myListMails, $line [3] ))
				$this->myListMails = $this->myListMails . $line [3] . ';';
		}

		mysqli_free_result  ( $result );
	}

	// Cette methode n'est plus utilisée
	public function SQL_SELECT_ALL() {
		$this->myList = array ();
		$sql = "SELECT IndividuID, Nom, Prenom, LoginSage FROM annuaire_individu WHERE AnnuaireID='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aModele = new Simple_Individu ();
			$aModele->setID ( $line [0] );
			$aModele->setNom ( $line [1] );
			$aModele->setPrenom ( $line [2] );
			$aModele->setLoginSage ( $line [3] );

			$this->myList [] = $aModele;
		}

		mysqli_free_result  ( $result );
	}
	public function SQL_SELECT_PAGE($NumPage, $NumEntry, $tri, $ordre) {
		$this->myList = array ();

		$this->myList = array ();

		switch ($tri) {
			case 1 :
				$tri = 'IndividuID';
				break;
			case 2 :
				$tri = 'Nom';
				break;
			case 3 :
				$tri = 'Prenom';
				break;
			default :
				$tri = 'Nom';
				break;
		}

		switch ($ordre) {
			case 'a' :
				$ordre = 'ASC';
				break;
			case 'd' :
				$ordre = 'DESC';
				break;
			default :
				$ordre = 'DESC';
				break;
		}

		$sql = "SELECT IndividuID, Nom, Prenom, LoginSage FROM annuaire_individu WHERE AnnuaireID='%s'  ORDER BY %s  %s   LIMIT %d, %d";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ), mysqli_real_escape_string ($_SESSION['LINK'], $tri ), mysqli_real_escape_string ($_SESSION['LINK'], $ordre ), ($NumPage - 1) * $NumEntry, $NumEntry );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aModele = new Simple_Individu ();
			$aModele->setID ( $line [0] );
			$aModele->setNom ( $line [1] );
			$aModele->setPrenom ( $line [2] );
			$aModele->setLoginSage ( $line [3] );

			$this->myList [] = $aModele;
		}

		mysqli_free_result  ( $result );
	}
	public function SQL_SEARCH($NumPage, $NumEntry, $Recherche, $tri, $ordre) {
		$this->myList = array ();

		switch ($tri) {
			case 1 :
				$tri = 'IndividuID';
				break;
			case 2 :
				$tri = 'Nom';
				break;
			case 3 :
				$tri = 'Prenom';
				break;
			default :
				$tri = 'Nom';
				break;
		}

		switch ($ordre) {
			case 'a' :
				$ordre = 'ASC';
				break;
			case 'd' :
				$ordre = 'DESC';
				break;
			default :
				$ordre = 'DESC';
				break;
		}
		$sql = "SELECT IndividuID, Nom, Prenom, LoginSage FROM annuaire_individu WHERE AnnuaireID='%s' AND  (IndividuID LIKE '%s' OR Nom LIKE '%s'  OR Prenom LIKE '%s') ORDER BY %s %s  LIMIT %d, %d  ";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $Recherche . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $Recherche . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $Recherche . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], $tri ), mysqli_real_escape_string ($_SESSION['LINK'], $ordre ), ($NumPage - 1) * $NumEntry, $NumEntry );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aModele = new Simple_Individu ();
			$aModele->setID ( $line [0] );
			$aModele->setNom ( $line [1] );
			$aModele->setPrenom ( $line [2] );
			$aModele->setLoginSage ( $line [3] );

			$this->myList [] = $aModele;
		}

		mysqli_free_result  ( $result );
	}
	public function SQL_SEARCH_NOM_PRENOM_ANNU($NumPage, $NumEntry, $Recherche, $tri, $ordre) {
		$tabRecherche = explode ( "+", $Recherche );
		$this->myList = array ();

		switch ($tri) {
			case 1 :
				$tri = 'IndividuID';
				break;
			case 2 :
				$tri = 'Nom';
				break;
			case 3 :
				$tri = 'Prenom';
				break;
			default :
				$tri = 'Nom';
				break;
		}

		switch ($ordre) {
			case 'a' :
				$ordre = 'ASC';
				break;
			case 'd' :
				$ordre = 'DESC';
				break;
			default :
				$ordre = 'DESC';
				break;
		}
		$sql = "SELECT IndividuID, Nom, Prenom, LoginSage FROM annuaire_individu WHERE AnnuaireID='%s' AND  ((Nom = '%s' AND Prenom = '%s') or UPPER(LoginRgpd) = UPPER('%s')) ORDER BY %s %s  LIMIT %d, %d  ";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $tabRecherche [3] ), mysqli_real_escape_string ($_SESSION['LINK'], $tabRecherche [0] ), mysqli_real_escape_string ($_SESSION['LINK'], $tabRecherche [1] ), mysqli_real_escape_string ($_SESSION['LINK'], $tabRecherche [2] ), mysqli_real_escape_string ($_SESSION['LINK'], $tri ), mysqli_real_escape_string ($_SESSION['LINK'], $ordre ), ($NumPage - 1) * $NumEntry, $NumEntry );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aModele = new Simple_Individu ();
			$aModele->setID ( $line [0] );
			$aModele->setNom ( $line [1] );
			$aModele->setPrenom ( $line [2] );
			$aModele->setLoginSage ( $line [3] );

			$this->myList [] = $aModele;
		}

		mysqli_free_result  ( $result );
	}

	// Renvoi le nb max d'individu avec recherche
	public function SQL_SEARCH_COUNT($Recherche) {
		$sql = "SELECT count(*) FROM annuaire_individu WHERE AnnuaireID='%s' AND  (IndividuID LIKE '%s' OR Nom LIKE '%s'  OR Prenom LIKE '%s')";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $Recherche . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $Recherche . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $Recherche . '%' ) );

		// $sql = "SELECT count(*) FROM annuaire_individu WHERE AnnuaireID='%s' AND (Nom LIKE '%s' OR Prenom LIKE '%s')";

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
		$line = mysqli_fetch_array  ( $result );
		return $line [0];
	}
}
?>