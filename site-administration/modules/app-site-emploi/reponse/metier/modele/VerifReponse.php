<?php
/**
 *Class gérant les informations d'une réponse
 * @author Alexandre DIALLO
 * @package app-site-emploi
 * @subpackage reponse
 * @version 1.0.4
 */
class VerifReponse {
	private $numrep;
	private $numoffre;
	private $titreoffre;
	private $domaineoffre;
	private $nommetieroffre;
	private $nomcatmetieroffre;
	private $fonctionoffre;
	private $commentaireoffre;
	private $datepriseposte;
	private $contactoffre;
	private $mailoffre;
	private $titrecand;
	private $regionlibelle;
	private $departementlibelle;
	private $villeoffre;
	private $domainecand;
	private $fonctioncand;
	private $adressecand;
	private $cpcand;
	private $villecand;
	private $payscand;
	private $cvcand;
	private $lettrecand;
	private $datecand;
	private $prenomcand; // n'existe plus dans la bdd
	private $nomcand;
	private $civilitecand;
	private $mailcand;
	private $ressort;
	private $sejour;
	private $dispo;
	private $mimecvcand;
	private $sizecvcand;
	private $blobcvcand;
	private $mimelmcand;
	private $sizelmcand;
	private $bloblmcand;
	public function __construct() {
		$this->numrep = NULL;
		$this->numoffre = NULL;
		$this->titreoffre = '';
		$this->domaineoffre = NULL;
		$this->nommetieroffre = '';
		$this->nomcatmetieroffre = '';
		$this->fonctionoffre = '';
		$this->commentaireoffre = '';
		$this->datepriseposte = '';
		$this->contactoffre = '';
		$this->mailoffre = '';
		$this->titrecand = '';
		$this->regionlibelle = '';
		$this->departementlibelle = '';
		$this->villeoffre = '';
		$this->domainecand = '';
		$this->fonctioncand = '';
		$this->adressecand = '';
		$this->cpcand = '';
		$this->villecand = '';
		$this->payscand = '';
		$this->cvcand = '';
		$this->lettrecand = '';
		$this->datecand = '';
		$this->prenomcand = '';
		$this->nomcand = '';
		$this->civilitecand = '';
		$this->mailcand = '';
		$this->ressort = 0;
		$this->sejour = NULL;
		$this->dispo = '';

		$this->mimecvcand = '';
		$this->blobcvcand = NULL;
		$this->sizecvcand = 0;
		$this->mimelmcand = '';
		$this->bloblmcand = NULL;
		$this->sizelmcand = 0;
	}

