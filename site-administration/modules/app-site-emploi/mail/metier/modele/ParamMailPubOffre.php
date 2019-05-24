<?php
/**
 * Class non utilisée
 * @deprecated
 * @author Quentin BRISSON
 * @package app-site-emploi
 * @subpackage mail
 * @version 1.0.4
 *
 */
class ParamMailPubOffre {
	private $idmail;
	private $mailbox;
	private $mailadmin;
	private $pubannoncepied;
	private $pubannoncetete;
	private $pubannonceobjet;
	private $pubcandpied;
	private $pubcandtete;
	private $pubcandobjet;
	private $nonpubcandobjet;
	private $nonpubcandpied;
	private $nonpubcandtete;
	private $nonpubannoncepied;
	private $nonpubannonceobjet;
	private $nonpubannoncetete;
	private $suppannonceobjet;
	private $suppannoncepied;
	private $suppannoncetete;
	private $suppcandobjet;
	private $suppcandtete;
	private $suppcandpied;
	private $repoffcandobjet;
	private $repoffcandtete;
	private $repoffcandpied;
	private $repoffempobjet;
	private $repoffemptete;
	private $repoffemppied;
	function __construct() {
		$this->idmail = NULL;
		$this->mailbox = '';
		$this->mailadmin = '';
		$this->pubannoncepied = '';
		$this->pubannoncetete = '';
		$this->pubannonceobjet = '';

		$this->pubcandpied = '';
		$this->pubcandtete = '';
		$this->pubcandobjet = '';

		$this->nonpubcandobjet = '';
		$this->nonpubcandpied = '';
		$this->nonpubcandtete = '';

		$this->nonpubannonceobjet = '';
		$this->nonpubannoncetete = '';
		$this->nonpubannoncepied = '';

		$this->suppannonceobjet = '';
		$this->suppannoncepied = '';
		$this->suppannoncetete = '';

		$this->suppcandobjet = '';
		$this->suppcandtete = '';
		$this->suppcandpied = '';

		$this->repoffcandobjet = '';
		$this->repoffcandtete = '';
		$this->repoffcandpied = '';

		$this->repoffempobjet = '';
		$this->repoffemptete = '';
		$this->repoffemppied = '';
	}

	// #################
	// Get et Set pour la publication d'une offre
	// Getteur
	public function getidmail() {
		return $this->idmail;
	}
	public function getmailbox() {
		return $this->mailbox;
	}
	public function getmailadmin() {
		return $this->mailadmin;
	}
	public function getpubannoncepied() {
		return $this->pubannoncepied;
	}
	public function getpubannoncetete() {
		return $this->pubannoncetete;
	}
	public function getpubannonceobjet() {
		return $this->pubannonceobjet;
	}

	// Setteur
	public function setidmail($newValue) {
		$this->idmail = $newValue;
	}
	public function setmailbox($newValue) {
		$this->mailbox = $newValue;
	}
	public function setmailadmin($newValue) {
		$this->mailadmin = $newValue;
	}
	public function setpubannoncepied($newValue) {
		$this->pubannoncepied = $newValue;
	}
	public function setpubannoncetete($newValue) {
		$this->pubannoncetete = $newValue;
	}
	public function setpubannonceobjet($newValue) {
		$this->pubannonceobjet = $newValue;
	}
	// Get et Set pour la non publication d'une offre
	// Getteur
	public function getnonpubannoncepied() {
		return $this->nonpubannoncepied;
	}
	public function getnonpubannoncetete() {
		return $this->nonpubannoncetete;
	}
	public function getnonpubannonceobjet() {
		return $this->nonpubannonceobjet;
	}

	// Setteur
	public function setnonpubannoncepied($newValue) {
		$this->nonpubannoncepied = $newValue;
	}
	public function setnonpubannoncetete($newValue) {
		$this->nonpubannoncetete = $newValue;
	}
	public function setnonpubannonceobjet($newValue) {
		$this->nonpubannonceobjet = $newValue;
	}
	// Get et Set pour la publication d'une candidature
	// Getteur
	public function getpubcandpied() {
		return $this->pubcandpied;
	}
	public function getpubcandtete() {
		return $this->pubcandtete;
	}
	public function getpubcandobjet() {
		return $this->pubcandobjet;
	}

