<?php
/**
 * Class utilisée pour générer la vue répartition par domaine
 * @author Alexandre DIALLO
 * @package site-administration
 * @subpackage statistiques
 */
class StatConsultDomaine {
	private $myList;
	public function __constructList() {
		$this->myList = array ();
	}

	// ###
	/**
	 * Retourne le tableau des consultations par domaine
	 */
	public function getList() {
		return $this->myList;
	}
	/**
	 *
	 * Insére le tableau des consultations par domaine
	 *
	 * @param unknown_type $newValue
	 *        	tableau des consultations par domaine
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
	public function SQL_SELECT_LAST_DATE() {
		$sql = " SELECT Date FROM stat_line_doc ORDER BY Date ASC LIMIT 0,1";
		$result = mysqli_query ($_SESSION['LINK'], $sql ) or die ( mysqli_error ($_SESSION['LINK']) );
		$line = mysqli_fetch_array  ( $result );
		return $line [0];

		mysqli_free  ( $result );
	}
	/**
	 *
	 * Sélectionne le total des consultations par mois,année,site et catégorie
	 *
	 * @param int $mois
	 * @param int $anne
	 * @param int $site
	 *        	1.CISCAR
	 *        	2.GCR
	 *        	3.ACNF
	 *        	7.GCRE
	 * @param int $type
	 *        	1.DocInfoDyn
	 *        	2.DocStatic
	 *        	3.DocPartenaire
	 */
	public function SQL_COUNT($mois, $anne, $site, $type) {
		$this->myList = array ();
		switch ($type) {
			case 0 :
				$type = "AND TypeDoc = '0'";
				break;
			case 1 :
				$type = "AND TypeDoc = '1'";
				break;
			case 2 :
				$type = "AND TypeDoc = '2'";
				break;
			case 3 :
				$type = '';
				break;
			default :
				$type = '';
				break;
		}
		$sql = "SELECT COUNT( * )
				FROM stat_line_doc
				WHERE  MONTH(Date) = %s
				AND YEAR(Date)= %s
				AND SiteID = %s %s";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $mois ), mysqli_real_escape_string ($_SESSION['LINK'], $anne ), mysqli_real_escape_string ($_SESSION['LINK'], $site ), stripslashes ( mysqli_real_escape_string ($_SESSION['LINK'], $type ) ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
		$line = mysqli_fetch_array  ( $result );
		return $line [0];
		mysqli_free_result  ( $result );
	}
	/**
	 *
	 * Sélectionne l'ensemble des domaines dont le nombre de consultations n'est pas nul en fonction du mois, de l'année, du site et de la catégorie
	 *
	 * @param int $mois
	 * @param int $anne
	 * @param int $site
	 *        	1.CISCAR
	 *        	2.GCR
	 *        	3.ACNF
	 *        	7.GCRE
	 * @param int $type
	 *        	1.DocInfoDyn
	 *        	2.DocStatic
	 *        	3.DocPartenaire
	 */
	public function SQL_SELECT_DOMAINE($mois, $anne, $type, $site) {
		switch ($type) {
			case 0 :
				$type = " AND TypeDoc = '0'";
				break;
			case 1 :
				$type = "AND TypeDoc = '1'";
				break;
			case 2 :
				$type = " AND TypeDoc = '2'";
				break;
			case 3 :
				$type = '';
				break;
			default :
				$type = '';
				break;
		}

		$this->myList = array ();

		$sql = "SELECT  Domaine,
						count(*)
						
						FROM stat_line_doc s
						WHERE
						 s.SiteID = '%s'
						AND MONTH(s.Date) = '%s'
						AND YEAR(s.Date)= '%s' %s
						GROUP BY Domaine ";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $site ), mysqli_real_escape_string ($_SESSION['LINK'], $mois ), mysqli_real_escape_string ($_SESSION['LINK'], $anne ), stripslashes ( mysqli_real_escape_string ($_SESSION['LINK'], $type ) ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$this->myList [$line [0]] = $line [1];
		}

		mysqli_free_result  ( $result );
	}
	/**
	 *
	 * @deprecated
	 *
	 */
	public function SQL_COUNT_DOMAINE($mois, $anne, $type, $site) {
		switch ($type) {
			case 0 :
				$type = 'AND TypeDoc = 0';
				break;
			case 1 :
				$type = 'AND TypeDoc = 1';
				break;
			case 2 :
				$type = 'AND TypeDoc =2';
				break;
			case 3 :
				$type = '';
				break;
			default :
				$type = '';
				break;
		}

		$this->myList = array ();

		$sql = "SELECT COUNT(*)
				FROM stat_line_doc s, annuaire_role_domainactivite a, annuaire_lva_domainactivite lva, annuaire_role r
				WHERE s.IDUser = r.IndividuID
				AND r.RoleID = a.RoleID
				AND a.DomainActiviteID = lva.DomainActiviteID
				AND lva.NumOrdre = (SELECT MIN( NumOrdre )FROM annuaire_lva_domainactivite )
				AND s.SiteID = %s
				AND MONTH(s.Date) = %s
				AND YEAR(s.Date)= %s %s
				GROUP BY lva.Libelle ";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $site ), mysqli_real_escape_string ($_SESSION['LINK'], $mois ), mysqli_real_escape_string ($_SESSION['LINK'], $anne ), mysqli_real_escape_string ($_SESSION['LINK'], $type ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
		$line = mysqli_fetch_array  ( $result );
		return $line [0];
		mysqli_free_result  ( $result );

		mysqli_free_result  ( $result );
	}
}

?>