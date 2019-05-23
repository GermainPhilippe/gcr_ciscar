<?php
class TraceUserDAO {
	public function create($traceUser) {
		$sql = "INSERT INTO stat_trace_user(id, user_id, date_action, description_in, url_in, description_out, url_out, site_id) ";
		$sql .= "VALUES(NULL, '%s', NOW(), '%s', '%s', '%s', '%s', '%s')";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $traceUser->getUserId () ), mysqli_real_escape_string ($_SESSION['LINK'], $traceUser->getDescriptionIn () ), mysqli_real_escape_string ( $_SESSION['LINK'],$traceUser->getUrlIn () ), mysqli_real_escape_string ( $_SESSION['LINK'],$traceUser->getDescriptionOut () ), mysqli_real_escape_string ( $_SESSION['LINK'],$traceUser->getUrlOut () ), mysqli_real_escape_string ($_SESSION['LINK'], $traceUser->getSiteId () ) );

		mysqli_query ( $_SESSION['LINK'],$query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
}