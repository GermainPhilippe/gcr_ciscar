<?php
class SurveyDraftRecipientManager {
	public function add(SurveyDraftRecipient $aSurveyDraftRecipient) {
		$sql = "INSERT IGNORE INTO wcm_survey_draft_recipient (SurveyID, ListeDiffusionID) VALUES('%s','%s')";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aSurveyDraftRecipient->getSurveyID () ), mysqli_real_escape_string ($_SESSION['LINK'], $aSurveyDraftRecipient->getListeDiffusionID () ) );
		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function delete(SurveyDraftRecipient $aSurveyDraftRecipient) {
		$sql = "DELETE FROM wcm_survey_draft_recipient WHERE SurveyID='%s' AND ListeDiffusionID='%s'";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aSurveyDraftRecipient->getSurveyID () ), mysqli_real_escape_string ($_SESSION['LINK'], $aSurveyDraftRecipient->getListeDiffusionID () ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function deleteAll($aSurveyID) {
		$sql = "DELETE FROM wcm_survey_draft_recipient WHERE SurveyID='%s'";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aSurveyID ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function getList($aSurveyID) {
		$aArray = array ();
		$sql = "SELECT SurveyID, ListeDiffusionID FROM wcm_survey_draft_recipient WHERE SurveyID='%s'";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aSurveyID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aSurveyDraftRecipient = new SurveyDraftRecipient ();
			$aSurveyDraftRecipient->setListeDiffusionID ( ( int ) $line [1] );
			$aSurveyDraftRecipient->setSurveyID ( ( int ) $line [0] );
			$aArray [] = $aSurveyDraftRecipient;
		}
		return $aArray;
	}
	public function getListNoRecipient($aSurveyID) {
		$aArray = array ();
		$sql = "SELECT listeID FROM annuaire_liste_diffusion WHERE SiteID='%s' AND listeID NOT IN (SELECT ListeDiffusionID FROM wcm_survey_draft_recipient WHERE SurveyID='%s') ORDER BY Nom";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ), mysqli_real_escape_string ($_SESSION['LINK'], $aSurveyID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aSurveyDraftRecipient = new SurveyDraftRecipient ();
			$aSurveyDraftRecipient->setListeDiffusionID ( ( int ) $line [0] );
			$aSurveyDraftRecipient->setSurveyID ( ( int ) $aSurveyID );
			$aArray [] = $aSurveyDraftRecipient;
		}
		return $aArray;
	}
}
?>