<?php
/**
 * Class permettant de récupérer la liste des réponses
 * @author Alexandre Diallo
 * @package app-site-emploi
 * @subpackage réponses
 * @version 1.0.4
 */
class ListReponse {
	private $myList;
	public function __constructList($aList) {
		$this->myList = $aList;
	}

	// ###
	/**
	 * Retourne la liste des réponses
	 */
	public function getList() {
		return $this->myList;
	}
	/**
	 * Retourne la liste des réponses
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

		$sql = "SELECT NumReponse,emploi_reponse.NumOffre,  TitreOffre, TitreCandidature FROM emploi_reponse, emploi_offres ";
		$sql .= "WHERE emploi_reponse.NumOffre = emploi_offres.NumOffre AND (emploi_reponse.NumOffre LIKE '%s' OR TitreOffre LIKE '%s' OR NumReponse LIKE '%s')ORDER BY NumReponse DESC";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], '%' . $rech . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $rech . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $rech . '%' ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aModele = new VerifReponse ();
			$aModele->setnumrep ( $line [0] );
			$aModele->setnumoffre ( $line [1] );
			$aModele->settitreoffre ( $line [2] );

			$this->myList [] = $aModele;
		}

		mysqli_free_result  ( $result );
	}
	/**
	 *
	 * Enter description here ...
	 *
	 * @param string $rech
	 * @param int $tri
	 *        	1 NumReponse
	 *        	2 emploi_reponse.NumOffre
	 *        	3 TitreOffre
	 *        	4 Fonctioncandidature
	 *        	5 Pub
	 *        	défaut NumReponse
	 * @param string $ordre
	 *        	'a' = 'ASC'
	 *        	'd' = 'DESC'
	 */
	public function SQL_SELECT_ALL($rech, $tri, $ordre) {
		$this->myList = array ();

		switch ($tri) {
			case 1 :
				$tri = 'NumReponse';
				break;
			case 2 :
				$tri = 'emploi_reponse.NumOffre';
				break;
			case 3 :
				$tri = 'TitreOffre';
				break;
			case 4 :
				$tri = 'FonctionCandRep';
			case 5 :
				$tri = 'DateReponse';
				break;
			default :
				$tri = 'NumReponse';
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
		$this->myList = array ();

		$sql = "SELECT NumReponse,emploi_reponse.NumOffre,DateReponse,TitreOffre,TitreCandidature, FonctionCandRep FROM emploi_reponse, emploi_offres ";
		$sql .= "WHERE emploi_reponse.NumOffre = emploi_offres.NumOffre AND (emploi_reponse.NumOffre LIKE '%s' OR TitreOffre LIKE '%s' OR NumReponse LIKE '%s' OR DateReponse LIKE '%s' OR TitreCandidature LIKE '%s' OR FonctionCandRep LIKE '%s') ORDER BY %s %s";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], '%' . $rech . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $rech . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $rech . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $rech . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $rech . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $rech . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], $tri ), mysqli_real_escape_string ($_SESSION['LINK'], $ordre ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aModele = new VerifReponse ();
			$aModele->setnumrep ( $line [0] );
			$aModele->setnumoffre ( $line [1] );
			$aModele->setdatecand ( $line [2] );
			$aModele->settitreoffre ( $line [3] );
			$aModele->settitrecand ( $line [4] );
			$aModele->setfonctioncand ( $line [5] );

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

		$sql = "SELECT NumReponse,DateReponse, TitreOffre, TitreCandidature, FonctionCandRep FROM emploi_reponse, emploi_offres ";
		$sql .= "WHERE emploi_reponse.NumOffre = emploi_offres.NumOffre AND (emploi_reponse.NumOffre LIKE '%s' OR TitreCandidature LIKE '%s' OR DateReponse LIKE '%s' OR FonctionCandRep LIKE '%s' ) ORDER BY DateReponse DESC";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], '%' . $rech . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $rech . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $rech . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $rech . '%' ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aModele = new VerifReponse ();
			$aModele->setnumrep ( $line [0] );
			$aModele->setdatecand ( $line [1] );
			$aModele->settitreoffre ( $line [2] );
			$aModele->settitrecand ( $line [3] );
			$aModele->setfonctioncand ( $line [4] );

			$this->myList [] = $aModele;
		}

		mysqli_free_result  ( $result );
	}
	/**
	 *
	 * Retourne le nombre de réponses (avec recherche)
	 *
	 * @return int
	 */
	public function SQL_SEARCH_COUNT($rech) {
		$sql = "SELECT COUNT(*) FROM emploi_reponse, emploi_offres ";
		$sql .= "WHERE emploi_reponse.NumOffre = emploi_offres.NumOffre AND (emploi_reponse.NumOffre LIKE '%s' OR TitreOffre LIKE '%s' OR NumReponse LIKE '%s' OR DateReponse LIKE '%s' OR TitreCandidature LIKE '%s' OR FonctionCandRep LIKE '%s')";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], '%' . $rech . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $rech . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $rech . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $rech . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $rech . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $rech . '%' ) );
		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
		$line = mysqli_fetch_array  ( $result );
		return $line [0];
		echo $line [0];

		mysqli_free  ( $result );
	}
}
?>