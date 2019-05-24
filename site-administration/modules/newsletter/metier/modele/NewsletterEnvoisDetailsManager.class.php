<?php
class NewsletterEnvoisDetailsManager {
	public function __construct() {
	}
	public function getListeEnvoisDetails($aEnvoiID) {
		$aArray = array ();

		$sql = "select a.individuID, max(DateVisu) as DateDerOuv, b.nom , b.Prenom , b.Mail, b.LoginSage,";
		$sql .= " (select count(distinct DateVisu) from wcm_newsletter_visu c where ModVisu = 'ouv' and EnvoiId = '%s' and c.individuID = a.IndividuID ) as Nb_Ouv,";
		$sql .= " (select count(distinct DateVisu) from wcm_newsletter_visu c where ModVisu = 'lien' and EnvoiId = '%s' and c.individuID = a.IndividuID ) as Nb_CLICKS";
		$sql .= " from wcm_newsletter_visu a, annuaire_individu b where a.individuID = b.individuID and EnvoiId = '%s'";
		$sql .= " group by a.individuID, b.nom,b.Prenom, b.Mail,b.LoginSage order by Nb_clicks desc, Nb_Ouv desc";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aEnvoiID ), mysqli_real_escape_string ($_SESSION['LINK'], $aEnvoiID ), mysqli_real_escape_string ($_SESSION['LINK'], $aEnvoiID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aNewsletterEnvoisDetails = new NewsletterEnvoisDetails ();
			$aNewsletterEnvoisDetails->setIndividuID ( ( int ) $line [0] );
			$aNewsletterEnvoisDetails->setDateDerOuv ( $line [1] );
			$aNewsletterEnvoisDetails->setNom ( $line [2] );
			$aNewsletterEnvoisDetails->setPreNom ( $line [3] );
			$aNewsletterEnvoisDetails->setMail ( $line [4] );
			$aNewsletterEnvoisDetails->setLoginSage ( $line [5] );
			$aNewsletterEnvoisDetails->setNbOuv ( $line [6] );
			$aNewsletterEnvoisDetails->setNbClicks ( $line [7] );
			$aArray [] = $aNewsletterEnvoisDetails;
		}

		mysqli_free_result  ( $result );

