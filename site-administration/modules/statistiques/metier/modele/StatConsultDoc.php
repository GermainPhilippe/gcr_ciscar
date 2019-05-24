<?php
/**
 * Class utilisée pour générer les vue TOP20 et nombre de consultations par docs
 * @author Alexandre DIALLO
 * @package site-administration
 * @subpackage statistiques
 */
class StatConsultDoc {
	private $myList;
	public function __constructList() {
		$this->myList = array ();
	}

	// ###
	/**
	 * Retourne le tableau des consultations par doc
	 */
	public function getList() {
		return $this->myList;
	}
	/**
	 *
	 * Insére le tableau des consultations par doc
	 *
	 * @param unknown_type $newValue
	 *        	tableau des consultations par doc
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
	public function SQL_SELECT_TOP_20($mois, $anne, $site) {
		$sql = "SELECT COUNT( * ), IDDoc,TypeDoc,Date 
							FROM stat_line_doc s
							WHERE  s.SiteID = %s
							AND MONTH(Date) = %s
							AND YEAR(Date)= %s
							GROUP BY IDDoc ORDER BY COUNT(*)DESC LIMIT 0,20";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $site ), mysqli_real_escape_string ($_SESSION['LINK'], $mois ), mysqli_real_escape_string ($_SESSION['LINK'], $anne ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$data = $line [0] . '-' . $line [2];
			$this->myList [$line [1]] = $data;
		}
		mysqli_free_result  ( $result );
	}

	/**
	 *
	 * Sélectionne les 20 document les plus consultés en fonction de la catégorie, du mois, de l'année, de la catégorie et du site
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
	 * @param string $top
	 */
	public function SQL_CONSULT_GRAPH($mois, $anne, $site, $type, $top) {
		if ($top == "top") {
			$top = "LIMIT 0,20";
		} else {
			$top = " ";
		}
		switch ($type) {
			case 0 :
				$sql = "SELECT COUNT( * ), TypeDoc,IDDoc,Titre,Libelle_CatType,Libelle_CatTheme,Libelle_CatMetier
							FROM stat_line_doc s
							WHERE  s.SiteID = %s
							AND MONTH(s.Date) = %s
							AND YEAR(s.Date)= %s
							AND s.TypeDoc='0'
							GROUP BY s.IDDoc  ORDER BY COUNT(*) DESC %s";
				$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $site ), mysqli_real_escape_string ($_SESSION['LINK'], $mois ), mysqli_real_escape_string ($_SESSION['LINK'], $anne ), mysqli_real_escape_string ($_SESSION['LINK'], $top ) );
				$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

				while ( $line = mysqli_fetch_array  ( $result ) ) {
					$aModele = new ConsultDoc ();
					$aModele->setcategorie ( $line [2] );
					$aModele->settitle ( $line [3] );
					$aModele->setconsult ( $line [0] );
					$aModele->settype ( $line [4] );
					$aModele->settheme ( $line [5] );
					$aModele->setmetier ( $line [6] );
					$this->myList [] = $aModele;
				}
				mysqli_free_result  ( $result );
				break;
			case 1 :

				$sql = "SELECT Titre ,COUNT( * ), IDDoc,Date ,Libelle_CatType
							FROM stat_line_doc s				
							WHERE s.SiteID = %s
							AND MONTH(Date) = %s
							AND YEAR(Date)= %s AND TypeDoc = '1'
							GROUP BY s.IDDoc ORDER BY COUNT(*) DESC %s";

