<?php
/**
 * @author Florent DESPIERRES
 * @package portail-ciscar
 * @subpackage document
 * @version 1.0.4
 */
class DocZoom {
	private $ID;
	private $Titre;
	private $Accroche;
	private $ImagePortail;
	private $DocInfoDynID;
	public function __construct() {
		$this->ID = NULL;
		$this->Titre = '';
		$this->Accroche = '';
		$this->ImagePortail = '';
		$this->DocInfoDynID = NULL;
	}
	
	// ###
	public function getID() {
		return $this->ID;
	}
	public function getTitre() {
		return $this->Titre;
	}
	public function getAccroche() {
		return $this->Accroche;
	}
	public function getImagePortail() {
		return $this->ImagePortail;
	}
	public function getDocInfoDynID() {
		return $this->DocInfoDynID;
	}
	public function setID($newValue) {
		$this->ID = $newValue;
	}
	public function setTitre($newValue) {
		$this->Titre = $newValue;
	}
	public function setAccroche($newValue) {
		$this->Accroche = $newValue;
	}
	public function setImagePortail($newValue) {
		$this->ImagePortail = $newValue;
	}
	public function setDocInfoDynID($newValue) {
		$this->DocInfoDynID = $newValue;
	}
	
	// ###
	public function SQL_select($DocID) {
		$sql = "SELECT DocZoomID, Titre, Accroche, ImagePortail,DocInfoDynID";
		$sql .= " FROM wcm_document_zoom";
		$sql .= " WHERE DocZoomID='%s'";
		
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'] , $DocID ) );
		
		$result = mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
		
		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array ( $result );
			$this->ID = $line [0];
			$this->Titre = $line [1];
			$this->Accroche = $line [2];
			$this->ImagePortail = $line [3];
			$this->DocInfoDynID = $line [4];
		} else {
			$this->ID = NULL;
			$this->Titre = '';
			$this->Accroche = '';
			$this->ImagePortail = '';
			$this->DocInfoDynID = NULL;
		}
		
		mysqli_free_result ( $result );
	}
}
?>
