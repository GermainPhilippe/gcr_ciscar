<?php
/**
 * Class permettant de récupérer la liste des Offres
 * @author Alexandre Diallo
 * @package app-site-emploi
 * @subpackage offre
 * @version 1.0.4
 */
class ListOffre {
	private $myList;
	public function __constructList($aList) {
		$this->myList = $aList;
	}

	// ###
	/**
	 * Retourne la liste des Offres
	 */
	public function getList() {
		return $this->myList;
	}
	/**
	 * Insère la liste des Offres
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

		$sql = "SELECT NumOffre, TitreOffre, Pub FROM emploi_offres WHERE NumOffre LIKE '%s' OR TitreOffre LIKE '%s' ORDER BY NumOffre DESC";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], '%' . $rech . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $rech . '%' ) );
		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aModele = new VerifOffre ();
			$aModele->setnumoffre ( $line [0] );
			$aModele->settitreoffre ( $line [1] );
			$aModele->setpub ( $line [2] );

			$this->myList [] = $aModele;
		}

		mysqli_free_result  ( $result );
	}
	/**
	 *
	 * @deprecated
	 *
	 */
	public function SQL_COUNT_NUM() {
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

		$sql = "SELECT NumOffre,DateOffre, TitreOffre, Pub, EmailOffre FROM emploi_offres WHERE NumOffre LIKE '%s' OR DateOffre LIKE '%s' OR TitreOffre LIKE '%s' OR EmailOffre LIKE '%s' ORDER BY DateOffre DESC";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], '%' . $rech . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $rech . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $rech . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $rech . '%' ) );
		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aModele = new VerifOffre ();
			$aModele->setnumoffre ( $line [0] );
			$aModele->setdateoffre ( $line [1] );
			$aModele->settitreoffre ( $line [2] );
			$aModele->setpub ( $line [3] );
			$aModele->setmail ( $line [4] );

			$this->myList [] = $aModele;
		}

		mysqli_free_result  ( $result );
	}
	/**
	 *
	 * @deprecated
	 *
	 */
	public function SQL_COUNT_DAT() {
		$sql = 'SELECT COUNT(NumOffre) FROM emploi_offres';

		$result = mysqli_query ($_SESSION['LINK'], $sql ) or die ( mysqli_error ($_SESSION['LINK']) );
		$line = mysqli_fetch_array  ( $result );
		return $line [0];
	}
	/**
	 *
	 * @deprecated
	 *
	 */
	public function SQL_SELECT_PAGE_DATE($rech, $NumPage, $NumEntry) {
		$this->myList = array ();

		$sql = "SELECT NumOffre, DateOffre, TitreOffre, Pub, EmailOffre FROM emploi_offres WHERE NumOffre LIKE '%s' OR DateOffre LIKE '%s' OR TitreOffre LIKE '%s' OR EmailOffre LIKE '%s' ORDER BY DateOffre DESC LIMIT %s, %s";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], '%' . $rech . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $rech . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $rech . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $rech . '%' ), ($NumPage - 1) * $NumEntry, $NumEntry );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aModele = new VerifOffre ();
			$aModele->setnumoffre ( $line [0] );
			$aModele->setdateoffre ( $line [1] );
			$aModele->settitreoffre ( $line [2] );
			$aModele->setpub ( $line [3] );
			$aModele->setmail ( $line [4] );

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

		$sql = "SELECT NumOffre, DateOffre ,pub, TitreOffre FROM emploi_offres WHERE pub = 0 AND Valid = 0 ORDER BY NumOffre DESC";

		$result = mysqli_query ($_SESSION['LINK'], $sql ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aModele = new VerifOffre ();
			$aModele->setnumoffre ( $line [0] );
			$aModele->setdateoffre ( $line [1] );
			$aModele->setpub ( $line [2] );
			$aModele->settitreoffre ( $line [3] );

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
	 *        	1 NumOffre
	 *        	2 TitreOffre
	 *        	3 DateOffre
	 *        	4 EmailOffre
	 *        	5 pub
	 *        	défaut DateOffre
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
				$tri = 'NumOffre';
				break;
			case 2 :
				$tri = 'TitreOffre';
				break;
			case 3 :
				$tri = 'DateOffre';
				break;
			case 4 :
				$tri = 'EmailOffre';
				break;
			case 5 :
				$tri = 'pub';
				break;
			default :
				$tri = 'DateOffre';
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

		$sql = "SELECT NumOffre,DateOffre, TitreOffre,EmailOffre,pub FROM emploi_offres WHERE ( NumOffre LIKE '%s' OR TitreOffre LIKE '%s' OR EmailOffre LIKE '%s' OR DateOffre LIKE '%s')  ORDER BY %s %s LIMIT %d, %d";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], '%' . $rech . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $rech . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $rech . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $rech . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], $tri ), mysqli_real_escape_string ($_SESSION['LINK'], $ordre ), ($page - 1) * $entry, $entry );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aModele = new VerifOffre ();
			$aModele->setnumoffre ( $line [0] );
			$aModele->setdateoffre ( $line [1] );
			$aModele->settitreoffre ( $line [2] );
			$aModele->setmail ( $line [3] );
			$aModele->setpub ( $line [4] );

			$this->myList [] = $aModele;
		}
	}

	/**
	 *
	 * Retourne le nombre d'offres (sans recherche)
	 *
	 * @return int
	 */
	public function SQL_COUNT() {
		$sql = "SELECT COUNT(*)FROM emploi_offres  ";

		$result = mysqli_query ($_SESSION['LINK'], $sql ) or die ( mysqli_error ($_SESSION['LINK']) );
		$line = mysqli_fetch_array  ( $result );
		return $line [0];
		echo $line [0];

		mysqli_free  ( $result );
	}
	/**
	 *
	 * Retourne le nombre d'offres (avec recherche)
	 *
	 * @param string $rech
	 * @return int
	 */
	public function SQL_SEARCH_COUNT($rech) {
		if (preg_match ( "#^((0[1-9])|([1-2][0-9])|(3[0-1]))(/)((0[1-9])|(1[0-2]))(/)([0-9]{4})$#", $rech )) {
			$rech = CommunFunction::getDateUS ( $rech );
		}

		$sql = "SELECT COUNT(*)FROM emploi_offres WHERE ( NumOffre LIKE '%s' OR TitreOffre LIKE '%s' OR EmailOffre LIKE '%s' OR DateOffre LIKE '%s') ";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], '%' . $rech . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $rech . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $rech . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $rech . '%' ) );
		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
		$line = mysqli_fetch_array  ( $result );
		return $line [0];

		mysqli_free  ( $result );
	}
}
?>