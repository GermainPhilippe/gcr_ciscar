<?php
/**
 * Ce modele permet d'extraire les parametres de configuration de la base de données
 * @author Florent DESPIERRES
 * @package site-convention
 * @subpackage commun
 * @version 1.0.4
 */
class ParametreEnquete {
	private $ID;
	private $Nom;
	private $Valeur;
	/**
	 * Cette methode permet d'initialiser les attributs de la classe
	 */
	public function __construct() {
		$this->ID = NULL;
		$this->Nom = '';
		$this->Valeur = '';
	}

	/**
	 * Cette methode permet de retourner l'ID SQL, sa valeur par defaut est NULL
	 *
	 * @return int
	 */
	public function getID() {
		return $this->ID;
	}
	/**
	 * Cette methode permet de retourner le Nom, sa valeur par defaut est ''
	 *
	 * @return string
	 */
	public function getNom() {
		return $this->Nom;
	}
	/**
	 * Cette methode permet de retourner la valeur du parametre, sa valeur par defaut est ''
	 *
	 * @return string
	 */
	public function getValeur() {
		return $this->Valeur;
	}
	/**
	 * Cette methode permet de modifier l'ID SQL
	 *
	 * @param int $newValue
	 */
	public function setID($newValue) {
		$this->ID = $newValue;
	}
	/**
	 * Cette methode permet de modifier le nom
	 *
	 * @param string $newValue
	 */
	public function setNom($newValue) {
		$this->Nom = $newValue;
	}
	/**
	 * Cette methode permet de modifier la valeur du parametre
	 *
	 * @param string $newValue
	 */
	public function setValeur($newValue) {
		$this->Valeur = $newValue;
	}

	/**
	 * Cette methode permet de creer un nouveau parametre via une requete SQL
	 */
	public function SQL_create() {
		$sql = "INSERT INTO annuaire_parametre (ParamID, Nom, Valeur)";
		$sql .= " VALUES(NULL, '%s', '%s')";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $this->Nom ), mysqli_real_escape_string ($_SESSION['LINK'], $this->Valeur ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	/**
	 * Cette methode permet de modifier le paramete en cours via une requete SQL
	 */
	public function SQL_update() {
		$sql = "UPDATE annuaire_parametre SET Nom='%s', Valeur='%s'";
		$sql .= " WHERE ParamID='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $this->Nom ), mysqli_real_escape_string ($_SESSION['LINK'], $this->Valeur ), mysqli_real_escape_string ($_SESSION['LINK'], $this->ID ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	/**
	 * Cette methode permet de supprimer un parametre
	 */
	public function SQL_delete() {
		$sql = "DELETE FROM annuaire_parametre WHERE ParamID='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $this->ID ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	/**
	 * Cette methode permet de renseigner les attributs de l'instance en cours grace a une requete SQL via l'ID SQL du parametre
	 *
	 * @param int $ParamID
	 */
	public function SQL_select($ParamID) {
		$sql = "SELECT ParamID, Nom, Valeur FROM annuaire_parametre";
		$sql .= " WHERE ParamID='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $ParamID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array  ( $result );

			$this->ID = $line [0];
			$this->Nom = $line [1];
			$this->Valeur = $line [2];
		} else {
			$this->__construct ();
		}

		mysqli_free_result  ( $result );
	}
	/**
	 * Cette methode permet de renseigner les attributs de l'instance en cours grace a une requete SQL via le nom du parametre
	 *
	 * @param string $ParametreName
	 */
	public function SQL_select_by_name($ParametreName) {
		$sql = "SELECT ParamID, Nom, Valeur FROM annuaire_parametre";
		$sql .= " WHERE Nom='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $ParametreName ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array  ( $result );

			$this->ID = $line [0];
			$this->Nom = $line [1];
			$this->Valeur = $line [2];
		} else {
			$this->__construct ();
		}

		mysqli_free_result  ( $result );
	}
}
?>