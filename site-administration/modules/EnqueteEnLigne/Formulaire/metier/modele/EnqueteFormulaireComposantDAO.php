<?php
class EnqueteFormulaireComposantDAO {
	public function create($conventionFormulaireComposant) {
		$sql = "INSERT INTO enquete_formulaire_composant(id, nom, valeur, type) VALUES('%s', '%s', '%s', '%s')";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $conventionFormulaireComposant->getId () ), mysqli_real_escape_string ($_SESSION['LINK'], $conventionFormulaireComposant->getNom () ), mysqli_real_escape_string ($_SESSION['LINK'], $conventionFormulaireComposant->getValeur () ), mysqli_real_escape_string ($_SESSION['LINK'], $conventionFormulaireComposant->getType () ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function update($conventionFormulaireComposant) {
		$sql = "UPDATE enquete_formulaire_composant SET nom='%s', valeur='%s' WHERE id='%s'";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $conventionFormulaireComposant->getNom () ), mysqli_real_escape_string ($_SESSION['LINK'], $conventionFormulaireComposant->getValeur () ), mysqli_real_escape_string ($_SESSION['LINK'], $conventionFormulaireComposant->getId () ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function delete($id) {
		$sql = "DELETE FROM enquete_formulaire_composant  WHERE id='%s'";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $id ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function find($id) {
		$sql = "SELECT id, nom, valeur,type FROM enquete_formulaire_composant WHERE id = '%s'";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $id ) );
		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		$instance = new EnqueteFormulaireComposant ();

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$instance->setID ( $line [0] );
			$instance->setNom ( $line [1] );
			$instance->setValeur ( $line [2] );
			$instance->setType ( $line [3] );
		}
		return $instance;
	}
}