				$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $site ), mysqli_real_escape_string ($_SESSION['LINK'], $mois ), mysqli_real_escape_string ($_SESSION['LINK'], $anne ), mysqli_real_escape_string ($_SESSION['LINK'], $top ) );

				$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

				while ( $line = mysqli_fetch_array  ( $result ) ) {
					$aModele = new ConsultDoc ();
					$aModele->settitle ( $line [0] );
					$aModele->setconsult ( $line [1] );
					$aModele->settype ( $line [4] );
					$aModele->settheme ( "" );
					$aModele->setmetier ( "" );
					$this->myList [] = $aModele;
				}
				mysqli_free_result  ( $result );
				break;

			case 2 :
				$sql = "SELECT COUNT( * ), IDDoc,Date,Titre 
							FROM stat_line_doc s					
							WHERE SiteID = %s
							AND MONTH(Date) = %s
							AND YEAR(Date)= %s AND s.TypeDoc = '2'
							GROUP BY IDDoc ORDER BY COUNT(*) DESC %s";

				$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $site ), mysqli_real_escape_string ($_SESSION['LINK'], $mois ), mysqli_real_escape_string ($_SESSION['LINK'], $anne ), mysqli_real_escape_string ($_SESSION['LINK'], $top ) );

				$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

				while ( $line = mysqli_fetch_array  ( $result ) ) {

					$aModele = new ConsultDoc ();
					$aModele->settitle ( $line [3] );
					$aModele->setconsult ( $line [0] );
					$aModele->settype ( "" );
					$aModele->settheme ( "" );
					$aModele->setmetier ( "" );
					$this->myList [] = $aModele;
				}
				mysqli_free_result  ( $result );
				break;

			case 3 :
				$sql = "SELECT COUNT( * ), IDDoc,TypeDoc,Date,Libelle_CatType,Libelle_CatTheme,Libelle_CatMetier,Titre
							FROM stat_line_doc s WHERE s.SiteID = %s
							AND MONTH(s.Date) = %s
							AND YEAR(s.Date)= %s
							GROUP BY s.IDDoc  ORDER BY COUNT(*) DESC %s";

				$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $site ), mysqli_real_escape_string ($_SESSION['LINK'], $mois ), mysqli_real_escape_string ($_SESSION['LINK'], $anne ), mysqli_real_escape_string ($_SESSION['LINK'], $top ) );
				$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
				while ( $line = mysqli_fetch_array  ( $result ) ) {
					$aModele = new ConsultDoc ();
					$aModele->setcategorie ( $line [2] );
					$aModele->settitle ( $line [7] );
					$aModele->setconsult ( $line [0] );
					$aModele->settype ( $line [4] );
					$aModele->settheme ( $line [5] );
					$aModele->setmetier ( $line [6] );
					$this->myList [] = $aModele;
				}
				mysqli_free_result  ( $result );
				break;
		}
	}

	/**
	 *
	 * Sélectionne les consultations par en fonction de la catégorie, du mois, de l'année, de la catégorie et du site
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
	 * @param string $top
	 * @param int $page
	 */
	public function SQL_SELECT_CONSULT_DOC($mois, $anne, $site, $type, $top, $page) {
		if ($top == "top") {
			$top = "20";
		} else {
			$top = "50";
		}
		switch ($type) {
			case 0 :
				$sql = "SELECT COUNT( * ), IDDoc,TypeDoc,Date,Titre,Libelle_CatType,Libelle_CatTheme,Libelle_CatMetier
							FROM stat_line_doc s
							WHERE  s.SiteID = %s
							AND MONTH(s.Date) = %s
							AND YEAR(s.Date)= %s
							AND s.TypeDoc='0'
							GROUP BY s.IDDoc  ORDER BY COUNT(*) DESC LIMIT %s, %s";
				$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $site ), mysqli_real_escape_string ($_SESSION['LINK'], $mois ), mysqli_real_escape_string ($_SESSION['LINK'], $anne ), ($page - 1) * $top, mysqli_real_escape_string ($_SESSION['LINK'], $top ) );
				$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

				while ( $line = mysqli_fetch_array  ( $result ) ) {
					$aModele = new ConsultDoc ();
					$aModele->settitle ( $line [4] );
					$aModele->setconsult ( $line [0] );
					$aModele->settype ( $line [5] );
					$aModele->settheme ( $line [6] );
					$aModele->setmetier ( $line [7] );
					$this->myList [] = $aModele;
				}
				mysqli_free_result  ( $result );
				break;
			case 1 :

				$sql = "SELECT Titre ,COUNT( * ), IDDoc,Date 
							FROM stat_line_doc s	
							WHERE s.SiteID = %s
							AND MONTH(Date) = %s
							AND YEAR(Date)= %s AND TypeDoc = '1'
							GROUP BY s.IDDoc ORDER BY COUNT(*) DESC LIMIT %s,%s";

				$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $site ), mysqli_real_escape_string ($_SESSION['LINK'], $mois ), mysqli_real_escape_string ($_SESSION['LINK'], $anne ), ($page - 1) * $top, mysqli_real_escape_string ($_SESSION['LINK'], $top ) );

				$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

				while ( $line = mysqli_fetch_array  ( $result ) ) {
					$aModele = new ConsultDoc ();
					$aModele->settitle ( $line [0] );
					$aModele->setconsult ( $line [1] );
					$aModele->settype ( "" );
					$aModele->settheme ( "" );
					$aModele->setmetier ( "" );
					$this->myList [] = $aModele;
				}
				mysqli_free_result  ( $result );
				break;

			case 2 :
				$sql = "SELECT COUNT( * ), IDDoc,Date,Titre 
							FROM stat_line_doc s					
							WHERE SiteID = %s
							AND MONTH(Date) = %s
							AND YEAR(Date)= %s AND s.TypeDoc = '2'
							GROUP BY IDDoc ORDER BY COUNT(*) DESC LIMIT %s,%s";

				$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $site ), mysqli_real_escape_string ($_SESSION['LINK'], $mois ), mysqli_real_escape_string ($_SESSION['LINK'], $anne ), ($page - 1) * $top, mysqli_real_escape_string ($_SESSION['LINK'], $top ) );

				$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

				while ( $line = mysqli_fetch_array  ( $result ) ) {

					$aModele = new ConsultDoc ();
					$aModele->settitle ( $line [3] );
					$aModele->setconsult ( $line [0] );
					$aModele->settype ( "" );
					$aModele->settheme ( "" );
					$aModele->setmetier ( "" );
					$this->myList [] = $aModele;
				}
				mysqli_free_result  ( $result );
				break;

			case 3 :
				$sql = "SELECT COUNT( * ), IDDoc,TypeDoc,Date,Libelle_CatType,Libelle_CatTheme,Libelle_CatMetier,Titre
							FROM stat_line_doc s WHERE s.SiteID = %s
							AND MONTH(s.Date) = %s
							AND YEAR(s.Date)= %s
							GROUP BY s.IDDoc  ORDER BY COUNT(*) DESC LIMIT %s,%s";

				$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $site ), mysqli_real_escape_string ($_SESSION['LINK'], $mois ), mysqli_real_escape_string ($_SESSION['LINK'], $anne ), ($page - 1) * $top, mysqli_real_escape_string ($_SESSION['LINK'], $top ) );
				$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

				while ( $line = mysqli_fetch_array  ( $result ) ) {
					$aModele = new ConsultDoc ();
					$aModele->setcategorie ( $line [2] );
					$aModele->settitle ( $line [7] );
					$aModele->setconsult ( $line [0] );
					$aModele->settype ( $line [4] );
					$aModele->settheme ( $line [5] );
					$aModele->setmetier ( $line [6] );
					$this->myList [] = $aModele;
				}
				mysqli_free_result  ( $result );
				break;
		}
	}

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
		$sql = "SELECT COUNT(*),IDDoc
				FROM stat_line_doc
				WHERE  MONTH(Date) = '%s'
				AND YEAR(Date)= '%s'
				AND SiteID = '%s' %s
				GROUP BY IDDoc
				";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $mois ), mysqli_real_escape_string ($_SESSION['LINK'], $anne ), mysqli_real_escape_string ($_SESSION['LINK'], $site ), stripslashes ( mysqli_real_escape_string ($_SESSION['LINK'], $type ) ) );
		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
		$num = mysqli_num_rows ( $result );
		return $num;
		mysqli_free_result  ( $result );
	}
}

?>