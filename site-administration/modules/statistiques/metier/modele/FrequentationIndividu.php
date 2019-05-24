<?php
class FrequentationIndividu {
	public function findAllBySiteID($site_id, $mois, $annee, $user_id) {
		$sql_post = "SELECT user_id, DATE_FORMAT(date_action, '%d/%m/%Y') as date_action, description_in, url_in, description_out, url_out, Nom, Prenom FROM stat_trace_user, annuaire_individu ";
		$sql = "WHERE IndividuID = user_id AND site_id = '%s' AND MONTH(date_action)='%s' AND YEAR(date_action)='%s'";
		if ($user_id != '') {
			$sql .= " AND user_id = '%s'";
		}
		$sql .= " ORDER BY date_action DESC";

		if ($user_id != '') {
			$query = $sql_post . sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $site_id ), mysqli_real_escape_string ($_SESSION['LINK'], $mois ), mysqli_real_escape_string ($_SESSION['LINK'], $annee ), mysqli_real_escape_string ($_SESSION['LINK'], $user_id ) );
		} else {
			$query = $sql_post . sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $site_id ), mysqli_real_escape_string ($_SESSION['LINK'], $mois ), mysqli_real_escape_string ($_SESSION['LINK'], $annee ) );
		}

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		$collection = array ();
		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$collection [] = $line;
		}

		return $collection;
	}
}