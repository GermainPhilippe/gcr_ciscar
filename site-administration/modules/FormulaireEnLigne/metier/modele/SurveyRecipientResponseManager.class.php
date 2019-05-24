<?php
class SurveyRecipientResponseManager {
	public function add(SurveyRecipientResponse $aSurveyRecipientResponse) {
		$sql = "INSERT IGNORE INTO wcm_survey_recipient_response (SurveyID, UserID, QuestionID, Response)";
		$sql .= " VALUES('%s','%s','%s','%s')";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aSurveyRecipientResponse->getSurveyID () ), mysqli_real_escape_string ($_SESSION['LINK'], $aSurveyRecipientResponse->getUserID () ), mysqli_real_escape_string ($_SESSION['LINK'], $aSurveyRecipientResponse->getQuestionID () ), mysqli_real_escape_string ($_SESSION['LINK'], $aSurveyRecipientResponse->getResponse () ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function update(SurveyRecipientResponse $aSurveyRecipientResponse) {
		$sql = "UPDATE wcm_survey_recipient_response SET Response='%s' WHERE SurveyID='%s' AND UserID='%s' AND QuestionID='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aSurveyRecipientResponse->getResponse () ), mysqli_real_escape_string ($_SESSION['LINK'], $aSurveyRecipientResponse->getSurveyID () ), mysqli_real_escape_string ($_SESSION['LINK'], $aSurveyRecipientResponse->getUserID () ), mysqli_real_escape_string ($_SESSION['LINK'], $aSurveyRecipientResponse->getQuestionID () ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function delete(SurveyRecipientResponse $aSurveyRecipientResponse) {
		$sql = "DELETE FROM wcm_survey_recipient_response WHERE SurveyID='%s' AND UserID='%s' AND QuestionID='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aSurveyRecipientResponse->getSurveyID () ), mysqli_real_escape_string ($_SESSION['LINK'], $aSurveyRecipientResponse->getUserID () ), mysqli_real_escape_string ($_SESSION['LINK'], $aSurveyRecipientResponse->getQuestionID () ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function getList($aSurvey) {
		$aArray = array ();

		$sql = "SELECT SurveyID, UserID, QuestionID, Response FROM wcm_survey WHERE SurveyID='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aSurvey ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aSurveyRecipientResponse = new SurveyRecipientResponse ();
			$aSurveyRecipientResponse->setSurveyID ( ( int ) $line [0] );
			$aSurveyRecipientResponse->setUserID ( ( int ) $line [1] );
			$aSurveyRecipientResponse->setQuestionID ( ( int ) $line [2] );
			$aSurveyRecipientResponse->setResponse ( $line [3] );
			$aArray [] = $aSurveyRecipientResponse;
		}
		return $aArray;
	}
	public function getListUserReponse($aSurvey) {
		$aArray = array ();

		$sql = "SELECT i.Nom, i.Prenom, r.Response FROM wcm_survey_recipient_response r, annuaire_individu i WHERE i.IndividuID = r.UserID AND r.SurveyID='%s' ORDER BY r.UserID,r.QuestionID";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aSurvey ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aArray [] = $line;
		}
		return $aArray;
	}
}
?>