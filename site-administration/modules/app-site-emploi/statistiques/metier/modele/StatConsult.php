<?php
/**
 * Class permettant d'avoir toutes les infos d'une consultation
 * @author Alexandre DIALLO
 * @package app-site-emploi
 * @subpackage statistiques
 * @version 1.0.4
 */
class StatConsult {
	private $myList;
	public function __constructList() {
		$this->myList = array ();
	}

	// ###
	/**
	 * Retourne la liste des consultations
	 */
	public function getList() {
		return $this->myList;
	}
	/**
	 * Insére la liste des consultation
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
	public function SQL_SELECT_CVTHEQUE() {
		$this->myList = array ();

		$sql = "SELECT IDUser,Nom,Prenom,Date  FROM annuaire_individu ai, stat_line_siteemploi se WHERE ai.IndividuID = se.IDUser AND ORDER BY se.Date DESC";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $mois ), mysqli_real_escape_string ($_SESSION['LINK'], $anne ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aModele = new Consult ();
			$aModele->setnom ( $line [1] );
			$aModele->setprenom ( $line [0] );
			$aModele->setdate ( $line [3] );
			$this->myList [] = $aModele;
		}

		mysqli_free_result  ( $result );
	}
	/**
	 *
	 * Sélectionne l'ensemble des consultation en fonction du mois et de l'année
	 *
	 * @param int $mois
	 * @param int $anne
	 */
	public function SQL_SELECT_CONSULT($mois, $anne) {
		$this->myList = array ();

		$sql = "SELECT COUNT(*),Titre,IDDoc,Espace FROM stat_line_siteemploi  WHERE  MONTH(Date)=%s AND YEAR(Date)=%s GROUP BY IDDoc ORDER BY Espace,Titre";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $mois ), mysqli_real_escape_string ($_SESSION['LINK'], $anne ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aModele = new Consult ();
			$aModele->settitle ( $line [1] );
			$aModele->setconsult ( $line [0] );
			$aModele->setespace ( $line [3] );
			$this->myList [] = $aModele;
		}

		mysqli_free_result  ( $result );
	}
	/**
	 *
	 * @deprecated
	 *
	 */
	public function SQL_SELECT_LAST_DATE() {
		$sql = " SELECT Date FROM stat_line_siteemploi ORDER BY Date ASC LIMIT 0,1";
		$result = mysqli_query ($_SESSION['LINK'], $sql ) or die ( mysqli_error ($_SESSION['LINK']) );
		$line = mysqli_fetch_array  ( $result );
		return $line [0];

		mysqli_free  ( $result );
	}
}

?>