	// Setteur
	public function setpubcandpied($newValue) {
		$this->pubcandpied = $newValue;
	}
	public function setpubcandtete($newValue) {
		$this->pubcandtete = $newValue;
	}
	public function setpubcandobjet($newValue) {
		$this->pubcandobjet = $newValue;
	}

	// Get et Set pour la non publication d'une candidature
	// Getteur
	public function getnonpubcandpied() {
		return $this->nonpubcandpied;
	}
	public function getnonpubcandtete() {
		return $this->nonpubcandtete;
	}
	public function getnonpubcandobjet() {
		return $this->nonpubcandobjet;
	}

	// Setteur
	public function setnonpubcandpied($newValue) {
		$this->nonpubcandpied = $newValue;
	}
	public function setnonpubcandtete($newValue) {
		$this->nonpubcandtete = $newValue;
	}
	public function setnonpubcandobjet($newValue) {
		$this->nonpubcandobjet = $newValue;
	}

	// Get et Set pour la suppression d'une offre
	// Getteur
	public function getsuppannonceobjet() {
		return $this->suppannonceobjet;
	}
	public function getsuppannoncepied() {
		return $this->suppannoncepied;
	}
	public function getsuppannoncetete() {
		return $this->suppannoncetete;
	}

	// Setteur
	public function setsuppannonceobjet($newValue) {
		$this->suppannonceobjet = $newValue;
	}
	public function setsuppannoncepied($newValue) {
		$this->suppannoncepied = $newValue;
	}
	public function setsuppannoncetete($newValue) {
		$this->suppannoncetete = $newValue;
	}

	// Get et Set pour la suppression d'une candidature
	// Getteur
	public function getsuppcandpied() {
		return $this->suppcandpied;
	}
	public function getsuppcandtete() {
		return $this->suppcandtete;
	}
	public function getsuppcandobjet() {
		return $this->suppcandobjet;
	}

	// Setteur
	public function setsuppcandpied($newValue) {
		$this->suppcandpied = $newValue;
	}
	public function setsuppcandtete($newValue) {
		$this->suppcandtete = $newValue;
	}
	public function setsuppcandobjet($newValue) {
		$this->suppcandobjet = $newValue;
	}

	// Get et Set pour la réponse à une offre au candidat
	// Getteur
	public function getrepoffcandobjet() {
		return $this->repoffcandobjet;
	}
	public function getrepoffcandpied() {
		return $this->repoffcandpied;
	}
	public function getrepoffcandtete() {
		return $this->repoffcandtete;
	}

	// Setteur
	public function setrepoffcandobjet($newValue) {
		$this->repoffcandobjet = $newValue;
	}
	public function setrepoffcandpied($newValue) {
		$this->repoffcandpied = $newValue;
	}
	public function setrepoffcandtete($newValue) {
		$this->repoffcandtete = $newValue;
	}

	// Get et Set pour la réponse à une offre à l'employé
	// Getteur
	public function getrepoffempobjet() {
		return $this->repoffempobjet;
	}
	public function getrepoffemppied() {
		return $this->repoffemppied;
	}
	public function getrepoffemptete() {
		return $this->repoffemptete;
	}

	// Setteur
	public function setrepoffempobjet($newValue) {
		$this->repoffempobjet = $newValue;
	}
	public function setrepoffemppied($newValue) {
		$this->repoffemppied = $newValue;
	}
	public function setrepoffemptete($newValue) {
		$this->repoffemptete = $newValue;
	}

