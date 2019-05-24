<?php
class EnqueteFormulaireCompositionDAO {
	public function create($EnqueteFormulaireComposition) {
		$sql = "INSERT INTO enquete_formulaire_composition(id, formulaireid, numordre, type) VALUES(NULL, %s, %s, '%s')";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $EnqueteFormulaireComposition->getFormulaireId () ), mysqli_real_escape_string ($_SESSION['LINK'], $EnqueteFormulaireComposition->getNumOrdre () ), mysqli_real_escape_string ($_SESSION['LINK'], $EnqueteFormulaireComposition->getType () ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function update($EnqueteFormulaireComposition) {
		$sql = "UPDATE enquete_formulaire_composition SET numordre='%s' WHERE id='%s'";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $EnqueteFormulaireComposition->getNumOrdre () ), mysqli_real_escape_string ($_SESSION['LINK'], $EnqueteFormulaireComposition->getId () ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function delete($id) {
		$sql = "DELETE FROM enquete_formulaire_composition WHERE id='%s'";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $id ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function find($id) {
		$sql = "SELECT id, formulaireid, numordre, type FROM enquete_formulaire_composition WHERE id = '%s'";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $id ) );
		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		$instance = new EnqueteFormulaireComposition ();

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$instance->setID ( $id );
			$instance->setFormulaireID ( $line [1] );
			$instance->setNumOrdre ( $line [2] );
			$instance->setType ( $line [3] );
		}
		return $instance;
	}
	public function findAll($formulaireid) {
		$sql = "SELECT id, formulaireid, numordre, type FROM enquete_formulaire_composition WHERE formulaireid = '%s' ORDER BY numordre";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $formulaireid ) );
		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		$collection = array ();

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$instance = new EnqueteFormulaireComposition ();
			$instance->setID ( $line [0] );
			$instance->setFormulaireID ( $line [1] );
			$instance->setNumOrdre ( $line [2] );
			$instance->setType ( $line [3] );
			$collection [] = $instance;
		}
		return $collection;
	}
	public function findAllField($formulaireid) {
		$sql = "SELECT id, formulaireid, numordre, type FROM enquete_formulaire_composition WHERE formulaireid = '%s' AND type='field' ORDER BY numordre";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $formulaireid ) );
		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		$collection = array ();

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$instance = new EnqueteFormulaireComposition ();
			$instance->setID ( $line [0] );
			$instance->setFormulaireID ( $line [1] );
			$instance->setNumOrdre ( $line [2] );
			$instance->setType ( $line [3] );
			$collection [] = $instance;
		}
		return $collection;
	}
}