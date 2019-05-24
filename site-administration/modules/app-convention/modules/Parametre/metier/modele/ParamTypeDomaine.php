<?php
/**
 * @author Florent DESPIERRES
 * @package app-convention
 * @subpackage Parametre
 * @version 1.0.4
 */
class ParamTypeDomaine {
	private $DomaineActiviteList;
	public function __construct() {
		$this->DomaineActiviteList = array ();
	}

	// ###
	public function getList() {
		return $this->DomaineActiviteList;
	}
	public function setList($newValue) {
		$this->DomaineActiviteList = $newValue;
	}

	// ###
	public function SQL_SELECT_ALL($AnnuaireTypeID) {
		$this->DomaineActiviteList = array ();

		$sql = "SELECT DomainActiviteID FROM conv_annuaire_type_domaine";
		$sql .= " WHERE AnnuaireTypeID='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $AnnuaireTypeID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$this->DomaineActiviteList [] = $line [0];
		}

		mysqli_free_result  ( $result );
	}
	public function SQL_UDPATE($AnnuaireTypeID) {
		// Delete all
		$sql = "DELETE FROM conv_annuaire_type_domaine WHERE AnnuaireTypeID='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $AnnuaireTypeID ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		// Insert all
		foreach ( $this->DomaineActiviteList as $aDomaineActiviteID ) {
			$sql = "INSERT INTO conv_annuaire_type_domaine (AnnuaireTypeID, DomainActiviteID) ";
			$sql .= "VALUES('%s','%s')";

			$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $AnnuaireTypeID ), mysqli_real_escape_string ($_SESSION['LINK'], $aDomaineActiviteID ) );

			mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
		}
	}
}
?>