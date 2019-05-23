<?php
class SSOTokenManager {
	public function add(SSOToken $ssotoken) {
		$sql = "INSERT INTO sso_token(id, dateCreation, userID, siteSource, siteDest, token) VALUES(NULL, '%s', '%s', '%s', '%s','%s')";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'] , $ssotoken->getDateCreation () ), mysqli_real_escape_string ($_SESSION['LINK'] , $ssotoken->getUserID () ), mysqli_real_escape_string ($_SESSION['LINK'] , $ssotoken->getSiteSource () ), mysqli_real_escape_string ($_SESSION['LINK'] , $ssotoken->getSiteDest () ), mysqli_real_escape_string ($_SESSION['LINK'] , $ssotoken->getToken () ) );
		
		mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function delete($id) {
		$sql = "DELETE FROM sso_token WHERE id = '%s'";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'] , $id ) );
		
		mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function get($token) {
		$sql = "SELECT id, dateCreation, userID, siteSource, siteDest, token FROM sso_token WHERE token = '%s'";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'] , $token ) );
		
		$result = mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
		$ssotoken = new SSOToken ();
		if (mysqli_num_rows ( $result ) > 0) {
			$line = mysqli_fetch_array ( $result );
			$ssotoken->setID ( ( int ) $line [0] );
			$ssotoken->setDateCreation ( $line [1] );
			$ssotoken->setUserID ( ( int ) $line [2] );
			$ssotoken->setSiteSource ( ( int ) $line [3] );
			$ssotoken->setSiteDest ( ( int ) $line [4] );
			$ssotoken->setToken ( $line [5] );
		}
		mysqli_free_result ( $result );
		return $ssotoken;
	}
	public function check($token) {
		$sql = "SELECT id, dateCreation, userID, siteSource, siteDest, token FROM sso_token WHERE token = '%s' AND (CURDATE()<= DATE_ADD(dateCreation, INTERVAL 2 MINUTE))";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'] , $token ) );
		
		$result = mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
		return (mysqli_num_rows ( $result ) > 0);
	}
}