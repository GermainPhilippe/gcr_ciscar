<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage connexion
 * @version 1.0.4
 */
class User {
	private $login;
	private $password;
	private $userID;
	// private $obj_site;

	function __construct()
	{
		$this->login = '';
		$this->password = '';
		$this->userID = 0;
	}
	function User() {
		self::__construct();
	}

	// ##################
	function getLogin() {
		return $this->login;
	}
	function getPassword() {
		$this->password;
	}
	function getUserID() {
		return $this->userID;
	}
	/*
	 * function getSite()
	 * {
	 * return $this->obj_site;
	 * }
	 */
	function setLogin($newValue) {
		$this->login = $newValue;
	}
	function setPassword($newValue) {
		$this->password = $newValue;
	}
	function setUserID($newValue) {
		$this->userID = $newValue;
	}
	/*
	 * function setSite($newValue)
	 * {
	 * $this->obj_site = $newValue;
	 * }
	 */

	// ##################
	function check() {
		$sql = "SELECT DISTINCT(i.IndividuID), i.Nom, i.Prenom, (SELECT (CASE Count(*) WHEN 0 THEN 'NON' ELSE 'OUI' END) FROM annuaire_lca_groupeindividu WHERE IndividuID=i.IndividuID AND GroupeID='1') As isAdministrateurs, (SELECT (CASE Count(*) WHEN 0 THEN 'NON' ELSE 'OUI' END) FROM annuaire_lca_groupeindividu WHERE IndividuID=i.IndividuID AND GroupeID='2') As isGestionnaires";
		$sql .= " FROM annuaire_lca_groupeindividu gi, annuaire_individu i WHERE i.IndividuID = gi.IndividuID AND gi.GroupeID IN (1, 2) AND i.AnnuaireID = '%s' AND UPPER(Login)=UPPER('%s') AND UPPER(Password)=UPPER('%s')";

		// "SELECT IndividuID, Nom, Prenom FROM annuaire_individu_admin WHERE UPPER(Login)=UPPER('%s') AND UPPER(Password)=UPPER('%s') AND AnnuaireID='%s'",

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['SITE'] ['ID'] == 7 ? '2' : $_SESSION ['SITE'] ['ID'] ), mysqli_real_escape_string ($_SESSION['LINK'], $this->login ), mysqli_real_escape_string ($_SESSION['LINK'], $this->password ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		if (mysqli_num_rows ( $result ) > 0) {
			$line = mysqli_fetch_array  ( $result );

			$_SESSION ['ADMIN'] ['USER'] ['USERID'] = $line [0];
			$_SESSION ['ADMIN'] ['USER'] ['FULLNAME'] = $line [1] . ' ' . $line [2];
			$_SESSION ['ADMIN'] ['USER'] ['ISADMINISTRATEURS'] = 0;
			$_SESSION ['ADMIN'] ['USER'] ['ISGESTIONNAIRES'] = 0;
			if ($line [3] == 'OUI') {
				$_SESSION ['ADMIN'] ['USER'] ['ISADMINISTRATEURS'] = 1;
			}
			if ($line [4] == 'OUI') {
				$_SESSION ['ADMIN'] ['USER'] ['ISGESTIONNAIRES'] = 2;
			}
			$_SESSION ['ADMIN'] ['USER'] ['CONNECTED'] = true;
			$_SESSION ['ADMIN'] ['USER'] ['SiteName'] = $_SESSION ['SITE'] ['NAME'];
			$_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] = $_SESSION ['SITE'] ['ID'];
		} else {
			$_SESSION ['ADMIN'] ['USER'] ['USERID'] = 0;
			$_SESSION ['ADMIN'] ['USER'] ['FULLNAME'] = 'Visitor';
			$_SESSION ['ADMIN'] ['USER'] ['ISADMINISTRATEURS'] = 0;
			$_SESSION ['ADMIN'] ['USER'] ['ISGESTIONNAIRES'] = 0;
			$_SESSION ['ADMIN'] ['USER'] ['CONNECTED'] = false;
			$_SESSION ['ADMIN'] ['USER'] ['SiteName'] = '';
			$_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] = 0;
		}
	}
	public function SQL_checkUserVisu($aUserName, $aPassword) {
		// Vérification si l'utilisateur existe
		$sql = "SELECT i.IndividuID FROM annuaire_individu i WHERE UPPER(Login)=UPPER('%s') AND UPPER(Password)=UPPER('%s')";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aUserName ), mysqli_real_escape_string ($_SESSION['LINK'], $aPassword ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
		// L'utilisateur existe
		if (mysqli_num_rows ( $result ) > 0) {
			$line = mysqli_fetch_array  ( $result );
			$this->setUserID ( $line [0] );
			return '0';
		} else {
			return '1';
		}
	}
	public function SQL_checkUserBe($aUserId) {
		$sql = "SELECT * FROM annuaire_lca_groupeindividu WHERE IndividuID='%s' AND GroupeID='6'";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aUserId ) );
		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
		if (mysqli_num_rows ( $result ) > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
}

?>