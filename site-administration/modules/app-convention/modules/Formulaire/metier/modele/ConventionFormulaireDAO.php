<?php
class ConventionFormulaireDAO {
	public function create($formulaire) {
		$sql = "INSERT INTO conv_formulaire(id, conventionid, nom) VALUES(NULL,NULL, '%s')";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $formulaire->getNom () ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		return mysqli_insert_id ($_SESSION['LINK']);
	}
	public function update($formulaire) {
		$sql = "UPDATE conv_formulaire SET nom = '%s' WHERE id = '%s'";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $formulaire->getNom () ), mysqli_real_escape_string ($_SESSION['LINK'], $formulaire->getID () ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function delete($id) {
		$sql = "DELETE FROM conv_formulaire WHERE id = '%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $id ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function find($id) {
		$sql = "SELECT id, conventionid, nom FROM conv_formulaire WHERE id = '%s'";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $id ) );
		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		$instance = new ConventionFormulaire ();

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$instance->setID ( $id );
			$instance->setConventionID ( $line [1] );
			$instance->setNom ( $line [2] );
		}
		return $instance;
	}
	public function findAll() {
		$sql = "SELECT id, conventionid, nom FROM conv_formulaire";
		// $query = sprintf($sql, mysql_real_escape_string($conventionID));
		$result = mysqli_query ($_SESSION['LINK'], $sql ) or die ( mysqli_error ($_SESSION['LINK']) );

		$collection = array ();

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$instance = new ConventionFormulaire ();
			$instance->setID ( $line [0] );
			$instance->setConventionID ( $line [1] );
			$instance->setNom ( $line [2] );

			$collection [] = $instance;
		}
		return $collection;
	}
}
