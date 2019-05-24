<?php
/**
 *Class gérant les informations d'un cv
 * @author Alexandre DIALLO
 * @package app-site-emploi
 * @subpackage mail
 * @version 1.0.4
 */
class VerifCV {
	private $numcv;
	private $titrecand;
	private $fonction;
	private $regionlibelle;
	private $departementselect;
	private $departementlibelle;
	private $departementid;
	private $iddomaine;
	private $civilite;
	private $nom;
	private $prenom; // N'existe plus dans la bdd
	private $adresse;
	private $cp;
	private $ville;
	private $mail;
	private $idpays;
	private $cv;
	private $lettrem;
	private $valid;
	private $pub;
	private $datecand;
	private $ressort;
	private $sejour;
	private $dispo;
	private $mimecv; // référence au champ MimeCV dans bdd
	private $blobcv; //
	private $sizecv; //
	private $mimelm; // Référence au champ MimeM dans bdd
	private $bloblm; //
	private $sizelm; //
	public function __construct() {
		$this->numcv = NULL;
		$this->titrecand = '';
		$this->fonction = '';
		$this->regionlibelle = '';
		$this->departementselect = '';
		$this->departementlibelle = '';
		$this->departementid = NULL;
		$this->iddomaine = '';
		$this->civilite = '';
		$this->nom = '';
		$this->prenom = '';
		$this->adresse = '';
		$this->cp = '';
		$this->ville = '';
		$this->mail = '';
		$this->idpays = '';
		$this->cv = '';
		$this->lettrem = '';
		$this->valid = NULL;
		$this->pub = NULL;
		$this->datecand = '';
		$this->ressort = '';
		$this->sejour = '';
		$this->dispo = '';
		$this->mimecv = '';
		$this->blobcv = NULL;
		$this->sizecv = 0;
		$this->mimelm = '';
		$this->bloblm = NULL;
		$this->sizelm = 0;
	}

	// ###

