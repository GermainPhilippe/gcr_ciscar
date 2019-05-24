<?php
/**
 * Graphique de la fréquentation quotidienne
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
	// On récupère le nombre de jours du mois courant ou demandé
	$m = (isset ( $_GET ['m'] )) ? $_GET ['m'] : date ( 'm', $time );
	$y = (isset ( $_GET ['a'] )) ? $_GET ['a'] : date ( 'Y', $time );
	$mois = mktime ( 0, 0, 0, $m, 1, $y );
	$jours = date ( 't', $mois );
	$aModele = new Frequentation ();
	$aModele->SQL_SELECT_FREQUENTATION ( isset ( $_GET ['m'] ) ? $_GET ['m'] : date ( 'm', $time ), isset ( $_GET ['a'] ) ? $_GET ['a'] : date ( 'Y', $time ), $_GET ['site'] );
	// On récupère le tableau de la fréquentation par jour du mois en cours ou demandé
	$aList = $aModele->getList ();
	$array = array ();
	// On parcours chaque entrée
	for($i = 1; $i <= $jours; $i ++) {
		if (array_key_exists ( $i, $aList )) {
			// Si le jour à une entrée correpondante, on lui affecte le nombre de fréquentation correspondante
			$array += array (
					"$i" => intval ( $aList [$i] )
			);
		} else {
			// Sinon il n'y a pas de fréquentation ce jour là
			$array += array (
					"$i" => 0
			);
		}
	}
	include ('../../../../include/phpgraphlib_v2.30/phpgraphlib.php');
	// Configuration de la librairie
	$graph = new PHPGraphLib ( 600, 250 );
	$graph->addData ( $array );
	$graph->setTitle ( 'Fréquentation Quotidienne' );
	$graph->setTitleColor ( "blue" );
	$graph->setBackgroundColor ( "255,255,255" );
	$graph->setBars ( false );
	$graph->setLine ( true );
	$graph->setLegend ( true );
	$graph->setLegendTitle ( 'Consultations' );
	$graph->setLegendTextColor ( "white" );
	$graph->setLegendColor ( "128,128,128" );
	$graph->setLineColor ( 'red' );
	$graph->setDataPoints ( false );
	$graph->setDataPointColor ( 'red' );
	$graph->setXValuesHorizontal ( true );
	$graph->setDataValues ( true );
	$graph->setDataValueColor ( 'maroon' );
	$graph->setGoalLine ( .0 );
	$graph->setGoalLineColor ( 'red' );
	$graph->createGraph ();
}
?>