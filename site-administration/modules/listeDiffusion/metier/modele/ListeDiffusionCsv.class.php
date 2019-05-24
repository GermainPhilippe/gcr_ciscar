<?php
class ListeDiffusionCsv {
	private $myID;
	private $myFileName;
	private $myListeCsv;
	public function __construct() {
		$this->myID = NULL;
		$this->myFileName = NULL;
		$this->myListeCsv = NULL;
	}

	// ### GETTER ###
	public function isNew() {
		return (is_null ( $this->myID ) || empty ( $this->myID ));
	}
	public function getID() {
		return $this->myID;
	}
	public function getListeCsv() {
		return $this->myListeCsv;
	}
	public function getFileName() {
		return $this->myFileName;
	}

	// ### SETTER ###
	public function setID($newValue) {
		$this->myID = $newValue;
	}
	function setFileName($newValue) {
		$this->myFileName = $newValue;
	}
	public function setListeCsv($newValue, $aIndividu, $aI) {
		$this->myListeCsv [$aI] [0] = $newValue;
		$this->myListeCsv [$aI] [1] = $aIndividu [0]; // IndividuID
		$this->myListeCsv [$aI] [2] = $aIndividu [1]; // AnnuaireID
		$this->myListeCsv [$aI] [3] = $aIndividu [2]; // Nom
		$this->myListeCsv [$aI] [4] = $aIndividu [3]; // Prenom
		$this->myListeCsv [$aI] [5] = $aIndividu [4]; // EtablissementID
		$this->myListeCsv [$aI] [6] = $aIndividu [5]; // Civilite
		$this->myListeCsv [$aI] [7] = $aIndividu [6]; // Liste EtablissementID
	}
	public function setContient($newValue) {
		if (is_string ( $newValue ) && in_array ( $newValue, array (
				self::CONTIENT_EST,
				self::CONTIENT_NEST
		) )) {
			$this->myContient = $newValue;
		} else {
			$this->myContient = self::CONTIENT_EST;
		}
	}
	function create_csv($FileName) {
		$sql = "INSERT INTO csv_liste_diffusion (csv_File) VALUES('%s')";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $FileName ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	function create_csv_detail($id, $mail, $listIdMail, $num) {
		$sql = "INSERT INTO csv_liste_diffusion_detail (csv_id,csv_num_id,csv_individu_Id,csv_mail,csv_Annuaire_Id,csv_Nom,csv_Prenom,csv_EtablissementID, csv_Civilite,csv_Liste_EtablissementID)";
		$sql .= " VALUES('%s','%s'";
		$sql .= is_null ( $listIdMail [0] ) ? ",NULL" : ", '" . $listIdMail [0] . "'";
		$sql .= ",'%s'";
		$sql .= is_null ( $listIdMail [1] ) ? ",NULL" : ", '" . $listIdMail [1] . "'";
		$sql .= is_null ( $listIdMail [2] ) ? ",NULL" : ", '" . str_replace ( "'", "''", $listIdMail [2] ) . "'";
		$sql .= is_null ( $listIdMail [3] ) ? ",NULL" : ", '" . str_replace ( "'", "''", $listIdMail [3] ) . "'";
		$sql .= is_null ( $listIdMail [4] ) ? ",NULL" : ", '" . str_replace ( "'", "''", $listIdMail [4] ) . "'";
		$sql .= is_null ( $listIdMail [5] ) ? ",NULL" : ", '" . str_replace ( "'", "''", $listIdMail [5] ) . "'";
		$sql .= is_null ( $listIdMail [6] ) ? ",NULL)" : ", '" . str_replace ( "'", "''", $listIdMail [6] ) . "')";
		
		$query = sprintf ( $sql, $id, $num, mysqli_real_escape_string ($_SESSION['LINK'], $mail ) );
print $query;
		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	function select_Csv($CsvID) {
		$query = sprintf ( "SELECT csv_id, csv_file FROM csv_liste_diffusion WHERE csv_id ='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $CsvID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array  ( $result );

			$this->setID ( $line [0] );

			$this->setFileName ( $line [1] );
		} else {
			$this->myID = NULL;
			$this->myFileName = '';
		}

		mysqli_free_result  ( $result );
	}
}
?>