	// Getteur
	/**
	 *
	 * Retourne le numéro de la réponse
	 *
	 * @return int
	 */
	public function getnumrep() {
		return $this->numrep;
	}
	/**
	 *
	 * Retourne le numéro de l'offre
	 *
	 * @return int
	 */
	public function getnumoffre() {
		return $this->numoffre;
	}
	/**
	 *
	 * Retourne le titre de l'offre
	 *
	 * @return string
	 */
	public function gettitreoffre() {
		return $this->titreoffre;
	}
	/**
	 *
	 * Retourne le nom du metier
	 *
	 * @return int
	 */
	public function getnommetieroffre() {
		return $this->nommetieroffre;
	}
	/**
	 *
	 * Retourne le nom de la catégorie de metier
	 *
	 * @return int
	 */
	public function getnomcatmetieroffre() {
		return $this->nomcatmetieroffre;
	}
	/**
	 *
	 * Retourne le domaine de l'offre
	 *
	 * @return int
	 */
	public function getdomaineoffre() {
		return $this->domaineoffre;
	}
	/**
	 *
	 * Retourne la fonction de l'offre
	 *
	 * @return string
	 */
	public function getfonctionoffre() {
		return $this->fonctionoffre;
	}
	/**
	 *
	 * Retourne le commentaire de l'offre
	 *
	 * @return string
	 */
	public function getcommentaireoffre() {
		return $this->commentaireoffre;
	}
	/**
	 *
	 * Retourne la date de prise de poste
	 *
	 * @return string
	 */
	public function getdatepriseposte() {
		return $this->datepriseposte;
	}
	/**
	 *
	 * Retourne le contact de l'offre
	 *
	 * @return string
	 */
	public function getcontactoffre() {
		return $this->contactoffre;
	}
	/**
	 *
	 * Retourne le mail de l'offre
	 *
	 * @return string
	 */
	public function getmailoffre() {
		return $this->mailoffre;
	}
	/**
	 *
	 * Retourne le titre de la candidature
	 *
	 * @return string
	 */
	public function gettitrecand() {
		return $this->titrecand;
	}
	/**
	 *
	 * Retourne les régions de la candidature
	 *
	 * @return int
	 */
	public function getregionlibelle() {
		return $this->regionlibelle;
	}
	/**
	 *
	 * Retourne les département de la candidature
	 *
	 * @return int
	 */
	public function getdepartementlibelle() {
		return $this->departementlibelle;
	}
	/**
	 *
	 * Retourne les villes de l'offre
	 *
	 * @return int
	 */
	public function getvilleoffre() {
		return $this->villeoffre;
	}
	/**
	 *
	 * Retourne le domaine de la candidature
	 *
	 * @return int
	 */
	public function getdomainecand() {
		return $this->domainecand;
	}
	/**
	 *
	 * Retourne la fonction de la candidature
	 *
	 * @return string
	 */
	public function getfonctioncand() {
		return $this->fonctioncand;
	}
	/**
	 *
	 * Retourne l'adresse de la candidature
	 *
	 * @return string
	 */
	public function getadressecand() {
		return $this->adressecand;
	}
	/**
	 *
	 * Retourne la ville de la candidature
	 *
	 * @return string
	 */
	public function getvillecand() {
		return $this->villecand;
	}
	/**
	 *
	 * @deprecated
	 *
	 */
	public function getcpcand() {
		return $this->cpcand;
	}
	/**
	 *
	 * Retourne le pays de la candidature
	 *
	 * @return string
	 */
	public function getpayscand() {
		return $this->payscand;
	}
	/**
	 *
	 * Retourne le cv de la candidature
	 *
	 * @return string
	 */
	public function getcvcand() {
		return $this->cvcand;
	}
	/**
	 *
	 * Retourne la lettre de motivation
	 *
	 * @return string
	 */
	public function getlettrecand() {
		return $this->lettrecand;
	}
	/**
	 *
	 * Retourne la date de la candidature
	 *
	 * @return date
	 */
	public function getdatecand() {
		return $this->datecand;
	}
	/**
	 *
	 * Retourne le prénom du candidat
	 *
	 * @return string
	 */
	public function getprenomcand() {
		return $this->prenomcand;
	}
	/**
	 *
	 * Retourne le nom du candidat
	 *
	 * @return string
	 */
	public function getnomcand() {
		return $this->nomcand;
	}
	/**
	 *
	 * Retourne la civilite du candidat
	 *
	 * @return string
	 */
	public function getcivilitecand() {
		switch ($this->civilitecand) {
			case 0 :
				return 'M.';
				break;
			case 1 :
				return 'Mme';
				break;
			case 2 :
				return 'Mlle';
				break;
			default :
				return ' ';
		}
	}
	/**
	 *
	 * Retourne le mail du candidat
	 *
	 * @return string
	 */
	public function getmailcand() {
		return $this->mailcand;
	}
	/**
	 *
	 * Retourne l'information "ressortissant"
	 *
	 * @return int
	 */
	public function getressort() {
		return $this->ressort;
	}
	/**
	 *
	 * Retourne l'information "séjour"
	 *
	 * @return int
	 */
	public function getsejour() {
		return $this->sejour;
	}
	/**
	 *
	 * Retourne la disponibilité
	 *
	 * @return string
	 */
	public function getdispo() {
		return $this->dispo;
	}
	/**
	 *
	 * Retourne le mime du cv
	 *
	 * @return int
	 */
	public function getmimecvcand() {
		return $this->mimecvcand;
	}
	/**
	 *
	 * Retourne le blob du cv
	 *
	 * @return longblob
	 */
	public function getblobcvcand() {
		return $this->blobcvcand;
	}
	/**
	 *
	 * Retourne la taille du cv
	 *
	 * @return int
	 */
	public function getsizecvcand() {
		return $this->sizecvcand;
	}
	/**
	 *
	 * Retourne le mime du candidat
	 *
	 * @return string
	 */
	public function getmimelmcand() {
		return $this->mimelmcand;
	}
	/**
	 *
	 * Retourne le blob de la lettre de motivation
	 *
	 * @return longblob
	 */
	public function getbloblmcand() {
		return $this->bloblmcand;
	}
	/**
	 *
	 * Retourne la taille de la lettre de motivation
	 *
	 * @return string
	 */
	public function getsizelmcand() {
		return $this->sizelmcand;
	}

