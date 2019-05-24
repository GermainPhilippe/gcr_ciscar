<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage individu
 * @version 1.0.4
 */
class IndividuFonctionBNList {
	private $myList;
	public function __construct() {
		$this->myList = array ();
	}
	public function getList() {
		return $this->myList;
	}
	public function setList($newValue) {
		$this->myList = $newValue;
	}

	// ###
	public function isIN($aFonctionBNID) {
		$result = false;

		foreach ( $this->myList as $aIndividuFonctionBN ) {
			if ($aIndividuFonctionBN->getFonctionBNID () == $aFonctionBNID) {
				$result = true;
				break;
			}
		}

		return $result;
	}
	public function SQL_SELECT_ALL($individuID) {
		$this->myList = array ();

		$sql = "SELECT FonctionBNID, IndividuID FROM annuaire_individufonctionbn WHERE IndividuID='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $individuID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aModele = new IndividuFonctionBN ();
			$aModele->setFonctionBNID ( $line [0] );
			$aModele->setIndividuID ( $line [1] );

			$this->myList [] = $aModele;
		}

		mysqli_free_result  ( $result );
	}
	public function SQL_DELETE_ALL($individuID) {
		$sql = "DELETE FROM annuaire_individufonctionbn WHERE IndividuID='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $individuID ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
}
?>