	// ######################
	function sql_update_param_mail() {
		$sql = " UPDATE emploi_param_mail ";
		$sql .= " SET ParamMailBox = '%s', ParamAdminMail = '%s', PubAnnonceObjet = '%s', PubAnnoncePied = '%s', PubAnnonceTete = '%s', ";
		$sql .= " NonPubAnnonceObjet = '%s', NonPubAnnoncePied = '%s', NonPubAnnonceTete = '%s', ";
		$sql .= " PubCandidatObjet = '%s', PubCandidatPied = '%s', PubCandidatTete = '%s', ";
		$sql .= " NonPubCandidatObjet = '%s', NonPubCandidatPied = '%s', NonPubCandidatTete = '%s', ";
		$sql .= " SuppAnnoncePied = '%s', SuppAnnonceTete = '%s', SuppAnnonceObjet = '%s', ";
		$sql .= " SuppCandidatObjet = '%s', SuppCandidatPied = '%s', SuppCandidatTete = '%s', ";
		$sql .= " RepOffCandObjet = '%s', RepOffCandTete = '%s', RepOffCandPied = '%s', ";
		$sql .= " RepOffEmpPied = '%s', RepOffEmpTete = '%s', RepOffEmpObjet = '%s'";
		$sql .= " WHERE IDMail = 1";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->mailbox ) ), mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->mailadmin ) ), mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->pubannonceobjet ) ), mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->pubannoncepied ) ), mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->pubannoncetete ) ), mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->nonpubannonceobjet ) ), mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->nonpubannoncepied ) ), mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->nonpubannoncetete ) ), mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->pubcandobjet ) ), mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->pubcandpied ) ), mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->pubcandtete ) ), mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->nonpubcandobjet ) ), mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->nonpubcandpied ) ), mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->nonpubcandtete ) ), mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->suppannoncepied ) ), mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->suppannoncetete ) ), mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->suppannonceobjet ) ), mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->suppcandobjet ) ), mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->suppcandpied ) ), mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->suppcandtete ) ), mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->repoffcandobjet ) ), mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->repoffcandtete ) ), mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->repoffcandpied ) ), mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->repoffemppied ) ), mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->repoffemptete ) ), mysqli_real_escape_string ($_SESSION['LINK'], stripslashes ( $this->repoffempobjet ) ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	function sql_select_param_mail() {
		$sql = " SELECT IDMail, ParamMailBox, ParamAdminMail, PubAnnonceObjet, PubAnnoncePied, PubAnnonceTete,";
		$sql .= "   NonPubAnnonceObjet, NonPubAnnonceTete, NonPubAnnoncePied, ";
		$sql .= " PubCandidatObjet, PubCandidatPied, PubCandidatTete, ";
		$sql .= " NonPubCandidatObjet, NonPubCandidatPied, NonPubCandidatTete, ";
		$sql .= " SuppAnnoncePied, SuppAnnonceTete, SuppAnnonceObjet, ";
		$sql .= " SuppCandidatObjet, SuppCandidatPied, SuppCandidatTete, ";
		$sql .= " RepOffCandObjet, RepOffCandTete, RepOffCandPied, ";
		$sql .= " RepOffEmpPied, RepOffEmpTete, RepOffEmpObjet ";
		$sql .= " FROM emploi_param_mail ";
		$sql .= " WHERE IDMail = 1";

		$result = mysqli_query ($_SESSION['LINK'], $sql ) or die ( mysqli_error ($_SESSION['LINK']) );

		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array  ( $result );

			$this->idmail = $line [0];
			$this->mailbox = $line [1];
			$this->mailadmin = $line [2];

			$this->pubannonceobjet = $line [3];
			$this->pubannoncepied = $line [4];
			$this->pubannoncetete = $line [5];

			$this->nonpubannonceobjet = $line [6];
			$this->nonpubannoncetete = $line [7];
			$this->nonpubannoncepied = $line [8];

			$this->pubcandobjet = $line [9];
			$this->pubcandpied = $line [10];
			$this->pubcandtete = $line [11];

			$this->nonpubcandobjet = $line [12];
			$this->nonpubcandpied = $line [13];
			$this->nonpubcandtete = $line [14];

			$this->suppannoncepied = $line [15];
			$this->suppannoncetete = $line [16];
			$this->suppannonceobjet = $line [17];

			$this->suppcandobjet = $line [18];
			$this->suppcandpied = $line [19];
			$this->suppcandtete = $line [20];

			$this->repoffcandobjet = $line [21];
			$this->repoffcandtete = $line [22];
			$this->repoffcandpied = $line [23];

			$this->repoffemppied = $line [24];
			$this->repoffemptete = $line [25];
			$this->repoffempobjet = $line [26];
		}
	}
}

?>