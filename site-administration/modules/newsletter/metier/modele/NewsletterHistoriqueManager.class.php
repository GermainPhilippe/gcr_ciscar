<?php
class NewsletterHistoriqueManager {
	public function __construct() {
	}
	
	public function NewsletterHistoriqueManager() {
		self::__construct();
	}
	public function add(NewsletterHistorique $aNewsletterHistorique) {
		$sql = "INSERT INTO wcm_newsletter_historique (HistoriqueID, NewsID, EnvoiID, DateCreation, Description)";
		$sql .= " VALUES(NULL,'%s','%s', NOW(),'%s')";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aNewsletterHistorique->getNewsletterID () ), mysqli_real_escape_string ($_SESSION['LINK'], $aNewsletterHistorique->getEnvoiID () ), mysqli_real_escape_string ($_SESSION['LINK'], $aNewsletterHistorique->getDescription () ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function MaxEnvoiId() {
		$sql = "select max(EnvoiID) from wcm_newsletter_historique";

		$result = mysqli_query ($_SESSION['LINK'], $sql ) or die ( mysqli_error ($_SESSION['LINK']) );
		$line = mysqli_fetch_array  ( $result );

		mysqli_free_result  ( $result );

		return $line [0];
	}
	public function update(NewsletterHistorique $aNewsletterHistorique) {
		$sql = "UPDATE wcm_newsletter_historique SET DateCreation='%s', Description='%s' WHERE HistoriqueID='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aNewsletterHistorique->getDateCreation () ), mysqli_real_escape_string ($_SESSION['LINK'], $aNewsletterHistorique->getDescription () ), mysqli_real_escape_string ($_SESSION['LINK'], $aNewsletterHistorique->getID () ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function delete($aID) {
		$sql = "DELETE FROM wcm_newsletter_historique WHERE HistoriqueID='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aID ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function getList($aNewsID, $debut = -1, $limite = -1) {
		$aArray = array ();

		$sql = "SELECT HistoriqueID, NewsID, CONCAT('le ', DATE_FORMAT(DateCreation,GET_FORMAT(DATE,'EUR')),' à ', DATE_FORMAT(DateCreation,GET_FORMAT(TIME,'EUR'))), Description FROM wcm_newsletter_historique";
		$sql .= " WHERE NewsID='%s'";
		if ($debut != - 1 || $limite != - 1) {
			$sql .= ' LIMIT ' . ( int ) $debut . ', ' . ( int ) $limite;
		}

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aNewsID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aNewsletterHistorique = new NewsletterHistorique ();
			$aNewsletterHistorique->setID ( ( int ) $line [0] );
			$aNewsletterHistorique->setNewsletterID ( ( int ) $line [1] );
			$aNewsletterHistorique->setDateCreation ( $line [2] );
			$aNewsletterHistorique->setDescription ( $line [3] );
			$aArray [] = $aNewsletterHistorique;
		}

		mysqli_free_result  ( $result );

		return $aArray;
	}
	public function getListEnvois($aNewsID) {
		$aArray = array ();

		$sql = "Select nh.EnvoiID as EnvoiID ";
		$sql .= " from wcm_newsletter_historique nh where NewsID = '%s'";
		$sql .= " and description like 'Notification Newsletter Envoyée%%' group by nh.EnvoiID order by nh.EnvoiID desc ";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aNewsID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aNewsletterHistorique = new NewsletterHistorique ();
			$aNewsletterHistorique->setEnvoiID ( ( int ) $line [0] );
			$aNewsletterHistorique->setNewsletterID ( ( int ) $aNewsID );
			$aArray [] = $aNewsletterHistorique;
		}

		mysqli_free_result  ( $result );

