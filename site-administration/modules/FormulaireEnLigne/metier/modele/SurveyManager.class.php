<?php
class SurveyManager {
	public function add(Survey $aSurvey) {
		$sql = "INSERT INTO wcm_survey (SurveyID, Name, DateCreation, Status, EnvoiInvitation, EnvoiRelance)";
		$sql .= " VALUES(NULL,'%s', NOW(),'%s','%s','%s')";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aSurvey->getName () ), mysqli_real_escape_string ($_SESSION['LINK'], $aSurvey->getStatus () ), mysqli_real_escape_string ($_SESSION['LINK'], $aSurvey->getEnvoiInvitation () ), mysqli_real_escape_string ($_SESSION['LINK'], $aSurvey->getEnvoiRelance () ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
		$aSurvey->setID ( ( int ) mysqli_insert_id ($_SESSION['LINK']) );
	}
	public function update(Survey $aSurvey) {
		$sql = "UPDATE wcm_survey SET Name='%s', Status='%s', EnvoiInvitation='%s', EnvoiRelance='%s' WHERE SurveyID='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aSurvey->getName () ), mysqli_real_escape_string ($_SESSION['LINK'], $aSurvey->getStatus () ), mysqli_real_escape_string ($_SESSION['LINK'], $aSurvey->getEnvoiInvitation () ), mysqli_real_escape_string ($_SESSION['LINK'], $aSurvey->getEnvoiRelance () ), mysqli_real_escape_string ($_SESSION['LINK'], $aSurvey->getID () ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function delete($aID) {
		$sql = "DELETE FROM wcm_survey WHERE SurveyID='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aID ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function get($aID) {
		$sql = "SELECT SurveyID, Name, DateCreation, Status, EnvoiInvitation, EnvoiRelance FROM wcm_survey WHERE SurveyID='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		$aSurvey = new Survey ();
		if (mysqli_num_rows ( $result ) > 0) {
			$line = mysqli_fetch_array  ( $result );
			$aSurvey->setID ( ( int ) $line [0] );
			$aSurvey->setName ( $line [1] );
			$aSurvey->setDateCreation ( $line [2] );
			$aSurvey->setStatus ( $line [3] );
			$aSurvey->setEnvoiInvitation ( $line [4] );
			$aSurvey->setEnvoiRelance ( $line [5] );
		}
		return $aSurvey;
	}
	public function getList() {
		$aArray = array ();

		$sql = "SELECT SurveyID, Name, DateCreation, Status, EnvoiInvitation, EnvoiRelance FROM wcm_survey ORDER BY Name";

		$result = mysqli_query ($_SESSION['LINK'], $sql ) or die ( mysqli_error ($_SESSION['LINK']) );
		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aSurvey = new Survey ();
			$aSurvey->setID ( ( int ) $line [0] );
			$aSurvey->setName ( $line [1] );
			$aSurvey->setDateCreation ( $line [2] );
			$aSurvey->setStatus ( $line [3] );
			$aSurvey->setEnvoiInvitation ( $line [4] );
			$aSurvey->setEnvoiRelance ( $line [5] );
			$aArray [] = $aSurvey;
		}
		return $aArray;
	}
}
?>