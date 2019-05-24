<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage lva
 * @version 1.0.4
 */
class FonctionBNListe {
	private $fonctionBNListe;
	private $fonctionBNIndividuListe;

	function __construct()
	{
		$this->fonctionBNListe = array ();	
	}
	function FonctionBNListe() {
		self::__construct();
	}
	
	function FonctionBNIndividuListe() {
		$this->fonctionBNIndividuListe = array ();
	}

	// #################
	function addFonctionBN($aFonctionBN) {
		$this->fonctionBNListe [] = $aFonctionBN;
	}
	function removeFonctionBN($i) {
		unset ( $this->fonctionBNListe [$i] );
	}
	function getFonctionBNListe() {
		return $this->fonctionBNListe;
	}
	function getFonctionBNIndividuListe() {
		return $this->fonctionBNIndividuListe;
	}
	function setFonctionBNListe($newValue) {
		$this->fonctionBNListe = $newValue;
	}
	function setFonctionBNIndividuListe($newValue) {
		$this->fonctionBNIndividuListe = $newValue;
	}
	function getNbFonctionBN() {
		return count ( $this->fonctionBNListe );
	}

	// ##################
	function select_all_fonctionbn() {
		$result = mysqli_query ($_SESSION['LINK'], "SELECT FonctionBNID, AnnuaireID, Libelle, NumeroOrdre FROM annuaire_lva_fonctionbn WHERE AnnuaireID='" . $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] . "' ORDER BY NumeroOrdre, Libelle" ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aFonctionBN = new FonctionBN ();

			$aFonctionBN->setID ( $line [0] );
			$aFonctionBN->setName ( $line [2] );
			$aFonctionBN->setNumeroOrdre ( $line [3] );

			$aAnnuaire = new Annuaire ();
			$aAnnuaire->select_annuaire ( $line [1] );
			$aFonctionBN->setAnnuaire ( $aAnnuaire );

			$this->fonctionBNListe [] = $aFonctionBN;
		}

		mysqli_free_result  ( $result );
	}
	function select_all_fonctionbn_tri($column = '2', $Order = 'a') {
		$sql = "SELECT FonctionBNID, AnnuaireID, Libelle, NumeroOrdre FROM annuaire_lva_fonctionbn WHERE AnnuaireID='" . $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] . "'";

		switch ($column) {
			case '2' :
				$sql .= " ORDER BY NumeroOrdre";
				break;
			default :
				$sql .= " ORDER BY Libelle";
				break;
		}

		$result = mysqli_query ($_SESSION['LINK'], $sql . ($Order == 'a' ? ' ASC' : ' DESC') ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aFonctionBN = new FonctionBN ();

			$aFonctionBN->setID ( $line [0] );
			$aFonctionBN->setName ( $line [2] );
			$aFonctionBN->setNumeroOrdre ( $line [3] );

			$aAnnuaire = new Annuaire ();
			$aAnnuaire->select_annuaire ( $line [1] );
			$aFonctionBN->setAnnuaire ( $aAnnuaire );

			$this->fonctionBNListe [] = $aFonctionBN;
		}

		mysqli_free_result  ( $result );
	}
	function select_individus_fonctionbn($aFonctionBNID) {
		$sql = "SELECT annuaire_individu.IndividuID, Nom, Prenom, Mail from annuaire_individu, annuaire_individufonctionbn where annuaire_individu.individuID = annuaire_individufonctionbn.IndividuID and FonctionBNID = '%s' ORDER BY Nom";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aFonctionBNID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aIndividuFonctionBN = new IndividuFonctionBN ();
			$aIndividuFonctionBN->setIndividuID ( $line [0] );
			$aIndividuFonctionBN->setNomIndividu ( $line [1] );
			$aIndividuFonctionBN->setPrenomIndividu ( $line [2] );
			$aIndividuFonctionBN->setMailIndividu ( $line [3] );

			$this->fonctionBNIndividuListe [] = $aIndividuFonctionBN;
		}

		mysqli_free_result  ( $result );
	}
}
?>