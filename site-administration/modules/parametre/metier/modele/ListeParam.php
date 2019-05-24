<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage parametre
 * @version 1.0.4
 */
class ListeParam {
	private $paramListe;

	function __construct()
	{
		$this->paramListe = array ();
	}
	function ListeParam() {
		self::__construct();
	}

	// #################
	function addParam($aParam) {
		$this->paramListe [] = $aParam;
	}
	function removeParam($i) {
		unset ( $this->paramListe [$i] );
	}
	function getParamListe() {
		return $this->paramListe;
	}
	function setParamListe($newValue) {
		$this->paramListe = $newValue;
	}
	function getNbParam() {
		return count ( $this->paramListe );
	}

	// ###################
	function select_all_param() {
		$aSite = new Site ();
		$aSite->select_site_by_name ();

		$query = sprintf ( "SELECT ParamID, Nom, Valeur, SiteID FROM annuaire_parametre WHERE SiteID IS NULL OR SiteID='%s'", mysqli_real_escape_string ($_SESSION['LINK'], $aSite->getID () ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aParam = new Param ();
			$aParam->setID ( $line [0] );
			$aParam->setName ( $line [1] );
			$aParam->setValue ( $line [2] );

			$this->paramListe [] = $aParam;
		}

		mysqli_free_result  ( $result );
	}
}

?>