<?php
/**
 * Class permettant de r�cup�rer la liste des  CVS
 * @author Alexandre Diallo
 * @package app-site-emploi
 * @subpackage cv
 * @version 1.0.4
 */
class ListCV {
	private $myList;
	public function __constructList() {
		$this->myList = array ();
	}

	// ###
	/**
	 * Retourne la liste des CV
	 */
	public function getList() {
		return $this->myList;
	}
	/**
	 * Ins�re la liste des CV
	 */
	public function setList($newValue) {
		$this->myList = $newValue;
	}

	// ###
	/**
	 *
	 * @deprecated
	 *
	 */
	public function SQL_SELECT_ALL_NUM($rech) {
		$this->myList = array ();

		$sql = "SELECT NumCV, TitreCandidature,Valid,Pub, Fonction FROM emploi_candidature WHERE NumCV LIKE '%s' OR TitreCandidature LIKE '%s' OR Fonction LIKE '%s' ORDER BY NumCV DESC";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], '%' . $rech . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $rech . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $rech . '%' ) );
		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aModele = new VerifCV ();
			$aModele->setnumcv ( $line [0] );
			$aModele->settitrecand ( $line [1] );
			$aModele->setvalid ( $line [2] );
			$aModele->setpub ( $line [3] );
			$aModele->setfonction ( $line [4] );
			$this->myList [] = $aModele;
		}

		mysqli_free_result  ( $result );
	}
	/**
	 *
	 * @deprecated
	 *
	 */
	public function SQL_SELECT_ALL_DATE($rech) {
		if (preg_match ( "#^((0[1-9])|([1-2][0-9])|(3[0-1]))(/)((0[1-9])|(1[0-2]))(/)([0-9]{4})$#", $rech )) {
			$rech = CommunFunction::getDateUS ( $rech );
		}

		$this->myList = array ();

		$sql = "SELECT NumCV, date_cand, TitreCandidature, Mail,Valid ,Pub, Fonction FROM emploi_candidature WHERE NumCV LIKE '%s' OR TitreCandidature LIKE '%s' OR  date_cand LIKE '%s' OR Mail LIKE '%s' OR Fonction LIKE '%s'ORDER BY date_cand DESC";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], '%' . $rech . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $rech . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $rech . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $rech . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $rech . '%' ) );
		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aModele = new VerifCV ();
			$aModele->setnumcv ( $line [0] );
			$aModele->setdatecand ( $line [1] );
			$aModele->settitrecand ( $line [2] );
			$aModele->setmail ( $line [3] );
			$aModele->setvalid ( $line [4] );
			$aModele->setpub ( $line [5] );
			$aModele->setfonction ( $line [6] );

			$this->myList [] = $aModele;
		}

		mysqli_free_result  ( $result );
	}
	/**
	 *
	 * @deprecated
	 *
	 */
	public function SQL_SELECT_ALL_PUB($rech) {
		if (preg_match ( "#^((0[1-9])|([1-2][0-9])|(3[0-1]))(/)((0[1-9])|(1[0-2]))(/)([0-9]{4})$#", $rech )) {
			$rech = CommunFunction::getDateUS ( $rech );
		}

		$this->myList = array ();

		$sql = "SELECT NumCV,date_cand, TitreCandidature,Valid, Pub, Fonction FROM emploi_candidature WHERE Pub = 0 AND ( NumCV LIKE '%s' OR TitreCandidature LIKE '%s' OR date_cand LIKE '%s') OR Fonction LIKE '%s' ORDER BY Valid DESC";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], '%' . $rech . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $rech . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $rech . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $rech . '%' ) );
		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aModele = new VerifCV ();
			$aModele->setnumcv ( $line [0] );
			$aModele->setdatecand ( $line [1] );
			$aModele->settitrecand ( $line [2] );
			$aModele->setvalid ( $line [3] );
			$aModele->setpub ( $line [4] );
			$aModele->setfonction ( $line [5] );

			$this->myList [] = $aModele;
		}

		mysqli_free_result  ( $result );
	}
	/**
	 *
	 * Enter description here ...
	 *
	 * @param string $rech
	 * @param int $page
	 * @param int $entry
	 * @param int $tri
	 *        	1 NumCV
	 *        	2 date_cand
	 *        	3 TitreCandidature
	 *        	4 Mail
	 *        	5 Pub
	 *        	d�faut date_cand
	 * @param string $ordre
	 *        	'a' = 'ASC'
	 *        	'd' = 'DESC'
	 */
	public function SQL_SEARCH($rech, $page, $entry, $tri, $ordre) {
		if (preg_match ( "#^((0[1-9])|([1-2][0-9])|(3[0-1]))(/)((0[1-9])|(1[0-2]))(/)([0-9]{4})$#", $rech )) {
			$rech = CommunFunction::getDateUS ( $rech );
		}

		$this->myList = array ();

		switch ($tri) {
			case 1 :
				$tri = 'NumCV';
				break;
			case 2 :
				$tri = 'date_cand';
				break;
			case 3 :
				$tri = 'Fonction';
				break;
			case 4 :
				$tri = 'Mail';
				break;
			case 5 :
				$tri = 'Pub';
				break;

			default :
				$tri = 'date_cand';
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
				$ordre = 'ASC';
				break;
		}

		$sql = "SELECT NumCV,date_cand, TitreCandidature,Mail,Valid, Pub, Fonction FROM emploi_candidature WHERE ( NumCV LIKE '%s' OR TitreCandidature LIKE '%s' OR Mail LIKE '%s' OR date_cand LIKE '%s') OR TitreCandidature LIKE '%s' ORDER BY %s %s LIMIT %d, %d";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], '%' . $rech . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $rech . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $rech . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $rech . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $rech . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], $tri ), mysqli_real_escape_string ($_SESSION['LINK'], $ordre ), ($page - 1) * $entry, $entry );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {

			$aModele = new VerifCV ();
			$aModele->setnumcv ( $line [0] );
			$aModele->setdatecand ( $line [1] );
			$aModele->settitrecand ( $line [2] );
			$aModele->setmail ( $line [3] );
			$aModele->setvalid ( $line [4] );
			$aModele->setpub ( $line [5] );
			$aModele->setfonction ( $line [6] );

			$this->myList [] = $aModele;
		}
	}
	public function SQL_COUNT_ALL() {
		$result = mysqli_query ($_SESSION['LINK'], "SELECT COUNT(*) FROM emploi_candidature" ) or die ( mysqli_error ($_SESSION['LINK']) );
		$line = mysqli_fetch_array  ( $result );
		return $line [0];
		mysqli_free ( $result );
	}

	/**
	 *
	 * Retourne le nombre de cv (sans recherche)
	 *
	 * @return int
	 */
	public function SQL_COUNT() {
		$sql = "SELECT COUNT(*)FROM emploi_candidature WHERE ( NumCV LIKE '%s' OR TitreCandidature LIKE '%s' OR Mail LIKE '%s' OR date_cand LIKE '%s' OR Fonction LIKE '%s' ) ";

		$result = mysqli_query ($_SESSION['LINK'], $sql ) or die ( mysqli_error ($_SESSION['LINK']) );
		$line = mysqli_fetch_array  ( $result );
		return $line [0];

		mysqli_free  ( $result );
	}
	/**
	 *
	 * Retourne le nombre de cv (avec recherche)
	 *
	 * @param string $rech
	 * @return int
	 */
	public function SQL_SEARCH_COUNT($rech) {
		if (preg_match ( "#^((0[1-9])|([1-2][0-9])|(3[0-1]))(/)((0[1-9])|(1[0-2]))(/)([0-9]{4})$#", $rech )) {
			$rech = CommunFunction::getDateUS ( $rech );
		}

		$sql = "SELECT COUNT(*)FROM emploi_candidature WHERE ( NumCV LIKE '%s' OR TitreCandidature LIKE '%s' OR Mail LIKE '%s' OR date_cand LIKE '%s' OR Fonction LIKE '%s') ";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], '%' . $rech . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $rech . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $rech . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $rech . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $rech . '%' ) );
		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
		$line = mysqli_fetch_array  ( $result );
		return $line [0];

		mysqli_free  ( $result );
	}
}
?>