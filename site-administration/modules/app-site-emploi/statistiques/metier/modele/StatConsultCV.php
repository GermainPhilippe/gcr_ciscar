<?php
/**
 * Class permettant d'avoir toutes les consultation de la CVthèque
 * @author Alexandre DIALLO
 * @package app-site-emploi
 * @subpackage statistiques
 * @version 1.0.4
 */
class StatConsultCV {
	private $myList;
	public function __constructList() {
		$this->myList = array ();
	}

	// ###
	/**
	 * Retourne la liste des consultations de la CVthèque
	 */
	public function getList() {
		return $this->myList;
	}
	/**
	 * Insére la liste des consultations de la CVthèque
	 */
	public function setList($newValue) {
		$this->myList = $newValue;
	}

	// ###

	/**
	 *
	 * Sélectionne l'ensemble des consultations de la CVthèque en fonction du mois et de l'année
	 *
	 * @param int $mois
	 * @param int $anne
	 */
	public function SQL_SELECT_CONSULT_CV($mois, $anne) {
		$this->myList = array ();

		/*
		 * $sql = "SELECT i.Nom, i.Prenom, i.IndividuID, lge.Libelle, lda.Libelle, lda.NumOrdre, se.IDUser, se.Date,f.Libelle
		 * FROM annuaire_lva_domainactivite_fonction f, annuaire_role r, annuaire_etablissement e, annuaire_individu i, annuaire_lva_groupe_etablissement lge, annuaire_role_domainactivite ra, annuaire_lva_domainactivite lda, stat_line_siteemploi se
		 * WHERE r.IndividuID = se.IDUser
		 * AND r.EtablissementID = e.EtablissementID
		 * AND i.IndividuID = se.IDUser
		 * AND e.GroupeID = lge.GroupeID
		 * AND r.RoleID = ra.RoleID
		 * AND ra.DomainActiviteID = lda.DomainActiviteID
		 * AND ra.FonctionDAID = f.FonctionDAID
		 * AND se.IDDoc = '2'
		 * AND MONTH(Date)=%s AND YEAR(Date)=%s
		 * ORDER BY se.Date
		 * LIMIT 0 , 30 ";
		 */

		$sql = "SELECT i.Nom, i.Prenom, i.IndividuID, d.Libelle, Min(f.NumOrdre), stat.IDUser, stat.Date, f.Libelle, e.GroupeID
				FROM  annuaire_individu i, stat_line_siteemploi stat,annuaire_role r,annuaire_role_domainactivite rda,annuaire_lva_domainactivite d,annuaire_lva_domainactivite_fonction f,annuaire_etablissement e
				WHERE i.IndividuID=stat.IDUser AND r.IndividuID=stat.IDUser AND r.RoleID=rda.RoleID AND d.DomainActiviteID=rda.DomainActiviteID
				AND f.FonctionDAID=rda.FonctionDAID AND r.EtablissementID=e.EtablissementID AND stat.IDDoc = '2' AND MONTH(stat.Date)='%s' AND YEAR(stat.Date)='%s'
				GROUP BY stat.Date, i.Nom, i.Prenom";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $mois ), mysqli_real_escape_string ($_SESSION['LINK'], $anne ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aModele = new Consult ();
			$aModele->setdate ( $line [6] );
			$aModele->setnom ( $line [0] );
			$aModele->setprenom ( $line [1] );
			$aModele->setdomaine ( $line [3] );
			$aModele->setgroupe ( empty ( $line [8] ) ? '' : $this->SQL_GET_GROUPE ( $line [8] ) );
			$aModele->setfonction ( $line [7] );
			$this->myList [] = $aModele;
		}

		mysqli_free_result  ( $result );
	}
	public function SQL_GET_GROUPE($aID) {
		$result = mysqli_query ($_SESSION['LINK'], sprintf ( "SELECT Libelle FROM annuaire_lva_groupe_etablissement WHERE GroupeID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $aID ) ) ) or die ( mysqli_error ($_SESSION['LINK']) );
		$line = mysqli_fetch_array  ( $result );
		return $line [0];
	}

	/**
	 *
	 * @deprecated
	 *
	 */
	public function SQL_SELECT_LAST_DATE() {
		$sql = " SELECT Date FROM stat_line_siteemploi WHERE IDDoc = 2 ORDER BY Date ASC LIMIT 0,1";
		$result = mysqli_query ($_SESSION['LINK'], $sql ) or die ( mysqli_error ($_SESSION['LINK']) );
		$line = mysqli_fetch_array  ( $result );
		return $line [0];

		mysqli_free  ( $result );
	}
}

?>