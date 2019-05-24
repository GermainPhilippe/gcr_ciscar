<?php
/**
 * Graphique de la répartition par type
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
	$aModele = new StatConsultType ();
	$aCount = $aModele->SQL_COUNT ( isset ( $_GET ['m'] ) ? $_GET ['m'] : date ( 'm', $time ), isset ( $_GET ['a'] ) ? $_GET ['a'] : date ( 'Y', $time ), $_GET ['site'], '0' );
	$aModele->SQL_SELECT_TYPE_DOC_GRAPH ( isset ( $_GET ['m'] ) ? $_GET ['m'] : date ( 'm', $time ), isset ( $_GET ['a'] ) ? $_GET ['a'] : date ( 'Y', $time ), $_GET ['site'] );
	// On récupère le tableau contenant les types et lzue nombre de consultations
	$aArray = $aModele->getList ();

	$dataArray = array ();
	// On sélectionne l'ensembre des types enregistrés en bdd
	$sql = "SELECT DocCategorieID, SiteID, DocCatParentID, Description FROM wcm_document_categorie  WHERE SiteID='%s' AND DocCatParentID IS NULL ORDER BY Description";
	$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $_GET ['site'] ) );
	$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( 'Query failed: ' . mysqli_error ($_SESSION['LINK']) );
	if ($result) {
		while ( $row = mysqli_fetch_assoc ( $result ) ) {
			$salesgroup = $row ["Description"];
			// Si le type correspond à une entrée, on lui associe le nombre de consultations correspondants
			if (array_key_exists ( $row ["DocCategorieID"], $aArray )) {

				$count = $aArray [$row ["DocCategorieID"]];
			} else {
				// Sinon c'est qu'il n'y a aucune consultation
				$count = 0;
			}
			$dataArray [$salesgroup] = $count;
		}
	}
	include ('../../../../include/phpgraphlib_v2.30/phpgraphlib.php');
	// Configuration de la librairie
	$graph = new PHPGraphLib ( 1100, 500 );
	$graph->addData ( $dataArray );
	$graph->setTitle ( 'Répartition Par Type de Publication (DocInfoDyn)' );
	$graph->setTitleColor ( "blue" );
	$graph->setBackgroundColor ( "255,255,255" );
	$graph->setBars ( true );
	$graph->setLine ( false );
	$graph->setDataPoints ( false );
	$graph->setDataPointColor ( 'red' );
	$graph->setLegend ( true );
	$graph->setLegendTitle ( 'Consultations' );
	$graph->setLegendTextColor ( "white" );
	$graph->setLegendColor ( "128,128,128" );
	$graph->setXValuesHorizontal ( false );
	$graph->setupXAxis ( 45 );
	$graph->setDataValues ( true );
	$graph->setDataValueColor ( 'maroon' );
	$graph->setGoalLine ( .0 );
	$graph->setGoalLineColor ( 'red' );
	$graph->createGraph ();
}
?>