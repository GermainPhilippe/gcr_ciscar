<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage lca
 * @version 1.0.4
 */
class TypeGroupe {
	private $id;
	private $name;

	function __construct()
	{
		$this->id = NULL;
		$this->name = '';
	}
	function TypeGroupe() {
		self::__construct();
	}
	
	// ################
	function getID() {
		return $this->id;
	}
	function getName() {
		return $this->name;
	}
	function setID($newValue) {
		$this->id = $newValue;
	}
	function setName($newValue) {
		$this->name = $newValue;
	}

	// ####################
	function select_typegroupe($i) {
		$result = mysqli_query ($_SESSION['LINK'], "SELECT TypeGroupeID,Libelle FROM annuaire_lca_typegroupe WHERE TypeGroupeID='" . $i . "'" ) or die ( mysqli_error ($_SESSION['LINK']) );

		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array  ( $result );

			$this->setID ( $line [0] );
			$this->setName ( $line [1] );
		} else {
			$this->id = NULL;
			$this->name = '';
		}

		mysqli_free_result  ( $result );
	}
}

?>