<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage export
 * @version 1.0.4
 */
class ExportAutologin implements DefaultModeleList {
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
		$sql = "SELECT e.LoginSage, i.Login, i.Nom, i.Prenom, i.Mail, CASE i.Civilite WHEN 2 THEN 4 WHEN 3 THEN 6 ELSE 1 END, i.Telephone, i.Fax, i.TelephonePortable, d.Libelle, f.Libelle, MIN(d.NumOrdre)";
		$sql .= " FROM annuaire_role r, annuaire_etablissement e, annuaire_individu i, annuaire_role_domainactivite rda, annuaire_lva_domainactivite d, annuaire_lva_domainactivite_fonction f";
		$sql .= " WHERE r.EtablissementID=e.EtablissementID AND r.IndividuID=i.IndividuID AND r.RoleID=rda.RoleID AND d.DomainActiviteID=rda.DomainActiviteID AND f.FonctionDAID=rda.FonctionDAID AND i.Mail!='' AND e.LoginSage!='' AND i.Login!=''";
		$sql .= " GROUP BY e.LoginSage, i.Login, i.Nom, i.Prenom, i.Mail, CASE i.Civilite WHEN 2 THEN 4 WHEN 3 THEN 6 ELSE 1 END, i.Telephone, i.Fax, i.TelephonePortable, d.Libelle, f.Libelle";

		$result = mysqli_query ($_SESSION['LINK'], $sql ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$this->myList [] = $line;
		}

		mysqli_free_result  ( $result );
	}
	public function SQL_SELECT_BY_SITE($aID) {
		$sql = "SELECT e.LoginSage, i.Login, i.Nom, i.Prenom, i.Mail, i.Civilite, i.Telephone, i.Fax, i.TelephonePortable FROM `annuaire_individu` i, annuaire_etablissement e, annuaire_role r WHERE  r.IndividuID=i.IndividuID AND r.EtablissementID=e.EtablissementID AND r.AnnuaireID='%s' AND i.LoginSage!=''";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aID ) );
		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$this->myList [] = $line;
		}

		mysqli_free_result  ( $result );
	}
}
?>