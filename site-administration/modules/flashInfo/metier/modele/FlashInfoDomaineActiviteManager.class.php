<?php
class FlashInfoDomaineActiviteManager {
	public function __construct() {
	}

	// ###
	public function add(FlashInfoDomaineActivite $aFlashInfoDomaineActivite) {
		$sql = "INSERT INTO wcm_flashinfo_domaineactivite(flashInfoID, domaineActiviteID) VALUES('%s', '%s')";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aFlashInfoDomaineActivite->getFlashInfoID () ), mysqli_real_escape_string ($_SESSION['LINK'], $aFlashInfoDomaineActivite->getDomaineActiviteID () ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function deleteAll($flashInfoID) {
		$sql = "DELETE FROM wcm_flashinfo_domaineactivite WHERE flashInfoID='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $flashInfoID ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function getList($flashInfoID, $begin = -1, $limit = -1) {
		$aArray = array ();

		$sql = "SELECT flashInfoID, domaineActiviteID FROM wcm_flashinfo_domaineactivite";
		$sql .= " WHERE flashInfoID='%s'";
		if ($begin != - 1 || $limit != - 1) {
			$sql .= ' LIMIT ' . ( int ) $begin . ', ' . ( int ) $limit;
		}

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $flashInfoID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aFlashInfoDomaineActivite = new FlashInfoDomaineActivite ();
			$aFlashInfoDomaineActivite->setFlashInfoID ( ( int ) $line [0] );
			$aFlashInfoDomaineActivite->setDomaineActiviteID ( ( int ) $line [1] );
			$aArray [] = $aFlashInfoDomaineActivite;
		}
		mysqli_free_result  ( $result );

		return $aArray;
	}
}
?>