		return $aArray;
	}
	public function getEnvois($aEnvoiID) {
		$aArray = array ();

		$sql = "Select nh.EnvoiID as EnvoiID, nh.NewsID as NewsID, DateCreation ,";
		$sql .= " (select count(*) from wcm_newsletter_historique where description like 'Notification Newsletter Envoyée%%' and EnvoiId = '%s') as Nb_TOT,";
		$sql .= " (select count(distinct a.individuID) from wcm_newsletter_visu a, annuaire_individu b where ModVisu = 'ouv' and a.individuID = b.individuID and EnvoiId = '%s')  as Nb_LECT,";
		$sql .= " (select count(distinct a.individuID,DATE_FORMAT(dateVisu, \"%%Y%%m%%d%%H%%i%%s\")) from wcm_newsletter_visu a, annuaire_individu b where ModVisu = 'lien' and a.individuID = b.individuID and EnvoiId = '%s') as Nb_CLICKS, ";
		$sql .= " (select count(DATE_FORMAT(dateVisu, \"%%Y%%m%%d%%H%%i%%s\")) from wcm_newsletter_visu where ModVisu = 'ouv' and EnvoiId = '%s') as Nb_OUV ";
		$sql .= " from wcm_newsletter_historique nh where EnvoiID = '%s'";
		$sql .= " and description like 'Notification Newsletter Envoyée%%' group by  '%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aEnvoiID ), mysqli_real_escape_string ($_SESSION['LINK'], $aEnvoiID ), mysqli_real_escape_string ($_SESSION['LINK'], $aEnvoiID ), mysqli_real_escape_string ($_SESSION['LINK'], $aEnvoiID ), mysqli_real_escape_string ($_SESSION['LINK'], $aEnvoiID ), mysqli_real_escape_string ($_SESSION['LINK'], $aEnvoiID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aNewsletterHistorique = new NewsletterHistorique ();
			$aNewsletterHistorique->setEnvoiID ( ( int ) $line [0] );
			$aNewsletterHistorique->setNewsletterID ( ( int ) $line [1] );
			$aNewsletterHistorique->setDateCreation ( $line [2] );
			$aNewsletterHistorique->setNbTot ( $line [3] );
			$aNewsletterHistorique->setNbLecteurs ( $line [4] );
			$aNewsletterHistorique->setNbClicks ( $line [5] );
			$aNewsletterHistorique->setNbOuv ( $line [6] );
			$aArray [] = $aNewsletterHistorique;
		}

		mysqli_free_result  ( $result );

		return $aArray;
	}
	public function getMailsEnvois() {
		$aArray = array ();

		$sql = "select a.EnvoiID,a.newsID,min(datevisu),";
		$sql .= " (select count(distinct individuID) from wcm_newsletter_visu where ModVisu = 'ouv' and EnvoiId = a.EnvoiID)  as Nb_OUV, ";
		$sql .= " (select count(EnvoiID) from wcm_newsletter_visu where EnvoiMail = 'OUI' and EnvoiId = a.EnvoiID)  as Nb_MAIL, ";
		$sql .= " b.Nom ";
		$sql .= " from wcm_newsletter_visu a, wcm_newsletter b";
		$sql .= " where a.NewsID = b.NewsID and b.siteID = 1";
		$sql .= " and b.Archive = 0";
		$sql .= " group by a.newsID,a.EnvoiID,b.Nom having NB_OUV > 10 and Nb_Mail = 0";
		$sql .= " and min(datevisu) < subdate(CURDATE(),3)";

		$result = mysqli_query ($_SESSION['LINK'], $sql ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aNewsletterHistorique = new NewsletterHistorique ();
			$aNewsletterHistorique->setEnvoiID ( ( int ) $line [0] );
			$aNewsletterHistorique->setNewsletterID ( ( int ) $line [1] );
			$aNewsletterHistorique->setDateCreation ( $line [2] );
			$aNewsletterHistorique->setNbOuv ( $line [3] );
			$aNewsletterHistorique->setDescription ( $line [5] );
			$aArray [] = $aNewsletterHistorique;
		}

		mysqli_free_result  ( $result );

		return $aArray;
	}
	public function getStatsNews() {
		$aArray = array ();

		$sql = "select distinct a.newsID as numNnewsID,a.envoiID as numEnvoiID, DateEnvoi, 1 as 'J',";
		$sql .= " (select NbEnvois from wcm_newsletter_envoi where envoiID = numEnvoiID and NewsID = numNnewsID) as NBEnvois,";
		$sql .= " b.Nom ";
		$sql .= " from wcm_newsletter_historique a, wcm_newsletter b, wcm_newsletter_envoi c ";
		$sql .= " where a.newsID = b.NewsID and b.siteID = 1 ";
		$sql .= " and a.envoiID = c.EnvoiID and a.newsID = c.NewsID ";
		$sql .= " AND a.envoiID > 1800 and Date(DateEnvoi) = Date(subDate(CURDATE(),1))";
		$sql .= " having NBEnvois > 10";
		$sql .= " union";
		$sql .= " select distinct a.newsID as numNnewsID,a.envoiID as numEnvoiID, DateEnvoi, 7 as 'J',";
		$sql .= " (select NbEnvois from wcm_newsletter_envoi where envoiID = numEnvoiID and NewsID = numNnewsID) as NBEnvois,";
		$sql .= " b.Nom ";
		$sql .= " from wcm_newsletter_historique a, wcm_newsletter b, wcm_newsletter_envoi c ";
		$sql .= " where a.newsID = b.NewsID and b.siteID = 1 ";
		$sql .= " and a.envoiID = c.EnvoiID and a.newsID = c.NewsID ";
		$sql .= " AND a.envoiID > 1800 and Date(DateEnvoi) = Date(subDate(CURDATE(),7))";
		$sql .= " having NBEnvois > 10";
		$sql .= " union";
		$sql .= " select distinct a.newsID as numNnewsID,a.envoiID as numEnvoiID, DateEnvoi, 21 as 'J',";
		$sql .= " (select NbEnvois from wcm_newsletter_envoi where envoiID = numEnvoiID and NewsID = numNnewsID) as NBEnvois,";
		$sql .= " b.Nom ";
		$sql .= " from wcm_newsletter_historique a, wcm_newsletter b, wcm_newsletter_envoi c ";
		$sql .= " where a.newsID = b.NewsID and b.siteID = 1 ";
		$sql .= " and a.envoiID = c.EnvoiID and a.newsID = c.NewsID ";
		$sql .= " AND a.envoiID > 1800 and Date(DateEnvoi) = Date(subDate(CURDATE(),21))";
		$sql .= " having NBEnvois > 10";
		$sql .= " order by numNnewsID,numEnvoiID,J";

		$result = mysqli_query ($_SESSION['LINK'], $sql ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aNewsletterHistorique = new NewsletterHistorique ();
			$aNewsletterHistorique->setEnvoiID ( ( int ) $line [1] );
			$aNewsletterHistorique->setNewsletterID ( ( int ) $line [0] );
			$aNewsletterHistorique->setDateCreation ( $line [2] );
			$aNewsletterHistorique->setJ ( $line [3] );
			$aNewsletterHistorique->setDescription ( $line [5] );
			$aArray [] = $aNewsletterHistorique;
		}

		mysqli_free_result  ( $result );

		return $aArray;
	}
}
?>