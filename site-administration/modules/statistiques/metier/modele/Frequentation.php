<?php
/**
 * Class utilis�e pour g�n�rer la vue des fr�quentations
 * @author Alexandre DIALLO
 * @package site-administration
 * @subpackage statistiques
 * @version 1.0.4
 */
class Frequentation {
	private $myList;
	public function __constructList() {
		$this->myList = array ();
	}

	// ###
	/**
	 * Retourne le tableau des fr�quentations par jour
	 */
	public function getList() {
		return $this->myList;
	}
	/**
	 *
	 * Ins�re le tableau des fr�quentations par jour
	 *
	 * @param unknown_type $newValue
	 *        	tableau des fr�quentations par jour
	 */
	public function setList($newValue) {
		$this->myList = $newValue;
	}

	// ###
	/**
	 *
	 * G�n�re le tableau des fr�quentations par jour en fonction du site, du mois et de l'ann�e
	 *
	 * @param int $mois
	 * @param int $annee
	 * @param int $site
	 *        	1.CISCAR
	 *        	2.GCR
	 *        	3.ACNF
	 *        	7.GCRE
	 */
	public function SQL_SELECT_FREQUENTATION($mois, $annee, $site) {
		$this->myList = array ();
		$sql = " SELECT DAY(Date),MONTH(Date),YEAR(Date) , COUNT( * )	FROM stat_line_doc
					WHERE SiteID = %s AND  MONTH( Date ) = %s AND YEAR(Date) =%s 
					GROUP BY DAY( Date )";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $site ), mysqli_real_escape_string ($_SESSION['LINK'], $mois ), mysqli_real_escape_string ($_SESSION['LINK'], $annee ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {

			$this->myList [$line [0]] = $line [3];
		}
		mysqli_free_result  ( $result );
	}
	public function SQL_FREQUENTATION_PAR_SITE($mois, $annee) {
		$this->myList = array ();

		$sql = "SELECT (CASE site_id WHEN 1 THEN 'CISCAR' WHEN 2 THEN 'GCR' WHEN 3 THEN 'GCNF' WHEN 4 THEN 'GCRE' ELSE 'EMPLOI' END) as site_id, COUNT(*) FROM stat_trace_user WHERE MONTH(date_action)='%s' AND YEAR(date_action)='%s'  GROUP BY site_id";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $mois ), mysqli_real_escape_string ($_SESSION['LINK'], $annee ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$this->myList [] = $line;
		}
		mysqli_free_result  ( $result );
	}
}
?>