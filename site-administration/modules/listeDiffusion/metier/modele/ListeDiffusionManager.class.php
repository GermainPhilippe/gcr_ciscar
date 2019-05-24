<?php
class ListeDiffusionManager {
	public function __construct() {
	}
	public function add(ListeDiffusion $aListeDiffusion, $Categorie) {
		$sql = "INSERT INTO annuaire_liste_diffusion (listeID, Nom, Type, SiteID, Categorie)";
		$sql .= " VALUES(NULL,'%s','%s','%s','%s')";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aListeDiffusion->getNom () ), mysqli_real_escape_string ($_SESSION['LINK'], $aListeDiffusion->getType () ), mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ), mysqli_real_escape_string ($_SESSION['LINK'], $Categorie ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		$aListeDiffusion->setID ( ( int ) mysqli_insert_id ($_SESSION['LINK']) );
	}
	public function update(ListeDiffusion $aListeDiffusion) {
		$sql = "UPDATE annuaire_liste_diffusion SET Nom='%s', Type='%s' WHERE listeID='%s'";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aListeDiffusion->getNom () ), mysqli_real_escape_string ($_SESSION['LINK'], $aListeDiffusion->getType () ), mysqli_real_escape_string ($_SESSION['LINK'], $aListeDiffusion->getID () ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function delete($aID) {
		$sql = "DELETE FROM annuaire_liste_diffusion WHERE listeID='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aID ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function get($aID) {
		$sql = "SELECT listeID, Nom, Type, SiteID FROM annuaire_liste_diffusion";
		$sql .= " WHERE SiteID='%s' AND listeID='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ), mysqli_real_escape_string ($_SESSION['LINK'], $aID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		$aListeDiffusion = new ListeDiffusion ();
		if (mysqli_num_rows ( $result ) > 0) {
			$line = mysqli_fetch_array  ( $result );
			$aListeDiffusion->setID ( ( int ) $line [0] );
			$aListeDiffusion->setNom ( $line [1] );
			$aListeDiffusion->setType ( $line [2] );
			$aListeDiffusion->setSiteID ( ( int ) $line [3] );
		}

		mysqli_free_result  ( $result );

		return $aListeDiffusion;
	}
	public function getList($debut = -1, $limite = -1, $Categorie = 'News') {
		$aArray = array ();

		$sql = "SELECT listeID, Nom, Type, SiteID FROM annuaire_liste_diffusion";
		$sql .= " WHERE SiteID='%s' and Categorie ='%s'";
		if ($debut != - 1 || $limite != - 1) {
			$sql .= ' LIMIT ' . ( int ) $debut . ', ' . ( int ) $limite;
		}
		$sql .= " ORDER BY Nom";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ), mysqli_real_escape_string ($_SESSION['LINK'], $Categorie ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aListeDiffusion = new ListeDiffusion ();
			$aListeDiffusion->setID ( ( int ) $line [0] );
			$aListeDiffusion->setNom ( $line [1] );
			$aListeDiffusion->setType ( $line [2] );
			$aListeDiffusion->setSiteID ( ( int ) $line [3] );
			$aArray [] = $aListeDiffusion;
		}
		mysqli_free_result  ( $result );

		return $aArray;
	}
	public function save(ListeDiffusion $aListeDiffusion, $Categorie) {
		$aListeDiffusion->isNew () ? $this->add ( $aListeDiffusion, $Categorie ) : $this->update ( $aListeDiffusion );
	}
	public function count() {
		$sql = "SELECT count(*) FROM annuaire_liste_diffusion WHERE SiteID='%s'";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ) );
		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		$line = 0;
		if (mysqli_num_rows ( $result ) > 0) {
			$line = mysqli_fetch_array  ( $result );
			$line = $line [0];
		}
		mysqli_free_result  ( $result );
		return $line;
	}
}
?>