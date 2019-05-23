<?php
class DocFormCatalogueModel {
	private $nom;
	private $prenom;
	private $mail;
	private $telephone;
	public function __construct() {
		$this->nom = '';
		$this->prenom = '';
		$this->mail = '';
		$this->telephone = '';
	}
	
	// ### GETTER ###
	public function getNom() {
		return $this->nom;
	}
	public function getPrenom() {
		return $this->prenom;
	}
	public function getMail() {
		return $this->mail;
	}
	public function getTelephone() {
		return $this->telephone;
	}
	
	// ### SETTER ###
	public function setNom($newValue) {
		$this->nom = $newValue;
	}
	public function setPrenom($newValue) {
		$this->prenom = $newValue;
	}
	public function setMail($newValue) {
		$this->mail = $newValue;
	}
	public function setTelephone($newValue) {
		$this->telephone = $newValue;
	}
	
	// ### SQL ###
	public function save() {
		$sql = "INSERT INTO form_catalogue(nom, prenom, telephone, mail) VALUES('%s','%s','%s','%s')";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'] , $this->nom ), mysqli_real_escape_string ($_SESSION['LINK'] , $this->prenom ), mysqli_real_escape_string ($_SESSION['LINK'] , $this->telephone ), mysqli_real_escape_string ($_SESSION['LINK'] , $this->mail ) );
		mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
}
?>