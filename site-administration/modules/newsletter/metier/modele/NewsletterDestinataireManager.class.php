<?php
class NewsletterDestinataireManager {
	public function __construct() {
	}
	public function add(NewsletterDestinataire $aNewsletterDestinataire) {
		$sql = "INSERT INTO wcm_newsletter_destinataire (NewsID, ListeDiffusionID) VALUES('%s','%s')";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aNewsletterDestinataire->getNewsletterID () ), mysqli_real_escape_string ($_SESSION['LINK'], $aNewsletterDestinataire->getListeDiffusionID () ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function deleteAll($aNewsID) {
		$sql = "DELETE FROM wcm_newsletter_destinataire WHERE NewsID='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aNewsID ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function getList($aNewsID, $debut = -1, $limite = -1) {
		$aArray = array ();

		$sql = "SELECT NewsID, ListeDiffusionID FROM wcm_newsletter_destinataire";
		$sql .= " WHERE NewsID='%s'";
		if ($debut != - 1 || $limite != - 1) {
			$sql .= ' LIMIT ' . ( int ) $debut . ', ' . ( int ) $limite;
		}

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aNewsID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aNewsletterDestinataire = new NewsletterDestinataire ();
			$aNewsletterDestinataire->setNewsletterID ( ( int ) $line [0] );
			$aNewsletterDestinataire->setListeDiffusionID ( ( int ) $line [1] );
			$aArray [] = $aNewsletterDestinataire;
		}

		mysqli_free_result  ( $result );

		return $aArray;
	}
}
?>