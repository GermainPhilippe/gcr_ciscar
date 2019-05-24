<?php
class NewsletterEnvoiManager {
	public function __construct() {
	}
	public function add(NewsletterEnvoi $aNewsletterEnvoi) {
		$sql = "INSERT INTO wcm_newsletter_envoi (NewsID, EnvoiID, DateEnvoi, NbEnvois, ListeDiffusionID, ListeDiffusionName) VALUES('%s','%s',NOW(),'%s','%s','%s')";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aNewsletterEnvoi->getNewsletterID () ), mysqli_real_escape_string ($_SESSION['LINK'], $aNewsletterEnvoi->getEnvoiID () ), mysqli_real_escape_string ($_SESSION['LINK'], $aNewsletterEnvoi->getNbEnvois () ), mysqli_real_escape_string ($_SESSION['LINK'], $aNewsletterEnvoi->getListeDiffusionID () ), mysqli_real_escape_string ($_SESSION['LINK'], $aNewsletterEnvoi->getListeDiffusionName () ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function selectListeDiffusion($aNewsID) {
		$aNewsletterEnvoi = new NewsletterEnvoi ();

		$sql = "Select  group_concat(convert(ListeDiffusionID,char(10)) SEPARATOR '|') as ListeDiffusionID,group_concat(Nom SEPARATOR '|') as ListeDiffusionName ";
		$sql .= " from wcm_newsletter_destinataire, annuaire_liste_diffusion where NewsID = '%s' and ListeDiffusionID = listeID";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aNewsID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		if (mysqli_num_rows ( $result ) > 0) {
			$line = mysqli_fetch_array  ( $result );
			$aNewsletterEnvoi->setNewsletterID ( $aNewsID );
			$aNewsletterEnvoi->setListeDiffusionID ( $line [0] );
			$aNewsletterEnvoi->setListeDiffusionName ( $line [1] );
		} else {
			$aNewsletterEnvoi->setNewsletterID ( $aNewsID );
			$aNewsletterEnvoi->setListeDiffusionID ( "" );
			$aNewsletterEnvoi->setListeDiffusionName ( "" );
		}

		mysqli_free_result  ( $result );

		return $aNewsletterEnvoi;
	}
	public function selectEnvoiStats($aNewsID, $aEnvoiID, $aPeriode) {
		$sql = "Select NewsID, EnvoiID ";
		$sql .= " from wcm_newsletter_envoi_stats where NewsID = '%s' and EnvoiID = '%s' and Periode = '%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aNewsID ), mysqli_real_escape_string ($_SESSION['LINK'], $aEnvoiID ), mysqli_real_escape_string ($_SESSION['LINK'], $aPeriode ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		if (mysqli_num_rows ( $result ) > 0) {
			mysqli_free_result  ( $result );
			return true;
		} else {
			mysqli_free_result  ( $result );
			return false;
		}
	}
	public function deleteEnvoiStats($aNewsID, $aEnvoiID, $aPeriode) {
		$sql = "delete from wcm_newsletter_envoi_stats where NewsID = '%s' and EnvoiID = '%s' and Periode = '%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aNewsID ), mysqli_real_escape_string ($_SESSION['LINK'], $aEnvoiID ), mysqli_real_escape_string ($_SESSION['LINK'], $aPeriode ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function addEnvoiStats($aNewsletterHistoriqueEnvoisStats) {
		$sql = "INSERT INTO wcm_newsletter_envoi_stats (NewsID, DateStats, Newsletter, EnvoiID, NbEnvois, DateEnvoi, Cibles, Periode, Ouvertures, Lecteurs, Clicks, Articles) ";
		$sql .= " VALUES('%s',DATE_FORMAT(Date(curdate()),\"%%Y%%m%%d\"),'%s','%s','%s','%s','%s','%s','%s','%s','%s','%s')";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aNewsletterHistoriqueEnvoisStats->getNewsletterID () ), mysqli_real_escape_string ($_SESSION['LINK'], $aNewsletterHistoriqueEnvoisStats->getDescription () ), mysqli_real_escape_string ($_SESSION['LINK'], $aNewsletterHistoriqueEnvoisStats->getEnvoiID () ), mysqli_real_escape_string ($_SESSION['LINK'], $aNewsletterHistoriqueEnvoisStats->getNbTot () ), mysqli_real_escape_string ($_SESSION['LINK'], $aNewsletterHistoriqueEnvoisStats->getDateCreation () ), mysqli_real_escape_string ($_SESSION['LINK'], $aNewsletterHistoriqueEnvoisStats->getListeDiffusion () ), mysqli_real_escape_string ($_SESSION['LINK'], $aNewsletterHistoriqueEnvoisStats->getJ () ), mysqli_real_escape_string ($_SESSION['LINK'], $aNewsletterHistoriqueEnvoisStats->getNbOuv () ), mysqli_real_escape_string ($_SESSION['LINK'], $aNewsletterHistoriqueEnvoisStats->getNbLecteurs () ), mysqli_real_escape_string ($_SESSION['LINK'], $aNewsletterHistoriqueEnvoisStats->getNbClicks () ), mysqli_real_escape_string ($_SESSION['LINK'], $aNewsletterHistoriqueEnvoisStats->getListeArticles () ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
}
?>