	// getteurs
	/**
	 *
	 * Retourne le numéro du cv
	 *
	 * @return int
	 */
	public function getnumcv() {
		return $this->numcv;
	}
	/**
	 *
	 * Retourne le titre du cv
	 *
	 * @return string
	 */
	public function gettitrecand() {
		return $this->titrecand;
	}
	/**
	 *
	 * Retourne la fonction du cv
	 *
	 * @return string
	 */
	public function getfonction() {
		return $this->fonction;
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
	 * Retourne les départements selectionnés de la candidature
	 *
	 * @return int
	 */
	public function getdepartementselect() {
		return $this->departementselect;
	}
	/**
	 *
	 * Retourne les codes département de la candidature
	 *
	 * @return int
	 */
	public function getdepartementlibelle() {
		return $this->departementlibelle;
	}
	/**
	 *
	 * Retourne le département de la candidature
	 *
	 * @return int
	 */
	public function getdepartementid() {
		return $this->departementid;
	}
	/**
	 *
	 * Retourne le domaine de la candidature
	 *
	 * @return int
	 */
	public function getiddomaine() {
		return $this->iddomaine;
	}
	/**
	 *
	 * Retourne la civilite du candidat
	 *
	 * @return string
	 */
	public function getcivilite() {
		switch ($this->civilite) {
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
	 * Retourne le ID civilite du candidat
	 *
	 * @return string
	 */
	public function getidcivilite() {
		return $this->civilite;
	}
	/**
	 *
	 * Retourne le nom du candidat
	 *
	 * @return string
	 */
	public function getnom() {
		return $this->nom;
	}
	/**
	 *
	 * Retourne le prénom du candidat
	 *
	 * @return string
	 */
	public function getprenom() {
		return $this->prenom;
	}
	/**
	 *
	 * Retourne l'adresse de la candidature
	 *
	 * @return string
	 */
	public function getadresse() {
		return $this->adresse;
	}
	/**
	 *
	 * Retourne le code postal de la candidature
	 *
	 * @return string
	 */
	public function getcp() {
		return $this->cp;
	}
	/**
	 *
	 * Retourne la ville de la candidature
	 *
	 * @return string
	 */
	public function getville() {
		return $this->ville;
	}
	/**
	 *
	 * Retourne le mail du candidat
	 *
	 * @return string
	 */
	public function getmail() {
		return $this->mail;
	}
	/**
	 *
	 * Retourne le pays de la candidature
	 *
	 * @return string
	 */
	public function getidpays() {
		return $this->idpays;
	}
	/**
	 *
	 * Retourne le cv de la candidature
	 *
	 * @return string
	 */
	public function getcv() {
		return $this->cv;
	}
	/**
	 *
	 * Retourne la lettre de motivation
	 *
	 * @return string
	 */
	public function getlettrem() {
		return $this->lettrem;
	}
	/**
	 *
	 * Retourne l'information "validé"
	 *
	 * @return int
	 */
	public function getvalid() {
		return $this->valid;
	}
	/**
	 *
	 * Retourne l'information "publié"
	 *
	 * @return int
	 */
	public function getpub() {
		return $this->pub;
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
	public function getmimecv() {
		return $this->mimecv;
	}
	/**
	 *
	 * Retourne le blob du cv
	 *
	 * @return longblob
	 */
	public function getblobcv() {
		return $this->blobcv;
	}
	/**
	 *
	 * Retourne la taille du cv
	 *
	 * @return int
	 */
	public function getsizecv() {
		return $this->sizecv;
	}
	/**
	 *
	 * Retourne le mime du candidat
	 *
	 * @return string
	 */
	public function getmimelm() {
		return $this->mimelm;
	}
	/**
	 *
	 * Retourne le blob de la lettre de motivation
	 *
	 * @return longblob
	 */
	public function getbloblm() {
		return $this->bloblm;
	}
	/**
	 *
	 * Retourne la taille de la lettre de motivation
	 *
	 * @return string
	 */
	public function getsizelm() {
		return $this->sizelm;
	}

	// setteurs
	/**
	 *
	 * Insère le numéro du cv
	 *
	 * @param int $newvalue
	 */
	public function setnumcv($newValue) {
		$this->numcv = $newValue;
	}
	/**
	 *
	 * Insère le titre du cv
	 *
	 * @param string $newvalue
	 */
	public function settitrecand($newValue) {
		$this->titrecand = $newValue;
	}
	/**
	 *
	 * Insère la fonction du cv
	 *
	 * @param string $newvalue
	 */
	public function setfonction($newValue) {
		$this->fonction = $newValue;
	}
	/**
	 *
	 * Insère les régions de la candidature
	 *
	 * @param string $newvalue
	 */
	public function setregionlibelle($newValue) {
		$this->regionlibelle = $newValue;
	}
	/**
	 *
	 * Insère les ID des départements sélectionnés
	 *
	 * @param string $newvalue
	 */
	public function setdepartementselect($newValue) {
		$this->departementselect = $newValue;
	}
	/**
	 *
	 * Insère les codes départements de la candidature
	 *
	 * @param string $newvalue
	 */
	public function setdepartementlibelle($newValue) {
		$this->departementlibelle = $newValue;
	}
	/**
	 *
	 * Insère le département de la candidature
	 *
	 * @param string $newvalue
	 */
	public function setdepartementid($newValue) {
		$this->departementid = $newValue;
	}
	/**
	 *
	 * Insère le domaine de la candidature
	 *
	 * @param int $newvalue
	 */
	public function setiddomaine($newValue) {
		$this->iddomaine = $newValue;
	}
	/**
	 *
	 * Insère le nom du candidat
	 *
	 * @param string $newvalue
	 */
	public function setcivilite($newValue) {
		$this->civilite = $newValue;
	}
	/**
	 *
	 * Insère le nom du candidat
	 *
	 * @param string $newvalue
	 */
	public function setnom($newValue) {
		$this->nom = $newValue;
	}
	/**
	 *
	 * Insère le prénom du candidat
	 *
	 * @param string $newvalue
	 */
	public function setprenom($newValue) {
		$this->prenom = $newValue;
	}
	/**
	 *
	 * Insère l'adresse de la candidature
	 *
	 * @param string $newvalue
	 */
	public function setadresse($newValue) {
		$this->adresse = $newValue;
	}
	/**
	 *
	 * Insère le code postal de la candidature
	 *
	 * @param string $newvalue
	 */
	public function setcp($newValue) {
		$this->cp = $newValue;
	}
	/**
	 *
	 * Insère la ville de la candidature
	 *
	 * @param string $newvalue
	 */
	public function setville($newValue) {
		$this->ville = $newValue;
	}
	/**
	 *
	 * Insère le mail du candidat
	 *
	 * @param string $newvalue
	 */
	public function setmail($newValue) {
		$this->mail = $newValue;
	}
	/**
	 *
	 * Insère le pays de la candidature
	 *
	 * @param string $newvalue
	 */
	public function setidpays($newValue) {
		$this->idpays = $newValue;
	}
	/**
	 *
	 * Insère le CV du candidat
	 *
	 * @param string $newvalue
	 */
	public function setcv($newValue) {
		$this->cv = $newValue;
	}
	/**
	 *
	 * Insère la lettre de la candidature
	 *
	 * @param string $newvalue
	 */
	public function setlettrem($newValue) {
		$this->lettrem = $newValue;
	}
	/**
	 *
	 * Insère l'information "validé"
	 *
	 * @param int $newvalue
	 */
	public function setvalid($newValue) {
		$this->valid = $newValue;
	}
	/**
	 *
	 * Insère l'information "publié"
	 *
	 * @param int $newvalue
	 */
	public function setpub($newValue) {
		$this->pub = $newValue;
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
	 * Insère le mime du cv
	 *
	 * @param string $newvalue
	 */
	public function setmimecv($newValue) {
		$this->mimecv = $newValue;
	}
	/**
	 *
	 * Insère le blob du cv
	 *
	 * @param longblob $newvalue
	 */
	public function setblobcv($newValue) {
		$this->blobcv = $newValue;
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
	 * Insère la taille du cv
	 *
	 * @param int $newvalue
	 */
	public function setsizecv($newValue) {
		$this->sizecv = $newValue;
	}
	/**
	 *
	 * Insère le mime de la lettre de motivation
	 *
	 * @param string $newvalue
	 */
	public function setmimelm($newValue) {
		$this->mimelm = $newValue;
	}
	/**
	 *
	 * Insère le blob du cv
	 *
	 * @param longblob $newvalue
	 */
	public function setbloblm($newValue) {
		$this->bloblm = $newValue;
	}
	/**
	 *
	 * Insère la taille de la lettre de motivation
	 *
	 * @param int $newvalue
	 */
	public function setsizelm($newValue) {
		$this->sizelm = $newValue;
	}

	// ###

	/**
	 *
	 * Récupèr le mail d'un candidat
	 *
	 * @param int $id
	 */
	public function sql_mail($id) {
		$sql = "SELECT mail FROM emploi_candidature WHERE NumCV='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $id ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
		$line = mysqli_fetch_array  ( $result );
		$this->mail = $line [0];
	}

	/**
	 * Met à jour une candidature
	 */
	public function sql_update_verifcv() {
		$sql = "UPDATE emploi_candidature SET Fonction='%s',DepartementID= NULL,IDDomaine= '%s',";
		$sql .= "Adresse= '%s',Cp= '%s',Ville= '%s',Mail= '%s',IDPays= '%s',Ressortissant= '%s',Sejour= '%s',";
		$sql .= "Disponibilite ='%s',Civilite= '%s',Nom= '%s',Prenom= '%s',";
		// GESTION PUBLICATION/VALIDATION
		$sql .= is_null ( $this->valid ) ? " Valid = NULL," : " Valid = " . $this->valid . ",";
		$sql .= is_null ( $this->pub ) ? " Pub = NULL" : " Pub = " . $this->pub;
		$sql .= " WHERE NumCV = '%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $this->fonction ), 
				// mysql_real_escape_string($this->departementid),
				mysqli_real_escape_string ($_SESSION['LINK'], $this->iddomaine ), mysqli_real_escape_string ($_SESSION['LINK'], $this->adresse ), mysqli_real_escape_string ($_SESSION['LINK'], $this->cp ), mysqli_real_escape_string ($_SESSION['LINK'], $this->ville ), mysqli_real_escape_string ($_SESSION['LINK'], $this->mail ), mysqli_real_escape_string ($_SESSION['LINK'], $this->idpays ), mysqli_real_escape_string ($_SESSION['LINK'], $this->ressort ), mysqli_real_escape_string ($_SESSION['LINK'], $this->sejour ), mysqli_real_escape_string ($_SESSION['LINK'], $this->dispo ), mysqli_real_escape_string ($_SESSION['LINK'], $this->civilite ), mysqli_real_escape_string ($_SESSION['LINK'], $this->nom ), mysqli_real_escape_string ($_SESSION['LINK'], $this->prenom ), mysqli_real_escape_string ($_SESSION['LINK'], $this->numcv ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		// on cré la liste des départements rattachée au cv
		$tempDep = explode ( ",", $this->getdepartementselect () );

		// on supprime tous les rattachements existants
		$sql = "DELETE FROM emploi_candidatures_departements where NumCV = " . $this->numcv;
		mysqli_query ($_SESSION['LINK'], $sql ) or die ( mysqli_error ($_SESSION['LINK']) );

		foreach ( $tempDep as $value ) {
			if (strpos ( $value, "R" ) === false && strpos ( $value, "F" ) === false) {
				$sql = "INSERT INTO emploi_candidatures_departements VALUES ('%s', '%s')";

				$query = sprintf ( $sql, 
				mysqli_real_escape_string ($_SESSION['LINK'], $this->numcv ), mysqli_real_escape_string ($_SESSION['LINK'], $value ) );

				mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
			}
		}
	}
	/**
	 * Met à jour un cv
	 */
	public function sql_update_cv() {
		$sql = "UPDATE emploi_candidature SET CV='%s', MimeCV='%s', BlobDataCV='%s', SizeCV='%s' WHERE NumCV='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $this->cv ), mysqli_real_escape_string ($_SESSION['LINK'], $this->mimecv ), mysqli_real_escape_string ($_SESSION['LINK'], $this->blobcv ), mysqli_real_escape_string ($_SESSION['LINK'], $this->sizecv ), mysqli_real_escape_string ($_SESSION['LINK'], $this->numcv ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	/**
	 * Met à jour une lettre de motivation
	 */
	public function sql_update_lettre() {
		$sql = "UPDATE emploi_candidature SET LettreM = '%s',MimeM='%s',BlobDateM= '%s',SizeM= '%s' WHERE NumCV = '%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $this->lettrem ), mysqli_real_escape_string ($_SESSION['LINK'], $this->mimelm ), mysqli_real_escape_string ($_SESSION['LINK'], $this->bloblm ), mysqli_real_escape_string ($_SESSION['LINK'], $this->sizelm ), mysqli_real_escape_string ($_SESSION['LINK'], $this->numcv ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}

	/**
	 * Supprime une candidature
	 */
	public function SQL_delete() {
		$sql = "DELETE FROM emploi_candidature WHERE NumCV='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $this->numcv ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	/**
	 *
	 * Sélectionne un cv
	 *
	 * @param int $id
	 */
	public function sql_select_verifcv($id) {
		$this->numcv = $id;

		$sql = " SELECT emploi_candidature.NumCV, TitreCandidature, Fonction, NomDomaine, Civilite, Nom, Prenom, Adresse, Cp, Ville, ";
		$sql .= " Mail, NomPays, CV, LettreM, Valid, Pub,DATE_FORMAT(date_cand, '%%d/%%m/%%Y'),Ressortissant, Sejour, Disponibilite,  ";
		$sql .= " group_concat(distinct annuaire_lva_region.Libelle SEPARATOR ' - ') as libelle, group_concat(annuaire_lva_departement.Code ORDER BY annuaire_lva_departement.Code SEPARATOR ' - ') as code ";
		$sql .= " FROM emploi_candidature, emploi_pays, emploi_domaine, ";
		$sql .= " emploi_candidatures_departements, annuaire_lva_departement_region, annuaire_lva_departement, annuaire_lva_region ";
		$sql .= " WHERE emploi_candidature.IDDomaine = emploi_domaine.IDDomaine ";
		$sql .= " AND emploi_candidature.IDPays = emploi_pays.IDPays ";

		$sql .= " AND emploi_candidature.NumCV = emploi_candidatures_departements.NumCV ";
		$sql .= " AND emploi_candidatures_departements.DepartementID = annuaire_lva_departement_region.DepartementID ";
		$sql .= " AND annuaire_lva_departement_region.DepartementID = annuaire_lva_departement.DepartementID ";
		$sql .= " AND annuaire_lva_departement_region.RegionID = annuaire_lva_region.RegionID ";
		$sql .= " AND AnnuaireID = 6 AND annuaire_lva_region.RegionID not in (92) AND emploi_candidature.NumCV = '%s' ";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $this->numcv ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array  ( $result );

			$this->numcv = $line [0];
			$this->titrecand = $line [1];
			$this->fonction = $line [2];
			$this->iddomaine = $line [3];
			$this->civilite = $line [4];
			$this->nom = $line [5];
			$this->prenom = $line [6];
			$this->adresse = $line [7];
			$this->cp = $line [8];
			$this->ville = $line [9];
			$this->mail = $line [10];
			$this->idpays = $line [11];
			$this->cv = $line [12];
			$this->lettrem = $line [13];
			$this->valid = $line [14];
			$this->pub = $line [15];
			$this->datecand = $line [16];
			$this->ressort = $line [17];
			$this->sejour = $line [18];
			$this->dispo = $line [19];
			$this->regionlibelle = $line [20];
			$this->departementlibelle = $line [21];
		}

		mysqli_free_result  ( $result );
	}
	/**
	 *
	 * Sélectionne un cv
	 *
	 * @param int $AttachmentID
	 */
	public function SQL_SELECT_BLOB_CV($AttachmentID) {
		$sql = "SELECT NumCV, CV, DATE_FORMAT(date_cand, '%%d/%%m/%%Y'), MimeCV, SizeCV, BlobDataCV FROM emploi_candidature WHERE NumCV='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK_CV'], $AttachmentID ) );

		$result = mysqli_query ($_SESSION['LINK_CV'], $query ) or die ( mysqli_error ($_SESSION['LINK_CV']) );

		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array  ( $result );

			$this->numcv = $line [0];
			$this->cv = $line [1];
			$this->datecand = $line [2];
			$this->mimecv = $line [3];
			$this->sizecv = $line [4];
			$this->blobcv = $line [5];
		} else {
			$this->__construct ();
		}

		mysqli_free_result  ( $result );
	}
	/**
	 *
	 * Sélectionnne une lettre de motivation
	 *
	 * @param int $AttachmentID
	 */
	public function SQL_SELECT_BLOB_LM($AttachmentID) {
		$sql = "SELECT NumCV, LettreM, DATE_FORMAT(date_cand, '%%d/%%m/%%Y'), MimeM, SizeM, BlobDateM FROM emploi_candidature WHERE NumCV='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK_LM'], $AttachmentID ) );

		$result = mysqli_query ($_SESSION['LINK_LM'], $query ) or die ( mysqli_error ($_SESSION['LINK_LM']) );

		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array  ( $result );

			$this->numcv = $line [0];
			$this->lettrem = $line [1];
			$this->datecand = $line [2];
			$this->mimelm = $line [3];
			$this->sizelm = $line [4];
			$this->bloblm = $line [5];
		} else {
			$this->__construct ();
		}

		mysqli_free_result  ( $result );
	}
}
?>