	// Setteur
	/**
	 *
	 * Insère le numéro de la réponse
	 *
	 * @param int $newvalue
	 */
	public function setnumrep($newvalue) {
		$this->numrep = $newvalue;
	}
	/**
	 *
	 * Insère le numéro de l'offre
	 *
	 * @param int $newvalue
	 */
	public function setnumoffre($newvalue) {
		$this->numoffre = $newvalue;
	}
	/**
	 *
	 * Insère le titre de l'offre
	 *
	 * @param string $newvalue
	 */
	public function settitreoffre($newvalue) {
		$this->titreoffre = $newvalue;
	}
	/**
	 *
	 * Insère le nom du metier
	 *
	 * @param int $newvalue
	 */
	public function setnommetieroffre($newvalue) {
		$this->nommetieroffre = $newvalue;
	}
	/**
	 *
	 * Insère le domaine de l'offre
	 *
	 * @param int $newvalue
	 */
	public function setcatmetieroffre($newvalue) {
		$this->nomcatmetieroffre = $newvalue;
	}
	/**
	 *
	 * Insère le domaine de l'offre
	 *
	 * @param int $newvalue
	 */
	public function setdomaineoffre($newvalue) {
		$this->domaineoffre = $newvalue;
	}
	/**
	 *
	 * Insère la fonction de l'offre
	 *
	 * @param string $newvalue
	 */
	public function setfonctionoffre($newvalue) {
		$this->fonctionoffre = $newvalue;
	}
	/**
	 *
	 * Insère le commentaire de l'offre
	 *
	 * @param int $newvalue
	 */
	public function setcommentaireoffre($newvalue) {
		$this->commentaireoffre = $newvalue;
	}
	/**
	 *
	 * Insère la date de prise de poste
	 *
	 * @param int $newvalue
	 */
	public function setdatepriseposte($newvalue) {
		$this->datepriseposte = $newvalue;
	}
	/**
	 *
	 * Insère le contact de l'offre
	 *
	 * @param string $newvalue
	 */
	public function setcontactoffre($newvalue) {
		$this->contactoffre = $newvalue;
	}
	/**
	 *
	 * Insère le mail de l'offre
	 *
	 * @param string $newvalue
	 */
	public function setmailoffre($newvalue) {
		$this->mailoffre = $newvalue;
	}
	/**
	 *
	 * Insère le titre de la candidature
	 *
	 * @param string $newvalue
	 */
	public function settitrecand($newvalue) {
		$this->titrecand = $newvalue;
	}
	/**
	 *
	 * Insère les régions de la candidature
	 *
	 * @param string $newvalue
	 */
	public function setregionlibelle($newvalue) {
		$this->regionlibelle = $newvalue;
	}
	/**
	 *
	 * Insère les départements de la candidature
	 *
	 * @param string $newvalue
	 */
	public function setdepartementlibelle($newvalue) {
		$this->departementlibelle = $newvalue;
	}
	/**
	 *
	 * Insère les villes de l'offre
	 *
	 * @param string $newvalue
	 */
	public function setvilleoffre($newvalue) {
		$this->villeoffre = $newvalue;
	}
	/**
	 *
	 * Insère le domaine de la candidature
	 *
	 * @param int $newvalue
	 */
	public function setdomainecand($newvalue) {
		$this->domainecand = $newvalue;
	}
	/**
	 *
	 * Insère la fonction de la candidature
	 *
	 * @param string $newvalue
	 */
	public function setfonctioncand($newvalue) {
		$this->fonctioncand = $newvalue;
	}
	/**
	 *
	 * Insère l'adresse de la candidature
	 *
	 * @param string $newvalue
	 */
	public function setadressecand($newvalue) {
		$this->adressecand = $newvalue;
	}
	/**
	 *
	 * Insère la ville de la candidature
	 *
	 * @param string $newvalue
	 */
	public function setvillecand($newvalue) {
		$this->villecand = $newvalue;
	}
	/**
	 *
	 * @deprecated
	 *
	 */
	public function setcpcand($newvalue) {
		$this->cpcand = $newvalue;
	}
	/**
	 *
	 * Insère le pays de la candidature
	 *
	 * @param int $newvalue
	 */
	public function setpayscand($newvalue) {
		$this->payscand = $newvalue;
	}
	/**
	 *
	 * Insère le CV du candidat
	 *
	 * @param string $newvalue
	 */
	public function setcvcand($newvalue) {
		$this->cvcand = $newvalue;
	}
	/**
	 *
	 * Insère la lettre de la candidature
	 *
	 * @param string $newvalue
	 */
	public function setlettrecand($newvalue) {
		$this->lettrecand = $newvalue;
	}
	/**
	 *
	 * Insère la date de la candidature
	 *
	 * @param date $newvalue
	 */
	public function setdatecand($newvalue) {
		$this->datecand = $newvalue;
	}
	/**
	 *
	 * Insère le prénom du candidat
	 *
	 * @param string $newvalue
	 */
	public function setprenomcand($newvalue) {
		$this->prenomcand = $newvalue;
	}
	/**
	 *
	 * Insère le nom du candidat
	 *
	 * @param string $newvalue
	 */
	public function setnomcand($newvalue) {
		$this->nomcand = $newvalue;
	}
	/**
	 *
	 * Insère la civilite du candidat
	 *
	 * @param string $newvalue
	 */
	public function setcivilitecand($newvalue) {
		$this->civilitecand = $newvalue;
	}
	/**
	 *
	 * Insère le mail du candidat
	 *
	 * @param string $newvalue
	 */
	public function setmailcand($newvalue) {
		$this->mailcand = $newvalue;
	}
	/**
	 *
	 * Insère l'information ressortissant
	 *
	 * @param int $newvalue
	 */
	public function setressort($newValue) {
		$this->ressort = $newValue;
	}
	/**
	 *
	 * Insère l'information séjour
	 *
	 * @param int $newvalue
	 */
	public function setsejour($newValue) {
		$this->sejour = $newValue;
	}
	/**
	 *
	 * Insère la disponibilité du candidat
	 *
	 * @param string $newvalue
	 */
	public function setdispo($newValue) {
		$this->dispo = $newValue;
	}
	/**
	 *
	 * Insère le mime du cv
	 *
	 * @param string $newvalue
	 */
	public function setmimecvcand($newValue) {
		$this->mimecvcand = $newValue;
	}
	/**
	 *
	 * Insère le blob du cv
	 *
	 * @param longblob $newvalue
	 */
	public function setblobcvcand($newValue) {
		$this->blobcvcand = $newValue;
	}
	/**
	 *
	 * Insère la taille du cv
	 *
	 * @param int $newvalue
	 */
	public function setsizecvcand($newValue) {
		$this->sizecvcand = $newValue;
	}
	/**
	 *
	 * Insère le mime de la lettre de motivation
	 *
	 * @param string $newvalue
	 */
	public function setmimelmcand($newValue) {
		$this->mimelmcand = $newValue;
	}
	/**
	 *
	 * Insère le blob du cv
	 *
	 * @param longblob $newvalue
	 */
	public function setbloblmcand($newValue) {
		$this->bloblmcand = $newValue;
	}
	/**
	 *
	 * Insère la taille de la lettre de motivation
	 *
	 * @param int $newvalue
	 */
	public function setsizelmcand($newValue) {
		$this->sizelmcand = $newValue;
	}

