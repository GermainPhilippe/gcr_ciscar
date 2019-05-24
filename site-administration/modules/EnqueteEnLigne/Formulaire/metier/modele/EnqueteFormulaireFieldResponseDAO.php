<?php
class EnqueteFormulaireFieldResponseDAO {
	public function create($enqueteFormulaireFieldResponse) {
		$sql = "INSERT INTO enquete_formulaire_response(id, fieldid, userid, valeur, enqueteid) VALUES(NULL, '%s', '%s', '%s','%s')";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $enqueteFormulaireFieldResponse->getFieldId () ), mysqli_real_escape_string ($_SESSION['LINK'], $enqueteFormulaireFieldResponse->getUserId () ), mysqli_real_escape_string ($_SESSION['LINK'], $enqueteFormulaireFieldResponse->getValeur () ), mysqli_real_escape_string ($_SESSION['LINK'], $enqueteFormulaireFieldResponse->getEnqueteId () ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function delete($id) {
		$sql = "DELETE FROM enquete_formulaire_response WHERE id= '%s')";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $id ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function deleteAll($fieldid, $userid) {
		$sql = "DELETE FROM enquete_formulaire_response WHERE fieldid= '%s' AND userid='%s'";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $fieldid ), mysqli_real_escape_string ($_SESSION['LINK'], $userid ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function findAllByEnquete($enqueteId) {
		$sql = "SELECT id, fieldid, userid, valeur, enqueteid, annuaireUserid, userLogin, userFirstname, userLastname, userEmail FROM enquete_formulaire_response WHERE enqueteid = '%s' ";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $enqueteId ) );
		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		$collection = array ();

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$instance = new EnqueteFormulaireFieldResponse ();
			$instance->setId ( $line [0] );
			$instance->setFieldId ( $line [1] );
			$instance->setUserId ( $line [2] );
			$instance->setValeur ( $line [3] );
			$instance->setEnqueteId ( $line [4] );
			$instance->setAnnuaireUserId ( $line [5] );
			$instance->setUserLogin ( $line [6] );
			$instance->setUserFirstname ( $line [7] );
			$instance->setUserLastname ( $line [8] );
			$instance->setUserEmail ( $line [9] );
			
			$collection [] = $instance;
		}
		return $collection;
	}
	public function findAll($fieldid, $userid) {
		$sql = "SELECT id, fieldid, userid, valeur, enqueteid FROM enquete_formulaire_response WHERE fieldid = '%s' AND userid='%s'";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $fieldid ), mysqli_real_escape_string ($_SESSION['LINK'], $userid ) );
		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		$collection = array ();

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$instance = new EnqueteFormulaireFieldResponse ();
			$instance->setId ( $line [0] );
			$instance->setFieldId ( $line [1] );
			$instance->setUserId ( $line [2] );
			$instance->setValeur ( $line [3] );
			$instance->setEnqueteId ( $line [4] );

			$collection [] = $instance;
		}
		return $collection;
	}
}