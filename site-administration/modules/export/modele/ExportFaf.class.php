<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage export
 * @version 1.0.4
 */
class ExportFaf {
	private $myListIndividu;
	private $myListEtablissement;
	public function __construct() {
		$this->myListIndividu = array ();
		$this->myListEtablissement = array ();
	}

	// ###
	public function getListIndividu() {
		return $this->myListIndividu;
	}
	public function getListEtablissement() {
		return $this->myListEtablissement;
	}

	// ###
	public function SQL_SELECT_BY_SITE($aID) {
		// Export Individu
		$this->myListIndividu = array ();
		$sql = "SELECT Nom, Prenom, Login, LoginSage, Mail, AnnuaireID FROM annuaire_individu WHERE AnnuaireID='%s'";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aID ) );
		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$this->myListIndividu [] = $line;
		}

		mysqli_free_result  ( $result );

		// export Etablissement
		$this->myListEtablissement = array ();
		$sql = "select e.RaisonSociale, e.Adresse1, e.Adresse2, e.BureauDistributeur, e.CodePostal, e.Mail, e.LoginSage, r.Libelle, e.AnnuaireID from (annuaire_etablissement e join annuaire_lva_region r on((e.RegionID = r.RegionID))) WHERE e.AnnuaireID='%s'";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aID ) );
		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$this->myListEtablissement [] = $line;
		}

		mysqli_free_result  ( $result );
	}
	public function SQL_SELECT_ALL() {
		// Export Individu
		$this->myListIndividu = array ();
		$sql = "SELECT Nom, Prenom, Login, LoginSage, Mail, AnnuaireID FROM annuaire_individu";
		$result = mysqli_query ($_SESSION['LINK'], $sql ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$this->myListIndividu [] = $line;
		}

		mysqli_free_result  ( $result );

		// export Etablissement
		$this->myListEtablissement = array ();
		$sql = "select e.RaisonSociale, e.Adresse1, e.Adresse2, e.BureauDistributeur, e.CodePostal, e.Mail, e.LoginSage, r.Libelle, e.AnnuaireID from (annuaire_etablissement e join annuaire_lva_region r on((e.RegionID = r.RegionID)))";
		$result = mysqli_query ($_SESSION['LINK'], $sql ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$this->myListEtablissement [] = $line;
		}

		mysqli_free_result  ( $result );
	}
	public function SQL_SELECT_NEW_ALL() {

		// Export Individu
		$sql = "SELECT i.Nom, i.Prenom, i.Login, i.LoginSage, i.Mail FROM annuaire_individu i, annuaire_role r, annuaire_role_domainactivite rda, annuaire_lva_domainactivite da";
		$sql .= " WHERE i.AnnuaireID IN (1,2) AND da.Libelle NOT IN ('Constructeur','GCRE','Partenaire') AND r.RoleID = rda.RoleID AND rda.DomainActiviteID = da.DomainActiviteID	AND r.IndividuID = i.IndividuID GROUP BY i.Nom, i.Prenom, i.Login, i.LoginSage, i.Mail;";
		$result = mysqli_query ($_SESSION['LINK'], $sql ) or die ( mysqli_error ($_SESSION['LINK']) );
		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$this->myListIndividu [] = $line;
		}

		// Export Etablissement
		$sql = "select e.RaisonSociale, e.Adresse1, e.Adresse2, e.BureauDistributeur, e.CodePostal, e.Mail, e.LoginSage, (SELECT r.Libelle FROM annuaire_lva_region r WHERE r.RegionID = e.RegionID ), e.AnnuaireID, (SELECT n.Libelle FROM annuaire_lva_nature n WHERE n.NatureID=e.NatureID), (SELECT t.Libelle FROM annuaire_lva_typologie t WHERE t.TypologieID=e.TypologieID), (SELECT m.Libelle FROM annuaire_lva_marque m WHERE m.MarqueID = e.Marque1_ID), (SELECT m.Libelle FROM annuaire_lva_marque m WHERE m.MarqueID = e.Marque2_ID), (SELECT m.Libelle FROM annuaire_lva_marque m WHERE m.MarqueID = e.Marque3_ID), (SELECT m.Libelle FROM annuaire_lva_marque m WHERE m.MarqueID = e.Marque4_ID), (SELECT m.Libelle FROM annuaire_lva_marque m WHERE m.MarqueID = e.Marque5_ID), e.EnSommeil FROM annuaire_etablissement e WHERE e.AnnuaireID IN (1,2) GROUP BY e.LoginSage";
		$result = mysqli_query ($_SESSION['LINK'], $sql ) or die ( mysqli_error ($_SESSION['LINK']) );
		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$this->myListEtablissement [] = $line;
		}
	}
}
?>