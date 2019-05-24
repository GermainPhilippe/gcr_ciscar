<?php
class SurveyQuestionManager {
	public function add(SurveyQuestion $aSurveyQuestion) {
		$sql = "INSERT INTO wcm_survey_question (QuestionID, SurveyID, Description, Type, Choix1, Choix2, Choix3, Choix4, Choix5, Choix6)";
		$sql .= " VALUES(NULL,'%s','%s','%s','%s','%s','%s','%s','%s','%s')";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aSurveyQuestion->getSurveyID () ), mysqli_real_escape_string ($_SESSION['LINK'], $aSurveyQuestion->getDescription () ), mysqli_real_escape_string ($_SESSION['LINK'], $aSurveyQuestion->getType () ), mysqli_real_escape_string ($_SESSION['LINK'], $aSurveyQuestion->getChoix1 () ), mysqli_real_escape_string ($_SESSION['LINK'], $aSurveyQuestion->getChoix2 () ), mysqli_real_escape_string ($_SESSION['LINK'], $aSurveyQuestion->getChoix3 () ), mysqli_real_escape_string ($_SESSION['LINK'], $aSurveyQuestion->getChoix4 () ), mysqli_real_escape_string ($_SESSION['LINK'], $aSurveyQuestion->getChoix5 () ), mysqli_real_escape_string ($_SESSION['LINK'], $aSurveyQuestion->getChoix6 () ) );
		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function update(SurveyQuestion $aSurveyQuestion) {
		$sql = "UPDATE wcm_survey_question SET Description='%s', Type='%s', Choix1='%s', Choix2='%s', Choix3='%s', Choix4='%s', Choix5='%s', Choix6='%s' WHERE QuestionID='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aSurveyQuestion->getDescription () ), mysqli_real_escape_string ($_SESSION['LINK'], $aSurveyQuestion->getType () ), mysqli_real_escape_string ($_SESSION['LINK'], $aSurveyQuestion->getChoix1 () ), mysqli_real_escape_string ($_SESSION['LINK'], $aSurveyQuestion->getChoix2 () ), mysqli_real_escape_string ($_SESSION['LINK'], $aSurveyQuestion->getChoix3 () ), mysqli_real_escape_string ($_SESSION['LINK'], $aSurveyQuestion->getChoix4 () ), mysqli_real_escape_string ($_SESSION['LINK'], $aSurveyQuestion->getChoix5 () ), mysqli_real_escape_string ($_SESSION['LINK'], $aSurveyQuestion->getChoix6 () ), mysqli_real_escape_string ($_SESSION['LINK'], $aSurveyQuestion->getID () ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function delete($aID) {
		$sql = "DELETE FROM wcm_survey_question WHERE QuestionID='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aID ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function get($aID) {
		$sql = "SELECT QuestionID, SurveyID, Description, Type, Choix1, Choix2, Choix3, Choix4, Choix5, Choix6 FROM wcm_survey_question WHERE QuestionID='%s'";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		$aSurveyQuestion = new SurveyQuestion ();
		if (mysqli_num_rows ( $result ) > 0) {
			$line = mysqli_fetch_array  ( $result );

			$aSurveyQuestion->setID ( ( int ) $line [0] );
			$aSurveyQuestion->setSurveyID ( ( int ) $line [1] );
			$aSurveyQuestion->setDescription ( $line [2] );
			$aSurveyQuestion->setType ( $line [3] );
			$aSurveyQuestion->setChoix1 ( $line [4] );
			$aSurveyQuestion->setChoix2 ( $line [5] );
			$aSurveyQuestion->setChoix3 ( $line [6] );
			$aSurveyQuestion->setChoix4 ( $line [7] );
			$aSurveyQuestion->setChoix5 ( $line [8] );
			$aSurveyQuestion->setChoix6 ( $line [9] );
		}
		return $aSurveyQuestion;
	}
	public function getList($aSurveyID) {
		$aArray = array ();
		$sql = "SELECT QuestionID, SurveyID, Description, Type, Choix1, Choix2, Choix3, Choix4, Choix5, Choix6 FROM wcm_survey_question WHERE SurveyID='%s'";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aSurveyID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aSurveyQuestion = new SurveyQuestion ();
			$aSurveyQuestion->setID ( ( int ) $line [0] );
			$aSurveyQuestion->setSurveyID ( ( int ) $line [1] );
			$aSurveyQuestion->setDescription ( $line [2] );
			$aSurveyQuestion->setType ( $line [3] );
			$aSurveyQuestion->setChoix1 ( $line [4] );
			$aSurveyQuestion->setChoix2 ( $line [5] );
			$aSurveyQuestion->setChoix3 ( $line [6] );
			$aSurveyQuestion->setChoix4 ( $line [7] );
			$aSurveyQuestion->setChoix5 ( $line [8] );
			$aSurveyQuestion->setChoix6 ( $line [9] );
			$aArray [] = $aSurveyQuestion;
		}
		return $aArray;
	}
}
?>