	// Requêtes
	/**
	 *
	 * @deprecated
	 *
	 */
	public function sql_insert() {
	}
	/**
	 *
	 * Récupère toutes les infos d'une réponse dont l'id est envoyé en paramètre
	 *
	 * @param int $id
	 */
	public function sql_select($id) {
		$this->numrep = $id;

		$sql = " SELECT emploi_reponse.NumReponse, TitreOffre, NomDomaine AS NomDomaineOffre, FonctionOffre, CommentaireOffre, ContactOffre, ";
		$sql .= " EmailOffre, TitreCandidature, group_concat(distinct annuaire_lva_region.Libelle SEPARATOR ' - ') as libelle, group_concat(annuaire_lva_departement.Code ORDER BY annuaire_lva_departement.Code SEPARATOR ' - ') as code, IDDomaineCandRep, FonctionCandRep, AdresseCandRep, CpCandRep, VilleCandRep, NomPays, ";
		$sql .= " CVCandRep, LettreMCandRep, DATE_FORMAT(DateReponse, '%%d/%%m/%%Y'), emploi_reponse.NumOffre, CiviliteCand, NomCand, PrenomCand, MailCand, Ressortissant, Sejour,";
		$sql .= " Disponibilite, NomType, Experience, Niveau, Ville,NomCatMetier, NomMetier, DATE_FORMAT(DateDebPost, '%%d/%%m/%%Y')  ";
		$sql .= " FROM emploi_reponse ";
		$sql .= " LEFT JOIN emploi_offres ON emploi_reponse.NumOffre=emploi_offres.NumOffre ";
		$sql .= " LEFT JOIN emploi_pays ON emploi_reponse.IDPays = emploi_pays.IDpays ";
		$sql .= " LEFT JOIN emploi_domaine ON emploi_offres.IDDomaine=emploi_domaine.IDDomaine ";
		// $sql .= " LEFT JOIN annuaire_lva_departement ON emploi_reponse.DepartementID=annuaire_lva_departement.DepartementID ";
		$sql .= " LEFT JOIN emploi_type_contrat ON emploi_offres.IDType=emploi_type_contrat.IDType ";
		$sql .= " LEFT JOIN emploi_experience ON emploi_offres.IDExp=emploi_experience.IDExp ";
		$sql .= " LEFT JOIN emploi_niveau ON emploi_offres.IDNiveau=emploi_niveau.IDNiveau ";

		$sql .= " LEFT JOIN emploi_reponses_departements ON emploi_reponse.NumReponse = emploi_reponses_departements.NumReponse ";
		$sql .= " LEFT JOIN annuaire_lva_departement_region ON emploi_reponses_departements.DepartementID = annuaire_lva_departement_region.DepartementID ";
		$sql .= " LEFT JOIN annuaire_lva_departement ON annuaire_lva_departement_region.DepartementID = annuaire_lva_departement.DepartementID ";
		$sql .= " LEFT JOIN annuaire_lva_region ON annuaire_lva_departement_region.RegionID = annuaire_lva_region.RegionID ";

		$sql .= " left join emploi_metier on emploi_offres.IDmetier = emploi_metier.IDMetier ";
		$sql .= " left join emploi_cat_metier on emploi_metier.IDCatMetier = emploi_cat_metier.IDCatMetier ";

		$sql .= " WHERE AnnuaireID = 6 AND annuaire_lva_region.RegionID not in (92) AND emploi_reponse.NumReponse = '%s' ";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $this->numrep ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array  ( $result );

			$this->numrep = $line [0];
			$this->titreoffre = $line [1];
			$this->domaineoffre = $line [2];
			$this->fonctionoffre = $line [3];
			$this->commentaireoffre = $line [4];
			$this->contactoffre = $line [5];
			$this->mailoffre = $line [6];
			$this->titrecand = $line [7];
			$this->regionlibelle = $line [8];
			$this->departementlibelle = $line [9];
			$this->domainecand = $line [10];
			$this->fonctioncand = $line [11];
			$this->adressecand = $line [12];
			$this->cpcand = $line [13];
			$this->villecand = $line [14];
			$this->payscand = $line [15];
			$this->cvcand = $line [16];
			$this->lettrecand = $line [17];
			$this->datecand = $line [18];
			$this->numoffre = $line [19];
			$this->civilitecand = $line [20];
			$this->nomcand = $line [21];
			$this->prenomcand = $line [22];
			$this->mailcand = $line [23];
			$this->ressort = $line [24];
			$this->sejour = $line [25];
			$this->dispo = $line [26];
			$this->villeoffre = $line [30];
			$this->nomcatmetieroffre = $line [31];
			$this->nommetieroffre = $line [32];
			$this->datepriseposte = $line [33];
		}