		return $aArray;
	}
	public function getSqlEnvoisDetails($aEnvoiID) {
		$aArray = array ();

		$sql = "select a.individuID As IndividuID, max(DateVisu) as Date_Derniere_Ouverture, b.nom as Nom, b.Prenom as Prenom, b.Telephone as Telephone, b.TelephonePortable as Tel_Portable,b.Mail as Mail, b.LoginSage as Login_Sage, e.CodePostal as CodePostal, ";
		$sql .= " ifnull(da.Libelle,'')  as Domaine, ifnull(daf.Libelle,'') as Fonction,";
		$sql .= " (select count(distinct DateVisu) from wcm_newsletter_visu c where ModVisu = 'ouv' and EnvoiId = '%s' and c.individuID = a.IndividuID ) as Ouvertures,";
		$sql .= " (select count(distinct DateVisu) from wcm_newsletter_visu c where ModVisu = 'lien' and EnvoiId = '%s' and c.individuID = a.IndividuID ) as Clicks";
		$sql .= " from wcm_newsletter_visu a";
		$sql .= " inner join annuaire_individu b  on b.IndividuID = a.IndividuID";
		$sql .= " inner join annuaire_etablissement e  on b.LieuTravailID = e.EtablissementID";
		$sql .= " left join annuaire_role r on b.LieuTravailID = r.EtablissementID and b.IndividuID = r.IndividuID";
		$sql .= " left join annuaire_role_domainactivite d on d.RoleID = r.RoleID";
		$sql .= " left join annuaire_lva_domainactivite da on da.DomainActiviteID = d.DomainActiviteID";
		$sql .= " left join annuaire_lva_domainactivite_fonction daf on daf.FonctionDAID = d.FonctionDAID";
		$sql .= " where EnvoiId = '%s'";
		$sql .= " group by a.individuID, b.nom,b.Prenom, b.Mail,b.LoginSage, e.CodePostal  order by Clicks desc, Ouvertures desc";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aEnvoiID ), mysqli_real_escape_string ($_SESSION['LINK'], $aEnvoiID ), mysqli_real_escape_string ($_SESSION['LINK'], $aEnvoiID ) );

		return $query;
	}
	public function getSqlEnvoisStats($aNewsID, $aEnvoiID, $aJ, $aDateDeb, $aDateFin) {
		$sql = " select DATE_FORMAT(Date(curdate()),\"%%Y%%m%%d\") as DATEJ,";
		$sql .= " (select distinct Nom from wcm_newsletter where NewsID = '%s') as NewsLetter,";
		$sql .= " (Select '%s') as EnvoiID,";
		$sql .= " (select NbEnvois from wcm_newsletter_envoi where NewsID = '%s' and EnvoiID = '%s') as NBEnvois,";
		$sql .= " (Select '%s') as Periode,";
		$sql .= " (select DATE_FORMAT(min(Date(DateCreation)),\"%%Y%%m%%d\")  from wcm_newsletter_historique where EnvoiId = '%s') as Date_Envoi,";
		$sql .= " (select ListeDiffusionName from wcm_newsletter_envoi where NewsID = '%s' and EnvoiId = '%s' ) as CIBLES,";
		$sql .= " (select GROUP_CONCAT(distinct(productID) SEPARATOR '|') from wcm_newsletter_visu where ModVisu = 'lien' and EnvoiId = '%s' and date(DateVisu) >= '%s' and date(DateVisu) <= '%s' )as ARTICLES,";
		$sql .= " (select count(distinct individuID,lienID,DATE_FORMAT(dateVisu, \"%%Y%%m%%d%%H%%i%%s\")) from wcm_newsletter_visu where ModVisu = 'lien' and EnvoiId = '%s' and date(DateVisu) >= '%s' and date(DateVisu) <= '%s' ) as CLICK,";
		$sql .= " (select count(distinct individuID) from wcm_newsletter_visu where ModVisu = 'ouv' and EnvoiId = '%s' and date(DateVisu) >= '%s' and date(DateVisu) <= '%s' ) as LECTEURS  ,";
		$sql .= " (select count(DATE_FORMAT(dateVisu, \"%%Y%%m%%d%%H%%i%%s\")) from wcm_newsletter_visu where ModVisu = 'ouv' and EnvoiId = '%s' and date(DateVisu) >= '%s' and date(DateVisu) <= '%s' ) as OUV";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aNewsID ), mysqli_real_escape_string ($_SESSION['LINK'], $aEnvoiID ), mysqli_real_escape_string ($_SESSION['LINK'], $aNewsID ), mysqli_real_escape_string ($_SESSION['LINK'], $aEnvoiID ), mysqli_real_escape_string ($_SESSION['LINK'], $aJ ), mysqli_real_escape_string ($_SESSION['LINK'], $aEnvoiID ), mysqli_real_escape_string ($_SESSION['LINK'], $aNewsID ), mysqli_real_escape_string ($_SESSION['LINK'], $aEnvoiID ), mysqli_real_escape_string ($_SESSION['LINK'], $aEnvoiID ), mysqli_real_escape_string ($_SESSION['LINK'], $aDateDeb ), mysqli_real_escape_string ($_SESSION['LINK'], $aDateFin ), mysqli_real_escape_string ($_SESSION['LINK'], $aEnvoiID ), mysqli_real_escape_string ($_SESSION['LINK'], $aDateDeb ), mysqli_real_escape_string ($_SESSION['LINK'], $aDateFin ), mysqli_real_escape_string ($_SESSION['LINK'], $aEnvoiID ), mysqli_real_escape_string ($_SESSION['LINK'], $aDateDeb ), mysqli_real_escape_string ($_SESSION['LINK'], $aDateFin ), mysqli_real_escape_string ($_SESSION['LINK'], $aEnvoiID ), mysqli_real_escape_string ($_SESSION['LINK'], $aDateDeb ), mysqli_real_escape_string ($_SESSION['LINK'], $aDateFin ) );
		echo $query;
		return $query;
	}
	public function getSqlNewsEnvoisStats($aNewsID) {
		$sql = " select DATE_FORMAT(Date(DateEnvoi) ,\"%%d/%%m/%%Y\") as DateEnvoi, sum(NbEnvois) as Envois, concat ('J+' , convert(Periode,char(2))) as Periodes, sum(Lecteurs) as Lecteurs,sum(Ouvertures) as Ouvertures,";
		$sql .= " sum(Clicks) as Clicks,GROUP_CONCAT(Cibles SEPARATOR '|') as Cibles,GROUP_CONCAT(Articles SEPARATOR '|') as 'Articles_Cliqués','' as Non_Remis, '' as Desinscription, '' as Visiteurs,'' as Bitly, '' as Commandes_Web, '' as Commandes_Hors_Web, '' as CA_Genere ";
		$sql .= " from wcm_newsletter_envoi_stats where NewsID = '%s' group by DateEnvoi, Periode order by DateEnvoi desc, Periode ";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aNewsID ) );

		return $query;
	}
	public function updateEnvoisMails($aEnvoiID) {
		$sql = "update wcm_newsletter_visu set EnvoiMail = 'OUI' where EnvoiId = '%s' and EnvoiMail = 'NON' ";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aEnvoiID ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
}
?>