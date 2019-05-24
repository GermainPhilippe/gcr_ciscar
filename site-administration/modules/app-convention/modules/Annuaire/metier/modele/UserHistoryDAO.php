<?php
class UserHistoryDAO {
	public function create($userHistory) {
		$sql = "INSERT INTO conv_annuaire_historique(id, dateAction, description, userId, actionRealisee) VALUES(NULL, NOW(), '%s', '%s' , '%s'  )";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $userHistory->getDescription () ), mysqli_real_escape_string ($_SESSION['LINK'], $userHistory->getUserId () ), mysqli_real_escape_string ($_SESSION['LINK'], $userHistory->getActionRealiseePar () ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function findAll($userid) {
		$sql = "SELECT id, dateAction, description, userId, actionRealisee FROM conv_annuaire_historique WHERE userId = '%s' ORDER BY dateAction DESC";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $userid ) );
		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		$collection = array ();

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$instance = new UserHistory ();
			$instance->setID ( $line [0] );
			$instance->setDateAction ( $line [1] );
			$instance->setDescription ( $line [2] );
			$instance->setUserId ( $line [3] );
			$instance->setActionRealiseePar ( $line [4] );

			$collection [] = $instance;
		}
		return $collection;
	}
}