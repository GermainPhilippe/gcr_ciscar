<?php
/**
 * Graphique de la répartition par domaine
 * @author Alexandre DIALLO
 * @package site-administration
 * @subpackage statistiques
 * @version 1.0.4
 */
session_start ();

if (! isset ( $_SESSION ['ADMIN'] )) {
	$_SESSION ['ADMIN'] ['USER'] ['FULLNAME'] = 'Visitor';
	$_SESSION ['ADMIN'] ['USER'] ['SiteName'] = '';
	$_SESSION ['ADMIN'] ['USER'] ['CONNECTED'] = false;
	$_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] = 0;
}

if ($_SESSION ['ADMIN'] ['USER'] ['CONNECTED']) {

	include ('../../../../../config/configuration.php');
	$baseURLModule = '../../../../modules/';
	require ('../../../../include/DbConnexion.php');
	require ('../../../mvc_inc.php');
	$time = time ();
	$aModele = new StatConsultDomaine ();
	$aCount = $aModele->SQL_COUNT_DOMAINE ( isset ( $_GET ['m'] ) ? $_GET ['m'] : date ( 'm', $time ), isset ( $_GET ['a'] ) ? $_GET ['a'] : date ( 'Y', $time ), isset ( $_GET ['type'] ) ? $_GET ['type'] : '3', $_GET ['site'] );
	$aModele->SQL_SELECT_DOMAINE ( isset ( $_GET ['m'] ) ? $_GET ['m'] : date ( 'm', $time ), isset ( $_GET ['a'] ) ? $_GET ['a'] : date ( 'Y', $time ), isset ( $_GET ['type'] ) ? $_GET ['type'] : '3', $_GET ['site'] );
	// On récupère le tableau contenant le domaine et son nombre de consultations
	$aArray = $aModele->getList ();

	// On récupère les domaines présents dans la bdd
	$sql = "SELECT DomainActiviteID, AnnuaireID, Libelle, NumOrdre FROM annuaire_lva_domainactivite WHERE AnnuaireID='%s' ORDER BY Libelle";
	$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $_GET ['site'] == '7' ? '2' : $_GET ['site'] ) );
	$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( 'Query failed: ' . mysqli_error ($_SESSION['LINK']) );
	if ($result) {
		while ( $row = mysqli_fetch_assoc ( $result ) ) {
			$salesgroup = $row ["Libelle"];
			// Si le domaine correspond à une entrée du tableau, on renvoit
			if (array_key_exists ( $row ["DomainActiviteID"], $aArray )) {

				$count = $aArray [$row ["DomainActiviteID"]];
			} else {
				// Sinon c'est qu'il n'y a aucune consultation pour le domaine concerné
				$count = 0;
			}

			$dataArray [$salesgroup] = $count;
		}
	}

	$type = "";
	// Titre du graphique
	if (isset ( $_GET ['type'] )) {
		switch ($_GET ['type']) {
			case '0' :
				$type = "Répartition Par Domaine (DocInfoDyn)";
				break;
			case '1' :
				$type = "Répartition Par Domaine (DocStatic)";
				break;
			case '2' :
				$type = "Répartition Par Domaine (DocPartenaire)";
				break;
			case '3' :
				$type = "Répartition Par Domaine (Tous)";
				break;
			default :
				$type = "Répartition Par Domaine (Tous)";
				break;
		}
	} else {
		$type = "Répartition Par Domaine (Tous)";
	}
	// Le domaine indéfini ayant un id particulier on le lie en dehors de la boucle
	$dataArray ["Indéfini"] = NULL;
	include ('../../../../include/phpgraphlib_v2.30/phpgraphlib.php');
	// Configuration de la librairie
	$graph = new PHPGraphLib ( 1100, 500 );
	$graph->addData ( $dataArray );
	$graph->setTitle ( $type );
	$graph->setTitleColor ( "blue" );
	$graph->setBackgroundColor ( "255,255,255" );
	$graph->setBars ( true );
	$graph->setLine ( false );
	$graph->setLegend ( true );
	$graph->setLegendTitle ( 'Consultations' );
	$graph->setLegendTextColor ( "white" );
	$graph->setLegendColor ( "128,128,128" );
	$graph->setDataPoints ( false );
	$graph->setDataPointColor ( 'red' );
	$graph->setXValuesHorizontal ( false );
	$graph->setupXAxis ( 45 );
	$graph->setDataValues ( true );
	$graph->setDataValueColor ( 'maroon' );
	$graph->setGoalLine ( .0 );
	$graph->setGoalLineColor ( 'red' );
	$graph->createGraph ();
}
?>