<?php
class BiblioMediaDAO {
	// Methods //
	public function create($instance) {
		$sql = "INSERT INTO biblio_media(id, titre, description, create_on, file_name, file_mime, file_size, file_blob)";
		$sql .= " VALUES(NULL, '%s', '%s', NOW(), '%s', '%s', '%s', '%s')";
		
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'] , $instance->getTitre () ), mysqli_real_escape_string ($_SESSION['LINK'] , $instance->getDescription () ), mysqli_real_escape_string ($_SESSION['LINK'] , $instance->getFileName () ), mysqli_real_escape_string ($_SESSION['LINK'] , $instance->getFileMime () ), mysqli_real_escape_string ($_SESSION['LINK'] , $instance->getFileSize () ), mysqli_real_escape_string ($_SESSION['LINK'] , $instance->getFileBlob () ) );
		
		mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function update(BiblioMedia $instance) {
		$sql = "UPDATE biblio_media SET titre = '%s', description = '%s', create_on = NOW(), file_name = '%s', file_mime = '%s',  file_size = '%s', file_blob = '%s' WHERE id = '%s'";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'] , $instance->getTitre () ), mysqli_real_escape_string ($_SESSION['LINK'] , $instance->getDescription () ), mysqli_real_escape_string ($_SESSION['LINK'] , $instance->getFileName () ), mysqli_real_escape_string ($_SESSION['LINK'] , $instance->getFileMime () ), mysqli_real_escape_string ($_SESSION['LINK'] , $instance->getFileSize () ), mysqli_real_escape_string ($_SESSION['LINK'] , $instance->getFileBlob () ), mysqli_real_escape_string ($_SESSION['LINK'] , $instance->getId () ) );
		
		mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function updateWithoutFileBlob(BiblioMedia $instance) {
		$sql = "UPDATE biblio_media SET titre = '%s', description = '%s' WHERE id = '%s'";
		
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'] , $instance->getTitre () ), mysqli_real_escape_string ($_SESSION['LINK'] , $instance->getDescription () ), mysqli_real_escape_string ($_SESSION['LINK'] , $instance->getId () ) );
		
		mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function delete($id) {
		$query = sprintf ( "DELETE FROM biblio_media WHERE id = '%s'", mysqli_real_escape_string ($_SESSION['LINK'] , $id ) );
		
		mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function find($id) {
		$sql = "SELECT id, titre, description, create_on, file_name, file_mime, file_size, file_blob  FROM biblio_media WHERE id = '%s'";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'] , $id ) );
		$result = mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
		
		$instance = new BiblioMedia ();
		while ( $line = mysqli_fetch_array ( $result ) ) {
			$instance->setId ( $line [0] );
			$instance->setTitre ( $line [1] );
			$instance->setDescription ( $line [2] );
			$instance->setCreateOn ( $line [3] );
			
			$instance->setFileName ( $line [4] );
			$instance->setFileMime ( $line [5] );
			$instance->setFileSize ( $line [6] );
			$instance->setFileBlob ( $line [7] );
		}
		
		return $instance;
	}
	public function findAll() {
		$sql = "SELECT id, titre, description, create_on, file_name, file_mime, file_size FROM biblio_media";
		$result = mysqli_query ( $_SESSION['LINK'] ,$sql ) or die ( mysqli_error ($_SESSION['LINK']) );
		
		$instances = array ();
		while ( $line = mysqli_fetch_array ( $result ) ) {
			$instance = new BiblioMedia ();
			$instance->setId ( $line [0] );
			$instance->setTitre ( $line [1] );
			$instance->setDescription ( $line [2] );
			$instance->setCreateOn ( $line [3] );
			
			$instance->setFileName ( $line [4] );
			$instance->setFileMime ( $line [5] );
			$instance->setFileSize ( $line [6] );
			$instances [] = $instance;
		}
		
		return $instances;
	}
	
	// Specific Search //
	public function findAllByTitre($titre) {
		$sql = "SELECT id, titre, description, create_on, file_name, file_mime, file_size FROM biblio_media WHERE titre LIKE '%s'";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'] , '%' . $titre . '%' ) );
		$result = mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
		
		$instances = array ();
		while ( $line = mysqli_fetch_array ( $result ) ) {
			$instance = new BiblioMedia ();
			$instance->setId ( $line [0] );
			$instance->setTitre ( $line [1] );
			$instance->setDescription ( $line [2] );
			$instance->setCreateOn ( $line [3] );
			
			$instance->setFileName ( $line [4] );
			$instance->setFileMime ( $line [5] );
			$instance->setFileSize ( $line [6] );
			$instances [] = $instance;
		}
		
		return $instances;
	}
}