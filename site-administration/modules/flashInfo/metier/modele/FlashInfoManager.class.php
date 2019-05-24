<?php
class FlashInfoManager {
	public function __construct() {
	}

	// ###
	public function add(FlashInfo $aFlashInfo) {
		if ($aFlashInfo->getDocInfoDynID () != '') {
			$sql = "INSERT INTO wcm_flashinfo(flashInfoID, Nom, DateDebut, DateFin, InformationRiche, DocInfoDynID) VALUES(NULL, '%s', '%s', '%s', '%s','%s')";
			$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aFlashInfo->getNom () ), mysqli_real_escape_string ($_SESSION['LINK'], $aFlashInfo->getDateDebut () ), mysqli_real_escape_string ($_SESSION['LINK'], $aFlashInfo->getDateFin () ), mysqli_real_escape_string ($_SESSION['LINK'], $aFlashInfo->getInformation () ), mysqli_real_escape_string ($_SESSION['LINK'], $aFlashInfo->getDocInfoDynID () ) );

			mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
		} else {
			$sql = "INSERT INTO wcm_flashinfo(flashInfoID, Nom, DateDebut, DateFin, InformationRiche, DocInfoDynID) VALUES(NULL, '%s', '%s', '%s', '%s',NULL)";
			$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aFlashInfo->getNom () ), mysqli_real_escape_string ($_SESSION['LINK'], $aFlashInfo->getDateDebut () ), mysqli_real_escape_string ($_SESSION['LINK'], $aFlashInfo->getDateFin () ), mysqli_real_escape_string ($_SESSION['LINK'], $aFlashInfo->getInformation () ) );

			mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
		}
		$aFlashInfo->setID ( ( int ) mysqli_insert_id ($_SESSION['LINK']) );
	}
	public function update(FlashInfo $aFlashInfo) {
		if ($aFlashInfo->getDocInfoDynID () != '') {
			$sql = "UPDATE wcm_flashinfo SET Nom='%s', DateDebut='%s', DateFin='%s', InformationRiche='%s', DocInfoDynID='%s' WHERE flashInfoID='%s'";
			$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aFlashInfo->getNom () ), mysqli_real_escape_string ($_SESSION['LINK'], $aFlashInfo->getDateDebut () ), mysqli_real_escape_string ($_SESSION['LINK'], $aFlashInfo->getDateFin () ), mysqli_real_escape_string ($_SESSION['LINK'], $aFlashInfo->getInformation () ), mysqli_real_escape_string ($_SESSION['LINK'], $aFlashInfo->getDocInfoDynID () ), mysqli_real_escape_string ($_SESSION['LINK'], $aFlashInfo->getID () ) );

			mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
		} else {
			$sql = "UPDATE wcm_flashinfo SET Nom='%s', DateDebut='%s', DateFin='%s', InformationRiche='%s', DocInfoDynID=NULL WHERE flashInfoID='%s'";
			$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aFlashInfo->getNom () ), mysqli_real_escape_string ($_SESSION['LINK'], $aFlashInfo->getDateDebut () ), mysqli_real_escape_string ($_SESSION['LINK'], $aFlashInfo->getDateFin () ), mysqli_real_escape_string ($_SESSION['LINK'], $aFlashInfo->getInformation () ), mysqli_real_escape_string ($_SESSION['LINK'], $aFlashInfo->getID () ) );

			mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
		}
	}
	public function delete($aID) {
		$sql = "DELETE FROM wcm_flashinfo WHERE flashInfoID='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aID ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function get($aID) {
		$sql = "SELECT flashInfoID, Nom, DateDebut, DateFin, InformationRiche, DocInfoDynID FROM wcm_flashinfo WHERE flashInfoID='%s'";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
		$aFlashInfo = new FlashInfo ();
		if (mysqli_num_rows ( $result ) > 0) {
			$line = mysqli_fetch_array  ( $result );
			$aFlashInfo->setID ( ( int ) $line [0] );
			$aFlashInfo->setNom ( $line [1] );
			$aFlashInfo->setDateDebut ( $line [2] );
			$aFlashInfo->setDateFin ( $line [3] );
			$aFlashInfo->setInformation ( $line [4] );
			$aFlashInfo->setDocInfoDynID ( ( int ) $line [5] );
		}
		mysqli_free_result  ( $result );
		return $aFlashInfo;
	}
	public function getList($begin = -1, $limit = -1) {
		$aArray = array ();

		$sql = "SELECT flashInfoID, Nom, DateDebut, DateFin, InformationRiche, DocInfoDynID FROM wcm_flashinfo";
		if ($begin != - 1 || $limit != - 1) {
			$sql .= ' LIMIT ' . ( int ) $begin . ', ' . ( int ) $limit;
		}
		$result = mysqli_query ($_SESSION['LINK'], $sql ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aFlashInfo = new FlashInfo ();
			$aFlashInfo->setID ( ( int ) $line [0] );
			$aFlashInfo->setNom ( $line [1] );
			$aFlashInfo->setDateDebut ( $line [2] );
			$aFlashInfo->setDateFin ( $line [3] );
			$aFlashInfo->setInformation ( $line [4] );
			$aFlashInfo->setDocInfoDynID ( ( int ) $line [5] );
			$aArray [] = $aFlashInfo;
		}
		mysqli_free_result  ( $result );

		return $aArray;
	}
}
?>