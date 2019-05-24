<?php
class SurveyRecipientManager {
	public function add(SurveyRecipient $aSurveyRecipient) {
		$sql = "INSERT IGNORE INTO wcm_survey_recipient (SurveyID, UserID, ARepondu)";
		$sql .= " VALUES('%s','%s','%s')";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aSurveyRecipient->getSurveyID () ), mysqli_real_escape_string ($_SESSION['LINK'], $aSurveyRecipient->getUserID () ), mysqli_real_escape_string ($_SESSION['LINK'], $aSurveyRecipient->getARepondu () ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function update(SurveyRecipient $aSurveyRecipient) {
		$sql = "UPDATE wcm_survey_recipient SET ARepondu='%s' WHERE SurveyID='%s' AND UserID='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aSurveyRecipient->getARepondu () ), mysqli_real_escape_string ($_SESSION['LINK'], $aSurveyRecipient->getSurveyID () ), mysqli_real_escape_string ($_SESSION['LINK'], $aSurveyRecipient->getUserID () ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function delete(SurveyRecipient $aSurveyRecipient) {
		$sql = "DELETE FROM wcm_survey_recipient WHERE SurveyID='%s' AND UserID='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aSurveyRecipient->getSurveyID () ), mysqli_real_escape_string ($_SESSION['LINK'], $aSurveyRecipient->getUserID () ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function getList($aSurveyID) {
		$aArray = array ();

		$sql = "SELECT SurveyID, UserID, ARepondu FROM wcm_survey_recipient WHERE SurveyID='%s'";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aSurveyID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aSurveyRecipient = new SurveyRecipient ();
			$aSurveyRecipient->setSurveyID ( ( int ) $line [0] );
			$aSurveyRecipient->setUserID ( ( int ) $line [1] );
			$aSurveyRecipient->setARepondu ( $line [2] );
			$aArray [] = $aSurveyRecipient;
		}
		return $aArray;
	}
	public function getListNoRepondu($aSurveyID) {
		$aArray = array ();

		$sql = "SELECT SurveyID, UserID, ARepondu FROM wcm_survey_recipient WHERE SurveyID='%s' AND ARepondu='0'";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aSurveyID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aSurveyRecipient = new SurveyRecipient ();
			$aSurveyRecipient->setSurveyID ( ( int ) $line [0] );
			$aSurveyRecipient->setUserID ( ( int ) $line [1] );
			$aSurveyRecipient->setARepondu ( $line [2] );
			$aArray [] = $aSurveyRecipient;
		}
		return $aArray;
	}
}
?>