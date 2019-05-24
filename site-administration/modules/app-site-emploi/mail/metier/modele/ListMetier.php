<?php
/**
 * Class gérant les listes de métiers
 * @author Philippe GERMAIN
 * @package site-emploi
 * @subpackage commun
 * @version 1.0.4
 */
class ListMetier {
	private $myList;
	public function __constructList($aList) {
		$this->myList = $aList;
	}

	// ###
	public function getList() {
		return $this->myList;
	}
	public function setList($newValue) {
		$this->myList = $newValue;
	}

	// ###
	public function SQL_SELECT_ALL() {
		$this->myList = array ();

		$sql = "SELECT ecm.IDCatMetier, IDMetier, NomMetier, NomCatMetier FROM emploi_cat_metier ecm, emploi_metier em where em.IDCatMetier = ecm.IDCatMetier and em.Visible = 1 order by ecm.IDCatMetier, em.NomMetier";

		$result = mysqli_query ($_SESSION['LINK'], $sql ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aModele = new Metier ();
			$aModele->setidcatmetier ( $line [0] );
			$aModele->setidmetier ( $line [1] );
			$aModele->setnommetier ( $line [2] );
			$aModele->setnomcatmetier ( $line [3] );

			$this->myList [] = $aModele;
		}

		mysqli_free_result  ( $result );
	}
	public function SQL_SELECT_METIER($id) {
		$sql = "SELECT NomMetier FROM emploi_metier WHERE  IDMetier = '%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $id ) );
		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
		$line = mysqli_fetch_array  ( $result );
		return $line [0];
		mysqli_free_result  ( $result );
	}
}

?>
