<?php
class MenuDynamiqueManager {
	public function add(MenuDynamique $aMenuDynamique) {
		$sql = "INSERT INTO wcm_menu (MenuID, Name, IconeDeplie, IconePlie, StatutDepart, TypeVueID, ElementID, ParentID, NumOrdre)";
		$sql .= " VALUES(NULL,'%s','%s','%s','%s','%s','%s',";
		$sql .= is_null ( $aMenuDynamique->getParentID () ) ? " NULL,'%s')" : "'" . $aMenuDynamique->getParentID () . "','%s')";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aMenuDynamique->getName () ), mysqli_real_escape_string ($_SESSION['LINK'], $aMenuDynamique->getIconeDeplie () ), mysqli_real_escape_string ($_SESSION['LINK'], $aMenuDynamique->getIconePlie () ), mysqli_real_escape_string ($_SESSION['LINK'], $aMenuDynamique->getStatutDepart () ), mysqli_real_escape_string ($_SESSION['LINK'], $aMenuDynamique->getTypeVueID () ), mysqli_real_escape_string ($_SESSION['LINK'], $aMenuDynamique->getElementID () ), mysqli_real_escape_string ($_SESSION['LINK'], $aMenuDynamique->getNumOrdre () ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function update(MenuDynamique $aMenuDynamique) {
		$sql = "UPDATE wcm_menu SET Name='%s', IconeDeplie='%s', IconePlie='%s', StatutDepart='%s', TypeVueID='%s', ElementID='%s', ";
		$sql .= is_null ( $aMenuDynamique->getParentID () ) ? "ParentID=NULL," : "ParentID='" . $aMenuDynamique->getParentID () . "',";
		$sql .= " NumOrdre='%s' WHERE MenuID='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aMenuDynamique->getName () ), mysqli_real_escape_string ($_SESSION['LINK'], $aMenuDynamique->getIconeDeplie () ), mysqli_real_escape_string ($_SESSION['LINK'], $aMenuDynamique->getIconePlie () ), mysqli_real_escape_string ($_SESSION['LINK'], $aMenuDynamique->getStatutDepart () ), mysqli_real_escape_string ($_SESSION['LINK'], $aMenuDynamique->getTypeVueID () ), mysqli_real_escape_string ($_SESSION['LINK'], $aMenuDynamique->getElementID () ), mysqli_real_escape_string ($_SESSION['LINK'], $aMenuDynamique->getNumOrdre () ), mysqli_real_escape_string ($_SESSION['LINK'], $aMenuDynamique->getID () ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function delete($aID) {
		$sql = "DELETE FROM wcm_menu WHERE MenuID='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aID ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function get($aID) {
		$sql = "SELECT MenuID, Name, IconeDeplie, IconePlie, StatutDepart, TypeVueID, ElementID, ParentID, NumOrdre FROM wcm_menu WHERE MenuID='%s'";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		$aMenuDynamique = new MenuDynamique ();
		if (mysqli_num_rows ( $result ) > 0) {
			$line = mysqli_fetch_array  ( $result );
			$aMenuDynamique->setID ( ( int ) $line [0] );
			$aMenuDynamique->setName ( $line [1] );
			$aMenuDynamique->setIconeDeplie ( $line [2] );
			$aMenuDynamique->setIconePlie ( $line [3] );
			$aMenuDynamique->setStatutDepart ( $line [4] );
			$aMenuDynamique->setTypeVueID ( ( int ) $line [5] );
			$aMenuDynamique->setElementID ( $line [6] );
			$aMenuDynamique->setParentID ( ( int ) $line [7] );
			$aMenuDynamique->setNumOrdre ( ( int ) $line [8] );
		}
		return $aMenuDynamique;
	}
	public function getList($begin = -1, $limit = -1) {
		$aCollection = array ();
		$sql = "SELECT MenuID, Name, IconeDeplie, IconePlie, StatutDepart, TypeVueID, ElementID, ParentID, NumOrdre FROM wcm_menu ORDER BY NumOrdre,Name";
		if ($begin != - 1 || $limit != - 1) {
			$sql .= ' LIMIT ' . ( int ) $begin . ', ' . ( int ) $limit;
		}

		$result = mysqli_query ($_SESSION['LINK'], $sql ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aMenuDynamique = new MenuDynamique ();
			$aMenuDynamique->setID ( ( int ) $line [0] );
			$aMenuDynamique->setName ( $line [1] );
			$aMenuDynamique->setIconeDeplie ( $line [2] );
			$aMenuDynamique->setIconePlie ( $line [3] );
			$aMenuDynamique->setStatutDepart ( $line [4] );
			$aMenuDynamique->setTypeVueID ( ( int ) $line [5] );
			$aMenuDynamique->setElementID ( $line [6] );
			$aMenuDynamique->setParentID ( ( int ) $line [7] );
			$aMenuDynamique->setNumOrdre ( ( int ) $line [8] );
			$aCollection [] = $aMenuDynamique;
		}

		return $aCollection;
	}
	public function getParentMenuList($begin = -1, $limit = -1) {
		$aCollection = array ();
		$sql = "SELECT MenuID, Name, IconeDeplie, IconePlie, StatutDepart, TypeVueID, ElementID, ParentID, NumOrdre FROM wcm_menu WHERE ParentID IS NULL ORDER BY NumOrdre,Name";
		if ($begin != - 1 || $limit != - 1) {
			$sql .= ' LIMIT ' . ( int ) $begin . ', ' . ( int ) $limit;
		}

		$result = mysqli_query ($_SESSION['LINK'], $sql ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aMenuDynamique = new MenuDynamique ();
			$aMenuDynamique->setID ( ( int ) $line [0] );
			$aMenuDynamique->setName ( $line [1] );
			$aMenuDynamique->setIconeDeplie ( $line [2] );
			$aMenuDynamique->setIconePlie ( $line [3] );
			$aMenuDynamique->setStatutDepart ( $line [4] );
			$aMenuDynamique->setTypeVueID ( ( int ) $line [5] );
			$aMenuDynamique->setElementID ( $line [6] );
			$aMenuDynamique->setParentID ( ( int ) $line [7] );
			$aMenuDynamique->setNumOrdre ( ( int ) $line [8] );
			$aCollection [] = $aMenuDynamique;
		}

		return $aCollection;
	}
	public function getChildMenuList($ParentID, $begin = -1, $limit = -1) {
		$aCollection = array ();
		$sql = "SELECT MenuID, Name, IconeDeplie, IconePlie, StatutDepart, TypeVueID, ElementID, ParentID, NumOrdre FROM wcm_menu WHERE ParentID='%s' ORDER BY NumOrdre,Name";
		if ($begin != - 1 || $limit != - 1) {
			$sql .= ' LIMIT ' . ( int ) $begin . ', ' . ( int ) $limit;
		}
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $ParentID ) );
		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aMenuDynamique = new MenuDynamique ();
			$aMenuDynamique->setID ( ( int ) $line [0] );
			$aMenuDynamique->setName ( $line [1] );
			$aMenuDynamique->setIconeDeplie ( $line [2] );
			$aMenuDynamique->setIconePlie ( $line [3] );
			$aMenuDynamique->setStatutDepart ( $line [4] );
			$aMenuDynamique->setTypeVueID ( ( int ) $line [5] );
			$aMenuDynamique->setElementID ( $line [6] );
			$aMenuDynamique->setParentID ( ( int ) $line [7] );
			$aMenuDynamique->setNumOrdre ( ( int ) $line [8] );
			$aCollection [] = $aMenuDynamique;
		}

		return $aCollection;
	}
}
?>