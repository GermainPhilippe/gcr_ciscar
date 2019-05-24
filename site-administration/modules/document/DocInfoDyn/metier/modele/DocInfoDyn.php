<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage document
 * @version 1.0.4
 */
class DocInfoDyn {
	private $ID;
	private $Titre;
	private $Accroche;
	private $ContenuRichText;
	private $BanniereID;
	private $PublicationALaUne;
	private $DateDebut;
	private $DateFin;
	private $AuteurID;
	private $VignetteAccroche;
	private $CommentaireActif;
	public function __construct() {
		$this->ID = NULL;
		$this->Titre = '';
		$this->Accroche = '';
		$this->ContenuRichText = '';
		$this->BanniereID = NULL;
		$this->PublicationALaUne = '1';
		$this->DateDebut = NULL;
		$this->DateFin = NULL;
		$this->AuteurID = '';
		$this->VignetteAccroche = '';
		$this->CommentaireActif = 0;
	}

	// ###
	public function getID() {
		return $this->ID;
	}
	public function getTitre() {
		return $this->Titre;
	}
	public function getAccroche() {
		return $this->Accroche;
	}
	public function getContenuRichText() {
		return $this->ContenuRichText;
	}
	public function getBanniereID() {
		return $this->BanniereID;
	}
	public function getPublicationALaUne() {
		return $this->PublicationALaUne;
	}
	public function getDateDebut() {
		return $this->DateDebut;
	}
	public function getDateFin() {
		return $this->DateFin;
	}
	public function getAuteurID() {
		return $this->AuteurID;
	}
	public function getVignetteAccroche() {
		return $this->VignetteAccroche;
	}
	public function getCommentaireActif() {
		return $this->CommentaireActif;
	}

	// ###
	public function setID($newValue) {
		$this->ID = $newValue;
	}
	public function setTitre($newValue) {
		$this->Titre = $newValue;
	}
	public function setAccroche($newValue) {
		$this->Accroche = $newValue;
	}
	public function setContenuRichText($newValue) {
		$this->ContenuRichText = $newValue;
	}
	public function setBanniereID($newValue) {
		$this->BanniereID = $newValue;
	}
	public function setPublicationALaUne($newValue) {
		$this->PublicationALaUne = $newValue;
	}
	public function setDateDebut($newValue) {
		$this->DateDebut = $newValue;
	}
	public function setDateFin($newValue) {
		$this->DateFin = $newValue;
	}
	public function setAuteurID($newValue) {
		$this->AuteurID = $newValue;
	}
	public function setVignetteAccroche($newValue) {
		$this->VignetteAccroche = $newValue;
	}
	public function setCommentaireActif($newValue) {
		$this->CommentaireActif = $newValue;
	}

	// ###
	public function SQL_create() {
		if (($_SESSION ['ADMIN'] ['USER'] ['AnnuaireID']) == '1') {
			$ref = 'MONTH';
		} else {
			$ref = 'YEAR';
		}
		$date = date ( 'Y-m-d' );
		$sql = "INSERT INTO wcm_document_infodyn (DocInfoDynID, SiteID, Titre, Accroche, ContenuRichText, BanniereID, PublicationALaUne, DateDebut, DateFin, AuteurID, DateCreation, VignetteAccroche, CommentaireActif)";
		$sql .= " VALUES (NULL,'%s','%s','%s','%s'";
		$sql .= is_null ( $this->BanniereID ) ? ", NULL" : "," . $this->BanniereID;
		$sql .= ",'%s',";

		// Date debut
		$sql .= strlen ( trim ( $this->DateDebut ) ) == 0 ? "CURRENT_DATE()," : "'" . trim ( $this->DateDebut ) . "',";
		// Date Fin
		$sql .= strlen ( trim ( $this->DateFin ) ) == 0 ? "ADDDATE(CURRENT_DATE, INTERVAL 3 $ref )" : "'" . trim ( $this->DateFin ) . "'";

		// Auteur
		$sql .= ",NULL,CURRENT_DATE(),'%s','%s')";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ), mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->Titre ) ), mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->Accroche ) ), mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->ContenuRichText ) ), mysqli_real_escape_string ($_SESSION['LINK'], $this->PublicationALaUne ), mysqli_real_escape_string ($_SESSION['LINK'], $this->VignetteAccroche ), mysqli_real_escape_string ($_SESSION['LINK'], $this->CommentaireActif ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		$this->setID ( mysqli_insert_id ($_SESSION['LINK']) );
	}
	public function SQL_update() {
		$sql = "UPDATE wcm_document_infodyn SET ";
		$sql .= is_null ( $this->BanniereID ) ? "BanniereID=NULL" : "BanniereID='" . $this->BanniereID . "'";
		$sql .= is_null ( $this->AuteurID ) ? ", AuteurID=NULL" : ", AuteurID='" . $this->AuteurID . "'";
		$sql .= ", PublicationALaUne='%s'";

		// Date debut
		$sql .= strlen ( trim ( $this->DateDebut ) ) == 0 ? ", DateDebut=NULL" : ", DateDebut='" . trim ( $this->DateDebut ) . "'";
		// Date Fin
		$sql .= strlen ( trim ( $this->DateFin ) ) == 0 ? ", DateFin=NULL" : ", DateFin='" . trim ( $this->DateFin ) . "'";
		$sql .= ",Titre='%s', Accroche='%s', ContenuRichText='%s', VignetteAccroche='%s', CommentaireActif='%s'";
		$sql .= " WHERE DocInfoDynID='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $this->PublicationALaUne ), mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->Titre ) ), mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->Accroche ) ), mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->ContenuRichText ) ), mysqli_real_escape_string ($_SESSION['LINK'], $this->VignetteAccroche ), mysqli_real_escape_string ($_SESSION['LINK'], $this->CommentaireActif ), mysqli_real_escape_string ($_SESSION['LINK'], $this->ID ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function SQL_delete() {
		$query = sprintf ( "DELETE FROM wcm_document_infodyn WHERE DocInfoDynID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $this->ID ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function SQL_select($DocID) {
		$query = sprintf ( "SELECT DocInfoDynID, Titre, Accroche, ContenuRichText, BanniereID, PublicationALaUne, DateDebut, DateFin, AuteurID, VignetteAccroche, CommentaireActif FROM wcm_document_infodyn WHERE DocInfoDynID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $DocID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		if (mysqli_num_rows ( $result ) > 0) {
			$line = mysqli_fetch_array  ( $result );

			$this->ID = $line [0];
			$this->Titre = $line [1];
			$this->Accroche = $line [2];
			$this->ContenuRichText = $line [3];
			$this->BanniereID = $line [4];
			$this->PublicationALaUne = $line [5];
			$this->DateDebut = $line [6];
			$this->DateFin = $line [7];
			$this->AuteurID = $line [8];
			$this->VignetteAccroche = $line [9];
			$this->CommentaireActif = $line [10];
		} else {
			$this->__construct ();
		}

		mysqli_free_result  ( $result );
	}
}
?>