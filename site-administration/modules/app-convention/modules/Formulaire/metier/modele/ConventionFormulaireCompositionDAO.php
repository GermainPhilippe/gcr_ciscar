<?php
class ConventionFormulaireCompositionDAO {
	public function create($ConventionFormulaireComposition) {
		$sql = "INSERT INTO conv_formulaire_composition(id, formulaireid, numordre, type) VALUES(NULL, %s, %s, '%s')";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $ConventionFormulaireComposition->getFormulaireId () ), mysqli_real_escape_string ($_SESSION['LINK'], $ConventionFormulaireComposition->getNumOrdre () ), mysqli_real_escape_string ($_SESSION['LINK'], $ConventionFormulaireComposition->getType () ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function update($ConventionFormulaireComposition) {
		$sql = "UPDATE conv_formulaire_composition SET numordre='%s' WHERE id='%s'";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $ConventionFormulaireComposition->getNumOrdre () ), mysqli_real_escape_string ($_SESSION['LINK'], $ConventionFormulaireComposition->getId () ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function delete($id) {
		$sql = "DELETE FROM conv_formulaire_composition WHERE id='%s'";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $id ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function find($id) {
		$sql = "SELECT id, formulaireid, numordre, type FROM conv_formulaire_composition WHERE id = '%s'";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $id ) );
		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		$instance = new ConventionFormulaireComposition ();

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$instance->setID ( $id );
			$instance->setFormulaireID ( $line [1] );
			$instance->setNumOrdre ( $line [2] );
			$instance->setType ( $line [3] );
		}
		return $instance;
	}
	public function findAll($formulaireid) {
		$sql = "SELECT id, formulaireid, numordre, type FROM conv_formulaire_composition WHERE formulaireid = '%s' ORDER BY numordre";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $formulaireid ) );
		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		$collection = array ();

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$instance = new ConventionFormulaireComposition ();
			$instance->setID ( $line [0] );
			$instance->setFormulaireID ( $line [1] );
			$instance->setNumOrdre ( $line [2] );
			$instance->setType ( $line [3] );
			$collection [] = $instance;
		}
		return $collection;
	}
	public function findAllField($formulaireid) {
		$sql = "SELECT id, formulaireid, numordre, type FROM conv_formulaire_composition WHERE formulaireid = '%s' AND type='field' ORDER BY numordre";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $formulaireid ) );
		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		$collection = array ();

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$instance = new ConventionFormulaireComposition ();
			$instance->setID ( $line [0] );
			$instance->setFormulaireID ( $line [1] );
			$instance->setNumOrdre ( $line [2] );
			$instance->setType ( $line [3] );
			$collection [] = $instance;
		}
		return $collection;
	}
}