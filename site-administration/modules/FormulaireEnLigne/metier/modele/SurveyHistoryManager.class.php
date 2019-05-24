<?php
class SurveyHistoryManager {
	public function add(SurveyHistory $aSurveyHistory) {
		$sql = "INSERT INTO wcm_survey_history (HistoryID, SurveyID, DateCreation, Description)";
		$sql .= " VALUES(NULL,'%s', NOW(),'%s')";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aSurveyHistory->getSurveyID () ), mysqli_real_escape_string ($_SESSION['LINK'], $aSurveyHistory->getDescription () ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function getList($aSurveyID) {
		$aArray = array ();

		$sql = "SELECT HistoryID, SurveyID, DateCreation, Description FROM wcm_survey_history WHERE SurveyID='%s' ORDER BY HistoryID DESC";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aSurveyID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aSurveyHistory = new SurveyHistory ();
			$aSurveyHistory->setID ( ( int ) $line [0] );
			$aSurveyHistory->setSurveyID ( ( int ) $line [1] );
			$aSurveyHistory->setDateCreation ( $line [2] );
			$aSurveyHistory->setDescription ( $line [3] );
			$aArray [] = $aSurveyHistory;
		}
		return $aArray;
	}
}
?>