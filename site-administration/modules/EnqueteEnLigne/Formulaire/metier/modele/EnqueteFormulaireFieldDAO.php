<?php
class EnqueteFormulaireFieldDAO {
	public function create($conventionFormulaireField) {
		$sql = "INSERT INTO enquete_formulaire_field(id, question, type, choix1, choix2, choix3, choix4, choix5, choix6, choix7, choix8, choix9, choix10) VALUES('%s', '%s', '%s','%s', '%s', '%s','%s', '%s', '%s','%s', '%s', '%s', '%s')";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $conventionFormulaireField->getId () ), mysqli_real_escape_string ($_SESSION['LINK'], $conventionFormulaireField->getQuestion () ), mysqli_real_escape_string ($_SESSION['LINK'], $conventionFormulaireField->getType () ), mysqli_real_escape_string ($_SESSION['LINK'], $conventionFormulaireField->getChoix1 () ), mysqli_real_escape_string ($_SESSION['LINK'], $conventionFormulaireField->getChoix2 () ), mysqli_real_escape_string ($_SESSION['LINK'], $conventionFormulaireField->getChoix3 () ), mysqli_real_escape_string ($_SESSION['LINK'], $conventionFormulaireField->getChoix4 () ), mysqli_real_escape_string ($_SESSION['LINK'], $conventionFormulaireField->getChoix5 () ), mysqli_real_escape_string ($_SESSION['LINK'], $conventionFormulaireField->getChoix6 () ), mysqli_real_escape_string ($_SESSION['LINK'], $conventionFormulaireField->getChoix7 () ), mysqli_real_escape_string ($_SESSION['LINK'], $conventionFormulaireField->getChoix8 () ), mysqli_real_escape_string ($_SESSION['LINK'], $conventionFormulaireField->getChoix9 () ), mysqli_real_escape_string ($_SESSION['LINK'], $conventionFormulaireField->getChoix10 () ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function update($conventionFormulaireField) {
		$sql = "UPDATE enquete_formulaire_field SET question='%s', type='%s', choix1='%s', choix2='%s', choix3='%s', choix4='%s', choix5='%s', choix6='%s', choix7='%s', choix8='%s', choix9='%s', choix10='%s' WHERE id='%s'";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $conventionFormulaireField->getQuestion () ), mysqli_real_escape_string ($_SESSION['LINK'], $conventionFormulaireField->getType () ), mysqli_real_escape_string ($_SESSION['LINK'], $conventionFormulaireField->getChoix1 () ), mysqli_real_escape_string ($_SESSION['LINK'], $conventionFormulaireField->getChoix2 () ), mysqli_real_escape_string ($_SESSION['LINK'], $conventionFormulaireField->getChoix3 () ), mysqli_real_escape_string ($_SESSION['LINK'], $conventionFormulaireField->getChoix4 () ), mysqli_real_escape_string ($_SESSION['LINK'], $conventionFormulaireField->getChoix5 () ), mysqli_real_escape_string ($_SESSION['LINK'], $conventionFormulaireField->getChoix6 () ), mysqli_real_escape_string ($_SESSION['LINK'], $conventionFormulaireField->getChoix7 () ), mysqli_real_escape_string ($_SESSION['LINK'], $conventionFormulaireField->getChoix8 () ), mysqli_real_escape_string ($_SESSION['LINK'], $conventionFormulaireField->getChoix9 () ), mysqli_real_escape_string ($_SESSION['LINK'], $conventionFormulaireField->getChoix10 () ), mysqli_real_escape_string ($_SESSION['LINK'], $conventionFormulaireField->getId () ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function delete($id) {
		$sql = "DELETE FROM enquete_formulaire_field WHERE id = '%s'";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $id ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function find($id) {
		$sql = "SELECT id, question, type, choix1, choix2, choix3, choix4, choix5, choix6, choix7, choix8, choix9, choix10 FROM enquete_formulaire_field WHERE id = '%s'";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $id ) );
		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		$instance = new EnqueteFormulaireField ();

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$instance->setId ( $line [0] );
			$instance->setQuestion ( $line [1] );
			$instance->setType ( $line [2] );
			$instance->setChoix1 ( $line [3] );
			$instance->setChoix2 ( $line [4] );
			$instance->setChoix3 ( $line [5] );
			$instance->setChoix4 ( $line [6] );
			$instance->setChoix5 ( $line [7] );
			$instance->setChoix6 ( $line [8] );
			$instance->setChoix7 ( $line [9] );
			$instance->setChoix8 ( $line [10] );
			$instance->setChoix9 ( $line [11] );
			$instance->setChoix10 ( $line [12] );
		}
		return $instance;
	}
	public function findAll() {
		$sql = "SELECT id, question, type, choix1, choix2, choix3, choix4, choix5, choix6, choix7, choix8, choix9, choix10 FROM enquete_formulaire_field WHERE id = '%s'";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $id ) );
		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		$collection = array ();

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$instance = new EnqueteFormulaireField ();
			$instance->setId ( $line [0] );
			$instance->setQuestion ( $line [1] );
			$instance->setType ( $line [2] );
			$instance->setChoix1 ( $line [3] );
			$instance->setChoix2 ( $line [4] );
			$instance->setChoix3 ( $line [5] );
			$instance->setChoix4 ( $line [6] );
			$instance->setChoix5 ( $line [7] );
			$instance->setChoix6 ( $line [8] );
			$instance->setChoix7 ( $line [9] );
			$instance->setChoix8 ( $line [10] );
			$instance->setChoix9 ( $line [11] );
			$instance->setChoix10 ( $line [12] );

			$collection [] = $instance;
		}
		return $collection;
	}
}