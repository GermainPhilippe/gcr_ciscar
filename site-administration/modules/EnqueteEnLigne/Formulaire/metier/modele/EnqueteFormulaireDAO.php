<?php
class EnqueteFormulaireDAO {
	public function create($formulaire) {
		$sql = "INSERT INTO enquete_formulaire(id, conventionid, nom) VALUES(NULL,NULL, '%s')";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $formulaire->getNom () ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		return mysqli_insert_id ($_SESSION['LINK']);
	}
	public function update($formulaire) {
		$sql = "UPDATE enquete_formulaire SET nom = '%s', statut = '%s' WHERE id = '%s'";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $formulaire->getNom () ), mysqli_real_escape_string ($_SESSION['LINK'], $formulaire->getStatut () ), mysqli_real_escape_string ($_SESSION['LINK'], $formulaire->getID () ) );
		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function delete($id) {
		$sql = "DELETE FROM enquete_formulaire WHERE id = '%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $id ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function find($id) {
		$sql = "SELECT id, conventionid, nom, statut FROM enquete_formulaire WHERE id = '%s'";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $id ) );
		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		$instance = new EnqueteFormulaire ();

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$instance->setID ( $id );
			$instance->setEnqueteID ( $line [1] );
			$instance->setNom ( $line [2] );
			$instance->setStatut ( $line [3] );
		}
		return $instance;
	}
	public function findAll() {
		$sql = "SELECT id, conventionid, nom,statut FROM enquete_formulaire";
		// $query = sprintf($sql, mysql_real_escape_string($conventionID));
		$result = mysqli_query ($_SESSION['LINK'], $sql ) or die ( mysqli_error ($_SESSION['LINK']) );

		$collection = array ();

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$instance = new EnqueteFormulaire ();
			$instance->setID ( $line [0] );
			$instance->setEnqueteID ( $line [1] );
			$instance->setNom ( $line [2] );
			$instance->setStatut ( $line [3] );
			$collection [] = $instance;
		}
		return $collection;
	}
}
