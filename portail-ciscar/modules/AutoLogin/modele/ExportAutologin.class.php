<?php
/**
 * @author Florent DESPIERRES
 * @package portail-ciscar
 * @subpackage autologin
 * @version 1.0.4
 */
class ExportAutologin {
	private $myList;
	public function __construct() {
		$this->myList = array ();
	}
	
	// ###
	public function getList() {
		return $this->myList;
	}
	public function setList($newValue) {
		$this->myList = $newValue;
	}
	
	// ###
	public function SQL_SELECT_ALL() {
		$sql = "SELECT i.LoginSage, i.Login, i.Nom, i.Prenom, i.Mail, i.Civilite, i.Telephone, i.Fax, i.TelephonePortable FROM `annuaire_individu` i WHERE TRIM(i.LoginSage)!=''";
		
		$result = mysqli_query ( $_SESSION['LINK'] ,$sql ) or die ( mysqli_error ($_SESSION['LINK']) );
		
		while ( $line = mysqli_fetch_array ( $result ) ) {
			$this->myList [] = $line;
		}
		
		mysqli_free_result ( $result );
	}
	public function SQL_SELECT_BY_SITE($aID) {
		$sql = "SELECT i.LoginSage, i.Login, i.Nom, i.Prenom, i.Mail, i.Civilite, i.Telephone, i.Fax, i.TelephonePortable FROM `annuaire_individu` i WHERE TRIM(i.LoginSage)!='' AND i.AnnuaireID='%s'";
		
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'] , $aID ) );
		$result = mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
		
		while ( $line = mysqli_fetch_array ( $result ) ) {
			$this->myList [] = $line;
		}
		
		mysqli_free_result ( $result );
	}
}
?>