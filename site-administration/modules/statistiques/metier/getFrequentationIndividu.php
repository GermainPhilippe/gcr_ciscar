<?php
session_start ();

if (! isset ( $_SESSION ['ADMIN'] )) {
	$_SESSION ['ADMIN'] ['USER'] ['FULLNAME'] = 'Visitor';
	$_SESSION ['ADMIN'] ['USER'] ['SiteName'] = '';
	$_SESSION ['ADMIN'] ['USER'] ['CONNECTED'] = false;
	$_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] = 0;
}

if ($_SESSION ['ADMIN'] ['USER'] ['CONNECTED']) {
	include ('../../../../config/configuration.php');
	$baseURLModule = '../../../modules/';
	require ('../../../include/DbConnexion.php');
	require ('../../mvc_inc.php');
	$time = time ();

	$aModele = new Frequentation ();
	$month = (isset ( $_GET ['m'] )) ? $_GET ['m'] : date ( 'm', $time );
	$year = (isset ( $_GET ['a'] )) ? $_GET ['a'] : date ( 'Y', $time );
	$user_id = isset ( $_GET ['user_id'] ) ? $_GET ['user_id'] : '';

	$dao = new FrequentationIndividu ();
	$list = $dao->findAllBySiteID ( $_GET ['site'], $month, $year, $user_id );

	switch ($_GET ['site']) {
		case 1 :
			$site = 'CISCAR';
			break;
		case 3 :
			$site = 'GCNF';
			break;
		case 2 :
			$site = 'GCR';
			break;
		case 7 :
			$site = 'GCRE';
			break;
	}

	header ( 'Content-Type:application/csv-tab-delimited-table' );
	header ( 'Content-disposition: filename="FrequentationsIndividu_' . $site . '.csv"' );

	echo "Utilisateur;";
	echo "Date;";
	echo "Page_Entree;";
	echo "URL_Entree;";
	echo "Page_Sortie;";
	echo "URL_Sortie";
	echo "\n";

	foreach ( $list as $line ) {
		echo '"' . $line [6] . ' ' . $line [7] . '";';
		echo '"' . $line [1] . '";';
		echo '"' . $line [2] . '";';
		echo '"' . $line [3] . '";';
		echo '"' . $line [4] . '";';
		echo '"' . $line [5] . '"';
		echo "\n";
	}

	require ('../../../include/DbDeconnexion.php');
}

?>