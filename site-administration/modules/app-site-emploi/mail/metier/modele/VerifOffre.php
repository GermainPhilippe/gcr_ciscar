<?php
/**
 *Class gï¿½rant les informations d'une offre
 * @author Alexandre DIALLO
 * @package app-site-emploi
 * @subpackage mail
 * @version 1.0.4
 */
class VerifOffre {
	private $numoffre;
	private $dateoffre;
	private $titreoffre;
	private $regionlibelle;
	private $departementlibelle;
	private $ville;
	private $datedebpost;
	private $departementselect;
	private $fonction;
	private $iddomaine;
	private $idmetier;
	private $nommetier;
	private $nomcatmetier;
	private $commentaire;
	private $contact;
	private $mail;
	private $fichier;
	private $valid;
	private $pub;
	private $nomdomaine;
	private $type;
	private $exp;
	private $niveau;
	private $mimefichier;
	private $sizefichier;
	private $blobfichier;
	private $nbrcv;
	public function __construct() {
		$this->numoffre = NULL;
		$this->dateoffre = '';
		$this->titreoffre = '';
		$this->regionlibelle = '';
		$this->departementselect = '';
		$this->departementlibelle = '';
		$this->ville = '';
		$this->datedebpost = '';
		$this->fonction = '';
		$this->iddomaine = '';
		$this->idmetier = '';
		$this->nommetier = '';
		$this->nomcatmetier = '';
		$this->commentaire = '';
		$this->contact = '';
		$this->mail = '';
		$this->fichier = '';
		$this->valid = 0;
		$this->pub = 0;
		$this->nomdomaine = '';
		$this->type = '';
		$this->exp = '';
		$this->niveau = '';

		$this->mimefichier = '';
		$this->sizefichier = 0;
		$this->blobfichier = NULL;

		$this->nbrcv = NULL;
	}

	// ###

