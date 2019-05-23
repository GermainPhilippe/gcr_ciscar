<?php
/**
 * @author Florent DESPIERRES
 * @package portail-ciscar
 * @subpackage banniere
 * @version 1.0.4
 */
class BanniereList {
	private $myList;
	public function __construct() {
		$this->myList = array ();
	}
	
	// ###
	public function getList() {
		return $this->myList;
	}
	public function setList($aList) {
		$this->myList = $aList;
	}
	
	// ###
	public function SQL_select_all() {
		$this->myList = array ();
		
		$result = mysqli_query ( $_SESSION['LINK'] ,"SELECT BanniereID, Titre, URL, URL_Image, Publication, DateDebut, DateFin, ParDefaut FROM wcm_banniere" ) or die ( mysqli_error ($_SESSION['LINK']) );
		
		while ( $line = mysqli_fetch_array ( $result ) ) {
			$aBanniere = new Banniere ();
			$aBanniere->setID ( $line [0] );
			$aBanniere->setTitre ( $line [1] );
			$aBanniere->setURL ( $line [2] );
			$aBanniere->setURLImage ( $line [3] );
			$aBanniere->setPublication ( $line [4] );
			$aBanniere->setDateDebut ( $line [5] );
			$aBanniere->setDateFin ( $line [6] );
			$aBanniere->setParDefaut ( $line [7] );
			
			$this->myList [] = $aBanniere;
		}
		
		mysqli_free_result ( $result );
	}
}
?>