		mysqli_free_result  ( $result );
	}
	/**
	 *
	 * Récupère le cv du candidat
	 *
	 * @param int $AttachmentID
	 */
	public function SQL_SELECT_BLOB_CV($AttachmentID) {
		$sql = "SELECT NumReponse, CVCandRep, DATE_FORMAT(DateReponse, '%%d/%%m/%%Y'), MimeCV, SizeCV, BlobDataCV FROM emploi_reponse WHERE NumReponse='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK_CV'], $AttachmentID ) );

		$result = mysqli_query ($_SESSION['LINK_CV'], $query ) or die ( mysqli_error ($_SESSION['LINK_CV']) );

		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array  ( $result );

			$this->numrep = $line [0];
			$this->cvcand = $line [1];
			$this->datecand = $line [2];
			$this->mimecvcand = $line [3];
			$this->sizecvcand = $line [4];
			$this->blobcvcand = $line [5];
		} else {
			$this->__construct ();
		}

		mysqli_free_result  ( $result );
	}
	/**
	 *
	 * Récupère la lettre de motivation du candidat
	 *
	 * @param int $AttachmentID
	 */
	public function SQL_SELECT_BLOB_LM($AttachmentID) {
		$sql = "SELECT NumReponse, LettreMCandRep, DATE_FORMAT(DateReponse, '%%d/%%m/%%Y'), MimeM, SizeM, BlobDataM FROM emploi_reponse WHERE NumReponse='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK_LM'], $AttachmentID ) );

		print $query;
		$result = mysqli_query ($_SESSION['LINK_LM'], $query ) or die ( mysqli_error ($_SESSION['LINK_LM']) );

		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array  ( $result );

			$this->numrep = $line [0];
			$this->lettrecand = $line [1];
			$this->datecand = $line [2];
			$this->mimelmcand = $line [3];
			$this->sizelmcand = $line [4];
			$this->bloblmcand = $line [5];
		} else {
			$this->__construct ();
		}

		mysqli_free_result  ( $result );
	}
}

?>