<?php
class ConventionFormulaireFieldResponseDAO {
	public function create($conventionFormulaireFieldResponse) {
		$sql = "INSERT INTO conv_formulaire_response(id, fieldid, userid, valeur) VALUES(NULL, '%s', '%s', '%s')";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $conventionFormulaireFieldResponse->getFieldId () ), mysqli_real_escape_string ($_SESSION['LINK'], $conventionFormulaireFieldResponse->getUserId () ), mysqli_real_escape_string ($_SESSION['LINK'], $conventionFormulaireFieldResponse->getValeur () ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function delete($id) {
		$sql = "DELETE FROM conv_formulaire_response WHERE id= '%s')";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $id ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function deleteAll($fieldid, $userid) {
		$sql = "DELETE FROM conv_formulaire_response WHERE fieldid= '%s' AND userid='%s'";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $fieldid ), mysqli_real_escape_string ($_SESSION['LINK'], $userid ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function findAll($fieldid, $userid) {
		$sql = "SELECT id, fieldid, userid, valeur FROM conv_formulaire_response WHERE fieldid = '%s' AND userid='%s'";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $fieldid ), mysqli_real_escape_string ($_SESSION['LINK'], $userid ) );
		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		$collection = array ();

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$instance = new ConventionFormulaireFieldResponse ();
			$instance->setId ( $line [0] );
			$instance->setFieldId ( $line [1] );
			$instance->setUserId ( $line [2] );
			$instance->setValeur ( $line [3] );

			$collection [] = $instance;
		}
		return $collection;
	}
}