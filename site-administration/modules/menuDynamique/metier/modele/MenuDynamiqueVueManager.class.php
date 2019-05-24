<?php
class MenuDynamiqueVueManager {
	public function add(MenuDynamiqueVue $aMenuDynamiqueVue) {
		$sql = "INSERT INTO wcm_menu_vue (MenuVueID, Nom)";
		$sql .= " VALUES(NULL,'%s')";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aMenuDynamiqueVue->getName () ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function update(MenuDynamiqueVue $aMenuDynamiqueVue) {
		$sql = "UPDATE wcm_menu_vue SET Nom='%s' WHERE MenuVueID='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aMenuDynamiqueVue->getName () ), mysqli_real_escape_string ($_SESSION['LINK'], $aMenuDynamiqueVue->getID () ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function delete($aID) {
		$sql = "DELETE FROM wcm_menu_vue WHERE MenuVueID='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aID ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function get($aID) {
		$query = sprintf ( "SELECT MenuVueID, Nom FROM wcm_menu_vue", mysqli_real_escape_string ($_SESSION['LINK'], $aID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		$aMenuDynamiqueVue = new MenuDynamiqueVue ();
		if (mysqli_num_rows ( $result ) > 0) {
			$line = mysqli_fetch_array  ( $result );
			$aMenuDynamiqueVue->setID ( ( int ) $line [0] );
			$aMenuDynamiqueVue->setName ( $line [1] );
		}
		return $aMenuDynamiqueVue;
	}
	public function getList($begin = -1, $limit = -1) {
		$aCollection = array ();

		$sql = "SELECT MenuVueID, Nom FROM wcm_menu_vue";
		if ($begin != - 1 || $limit != - 1) {
			$sql .= ' LIMIT ' . ( int ) $begin . ', ' . ( int ) $limit;
		}

		$result = mysqli_query ($_SESSION['LINK'], $sql ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aMenuDynamiqueVue = new MenuDynamiqueVue ();
			$aMenuDynamiqueVue->setID ( ( int ) $line [0] );
			$aMenuDynamiqueVue->setName ( $line [1] );
			$aCollection [] = $aMenuDynamiqueVue;
		}
		return $aCollection;
	}
}
?>