	// getteurs
	/**
	 *
	 * Retourne le numï¿½ro de l'offre
	 *
	 * @return int
	 */
	public function getnumoffre() {
		return $this->numoffre;
	}
	/**
	 *
	 * Retourne la date de l'offre
	 *
	 * @return date
	 */
	public function getdateoffre() {
		return $this->dateoffre;
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
	 * Retourne les régions
	 *
	 * @return int
	 */
	public function getregionlibelle() {
		return $this->regionlibelle;
	}
	/**
	 *
	 * Retourne les ID des départements selectionnés
	 *
	 * @return int
	 */
	public function getdepartementselect() {
		return $this->departementselect;
	}
	/**
	 *
	 * Retourne les codes département
	 *
	 * @return int
	 */
	public function getdepartementlibelle() {
		return $this->departementlibelle;
	}
	/**
	 *
	 * Retourne les villes
	 *
	 * @return int
	 */
	public function getville() {
		return $this->ville;
	}
	/**
	 *
	 * Retourne la date de debut de post
	 *
	 * @return int
	 */
	public function getdatedebpost() {
		return $this->datedebpost;
	}
	/**
	 *
	 * Retourne la fonction
	 *
	 * @return string
	 */
	public function getfonction() {
		return $this->fonction;
	}
	/**
	 *
	 * Retourne le domaine de l'offre
	 *
	 * @return int
	 */
	public function getiddomaine() {
		return $this->iddomaine;
	}
	/**
	 *
	 * Retourne le metier de l'offre
	 *
	 * @return int
	 */
	public function getidmetier() {
		return $this->idmetier;
	}
	/**
	 *
	 * Retourne le libelle du metier de l'offre
	 *
	 * @return int
	 */
	public function getnommetier() {
		return $this->nommetier;
	}
	public function getnomcatmetier() {
		return $this->nomcatmetier;
	}
	/**
	 *
	 * Retourne le commentaire
	 *
	 * @return string
	 */
	public function getcommentaire() {
		return $this->commentaire;
	}
	/**
	 *
	 * Retourne le contact
	 *
	 * @return string
	 */
	public function getcontact() {
		return $this->contact;
	}
	/**
	 *
	 * Retourne le mail
	 *
	 * @return string
	 */
	public function getmail() {
		return $this->mail;
	}
	/**
	 *
	 * Retourne le fichier
	 *
	 * @return string
	 */
	public function getfichier() {
		return $this->fichier;
	}
	/**
	 *
	 * Retourne l'information "validï¿½"
	 *
	 * @return int
	 */
	public function getvalid() {
		return $this->valid;
	}
	/**
	 *
	 * Retourne l'information "publiï¿½"
	 *
	 * @return int
	 */
	public function getpub() {
		return $this->pub;
	}
	/**
	 *
	 * Retourne le nombre de cv
	 *
	 * @return int
	 */
	public function getnbrcv() {
		return $this->nbrcv;
	}
	/**
	 *
	 * Retourne le nom du domaine
	 *
	 * @return string
	 */
	public function getnomdomaine() {
		return $this->nomdomaine;
	}
	/**
	 *
	 * Retourne le type
	 *
	 * @return string
	 */
	public function gettype() {
		return $this->type;
	}
	/**
	 *
	 * Retourne l'expï¿½rience
	 *
	 * @return int
	 */
	public function getexp() {
		return $this->exp;
	}
	/**
	 *
	 * Retourne le niveau
	 *
	 * @return int
	 */
	public function getniveau() {
		return $this->niveau;
	}
	/**
	 *
	 * Retourne le mime du fichier
	 *
	 * @return string
	 */
	public function getmimefichier() {
		return $this->mimefichier;
	}
	/**
	 *
	 * Retourne la taille
	 *
	 * @return int
	 */
	public function getsizefichier() {
		return $this->sizefichier;
	}
	/**
	 *
	 * Retourne le blob du fichier
	 *
	 * @return string
	 */
	public function getblobfichier() {
		return $this->blobfichier;
	}

	// setteurs
	/**
	 *
	 * insï¿½re le numï¿½ro de l'offre
	 *
	 * @param int $newvalue
	 */
	public function setnumoffre($newValue) {
		$this->numoffre = $newValue;
	}
	/**
	 *
	 * insï¿½re la date de l'offre
	 *
	 * @param date $newvalue
	 */
	public function setdateoffre($newValue) {
		$this->dateoffre = $newValue;
	}
	/**
	 *
	 * insï¿½re le titre de l'offre
	 *
	 * @param string $newvalue
	 */
	public function settitreoffre($newValue) {
		$this->titreoffre = $newValue;
	}
	/**
	 *
	 * insère les régios
	 *
	 * @param int $newvalue
	 */
	public function setregionlibelle($newValue) {
		$this->regionlibelle = $newValue;
	}
	/**
	 *
	 * insère les codes départements
	 *
	 * @param int $newvalue
	 */
	public function setdepartementlibelle($newValue) {
		$this->departementlibelle = $newValue;
	}
	/**
	 *
	 * insère les villes
	 *
	 * @param int $newvalue
	 */
	public function setville($newValue) {
		$this->ville = $newValue;
	}
	/**
	 *
	 * insère la date de début de poste
	 *
	 * @param int $newvalue
	 */
	public function setdatedebpost($newValue) {
		$this->datedebpost = $newValue;
	}
	/**
	 *
	 * insère les id des départements sélectionnés
	 *
	 * @param int $newvalue
	 */
	public function setdepartementselect($newValue) {
		$this->departementselect = $newValue;
	}
	/**
	 *
	 * insï¿½re la fonction
	 *
	 * @param string $newvalue
	 */
	public function setfonction($newValue) {
		$this->fonction = $newValue;
	}
	/**
	 *
	 * insï¿½re lde domaine
	 *
	 * @param int $newvalue
	 */
	public function setiddomaine($newValue) {
		$this->iddomaine = $newValue;
	}
	/**
	 *
	 * insï¿½re le nom du metier
	 *
	 * @param int $newvalue
	 */
	public function setnommetier($newValue) {
		$this->nommetier = $newValue;
	}
	public function setnomcatmetier($newValue) {
		$this->nomcatmetier = $newValue;
	}
	/**
	 *
	 * insï¿½re le metier
	 *
	 * @param int $newvalue
	 */
	public function setidmetier($newValue) {
		$this->idmetier = $newValue;
	}
	/**
	 *
	 * insï¿½re le commentaire
	 *
	 * @param string $newvalue
	 */
	public function setcommentaire($newValue) {
		$this->commentaire = $newValue;
	}
	/**
	 *
	 * insï¿½re le contact
	 *
	 * @param string $newvalue
	 */
	public function setcontact($newValue) {
		$this->contact = $newValue;
	}
	/**
	 *
	 * insï¿½re le mail
	 *
	 * @param string $newvalue
	 */
	public function setmail($newValue) {
		$this->mail = $newValue;
	}
	/**
	 *
	 * insï¿½re le fichier
	 *
	 * @param string $newvalue
	 */
	public function setfichier($newValue) {
		$this->fichier = $newValue;
	}
	/**
	 *
	 * insï¿½re l'information "validï¿½"
	 *
	 * @param int $newvalue
	 */
	public function setvalid($newValue) {
		$this->valid = $newValue;
	}
	/**
	 *
	 * insï¿½re l'information "publiï¿½"
	 *
	 * @param int $newvalue
	 */
	public function setpub($newValue) {
		$this->pub = $newValue;
	}
	/**
	 *
	 * insï¿½re le nombre de cv
	 *
	 * @param int $newvalue
	 */
	public function setnbrcve($newValue) {
		$this->nbrcv = $newValue;
	}
	/**
	 *
	 * insï¿½re le nom du domaine
	 *
	 * @param string $newvalue
	 */
	public function setnomdomaine($newValue) {
		$this->nomdomaine = $newValue;
	}
	/**
	 *
	 * insï¿½re le type
	 *
	 * @param string $newvalue
	 */
	public function settype($newValue) {
		$this->type = $newValue;
	}
	/**
	 *
	 * insï¿½re l'expï¿½rience
	 *
	 * @param string $newvalue
	 */
	public function setexp($newValue) {
		$this->exp = $newValue;
	}
	/**
	 *
	 * insï¿½re le niveau
	 *
	 * @param string $newvalue
	 */
	public function setniveau($newValue) {
		$this->niveau = $newValue;
	}
	/**
	 *
	 * insï¿½re le mime du fichier
	 *
	 * @param string $newvalue
	 */
	public function setmimefichier($newValue) {
		$this->mimefichier = $newValue;
	}
	/**
	 *
	 * insï¿½re la taille du fichier
	 *
	 * @param string $newvalue
	 */
	public function setsizefichier($newValue) {
		$this->sizefichier = $newValue;
	}
	/**
	 *
	 * insï¿½re le blob du fichier
	 *
	 * @param string $newvalue
	 */
	public function setblobfichier($newValue) {
		$this->blobfichier = $newValue;
	}

	// ###
	/**
	 *
	 * Sï¿½lectionne le mail d'une offre
	 *
	 * @param int $id
	 */
	public function sql_mail($id) {
		$sql = "SELECT EmailOffre FROM emploi_offres WHERE NumOffre='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $id ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
		$line = mysqli_fetch_array  ( $result );
		$this->mail = $line [0];
	}
	/**
	 * Met ï¿½ jour une offre
	 */
	public function sql_update_verifoffre() {
		$sql = "UPDATE emploi_offres SET TitreOffre = '%s', RegionID = NULL ,FonctionOffre ='%s',IDDomaine ='%s',";
		$sql .= " CommentaireOffre = '%s',ContactOffre = '%s',EmailOffre = '%s',IDExp = '%s', IDNiveau ='%s', IDType = '%s', IDmetier = '%s', ville = '%s', DateDebPost = '%s',";
		// GESTION VALIDATION/PUBLICATION
		$sql .= is_null ( $this->valid ) ? " Valid = NULL," : " Valid = " . $this->valid . ",";
		$sql .= is_null ( $this->valid ) ? " Pub = NULL" : " Pub = " . $this->valid;
		$sql .= " WHERE NumOffre = '%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $this->titreoffre ), 
				// mysql_real_escape_string($this->regionid),
				// mysqli_real_escape_string ($_SESSION['LINK'], $this->fonction ), mysqli_real_escape_string ($_SESSION['LINK'], $this->iddomaine ), mysqli_real_escape_string ($_SESSION['LINK'], $this->commentaire ), mysqli_real_escape_string ($_SESSION['LINK'], $this->contact ), mysqli_real_escape_string ($_SESSION['LINK'], $this->mail ), mysqli_real_escape_string ($_SESSION['LINK'], $this->exp ), mysqli_real_escape_string ($_SESSION['LINK'], $this->niveau ), mysqli_real_escape_string ($_SESSION['LINK'], $this->type ), mysqli_real_escape_string ($_SESSION['LINK'], $this->idmetier ), mysqli_real_escape_string ($_SESSION['LINK'], $this->ville ), mysqli_real_escape_string ($_SESSION['LINK'], $this->datedebpost ), mysqli_real_escape_string ($_SESSION['LINK'], $this->numoffre ) );
				'', 2, mysqli_real_escape_string ($_SESSION['LINK'], $this->commentaire ), mysqli_real_escape_string ($_SESSION['LINK'], $this->contact ), mysqli_real_escape_string ($_SESSION['LINK'], $this->mail ), mysqli_real_escape_string ($_SESSION['LINK'], $this->exp ), mysqli_real_escape_string ($_SESSION['LINK'], $this->niveau ), mysqli_real_escape_string ($_SESSION['LINK'], $this->type ), mysqli_real_escape_string ($_SESSION['LINK'], $this->idmetier ), mysqli_real_escape_string ($_SESSION['LINK'], $this->ville ), mysqli_real_escape_string ($_SESSION['LINK'], $this->datedebpost ), mysqli_real_escape_string ($_SESSION['LINK'], $this->numoffre ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		// on cré la liste des départements rattachée à l'offre
		$tempDep = explode ( ",", $this->getdepartementselect () );

		// on supprime tous les rattachements existants
		$sql = "DELETE FROM emploi_offres_departements where NumOffre = " . $this->numoffre;
		mysqli_query ($_SESSION['LINK'], $sql ) or die ( mysqli_error ($_SESSION['LINK']) );

		foreach ( $tempDep as $value ) {
			if (strpos ( $value, "R" ) === false && strpos ( $value, "F" ) === false) {
				$sql = "INSERT INTO emploi_offres_departements VALUES ('%s', '%s')";

				$query = sprintf ( $sql, 
				mysqli_real_escape_string ($_SESSION['LINK'], $this->numoffre ), mysqli_real_escape_string ($_SESSION['LINK'], $value ) );

				mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
			}
		}
	}
	/**
	 * Met ï¿½ jour un fichier
	 */
	public function sql_update_fichier() {
		$sql = "UPDATE emploi_offres SET FichierOffre = '%s', MimeF ='%s',BlobDataF ='%s',SizeF ='%s'";
		$sql .= " WHERE NumOffre = '%s'";

		$query = sprintf ( $sql, 
		mysqli_real_escape_string ($_SESSION['LINK'], $this->fichier ), mysqli_real_escape_string ($_SESSION['LINK'], $this->mimefichier ), mysqli_real_escape_string ($_SESSION['LINK'], $this->blobfichier ), mysqli_real_escape_string ($_SESSION['LINK'], $this->sizefichier ), mysqli_real_escape_string ($_SESSION['LINK'], $this->numoffre ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}

	/**
	 * Supprimer une offre
	 */
	public function SQL_delete() {
		$sql = "DELETE FROM emploi_offres WHERE NumOffre='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $this->numoffre ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	/**
	 *
	 * Sï¿½lectionne une offre
	 *
	 * @param int $id
	 */
	public function sql_select_verifoffre($id) {
		$this->numoffre = $id;

		$sql = " SELECT emploi_offres.NumOffre, DATE_FORMAT(DateOffre, '%%d/%%m/%%Y'), TitreOffre, FonctionOffre, NomDomaine, CommentaireOffre, ContactOffre, EmailOffre, FichierOffre, Valid, pub, NomType, Experience, Niveau, ";
		$sql .= " group_concat(distinct annuaire_lva_region.Libelle SEPARATOR ' - ') as libelle, group_concat(annuaire_lva_departement.Code ORDER BY annuaire_lva_departement.Code SEPARATOR ' - ') as code, Ville, emploi_offres.IDmetier, DATE_FORMAT(dateDebPost, '%%d/%%m/%%Y'),NomMetier,NomCatMetier ";
		$sql .= " FROM emploi_offres LEFT JOIN emploi_domaine ON emploi_offres.IDDomaine = emploi_domaine.IDDomaine ";
		// $sql .= " LEFT JOIN annuaire_lva_region ON emploi_offres.RegionID = annuaire_lva_region.RegionID ";
		$sql .= " LEFT JOIN emploi_type_contrat ON emploi_offres.IDType = emploi_type_contrat.IDType ";
		$sql .= " LEFT JOIN emploi_experience ON emploi_offres.IDExp = emploi_experience.IDExp ";
		$sql .= " LEFT JOIN emploi_niveau ON emploi_offres.IDNiveau = emploi_niveau.IDNiveau ";
		$sql .= " LEFT JOIN emploi_metier ON emploi_offres.IDMetier = emploi_metier.IDmetier ";
		$sql .= " LEFT JOIN emploi_cat_metier ON emploi_metier.IDCatMetier = emploi_cat_metier.IDCatmetier ";

		$sql .= " LEFT JOIN emploi_offres_departements ON emploi_offres.NumOffre = emploi_offres_departements.NumOffre ";
		$sql .= " LEFT JOIN annuaire_lva_departement_region ON emploi_offres_departements.DepartementID = annuaire_lva_departement_region.DepartementID ";
		$sql .= " LEFT JOIN annuaire_lva_departement ON annuaire_lva_departement_region.DepartementID = annuaire_lva_departement.DepartementID ";
		$sql .= " LEFT JOIN annuaire_lva_region ON annuaire_lva_departement_region.RegionID = annuaire_lva_region.RegionID ";

		$sql .= " WHERE AnnuaireID = 6 AND annuaire_lva_region.RegionID not in (92) AND emploi_offres.NumOffre = '%s' ";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $this->numoffre ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array  ( $result );

			$this->numoffre = $line [0];
			$this->dateoffre = $line [1];
			$this->titreoffre = $line [2];
			// $this->regionid = $line[3];
			$this->fonction = $line [3];
			$this->iddomaine = $line [4];
			$this->commentaire = $line [5];
			$this->contact = $line [6];
			$this->mail = $line [7];
			$this->fichier = $line [8];
			$this->valid = $line [9];
			$this->pub = $line [10];
			$this->type = $line [11];
			$this->exp = $line [12];
			$this->niveau = $line [13];
			$this->regionlibelle = $line [14];
			$this->departementlibelle = $line [15];
			$this->ville = $line [16];
			$this->idmetier = $line [17];
			$this->datedebpost = $line [18];
			$this->nommetier = $line [19];
			$this->nomcatmetier = $line [20];
		}

		mysqli_free_result  ( $result );
	}
	/**
	 *
	 * Sï¿½lectione le fichier d'une offre
	 *
	 * @param int $AttachmentID
	 */
	public function SQL_SELECT_BLOB_FICHIER($AttachmentID) {
		$sql = "SELECT NumOffre, FichierOffre, DATE_FORMAT(DateOffre, '%%d/%%m/%%Y'), MimeF, SizeF, BlobDataF FROM emploi_offres WHERE NumOffre='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK_FI'], $AttachmentID ) );

		$result = mysqli_query ($_SESSION['LINK_FI'], $query ) or die ( mysqli_error ($_SESSION['LINK_FI']) );

		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array  ( $result );

			$this->numoffre = $line [0];
			$this->fichier = $line [1];
			$this->dateoffre = $line [2];
			$this->mimefichier = $line [3];
			$this->sizefichier = $line [4];
			$this->blobfichier = $line [5];
		} else {
			$this->__construct ();
		}

		mysqli_free_result  ( $result );
	}
}
?>