<?php
/**
 * Class utilisée pour générer la vue répartition par DR
 * @author Alexandre DIALLO
 * @package site-administration
 * @subpackage statistiques
 */
class StatConsultDR {
	private $myList;
	public function __constructList() {
		$this->myList = array ();
	}

	// ###
	/**
	 * Retourne le tableau des consultations par DR
	 */
	public function getList() {
		return $this->myList;
	}
	/**
	 *
	 * Insére le tableau des consultations par DR
	 *
	 * @param unknown_type $newValue
	 *        	tableau des consultations par DR
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
	public function SQL_SELECT_DR($mois, $anne, $site) {
		$this->myList = array ();

		$sql = "SELECT Titre ,COUNT( * ), IDDoc,Date ,Libelle_CatType,Libelle_CatTheme,Libelle_CatMetier
				FROM stat_line_doc s
				WHERE
				 s.SiteID = %s
				AND MONTH(Date) = %s
				AND YEAR(Date)= %s
				AND s.TypeDoc = 0
				GROUP BY CatType,IDDoc";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $site ), mysqli_real_escape_string ($_SESSION['LINK'], $mois ), mysqli_real_escape_string ($_SESSION['LINK'], $anne ), mysqli_real_escape_string ($_SESSION['LINK'], $site ) );
		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

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
	 * Sélectionne les documents et leurs consultations en fonction de l'id (région-domaine), du site,du mois et de l'année
	 *
	 * @param unknown_type $id
	 * @param int $mois
	 * @param int $anne
	 * @param int $site
	 *        	1.CISCAR
	 *        	2.GCR
	 *        	3.ACNF
	 *        	7.GCRE
	 */
	public function SQL_SELECT_DR_DOC($id, $mois, $anne, $site) {
		$this->myList = array ();

		$sql = "SELECT Titre ,COUNT( * ), IDDoc,Date ,Libelle_CatType,Libelle_CatTheme,Libelle_CatMetier
				FROM stat_line_doc s 
				WHERE s.SiteID = %s
				AND MONTH(Date) = %s
				AND YEAR(Date)= %s
				AND s.TypeDoc = 0
				GROUP BY CatTypeID,IDDoc";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $site ), mysqli_real_escape_string ($_SESSION['LINK'], $mois ), mysqli_real_escape_string ($_SESSION['LINK'], $anne ), mysqli_real_escape_string ($_SESSION['LINK'], $site ) );
		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

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
	 * @deprecated
	 *
	 */
	public function SQL_COUNT_TYPE($id, $mois, $anne, $site) {
		$this->myList = array ();

		$sql = "SELECT COUNT( * )
				FROM stat_line_doc s, wcm_document_infodyn wd, wcm_document_infodyn_categorie wc
				WHERE wd.DocInfoDynID = s.IDDoc	
				AND s.IDDoc = wc.DocInfoDynID
				AND wc.CatTypeID = wc.CatUne
			    AND wc.CatTypeID = %s
				AND s.SiteID = %s
				AND MONTH(Date) = %s
				AND YEAR(Date)= %s
				AND TypeDoc=0
				GROUP BY CatTypeID";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $id ), mysqli_real_escape_string ($_SESSION['LINK'], $site ), mysqli_real_escape_string ($_SESSION['LINK'], $mois ), mysqli_real_escape_string ($_SESSION['LINK'], $anne ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
		$line = mysqli_fetch_array  ( $result );
		return $line [0];
		echo $line [0];
		mysqli_free_result  ( $result );
	}
	/**
	 *
	 * Renvoi le nombre de consultations pour une région
	 *
	 * @param int $site
	 *        	1.CISCAR
	 *        	2.GCR
	 *        	3.ACNF
	 *        	7.GCRE
	 * @param int $mois
	 * @param int $annee
	 * @param int $id
	 */
	public function SQL_COUNT_DR($site, $mois, $annee, $id) {
		if ($id == 'NULL') {
			$id = "IS NULL";
		} else {
			$id = '=' . $id;
		}
		$sql = "SELECT COUNT(*),Region
				FROM stat_line_doc s
				WHERE s.SiteID = %s
				AND MONTH(s.Date) = %s
				AND YEAR(s.Date)= %s 
				AND Region  %s
				AND TypeDoc = '0'
				";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $site ), mysqli_real_escape_string ($_SESSION['LINK'], $mois ), mysqli_real_escape_string ($_SESSION['LINK'], $annee ), mysqli_real_escape_string ($_SESSION['LINK'], $id ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
		$line = mysqli_fetch_array  ( $result );
		return $line [0];
		mysqli_free_result  ( $result );

		mysqli_free_result  ( $result );
	}
	/**
	 *
	 * @deprecated
	 *
	 */
	public function SQL_COUNT_DOMAINE($mois, $anne, $type, $site, $id) {
		switch ($type) {
			case 0 :
				$type = 'AND TypeDoc = 0';
				break;
			case 1 :
				$type = 'AND TypeDoc = 1';
				break;
			case 2 :
				$type = 'AND TypeDoc = 2';
				break;
			case 3 :
				$type = '';
				break;
			default :
				$type = 'AND TypeDoc = 0';
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
	/**
	 *
	 * @deprecated
	 *
	 */
	public function SQL_SELECT_DOMAINE($mois, $anne, $type, $site) {
		switch ($type) {
			case 0 :
				$type = ' AND TypeDoc = 0';
				break;
			case 1 :
				$type = 'AND TypeDoc = 1';
				break;
			case 2 :
				$type = ' AND TypeDoc = 2';
				break;
			case 3 :
				$type = '';
				break;
			default :
				$type = '';
				break;
		}

		$this->myList = array ();

		$sql = "SELECT lva.DomainActiviteID, COUNT(*)
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

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$this->myList [$line [0]] = $line [1];
		}

		mysqli_free_result  ( $result );
	}
	/**
	 *
	 * Renvoi les domaines et leur consultations pour une région donnée
	 *
	 * @param int $site
	 *        	1.CISCAR
	 *        	2.GCR
	 *        	3.ACNF
	 *        	7.GCRE
	 * @param int $mois
	 * @param int $annee
	 * @param string $type
	 * @param int $dr
	 */
	public function SQL_SELECT_DOMAINE_DR($mois, $anne, $type, $site, $dr) {
		if ($dr == 'NULL') {
			$dr = 'IS NULL';
		} else {
			$dr = '=' . $dr;
		}

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

		$sql = "SELECT Domaine,COUNT(*)
				FROM stat_line_doc s
				WHERE
				s.SiteID = %s
				AND MONTH(s.Date) = %s
				AND YEAR(s.Date)= %s %s
				AND Region  %s
				GROUP BY Domaine";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $site ), mysqli_real_escape_string ($_SESSION['LINK'], $mois ), mysqli_real_escape_string ($_SESSION['LINK'], $anne ), stripslashes ( mysqli_real_escape_string ($_SESSION['LINK'], $type ) ), mysqli_real_escape_string ($_SESSION['LINK'], $dr ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$this->myList [$line [0]] = $line [1];
		}

		mysqli_free_result  ( $result );
	}
	/**
	 *
	 * Renvoi les domaines et leur consultations pour un domaine et une région donnés
	 *
	 * @param int $site
	 *        	1.CISCAR
	 *        	2.GCR
	 *        	3.ACNF
	 *        	7.GCRE
	 * @param int $mois
	 * @param int $annee
	 * @param string $type
	 * @param int $dr
	 */
	public function SQL_SELECT_DOMAINE_DR_DOC($mois, $anne, $type, $site, $dr) {
		$data = explode ( '-', $dr );

		if ($data ['0'] == 'NULL') {
			$data ['0'] = 'IS NULL';
		} else {
			$data ['0'] = '=' . $data ['0'];
		}
		if ($data ['1'] == 'NULL') {
			$data ['1'] = 'IS NULL';
		} else {
			$data ['1'] = '=' . $data ['1'];
		}
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

		$sql = "SELECT Titre, COUNT(*)
				FROM stat_line_doc s
				WHERE s.SiteID = %s
				AND MONTH(s.Date) = %s
				AND YEAR(s.Date)= %s %s
				AND Domaine  %s
				AND Region %s
				
				GROUP BY s.IDDoc ";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $site ), mysqli_real_escape_string ($_SESSION['LINK'], $mois ), mysqli_real_escape_string ($_SESSION['LINK'], $anne ), stripslashes ( mysqli_real_escape_string ($_SESSION['LINK'], $type ) ), mysqli_real_escape_string ($_SESSION['LINK'], $data ['1'] ), mysqli_real_escape_string ($_SESSION['LINK'], $data ['0'] ) );
		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		$num = mysqli_num_rows ( $result );

		while ( $line = mysqli_fetch_assoc ( $result ) ) {
			$this->myList [$line ["Titre"]] = $line ["COUNT(*)"];
		}
	}
}

?>