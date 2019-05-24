<?php
class ListeDiffusionCritereManager {
	public function __construct() {
	}
	public function add(ListeDiffusionCritere $aListeDiffusionCritere) {
		$sql = "INSERT INTO annuaire_liste_diffusion_critere (listeCritereID, listeID, Type, Contient, ElementID)";
		$sql .= " VALUES(NULL,'%s','%s','%s','%s')";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aListeDiffusionCritere->getListeID () ), mysqli_real_escape_string ($_SESSION['LINK'], $aListeDiffusionCritere->getType () ), mysqli_real_escape_string ($_SESSION['LINK'], $aListeDiffusionCritere->getContient () ), mysqli_real_escape_string ($_SESSION['LINK'], $aListeDiffusionCritere->getElementID () ) );
		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function update(ListeDiffusionCritere $aListeDiffusionCritere) {
		$sql = "UPDATE annuaire_liste_diffusion_critere SET Type='%s', Contient='%s', ElementID='%s' WHERE listeCritereID='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aListeDiffusionCritere->getType () ), mysqli_real_escape_string ($_SESSION['LINK'], $aListeDiffusionCritere->getContient () ), mysqli_real_escape_string ($_SESSION['LINK'], $aListeDiffusionCritere->getElementID () ), mysqli_real_escape_string ($_SESSION['LINK'], $aListeDiffusionCritere->getID () ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function deleteAll($aID) {
		$sql = "DELETE FROM annuaire_liste_diffusion_critere WHERE listeID='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aID ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function delete($aID) {
		$sql = "DELETE FROM annuaire_liste_diffusion_critere WHERE listeCritereID='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aID ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function get($aID) {
		$sql = "SELECT listeCritereID, listeID, Type, Contient ElementID FROM annuaire_liste_diffusion_critere";
		$sql .= " WHERE listeCritereID='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		$aListeDiffusionCritere = new ListeDiffusionCritere ();
		if (mysqli_num_rows ( $result ) > 0) {
			$line = mysqli_fetch_array  ( $result );
			$aListeDiffusionCritere->setID ( ( int ) $line [0] );
			$aListeDiffusionCritere->setListeID ( ( int ) $line [1] );
			$aListeDiffusionCritere->setType ( $line [2] );
			$aListeDiffusionCritere->setContient ( $line [3] );
			$aListeDiffusionCritere->setElementID ( ( int ) $line [4] );
		}

		mysqli_free_result  ( $result );

		return $aListeDiffusionCritere;
	}
	public function getList($aListeID, $debut = -1, $limite = -1) {
		$aArray = array ();
		$sql = "SELECT listeCritereID, listeID, Type, Contient, ElementID FROM annuaire_liste_diffusion_critere";
		$sql .= " WHERE listeID='%s'";
		if ($debut != - 1 || $limite != - 1) {
			$sql .= ' LIMIT ' . ( int ) $debut . ', ' . ( int ) $limite;
		}
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aListeID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aListeDiffusionCritere = new ListeDiffusionCritere ();
			$aListeDiffusionCritere->setID ( ( int ) $line [0] );
			$aListeDiffusionCritere->setListeID ( ( int ) $line [1] );
			$aListeDiffusionCritere->setType ( $line [2] );
			$aListeDiffusionCritere->setContient ( $line [3] );
			$aListeDiffusionCritere->setElementID ( ( int ) $line [4] );
			$aArray [] = $aListeDiffusionCritere;
		}

		mysqli_free_result  ( $result );

		return $aArray;
	}
	public function save(ListeDiffusionCritere $aListeDiffusionCritere) {
		$aListeDiffusionCritere->isNew () ? $this->add ( $aListeDiffusionCritere ) : $this->update ( $aListeDiffusionCritere );
	}
	public function count($aID) {
		$sql = "SELECT count(*) FROM annuaire_liste_diffusion WHERE SiteID='%s' AND listeID";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ), mysqli_real_escape_string ($_SESSION['LINK'], $aID ) );
		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		$line = 0;
		if (mysqli_num_rows ( $result ) > 0) {
			$line = mysqli_fetch_array  ( $result );
			$line = $line [0];
		}
		mysqli_free_result  ( $result );
		return $line;
	}
}
?>