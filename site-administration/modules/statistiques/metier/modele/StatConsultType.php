<?php
/**
 * Class utilisée pour générer la vue répartition par type
 * @author Alexandre DIALLO
 * @package site-administration
 * @subpackage statistiques
 */
class StatConsultType {
	private $myList;
	public function __constructList() {
		$this->myList = array ();
	}

	// ###
	/**
	 * Retourne le tableau des consultations par type
	 */
	public function getList() {
		return $this->myList;
	}
	/**
	 *
	 * Insére le tableau des consultations par type
	 *
	 * @param unknown_type $newValue
	 *        	tableau des consultations par type
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
	public function SQL_SELECT_NAME($id) {
		$sql = "SELECT Description FROM wcm_document_categorie WHERE DocCategorieID = '%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $id ) );
		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
		$line = mysqli_fetch_array  ( $result );
		return $line [0];

		mysqli_free  ( $result );
	}
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
	 * @deprecated
	 *
	 */
	public function SQL_SELECT_TYPE_DOC($mois, $anne, $site) {
		$this->myList = array ();

		$sql = "SELECT Titre ,COUNT( * ), IDDoc,Date ,CatType,CatTheme,CatMetier
				FROM stat_line_doc s, wcm_document_infodyn wd
				WHERE wd.DocInfoDynID = s.IDDoc	
							AND s.SiteID = %s
				AND MONTH(Date) = %s
				AND YEAR(Date)= %s
				AND s.TypeDoc = '0'
				GROUP BY IDDoc";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $site ), mysqli_real_escape_string ($_SESSION['LINK'], $mois ), mysqli_real_escape_string ($_SESSION['LINK'], $anne ), mysqli_real_escape_string ($_SESSION['LINK'], $site ) );
		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
		echo $query;
		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aModele = new ConsultDoc ();
			$aModele->settitle ( $line [0] );
			$aModele->setconsult ( $line [1] );
			$aModele->settype ( $line [4] );
			$aModele->settheme ( $line [5] );
			$aModele->setmetier ( $line [6] );
			$this->myList [] = $aModele;
		}

		mysqli_free_result  ( $result );
	}
	/**
	 *
	 * Renvoi les type et leur consultations en fonction du mois, de l'année et du site
	 *
	 * @param int $mois
	 * @param int $anne
	 * @param int $site
	 *        	1.CISCAR
	 *        	2.GCR
	 *        	3.ACNF
	 *        	7.GCRE
	 */
	public function SQL_SELECT_TYPE_DOC_GRAPH($mois, $anne, $site) {
		$this->myList = array ();

		$sql = "SELECT COUNT( * ),CatType
				FROM stat_line_doc 
				WHERE 	SiteID = %s
				AND MONTH(Date) = %s
				AND YEAR(Date)= %s
				AND TypeDoc = '0'
				GROUP BY CatType";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $site ), mysqli_real_escape_string ($_SESSION['LINK'], $mois ), mysqli_real_escape_string ($_SESSION['LINK'], $anne ), mysqli_real_escape_string ($_SESSION['LINK'], $site ) );
		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {

			$this->myList [$line [1]] = $line [0];
		}

		mysqli_free_result  ( $result );
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
		$sql = "SELECT COUNT( * )
				FROM stat_line_doc
				WHERE  MONTH(Date) = %s
				AND YEAR(Date)= %s
				AND SiteID = %s %s
				
				";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $mois ), mysqli_real_escape_string ($_SESSION['LINK'], $anne ), mysqli_real_escape_string ($_SESSION['LINK'], $site ), stripslashes ( mysqli_real_escape_string ($_SESSION['LINK'], $type ) ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
		$line = mysqli_fetch_array  ( $result );
		return $line [0];
		mysqli_free_result  ( $result );
	}
	/**
	 *
	 * Sélectionne le total des consultations par type par mois,année,site et catégorie
	 *
	 * @param int $mois
	 * @param int $anne
	 * @param int $site
	 *        	1.CISCAR
	 *        	2.GCR
	 *        	3.ACNF
	 *        	7.GCRE
	 * @param int $id
	 */
	public function SQL_COUNT_TYPE($id, $mois, $anne, $site) {
		$this->myList = array ();

		$sql = "SELECT COUNT( * )
				FROM stat_line_doc 
				WHERE CatType= %s
				AND SiteID = %s
				AND MONTH(Date) = %s
				AND YEAR(Date)= %s
				AND TypeDoc=0
				";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $id ), mysqli_real_escape_string ($_SESSION['LINK'], $site ), mysqli_real_escape_string ($_SESSION['LINK'], $mois ), mysqli_real_escape_string ($_SESSION['LINK'], $anne ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
		$line = mysqli_fetch_array  ( $result );
		return $line [0];
		echo $line [0];
		mysqli_free_result  ( $result );
	}
}

?>