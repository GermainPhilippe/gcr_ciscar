<?php
class ConventionPageDAO {
	public function create($conventionPage) {
		$sql = "INSERT INTO conv_page(id, title, htmlcontent) VALUES(NULL, '%s', '%s')";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $conventionPage->getTitle () ), mysqli_real_escape_string ($_SESSION['LINK'], $conventionPage->getHtmlContent () ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function update($conventionPage) {
		$sql = "UPDATE conv_page SET title = '%s', htmlcontent = '%s' WHERE id = '%s'";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $conventionPage->getTitle () ), mysqli_real_escape_string ($_SESSION['LINK'], $conventionPage->getHtmlContent () ), mysqli_real_escape_string ($_SESSION['LINK'], $conventionPage->getId () ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function delete($id) {
		$sql = "DELETE FROM conv_page WHERE id = '%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $id ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function find($id) {
		$sql = "SELECT id, title, htmlcontent FROM conv_page WHERE id = '%s'";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $id ) );
		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		$instance = new ConventionPage ();

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$instance->setId ( $id );
			$instance->setTitle ( $line [1] );
			$instance->setHtmlContent ( $line [2] );
		}
		return $instance;
	}
	public function findAll() {
		$query = "SELECT id, title, htmlcontent FROM conv_page ORDER BY title";
		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		$collection = array ();

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$instance = new ConventionPage ();
			$instance->setId ( $line [0] );
			$instance->setTitle ( $line [1] );
			$instance->setHtmlContent ( $line [2] );
			$collection [] = $instance;
		}
		return $collection;
	}
}